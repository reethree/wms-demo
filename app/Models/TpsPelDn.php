<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TpsPelDn extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tpspeldnxml';
    protected $primaryKey = 'TPSPELDNXML_PK';
    public $timestamps = false;

}