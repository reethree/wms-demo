@extends('layout')

@section('content')
<style>
    .datepicker.dropdown-menu {
        /*z-index: 100 !important;*/
    }
</style>
<script>
    
    function gridCompleteEvent()
    {
        var ids = jQuery("#tpsLaporanYorGrid").jqGrid('getDataIDs'),
            edt = '',
            upl = ''; 
        for(var i=0;i < ids.length;i++){ 
            var cl = ids[i];
            
            edt = '<a href="{{ route("tps-laporanYor-edit",'') }}/'+cl+'"><i class="fa fa-pencil"></i></a> ';
            upl = '<a href="{{ route("tps-laporanYor-upload",'') }}/'+cl+'" onclick="if (confirm(\'Are You Sure ?\')){return true; }else{return false; };"><i class="fa fa-floppy-o" aria-hidden="true"></i></a>';
            jQuery("#tpsLaporanYorGrid").jqGrid('setRowData',ids[i],{action:edt+' |  '+upl}); 
        } 
    }
    
</script>

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">TPS Laporan YOR</h3>
        <div class="box-tools">
            <button class="btn btn-info btn-sm" id="create-new-btn"><i class="fa fa-plus"></i> Create New Report</button>
        </div>
    </div>
    <div class="box-body table-responsive">
        <div class="row" style="margin-bottom: 30px;margin-right: 0;">
            <div class="col-md-8">
                <div class="col-xs-12">Search By Date</div>
                <div class="col-xs-12">&nbsp;</div>
                <div class="col-xs-3">
                    <select class="form-control select2" id="by" name="by" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option value="TGL_LAPORAN">Tgl. Laporan</option>                        
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
            GridRender::setGridId("tpsLaporanYorGrid")
            ->enableFilterToolbar()
            ->setGridOption('mtype', 'POST')
            ->setGridOption('url', URL::to('/tpsonline/pengiriman/laporan-yor/grid-data?_token='.csrf_token()))
            ->setGridOption('rowNum', 20)
            ->setGridOption('shrinkToFit', true)
            ->setGridOption('sortname','id')
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
            ->addColumn(array('label'=>'Response','index'=>'RESPONSE','width'=>160,'align'=>'center'))
            ->addColumn(array('label'=>'Ref. Number','index'=>'REF_NUMBER','width'=>160,'align'=>'center'))
            ->addColumn(array('label'=>'Kode TPS','index'=>'KD_TPS','width'=>160,'align'=>'center'))
            ->addColumn(array('label'=>'Kode Gudang','index'=>'KD_GUDANG','width'=>160,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl. Laporan','index'=>'TGL_LAPORAN','width'=>160,'align'=>'center'))
            ->addColumn(array('label'=>'UID','index'=>'uid','width'=>160,'align'=>'center'))
            ->renderGrid()
        }}
    </div>
</div>

<div id="create-new-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Create YOR Report (IMPORT)</h4>
            </div>
            <form class="form-horizontal" action="{{ route('tps-laporanYor-store') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-body"> 
                    <div class="row">
                        <div class="col-md-12">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Tgl. Laporan</label>
                                <div class="col-sm-7">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" name="TGL_LAPORAN" class="form-control pull-right datepicker" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">YOR</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="YOR" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Kapasitas Gudang</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="KAPASITAS_GUDANG" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Kapasitas Lapangan</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="KAPASITAS_LAPANGAN" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Total Kontainer</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="TOTAL_CONT" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Total Kemasan</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="TOTAL_KMS" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Jumlah Kontainer 20F</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="JML_CONT20F" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Jumlah Kontainer 40F</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="JML_CONT40F" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Jumlah Kontainer 45F</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="JML_CONT45F" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

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
        jQuery("#tpsLaporanYorGrid").jqGrid('setGridParam',{url:"{{URL::to('/tpsonline/pengiriman/laporan-yor/grid-data')}}?startdate="+startdate+"&enddate="+enddate+"&by="+by}).trigger("reloadGrid");
        return false;
    });
    
    $('#create-new-btn').on("click", function(){
        $('#create-new-modal').modal('show');
    });
    
</script>

@endsection