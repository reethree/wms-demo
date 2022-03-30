<?php

namespace App\Http\Controllers\Invoice;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    
    public function invoiceIndex()
    {
        if ( !$this->access->can('show.invoice.index') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "Invoice";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'Invoice'
            ]
        ];        
        
        $data['consolidators'] = \App\Models\Consolidator::select('TCONSOLIDATOR_PK as id','NAMACONSOLIDATOR as name')->get();
        
        return view('invoice.index-invoice')->with($data);
    }
    
    public function releaseIndex()
    {
        if ( !$this->access->can('show.invoice.release.index') ) {
            return view('errors.no-access');
        }
        
        // Create Roles Access
        $this->insertRoleAccess(array('name' => 'Index Invoice Release', 'slug' => 'show.invoice.release.index', 'description' => ''));
        
        $data['page_title'] = "Invoice Release";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'Invoice Release'
            ]
        ];        
        
//        $data['perusahaans'] = DBPerusahaan::select('TPERUSAHAAN_PK as id', 'NAMAPERUSAHAAN as name')->get();
        
        return view('invoice.index-release')->with($data);
    }
    
    public function invoiceEdit($id)
    {
        
        if ( !$this->access->can('edit.invoice.index') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "Edit Invoice";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('invoice-index'),
                'title' => 'Invoice'
            ],
            [
                'action' => '',
                'title' => 'Edit'
            ]
        ];
        
        $data['invoice'] = \DB::table('invoice_import')->find($id);
        $data['manifest'] = \App\Models\Manifest::find($data['invoice']->manifest_id);
        $data['tarif'] = \App\Models\InvoiceTarif::where(array('consolidator_id' => $data['manifest']->TCONSOLIDATOR_FK, 'type' => $data['manifest']->INVOICE))->first();
//        $data['tarif'] = \App\Models\ConsolidatorTarif::where('TCONSOLIDATOR_FK', $data['manifest']->TCONSOLIDATOR_FK)->first();
        $total = $data['invoice']->sub_total + $data['invoice']->ppn;
        $data['terbilang'] = ucwords($this->terbilang($total))." Rupiah";
        
        return view('invoice.edit-invoice')->with($data);
    }
    
    public function invoiceDestroy($id)
    {
        \DB::table('invoice_import')->where('id', $id)->delete();
        return back()->with('success', 'Invoice has been deleted.'); 
    }
    
    public function invoicePrint($id)
    {
        $data['invoice'] = \DB::table('invoice_import')->find($id);
        $data['manifest'] = \App\Models\Manifest::find($data['invoice']->manifest_id);
        $data['tarif'] = \App\Models\InvoiceTarif::where(array('consolidator_id' => $data['manifest']->TCONSOLIDATOR_FK, 'type' => $data['manifest']->INVOICE))->first();
//        $data['tarif'] = \App\Models\ConsolidatorTarif::where('TCONSOLIDATOR_FK', $data['manifest']->TCONSOLIDATOR_FK)->first();
        $total = $data['invoice']->sub_total + $data['invoice']->ppn;
        $data['terbilang'] = ucwords($this->terbilang($total))." Rupiah";
//        return view('print.bon-muat', $container);
        
//        switch ($type){
//            case 'bon-muat':
//                $pdf = \PDF::loadView('print.bon-muat', $data);        
//                break;
//            case 'surat-jalan':
//                $pdf = \PDF::loadView('print.surat-jalan', $data);
//                break;
//        }
        return view('print.invoice')->with($data);
        $pdf = \PDF::loadView('print.invoice', $data)->setPaper('a4');
        
        return $pdf->stream($data['invoice']->no_invoice.'-'.date('dmy').'.pdf');
    }
    
    public function invoicePrintRekapAkumulasi(Request $request)
    {
        $consolidator_id = $request->consolidator_id;
        $start = $request->start_date;
        $end = $request->end_date;
        $type = $request->type;
        
        $data['consolidator'] = \App\Models\Consolidator::find($consolidator_id);
        
        $data['invoices'] = \App\Models\Invoice::select('tmanifest.tglrelease', 
                \DB::raw('SUM(invoice_import.sub_total) as sub_total'), 
                \DB::raw('SUM(invoice_import.cbm) as total_cbm'), 
                \DB::raw('SUM(invoice_import.rdm) as total_rdm'),
                \DB::raw('COUNT(invoice_import.id) as total_inv'))               
                ->join('tmanifest','invoice_import.manifest_id','=','tmanifest.TMANIFEST_PK')
                ->where('tmanifest.TCONSOLIDATOR_FK', $consolidator_id)
                ->where('tmanifest.tglrelease','>=',$start)
                ->where('tmanifest.tglrelease','<=',$end)
                ->where('tmanifest.INVOICE', $type)
                ->groupBy('tmanifest.tglrelease')
                ->get();
        
//        return $data['invoices'];
        
        if(count($data['invoices']) > 0):
            
            $sum_total = array();
            foreach ($data['invoices'] as $invoice):
                $sum_total[] = $invoice->sub_total;        
            endforeach;
            
            $data['sub_total'] = array_sum($sum_total);
            if(isset($request->free_ppn)):
                $data['ppn'] = 0;
            else:
                $data['ppn'] = $data['sub_total']*11/100;
            endif;
            
            $data['materai'] = ($data['sub_total'] + $data['ppn'] >= 5000000) ? '10000' : '0';
            $data['total'] = round($data['sub_total'] + $data['ppn'] + $data['materai']);           
            $data['terbilang'] = ucwords($this->terbilang($data['total']))." Rupiah";
            $data['tgl_cetak'] = $request->tgl_cetak;
            $data['tgl_release'] = array('start' => $start, 'end' => $end);
            $data['type'] = $type;
            
            return \View('print.invoice-rekap-akumulasi', $data);
            
            $pdf = \PDF::loadView('print.invoice-rekap-akumulasi', $data)->setPaper('legal');

            return $pdf->stream('Rekap Akumulasi Invoice '.date('d-m-Y').'-'.$data['consolidator']->NAMACONSOLIDATOR.'.pdf');
            
        endif;
        
        return back()->with('error', 'Data tidak ditemukan.')->withInput();
    }
    
    public function invoicePrintRekap(Request $request)
    {
        $consolidator_id = $request->consolidator_id;
        $start = $request->tanggal.' 00:00:00';
        $end = date('Y-m-d', strtotime('+1 Day', strtotime($request->tanggal))).' 00:00:00';
        $type = $request->type;
        
        $data['consolidator'] = \App\Models\Consolidator::find($consolidator_id);
        $data['invoices'] = \App\Models\Invoice::select('*')
                ->join('tmanifest','invoice_import.manifest_id','=','tmanifest.TMANIFEST_PK')
                ->where('tmanifest.TCONSOLIDATOR_FK', $consolidator_id)
                ->where('tmanifest.tglrelease',$request->tanggal)
//                ->where('invoice_import.created_at','>=',$start)
//                ->where('invoice_import.created_at','<',$end)
                ->where('tmanifest.INVOICE', $type)
                ->get();
        
        if(count($data['invoices']) > 0):
            $sum_total = array();
            foreach ($data['invoices'] as $invoice):
                $sum_total[] = $invoice->sub_total;        
            endforeach;
            
            $data['sub_total'] = array_sum($sum_total);
            if(isset($request->free_ppn)):
                $data['ppn'] = 0;
            else:
                $data['ppn'] = $data['sub_total']*11/100;
            endif;
            $data['materai'] = ($data['sub_total'] + $data['ppn'] > 5000000) ? '10000' : '0';
            $data['total'] = round($data['sub_total'] + $data['ppn'] + $data['materai']);           
            $data['terbilang'] = ucwords($this->terbilang($data['total']))." Rupiah";
            $data['tgl_cetak'] = $request->tgl_cetak;

            return \View('print.invoice-rekap', $data);
            
            $pdf = \PDF::loadView('print.invoice-rekap', $data)->setPaper('legal');

            return $pdf->stream('Rekap Invoice '.date('d-m-Y').'-'.$data['consolidator']->NAMACONSOLIDATOR.'.pdf');
            
        endif;
        
        return back()->with('error', 'Data tidak ditemukan.')->withInput();
    }
    
    public function tarifIndex()
    {
        if ( !$this->access->can('show.tarif.index') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "Daftar Tarif";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'Daftar Tarif'
            ]
        ];        
        
        return view('invoice.index-tarif')->with($data);
    }
    
    public function tarifCreate()
    {
        if ( !$this->access->can('show.tarif.create') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "Create Tarif";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('invoice-tarif-index'),
                'title' => 'Daftar Tarif'
            ],
            [
                'action' => '',
                'title' => 'Create'
            ]
        ];         
        
        $data['consolidators'] = \App\Models\Consolidator::select('TCONSOLIDATOR_PK as id','NAMACONSOLIDATOR as name')->get();
        
        return view('invoice.create-tarif')->with($data);
    }

    public function tarifView($id)
    {
        if ( !$this->access->can('show.tarif.view') ) {
            return view('errors.no-access');
        }
        
        $tarif = \DB::table('invoice_tarif')->find($id);
        
        $data['page_title'] = "Daftar Item Tarif ".$tarif->type;
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('invoice-tarif-index'),
                'title' => 'Daftar Tarif'
            ],
            [
                'action' => '',
                'title' => "Daftar Item Tarif ".$tarif->type
            ]
        ];        
        
        $data['tarif'] = $tarif;
        
        return view('invoice.view-tarif')->with($data);
    }
    
    public function tarifEdit($id)
    {
        if ( !$this->access->can('show.tarif.edit') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "Edit Tarif";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('invoice-tarif-index'),
                'title' => 'Daftar Tarif'
            ],
            [
                'action' => '',
                'title' => 'Edit'
            ]
        ];         
        $data['tarif'] = \App\Models\InvoiceTarif::find($id);
        $data['consolidators'] = \App\Models\Consolidator::select('TCONSOLIDATOR_PK as id','NAMACONSOLIDATOR as name')->get();
        
        return view('invoice.update-tarif')->with($data);
    }
    
    public function tarifStore(Request $request)
    {
        if ( !$this->access->can('store.tarif.create') ) {
            return view('errors.no-access');
        }
        
        $validator = \Validator::make($request->all(), [
            'consolidator_id' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        $data = $request->except(['_token']);
        $data['UID'] = \Auth::getUser()->name;
        
        $insert_id = \App\Models\InvoiceTarif::insertGetId($data);
        
        if($insert_id){
            return redirect()->route('invoice-tarif-index')->with('success', 'Tarif has been created.');
        }
        
        return back()->with('error', 'Tarif cannot create, please try again.')->withInput();
    }
    
    public function tarifUpdate(Request $request, $id)
    {
        if ( !$this->access->can('show.tarif.edit') ) {
            return view('errors.no-access');
        }
        
        $validator = \Validator::make($request->all(), [
            'consolidator_id' => 'required'
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        $data = $request->except(['_token']);
        if(!isset($data['surcharge'])) { $data['surcharge'] = 0; }
        if(!isset($data['cbm'])) { $data['cbm'] = 0; }
        if(!isset($data['pembulatan'])) { $data['pembulatan'] = 0; }

        $update = \App\Models\InvoiceTarif::where('id', $id)->update($data);
        
        if($update){
            return redirect()->route('invoice-tarif-index')->with('success', 'Tarif has been updated.');
        }
        
        return back()->with('error', 'Tarif cannot update, please try again.')->withInput();
    }
    
    public function tarifDestroy($id)
    {
        \App\Models\InvoiceTarif::where('id', $id)->delete();
        return back()->with('success', 'Invoice tarif has been deleted.'); 
    }
    
    public function tarifItemEdit($id)
    {
        if ( !$this->access->can('show.tarif.item.edit') ) {
            return view('errors.no-access');
        }
        
        $tarif_item = \DB::table('invoice_tarif_item')->find($id);
        
        $data['page_title'] = "Edit Item Tarif ".$tarif_item->description;
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('invoice-tarif-index'),
                'title' => 'Daftar Tarif'
            ],
            [
                'action' => '',
                'title' => "Edit Item Tarif ".$tarif_item->description
            ]
        ];        
        
        $data['item'] = $tarif_item;
        
        return view('invoice.edit-tarif')->with($data);
    }
    
    public function tarifItemUpdate(Request $request, $id)
    {
        if ( !$this->access->can('update.tarif.item.edit') ) {
            return view('errors.no-access');
        }
        
        unset($request['_token']);
        
        //UPDATE TARIF
        $update = \DB::table('invoice_tarif_item')->where('id', $id)
            ->update($request->all());

        if($update){

            return back()->with('success', 'LCL Register has been updated.');                   
        }
        
        return back()->with('error', 'Something wrong, please try again.')->withInput();
    }
    
    
//    FCL INVOICE
    public function invoiceNctIndex()
    {
        if ( !$this->access->can('show.invoicenct.index') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "Invoice NCT1";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'Invoice NCT1'
            ]
        ];        

        return view('invoice.index-invoice-nct')->with($data);
    }
    
    public function invoiceNctEdit($id)
    {
        if ( !$this->access->can('edit.invoiceNct.index') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "Edit Invoice NCT1";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('invoice-nct-index'),
                'title' => 'Invoice NCT1'
            ],
            [
                'action' => '',
                'title' => 'Edit'
            ]
        ];
        
        $data['invoice'] = \App\Models\InvoiceNct::find($id);
        $data['penumpukan'] = \App\Models\InvoiceNctPenumpukan::where('invoice_nct_id', $data['invoice']->id)->get();
        $data['gerakan'] = \App\Models\InvoiceNctGerakan::where('invoice_nct_id', $data['invoice']->id)->orderBy('lokasi_sandar', 'ASC')->get();
        $data['tarif'] = \App\Models\InvoiceTarifNct::get();
        $data['terbilang'] = ucwords($this->terbilang($data['invoice']->total))." Rupiah";
        
        return view('invoice.edit-invoice-nct')->with($data);
    }
    
    public function invoiceNctDestroy($id)
    {
        \App\Models\InvoiceNct::where('id', $id)->delete();
        \App\Models\InvoiceNctPenumpukan::where('invoice_nct_id', $id)->delete();
        \App\Models\InvoiceNctGerakan::where('invoice_nct_id', $id)->delete();
        
        return back()->with('success', 'Invoice has been deleted.'); 
    }
    
    public function invoiceNctPrint($id)
    {
        $data['invoice'] = \App\Models\InvoiceNct::find($id);
        $data['penumpukan'] = \App\Models\InvoiceNctPenumpukan::where('invoice_nct_id', $data['invoice']->id)->get();
        $data['gerakan'] = \App\Models\InvoiceNctGerakan::where('invoice_nct_id', $data['invoice']->id)->orderBy('lokasi_sandar', 'ASC')->get();
        $data['tarif'] = \App\Models\InvoiceTarifNct::get();
        $data['terbilang'] = ucwords($this->terbilang($data['invoice']->total))." Rupiah";

        return view('print.invoice-nct')->with($data);

        $pdf = \PDF::loadView('print.invoice-nct', $data)->setPaper('legal');
        return $pdf->stream($data['invoice']->no_invoice.'.pdf');
    }
    
    public function tarifNctIndex()
    {
        if ( !$this->access->can('show.tarifnct.index') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "Daftar Tarif NCT1";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'Daftar Tarif NCT1'
            ]
        ];        
        
        return view('invoice.index-tarif-nct')->with($data);
    }
    
    public function releaseNctIndex()
    {
        if ( !$this->access->can('show.invoice.releasenct.index') ) {
            return view('errors.no-access');
        }
        
        // Create Roles Access
        $this->insertRoleAccess(array('name' => 'Index Invoice Release NCT1', 'slug' => 'show.invoice.releasenct.index', 'description' => ''));
        
        $data['page_title'] = "Invoice Release FCL";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'Invoice Release FCL'
            ]
        ];        
        
//        $data['perusahaans'] = DBPerusahaan::select('TPERUSAHAAN_PK as id', 'NAMAPERUSAHAAN as name')->get();
        
        return view('invoice.index-release-fcl')->with($data);
    }
    
    public function updateInvoiceRdm(Request $request)
    {
        $invoices = \App\Models\Invoice::select('invoice_import.*')               
                ->join('tmanifest','invoice_import.manifest_id','=','tmanifest.TMANIFEST_PK')
                ->where('tmanifest.TCONSOLIDATOR_FK', $request->consolidator_id)
                ->where('tmanifest.tglrelease','>=',$request->start_date)
                ->where('tmanifest.tglrelease','<=',$request->end_date)
                ->where('tmanifest.INVOICE', $request->type)
//                ->where('invoice_import.rdm', 0)
                ->get();
        
        $i = 0;
        foreach ($invoices as $invoice):
            $rdm =  $request->tarif_rdm * $invoice->cbm;
            
            $array_total = array(
                $rdm,
                $invoice->storage,
                $invoice->storage_masa1,
                $invoice->storage_masa2,
                $invoice->storage_masa3,
                $invoice->harga_behandle,
                $invoice->adm,
                $invoice->dg_surcharge,
                $invoice->weight_surcharge
            );
            $subtotal = array_sum($array_total);     
            
            // Update Invoice
            $update = \App\Models\Invoice::find($invoice->id);
            $update->rdm = $rdm;
            $update->sub_total = $subtotal;
            $update->save();
            
            $i++;
        endforeach;
        
        if($i > 0){
            return back()->with('success', $i.' invoice berhasil di update.'); 
        }
        
        return back()->with('error', 'Tidak ada invoice yang di update.');
    }

    public function InvoicePlatformApprovePayment($invoice_id)
    {
        $invoice = InvoiceNct::find($invoice_id);
        if($invoice){
            // Update Payment Status
            $invoice->payment_status = 'Paid';
            $invoice->payment_date = date('Y-m-d H:i:s');

            if($invoice->save()){
                // Update VA Status

                // Create & Send Gate Pass
                $nobl = $invoice->no_bl;
                $conts = explode(',',$invoice->no_container);
                $expired = date('Y-m-d', strtotime('+1 day'));

                foreach ($conts as $cont):
                    $refdata = Containercy::where(array('NOCONTAINER' => $cont, 'NO_BL_AWB' => $nobl))->first();
                    $ids[] = $refdata->TCONTAINER_PK;
//                    $urls[] = route('barcode-print-pdf', array('fcl', $refdata->TCONTAINER_PK));
                    $ref_id = $refdata->TCONTAINER_PK;
                    $ref_number = $refdata->NOCONTAINER;
                    if($refdata->flag_bc == 'Y' || $refdata->status_bc == 'HOLD'){
                        $ref_status = 'hold';
                    }else{
                        $ref_status = 'active';
                    }

                    $check = \App\Models\Barcode::where(array('ref_id'=>$ref_id, 'ref_type'=>'FCL', 'ref_action'=>'release'))->first();
                    if(count($check) > 0){
//                    continue;
                        $barcode = \App\Models\Barcode::find($check->id);
                        $barcode->expired = $expired;
                        $barcode->status = $ref_status;
                        $barcode->uid = 'Platform';
                        $barcode->save();
                    }else{
                        $barcode = new \App\Models\Barcode();
                        $barcode->ref_id = $ref_id;
                        $barcode->ref_type = 'FCL';
                        $barcode->ref_action = 'release';
                        $barcode->ref_number = $ref_number;
                        $barcode->barcode = str_random(20);
                        $barcode->expired = $expired;
                        $barcode->status = $ref_status;
                        $barcode->uid = 'Platform';
                        $barcode->save();
                    }
                endforeach;

                $data_barcode = \App\Models\Barcode::select('barcode_autogate.*','tcontainercy.location_name','tcontainercy.NOCONTAINER','tcontainercy.SIZE','tcontainercy.KD_TPS_ASAL','tcontainercy.VOY','tcontainercy.VESSEL','tcontainercy.NO_PLP','tcontainercy.TGL_PLP','tcontainercy.NO_BC11','tcontainercy.TGL_BC11')
                    ->join('tcontainercy', 'barcode_autogate.ref_id', '=', 'tcontainercy.TCONTAINER_PK')
                    ->where(array('ref_type' => 'FCL', 'ref_action'=>'release'))
                    ->whereIn('tcontainercy.TCONTAINER_PK', $ids)
                    ->get();

//                $data['invoice'] = $invoice;
                $data['no_invoice'] = $invoice->no_invoice;
                $data['npwp'] = $invoice->npwp;
                $data['no_bl'] = $invoice->no_bl;
                $data['platform'] = 'TO011';
                $data['paid_date'] = date('Y-m-d');
                $data['barcode'] = $data_barcode;
//                $data['barcode']['urls'] = $urls;

                // Send Barcode To Platform
                $elogis_url_dev = 'http://localhost/ppjk-online/public/api/v1/generate-barcode';
                $elogis_url_prod = 'https://elogis.id/api/v1/generate-barcode';

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $elogis_url_prod);
                curl_setopt($ch, CURLOPT_HEADER, 0);            // No header in the result
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return, do not echo result
                curl_setopt($ch, CURLOPT_POST, 1);              // This is a POST request
                // Data to POST
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

                $dataResults = curl_exec($ch);
                curl_close($ch);

                $results = json_decode($dataResults);

                if($results->success){
                    // Update Invoice To Paid
                    return back()->with('success', $results->message);
                }

                return back()->with('error', $results->message);

            }
        }
    }

}
