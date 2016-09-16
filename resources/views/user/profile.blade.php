@extends('backend.layout')

@section('content')
<div class="box box-danger">
    <div class="box-header with-border">
        <h3 class="box-title">Your Profile Information</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">         
            <div class="form-horizontal" id='show-profile'>
                    <div class="form-group">
                      <label for="name" class="col-sm-2 control-label">Avatar</label>
                      <div class="col-sm-8">
                          @if(!empty($user->avatar))
                          <div>
                              <img src='{{asset('uploads/avatar/'.$user->avatar)}}' width='100'>
                          </div>
                          @endif
                      </div>
                    </div>
                    <div class="form-group">
                        <label for="room_name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-4">
                            <p class='form-control-static'>{{$user->name}}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="room_name" class="col-sm-2 control-label">Username</label>
                        <div class="col-sm-4">
                            <p class='form-control-static'>{{(!empty($user->username))?$user->username:'-'}}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="room_name" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-4">
                            <p class='form-control-static'>{{$user->email}}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="room_name" class="col-sm-2 control-label">Phone</label>
                        <div class="col-sm-4">
                            <p class='form-control-static'>{{$user->phone}}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="room_name" class="col-sm-2 control-label">Address</label>
                        <div class="col-sm-4">
                            <p class='form-control-static'>{{$user->address}}</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class='col-md-8 col-md-offset-2'>
                            <button type="button" id='edit_profile_btn' class='btn btn-default'>Edit Profile</button>
                        </div>
                    </div>
                
            </div>
            <form class="form-horizontal hide" enctype="multipart/form-data" id='form-profile' action="{{route('backend-user-profile-updated')}}" method="POST">
                <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    <div class="form-group">
                      <label for="name" class="col-sm-2 control-label">Avatar</label>
                      <div class="col-sm-8">
                          @if(!empty($user->avatar))
                          <div>
                              <img src='{{asset('uploads/avatar/'.$user->avatar)}}' width='100'>
                          </div>
                          @endif
                          <input type='file' name='avatar'>
                      </div>
                    </div>
                    <div class="form-group">
                        <label for="room_name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-4">
                            <input type="text" name="name" class="form-control" value='{{$user->name}}' required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="room_name" class="col-sm-2 control-label">Username</label>
                        <div class="col-sm-4">
                            <input type="text" name="username" class="form-control" value='{{$user->username}}'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="room_name" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-4">
                            <input type="email" name="email" class="form-control" value='{{$user->email}}' required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="room_name" class="col-sm-2 control-label">New Password</label>
                        <div class="col-sm-3">
                            <input type="password" name="password" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="room_name" class="col-sm-2 control-label">Confirmation Password</label>
                        <div class="col-sm-3">
                            <input type="password" name="confirmation_password" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="room_name" class="col-sm-2 control-label">Phone</label>
                        <div class="col-sm-4">
                            <input type="text" name="phone" value='{{$user->phone}}' class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="room_name" class="col-sm-2 control-label">Address</label>
                        <div class="col-sm-4">
                            <textarea name='address' class='form-control' rows="5">{{$user->address}}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class='col-md-8 col-md-offset-2'>
                            <button type="submit" id="add_room_btn" class="btn btn-danger">Save Information</button>
                        </div>
                    </div>
            </form>
    </div>
</div>

@endsection

@section('custom_css')

@endsection

@section('custom_js')

<script>

$(function(){
    
    $('#edit_profile_btn').on('click',function(){
        
        var $this = $(this);
        
        $('#form-profile').removeClass('hide');
        $('#show-profile').addClass('hide');
        
        
    });
    
});

</script>

@endsection
