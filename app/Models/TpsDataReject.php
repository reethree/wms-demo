<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TpsDataReject extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tps_getdatarejectxml';
    protected $primaryKey = 'tps_getdatareject_pk';
    public $timestamps = false;

}