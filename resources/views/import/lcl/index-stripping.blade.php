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
        var ids = jQuery("#lclStrippingGrid").jqGrid('getDataIDs'),
            apv = '', vi = ''; 
        for(var i=0;i < ids.length;i++){ 
            var cl = ids[i];
            var rowdata = $('#lclStrippingGrid').getRowData(cl);
            
            if(rowdata.STARTSTRIPPING !== ''){
                apv = '<button style="margin:5px;" class="btn btn-danger btn-xs approve-stripping-btn" disabled><i class="fa fa-close"></i> Stripping</button>';
            }else{
                apv = '<button style="margin:5px;" class="btn btn-danger btn-xs approve-stripping-btn" data-id="'+cl+'" onclick="if (confirm(\'Are You Sure ?\')){ approveStripping('+cl+'); }else{return false;};"><i class="fa fa-check"></i> Stripping</button>';
            }
            
            if(rowdata.photo_gatein_extra != '' || rowdata.photo_stripping != ''){
                vi = '<button style="margin:5px;" class="btn btn-default btn-xs approve-manifest-btn" data-id="'+cl+'" onclick="viewPhoto('+cl+')"><i class="fa fa-photo"></i> View Photo</button>';
            }else{
                vi = '<button style="margin:5px;" class="btn btn-default btn-xs approve-manifest-btn" disabled><i class="fa fa-photo"></i> Not Found</button>';
            }
            
            jQuery("#lclStrippingGrid").jqGrid('setRowData',ids[i],{action:apv, photo:vi}); 
        } 
    }
    
    function approveStripping($id)
    {
        $.ajax({
            type: 'GET',
            dataType : 'json',
            url: '{{route("lcl-realisasi-stripping-approve","")}}/'+$id,
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Something went wrong, please try again later.');
            },
            beforeSend:function()
            {

            },
            success:function(json)
            {
                if(json.success) {
                    $('#btn-toolbar').showAlertAfterElement('alert-success alert-custom', json.message, 5000);
                } else {
                    $('#btn-toolbar').showAlertAfterElement('alert-danger alert-custom', json.message, 5000);
                }

                //Triggers the "Refresh" button funcionality.
                $('#btn-refresh').click();
            }
        });
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
                $('#container-photo').html('');
                $('#stripping-photo').html('');
            },
            success:function(json)
            {                
                if(json.data.photo_gatein_extra){
                    var photos_container = $.parseJSON(json.data.photo_gatein_extra);
                    var html_container = '';
                    $.each(photos_container, function(i, item) {
                        /// do stuff
                        html_container += '<img src="{{url("uploads/photos/container/lcl")}}/'+json.data.NOCONTAINER+'/'+item+'" style="width: 200px;padding:5px;" />';

                    });
                    $('#container-photo').html(html_container);
                }
                if(json.data.photo_stripping){
                    var photos_stripping = $.parseJSON(json.data.photo_stripping);
                    var html_stripping = '';
                    $.each(photos_stripping, function(i, item) {
                        /// do stuff
                        html_stripping += '<img src="{{url("uploads/photos/container/lcl")}}/'+json.data.NOCONTAINER+'/'+item+'" style="width: 200px;padding:5px;" />';

                    });
                    $('#stripping-photo').html(html_stripping);
                }
                
                $("#title-photo").html('PHOTO CONTAINER NO. '+json.data.NOCONTAINER);
            }
        });
        
        $('#view-photo-bl-btn').attr("data-id", containerID);
        $('#view-photo-modal').modal('show');
    }
    
    function onSelectRowEvent()
    {
        $('#btn-group-1').enableButtonGroup();
    }
    
    $(document).ready(function()
    {
        $('#stripping-form').disabledFormGroup();
        $('#btn-toolbar, #btn-photo').disabledButtonGroup();
        $('#btn-group-3').enableButtonGroup();
        
        $('#btn-edit').click(function() {
            //Gets the selected row id.
            rowid = $('#lclStrippingGrid').jqGrid('getGridParam', 'selrow');
            rowdata = $('#lclStrippingGrid').getRowData(rowid);
            console.log(rowdata);
            populateFormFields(rowdata, '');
            $('#TCONTAINER_PK').val(rowid);
            $('#NO_BC11').val(rowdata.NO_BC11);
            $('#TGL_BC11').val(rowdata.TGL_BC11);
            $('#NO_PLP').val(rowdata.NO_PLP);
            $('#TGL_PLP').val(rowdata.TGL_PLP);
            $('#KD_TPS_ASAL').val(rowdata.KD_TPS_ASAL);
            if(rowdata.STARTSTRIPPING) {
                var date_start = new Date(rowdata.STARTSTRIPPING);
                var date = date_start.toString("yyyy-MM-dd");
                var jam = date_start.toString("HH:mm");
                $('#STARTSTRIPPING').datepicker('setDate', date);
                $('#JAMSTARTSTRIPPING').val(jam);
            }
            if(rowdata.ENDSTRIPPING) {
                var date_start = new Date(rowdata.ENDSTRIPPING);
                var date = date_start.toString("yyyy-MM-dd");
                var jam = date_start.toString("HH:mm");
                $('#ENDSTRIPPING').datepicker('setDate', date);
                $('#JAMENDSTRIPPING').val(jam);
            }
            $('#coordinator_stripping').val(rowdata.coordinator_stripping);
            $('#mulai_tunda').val(rowdata.mulai_tunda);
            $('#selesai_tunda').val(rowdata.selesai_tunda);
            $('#operator_forklif').val(rowdata.operator_forklif);
            $('#working_hours').val(rowdata.working_hours);
            $('#jumlah_bl').val(rowdata.jumlah_bl);
            
            $('#upload-title').html('Upload Photo Hasil Stripping '+rowdata.NOCONTAINER);
            $('#no_cont').val(rowdata.NOCONTAINER);
            $('#id_cont').val(rowdata.TCONTAINER_PK);
            $('#load_photos').html('');
            $('#delete_photo').val('N');
            
            if(rowdata.photo_stripping){
                var html = '';
                var photos = $.parseJSON(rowdata.photo_stripping);
                $.each(photos, function(i, item) {
                    /// do stuff
                    html += '<img src="{{url("uploads/photos/container/lcl/")}}/'+rowdata.NOCONTAINER+'/'+item+'" style="width: 200px;padding:5px;" />';
                });
                $('#load_photos').html(html);
            }
            
            if(rowdata.TGLMASUK && rowdata.JAMMASUK) {
                $('#btn-group-2,#btn-photo').enableButtonGroup();
                $('#stripping-form').enableFormGroup();
                $('#UIDSTRIPPING').val('{{ Auth::getUser()->name }}');
                $('#TGLMASUK').attr('disabled','disabled');
                $('#JAMMASUK').attr('disabled','disabled');
            }else{
                $('#btn-group-2').disabledButtonGroup();
                $('#stripping-form').disabledFormGroup();
            }

        });
        
        $('#btn-print').click(function() {

        });
        
        $('#btn-save').click(function() {
            
            if(!confirm('Apakah anda yakin?')){return false;}
            
            var url = $('#stripping-form').attr('action')+'/edit/'+$('#TCONTAINER_PK').val();

            $.ajax({
                type: 'POST',
                data: JSON.stringify($('#stripping-form').formToObject('')),
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
            $('#lclStrippingGrid').jqGrid().trigger("reloadGrid");
            $('#stripping-form').disabledFormGroup();
            $('#btn-toolbar').disabledButtonGroup();
            $('#btn-group-3').enableButtonGroup();
            
            $('#stripping-form')[0].reset();
            $('#TCONTAINER_PK').val("");
        });
        
    });
    
</script>

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">LCL Realisasi Stripping</h3>
<!--        <div class="box-tools">
            <a href="{{ route('lcl-manifest-create') }}" type="button" class="btn btn-block btn-info btn-sm"><i class="fa fa-plus"></i> Add New</a>
        </div>-->
    </div>
    <div class="box-body">
        <div class="row" style="margin-bottom: 30px;">
            <div class="col-md-12"> 
                {{
                    GridRender::setGridId("lclStrippingGrid")
                    ->enableFilterToolbar()
                    ->setGridOption('mtype', 'POST')
                    ->setGridOption('url', URL::to('/lcl/register/grid-data?module=stripping&_token='.csrf_token()))
                    ->setGridOption('rowNum', 20)
                    ->setGridOption('shrinkToFit', true)
                    ->setGridOption('sortname','TCONTAINER_PK')
                    ->setGridOption('sortorder','DESC')
                    ->setGridOption('rownumbers', true)
                    ->setGridOption('height', '300')
                    ->setGridOption('rowList',array(20,50,100))
                    ->setGridOption('useColSpanStyle', true)
                    ->setNavigatorOptions('navigator', array('viewtext'=>'view'))
                    ->setNavigatorOptions('view',array('closeOnEscape'=>false))
                    ->setFilterToolbarOptions(array('autosearch'=>true))
                    ->setGridEvent('gridComplete', 'gridCompleteEvent')
                    ->setGridEvent('onSelectRow', 'onSelectRowEvent')
                    ->addColumn(array('label'=>'Action','index'=>'action', 'width'=>100, 'search'=>false, 'sortable'=>false, 'align'=>'center'))
                    ->addColumn(array('label'=>'Photo','index'=>'photo', 'width'=>120, 'search'=>false, 'sortable'=>false, 'align'=>'center'))
                    ->addColumn(array('key'=>true,'index'=>'TCONTAINER_PK','hidden'=>true))
                    ->addColumn(array('label'=>'No. Container','index'=>'NOCONTAINER','width'=>150))
                    ->addColumn(array('label'=>'No. Joborder','index'=>'NoJob','width'=>150))
                    ->addColumn(array('label'=>'Size','index'=>'SIZE', 'width'=>80,'align'=>'center'))
                    ->addColumn(array('label'=>'Teus','index'=>'TEUS', 'width'=>80,'align'=>'center'))
                    ->addColumn(array('label'=>'Vessel','index'=>'VESSEL','width'=>120,'align'=>'center'))
                    ->addColumn(array('label'=>'Tgl. ETA','index'=>'ETA','width'=>120,'align'=>'center'))
                    ->addColumn(array('label'=>'TPS Asal','index'=>'KD_TPS_ASAL','width'=>80,'align'=>'center'))
                    ->addColumn(array('label'=>'Tgl. Masuk','index'=>'TGLMASUK','width'=>120,'align'=>'center'))
                    ->addColumn(array('label'=>'Jam Masuk','index'=>'JAMMASUK','width'=>120,'align'=>'center'))
                    ->addColumn(array('label'=>'Mulai Stripping','index'=>'STARTSTRIPPING','width'=>150,'align'=>'center','hidden'=>false))
                    ->addColumn(array('label'=>'Jam Mulai','index'=>'JAMSTARTSTRIPPING','width'=>120,'align'=>'center','hidden'=>true))
                    ->addColumn(array('label'=>'Selesai Stripping','index'=>'ENDSTRIPPING','width'=>150,'align'=>'center','hidden'=>false))
                    ->addColumn(array('label'=>'Jam Selesai','index'=>'JAMENDSTRIPPING','width'=>120,'align'=>'center','hidden'=>true))
                    ->addColumn(array('label'=>'Working Hours','index'=>'working_hours','width'=>100,'align'=>'center','hidden'=>false))
            
                    ->addColumn(array('label'=>'No. BC11','index'=>'NO_BC11','width'=>120,'hidden'=>true))
                    ->addColumn(array('label'=>'Tgl. BC11','index'=>'TGL_BC11','width'=>120,'hidden'=>true))
                    ->addColumn(array('label'=>'No. PLP','index'=>'NO_PLP','width'=>120,'hidden'=>true))
                    ->addColumn(array('label'=>'Tgl. PLP','index'=>'TGL_PLP','width'=>120,'hidden'=>true))
                    
                    ->addColumn(array('label'=>'No. Seal','index'=>'NO_SEAL', 'width'=>120,'align'=>'right','hidden'=>true))
                    
                    ->addColumn(array('label'=>'Coordinator','index'=>'coordinator_stripping','hidden'=>true))           
                    ->addColumn(array('label'=>'Petugas','index'=>'UIDSTRIPPING','hidden'=>false,'align'=>'center'))
                    ->addColumn(array('label'=>'Jumlah B/L','index'=>'jumlah_bl','hidden'=>true))                   
                    ->addColumn(array('label'=>'MEAS','index'=>'MEAS','hidden'=>true))
            
                    ->addColumn(array('label'=>'Mulai Tunda','index'=>'mulai_tunda','hidden'=>true))
                    ->addColumn(array('label'=>'Selesai Tunda','index'=>'selesai_tunda','hidden'=>true))
                    ->addColumn(array('label'=>'Keterangan','index'=>'keterangan','hidden'=>true))
                    ->addColumn(array('label'=>'Operator Forklif','index'=>'operator_forklif','hidden'=>true))
        //            ->addColumn(array('label'=>'Layout','index'=>'layout','width'=>80,'align'=>'center','hidden'=>true))
        //            ->addColumn(array('label'=>'UID','index'=>'UID', 'width'=>150))
                    ->addColumn(array('label'=>'Tgl. Entry','index'=>'TGLENTRY', 'width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'Updated','index'=>'last_update', 'width'=>150,'align'=>'center','search'=>false))
                    ->addColumn(array('label'=>'Photo Extra','index'=>'photo_gatein_extra', 'width'=>70,'hidden'=>true))
                    ->addColumn(array('label'=>'Photo Stripping','index'=>'photo_stripping', 'width'=>70,'hidden'=>true))
        //            ->addColumn(array('label'=>'Action','index'=>'action', 'width'=>80, 'search'=>false, 'sortable'=>false, 'align'=>'center'))
                    ->renderGrid()
                }}
                
                <div id="btn-toolbar" class="section-header btn-toolbar" role="toolbar" style="margin: 10px 0;">
                    <div id="btn-group-3" class="btn-group">
                        <button class="btn btn-default" id="btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>
                    </div>
                    <div id="btn-group-1" class="btn-group">
                        <button class="btn btn-default" id="btn-edit"><i class="fa fa-edit"></i> Edit</button>
<!--                        <button class="btn btn-default" id="btn-print"><i class="fa fa-print"></i> Cetak WO Lift Off</button>-->
                    </div>
                    <div id="btn-group-2" class="btn-group toolbar-block">
                        <button class="btn btn-default" id="btn-save"><i class="fa fa-save"></i> Save</button>
                        <button class="btn btn-default" id="btn-cancel"><i class="fa fa-close"></i> Cancel</button>
                    </div>
<!--                    <div id="btn-group-5" class="btn-group pull-right">
                        <button class="btn btn-default" id="btn-upload"><i class="fa fa-upload"></i> Upload TPS Online</button>
                    </div>-->
                </div>
            </div>
            
        </div>
        <form class="form-horizontal" id="stripping-form" action="{{ route('lcl-realisasi-stripping-index') }}" method="POST">
            <div class="row">
                <div class="col-md-6">
                    
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    <input id="TCONTAINER_PK" name="TCONTAINER_PK" type="hidden">
                    <input name="delete_photo" id="delete_photo" value="N" type="hidden">
                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. SPK</label>
                        <div class="col-sm-8">
                            <input type="text" id="NoJob" name="NoJob" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. Container</label>
                        <div class="col-sm-8">
                            <input type="text" id="NOCONTAINER" name="NOCONTAINER" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Size</label>
                        <div class="col-sm-3">
                            <input type="text" id="SIZE" name="SIZE" class="form-control" readonly>
                        </div>
                        <label class="col-sm-2 control-label">TPS Asal</label>
                        <div class="col-sm-3">
                            <input type="text" id="KD_TPS_ASAL" name="KD_TPS_ASAL" class="form-control" readonly>
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
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="col-md-6">
                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl.Masuk</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" id="TGLMASUK" name="TGLMASUK" class="form-control pull-right datepicker" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bootstrap-timepicker">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Jam Masuk</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="text" id="JAMMASUK" name="JAMMASUK" class="form-control timepicker" required>
                                    <div class="input-group-addon">
                                          <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Coordinator</label>
                        <div class="col-sm-8">
                            <input type="text" id="coordinator_stripping" name="coordinator_stripping" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Petugas</label>
                        <div class="col-sm-8">
                            <input type="text" id="UIDSTRIPPING" name="UIDSTRIPPING" class="form-control" required readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Jumlah B/L</label>
                        <div class="col-sm-8">
                            <input type="text" id="jumlah_bl" name="jumlah_bl" class="form-control" required readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kubikasi</label>
                        <div class="col-sm-8">
                            <input type="text" id="MEAS" name="MEAS" class="form-control" required readonly>
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
                </div>
                <div class="col-md-6"> 
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Mulai Stripping</label>
                        <div class="col-sm-5">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" id="STARTSTRIPPING" name="STARTSTRIPPING" class="form-control pull-right datepicker" required>
                            </div>
                        </div>
                        <div class="bootstrap-timepicker">
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <input type="text" id="JAMSTARTSTRIPPING" name="JAMSTARTSTRIPPING" class="form-control timepicker" required>
                                    <div class="input-group-addon">
                                          <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Selesai Stripping</label>
                        <div class="col-sm-5">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" id="ENDSTRIPPING" name="ENDSTRIPPING" class="form-control pull-right datepicker" required>
                            </div>
                        </div>
                        <div class="bootstrap-timepicker">
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <input type="text" id="JAMENDSTRIPPING" name="JAMENDSTRIPPING" class="form-control timepicker" required>
                                    <div class="input-group-addon">
                                          <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bootstrap-timepicker">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Mulai Tunda</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="text" id="mulai_tunda" name="mulai_tunda" class="form-control timepicker" required>
                                    <div class="input-group-addon">
                                          <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bootstrap-timepicker">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Selesai Tunda</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="text" id="selesai_tunda" name="selesai_tunda" class="form-control timepicker" required>
                                    <div class="input-group-addon">
                                          <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Keterangan</label>
                        <div class="col-sm-8">
                           <textarea id="keterangan" name="keterangan" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="bootstrap-timepicker">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Working Hours</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="text" id="working_hours" name="working_hours" class="form-control timepicker" required disabled>
                                    <div class="input-group-addon">
                                          <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Operator Forklif</label>
                        <div class="col-sm-8">
                            <input type="text" id="operator_forklif" name="operator_forklif" class="form-control" required>
                        </div>
                    </div>
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
            <form class="form-horizontal" id="upload-photo-form" action="{{ route('lcl-stripping-upload-photo') }}" method="POST" enctype="multipart/form-data">
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
                        <button type="button" class="btn btn-primary" id="view-photo-bl-btn" data-id="">LIHAT PHOTO B/L</button>
                        <hr />
                        <h4>AJU STRIPPING</h4>
                        <div id="container-photo"></div>
                        <hr />
                        <h4>HASIL STRIPPING</h4>
                        <div id="stripping-photo"></div>
                    </div>
                </div>
            </div>    
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

@section('custom_css')

<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/plugins/datepicker/datepicker3.css") }}">
<link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/plugins/timepicker/bootstrap-timepicker.min.css") }}">

@endsection

@section('custom_js')

<script src="{{ asset("/bower_components/AdminLTE/plugins/datepicker/bootstrap-datepicker.js") }}"></script>
<script src="{{ asset("/bower_components/AdminLTE/plugins/timepicker/bootstrap-timepicker.min.js") }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
<script src="{{ asset("/plugins/jQgrid/js/date.js") }}" type="text/javascript"></script>
<script type="text/javascript">
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
    
    $("#view-photo-bl-btn").on("click", function(e){
        e.preventDefault();
        var cont_id = $(this).attr('data-id');

        window.open("{{ route('lcl-realisasi-stripping-view-photo-bl', '') }}/"+cont_id,"View B/L Photo","width=600,height=600,menubar=no,status=no,scrollbars=yes");
    });
    
    $('.select2').select2();
    $('.datepicker').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'yyyy-mm-dd' 
    });
    $('.timepicker').timepicker({ 
        showMeridian: false,
        showInputs: false,
        showSeconds: false,
        defaultTime: false,
        minuteStep: 1,
        secondStep: 1
    });
    $("JAMMASUK").mask("99:99:99");
    $("JAMSTARTSTRIPPING").mask("99:99:99");
    $("JAMENDSTRIPPING").mask("99:99:99");
    $("mulai_tunda").mask("99:99:99");
    $("#selesai_tunda").mask("99:99:99");
    $(".datepicker").mask("9999-99-99");
</script>

@endsection