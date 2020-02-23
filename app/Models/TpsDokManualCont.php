<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TpsDokManualCont extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tps_dokmanualcontxml';
    protected $primaryKey = 'TPS_DOKMANUALCONTXML_PK';
    public $timestamps = false;

}