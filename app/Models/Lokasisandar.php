<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lokasisandar extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tlokasisandar';
    protected $primaryKey = 'TLOKASISANDAR_PK';
    public $timestamps = false;

}
