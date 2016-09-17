<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consolidator extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tconsolidator';
    protected $primaryKey = 'TCONSOLIDATOR_PK';
    public $timestamps = false;

}
