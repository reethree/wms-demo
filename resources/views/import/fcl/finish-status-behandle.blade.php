@extends('layout')

@section('content')
<style>
    .bootstrap-timepicker-widget {
        left: 27%;
    }
</style>
<script>
    
    function gridCompleteEvent()
    {
        var ids = jQuery("#fclBehandleGrid").jqGrid('getDataIDs'),
            apv = '', chk = '', info = '', vi = '';   
            
        for(var i=0;i < ids.length;i++){ 
            var cl = ids[i];
            
            rowdata = $('#fclBehandleGrid').getRowData(cl); 

            
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
            
            if(rowdata.photo_behandle != ''){
                vi = '<button style="margin:5px;" class="btn btn-default btn-xs approve-manifest-btn" data-id="'+cl+'" onclick="viewPhoto('+cl+')"><i class="fa fa-photo"></i> View Photo</button>';
            }else{
                vi = '<button style="margin:5px;" class="btn btn-default btn-xs approve-manifest-btn" disabled><i class="fa fa-photo"></i> Not Found</button>';
            }

            jQuery("#fclBehandleGrid").jqGrid('setRowData',ids[i],{photo:vi});
            
        } 
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
                $('#container-photo').html('');
            },
            success:function(json)
            {
                var html_container = '';
                
                if(json.data.photo_behandle){
                    var photos_container = $.parseJSON(json.data.photo_behandle);
                    var html_container = '';
                    $.each(photos_container, function(i, item) {
                        /// do stuff
                        html_container += '<img src="{{url("uploads/photos/container/fcl")}}/'+json.data.NOCONTAINER+'/'+item+'" style="width: 200px;padding:5px;" />';

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
        <h3 class="box-title">FCL Status Behandle Finish</h3>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-12"> 
                {{
                    GridRender::setGridId("fclBehandleGrid")
                    ->enableFilterToolbar()
                    ->setGridOption('mtype', 'POST')
                    ->setGridOption('url', URL::to('/container/grid-data-cy?module=finish_behandle&_token='.csrf_token()))
//                    ->setGridOption('editurl',URL::to('/container/crud-cy/'))
                    ->setGridOption('rowNum', 100)
                    ->setGridOption('shrinkToFit', true)
                    ->setGridOption('sortname','TCONTAINER_PK')
                    ->setGridOption('rownumbers', true)
                    ->setGridOption('rownumWidth', 50)
                    ->setGridOption('height', '395')
                    ->setGridOption('rowList',array(100,200,300))
                    ->setGridOption('useColSpanStyle', true)
                    ->setNavigatorOptions('navigator', array('viewtext'=>'view'))
                    ->setNavigatorOptions('view',array('closeOnEscape'=>false))
                    ->setNavigatorOptions('navigator', array('add' => false, 'edit' => false, 'del' => false, 'view' => true, 'refresh' => false))
                    ->setFilterToolbarOptions(array('autosearch'=>true))
                    ->setGridEvent('gridComplete', 'gridCompleteEvent')
//                    ->setGridEvent('onSelectRow', 'onSelectRowEvent')
                    ->addColumn(array('key'=>true,'index'=>'TCONTAINER_PK','hidden'=>true))
                    ->addColumn(array('label'=>'Photo','index'=>'photo', 'width'=>120, 'search'=>false, 'sortable'=>false, 'align'=>'center'))
                    ->addColumn(array('label'=>'Status Behandle','index'=>'status_behandle','width'=>120, 'align'=>'center'))
                    ->addColumn(array('label'=>'No. SPJM','index'=>'NO_SPJM', 'width'=>120,'hidden'=>false))
                    ->addColumn(array('label'=>'Tgl. SPJM','index'=>'TGL_SPJM', 'width'=>150,'hidden'=>false))
                    ->addColumn(array('label'=>'No. Container','index'=>'NOCONTAINER','width'=>160,'editable' => true, 'editrules' => array('required' => true)))
                    ->addColumn(array('label'=>'Vessel','index'=>'VESSEL', 'width'=>150))
                    ->addColumn(array('label'=>'TPS Asal','index'=>'KD_TPS_ASAL', 'width'=>80,'align'=>'center'))
                    ->addColumn(array('label'=>'Consignee','index'=>'CONSIGNEE','width'=>160,'hidden'=>false))
                    ->addColumn(array('label'=>'No. BC11','index'=>'NO_BC11','width'=>150,'align'=>'right','hidden'=>false))
                    ->addColumn(array('label'=>'Tgl. BC11','index'=>'TGL_BC11','width'=>150,'align'=>'center','hidden'=>false))
                    ->addColumn(array('label'=>'No. POS BC11','index'=>'NO_POS_BC11','width'=>150,'align'=>'center','hidden'=>false))
                    ->addColumn(array('label'=>'No. PLP','index'=>'NO_PLP','width'=>150,'align'=>'right','hidden'=>false))
                    ->addColumn(array('label'=>'Tgl. PLP','index'=>'TGL_PLP','width'=>150,'align'=>'center','hidden'=>false))
                    ->addColumn(array('label'=>'Tgl. Masuk','index'=>'TGLMASUK','width'=>120,'align'=>'center'))
                    ->addColumn(array('label'=>'Jam Masuk','index'=>'JAMMASUK','width'=>120,'align'=>'center'))
                    ->addColumn(array('label'=>'Nama Dokumen','index'=>'KODE_DOKUMEN', 'width'=>120))
                    ->addColumn(array('label'=>'No. SPPB','index'=>'NO_SPPB', 'width'=>120,'align'=>'center'))
                    ->addColumn(array('label'=>'Tgl. SPPB','index'=>'TGL_SPPB', 'width'=>120,'align'=>'center'))
                    ->addColumn(array('label'=>'No. Pabean','index'=>'NO_DAFTAR_PABEAN','width'=>160))
                    ->addColumn(array('label'=>'Tgl. Pabean','index'=>'TGL_DAFTAR_PABEAN', 'width'=>150,'hidden'=>false, 'align'=>'center'))
                    ->addColumn(array('label'=>'Status BC','index'=>'status_bc', 'width'=>80,'align'=>'center'))
                    ->addColumn(array('label'=>'Tgl. Behandle','index'=>'TGLBEHANDLE','width'=>120,'align'=>'center'))
                    ->addColumn(array('label'=>'Jam. Behandle','index'=>'JAMBEHANDLE', 'width'=>120,'align'=>'center'))  
                    ->addColumn(array('label'=>'Segel Merah','index'=>'flag_bc', 'width'=>100,'align'=>'center'))
                    ->addColumn(array('label'=>'No. Segel','index'=>'no_flag_bc','width'=>100,'align'=>'center','hidden'=>false))
                    ->addColumn(array('label'=>'Alasan Segel','index'=>'alasan_segel','width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'Photo Behandle','index'=>'photo_behandle', 'width'=>70,'hidden'=>true))
                    ->addColumn(array('label'=>'UID','index'=>'UID', 'width'=>150,'align'=>'center', 'hidden'=>true))
                    ->addColumn(array('label'=>'Tgl. Entry','index'=>'TGLENTRY', 'width'=>150, 'search'=>false, 'hidden'=>true))
                    ->addColumn(array('label'=>'Jam. Entry','index'=>'JAMENTRY', 'width'=>150, 'search'=>false, 'hidden'=>true))
                    
                    
//                    ->addColumn(array('label'=>'No. SPK','index'=>'NoJob','width'=>160))
//                    ->addColumn(array('label'=>'Size','index'=>'SIZE', 'width'=>80,'align'=>'center','editable' => true, 'editrules' => array('required' => true,'number'=>true),'edittype'=>'select','editoptions'=>array('value'=>"20:20;40:40")))
//                    ->addColumn(array('label'=>'Callsign','index'=>'CALLSIGN', 'width'=>150,'align'=>'center'))
//                    ->addColumn(array('label'=>'Voy','index'=>'VOY','width'=>80,'align'=>'center'))
//                    ->addColumn(array('label'=>'ETA','index'=>'ETA', 'width'=>150,'align'=>'center'))
//                    ->addColumn(array('label'=>'No. MBL','index'=>'NOMBL','width'=>160,'hidden'=>true))
//                    ->addColumn(array('label'=>'Tgl. MBL','index'=>'TGLMBL','width'=>150,'align'=>'center','hidden'=>true))
//                    ->addColumn(array('label'=>'Consolidator','index'=>'NAMACONSOLIDATOR','width'=>250,'hidden'=>true))
//                    ->addColumn(array('label'=>'Importir','index'=>'NAMA_IMP','width'=>160,'hidden'=>true))
//                    ->addColumn(array('label'=>'NPWP Importir','index'=>'NPWP_IMP','width'=>160,'hidden'=>true))
//                    ->addColumn(array('label'=>'Teus','index'=>'TEUS', 'width'=>80,'align'=>'center','editable' => false,'hidden'=>true))
//                    ->addColumn(array('label'=>'No. Seal','index'=>'NOSEGEL', 'width'=>120,'editable' => true, 'align'=>'right','hidden'=>true))
//                    ->addColumn(array('label'=>'Weight','index'=>'WEIGHT', 'width'=>120,'editable' => true, 'align'=>'right','editrules' => array('required' => true),'hidden'=>true))
//                    ->addColumn(array('label'=>'Measurment','index'=>'MEAS', 'width'=>120,'editable' => true, 'align'=>'right','editrules' => array('required' => true),'hidden'=>true))
//                    ->addColumn(array('label'=>'Layout','index'=>'layout', 'width'=>80,'editable' => true,'align'=>'center','editoptions'=>array('defaultValue'=>"C-1"),'hidden'=>true))                   
//                    ->addColumn(array('label'=>'Updated','index'=>'last_update', 'width'=>150, 'search'=>false,'hidden'=>true))
                    ->renderGrid()
                }}
            
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
                        <h4>BEHANDLE</h4>
                        <div id="container-photo"></div>
                    </div>
                </div>
            </div>    
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection