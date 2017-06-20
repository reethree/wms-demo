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
        $('#btn-group-1, #btn-group-4').enableButtonGroup();
    }
    
    $(document).ready(function()
    {
        $('#fiatmuat-form').disabledFormGroup();
        $('#btn-toolbar').disabledButtonGroup();
        $('#btn-group-3').enableButtonGroup();
        
        $('#btn-edit').click(function() {
            //Gets the selected row id.
            rowid = $('#fclFiatMuatGrid').jqGrid('getGridParam', 'selrow');
            rowdata = $('#fclFiatMuatGrid').getRowData(rowid);

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
            $('#NO_SPPB').val(rowdata.NO_SPPB);
            $('#TGL_SPPB').val(rowdata.TGL_SPPB);
            $('#NO_KUITANSI').val(rowdata.NO_KUITANSI);
            $('#KD_DOK_INOUT').val(rowdata.KD_DOK_INOUT).trigger('change');

            if(!rowdata.TGLFIAT && !rowdata.JAMFIAT) {
                $('#btn-group-2').enableButtonGroup();
                $('#fiatmuat-form').enableFormGroup();
            }else{
                $('#btn-group-2').disabledButtonGroup();
                $('#fiatmuat-form').disabledFormGroup();
            }

        });
        
        $('#btn-print').click(function() {
            var id = $('#fclFiatMuatGrid').jqGrid('getGridParam', 'selrow');
            window.open("{{ route('fcl-delivery-fiatmuat-cetak', '') }}/"+id,"preview wo fiat muat","width=600,height=600,menubar=no,status=no,scrollbars=yes");   
        });
        
        $('#btn-save').click(function() {
            
            if(!confirm('Apakah anda yakin?')){return false;}
            
            var manifestId = $('#TCONTAINER_PK').val();
            var url = "{{route('fcl-delivery-fiatmuat-update','')}}/"+manifestId;

            $.ajax({
                type: 'POST',
                data: JSON.stringify($('#fiatmuat-form').formToObject('')),
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
//                    console.log(json);
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
            $('#fclFiatMuatGrid').jqGrid().trigger("reloadGrid");
            $('#fiatmuat-form').disabledFormGroup();
            $('#btn-toolbar').disabledButtonGroup();
            $('#btn-group-3').enableButtonGroup();
            
            $('#fiatmuat-form')[0].reset();
            $('.select2').val(null).trigger("change");
            $('#TCONTAINER_PK').val("");
        });
        
    });
    
</script>

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">FCL Delivery Fiat Muat</h3>
    </div>
    <div class="box-body">
        <div class="row" style="margin-bottom: 30px;">
            <div class="col-md-12"> 
                {{
                    GridRender::setGridId("fclFiatMuatGrid")
                    ->enableFilterToolbar()
                    ->setGridOption('mtype', 'POST')
                    ->setGridOption('url', URL::to('/container/grid-data-cy?module=fiatmuat&_token='.csrf_token()))
//                    ->setGridOption('editurl',URL::to('/container/crud-cy/'))
                    ->setGridOption('rowNum', 10)
                    ->setGridOption('shrinkToFit', true)
                    ->setGridOption('sortname','TCONTAINER_PK')
                    ->setGridOption('rownumbers', true)
                    ->setGridOption('height', '150')
                    ->setGridOption('rowList',array(10,20,50))
                    ->setGridOption('useColSpanStyle', true)
                    ->setNavigatorOptions('navigator', array('viewtext'=>'view'))
                    ->setNavigatorOptions('view',array('closeOnEscape'=>false))
                    ->setNavigatorOptions('navigator', array('add' => false, 'edit' => false, 'del' => false, 'view' => true, 'refresh' => false))
                    ->setNavigatorOptions('add', array('closeAfterAdd' => true))
                    ->setNavigatorEvent('add', 'afterSubmit', 'afterSubmitEvent')
                    ->setNavigatorOptions('edit', array('closeAfterEdit' => true))
                    ->setNavigatorEvent('edit', 'afterSubmit', 'afterSubmitEvent')
                    ->setNavigatorEvent('del', 'afterSubmit', 'afterSubmitEvent')
                    ->setFilterToolbarOptions(array('autosearch'=>true))
                    ->setGridEvent('onSelectRow', 'onSelectRowEvent')
                    ->addColumn(array('key'=>true,'index'=>'TCONTAINER_PK','hidden'=>true))
                    ->addColumn(array('label'=>'No. Container','index'=>'NOCONTAINER','width'=>160,'editable' => true, 'editrules' => array('required' => true)))
                    ->addColumn(array('label'=>'No. SPK','index'=>'NoJob','width'=>160))
                    ->addColumn(array('label'=>'No. MBL','index'=>'NOMBL','width'=>160))
                    ->addColumn(array('label'=>'Tgl. MBL','index'=>'TGLMBL','width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'Consolidator','index'=>'NAMACONSOLIDATOR','width'=>250))
                    ->addColumn(array('label'=>'Tgl. Behandle','index'=>'TGLBEHANDLE','width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'Jam. Behandle','index'=>'JAMBEHANDLE', 'width'=>150,'align'=>'center','hidden'=>true))
                    ->addColumn(array('label'=>'Tgl. Fiat','index'=>'TGLFIAT','width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'Jam. Fiat','index'=>'JAMFIAT', 'width'=>150,'align'=>'center','hidden'=>true))
                    ->addColumn(array('label'=>'No. BC11','index'=>'NO_BC11','width'=>150,'align'=>'right'))
                    ->addColumn(array('label'=>'Tgl. BC11','index'=>'TGL_BC11','width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'Tgl. POS BC11','index'=>'NO_POS_BC11','width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'No. PLP','index'=>'NO_PLP','width'=>150,'align'=>'right'))
                    ->addColumn(array('label'=>'Tgl. PLP','index'=>'TGL_PLP','width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'No. SPJM','index'=>'NO_SPJM', 'width'=>150))
                    ->addColumn(array('label'=>'Tgl. SPJM','index'=>'TGL_SPJM', 'width'=>150))
                    ->addColumn(array('label'=>'No. SPPB','index'=>'NO_SPPB', 'width'=>150))
                    ->addColumn(array('label'=>'Tgl. SPPB','index'=>'TGL_SPPB', 'width'=>150))
                    ->addColumn(array('label'=>'No. BL AWB','index'=>'NO_BL_AWB', 'width'=>150))
                    ->addColumn(array('label'=>'Tgl. BL AWB','index'=>'TGL_BL_AWB', 'width'=>150))
                    ->addColumn(array('label'=>'No. Pabean','index'=>'NO_DAFTAR_PABEAN', 'width'=>150))
                    ->addColumn(array('label'=>'Tgl. Pabean','index'=>'TGL_DAFTAR_PABEAN', 'width'=>150))
                    ->addColumn(array('label'=>'Kode Dokumen','index'=>'KODE_DOKUMEN', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('index'=>'KD_DOK_INOUT', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('label'=>'Kode Kuitansi','index'=>'NO_KUITANSI', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('label'=>'Consignee','index'=>'CONSIGNEE','width'=>160))
                    ->addColumn(array('label'=>'Importir','index'=>'NAMA_IMP','width'=>160))
                    ->addColumn(array('label'=>'NPWP Importir','index'=>'NPWP_IMP','width'=>160))
                    ->addColumn(array('label'=>'ETA','index'=>'ETA', 'width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'Size','index'=>'SIZE', 'width'=>80,'align'=>'center','editable' => true, 'editrules' => array('required' => true,'number'=>true),'edittype'=>'select','editoptions'=>array('value'=>"20:20;40:40")))
                    ->addColumn(array('label'=>'Teus','index'=>'TEUS', 'width'=>80,'align'=>'center','editable' => false))
                    ->addColumn(array('label'=>'No. Seal','index'=>'NOSEGEL', 'width'=>120,'editable' => true, 'align'=>'right'))
                    ->addColumn(array('label'=>'Weight','index'=>'WEIGHT', 'width'=>120,'editable' => true, 'align'=>'right','editrules' => array('required' => true)))
                    ->addColumn(array('label'=>'Measurment','index'=>'MEAS', 'width'=>120,'editable' => true, 'align'=>'right','editrules' => array('required' => true)))
                    ->addColumn(array('label'=>'Layout','index'=>'layout', 'width'=>80,'editable' => true,'align'=>'center','editoptions'=>array('defaultValue'=>"C-1")))
                    ->addColumn(array('label'=>'UID','index'=>'UID', 'width'=>150))
                    ->addColumn(array('label'=>'Nama EMKL','index'=>'NAMAEMKL', 'width'=>150,'hidden'=>true)) 
                    ->addColumn(array('label'=>'Telp. EMKL','index'=>'TELPEMKL', 'width'=>150,'hidden'=>true)) 
                    ->addColumn(array('label'=>'No. Truck','index'=>'NOPOL', 'width'=>150,'hidden'=>true)) 
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
                    <div id="btn-group-4" class="btn-group">
                        <button class="btn btn-default" id="btn-print"><i class="fa fa-print"></i> Cetak WO</button>
                    </div>
                </div>
            </div>
            
        </div>
        <form class="form-horizontal" id="fiatmuat-form" action="{{ route('fcl-delivery-fiatmuat-index') }}" method="POST">
            <div class="row">
                <div class="col-md-6">
                    
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    <input id="TCONTAINER_PK" name="TCONTAINER_PK" type="hidden">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. SPK</label>
                        <div class="col-sm-8">
                            <input type="text" id="NOJOBORDER" name="NOJOBORDER" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. Container</label>
                        <div class="col-sm-8">
                            <input type="text" id="NOCONTAINER" name="NOCONTAINER" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Consolidator</label>
                        <div class="col-sm-8">
                            <input type="text" id="NAMACONSOLIDATOR" name="NAMACONSOLIDATOR" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Consignee</label>
                        <div class="col-sm-8">
                            <input type="text" id="CONSIGNEE" name="CONSIGNEE" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">NAMA Importir</label>
                        <div class="col-sm-8">
                            <input type="text" id="NAMA_IMP" name="NAMA_IMP" class="form-control" readonly>
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
                        <label class="col-sm-3 control-label">No.SPJM</label>
                        <div class="col-sm-3">
                            <input type="text" id="NO_SPJM" name="NO_SPJM" class="form-control" readonly>
                        </div>
                        <label class="col-sm-2 control-label">Tgl.SPJM</label>
                        <div class="col-sm-3">
                            <input type="text" id="TGL_SPJM" name="TGL_SPJM" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. Behandle</label>
                        <div class="col-sm-8">
                            <input type="text" id="TGLBEHANDLE" name="TGLBEHANDLE" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">NPWP Importir</label>
                        <div class="col-sm-8">
                            <input type="text" id="NPWP_IMP" name="NPWP_IMP" class="form-control" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. Dok</label>
                        <div class="col-sm-8">
                            <input type="text" id="NO_SPPB" name="NO_SPPB" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. Dok</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" id="TGL_SPPB" name="TGL_SPPB" class="form-control pull-right datepicker" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kode Dokumen</label>
                        <div class="col-sm-8">
                            <select class="form-control select2" id="KD_DOK_INOUT" name="KD_DOK_INOUT" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                <option value="">Choose Document</option>
                                @foreach($kode_doks as $kode)
                                    <option value="{{ $kode->kode }}">({{$kode->kode}}) {{ $kode->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. Kuitansi</label>
                        <div class="col-sm-8">
                            <input type="text" id="NO_KUITANSI" name="NO_KUITANSI" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. B/L AWB</label>
                        <div class="col-sm-8">
                            <input type="text" id="NO_BL_AWB" name="NO_BL_AWB" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. B/L AWB</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" id="TGL_BL_AWB" name="TGL_BL_AWB" class="form-control pull-right datepicker" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. Pabean</label>
                        <div class="col-sm-8">
                            <input type="text" id="NO_DAFTAR_PABEAN" name="NO_DAFTAR_PABEAN" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. Pabean</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" id="TGL_DAFTAR_PABEAN" name="TGL_DAFTAR_PABEAN" class="form-control pull-right datepicker" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6"> 
                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl.Fiat</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" id="TGLFIAT" name="TGLFIAT" class="form-control pull-right datepicker" value="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bootstrap-timepicker">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Jam Fiat</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="text" id="JAMFIAT" name="JAMFIAT" class="form-control timepicker" value="{{ date('H:i:s') }}" required>
                                    <div class="input-group-addon">
                                          <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nama EMKL</label>
                        <div class="col-sm-8">
                            <input type="text" id="NAMAEMKL" name="NAMAEMKL" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Telp. EMKL</label>
                        <div class="col-sm-8">
                            <input type="text" id="TELPEMKL" name="TELPEMKL" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. Truck</label>
                        <div class="col-sm-8">
                            <input type="text" id="NOPOL" name="NOPOL" class="form-control" required>
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
</script>

@endsection