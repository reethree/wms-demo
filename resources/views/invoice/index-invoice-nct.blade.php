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
    
    var grid = $("#fclInvoicesGrid"), headerRow, rowHight, resizeSpanHeight;

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
        var ids = jQuery("#fclInvoicesGrid").jqGrid('getDataIDs'),
            edt = '',
            del = ''; 
        for(var i=0;i < ids.length;i++){ 
            var cl = ids[i];
            
            edt = '<a href="{{ route("invoice-nct-edit",'') }}/'+cl+'"><i class="fa fa-pencil"></i></a> ';
            del = '<a href="{{ route("invoice-nct-delete",'') }}/'+cl+'" onclick="if (confirm(\'Are You Sure ?\')){return true; }else{return false; };"><i class="fa fa-close"></i></a>';
            jQuery("#fclInvoicesGrid").jqGrid('setRowData',ids[i],{action:edt+' '+del}); 
        } 
    }
    
</script>

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">FCL Invoices Lists</h3>
<!--        <div class="box-tools">
            <button class="btn btn-block btn-info btn-sm" id="cetak-rekap"><i class="fa fa-print"></i> Cetak Rekap Harian</button>
        </div>-->
    </div>
    <div class="box-body table-responsive">
        <div class="row" style="margin-bottom: 30px;margin-right: 0;">
            <div class="col-md-6">
                <div class="col-xs-12">Search By Date</div>
                <div class="col-xs-4">
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" id="startdate" class="form-control pull-right datepicker">
                    </div>
                </div>
                <div class="col-xs-1">
                    s/d
                </div>
                <div class="col-xs-4">
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" id="enddate" class="form-control pull-right datepicker">
                    </div>
                </div>
                <div class="col-xs-2">
                    <button id="searchByDateBtn" class="btn btn-default">Search</button>
                </div>
            </div>
        </div>
        {{
            GridRender::setGridId("fclInvoicesGrid")
            ->enableFilterToolbar()
            ->setGridOption('mtype', 'POST')
            ->setGridOption('url', URL::to('/invoice/fcl/grid-data?_token='.csrf_token()))
            ->setFileProperty('title', 'LCL Invoices') //Laravel Excel File Property
            ->setFileProperty('creator', 'Reza') //Laravel Excel File Property
            ->setSheetProperty('fitToPage', true) //Laravel Excel Sheet Property
            ->setSheetProperty('fitToHeight', true)
            ->setGridOption('rowNum', 20)
            ->setGridOption('shrinkToFit', true)
            ->setGridOption('sortname','updated_at')
            ->setGridOption('rownumbers', true)
            ->setGridOption('height', '295')
            ->setGridOption('rowList',array(20,50,100))
            ->setGridOption('useColSpanStyle', true)
            ->setNavigatorOptions('navigator', array('viewtext'=>'view'))
            ->setNavigatorOptions('view',array('closeOnEscape'=>false))
            ->setFilterToolbarOptions(array('autosearch'=>true))
            ->setGridEvent('gridComplete', 'gridCompleteEvent')
            ->addColumn(array('label'=>'Action','index'=>'action', 'width'=>80, 'search'=>false, 'sortable'=>false, 'align'=>'center'))
            ->addColumn(array('key'=>true,'index'=>'id','hidden'=>true))
            ->addColumn(array('label'=>'No. Invoice','index'=>'no_invoice','width'=>160,'align'=>'center'))           
            ->addColumn(array('label'=>'No. Pajak','index'=>'no_pajak','width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'Consignee','index'=>'consignee','width'=>350,'align'=>'left'))
            ->addColumn(array('label'=>'NPWP','index'=>'npwp','width'=>160,'align'=>'center'))
            ->addColumn(array('label'=>'Alamat','index'=>'alamat','width'=>120, 'align'=>'center','hidden'=>true))
            ->addColumn(array('index'=>'consignee_id','hidden'=>true))
            ->addColumn(array('label'=>'Vessel','index'=>'vessel', 'width'=>160))
            ->addColumn(array('label'=>'Voy','index'=>'voy','width'=>80,'align'=>'center'))
            ->addColumn(array('label'=>'No. DO','index'=>'no_do','width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'No. B/L','index'=>'no_bl','width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'ETA','index'=>'eta', 'width'=>120, 'align'=>'center'))
            ->addColumn(array('label'=>'Terminal Out','index'=>'gateout_terminal', 'width'=>120, 'align'=>'center'))
            ->addColumn(array('label'=>'TPS Out','index'=>'gateout_tps', 'width'=>120, 'align'=>'center'))
            ->addColumn(array('label'=>'Administrasi','index'=>'administrasi','width'=>100,'align'=>'right', 'formatter'=>'currency', 'formatoptions'=>array('decimalSeparator'=>',', 'thousandsSeparator'=> '.', 'decimalPlaces'=> '2')))
            ->addColumn(array('label'=>'Sebelum PPN','index'=>'total_non_ppn','width'=>100,'align'=>'right', 'formatter'=>'currency', 'formatoptions'=>array('decimalSeparator'=>',', 'thousandsSeparator'=> '.', 'decimalPlaces'=> '2')))
            ->addColumn(array('label'=>'PPN 10%','index'=>'ppn','width'=>100,'align'=>'right', 'formatter'=>'currency', 'formatoptions'=>array('decimalSeparator'=>',', 'thousandsSeparator'=> '.', 'decimalPlaces'=> '2')))
            ->addColumn(array('label'=>'Materai','index'=>'materai','width'=>100,'align'=>'right', 'formatter'=>'currency', 'formatoptions'=>array('decimalSeparator'=>',', 'thousandsSeparator'=> '.', 'decimalPlaces'=> '2')))
            ->addColumn(array('label'=>'Total','index'=>'total','width'=>100,'align'=>'right', 'formatter'=>'currency', 'formatoptions'=>array('decimalSeparator'=>',', 'thousandsSeparator'=> '.', 'decimalPlaces'=> '2')))
            ->addColumn(array('label'=>'Created','index'=>'created_at', 'width'=>160,'align'=>'center'))
            ->addColumn(array('label'=>'Updated','index'=>'updated_at', 'width'=>160,'align'=>'center','hidden'=>true))
            ->addColumn(array('label'=>'UID','index'=>'uid','width'=>'150','align'=>'center')) 
            ->renderGrid()
        }}
    </div>
</div>


@endsection

@section('custom_css')

<link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/plugins/datepicker/datepicker3.css") }}">
<link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/plugins/bootstrap-switch/bootstrap-switch.min.css") }}">

@endsection

@section('custom_js')

<script src="{{ asset("/bower_components/AdminLTE/plugins/datepicker/bootstrap-datepicker.js") }}"></script>
<script src="{{ asset("/bower_components/AdminLTE/plugins/bootstrap-switch/bootstrap-switch.min.js") }}"></script>
<script type="text/javascript">
    $('.datepicker').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'yyyy-mm-dd',
        zIndex: 99
    });
    
    $('#searchByDateBtn').on("click", function(){
        var startdate = $("#startdate").val();
        var enddate = $("#enddate").val();
        jQuery("#fclInvoicesGrid").jqGrid('setGridParam',{url:"{{URL::to('/invoice/fcl/grid-data')}}?startdate="+startdate+"&enddate="+enddate}).trigger("reloadGrid");
        return false;
    });
    
    $('#cetak-rekap').on('click', function(){
        $('#cetak-rekap-modal').modal('show');
    });
    
    $.fn.bootstrapSwitch.defaults.onColor = 'danger';
    $.fn.bootstrapSwitch.defaults.onText = 'Yes';
    $.fn.bootstrapSwitch.defaults.offText = 'No';
    $("input[type='checkbox']").bootstrapSwitch();
</script>

@endsection