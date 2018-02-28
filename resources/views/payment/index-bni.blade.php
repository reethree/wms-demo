@extends('layout')

@section('content')
<style>
    .datepicker.dropdown-menu {
        z-index: 9999 !important;
    }
    th.ui-th-column div{
        white-space:normal !important;
        height:auto !important;
        padding:2px;
    }
</style>
<script>
    
    var grid = $("#paymentBniGrid"), headerRow, rowHight, resizeSpanHeight;

    // get the header row which contains
    headerRow = grid.closest("div.ui-jqgrid-view")
        .find("table.ui-jqgrid-htable>thead>tr.ui-jqgrid-labels");

    // increase the height of the resizing span
    resizeSpanHeight = 'height: ' + headerRow.height() +
        'px !important; cursor: col-resize;';
    headerRow.find("span.ui-jqgrid-resize").each(function () {
        this.style.cssText = resizeSpanHeight;
    });

    // set position of the dive with the column header text to the middle
    rowHight = headerRow.height();
    headerRow.find("div.ui-jqgrid-sortable").each(function () {
        var ts = $(this);
        ts.css('top', (rowHight - ts.outerHeight()) / 2 + 'px');
    });
    
    function gridCompleteEvent()
    {
        var ids = jQuery("#paymentBniGrid").jqGrid('getDataIDs'),
            edt = '';
        for(var i=0;i < ids.length;i++){ 
            var cl = ids[i];
            
            edt = '<a href="{{ route("payment-bni-edit",'') }}/'+cl+'"><i class="fa fa-pencil"></i></a> ';
            jQuery("#paymentBniGrid").jqGrid('setRowData',ids[i],{action:edt}); 
        } 
    }
    
</script>
<div class="box">
    <div class="box-header with-border" style="padding: 13px;">
        <h3 class="box-title">BNI E-Collection Payment Lists</h3>
        <div class="box-tools pull-right">
            <button class="btn btn-success" id="create-billing-btn"><i class="fa fa-plus"></i>&nbsp; Create Billing</button>
            <button class="btn btn-info" id="inquiry-btn"><i class="fa fa-info"></i>&nbsp; Inquiry</button>
        </div>
    </div>
    <div class="box-body table-responsive">
        {{
            GridRender::setGridId("paymentBniGrid")
            ->enableFilterToolbar()
            ->setGridOption('mtype', 'POST')
            ->setGridOption('url', URL::to('/payment/grid-data?_token='.csrf_token()))
            ->setFileProperty('title', 'BNI E-Collection') //Laravel Excel File Property
            ->setFileProperty('creator', 'Reza') //Laravel Excel File Property
            ->setSheetProperty('fitToPage', true) //Laravel Excel Sheet Property
            ->setSheetProperty('fitToHeight', true)
            ->setGridOption('rowNum', 20)
            ->setGridOption('shrinkToFit', true)
            ->setGridOption('sortname','created_at')
            ->setGridOption('rownumbers', true)
            ->setGridOption('height', '400')
            ->setGridOption('rowList',array(50,100,200))
            ->setGridOption('useColSpanStyle', true)
            ->setNavigatorOptions('navigator', array('viewtext'=>'view'))
            ->setNavigatorOptions('view',array('closeOnEscape'=>false))
            ->setFilterToolbarOptions(array('autosearch'=>true))
            ->setGridEvent('gridComplete', 'gridCompleteEvent')
            ->addColumn(array('label'=>'Action','index'=>'action', 'width'=>80, 'search'=>false, 'sortable'=>false, 'align'=>'center'))
            ->addColumn(array('key'=>true,'index'=>'id','hidden'=>true))
            ->addColumn(array('label'=>'Transaction ID','index'=>'trx_id','width'=>150,'align'=>'center'))
            ->addColumn(array('label'=>'Customer Name','index'=>'customer_name','width'=>200,'align'=>'center'))
            ->addColumn(array('label'=>'VA Number','index'=>'virtual_account','width'=>200,'align'=>'center'))
            ->addColumn(array('label'=>'Transaction<br />Amount','index'=>'trx_amount','width'=>150,'align'=>'right', 'formatter'=>'currency', 'formatoptions'=>array('decimalSeparator'=>',', 'thousandsSeparator'=> '.', 'decimalPlaces'=> '2')))
            ->addColumn(array('label'=>'Created','index'=>'datetime_created','width'=>150,'align'=>'center'))
            ->addColumn(array('label'=>'Expired','index'=>'datetime_expired','width'=>150,'align'=>'center'))
            ->addColumn(array('label'=>'Last Update','index'=>'datetime_last_updated','width'=>150,'align'=>'center'))
            ->addColumn(array('label'=>'Payment Date','index'=>'datetime_payment','width'=>150,'align'=>'center'))                             
            ->addColumn(array('label'=>'Payment<br />Ref Number','index'=>'payment_ntb','width'=>150,'align'=>'center'))
            ->addColumn(array('label'=>'Payment Amount','index'=>'payment_amount','width'=>150,'align'=>'right', 'formatter'=>'currency', 'formatoptions'=>array('decimalSeparator'=>',', 'thousandsSeparator'=> '.', 'decimalPlaces'=> '2')))
            ->addColumn(array('label'=>'VA Status<br />1=active<br />2=inactive','index'=>'va_status','width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Description','index'=>'description','width'=>200,'align'=>'left'))
            ->addColumn(array('label'=>'UID','index'=>'uid','width'=>150,'align'=>'center'))
        
            ->renderGrid()
        }}
    </div>
</div>

<div id="create-billing-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Create Billing</h4>
            </div>
            <form class="form-horizontal" action="{{ route('payment-bni-create-billing') }}" method="POST">
                <div class="modal-body"> 
                    <div class="row">
                        <div class="col-md-12">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Transaction ID</label>
                                <div class="col-sm-8">
                                    <input type="text" name="trx_id" placeholder="Trx ID or Invoice ID" class="form-control pull-right" required />
                                </div>
                            </div> 
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Transaction Amount</label>
                                <div class="col-sm-8">
                                    <input type="number" name="trx_amount" id="trx_amount" class="form-control pull-right" required />
                                </div>
                            </div> 
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Customer Name</label>
                                <div class="col-sm-8">
                                    <input type="text" name="customer_name" class="form-control pull-right" required />
                                </div>
                            </div> 
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Customer Email</label>
                                <div class="col-sm-8">
                                    <input type="email" name="customer_email" class="form-control pull-right" />
                                </div>
                            </div> 
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Customer Phone</label>
                                <div class="col-sm-8">
                                    <input type="tel" name="customer_phone" class="form-control pull-right" />
                                </div>
                            </div> 
                            
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Expired Date</label>
                                <div class="col-sm-8">
                                    <select class="form-control select2" name="expired" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                        <option value="1" selected>+1 Day</option>
                                        <option value="2">+2 Day</option>
                                        <option value="3">+3 Day</option>
                                    </select>
                                </div>
                            </div>   
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Description</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="description" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="inquiry-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Inquiry Billing</h4>
            </div>
            <form class="form-horizontal" action="{{ route('payment-bni-inquiry') }}" method="POST">
                <div class="modal-body"> 
                    <div class="row">
                        <div class="col-md-12">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Transaction ID</label>
                                <div class="col-sm-8">
                                    <input type="text" name="trx_id" placeholder="Trx ID or Invoice ID" class="form-control pull-right" required />
                                </div>
                            </div> 
                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection

@section('custom_css')


@endsection

@section('custom_js')
<script>
//    $('#trx_amount').mask("#,##0.00");
    $('#create-billing-btn').on('click', function(){
        $('#create-billing-modal').modal('show');
    });
    $('#inquiry-btn').on('click', function(){
        $('#inquiry-modal').modal('show');
    });
</script>
@endsection