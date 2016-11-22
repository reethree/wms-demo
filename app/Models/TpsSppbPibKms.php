<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TpsSppbPibKms extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tps_sppbkmsxml';
    protected $primaryKey = 'TPS_SPPBKMSXML_PK';
    public $timestamps = false;

}