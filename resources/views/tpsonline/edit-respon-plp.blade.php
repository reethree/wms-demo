@extends('layout')

@section('content')

@include('partials.form-alert')

<script>
 
    function gridCompleteEvent()
    {
        var ids = jQuery("#tpsResponPlpDetailGrid").jqGrid('getDataIDs'),
            edt = '',
            del = ''; 
        for(var i=0;i < ids.length;i++){ 
            var cl = ids[i];
            
            rowdata = $('#tpsResponPlpDetailGrid').getRowData(cl);
            if(rowdata.JNS_CONT == 'F') {
//                $("#" + cl).find("td").css("color", "#666");
                $("#btn-group-4").show();
            } 
            
//            edt = '<a href="{{ route("tps-responPlp-edit",'') }}/'+cl+'"><i class="fa fa-pencil"></i></a> ';
//            del = '<a href="{{ route("lcl-register-delete",'') }}/'+cl+'" onclick="if (confirm(\'Are You Sure ?\')){return true; }else{return false; };"><i class="fa fa-close"></i></a>';
//            jQuery("#tpsResponPlpDetailGrid").jqGrid('setRowData',ids[i],{action:edt}); 
        } 
    }
    
</script>

<div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">TPS Respon PLP</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <!-- /.box-header -->
    <form class="form-horizontal" action="{{ route('tps-responPlp-update', $respon->tps_responplptujuanxml_pk) }}" method="POST">
        <div class="box-body">            
            <div class="row">
                <div class="col-md-6">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. Upload</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="TGL_UPLOAD" class="form-control pull-right datepicker" required value="{{ date('Y-m-d',strtotime($respon->TGL_UPLOAD)) }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kode Kantor</label>
                        <div class="col-sm-8">
                            <input type="text" name="KD_KANTOR" class="form-control"  value="{{ $respon->KD_KANTOR }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. Surat PLP</label>
                        <div class="col-sm-8">
                            <input type="text" name="NO_SURAT" class="form-control"  value="{{ $respon->NO_SURAT }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. Surat PLP</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="TGL_SURAT_PLP" class="form-control pull-right datepicker" required value="{{ date('Y-m-d',strtotime($respon->TGL_SURAT_PLP)) }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. BC11</label>
                        <div class="col-sm-8">
                            <input type="text" name="NO_BC11" class="form-control"  value="{{ $respon->NO_BC11 }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. BC11</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="TGL_BC11" class="form-control pull-right datepicker" required value="{{ date('Y-m-d',strtotime($respon->TGL_BC11)) }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. PLP</label>
                        <div class="col-sm-8">
                            <input type="text" name="NO_PLP" class="form-control"  value="{{ $respon->NO_PLP }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. PLP</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="TGL_PLP" class="form-control pull-right datepicker" required value="{{ date('Y-m-d',strtotime($respon->TGL_PLP)) }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kode TPS Asal</label>
                        <div class="col-sm-8">
                            <input type="text" name="KD_TPS_ASAL" class="form-control" value="{{ $respon->KD_TPS_ASAL }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">YOR/SOR (%)</label>
                        <div class="col-sm-8">
                            <input type="number" name="YOR_TPS_ASAL" class="form-control" value="{{ $respon->YOR_TPS_ASAL }}" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Gudang Tujuan</label>
                        <div class="col-sm-8">
                            <input type="text" name="GUDANG_TUJUAN" class="form-control"  value="{{ $respon->GUDANG_TUJUAN }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Alasan Pindah</label>
                        <div class="col-sm-8">
                            <select class="form-control select2" id="apl" name="APL" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                <option value="">Choose Alasan Pindah Lokasi</option>
                                <option value="1">YOR atau SOR sama dengan atau lebih tinggi dari batas standar...</option>
                                <option value="2">Pada TPS asal tidak tersedia tempat penimbunan barang import konsolidasi...</option>
                                <option value="3">Pada TPS asal tidak tersedia lapangan atau gudang penumpukan barang...</option>
                                <option value="4">Barang import berupa barang kena cukai yang akan dilekati pita cukai di TPS tujuan...</option>
                                <option value="5">Barang import konsolidasi dalam satu MAWB/Master BL...</option>
                                <option value="6">Berdasarkan pertimbangan Kepala Kantor Pabean dimungkinkan terjadi stagnasi...</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Alasan</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="alasan" name="ALASAN" rows="3">{{ $respon->ALASAN }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Lampiran</label>
                        <div class="col-sm-8">
                            <input type="text" name="LAMPIRAN" class="form-control"  value="{{ $respon->LAMPIRAN }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nama Angkut</label>
                        <div class="col-sm-8">
                            <input type="text" name="NM_ANGKUT" class="form-control"  value="{{ $respon->NM_ANGKUT }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. VOY Flight</label>
                        <div class="col-sm-8">
                            <input type="text" name="NO_VOY_FLIGHT" class="form-control"  value="{{ $respon->NO_VOY_FLIGHT }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Call Sign</label>
                        <div class="col-sm-8">
                            <input type="text" name="CALL_SIGN" class="form-control"  value="{{ $respon->CALL_SIGN }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. Tiba</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="TGL_TIBA" class="form-control pull-right datepicker" required value="{{ date('Y-m-d',strtotime($respon->TGL_TIBA)) }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Simpan</button>
            <a href="{{ route('tps-responPlp-index') }}" class="btn btn-danger pull-right" style="margin-right: 10px;"><i class="fa fa-close"></i> Keluar</a>
        </div>
        <!-- /.box-footer -->
    </form>
</div>

<script>
    function onSelectRowEvent(rowid, status, e)
    {
        $('#cetak-permohonan').prop("disabled",false);
    }
</script>

<div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Lists Detail</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="form-horizontal">
        <div class="box-body">            
            <div class="row">
                
                <div class="col-md-12">
                    <div id="btn-toolbar" class="section-header btn-toolbar" role="toolbar" style="margin: 10px 0;"></div>
                    {{
                        GridRender::setGridId("tpsResponPlpDetailGrid")
                        ->enableFilterToolbar()
                        ->setGridOption('mtype', 'POST')
                        ->setGridOption('url', URL::to('/tpsonline/penerimaan/respon-plp-detail/grid-data?responid='.$respon->tps_responplptujuanxml_pk.'&_token='.csrf_token()))
                        ->setGridOption('rowNum', 10)
                        ->setGridOption('shrinkToFit', true)
                        ->setGridOption('sortname','tps_responplptujuandetailxml_pk')
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
                        ->setGridEvent('gridComplete', 'gridCompleteEvent')
                        ->addColumn(array('key'=>true,'index'=>'tps_responplptujuandetailxml_pk','hidden'=>true))
                        ->addColumn(array('label'=>'No. Container','index'=>'NO_CONT','width'=>250,'editable' => true, 'editrules' => array('' => true)))
                        ->addColumn(array('label'=>'Ukuran','index'=>'UK_CONT', 'width'=>80,'align'=>'center','editable' => true, 'editrules' => array('' => true,'number'=>true),'edittype'=>'select','editoptions'=>array('value'=>"20:20;40:40")))
                        ->addColumn(array('label'=>'No. POS','index'=>'NO_POS_BC11', 'width'=>200,'align'=>'center','editable' => false))
                        ->addColumn(array('label'=>'Jenis','index'=>'JNS_CONT', 'width'=>80,'editable' => true, 'align'=>'center'))
                        ->addColumn(array('label'=>'Consignee','index'=>'CONSIGNEE', 'width'=>350,'editable' => true,'editrules' => array('' => true)))
//                        ->addColumn(array('label'=>'Measurment','index'=>'MEAS', 'width'=>120,'editable' => true, 'align'=>'right','editrules' => array('' => true)))
//                        ->addColumn(array('label'=>'Layout','index'=>'layout', 'width'=>80,'editable' => true,'align'=>'center','editoptions'=>array('defaultValue'=>"C-1")))
//                        ->addColumn(array('label'=>'UID','index'=>'UID', 'width'=>150))
//                        ->addColumn(array('label'=>'Tgl. Entry','index'=>'TGLENTRY', 'width'=>150, 'search'=>false))
//                        ->addColumn(array('label'=>'Updated','index'=>'last_update', 'width'=>150, 'search'=>false))
                        ->renderGrid()
                    }}
                </div>
                
                <div class="col-md-12">
<!--                    <div id="btn-group-1" class="col-sm-3" style="margin-top: 10px;margin-bottom: 10px;">
                        <button id="cetak-permohonan" type="button" disabled class="btn btn-block btn-default">Cetak Respon PLP</button>
                    </div>
                    <div id="btn-group-2" class="col-sm-3" style="margin: 10px 0;">
                        <button type="button" disabled class="btn btn-block btn-default">Cetak PLP LCL</button>
                    </div>
                    <div id="btn-group-3" class="col-sm-3" style="margin: 10px 0;">
                        <button type="button" disabled class="btn btn-block btn-default">Cetak Respon PLP Tujuan</button>
                    </div>-->
                    <div id="btn-group-4" class="col-sm-2 pull-right" style="margin: 10px 0;display: none;">
                        <button type="button" id="createJoborderBtn" class="btn btn-block btn-info">Create Job Order</button>
                    </div>
                </div>
            </div>
                
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
        format: 'yyyy-mm-dd' 
    });
    $('#apl').on("change", function (e) { 
        var alasan,
            apl = $(this).val();
        console.log(apl);
        switch(apl) {
            case '1':
                alasan = "YOR atau SOR sama dengan atau lebih tinggi dari batas standar utilitas fasilitas yang ditetapkan oleh instansi teknis yang bertanggung jawab di bidang pelabuhan";
                break;
            case '2':
                alasan = "Pada TPS Asal tidak tersedia tempat penimbunan barang impor konsolidasi, yaitu pengangkutan barang impor menggunakan satu peti kemas untuk lebih dari satu penerima barang atau menggunakan 1 (satu) peti kemas untuk lebih dari 1 (satu) house bill of lading dengan penerima barang yang sama (Lessthan Container Load/LCL)";
                break;
            case '3':
                alasan = "Pada TPS Asal tidak tersedia lapangan atau gudang penumpukan barang impor yang membutuhkan sarana dan prasarana yang khusus atau penggunaan kapasitas tempat penumpukan dengan sarana dan prasarana yang khusus yang tersedia mencapai sama dengan atau lebih tinggi dari batas standar utilitas fasilitas";
                break;
            case '4':
                alasan = "Barang impor berupa barang kena cukai yang akan dilekati pita cukai di TPS Tujuan";
                break;
            case '5':
                alasan = "Barang impor konsolidasi dalam 1 (satu) masterairway bill atau master bill of lading";
                break;
            case '6':
                alasan = "Berdasarkan pertibangan Kepala Kantor Pabean dimungkinkan terjadi stagnasi setelah mendapatkan masukan dari Pengusaha TPS Asal";
                break;
            default:
                alasan = "";
        }
                
        $('#alasan').val(alasan);
    });
    
    $('#cetak-permohonan').click(function()
    {
        //Gets the selected row id.
        var rowid = $('#tpsResponPlpDetailGrid').jqGrid('getGridParam', 'selrow'),
            rowdata = $('#tpsResponPlpDetailGrid').getRowData(rowid);
        
        if(rowid){
            $('#cetak-permohonan-modal').modal('show');
            $("#container_id").val(rowid);
        }else{
            alert('Please Select Container.');
        }
    });
    
    $('#createJoborderBtn').click(function()
    {
        if(!confirm('Apakah anda yakin akan membuat Job Order?')){return false;}
        
        var responPlpId = '{{$respon->tps_responplptujuanxml_pk}}';
        var url = '{{ route("tps-responPlp-create-joborder", $respon->tps_responplptujuanxml_pk) }}';

        $.ajax({
            type: 'POST',
            data: 
            {
                'id' : responPlpId,
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
//                $('#btn-refresh').click();
            }
        });
        
    });
</script>

@endsection