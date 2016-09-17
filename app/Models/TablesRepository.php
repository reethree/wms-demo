<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mgallegos\LaravelJqgrid\Repositories\EloquentRepositoryAbstract;
 
class TablesRepository extends EloquentRepositoryAbstract {
 
    public function __construct(Model $Model)
    {
        if($Model->getMorphClass() == 'App\User'){
            $Model = \DB::table('users')
                ->join('role_user', 'users.id', '=', 'role_user.user_id')
                ->join('roles', 'role_user.role_id', '=', 'roles.id');
            
            $Columns = array('users.*','roles.name as roles.name');
        }else{
            $Columns = array('*');
        }
        $this->Database = $Model;        
        $this->visibleColumns = $Columns; 
        $this->orderBy = array(array('id', 'asc'), array('name'));
    }
}