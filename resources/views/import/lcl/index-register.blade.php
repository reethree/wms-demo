@extends('layout')

@section('content')

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">LCL Register Lists</h3>
        <div class="box-tools">
            <a href="{{ route('lcl-register-create') }}" type="button" class="btn btn-block btn-info btn-sm"><i class="fa fa-plus"></i> Add New</a>
        </div>
    </div>
    <div class="box-body table-responsive">
        
    </div>
</div>

@endsection

