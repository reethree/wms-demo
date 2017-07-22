<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceNctGerakan extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'invoice_nct_gerakan';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
}
