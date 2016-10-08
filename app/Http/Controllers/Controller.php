<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Contracts\Auth\Authenticatable;

use Caffeinated\Shinobi\Models\Role as DBRole;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;
    
    protected $access;
    protected $user;

    public function __construct() {
        
        date_default_timezone_set("Asia/Jakarta");
        
        $user = \App\User::findOrfail(\Auth::getUser()->id);
        
        foreach ($user->roles as $role) {
            $role_id = $role->id;
        }
        $this->access = DBRole::find($role_id);
        $this->user = $user;
        
    }
}
