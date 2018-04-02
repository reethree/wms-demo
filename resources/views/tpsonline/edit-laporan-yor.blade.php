@extends('layout')

@section('content')

@include('partials.form-alert')

<div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Edit TPS Laporan Yor</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <!-- /.box-header -->
    <form class="form-horizontal" action="#" method="POST">
        <div class="box-body">            
            <div class="row">
                <div class="col-md-6">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Ref Number</label>
                        <div class="col-sm-8">
                            <input type="text" name="REF_NUMBER" class="form-control"  value="{{ $header->REF_NUMBER }}" required readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kode TPS</label>
                        <div class="col-sm-8">
                            <input type="text" name="KD_TPS" class="form-control"  value="{{ $header->KD_TPS }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kode Gudang</label>
                        <div class="col-sm-8">
                            <input type="text" name="KD_GUDANG" class="form-control"  value="{{ $header->KD_GUDANG }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. Laporan</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="TGL_LAPORAN" class="form-control pull-right datepicker" required value="{{ date('Y-m-d', strtotime($header->TGL_LAPORAN)) }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Response</label>
                        <div class="col-sm-8">
                            <input type="text" name="RESPONSE" class="form-control"  value="{{ $header->RESPONSE }}" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">      
                    
                    @foreach($details as $detail)
                    
                    <div style="border-bottom: 1px solid; margin-bottom: 20px;text-align: center"><p style="font-size: 20px;">{{$detail->TYPE}}</p></div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">YOR</label>
                        <div class="col-sm-8">
                            <input type="text" name="YOR" class="form-control"  value="{{$detail->YOR}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kapasitas Lapangan</label>
                        <div class="col-sm-8">
                            <input type="text" name="KAPASITAS_LAPANGAN" class="form-control"  value="{{$detail->KAPASITAS_LAPANGAN}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kapasitas Gudang</label>
                        <div class="col-sm-8">
                            <input type="text" name="KAPASITAS_GUDANG" class="form-control"  value="{{$detail->KAPASITAS_GUDANG}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Total Kontainer</label>
                        <div class="col-sm-8">
                            <input type="text" name="TOTAL_CONT" class="form-control"  value="{{$detail->TOTAL_CONT}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Total Kemasan</label>
                        <div class="col-sm-8">
                            <input type="text" name="TOTAL_KMS" class="form-control"  value="{{$detail->TOTAL_KMS}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Jml. Cont 20F</label>
                        <div class="col-sm-8">
                            <input type="text" name="JML_CONT20F" class="form-control"  value="{{$detail->JML_CONT20F}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Jml. Cont 40F</label>
                        <div class="col-sm-8">
                            <input type="text" name="JML_CONT40F" class="form-control"  value="{{$detail->JML_CONT40F}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Jml. Cont 45F</label>
                        <div class="col-sm-8">
                            <input type="text" name="JML_CONT45F" class="form-control"  value="{{$detail->JML_CONT45F}}" required>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Simpan</button>
            <a href="{{ route('tps-laporanYor-index') }}" class="btn btn-danger pull-right" style="margin-right: 10px;"><i class="fa fa-close"></i> Keluar</a>
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