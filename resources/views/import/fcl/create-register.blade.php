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
    <form class="form-horizontal" action="{{ route('fcl-register-store') }}" method="POST">
        <div class="box-body">            
            <div class="row">
                <div class="col-md-6">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. SPK</label>
                        <div class="col-sm-8">
                            <input type="text" readonly name="NOJOBORDER" class="form-control" value="{{$spk_number}}"  value="{{ old('NOJOBORDER') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="NOMBL" class="col-sm-3 control-label">No. MBL</label>
                        <div class="col-sm-8">
                            <input type="text" name="NOMBL" class="form-control"  value="{{ old('NOMBL') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. MBL</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="TGLMBL" class="form-control pull-right datepicker" value="{{ old('TGLMBL') }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Consolidator</label>
                        <div class="col-sm-8">
                            <select class="form-control select2" name="TCONSOLIDATOR_FK" style="width: 100%;" tabindex="-1" aria-hidden="true" >
                                <option value="">Choose Consolidator</option>
                                @foreach($consolidators as $consolidator)
                                    <option value="{{ $consolidator->id }}">{{ $consolidator->name }}</option>
                                @endforeach
                                @foreach($lokasisandars as $lokasisandar)
                                    <option value="{{ $lokasisandar->id }}">{{ $lokasisandar->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Consignee</label>
                        <div class="col-sm-6">
                            <select class="form-control select2" id="TCONSIGNEE_FK" name="TCONSIGNEE_FK" style="width: 100%;" tabindex="-1" aria-hidden="true" >
                                <option value="">Choose Consignee</option>
<!--                                @foreach($perusahaans as $perusahaan)
                                    <option value="{{ $perusahaan->id }}">{{ $perusahaan->name }}</option>
                                @endforeach-->
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-info" id="add-consignee-btn">Add Consignee</button>
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="PARTY" class="col-sm-3 control-label">Party</label>
                      <div class="col-sm-8">
                          <input type="text" name="PARTY" class="form-control"  value="{{ old('PARTY') }}"> 
                      </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Country</label>
                        <div class="col-sm-8">
                            <select class="form-control select2" name="TNEGARA_FK" style="width: 100%;" tabindex="-1" aria-hidden="true" >
                                <option value="">Choose Country</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Port of Loading</label>
                        <div class="col-sm-8">
                            <select class="form-control select2" id="TPELABUHAN_FK" name="TPELABUHAN_FK" style="width: 100%;" tabindex="-1" aria-hidden="true" >
                                <option value="">Choose Port of Loading</option>
<!--                                @foreach($pelabuhans as $pelabuhan)
                                    <option value="{{ $pelabuhan->id }}">{{ $pelabuhan->name }}</option>
                                @endforeach-->
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Vessel</label>
                        <div class="col-sm-6">
                            <!--<input type="text" name="VESSEL" class="form-control"  value="{{ old('VESSEL') }}">-->
                            <select class="form-control select2" id="vessel" name="VESSEL" style="width: 100%;" tabindex="-1" aria-hidden="true" >
                                <option value="">Choose Vessel</option>
                                @foreach($vessels as $vessel)
                                    <option value="{{ $vessel->name }}" data-code="{{ $vessel->code }}" data-callsign="{{ $vessel->callsign }}">{{ $vessel->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-info" id="add-vessel-btn">Add Vessel</button>
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Voy</label>
                        <div class="col-sm-3">
                            <input type="text" name="VOY" class="form-control"  value="{{ old('VOY') }}">
                        </div>
                        <label class="col-sm-2 control-label">Callsign</label>
                        <div class="col-sm-3">
                            <input type="text" name="CALLSIGN" class="form-control"  readonly value="{{ old('CALLSIGN') }}">
                        </div>
                    </div>             
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. ETA</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="ETA" class="form-control pull-right datepicker"  value="{{ old('ETA') }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Shipping Line</label>
                        <div class="col-sm-8">
                            <select class="form-control select2" name="TSHIPPINGLINE_FK" style="width: 100%;" tabindex="-1" aria-hidden="true" >
                                <option value="">Choose Shipping Line</option>
                                @foreach($shippinglines as $shippingline)
                                    <option value="{{ $shippingline->id }}">{{ $shippingline->name }}</option>
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
                                <input type="text" name="ETD" class="form-control pull-right datepicker"  value="{{ old('ETD') }}">
                            </div>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Lokasi Sandar</label>
                        <div class="col-sm-8">
                            <select class="form-control select2" name="TLOKASISANDAR_FK" style="width: 100%;" tabindex="-1" aria-hidden="true" >
                                <option value="">Choose Lokasi Sandar</option>
                                @foreach($lokasisandars as $lokasisandar)
                                    <option value="{{ $lokasisandar->id }}">{{ $lokasisandar->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6"> 
                    <div class="form-group">                       
                        <label class="col-sm-3 control-label">Kode Gudang</label>
                        <div class="col-sm-3">
                            <input type="text" name="KODE_GUDANG" value="PRJP" class="form-control"  readonly>
                        </div>
                        <label class="col-sm-2 control-label">Tujuan</label>
                        <div class="col-sm-3">
                            <input type="text" name="GUDANG_TUJUAN" value="PRJP" class="form-control"  readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Jenis Kegiatan</label>
                        <div class="col-sm-8">
                            <input type="text" name="JENISKEGIATAN" value="CY/CFS" class="form-control"  readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Gross Weight</label>
                        <div class="col-sm-3">
                            <input type="text" name="GROSSWEIGHT" class="form-control"  value="{{ old('GROSSWEIGHT') }}">
                        </div>
<!--                        <label class="col-sm-2 control-label">Total HBL</label>
                        <div class="col-sm-3">
                            <input type="number" name="JUMLAHHBL" class="form-control"  value="{{ old('JUMLAHHBL') }}">
                        </div>-->
                        <label class="col-sm-2 control-label">Measurment</label>
                        <div class="col-sm-3">
                            <input type="text" name="MEASUREMENT" class="form-control"  value="{{ old('MEASUREMENT') }}">
                        </div>
                    </div> 
                    <div class="form-group">  
                        <label class="col-sm-3 control-label">ISO Code</label>
                        <div class="col-sm-8">
                            <input type="text" name="ISO_CODE" class="form-control"  value="{{ old('ISO_CODE') }}">
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Description</label>
                      <div class="col-sm-8">
                          <textarea class="form-control" name="KETERANGAN" rows="3" placeholder="Description...">{{ old('KETERANGAN') }}</textarea>
                      </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. BC11</label>
                        <div class="col-sm-8">
                            <input type="text" name="NO_BC11" class="form-control" value="{{ old('NO_BC11') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. BC11</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="TGL_BC11" class="form-control pull-right datepicker" value="{{ old('TGL_BC11') }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. POS BC11</label>
                        <div class="col-sm-8">
                            <input type="text" name="NO_POS_BC11" class="form-control" value="{{ old('NO_POS_BC11') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. PLP</label>
                        <div class="col-sm-8">
                            <input type="text" name="TNO_PLP" class="form-control" value="{{ old('TNO_PLP') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. PLP</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="TTGL_PLP" class="form-control pull-right datepicker"  value="{{ old('TTGL_PLP') }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Pel. Muat</label>
                        <div class="col-sm-8">
                            <select class="form-control select2" id="PEL_MUAT" name="PEL_MUAT" style="width: 100%;" tabindex="-1" aria-hidden="true" >
                                <option value="">Choose Pelabuhan Muat</option>
<!--                                @foreach($pelabuhans as $pelabuhan)
                                    <option value="{{ $pelabuhan->code }}">{{ $pelabuhan->code }}</option>
                                @endforeach-->
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Pel. Transit</label>
                        <div class="col-sm-8">
                            <select class="form-control select2" id="PEL_TRANSIT" name="PEL_TRANSIT" style="width: 100%;" tabindex="-1" aria-hidden="true" >
                                <option value="">Choose Pelabuhan Transit</option>
                                <option value="-" selected>-</option>
<!--                                @foreach($pelabuhans as $pelabuhan)
                                    <option value="{{ $pelabuhan->code }}">{{ $pelabuhan->code }}</option>
                                @endforeach-->
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Pel. Bongkar</label>
                        <div class="col-sm-8">
                            <select class="form-control select2" id="PEL_BONGKAR" name="PEL_BONGKAR" style="width: 100%;" tabindex="-1" aria-hidden="true" >
                                <option value="">Choose Pelabuhan Bongkar</option>
<!--                                @foreach($pelabuhans as $pelabuhan)
                                    <option value="{{ $pelabuhan->code }}" @if($pelabuhan->code == 'IDTPP'){{'selected'}}@endif>{{ $pelabuhan->code }}</option>
                                @endforeach-->
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Simpan</button>
            <button type="reset" class="btn btn-default pull-right" style="margin-right: 10px;"><i class="fa fa-trash"></i> Batal</button>
            <a href="{{ route('fcl-register-index') }}" class="btn btn-danger pull-right" style="margin-right: 10px;"><i class="fa fa-close"></i> Keluar</a>
        </div>
        <!-- /.box-footer -->
    </form>
</div>

<div id="vessel-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="modal">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Add New Vessel</h4>
            </div>
            <form class="form-horizontal" id="create-vessel-form" action="{{ route('vessel-store') }}" method="POST">
                <div class="modal-body"> 
                    <div class="row">
                        <div class="col-md-12">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Vessel Name</label>
                                <div class="col-sm-8">
                                    <input type="text" name="vesselname" class="form-control" required /> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Vessel Code</label>
                                <div class="col-sm-8">
                                    <input type="text" name="vesselcode" class="form-control" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Call Sign</label>
                                <div class="col-sm-8">
                                    <input type="text" name="callsign" class="form-control" required /> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Country</label>
                                <div class="col-sm-8">
                                    <select class="form-control select2" id="nationality" name="nationality" style="width: 100%;" tabindex="-1" aria-hidden="true" >
                                        <option value="">Choose Country</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->name }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="consignee-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="modal">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Add New Consignee</h4>
            </div>
            <form class="form-horizontal" id="create-consignee-form" action="{{ route('perusahaan-store') }}" method="POST">
                <div class="modal-body"> 
                    <div class="row">
                        <div class="col-md-12">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Nama Perusahaan</label>
                                <div class="col-sm-8">
                                    <input type="text" name="NAMAPERUSAHAAN" class="form-control" required /> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">NPWP</label>
                                <div class="col-sm-8">
                                    <input type="text" id="npwp" name="NPWP" class="form-control" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Telepon</label>
                                <div class="col-sm-8">
                                    <input type="tel" name="NOTELP" class="form-control" /> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="email" name="EMAIL" class="form-control" /> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">CP</label>
                                <div class="col-sm-8">
                                    <input type="text" name="CONTACTPERSON" class="form-control" /> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Alamat</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="ALAMAT"></textarea>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

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
    $('#npwp').mask("99.999.999.9-999.999");
    $('.datepicker').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'yyyy-mm-dd' 
    });
    $('#vessel').on("change", function (e) { 
        $('input[name="CALLSIGN"]').val($(this).find(":selected").data("callsign"));
    });
    $("#TPELABUHAN_FK").select2({
        ajax: {
          url: "{{ route('getDataPelabuhan') }}",
          dataType: 'json',
          delay: 250,
          data: function (params) {
            return {
              q: params.term, // search term
//              page: params.page
            };
          },
          processResults: function (data, params) {
//              console.log(data);
            // parse the results into the format expected by Select2
            // since we are using custom formatting functions we do not need to
            // alter the remote JSON data, except to indicate that infinite
            // scrolling can be used
            params.page = params.page || 1;

            return {
              results: data.items,
//              pagination: {
//                more: (params.page * 30) < data.total_count
//              }
            };
          },
          cache: true
        },
        escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
        minimumInputLength: 3,
//        templateResult: formatRepo, // omitted for brevity, see the source of this page
//        templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
    });
    $("#TCONSIGNEE_FK").select2({
        ajax: {
          url: "{{ route('getDataPerusahaan') }}",
          dataType: 'json',
          delay: 250,
          data: function (params) {
            return {
              q: params.term, // search term
//              page: params.page
            };
          },
          processResults: function (data, params) {
//              console.log(data);
            // parse the results into the format expected by Select2
            // since we are using custom formatting functions we do not need to
            // alter the remote JSON data, except to indicate that infinite
            // scrolling can be used
            params.page = params.page || 1;

            return {
              results: data.items,
//              pagination: {
//                more: (params.page * 30) < data.total_count
//              }
            };
          },
          cache: true
        },
        escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
        minimumInputLength: 3,
//        templateResult: formatRepo, // omitted for brevity, see the source of this page
//        templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
    });
    $("#PEL_MUAT, #PEL_TRANSIT, #PEL_BONGKAR").select2({
        ajax: {
          url: "{{ route('getDataCodePelabuhan') }}",
          dataType: 'json',
          delay: 250,
          data: function (params) {
            return {
              q: params.term, // search term
//              page: params.page
            };
          },
          processResults: function (data, params) {
//              console.log(data);
            // parse the results into the format expected by Select2
            // since we are using custom formatting functions we do not need to
            // alter the remote JSON data, except to indicate that infinite
            // scrolling can be used
            params.page = params.page || 1;

            return {
              results: data.items,
//              pagination: {
//                more: (params.page * 30) < data.total_count
//              }
            };
          },
          cache: true
        },
        escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
        minimumInputLength: 3,
//        templateResult: formatRepo, // omitted for brevity, see the source of this page
//        templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
    });
    
    $("#PEL_BONGKAR").append('<option value="IDTPP" selected="selected">IDTPP</option>');
    $("#PEL_BONGKAR").trigger('change');
    
    $("#add-vessel-btn").on("click", function(e){
        e.preventDefault();
        $("#vessel-modal").modal('show');
        return false;
    });
    
    $("#add-consignee-btn").on("click", function(e){
        e.preventDefault();
        $("#consignee-modal").modal('show');
        return false;
    });
    
    $("#create-vessel-form").on("submit", function(){
        console.log(JSON.stringify($(this).formToObject('')));
        var url = $(this).attr('action');

        $.ajax({
            type: 'POST',
            data: JSON.stringify($(this).formToObject('')),
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
//                console.log(json);

                if(json.success) {
                    $('#btn-toolbar').showAlertAfterElement('alert-success alert-custom', json.message, 5000);
                    $("#vessel").append('<option value="'+json.data.vesselname+'" selected="selected">'+json.data.vesselname+'</option>');
                    $("#vessel").trigger('change');
                    $('input[name="CALLSIGN"]').val(json.data.callsign);
                    $("#vessel-modal").modal('hide');
                } else {
                    $('#btn-toolbar').showAlertAfterElement('alert-danger alert-custom', json.message, 5000);
                }
//                
//                //Triggers the "Close" button funcionality.
//                $('#btn-refresh').click();
            }
        });
        
        return false;
    });
    
    $("#create-consignee-form").on("submit", function(){
        console.log(JSON.stringify($(this).formToObject('')));
        var url = $(this).attr('action');

        $.ajax({
            type: 'POST',
            data: JSON.stringify($(this).formToObject('')),
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
                    $("#TCONSIGNEE_FK").append('<option value="'+json.data.id+'" selected="selected">'+json.data.NAMAPERUSAHAAN+'</option>');
                    $("#TCONSIGNEE_FK").trigger('change');
                    $("#consignee-modal").modal('hide');
                } else {
                    $('#btn-toolbar').showAlertAfterElement('alert-danger alert-custom', json.message, 5000);
                }
//                
//                //Triggers the "Close" button funcionality.
//                $('#btn-refresh').click();
            }
        });
        
        return false;
    });
    
</script>

@endsection