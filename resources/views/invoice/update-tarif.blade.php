@extends('layout')

@section('content')

@include('partials.form-alert')

<div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Form Tarif</h3>
    </div>
    <!-- /.box-header -->
    <form class="form-horizontal" action="{{ route('invoice-tarif-update', $tarif->id ) }}" method="POST">
        <div class="box-body">            
            <div class="row">
                <div class="col-md-6">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    <div class="form-group">
                      <label for="roles" class="col-sm-3 control-label">Consolidator</label>
                      <div class="col-sm-8">
                            <select class="form-control select2 select2-hidden-accessible" name="consolidator_id" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                <option value="">Choose Consolidator</option>
                                @foreach($consolidators as $consolidator)
                                    <option value="{{ $consolidator->id }}" @if($tarif->consolidator_id == $consolidator->id) {{ 'selected' }} @endif>{{ $consolidator->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                      <label for="type" class="col-sm-3 control-label">Type</label>
                      <div class="col-sm-8">
                            <select class="form-control select2 select2-hidden-accessible" name="type" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                <option value="">Choose Type</option>
                                <option value="BB" @if($tarif->type == 'BB') {{ 'selected' }} @endif>BB</option>
                                <option value="DRY" @if($tarif->type == 'DRY') {{ 'selected' }} @endif>DRY</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="rdm" class="col-sm-3 control-label">RDM</label>
                      <div class="col-sm-8">
                          <input type="number" name="rdm" class="form-control" id="rdm" value="{{ $tarif->rdm }}" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="storage" class="col-sm-3 control-label">Storage</label>
                      <div class="col-sm-8">
                          <input type="number" name="storage" class="form-control" id="storage" value="{{ $tarif->storage }}" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="storage_masa1" class="col-sm-3 control-label">Storage Masa I</label>
                      <div class="col-sm-8">
                          <input type="number" name="storage_masa1" class="form-control" id="storage_masa1" value="{{ $tarif->storage_masa1 }}" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="storage_masa2" class="col-sm-3 control-label">Storage Masa II</label>
                      <div class="col-sm-8">
                          <input type="number" name="storage_masa2" class="form-control" id="storage_masa2" value="{{ $tarif->storage_masa2 }}" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="storage_masa3" class="col-sm-3 control-label">Storage Masa III</label>
                      <div class="col-sm-8">
                          <input type="number" name="storage_masa3" class="form-control" id="storage_masa3" value="{{ $tarif->storage_masa3 }}" required>
                      </div>
                    </div>
                </div>
                <div class="col-md-6"> 
                    <div class="form-group">
                      <label for="behandle" class="col-sm-3 control-label">Behandle</label>
                      <div class="col-sm-8">
                          <input type="number" name="behandle" class="form-control" id="behandle" value="{{ $tarif->behandle }}" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="adm" class="col-sm-3 control-label">Biaya Admin</label>
                      <div class="col-sm-8">
                          <input type="number" name="adm" class="form-control" id="adm" value="{{ $tarif->adm }}" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="surcharge_price" class="col-sm-3 control-label">Surcharge</label>
                      <div class="col-sm-8">
                          <input type="number" name="surcharge_price" class="form-control" id="surcharge_price" value="{{ $tarif->surcharge_price }}" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="surcharge" class="col-sm-3 control-label">> 2.5Ton</label>
                      <div class="col-sm-8">
                          <input type="checkbox" name="surcharge" id="surcharge" value="1" @if($tarif->surcharge) {{ 'checked' }} @endif />
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="cbm" class="col-sm-3 control-label">X CBM</label>
                      <div class="col-sm-8">
                          <input type="checkbox" name="cbm" id="cbm" value="1" @if($tarif->cbm) {{ 'checked' }} @endif />
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="pembulatan" class="col-sm-3 control-label">Pembulatan 0.5</label>
                      <div class="col-sm-8">
                          <input type="checkbox" name="pembulatan" id="pembulatan" value="1" @if($tarif->pembulatan) {{ 'checked' }} @endif />
                      </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Simpan</button>
            <button type="reset" class="btn btn-default pull-right" style="margin-right: 10px;"><i class="fa fa-trash"></i> Batal</button>
            <a href="{{ route('invoice-tarif-index') }}" class="btn btn-danger pull-right" style="margin-right: 10px;"><i class="fa fa-close"></i> Keluar</a>
        </div>
        <!-- /.box-footer -->
    </form>
</div>

@endsection

@section('custom_css')

<!-- Select2 -->
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" />

<!-- Bootstrap Switch -->
<link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/plugins/bootstrap-switch/bootstrap-switch.min.css") }}">
@endsection

@section('custom_js')

<!-- Select2 -->
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>

<!-- Bootstrap Switch -->
<script src="{{ asset("/bower_components/AdminLTE/plugins/bootstrap-switch/bootstrap-switch.min.js") }}"></script>

<script type="text/javascript">
    $('select').select2(); 
  
//    $.fn.bootstrapSwitch.defaults.size = 'mini';
    $.fn.bootstrapSwitch.defaults.onColor = 'danger';
    $.fn.bootstrapSwitch.defaults.onText = 'Ya';
    $.fn.bootstrapSwitch.defaults.offText = 'Tidak';
    
    $("input[type='checkbox']").bootstrapSwitch();
  
</script>

@endsection
