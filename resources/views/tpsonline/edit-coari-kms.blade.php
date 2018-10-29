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
        $('#btn-group-1, #btn-group-2').enableButtonGroup();
    }
    
    $(document).ready(function()
    {
        $('#coari-kms-form').disabledFormGroup();
        $('#btn-toolbar').disabledButtonGroup();
        $('#btn-group-3').enableButtonGroup();
        
        $('#btn-edit').click(function() {
            //Gets the selected row id.
            rowid = $('#tpsCoariKmsGrid').jqGrid('getGridParam', 'selrow');
            rowdata = $('#tpsCoariKmsGrid').getRowData(rowid);
            
            $.each(rowdata, function( index, value )
            {
                    var element = index;

                    if($('#' + element).is("input") || $('#' + element).is("textarea"))
                    {
                            switch ($('#' + element).attr('type'))
                            {
                                    case 'checkbox': //missing radio, autocomplete, multiselect
                                            if((value == 1 && !$('#' + element).is(":checked")) || (value == 0 && $('#' + element).is(":checked")))
                                            {
                                                    $('#' + element).click();
                                            }
                                            break;
                                    default:
                                            $('#' + element).val(value);
                                            break;
                            }
                    }

                    if($('#' + element).is("select"))
                    {
                            $('#' + element).val(value);
                    }
            });
            
            $('#TPSCOARIKMSDETAILXML_PK').val(rowid);

//            if(!rowdata.TGLSURATJALAN && !rowdata.JAMSURATJALAN) {
                $('#btn-group-2').enableButtonGroup();
                $('#coari-kms-form').enableFormGroup();
//            }else{
//                $('#btn-group-2').disabledButtonGroup();
//                $('#coari-kms-form').disabledFormGroup();
//            }

        });
        
        $('#btn-save').click(function() {
            
            if(!confirm('Apakah anda yakin?')){return false;}
            
            var kmsId = $('#TPSCOARIKMSDETAILXML_PK').val();
            var url = "{{route('tps-coariKmsDetail-update','')}}/"+kmsId;

            $.ajax({
                type: 'POST',
                data: JSON.stringify($('#coari-kms-form').formToObject('')),
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
            $('#tpsCoariKmsGrid').jqGrid().trigger("reloadGrid");
            $('#coari-kms-form').disabledFormGroup();
            $('#btn-toolbar').disabledButtonGroup();
            $('#btn-group-3').enableButtonGroup();
            
            $('#coari-kms-form')[0].reset();
            $('.select2').val(null).trigger("change");
            $('#TPSCOARIKMSDETAILXML_PK').val("");
        });
        
    });
    
</script>

@include('partials.form-alert')

<div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Edit TPS COARI Kemasan</h3>
      <div class="box-tools pull-right">
        <!--<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>-->
          <a href="{{ route('tps-coariKms-upload', $header->TPSCOARIKMSXML_PK) }}" id="resend-btn" type="button" class="btn btn-info btn-sm"><i class="fa fa-send"></i> Kirim Ulang</a>
      </div>
    </div>
    <!-- /.box-header -->
    <form class="form-horizontal" action="#" method="POST">
        <div class="box-body">            
            <div class="row">
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">REF Number</label>
                        <div class="col-sm-8">
                            <input type="text" name="REF_NUMBER" class="form-control"  value="{{ $header->REF_NUMBER }}" required readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. Entry</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="TGL_ENTRY" class="form-control pull-right datepicker" required value="{{ $header->TGL_ENTRY }}" readonly>
                            </div>
                        </div>
                    </div>                  
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">           
            <button type="submit" class="btn btn-success pull-right" style="margin-right: 10px;"><i class="fa fa-save"></i> Simpan</button>
            <a href="{{ route('tps-coariKms-index') }}" class="btn btn-danger pull-right" style="margin-right: 10px;"><i class="fa fa-close"></i> Keluar</a>
        </div>
        <!-- /.box-footer -->
    </form>
</div>

<div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">COARI Kemasan Detail</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="form-horizontal">
        <div class="box-body">            
            <div class="row" style="margin-bottom: 30px;">
            
                <div class="col-md-12">
                    {{
                        GridRender::setGridId("tpsCoariKmsGrid")
                        ->enableFilterToolbar()
                        ->setGridOption('mtype', 'POST')
                        ->setGridOption('url', URL::to('/tpsonline/pengiriman/coari-kms/grid-data?coarikms_id='.$header->TPSCOARIKMSXML_PK.'&_token='.csrf_token()))
                        ->setGridOption('rowNum', 10)
                        ->setGridOption('shrinkToFit', true)
                        ->setGridOption('sortname','TPSCOARIKMSDETAILXML_PK')
                        ->setGridOption('rownumbers', true)
                        ->setGridOption('height', '250')
                        ->setGridOption('rowList',array(20,50,100))
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
                        ->addColumn(array('key'=>true,'index'=>'TPSCOARIKMSDETAILXML_PK','hidden'=>true))

                        ->addColumn(array('label'=>'No. Tally','index'=>'NOTALLY', 'width'=>150,'editable' => true, 'align'=>'left'))
                        ->addColumn(array('label'=>'Kode DOK','index'=>'KD_DOK', 'width'=>150,'editable' => true, 'align'=>'center'))
                        ->addColumn(array('label'=>'Kode TPS','index'=>'KD_TPS', 'width'=>150,'editable' => true, 'align'=>'center'))
                        ->addColumn(array('label'=>'Nama Angkut','index'=>'NM_ANGKUT', 'width'=>150,'editable' => true, 'align'=>'left'))
                        ->addColumn(array('label'=>'No. VOY Flight','index'=>'NO_VOY_FLIGHT', 'width'=>150,'editable' => true, 'align'=>'center'))
                        ->addColumn(array('label'=>'Call Sign','index'=>'CALL_SIGN', 'width'=>150,'editable' => true, 'align'=>'center'))
                        ->addColumn(array('label'=>'Tgl. Tiba','index'=>'TGL_TIBA', 'width'=>150,'editable' => true, 'align'=>'center'))
                        ->addColumn(array('label'=>'Kode Gudang','index'=>'KD_GUDANG', 'width'=>150,'editable' => true, 'align'=>'center'))
                        ->addColumn(array('label'=>'No. BL AWB','index'=>'NO_BL_AWB', 'width'=>150,'editable' => true, 'align'=>'left'))
                        ->addColumn(array('label'=>'Tgl. BL AWB','index'=>'TGL_BL_AWB', 'width'=>150,'editable' => true, 'align'=>'center'))
                        ->addColumn(array('label'=>'No. MBL AWB','index'=>'NO_MASTER_BL_AWB', 'width'=>150,'editable' => true, 'align'=>'left'))
                        ->addColumn(array('label'=>'Tgl. MBL AWB','index'=>'TGL_MASTER_BL_AWB', 'width'=>150,'editable' => true, 'align'=>'center'))
                        ->addColumn(array('index'=>'ID_CONSIGNEE', 'width'=>150,'editable' => true, 'align'=>'center','hidden'=>true))
                        ->addColumn(array('label'=>'Consignee','index'=>'CONSIGNEE', 'width'=>150,'editable' => true, 'align'=>'left'))
                        ->addColumn(array('label'=>'Bruto','index'=>'BRUTO', 'width'=>150,'editable' => true, 'align'=>'center'))
                        ->addColumn(array('label'=>'No. BC11','index'=>'NO_BC11', 'width'=>150,'editable' => true, 'align'=>'center'))
                        ->addColumn(array('label'=>'Tgl. BC11','index'=>'TGL_BC11', 'width'=>150,'editable' => true, 'align'=>'center'))
                        ->addColumn(array('label'=>'No. POS BC11','index'=>'NO_POS_BC11', 'width'=>150,'editable' => true, 'align'=>'center'))
                        ->addColumn(array('label'=>'Cont. Asal','index'=>'CONT_ASAL', 'width'=>150,'editable' => true, 'align'=>'center'))
                        ->addColumn(array('label'=>'Seri Kemas','index'=>'SERI_KEMAS', 'width'=>150,'editable' => true, 'align'=>'center'))
                        ->addColumn(array('label'=>'Kode Kemas','index'=>'KD_KEMAS', 'width'=>150,'editable' => true, 'align'=>'center'))
                        ->addColumn(array('label'=>'Jumlah Kemas','index'=>'JML_KEMAS', 'width'=>150,'editable' => true, 'align'=>'center'))
                        ->addColumn(array('label'=>'Kode Timbun','index'=>'KD_TIMBUN', 'width'=>150,'editable' => true, 'align'=>'center'))
                        ->addColumn(array('label'=>'Kode DOK. INOUT','index'=>'KD_DOK_INOUT', 'width'=>150,'editable' => true, 'align'=>'center'))
                        ->addColumn(array('label'=>'No. DOK. INOUT','index'=>'NO_DOK_INOUT', 'width'=>150,'editable' => true, 'align'=>'center'))
                        ->addColumn(array('label'=>'Tgl. DOK. INOUT','index'=>'TGL_DOK_INOUT', 'width'=>150,'editable' => true, 'align'=>'center'))
                        ->addColumn(array('label'=>'Waktu DOK. INOUT','index'=>'WK_INOUT', 'width'=>150,'editable' => true, 'align'=>'center'))
                        ->addColumn(array('label'=>'Kode SAR Angkut INOUT','index'=>'KD_SAR_ANGKUT_INOUT', 'width'=>150,'editable' => true, 'align'=>'center'))
                        ->addColumn(array('label'=>'No. POL','index'=>'NO_POL', 'width'=>150,'editable' => true, 'align'=>'center'))
                        ->addColumn(array('label'=>'Pel. Muat','index'=>'PEL_MUAT', 'width'=>150,'editable' => true, 'align'=>'center'))
                        ->addColumn(array('label'=>'Pel. Transit','index'=>'PEL_TRANSIT', 'width'=>150,'editable' => true, 'align'=>'center'))
                        ->addColumn(array('label'=>'Pel. Bongkar','index'=>'PEL_BONGKAR', 'width'=>150,'editable' => true, 'align'=>'center'))
                        ->addColumn(array('label'=>'Gudang Tujuan','index'=>'GUDANG_TUJUAN', 'width'=>150,'editable' => true, 'align'=>'center'))
                        ->addColumn(array('label'=>'UID','index'=>'UID', 'width'=>150,'editable' => true, 'align'=>'center'))
                        ->addColumn(array('label'=>'Response','index'=>'RESPONSE', 'width'=>150,'editable' => true, 'align'=>'center'))
                        ->addColumn(array('label'=>'Status TPS','index'=>'STATUS_TPS', 'width'=>150,'editable' => true, 'align'=>'center'))
                        ->addColumn(array('label'=>'No. Urut','index'=>'NOURUT', 'width'=>150,'editable' => true, 'align'=>'center'))
                        ->addColumn(array('label'=>'Kode Kantor','index'=>'KODE_KANTOR', 'width'=>150,'editable' => true, 'align'=>'center'))
                        ->addColumn(array('label'=>'No. Daftar Pabean','index'=>'NO_DAFTAR_PABEAN', 'width'=>150,'editable' => true, 'align'=>'center'))
                        ->addColumn(array('label'=>'Tgl. Daftar Pabean','index'=>'TGL_DAFTAR_PABEAN', 'width'=>150,'editable' => true, 'align'=>'center'))
                        ->addColumn(array('label'=>'No. Segel BC','index'=>'NO_SEGEL_BC', 'width'=>150,'editable' => true, 'align'=>'center'))
                        ->addColumn(array('label'=>'Tgl. Segel BC','index'=>'TGL_SEGEL_BC', 'width'=>150,'editable' => true, 'align'=>'center'))
                        ->addColumn(array('label'=>'No. Ijin TPS','index'=>'NO_IJIN_TPS', 'width'=>150,'editable' => true, 'align'=>'center'))
                        ->addColumn(array('label'=>'Tgl. Ijin TPS','index'=>'TGL_IJIN_TPS', 'width'=>150,'editable' => true, 'align'=>'center'))
                        ->addColumn(array('label'=>'Response IPC','index'=>'RESPONSE_IPC', 'width'=>150,'editable' => true, 'align'=>'center'))
                        ->addColumn(array('label'=>'Status TPS IPC','index'=>'STATUS_TPS_IPC', 'width'=>150,'editable' => true, 'align'=>'center'))
                        ->addColumn(array('label'=>'Kode TPS Asal','index'=>'KD_TPS_ASAL', 'width'=>150,'editable' => true, 'align'=>'center'))
                        ->addColumn(array('label'=>'Tgl. Entry','index'=>'TGL_ENTRY', 'width'=>150,'editable' => true, 'align'=>'center'))
                        ->addColumn(array('label'=>'Jam Entry','index'=>'JAM_ENTRY', 'width'=>150,'editable' => true, 'align'=>'center'))
                
                        ->renderGrid()
                    }}
                    
                    <div id="btn-toolbar" class="section-header btn-toolbar" role="toolbar" style="margin: 10px 0;">
                        <div id="btn-group-1" class="btn-group">
                            <button class="btn btn-default" id="btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>
                        </div>
                        <div id="btn-group-2" class="btn-group">
                            <button class="btn btn-default" id="btn-edit"><i class="fa fa-edit"></i> Edit</button>
                            <!--<button class="btn btn-default" id="btn-delete"><i class="fa fa-minus"></i> Delete</button>-->
                        </div>
                        <div id="btn-group-3" class="btn-group toolbar-block">
                            <button class="btn btn-default" id="btn-save"><i class="fa fa-save"></i> Save</button>
                        </div>
                    </div>
                    
                </div>
                <div class="col-md-12"><hr /></div>
            </div>
            <form class="form-horizontal" id="coari-kms-form" action="#" method="POST">
                <input name="_token" type="hidden" value="{{ csrf_token() }}">
                <input id="TPSCOARIKMSDETAILXML_PK" name="TPSCOARIKMSDETAILXML_PK" type="hidden">
            <div class="row">        
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kode Dokumen</label>
                        <div class="col-sm-8">
                            <input type="text" name="KD_DOK_INOUT" id="KD_DOK_INOUT" class="form-control"  value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kode TPS</label>
                        <div class="col-sm-8">
                            <input type="text" name="KD_TPS" id="KD_TPS" class="form-control"  value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nama Angkut</label>
                        <div class="col-sm-8">
                            <input type="text" name="NM_ANGKUT" id="NM_ANGKUT" class="form-control"  value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. VOY Flight</label>
                        <div class="col-sm-8">
                            <input type="text" name="NO_VOY_FLIGHT" id="NO_VOY_FLIGHT" class="form-control"  value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Call Sign</label>
                        <div class="col-sm-8">
                            <input type="text" name="CALL_SIGN" id="CALL_SIGN" class="form-control"  value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. Tiba</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="TGL_TIBA" id="TGL_TIBA" class="form-control pull-right datepicker" required value="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kode Gudang</label>
                        <div class="col-sm-8">
                            <input type="text" name="KD_GUDANG" id="KD_GUDANG" class="form-control"  value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. Tally</label>
                        <div class="col-sm-8">
                            <input type="text" name="NOTALLY" id="NOTALLY" class="form-control"  value="" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. MBL AWB</label>
                        <div class="col-sm-8">
                            <input type="text" name="NO_MASTER_BL_AWB" id="NO_MASTER_BL_AWB" class="form-control"  value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. MBL AWB</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="TGL_MASTER_BL_AWB" id="TGL_MASTER_BL_AWB" class="form-control pull-right datepicker" required value="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. BL AWB</label>
                        <div class="col-sm-8">
                            <input type="text" name="NO_BL_AWB" id="NO_BL_AWB" class="form-control"  value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. BL AWB</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="TGL_BL_AWB" id="TGL_BL_AWB" class="form-control pull-right datepicker" required value="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Consignee</label>
                        <div class="col-sm-8">
                            <input type="text" name="CONSIGNEE" id="CONSIGNEE" class="form-control"  value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Bruto</label>
                        <div class="col-sm-8">
                            <input type="text" name="BRUTO" id="BRUTO" class="form-control"  value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. BC11</label>
                        <div class="col-sm-8">
                            <input type="text" name="NO_BC11" id="NO_BC11" class="form-control"  value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. BC11</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="TGL_BC11" id="TGL_BC11" class="form-control pull-right datepicker" required value="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. POS BC11</label>
                        <div class="col-sm-8">
                            <input type="text" name="NO_POS_BC11" id="NO_POS_BC11" class="form-control"  value="" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Seri Kemas</label>
                        <div class="col-sm-8">
                            <input type="text" name="SERI_KEMAS" id="SERI_KEMAS" class="form-control"  value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kode Kemas</label>
                        <div class="col-sm-8">
                            <input type="text" name="KD_KEMAS" id="KD_KEMAS" class="form-control"  value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Jumlah Kemas</label>
                        <div class="col-sm-8">
                            <input type="text" name="JML_KEMAS" id="JML_KEMAS" class="form-control"  value="" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Cont. Asal</label>
                        <div class="col-sm-8">
                            <input type="text" name="CONT_ASAL" id="CONT_ASAL" class="form-control"  value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kode Timbun</label>
                        <div class="col-sm-8">
                            <input type="text" name="KD_TIMBUN" id="KD_TIMBUN" class="form-control"  value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kode DOK. INOUT</label>
                        <div class="col-sm-8">
                            <input type="text" name="KD_DOK_INOUT" id="KD_DOK_INOUT" class="form-control"  value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. DOK. INOUT</label>
                        <div class="col-sm-8">
                            <input type="text" name="NO_DOK_INOUT" id="NO_DOK_INOUT" class="form-control"  value="" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. DOK. INOUT</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="TGL_DOK_INOUT" id="TGL_DOK_INOUT" class="form-control pull-right datepicker" required value="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Jam DOK. INOUT</label>
                        <div class="col-sm-8">
                            <input type="text" name="WK_INOUT" id="WK_INOUT" class="form-control"  value="" required>
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kode SAR Angkut INOUT</label>
                        <div class="col-sm-8">
                            <input type="text" name="KD_SAR_ANGKUT_INOUT" id="KD_SAR_ANGKUT_INOUT" class="form-control"  value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. POL</label>
                        <div class="col-sm-8">
                            <input type="text" name="NO_POL" id="NO_POL" class="form-control"  value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Pel. Muat</label>
                        <div class="col-sm-8">
                            <input type="text" name="PEL_MUAT" id="PEL_MUAT" class="form-control"  value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Pel. Transit</label>
                        <div class="col-sm-8">
                            <input type="text" name="PEL_TRANSIT" id="PEL_TRANSIT" class="form-control"  value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Pel. Bongkar</label>
                        <div class="col-sm-8">
                            <input type="text" name="PEL_BONGKAR" id="PEL_BONGKAR" class="form-control"  value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Gudang Tujuan</label>
                        <div class="col-sm-8">
                            <input type="text" name="GUDANG_TUJUAN" id="GUDANG_TUJUAN" class="form-control"  value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kode Kantor</label>
                        <div class="col-sm-8">
                            <input type="text" name="KODE_KANTOR" id="KODE_KANTOR" class="form-control"  value="" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. Daftar Pabean</label>
                        <div class="col-sm-8">
                            <input type="text" name="NO_DAFTAR_PABEAN" id="NO_DAFTAR_PABEAN" class="form-control"  value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. Daftar Pabean</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="TGL_DAFTAR_PABEAN" id="TGL_DAFTAR_PABEAN" class="form-control pull-right datepicker" required value="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. Segel BC</label>
                        <div class="col-sm-8">
                            <input type="text" name="NO_SEGEL_BC" id="NO_SEGEL_BC" class="form-control"  value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. Segel BC</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="TGL_SEGEL_BC" id="TGL_SEGEL_BC" class="form-control pull-right datepicker" required value="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. Ijin TPS</label>
                        <div class="col-sm-8">
                            <input type="text" name="NO_IJIN_TPS" id="NO_IJIN_TPS" class="form-control"  value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. Ijin TPS</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="TGL_IJIN_TPS" id="TGL_IJIN_TPS" class="form-control pull-right datepicker" required value="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('custom_css')

<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/plugins/datepicker/datepicker3.css") }}">

@endsection

@section('custom_js')

<script src="{{ asset("/bower_components/AdminLTE/plugins/datepicker/bootstrap-datepicker.js") }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
<script type="text/javascript">
    $('select').select2();
    $('.datepicker').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'yyyymmdd' 
    });

    $("#resend-btn").on("click", function(e){     
        if(!confirm('Apakah anda yakin?')){return false;}
    });
</script>

@endsection