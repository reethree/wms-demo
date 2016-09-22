<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Container extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tcontainer';
    protected $primaryKey = 'TCONTAINER_PK';
    public $timestamps = false;

}
