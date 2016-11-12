<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TpsDokManual extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tps_dokmanualxml';
    protected $primaryKey = 'TPS_DOKMANUALXML_PK';
    public $timestamps = false;

}