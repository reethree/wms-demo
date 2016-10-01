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
        var ids = jQuery("#lclBuangmtyGrid").jqGrid('getDataIDs'),
            edt = '',
            del = ''; 
        for(var i=0;i < ids.length;i++){ 
            var cl = ids[i];
            
            edt = '<a href="{{ route("lcl-manifest-edit",'') }}/'+cl+'"><i class="fa fa-pencil"></i></a> ';
            del = '<a href="{{ route("lcl-manifest-delete",'') }}/'+cl+'" onclick="if (confirm(\'Are You Sure ?\')){return true; }else{return false; };"><i class="fa fa-close"></i></a>';
            jQuery("#lclBuangmtyGrid").jqGrid('setRowData',ids[i],{action:edt+' '+del}); 
        } 
    }
    
    function onSelectRowEvent()
    {
        $('#btn-group-1').enableButtonGroup();
        $('#btn-group-4').enableButtonGroup();
    }
    
    $(document).ready(function()
    {
        $('#buangmty-form').disabledFormGroup();
        $('#btn-toolbar').disabledButtonGroup();
        $('#btn-group-3').enableButtonGroup();
        
        $('#btn-edit').click(function() {
            //Gets the selected row id.
            rowid = $('#lclBuangmtyGrid').jqGrid('getGridParam', 'selrow');
            rowdata = $('#lclBuangmtyGrid').getRowData(rowid);
            console.log(rowdata);
            populateFormFields(rowdata, '');
            $('#TCONTAINER_PK').val(rowid);
            $('#NOPOL_MTY').val(rowdata.NOPOL_MTY);
            $('#TUJUAN_MTY').val(rowdata.TUJUAN_MTY);
            if(rowdata.STARTSTRIPPING && rowdata.STARTSTRIPPING) {
                $('#btn-group-2').enableButtonGroup();
                $('#buangmty-form').enableFormGroup();
                $('#UIDMTY').val('{{ Auth::getUser()->name }}');
            }else{
                $('#btn-group-2').disabledButtonGroup();
                $('#buangmty-form').disabledFormGroup();
            }

        });
        
        $('#btn-print-bon').click(function() {

        });
        
        $('#btn-print-cir').click(function() {

        });
        
        $('#btn-save').click(function() {
            
            var url = $('#buangmty-form').attr('action')+'/edit/'+$('#TCONTAINER_PK').val();

            $.ajax({
                type: 'POST',
                data: JSON.stringify($('#buangmty-form').formToObject('')),
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
            $('#lclBuangmtyGrid').jqGrid().trigger("reloadGrid");
            $('#buangmty-form').disabledFormGroup();
            $('#btn-toolbar').disabledButtonGroup();
            $('#btn-group-3').enableButtonGroup();
            
            $('#buangmty-form')[0].reset();
            $('.select2').val(null).trigger("change");
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
                    GridRender::setGridId("lclBuangmtyGrid")
                    ->enableFilterToolbar()
                    ->setGridOption('url', URL::to('/lcl/register/grid-data'))
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
                    ->addColumn(array('label'=>'No. Seal','index'=>'NO_SEAL', 'width'=>120,'align'=>'right'))
                    ->addColumn(array('label'=>'Tgl. Masuk','index'=>'TGLMASUK','width'=>120))
                    ->addColumn(array('label'=>'Jam Masuk','index'=>'JAMMASUK','width'=>120))
                    ->addColumn(array('label'=>'Start Stripping','index'=>'STARTSTRIPPING','hidden'=>true))
                    ->addColumn(array('label'=>'End Stripping','index'=>'ENDSTRIPPING','hidden'=>true))
                    ->addColumn(array('label'=>'Tgl. Buang MTY','index'=>'TGLBUANGMTY','hidden'=>true))
                    ->addColumn(array('label'=>'Jam Buang MTY','index'=>'JAMBUANGMTY','hidden'=>true))
                    ->addColumn(array('label'=>'No. POL MTY','index'=>'NOPOL_MTY','hidden'=>true))
                    ->addColumn(array('label'=>'Tujuan MTY','index'=>'TUJUAN_MTY','hidden'=>true))
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
                    <div id="btn-group-4" class="btn-group">
                        <button class="btn btn-default" id="btn-print-bon"><i class="fa fa-print"></i> Cetak BON Muat</button>
                        <button class="btn btn-default" id="btn-print-cir"><i class="fa fa-print"></i> Cetak Surat Jalan (CIR)</button>
                    </div>
                    <div id="btn-group-5" class="btn-group">
                        <button class="btn btn-default" id="btn-upload"><i class="fa fa-upload"></i> Upload TPS Online</button>
                    </div>
                </div>
            </div>
            
        </div>
        <form class="form-horizontal" id="buangmty-form" action="{{ route('lcl-realisasi-buangmty-index') }}" method="POST">
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
                        <label class="col-sm-3 control-label">Tgl.Buang MTY</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" id="TGLBUANGMTY" name="TGLBUANGMTY" class="form-control pull-right datepicker" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bootstrap-timepicker">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Jam Buang MTY</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="text" id="JAMBUANGMTY" name="JAMBUANGMTY" class="form-control timepicker" required>
                                    <div class="input-group-addon">
                                          <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6"> 
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Petugas</label>
                        <div class="col-sm-8">
                            <input type="text" id="UIDMTY" name="UIDMTY" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Lokasi</label>
                        <div class="col-sm-8">
                            <input type="text" id="LOKASI_MTY" name="LOKASI_MTY" class="form-control" required value="PRIMANATA">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No.Pol</label>
                        <div class="col-sm-8">
                            <input type="text" id="NOPOL_MTY" name="NOPOL_MTY" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tujuan</label>
                        <div class="col-sm-8">
                            <input type="text" id="TUJUAN_MTY" name="TUJUAN_MTY" class="form-control" required>
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
        showSeconds: true,
        defaultTime: false,
        minuteStep: 1,
        secondStep: 1
    });
</script>

@endsection