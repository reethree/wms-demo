@extends('layout')

@section('content')
<style>
    .datepicker.dropdown-menu {
        z-index: 100 !important;
    }
</style>
<script>
 
    function gridCompleteEvent()
    {
        var ids = jQuery("#fclRegisterGrid").jqGrid('getDataIDs'),
            edt = '',
            del = ''; 
        for(var i=0;i < ids.length;i++){ 
            var cl = ids[i];
            
            edt = '<a href="{{ route("fcl-register-edit",'') }}/'+cl+'"><i class="fa fa-pencil"></i></a> ';
            del = '<a href="{{ route("fcl-register-delete",'') }}/'+cl+'" onclick="if (confirm(\'Are You Sure ?\')){return true; }else{return false; };"><i class="fa fa-close"></i></a>';
            jQuery("#fclRegisterGrid").jqGrid('setRowData',ids[i],{action:edt+' '+del}); 
        } 
    }
    
</script>

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">FCL Register Lists</h3>
        <div class="box-tools">
            <a href="{{ route('fcl-register-create') }}" type="button" class="btn btn-block btn-info btn-sm"><i class="fa fa-plus"></i> Add New</a>
        </div>
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
            GridRender::setGridId("fclRegisterGrid")
            ->enableFilterToolbar()
            ->setGridOption('mtype', 'POST')
            ->setGridOption('url', URL::to('/fcl/joborder/grid-data?_token='.csrf_token()))
            ->setGridOption('rowNum', 20)
            ->setGridOption('shrinkToFit', true)
            ->setGridOption('sortname','NoJob')
            ->setGridOption('rownumbers', true)
            ->setGridOption('height', '295')
            ->setGridOption('rowList',array(20,50,100))
            ->setGridOption('useColSpanStyle', true)
            ->setNavigatorOptions('navigator', array('viewtext'=>'view'))
            ->setNavigatorOptions('view',array('closeOnEscape'=>false))
            ->setFilterToolbarOptions(array('autosearch'=>true))
            ->setGridEvent('gridComplete', 'gridCompleteEvent')
            ->addColumn(array('label'=>'Action','index'=>'action', 'width'=>80, 'search'=>false, 'sortable'=>false, 'align'=>'center'))
//            ->addColumn(array('key'=>true,'index'=>'TJOBORDER_PK','hidden'=>true))  
            ->addColumn(array('key'=>true,'index'=>'TCONTAINER_PK','hidden'=>true))
//            ->addColumn(array('index'=>'TCONSIGNEE_FK','hidden'=>true))  
            ->addColumn(array('label'=>'No. Joborder','index'=>'NoJob','width'=>160))
            ->addColumn(array('label'=>'No. MBL','index'=>'NOMBL','width'=>160,'hidden'=>true))
            ->addColumn(array('label'=>'Tgl. MBL','index'=>'TGLMBL','width'=>150,'align'=>'center','hidden'=>true))
            ->addColumn(array('label'=>'Consolidator','index'=>'NAMACONSOLIDATOR','width'=>250,'hidden'=>true))
            ->addColumn(array('label'=>'No. Container','index'=>'NOCONTAINER','width'=>160,'hidden'=>false))           
            ->addColumn(array('label'=>'Consignee','index'=>'tcontainercy.CONSIGNEE','width'=>250,'hidden'=>false))
            ->addColumn(array('label'=>'No. BC11','index'=>'NO_BC11','width'=>150,'align'=>'right'))
            ->addColumn(array('label'=>'Tgl. BC11','index'=>'TGL_BC11','width'=>150,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl. POS BC11','index'=>'NO_POS_BC11','width'=>150,'align'=>'center'))
            ->addColumn(array('label'=>'No. PLP','index'=>'TNO_PLP','width'=>150,'align'=>'right'))
            ->addColumn(array('label'=>'Tgl. PLP','index'=>'TTGL_PLP','width'=>150,'align'=>'center'))
            ->addColumn(array('label'=>'ETA','index'=>'ETA', 'width'=>150,'align'=>'center'))
            ->addColumn(array('label'=>'ETD','index'=>'ETD', 'width'=>150,'align'=>'center','hidden'=>true))
            ->addColumn(array('label'=>'Vessel','index'=>'VESSEL', 'width'=>150))
            ->addColumn(array('label'=>'Callsign','index'=>'CALLSIGN', 'width'=>150,'align'=>'center'))
            ->addColumn(array('label'=>'Voy','index'=>'VOY','width'=>80,'align'=>'center'))
            ->addColumn(array('label'=>'Teus','index'=>'TEUS', 'width'=>80,'align'=>'center','hidden'=>true))
            ->addColumn(array('label'=>'No. Seal','index'=>'NO_SEAL', 'width'=>120,'align'=>'right','hidden'=>true))
            ->addColumn(array('label'=>'Layout','index'=>'layout','width'=>80,'align'=>'center','hidden'=>true,'hidden'=>true))
            ->addColumn(array('label'=>'UID','index'=>'UID', 'width'=>150))
            ->addColumn(array('label'=>'Tgl. Entry','index'=>'TGLENTRY', 'width'=>150,'align'=>'center'))
//            ->addColumn(array('label'=>'Updated','index'=>'last_update', 'width'=>150, 'search'=>false))
            ->renderGrid()
        }}
    </div>
</div>

@endsection

@section('custom_css')

<link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/plugins/datepicker/datepicker3.css") }}">

@endsection

@section('custom_js')

<script src="{{ asset("/bower_components/AdminLTE/plugins/datepicker/bootstrap-datepicker.js") }}"></script>
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
        jQuery("#fclRegisterGrid").jqGrid('setGridParam',{url:"{{URL::to('/fcl/joborder/grid-data')}}?startdate="+startdate+"&enddate="+enddate}).trigger("reloadGrid");
        return false;
    });
</script>

@endsection