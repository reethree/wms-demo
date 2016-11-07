<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TpsGudang extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tpsgudang';
    protected $primaryKey = 'TPSGUDANG_PK';
    public $timestamps = false;

}