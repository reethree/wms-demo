<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Packing extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tpacking';
    protected $primaryKey = 'TPACKING_PK';
    public $timestamps = false;

}
