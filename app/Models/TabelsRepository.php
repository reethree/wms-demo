<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mgallegos\LaravelJqgrid\Repositories\EloquentRepositoryAbstract;
 
class TabelsRepository extends EloquentRepositoryAbstract {
 
    public function __construct(Model $Model)
    {
        $this->Database = $Model;
        
        $this->visibleColumns = array('id','name','username','email');
 
        $this->orderBy = array(array('id', 'asc'), array('name','desc'));
    }
}