@extends('layout')

@section('content')
<style>
    .datepicker.dropdown-menu {
        z-index: 100 !important;
    }
</style>
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">LCL Register Lists</h3>
<!--        <div class="box-tools">
            <a href="{{ route('lcl-register-create') }}" type="button" class="btn btn-block btn-info btn-sm"><i class="fa fa-plus"></i> Add New</a>
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
            GridRender::setGridId("lclDailyReportGrid")
            ->enableFilterToolbar()
            ->setGridOption('url', URL::to('/lcl/manifest/grid-data'))
            ->setGridOption('rowNum', 20)
            ->setGridOption('shrinkToFit', true)
            ->setGridOption('sortname','TMANIFEST_PK')
            ->setGridOption('rownumbers', true)
            ->setGridOption('height', '250')
            ->setGridOption('rowList',array(20,50,100))
            ->setGridOption('useColSpanStyle', true)
            ->setNavigatorOptions('navigator', array('viewtext'=>'view'))
            ->setNavigatorOptions('view',array('closeOnEscape'=>false))
            ->setFilterToolbarOptions(array('autosearch'=>true))
//            ->setGridEvent('onSelectRow', 'onSelectRowEvent')
            ->addColumn(array('key'=>true,'index'=>'TMANIFEST_PK','hidden'=>true))
            ->addColumn(array('label'=>'Status','index'=>'VALIDASI','width'=>80, 'align'=>'center'))
            ->addColumn(array('label'=>'No. HBL','index'=>'NOHBL','width'=>160))
            ->addColumn(array('label'=>'Tgl. HBL','index'=>'TGL_HBL', 'width'=>150))
            ->addColumn(array('label'=>'No. Tally','index'=>'NOTALLY','width'=>160))
            ->addColumn(array('label'=>'No. SPK','index'=>'NOJOBORDER', 'width'=>150))
            ->addColumn(array('label'=>'No. Container','index'=>'NOCONTAINER', 'width'=>150))
            ->addColumn(array('label'=>'No. SPJM','index'=>'NO_SPJM', 'width'=>150))
            ->addColumn(array('label'=>'Tgl. SPJM','index'=>'TGL_SPJM', 'width'=>150))
            ->addColumn(array('label'=>'No. SPPB','index'=>'NO_SPPB', 'width'=>150))
            ->addColumn(array('label'=>'Tgl. SPPB','index'=>'TGL_SPPB', 'width'=>150))
            ->addColumn(array('label'=>'Kode Dokumen','index'=>'KODE_DOKUMEN', 'width'=>150))
//            ->addColumn(array('label'=>'Shipper','index'=>'SHIPPER','width'=>160))
//            ->addColumn(array('label'=>'Consignee','index'=>'CONSIGNEE','width'=>160))
//            ->addColumn(array('label'=>'Notify Party','index'=>'NOTIFYPARTY','width'=>160))
            ->addColumn(array('label'=>'Consolidator','index'=>'NAMACONSOLIDATOR','width'=>250))
            ->addColumn(array('label'=>'Weight','index'=>'WEIGHT', 'width'=>120))               
            ->addColumn(array('label'=>'Meas','index'=>'MEAS', 'width'=>120))
            ->addColumn(array('label'=>'Qty','index'=>'QUANTITY', 'width'=>80,'align'=>'center'))
            ->addColumn(array('label'=>'Packing','index'=>'NAMAPACKING', 'width'=>120))
            ->addColumn(array('label'=>'Kode Kemas','index'=>'KODE_KEMAS', 'width'=>100,'align'=>'center'))        
            ->addColumn(array('label'=>'Consignee','index'=>'CONSIGNEE', 'width'=>150))
//            ->addColumn(array('label'=>'NPWP Consignee','index'=>'NPWP_CONSIGNEE', 'width'=>150))
            ->addColumn(array('label'=>'Marking','index'=>'MARKING', 'width'=>150)) 
            ->addColumn(array('label'=>'Desc of Goods','index'=>'DESCOFGOODS', 'width'=>150))              
            ->addColumn(array('label'=>'No.BC11','index'=>'NO_BC11', 'width'=>150))
            ->addColumn(array('label'=>'Tgl.BC11','index'=>'TGL_BC11', 'width'=>150))
            ->addColumn(array('label'=>'No.POS BC11','index'=>'NO_POS_BC11', 'width'=>150))
            ->addColumn(array('label'=>'No.PLP','index'=>'NO_PLP', 'width'=>150))                
            ->addColumn(array('label'=>'Tgl.PLP','index'=>'TGL_PLP', 'width'=>150)) 
            ->addColumn(array('label'=>'Tgl.Behandle','index'=>'tglbehandle', 'width'=>150)) 
//            ->addColumn(array('label'=>'Surcharge (DG)','index'=>'DG_SURCHARGE', 'width'=>150))
//            ->addColumn(array('label'=>'Surcharge (Weight)','index'=>'WEIGHT_SURCHARGE', 'width'=>150)) 
            ->addColumn(array('label'=>'Tgl. Surat Jalan','index'=>'TGLSURATJALAN', 'width'=>120))
            ->addColumn(array('label'=>'Jam. Surat Jalan','index'=>'JAMSURATJALAN', 'width'=>70))
            ->addColumn(array('label'=>'Tgl. Fiat Muat','index'=>'tglfiat', 'width'=>120))
            ->addColumn(array('label'=>'Jam. Fiat Muat','index'=>'jamfiat', 'width'=>70))
            ->addColumn(array('label'=>'Tgl. Entry','index'=>'tglentry', 'width'=>120))
            ->addColumn(array('label'=>'Jam. Entry','index'=>'jamentry', 'width'=>70,'hidden'=>true))
            ->addColumn(array('label'=>'Updated','index'=>'last_update', 'width'=>150, 'search'=>false))
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
        jQuery("#lclDailyReportGrid").jqGrid('setGridParam',{url:"{{URL::to('/lcl/manifest/grid-data')}}?startdate="+startdate+"&enddate="+enddate}).trigger("reloadGrid");
        return false;
    });
</script>

@endsection