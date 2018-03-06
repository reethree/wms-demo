@extends('layout')

@section('content')

@include('partials.form-alert')

<div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Billing Form</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <!-- /.box-header -->
    <form class="form-horizontal" action="{{route('payment-bni-update-billing')}}" method="POST">
        <div class="box-body">            
            <div class="row">
                <div class="col-md-6">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">VA Number</label>
                        <div class="col-sm-8">
                            <input type="text" value="{{$payment->virtual_account}}" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Transaction ID</label>
                        <div class="col-sm-8">
                            <input type="text" name="trx_id" value="{{$payment->trx_id}}" placeholder="Trx ID or Invoice ID" class="form-control pull-right" required readonly />
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Amount</label>
                        <div class="col-sm-8">
                            <input type="number" name="trx_amount" value="{{$payment->trx_amount}}" id="trx_amount" class="form-control pull-right" required />
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Customer Name</label>
                        <div class="col-sm-8">
                            <input type="text" name="customer_name" value="{{$payment->customer_name}}" class="form-control pull-right" required />
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Customer Email</label>
                        <div class="col-sm-8">
                            <input type="email" name="customer_email" value="{{$payment->customer_email}}" class="form-control pull-right" />
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Customer Phone</label>
                        <div class="col-sm-8">
                            <input type="tel" name="customer_phone" value="{{$payment->customer_phone}}" class="form-control pull-right" />
                        </div>
                    </div> 
 
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Description</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="description" rows="3">{{$payment->desctiption}}</textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Update Expired</label>
                        <div class="col-sm-8">
                            <select class="form-control select2" name="expired" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                <option value="" selected>Not Set</option>
                                <option value="1">+1 Day</option>
                                <option value="2">+2 Day</option>
                                <option value="3">+3 Day</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6"> 
                    <div class="form-group">                       
                        <label class="col-sm-3 control-label">VA Status</label>
                        <div class="col-sm-3">
                            <input type="text" value="{{$payment->va_status}}" class="form-control"  readonly>
                        </div>
                        <label class="col-sm-5 control-label">1=Active, 2=Inactive</label>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Created Date</label>
                        <div class="col-sm-8">
                            <input type="text" value="{{$payment->datetime_created}}" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Expired Date</label>
                        <div class="col-sm-8">
                            <input type="text" value="{{$payment->datetime_expired}}" class="form-control" readonly>
                        </div>
                    </div>
                      
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Payment Date</label>
                        <div class="col-sm-8">
                            <input type="text" value="{{$payment->datetime_payment}}" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Payment NTB</label>
                        <div class="col-sm-8">
                            <input type="text" value="{{$payment->payment_ntb}}" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Payment Amount</label>
                        <div class="col-sm-8">
                            <input type="text" value="{{$payment->payment_amount}}" class="form-control" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Update</button>
            <a href="{{ route('payment-bni-index') }}" class="btn btn-danger pull-right" style="margin-right: 10px;"><i class="fa fa-close"></i> Close</a>
        </div>
        <!-- /.box-footer -->
    </form>
</div>

@endsection