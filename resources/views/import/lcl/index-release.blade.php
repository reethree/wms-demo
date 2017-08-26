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
        var ids = jQuery("#lclReleaseGrid").jqGrid('getDataIDs');   
            
        for(var i=0;i < ids.length;i++){ 
            var cl = ids[i];
            
            rowdata = $('#lclReleaseGrid').getRowData(cl);
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
            rowid = $('#lclReleaseGrid').jqGrid('getGridParam', 'selrow');
            rowdata = $('#lclReleaseGrid').getRowData(rowid);

            populateFormFields(rowdata, '');
            $('#TMANIFEST_PK').val(rowid);
            $('#NO_BC11').val(rowdata.NO_BC11);
            $('#TGL_BC11').val(rowdata.TGL_BC11);
            $('#NO_POS_BC11').val(rowdata.NO_POS_BC11);
            $('#NO_SPJM').val(rowdata.NO_SPJM);
            $('#TGL_SPJM').val(rowdata.TGL_SPJM);
            $('#ID_CONSIGNEE').val(rowdata.ID_CONSIGNEE);
            $('#NO_SPPB').val(rowdata.NO_SPPB);
            $('#TGL_SPPB').val(rowdata.TGL_SPPB);
            $('#NOPOL_RELEASE').val(rowdata.NOPOL_RELEASE);
            $('#PENAGIHAN').val(rowdata.PENAGIHAN).trigger("change");
            $('#LOKASI_TUJUAN').val(rowdata.LOKASI_TUJUAN).trigger("change");
            $('#REF_NUMBER_OUT').val(rowdata.REF_NUMBER_OUT);
            $('#UIDRELEASE').val(rowdata.UIDRELEASE);
            $('#KD_DOK_INOUT').val(rowdata.KD_DOK_INOUT).trigger('change');
            $('#bcf_consignee').val(rowdata.bcf_consignee).trigger('change');
                        
//            if(!rowdata.tglrelease && !rowdata.jamrelease) {
//                $('#btn-group-4').disabledButtonGroup();
//                $('#btn-group-5').disabledButtonGroup();
                $('#btn-group-2').enableButtonGroup();
                $('#release-form').enableFormGroup();
//            }else{
                $('#btn-group-4').enableButtonGroup();
                $('#btn-group-5').enableButtonGroup();
//                $('#btn-group-2').disabledButtonGroup();
//                $('#release-form').disabledFormGroup();
//            }
            
            if(rowdata.flag_bc == 'Y'){
                $('#btn-group-4').disabledButtonGroup();
                $('#btn-group-5').disabledButtonGroup();
                $('#btn-group-2').disabledButtonGroup();
                $('#release-form').disabledFormGroup();
            }

        });
        
        $('#btn-invoice').click(function() {
            if(!confirm('Apakah anda yakin?')){return false;}
            
            var manifestId = $('#TMANIFEST_PK').val();
            var url = '{{ route("lcl-delivery-release-invoice") }}';
            
            $.ajax({
                type: 'POST',
                data: 
                {
                    'id' : manifestId,
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
                }
            });
            
        });

        $('#btn-save').click(function() {
            
            if(!confirm('Apakah anda yakin?')){return false;}
            
            var manifestId = $('#TMANIFEST_PK').val();
            var url = "{{route('lcl-delivery-release-update','')}}/"+manifestId;

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
            $('#lclReleaseGrid').jqGrid().trigger("reloadGrid");
            $('#release-form').disabledFormGroup();
            $('#btn-toolbar').disabledButtonGroup();
            $('#btn-group-3').enableButtonGroup();
            
            $('#release-form')[0].reset();
            $('.select2').val(null).trigger("change");
            $('#TMANIFEST_PK').val("");
        });
        
        $('#btn-print-sj').click(function() {
            var id = $('#lclReleaseGrid').jqGrid('getGridParam', 'selrow');
            window.open("{{ route('lcl-delivery-suratjalan-cetak', '') }}/"+id,"preview wo fiat muat","width=600,height=600,menubar=no,status=no,scrollbars=yes");
        });
        
        $('#btn-print-wo').click(function() {
            var id = $('#lclReleaseGrid').jqGrid('getGridParam', 'selrow');
            window.open("{{ route('lcl-delivery-fiatmuat-cetak', '') }}/"+id,"preview wo fiat muat","width=600,height=600,menubar=no,status=no,scrollbars=yes");   
        });
        
        $('#btn-upload').click(function() {
            
            if(!confirm('Apakah anda yakin?')){return false;}

            var url = '{{ route("lcl-delivery-release-upload") }}';

            $.ajax({
                type: 'POST',
                data: 
                {
                    'id' : $('#TMANIFEST_PK').val(),
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
                    
                    $('#tpsonline-modal-text').html(json.message+', Apakah anda ingin mengirimkan CODECO Kemasan XML data sekarang?');
                    $("#tpsonline-send-btn").attr("href", "{{ route('tps-codecoKms-upload','') }}/"+json.insert_id);
                    
                    $('#tpsonline-modal').modal('show');
                }
            });
            
        });
        
    });
    
</script>

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">LCL Delivery Release</h3>
<!--        <div class="box-tools">
            <a href="{{ route('lcl-manifest-create') }}" type="button" class="btn btn-block btn-info btn-sm"><i class="fa fa-plus"></i> Add New</a>
        </div>-->
    </div>
    <div class="box-body">
        <div class="row" style="margin-bottom: 30px;">
            <div class="col-md-12"> 
                {{
                    GridRender::setGridId("lclReleaseGrid")
                    ->enableFilterToolbar()
                    ->setGridOption('mtype', 'POST')
                    ->setGridOption('url', URL::to('/lcl/manifest/grid-data?module=release&_token='.csrf_token()))
                    ->setGridOption('rowNum', 20)
                    ->setGridOption('shrinkToFit', true)
                    ->setGridOption('sortname','TMANIFEST_PK')
                    ->setGridOption('rownumbers', true)
                    ->setGridOption('height', '250')
                    ->setGridOption('rowList',array(20,50,100))
                    ->setGridOption('useColSpanStyle', true)
                    ->setNavigatorOptions('navigator', array('viewtext'=>'view'))
                    ->setNavigatorOptions('view',array('closeOnEscape'=>false))
                    ->setFilterToolbarOptions(array('autosearch'=>true))
                    ->setGridEvent('gridComplete', 'gridCompleteEvent')
                    ->setGridEvent('onSelectRow', 'onSelectRowEvent')
                    ->addColumn(array('key'=>true,'index'=>'TMANIFEST_PK','hidden'=>true))
                    ->addColumn(array('label'=>'Validasi','index'=>'VALIDASI','width'=>80, 'align'=>'center'))
                    ->addColumn(array('label'=>'No. HBL','index'=>'NOHBL','width'=>160))
                    ->addColumn(array('label'=>'Tgl. HBL','index'=>'TGL_HBL', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('label'=>'No. Tally','index'=>'NOTALLY','width'=>160))
                    ->addColumn(array('label'=>'No. SPK','index'=>'NOJOBORDER', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('label'=>'No. Container','index'=>'NOCONTAINER', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('label'=>'No. SPJM','index'=>'NO_SPJM', 'width'=>150))
                    ->addColumn(array('label'=>'Tgl. SPJM','index'=>'TGL_SPJM', 'width'=>150))
                    ->addColumn(array('label'=>'No. SPPB','index'=>'NO_SPPB', 'width'=>150))
                    ->addColumn(array('label'=>'Tgl. SPPB','index'=>'TGL_SPPB', 'width'=>150))
                    ->addColumn(array('label'=>'Kode Dokumen','index'=>'KD_DOK_INOUT', 'width'=>100,'hidden'=>false))
                    ->addColumn(array('label'=>'Nama Dokumen','index'=>'KODE_DOKUMEN', 'width'=>100,'hidden'=>false, 'align'=>'center'))                   
                    ->addColumn(array('label'=>'Kode Kuitansi','index'=>'NO_KUITANSI', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('label'=>'Shipper','index'=>'SHIPPER','width'=>160))
                    ->addColumn(array('label'=>'Consignee','index'=>'CONSIGNEE','width'=>160))
                    ->addColumn(array('label'=>'Notify Party','index'=>'NOTIFYPARTY','width'=>160))
                    ->addColumn(array('label'=>'Consolidator','index'=>'NAMACONSOLIDATOR','width'=>250))
                    ->addColumn(array('label'=>'Weight','index'=>'WEIGHT', 'width'=>120))               
                    ->addColumn(array('label'=>'Meas','index'=>'MEAS', 'width'=>120))
                    ->addColumn(array('label'=>'Qty','index'=>'QUANTITY', 'width'=>80,'align'=>'center'))
                    ->addColumn(array('label'=>'Packing','index'=>'NAMAPACKING', 'width'=>120))
                    ->addColumn(array('label'=>'Kode Kemas','index'=>'KODE_KEMAS', 'width'=>100,'align'=>'center'))
                    ->addColumn(array('label'=>'No. Rack','index'=>'RACKING', 'width'=>150,'hidden'=>true)) 
                    ->addColumn(array('label'=>'UID','index'=>'UID', 'width'=>150,'hidden'=>true))          
                    ->addColumn(array('index'=>'TSHIPPER_FK', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('index'=>'TCONSIGNEE_FK', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('label'=>'Consignee','index'=>'CONSIGNEE', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('label'=>'NPWP Consignee','index'=>'ID_CONSIGNEE', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('label'=>'No. Kuitansi','index'=>'NO_KUITANSI', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('index'=>'TNOTIFYPARTY_FK', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('index'=>'TPACKING_FK', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('label'=>'Marking','index'=>'MARKING', 'width'=>150,'hidden'=>true)) 
                    ->addColumn(array('label'=>'Desc of Goods','index'=>'DESCOFGOODS', 'width'=>150,'hidden'=>true))              
                    ->addColumn(array('label'=>'No.BC11','index'=>'NO_BC11', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('label'=>'Tgl.BC11','index'=>'TGL_BC11', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('label'=>'No.POS BC11','index'=>'NO_POS_BC11', 'width'=>150))
                    ->addColumn(array('label'=>'No.PLP','index'=>'NO_PLP', 'width'=>150,'hidden'=>true))                
                    ->addColumn(array('label'=>'Tgl.PLP','index'=>'TGL_PLP', 'width'=>150,'hidden'=>true)) 
                    ->addColumn(array('label'=>'Tgl.Behandle','index'=>'tglbehandle', 'width'=>150,'hidden'=>true)) 
                    ->addColumn(array('label'=>'Surcharge (DG)','index'=>'DG_SURCHARGE', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('label'=>'Surcharge (Weight)','index'=>'WEIGHT_SURCHARGE', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('label'=>'Flag','index'=>'flag_bc','width'=>80, 'align'=>'center'))
                    ->addColumn(array('label'=>'Nama EMKL','index'=>'NAMAEMKL', 'width'=>150,'hidden'=>true)) 
                    ->addColumn(array('label'=>'Telp. EMKL','index'=>'TELPEMKL', 'width'=>150,'hidden'=>true)) 
                    ->addColumn(array('label'=>'No. Truck','index'=>'NOPOL', 'width'=>150,'hidden'=>true)) 
                    ->addColumn(array('label'=>'No. POL Release','index'=>'NOPOL_RELEASE', 'width'=>150,'hidden'=>true)) 
                    ->addColumn(array('label'=>'Tgl. Surat Jalan','index'=>'TGLSURATJALAN', 'width'=>120,'hidden'=>true))
                    ->addColumn(array('label'=>'Jam. Surat Jalan','index'=>'JAMSURATJALAN', 'width'=>70,'hidden'=>true))
                    ->addColumn(array('label'=>'Petugas Surat Jalan','index'=>'UIDSURATJALAN', 'width'=>70,'hidden'=>true))
                    ->addColumn(array('label'=>'Petugas Release','index'=>'UIDRELEASE', 'width'=>70,'hidden'=>true))
                    ->addColumn(array('label'=>'Penagihan','index'=>'PENAGIHAN', 'width'=>70,'hidden'=>true))
                    ->addColumn(array('label'=>'BCF Consignee','index'=>'bcf_consignee', 'width'=>70,'hidden'=>true))
                    ->addColumn(array('label'=>'Ref Number','index'=>'REF_NUMBER_OUT', 'width'=>70,'hidden'=>true))
                    ->addColumn(array('label'=>'Tgl. Fiat Muat','index'=>'tglfiat', 'width'=>120,'hidden'=>true))
                    ->addColumn(array('label'=>'Jam. Fiat Muat','index'=>'jamfiat', 'width'=>70,'hidden'=>true))
                    ->addColumn(array('label'=>'Tgl. Entry','index'=>'tglentry', 'width'=>120))
                    ->addColumn(array('label'=>'Jam. Entry','index'=>'jamentry', 'width'=>70,'hidden'=>true))
                    ->addColumn(array('label'=>'Tgl. Release','index'=>'tglrelease', 'width'=>120))
                    ->addColumn(array('label'=>'Jam. Release','index'=>'jamrelease', 'width'=>70,'hidden'=>true))
                    ->addColumn(array('label'=>'Lokasi Tujuan','index'=>'LOKASI_TUJUAN', 'width'=>70,'hidden'=>true))
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
                        <button class="btn btn-default" id="btn-print-wo"><i class="fa fa-print"></i> Cetak WO</button>
                        <button class="btn btn-default" id="btn-print-sj"><i class="fa fa-print"></i> Cetak Surat Jalan</button>
                    </div>
                    <div id="btn-group-5" class="btn-group pull-right">
                        <button class="btn btn-default" id="btn-upload"><i class="fa fa-upload"></i> Upload TPS Online</button>
                    </div>
                </div>
            </div>
            
        </div>
        <form class="form-horizontal" id="release-form" action="{{ route('lcl-delivery-release-index') }}" method="POST">
            <div class="row">
                <div class="col-md-6">
                    
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    <input id="TMANIFEST_PK" name="TMANIFEST_PK" type="hidden">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. HBL</label>
                        <div class="col-sm-8">
                            <input type="text" id="NOHBL" name="NOHBL" class="form-control" readonly>
                        </div>
                    </div>
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
                        <label class="col-sm-3 control-label">No. Tally</label>
                        <div class="col-sm-8">
                            <input type="text" id="NOTALLY" name="NOTALLY" class="form-control" readonly>
                        </div>
                    </div>
<!--                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl.Surat Jalan</label>
                        <div class="col-sm-8">
                            <input type="text" id="TGLSURATJALAN" name="TGLSURATJALAN" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Jam Surat Jalan</label>
                        <div class="col-sm-8">
                            <input type="text" id="JAMSURATJALAN" name="JAMSURATJALAN" class="form-control" readonly>
                        </div>
                    </div>-->
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
                            <input type="text" id="NO_POS_BC11" name="NO_POS_BC11" class="form-control">
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
                        <label class="col-sm-3 control-label">NPWP Consignee</label>
                        <div class="col-sm-8">
                            <input type="text" id="ID_CONSIGNEE" name="ID_CONSIGNEE" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="col-md-6">
                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No.SPPB/BC.23</label>
                        <div class="col-sm-8">
                            <input type="text" id="NO_SPPB" name="NO_SPPB" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl.SPPB/BC.23</label>
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
                        <label class="col-sm-3 control-label">Ref. Number</label>
                        <div class="col-sm-8">
                            <input type="text" id="REF_NUMBER_OUT" name="REF_NUMBER_OUT" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6"> 
<!--                    <div class="form-group">
                        <label class="col-sm-3 control-label">Lokasi Tujuan</label>
                        <div class="col-sm-8">
                            <select class="form-control select2" id="LOKASI_TUJUAN" name="LOKASI_TUJUAN" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                <option value="consignee">Consignee</option>
                                @foreach($perusahaans as $perusahaan)
                                    <option value="{{ $perusahaan->name }}">{{ $perusahaan->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Penagihan</label>
                        <div class="col-sm-8">
                            <select class="form-control select2" id="PENAGIHAN" name="PENAGIHAN" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                <option value="kredit">Kredit</option>
                                <option value="tunai">Tunai</option>
                            </select>
                        </div>
                    </div>-->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl.Release</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" id="tglrelease" name="tglrelease" class="form-control pull-right datepicker" required value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                    </div>
                    
                    <div class="bootstrap-timepicker">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Jam Release</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="text" id="jamrelease" name="jamrelease" class="form-control timepicker" value="{{ date('H:i:s') }}" required>
                                    <div class="input-group-addon">
                                          <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Petugas</label>
                        <div class="col-sm-8">
                            <input type="text" id="UIDRELEASE" name="UIDRELEASE" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. POL</label>
                        <div class="col-sm-8">
                            <input type="text" id="NOPOL_RELEASE" name="NOPOL_RELEASE" class="form-control" required>
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
        todayHighlight: false,
        format: 'yyyy-mm-dd' 
    });
    $('.timepicker').timepicker({ 
        showMeridian: false,
        showInputs: false,
        showSeconds: true,
        minuteStep: 1,
        secondStep: 1
    });
    $("#JAMSURATJALAN").mask("99:99:99");
    $("#jamrelease").mask("99:99:99");
    $("#ID_CONSIGNEE").mask("99.999.999.9-999.999");
</script>

@endsection