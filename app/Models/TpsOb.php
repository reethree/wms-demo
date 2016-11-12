<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TpsOb extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tpsobxml';
    protected $primaryKey = 'TPSOBXML_PK';
    public $timestamps = false;

}