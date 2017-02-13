<?php
namespace App\Models;

use Illuminate\Support\Facades\Request;
use Illuminate\Database\Eloquent\Model;
use Mgallegos\LaravelJqgrid\Repositories\EloquentRepositoryAbstract;
 
class InvoiceTablesRepository extends EloquentRepositoryAbstract {
 
    public function __construct($ModelRef, $request = null)
    {
        $Columns = array('*');

        if(isset($request['tarif_id'])){
            $Model = \DB::table($ModelRef)->where('tarif_id', $request['tarif_id']);
        }else{
            $Model = \DB::table($ModelRef);
        }
        
        if($ModelRef == 'invoice_import'){
            $Model = \DB::table($ModelRef)
                    ->join('tmanifest', 'invoice_import.manifest_id', '=', 'tmanifest.TMANIFEST_PK');
        }
        
        $this->Database = $Model;        
        $this->visibleColumns = $Columns; 
        $this->orderBy = array(array('id', 'asc'), array('name'));
    }
}