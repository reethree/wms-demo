@extends('layout')

@section('content')

@include('partials.form-alert')

<div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Form User</h3>
    </div>
    <!-- /.box-header -->
    <form class="form-horizontal" action="{{ route('user-store') }}" enctype="multipart/form-data" method="POST">
        <div class="box-body">            
            <div class="row">
                <div class="col-md-6">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
<!--                    <div class="form-group">
                      <label for="name" class="col-sm-3 control-label">Avatar</label>
                      <div class="col-sm-8">
                          <input type='file' name='avatar'>
                      </div>
                    </div>-->
                    
                    <div class="form-group">
                      <label for="name" class="col-sm-3 control-label">Name</label>
                      <div class="col-sm-8">
                          <input type="text" name="name" class="form-control" id="name" placeholder="Name" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="username" class="col-sm-3 control-label">Username</label>
                      <div class="col-sm-8">
                          <input type="text" name="username" class="form-control" id="username" placeholder="Username" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="email" class="col-sm-3 control-label">Email</label>
                      <div class="col-sm-8">
                          <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="password" class="col-sm-3 control-label">Password</label>
                      <div class="col-sm-8">
                          <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="c_password" class="col-sm-3 control-label">Confirm Password</label>
                      <div class="col-sm-8">
                          <input type="password" name="password_confirmation" class="form-control" id="c_password" placeholder="Password Again" required>
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
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Status</label>
                        <div class="col-sm-8">
                            <select class="form-control select2 select2-hidden-accessible" name="status" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                <option value="active" selected="selected">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-danger pull-right">Create</button>
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
