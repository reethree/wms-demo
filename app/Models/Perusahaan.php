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
    
}
