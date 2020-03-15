<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TpsDokPabean extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tps_dokpabeanxml';
    protected $primaryKey = 'TPS_DOKPABEANXML_PK';
    public $timestamps = false;

}