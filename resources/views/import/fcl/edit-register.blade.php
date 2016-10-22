@extends('layout')

@section('content')

@include('partials.form-alert')

<div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Form Register FCL</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <!-- /.box-header -->
    <form class="form-horizontal" action="{{ route('fcl-register-update', $joborder->TJOBORDER_PK) }}" method="POST">
        <div class="box-body">            
            <div class="row">
                <div class="col-md-6">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. SPK</label>
                        <div class="col-sm-8">
                            <input type="text" readonly name="NOJOBORDER" class="form-control" value="{{ $joborder->NOJOBORDER }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="NOMBL" class="col-sm-3 control-label">No. MBL</label>
                        <div class="col-sm-8">
                            <input type="text" name="NOMBL" class="form-control" required value="{{ $joborder->NOMBL }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. MBL</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="TGLMBL" class="form-control pull-right datepicker" required value="{{ $joborder->TGLMBL }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Consolidator</label>
                        <div class="col-sm-8">
                            <select class="form-control select2" name="TCONSOLIDATOR_FK" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                <option value="">Choose Consolidator</option>
                                @foreach($consolidators as $consolidator)
                                    <option value="{{ $consolidator->id }}" @if($consolidator->id == $joborder->TCONSOLIDATOR_FK){{ "selected" }}@endif>{{ $consolidator->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>     
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Consignee</label>
                        <div class="col-sm-8">
                            <select class="form-control select2" id="TCONSIGNEE_FK" name="TCONSIGNEE_FK" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                <option value="">Choose Consignee</option>
                                @foreach($perusahaans as $perusahaan)
                                    <option value="{{ $perusahaan->id }}" @if($perusahaan->id == $joborder->TCONSIGNEE_FK){{ "selected" }}@endif>{{ $perusahaan->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="PARTY" class="col-sm-3 control-label">Party</label>
                      <div class="col-sm-8">
                          <input type="text" name="PARTY" class="form-control" required value="{{ $joborder->PARTY }}"> 
                      </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Country</label>
                        <div class="col-sm-8">
                            <select class="form-control select2" name="TNEGARA_FK" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                <option value="">Choose Country</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}" @if($country->id == $joborder->TNEGARA_FK){{ "selected" }}@endif>{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Port of Loading</label>
                        <div class="col-sm-8">
                            <select class="form-control select2" name="TPELABUHAN_FK" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                <option value="">Choose Port of Loading</option>
                                @foreach($pelabuhans as $pelabuhan)
                                    <option value="{{ $pelabuhan->id }}" @if($pelabuhan->id == $joborder->TPELABUHAN_FK){{ "selected" }}@endif>{{ $pelabuhan->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Vessel</label>
                        <div class="col-sm-8">
                            <!--<input type="text" name="VESSEL" class="form-control" required value="{{ $joborder->VESSEL }}">-->
                            <select class="form-control select2" id="vessel" name="VESSEL" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                <option value="">Choose Vessel</option>
                                @foreach($vessels as $vessel)
                                    <option value="{{ $vessel->name }}" data-code="{{ $vessel->code }}" data-callsign="{{ $vessel->callsign }}" @if($vessel->name == $joborder->VESSEL){{ "selected" }}@endif>{{ $vessel->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Voy</label>
                        <div class="col-sm-3">
                            <input type="text" name="VOY" class="form-control" required value="{{ $joborder->VOY }}">
                        </div>
                        <label class="col-sm-2 control-label">Callsign</label>
                        <div class="col-sm-3">
                            <input type="text" name="CALLSIGN" class="form-control" required readonly value="{{ $joborder->CALLSIGN }}">
                        </div>
                    </div>             
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. ETA</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="ETA" class="form-control pull-right datepicker" required value="{{ $joborder->ETA }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Shipping Line</label>
                        <div class="col-sm-8">
                            <select class="form-control select2" name="TSHIPPINGLINE_FK" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                <option value="">Choose Shipping Line</option>
                                @foreach($shippinglines as $shippingline)
                                    <option value="{{ $shippingline->id }}" @if($shippingline->id == $joborder->TSHIPPINGLINE_FK){{ "selected" }}@endif>{{ $shippingline->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. ETD</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="ETD" class="form-control pull-right datepicker" required value="{{ $joborder->ETD }}">
                            </div>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Lokasi Sandar</label>
                        <div class="col-sm-8">
                            <select class="form-control select2" name="TLOKASISANDAR_FK" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                <option value="">Choose Lokasi Sandar</option>
                                @foreach($lokasisandars as $lokasisandar)
                                    <option value="{{ $lokasisandar->id }}" @if($lokasisandar->id == $joborder->TLOKASISANDAR_FK){{ "selected" }}@endif>{{ $lokasisandar->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6"> 
                    <div class="form-group">                       
                        <label class="col-sm-3 control-label">Kode Gudang</label>
                        <div class="col-sm-3">
                            <input type="text" name="KODE_GUDANG" value="{{ $joborder->KODE_GUDANG }}" class="form-control" required readonly>
                        </div>
                        <label class="col-sm-2 control-label">Tujuan</label>
                        <div class="col-sm-3">
                            <input type="text" name="GUDANG_TUJUAN" value="{{ $joborder->GUDANG_TUJUAN }}" class="form-control" required readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Jenis Kegiatan</label>
                        <div class="col-sm-8">
                            <input type="text" name="JENISKEGIATAN" value="{{ $joborder->JENISKEGIATAN }}" class="form-control" required readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Gross Weight</label>
                        <div class="col-sm-3">
                            <input type="text" name="GROSSWEIGHT" class="form-control" required value="{{ $joborder->GROSSWEIGHT }}">
                        </div>
<!--                        <label class="col-sm-2 control-label">Total HBL</label>
                        <div class="col-sm-3">
                            <input type="number" name="JUMLAHHBL" class="form-control" required value="{{ $joborder->JUMLAHHBL }}">
                        </div>-->
                        <label class="col-sm-2 control-label">Measurment</label>
                        <div class="col-sm-3">
                            <input type="text" name="MEASUREMENT" class="form-control" required value="{{ $joborder->MEASUREMENT }}">
                        </div>
                    </div> 
                    <div class="form-group">
                        
                        <label class="col-sm-3 control-label">ISO Code</label>
                        <div class="col-sm-8">
                            <input type="text" name="ISO_CODE" class="form-control" required value="{{ $joborder->ISO_CODE }}">
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Description</label>
                      <div class="col-sm-8">
                          <textarea class="form-control" name="KETERANGAN" rows="3" placeholder="Description...">{{ $joborder->KETERANGAN }}</textarea>
                      </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. BC11</label>
                        <div class="col-sm-8">
                            <input type="text" name="NO_BC11" class="form-control" required value="{{ $joborder->NO_BC11 }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. BC11</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="TGL_BC11" class="form-control pull-right datepicker" required value="{{ $joborder->TGL_BC11 }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. POS BC11</label>
                        <div class="col-sm-8">
                            <input type="text" name="NO_POS_BC11" class="form-control" required value="{{ $joborder->NO_POS_BC11 }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. PLP</label>
                        <div class="col-sm-8">
                            <input type="text" name="TNO_PLP" class="form-control" required value="{{ $joborder->TNO_PLP }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. PLP</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="TTGL_PLP" class="form-control pull-right datepicker" required value="{{ $joborder->TTGL_PLP }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Pel. Muat</label>
                        <div class="col-sm-8">
                            <select class="form-control select2" name="PEL_MUAT" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                <option value="">Choose Pelabuhan Muat</option>
                                @foreach($pelabuhans as $pelabuhan)
                                    <option value="{{ $pelabuhan->code }}" @if($pelabuhan->code == $joborder->PEL_MUAT){{ "selected" }}@endif>{{ $pelabuhan->code }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Pel. Transit</label>
                        <div class="col-sm-8">
                            <select class="form-control select2" name="PEL_TRANSIT" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                <option value="">Choose Pelabuhan Transit</option>
                                <option value="-" selected>-</option>
                                @foreach($pelabuhans as $pelabuhan)
                                    <option value="{{ $pelabuhan->code }}" @if($pelabuhan->code == $joborder->PEL_TRANSIT){{ "selected" }}@endif>{{ $pelabuhan->code }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Pel. Bongkar</label>
                        <div class="col-sm-8">
                            <select class="form-control select2" name="PEL_BONGKAR" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                <option value="">Choose Pelabuhan Bongkar</option>
                                @foreach($pelabuhans as $pelabuhan)
                                    <option value="{{ $pelabuhan->code }}" @if($pelabuhan->code == $joborder->PEL_BONGKAR){{'selected'}}@endif>{{ $pelabuhan->code }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Simpan</button>
            <a href="{{ route('fcl-register-index') }}" class="btn btn-danger pull-right" style="margin-right: 10px;"><i class="fa fa-close"></i> Keluar</a>
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
      <h3 class="box-title">Form Container</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="form-horizontal">
        <div class="box-body">            
            <div class="row">
                <div class="col-md-12">
                    {{
                        GridRender::setGridId("containerGrid")
                        ->enableFilterToolbar()
                        ->setGridOption('url', URL::to('/container/grid-data-cy?jobid='.$joborder->TJOBORDER_PK))
                        ->setGridOption('editurl',URL::to('/container/crud-cy/'.$joborder->TJOBORDER_PK))
                        ->setGridOption('rowNum', 10)
                        ->setGridOption('shrinkToFit', true)
                        ->setGridOption('sortname','TCONTAINER_PK')
                        ->setGridOption('rownumbers', true)
                        ->setGridOption('height', '150')
                        ->setGridOption('rowList',array(10,20,50))
                        ->setGridOption('useColSpanStyle', true)
                        ->setNavigatorOptions('navigator', array('viewtext'=>'view'))
                        ->setNavigatorOptions('view',array('closeOnEscape'=>false))
                        ->setNavigatorOptions('navigator', array('add' => true, 'edit' => true, 'del' => true, 'view' => true, 'refresh' => false))
                        ->setNavigatorOptions('add', array('closeAfterAdd' => true))
                        ->setNavigatorEvent('add', 'afterSubmit', 'afterSubmitEvent')
                        ->setNavigatorOptions('edit', array('closeAfterEdit' => true))
                        ->setNavigatorEvent('edit', 'afterSubmit', 'afterSubmitEvent')
                        ->setNavigatorEvent('del', 'afterSubmit', 'afterSubmitEvent')
                        ->setFilterToolbarOptions(array('autosearch'=>true))
                        ->setGridEvent('onSelectRow', 'onSelectRowEvent')
                        ->addColumn(array('key'=>true,'index'=>'TCONTAINER_PK','hidden'=>true))
                        ->addColumn(array('label'=>'No. Container','index'=>'NOCONTAINER','width'=>250,'editable' => true, 'editrules' => array('required' => true)))
                        ->addColumn(array('label'=>'Size','index'=>'SIZE', 'width'=>80,'align'=>'center','editable' => true, 'editrules' => array('required' => true,'number'=>true),'edittype'=>'select','editoptions'=>array('value'=>"20:20;40:40")))
                        ->addColumn(array('label'=>'Teus','index'=>'TEUS', 'width'=>80,'align'=>'center','editable' => false))
                        ->addColumn(array('label'=>'No. Seal','index'=>'NOSEGEL', 'width'=>120,'editable' => true, 'align'=>'right'))
                        ->addColumn(array('label'=>'Weight','index'=>'WEIGHT', 'width'=>120,'editable' => true, 'align'=>'right','editrules' => array('required' => true)))
                        ->addColumn(array('label'=>'Measurment','index'=>'MEAS', 'width'=>120,'editable' => true, 'align'=>'right','editrules' => array('required' => true)))
                        ->addColumn(array('label'=>'Layout','index'=>'layout', 'width'=>80,'editable' => true,'align'=>'center','editoptions'=>array('defaultValue'=>"C-1")))
                        ->addColumn(array('label'=>'UID','index'=>'UID', 'width'=>150))
                        ->addColumn(array('label'=>'Tgl. Entry','index'=>'TGLENTRY', 'width'=>150, 'search'=>false))
                        ->addColumn(array('label'=>'Updated','index'=>'last_update', 'width'=>150, 'search'=>false))
                        ->renderGrid()
                    }}
                </div>
                <div class="col-md-12">
<!--                    <a class="btn btn-app">
                        <i class="fa fa-print"></i> Cetak Permohonan
                    </a>-->
<!--                    <div id="btn-group-1" class="col-sm-3 col-sm-offset-3" style="margin-top: 10px;margin-bottom: 10px;">
                        <button id="cetak-permohonan" type="button" disabled class="btn btn-block btn-default">Cetak Permohonan</button>
                    </div>
                    <div id="btn-group-2" class="col-sm-3" style="margin: 10px 0;">
                        <button type="button" class="btn btn-block btn-default">Cetak Cek List</button>
                    </div>-->
<!--                    <a class="btn btn-app">
                        <i class="fa fa-print"></i> Cetak Cek List
                    </a>-->
                </div>
            </div>
                
        </div>
    </div>
</div>

<!--<div id="cetak-permohonan-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Cetak Permohonan</h4>
            </div>
            <form class="form-horizontal" action="{{ route('lcl-register-print-permohonan') }}" method="POST">
                <div class="modal-body"> 
                    <div class="row">
                        <div class="col-md-12">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">No. Surat</label>
                                <div class="col-sm-8">
                                    <input type="text" name="no_surat" class="form-control" required> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Prihal</label>
                                <div class="col-sm-8">
                                    <textarea name="prihal_surat" class="form-control" required>Permohonan PLP-FCL Ke Gudang Primanata Jaya Persada</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">SOR</label>
                                <div class="col-sm-8">
                                    <input type="text" name="sor" class="form-control" required> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Penandatangan</label>
                                <div class="col-sm-8">
                                    <input type="text" name="penandatangan" class="form-control" required> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Jabatan Pemohon</label>
                                <div class="col-sm-8">
                                    <input type="text" name="jabatan" class="form-control" required> 
                                </div>
                            </div>
                            <input id="container_id" name="container_id" type="hidden" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                  <button type="submit" class="btn btn-primary">Cetak</button>
                </div>
            </form>
        </div> /.modal-content 
    </div> /.modal-dialog 
</div> /.modal -->

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
    $('#vessel').on("change", function (e) { 
        $('input[name="CALLSIGN"]').val($(this).find(":selected").data("callsign"));
    });
    $('#cetak-permohonan').click(function()
    {
        //Gets the selected row id.
        var rowid = $('#containerGrid').jqGrid('getGridParam', 'selrow'),
            rowdata = $('#containerGrid').getRowData(rowid);
        
        if(rowid){
            $('#cetak-permohonan-modal').modal('show');
            $("#container_id").val(rowid);
        }else{
            alert('Please Select Container.');
        }
    });
</script>

@endsection