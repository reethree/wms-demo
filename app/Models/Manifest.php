<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manifest extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tmanifest';
    protected $primaryKey = 'TMANIFEST_PK';
    public $timestamps = false;

}