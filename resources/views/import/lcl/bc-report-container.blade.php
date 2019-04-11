@extends('layout')

@section('content')
<style>
    .datepicker.dropdown-menu {
        z-index: 100 !important;
    }
</style>
<script>
    function gridCompleteEvent(){
        var ids = jQuery("#lclContainerReportGrid").jqGrid('getDataIDs'),
            vi = '';   
            
        for(var i=0;i < ids.length;i++){ 
            var cl = ids[i];
            
            rowdata = $('#lclContainerReportGrid').getRowData(cl);
            
            if(rowdata.photo_get_in != '' || rowdata.photo_get_out != '' || rowdata.photo_gatein_extra != ''){
                vi = '<button style="margin:5px;" class="btn btn-default btn-xs approve-manifest-btn" data-id="'+cl+'" onclick="viewPhoto('+cl+')"><i class="fa fa-photo"></i> View Photo</button>';
            }else{
                vi = '<button style="margin:5px;" class="btn btn-default btn-xs approve-manifest-btn" disabled><i class="fa fa-photo"></i> Not Found</button>';
            }
            
            jQuery("#lclContainerReportGrid").jqGrid('setRowData',ids[i],{action:vi}); 
        } 
    }
    
    function viewPhoto(containerID)
    {       
        $.ajax({
            type: 'GET',
            dataType : 'json',
            url: '{{route("lcl-report-container-view-photo","")}}/'+containerID,
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Something went wrong, please try again later.');
            },
            beforeSend:function()
            {
                $('#gateout-photo').html('');
                $('#gatein-photo').html('');
                $('#container-photo').html('');
            },
            success:function(json)
            {
                var html_in = '';
                var html_out = '';
                var html_container = '';
                
                if(json.data.photo_get_in){
                    html_in += '<img src="{{url("uploads/photos/autogate")}}/'+json.data.photo_get_in+'" style="width: 200px;padding:5px;" />';
                }
                $('#gatein-photo').html(html_in);
                if(json.data.photo_empty_in){
                    html_out += '<img src="{{url("uploads/photos/autogate")}}/'+json.data.photo_empty_in+'" style="width: 200px;padding:5px;" />';
                }
                $('#gateout-photo').html(html_out);
                
                if(json.data.photo_gatein_extra){
                    var photos_container = $.parseJSON(json.data.photo_gatein_extra);
                    var html_container = '';
                    $.each(photos_container, function(i, item) {
                        /// do stuff
                        html_container += '<img src="{{url("uploads/photos/container/lcl")}}/'+json.data.NOCONTAINER+'/'+item+'" style="width: 200px;padding:5px;" />';

                    });
                    $('#container-photo').html(html_container);
                }
                
                $("#title-photo").html('PHOTO CONTAINER NO. '+json.data.NOCONTAINER);
            }
        });
        
        $('#view-photo-modal').modal('show');
    }
</script>
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
            ->setGridOption('rownumWidth', 50)
            ->setGridOption('height', '320')
            ->setGridOption('rowList',array(20,50,100))
            ->setGridOption('useColSpanStyle', true)
            ->setNavigatorOptions('navigator', array('viewtext'=>'view'))
            ->setNavigatorOptions('view',array('closeOnEscape'=>false))
            ->setFilterToolbarOptions(array('autosearch'=>true))
            ->setGridEvent('gridComplete', 'gridCompleteEvent')
//            ->setGridEvent('onSelectRow', 'onSelectRowEvent')
            ->addColumn(array('key'=>true,'index'=>'TCONTAINER_PK','hidden'=>true))
            ->addColumn(array('label'=>'Action','index'=>'action', 'width'=>120, 'search'=>false, 'sortable'=>false, 'align'=>'center'))
//            ->addColumn(array('label'=>'No. Job Order','index'=>'NoJob', 'width'=>150))
            ->addColumn(array('label'=>'No. Container','index'=>'NOCONTAINER', 'width'=>150,'align'=>'center'))
            ->addColumn(array('label'=>'Size','index'=>'SIZE', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'ETA','index'=>'ETA', 'width'=>120,'align'=>'center','hidden'=>false))
            ->addColumn(array('label'=>'Nama Angkut','index'=>'VESSEL','width'=>160))
            ->addColumn(array('label'=>'VOY','index'=>'VOY','width'=>100,'align'=>'center','hidden'=>false))
            ->addColumn(array('label'=>'Call Sign','index'=>'CALL_SIGN','width'=>100,'align'=>'center','hidden'=>false))
            ->addColumn(array('label'=>'TPS Asal','index'=>'KD_TPS_ASAL', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'No. MBL','index'=>'NOMBL','width'=>160))
            ->addColumn(array('label'=>'Tgl. MBL','index'=>'TGL_MASTER_BL', 'width'=>150,'hidden'=>false, 'align'=>'center'))
            ->addColumn(array('label'=>'Consolidator','index'=>'NAMACONSOLIDATOR','width'=>250))
            ->addColumn(array('label'=>'No.PLP','index'=>'NO_PLP', 'width'=>120,'align'=>'center'))                
            ->addColumn(array('label'=>'Tgl.PLP','index'=>'TGL_PLP', 'width'=>150,'align'=>'center'))
            ->addColumn(array('label'=>'No.BC 1.1','index'=>'NO_BC11', 'width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl.BC 1.1','index'=>'TGL_BC11', 'width'=>150,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl. Gate In','index'=>'TGLMASUK', 'width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'Jam. Gate In','index'=>'JAMMASUK', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'No. POL In','index'=>'NOPOL', 'width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl. Stripping','index'=>'TGLSTRIPPING', 'width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'Jam. Stripping','index'=>'JAMSTRIPPING', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl. MTY','index'=>'TGLBUANGMTY', 'width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'Jam. MTY','index'=>'JAMBUANGMTY', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Tujuan MTY','index'=>'NAMADEPOMTY', 'width'=>200,'align'=>'left'))
            ->addColumn(array('label'=>'No. POL MTY','index'=>'NOPOL_MTY', 'width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'Photo Gate In','index'=>'photo_get_in', 'width'=>70,'hidden'=>true))
            ->addColumn(array('label'=>'Photo Gate Out','index'=>'photo_get_out', 'width'=>70,'hidden'=>true))
            ->addColumn(array('label'=>'Photo Empty In','index'=>'photo_empty_in', 'width'=>70,'hidden'=>true))
            ->addColumn(array('label'=>'Photo Empty Out','index'=>'photo_empty_out', 'width'=>70,'hidden'=>true))
            ->addColumn(array('label'=>'Photo Extra','index'=>'photo_gatein_extra', 'width'=>70,'hidden'=>true))
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
                        <option value="2018" @if($year == '2018') {{ 'selected' }} @endif>2018</option>
                        <option value="2019" @if($year == '2019') {{ 'selected' }} @endif>2019</option>
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

<div id="view-photo-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="title-photo">Photo</h4>
            </div>
            <div class="modal-body"> 
                <div class="row">
                    <div class="col-md-12">
                        <h4>IN CONTAINER</h4>
                        <div id="gatein-photo"></div>
                        <hr />
                        <h4>OUT CONTAINER</h4>
                        <div id="gateout-photo"></div>
                        <hr />
                        <h4>CONTAINER</h4>
                        <div id="container-photo"></div>
                    </div>
                </div>
            </div>    
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

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