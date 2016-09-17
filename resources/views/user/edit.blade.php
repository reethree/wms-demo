@extends('layout')

@section('content')

@include('partials.form-alert')

<div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Form User</h3>
    </div>
    <!-- /.box-header -->
    <form class="form-horizontal" action="{{ route('user-update', $user->id) }}" enctype="multipart/form-data" method="POST">
        <div class="box-body">            
            <div class="row">
                <div class="col-md-6">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    <div class="form-group">
                      <label for="name" class="col-sm-3 control-label">Name</label>
                      <div class="col-sm-8">
                          <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{ $user->name }}" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="name" class="col-sm-3 control-label">Username</label>
                      <div class="col-sm-8">
                          <input type="text" name="username" class="form-control" id="username" placeholder="Username" value="{{ $user->username }}" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="email" class="col-sm-3 control-label">Email</label>
                      <div class="col-sm-8">
                          <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="{{ $user->email }}" required readonly>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="password" class="col-sm-3 control-label">Password</label>
                      <div class="col-sm-8">
                          <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="c_password" class="col-sm-3 control-label">Confirm Password</label>
                      <div class="col-sm-8">
                          <input type="password" name="password_confirmation" class="form-control" id="c_password" placeholder="Password Again">
                      </div>
                    </div>                                      
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="roles" class="col-sm-3 control-label">Roles</label>
                      <div class="col-sm-8">
                            <select class="form-control select2 select2-hidden-accessible" name="role_id" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                <option value="">Choose Roles</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" @if($user->role_id == $role->id){{ 'selected' }}@endif>{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Status</label>
                        <div class="col-sm-8">
                            <select class="form-control select2 select2-hidden-accessible" name="status" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                <option value="active" @if($user->status == 'active'){{ 'selected' }}@endif>Active</option>
                                <option value="inactive" @if($user->status == 'inactive'){{ 'selected' }}@endif>Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-danger pull-right">Update</button>
        </div>
        <!-- /.box-footer -->
    </form>
</div>

@endsection

@section('custom_css')

<!-- Select2 -->
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" />

@endsection

@section('custom_js')

<!-- Select2 -->
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
<script type="text/javascript">
  $('select').select2();
  
</script>

@endsection
