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
        var ids = jQuery("#tpsDokManualGrid").jqGrid('getDataIDs'),
            edt = '',
            del = ''; 
        for(var i=0;i < ids.length;i++){ 
            var cl = ids[i];
            
            edt = '<a href="{{ route("tps-dokmanual-edit",'') }}/'+cl+'"><i class="fa fa-pencil"></i></a> ';
//            del = '<a href="{{ route("lcl-register-delete",'') }}/'+cl+'" onclick="if (confirm(\'Are You Sure ?\')){return true; }else{return false; };"><i class="fa fa-close"></i></a>';
            jQuery("#tpsDokManualGrid").jqGrid('setRowData',ids[i],{action:edt}); 
        } 
    }
    
</script>

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">TPS Dokumen Manual</h3>
        <div class="box-tools">
            <a href="{{ route('tps-dokManual-get') }}" type="button" class="btn btn-block btn-info btn-sm"><i class="fa fa-plus"></i> Get Data</a>
        </div>
    </div>
    <div class="box-body table-responsive">
        <div class="row" style="margin-bottom: 30px;margin-right: 0;">
            <div class="col-md-8">
                <div class="col-xs-12">Search By Date</div>
                <div class="col-xs-12">&nbsp;</div>
                <div class="col-xs-3">
                    <select class="form-control select2" id="by" name="by" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option value="TGL_UPLOAD">Tgl. Upload</option>
                        <option value="TGL_DOK_INOUT">Tgl. Dok. In/Out</option>
                        <option value="TGL_BC11">Tgl. BC11</option>    
                        <option value="TGL_BL_AWB">Tgl. BL AWB</option>
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
            GridRender::setGridId("tpsDokManualGrid")
            ->enableFilterToolbar()
            ->setGridOption('mtype', 'POST')
            ->setGridOption('url', URL::to('/tpsonline/penerimaan/dok-manual/grid-data?_token='.csrf_token()))
            ->setGridOption('rowNum', 100)
            ->setGridOption('shrinkToFit', true)
            ->setGridOption('sortname','TPS_DOKMANUALXML_PK')
            ->setGridOption('rownumbers', true)
            ->setGridOption('height', '295')
            ->setGridOption('rownumWidth', 50)
            ->setGridOption('rowList',array(100,200,500))
            ->setGridOption('useColSpanStyle', true)
            ->setNavigatorOptions('navigator', array('viewtext'=>'view'))
            ->setNavigatorOptions('view',array('closeOnEscape'=>false))
            ->setFilterToolbarOptions(array('autosearch'=>true))
            ->setGridEvent('gridComplete', 'gridCompleteEvent')
            ->addColumn(array('label'=>'Action','index'=>'action', 'width'=>80, 'search'=>false, 'sortable'=>false, 'align'=>'center'))
            ->addColumn(array('key'=>true,'index'=>'TPS_DOKMANUALXML_PK','hidden'=>true))

            ->addColumn(array('label'=>'Kode Kantor','index'=>'KD_KANTOR','width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'Kode Dok','index'=>'KD_DOK_INOUT','width'=>80,'align'=>'center'))
            ->addColumn(array('label'=>'No. Dok','index'=>'NO_DOK_INOUT','width'=>250,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl. Dok','index'=>'TGL_DOK_INOUT','width'=>120,'align'=>'center'))
            ->addColumn(array('index'=>'ID_CONSIGNEE','width'=>160,'hidden'=>true))
            ->addColumn(array('label'=>'Consignee','index'=>'CONSIGNEE','width'=>350))
            ->addColumn(array('label'=>'NPWP PPJK','index'=>'NPWP_PPJK','width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'Nama PPJK','index'=>'NAMA_PPJK','width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'Nama Angkut','index'=>'NM_ANGKUT','width'=>160,'align'=>'center'))
            ->addColumn(array('label'=>'VOY','index'=>'NO_VOY_FLIGHT','width'=>80,'align'=>'center'))
            ->addColumn(array('label'=>'Kode Gudang','index'=>'KD_GUDANG','width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Jumlah Cont','index'=>'JML_CONT','width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'No. BC11','index'=>'NO_BC11','width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl. BC11','index'=>'TGL_BC11','width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl. POS BC11','index'=>'NO_POS_BC11','width'=>160,'align'=>'center'))
            ->addColumn(array('label'=>'No. BL AWB','index'=>'NO_BL_AWB','width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl. BL AWB','index'=>'TGL_BL_AWB','width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'FL Segel','index'=>'FL_SEGEL','width'=>80,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl. Upload','index'=>'TGL_UPLOAD','width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Jam. Upload','index'=>'JAM_UPLOAD','width'=>80,'align'=>'center'))

            ->renderGrid()
        }}
    </div>
</div>

@endsection

@section('custom_css')

<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/plugins/datepicker/datepicker3.css") }}">

@endsection

@section('custom_js')

<script src="{{ asset("/bower_components/AdminLTE/plugins/datepicker/bootstrap-datepicker.js") }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
<script type="text/javascript">
    $('select').select2();
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
        jQuery("#tpsDokManualGrid").jqGrid('setGridParam',{url:"{{URL::to('/tpsonline/penerimaan/dok-manual/grid-data')}}?startdate="+startdate+"&enddate="+enddate+"&by="+by}).trigger("reloadGrid");
        return false;
    });
</script>

@endsection