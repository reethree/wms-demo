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
        var ids = jQuery("#lclInoutReportGrid").jqGrid('getDataIDs'),
            lt = '';   
            
        for(var i=0;i < ids.length;i++){ 
            var cl = ids[i];
            
            rowdata = $('#lclInoutReportGrid').getRowData(cl);
            
            if(rowdata.tglmasuk && rowdata.tglrelease == ''){
                lt = jQuery.timeago(rowdata.tglmasuk+' '+rowdata.jammasuk);
            }else if(rowdata.tglmasuk == ''){
                lt = 'Belum GateIn';
            }else{
                lt = 'Sudah Release';
            }
            jQuery("#lclInoutReportGrid").jqGrid('setRowData',ids[i],{lamaTimbun:lt}); 
        } 
    }
    
</script>
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Report Stock LCL</h3>
<!--        <div class="box-tools">
            <a href="{{ route('lcl-register-create') }}" type="button" class="btn btn-block btn-info btn-sm"><i class="fa fa-plus"></i> Add New</a>
        </div>-->
    </div>
    <div class="box-body table-responsive">
        <div class="row" style="margin-bottom: 30px;margin-right: 0;">
            <div class="col-md-8">
                <div class="col-xs-12">Search By Date</div>
                <div class="col-xs-12">&nbsp;</div>
                <div class="col-xs-3">
                    <select class="form-control select2" id="by" name="by" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option value="TGL_PLP">Tgl. PLP</option>
                        <option value="ETA">ETA</option>
                        <option value="TGL_BC11">Tgl. BC11</option>
                        <option value="tglmasuk">Tgl. GateIn</option>
                        <option value="tglrelease">Tgl. Release</option>
                        
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
            GridRender::setGridId("lclInoutReportGrid")
            ->enableFilterToolbar()
            ->setGridOption('mtype', 'POST')
            ->setGridOption('url', URL::to('/lcl/manifest/grid-data?report=1&_token='.csrf_token()))
            ->setGridOption('rowNum', 20)
            ->setGridOption('shrinkToFit', true)
            ->setGridOption('sortname','TMANIFEST_PK')
            ->setGridOption('rownumbers', true)
            ->setGridOption('height', '320')
            ->setGridOption('rowList',array(20,50,100))
            ->setGridOption('useColSpanStyle', true)
            ->setNavigatorOptions('navigator', array('viewtext'=>'view'))
            ->setNavigatorOptions('view',array('closeOnEscape'=>false))
            ->setFilterToolbarOptions(array('autosearch'=>true))
//            ->setGridEvent('onSelectRow', 'onSelectRowEvent')
            ->setGridEvent('gridComplete', 'gridCompleteEvent')
            ->addColumn(array('key'=>true,'index'=>'TMANIFEST_PK','hidden'=>true))
//            ->addColumn(array('label'=>'Status','index'=>'VALIDASI','width'=>80, 'align'=>'center'))
            ->addColumn(array('label'=>'No. Joborder','index'=>'NOJOBORDER', 'width'=>150))
            ->addColumn(array('label'=>'Nama Angkut','index'=>'VESSEL','width'=>160))
            ->addColumn(array('label'=>'VOY','index'=>'VOY','width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'No. Container','index'=>'NOCONTAINER', 'width'=>150,'align'=>'center'))
            ->addColumn(array('label'=>'Size','index'=>'SIZE', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Teus','index'=>'TEUS', 'width'=>100,'align'=>'center','hidden'=>true))
            ->addColumn(array('label'=>'ETA','index'=>'ETA', 'width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'TPS Asal','index'=>'KD_TPS_ASAL', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Consolidator','index'=>'NAMACONSOLIDATOR','width'=>250))
            ->addColumn(array('label'=>'No. HBL','index'=>'NOHBL','width'=>160))
            ->addColumn(array('label'=>'Tgl. HBL','index'=>'TGL_HBL', 'width'=>150,'align'=>'center'))
            ->addColumn(array('label'=>'No. Tally','index'=>'NOTALLY','width'=>160))
            ->addColumn(array('label'=>'Consignee','index'=>'CONSIGNEE', 'width'=>250))
            ->addColumn(array('label'=>'Quantity','index'=>'QUANTITY', 'width'=>80,'align'=>'center'))
            ->addColumn(array('label'=>'Packing','index'=>'NAMAPACKING', 'width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'Kode Kemas','index'=>'KODE_KEMAS', 'width'=>100,'align'=>'center'))        
            ->addColumn(array('label'=>'Weight','index'=>'WEIGHT', 'width'=>120,'align'=>'center'))               
            ->addColumn(array('label'=>'Meas','index'=>'MEAS', 'width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'No.PLP','index'=>'NO_PLP', 'width'=>150,'align'=>'center'))                
            ->addColumn(array('label'=>'Tgl.PLP','index'=>'TGL_PLP', 'width'=>150,'align'=>'center'))
            ->addColumn(array('label'=>'No.BC 1.1','index'=>'NO_BC11', 'width'=>150,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl.BC 1.1','index'=>'TGL_BC11', 'width'=>150,'align'=>'center'))
            ->addColumn(array('label'=>'No.POS BC11','index'=>'NO_POS_BC11', 'width'=>150,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl. Gate In','index'=>'tglmasuk', 'width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'Jam. Gate In','index'=>'jammasuk', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl. Stripping','index'=>'tglstripping', 'width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'Jam. Stripping','index'=>'jamstripping', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl. Release','index'=>'tglrelease', 'width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'Jam. Release','index'=>'jamrelease', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Kode Dokumen','index'=>'KODE_DOKUMEN', 'width'=>150))
            ->addColumn(array('label'=>'No. SPPB','index'=>'NO_SPPB', 'width'=>150))
            ->addColumn(array('label'=>'Tgl. SPPB','index'=>'TGL_SPPB', 'width'=>150))
            ->addColumn(array('label'=>'No. SPJM','index'=>'NO_SPJM', 'width'=>150))
            ->addColumn(array('label'=>'Tgl. SPJM','index'=>'TGL_SPJM', 'width'=>150))
//            ->addColumn(array('label'=>'No. POL','index'=>'NOPOL', 'width'=>120,'align'=>'center'))
//            ->addColumn(array('label'=>'Kode Dokumen','index'=>'KODE_DOKUMEN', 'width'=>150))
//            ->addColumn(array('label'=>'Shipper','index'=>'SHIPPER','width'=>160))
//            ->addColumn(array('label'=>'Consignee','index'=>'CONSIGNEE','width'=>160))
//            ->addColumn(array('label'=>'Notify Party','index'=>'NOTIFYPARTY','width'=>160))            
//            ->addColumn(array('label'=>'NPWP Consignee','index'=>'NPWP_CONSIGNEE', 'width'=>150))
//            ->addColumn(array('label'=>'Marking','index'=>'MARKING', 'width'=>150)) 
//            ->addColumn(array('label'=>'Desc of Goods','index'=>'DESCOFGOODS', 'width'=>150))              
//            ->addColumn(array('label'=>'Tgl.Behandle','index'=>'tglbehandle', 'width'=>150)) 
//            ->addColumn(array('label'=>'Surcharge (DG)','index'=>'DG_SURCHARGE', 'width'=>150))
//            ->addColumn(array('label'=>'Surcharge (Weight)','index'=>'WEIGHT_SURCHARGE', 'width'=>150)) 
//            ->addColumn(array('label'=>'Tgl. Surat Jalan','index'=>'TGLSURATJALAN', 'width'=>120))
//            ->addColumn(array('label'=>'Jam. Surat Jalan','index'=>'JAMSURATJALAN', 'width'=>70))
//            ->addColumn(array('label'=>'Tgl. Fiat Muat','index'=>'tglfiat', 'width'=>120))
//            ->addColumn(array('label'=>'Jam. Fiat Muat','index'=>'jamfiat', 'width'=>70))
//            ->addColumn(array('label'=>'Tgl. Entry','index'=>'tglentry', 'width'=>120))
//            ->addColumn(array('label'=>'Jam. Entry','index'=>'jamentry', 'width'=>70,'hidden'=>true))
//            ->addColumn(array('label'=>'Updated','index'=>'last_update', 'width'=>150, 'search'=>false))
//            ->addColumn(array('label'=>'Lama Timbun','index'=>'lamaTimbun', 'width'=>150, 'search'=>false, 'editable'=>false,'align'=>'center'))
            ->addColumn(array('label'=>'Lama Timbun (Hari)','index'=>'timeSinceUpdate', 'width'=>150, 'search'=>false, 'align'=>'center'))
            ->renderGrid()
        }}
    </div>
</div>

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Laporan Total Penarikan</h3>
        <form action="{{ route('lcl-report-inout') }}" method="GET">
            <div class="row">
                <div class="col-md-2">
                    <select class="form-control select2" id="by" name="month" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option value="01" @if($month == '01') {{ 'selected' }} @endif>Januari</option>
                        <option value="02" @if($month == '02') {{ 'selected' }} @endif>Februari</option>
                        <option value="03" @if($month == '03') {{ 'selected' }} @endif>Maret</option>
                        <option value="04" @if($month == '04') {{ 'selected' }} @endif>April</option>
                        <option value="05" @if($month == '05') {{ 'selected' }} @endif>Mei</option>
                        <option value="06" @if($month == '06') {{ 'selected' }} @endif>Juni</option>
                        <option value="07" @if($month == '07') {{ 'selected' }} @endif>Juli</option>
                        <option value="08" @if($month == '08') {{ 'selected' }} @endif>Agustus</option>
                        <option value="09" @if($month == '09') {{ 'selected' }} @endif>September</option>
                        <option value="10" @if($month == '10') {{ 'selected' }} @endif>Oktober</option>
                        <option value="11" @if($month == '11') {{ 'selected' }} @endif>November</option>
                        <option value="12" @if($month == '12') {{ 'selected' }} @endif>Desember</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-control select2" id="by" name="year" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option value="2016" @if($year == '2016') {{ 'selected' }} @endif>2016</option>
                        <option value="2017" @if($year == '2017') {{ 'selected' }} @endif>2017</option>  
                        <option value="2018" @if($year == '2018') {{ 'selected' }} @endif>2018</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" id="searchByMonthBtn" class="btn btn-default">Search</button>
                </div>
            </div>
        </form>
    </div>
    <div class="box-body table-responsive">
        <div class="row" style="margin-bottom: 30px;margin-right: 0;">
            <div class="col-sm-4">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>KODE DOKUMEN</th>
                            <th>JML DOKUMEN</th>
                        </tr>
                        @foreach($countbydoc as $key=>$value)
                        <tr>
                            <th>{{ $key }}</th>
                            <td align="center">{{ $value }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Report SOR ({{ date('d F Y') }})</h3>
    </div>
    <div class="box-body table-responsive">
        <div class="row" style="margin-bottom: 30px;margin-right: 0;">
            <div class="col-sm-4">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>KAPASITAS TERISI</th>
                            <td align="right">{{ number_format($sor->kapasitas_terisi,'2','.',',') }} CBM</td>
                        </tr>
                        <tr>
                            <th>KAPASITAS GUDANG</th>
                            <td align="right">{{ number_format($sor->kapasitas_default,'2','.',',') }} CBM</td>
                        </tr>
                        <tr>
                            <th>KAPASITAS KOSONG</th>
                            <td align="right">{{ number_format($sor->kapasitas_kosong,'2','.',',') }} CBM</td>
                        </tr>
                        <tr>
                            <th>SOR (%)</th>
                            <td align="right">{{ number_format($sor->total,'2','.',',') }} %</td>
                        </tr>
                        <tr>
                            <th>SUM MEAS</th>
                            <td align="right">{{ number_format($meas,'4','.',',') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
</div>

@endsection

@section('custom_css')

<link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/plugins/datepicker/datepicker3.css") }}">

@endsection

@section('custom_js')

<script src="{{ asset("/bower_components/AdminLTE/plugins/datepicker/bootstrap-datepicker.js") }}"></script>
<script src="{{ asset("/assets/js/jquery.timeago.js") }}"></script>
<script src="{{ asset("/assets/js/jquery.timeago.id.js") }}"></script>
<script type="text/javascript">
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
        var string_filters = '';
        var filters = '{"groupOp":"AND","rules":[{"field":"'+by+'","op":"ge","data":"'+startdate+'"},{"field":"'+by+'","op":"le","data":"'+enddate+'"}]}';

        var current_filters = jQuery("#lclInoutReportGrid").getGridParam("postData").filters;
        
        if (current_filters) {
            var get_filters = $.parseJSON(current_filters);
            if (get_filters.rules !== undefined && get_filters.rules.length > 0) {

                var tempData = get_filters.rules;
                
                tempData.push( { "field":by,"op":"ge","data":startdate } );
                tempData.push( { "field":by,"op":"le","data":enddate } );
                
                string_filters = JSON.stringify(tempData);
                
                filters = '{"groupOp":"AND","rules":'+string_filters+'}';
            }
        }
        
//        jQuery("#lclInoutReportGrid").jqGrid('setGridParam',{url:"{{URL::to('/lcl/manifest/grid-data')}}?startdate="+startdate+"&enddate="+enddate+"&by="+by}).trigger("reloadGrid");
        jQuery("#lclInoutReportGrid").jqGrid("setGridParam", { postData: {filters} }).trigger("reloadGrid");
        
        return false;
    });
</script>

@endsection