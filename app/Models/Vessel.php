<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vessel extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tvessel';
    protected $primaryKey = 'tvessel_pk';
    public $timestamps = false;

}
