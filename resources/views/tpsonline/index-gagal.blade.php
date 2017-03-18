@extends('layout')

@section('content')
<style>
    .datepicker.dropdown-menu {
        z-index: 100 !important;
    }
</style>

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">COARI CODECO Gagal Terkirim</h3>
<div class="box-tools">
            <a href="{{ route('tps-gagal-get') }}" type="button" class="btn btn-block btn-info btn-sm"><i class="fa fa-plus"></i> Get Data</a>
        </div>
    </div>
    <div class="box-body table-responsive">
        <div class="row" style="margin-bottom: 30px;margin-right: 0;">
            <div class="col-md-8">
                <div class="col-xs-12">Search By Date</div>
                <div class="col-xs-12">&nbsp;</div>
                <div class="col-xs-3">
                    <select class="form-control select2" id="by" name="by" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option value="tgl_upload">Tgl. Upload</option>
                    </select>
                </div>
                <div class="col-xs-3">
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
                <div class="col-xs-3">
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
                GridRender::setGridId("tpsGagalGrid")
                ->enableFilterToolbar()
                ->setGridOption('url', URL::to('/tpsonline/report/grid-data?type=gagal'))
//                ->setGridOption('editurl',URL::to('/tpsonline/report/crud'))
                ->setGridOption('rowNum', 20)
                ->setGridOption('shrinkToFit', true)
                ->setGridOption('sortname','tps_getdatagagalkirim_pk')
                ->setGridOption('rownumbers', true)
                ->setGridOption('height', '295')
                ->setGridOption('rowList',array(20,50,100))
                ->setGridOption('useColSpanStyle', true)
                ->setNavigatorOptions('navigator', array('viewtext'=>'view'))
                ->setNavigatorOptions('view',array('closeOnEscape'=>false))
                ->setNavigatorOptions('navigator', array('add' => false, 'edit' => false, 'del' => false, 'view' => true, 'refresh' => false))
                ->setNavigatorOptions('add', array('closeAfterAdd' => true))
                ->setNavigatorEvent('add', 'afterSubmit', 'afterSubmitEvent')
                ->setNavigatorOptions('edit', array('closeAfterEdit' => true))
                ->setNavigatorEvent('edit', 'afterSubmit', 'afterSubmitEvent')
                ->setNavigatorEvent('del', 'afterSubmit', 'afterSubmitEvent')
                ->setFilterToolbarOptions(array('autosearch'=>true))
                ->addColumn(array('key'=>true,'index'=>'tps_getdatagagalkirim_pk','hidden'=>true))
        
                ->addColumn(array('label'=>'Tgl. Upload','index'=>'tgl_upload', 'width'=>120, 'editable' => true, 'editrules' => array('required' => true)))
                ->addColumn(array('label'=>'Jam Upload','index'=>'jam_upload', 'width'=>120, 'editable' => true, 'editrules' => array('required' => true)))
                ->addColumn(array('label'=>'Jumlah','index'=>'jumlah', 'width'=>120, 'editable' => true, 'editrules' => array('required' => true)))
                ->addColumn(array('label'=>'RN','index'=>'rn', 'width'=>80, 'editable' => true, 'editrules' => array('required' => true)))
                ->addColumn(array('label'=>'Updated','index'=>'lastupdate', 'width'=>120, 'editable' => true, 'editrules' => array('required' => true)))
                ->addColumn(array('label'=>'UID','index'=>'uid', 'width'=>120, 'editable' => true, 'editrules' => array('required' => true)))
        
                ->renderGrid()
            }}
    </div>
  
</div>

@endsection

@section('custom_css')

<!--<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" />-->
<link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/plugins/datepicker/datepicker3.css") }}">

@endsection

@section('custom_js')

<script src="{{ asset("/bower_components/AdminLTE/plugins/datepicker/bootstrap-datepicker.js") }}"></script>
<!--<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>-->
<script type="text/javascript">
//    $('select').select2();
    $('.datepicker').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'yyyy-mm-dd',
        zIndex: 99
    });
    
    $('#searchByDateBtn').on("click", function(){
        var by = $("#by").val();
        var startdate = $("#startdate").val();
        var enddate = $("#enddate").val();
        jQuery("#tpsGagalGrid").jqGrid('setGridParam',{url:"{{URL::to('/tpsonline/report/grid-data')}}?type=gagal&startdate="+startdate+"&enddate="+enddate+"&by="+by}).trigger("reloadGrid");
        return false;
    });
</script>

@endsection