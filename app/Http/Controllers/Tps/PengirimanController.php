<?php

namespace App\Http\Controllers\Tps;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PengirimanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
   
    public function coariContIndex()
    {
        if ( !$this->access->can('show.tps.coariCont.index') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "TPS Coari Container";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'TPS Coari Container'
            ]
        ];        
        
        return view('tpsonline.index-coari-cont')->with($data);
    }
    
    public function coariKmsIndex()
    {
        if ( !$this->access->can('show.tps.coariKms.index') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "TPS Coari Kemasan";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'TPS Coari Kemasan'
            ]
        ];        
        
        return view('tpsonline.index-coari-kms')->with($data);
    }

    public function codecoContFclIndex()
    {
        if ( !$this->access->can('show.tps.codecoContFcl.index') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "TPS Codeco Cont FCL";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'TPS Codeco Cont FCL'
            ]
        ];        
        
        return view('tpsonline.index-codeco-cont-fcl')->with($data);
    }
    
    public function codecoContBuangMtyIndex()
    {
                if ( !$this->access->can('show.tps.codecoContBuangMty.index') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "TPS Codeco Cont Buang MTY";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'TPS Codeco Cont Buang MTY'
            ]
        ];        
        
        return view('tpsonline.index-codeco-cont-buangmty')->with($data);
    }
    
    public function codecoKmsIndex()
    {
        if ( !$this->access->can('show.tps.codecoKms.index') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "TPS Codeco Kemasan";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'TPS Codeco Kemasan'
            ]
        ];        
        
        return view('tpsonline.index-codeco-kms')->with($data);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }    

}
