@extends('layout')

@section('content')

@include('partials.form-alert')

<div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Edit TPS COARI CONT</h3>
      <div class="box-tools pull-right">
        <!--<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>-->
          <a href="{{ route("tps-coariCont-upload", $header->TPSCOARICONTXML_PK) }}" type="button" id="resend-btn" class="btn btn-info btn-sm"><i class="fa fa-send"></i> Kirim Ulang</a>
      </div>
    </div>
    <!-- /.box-header -->
    <form class="form-horizontal" action="{{ route('tps-coariCont-update', $header->TPSCOARICONTXML_PK) }}" method="POST">
        <div class="box-body">            
            <div class="row">
                <input name="_token" type="hidden" value="{{ csrf_token() }}">
                <input id="TPSCOARIKMSDETAILXML_PK" name="TPSCOARICONTDETAILXML_PK" type="hidden" value="{{ $detail->TPSCOARICONTDETAILXML_PK }}">  
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">REF Number</label>
                        <div class="col-sm-8">
                            <input type="text" name="REF_NUMBER" class="form-control"  value="{{ $detail->REF_NUMBER }}" required readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. Entry</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="TGL_ENTRY" class="form-control pull-right datepicker" required value="{{ date('Y-m-d',strtotime($detail->TGL_ENTRY)) }}" readonly>
                            </div>
                        </div>
                    </div>     
                </div>
                <div class="col-md-12"><hr /></div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kode Dokumen</label>
                        <div class="col-sm-8">
                            <input type="text" name="KD_DOK_INOUT" class="form-control"  value="{{ $detail->KD_DOK_INOUT }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kode TPS</label>
                        <div class="col-sm-8">
                            <input type="text" name="KD_TPS" class="form-control"  value="{{ $detail->KD_TPS }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nama Angkut</label>
                        <div class="col-sm-8">
                            <input type="text" name="NM_ANGKUT" class="form-control"  value="{{ $detail->NM_ANGKUT }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. VOY Flight</label>
                        <div class="col-sm-8">
                            <input type="text" name="NO_VOY_FLIGHT" class="form-control"  value="{{ $detail->NO_VOY_FLIGHT }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Call Sign</label>
                        <div class="col-sm-8">
                            <input type="text" name="CALL_SIGN" class="form-control"  value="{{ $detail->CALL_SIGN }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. Tiba</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="TGL_TIBA" class="form-control pull-right datepicker" required value="{{ $detail->TGL_TIBA }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kode Gudang</label>
                        <div class="col-sm-8">
                            <input type="text" name="KD_GUDANG" class="form-control"  value="{{ $detail->KD_GUDANG }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. Container</label>
                        <div class="col-sm-8">
                            <input type="text" name="NO_CONT" class="form-control"  value="{{ $detail->NO_CONT }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Ukuran Container</label>
                        <div class="col-sm-8">
                            <input type="text" name="UK_CONT" class="form-control"  value="{{ $detail->UK_CONT }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. Segel</label>
                        <div class="col-sm-8">
                            <input type="text" name="NO_SEGEL" class="form-control"  value="{{ $detail->NO_SEGEL }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Jenis Container</label>
                        <div class="col-sm-8">
                            <input type="text" name="JNS_CONT" class="form-control"  value="{{ $detail->JNS_CONT }}" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. MBL AWB</label>
                        <div class="col-sm-8">
                            <input type="text" name="NO_MASTER_BL_AWB" class="form-control"  value="{{ $detail->NO_MASTER_BL_AWB }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. MBL AWB</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="TGL_MASTER_BL_AWB" class="form-control pull-right datepicker" required value="{{ $detail->TGL_MASTER_BL_AWB }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. BL AWB</label>
                        <div class="col-sm-8">
                            <input type="text" name="NO_BL_AWB" class="form-control"  value="{{ $detail->NO_BL_AWB }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. BL AWB</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="TGL_BL_AWB" class="form-control pull-right datepicker" required value="{{ $detail->TGL_BL_AWB }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Consignee</label>
                        <div class="col-sm-8">
                            <input type="text" name="CONSIGNEE" class="form-control"  value="{{ $detail->CONSIGNEE }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Bruto</label>
                        <div class="col-sm-8">
                            <input type="text" name="BRUTO" class="form-control"  value="{{ $detail->BRUTO }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. BC11</label>
                        <div class="col-sm-8">
                            <input type="text" name="NO_BC11" class="form-control"  value="{{ $detail->NO_BC11 }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. BC11</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="TGL_BC11" class="form-control pull-right datepicker" required value="{{ $detail->TGL_BC11 }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. POS BC11</label>
                        <div class="col-sm-8">
                            <input type="text" name="NO_POS_BC11" class="form-control"  value="{{ $detail->NO_POS_BC11 }}" required>
                        </div>
                    </div>
                    
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kode Timbun</label>
                        <div class="col-sm-8">
                            <input type="text" name="KD_TIMBUN" class="form-control"  value="{{ $detail->KD_TIMBUN }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kode DOK. INOUT</label>
                        <div class="col-sm-8">
                            <input type="text" name="KD_DOK_INOUT" class="form-control"  value="{{ $detail->KD_DOK_INOUT }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. DOK. INOUT</label>
                        <div class="col-sm-8">
                            <input type="text" name="NO_DOK_INOUT" class="form-control"  value="{{ $detail->NO_DOK_INOUT }}" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. DOK. INOUT</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="TGL_DOK_INOUT" class="form-control pull-right datepicker" required value="{{ $detail->TGL_DOK_INOUT }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Waktu DOK.INOUT</label>
                        <div class="col-sm-8">
                            <input type="text" name="WK_INOUT" class="form-control"  value="{{ $detail->WK_INOUT }}" required>
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kode SAR Angkut INOUT</label>
                        <div class="col-sm-8">
                            <input type="text" name="KD_SAR_ANGKUT_INOUT" class="form-control"  value="{{ $detail->KD_SAR_ANGKUT_INOUT }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. POL</label>
                        <div class="col-sm-8">
                            <input type="text" name="NO_POL" class="form-control"  value="{{ $detail->NO_POL }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">FL CONT</label>
                        <div class="col-sm-8">
                            <input type="text" name="FL_CONT_KOSONG" class="form-control"  value="{{ $detail->FL_CONT_KOSONG }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">ISO Code</label>
                        <div class="col-sm-8">
                            <input type="text" name="ISO_CODE" class="form-control"  value="{{ $detail->ISO_CODE }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Pel. Muat</label>
                        <div class="col-sm-8">
                            <input type="text" name="PEL_MUAT" class="form-control"  value="{{ $detail->PEL_MUAT }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Pel. Transit</label>
                        <div class="col-sm-8">
                            <input type="text" name="PEL_TRANSIT" class="form-control"  value="{{ $detail->PEL_TRANSIT }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Pel. Bongkar</label>
                        <div class="col-sm-8">
                            <input type="text" name="PEL_BONGKAR" class="form-control"  value="{{ $detail->PEL_BONGKAR }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Gudang Tujuan</label>
                        <div class="col-sm-8">
                            <input type="text" name="GUDANG_TUJUAN" class="form-control"  value="{{ $detail->GUDANG_TUJUAN }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kode Kantor</label>
                        <div class="col-sm-8">
                            <input type="text" name="KODE_KANTOR" class="form-control"  value="{{ $detail->KODE_KANTOR }}" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. Daftar Pabean</label>
                        <div class="col-sm-8">
                            <input type="text" name="NO_DAFTAR_PABEAN" class="form-control"  value="{{ $detail->NO_DAFTAR_PABEAN }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. Daftar Pabean</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="TGL_DAFTAR_PABEAN" class="form-control pull-right datepicker" required value="{{ $detail->TGL_DAFTAR_PABEAN }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. Segel BC</label>
                        <div class="col-sm-8">
                            <input type="text" name="NO_SEGEL_BC" class="form-control"  value="{{ $detail->NO_SEGEL_BC }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. Segel BC</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="TGL_SEGEL_BC" class="form-control pull-right datepicker" required value="{{ $detail->TGL_SEGEL_BC }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. Ijin TPS</label>
                        <div class="col-sm-8">
                            <input type="text" name="NO_IJIN_TPS" class="form-control"  value="{{ $detail->NO_IJIN_TPS }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. Ijin TPS</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="TGL_IJIN_TPS" class="form-control pull-right datepicker" required value="{{ $detail->TGL_IJIN_TPS }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-success pull-right" style="margin-right: 10px;"><i class="fa fa-save"></i> Simpan</button>
            <a href="{{ route('tps-coariCont-index') }}" class="btn btn-danger pull-right" style="margin-right: 10px;"><i class="fa fa-close"></i> Keluar</a>
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
        format: 'yyyymmdd' 
    });
    
    $("#resend-btn").on("click", function(e){
        if(!confirm('Apakah anda yakin?')){return false;}
    });
    
</script>

@endsection