<?php

namespace App\Http\Controllers\Data;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Negara as DBNegara;
use App\Models\Vessel as DBVessel;

class VesselController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ( !$this->access->can('show.vessel.index') ) {
            return view('errors.no-access');
        }
        
        // Create Roles Access
        $this->insertRoleAccess(array('name' => 'Index Vessel', 'slug' => 'show.vessel.index', 'description' => ''));
        
        $data['page_title'] = "Vessel";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'Vessel'
            ]
        ];        
        
        $negara = DBNegara::select('TNEGARA_PK','NAMANEGARA')->get();
        $results = [];
        foreach ($negara as $n):
            $results[$n->NAMANEGARA] = $n->NAMANEGARA;
        endforeach;
        
        $data['negara'] = $results;
        
        return view('data.vessel.index')->with($data);
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
        $data = $request->json()->all(); 
        unset($data['_token']);
        
        $data['uid'] = \Auth::getUser()->name;
        try
        {
  //        $this->Vessel->create($data);
            DBVessel::insertGetId($data);
        }
        catch (Exception $e)
        {
            return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
        }

        return json_encode(array('success' => true, 'message' => 'Vessel successfully saved!', 'data' => $data));
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
