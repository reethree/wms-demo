@extends('layout')

@section('content')

@include('partials.form-alert')

<div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Edit TPS SPPB PIB</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <!-- /.box-header -->
    <form class="form-horizontal" action="{{ route('tps-sppbPib-update', $sppb->TPS_SPPBXML_PK) }}" method="POST">
        <div class="box-body">            
            <div class="row">
                <div class="col-md-6">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">CAR</label>
                        <div class="col-sm-8">
                            <input type="text" name="CAR" class="form-control"  value="{{ $sppb->CAR }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. SPPB</label>
                        <div class="col-sm-8">
                            <input type="text" name="NO_SPPB" class="form-control"  value="{{ $sppb->NO_SPPB }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. SPPB</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="TGL_SPPB" class="form-control pull-right datepicker" required value="{{ date('Y-m-d',strtotime($sppb->TGL_SPPB)) }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. SPK</label>
                        <div class="col-sm-8">
                            <input type="text" name="NOJOBORDER" class="form-control"  value="{{ $sppb->NOJOBORDER }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kode KPBC</label>
                        <div class="col-sm-8">
                            <input type="text" name="KD_KPBC" class="form-control"  value="{{ $sppb->KD_KPBC }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. PIB</label>
                        <div class="col-sm-8">
                            <input type="text" name="NO_PIB" class="form-control"  value="{{ $sppb->NO_PIB }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. PIB</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="TGL_PIB" class="form-control pull-right datepicker" required value="{{ date('Y-m-d',strtotime($sppb->TGL_PIB)) }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nama Importir</label>
                        <div class="col-sm-8">
                            <input type="text" name="NAMA_IMP" class="form-control"  value="{{ $sppb->NAMA_IMP }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">NPWP Importir</label>
                        <div class="col-sm-8">
                            <input type="text" name="NPWP_IMP" class="form-control"  value="{{ $sppb->NPWP_IMP }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Alamat Importir</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="ALAMAT_IMP" rows="3">{{ $sppb->ALAMAT_IMP }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nama PPJK</label>
                        <div class="col-sm-8">
                            <input type="text" name="NAMA_PPJK" class="form-control"  value="{{ $sppb->NAMA_PPJK }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">NPWP PPJK</label>
                        <div class="col-sm-8">
                            <input type="text" name="NPWP_PPJK" class="form-control"  value="{{ $sppb->NPWP_PPJK }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Alamat PPJK</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="ALAMAT_PPJK" rows="3">{{ $sppb->ALAMAT_PPJK }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nama Angkut</label>
                        <div class="col-sm-8">
                            <input type="text" name="NM_ANGKUT" class="form-control"  value="{{ $sppb->NM_ANGKUT }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. VOY Flight</label>
                        <div class="col-sm-8">
                            <input type="text" name="NO_VOY_FLIGHT" class="form-control"  value="{{ $sppb->NO_VOY_FLIGHT }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Bruto</label>
                        <div class="col-sm-8">
                            <input type="text" name="BRUTO" class="form-control"  value="{{ $sppb->BRUTO }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Netto</label>
                        <div class="col-sm-8">
                            <input type="text" name="NETTO" class="form-control"  value="{{ $sppb->NETTO }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Gudang</label>
                        <div class="col-sm-8">
                            <input type="text" name="GUDANG" class="form-control"  value="{{ $sppb->GUDANG }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Status Jalur</label>
                        <div class="col-sm-8">
                            <input type="text" name="STATUS_JALUR" class="form-control"  value="{{ $sppb->STATUS_JALUR }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Jml.Container</label>
                        <div class="col-sm-8">
                            <input type="text" name="JML_CONT" class="form-control"  value="{{ $sppb->JML_CONT }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. BC11</label>
                        <div class="col-sm-8">
                            <input type="text" name="NO_BC11" class="form-control"  value="{{ $sppb->NO_BC11 }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. BC11</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="TGL_BC11" class="form-control pull-right datepicker" required value="{{ date('Y-m-d',strtotime($sppb->TGL_BC11)) }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. POS BC11</label>
                        <div class="col-sm-8">
                            <input type="text" name="NO_POS_BC11" class="form-control"  value="{{ $sppb->NO_POS_BC11 }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. BL AWB</label>
                        <div class="col-sm-8">
                            <input type="text" name="NO_BL_AWB" class="form-control"  value="{{ $sppb->NO_BL_AWB }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. BL AWB</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="TGL_BL_AWB" class="form-control pull-right datepicker" required value="{{ date('Y-m-d',strtotime($sppb->TGL_BL_AWB)) }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. MBL AWB</label>
                        <div class="col-sm-8">
                            <input type="text" name="NO_MASTER_BL_AWB" class="form-control"  value="{{ $sppb->NO_MASTER_BL_AWB }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. MBL AWB</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="TGL_MASTER_BL_AWB" class="form-control pull-right datepicker" required value="{{ date('Y-m-d',strtotime($sppb->TGL_MASTER_BL_AWB)) }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Simpan</button>
            <a href="{{ route('tps-sppbPib-index') }}" class="btn btn-danger pull-right" style="margin-right: 10px;"><i class="fa fa-close"></i> Keluar</a>
        </div>
        <!-- /.box-footer -->
    </form>
</div>

<div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Lists Container</h3>
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
                        GridRender::setGridId("tpsSppbPibContGrid")
                        ->enableFilterToolbar()
                        ->setGridOption('mtype', 'POST')
                        ->setGridOption('url', URL::to('/tpsonline/penerimaan/sppb-pib/grid-data?type=cont&sppbid='.$sppb->TPS_SPPBXML_PK.'&_token='.csrf_token()))
                        ->setGridOption('rowNum', 10)
                        ->setGridOption('shrinkToFit', true)
                        ->setGridOption('sortname','TPS_SPPBCONTXML_PK')
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
                        ->addColumn(array('key'=>true,'index'=>'TPS_SPPBCONTXML_PK','hidden'=>true))
                        ->addColumn(array('label'=>'No. Container','index'=>'NO_CONT','width'=>300,'editable' => true, 'editrules' => array('' => true)))
                        ->addColumn(array('label'=>'Ukuran','index'=>'SIZE', 'width'=>250,'align'=>'center','editable' => true, 'editrules' => array('' => true,'number'=>true),'edittype'=>'select','editoptions'=>array('value'=>"20:20;40:40")))
                        ->addColumn(array('label'=>'Jenis','index'=>'JNS_MUAT', 'width'=>250,'editable' => true, 'align'=>'right'))
                        ->renderGrid()
                    }}
                </div>
            </div>               
        </div>
    </div>
</div>

<div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Lists Kemasan</h3>
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
                        GridRender::setGridId("tpstpsSppbPibKmsGrid")
                        ->enableFilterToolbar()
                        ->setGridOption('mtype', 'POST')
                        ->setGridOption('url', URL::to('/tpsonline/penerimaan/sppb-pib/grid-data?type=kms&sppbid='.$sppb->TPS_SPPBXML_PK.'&_token='.csrf_token()))
                        ->setGridOption('rowNum', 10)
                        ->setGridOption('shrinkToFit', true)
                        ->setGridOption('sortname','TPS_SPPBKMSXML_PK')
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
                        ->addColumn(array('key'=>true,'index'=>'TPS_SPPBKMSXML_PK','hidden'=>true))
                        ->addColumn(array('label'=>'Jenis KMS','index'=>'JNS_KMS','width'=>250,'editable' => true, 'editrules' => array('' => true)))
                        ->addColumn(array('label'=>'Merk KMS','index'=>'MERK_KMS', 'width'=>250,'align'=>'center','editable' => true))
                        ->addColumn(array('label'=>'Jumlah KMS','index'=>'JML_KMS', 'width'=>250,'editable' => true, 'align'=>'center'))
                        ->renderGrid()
                    }}
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

</script>

@endsection