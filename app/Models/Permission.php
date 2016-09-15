<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'permissions';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'description'];
    
    /**
     * The roles that have the permissions.
     */
    public function roles()
    {
        return $this->belongsToMany('App\Models\Roles');
    }
}
