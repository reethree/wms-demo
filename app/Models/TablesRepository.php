<?php
namespace App\Models;

use Illuminate\Support\Facades\Request;
use Illuminate\Database\Eloquent\Model;
use Mgallegos\LaravelJqgrid\Repositories\EloquentRepositoryAbstract;
 
class TablesRepository extends EloquentRepositoryAbstract {
 
    public function __construct(Model $Model, $request = null)
    {
        $Columns = array('*');
        
        if($Model->getMorphClass() == 'App\User'){
            
            $Model = \DB::table('users')
                ->join('role_user', 'users.id', '=', 'role_user.user_id')
                ->join('roles', 'role_user.role_id', '=', 'roles.id');
            
            $Columns = array('users.*','roles.name as roles.name');
            
        }elseif($Model->getMorphClass() == 'App\Models\Container'){
            if(isset($request['jobid'])){
                
                $Model = \DB::table('tcontainer')
                        ->where('TJOBORDER_FK', $request['jobid']);
                
            }elseif(isset($request['startdate']) || isset($request['enddate'])){
                
                $Model = \DB::table('tcontainer')
                        ->where('TGLENTRY', '>=',date('Y-m-d 00:00:00',strtotime($request['startdate'])))
                        ->where('TGLENTRY', '<=',date('Y-m-d 23:59:59',strtotime($request['enddate'])));
                
            }elseif(isset($request['module'])){
                
                switch ($request['module']) {
                    case 'gatein':
                        $Model = \DB::table('tcontainer')
                            ->whereNotNull('NO_BC11')
                            ->whereNotNull('TGL_BC11')
                            ->whereNotNull('NO_PLP')
                            ->whereNotNull('TGL_PLP');
                    break;
                    case 'stripping':
                        $Model = \DB::table('tcontainer')
                            ->whereNotNull('TGLMASUK')
                            ->whereNotNull('JAMMASUK');
                    break;
                    case 'buangmty':
                        $Model = \DB::table('tcontainer')
                            ->whereNotNull('TGLSTRIPPING')
                            ->whereNotNull('JAMSTRIPPING');
                    break;
                }
            }
            
        }elseif($Model->getMorphClass() == 'App\Models\Manifest'){
            
            if(isset($request['containerid'])){
                
                $Model = \DB::table('tmanifest')
                        ->where('TCONTAINER_FK', $request['containerid']);

            }elseif($request['module']){
                
                switch ($request['module']) {
                    case 'behandle':
                        
                    break;
                    case 'fiatmuat':
                        $Model = \DB::table('tmanifest')
                            ->select('tmanifest.*','tperusahaan.NPWP as NPWP_CONSIGNEE')
                            ->join('tperusahaan', 'tperusahaan.TPERUSAHAAN_PK', '=', 'tmanifest.TCONSIGNEE_FK')
                            ->whereNotNull('tmanifest.NO_SPJM')
                            ->whereNotNull('tmanifest.TGL_SPJM');
                    break;
                    case 'suratjalan':
                        $Model = \DB::table('tmanifest')
                            ->whereNotNull('NO_SPPB')
                            ->whereNotNull('TGL_SPPB');
                    break;
                    case 'release':
                        $Model = \DB::table('tmanifest')
                            ->whereNotNull('TGLSURATJALAN')
                            ->whereNotNull('JAMSURATJALAN');
                    break;
                }
                
            }else{
                
            }
            
        }
        
        $this->Database = $Model;        
        $this->visibleColumns = $Columns; 
        $this->orderBy = array(array('id', 'asc'), array('name'));
    }
}