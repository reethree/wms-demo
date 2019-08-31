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
        var ids = jQuery("#lclGateinGrid").jqGrid('getDataIDs'),
            edt = '',
            del = '',
            vi = ''; 
        for(var i=0;i < ids.length;i++){ 
            var cl = ids[i];
            rowdata = $('#lclInoutReportGrid').getRowData(cl);
//            edt = '<a href="{{ route("lcl-manifest-edit",'') }}/'+cl+'"><i class="fa fa-pencil"></i></a> ';
//            del = '<a href="{{ route("lcl-manifest-delete",'') }}/'+cl+'" onclick="if (confirm(\'Are You Sure ?\')){return true; }else{return false; };"><i class="fa fa-close"></i></a>';
//            jQuery("#lclGateinGrid").jqGrid('setRowData',ids[i],{action:edt+' '+del}); 
        } 
    }
    
    function onSelectRowEvent()
    {
        $('#btn-group-1, #btn-group-4').enableButtonGroup();
    }
    
    $(document).ready(function()
    {
        $('#gatein-form').disabledFormGroup();
        $('#btn-toolbar, #btn-photo').disabledButtonGroup();
        $('#btn-group-3').enableButtonGroup();
        
        $('#btn-edit').click(function() {
            //Gets the selected row id.
            rowid = $('#lclGateinGrid').jqGrid('getGridParam', 'selrow');
            rowdata = $('#lclGateinGrid').getRowData(rowid);

            populateFormFields(rowdata, '');
            $('#TCONTAINER_PK').val(rowid);
            $('#NO_BC11').val(rowdata.NO_BC11);
            $('#TGL_BC11').val(rowdata.TGL_BC11);
            $('#NO_PLP').val(rowdata.NO_PLP);
            $('#TGL_PLP').val(rowdata.TGL_PLP);
            $('#KD_TPS_ASAL').val(rowdata.KD_TPS_ASAL);
            $("#P_TGLKELUAR").datepicker('setDate', rowdata.P_TGLKELUAR);
            $('#NO_SP2').val(rowdata.NO_SP2);
            $("#TGL_SP2").datepicker('setDate', rowdata.TGL_SP2);
            $('#ESEALCODE').val(rowdata.ESEALCODE).trigger('change');
            $('#TGLKELUAR_TPK').val(rowdata.TGLKELUAR_TPK);
            $('#JAMKELUAR_TPK').val(rowdata.JAMKELUAR_TPK);
            
            $('#upload-title').html('Upload Photo for '+rowdata.NOCONTAINER);
            $('#no_cont').val(rowdata.NOCONTAINER);
            $('#id_cont').val(rowdata.TCONTAINER_PK);
            $('#load_photos').html('');
            $('#delete_photo').val('N');
            
            if(rowdata.photo_gatein_extra){
                var html = '';
                var photos = $.parseJSON(rowdata.photo_gatein_extra);
                $.each(photos, function(i, item) {
                    /// do stuff
                    html += '<img src="{{url("uploads/photos/container/lcl/")}}/'+rowdata.NOCONTAINER+'/'+item+'" style="width: 200px;padding:5px;" />';
                });
                $('#load_photos').html(html);
            }
            
            $('#btn-group-2,#btn-photo').enableButtonGroup();
            $('#btn-group-5').enableButtonGroup();
            $('#gatein-form').enableFormGroup();
            if(!rowdata.TGLMASUK && !rowdata.JAMMASUK) {             
                $('#UIDMASUK').val('{{ Auth::getUser()->name }}');
            }else{
                @role('super-admin')

                @else
                    $("#TGLMASUK").attr('disabled','disabled');
                    $("#JAMMASUK").attr('disabled','disabled');
                @endrole  
            }

        });
        
        $('#btn-print').click(function() {
            
        });
        
        $('#btn-save').click(function() {
            
            if(!confirm('Apakah anda yakin?')){return false;}
            
            var url = $('#gatein-form').attr('action')+'/edit/'+$('#TCONTAINER_PK').val();

            $.ajax({
                type: 'POST',
                data: JSON.stringify($('#gatein-form').formToObject('')),
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
            $('#lclGateinGrid').jqGrid().trigger("reloadGrid");
            $('#gatein-form').disabledFormGroup();
            $('#btn-toolbar, #btn-photo').disabledButtonGroup();
            $('#btn-group-3').enableButtonGroup();
            
            $('#gatein-form')[0].reset();
            $('.select2').val(null).trigger("change");
            $('#TCONTAINER_PK').val("");
        });
        
        $('#btn-upload').click(function(){
            
            if(!confirm('Apakah anda yakin?')){return false;}
            
            if($('#NAMACONSOLIDATOR').val() == ''){
                alert('Consolidator masih kosong!');
                return false;
            }else if($('#NO_BC11').val() == ''){
                alert('No. BC11 masih kosong!');
                return false;
            }else if($('#TGL_BC11').val() == ''){
                alert('Tgl. BC11 masih kosong!');
                return false;
            }else if($('#NO_PLP').val() == ''){
                alert('No. PLP masih kosong!');
                return false;
            }else if($('#TGL_PLP').val() == ''){
                alert('Tgl. PLP masih kosong!');
                return false;
            }else if($('#TGLMASUK').val() == '' || $('#JAMMASUK').val() == ''){
                alert('Tanggal / Jam Masuk masih kosong!');
                return false;
            }
            
            var url = '{{ route("lcl-realisasi-gatein-upload") }}';
            
            $.ajax({
                type: 'POST',
                data: 
                {
                    'id' : $('#TCONTAINER_PK').val(),
                    '_token' : '{{ csrf_token() }}'
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
                    
                    $('#tpsonline-modal-text').html(json.message+', Apakah anda ingin mengirimkan COARI Kontainer XML data sekarang?');
                    $("#tpsonline-send-btn").attr("href", "{{ route('tps-coariCont-upload','') }}/"+json.insert_id);
                    
                    $('#tpsonline-modal').modal('show');
                }
            });
            
        });
        
    });
    
</script>

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">LCL Realisasi Masuk / Gate In</h3>
<!--        <div class="box-tools">
            <a href="{{ route('lcl-manifest-create') }}" type="button" class="btn btn-block btn-info btn-sm"><i class="fa fa-plus"></i> Add New</a>
        </div>-->
    </div>
    <div class="box-body">
        <div class="row" style="margin-bottom: 30px;">
            <div class="col-md-12"> 
                {{
                    GridRender::setGridId("lclGateinGrid")
                    ->enableFilterToolbar()
                    ->setGridOption('mtype', 'POST')
                    ->setGridOption('url', URL::to('/lcl/register/grid-data?module=gatein&_token='.csrf_token()))
                    ->setGridOption('rowNum', 20)
                    ->setGridOption('shrinkToFit', true)
                    ->setGridOption('sortname','TCONTAINER_PK')
                    ->setGridOption('rownumbers', true)
                    ->setGridOption('height', '300')
                    ->setGridOption('rowList',array(20,50,100))
                    ->setGridOption('useColSpanStyle', true)
                    ->setNavigatorOptions('navigator', array('viewtext'=>'view'))
                    ->setNavigatorOptions('view',array('closeOnEscape'=>false))
                    ->setFilterToolbarOptions(array('autosearch'=>true))
                    ->setGridEvent('gridComplete', 'gridCompleteEvent')
                    ->setGridEvent('onSelectRow', 'onSelectRowEvent')
        //            ->addColumn(array('label'=>'Action','index'=>'action', 'width'=>80, 'search'=>false, 'sortable'=>false, 'align'=>'center'))
                    ->addColumn(array('key'=>true,'index'=>'TCONTAINER_PK','hidden'=>true))
                    ->addColumn(array('label'=>'No. Joborder','index'=>'NoJob','width'=>150))
                    ->addColumn(array('label'=>'No. Container','index'=>'NOCONTAINER','width'=>150))
                    ->addColumn(array('label'=>'Size','index'=>'SIZE', 'width'=>80,'align'=>'center'))
                    ->addColumn(array('label'=>'Teus','index'=>'TEUS', 'width'=>80,'align'=>'center'))
                    ->addColumn(array('label'=>'Vessel','index'=>'VESSEL','width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'Tgl. ETA','index'=>'ETA','width'=>120,'align'=>'center'))
                    ->addColumn(array('label'=>'TPS Asal','index'=>'KD_TPS_ASAL','width'=>80,'align'=>'center'))
                    ->addColumn(array('label'=>'Tgl. Dispatche','index'=>'TGL_DISPATCHE','width'=>120,'align'=>'center'))
                    ->addColumn(array('label'=>'Jam Dispatche','index'=>'JAM_DISPATCHE','width'=>120,'align'=>'center'))
                    ->addColumn(array('label'=>'Tgl. Masuk','index'=>'TGLMASUK','width'=>120,'align'=>'center'))
                    ->addColumn(array('label'=>'Jam Masuk','index'=>'JAMMASUK','width'=>120,'align'=>'center'))
                    ->addColumn(array('label'=>'Tgl. Keluar TPK','index'=>'TGLKELUAR_TPK','width'=>120,'align'=>'center'))
                    ->addColumn(array('label'=>'Jam Keluar TPK','index'=>'JAMKELUAR_TPK','width'=>120,'align'=>'center'))
                    ->addColumn(array('label'=>'No. POL','index'=>'NOPOL','align'=>'center'))
                    ->addColumn(array('label'=>'No. BC11','index'=>'NO_BC11','width'=>120,'hidden'=>true))
                    ->addColumn(array('label'=>'Tgl. BC11','index'=>'TGL_BC11','width'=>120,'hidden'=>true))
                    ->addColumn(array('label'=>'No. PLP','index'=>'NO_PLP','width'=>120,'hidden'=>true))
                    ->addColumn(array('label'=>'Tgl. PLP','index'=>'TGL_PLP','width'=>120,'hidden'=>true))
                    ->addColumn(array('label'=>'Weight','index'=>'WEIGHT','hidden'=>true))
//                    ->addColumn(array('label'=>'No. Seal','index'=>'NO_SEAL', 'width'=>120,'align'=>'right'))
                    
//                    ->addColumn(array('label'=>'Perkiraan Keluar','index'=>'P_TGLKELUAR','hidden'=>true))
                    ->addColumn(array('label'=>'Petugas','index'=>'UIDMASUK','hidden'=>true))
 
                    ->addColumn(array('label'=>'Photo Gate In','index'=>'photo_get_in', 'width'=>70,'hidden'=>true))
                    ->addColumn(array('label'=>'Photo Gate Out','index'=>'photo_get_out', 'width'=>70,'hidden'=>true))
                    ->addColumn(array('label'=>'Photo Extra','index'=>'photo_gatein_extra', 'width'=>70,'hidden'=>true))
//                    ->addColumn(array('label'=>'No. SP2','index'=>'NO_SP2','width'=>120,'hidden'=>true))
//                    ->addColumn(array('label'=>'Tgl. SP2','index'=>'TGL_SP2','hidden'=>true))
                    ->addColumn(array('label'=>'E-Seal','index'=>'ESEALCODE','align'=>'center'))
        //            ->addColumn(array('label'=>'Layout','index'=>'layout','width'=>80,'align'=>'center','hidden'=>true))
                    ->addColumn(array('label'=>'UID','index'=>'UID', 'width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'Tgl. Entry','index'=>'TGLENTRY', 'width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'Updated','index'=>'last_update', 'width'=>150, 'search'=>false,'align'=>'center'))
        //            ->addColumn(array('label'=>'Action','index'=>'action', 'width'=>80, 'search'=>false, 'sortable'=>false, 'align'=>'center'))
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
                        <button class="btn btn-default" id="btn-print"><i class="fa fa-print"></i> Cetak WO Lift Off</button>
                    </div>
                    <div id="btn-group-5" class="btn-group pull-right">
                        <button class="btn btn-default" id="btn-upload"><i class="fa fa-upload"></i> Upload TPS Online</button>
                    </div>
                </div>
            </div>
            
        </div>
        <form class="form-horizontal" id="gatein-form" action="{{ route('lcl-realisasi-gatein-index') }}" method="POST">
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
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Weight</label>
                        <div class="col-sm-8">
                            <input type="text" id="WEIGHT" name="WEIGHT" class="form-control">
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
                        <label class="col-sm-3 control-label">Tgl.Kaluar TPK</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" id="TGLKELUAR_TPK" name="TGLKELUAR_TPK" class="form-control pull-right datepicker" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bootstrap-timepicker">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Jam Kaluar TPK</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="text" id="JAMKELUAR_TPK" name="JAMKELUAR_TPK" class="form-control timepicker" required>
                                    <div class="input-group-addon">
                                          <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
<!--                    <div class="form-group">
                        <label class="col-sm-3 control-label">Perkiraan Tgl.Kaluar</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" id="P_TGLKELUAR" name="P_TGLKELUAR" class="form-control pull-right datepicker" required value="{{ date('Y-m-d',strtotime('+3Days')) }}">
                            </div>
                        </div>
                    </div>-->
                </div>
                <div class="col-md-6"> 
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Petugas</label>
                        <div class="col-sm-8">
                            <input type="text" id="UIDMASUK" name="UIDMASUK" class="form-control" required readonly value="{{ Auth::getUser()->name }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No.POL</label>
                        <div class="col-sm-8">
                            <input type="text" id="NOPOL" name="NOPOL" class="form-control" required>
                        </div>
                    </div>
<!--                    <div class="form-group">
                        <label class="col-sm-3 control-label">No.SP2</label>
                        <div class="col-sm-8">
                            <input type="text" id="NO_SP2" name="NO_SP2" class="form-control" required>
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl.SP2</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" id="TGL_SP2" name="TGL_SP2" class="form-control pull-right datepicker" required>
                            </div>
                        </div>
                    </div>-->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">E-Seal</label>
                        <div class="col-sm-8">
                            <select class="form-control select2" id="ESEALCODE" name="ESEALCODE" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                <option value="">Choose E-Seal</option>
                                @foreach($eseals as $eseal)
                                    <option value="{{ $eseal->code }}">{{ $eseal->code }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group hide-kddoc" id="btn-photo">
                        <label class="col-sm-3 control-label">Photo</label>
                        <div class="col-sm-8">
                            <button type="button" class="btn btn-warning" id="upload-photo-btn">Upload Photo</button>
                            <button type="button" class="btn btn-danger" id="delete-photo-btn">Delete Photo</button>
                        </div>
                    </div>
                    <div class="form-group hide-kddoc">
                        <div class="col-sm-12">
                            <div id="load_photos" style="text-align: center;"></div>
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
            <form class="form-horizontal" id="upload-photo-form" action="{{ route('lcl-gatein-upload-photo') }}" method="POST" enctype="multipart/form-data">
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
    $('.select2').select2();
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
    $('#TGLMASUK').on("change", function (e) { 
        var actualDate = new Date($(this).val());
        var newDate = new Date(actualDate.getFullYear(), actualDate.getMonth(), actualDate.getDate()+3);
        $('#P_TGLKELUAR').datepicker('setDate', newDate );
    });
    $("#JAMMASUK").mask("99:99:99");
    $("#JAMKELUAR_TPK").mask("99:99:99");
    $(".datepicker").mask("9999-99-99");
</script>

@endsection