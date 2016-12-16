<?php

namespace App\Http\Controllers\Tps;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TpsOnlineController extends Controller
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
    
    public function gudangIndex()
    {
        if ( !$this->access->can('show.tps.gudang.index') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "Data Gudang";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'Data Gudang'
            ]
        ];        
        
        return view('tpsonline.index-gudang')->with($data);
    }
    
    public function pelabuhandnIndex()
    {
        if ( !$this->access->can('show.tps.pelabuhandn.index') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "Data Pelabuhan DN";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'Data Pelabuhan DN'
            ]
        ];        
        
        return view('tpsonline.index-peldn')->with($data);
    }
    
    public function pelabuhanlnIndex()
    {
        if ( !$this->access->can('show.tps.pelabuhanln.index') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "Data Pelabuhan LN";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'Data Pelabuhan LN'
            ]
        ];        
        
        return view('tpsonline.index-pelln')->with($data);
    }
    
    public function rejectIndex()
    {
        if ( !$this->access->can('show.tps.reject.index') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "COARI CODECO Reject";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'COARI CODECO Reject'
            ]
        ];        
        
        return view('tpsonline.index-reject')->with($data);
    }
    
    public function terkirimIndex()
    {
        if ( !$this->access->can('show.tps.terkirim.index') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "COARI CODECO Terkirim";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'COARI CODECO Terkirim'
            ]
        ];        
        
        return view('tpsonline.index-terkirim')->with($data);
    }
    
    public function gagalIndex()
    {
        if ( !$this->access->can('show.tps.gagal.index') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "COARI CODECO Gagal Terkirim";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'COARI CODECO Gagal Terkirim'
            ]
        ];        
        
        return view('tpsonline.index-gagal')->with($data);
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
