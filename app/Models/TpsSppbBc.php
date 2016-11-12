<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TpsSppbBc extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tps_sppbbc23xml';
    protected $primaryKey = 'TPS_SPPBXML_PK';
    public $timestamps = false;

}