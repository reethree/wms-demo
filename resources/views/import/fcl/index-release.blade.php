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
        var ids = jQuery("#fclReleaseGrid").jqGrid('getDataIDs');   
            
        for(var i=0;i < ids.length;i++){ 
            var cl = ids[i];
            
            rowdata = $('#fclReleaseGrid').getRowData(cl);
            if(rowdata.VALIDASI == 'Y') {
                $("#" + cl).find("td").css("color", "#666");
            }
            if(rowdata.flag_bc == 'Y') {
                $("#" + cl).find("td").css("color", "#FF0000");
            } 
        } 
    }
    
    function onSelectRowEvent()
    {
        $('#btn-group-1').enableButtonGroup();
    }
    
    $(document).ready(function()
    {
        $('#release-form').disabledFormGroup();
        $('#btn-toolbar').disabledButtonGroup();
        $('#btn-group-3').enableButtonGroup();
        
        $("#KD_DOK_INOUT").on("change", function(){
            var $this = $(this).val();
            if($this == 9){
                $(".select-bcf-consignee").show();
            }else{
                $(".select-bcf-consignee").hide();
            }
        });
        
        $('#btn-edit').click(function() {
            //Gets the selected row id.
            rowid = $('#fclReleaseGrid').jqGrid('getGridParam', 'selrow');
            rowdata = $('#fclReleaseGrid').getRowData(rowid);

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
            $('#NO_BL_AWB').val(rowdata.NO_BL_AWB);
            $('#TGL_BL_AWB').val(rowdata.TGL_BL_AWB);
            $('#NO_DAFTAR_PABEAN').val(rowdata.NO_DAFTAR_PABEAN);
            $('#TGL_DAFTAR_PABEAN').val(rowdata.TGL_DAFTAR_PABEAN);
            $('#TGLSURATJALAN').val(rowdata.TGLSURATJALAN+' '+rowdata.JAMSURATJALAN);
            $('#NOPOL_OUT').val(rowdata.NOPOL_OUT);
            $('#REF_NUMBER_OUT').val(rowdata.REF_NUMBER_OUT);
            $('#ID_CONSIGNEE').val(rowdata.ID_CONSIGNEE);
            $('#KD_DOK_INOUT').val(rowdata.KD_DOK_INOUT).trigger('change');
            $('#bcf_consignee').val(rowdata.bcf_consignee).trigger('change');

//            if(!rowdata.TGLRELEASE && !rowdata.JAMRELEASE) {
                $('#btn-group-2').enableButtonGroup();
                $('#release-form').enableFormGroup();
//                $('#btn-group-5').disabledButtonGroup();
//            }else{
                $('#btn-group-4').enableButtonGroup();
                $('#btn-group-5').enableButtonGroup();
//                $('#btn-group-2').disabledButtonGroup();
//                $('#release-form').disabledFormGroup();
//            }

        });
        
        $('#btn-print-sj').click(function() {
            var id = $('#fclReleaseGrid').jqGrid('getGridParam', 'selrow');
            window.open("{{ route('fcl-delivery-suratjalan-cetak', '') }}/"+id,"preview wo fiat muat","width=600,height=600,menubar=no,status=no,scrollbars=yes");
        });
        
        $('#btn-print-wo').click(function() {
            var id = $('#fclReleaseGrid').jqGrid('getGridParam', 'selrow');
            window.open("{{ route('fcl-delivery-fiatmuat-cetak', '') }}/"+id,"preview wo fiat muat","width=600,height=600,menubar=no,status=no,scrollbars=yes");   
        });

        $('#btn-save').click(function() {
            
            if(!confirm('Apakah anda yakin?')){return false;}
            
            var manifestId = $('#TCONTAINER_PK').val();
            var url = "{{route('fcl-delivery-release-update','')}}/"+manifestId;

            $.ajax({
                type: 'POST',
                data: JSON.stringify($('#release-form').formToObject('')),
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
            $('#fclReleaseGrid').jqGrid().trigger("reloadGrid");
            $('#release-form').disabledFormGroup();
            $('#btn-toolbar').disabledButtonGroup();
            $('#btn-group-3').enableButtonGroup();
            
            $('#release-form')[0].reset();
            $('.select2').val(null).trigger("change");
            $('#TCONTAINER_PK').val("");
        });
        
        $('#btn-upload').click(function() {
            
            if(!confirm('Apakah anda yakin?')){return false;}
            
            if($('#NAMACONSOLIDATOR').val() == ''){
                alert('Consolidator masih kosong!');
                return false;
            }
            
            var url = '{{ route("fcl-delivery-release-upload") }}';

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
//                    console.log(json);

                    if(json.success) {
                        $('#btn-toolbar').showAlertAfterElement('alert-success alert-custom', json.message, 5000);
                    } else {
                        $('#btn-toolbar').showAlertAfterElement('alert-danger alert-custom', json.message, 5000);
                    }

                    //Triggers the "Close" button funcionality.
                    $('#btn-refresh').click();
                    
                    $('#tpsonline-modal-text').html(json.message+', Apakah anda ingin mengirimkan CODECO Kontainer XML data sekarang?');
                    $("#tpsonline-send-btn").attr("href", "{{ route('tps-codecoContFcl-upload','') }}/"+json.insert_id);
                    
                    $('#tpsonline-modal').modal('show');
                }
            });
            
        });
        
    });
    
</script>

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">FCL Delivery Release</h3>
    </div>
    <div class="box-body">
        <div class="row" style="margin-bottom: 30px;">
            <div class="col-md-12"> 
                {{
                    GridRender::setGridId("fclReleaseGrid")
                    ->enableFilterToolbar()
                    ->setGridOption('mtype', 'POST')
                    ->setGridOption('url', URL::to('/container/grid-data-cy?module=release&_token='.csrf_token()))
                    ->setGridOption('rowNum', 20)
                    ->setGridOption('shrinkToFit', true)
                    ->setGridOption('sortname','TCONTAINER_PK')
                    ->setGridOption('rownumbers', true)
                    ->setGridOption('height', '295')
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
                    ->addColumn(array('label'=>'Tgl. MBL','index'=>'TGLMBL','width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'Consolidator','index'=>'NAMACONSOLIDATOR','width'=>250,'align'=>'center'))
                    ->addColumn(array('label'=>'Tgl. Behandle','index'=>'TGLBEHANDLE','width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'Jam. Behandle','index'=>'JAMBEHANDLE', 'width'=>150,'align'=>'center','hidden'=>true))
                    ->addColumn(array('label'=>'Tgl. Fiat','index'=>'TGLFIAT','width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'Jam. Fiat','index'=>'JAMFIAT', 'width'=>150,'align'=>'center','hidden'=>true))
                    ->addColumn(array('label'=>'Tgl. Surat Jalan','index'=>'TGLSURATJALAN','width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'Jam. Surat Jalan','index'=>'JAMSURATJALAN', 'width'=>150,'align'=>'center','hidden'=>true))
                    ->addColumn(array('label'=>'Tgl. Release','index'=>'TGLRELEASE','width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'Jam. Release','index'=>'JAMRELEASE', 'width'=>150,'align'=>'center','hidden'=>true))
                    ->addColumn(array('label'=>'No. BC11','index'=>'NO_BC11','width'=>150,'align'=>'right'))
                    ->addColumn(array('label'=>'Tgl. BC11','index'=>'TGL_BC11','width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'Tgl. POS BC11','index'=>'NO_POS_BC11','width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'No. PLP','index'=>'NO_PLP','width'=>150,'align'=>'right'))
                    ->addColumn(array('label'=>'Tgl. PLP','index'=>'TGL_PLP','width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'No. SPJM','index'=>'NO_SPJM', 'width'=>150))
                    ->addColumn(array('label'=>'Tgl. SPJM','index'=>'TGL_SPJM', 'width'=>150))
                    ->addColumn(array('label'=>'No. SPPB','index'=>'NO_SPPB', 'width'=>150))
                    ->addColumn(array('label'=>'Tgl. SPPB','index'=>'TGL_SPPB', 'width'=>150))
                    ->addColumn(array('label'=>'Nama Dokumen','index'=>'KODE_DOKUMEN','align'=>'center', 'width'=>120,'hidden'=>false))
                    ->addColumn(array('label'=>'Kode Dokumen','index'=>'KD_DOK_INOUT','align'=>'center', 'width'=>120,'hidden'=>false))
                    ->addColumn(array('label'=>'Kode Kuitansi','index'=>'NO_KUITANSI', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('label'=>'Consignee','index'=>'CONSIGNEE','width'=>160))
                    ->addColumn(array('label'=>'NPWP Consignee','index'=>'ID_CONSIGNEE','width'=>160))
                    ->addColumn(array('label'=>'No. BL/AWB','index'=>'NO_BL_AWB', 'width'=>150))
                    ->addColumn(array('label'=>'Tgl. BL/AWB','index'=>'TGL_BL_AWB', 'width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'No. D.Pabean','index'=>'NO_DAFTAR_PABEAN', 'width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'Tgl. D.Pabean','index'=>'TGL_DAFTAR_PABEAN', 'width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'Importir','index'=>'NAMA_IMP','width'=>160,'hidden'=>true))
                    ->addColumn(array('label'=>'NPWP Importir','index'=>'NPWP_IMP','width'=>160,'hidden'=>true))
                    ->addColumn(array('label'=>'ETA','index'=>'ETA', 'width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'Size','index'=>'SIZE', 'width'=>80,'align'=>'center','editable' => true, 'editrules' => array('required' => true,'number'=>true),'edittype'=>'select','editoptions'=>array('value'=>"20:20;40:40")))
                    ->addColumn(array('label'=>'Teus','index'=>'TEUS', 'width'=>80,'align'=>'center','editable' => false))
                    ->addColumn(array('label'=>'No. Seal','index'=>'NOSEGEL', 'width'=>120,'editable' => true, 'align'=>'right'))
                    ->addColumn(array('label'=>'Weight','index'=>'WEIGHT', 'width'=>120,'editable' => true, 'align'=>'right','editrules' => array('required' => true)))
                    ->addColumn(array('label'=>'Measurment','index'=>'MEAS', 'width'=>120,'editable' => true, 'align'=>'right','editrules' => array('required' => true)))
                    ->addColumn(array('label'=>'Layout','index'=>'layout', 'width'=>80,'editable' => true,'align'=>'center','editoptions'=>array('defaultValue'=>"C-1")))
                    ->addColumn(array('label'=>'UID','index'=>'UID', 'width'=>150))
                    ->addColumn(array('label'=>'BCF Consignee','index'=>'bcf_consignee', 'width'=>70,'hidden'=>true))
                    ->addColumn(array('label'=>'Nama EMKL','index'=>'NAMAEMKL', 'width'=>150,'hidden'=>true)) 
                    ->addColumn(array('label'=>'Telp. EMKL','index'=>'TELPEMKL', 'width'=>150,'hidden'=>true)) 
                    ->addColumn(array('label'=>'No. Truck','index'=>'NOPOL', 'width'=>150,'hidden'=>true)) 
                    ->addColumn(array('label'=>'No. POL','index'=>'NOPOLCIROUT', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('label'=>'No. POL Out','index'=>'NOPOL_OUT', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('label'=>'Ref. Number Out','index'=>'REF_NUMBER_OUT', 'width'=>150,'hidden'=>true))
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
                        <button class="btn btn-default" id="btn-print-wo"><i class="fa fa-print"></i> Cetak WO</button>
                        <button class="btn btn-default" id="btn-print-sj"><i class="fa fa-print"></i> Cetak Surat Jalan</button>
                    </div>
                    <div id="btn-group-5" class="btn-group pull-right">
                        <button class="btn btn-default" id="btn-upload"><i class="fa fa-upload"></i> Upload TPS Online</button>
                    </div>
                </div>
            </div>
            
        </div>
        <form class="form-horizontal" id="release-form" action="{{ route('fcl-delivery-release-index') }}" method="POST">
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
                        <label class="col-sm-3 control-label">No. MBL</label>
                        <div class="col-sm-8">
                            <input type="text" id="NOMBL" name="NOMBL" class="form-control" readonly>
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
<!--                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kode Dokumen</label>
                        <div class="col-sm-8">
                            <input type="text" id="KD_DOK_INOUT" name="KD_DOK_INOUT" class="form-control" readonly>
                        </div>
                    </div>-->
                    

                </div>
                <div class="col-md-6">
<!--                    <div class="form-group">
                        <label class="col-sm-3 control-label">No.SPPB</label>
                        <div class="col-sm-3">
                            <input type="text" id="NO_SPPB" name="NO_SPPB" class="form-control" readonly>
                        </div>
                        <label class="col-sm-2 control-label">Tgl.SPPB</label>
                        <div class="col-sm-3">
                            <input type="text" id="TGL_SPPB" name="TGL_SPPB" class="form-control" readonly>
                        </div>
                    </div>-->
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
                        <label class="col-sm-3 control-label">Consignee</label>
                        <div class="col-sm-8">
                            <input type="text" id="CONSIGNEE" name="CONSIGNEE" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">NPWP Consignee</label>
                        <div class="col-sm-8">
                            <input type="text" id="ID_CONSIGNEE" name="ID_CONSIGNEE" class="form-control">
                        </div>
                    </div>
<!--                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. Surat Jalan</label>
                        <div class="col-sm-8">
                            <input type="text" id="TGLSURATJALAN" name="TGLSURATJALAN" class="form-control" readonly>
                        </div>
                    </div>-->
<!--                    <div class="form-group">
                        <label class="col-sm-3 control-label">Jam Surat Jalan</label>
                        <div class="col-sm-8">
                            <input type="text" id="JAMSURATJALAN" name="JAMSURATJALAN" class="form-control" readonly>
                        </div>
                    </div>-->
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. SPPB</label>
                        <div class="col-sm-8">
                            <input type="text" id="NO_SPPB" name="NO_SPPB" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. SPPB</label>
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
                    <div class="form-group select-bcf-consignee" style="display:none;">
                        <label class="col-sm-3 control-label">BCF 1.5 Consignee</label>
                        <div class="col-sm-8">
                            <select class="form-control select2" id="bcf_consignee" name="bcf_consignee" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                <option value="">Choose Consignee</option>
                                <option value="PT. LAYANAN LANCAR LINTAS LOGISTINDO">PT. LAYANAN LANCAR LINTAS LOGISTINDO</option>
                                <option value="PT. MULTI SEJAHTERA ABADI">PT. MULTI SEJAHTERA ABADI</option>
                                <option value="PT. TRANSCON INDONESIA">PT. TRANSCON INDONESIA</option>
                                <option value="PT. TRI PANDU PELITA">PT. TRI PANDU PELITA</option>
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
                    
                </div>
                <div class="col-md-6">
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
                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. Release</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" id="TGLRELEASE" name="TGLRELEASE" class="form-control pull-right datepicker" required value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                    </div>
                    
                    <div class="bootstrap-timepicker">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Jam Release</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="text" id="JAMRELEASE" name="JAMRELEASE" class="form-control timepicker" value="{{ date('H:i:s') }}" required>
                                    <div class="input-group-addon">
                                          <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. POL</label>
                        <div class="col-sm-8">
                            <input type="text" id="NOPOL_OUT" name="NOPOL_OUT" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Ref. Number</label>
                        <div class="col-sm-8">
                            <input type="text" id="REF_NUMBER_OUT" name="REF_NUMBER_OUT" class="form-control" required>
                        </div>
                    </div>
                    
                </div>
                <!--<div class="col-md-6">--> 
                                     
<!--                    <div class="form-group">
                        <label class="col-sm-3 control-label">Petugas</label>
                        <div class="col-sm-8">
                            <input type="text" id="UIDSURATJALAN" name="UIDSURATJALAN" class="form-control" required>
                        </div>
                    </div>-->
                    
                <!--</div>-->
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