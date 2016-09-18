<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shippingline extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tshippingline';
    protected $primaryKey = 'tshippingline_pk';
    public $timestamps = false;

}
