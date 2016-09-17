<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelabuhan extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tpelabuhan';
    protected $primaryKey = 'TPELABUHAN_PK';
    public $timestamps = false;

}
