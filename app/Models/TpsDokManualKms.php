<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TpsDokManualKms extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tps_dokmanualkmsxml';
    protected $primaryKey = 'TPS_DOKMANUALKMSXML_PK';
    public $timestamps = false;

}