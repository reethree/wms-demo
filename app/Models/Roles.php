<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'description', 'special'];

    /**
     * The users that belong to the role.
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
    
    /**
     * The users that belong to the role.
     */
    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission','permission_role','role_id');
    }
}
