<?php

namespace App\Models;

use Illuminate\Support\Facades\Request;
use Illuminate\Database\Eloquent\Model;
use Mgallegos\LaravelJqgrid\Repositories\EloquentRepositoryAbstract;
 
class TpsTablesRepository extends EloquentRepositoryAbstract {
 
    public function __construct(Model $Model, $request = null)
    {
        $Columns = array('*');
        
        if($Model->getMorphClass() == 'App\Models\TpsResponPlpDetail'){
        
            if(isset($request['responid'])){
                $Model = \DB::table('tps_responplptujuandetailxml')
                        ->where('tps_responplptujuanxml_fk', $request['responid']);
            }else{
                
            }
        }elseif($Model->getMorphClass() == 'App\Models\TpsResponPlp'){   
            if(isset($request['startdate']) && isset($request['enddate'])){
                if($request['by'] == 'TGL_UPLOAD') {
                    $start_date = date('Y-m-d 00:00:00',strtotime($request['startdate']));
                    $end_date = date('Y-m-d 23:59:59',strtotime($request['enddate']));
                }else{
                    $start_date = date('Ymd',strtotime($request['startdate']));
                    $end_date = date('Ymd',strtotime($request['enddate']));      
                }
                $Model = \DB::table('tps_responplptujuanxml')
                        ->where($request['by'], '>=', $start_date)
                        ->where($request['by'], '<=', $end_date);
            }else{
                
            }
        }elseif($Model->getMorphClass() == 'App\Models\TpsOb'){   
            if(isset($request['startdate']) && isset($request['enddate'])){
                if($request['by'] == 'TGLUPLOAD') {
                    $start_date = date('Y-m-d 00:00:00',strtotime($request['startdate']));
                    $end_date = date('Y-m-d 23:59:59',strtotime($request['enddate']));
                }else{
                    $start_date = date('Ymd',strtotime($request['startdate']));
                    $end_date = date('Ymd',strtotime($request['enddate']));      
                }
                
                if(isset($request['group'])){
                    $Model = TpsOb::
//                        select('tpsobxml.*', 'easygo_inputdo.TGL_DISPATCHE', 'easygo_inputdo.JAM_DISPATCHE')
//                        ->leftjoin('easygo_inputdo','tpsobxml.TPSOBXML_PK','=','easygo_inputdo.OB_ID')
                        where($request['by'], '>=', $start_date)
                        ->where($request['by'], '<=', $end_date)
                        ->where('tpsobxml.', $request['jenis'])
//                        ->groupBy('NO_CONT')
                        ;
                }else{
                    $Model = TpsOb::
//                        select('tpsobxml.*', 'easygo_inputdo.TGL_DISPATCHE', 'easygo_inputdo.JAM_DISPATCHE') 
//                        ->leftjoin('easygo_inputdo','tpsobxml.TPSOBXML_PK','=','easygo_inputdo.OB_ID')
                        where($request['by'], '>=', $start_date)
                        ->where($request['by'], '<=', $end_date)
                        ->where('tpsobxml.JNS_CONT', $request['jenis']);
                }

            }else{
                if(isset($request['group'])){
                    $Model = TpsOb::
//                        select('tpsobxml.*', 'easygo_inputdo.TGL_DISPATCHE', 'easygo_inputdo.JAM_DISPATCHE')                        
//                        ->leftjoin('easygo_inputdo','tpsobxml.TPSOBXML_PK','=','easygo_inputdo.OB_ID')
                        where('tpsobxml.JNS_CONT', $request['jenis'])
//                        ->groupBy('NO_CONT')
                        ;
                }else{
                    $Model = TpsOb::
//                        select('tpsobxml.*', 'easygo_inputdo.TGL_DISPATCHE', 'easygo_inputdo.JAM_DISPATCHE') 
//                        ->leftjoin('easygo_inputdo','tpsobxml.TPSOBXML_PK','=','easygo_inputdo.OB_ID')
                        where('tpsobxml.JNS_CONT', $request['jenis'])
                            ;
                }
 
            }
        }elseif($Model->getMorphClass() == 'App\Models\TpsSpjm'){   
            if(isset($request['startdate']) && isset($request['enddate'])){
                if($request['by'] == 'TGL_UPLOAD') {
                    $start_date = date('Y-m-d',strtotime($request['startdate']));
                    $end_date = date('Y-m-d',strtotime($request['enddate']));
                }else{
                    $start_date = date('d/m/Y',strtotime($request['startdate']));
                    $end_date = date('d/m/Y',strtotime($request['enddate']));      
                }
                $Model = \DB::table('tps_spjmxml')
                        ->where($request['by'], '>=', $start_date)
                        ->where($request['by'], '<=', $end_date);
            }else{
                
            }   
            
        }elseif($Model->getMorphClass() == 'App\Models\TpsDokManual'){   
            if(isset($request['startdate']) && isset($request['enddate'])){
                if($request['by'] == 'TGL_UPLOAD') {
                    $start_date = date('Y-m-d 00:00:00', strtotime($request['startdate']));
                    $end_date = date('Y-m-d 23:59:59', strtotime($request['enddate']));
                }else{
                    $start_date = date('Ymd',strtotime($request['startdate']));
                    $end_date = date('Ymd',strtotime($request['enddate']));      
                }
                $Model = \DB::table('tps_dokmanualxml')
                        ->where($request['by'], '>=', $start_date)
                        ->where($request['by'], '<=', $end_date);
            }else{
                
            }
            
        }elseif($Model->getMorphClass() == 'App\Models\TpsSppbPib'){   
            if(isset($request['startdate']) && isset($request['enddate'])){
                if($request['by'] == 'TGL_UPLOAD') {
                    $start_date = date('Y-m-d 00:00:00', strtotime($request['startdate']));
                    $end_date = date('Y-m-d 23:59:59', strtotime($request['enddate']));
                }else{
                    $start_date = date('Ymd',strtotime($request['startdate']));
                    $end_date = date('Ymd',strtotime($request['enddate']));      
                }
                $Model = \DB::table('tps_sppbxml')
                        ->where($request['by'], '>=', $start_date)
                        ->where($request['by'], '<=', $end_date);
            }else{
                
                if(isset($request['type']) && isset($request['sppbid'])){
                    
                    $type = $request['type'];
                    
                    if($type == 'cont') {
                        $Model = \DB::table('tps_sppbcontxml')
                            ->where('TPS_SPPBXML_FK', $request['sppbid']);
                    }else{
                        $Model = \DB::table('tps_sppbkmsxml')
                            ->where('TPS_SPPBXML_FK', $request['sppbid']);
                    }
                    
                }else{

                }
                
            }
            
        }elseif($Model->getMorphClass() == 'App\Models\TpsSppbBc'){   
            if(isset($request['startdate']) && isset($request['enddate'])){
                if($request['by'] == 'TGL_UPLOAD') {
                    $start_date = date('Y-m-d 00:00:00', strtotime($request['startdate']));
                    $end_date = date('Y-m-d 23:59:59', strtotime($request['enddate']));
                }else{
                    $start_date = date('Ymd',strtotime($request['startdate']));
                    $end_date = date('Ymd',strtotime($request['enddate']));      
                }
                $Model = \DB::table('tps_sppbbc23xml')
                        ->where($request['by'], '>=', $start_date)
                        ->where($request['by'], '<=', $end_date);
            }else{
                
                if(isset($request['type']) && isset($request['sppbid'])){
                    
                    $type = $request['type'];
                    
                    if($type == 'cont') {
                        $Model = \DB::table('tps_sppbbc23contxml')
                            ->where('TPS_SPPBXML_FK', $request['sppbid']);
                    }else{
                        $Model = \DB::table('tps_sppbbc23kmsxml')
                            ->where('TPS_SPPBXML_FK', $request['sppbid']);
                    }
                    
                }else{

                }
                
            }
        }elseif($Model->getMorphClass() == 'App\Models\TpsCoariCont'){ 
            
            if(isset($request['startdate']) && isset($request['enddate'])){
                if($request['by'] == 'TGL_UPLOAD') {
                    $start_date = date('Y-m-d 00:00:00', strtotime($request['startdate']));
                    $end_date = date('Y-m-d 23:59:59', strtotime($request['enddate']));
                }else{
                    $start_date = date('Ymd',strtotime($request['startdate']));
                    $end_date = date('Ymd',strtotime($request['enddate']));      
                }
                $Model = TpsCoariCont::select('*')
                        ->join('tpscoaricontdetailxml', 'tpscoaricontxml.TPSCOARICONTXML_PK', '=', 'tpscoaricontdetailxml.TPSCOARICONTXML_FK')
                        ->where('tpscoaricontxml.'.$request['by'], '>=', $start_date)
                        ->where('tpscoaricontxml.'.$request['by'], '<=', $end_date);
//                        ->groupBy('tpscoaricontdetailxml.TPSCOARICONTXML_FK');
            }else{
                $Model = TpsCoariCont::select('*')
                        ->join('tpscoaricontdetailxml', 'tpscoaricontxml.TPSCOARICONTXML_PK', '=', 'tpscoaricontdetailxml.TPSCOARICONTXML_FK');
//                        ->groupBy('tpscoaricontdetailxml.TPSCOARICONTXML_FK');
            }
        }elseif($Model->getMorphClass() == 'App\Models\TpsCoariKms'){ 
            
            if(isset($request['startdate']) && isset($request['enddate'])){
                if($request['by'] == 'TGL_UPLOAD') {
                    $start_date = date('Y-m-d 00:00:00', strtotime($request['startdate']));
                    $end_date = date('Y-m-d 23:59:59', strtotime($request['enddate']));
                }else{
                    $start_date = date('Ymd',strtotime($request['startdate']));
                    $end_date = date('Ymd',strtotime($request['enddate']));      
                }
                $Model = TpsCoariKms::select('*')
                        ->leftjoin('tpscoarikmsdetailxml', 'tpscoarikmsxml.TPSCOARIKMSXML_PK', '=', 'tpscoarikmsdetailxml.TPSCOARIKMSXML_FK')
                        ->where('tpscoarikmsxml.'.$request['by'], '>=', $start_date)
                        ->where('tpscoarikmsxml.'.$request['by'], '<=', $end_date)
                        ->whereYear('tpscoarikmsxml.TGL_ENTRY', '=', date('Y'))
//                        ->groupBy('tpscoarikmsdetailxml.TPSCOARIKMSXML_FK')
                        ;
            }elseif(isset($request['coarikms_id'])){
                $Model = TpsCoariKmsDetail::where('TPSCOARIKMSXML_FK',$request['coarikms_id']);
            }else{
                $Model = TpsCoariKms::select('tpscoarikmsxml.*','tpscoarikmsdetailxml.RESPONSE','tpscoarikmsdetailxml.STATUS_TPS')
                        ->leftJoin('tpscoarikmsdetailxml', 'tpscoarikmsxml.TPSCOARIKMSXML_PK', '=', 'tpscoarikmsdetailxml.TPSCOARIKMSXML_FK')
                        ->whereYear('tpscoarikmsxml.TGL_ENTRY', '=', date('Y'))
//                        ->groupBy('tpscoarikmsdetailxml.TPSCOARIKMSXML_FK')
                        ;
            }
        }elseif($Model->getMorphClass() == 'App\Models\TpsCodecoContFcl'){ 
            
            if(isset($request['startdate']) && isset($request['enddate'])){
                if($request['by'] == 'TGL_UPLOAD') {
                    $start_date = date('Y-m-d 00:00:00', strtotime($request['startdate']));
                    $end_date = date('Y-m-d 23:59:59', strtotime($request['enddate']));
                }else{
                    $start_date = date('Ymd',strtotime($request['startdate']));
                    $end_date = date('Ymd',strtotime($request['enddate']));      
                }
                $Model = TpsCodecoContFcl::select('*')
                        ->join('tpscodecocontdetailxml', 'tpscodecocontxml.TPSCODECOCONTXML_PK', '=', 'tpscodecocontdetailxml.TPSCODECOCONTXML_FK')
                        ->where('tpscodecocontdetailxml.JNS_CONT', 'F')
                        ->where('tpscodecocontxml.'.$request['by'], '>=', $start_date)
                        ->where('tpscodecocontxml.'.$request['by'], '<=', $end_date);
            }else{
                $Model = TpsCodecoContFcl::select('*')
                        ->join('tpscodecocontdetailxml', 'tpscodecocontxml.TPSCODECOCONTXML_PK', '=', 'tpscodecocontdetailxml.TPSCODECOCONTXML_FK')
                        ->where('tpscodecocontdetailxml.JNS_CONT', 'F');
            }
        }elseif($Model->getMorphClass() == 'App\Models\TpsCodecoContBuangMty'){ 
            
            if(isset($request['startdate']) && isset($request['enddate'])){
                if($request['by'] == 'TGL_UPLOAD') {
                    $start_date = date('Y-m-d 00:00:00', strtotime($request['startdate']));
                    $end_date = date('Y-m-d 23:59:59', strtotime($request['enddate']));
                }else{
                    $start_date = date('Ymd',strtotime($request['startdate']));
                    $end_date = date('Ymd',strtotime($request['enddate']));      
                }
                $Model = TpsCodecoContFcl::select('*')
                        ->join('tpscodecocontdetailxml', 'tpscodecocontxml.TPSCODECOCONTXML_PK', '=', 'tpscodecocontdetailxml.TPSCODECOCONTXML_FK')
                        ->where('tpscodecocontdetailxml.JNS_CONT', 'L')
                        ->where('tpscodecocontxml.'.$request['by'], '>=', $start_date)
                        ->where('tpscodecocontxml.'.$request['by'], '<=', $end_date);
            }else{
                $Model = TpsCodecoContFcl::select('*')
                        ->join('tpscodecocontdetailxml', 'tpscodecocontxml.TPSCODECOCONTXML_PK', '=', 'tpscodecocontdetailxml.TPSCODECOCONTXML_FK')
                        ->where('tpscodecocontdetailxml.JNS_CONT', 'L');
            }
        }elseif($Model->getMorphClass() == 'App\Models\TpsCodecoKms'){ 
            
            if(isset($request['startdate']) && isset($request['enddate'])){
                if($request['by'] == 'TGL_UPLOAD') {
                    $start_date = date('Y-m-d 00:00:00', strtotime($request['startdate']));
                    $end_date = date('Y-m-d 23:59:59', strtotime($request['enddate']));
                }else{
                    $start_date = date('Ymd',strtotime($request['startdate']));
                    $end_date = date('Ymd',strtotime($request['enddate']));      
                }
                $Model = TpsCodecoKms::select('*')
                        ->leftjoin('tpscodecokmsdetailxml', 'tpscodecokmsxml.TPSCODECOKMSXML_PK', '=', 'tpscodecokmsdetailxml.TPSCODECOKMSXML_FK')
                        ->where('tpscodecokmsxml.'.$request['by'], '>=', $start_date)
                        ->where('tpscodecokmsxml.'.$request['by'], '<=', $end_date)
                        ->whereYear('tpscodecokmsxml.TGL_ENTRY', '=', date('Y'))
                        ;
            }elseif(isset($request['codecokms_id'])){
                $Model = TpsCodecoKmsDetail::where('TPSCODECOKMSXML_FK', $request['codecokms_id']);
            }else{
                $Model = TpsCodecoKms::select('*')
                        ->leftjoin('tpscodecokmsdetailxml', 'tpscodecokmsxml.TPSCODECOKMSXML_PK', '=', 'tpscodecokmsdetailxml.TPSCODECOKMSXML_FK')
                        ->whereYear('tpscodecokmsxml.TGL_ENTRY', '=', date('Y'))
                        ;
            }
            
        }elseif($Model->getMorphClass() == 'App\Models\TpsDataKirim'){ 
            
            if(isset($request['type'])){
                switch ($request['type']) {
                    case 'reject':
                        if(isset($request['startdate']) && isset($request['enddate'])){
                            if($request['by'] == 'TGL_UPLOAD') {
                                $start_date = date('Y-m-d 00:00:00', strtotime($request['startdate']));
                                $end_date = date('Y-m-d 23:59:59', strtotime($request['enddate']));
                            }else{
                                $start_date = date('Ymd',strtotime($request['startdate']));
                                $end_date = date('Ymd',strtotime($request['enddate']));      
                            }
                            $Model = TpsDataReject::select('*')
                                    ->where($request['by'], '>=', $start_date)
                                    ->where($request['by'], '<=', $end_date);
                        }else{
                            $Model = new TpsDataReject();
                        }

                        break;
                    case 'terkirim':
                        if(isset($request['startdate']) && isset($request['enddate'])){
                            if($request['by'] == 'TGL_UPLOAD') {
                                $start_date = date('Y-m-d 00:00:00', strtotime($request['startdate']));
                                $end_date = date('Y-m-d 23:59:59', strtotime($request['enddate']));
                            }else{
                                $start_date = date('Ymd',strtotime($request['startdate']));
                                $end_date = date('Ymd',strtotime($request['enddate']));      
                            }
                            $Model = TpsDataKirim::select('*')
                                    ->where($request['by'], '>=', $start_date)
                                    ->where($request['by'], '<=', $end_date);
                        }else{
                            $Model = new TpsDataKirim();
                        }

                        break;
                    case 'gagal':
                        if(isset($request['startdate']) && isset($request['enddate'])){
                            if($request['by'] == 'TGL_UPLOAD') {
                                $start_date = date('Y-m-d 00:00:00', strtotime($request['startdate']));
                                $end_date = date('Y-m-d 23:59:59', strtotime($request['enddate']));
                            }else{
                                $start_date = date('Ymd',strtotime($request['startdate']));
                                $end_date = date('Ymd',strtotime($request['enddate']));      
                            }
                            $Model = TpsDataGagal::select('*')
                                    ->where($request['by'], '>=', $start_date)
                                    ->where($request['by'], '<=', $end_date);
                        }else{
                            $Model = new TpsDataGagal();
                        }

                        break;
                    default:
                        break;
                }
            }
            
        }else{
                        
        }
        
        $this->Database = $Model;        
        $this->visibleColumns = $Columns; 
        $this->orderBy = array(array('id', 'asc'), array('name'));
    }
}