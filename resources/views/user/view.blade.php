@extends('backend.layout')

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">User Detail</h3>
          
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <dl>
                        
                        <dt>User Information :</dt>
                        <dd>
                            <dl class="dl-horizontal">
                                <dt>&nbsp;</dt>
                                <dd>
                                    @if(!empty($user->avatar))
                                    <div>
                                        <img width='100' src='{{asset('uploads/avatar/'.$user->avatar)}}'>
                                    </div>
                                    @endif
                                </dd>
                                <dt>Name</dt>
                                <dd>{{ $user->name }}</dd>
                                <dt>Email</dt>
                                <dd>{{ $user->email }}</dd>
                                <dt>Phone</dt>
                                <dd>{{ $user->phone }}</dd>
                                <dt>Address</dt>
                                <dd>{{ $user->address }}</dd>
                            </dl>
                        </dd>
                        
                    </dl>
                </div>
                
            </div> 
        </div>
        <!-- /.box-body -->
        
      </div>
      <!-- /.box -->
     
    </div>
    <!-- ./col -->
</div>

@endsection

@section('custom_css')
@endsection

@section('custom_js')
@endsection