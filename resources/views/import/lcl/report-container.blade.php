@extends('layout')

@section('content')
<style>
    .datepicker.dropdown-menu {
        z-index: 100 !important;
    }
</style>
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Report Container LCL</h3>
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
                        <option value="TGLMASUK">Tgl. GateIn</option>
                        <option value="TGL_BC11">Tgl. BC1.1</option>                           
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
            GridRender::setGridId("lclContainerReportGrid")
            ->enableFilterToolbar()
            ->setGridOption('mtype', 'POST')
            ->setGridOption('url', URL::to('/container/grid-data?_token='.csrf_token()))
            ->setGridOption('rowNum', 20)
            ->setGridOption('shrinkToFit', true)
            ->setGridOption('sortname','TCONTAINER_PK')
            ->setGridOption('rownumbers', true)
            ->setGridOption('height', '320')
            ->setGridOption('rowList',array(20,50,100))
            ->setGridOption('useColSpanStyle', true)
            ->setNavigatorOptions('navigator', array('viewtext'=>'view'))
            ->setNavigatorOptions('view',array('closeOnEscape'=>false))
            ->setFilterToolbarOptions(array('autosearch'=>true))
//            ->setGridEvent('onSelectRow', 'onSelectRowEvent')
            ->addColumn(array('key'=>true,'index'=>'TCONTAINER_PK','hidden'=>true))
//            ->addColumn(array('label'=>'Status','index'=>'VALIDASI','width'=>80, 'align'=>'center'))
            ->addColumn(array('label'=>'No. Joborder','index'=>'NoJob', 'width'=>150))
            ->addColumn(array('label'=>'Nama Angkut','index'=>'VESSEL','width'=>160))
            ->addColumn(array('label'=>'VOY','index'=>'VOY','width'=>100,'align'=>'center','hidden'=>true))
            ->addColumn(array('label'=>'No. Container','index'=>'NOCONTAINER', 'width'=>150,'align'=>'center'))
            ->addColumn(array('label'=>'Size','index'=>'SIZE', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Teus','index'=>'TEUS', 'width'=>100,'align'=>'center','hidden'=>true))
            ->addColumn(array('label'=>'ETA','index'=>'ETA', 'width'=>120,'align'=>'center','hidden'=>true))
            ->addColumn(array('label'=>'TPS Asal','index'=>'KD_TPS_ASAL', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Consolidator','index'=>'NAMACONSOLIDATOR','width'=>250))

//            ->addColumn(array('label'=>'No. Tally','index'=>'NOTALLY','width'=>160))
//            ->addColumn(array('label'=>'Consignee','index'=>'CONSIGNEE', 'width'=>250))
//            ->addColumn(array('label'=>'Quantity','index'=>'QUANTITY', 'width'=>80,'align'=>'center'))
//            ->addColumn(array('label'=>'Packing','index'=>'NAMAPACKING', 'width'=>120,'align'=>'center'))
//            ->addColumn(array('label'=>'Kode Kemas','index'=>'KODE_KEMAS', 'width'=>100,'align'=>'center'))        
//            ->addColumn(array('label'=>'Weight','index'=>'WEIGHT', 'width'=>120,'align'=>'center'))               
//            ->addColumn(array('label'=>'Meas','index'=>'MEAS', 'width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'No.PLP','index'=>'NO_PLP', 'width'=>150,'align'=>'center'))                
            ->addColumn(array('label'=>'Tgl.PLP','index'=>'TGL_PLP', 'width'=>150,'align'=>'center'))
            ->addColumn(array('label'=>'No.BC 1.1','index'=>'NO_BC11', 'width'=>150,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl.BC 1.1','index'=>'TGL_BC11', 'width'=>150,'align'=>'center'))
            ->addColumn(array('label'=>'No.POS BC11','index'=>'NO_POS_BC11', 'width'=>150,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl. Gate In','index'=>'TGLMASUK', 'width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'Jam. Gate In','index'=>'JAMMASUK', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl. Stripping','index'=>'TGLSTRIPPING', 'width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'Jam. Stripping','index'=>'JAMSTRIPPING', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl. Buang MTY','index'=>'TGLBUANGMTY', 'width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'Jam. Buang MTY','index'=>'JAMBUANGMTY', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Tujuan MTY','index'=>'NAMADEPOMTY', 'width'=>200,'align'=>'left'))
//            ->addColumn(array('label'=>'Tgl. Release','index'=>'tglrelease', 'width'=>120,'align'=>'center'))
//            ->addColumn(array('label'=>'Jam. Release','index'=>'jamrelease', 'width'=>100,'align'=>'center'))
//            ->addColumn(array('label'=>'Kode Dokumen','index'=>'KODE_DOKUMEN', 'width'=>150))
//            ->addColumn(array('label'=>'No. SPPB','index'=>'NO_SPPB', 'width'=>150))
//            ->addColumn(array('label'=>'Tgl. SPPB','index'=>'TGL_SPPB', 'width'=>150))
//            ->addColumn(array('label'=>'No. SPJM','index'=>'NO_SPJM', 'width'=>150))
//            ->addColumn(array('label'=>'Tgl. SPJM','index'=>'TGL_SPJM', 'width'=>150))
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
            ->renderGrid()
        }}
    </div>
</div>

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Total Penarikan Bulanan</h3>
        <form action="{{ route('lcl-report-container') }}" method="GET">
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
                            <th>UKURAN</th>
                            <th>JML CONT (PLP)</th>
                            <th>JML CONT (GATEIN)</th>
                        </tr>
                        <tr>
                            <td align="center">20</td>
                            <td align="center">{{ $countbysize['twenty'] }}</td>
                            <td align="center">{{ $countbysizegatein['twenty'] }}</td>
                        </tr>
                        <tr>
                            <td align="center">40</td>
                            <td align="center">{{ $countbysize['fourty'] }}</td>
                            <td align="center">{{ $countbysizegatein['fourty'] }}</td>
                        </tr>
                        <tr>
                            <th>TOTAL</th>
                            <td align="center"><strong>{{ $countbysize['total'] }}</strong></td>
                            <td align="center"><strong>{{ $countbysizegatein['total'] }}</strong></td>
                        </tr>
                        <tr>
                            <th>TEUS</th>
                            <td align="center"><strong>{{ $countbysize['teus'] }}</strong></td>
                            <td align="center"><strong>{{ $countbysizegatein['teus'] }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-sm-4">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>TPS ASAL</th>
                            <th>JML CONT (PLP)</th>
                            <th>JML CONT (GATEIN)</th>
                        </tr>
                        @foreach($countbytps as $key=>$value)
                        <tr>
                            <td>{{ $key }}</td>
                            <td align="center">{{ $value[0] }}</td>
                            <td align="center">{{ $value[1] }}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <th>TOTAL</th>
                            <td align="center"><strong>{{ $totcounttpsp }}</strong></td>
                            <td align="center"><strong>{{ $totcounttpsg }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-sm-4">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>CONSOLIDATOR</th>
                            <th>JML CONT (PLP)</th>
                            <th>JML CONT (GATEIN)</th>
                        </tr>
                        @foreach($countbyconsolidator as $key=>$value)
                        <tr>
                            <td>{{ $key }}</td>
                            <td align="center">{{ $value[0] }}</td>
                            <td align="center">{{ $value[1] }}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <th>TOTAL</th>
                            <td align="center"><strong>{{ $totcountconsolidatorp }}</strong></td>
                            <td align="center"><strong>{{ $totcountconsolidatorg }}</strong></td>
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

        var current_filters = jQuery("#lclContainerReportGrid").getGridParam("postData").filters;
        
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

        jQuery("#lclContainerReportGrid").jqGrid("setGridParam", { postData: {filters} }).trigger("reloadGrid");
        
        return false;
    });
</script>

@endsection