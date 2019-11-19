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
            
            if(rowdata.status_behandle == 'Siap Periksa' || rowdata.status_behandle == 'Sedang Periksa') {
                apv = '<button style="margin:5px;" class="btn btn-info btn-xs" data-id="'+cl+'" onclick="if (confirm(\'Apakah anda yakin telah selesai melakukan pemeriksaan behandle ?\')){ changeStatusBehandle('+cl+',\'finish\'); }else{return false;};"><i class="fa fa-check"></i> SELESAI</button>';
            }else{
                apv = '';
            }  
            
            if(rowdata.status_behandle == 'Belum Siap') {
                $("#" + cl).find("td").css("background-color", "#FF0000").css("color", "#FFF");
            } 
            if(rowdata.status_behandle == 'Siap Periksa') {
                $("#" + cl).find("td").css("background-color", "#aae25a");
            }
            if(rowdata.status_behandle == 'Sedang Periksa') {
                $("#" + cl).find("td").css("background-color", "#f4dc27");
            }
            if(rowdata.status_behandle == 'Selesai Periksa') {
                $("#" + cl).find("td").css("background-color", "#6acaf7");
            }    
            if(rowdata.status_behandle == 'Delivery') {
                $("#" + cl).find("td").css("background-color", "#ffdc60");
            }
                    
            jQuery("#fclBehandleGrid").jqGrid('setRowData',ids[i],{action:apv});
            
        } 
    }
    
    function onSelectRowEvent()
    {
        $('#btn-group-1, #btn-group-4').enableButtonGroup();
    }
    
    function changeStatusBehandle($id,$action)
    {
        $("#container_finish_id").val($id);
        $('#finish-modal').modal('show');
    }
    
    $(document).ready(function()
    {
        $('#behandle-form').disabledFormGroup();
        $('#desc').removeAttr('disabled');
        $('#btn-toolbar, #btn-photo').disabledButtonGroup();
        $('#btn-group-3').enableButtonGroup();
        
        $('#btn-edit').click(function() {
            //Gets the selected row id.
            rowid = $('#fclBehandleGrid').jqGrid('getGridParam', 'selrow');
            rowdata = $('#fclBehandleGrid').getRowData(rowid);

            populateFormFields(rowdata, '');
            $('#TCONTAINER_PK').val(rowid);
            $('#NOJOBORDER').val(rowdata.NoJob);
            $('#NO_BC11').val(rowdata.NO_BC11);
            $('#TGL_BC11').val(rowdata.TGL_BC11);
            $('#NO_PLP').val(rowdata.NO_PLP);
            $('#TGL_PLP').val(rowdata.TGL_PLP);
            $('#NO_POS_BC11').val(rowdata.NO_POS_BC11);
            $('#NO_SPJM').val(rowdata.NO_SPJM);
            $('#TGL_SPJM').val(rowdata.TGL_SPJM);
            $('#NAMA_IMP').val(rowdata.NAMA_IMP);
            $('#NPWP_IMP').val(rowdata.NPWP_IMP);
            
            $('#upload-title').html('Upload Photo for '+rowdata.NOCONTAINER);
            $('#no_cont').val(rowdata.NOCONTAINER);
            $('#id_cont').val(rowdata.TCONTAINER_PK);
            $('#load_photos').html('');
            $('#delete_photo').val('N');
            
            if(rowdata.photo_behandle){
                var html = '';
                var photos = $.parseJSON(rowdata.photo_behandle);
                $.each(photos, function(i, item) {
                    /// do stuff
                    html += '<img src="{{url("uploads/photos/container/fcl/")}}/'+rowdata.NOCONTAINER+'/'+item+'" style="width: 200px;padding:5px;" />';
                });
                $('#load_photos').html(html);
            }
            
//            if(!rowdata.TGLBEHANDLE) {
                $('#btn-group-2, #btn-photo').enableButtonGroup();
                $('#behandle-form').enableFormGroup();
//            }else{
//                $('#btn-group-2').disabledButtonGroup();
//                $('#behandle-form').disabledFormGroup();
//            }
            
            if(rowdata.status_behandle == 'Belum Siap'){
                $('#btn-group-5').enableButtonGroup();
            }

        });
        
        $('#btn-print').click(function() {
            var id = $('#fclBehandleGrid').jqGrid('getGridParam', 'selrow');
            window.open("{{ route('fcl-behandle-cetak', '') }}/"+id,"preview wo behandle","width=600,height=600,menubar=no,status=no,scrollbars=yes");
        });
        
        $('#btn-save').click(function() {
            
            if(!confirm('Apakah anda yakin?')){return false;}
            
//            if($('#TGLBEHANDLE').val() == ''){
//                alert('Tanggal Behandle Masih Kosong!');
//                return false;
//            }
            
            var containerId = $('#TCONTAINER_PK').val();
            var url = "{{route('fcl-delivery-behandle-update','')}}/"+containerId;

            $.ajax({
                type: 'POST',
                data: JSON.stringify($('#behandle-form').formToObject('')),
                dataType : 'json',
                url: url,
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Something went wrong, please try again later.');
                },
                beforeSend:function()
                {

                },
                success:function(json)
                {
                    console.log(json);
                    if(json.success) {
                      $('#btn-toolbar').showAlertAfterElement('alert-success alert-custom', json.message, 5000);
                    } else {
                      $('#btn-toolbar').showAlertAfterElement('alert-danger alert-custom', json.message, 5000);
                    }

                    //Triggers the "Close" button funcionality.
                    $('#btn-refresh').click();
                }
            });
        });
        
        $('#btn-cancel').click(function() {
            $('#btn-refresh').click();
        });
        
        $('#btn-refresh').click(function() {
            $('#fclBehandleGrid').jqGrid().trigger("reloadGrid");
            $('#behandle-form').disabledFormGroup();
            $('#btn-toolbar, #btn-photo').disabledButtonGroup();
            $('#btn-group-3').enableButtonGroup();
            
            $('#behandle-form')[0].reset();
            $('.select2').val(null).trigger("change");
            $('#TCONTAINER_PK').val("");
        });
        
        $('#btn-ready').click(function() {
            if(!confirm('Apakah anda yakin?')){return false;}
            
            var containerId = $('#TCONTAINER_PK').val();
            var url = "{{route('fcl-delivery-behandle-ready','')}}/"+containerId;

            $.ajax({
                type: 'POST',
                data: {
                    _token : '{{ csrf_token() }}',
                    status_behandle : 'Siap Periksa'
                },
                dataType : 'json',
                url: url,
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Something went wrong, please try again later.');
                },
                beforeSend:function()
                {

                },
                success:function(json)
                {
                    console.log(json);
                    if(json.success) {
                      $('#btn-toolbar').showAlertAfterElement('alert-success alert-custom', json.message, 5000);
                    } else {
                      $('#btn-toolbar').showAlertAfterElement('alert-danger alert-custom', json.message, 5000);
                    }

                    //Triggers the "Close" button funcionality.
                    $('#btn-refresh').click();
                }
            });
        });
        
    });
    
</script>

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">FCL Delivery Behandle</h3>
    </div>
    <div class="box-body">
        <div class="row" style="margin-bottom: 30px;">
            <div class="col-md-12"> 
                {{
                    GridRender::setGridId("fclBehandleGrid")
                    ->enableFilterToolbar()
                    ->setGridOption('mtype', 'POST')
                    ->setGridOption('url', URL::to('/container/grid-data-cy?module=behandle&_token='.csrf_token()))
//                    ->setGridOption('editurl',URL::to('/container/crud-cy/'))
                    ->setGridOption('rowNum', 50)
                    ->setGridOption('shrinkToFit', true)
                    ->setGridOption('sortname','TCONTAINER_PK')
                    ->setGridOption('rownumbers', true)
                    ->setGridOption('height', '300')
                    ->setGridOption('rowList',array(50,100,200))
                    ->setGridOption('useColSpanStyle', true)
                    ->setNavigatorOptions('navigator', array('viewtext'=>'view'))
                    ->setNavigatorOptions('view',array('closeOnEscape'=>false))
                    ->setNavigatorOptions('navigator', array('add' => false, 'edit' => false, 'del' => false, 'view' => true, 'refresh' => false))
                    ->setFilterToolbarOptions(array('autosearch'=>true))
                    ->setGridEvent('gridComplete', 'gridCompleteEvent')
                    ->setGridEvent('onSelectRow', 'onSelectRowEvent')
                    ->addColumn(array('key'=>true,'index'=>'TCONTAINER_PK','hidden'=>true))
                    ->addColumn(array('label'=>'Action','index'=>'action', 'width'=>80, 'search'=>false, 'sortable'=>false, 'align'=>'center'))  
                    ->addColumn(array('label'=>'Status Behandle','index'=>'status_behandle','width'=>120, 'align'=>'center'))
                    ->addColumn(array('label'=>'No. SPK','index'=>'NoJob','width'=>160))
                    ->addColumn(array('label'=>'No. Container','index'=>'NOCONTAINER','width'=>160,'editable' => true, 'editrules' => array('required' => true)))
                    ->addColumn(array('label'=>'Size','index'=>'SIZE', 'width'=>80,'align'=>'center','editable' => true, 'editrules' => array('required' => true,'number'=>true),'edittype'=>'select','editoptions'=>array('value'=>"20:20;40:40")))
                    ->addColumn(array('label'=>'Vessel','index'=>'VESSEL', 'width'=>150))
                    ->addColumn(array('label'=>'Callsign','index'=>'CALLSIGN', 'width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'Voy','index'=>'VOY','width'=>80,'align'=>'center'))
                    ->addColumn(array('label'=>'ETA','index'=>'ETA', 'width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'TPS Asal','index'=>'KD_TPS_ASAL', 'width'=>80,'align'=>'center'))
                    ->addColumn(array('label'=>'Tgl. Masuk','index'=>'TGLMASUK','width'=>120,'align'=>'center'))
                    ->addColumn(array('label'=>'Jam Masuk','index'=>'JAMMASUK','width'=>120,'align'=>'center'))
                    ->addColumn(array('label'=>'No. SPJM','index'=>'NO_SPJM', 'width'=>120,'hidden'=>false))
                    ->addColumn(array('label'=>'Tgl. SPJM','index'=>'TGL_SPJM', 'width'=>150,'hidden'=>false))
                    ->addColumn(array('label'=>'Tgl. Behandle','index'=>'TGLBEHANDLE','width'=>120,'align'=>'center'))
                    ->addColumn(array('label'=>'Jam. Behandle','index'=>'JAMBEHANDLE', 'width'=>120,'align'=>'center'))
            
                    ->addColumn(array('label'=>'No. MBL','index'=>'NOMBL','width'=>160,'hidden'=>true))
                    ->addColumn(array('label'=>'Tgl. MBL','index'=>'TGLMBL','width'=>150,'align'=>'center','hidden'=>true))
                    ->addColumn(array('label'=>'Consolidator','index'=>'NAMACONSOLIDATOR','width'=>250,'hidden'=>true))
                    ->addColumn(array('label'=>'No. BC11','index'=>'NO_BC11','width'=>150,'align'=>'right','hidden'=>true))
                    ->addColumn(array('label'=>'Tgl. BC11','index'=>'TGL_BC11','width'=>150,'align'=>'center','hidden'=>true))
                    ->addColumn(array('label'=>'No. POS BC11','index'=>'NO_POS_BC11','width'=>150,'align'=>'center','hidden'=>true))
                    ->addColumn(array('label'=>'No. PLP','index'=>'NO_PLP','width'=>150,'align'=>'right','hidden'=>true))
                    ->addColumn(array('label'=>'Tgl. PLP','index'=>'TGL_PLP','width'=>150,'align'=>'center','hidden'=>true))
                    
                    ->addColumn(array('label'=>'Photo Behandle','index'=>'photo_behandle', 'width'=>70,'hidden'=>true))
                    
                    ->addColumn(array('label'=>'Consignee','index'=>'CONSIGNEE','width'=>160,'hidden'=>true))
                    ->addColumn(array('label'=>'Importir','index'=>'NAMA_IMP','width'=>160,'hidden'=>true))
                    ->addColumn(array('label'=>'NPWP Importir','index'=>'NPWP_IMP','width'=>160,'hidden'=>true))
                    ->addColumn(array('label'=>'Teus','index'=>'TEUS', 'width'=>80,'align'=>'center','editable' => false,'hidden'=>true))
                    ->addColumn(array('label'=>'No. Seal','index'=>'NOSEGEL', 'width'=>120,'editable' => true, 'align'=>'right','hidden'=>true))
                    ->addColumn(array('label'=>'Weight','index'=>'WEIGHT', 'width'=>120,'editable' => true, 'align'=>'right','editrules' => array('required' => true),'hidden'=>true))
                    ->addColumn(array('label'=>'Measurment','index'=>'MEAS', 'width'=>120,'editable' => true, 'align'=>'right','editrules' => array('required' => true),'hidden'=>true))
                    ->addColumn(array('label'=>'Layout','index'=>'layout', 'width'=>80,'editable' => true,'align'=>'center','editoptions'=>array('defaultValue'=>"C-1"),'hidden'=>true))
                    ->addColumn(array('label'=>'UID','index'=>'UID', 'width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'Tgl. Entry','index'=>'TGLENTRY', 'width'=>150, 'search'=>false))
                    ->addColumn(array('label'=>'Jam. Entry','index'=>'JAMENTRY', 'width'=>150, 'search'=>false, 'hidden'=>true))
                    ->addColumn(array('label'=>'Updated','index'=>'last_update', 'width'=>150, 'search'=>false,'hidden'=>true))
                    ->renderGrid()
                }}
                
                
                <div id="btn-toolbar" class="section-header btn-toolbar" role="toolbar" style="margin: 10px 0;">
                    <div id="btn-group-3" class="btn-group">
                        <button class="btn btn-default" id="btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>
                    </div>
                    <div id="btn-group-1" class="btn-group">
                        <button class="btn btn-default" id="btn-edit"><i class="fa fa-edit"></i> Edit</button>
                    </div>
                    <div id="btn-group-2" class="btn-group toolbar-block">
                        <button class="btn btn-default" id="btn-save"><i class="fa fa-save"></i> Save</button>
                        <button class="btn btn-default" id="btn-cancel"><i class="fa fa-close"></i> Cancel</button>
                    </div>  
                    <div id="btn-group-4" class="btn-group">
                        <button class="btn btn-default" id="btn-print"><i class="fa fa-print"></i> Cetak Behandle</button>
                    </div>
                    <div id="btn-group-5" class="btn-group pull-right">
                        <button class="btn btn-warning" id="btn-ready"><i class="fa fa-check"></i> Ready To Checking</button>
                    </div>
                </div>
            </div>
            
        </div>
        <form class="form-horizontal" id="behandle-form" action="{{ route('fcl-delivery-behandle-index') }}" method="POST">
            <div class="row">
                <div class="col-md-6">
                    
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    <input id="TCONTAINER_PK" name="TCONTAINER_PK" type="hidden">
                    <input id="status_behandle" name="status_behandle" type="hidden" value="Belum Siap">
                    <input name="delete_photo" id="delete_photo" value="N" type="hidden">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. SPK</label>
                        <div class="col-sm-8">
                            <input type="text" id="NOJOBORDER" name="NOJOBORDER" class="form-control" readonly>
                        </div>
                    </div>
<!--                    <div class="form-group">
                        <label class="col-sm-3 control-label">No.MBL</label>
                        <div class="col-sm-8">
                            <input type="text" id="NOMBL" name="NOMBL" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl.MBL</label>
                        <div class="col-sm-8">
                            <input type="text" id="TGLMBL" name="TGLMBL" class="form-control" readonly>
                        </div>
                    </div>-->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. Container</label>
                        <div class="col-sm-8">
                            <input type="text" id="NOCONTAINER" name="NOCONTAINER" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Consignee</label>
                        <div class="col-sm-8">
                            <input type="text" id="CONSIGNEE" name="CONSIGNEE" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No.BC11</label>
                        <div class="col-sm-3">
                            <input type="text" id="NO_BC11" name="NO_BC11" class="form-control" readonly>
                        </div>
                        <label class="col-sm-2 control-label">Tgl.BC11</label>
                        <div class="col-sm-3">
                            <input type="text" id="TGL_BC11" name="TGL_BC11" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. POS BC11</label>
                        <div class="col-sm-8">
                            <input type="text" id="NO_POS_BC11" name="NO_POS_BC11" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No.PLP</label>
                        <div class="col-sm-3">
                            <input type="text" id="NO_PLP" name="NO_PLP" class="form-control" readonly>
                        </div>
                        <label class="col-sm-2 control-label">Tgl.PLP</label>
                        <div class="col-sm-3">
                            <input type="text" id="TGL_PLP" name="TGL_PLP" class="form-control" readonly>
                        </div>
                    </div>
<!--                    <div class="form-group">
                        <label class="col-sm-3 control-label">Consolidator</label>
                        <div class="col-sm-8">
                            <input type="text" id="NAMACONSOLIDATOR" name="NAMACONSOLIDATOR" class="form-control" readonly>
                        </div>
                    </div>-->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl/Jam Masuk</label>
                        <div class="col-sm-8">
                            <input type="text" id="TGLENTRY" name="TGLENTRY" class="form-control" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. SPJM</label>
                        <div class="col-sm-8">
                            <input type="text" id="NO_SPJM" name="NO_SPJM" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. SPJM</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" id="TGL_SPJM" name="TGL_SPJM" class="form-control pull-right datepicker" required>
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
                <div class="col-md-6"> 
                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl.Behandle</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" id="TGLBEHANDLE" name="TGLBEHANDLE" class="form-control pull-right datepicker" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bootstrap-timepicker">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Jam Behandle</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="text" id="JAMBEHANDLE" name="JAMBEHANDLE" class="form-control timepicker" required>
                                    <div class="input-group-addon">
                                          <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group" id="btn-photo">
                        <label class="col-sm-3 control-label">Photo</label>
                        <div class="col-sm-8">
                            <button type="button" class="btn btn-warning" id="upload-photo-btn">Upload Photo</button>
                            <button type="button" class="btn btn-danger" id="delete-photo-btn">Delete Photo</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <div id="load_photos" style="text-align: center;"></div>
                        </div>
                    </div>
<!--                    <div class="form-group">
                        <label class="col-sm-3 control-label">Importir</label>
                        <div class="col-sm-8">
                            <input type="text" id="NAMA_IMP" name="NAMA_IMP" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">NPWP Importir</label>
                        <div class="col-sm-8">
                            <input type="text" id="NPWP_IMP" name="NPWP_IMP" class="form-control" required>
                        </div>
                    </div>-->
                    
                </div>
            </div>
        </form>  
    </div>
</div>
<div id="photo-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="modal">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="upload-title"></h4>
            </div>
            <form class="form-horizontal" id="upload-photo-form" action="{{ route('fcl-behandle-upload-photo') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-body"> 
                    <div class="row">
                        <div class="col-md-12">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            <input type="hidden" id="id_cont" name="id_cont" required>   
                            <input type="hidden" id="no_cont" name="no_cont" required>    
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Photo</label>
                                <div class="col-sm-8">
                                    <input type="file" name="photos[]" class="form-control" multiple="true" required>
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="finish-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Finish Behandle</h4>
            </div>
            <form class="form-horizontal" action="{{ route('fcl-change-status-behandle') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-body"> 
                    <div class="row">
                        <div class="col-md-12">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                            <input name="id" type="hidden" id="container_finish_id" />
                            <input name="status_behandle" type="hidden" id="status_behandle" value="Selesai Periksa" />
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Keterangan</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="desc" id="desc"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary">Finish</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

@section('custom_css')

<!--<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" />-->
<link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/plugins/datepicker/datepicker3.css") }}">
<link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/plugins/timepicker/bootstrap-timepicker.min.css") }}">

@endsection

@section('custom_js')

<script src="{{ asset("/bower_components/AdminLTE/plugins/datepicker/bootstrap-datepicker.js") }}"></script>
<script src="{{ asset("/bower_components/AdminLTE/plugins/timepicker/bootstrap-timepicker.min.js") }}"></script>
<!--<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>-->
<script type="text/javascript">
//    $('.select2').select2();

    $("#upload-photo-btn").on("click", function(e){
        e.preventDefault();
        $("#photo-modal").modal('show');
        return false;
    });
    
    $("#delete-photo-btn").on("click", function(e){
        if(!confirm('Apakah anda yakin akan menghapus photo?')){return false;}
        
        $('#load_photos').html('');
        $('#delete_photo').val('Y');
    });

    $('.datepicker').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'yyyy-mm-dd' 
    });
    $('.timepicker').timepicker({ 
        showMeridian: false,
        showInputs: false,
        showSeconds: true,
        minuteStep: 1,
        secondStep: 1
    });
    $(".timepicker").mask("99:99:99");
    $(".datepicker").mask("9999-99-99");
    $("#NPWP_IMP").mask("99.999.999.9-999.999");
</script>

@endsection