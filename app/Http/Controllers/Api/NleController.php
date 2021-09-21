<?php

namespace App\Http\Controllers\Api;

use App\Models\Document;
use App\Models\KodeDok;
use App\Models\TpsDokPabeanCont;
use App\Models\TpsSppbBcCont;
use App\Models\TpsSppbPib;
use App\Models\Containercy as DBContainer;
use App\Models\Perusahaan as DBPerusahaan;
use App\Models\TpsSppbPibCont;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Api\ApiBaseController;

class NleController extends ApiBaseController
{
    public function getSppbOnline(Request $request){
        $no_bl = 'ACHY029607';
        $tgl_bl = '11/24/2019';
        $npwp = '025056797073000';

        $data = TpsSppbPib::where(array('NPWP_IMP'=>$npwp, 'NO_BL_AWB'=>$no_bl, 'TGL_BL_AWB'=>$tgl_bl))->first();

        return json_encode(['status'=>'200', 'msg' => 'success','data'=>$data]);
    }

    public function requestSppb(Request $request)
    {
        $no_bl = $request->no_bl;
        $tgl_bl = date('n/j/Y', strtotime($request->tgl_bl));
        $npwp = $request->npwp;
        $kd_dok = $request->kd_dok;
        $dok = KodeDok:: where('id', $kd_dok)->first();

        if($kd_dok == 1){
            $sppb = \App\Models\TpsSppbPib::where(array('NPWP_IMP'=>$npwp, 'NO_BL_AWB'=>$no_bl, 'TGL_BL_AWB'=>$tgl_bl))->first();
            if($sppb){
                $sppb->containers = TpsSppbPibCont::where('TPS_SPPBXML_FK', $sppb->TPS_SPPBXML_PK)->get();
            }
        }elseif($kd_dok == 2){
            $sppb = \App\Models\TpsSppbBc::where(array('NPWP_IMP'=>$npwp, 'NO_BL_AWB'=>$no_bl, 'TGL_BL_AWB'=>$tgl_bl))->first();
            if($sppb) {
                $sppb->containers = TpsSppbBcCont::where('TPS_SPPBXML_FK', $sppb->TPS_SPPBXML_PK)->get();
            }
        }else{
            $sppb = \App\Models\TpsDokPabean::select('NO_DOK_INOUT as NO_SPPB','TGL_DOK_INOUT as TGL_SPPB','NPWP_IMP')
                ->where(array('NPWP_IMP'=>$npwp, 'KD_DOK_INOUT' => $kd_dok, 'NO_BL_AWB' => $no_bl))->first();
            if($sppb) {
                $sppb->containers = TpsDokPabeanCont::where('TPS_DOKPABEANXML_FK', $sppb->TPS_DOKPABEANXML_PK)->get();
            }
        }

        if($sppb){
            $sppb->kode_dok = $dok->name;
            $sppb->id_dok = $dok->id;
            $data = $sppb;

            return json_encode(['status'=>'200', 'msg' => 'success','data'=>$data]);
        }

        return json_encode(['status'=>'404', 'msg' => 'not found','data'=>$request->all()]);
    }

    public function requestInvoiceForPlatform(Request $request)
    {
        $npwp = $request->npwp;
        $no_do = '';
        $no_bl = $request->no_bl;
        $paid_thrud_date = $request->paid_thrud_date;
        $conts = $request->containers;

        $container20 = DBContainer::where(array('NO_BL_AWB' => $no_bl, 'size' => 20))
            ->whereIn('NOCONTAINER', $conts)->get();
        $container40 = DBContainer::where(array('NO_BL_AWB' => $no_bl, 'size' => 40))
            ->whereIn('NOCONTAINER', $conts)->get();
        $container45 = DBContainer::where(array('NO_BL_AWB' => $no_bl, 'size' => 45))
            ->whereIn('NOCONTAINER', $conts)->get();

        if($container20 || $container40 || $container45) {

            if(count($container20) > 0){
                $data = $container20['0'];
            }elseif(count($container40) > 0){
                $data = $container40['0'];
            }else{
                $data = $container45['0'];
            }

            $getNoInv = $this->getInvoiceNumber('fcl','Platform');
            $no_inv = $getNoInv.'/LAP-PJP/'.date('Y').'/'.$data['KD_TPS_ASAL'].'/ELOGIS';
            $tgl_release = $paid_thrud_date;

//            $data = (count($container20) > 0 ? $container20['0'] : $container40['0']);
            $consignee = DBPerusahaan::where('TPERUSAHAAN_PK', $data['TCONSIGNEE_FK'])->first();

            // Create Invoice Header
            $invoice_nct = new \App\Models\InvoiceNct;
            $invoice_nct->no_container = implode(',', $conts);
            $invoice_nct->no_invoice = $no_inv;
            $invoice_nct->no_pajak = '-';
            $invoice_nct->consignee = $data['CONSIGNEE'];
            $invoice_nct->npwp = $data['ID_CONSIGNEE'];
            $invoice_nct->alamat = $consignee->ALAMAT;
            $invoice_nct->consignee_id = $data['TCONSIGNEE_FK'];
            $invoice_nct->vessel = $data['VESSEL'];
            $invoice_nct->voy = $data['VOY'];
            $invoice_nct->no_do = $no_do;
            $invoice_nct->no_bl = $no_bl;
            $invoice_nct->eta = $data['ETA'];
            $invoice_nct->gateout_terminal = $data['TGLMASUK'];
            $invoice_nct->gateout_tps = $tgl_release;
            $invoice_nct->type = $data['jenis_container'];
            $invoice_nct->tps_asal = $data['KD_TPS_ASAL'];
            $invoice_nct->payment_status = 'Waiting';
            $invoice_nct->uid = 'Platform';

            if($invoice_nct->save()) {

                // HARI TERMINAL
                $date1_terminal = date_create($data['ETA']);
                $date2_terminal = date_create(date('Y-m-d',strtotime($data['TGLMASUK'])));
                $diff_terminal = date_diff($date1_terminal, $date2_terminal);
                $hari_terminal = $diff_terminal->format("%a")+1;

                if($data['KD_TPS_ASAL'] == 'NCT1' || $data['KD_TPS_ASAL'] == 'KOJA'){
                    if($data['KD_TPS_ASAL'] == 'KOJA'){
                        $nct_gerakan = array('Pas Truck' => 9100);
                    }else{
                        $nct_gerakan = array('Pas Truck' => 9100, 'Gate Pass Admin' => 20000, 'Cost Rec/Surcarge' => 75000);
                    }

                    foreach($nct_gerakan as $key=>$value):
                        $invoice_gerakan = new \App\Models\InvoiceNctGerakan;

                        $invoice_gerakan->invoice_nct_id = $invoice_nct->id;
                        $invoice_gerakan->lokasi_sandar = $data['KD_TPS_ASAL'];
                        $invoice_gerakan->size = 0;
                        $invoice_gerakan->qty = count($container20)+count($container40)+count($container45);
                        $invoice_gerakan->jenis_gerakan = $key;
                        $invoice_gerakan->tarif_dasar = $value;
                        $invoice_gerakan->total = (count($container20)+count($container40)+count($container45)) * $value;

                        $invoice_gerakan->save();
                    endforeach;
                }else{
                    $invoice_gerakan = new \App\Models\InvoiceNctGerakan;

                    $invoice_gerakan->invoice_nct_id = $invoice_nct->id;
                    $invoice_gerakan->lokasi_sandar = 'JICT';
                    $invoice_gerakan->size = 0;
                    $invoice_gerakan->qty = count($container20)+count($container40)+count($container45);
                    $invoice_gerakan->jenis_gerakan = 'Cost Rec/Surcarge';
                    $invoice_gerakan->tarif_dasar = 75000;
                    $invoice_gerakan->total = (count($container20)+count($container40)+count($container45)) * 75000;

                    $invoice_gerakan->save();
                }

                // Insert Invoice Detail
                if(count($container20) > 0) {

                    $tarif20 = \App\Models\InvoiceTarifNct::where(array('size' => 20, 'type' => $data->jenis_container))->whereIn('lokasi_sandar', array($data['KD_TPS_ASAL'],'TPS'))->get();

                    foreach ($tarif20 as $t20) :

                        $invoice_penumpukan = new \App\Models\InvoiceNctPenumpukan;

                        $invoice_penumpukan->invoice_nct_id = $invoice_nct->id;
                        $invoice_penumpukan->lokasi_sandar = $t20->lokasi_sandar;
                        $invoice_penumpukan->size = 20;
                        $invoice_penumpukan->qty = count($container20);

                        if($t20->lokasi_sandar == 'NCT1' || $t20->lokasi_sandar == 'JICT' || $t20->lokasi_sandar == 'KOJA') {

                            // GERAKAN
                            $invoice_gerakan = new \App\Models\InvoiceNctGerakan;

                            $invoice_gerakan->invoice_nct_id = $invoice_nct->id;
                            $invoice_gerakan->lokasi_sandar = $t20->lokasi_sandar;
                            $invoice_gerakan->size = 20;
                            $invoice_gerakan->qty = count($container20);
                            $invoice_gerakan->jenis_gerakan = 'Lift On Terminal';
                            $invoice_gerakan->tarif_dasar = $t20->lift_on;
                            $invoice_gerakan->total = $invoice_gerakan->qty * $t20->lift_on;
                            $invoice_gerakan->save();

                            // PENUMPUKAN
                            $date1 = date_create($data['ETA']);
                            $date2 = date_create(date('Y-m-d',strtotime($data['TGLMASUK']. "+1 days")));
                            $diff = date_diff($date1, $date2);
                            $hari = $diff->format("%a");

                            $invoice_penumpukan->startdate = $data['ETA'];
                            $invoice_penumpukan->enddate = $data['TGLMASUK'];
                            $invoice_penumpukan->lama_timbun = $hari;
                            $invoice_penumpukan->tarif_dasar = $t20->masa2;

                            $invoice_penumpukan->hari_masa1 = ($hari > 0) ? 1 : 0;
                            $invoice_penumpukan->hari_masa2 = ($hari > 1) ? 1 : 0;
//                            $invoice_penumpukan->hari_masa3 = ($hari > 2) ? 1 : 0;
                            $invoice_penumpukan->hari_masa3 = ($hari > 2) ? $hari - 2 : 0;
                            $invoice_penumpukan->hari_masa4 = 0;

                            $invoice_penumpukan->masa1 = ($invoice_penumpukan->hari_masa2 * $t20->masa1) * count($container20);
                            $invoice_penumpukan->masa2 = ($invoice_penumpukan->hari_masa2 * $t20->masa2 * 3) * count($container20);
                            $invoice_penumpukan->masa3 = ($invoice_penumpukan->hari_masa3 * $t20->masa3 * 6) * count($container20);
                            $invoice_penumpukan->masa4 = ($invoice_penumpukan->hari_masa4 * $t20->masa4 * 9) * count($container20);

                        } else {

                            // GERAKAN
//                            if($data['BEHANDLE'] == 'Y') {
//                                $jenis = array('Lift On/Off' => $t20->lift_off,'Paket PLP' => $t20->paket_plp,'Behandle' => $t20->behandle);
//                            }else{
                            if($data->jenis_container == 'BB') {
                                $jenis = array('Lift On/Off' => $t20->lift_off*2, 'Paket PLP' => $t20->paket_plp);
                            }else{
                                $jenis = array('Lift On/Off' => $t20->lift_off, 'Paket PLP' => $t20->paket_plp);
                            }
//                            }


                            foreach ($jenis as $key=>$value):
                                $invoice_gerakan = new \App\Models\InvoiceNctGerakan;

                                $invoice_gerakan->invoice_nct_id = $invoice_nct->id;
                                $invoice_gerakan->lokasi_sandar = $t20->lokasi_sandar;
                                $invoice_gerakan->size = 20;
                                $invoice_gerakan->qty = count($container20);
                                $invoice_gerakan->jenis_gerakan = $key;
                                $invoice_gerakan->tarif_dasar = $value;
                                $invoice_gerakan->total = $invoice_gerakan->qty * $value;

                                $invoice_gerakan->save();
                            endforeach;

                            // PENUMPUKAN
                            $date1 = date_create($data['TGLMASUK']);
                            $date2 = date_create($tgl_release);
                            $diff = date_diff($date1, $date2);
//                            if($data['KD_TPS_ASAL'] == 'KOJA'){
//                                $hari = $diff->format("%a") + 1;
//                            }else{
                            $hari = $diff->format("%a");
//                            }

                            $invoice_penumpukan->startdate = $data['TGLMASUK'];
                            $invoice_penumpukan->enddate = $tgl_release;
                            $invoice_penumpukan->lama_timbun = $hari;
                            $invoice_penumpukan->tarif_dasar = $t20->masa2;

                            if($data['KD_TPS_ASAL'] == 'KOJA'){
                                if($hari_terminal >= 10){
                                    $invoice_penumpukan->hari_masa1 = 0;
                                    $invoice_penumpukan->hari_masa2 = $hari;
                                }else{
                                    $sisa_hari = 10-$hari_terminal;
                                    $hari_depo_masa1 = min(array($hari, $sisa_hari));
                                    $invoice_penumpukan->hari_masa1 = $hari_depo_masa1;
                                    $invoice_penumpukan->hari_masa2 = abs($hari-$hari_depo_masa1);
                                }
                            }else{
                                $invoice_penumpukan->hari_masa1 = ($hari > 0) ? min(array($hari,2)) : 0;
                                $invoice_penumpukan->hari_masa2 = ($hari > 2) ? $hari-2 : 0;
                            }

                            $invoice_penumpukan->hari_masa3 = 0;
                            $invoice_penumpukan->hari_masa4 = 0;

                            $invoice_penumpukan->masa1 = ($invoice_penumpukan->hari_masa1 * $t20->masa1 * 2) * count($container20);
                            $invoice_penumpukan->masa2 = ($invoice_penumpukan->hari_masa2 * $t20->masa2 * 3) * count($container20);
                            $invoice_penumpukan->masa3 = ($invoice_penumpukan->hari_masa3 * $t20->masa3) * count($container20);
                            $invoice_penumpukan->masa4 = ($invoice_penumpukan->hari_masa4 * $t20->masa4) * count($container20);
                        }

                        $invoice_penumpukan->total = array_sum(array($invoice_penumpukan->masa1,$invoice_penumpukan->masa2,$invoice_penumpukan->masa3,$invoice_penumpukan->masa4));

                        $invoice_penumpukan->save();

                    endforeach;

                }

                if(count($container40) > 0) {

                    $tarif40 = \App\Models\InvoiceTarifNct::where(array('size' => 40, 'type' => $data->jenis_container))->whereIn('lokasi_sandar', array($data['KD_TPS_ASAL'],'TPS'))->get();
//                    return $tarif40;
                    foreach ($tarif40 as $t40) :

                        $invoice_penumpukan = new \App\Models\InvoiceNctPenumpukan;

                        $invoice_penumpukan->invoice_nct_id = $invoice_nct->id;
                        $invoice_penumpukan->lokasi_sandar = $t40->lokasi_sandar;
                        $invoice_penumpukan->size = 40;
                        $invoice_penumpukan->qty = count($container40);

                        if($t40->lokasi_sandar == 'NCT1' || $t40->lokasi_sandar == 'JICT' || $t40->lokasi_sandar == 'KOJA') {
                            // GERAKAN
                            $invoice_gerakan = new \App\Models\InvoiceNctGerakan;

                            $invoice_gerakan->invoice_nct_id = $invoice_nct->id;
                            $invoice_gerakan->lokasi_sandar = $t40->lokasi_sandar;
                            $invoice_gerakan->size = 40;
                            $invoice_gerakan->qty = count($container40);
                            $invoice_gerakan->jenis_gerakan = 'Lift On Terminal';
                            $invoice_gerakan->tarif_dasar = $t40->lift_on;
                            $invoice_gerakan->total = $invoice_gerakan->qty * $t40->lift_on;
                            $invoice_gerakan->save();

                            // PENUMPUKAN
                            $date1 = date_create($data['ETA']);
                            $date2 = date_create(date('Y-m-d',strtotime($data['TGLMASUK']. "+1 days")));
                            $diff = date_diff($date1, $date2);
                            $hari = $diff->format("%a");

                            $invoice_penumpukan->startdate = $data['ETA'];
                            $invoice_penumpukan->enddate = $data['TGLMASUK'];
                            $invoice_penumpukan->lama_timbun = $hari;
                            $invoice_penumpukan->tarif_dasar = $t40->masa2;

                            $invoice_penumpukan->hari_masa1 = ($hari > 0) ? 1 : 0;
                            $invoice_penumpukan->hari_masa2 = ($hari > 1) ? 1 : 0;
//                            $invoice_penumpukan->hari_masa3 = ($hari > 2) ? 1 : 0;
                            $invoice_penumpukan->hari_masa3 = ($hari > 2) ? $hari - 2 : 0;
                            $invoice_penumpukan->hari_masa4 = 0;

                            $invoice_penumpukan->masa1 = ($invoice_penumpukan->hari_masa1 * $t40->masa1) * count($container40);
                            $invoice_penumpukan->masa2 = ($invoice_penumpukan->hari_masa2 * $t40->masa2 * 3) * count($container40);
                            $invoice_penumpukan->masa3 = ($invoice_penumpukan->hari_masa3 * $t40->masa3 * 6) * count($container40);
                            $invoice_penumpukan->masa4 = ($invoice_penumpukan->hari_masa4 * $t40->masa4 * 9) * count($container40);

                        } else {
                            // GERAKAN
//                            if($data['BEHANDLE'] == 'Y') {
//                                $jenis = array('Lift On/Off' => $t40->lift_off,'Paket PLP' => $t40->paket_plp,'Behandle' => $t40->behandle);
//                            }else{
                            if($data->jenis_container == 'BB') {
                                $jenis = array('Lift On/Off' => $t40->lift_off*2, 'Paket PLP' => $t40->paket_plp);
                            }else{
                                $jenis = array('Lift On/Off' => $t40->lift_off, 'Paket PLP' => $t40->paket_plp);
                            }
//                            }

                            foreach ($jenis as $key=>$value):
                                $invoice_gerakan = new \App\Models\InvoiceNctGerakan;

                                $invoice_gerakan->invoice_nct_id = $invoice_nct->id;
                                $invoice_gerakan->lokasi_sandar = $t40->lokasi_sandar;
                                $invoice_gerakan->size = 40;
                                $invoice_gerakan->qty = count($container40);
                                $invoice_gerakan->jenis_gerakan = $key;
                                $invoice_gerakan->tarif_dasar = $value;
                                $invoice_gerakan->total = $invoice_gerakan->qty * $value;

                                $invoice_gerakan->save();
                            endforeach;

                            // PENUMPUKAN
                            $date1 = date_create($data['TGLMASUK']);
                            $date2 = date_create($tgl_release);
                            $diff = date_diff($date1, $date2);
//                            if($data['KD_TPS_ASAL'] == 'KOJA'){
//                                $hari = $diff->format("%a") + 1;
//                            }else{
                            $hari = $diff->format("%a");
//                            }

                            $invoice_penumpukan->startdate = $data['TGLMASUK'];
                            $invoice_penumpukan->enddate = $tgl_release;
                            $invoice_penumpukan->lama_timbun = $hari;
                            $invoice_penumpukan->tarif_dasar = $t40->masa2;

                            if($data['KD_TPS_ASAL']  == 'KOJA'){
                                if($hari_terminal >= 10){
                                    $invoice_penumpukan->hari_masa1 = 0;
                                    $invoice_penumpukan->hari_masa2 = $hari;
                                }else{
                                    $sisa_hari = 10-$hari_terminal;
                                    $hari_depo_masa1 = min(array($hari, $sisa_hari));
                                    $invoice_penumpukan->hari_masa1 = $hari_depo_masa1;
                                    $invoice_penumpukan->hari_masa2 = abs($hari-$hari_depo_masa1);
                                }
                            }else{
                                $invoice_penumpukan->hari_masa1 = ($hari > 0) ? min(array($hari,2)) : 0;
                                $invoice_penumpukan->hari_masa2 = ($hari > 2) ? $hari-2 : 0;
                            }

                            $invoice_penumpukan->hari_masa3 = 0;
                            $invoice_penumpukan->hari_masa4 = 0;

                            $invoice_penumpukan->masa1 = ($invoice_penumpukan->hari_masa1 * $t40->masa1 * 2) * count($container40);
                            $invoice_penumpukan->masa2 = ($invoice_penumpukan->hari_masa2 * $t40->masa2 * 3) * count($container40);
                            $invoice_penumpukan->masa3 = ($invoice_penumpukan->hari_masa3 * $t40->masa3) * count($container40);
                            $invoice_penumpukan->masa4 = ($invoice_penumpukan->hari_masa4 * $t40->masa4) * count($container40);
                        }

                        $invoice_penumpukan->total = array_sum(array($invoice_penumpukan->masa1,$invoice_penumpukan->masa2,$invoice_penumpukan->masa3,$invoice_penumpukan->masa4));

                        $invoice_penumpukan->save();

                    endforeach;

                }

                if(count($container45) > 0) {

                    $tarif45 = \App\Models\InvoiceTarifNct::where(array('size' => 45, 'type' => $data->jenis_container))->whereIn('lokasi_sandar', array($data['KD_TPS_ASAL'],'TPS'))->get();
//                    return $tarif40;
                    foreach ($tarif45 as $t45) :

                        $invoice_penumpukan = new \App\Models\InvoiceNctPenumpukan;

                        $invoice_penumpukan->invoice_nct_id = $invoice_nct->id;
                        $invoice_penumpukan->lokasi_sandar = $t45->lokasi_sandar;
                        $invoice_penumpukan->size = 45;
                        $invoice_penumpukan->qty = count($container45);

                        if($t45->lokasi_sandar == 'NCT1' || $t45->lokasi_sandar == 'JICT' || $t45->lokasi_sandar == 'KOJA') {
                            // GERAKAN
                            $invoice_gerakan = new \App\Models\InvoiceNctGerakan;

                            $invoice_gerakan->invoice_nct_id = $invoice_nct->id;
                            $invoice_gerakan->lokasi_sandar = $t45->lokasi_sandar;
                            $invoice_gerakan->size = 45;
                            $invoice_gerakan->qty = count($container45);
                            $invoice_gerakan->jenis_gerakan = 'Lift On Terminal';
                            $invoice_gerakan->tarif_dasar = $t45->lift_on;
                            $invoice_gerakan->total = $invoice_gerakan->qty * $t45->lift_on;
                            $invoice_gerakan->save();

                            // PENUMPUKAN
                            $date1 = date_create($data['ETA']);
                            $date2 = date_create(date('Y-m-d',strtotime($data['TGLMASUK']. "+1 days")));
                            $diff = date_diff($date1, $date2);
                            $hari = $diff->format("%a");

                            $invoice_penumpukan->startdate = $data['ETA'];
                            $invoice_penumpukan->enddate = $data['TGLMASUK'];
                            $invoice_penumpukan->lama_timbun = $hari;
                            $invoice_penumpukan->tarif_dasar = $t45->masa2;

                            $invoice_penumpukan->hari_masa1 = ($hari > 0) ? 1 : 0;
                            $invoice_penumpukan->hari_masa2 = ($hari > 1) ? 1 : 0;
//                            $invoice_penumpukan->hari_masa3 = ($hari > 2) ? 1 : 0;
                            $invoice_penumpukan->hari_masa3 = ($hari > 2) ? $hari - 2 : 0;
                            $invoice_penumpukan->hari_masa4 = 0;

                            $invoice_penumpukan->masa1 = ($invoice_penumpukan->hari_masa1 * $t45->masa1) * count($container45);
                            $invoice_penumpukan->masa2 = ($invoice_penumpukan->hari_masa2 * $t45->masa2 * 3) * count($container45);
                            $invoice_penumpukan->masa3 = ($invoice_penumpukan->hari_masa3 * $t45->masa3 * 6) * count($container45);
                            $invoice_penumpukan->masa4 = ($invoice_penumpukan->hari_masa4 * $t45->masa4 * 9) * count($container45);

                        } else {
                            // GERAKAN
//                            if($data['BEHANDLE'] == 'Y') {
//                                $jenis = array('Lift On/Off' => $t45->lift_off,'Paket PLP' => $t45->paket_plp,'Behandle' => $t45->behandle);
//                            }else{
                            if($data->jenis_container == 'BB') {
                                $jenis = array('Lift On/Off' => $t45->lift_off*2, 'Paket PLP' => $t45->paket_plp);
                            }else{
                                $jenis = array('Lift On/Off' => $t45->lift_off, 'Paket PLP' => $t45->paket_plp);
                            }
//                            }

                            foreach ($jenis as $key=>$value):
                                $invoice_gerakan = new \App\Models\InvoiceNctGerakan;

                                $invoice_gerakan->invoice_nct_id = $invoice_nct->id;
                                $invoice_gerakan->lokasi_sandar = $t45->lokasi_sandar;
                                $invoice_gerakan->size = 45;
                                if($key == 'Lift On/Off'){
                                    $invoice_gerakan->qty = count($container45)*2;
                                }else{
                                    $invoice_gerakan->qty = count($container45);
                                }
                                $invoice_gerakan->jenis_gerakan = $key;
                                $invoice_gerakan->tarif_dasar = $value;
                                $invoice_gerakan->total = $invoice_gerakan->qty * $value;

                                $invoice_gerakan->save();
                            endforeach;

                            // PENUMPUKAN
                            $date1 = date_create($data['TGLMASUK']);
                            $date2 = date_create($tgl_release);
                            $diff = date_diff($date1, $date2);
//                            if($data['KD_TPS_ASAL'] == 'KOJA'){
//                                $hari = $diff->format("%a") + 1;
//                            }else{
                            $hari = $diff->format("%a");
//                            }

                            $invoice_penumpukan->startdate = $data['TGLMASUK'];
                            $invoice_penumpukan->enddate = $tgl_release;
                            $invoice_penumpukan->lama_timbun = $hari;
                            $invoice_penumpukan->tarif_dasar = $t45->masa2;

                            if($data['KD_TPS_ASAL'] == 'KOJA'){
                                if($hari_terminal >= 10){
                                    $invoice_penumpukan->hari_masa1 = 0;
                                    $invoice_penumpukan->hari_masa2 = $hari;
                                }else{
                                    $sisa_hari = 10-$hari_terminal;
                                    $hari_depo_masa1 = min(array($hari, $sisa_hari));
                                    $invoice_penumpukan->hari_masa1 = $hari_depo_masa1;
                                    $invoice_penumpukan->hari_masa2 = abs($hari-$hari_depo_masa1);
                                }
                            }else{
                                $invoice_penumpukan->hari_masa1 = ($hari > 0) ? min(array($hari,2)) : 0;
                                $invoice_penumpukan->hari_masa2 = ($hari > 2) ? $hari-2 : 0;
                            }

                            $invoice_penumpukan->hari_masa3 = 0;
                            $invoice_penumpukan->hari_masa4 = 0;

                            $invoice_penumpukan->masa1 = ($invoice_penumpukan->hari_masa1 * $t45->masa1 * 2) * count($container45);
                            $invoice_penumpukan->masa2 = ($invoice_penumpukan->hari_masa2 * $t45->masa2 * 3) * count($container45);
                            $invoice_penumpukan->masa3 = ($invoice_penumpukan->hari_masa3 * $t45->masa3) * count($container45);
                            $invoice_penumpukan->masa4 = ($invoice_penumpukan->hari_masa4 * $t45->masa4) * count($container45);
                        }

                        $invoice_penumpukan->total = array_sum(array($invoice_penumpukan->masa1,$invoice_penumpukan->masa2,$invoice_penumpukan->masa3,$invoice_penumpukan->masa4));

                        $invoice_penumpukan->save();

                    endforeach;

                }

            }

            $update_nct = \App\Models\InvoiceNct::find($invoice_nct->id);

            $total_penumpukan = \App\Models\InvoiceNctPenumpukan::where('invoice_nct_id', $invoice_nct->id)->sum('total');
            $total_gerakan = \App\Models\InvoiceNctGerakan::where('invoice_nct_id', $invoice_nct->id)->sum('total');

            if($data['KD_TPS_ASAL'] == 'KOJA'):
                $update_nct->perawatan_it = (count($container20)+count($container40)+count($container45)) * 90000;
                if($data->jenis_container == 'BB'){
                    $total_penumpukan_tps = \App\Models\InvoiceNctPenumpukan::where('invoice_nct_id', $invoice_nct->id)->where('lokasi_sandar','TPS')->sum('total');
                    $total_gerakan_tps = \App\Models\InvoiceNctGerakan::where('invoice_nct_id', $invoice_nct->id)->where('lokasi_sandar','TPS')->sum('total');
                    $update_nct->surcharge = ($total_penumpukan_tps+$total_gerakan_tps)*(25/100);
                }
                $update_nct->administrasi = 30000;
            else:
                $update_nct->administrasi = (count($container20)+count($container40)+count($container45)) * 100000;
            endif;

            $update_nct->total_non_ppn = $total_penumpukan + $total_gerakan + $update_nct->administrasi + $update_nct->perawatan_it + $update_nct->surcharge;
            $update_nct->ppn = $update_nct->total_non_ppn * 10/100;
            if(($update_nct->total_non_ppn+$update_nct->ppn) >= 5000000){
                $materai = 10000;
            }else{
                $materai = 0;
            }
            $update_nct->materai = $materai;
            $update_nct->total = $update_nct->total_non_ppn+$update_nct->ppn+$update_nct->materai;

            if($update_nct->save()) {
                $penumpukan = \App\Models\InvoiceNctPenumpukan::where('invoice_nct_id', $update_nct->id)->get();
                $gerakan = \App\Models\InvoiceNctGerakan::where('invoice_nct_id', $update_nct->id)->get();

                return json_encode(
                    [
                        'status' => '200',
                        'msg' => 'Invoice has been created',
                        'invoice' => ['header' => $update_nct, 'detail' => ['penumpukan' => $penumpukan, 'gerakan' => $gerakan]],
                        'bank' => ['name' => 'BNI', 'va' => 'XXXXXXXXXXXXXXXXX', 'status' => 'Menunggu Pembayaran', 'expired' => 'yyyy-mm-dd']
                    ]
                );
            }
        }

        return json_encode(['status'=>'500', 'success' => false,'msg' => 'Data tidak ditemukan.']);
    }

    public function requestInvoicePlatform(Request $request)
    {

        $npwp = $request->npwp;
        $no_do = '';
        $no_bl = $request->no_bl;
        $paid_thrud_date = $request->paid_thrud_date;
        $conts = $request->containers;
//        $no_bl = 'ONEYBKKAR5903300';
//        $paid_thrud_date = '2021-03-20';
//        $conts = [
//            'TCLU2010393',
//            'DFSU4371960',
//        ];

        $container20 = DBContainer::where(array('NO_BL_AWB' => $no_bl, 'size' => 20))
            ->whereIn('NOCONTAINER', $conts)->get();
        $container40 = DBContainer::where(array('NO_BL_AWB' => $no_bl, 'size' => 40))
            ->whereIn('NOCONTAINER', $conts)->get();
        $container45 = DBContainer::where(array('NO_BL_AWB' => $no_bl, 'size' => 45))
            ->whereIn('NOCONTAINER', $conts)->get();

        $std = array(
            'DRY'
        );
        $low = array(
            'BB',
            'Class BB Standar 3',
            'Class BB Standar 8',
            'Class BB Standar 9',
            'Class BB Standar 4,1',
            'Class BB Standar 6',
            'Class BB Standar 2,2'
        );
        $high = array(
            "Class BB High Class 2,1",
            "Class BB High Class 5,1",
            "Class BB High Class 6,1",
            "Class BB High Class 5,2"
        );

        if(count($container20) > 0 || count($container40) > 0 || count($container45) > 0) {

            if(count($container20) > 0){
                $data = $container20['0'];
            }elseif(count($container40) > 0){
                $data = $container40['0'];
            }else{
                $data = $container45['0'];
            }
            $getNoInv = $this->getInvoiceNumber('fcl','Platform');
//            $getNoInv = 'TP0001';
            $no_inv = $getNoInv.'/LAP-PJP/'.date('Y').'/'.$data['KD_TPS_ASAL'].'/ELOGIS';
            $tgl_release = $paid_thrud_date;
            $consignee = DBPerusahaan::where('TPERUSAHAAN_PK', $data['TCONSIGNEE_FK'])->first();

            $jenis_cont = $data['jenis_container'];

            if(in_array($jenis_cont, $std)){
                $type_cont = 'Standar';
            }else if(in_array($jenis_cont, $low)){
                $type_cont = 'Low';
            }else if(in_array($jenis_cont, $high)){
                $type_cont = 'High';
            }

            $jenis_cont_std = ($jenis_cont == 'DRY') ? $jenis_cont : 'BB';

            // Create Invoice Header
            $invoice_nct = new \App\Models\InvoiceNct;
            $invoice_nct->no_container = implode(',', $conts);
            $invoice_nct->no_invoice = $no_inv;
            $invoice_nct->no_pajak = '-';
            $invoice_nct->consignee = $data['CONSIGNEE'];
            $invoice_nct->npwp = $data['ID_CONSIGNEE'];
            $invoice_nct->alamat = $consignee->ALAMAT;
            $invoice_nct->consignee_id = $data['TCONSIGNEE_FK'];
            $invoice_nct->vessel = $data['VESSEL'];
            $invoice_nct->voy = $data['VOY'];
            $invoice_nct->no_do = $no_do;
            $invoice_nct->no_bl = $no_bl;
            $invoice_nct->eta = $data['ETA'];
            $invoice_nct->gateout_terminal = $data['TGLMASUK'];
            $invoice_nct->gateout_tps = $tgl_release;
            $invoice_nct->type = $jenis_cont_std;
            $invoice_nct->tps_asal = $data['KD_TPS_ASAL'];
            $invoice_nct->payment_status = 'Waiting';
            $invoice_nct->uid = 'Platform';

            if($invoice_nct->save()) {

                // HARI TERMINAL
                $date1_terminal = date_create($data['ETA']);
                $date2_terminal = date_create(date('Y-m-d',strtotime($data['TGLMASUK'])));
                $diff_terminal = date_diff($date1_terminal, $date2_terminal);
                $hari_terminal = $diff_terminal->format("%a")+1;

                if($data['KD_TPS_ASAL'] == 'NCT1' || $data['KD_TPS_ASAL'] == 'KOJA'){
                    if($data['KD_TPS_ASAL'] == 'KOJA'){
//                        $nct_gerakan = array('Pas Truck' => 9100);
                    }else{
                        $nct_gerakan = array('Pas Truck' => 9100, 'Gate Pass Admin' => 20000, 'Cost Rec/Surcarge' => 75000);
                    }

                    foreach($nct_gerakan as $key=>$value):
                        $invoice_gerakan = new \App\Models\InvoiceNctGerakan;

                        $invoice_gerakan->invoice_nct_id = $invoice_nct->id;
                        $invoice_gerakan->lokasi_sandar = $data['KD_TPS_ASAL'];
                        $invoice_gerakan->size = 0;
                        $invoice_gerakan->qty = count($container20)+count($container40)+count($container45);
                        $invoice_gerakan->jenis_gerakan = $key;
                        $invoice_gerakan->tarif_dasar = $value;
                        $invoice_gerakan->total = (count($container20)+count($container40)+count($container45)) * $value;

                        $invoice_gerakan->save();
                    endforeach;
                }else{
                    $invoice_gerakan = new \App\Models\InvoiceNctGerakan;

                    $invoice_gerakan->invoice_nct_id = $invoice_nct->id;
                    $invoice_gerakan->lokasi_sandar = 'JICT';
                    $invoice_gerakan->size = 0;
                    $invoice_gerakan->qty = count($container20)+count($container40)+count($container45);
                    $invoice_gerakan->jenis_gerakan = 'Cost Rec/Surcarge';
                    $invoice_gerakan->tarif_dasar = 75000;
                    $invoice_gerakan->total = (count($container20)+count($container40)+count($container45)) * 75000;

                    $invoice_gerakan->save();
                }

                // Insert Invoice Detail
                if(count($container20) > 0) {

                    $tarif20 = \App\Models\InvoiceTarifNct::where(array('size' => 20, 'type' => $jenis_cont_std))->whereIn('lokasi_sandar', array($data['KD_TPS_ASAL'],'TPS'))->get();

                    foreach ($tarif20 as $t20) :

                        $invoice_penumpukan = new \App\Models\InvoiceNctPenumpukan;

                        $invoice_penumpukan->invoice_nct_id = $invoice_nct->id;
                        $invoice_penumpukan->lokasi_sandar = $t20->lokasi_sandar;
                        $invoice_penumpukan->size = 20;
                        $invoice_penumpukan->qty = count($container20);

                        if($t20->lokasi_sandar == 'KOJA' || $t20->lokasi_sandar == 'NCT1') {

                            // GERAKAN
                            $invoice_gerakan = new \App\Models\InvoiceNctGerakan;

                            $invoice_gerakan->invoice_nct_id = $invoice_nct->id;
                            $invoice_gerakan->lokasi_sandar = $t20->lokasi_sandar;
                            $invoice_gerakan->size = 20;
                            $invoice_gerakan->qty = count($container20);
                            $invoice_gerakan->jenis_gerakan = 'Lift On Terminal';
                            $invoice_gerakan->tarif_dasar = $t20->lift_on;
                            $invoice_gerakan->total = $invoice_gerakan->qty * $t20->lift_on;
                            $invoice_gerakan->save();

                            // PENUMPUKAN
                            $date1 = date_create($data['ETA']);
                            $date2 = date_create(date('Y-m-d',strtotime($data['TGLMASUK'])));
                            $diff = date_diff($date1, $date2);
                            $hari = $diff->format("%a");

                            $invoice_penumpukan->startdate = $data['ETA'];
                            $invoice_penumpukan->enddate = $data['TGLMASUK'];
                            $invoice_penumpukan->lama_timbun = $hari;
                            $invoice_penumpukan->tarif_dasar = $t20->masa2;

                            $invoice_penumpukan->hari_masa1 = ($hari > 0) ? 1 : 0;
                            $invoice_penumpukan->hari_masa2 = ($hari > 1) ? 1 : 0;
                            $invoice_penumpukan->hari_masa3 = ($hari > 2) ? $hari - 2 : 0;
                            $invoice_penumpukan->hari_masa4 = 0;

                            $invoice_penumpukan->masa1 = ($invoice_penumpukan->hari_masa1 * $t20->masa1) * count($container20);
                            $invoice_penumpukan->masa2 = ($invoice_penumpukan->hari_masa2 * $t20->masa2 * 3) * count($container20);
                            $invoice_penumpukan->masa3 = ($invoice_penumpukan->hari_masa3 * $t20->masa3 * 6) * count($container20);
                            $invoice_penumpukan->masa4 = ($invoice_penumpukan->hari_masa4 * $t20->masa4 * 9) * count($container20);

                        } else {

                            // GERAKAN
//                            if($data['BEHANDLE'] == 'Y') {
//                                $jenis = array('Lift On/Off' => $t20->lift_off,'Paket PLP' => $t20->paket_plp,'Behandle' => $t20->behandle);
//                            }else{
                            if($jenis_cont_std == 'BB') {
                                $jenis = array('Lift On/Off' => $t20->lift_off*2, 'Paket PLP' => $t20->paket_plp);
                            }else{
                                $jenis = array('Lift On/Off' => $t20->lift_off, 'Paket PLP' => $t20->paket_plp);
                            }
//                            }

                            foreach ($jenis as $key=>$value):
                                $invoice_gerakan = new \App\Models\InvoiceNctGerakan;

                                $invoice_gerakan->invoice_nct_id = $invoice_nct->id;
                                $invoice_gerakan->lokasi_sandar = $t20->lokasi_sandar;
                                $invoice_gerakan->size = 20;
                                $invoice_gerakan->qty = count($container20);
                                $invoice_gerakan->jenis_gerakan = $key;
                                $invoice_gerakan->tarif_dasar = $value;
                                $invoice_gerakan->total = $invoice_gerakan->qty * $value;

                                $invoice_gerakan->save();
                            endforeach;

                            // PENUMPUKAN
                            $date1 = date_create($data['TGLMASUK']);
                            $date2 = date_create($tgl_release);
                            $diff = date_diff($date1, $date2);
                            $hari = $diff->format("%a");

                            $invoice_penumpukan->startdate = $data['TGLMASUK'];
                            $invoice_penumpukan->enddate = $tgl_release;
                            $invoice_penumpukan->lama_timbun = $hari;
                            $invoice_penumpukan->tarif_dasar = $t20->masa2;

                            if($data['KD_TPS_ASAL'] == 'KOJA'){
                                if($hari_terminal >= 10){
                                    $invoice_penumpukan->hari_masa1 = 0;
                                    $invoice_penumpukan->hari_masa2 = $hari;
                                }else{
                                    $sisa_hari = 10-$hari_terminal;
                                    $hari_depo_masa1 = min(array($hari, $sisa_hari));
                                    $invoice_penumpukan->hari_masa1 = $hari_depo_masa1;
                                    $invoice_penumpukan->hari_masa2 = abs($hari-$hari_depo_masa1);
                                }
                            }else{
                                $invoice_penumpukan->hari_masa1 = ($hari > 0) ? min(array($hari,2)) : 0;
                                $invoice_penumpukan->hari_masa2 = ($hari > 2) ? $hari-2 : 0;
                            }
                            $invoice_penumpukan->hari_masa3 = 0;
                            $invoice_penumpukan->hari_masa4 = 0;

                            $invoice_penumpukan->masa1 = ($invoice_penumpukan->hari_masa1 * $t20->masa1 * 2) * count($container20);
                            $invoice_penumpukan->masa2 = ($invoice_penumpukan->hari_masa2 * $t20->masa2 * 3) * count($container20);
                            $invoice_penumpukan->masa3 = ($invoice_penumpukan->hari_masa3 * $t20->masa3) * count($container20);
                            $invoice_penumpukan->masa4 = ($invoice_penumpukan->hari_masa4 * $t20->masa4) * count($container20);
                        }

                        $invoice_penumpukan->total = array_sum(array($invoice_penumpukan->masa1,$invoice_penumpukan->masa2,$invoice_penumpukan->masa3,$invoice_penumpukan->masa4));

                        $invoice_penumpukan->save();

                    endforeach;

                }

                if(count($container40) > 0) {

                    $tarif40 = \App\Models\InvoiceTarifNct::where(array('size' => 40, 'type' => $jenis_cont_std))->whereIn('lokasi_sandar', array($data['KD_TPS_ASAL'],'TPS'))->get();
                    foreach ($tarif40 as $t40) :

                        $invoice_penumpukan = new \App\Models\InvoiceNctPenumpukan;

                        $invoice_penumpukan->invoice_nct_id = $invoice_nct->id;
                        $invoice_penumpukan->lokasi_sandar = $t40->lokasi_sandar;
                        $invoice_penumpukan->size = 40;
                        $invoice_penumpukan->qty = count($container40);

                        if($t40->lokasi_sandar == 'KOJA' || $t40->lokasi_sandar == 'NCT1') {
                            // GERAKAN
                            $invoice_gerakan = new \App\Models\InvoiceNctGerakan;

                            $invoice_gerakan->invoice_nct_id = $invoice_nct->id;
                            $invoice_gerakan->lokasi_sandar = $t40->lokasi_sandar;
                            $invoice_gerakan->size = 40;
                            $invoice_gerakan->qty = count($container40);
                            $invoice_gerakan->jenis_gerakan = 'Lift On Terminal';
                            $invoice_gerakan->tarif_dasar = $t40->lift_on;
                            $invoice_gerakan->total = $invoice_gerakan->qty * $t40->lift_on;
                            $invoice_gerakan->save();

                            // PENUMPUKAN
                            $date1 = date_create($data['ETA']);
                            $date2 = date_create(date('Y-m-d',strtotime($data['TGLMASUK'])));
                            $diff = date_diff($date1, $date2);
                            $hari = $diff->format("%a");

                            $invoice_penumpukan->startdate = $data['ETA'];
                            $invoice_penumpukan->enddate = $data['TGLMASUK'];
                            $invoice_penumpukan->lama_timbun = $hari;
                            $invoice_penumpukan->tarif_dasar = $t40->masa2;

                            $invoice_penumpukan->hari_masa1 = ($hari > 0) ? 1 : 0;
                            $invoice_penumpukan->hari_masa2 = ($hari > 1) ? 1 : 0;
                            $invoice_penumpukan->hari_masa3 = ($hari > 2) ? $hari - 2 : 0;
                            $invoice_penumpukan->hari_masa4 = 0;

                            $invoice_penumpukan->masa1 = ($invoice_penumpukan->hari_masa1 * $t40->masa1) * count($container40);
                            $invoice_penumpukan->masa2 = ($invoice_penumpukan->hari_masa2 * $t40->masa2 * 3) * count($container40);
                            $invoice_penumpukan->masa3 = ($invoice_penumpukan->hari_masa3 * $t40->masa3 * 6) * count($container40);
                            $invoice_penumpukan->masa4 = ($invoice_penumpukan->hari_masa4 * $t40->masa4 * 9) * count($container40);

                        } else {
                            // GERAKAN
//                            if($data['BEHANDLE'] == 'Y') {
//                                $jenis = array('Lift On/Off' => $t40->lift_off,'Paket PLP' => $t40->paket_plp,'Behandle' => $t40->behandle);
//                            }else{
                            if($jenis_cont_std == 'BB') {
                                $jenis = array('Lift On/Off' => $t40->lift_off*2, 'Paket PLP' => $t40->paket_plp);
                            }else{
                                $jenis = array('Lift On/Off' => $t40->lift_off, 'Paket PLP' => $t40->paket_plp);
                            }
//                            }

                            foreach ($jenis as $key=>$value):
                                $invoice_gerakan = new \App\Models\InvoiceNctGerakan;

                                $invoice_gerakan->invoice_nct_id = $invoice_nct->id;
                                $invoice_gerakan->lokasi_sandar = $t40->lokasi_sandar;
                                $invoice_gerakan->size = 40;
                                $invoice_gerakan->qty = count($container40);
                                $invoice_gerakan->jenis_gerakan = $key;
                                $invoice_gerakan->tarif_dasar = $value;
                                $invoice_gerakan->total = $invoice_gerakan->qty * $value;

                                $invoice_gerakan->save();
                            endforeach;

                            // PENUMPUKAN
                            $date1 = date_create($data['TGLMASUK']);
                            $date2 = date_create($tgl_release);
                            $diff = date_diff($date1, $date2);
                            $hari = $diff->format("%a");

                            $invoice_penumpukan->startdate = $data['TGLMASUK'];
                            $invoice_penumpukan->enddate = $tgl_release;
                            $invoice_penumpukan->lama_timbun = $hari;
                            $invoice_penumpukan->tarif_dasar = $t40->masa2;

                            if($data['KD_TPS_ASAL']  == 'KOJA'){
                                if($hari_terminal >= 10){
                                    $invoice_penumpukan->hari_masa1 = 0;
                                    $invoice_penumpukan->hari_masa2 = $hari;
                                }else{
                                    $sisa_hari = 10-$hari_terminal;
                                    $hari_depo_masa1 = min(array($hari, $sisa_hari));
                                    $invoice_penumpukan->hari_masa1 = $hari_depo_masa1;
                                    $invoice_penumpukan->hari_masa2 = abs($hari-$hari_depo_masa1);
                                }
                            }else{
                                $invoice_penumpukan->hari_masa1 = ($hari > 0) ? min(array($hari,2)) : 0;
                                $invoice_penumpukan->hari_masa2 = ($hari > 2) ? $hari-2 : 0;
                            }
                            $invoice_penumpukan->hari_masa3 = 0;
                            $invoice_penumpukan->hari_masa4 = 0;

                            $invoice_penumpukan->masa1 = ($invoice_penumpukan->hari_masa1 * $t40->masa1 * 2) * count($container40);
                            $invoice_penumpukan->masa2 = ($invoice_penumpukan->hari_masa2 * $t40->masa2 * 3) * count($container40);
                            $invoice_penumpukan->masa3 = ($invoice_penumpukan->hari_masa3 * $t40->masa3) * count($container40);
                            $invoice_penumpukan->masa4 = ($invoice_penumpukan->hari_masa4 * $t40->masa4) * count($container40);
                        }

                        $invoice_penumpukan->total = array_sum(array($invoice_penumpukan->masa1,$invoice_penumpukan->masa2,$invoice_penumpukan->masa3,$invoice_penumpukan->masa4));

                        $invoice_penumpukan->save();

                    endforeach;

                }

                if(count($container45) > 0) {

                    $tarif45 = \App\Models\InvoiceTarifNct::where(array('size' => 45, 'type' => $jenis_cont_std))->whereIn('lokasi_sandar', array($data['KD_TPS_ASAL'],'TPS'))->get();
                    foreach ($tarif45 as $t45) :

                        $invoice_penumpukan = new \App\Models\InvoiceNctPenumpukan;

                        $invoice_penumpukan->invoice_nct_id = $invoice_nct->id;
                        $invoice_penumpukan->lokasi_sandar = $t45->lokasi_sandar;
                        $invoice_penumpukan->size = 45;
                        $invoice_penumpukan->qty = count($container45);

                        if($t45->lokasi_sandar == 'KOJA' || $t45->lokasi_sandar == 'NCT1') {
                            // GERAKAN
                            $invoice_gerakan = new \App\Models\InvoiceNctGerakan;

                            $invoice_gerakan->invoice_nct_id = $invoice_nct->id;
                            $invoice_gerakan->lokasi_sandar = $t45->lokasi_sandar;
                            $invoice_gerakan->size = 45;
                            $invoice_gerakan->qty = count($container45);
                            $invoice_gerakan->jenis_gerakan = 'Lift On Terminal';
                            $invoice_gerakan->tarif_dasar = $t45->lift_on;
                            $invoice_gerakan->total = $invoice_gerakan->qty * $t45->lift_on;
                            $invoice_gerakan->save();

                            // PENUMPUKAN
                            $date1 = date_create($data['ETA']);
                            $date2 = date_create(date('Y-m-d',strtotime($data['TGLMASUK'])));
                            $diff = date_diff($date1, $date2);
                            $hari = $diff->format("%a");

                            $invoice_penumpukan->startdate = $data['ETA'];
                            $invoice_penumpukan->enddate = $data['TGLMASUK'];
                            $invoice_penumpukan->lama_timbun = $hari;
                            $invoice_penumpukan->tarif_dasar = $t45->masa2;

                            $invoice_penumpukan->hari_masa1 = ($hari > 0) ? 1 : 0;
                            $invoice_penumpukan->hari_masa2 = ($hari > 1) ? 1 : 0;
                            $invoice_penumpukan->hari_masa3 = ($hari > 2) ? $hari - 2 : 0;
                            $invoice_penumpukan->hari_masa4 = 0;

                            $invoice_penumpukan->masa1 = ($invoice_penumpukan->hari_masa1 * $t45->masa1) * count($container45);
                            $invoice_penumpukan->masa2 = ($invoice_penumpukan->hari_masa2 * $t45->masa2 * 3) * count($container45);
                            $invoice_penumpukan->masa3 = ($invoice_penumpukan->hari_masa3 * $t45->masa3 * 6) * count($container45);
                            $invoice_penumpukan->masa4 = ($invoice_penumpukan->hari_masa4 * $t45->masa4 * 9) * count($container45);

                        } else {
                            // GERAKAN
//                            if($data['BEHANDLE'] == 'Y') {
//                                $jenis = array('Lift On/Off' => $t45->lift_off,'Paket PLP' => $t45->paket_plp,'Behandle' => $t45->behandle);
//                            }else{
                            if($jenis_cont_std == 'BB') {
                                $jenis = array('Lift On/Off' => $t45->lift_off*2, 'Paket PLP' => $t45->paket_plp);
                            }else{
                                $jenis = array('Lift On/Off' => $t45->lift_off, 'Paket PLP' => $t45->paket_plp);
                            }

                            foreach ($jenis as $key=>$value):
                                $invoice_gerakan = new \App\Models\InvoiceNctGerakan;

                                $invoice_gerakan->invoice_nct_id = $invoice_nct->id;
                                $invoice_gerakan->lokasi_sandar = $t45->lokasi_sandar;
                                $invoice_gerakan->size = 45;
                                if($key == 'Lift On/Off'){
                                    $invoice_gerakan->qty = count($container45)*2;
                                }else{
                                    $invoice_gerakan->qty = count($container45);
                                }
                                $invoice_gerakan->jenis_gerakan = $key;
                                $invoice_gerakan->tarif_dasar = $value;
                                $invoice_gerakan->total = $invoice_gerakan->qty * $value;

                                $invoice_gerakan->save();
                            endforeach;

                            // PENUMPUKAN
                            $date1 = date_create($data['TGLMASUK']);
                            $date2 = date_create($tgl_release);
                            $diff = date_diff($date1, $date2);
                            $hari = $diff->format("%a");

                            $invoice_penumpukan->startdate = $data['TGLMASUK'];
                            $invoice_penumpukan->enddate = $tgl_release;
                            $invoice_penumpukan->lama_timbun = $hari;
                            $invoice_penumpukan->tarif_dasar = $t45->masa2;

                            if($data['KD_TPS_ASAL'] == 'KOJA'){
                                if($hari_terminal >= 10){
                                    $invoice_penumpukan->hari_masa1 = 0;
                                    $invoice_penumpukan->hari_masa2 = $hari;
                                }else{
                                    $sisa_hari = 10-$hari_terminal;
                                    $hari_depo_masa1 = min(array($hari, $sisa_hari));
                                    $invoice_penumpukan->hari_masa1 = $hari_depo_masa1;
                                    $invoice_penumpukan->hari_masa2 = abs($hari-$hari_depo_masa1);
                                }
                            }else{
                                $invoice_penumpukan->hari_masa1 = ($hari > 0) ? min(array($hari,2)) : 0;
                                $invoice_penumpukan->hari_masa2 = ($hari > 2) ? $hari-2 : 0;
                            }
                            $invoice_penumpukan->hari_masa3 = 0;
                            $invoice_penumpukan->hari_masa4 = 0;

                            $invoice_penumpukan->masa1 = ($invoice_penumpukan->hari_masa1 * $t45->masa1 * 2) * count($container45);
                            $invoice_penumpukan->masa2 = ($invoice_penumpukan->hari_masa2 * $t45->masa2 * 3) * count($container45);
                            $invoice_penumpukan->masa3 = ($invoice_penumpukan->hari_masa3 * $t45->masa3) * count($container45);
                            $invoice_penumpukan->masa4 = ($invoice_penumpukan->hari_masa4 * $t45->masa4) * count($container45);
                        }

                        $invoice_penumpukan->total = array_sum(array($invoice_penumpukan->masa1,$invoice_penumpukan->masa2,$invoice_penumpukan->masa3,$invoice_penumpukan->masa4));

                        $invoice_penumpukan->save();

                    endforeach;

                }

            }

            $update_nct = \App\Models\InvoiceNct::find($invoice_nct->id);

            if($data['KD_TPS_ASAL'] == 'KOJA'):
                if($jenis_cont_std == 'BB'){
                    $total_penumpukan_tps = \App\Models\InvoiceNctPenumpukan::where('invoice_nct_id', $invoice_nct->id)->where('lokasi_sandar','TPS')->sum('total');
                    $total_gerakan_tps = \App\Models\InvoiceNctGerakan::where('invoice_nct_id', $invoice_nct->id)->where('lokasi_sandar','TPS')->sum('total');
                    if($type_cont == 'High'){
                        $total_surcharge = ($total_penumpukan_tps+$total_gerakan_tps)*(30/100);
                    }else{
                        $total_surcharge = ($total_penumpukan_tps+$total_gerakan_tps)*(25/100);
                    }

                    $invoice_gerakan = new \App\Models\InvoiceNctGerakan;
                    $invoice_gerakan->invoice_nct_id = $invoice_nct->id;
                    $invoice_gerakan->lokasi_sandar = 'TPS';
                    $invoice_gerakan->size = 0;
                    $invoice_gerakan->qty = 1;
                    $invoice_gerakan->jenis_gerakan = 'Surcharge DG';
                    $invoice_gerakan->tarif_dasar = $total_surcharge;
                    $invoice_gerakan->total = $total_surcharge;
                    $invoice_gerakan->save();
                }
//                $update_nct->perawatan_it = (count($container20)+count($container40)+count($container45)) * 90000;
//                $update_nct->administrasi = 20000;

                $update_nct->administrasi = (count($container20)+count($container40)+count($container45)) * 100000;
            else:
                $update_nct->administrasi = (count($container20)+count($container40)+count($container45)) * 100000;
            endif;

            $total_penumpukan = \App\Models\InvoiceNctPenumpukan::where('invoice_nct_id', $invoice_nct->id)->sum('total');
            $total_gerakan = \App\Models\InvoiceNctGerakan::where('invoice_nct_id', $invoice_nct->id)->sum('total');

            $update_nct->total_non_ppn = $total_penumpukan + $total_gerakan + $update_nct->administrasi + $update_nct->perawatan_it + $update_nct->surcharge;
            $update_nct->ppn = $update_nct->total_non_ppn * 10/100;
            if(($update_nct->total_non_ppn+$update_nct->ppn) >= 5000000){
                $materai = 10000;
            }else{
                $materai = 0;
            }
            $update_nct->materai = $materai;
            $update_nct->total = $update_nct->total_non_ppn+$update_nct->ppn+$update_nct->materai;

            if($update_nct->save()) {
                $penumpukan = \App\Models\InvoiceNctPenumpukan::where('invoice_nct_id', $update_nct->id)->get();
                $gerakan = \App\Models\InvoiceNctGerakan::where('invoice_nct_id', $update_nct->id)->get();

                return json_encode(
                    [
                        'status' => '200',
                        'msg' => 'Invoice has been created',
                        'invoice' => ['header' => $update_nct, 'detail' => ['penumpukan' => $penumpukan, 'gerakan' => $gerakan]],
                        'bank' => ['name' => 'BNI', 'va' => 'XXXXXXXXXXXXXXXXX', 'status' => 'Menunggu Pembayaran', 'expired' => 'yyyy-mm-dd']
                    ]
                );
            }
        }

        return json_encode(['status'=>'500', 'success' => false,'msg' => 'Data tidak ditemukan.']);
    }

}
