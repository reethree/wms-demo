@extends('layout')

@section('content')

@include('partials.form-alert')

<div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Form Edit {{ $item->description }}</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <!-- /.box-header -->
    <form class="form-horizontal" action="{{ route('invoice-tarif-item-update', $item->id) }}" method="POST">
        <div class="box-body">            
            <div class="row">
                <div class="col-md-6">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Item Description</label>
                        <div class="col-sm-8">
                            <input type="text" name="description" class="form-control"  value="{{ $item->description }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Unit</label>
                        <div class="col-sm-8">
                            <select class="form-control select2" id="apl" name="unit" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                <option value="">Choose Unit Tarif</option>
                                @if($item->tarif_id == 1)
                                    <option value="M/T" @if($item->unit == 'M/T') {{'selected'}} @endif>M/T</option>
                                    <option value="Hari" @if($item->unit == 'Hari') {{'selected'}} @endif>Hari</option>
                                    <option value="Doc" @if($item->unit == 'Doc') {{'selected'}} @endif>Doc</option>
                                @else
                                    <option value="Box 20" @if($item->unit == 'Box 20') {{'selected'}} @endif>Box 20</option>
                                    <option value="Box 40/45" @if($item->unit == 'Box 40/45') {{'selected'}} @endif>Box 40/45</option>
                                @endif                              
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Refund</label>
                        <div class="col-sm-8">
                            <input type="text" name="refund" class="form-control" value="{{ $item->refund }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Royalti</label>
                        <div class="col-sm-8">
                            <input type="text" name="royalti" class="form-control" value="{{ $item->royalti }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Harga</label>
                        <div class="col-sm-8">
                            <input type="text" name="harga_batasan" class="form-control" value="{{ $item->harga_batasan }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Batasan 1</label>
                        <div class="col-sm-8">
                            <select class="form-control select2" id="apl" name="batasan" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                <option value="">Choose Batasan</option>
                                <option value="Min" @if($item->batasan == 'Min') {{'selected'}} @endif>Min</option>
                                <option value="Max" @if($item->batasan == 'Max') {{'selected'}} @endif>Max</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nilai Batasan 1</label>
                        <div class="col-sm-8">
                            <input type="number" name="nilai_batasan" class="form-control" value="{{ $item->nilai_batasan }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Batasan 2</label>
                        <div class="col-sm-8">
                            <select class="form-control select2" id="apl" name="batasan2" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                <option value="">Choose Batasan</option>
                                <option value="Min" @if($item->batasan2 == 'Min') {{'selected'}} @endif>Min</option>
                                <option value="Max" @if($item->batasan2 == 'Max') {{'selected'}} @endif>Max</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nilai Batasan 2</label>
                        <div class="col-sm-8">
                            <input type="number" name="nilai_batasan2" class="form-control" value="{{ $item->nilai_batasan2 }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Discount</label>
                        <div class="col-sm-8">
                            <input type="number" name="discount" class="form-control" value="{{ $item->discount }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">PPN</label>
                        <div class="col-sm-8">
                            <input type="number" name="ppn" class="form-control" value="{{ $item->ppn }}" required>
                        </div>
                    </div>        
                                                
                </div>
                @if($item->tarif_id == 1)
                <div class="col-md-6">
                    
                    <h5><strong>Perhitungan Masa</strong></h5>
                    <hr />
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Masa 1</label>
                        <div class="col-sm-8">
                            <div class="col-sm-4"><input type="number" name="masa1_start" class="form-control" value="{{ $item->masa1_start }}" required></div>
                            <div class="col-sm-2">S/D</div>
                            <div class="col-sm-4"><input type="number" name="masa1_end" class="form-control" value="{{ $item->masa1_end }}" required></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Harga Masa 1</label>
                        <div class="col-sm-8">
                            <input type="text" name="harga_masa1" class="form-control" value="{{ $item->harga_masa1 }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Masa 2</label>
                        <div class="col-sm-8">
                            <div class="col-sm-4"><input type="number" name="masa2_start" class="form-control" value="{{ $item->masa2_start }}" required></div>
                            <div class="col-sm-2">S/D</div>
                            <div class="col-sm-4"><input type="number" name="masa2_end" class="form-control" value="{{ $item->masa2_end }}" required></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Harga Masa 2</label>
                        <div class="col-sm-8">
                            <input type="text" name="harga_masa2" class="form-control" value="{{ $item->harga_masa2 }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Masa 3</label>
                        <div class="col-sm-8">
                            <div class="col-sm-4"><input type="number" name="masa3_start" class="form-control" value="{{ $item->masa3_start }}" required></div>
                            <div class="col-sm-2">S/D</div>
                            <div class="col-sm-4"><input type="number" name="masa3_end" class="form-control" value="{{ $item->masa3_end }}" required></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Harga Masa 3</label>
                        <div class="col-sm-8">
                            <input type="text" name="harga_masa3" class="form-control" value="{{ $item->harga_masa3 }}" required>
                        </div>
                    </div>
                    <hr />
                    <h5><strong>Perhitungan Masa DG</strong></h5>
                    <hr />
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Masa 1</label>
                        <div class="col-sm-8">
                            <div class="col-sm-4"><input type="number" name="masa_dg1_start" class="form-control" value="{{ $item->masa_dg1_start }}" required></div>
                            <div class="col-sm-2">S/D</div>
                            <div class="col-sm-4"><input type="number" name="masa_dg1_end" class="form-control" value="{{ $item->masa_dg1_end }}" required></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Harga Masa 1</label>
                        <div class="col-sm-8">
                            <input type="text" name="harga_masa_dg1" class="form-control" value="{{ $item->harga_masa_dg1 }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Masa 2</label>
                        <div class="col-sm-8">
                            <div class="col-sm-4"><input type="number" name="masa_dg2_start" class="form-control" value="{{ $item->masa_dg2_start }}" required></div>
                            <div class="col-sm-2">S/D</div>
                            <div class="col-sm-4"><input type="number" name="masa_dg2_end" class="form-control" value="{{ $item->masa_dg2_end }}" required></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Harga Masa 2</label>
                        <div class="col-sm-8">
                            <input type="text" name="harga_masa_dg2" class="form-control" value="{{ $item->harga_masa_dg2 }}" required>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Simpan</button>
            <a href="{{ route("invoice-tarif-view", $item->tarif_id) }}" class="btn btn-danger pull-right" style="margin-right: 10px;"><i class="fa fa-close"></i> Keluar</a>
        </div>
        <!-- /.box-footer -->
    </form>
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
</script>

@endsection