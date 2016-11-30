<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TpsDataKirim extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tps_getdatakirimxml';
    protected $primaryKey = 'tps_getdatakirim_pk';
    public $timestamps = false;

}