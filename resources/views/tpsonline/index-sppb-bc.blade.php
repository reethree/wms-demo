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
        var ids = jQuery("#tpsSppbBcGrid").jqGrid('getDataIDs'),
            edt = '',
            del = ''; 
        for(var i=0;i < ids.length;i++){ 
            var cl = ids[i];
            
            edt = '<a href="{{ route("tps-sppbBc-edit",'') }}/'+cl+'"><i class="fa fa-pencil"></i></a> ';
//            del = '<a href="{{ route("lcl-register-delete",'') }}/'+cl+'" onclick="if (confirm(\'Are You Sure ?\')){return true; }else{return false; };"><i class="fa fa-close"></i></a>';
            jQuery("#tpsSppbBcGrid").jqGrid('setRowData',ids[i],{action:edt}); 
        } 
    }
    
</script>

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">TPS SPPB BC23</h3>
        <div class="box-tools">
            <a href="{{ route('tps-sppbBc-get') }}" type="button" class="btn btn-block btn-info btn-sm"><i class="fa fa-plus"></i> Get Data</a>
        </div>
    </div>
    <div class="box-body table-responsive">
        <div class="row" style="margin-bottom: 30px;margin-right: 0;">
            <div class="col-md-8">
                <div class="col-xs-12">Search By Date</div>
                <div class="col-xs-12">&nbsp;</div>
                <div class="col-xs-3">
                    <select class="form-control select2" id="by" name="by" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option value="TGL_SPPB">Tgl. SPPB</option>
                        <option value="TGL_UPLOAD">Tgl. Upload</option>
                        <option value="TGL_PIB">Tgl. SPJM</option>
                        <option value="TGL_BC11">Tgl. BC11</option>                     
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
            GridRender::setGridId("tpsSppbBcGrid")
            ->enableFilterToolbar()
            ->setGridOption('mtype', 'POST')
            ->setGridOption('url', URL::to('/tpsonline/penerimaan/sppb-bc/grid-data?_token='.csrf_token()))
            ->setGridOption('rowNum', 20)
            ->setGridOption('shrinkToFit', true)
            ->setGridOption('sortname','TPS_SPPBXML_PK')
            ->setGridOption('rownumbers', true)
            ->setGridOption('height', '295')
            ->setGridOption('rowList',array(20,50,100))
            ->setGridOption('useColSpanStyle', true)
            ->setNavigatorOptions('navigator', array('viewtext'=>'view'))
            ->setNavigatorOptions('view',array('closeOnEscape'=>false))
            ->setFilterToolbarOptions(array('autosearch'=>true))
            ->setGridEvent('gridComplete', 'gridCompleteEvent')
            ->addColumn(array('label'=>'Action','index'=>'action', 'width'=>80, 'search'=>false, 'sortable'=>false, 'align'=>'center'))
            ->addColumn(array('key'=>true,'index'=>'TPS_SPPBXML_PK','hidden'=>true))

            ->addColumn(array('label'=>'CAR','index'=>'CAR','width'=>300))    
            ->addColumn(array('label'=>'No. SPPB','index'=>'NO_SPPB','width'=>1600,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl. SPPB','index'=>'TGL_SPPB','width'=>160,'align'=>'center'))
            ->addColumn(array('label'=>'No. SPK','index'=>'NOJOBORDER','width'=>160))
            ->addColumn(array('label'=>'Kode Pengawas','index'=>'KD_KANTOR_PENGAWAS','width'=>160,'align'=>'center'))
            ->addColumn(array('label'=>'Kode Bongkar','index'=>'KD_KANTOR_BONGKAR','width'=>160,'align'=>'center'))
            ->addColumn(array('label'=>'NO. SPJM','index'=>'NO_PIB','width'=>160,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl. SPJM','index'=>'TGL_PIB','width'=>160,'align'=>'center'))
            ->addColumn(array('label'=>'Nama Importir','index'=>'NAMA_IMP','width'=>300))
            ->addColumn(array('label'=>'NPWP Importir','index'=>'NPWP_IMP','width'=>160))
            ->addColumn(array('label'=>'Alamat Importir','index'=>'ALAMAT_IMP','width'=>350))           
            ->addColumn(array('label'=>'Nama PPJK','index'=>'NAMA_PPJK','width'=>250))
            ->addColumn(array('label'=>'NPWP PPJK','index'=>'NPWP_PPJK','width'=>160))
            ->addColumn(array('label'=>'Alamat PPJK','index'=>'ALAMAT_PPJK','width'=>300))
            ->addColumn(array('label'=>'Nama Angkut','index'=>'NM_ANGKUT','width'=>160))
            ->addColumn(array('label'=>'No. VOY Flight','index'=>'NO_VOY_FLIGHT','width'=>160,'align'=>'center'))
            ->addColumn(array('label'=>'Bruto','index'=>'BRUTO','width'=>80,'align'=>'right'))
            ->addColumn(array('label'=>'Netto','index'=>'NETTO','width'=>80,'align'=>'right'))
            ->addColumn(array('label'=>'Gudang','index'=>'GUDANG','width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'Status Jalur','index'=>'STATUS_JALUR','width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Jumlah Cont.','index'=>'JML_CONT','width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'No. BC11','index'=>'NO_BC11','width'=>160,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl. BC11','index'=>'TGL_BC11','width'=>160,'align'=>'center'))
            ->addColumn(array('label'=>'No. POS BC11','index'=>'NO_POS_BC11','width'=>160,'align'=>'center'))
            ->addColumn(array('label'=>'No. BL AWB','index'=>'NO_BL_AWB','width'=>160,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl. BL AWB','index'=>'TGL_BL_AWB','width'=>160,'align'=>'center'))
            ->addColumn(array('label'=>'No. MBL AWB','index'=>'NO_MASTER_BL_AWB','width'=>160,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl. MBL AWB','index'=>'TGL_MASTER_BL_AWB','width'=>160,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl. Upload','index'=>'TGL_UPLOAD','width'=>160,'align'=>'center'))
            ->addColumn(array('label'=>'Jam Upload','index'=>'JAM_UPLOAD','width'=>160,'align'=>'center'))
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
        jQuery("#tpsSppbBcGrid").jqGrid('setGridParam',{url:"{{URL::to('/tpsonline/penerimaan/sppb-bc/grid-data')}}?startdate="+startdate+"&enddate="+enddate+"&by="+by}).trigger("reloadGrid");
        return false;
    });
</script>

@endsection