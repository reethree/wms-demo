<?php
namespace App\Models;

use Illuminate\Support\Facades\Request;
use Illuminate\Database\Eloquent\Model;
use Mgallegos\LaravelJqgrid\Repositories\EloquentRepositoryAbstract;
 
class TablesRepository extends EloquentRepositoryAbstract {
 
    public function __construct(Model $Model, $request = null)
    {
        if($Model->getMorphClass() == 'App\User'){
            $Model = \DB::table('users')
                ->join('role_user', 'users.id', '=', 'role_user.user_id')
                ->join('roles', 'role_user.role_id', '=', 'roles.id');
            
            $Columns = array('users.*','roles.name as roles.name');
        }elseif($Model->getMorphClass() == 'App\Models\Container'){
            if(isset($request['jobid'])){
                $Model = \DB::table('tcontainer')
                        ->where('TJOBORDER_FK', $request['jobid']);
                $Columns = array('*');
            }elseif(isset($request['startdate']) || isset($request['enddate'])){
                $Model = \DB::table('tcontainer')
                        ->where('TGLENTRY', '>=',date('Y-m-d 00:00:00',strtotime($request['startdate'])))
                        ->where('TGLENTRY', '<=',date('Y-m-d 23:59:59',strtotime($request['enddate'])));
                $Columns = array('*');
            }elseif(isset($request['module'])){
                switch ($request['module']) {
                    case 'gatein':
                        $Model = \DB::table('tcontainer')
                            ->whereNotNull('NO_BC11')
                            ->whereNotNull('TGL_BC11')
                            ->whereNotNull('NO_PLP')
                            ->whereNotNull('TGL_PLP');
                        $Columns = array('*');
                        break;
                    case 'stripping':
                        $Model = \DB::table('tcontainer')
                            ->whereNotNull('TGLMASUK')
                            ->whereNotNull('JAMMASUK');
                        $Columns = array('*');
                        break;
                    case 'buangmty':
                        $Model = \DB::table('tcontainer')
                            ->whereNotNull('TGLSTRIPPING')
                            ->whereNotNull('JAMSTRIPPING');
                        $Columns = array('*');
                        break;
                    
                    default:
                        $Columns = array('*');
                }
            }else{
                $Columns = array('*');
            }
        }elseif($Model->getMorphClass() == 'App\Models\Manifest'){
            $Model = \DB::table('tmanifest')
                        ->where('TCONTAINER_FK', $request['containerid']);
                $Columns = array('*');
        }else{
            $Columns = array('*');
        }
        $this->Database = $Model;        
        $this->visibleColumns = $Columns; 
        $this->orderBy = array(array('id', 'asc'), array('name'));
    }
}