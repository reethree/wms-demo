<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Permission as DBPermission;

class PermissionController extends Controller
{
    public function __construct()
    {
        parent::__construct();   
    }
    
    public function index()
    {
        if ( !$this->access->can('show.permission.index') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "User Permissions Data";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('user-index'),
                'title' => 'Users'
            ],
            [
                'action' => '',
                'title' => 'Permissions'
            ]
        ];
        
        $permissions = DBPermission::orderBy('id', 'asc')->get();
        
        $data['permissions'] = $permissions;

        return view('permission.index')->with($data);
    }

    public function create()
    {
        if ( !$this->access->can('show.permission.create') ) {
            return view('errors.no-access');
        }
        $data['page_title'] = "User Permissions Data";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('user-index'),
                'title' => 'Users'
            ],
            [
                'action' => route('permission-index'),
                'title' => 'Permissions'
            ],
            [
                'action' => '',
                'title' => 'Create'
            ]
        ];
        
        return view('permission.create')->with($data);
    }

    public function store(Request $request)
    {
        if ( !$this->access->can('show.permission.create') ) {
            return view('errors.no-access');
        }
        $data = $request->except('_token');
        
        $permission_id = DBPermission::insertGetId($data);
        if($permission_id){
            return back()->with('success','Permission has been saved.');
        }else{
            return back()->with('error','Error.');
        }
        
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        if ( !$this->access->can('show.permission.edit') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "User Permissions Data";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('user-index'),
                'title' => 'Users'
            ],
            [
                'action' => route('permission-index'),
                'title' => 'Permissions'
            ],
            [
                'action' => '',
                'title' => 'Edit'
            ]
        ];
        
        $permission = DBPermission::find($id);
        if(!$permission){
            return back()->with('success','Permission not found.');
        }
        $data['permission'] = $permission;
        
        return view('permission.edit')->with($data);
        
    }

    public function update(Request $request, $id)
    {
        
        if ( !$this->access->can('show.permission.edit') ) {
            return view('errors.no-access');
        }
        $permission = DBPermission::find($id);
        if(!$permission){
            return back()->with('success','Permission not found.');
        }
        
        $data = $request->except('_token');
        
        $permission = DBPermission::where('id',$permission->id)->update($data);
        if($permission){
            return back()->with('success','Permission has been edited.');
        }else{
            return back()->with('error','Error.');
        }
        
    }

    public function destroy($id)
    {
        
        if ( !$this->access->can('show.permission.delete') ) {
            return view('errors.no-access');
        }
        
        $permission = DBPermission::find($id);
        if($permission){
            DBPermission::destroy($permission->id);
            
            return back()->with('success','Permission has been deleted.');
        }else{
            return back()->with('success','Permission not found.');
        }
    }
}
