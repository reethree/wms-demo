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
        var ids = jQuery("#tpsobLclGrid").jqGrid('getDataIDs'),
            edt = '',
            del = ''; 
        for(var i=0;i < ids.length;i++){ 
            var cl = ids[i];
            
            edt = '<a href="{{ route("tps-obLcl-edit",'') }}/'+cl+'"><i class="fa fa-pencil"></i> Details</a> ';
//            del = '<a href="{{ route("lcl-register-delete",'') }}/'+cl+'" onclick="if (confirm(\'Are You Sure ?\')){return true; }else{return false; };"><i class="fa fa-close"></i></a>';
            jQuery("#tpsobLclGrid").jqGrid('setRowData',ids[i],{action:edt}); 
        } 
    }
    
</script>

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">TPS OB LCL</h3>
        <div class="box-tools">
            <a href="{{ route('tps-ob-get') }}" type="button" class="btn btn-block btn-info btn-sm"><i class="fa fa-plus"></i> Get Data</a>
        </div>
    </div>
    <div class="box-body table-responsive">
        <div class="row" style="margin-bottom: 30px;margin-right: 0;">
            <div class="col-md-8">
                <div class="col-xs-12">Search By Date</div>
                <div class="col-xs-12">&nbsp;</div>
                <div class="col-xs-3">
                    <select class="form-control select2" id="by" name="by" style="width: 100%;" tabindex="-1" aria-hidden="true">                        
                        <option value="TGL_PLP">Tgl. PLP</option>
                        <option value="TGL_BC11">Tgl. BC11</option>
                        <option value="TGL_TIBA">Tgl. Tiba</option>  
                        <option value="TGLUPLOAD">Tgl. Upload</option>
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
            GridRender::setGridId("tpsobLclGrid")
            ->enableFilterToolbar()
            ->setGridOption('mtype', 'POST')
            ->setGridOption('url', URL::to('/tpsonline/penerimaan/ob-lcl/grid-data?jenis=L&_token='.csrf_token()))
            ->setGridOption('rowNum', 20)
            ->setGridOption('shrinkToFit', true)
            ->setGridOption('sortname','TPSOBXML_PK')
            ->setGridOption('rownumbers', true)
            ->setGridOption('height', '295')
            ->setGridOption('rowList',array(20,50,100))
            ->setGridOption('useColSpanStyle', true)
            ->setNavigatorOptions('navigator', array('viewtext'=>'view'))
            ->setNavigatorOptions('view',array('closeOnEscape'=>false))
            ->setFilterToolbarOptions(array('autosearch'=>true))
//            ->setGridEvent('gridComplete', 'gridCompleteEvent')
//            ->addColumn(array('label'=>'Action','index'=>'action', 'width'=>80, 'search'=>false, 'sortable'=>false, 'align'=>'center'))
            ->addColumn(array('key'=>true,'index'=>'TPSOBXML_PK','hidden'=>true))
            ->addColumn(array('label'=>'Ref Number','index'=>'REF_NUMBER','width'=>160,'hidden'=>true))			
            ->addColumn(array('label'=>'No. Surat PLP','index'=>'NO_SURAT_PLP','width'=>250))			
            ->addColumn(array('label'=>'Tgl. Surat PLP','index'=>'TGL_SURAT_PLP','width'=>160,'align'=>'center'))			
            ->addColumn(array('label'=>'Kode Kantor','index'=>'KD_KANTOR','width'=>160,'align'=>'center'))			
            ->addColumn(array('label'=>'Kode Dokumen','index'=>'KD_DOK','width'=>160,'hidden'=>true))			
            ->addColumn(array('label'=>'No. PLP','index'=>'NO_PLP','width'=>160,'align'=>'center'))			
            ->addColumn(array('label'=>'Tgl. PLP','index'=>'TGL_PLP','width'=>160,'align'=>'center'))			
            ->addColumn(array('label'=>'Kode TPS Asal','index'=>'KD_TPS_ASAL','width'=>160,'hidden'=>true))		
            ->addColumn(array('label'=>'TPS Asal','index'=>'TPS_ASAL','width'=>160))	
            ->addColumn(array('label'=>'Nama Angkut','index'=>'NM_ANGKUT','width'=>160))		
            ->addColumn(array('label'=>'No. VOY Flight','index'=>'NO_VOY_FLIGHT','width'=>160))	
            ->addColumn(array('label'=>'Call Sign','index'=>'CALL_SIGN','width'=>160))	
            ->addColumn(array('label'=>'Tgl. Tiba','index'=>'TGL_TIBA','width'=>160))	
            ->addColumn(array('label'=>'Gudang Tujuan','index'=>'GUDANG_TUJUAN','width'=>160))	
            ->addColumn(array('label'=>'No. Container','index'=>'NO_CONT','width'=>250))	
            ->addColumn(array('label'=>'Ukuran Cont.','index'=>'UK_CONT','width'=>160))		
            ->addColumn(array('label'=>'No. Segel','index'=>'NO_SEGEL','width'=>160))	
            ->addColumn(array('label'=>'Janis Cont.','index'=>'JNS_CONT','width'=>80,'align'=>'center'))
            ->addColumn(array('label'=>'No. A11','index'=>'NO_A11','width'=>160,'hidden'=>true))	
            ->addColumn(array('label'=>'Tgl. A11','index'=>'TGL_A11','width'=>160,'hidden'=>true))		
            ->addColumn(array('label'=>'No. BL AWB','index'=>'NO_BL_AWB','width'=>160,'hidden'=>true))		
            ->addColumn(array('label'=>'Tgl. BL AWB','index'=>'TGL_BL_AWB','width'=>160,'hidden'=>true))		
            ->addColumn(array('label'=>'No. MBL AWB','index'=>'NO_MASTER_BL_AWB','width'=>160,'hidden'=>true))		
            ->addColumn(array('label'=>'Tgl. MBL AWB','index'=>'TGL_MASTER_BL_AWB','width'=>160,'hidden'=>true))		
            ->addColumn(array('index'=>'ID_CONSIGNEE','width'=>160,'hidden'=>true))		
            ->addColumn(array('label'=>'Consignee','index'=>'CONSIGNEE','width'=>250))	
            ->addColumn(array('label'=>'Bruto','index'=>'BRUTO','width'=>80))	
            ->addColumn(array('label'=>'No. BC11','index'=>'NO_BC11','width'=>160))			
            ->addColumn(array('label'=>'Tgl. BC11','index'=>'TGL_BC11','width'=>160))			
            ->addColumn(array('label'=>'No. POS BC11','index'=>'NO_POS_BC11','width'=>160))		
            ->addColumn(array('label'=>'ISO Code','index'=>'ISO_CODE','width'=>160,'hidden'=>true))		
            ->addColumn(array('label'=>'Pel. Muat','index'=>'PEL_MUAT','width'=>160,'hidden'=>true))			
            ->addColumn(array('label'=>'Pel. Transit','index'=>'PEL_TRANSIT','width'=>160,'hidden'=>true))		
            ->addColumn(array('label'=>'Pel. Bongkar','index'=>'PEL_BONGKAR','width'=>160,'hidden'=>true))	
            ->addColumn(array('label'=>'Tgl. Upload','index'=>'TGLUPLOAD','width'=>160,'align'=>'center'))
            ->addColumn(array('label'=>'Status','index'=>'STATUS','width'=>160))		
            ->addColumn(array('label'=>'Updated','index'=>'LASTUPDATE','width'=>160))		
            ->addColumn(array('label'=>'Reg. Code','index'=>'REGCODE','width'=>160,'hidden'=>true))
            ->addColumn(array('index'=>'INSDATETIME','width'=>160,'hidden'=>true))
            ->addColumn(array('index'=>'REGCODEDATA','width'=>160,'hidden'=>true))
            ->addColumn(array('index'=>'ID_BOOKING','width'=>160,'hidden'=>true))		
            ->addColumn(array('index'=>'REFNUM_COARI','width'=>160,'hidden'=>true))			
            ->addColumn(array('index'=>'REFDATE_COARI','width'=>160,'hidden'=>true))	
            ->addColumn(array('index'=>'GATEIN_DEPO','width'=>160,'hidden'=>true))		
            ->addColumn(array('index'=>'FLAG_UPD','width'=>160,'hidden'=>true))
            ->addColumn(array('label'=>'No. SPPB','index'=>'NO_SPPB','width'=>160,'hidden'=>true))		
            ->addColumn(array('label'=>'Tgl. SPPN','index'=>'TGL_SPPB','width'=>160,'hidden'=>true))
            ->addColumn(array('label'=>'No. SPJM','index'=>'NO_PIB','width'=>160,'hidden'=>true))	
            ->addColumn(array('label'=>'Tgl. SPJM','index'=>'TGL_PIB','width'=>160,'hidden'=>true))
            ->addColumn(array('index'=>'REFNUM_CODECO','width'=>160,'hidden'=>true))	
            ->addColumn(array('index'=>'REFDATE_CODECO','width'=>160,'hidden'=>true))
            ->addColumn(array('index'=>'GATEOUT_DEPO','width'=>160,'hidden'=>true))
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
        jQuery("#tpsobLclGrid").jqGrid('setGridParam',{url:"{{URL::to('/tpsonline/penerimaan/ob-lcl/grid-data')}}?jenis=L&startdate="+startdate+"&enddate="+enddate+"&by="+by}).trigger("reloadGrid");
        return false;
    });
</script>

@endsection