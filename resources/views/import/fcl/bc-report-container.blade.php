@extends('layout')

@section('content')
<style>
    .datepicker.dropdown-menu {
        z-index: 9999 !important;
    }
    th.ui-th-column div{
        white-space:normal !important;
        height:auto !important;
        padding:2px;
    }
</style>
<script>
    
    function gridCompleteEvent()
    {
        var ids = jQuery("#fclContainerReportGrid").jqGrid('getDataIDs'),
            lt = '',
            vi = '',
            info = '';   
            
        for(var i=0;i < ids.length;i++){ 
            var cl = ids[i];
            
            rowdata = $('#fclContainerReportGrid').getRowData(cl);
            
            if(rowdata.TGLMASUK && rowdata.TGLRELEASE == ''){
                lt = jQuery.timeago(rowdata.TGLMASUK+' '+rowdata.JAMMASUK);
            }else if(rowdata.TGLMASUK == ''){
                lt = 'Belum GateIn';
            }else{
                lt = 'Sudah Release';
            }
            
            if(rowdata.photo_get_in != '' || rowdata.photo_get_out != '' || rowdata.photo_gatein_extra != ''){
                vi = '<button style="margin:5px;" class="btn btn-default btn-xs approve-manifest-btn" data-id="'+cl+'" onclick="viewPhoto('+cl+')"><i class="fa fa-photo"></i> View Photo</button>';
            }else{
                vi = '<button style="margin:5px;" class="btn btn-default btn-xs approve-manifest-btn" disabled><i class="fa fa-photo"></i> Not Found</button>';
            }
            if(rowdata.no_flag_bc != ''){
                info = '<button style="margin:5px;" class="btn btn-danger btn-xs info-segel-btn" data-id="'+cl+'" onclick="viewInfo('+cl+')"><i class="fa fa-info"></i> Info Segel</button>';
            }else{
                info = '';
            }
            
            jQuery("#fclContainerReportGrid").jqGrid('setRowData',ids[i],{action:vi+''+info,lamaTimbun:lt}); 
        } 
    }
    
    function viewInfo($containerID) {      
        $.ajax({
            type: 'GET',
            dataType : 'json',
            url: '{{route("fcl-view-info-flag","")}}/'+$containerID,
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Something went wrong, please try again later.');
            },
            beforeSend:function()
            {
                $('#lock-info').html('');
                $('#unlock-info').html('');
            },
            success:function(json)
            {
                var data_segel = json.data;
                var html_lock = '';
                var html_unlock = '';
                
                if(data_segel.length > 0){
                    for(var i = 0; i < data_segel.length; i++) {
                        var segel = data_segel[i];

                        if(segel.action == 'lock'){
                            html_lock += '<hr /><p>Nomor Segel : <b>'+segel.no_segel+'</b><br />Alasan Segel : <b>'+segel.alasan+'</b><br />Keterangan : <b>'+segel.keterangan+'</b><br />Date : <b>'+segel.created_at+'</b></p>';
                            if(segel.photo){
                                var photos_container = $.parseJSON(segel.photo);
                                $.each(photos_container, function(i, item) {
                                    /// do stuff
                                    html_lock += '<img src="{{url("uploads/photos/flag/fcl")}}/'+item+'" style="width: 200px;padding:5px;" />';
                                });
                            }
                        }else{
                            html_unlock += '<hr /><p>Nomor Segel : <b>'+segel.no_segel+'</b><br />Alasan Segel : <b>'+segel.alasan+'</b><br />Keterangan : <b>'+segel.keterangan+'</b><br />Date : <b>'+segel.created_at+'</b></p>';
                            if(segel.photo){
                                var photos_container = $.parseJSON(segel.photo);
                                $.each(photos_container, function(i, item) {
                                    /// do stuff
                                    html_unlock += '<img src="{{url("uploads/photos/unflag/fcl")}}/'+item+'" style="width: 200px;padding:5px;" />';
                                });
                            }
                        }
                    }
                }else{
                    var html_lock = '<p>Nomor Segel : <b>'+json.container.no_flag_bc+'</b><br />Alasan Segel : <b>'+json.container.alasan_segel+'</b><br />Keterangan : <b>'+json.container.description_flag_bc+'</b></p>';
                    var html_unlock = '<p>Nomor Lepas Segel : <b>'+json.container.no_unflag_bc+'</b><br />Alasan Lepas Segel : <b>'+json.container.alasan_lepas_segel+'</b><br />Keterangan : <b>'+json.container.description_unflag_bc+'</b></p>';

                    if(json.container.photo_lock){
                        var photos_container = $.parseJSON(json.container.photo_lock);
                        $.each(photos_container, function(i, item) {
                            /// do stuff
                            html_lock += '<img src="{{url("uploads/photos/flag/fcl")}}/'+item+'" style="width: 200px;padding:5px;" />';

                        });
                    }
                    if(json.container.photo_unlock){
                        var photos_container = $.parseJSON(json.container.photo_unlock);
                        $.each(photos_container, function(i, item) {
                            /// do stuff
                            html_unlock += '<img src="{{url("uploads/photos/unflag/fcl")}}/'+item+'" style="width: 200px;padding:5px;" />';

                        });
                    }
                }
                
                $('#lock-info').html(html_lock);
                $('#unlock-info').html(html_unlock);
                $('#nobl_info').html(json.NOCONTAINER);
            }
        });
        
        $('#view-info-modal').modal('show');
    }
    
    function viewPhoto(containerID)
    {       
        $.ajax({
            type: 'GET',
            dataType : 'json',
            url: '{{route("fcl-report-rekap-view-photo","")}}/'+containerID,
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Something went wrong, please try again later.');
            },
            beforeSend:function()
            {
                $('#gatein-photo').html('');
                $('#gateout-photo').html('');
                $('#container-photo').html('');
            },
            success:function(json)
            {
                var html_in = '';
                var html_out = '';
                var html_container = '';
                var html_out_container = '';
                
                if(json.data.photo_get_in){
                    html_in += '<img src="{{url("uploads/photos/autogate")}}/'+json.data.photo_get_in.replace("C2", "C1")+'" style="width: 200px;padding:5px;" />';
                    html_in += '<img src="{{url("uploads/photos/autogate")}}/'+json.data.photo_get_in+'" style="width: 200px;padding:5px;" />';
                }
                $('#gatein-photo').html(html_in);
                if(json.data.photo_release_in){
                    html_out += '<img src="{{url("uploads/photos/autogate")}}/'+json.data.photo_release_in.replace("C2", "C1")+'" style="width: 200px;padding:5px;" />';
                    html_out += '<img src="{{url("uploads/photos/autogate")}}/'+json.data.photo_release_in+'" style="width: 200px;padding:5px;" />';
                }
                if(json.data.photo_release_out){
                    html_out += '<img src="{{url("uploads/photos/autogate")}}/'+json.data.photo_release_out.replace("C2", "C1")+'" style="width: 200px;padding:5px;" />';
                    html_out += '<img src="{{url("uploads/photos/autogate")}}/'+json.data.photo_release_out+'" style="width: 200px;padding:5px;" />';
                }
                $('#gateout-photo').html(html_out);
                
                if(json.data.photo_gatein_extra){
                    var photos_container = $.parseJSON(json.data.photo_gatein_extra);
                    var html_container = '';
                    $.each(photos_container, function(i, item) {
                        /// do stuff
                        html_container += '<img src="{{url("uploads/photos/container/fcl")}}/'+json.data.NOCONTAINER+'/'+item+'" style="width: 200px;padding:5px;" />';

                    });
                    $('#in-container-photo').html(html_container);
                }
                if(json.data.photo_release_extra){
                    var photos_out_container = $.parseJSON(json.data.photo_release_extra);
                    var html_out_container = '';
                    $.each(photos_out_container, function(i, item) {
                        /// do stuff
                        html_out_container += '<img src="{{url("uploads/photos/container/fcl")}}/'+json.data.NOCONTAINER+'/'+item+'" style="width: 200px;padding:5px;" />';

                    });
                    $('#out-container-photo').html(html_out_container);
                }
                
                $("#title-photo").html('PHOTO CONTAINER NO. '+json.data.NOCONTAINER);
            }
        });
        
        $('#view-photo-modal').modal('show');
    }
    
</script>
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Report Container FCL</h3>
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
                        <option value="TGLRELEASE">Tgl. Release</option>
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
            GridRender::setGridId("fclContainerReportGrid")
            ->enableFilterToolbar()
            ->setGridOption('mtype', 'POST')
            ->setGridOption('url', URL::to('/container/grid-data-cy?report=1&_token='.csrf_token()))
            ->setGridOption('rowNum', 20)
            ->setGridOption('shrinkToFit', true)
            ->setGridOption('sortname','TCONTAINER_PK')
            ->setGridOption('rownumbers', true)
            ->setGridOption('rownumWidth', 50)
            ->setGridOption('height', '320')
//            ->setGridOption('multiselect', true)
            ->setGridOption('rowList',array(20,50,100))
            ->setGridOption('useColSpanStyle', true)
            ->setNavigatorOptions('navigator', array('viewtext'=>'view'))
            ->setNavigatorOptions('view',array('closeOnEscape'=>false))
            ->setFilterToolbarOptions(array('autosearch'=>true))
//            ->setGridEvent('onSelectRow', 'onSelectRowEvent')
            ->setGridEvent('gridComplete', 'gridCompleteEvent')
            ->addColumn(array('key'=>true,'index'=>'TCONTAINER_PK','hidden'=>true))
            ->addColumn(array('label'=>'Action','index'=>'action', 'width'=>120, 'search'=>false, 'sortable'=>false, 'align'=>'center'))
            ->addColumn(array('label'=>'No. Container','index'=>'NOCONTAINER', 'width'=>150,'align'=>'center'))
            ->addColumn(array('label'=>'Size','index'=>'SIZE', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'ETA','index'=>'ETA', 'width'=>120,'align'=>'center','hidden'=>false))
            ->addColumn(array('label'=>'Nama Angkut','index'=>'VESSEL','width'=>160))  
            ->addColumn(array('label'=>'VOY','index'=>'VOY','width'=>100,'align'=>'center','hidden'=>false))
            ->addColumn(array('index'=>'TSHIPPINGLINE_FK','width'=>200,'hidden'=>true))
            ->addColumn(array('label'=>'Shipping Line','index'=>'SHIPPINGLINE','width'=>150,'align'=>'center'))
            ->addColumn(array('label'=>'TPS Asal','index'=>'KD_TPS_ASAL', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Consignee','index'=>'CONSIGNEE', 'width'=>250))   
            ->addColumn(array('label'=>'No.PLP','index'=>'NO_PLP', 'width'=>120,'align'=>'center'))                
            ->addColumn(array('label'=>'Tgl.PLP','index'=>'TGL_PLP', 'width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'No.BC 1.1','index'=>'NO_BC11', 'width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl.BC 1.1','index'=>'TGL_BC11', 'width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'No.POS BC11','index'=>'NO_POS_BC11', 'width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl. Gate In','index'=>'TGLMASUK', 'width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'Jam. Gate In','index'=>'JAMMASUK', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'No.POL IN','index'=>'NOPOL', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl. Release','index'=>'TGLRELEASE', 'width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'Jam. Release','index'=>'JAMRELEASE', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'No.POL OUT','index'=>'NOPOL_OUT', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Kode Dokumen','index'=>'KD_DOK_INOUT', 'width'=>120,'align'=>'center','hidden'=>true))
            ->addColumn(array('label'=>'Nama Dokumen','index'=>'KODE_DOKUMEN', 'width'=>120))
            ->addColumn(array('label'=>'No. SPPB','index'=>'NO_SPPB', 'width'=>160,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl. SPPB','index'=>'TGL_SPPB', 'width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'No. Pabean','index'=>'NO_DAFTAR_PABEAN', 'width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl. Pabean','index'=>'TGL_DAFTAR_PABEAN', 'width'=>120,'align'=>'center'))       
            ->addColumn(array('label'=>'No. Segel','index'=>'no_flag_bc','width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Alasan Segel','index'=>'alasan_segel','width'=>150,'align'=>'center'))
            ->addColumn(array('label'=>'No. Lepas Segel','index'=>'no_unflag_bc','width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Alasan Lepas Segel','index'=>'alasan_lepas_segel','width'=>150,'align'=>'center'))
            ->addColumn(array('index'=>'location_id', 'width'=>150,'hidden'=>true))
            ->addColumn(array('label'=>'Lokasi','index'=>'location_name','width'=>200, 'align'=>'center'))
            ->addColumn(array('label'=>'Lama Timbun (Hari)','index'=>'timeSinceUpdate', 'width'=>150, 'search'=>false, 'align'=>'center'))
            ->addColumn(array('label'=>'Photo Gate In','index'=>'photo_get_in', 'width'=>70,'hidden'=>true))
            ->addColumn(array('label'=>'Photo Gate Out','index'=>'photo_get_out', 'width'=>70,'hidden'=>true))
            ->addColumn(array('label'=>'Photo Release In','index'=>'photo_release_in', 'width'=>70,'hidden'=>true))
            ->addColumn(array('label'=>'Photo Release Out','index'=>'photo_release_out', 'width'=>70,'hidden'=>true))
            ->addColumn(array('label'=>'Photo Extra','index'=>'photo_gatein_extra', 'width'=>70,'hidden'=>true))
            ->renderGrid()
        }}
    </div>
</div>

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Laporan Total Penarikan</h3>
        <form action="{{ route('fcl-bc-report-container') }}" method="GET">
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
                        <option value="2020" @if($year == '2020') {{ 'selected' }} @endif>2020</option>
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
                    <tbody><tr>
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
        <h3 class="box-title">Report YOR ({{ date('d F Y') }})</h3>
    </div>
    <div class="box-body table-responsive">
        <div class="row" style="margin-bottom: 30px;margin-right: 0;">
            <div class="col-sm-4">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>KAPASITAS TERISI</th>
                            <td align="right">{{ number_format($yor->kapasitas_terisi,'2','.',',') }} TEUS</td>
                        </tr>
                        <tr>
                            <th>KAPASITAS LAPANGAN</th>
                            <td align="right">{{ number_format($yor->kapasitas_default,'2','.',',') }} TEUS</td>
                        </tr>
                        <tr>
                            <th>KAPASITAS KOSONG</th>
                            <td align="right">{{ number_format($yor->kapasitas_kosong,'2','.',',') }} TEUS</td>
                        </tr>
                        <tr>
                            <th>YOR (%)</th>
                            <td align="right">{{ number_format($yor->total,'2','.',',') }} %</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="create-report-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Please Choose Report Date</h4>
            </div>
            <form id="create-invoice-form" class="form-horizontal" action="{{ route("fcl-report-rekap-sendemail") }}" method="POST" enctype="multipart/form-data">
                <div class="modal-body"> 
                    <div class="row">
                        <div class="col-md-12">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                            <input name="id" type="hidden" id="container_id_selected" />
                            <input name="shippingline_id" type="hidden" id="shippingline_id" />
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Subject Email</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="subject" value="Data GATE OUT FCL Tanggal {{date('d F Y', strtotime("-1 Day"))}}" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Tgl. Laporan</label>
                                <div class="col-sm-8">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" name="tgl_laporan" class="form-control pull-right datepicker" value="{{date('Y-m-d')}}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary">Send Report</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="create-billing-report-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Please Insert Amount</h4>
            </div>
            <form class="form-horizontal" action="{{ route("fcl-report-rekap-sendbilling") }}" method="POST" enctype="multipart/form-data">
                <div class="modal-body"> 
                    <div class="row">
                        <div class="col-md-12">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                            <input name="id" type="hidden" id="billing_container_id_selected" />
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Subject Email</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="subject" value="Data BILLING REPORT FCL Tanggal {{date('d F Y', strtotime("-1 Day"))}}" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Tgl. Laporan</label>
                                <div class="col-sm-8">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" name="tgl_laporan" class="form-control pull-right datepicker" value="{{date('Y-m-d', strtotime("-1 Day"))}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Total Amount</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" name="amount" required />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary">Send Report</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
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
                        <h4>GATE IN CONTAINER</h4>
                        <div id="gatein-photo"></div>
                        <hr />
                        <h4>GATE OUT CONTAINER</h4>
                        <div id="gateout-photo"></div>
                        <hr />
                        <h4>IN CONTAINER</h4>
                        <div id="in-container-photo"></div>
                        <hr />
                        <h4>OUT CONTAINER</h4>
                        <div id="out-container-photo"></div>
                    </div>
                </div>
            </div>    
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div id="view-info-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Informasi Segel (<span id='nobl_info'></span>)</h4>
            </div>
            <div class="modal-body"> 
                <div class="row">
                    <div class="col-md-12">
                        <h4><b>Segel (Lock)</b></h4>
                        <div id="lock-info"></div>
                        <hr />
                        <h4><b>Lepas Segel (Unlock)</b></h4>
                        <div id="unlock-info"></div>
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

        var current_filters = jQuery("#fclContainerReportGrid").getGridParam("postData").filters;
        
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

        jQuery("#fclContainerReportGrid").jqGrid("setGridParam", { postData: {filters} }).trigger("reloadGrid");
        
        return false;
    });
</script>

@endsection