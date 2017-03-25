<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tperusahaan';
    protected $primaryKey = 'TPERUSAHAAN_PK';
    public $timestamps = false;

    public static function getNameById($id)
    {
        $data = Perusahaan::select('NAMAPERUSAHAAN')->where('TPERUSAHAAN_PK', $id)->first();   
        return $data->NAMAPERUSAHAAN;
    }
    
    public static function getNpwpById($id)
    {
        $data = Perusahaan::select('NPWP')->where('TPERUSAHAAN_PK', $id)->first();   
        return $data->NPWP;
    }
    
    public static function insertOrGet($name, $address)
    {
        $perusahaan = Perusahaan::where('NAMAPERUSAHAAN', $name)->first();
        if($perusahaan){
            return $perusahaan;
        }else{
            $data = array();
            $data['UID'] = \Auth::getUser()->name;
            $data['NAMAPERUSAHAAN'] = $name;
            $data['ALAMAT'] = $address;
            
            $perusahaan_id = Perusahaan::insertGetId($data);
            
            $perusahaan = Perusahaan::find($perusahaan_id);
            
            return $perusahaan;
        }
    }
    
}
