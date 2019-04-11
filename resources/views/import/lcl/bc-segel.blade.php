@extends('layout')

@section('content')
<script>
 
    function gridCompleteEvent()
    {
        
        var $grid = jQuery('#lclSegelGrid');
        var colweightSum = $grid.jqGrid('getCol', 'WEIGHT', false, 'sum');
        var colmeasSum = $grid.jqGrid('getCol', 'MEAS', false, 'sum');
        
//        $grid.jqGrid('footerData', 'set', { WEIGHT: precisionRound(colweightSum, 4) });
//        $grid.jqGrid('footerData', 'set', { MEAS: precisionRound(colmeasSum, 4) });
        
        var ids = jQuery("#lclSegelGrid").jqGrid('getDataIDs'),
            apv = '', sgl = '', info = '';   
            
        for(var i=0;i < ids.length;i++){ 
            var cl = ids[i];
            
            rowdata = $('#lclSegelGrid').getRowData(cl); 
            
            if(rowdata.flag_bc == 'Y') {
                sgl = '<button style="margin:5px;" class="btn btn-info btn-xs" data-id="'+cl+'" onclick="if (confirm(\'Apakah anda yakin ingin membuka Segel Merah ?\')){ changeStatusFlag('+cl+',\'unlock\'); }else{return false;};"><i class="fa fa-unlock"></i> UNLOCK</button>';
                apv = '';
            }else{
                sgl = '<button style="margin:5px;" class="btn btn-info btn-xs" data-id="'+cl+'" onclick="if (confirm(\'Apakah anda yakin ingin mengunci Segel Merah ?\')){ changeStatusFlag('+cl+',\'lock\'); }else{return false;};"><i class="fa fa-lock"></i> LOCK</button>';
            }
            
            if(rowdata.no_flag_bc != ''){
                info = '<button style="margin:5px;" class="btn btn-default btn-xs info-segel-btn" data-id="'+cl+'" onclick="viewInfo('+cl+')"><i class="fa fa-info"></i> INFO</button>';
            }else{
                info = '<button style="margin:5px;" class="btn btn-default btn-xs info-segel-btn" disabled><i class="fa fa-info"></i> INFO</button>';
            }
            
            if(rowdata.perubahan_hbl == 'Y') {
                $("#" + cl).find("td").css("background-color", "#3dc6f2");
            }
            
            if(rowdata.status_behandle == 'Ready') {
                $("#" + cl).find("td").css("background-color", "#aae25a");
            }
            if(rowdata.status_behandle == 'Checking') {
                $("#" + cl).find("td").css("background-color", "#f4dc27");
            }
            if(rowdata.status_behandle == 'Finish') {
                $("#" + cl).find("td").css("background-color", "#6acaf7");
            }
            
            if(rowdata.status_bc == 'HOLD') {
                $("#" + cl).find("td").css("background-color", "#ffe500");
            }
            
            if(rowdata.flag_bc == 'Y') {
                $("#" + cl).find("td").css("background-color", "#d73925").css("color", "#FFF");
            } 
            
            @if(Auth::getUser()->username == 'bcp2')  
                jQuery("#lclSegelGrid").jqGrid('setRowData',ids[i],{action:sgl+' '+info});        
            @else
                jQuery("#lclSegelGrid").jqGrid('setRowData',ids[i],{action:info}); 
            @endif
        } 
    
    }
    
    function changeStatusFlag($id,$action)
    {        
        if($action == 'lock'){
            $("#manifest_id").val($id);
            $('#lock-flag-modal').modal('show');
        }else{
            
            $("#manifest_unlock_id").val($id);
            $('#unlock-flag-modal').modal('show');
        }

    }
    
    function viewInfo(manifestID)
    {       
        $.ajax({
            type: 'GET',
            dataType : 'json',
            url: '{{route("lcl-view-info-flag","")}}/'+manifestID,
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
                                    html_lock += '<img src="{{url("uploads/photos/flag/lcl")}}/'+item+'" style="width: 200px;padding:5px;" />';
                                });
                            }
                        }else{
                            html_unlock += '<hr /><p>Nomor Segel : <b>'+segel.no_segel+'</b><br />Alasan Segel : <b>'+segel.alasan+'</b><br />Keterangan : <b>'+segel.keterangan+'</b><br />Date : <b>'+segel.created_at+'</b></p>';
                            if(segel.photo){
                                var photos_container = $.parseJSON(segel.photo);
                                $.each(photos_container, function(i, item) {
                                    /// do stuff
                                    html_unlock += '<img src="{{url("uploads/photos/unflag/lcl")}}/'+item+'" style="width: 200px;padding:5px;" />';
                                });
                            }
                        }
                    }
                }else{
                    var html_lock = '<p>Nomor Segel : <b>'+json.manifest.no_flag_bc+'</b><br />Alasan Segel : <b>'+json.manifest.alasan_segel+'</b><br />Keterangan : <b>'+json.manifest.description_flag_bc+'</b></p>';
                    var html_unlock = '<p>Nomor Lepas Segel : <b>'+json.manifest.no_unflag_bc+'</b><br />Alasan Lepas Segel : <b>'+json.manifest.alasan_lepas_segel+'</b><br />Keterangan : <b>'+json.manifest.description_unflag_bc+'</b></p>';

                    if(json.manifest.photo_lock){
                        var photos_container = $.parseJSON(json.manifest.photo_lock);
                        $.each(photos_container, function(i, item) {
                            /// do stuff
                            html_lock += '<img src="{{url("uploads/photos/flag/lcl")}}/'+item+'" style="width: 200px;padding:5px;" />';

                        });
                    }
                    if(json.manifest.photo_unlock){
                        var photos_container = $.parseJSON(json.manifest.photo_unlock);
                        $.each(photos_container, function(i, item) {
                            /// do stuff
                            html_unlock += '<img src="{{url("uploads/photos/unflag/lcl")}}/'+item+'" style="width: 200px;padding:5px;" />';

                        });
                    }
                }
                
                $('#lock-info').html(html_lock);
                $('#unlock-info').html(html_unlock);
                $('#nobl_info').html(json.NOHBL);
            }
        });
        
        $('#view-info-modal').modal('show');
    }
    
    function precisionRound(number, precision) {
        var factor = Math.pow(10, precision);
        return Math.round(number * factor) / factor;
    }
    
</script>
<style>
    .datepicker.dropdown-menu {
        z-index: 100 !important;
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
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">LCL Lists Manifest</h3>
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
                        <option value="ETA">ETA</option>
                        <option value="TGL_BC11">Tgl. BC11</option>
                        <option value="tglmasuk">Tgl. GateIn</option>
                        
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
        <div id="btn-toolbar" class="section-header btn-toolbar" role="toolbar" style="margin: 10px 0;"></div>
        {{
            GridRender::setGridId("lclSegelGrid")
            ->enableFilterToolbar()
            ->setGridOption('mtype', 'POST')
            ->setGridOption('url', URL::to('/lcl/manifest/grid-data?module=segel&_token='.csrf_token()))
            ->setGridOption('rowNum', 50)
            ->setGridOption('shrinkToFit', true)
            ->setGridOption('sortname','timeSinceUpdate')
            ->setGridOption('sortorder','DESC')
            ->setGridOption('rownumbers', true)
            ->setGridOption('rownumWidth', 50)
            ->setGridOption('height', '395')
            ->setGridOption('rowList',array(50,100,200,500))
            ->setGridOption('useColSpanStyle', true)
//            ->setGridOption('footerrow', true)
            ->setNavigatorOptions('navigator', array('viewtext'=>'view'))
            ->setNavigatorOptions('view',array('closeOnEscape'=>false))
            ->setFilterToolbarOptions(array('autosearch'=>true))
            ->setGridEvent('gridComplete', 'gridCompleteEvent')
//            ->setGridEvent('onSelectRow', 'onSelectRowEvent')
            ->addColumn(array('key'=>true,'index'=>'TMANIFEST_PK','hidden'=>true))
             ->addColumn(array('label'=>'Action','index'=>'action', 'width'=>155, 'search'=>false, 'sortable'=>false, 'align'=>'center'))
            ->addColumn(array('label'=>'Segel Merah','index'=>'flag_bc', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Status BC','index'=>'status_bc', 'width'=>80,'align'=>'center'))            
            ->addColumn(array('label'=>'Nama Dokumen','index'=>'KODE_DOKUMEN', 'width'=>130))
            ->addColumn(array('label'=>'No. SPPB','index'=>'NO_SPPB', 'width'=>120,'align'=>'center'))
//            ->addColumn(array('label'=>'No. SPK','index'=>'NOJOBORDER', 'width'=>150))
            ->addColumn(array('label'=>'No. HBL','index'=>'NOHBL','width'=>160))
            ->addColumn(array('label'=>'Tgl. HBL','index'=>'TGL_HBL', 'width'=>150,'align'=>'center'))
            ->addColumn(array('label'=>'No. Container','index'=>'NOCONTAINER', 'width'=>150,'align'=>'center'))
            ->addColumn(array('label'=>'Size','index'=>'SIZE', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Nama Angkut','index'=>'VESSEL','width'=>160))
            ->addColumn(array('label'=>'Call Sign','index'=>'CALL_SIGN','width'=>100,'align'=>'center','hidden'=>true))
            ->addColumn(array('label'=>'VOY','index'=>'VOY','width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'ETA','index'=>'ETA', 'width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'Consolidator','index'=>'NAMACONSOLIDATOR','width'=>300))
            ->addColumn(array('label'=>'No. MBL','index'=>'NOMBL','width'=>160))
            ->addColumn(array('label'=>'Tgl. MBL','index'=>'TGL_MASTER_BL', 'width'=>150,'hidden'=>false, 'align'=>'center'))
            ->addColumn(array('label'=>'Shipper','index'=>'SHIPPER','width'=>160,'hidden'=>true))
            ->addColumn(array('label'=>'Consignee','index'=>'CONSIGNEE', 'width'=>300))
            ->addColumn(array('label'=>'Desc of Goods','index'=>'DESCOFGOODS', 'width'=>300,'hidden'=>true))
            ->addColumn(array('label'=>'Qty','index'=>'QUANTITY', 'width'=>80,'align'=>'center'))
            ->addColumn(array('label'=>'Packing','index'=>'NAMAPACKING', 'width'=>120))
            ->addColumn(array('label'=>'Kode Kemas','index'=>'KODE_KEMAS', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Weight','index'=>'WEIGHT', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Meas','index'=>'MEAS', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'No.BC 1.1','index'=>'NO_BC11', 'width'=>150,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl.BC 1.1','index'=>'TGL_BC11', 'width'=>150,'align'=>'center'))
            ->addColumn(array('label'=>'No.POS BC11','index'=>'NO_POS_BC11', 'width'=>150,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl. Gate In','index'=>'tglmasuk', 'width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'Jam. Gate In','index'=>'jammasuk', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl. Stripping','index'=>'tglstripping', 'width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'Jam. Stripping','index'=>'jamstripping', 'width'=>100,'align'=>'center'))
            ->addColumn(array('index'=>'location_id', 'width'=>150,'hidden'=>true))
            ->addColumn(array('label'=>'Lokasi','index'=>'location_name','width'=>200, 'align'=>'center'))
            ->addColumn(array('label'=>'No. Segel','index'=>'no_flag_bc','width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Alasan Segel','index'=>'alasan_segel','width'=>150,'align'=>'center'))
            ->addColumn(array('label'=>'No. Lepas Segel','index'=>'no_unflag_bc','width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Alasan Lepas Segel','index'=>'alasan_lepas_segel','width'=>150,'align'=>'center'))
            ->addColumn(array('label'=>'Perubahan HBL','index'=>'perubahan_hbl','width'=>100, 'align'=>'center'))
            ->addColumn(array('label'=>'Alasan Perubahan','index'=>'alasan_perubahan','width'=>150,'align'=>'center'))
            ->addColumn(array('label'=>'Status Behandle','index'=>'status_behandle','width'=>120, 'align'=>'center'))
            ->addColumn(array('label'=>'Lama Timbun (Hari)','index'=>'timeSinceUpdate', 'width'=>150, 'search'=>false, 'align'=>'center'))
            ->renderGrid()
        }}
    </div>
</div>

<div id="lock-flag-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Silahkan pilih alasan segel</h4>
            </div>
            <form id="create-invoice-form" class="form-horizontal" action="{{ route('lcl-lock-flag') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-body"> 
                    <div class="row">
                        <div class="col-md-12">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                            <input name="id" type="hidden" id="manifest_id" />
                            <div class="form-group">
                                <label class="col-sm-3 control-label">No. Segel</label>
                                <div class="col-sm-8">
                                    <input type="text" id="no_flag_bc" name="no_flag_bc" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Alasan Segel</label>
                                <div class="col-sm-8">
                                    <select class="form-control select2" id="alasan_segel" name="alasan_segel" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                        <option value="Nota Hasil Intelijen (NHI)" selected>Nota Hasil Intelijen (NHI)</option>
                                        <option value="Surveilance P2">Surveilance P2</option>
                                        <option value="P2 Pusat">P2 Pusat</option>
                                        <option value="SPBL">SPBL</option>
                                        <option value="IKP / Temuan Lapangan">IKP / Temuan Lapangan</option>
                                        <option value="Eks. Pemeriksaan Fisik">Eks. Pemeriksaan Fisik</option>
                                        <option value="Hico Scan">Hico Scan</option>
                                        <option value="Eks. Ambil Contoh">Eks. Ambil Contoh</option>
                                        <option value="CNT">CNT</option>
                                        <option value="Penegahan">Penegahan</option>
                                        <option value="Nota Pemberitahuan Barang Lartas (PFPD)">Nota Pemberitahuan Barang Lartas (PFPD)</option>
                                        <option value="Selisih Bongkar">Selisih Bongkar</option>
                                        <option value="Seal Pelayaran Hilang">Seal Pelayaran Hilang</option>
                                        <option value="Stripping MMEA">Stripping MMEA</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Photo</label>
                                <div class="col-sm-8">
                                    <input type="file" name="photos_flag[]" class="form-control" multiple="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Keterangan</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="description_flag_bc"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary">Lock</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div id="unlock-flag-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Silahkan pilih alasan lepas segel</h4>
            </div>
            <form id="create-invoice-form" class="form-horizontal" action="{{ route('lcl-unlock-flag') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-body"> 
                    <div class="row">
                        <div class="col-md-12">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                            <input name="id" type="hidden" id="manifest_unlock_id" />
                            <div class="form-group">
                                <label class="col-sm-3 control-label">No. Segel</label>
                                <div class="col-sm-8">
                                    <input type="text" id="no_unflag_bc" name="no_unflag_bc" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Alasan Lepas Segel</label>
                                <div class="col-sm-8">
                                    <select class="form-control select2" id="alasan_lepas_segel" name="alasan_lepas_segel" style="width: 100%;" tabindex="-1" aria-hidden="true" required>                                        
                                        <option value="SPBL">SPPB</option>
                                        <option value="SPPBE">SPPBE</option>
                                        <option value="Re Ekspor">Re Ekspor</option>
                                        <option value="Pemusnahan">Pemusnahan</option>
                                        <option value="Lelang">Lelang</option>
                                        <option value="Serah Terima">Serah Terima</option>
                                        <option value="Surveilance">Surveilance</option>
                                        <option value="Selesai Hico">Selesai Hico</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Photo</label>
                                <div class="col-sm-8">
                                    <input type="file" name="photos_unflag[]" class="form-control" multiple="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Keterangan</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="description_unflag_bc"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary">Unlock</button>
                </div>
            </form>
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

        var current_filters = jQuery("#lclSegelGrid").getGridParam("postData").filters;
        
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
        
//        jQuery("#lclSegelGrid").jqGrid('setGridParam',{url:"{{URL::to('/lcl/manifest/grid-data')}}?startdate="+startdate+"&enddate="+enddate+"&by="+by}).trigger("reloadGrid");
        jQuery("#lclSegelGrid").jqGrid("setGridParam", { postData: {filters} }).trigger("reloadGrid");
        
        return false;
    });
</script>

@endsection