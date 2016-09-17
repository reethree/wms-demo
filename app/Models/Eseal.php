<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Eseal extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'teseal';
    protected $primaryKey = 'eseal_id';
    public $timestamps = false;

}
