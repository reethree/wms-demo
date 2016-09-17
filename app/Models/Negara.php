<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Negara extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tnegara';
    protected $primaryKey = 'TNEGARA_PK';
    public $timestamps = false;

}
