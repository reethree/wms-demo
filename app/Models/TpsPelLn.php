<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TpsPelLn extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tpspellnxml';
    protected $primaryKey = 'TPSPELLNXML_PK';
    public $timestamps = false;

}