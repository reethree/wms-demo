@extends('layout')

@section('content')

@include('partials.form-alert')

<div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Permissions for {{ $role->name }}</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <form class="form-horizontal" action="{{ route('role-permission-update', $role->id) }}" method="POST">
    <!-- /.box-header -->
        <div class="box-body">            

            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Access Name</th>
                        <th>Access Description</th>
                        <th>Action</th>
                    </tr>
                    @foreach($permissions as $permission)
                    <tr>
                        <td>{{ $permission->id }}.</td>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->description }}</td>
                        <td><input type="checkbox" name="slug[]" value="{{ $permission->id }}" @if(count($permission_id) > 0 && in_array($permission->id, $permission_id)) {{ 'checked' }} @endif></td>
                    </tr> 
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer">
            <input name="_token" type="hidden" value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-danger pull-right">Update</button>
        </div>
    </form>
</div>

@endsection

@section('custom_css')

<!-- Bootstrap Switch -->
<link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/plugins/bootstrap-switch/bootstrap-switch.min.css") }}">

@endsection

@section('custom_js')

<!-- Bootstrap Switch -->
<script src="{{ asset("/bower_components/AdminLTE/plugins/bootstrap-switch/bootstrap-switch.min.js") }}"></script>
<script type="text/javascript">
    $.fn.bootstrapSwitch.defaults.size = 'mini';
    $.fn.bootstrapSwitch.defaults.onColor = 'danger';
    
    $("input[type='checkbox']").bootstrapSwitch();
</script>

@endsection