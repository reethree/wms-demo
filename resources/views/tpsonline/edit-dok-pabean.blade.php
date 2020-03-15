@extends('layout')

@section('content')

@include('partials.form-alert')

<div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Edit TPS DOKUMEN PABEAN</h3>
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
                        <label class="col-sm-3 control-label">Kode Kantor</label>
                        <div class="col-sm-8">
                            <input type="text" name="KD_KANTOR" class="form-control"  value="{{ $dokpabean->KD_KANTOR }}" required readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kode Dokuman</label>
                        <div class="col-sm-8">
                            <input type="text" name="KD_DOK_INOUT" class="form-control"  value="{{ $dokpabean->KD_DOK_INOUT }}" required readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. Dokuman</label>
                        <div class="col-sm-8">
                            <input type="text" name="NO_DOK_INOUT" class="form-control"  value="{{ $dokpabean->NO_DOK_INOUT }}" required readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. Dokumen</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="TGL_DOK_INOUT" class="form-control pull-right" required value="{{ $dokpabean->TGL_DOK_INOUT }}" readonly="readonly">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. Daftar</label>
                        <div class="col-sm-8">
                            <input type="text" name="NO_DOK_INOUT" class="form-control"  value="{{ $dokpabean->NO_DAFTAR }}" required readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. Daftar</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="TGL_DOK_INOUT" class="form-control pull-right" required value="{{ $dokpabean->TGL_DAFTAR }}" readonly="readonly">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nama PPJK</label>
                        <div class="col-sm-8">
                            <input type="text" name="NM_PPJK" class="form-control"  value="{{ $dokpabean->NM_PPJK }}" required readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">NPWP PPJK</label>
                        <div class="col-sm-8">
                            <input type="text" name="NPWP_PPJK" class="form-control"  value="{{ $dokpabean->NPWP_PPJK }}" required readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">FL Segel</label>
                        <div class="col-sm-8">
                            <input type="text" name="FL_SEGEL" class="form-control"  value="{{ $dokpabean->FL_SEGEL }}" required readonly="readonly">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">               
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nama IMP</label>
                        <div class="col-sm-8">
                            <input type="text" name="NM_IMP" class="form-control"  value="{{ $dokpabean->NM_IMP }}" required readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">NPWP IMP</label>
                        <div class="col-sm-8">
                            <input type="text" name="NPWP_IMP" class="form-control"  value="{{ $dokpabean->NPWP_IMP }}" required readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nama Angkut</label>
                        <div class="col-sm-8">
                            <input type="text" name="NM_ANGKUT" class="form-control"  value="{{ $dokpabean->NM_ANGKUT }}" required readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. VOY Flight</label>
                        <div class="col-sm-8">
                            <input type="text" name="NO_VOY_FLIGHT" class="form-control"  value="{{ $dokpabean->NO_VOY_FLIGHT }}" required readonly="readonly">
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Gudang</label>
                        <div class="col-sm-8">
                            <input type="text" name="GUDANG" class="form-control"  value="{{ $dokpabean->GUDANG }}" required readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Jumlah CONT</label>
                        <div class="col-sm-8">
                            <input type="text" name="JML_CONT" class="form-control"  value="{{ $dokpabean->JML_CONT }}" required readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. BC11</label>
                        <div class="col-sm-8">
                            <input type="text" name="NO_BC11" class="form-control"  value="{{ $dokpabean->NO_BC11 }}" required readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. BC11</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="TGL_BC11" class="form-control pull-right" required value="{{ $dokpabean->TGL_BC11 }}" readonly="readonly">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. POS BC11</label>
                        <div class="col-sm-8">
                            <input type="text" name="NO_POS_BC11" class="form-control"  value="{{ $dokpabean->NO_POS_BC11 }}" required readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. BL AWB</label>
                        <div class="col-sm-8">
                            <input type="text" name="NO_BL_AWB" class="form-control"  value="{{ $dokpabean->NO_BL_AWB }}" required readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. BL AWB</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="TGL_BL_AWB" class="form-control pull-right" required value="{{ $dokpabean->TGL_BL_AWB }}" readonly="readonly">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
<!--        <div class="box-footer">
            <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Simpan</button>
            <a href="#" class="btn btn-danger pull-right" style="margin-right: 10px;"><i class="fa fa-close"></i> Keluar</a>
        </div>-->
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
                        GridRender::setGridId("tpsDokPabeanContGrid")
                        ->enableFilterToolbar()
                        ->setGridOption('mtype', 'POST')
                        ->setGridOption('url', URL::to('/tpsonline/penerimaan/dok-pabean/grid-data?type=cont&dokid='.$dokpabean->TPS_DOKPABEANXML_PK.'&_token='.csrf_token()))
                        ->setGridOption('rowNum', 50)
                        ->setGridOption('shrinkToFit', true)
                        ->setGridOption('sortname','TPS_DOKPABEANCONTXML_PK')
                        ->setGridOption('rownumbers', true)
                        ->setGridOption('height', '150')
                        ->setGridOption('rowList',array(50,100,200))
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
                        ->addColumn(array('key'=>true,'index'=>'TPS_SPJMCONTXML_PK','hidden'=>true))
//                        ->addColumn(array('label'=>'ID','index'=>'ID', 'width'=>250,'editable' => true, 'align'=>'center'))
                        ->addColumn(array('label'=>'No. Container','index'=>'NO_CONT','width'=>250,'editable' => true,'align'=>'center', 'editrules' => array('' => true)))
                        ->addColumn(array('label'=>'Ukuran','index'=>'SIZE', 'width'=>250,'align'=>'center','editable' => true,'align'=>'center', 'editrules' => array('' => true,'number'=>true),'edittype'=>'select','editoptions'=>array('value'=>"20:20;40:40")))
                        ->addColumn(array('label'=>'Jenis','index'=>'JNS_MUAT', 'width'=>250,'editable' => true, 'align'=>'center'))
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
                        GridRender::setGridId("tpsDokPabeanKmsGrid")
                        ->enableFilterToolbar()
                        ->setGridOption('mtype', 'POST')
                        ->setGridOption('url', URL::to('/tpsonline/penerimaan/dok-pabean/grid-data?type=kms&dokid='.$dokpabean->TPS_DOKPABEANXML_PK.'&_token='.csrf_token()))
                        ->setGridOption('rowNum', 50)
                        ->setGridOption('shrinkToFit', true)
                        ->setGridOption('sortname','TPS_DOKPABEANKMSXML_PK')
                        ->setGridOption('rownumbers', true)
                        ->setGridOption('height', '150')
                        ->setGridOption('rowList',array(50,100,200))
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
                        ->addColumn(array('label'=>'Jenis KMS','index'=>'JNS_KMS','width'=>250,'editable' => true,'align'=>'center', 'editrules' => array('' => true)))
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