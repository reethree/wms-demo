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
        
        return view('invoice.index-invoice')->with($data);
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
        $data['tarif'] = \App\Models\ConsolidatorTarif::where('TCONSOLIDATOR_FK', $data['manifest']->TCONSOLIDATOR_FK)->first();
        $total = $data['invoice']->sub_total + $data['invoice']->ppn;
        $data['terbilang'] = ucwords($this->terbilang($total))." Rupiah";
        
        return view('invoice.edit-invoice')->with($data);
    }
    
    public function invoiceDestroy($id)
    {
        
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

}
