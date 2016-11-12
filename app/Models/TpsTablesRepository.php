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
                
                $Model = \DB::table('tps_responplptujuanxml')
                        ->where($request['by'], '>=',date('Y-m-d 00:00:00',strtotime($request['startdate'])))
                        ->where($request['by'], '<=',date('Y-m-d 23:59:59',strtotime($request['enddate'])));
            }else{
                
            }
        }elseif($Model->getMorphClass() == 'App\Models\TpsOb'){   
            if(isset($request['startdate']) && isset($request['enddate'])){
                
                $Model = \DB::table('tpsobxml')
                        ->where($request['by'], '>=',date('Y-m-d 00:00:00',strtotime($request['startdate'])))
                        ->where($request['by'], '<=',date('Y-m-d 23:59:59',strtotime($request['enddate'])))
                        ->where('JNS_CONT', $request['jenis']);
                
            }else{
                
                $Model = \DB::table('tpsobxml')
                        ->where('JNS_CONT', $request['jenis']);
                
            }
        }elseif($Model->getMorphClass() == 'App\Models\TpsSpjm'){   
            if(isset($request['startdate']) && isset($request['enddate'])){
                
                $Model = \DB::table('tps_spjmxml')
                        ->where($request['by'], '>=',date('Y-m-d 00:00:00',strtotime($request['startdate'])))
                        ->where($request['by'], '<=',date('Y-m-d 23:59:59',strtotime($request['enddate'])));
            }else{
                
            }   
            
        }elseif($Model->getMorphClass() == 'App\Models\TpsDokManual'){   
            if(isset($request['startdate']) && isset($request['enddate'])){
                
                $Model = \DB::table('tps_dokmanualxml')
                        ->where($request['by'], '>=',date('Y-m-d 00:00:00',strtotime($request['startdate'])))
                        ->where($request['by'], '<=',date('Y-m-d 23:59:59',strtotime($request['enddate'])));
            }else{
                
            }
        }else{
            
        }
        
        $this->Database = $Model;        
        $this->visibleColumns = $Columns; 
        $this->orderBy = array(array('id', 'asc'), array('name'));
    }
}