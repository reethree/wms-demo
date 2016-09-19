<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User as DBUser;
use App\Models\Roles as DBRoles;

class UserController extends Controller
{
    public function __construct()
    {
        parent::__construct();   
    }
    
    public function index()
    {
        if ( !$this->access->can('show.user.index') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "Users";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'Users'
            ]
        ];        

        return view('user.index')->with($data);
    }
    
    public function create()
    {
        if ( !$this->access->can('show.user.create') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "Add New User";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('user-index'),
                'title' => 'User'
            ],
            [
                'action' => '',
                'title' => 'Add New'
            ]
        ];
        
        $data['roles'] = DBRoles::get();
        
        return view('user.create')->with($data);
    }
    
    public function store(Request $request)
    {       
        if ( !$this->access->can('show.user.store') ) {
            return view('errors.no-access');
        }
        
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'unique:users|email',
            'username' => 'required|unique:users',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required|min:6',
            'role_id' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        $data = $request->except(['_token','password_confirmation','role_id','avatar']);        
        $data['password'] = bcrypt($request->password);
        
//        if($request->hasFile('avatar')){
//            
//            $dir = 'uploads' . DIRECTORY_SEPARATOR . 'avatar' . DIRECTORY_SEPARATOR;
//            $image = $request->file('avatar');
//            
//            $filename = $image->getClientOriginalName();
//            $ext = $image->guessClientExtension();
//            $base_name = basename(time() . '_' . rand(0, 10000000) . '.' . $ext);
//
//            $image->move($dir, $base_name);
//            
//            $img = Image::make($dir.$base_name);
//            $img->crop(200, 200, 0, 0);
//            
//            $img->save($dir.'thumb_'.$base_name);
//            \File::delete($dir.$base_name);
//            
//            $data['avatar'] = $base_name;
//            
//        }
        
        $insert_id = DBUser::insertGetId($data);
        
        if($insert_id){
            $user = DBUser::find($insert_id);
            $user->roles()->attach($request->role_id);
            
            return redirect()->route('user-index')->with('success', 'Data user has been added.');
        }
        
        return back()->withInput();
    }
    
    public function show($id)
    {
        if ( !$this->access->can('show.user.view') ) {
            return view('errors.no-access');
        }
        $data['page_title'] = "User Detail";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('user-index'),
                'title' => 'User'
            ],
            [
                'action' => '',
                'title' => 'Detail'
            ]
        ];
        
        $user = \App\Models\User::find($id);
        if(!$user){
            return back()->with('error','Data user not found.');
        }
        
        $data['user']=$user;
        
        return view('user.view')->with($data);
        
    }

    public function edit($id)
    {
        if ( !$this->access->can('show.user.edit') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "Edit User";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('user-index'),
                'title' => 'User'
            ],
            [
                'action' => '',
                'title' => 'Edit'
            ]
        ];
        
        $user = DBUser::find($id);
        $data['user'] = $user;
        foreach ($user->roles as $role) {
            $data['user']['role_id'] = $role->pivot->role_id;
        }
        $data['roles'] = DBRoles::get();
        
        return view('user.edit')->with($data);
    }

    public function update(Request $request, $id)
    {
        
        if ( !$this->access->can('show.user.edit') ) {
            return view('errors.no-access');
        }
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required',
            'email' => 'email',
            'password' => 'confirmed|min:6',
            'password_confirmation' => 'min:6',
            'role_id' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        $data = $request->except(['_token','password_confirmation','role_id','avatar']); 
        
        
        if(!$request->password){
            $data = $request->except(['_token','password','password_confirmation','role_id']);
        }else{
            $data = $request->except(['_token','password_confirmation','role_id']);
            $data['password'] = bcrypt($request->password);
        }
        
//        if($request->hasFile('avatar')){
//            
//            $dir = 'uploads' . DIRECTORY_SEPARATOR . 'avatar' . DIRECTORY_SEPARATOR;
//            $image = $request->file('avatar');
//            
//            $filename = $image->getClientOriginalName();
//            $ext = $image->guessClientExtension();
//            $base_name = basename(time() . '_' . rand(0, 10000000) . '.' . $ext);
//
//            $image->move($dir, $base_name);
//            
//            $data['avatar'] = $base_name;
//            
//        }
        
        $update = DBUser::where('id', $id)
            ->update($data);
        
        if($update){
            $user = DBUser::findOrFail($id);
            if ($request->has('role_id')) {
                $user->roles()->sync( [$request->role_id] );
            } else {
                $user->roles()->detach();
            }
            return redirect()->route('user-index')->with('success', 'Data user has been updated.');
        }
        
        return back()->withInput();
    }

    public function destroy($id)
    {
        if ( !$this->access->can('show.user.delete') ) {
            return view('errors.no-access');
        }
        
        $user = DBUser::find($id);
        
        if(!$user){
            return back()->with('error','Data user not found.');
        }
        
        DBUser::destroy($id);
        
        return back()->with('success','User has been deleted.');
        
    }
    
    public function profile(){
        
        $data['page_title'] = "Profile";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'Setting'
            ],
            [
                'action' => '',
                'title' => 'Profile'
            ]
        ];
        
        $user_id = $this->user->id;
        $user = DBUser::find($user_id);
        
        $data['user'] = $user;
        
        return view('user.profile')->with($data);
        
    }
    public function profileUpdated(Request $request){
        
        if(!$request->has('password')){
            $data = $request->except('_token','confirmation_password','password');
        }else{
            $data = $request->except('_token','confirmation_password');
            if($request->password !== $request->confirmation_password){
                return back()->withInput('error','Password not match!');
            }else{
                $data['password'] = bcrypt($request->password);
            }
        }
        
        if($request->hasFile('avatar')){
            
            $dir = 'uploads' . DIRECTORY_SEPARATOR . 'avatar' . DIRECTORY_SEPARATOR;
            $image = $request->file('avatar');
            
            $filename = $image->getClientOriginalName();
            $ext = $image->guessClientExtension();
            $base_name = basename(time() . '_' . rand(0, 10000000) . '.' . $ext);

            $image->move($dir, $base_name);
            
            $data['avatar'] = $base_name;
            
        }
        
        $user_id = $this->user->id;
        $user = DBUser::where('id',$user_id)->update($data);
                
        return back()->with('success','Profile has been updated.');
        
    }
    
}
