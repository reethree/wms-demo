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
            edt = '',
            del = ''; 
        for(var i=0;i < ids.length;i++){ 
            var cl = ids[i];
            
            edt = '<a href="{{ route("lcl-manifest-edit",'') }}/'+cl+'"><i class="fa fa-pencil"></i></a> ';
            del = '<a href="{{ route("lcl-manifest-delete",'') }}/'+cl+'" onclick="if (confirm(\'Are You Sure ?\')){return true; }else{return false; };"><i class="fa fa-close"></i></a>';
            jQuery("#lclStrippingGrid").jqGrid('setRowData',ids[i],{action:edt+' '+del}); 
        } 
    }
    
    function onSelectRowEvent()
    {
        $('#btn-group-1').enableButtonGroup();
    }
    
    $(document).ready(function()
    {
        $('#stripping-form').disabledFormGroup();
        $('#btn-toolbar').disabledButtonGroup();
        $('#btn-group-3').enableButtonGroup();
        
        $('#btn-edit').click(function() {
            //Gets the selected row id.
            rowid = $('#lclStrippingGrid').jqGrid('getGridParam', 'selrow');
            rowdata = $('#lclStrippingGrid').getRowData(rowid);
            console.log(rowdata);
            populateFormFields(rowdata, '');
            $('#TCONTAINER_PK').val(rowid);
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
            
            if(rowdata.TGLMASUK && rowdata.JAMMASUK) {
                $('#btn-group-2').enableButtonGroup();
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
                    ->setGridOption('rownumbers', true)
                    ->setGridOption('height', '250')
                    ->setGridOption('rowList',array(20,50,100))
                    ->setGridOption('useColSpanStyle', true)
                    ->setNavigatorOptions('navigator', array('viewtext'=>'view'))
                    ->setNavigatorOptions('view',array('closeOnEscape'=>false))
                    ->setFilterToolbarOptions(array('autosearch'=>true))
                    ->setGridEvent('gridComplete', 'gridCompleteEvent')
                    ->setGridEvent('onSelectRow', 'onSelectRowEvent')
        //            ->addColumn(array('label'=>'Action','index'=>'action', 'width'=>80, 'search'=>false, 'sortable'=>false, 'align'=>'center'))
                    ->addColumn(array('key'=>true,'index'=>'TCONTAINER_PK','hidden'=>true))
                    ->addColumn(array('label'=>'No. Container','index'=>'NOCONTAINER','width'=>150))
                    ->addColumn(array('label'=>'No. Joborder','index'=>'NoJob','width'=>150))
                    ->addColumn(array('label'=>'Tgl. ETA','index'=>'ETA','width'=>120))
                    ->addColumn(array('label'=>'Consolidator','index'=>'NAMACONSOLIDATOR','width'=>250))
                    ->addColumn(array('label'=>'No. BC11','index'=>'NO_BC11','width'=>120))
                    ->addColumn(array('label'=>'Tgl. BC11','index'=>'TGL_BC11','width'=>120,'hidden'=>true))
                    ->addColumn(array('label'=>'No. PLP','index'=>'NO_PLP','width'=>120))
                    ->addColumn(array('label'=>'Tgl. PLP','index'=>'TGL_PLP','width'=>120,'hidden'=>true))
                    ->addColumn(array('label'=>'Size','index'=>'SIZE', 'width'=>80,'align'=>'center'))
        //            ->addColumn(array('label'=>'Teus','index'=>'TEUS', 'width'=>80,'align'=>'center'))
                    ->addColumn(array('label'=>'No. Seal','index'=>'NO_SEAL', 'width'=>120,'align'=>'right'))
                    ->addColumn(array('label'=>'Tgl. Masuk','index'=>'TGLMASUK','width'=>120))
                    ->addColumn(array('label'=>'Jam Masuk','index'=>'JAMMASUK','width'=>120))
                    ->addColumn(array('label'=>'Coordinator','index'=>'coordinator_stripping','hidden'=>true))           
                    ->addColumn(array('label'=>'Petugas','index'=>'UIDSTRIPPING','hidden'=>true))
                    ->addColumn(array('label'=>'Jumlah B/L','index'=>'jumlah_bl','hidden'=>true))
                    ->addColumn(array('label'=>'Mulai Stripping','index'=>'STARTSTRIPPING','align'=>'center','hidden'=>false))
                    ->addColumn(array('label'=>'Jam Mulai','index'=>'JAMSTARTSTRIPPING','hidden'=>true))
                    ->addColumn(array('label'=>'Selesai Stripping','index'=>'ENDSTRIPPING','align'=>'center','hidden'=>false))
                    ->addColumn(array('label'=>'Jam Selesai','index'=>'JAMENDSTRIPPING','hidden'=>true))
                    ->addColumn(array('label'=>'MEAS','index'=>'MEAS','hidden'=>true))
                    ->addColumn(array('label'=>'Mulai Tunda','index'=>'mulai_tunda','hidden'=>true))
                    ->addColumn(array('label'=>'Selesai Tunda','index'=>'selesai_tunda','hidden'=>true))
                    ->addColumn(array('label'=>'Keterangan','index'=>'keterangan','hidden'=>true))
                    ->addColumn(array('label'=>'Working Hours','index'=>'working_hours','hidden'=>true))
                    ->addColumn(array('label'=>'Operator Forklif','index'=>'operator_forklif','hidden'=>true))
        //            ->addColumn(array('label'=>'Layout','index'=>'layout','width'=>80,'align'=>'center','hidden'=>true))
        //            ->addColumn(array('label'=>'UID','index'=>'UID', 'width'=>150))
                    ->addColumn(array('label'=>'Tgl. Entry','index'=>'TGLENTRY', 'width'=>150))
                    ->addColumn(array('label'=>'Updated','index'=>'last_update', 'width'=>150, 'search'=>false))
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
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Consolidator</label>
                        <div class="col-sm-8">
                            <input type="text" id="NAMACONSOLIDATOR" name="NAMACONSOLIDATOR" class="form-control" readonly>
                        </div>
                    </div>
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