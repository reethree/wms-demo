<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Roles as DBRoles;
use App\Models\Permission as DBPermission;

class RolesController extends Controller
{
    public function __construct()
    {
        parent::__construct();   
    }
    
    public function index()
    {
        if ( !$this->access->can('show.role.index') ) {
            return view('errors.no-access');
        }
        
        
        $data['page_title'] = "User Roles Data";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('user-index'),
                'title' => 'Users'
            ],
            [
                'action' => '',
                'title' => 'Roles'
            ]
        ];

        return view('roles.index')->with($data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        
        if ( !$this->access->can('show.role.create') ) {
            return view('errors.no-access');
        }
        
        $data = $request->except('_token');
        $data['slug'] = strtolower(str_replace(' ', '-', $request->name));
        $insert_id = DBRoles::insertGetId($data);

        if($insert_id){
            return back()->with('success', 'Data roles has been added.');
        }
        
        return back()->withInput();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        
        if ( !$this->access->can('show.role.edit') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "Edit User Roles";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('user-index'),
                'title' => 'Users'
            ],
            [
                'action' => route('role-index'),
                'title' => 'Roles'
            ],
            [
                'action' => '',
                'title' => 'Edit'
            ]
        ];
        
        $role = DBRoles::findOrFail($id);
        $permission_id = array();
        foreach ($role->permissions as $permission):
            $permission_id[] = $permission->pivot->permission_id;
        endforeach;

        $data['role'] = $role;
        $data['permission_id'] = $permission_id;
        $data['permissions'] = DBPermission::get();
        
        return view('roles.edit')->with($data);
    }

    public function update(Request $request, $id)
    {
        //
    }
    
    public function updatePermission(Request $request, $id)
    {
//        return $request->all();
        
        if ( !$this->access->can('show.role.edit') ) {
            return view('errors.no-access');
        }
        
        $role = DBRoles::findOrFail($id);
        if ($request->has('slug')) {
            $role->permissions()->sync( $request->slug );
        } else {
            $role->permissions()->detach();
        }
        
        return back()->with('success', 'Data permissions has been updated.');
    }
    
    public function destroy($id)
    {
        
        if ( !$this->access->can('show.role.delete') ) {
            return view('errors.no-access');
        }
        
        $role = DBRoles::find($id);
        if(!$role){
            return back()->with('error','Data not found.');
        }
        
        DBRoles::destroy($id);
        
        return back()->with('success','Role has been deleted.');
        
    }
}
