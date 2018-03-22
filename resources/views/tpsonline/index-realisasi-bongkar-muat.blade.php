@extends('layout')

@section('content')
<style>
    .datepicker.dropdown-menu {
        /*z-index: 100 !important;*/
    }
    .ui-jqgrid tr.jqgrow td {
        word-wrap: break-word; /* IE 5.5+ and CSS3 */
        white-space: pre-wrap; /* CSS3 */
        white-space: -moz-pre-wrap; /* Mozilla, since 1999 */
        white-space: -pre-wrap; /* Opera 4-6 */
        white-space: -o-pre-wrap; /* Opera 7 */
        overflow: hidden;
        height: auto;
        vertical-align: middle;
        padding-top: 3px;
        padding-bottom: 3px
    }
</style>
<script>
 
    function gridCompleteEvent()
    {
        var ids = jQuery("#tpsBongkarMuatGrid").jqGrid('getDataIDs'),
            edt = '' 
        for(var i=0;i < ids.length;i++){ 
            var cl = ids[i];
            
            edt = '<a href="{{ route("tps-responBatalPlp-edit",'') }}/'+cl+'"><i class="fa fa-pencil"></i></a> ';
            jQuery("#tpsBongkarMuatGrid").jqGrid('setRowData',ids[i],{action:edt}); 
        } 
    }
    
</script>

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">TPS Realisasi Bongkar Muat</h3>
<!--        <div class="box-tools">
            <a href="{{ route('tps-responBatalPlp-get') }}" type="button" class="btn btn-block btn-info btn-sm"><i class="fa fa-plus"></i> Get Data</a>
        </div>-->
    </div>
    <div class="box-body table-responsive">
<!--        <div class="row" style="margin-bottom: 30px;margin-right: 0;">
            <div class="col-md-8">
                <div class="col-xs-12">Search By Date</div>
                <div class="col-xs-12">&nbsp;</div>
                <div class="col-xs-3">
                    <select class="form-control select2" id="by" name="by" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option value="TGL_UPLOAD">Tgl. Upload</option>
                        <option value="TGL_PLP">Tgl. PLP</option>  
                        <option value="TGL_BATAL_PLP">Tgl. Batal PLP</option>
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
        </div>-->
        {{
            GridRender::setGridId("tpsBongkarMuatGrid")
            ->enableFilterToolbar()
            ->setGridOption('mtype', 'POST')
            ->setGridOption('url', URL::to('/tpsonline/pengiriman/realisasi-bongkar-muat/grid-data?_token='.csrf_token()))
            ->setGridOption('rowNum', 20)
            ->setGridOption('shrinkToFit', true)
            ->setGridOption('sortname','id')
            ->setGridOption('rownumbers', true)
            ->setGridOption('height', '350')
            ->setGridOption('rowList',array(20,50,100))
            ->setGridOption('useColSpanStyle', true)
            ->setNavigatorOptions('navigator', array('viewtext'=>'view'))
            ->setNavigatorOptions('view',array('closeOnEscape'=>false))
            ->setFilterToolbarOptions(array('autosearch'=>true))
            ->setGridEvent('gridComplete', 'gridCompleteEvent')
            ->addColumn(array('label'=>'Action','index'=>'action', 'width'=>80, 'search'=>false, 'sortable'=>false, 'align'=>'center'))
            ->addColumn(array('key'=>true,'index'=>'id','hidden'=>true))
            ->addColumn(array('label'=>'Ref. Number','index'=>'REF_NUMBER','width'=>160))
            ->addColumn(array('label'=>'No. BC11','index'=>'NO_BC11','width'=>160))
            ->addColumn(array('label'=>'Tgl. BC11','index'=>'TGL_BC11','width'=>160,'align'=>'center'))
            ->addColumn(array('label'=>'Kode Kantor','index'=>'KD_KANTOR','width'=>160))
            ->addColumn(array('label'=>'Kode TPS','index'=>'KD_TPS','width'=>160,'align'=>'center'))
            ->addColumn(array('label'=>'Kode Gudang','index'=>'KD_GUDANG','width'=>160,'align'=>'center'))
            ->addColumn(array('label'=>'Jumlah TPS','index'=>'JML_TPS','width'=>160))
            ->addColumn(array('label'=>'Jumlah Manifest','index'=>'JML_MANIFES','width'=>160,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl. Upload','index'=>'created_at','width'=>160,'align'=>'center'))
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
        jQuery("#tpsBongkarMuatGrid").jqGrid('setGridParam',{url:"{{URL::to('/tpsonline/penerimaan/respon-batal-plp/grid-data')}}?startdate="+startdate+"&enddate="+enddate+"&by="+by}).trigger("reloadGrid");
        return false;
    });
    
</script>

@endsection