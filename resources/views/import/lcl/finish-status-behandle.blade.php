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
        var ids = jQuery("#lclBehandleGrid").jqGrid('getDataIDs'),
            apv = '', chk = '', info = '', vi = '';   
            
        for(var i=0;i < ids.length;i++){ 
            var cl = ids[i];
            
            rowdata = $('#lclBehandleGrid').getRowData(cl);  
            
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
            
            jQuery("#lclBehandleGrid").jqGrid('setRowData',ids[i],{photo:vi});
            
        } 
    }
    
    function viewPhoto(manifestID)
    {
//        alert(manifestID);
        
        $.ajax({
            type: 'GET',
            dataType : 'json',
            url: '{{route("lcl-report-inout-view-photo","")}}/'+manifestID,
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Something went wrong, please try again later.');
            },
            beforeSend:function()
            {
                $('#gatein-photo').html('');
                $('#container-photo').html('');
                $('#stripping-photo').html('');
                $('#gateout-photo').html('');
                $('#release-photo').html('');
            },
            success:function(json)
            {
                if(json.data.photo_behandle){
                    var photos_release = $.parseJSON(json.data.photo_behandle);
                    var html_behandle = '';
                    $.each(photos_release, function(i, item) {
                        /// do stuff
                        html_behandle += '<img src="{{url("uploads/photos/manifest")}}/'+item+'" style="width: 200px;padding:5px;" />';
                    });
                    $('#manifest-photo').html(html_behandle);
                }
                
                
                $("#title-photo").html('PHOTO HBL NO. '+json.data.NOHBL);
            }
        });
        
        $('#view-photo-modal').modal('show');
    }
    
</script>
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">LCL Status Behandle Finish</h3>
<!--        <div class="box-tools">
            <a href="{{ route('lcl-manifest-create') }}" type="button" class="btn btn-block btn-info btn-sm"><i class="fa fa-plus"></i> Add New</a>
        </div>-->
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-12"> 
                {{
                    GridRender::setGridId("lclBehandleGrid")
                    ->enableFilterToolbar()
                    ->setGridOption('mtype', 'POST')
                    ->setGridOption('url', URL::to('/lcl/manifest/grid-data?module=finish_behandle&_token='.csrf_token()))
                    ->setGridOption('rowNum', 100)
                    ->setGridOption('shrinkToFit', true)
                    ->setGridOption('sortname','TMANIFEST_PK')
                    ->setGridOption('rownumbers', true)
                    ->setGridOption('rownumWidth', 50)
                    ->setGridOption('height', '395')
                    ->setGridOption('rowList',array(100,200,300))
                    ->setGridOption('useColSpanStyle', true)
                    ->setNavigatorOptions('navigator', array('viewtext'=>'view'))
                    ->setNavigatorOptions('view',array('closeOnEscape'=>false))
                    ->setFilterToolbarOptions(array('autosearch'=>true))
                    ->setGridEvent('gridComplete', 'gridCompleteEvent')
//                    ->setGridEvent('onSelectRow', 'onSelectRowEvent')
                    ->addColumn(array('key'=>true,'index'=>'TMANIFEST_PK','hidden'=>true))
                    ->addColumn(array('label'=>'Photo','index'=>'photo', 'width'=>120, 'search'=>false, 'sortable'=>false, 'align'=>'center'))
                    ->addColumn(array('label'=>'Status Behandle','index'=>'status_behandle','width'=>120, 'align'=>'center'))
                    ->addColumn(array('label'=>'No. SPJM','index'=>'NO_SPJM', 'width'=>120, 'align'=>'center','hidden'=>false))
                    ->addColumn(array('label'=>'Tgl. SPJM','index'=>'TGL_SPJM', 'width'=>150, 'align'=>'center','hidden'=>false))
                    ->addColumn(array('label'=>'No. HBL','index'=>'NOHBL','width'=>160))
                    ->addColumn(array('label'=>'Tgl. HBL','index'=>'TGL_HBL', 'width'=>150,'hidden'=>false, 'align'=>'center'))
                    ->addColumn(array('label'=>'Qty','index'=>'QUANTITY', 'width'=>80,'align'=>'center'))
                    ->addColumn(array('label'=>'Packing','index'=>'NAMAPACKING', 'width'=>120,'align'=>'center'))
                    ->addColumn(array('label'=>'Kode Kemas','index'=>'KODE_KEMAS', 'width'=>100,'align'=>'center'))
                    ->addColumn(array('index'=>'location_id', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('label'=>'Lokasi','index'=>'location_name','width'=>200, 'align'=>'center'))
                    ->addColumn(array('label'=>'No. Container','index'=>'NOCONTAINER', 'width'=>150,'hidden'=>false))
                    ->addColumn(array('label'=>'Vessel','index'=>'VESSEL','width'=>120,'align'=>'center'))
                    ->addColumn(array('label'=>'Consignee','index'=>'CONSIGNEE','width'=>250))
                    ->addColumn(array('label'=>'Shipper','index'=>'SHIPPER','width'=>230,'hidden'=>false))
                    ->addColumn(array('label'=>'No.BC11','index'=>'NO_BC11', 'width'=>150,'hidden'=>false))
                    ->addColumn(array('label'=>'Tgl.BC11','index'=>'TGL_BC11', 'width'=>150,'hidden'=>false))
                    ->addColumn(array('label'=>'No.POS BC11','index'=>'NO_POS_BC11', 'width'=>150, 'align'=>'center'))
                    ->addColumn(array('label'=>'No.PLP','index'=>'NO_PLP', 'width'=>150,'hidden'=>false))                
                    ->addColumn(array('label'=>'Tgl.PLP','index'=>'TGL_PLP', 'width'=>150,'hidden'=>false))    
                    ->addColumn(array('label'=>'Nama Dokumen','index'=>'KODE_DOKUMEN', 'width'=>120))
                    ->addColumn(array('label'=>'No. SPPB','index'=>'NO_SPPB', 'width'=>120,'align'=>'center'))
                    ->addColumn(array('label'=>'Tgl. SPPB','index'=>'TGL_SPPB', 'width'=>120,'align'=>'center'))
                    ->addColumn(array('label'=>'Status BC','index'=>'status_bc', 'width'=>80,'align'=>'center')) 
                    ->addColumn(array('label'=>'Tgl. Masuk','index'=>'TGLMASUK','width'=>120,'align'=>'center'))
                    ->addColumn(array('label'=>'Jam Masuk','index'=>'JAMMASUK','width'=>120,'align'=>'center'))
                    ->addColumn(array('label'=>'Tgl. Behandle','index'=>'tglbehandle', 'width'=>120,'align'=>'center'))
                    ->addColumn(array('label'=>'Jam Behandle','index'=>'jambehandle', 'width'=>120,'align'=>'center'))
                    ->addColumn(array('label'=>'Segel Merah','index'=>'flag_bc', 'width'=>100,'align'=>'center'))
                    ->addColumn(array('label'=>'No. Segel','index'=>'no_flag_bc','width'=>100,'align'=>'center','hidden'=>false))
                    ->addColumn(array('label'=>'Alasan Segel','index'=>'alasan_segel','width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'Photo Behandle','index'=>'photo_behandle', 'width'=>70,'hidden'=>true))
                    ->addColumn(array('label'=>'UID','index'=>'UID', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('label'=>'Tgl. Entry','index'=>'tglentry', 'width'=>120, 'align'=>'center', 'hidden'=>true))
                    ->addColumn(array('label'=>'Jam. Entry','index'=>'jamentry', 'width'=>70,'hidden'=>true, 'align'=>'center'))
                    ->addColumn(array('label'=>'Updated','index'=>'last_update', 'width'=>150, 'search'=>false,'hidden'=>true))
            
//                    ->addColumn(array('label'=>'No. Pabean','index'=>'no_pabean','width'=>160,'hidden'=>true))
//                    ->addColumn(array('label'=>'Tgl. Pabean','index'=>'tgl_pabean', 'width'=>150,'hidden'=>true, 'align'=>'center'))
//                    ->addColumn(array('label'=>'No. SPK','index'=>'NOJOBORDER', 'width'=>150,'hidden'=>true))
//                    ->addColumn(array('label'=>'No. MBL','index'=>'NOMBL','width'=>160,'hidden'=>true))
//                    ->addColumn(array('label'=>'Tgl. MBL','index'=>'TGL_MASTER_BL', 'width'=>150,'hidden'=>true, 'align'=>'center'))
//                    ->addColumn(array('label'=>'No. Tally','index'=>'NOTALLY','width'=>160,'hidden'=>true))
//                    ->addColumn(array('label'=>'Consolidator','index'=>'NAMACONSOLIDATOR','width'=>250,'hidden'=>true))                   
//                    ->addColumn(array('label'=>'Weight','index'=>'WEIGHT', 'width'=>120, 'align'=>'right','hidden'=>true))               
//                    ->addColumn(array('label'=>'Meas','index'=>'MEAS', 'width'=>120, 'align'=>'right','hidden'=>true))                                       
//                    ->addColumn(array('label'=>'Notify Party','index'=>'NOTIFYPARTY','width'=>160,'hidden'=>true))                                                 
//                    ->addColumn(array('index'=>'TSHIPPER_FK', 'width'=>150,'hidden'=>true))
//                    ->addColumn(array('index'=>'TCONSIGNEE_FK', 'width'=>150,'hidden'=>true))
//                    ->addColumn(array('index'=>'TNOTIFYPARTY_FK', 'width'=>150,'hidden'=>true))
//                    ->addColumn(array('index'=>'TPACKING_FK', 'width'=>150,'hidden'=>true))
//                    ->addColumn(array('label'=>'Marking','index'=>'MARKING', 'width'=>150,'hidden'=>true)) 
//                    ->addColumn(array('label'=>'Desc of Goods','index'=>'DESCOFGOODS', 'width'=>150,'hidden'=>true))                                             
//                    ->addColumn(array('label'=>'Surcharge (DG)','index'=>'DG_SURCHARGE', 'width'=>150,'hidden'=>true))
//                    ->addColumn(array('label'=>'Surcharge (Weight)','index'=>'WEIGHT_SURCHARGE', 'width'=>150,'hidden'=>true))         
                    
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
                        <div id="manifest-photo"></div>
                    </div>
                </div>
            </div>    
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->    
@endsection