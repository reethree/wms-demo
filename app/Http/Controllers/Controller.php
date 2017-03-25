<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Contracts\Auth\Authenticatable;

use Illuminate\Http\Request;

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
    
    public function getDataPelabuhan(Request $request) {
        
        $query = $request->q;
        
        $data['items'] = \App\Models\Pelabuhan::select('TPELABUHAN_PK as id','NAMAPELABUHAN as text','KODEPELABUHAN as code')
                ->where('NAMAPELABUHAN','LIKE','%'.$query.'%')
                ->orWhere('KODEPELABUHAN','LIKE','%'.$query.'%')
                ->get();
        
        return json_encode($data);
    }
    
    public function getDataCodePelabuhan(Request $request) {
        
        $query = $request->q;
        
        $data['items'] = \App\Models\Pelabuhan::select('KODEPELABUHAN as id','KODEPELABUHAN as text')
                ->orWhere('KODEPELABUHAN','LIKE','%'.$query.'%')
                ->get();
        
        return json_encode($data);
    }
    
    public function insertRoleAccess($data = array())
    {
        if(count($data) > 0){
            // $data = array('name','slug','desc')
            $valid = \App\Models\Permission::where('slug', $data['slug'])->count();
            if($valid > 0){
                return false;
            }

            \App\Models\Permission::insert($data);
            return true;
        }
        
        return false;
    }
    
    public function getReffNumber()
    {
        $reff = \DB::table('tpsurutxml')->select('REF_NUMBER as id')
                ->where('TGL_ENTRY', date('Y-m-d'))
                ->orderBy('TPSURUTXML_PK', 'DESC')
                ->first();
        
        if(count($reff) > 0){
            $reff_id = substr($reff->id, -4);
        }else{
            $reff_id = 0;
        }
        
        $new_ref = 'PRJP'.date('ymd').str_pad(intval($reff_id+1), 4, '0', STR_PAD_LEFT);
        
        $insert = \DB::table('tpsurutxml')->insert(
            ['REF_NUMBER' => $new_ref, 'TGL_ENTRY' => date('Y-m-d'), 'UID' => \Auth::getUser()->name, 'TAHUN' => date('Y')]
        );
        
        if($insert){
            return $new_ref;
        }
        
        return false;
    }
    
    public function getSpkNumber()
    {
        $spk = \DB::table('tjoborderurut')->select('spk_number')
                ->where('year', date('Y'))
                ->orderBy('id', 'DESC')
                ->pluck('spk_number');
        
        $new_spk = intval((isset($spk) ? $spk : 0));
        
        $insert = \DB::table('tjoborderurut')->insert(
            ['spk_number' => $new_spk, 'uid' => \Auth::getUser()->name, 'year' => date('Y')]
        );
        
        if($insert){
            return $new_spk;
        }
        
        return false;
    }
    
    public function terbilang($x) 
    {
        $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        if ($x < 12)
          return " " . $abil[$x];
        elseif ($x < 20)
          return $this->terbilang($x - 10) . " belas";
        elseif ($x < 100)
          return $this->terbilang($x / 10) . " puluh" . $this->terbilang($x % 10);
        elseif ($x < 200)
          return " seratus" . $this->terbilang($x - 100);
        elseif ($x < 1000)
          return $this->terbilang($x / 100) . " ratus" . $this->terbilang($x % 100);
        elseif ($x < 2000)
          return " seribu" . $this->terbilang($x - 1000);
        elseif ($x < 1000000)
          return $this->terbilang($x / 1000) . " ribu" . $this->terbilang($x % 1000);
        elseif ($x < 1000000000)
          return $this->terbilang($x / 1000000) . " juta" . $this->terbilang($x % 1000000);  
    }
    
    public function removeSpace($string)
    {
        return preg_replace('!\s+!', ' ', $string);
    }
    
}
