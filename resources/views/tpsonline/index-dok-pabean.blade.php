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
        var ids = jQuery("#tpsDokPabeanGrid").jqGrid('getDataIDs'),
            edt = '',
            del = ''; 
        for(var i=0;i < ids.length;i++){ 
            var cl = ids[i];
            
            edt = '<a href="{{ route("tps-dokpabean-edit",'') }}/'+cl+'"><i class="fa fa-pencil"></i></a> ';
//            del = '<a href="{{ route("lcl-register-delete",'') }}/'+cl+'" onclick="if (confirm(\'Are You Sure ?\')){return true; }else{return false; };"><i class="fa fa-close"></i></a>';
            jQuery("#tpsDokPabeanGrid").jqGrid('setRowData',ids[i],{action:edt}); 
        } 
    }
    
</script>

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">TPS Dokumen Pabean</h3>
        <div class="box-tools">
            <a href="{{ route('tps-dokpabean-get') }}" type="button" class="btn btn-block btn-info btn-sm"><i class="fa fa-plus"></i> Get Data</a>
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
            GridRender::setGridId("tpsDokPabeanGrid")
            ->enableFilterToolbar()
            ->setGridOption('mtype', 'POST')
            ->setGridOption('url', URL::to('/tpsonline/penerimaan/dok-pabean/grid-data?_token='.csrf_token()))
            ->setGridOption('rowNum', 100)
            ->setGridOption('shrinkToFit', true)
            ->setGridOption('sortname','TPS_DOKPABEANXML_PK')
            ->setGridOption('rownumbers', true)
            ->setGridOption('height', '350')
            ->setGridOption('rownumWidth', 50)
            ->setGridOption('rowList',array(100,200,500))
            ->setGridOption('useColSpanStyle', true)
            ->setNavigatorOptions('navigator', array('viewtext'=>'view'))
            ->setNavigatorOptions('view',array('closeOnEscape'=>false))
            ->setFilterToolbarOptions(array('autosearch'=>true))
            ->setGridEvent('gridComplete', 'gridCompleteEvent')
            ->addColumn(array('label'=>'Action','index'=>'action', 'width'=>80, 'search'=>false, 'sortable'=>false, 'align'=>'center'))
            ->addColumn(array('key'=>true,'index'=>'TPS_DOKPABEANXML_PK','hidden'=>true))
            ->addColumn(array('label'=>'Kode Dok','index'=>'KD_DOK_INOUT','width'=>80,'align'=>'center'))
            ->addColumn(array('label'=>'No. Dok','index'=>'NO_DOK_INOUT','width'=>250,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl. Dok','index'=>'TGL_DOK_INOUT','width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'No. Daftar','index'=>'NO_DAFTAR','width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl. Daftar','index'=>'TGL_DAFTAR','width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'Kode Kantor','index'=>'KD_KANTOR','width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'Pengawas','index'=>'KD_KANTOR_PENGAWAS','width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'Bongkar','index'=>'KD_KANTOR_BONGKAR','width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'NPWP Importir','index'=>'NPWP_IMP','width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'Nama Importir','index'=>'NM_IMP','width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'NPWP PPJK','index'=>'NPWP_PPJK','width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'Nama PPJK','index'=>'NM_PPJK','width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'Nama Angkut','index'=>'NM_ANGKUT','width'=>160,'align'=>'center'))
            ->addColumn(array('label'=>'VOY','index'=>'NO_VOY_FLIGHT','width'=>80,'align'=>'center'))
            ->addColumn(array('label'=>'Gudang','index'=>'GUDANG','width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Jumlah Cont','index'=>'JML_CONT','width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Brutto','index'=>'BRUTTO','width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Netto','index'=>'NETTO','width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'No. BC11','index'=>'NO_BC11','width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl. BC11','index'=>'TGL_BC11','width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl. POS BC11','index'=>'NO_POS_BC11','width'=>160,'align'=>'center'))
            ->addColumn(array('label'=>'No. BL AWB','index'=>'NO_BL_AWB','width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl. BL AWB','index'=>'TGL_BL_AWB','width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'No. MBL AWB','index'=>'NO_MASTER_BL_AWB','width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl. MBL AWB','index'=>'TGL_MASTER_BL_AWB','width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'FL Segel','index'=>'FL_SEGEL','width'=>80,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl. Upload','index'=>'TGL_UPLOAD','width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Jam. Upload','index'=>'JAM_UPLOAD','width'=>80,'align'=>'center'))

            ->renderGrid()
        }}
        
        <div class="row" style="margin: 30px 0 0;">
            <button class="btn btn-info" id="upload-on-demand"><i class="fa fa-upload"></i> Upload On Demand</button>
        </div>
    </div>
</div>
<div id="ondemand-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Upload Dokumen Pabean</h4>
            </div>
            <form class="form-horizontal" action="{{ route('tps-dokPabeanOnDemand-get') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-body"> 
                    <div class="row">
                        <div class="col-md-12">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Kode Dokumen</label>
                                <div class="col-sm-8">
                                    <select class="form-control select2" id="kode_dok" name="kode_dok" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                        <option value="">Choose Document</option>
                                        @foreach($kode_doks as $kode)
                                            <option value="{{ $kode->kode }}">({{$kode->kode}}) {{ $kode->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">No. Dokumen</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="no_dok" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Tgl. Dokumen</label>
                                <div class="col-sm-8">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" name="tgl_dok" class="form-control pull-right tgldok_datepicker" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                  <button type="submit" class="btn btn-primary">Upload</button>
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
    
    $('.tgldok_datepicker').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'ddmmyyyy',
        zIndex: 999999
    });
    
    $('#searchByDateBtn').on("click", function(){
        var by = $("#by").val();
        var startdate = $("#startdate").val();
        var enddate = $("#enddate").val();
        jQuery("#tpsDokPabeanGrid").jqGrid('setGridParam',{url:"{{URL::to('/tpsonline/penerimaan/dok-pabean/grid-data')}}?startdate="+startdate+"&enddate="+enddate+"&by="+by}).trigger("reloadGrid");
        return false;
    });
    
    $('#upload-on-demand').on("click", function(){
        $('#ondemand-modal').modal('show');
    });
</script>

@endsection