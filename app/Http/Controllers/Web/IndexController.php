<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\DefaultController;

class IndexController extends DefaultController
{
    
    public function index()
    {
        return view('web.index');
    }
    
    public function pages($slug)
    {
        
        $page = \App\Models\WebPages::where("slug", $slug)->first();
        
        if($page) {
            $data['page'] = $page;
            
            return view('web.'.$page->view)->with($data);
        }
        
        return view('errors.404');
        
    }


    public function ourStory()
    {
        return view('web.our-story');
    }
    
    public function ourValue()
    {
        return view('web.our-value');
    }
    
    public function ourLegal()
    {
        return view('web.our-legal');
    }
    
    public function warehouseManagement()
    {
        return view('web.warehouse-management');
    }
    
    public function multimodal()
    {
        return view('web.multimodal');
    }
    
    public function tracking()
    {
        return view('web.tracking');
    }
    
    public function operasionalGudang()
    {
        return view('web.operasional-gudang');
    }
    
    public function operasionalLapangan()
    {
        return view('web.operasional-lapangan');
    }
    
    public function fasilitasGudang()
    {
        return view('web.fasilitas-gudang');
    }
    
    public function fasilitasLapangan()
    {
        return view('web.fasilitas-lapangan');
    }
    
    public function fasilitasAlat()
    {
        return view('web.fasilitas-alat');
    }
    
    public function contactUs()
    {
        return view('web.contact');
    }
    
}