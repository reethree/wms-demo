<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TpsResponPlpDetail extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tps_responplptujuandetailxml';
    protected $primaryKey = 'tps_responplptujuandetailxml_pk';
    public $timestamps = false;

    public function update($id, array $data)
    { 
      try
      {
//        $cData['JNS_CONT'] = $data['JNS_CONT'];
//        TpsResponPlpDetail::where($this->primaryKey, $id)->update($cData);
        $plp = new TpsResponPlpDetail;
        $plp->JNS_CONT = $data['JNS_CONT'];
        $plp->save();
        
      }
      catch (Exception $e)
      {
        return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
      }
 
      return json_encode(array('success' => true, 'message' => 'PLP successfully updated!'));
    }
}