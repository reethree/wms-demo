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
        var ids = jQuery("#fclSegelGrid").jqGrid('getDataIDs'),
            apv = '', sgl = '', info = '';   
            
        for(var i=0;i < ids.length;i++){ 
            var cl = ids[i];
            
            rowdata = $('#fclSegelGrid').getRowData(cl);  
            
            if(rowdata.no_flag_bc != ''){
                info = '<button style="margin:5px;" class="btn btn-default btn-xs info-segel-btn" data-id="'+cl+'" onclick="viewInfo('+cl+')"><i class="fa fa-info"></i> INFO</button>';
            }else{
                info = '';
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
            
            jQuery("#fclSegelGrid").jqGrid('setRowData',ids[i],{action:info});
            
        } 
    } 
    
    function viewInfo($containerID)
    {       
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
    
</script>
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">FCL Lists Container</h3>
    </div>
    <div class="box-body table-responsive">
        <div id="btn-toolbar" class="section-header btn-toolbar" role="toolbar" style="margin: 10px 0;"></div>
        {{
            GridRender::setGridId("fclSegelGrid")
            ->enableFilterToolbar()
            ->setGridOption('mtype', 'POST')
            ->setGridOption('url', URL::to('/container/grid-data-cy?module=segel_report&_token='.csrf_token()))
            ->setGridOption('rowNum', 20)
            ->setGridOption('shrinkToFit', true)
            ->setGridOption('sortname','timeSinceUpdate')
            ->setGridOption('sortorder','DESC')
            ->setGridOption('rownumbers', true)
            ->setGridOption('rownumWidth', 50)
            ->setGridOption('height', '395')
            ->setGridOption('rowList',array(20,50,100))
            ->setGridOption('useColSpanStyle', true)
            ->setNavigatorOptions('navigator', array('viewtext'=>'view'))
            ->setNavigatorOptions('view',array('closeOnEscape'=>false))
            ->setFilterToolbarOptions(array('autosearch'=>true))
//            ->setGridEvent('onSelectRow', 'onSelectRowEvent')
            ->setGridEvent('gridComplete', 'gridCompleteEvent')
            ->addColumn(array('key'=>true,'index'=>'TCONTAINER_PK','hidden'=>true))
            ->addColumn(array('label'=>'Action','index'=>'action', 'width'=>100, 'search'=>false, 'sortable'=>false, 'align'=>'center'))           
            ->addColumn(array('label'=>'Segel Merah','index'=>'flag_bc','width'=>100, 'align'=>'center'))
            ->addColumn(array('label'=>'Status BC','index'=>'status_bc','width'=>100, 'align'=>'center'))
            ->addColumn(array('label'=>'Nama Dokumen','index'=>'KODE_DOKUMEN', 'width'=>130))
            ->addColumn(array('label'=>'No. SPPB','index'=>'NO_SPPB', 'width'=>120,'align'=>'center'))
//            ->addColumn(array('label'=>'No. SPK','index'=>'NoJob', 'width'=>150))
            ->addColumn(array('label'=>'No. Container','index'=>'NOCONTAINER', 'width'=>150,'align'=>'center'))
            ->addColumn(array('label'=>'Size','index'=>'SIZE', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Nama Angkut','index'=>'VESSEL','width'=>160))  
            ->addColumn(array('label'=>'VOY','index'=>'VOY','width'=>100,'align'=>'center','hidden'=>false))
            ->addColumn(array('label'=>'Call Sign','index'=>'CALLSIGN','width'=>100,'align'=>'center','hidden'=>false))
            ->addColumn(array('label'=>'ETA','index'=>'ETA', 'width'=>120,'align'=>'center','hidden'=>false))
            ->addColumn(array('label'=>'TPS Asal','index'=>'KD_TPS_ASAL', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Consolidator','index'=>'NAMACONSOLIDATOR','width'=>250,'hidden'=>true))
            ->addColumn(array('label'=>'Consignee','index'=>'CONSIGNEE', 'width'=>250))
            ->addColumn(array('label'=>'No.PLP','index'=>'NO_PLP', 'width'=>120,'align'=>'center'))                
            ->addColumn(array('label'=>'Tgl.PLP','index'=>'TGL_PLP', 'width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'No.BC 1.1','index'=>'NO_BC11', 'width'=>150,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl.BC 1.1','index'=>'TGL_BC11', 'width'=>150,'align'=>'center'))
            ->addColumn(array('label'=>'No.POS BC11','index'=>'NO_POS_BC11', 'width'=>150,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl. Gate In','index'=>'TGLMASUK', 'width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'Jam. Gate In','index'=>'JAMMASUK', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'No.POL IN','index'=>'NOPOL', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'No. Segel','index'=>'no_flag_bc','width'=>200,'align'=>'center'))
            ->addColumn(array('label'=>'Alasan Segel','index'=>'alasan_segel','width'=>250,'align'=>'center'))
            ->addColumn(array('label'=>'No. Lepas Segel','index'=>'no_unflag_bc','width'=>200,'align'=>'center'))
            ->addColumn(array('label'=>'Alasan Lepas Segel','index'=>'alasan_lepas_segel','width'=>250,'align'=>'center'))
            ->addColumn(array('label'=>'Status Behandle','index'=>'status_behandle','width'=>120, 'align'=>'center'))
            ->addColumn(array('label'=>'Lama Timbun (Hari)','index'=>'timeSinceUpdate', 'width'=>150, 'search'=>false, 'align'=>'center'))
            ->renderGrid()
        }}
    </div>
</div>

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

@endsection

@section('custom_js')

@endsection