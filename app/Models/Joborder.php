<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Joborder extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tjoborder';
    protected $primaryKey = 'TJOBORDER_PK';
    public $timestamps = false;

}
