@extends('layout')

@section('content')
<style>
    .bootstrap-timepicker-widget {
        left: 27%;
    }
</style>
<script>
    
    function onSelectRowEvent()
    {
        $('#btn-group-1, #btn-group-4, #btn-group-5').enableButtonGroup();
    }
    
    $(document).ready(function()
    {
        $('#dispatche-form').disabledFormGroup();
        $('#btn-toolbar').disabledButtonGroup();
        $('#btn-group-3').enableButtonGroup();
        
        $('#btn-edit').click(function() {
            //Gets the selected row id.
            rowid = $('#fclDispatcheGrid').jqGrid('getGridParam', 'selrow');
            rowdata = $('#fclDispatcheGrid').getRowData(rowid);

            populateFormFields(rowdata, '');
            $('#TCONTAINER_PK').val(rowid);
            $('#NOJOBORDER').val(rowdata.NoJob);
            $('#NO_PLP').val(rowdata.NO_PLP);
            $('#TGL_PLP').val(rowdata.TGL_PLP);
            $('#ESEALCODE').val(rowdata.ESEALCODE).trigger('change');
            $('#RESPONSE_DISPATCHE').val(rowdata.RESPONSE_DISPATCHE);
            $('#STATUS_DISPATCHE').val(rowdata.STATUS_DISPATCHE);
            $('#KODE_DISPATCHE').val(rowdata.KODE_DISPATCHE);
            $('#DO_ID').val(rowdata.DO_ID);

//            if(!rowdata.TGLRELEASE && !rowdata.JAMRELEASE) {
                $('#btn-group-2').enableButtonGroup();
                $('#dispatche-form').enableFormGroup();
//            }else{
//                $('#btn-group-2').disabledButtonGroup();
//                $('#dispatche-form').disabledFormGroup();
//            }

        });
        
        $('#btn-print').click(function() {
            
        });
        
        $('#btn-upload').click(function() {
            if(!confirm('Apakah anda yakin?')){return false;}
            
            if($('#NO_PLP').val() == ''){
                alert('No. PLP masih kosong!');
                return false;
            }else if($('#TGL_PLP').val() == ''){
                alert('Tgl. PLP masih kosong!');
                return false;
            }else if($('#ESEALCODE').val() == ''){
                alert('E-Seal masih kosong!');
                return false;
            }else if($('#NOPOL').val() == ''){
                alert('No. POL masih kosong!');
                return false;
            }
            
            $.ajax({
                type: 'POST',
                data: JSON.stringify($('#dispatche-form').formToObject('')),
                dataType : 'json',
                url: '{{ route("easygo-inputdo") }}',
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

        $('#btn-save').click(function() {
            
            if(!confirm('Apakah anda yakin?')){return false;}
            
            var manifestId = $('#TCONTAINER_PK').val();
            var url = "{{route('fcl-dispatche-update','')}}/"+manifestId;

            $.ajax({
                type: 'POST',
                data: JSON.stringify($('#dispatche-form').formToObject('')),
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
            $('#fclDispatcheGrid').jqGrid().trigger("reloadGrid");
            $('#dispatche-form').disabledFormGroup();
            $('#btn-toolbar').disabledButtonGroup();
            $('#btn-group-3').enableButtonGroup();
            
            $('#dispatche-form')[0].reset();
            $('.select2').val(null).trigger("change");
            $('#TMANIFEST_PK').val("");
        });
        
    });
    
</script>

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">LCL Dispatche E-Seal</h3>
    </div>
    <div class="box-body">
        <div class="row" style="margin-bottom: 30px;">
            <div class="col-md-12"> 
                {{
                    GridRender::setGridId("fclDispatcheGrid")
                    ->enableFilterToolbar()
                    ->setGridOption('mtype', 'POST')
                    ->setGridOption('url', URL::to('/container/grid-data-cy?_token='.csrf_token()))
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
                    ->setGridEvent('onSelectRow', 'onSelectRowEvent')
                    ->addColumn(array('key'=>true,'index'=>'TCONTAINER_PK','hidden'=>true))
                    ->addColumn(array('label'=>'No. Container','index'=>'NOCONTAINER','width'=>160,'editable' => true, 'editrules' => array('required' => true)))
                    ->addColumn(array('label'=>'No. SPK','index'=>'NoJob','width'=>160))
                    ->addColumn(array('label'=>'No. MBL','index'=>'NOMBL','width'=>160))
                    ->addColumn(array('label'=>'Tgl. MBL','index'=>'TGL_MASTER_BL','width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'Consolidator','index'=>'NAMACONSOLIDATOR','width'=>250))
                    ->addColumn(array('label'=>'Vessel','index'=>'VESSEL', 'width'=>100,'align'=>'center'))
                    ->addColumn(array('label'=>'Voy','index'=>'VOY', 'width'=>100,'align'=>'center'))
//                    ->addColumn(array('label'=>'Tgl. Behandle','index'=>'TGLBEHANDLE','width'=>150,'align'=>'center'))
//                    ->addColumn(array('label'=>'Jam. Behandle','index'=>'JAMBEHANDLE', 'width'=>150,'align'=>'center','hidden'=>true))
//                    ->addColumn(array('label'=>'Tgl. Fiat','index'=>'TGLFIAT','width'=>150,'align'=>'center'))
//                    ->addColumn(array('label'=>'Jam. Fiat','index'=>'JAMFIAT', 'width'=>150,'align'=>'center','hidden'=>true))
//                    ->addColumn(array('label'=>'Tgl. Surat Jalan','index'=>'TGLSURATJALAN','width'=>150,'align'=>'center'))
//                    ->addColumn(array('label'=>'Jam. Surat Jalan','index'=>'JAMSURATJALAN', 'width'=>150,'align'=>'center','hidden'=>true))
//                    ->addColumn(array('label'=>'Tgl. Dispatche','index'=>'TGLRELEASE','width'=>150,'align'=>'center'))
//                    ->addColumn(array('label'=>'Jam. Dispatche','index'=>'JAMRELEASE', 'width'=>150,'align'=>'center','hidden'=>true))
                    ->addColumn(array('label'=>'No. BC11','index'=>'NO_BC11','width'=>130,'align'=>'right'))
                    ->addColumn(array('label'=>'Tgl. BC11','index'=>'TGL_BC11','width'=>130,'align'=>'center'))
                    ->addColumn(array('label'=>'Tgl. POS BC11','index'=>'NO_POS_BC11','width'=>130,'align'=>'center'))
                    ->addColumn(array('label'=>'No. PLP','index'=>'NO_PLP','width'=>130,'align'=>'right'))
                    ->addColumn(array('label'=>'Tgl. PLP','index'=>'TGL_PLP','width'=>130,'align'=>'center'))
                    ->addColumn(array('label'=>'No. SPJM','index'=>'NO_SPJM', 'width'=>130))
                    ->addColumn(array('label'=>'Tgl. SPJM','index'=>'TGL_SPJM', 'width'=>130))
                    ->addColumn(array('label'=>'No. SPPB','index'=>'NO_SPPB', 'width'=>130))
                    ->addColumn(array('label'=>'Tgl. SPPB','index'=>'TGL_SPPB', 'width'=>150))
                    ->addColumn(array('label'=>'Tgl. Keluar TPK','index'=>'TGL_KELUAR_TPK_ESEAL', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('label'=>'Jam Keluar TPK','index'=>'JAM_KELUAR_TPK_ESEAL', 'width'=>150,'hidden'=>true))
//                    ->addColumn(array('label'=>'Kode Dokumen','index'=>'KODE_DOKUMEN', 'width'=>150,'hidden'=>true))
//                    ->addColumn(array('index'=>'KD_DOK_INOUT', 'width'=>150,'hidden'=>true))
//                    ->addColumn(array('label'=>'Kode Kuitansi','index'=>'NO_KUITANSI', 'width'=>150,'hidden'=>true))
//                    ->addColumn(array('label'=>'Consignee','index'=>'CONSIGNEE','width'=>160))
//                    ->addColumn(array('label'=>'Importir','index'=>'NAMA_IMP','width'=>160))
//                    ->addColumn(array('label'=>'NPWP Importir','index'=>'NPWP_IMP','width'=>160))
                    ->addColumn(array('label'=>'E-Seal','index'=>'ESEALCODE','width'=>120,'align'=>'center'))
                    ->addColumn(array('label'=>'No. POL','index'=>'NOPOL','width'=>120,'align'=>'center'))
                    ->addColumn(array('label'=>'DO ID','index'=>'DO_ID','width'=>120,'align'=>'center'))
                    ->addColumn(array('label'=>'Status','index'=>'STATUS_DISPATCHE','width'=>60,'align'=>'center'))
                    ->addColumn(array('label'=>'Kode','index'=>'KODE_DISPATCHE','width'=>60,'align'=>'center'))
                    ->addColumn(array('label'=>'Response','index'=>'RESPONSE_DISPATCHE','width'=>120,'align'=>'center','hidden'=>false))
                    ->addColumn(array('label'=>'Tgl. Dispatche','index'=>'TGL_DISPATCHE','width'=>130,'align'=>'center'))
                    ->addColumn(array('label'=>'Jam Dispatche','index'=>'JAM_DISPATCHE','width'=>130,'align'=>'center'))
                    ->addColumn(array('label'=>'ETA','index'=>'ETA', 'width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'Size','index'=>'SIZE', 'width'=>80,'align'=>'center','editable' => true, 'editrules' => array('required' => true,'number'=>true),'edittype'=>'select','editoptions'=>array('value'=>"20:20;40:40")))
                    ->addColumn(array('label'=>'Teus','index'=>'TEUS', 'width'=>80,'align'=>'center','editable' => false))
                    ->addColumn(array('label'=>'No. Seal','index'=>'NOSEGEL', 'width'=>120,'editable' => true, 'align'=>'right'))
                    ->addColumn(array('label'=>'Weight','index'=>'WEIGHT', 'width'=>120,'editable' => true, 'align'=>'right','editrules' => array('required' => true)))
                    ->addColumn(array('label'=>'Measurment','index'=>'MEAS', 'width'=>120,'editable' => true, 'align'=>'right','editrules' => array('required' => true)))
                    ->addColumn(array('label'=>'Layout','index'=>'layout', 'width'=>80,'editable' => true,'align'=>'center','editoptions'=>array('defaultValue'=>"C-1")))
                    ->addColumn(array('label'=>'UID','index'=>'UID', 'width'=>150))
//                    ->addColumn(array('label'=>'Nama EMKL','index'=>'NAMAEMKL', 'width'=>150,'hidden'=>true)) 
//                    ->addColumn(array('label'=>'Telp. EMKL','index'=>'TELPEMKL', 'width'=>150,'hidden'=>true)) 
//                    ->addColumn(array('label'=>'No. Truck','index'=>'NOPOL', 'width'=>150,'hidden'=>true)) 
//                    ->addColumn(array('label'=>'No. POL','index'=>'NOPOLCIROUT', 'width'=>150,'hidden'=>true))
//                    ->addColumn(array('label'=>'No. POL Out','index'=>'NOPOL_OUT', 'width'=>150,'hidden'=>true))
//                    ->addColumn(array('label'=>'Ref. Number Out','index'=>'REF_NUMBER_OUT', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('label'=>'Tgl. Entry','index'=>'TGLENTRY', 'width'=>150, 'search'=>false))
                    ->addColumn(array('label'=>'Jam. Entry','index'=>'JAMENTRY', 'width'=>150, 'search'=>false, 'hidden'=>true))
                    ->addColumn(array('label'=>'Updated','index'=>'last_update', 'width'=>150, 'search'=>false))
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
<!--                    <div id="btn-group-4" class="btn-group">
                        <button class="btn btn-default" id="btn-print"><i class="fa fa-print"></i> Cetak Surat Jalan</button>
                    </div>-->
                    <div id="btn-group-5" class="btn-group pull-right">
                        <button class="btn btn-default" id="btn-upload"><i class="fa fa-upload"></i> Upload EasyGO</button>
                    </div>
                </div>
            </div>
            
        </div>
        <form class="form-horizontal" id="dispatche-form" action="{{ route('fcl-delivery-release-index') }}" method="POST">
            <div class="row">
                <div class="col-md-6">
                    
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    <input id="TCONTAINER_PK" name="TCONTAINER_PK" type="hidden">
                    <input id="container_type" name="container_type" type="hidden" value="F">
<!--                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. SPK</label>
                        <div class="col-sm-8">
                            <input type="text" id="NOJOBORDER" name="NOJOBORDER" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. MBL</label>
                        <div class="col-sm-8">
                            <input type="text" id="NOMBL" name="NOMBL" class="form-control" readonly>
                        </div>
                    </div>-->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. Container</label>
                        <div class="col-sm-8">
                            <input type="text" id="NOCONTAINER" name="NOCONTAINER" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Size</label>
                        <div class="col-sm-8">
                            <input type="text" id="SIZE" name="SIZE" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Vessel</label>
                        <div class="col-sm-8">
                            <input type="text" id="VESSEL" name="VESSEL" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. PLP</label>
                        <div class="col-sm-3">
                            <input type="text" id="NO_PLP" name="NO_PLP" class="form-control" readonly>
                        </div>
                        <label class="col-sm-2 control-label">Tgl. PLP</label>
                        <div class="col-sm-3">
                            <input type="text" id="TGL_PLP" name="TGL_PLP" class="form-control" readonly>
                        </div>
                    </div>
<!--                    <div class="form-group">
                        <label class="col-sm-3 control-label">No.SPJM</label>
                        <div class="col-sm-3">
                            <input type="text" id="NO_SPJM" name="NO_SPJM" class="form-control" readonly>
                        </div>
                        <label class="col-sm-2 control-label">Tgl.SPJM</label>
                        <div class="col-sm-3">
                            <input type="text" id="TGL_SPJM" name="TGL_SPJM" class="form-control" readonly>
                        </div>
                    </div>-->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">ETA</label>
                        <div class="col-sm-8">
                            <input type="text" id="ETA" name="ETA" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Voy</label>
                        <div class="col-sm-8">
                            <input type="text" id="VOY" name="VOY" class="form-control" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="col-md-6">
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
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. POL</label>
                        <div class="col-sm-8">
                            <input type="text" id="NOPOL" name="NOPOL" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Status Dispatche</label>
                        <div class="col-sm-2">
                            <input type="text" id="STATUS_DISPATCHE" name="STATUS_DISPATCHE" class="form-control" required readonly>
                        </div>
                        <div class="col-sm-2">
                            <input type="text" id="KODE_DISPATCHE" name="KODE_DISPATCHE" class="form-control" required readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Response Dispatche</label>
                        <div class="col-sm-8">
                            <input type="text" id="RESPONSE_DISPATCHE" name="RESPONSE_DISPATCHE" class="form-control" required readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">DO ID</label>
                        <div class="col-sm-8">
                            <input type="text" id="DO_ID" name="DO_ID" class="form-control" required readonly>
                        </div>
                    </div>
                </div>
                <div class="col-md-6"> 
                                     
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. Dispatche</label>
                        <div class="col-sm-4">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" id="TGL_DISPATCHE" name="TGL_DISPATCHE" class="form-control pull-right datepicker" required value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <input type="text" id="JAM_DISPATCHE" name="JAM_DISPATCHE" class="form-control timepicker" value="{{ date('H:i:s') }}" required>
                                <div class="input-group-addon">
                                      <i class="fa fa-clock-o"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bootstrap-timepicker">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Tgl. Keluar TPK</label>
                            <div class="col-sm-4">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" id="TGL_KELUAR_TPK_ESEAL" name="TGL_KELUAR_TPK_ESEAL" class="form-control pull-right datepicker" required value="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <input type="text" id="JAM_KELUAR_TPK_ESEAL" name="JAM_KELUAR_TPK_ESEAL" class="form-control timepicker" value="{{ date('H:i:s') }}" required>
                                    <div class="input-group-addon">
                                          <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                            </div>
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
        minuteStep: 1,
        secondStep: 1
    });
    $(".timepicker").mask("99:99:99");
    $(".datepicker").mask("9999-99-99");
</script>

@endsection