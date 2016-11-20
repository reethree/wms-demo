<?php

namespace App\Http\Controllers\Tps;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PenerimaanController extends Controller
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
   
    
    public function responPlpIndex()
    {
        if ( !$this->access->can('show.tps.responPlp.index') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "TPS Respon PLP";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'TPS Respon PLP'
            ]
        ];        
        
        return view('tpsonline.index-respon-plp')->with($data);
    }
    
    public function responBatalPlpIndex()
    {
        if ( !$this->access->can('show.tps.responBatalPlp.index') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "TPS Respon Batal PLP";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'TPS Respon Batal PLP'
            ]
        ];        
        
        return view('tpsonline.index-respon-batal-plp')->with($data);
    }
    
    public function obLclIndex()
    {
        if ( !$this->access->can('show.tps.obLcl.index') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "TPS OB LCL";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'TPS OB LCL'
            ]
        ];        
        
        return view('tpsonline.index-ob-lcl')->with($data);
    }
    
    public function obFclIndex()
    {
        if ( !$this->access->can('show.tps.obFcl.index') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "TPS OB FCL";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'TPS OB FCL'
            ]
        ];        
        
        return view('tpsonline.index-ob-fcl')->with($data);
    }
    
    public function spjmIndex()
    {
        if ( !$this->access->can('show.tps.spjm.index') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "TPS SPJM";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'TPS SPJM'
            ]
        ];        
        
        return view('tpsonline.index-spjm')->with($data);
    }
    
    public function dokManualIndex()
    {
        if ( !$this->access->can('show.tps.dokManual.index') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "TPS Dokumen Manual";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'TPS Dokumen Manual'
            ]
        ];        
        
        return view('tpsonline.index-dok-manual')->with($data);
    }
    
    public function sppbPibIndex()
    {
        if ( !$this->access->can('show.tps.sppbPib.index') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "TPS SPPB PIB";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'TPS SPPB PIB'
            ]
        ];        
        
        return view('tpsonline.index-sppb-pib')->with($data);
    }
    
    public function sppbBcIndex()
    {
        if ( !$this->access->can('show.tps.sppbBc.index') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "TPS SPPB BC23";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'TPS SPPB BC23'
            ]
        ];        
        
        return view('tpsonline.index-sppb-bc')->with($data);
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

    public function responPlpEdit($id)
    {
        if ( !$this->access->can('show.tps.responPlp.edit') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "Edit TPS Respon PLP";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('tps-responPlp-index'),
                'title' => 'Edit TPS Respon PLP'
            ],
            [
                'action' => '',
                'title' => 'Edit'
            ]
        ];
        
        $data['respon'] = \App\Models\TpsResponPlp::find($id);
        
        return view('tpsonline.edit-respon-plp')->with($data);
    }
    
    public function obEdit($id)
    {
        if ( !$this->access->can('show.tps.ob.edit') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "Edit OB";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'Edit OB'
            ],
            [
                'action' => '',
                'title' => 'Edit'
            ]
        ];
        
        $data['ob'] = \App\Models\TpsOb::find($id);
        
        return view('tpsonline.edit-ob')->with($data);
    }
    
    public function sppbPibEdit($id)
    {
        if ( !$this->access->can('show.tps.sppbPib.edit') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "Edit SPPB PIB";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('tps-sppbPib-index'),
                'title' => 'TPS SPPB PIB'
            ],
            [
                'action' => '',
                'title' => 'Edit'
            ]
        ];
        
        $data['sppb'] = \App\Models\TpsSppbPib::find($id);
        
        return view('tpsonline.edit-sppb-pib')->with($data);
    }
    
    public function sppbBcEdit($id)
    {
        if ( !$this->access->can('show.tps.sppbBc.edit') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "Edit SPPB BC23";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('tps-sppbBc-index'),
                'title' => 'TPS SPPB BC23'
            ],
            [
                'action' => '',
                'title' => 'Edit'
            ]
        ];
        
        $data['sppb'] = \App\Models\TpsSppbBc::find($id);
        
        return view('tpsonline.edit-sppb-bc')->with($data);
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
    
    public function responPlpUpdate(Request $request, $id)
    {
        
    }
    
    public function sppbPibUpdate(Request $request, $id)
    {
        
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
