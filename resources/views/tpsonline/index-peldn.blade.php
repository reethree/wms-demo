@extends('layout')

@section('content')

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Pelabuhan DN</h3>
<!--        <div class="box-tools">
            <a href="{{ route('consolidator-create') }}" type="button" class="btn btn-block btn-info btn-sm"><i class="fa fa-plus"></i> Add New</a>
        </div>-->
    </div>
    <div class="box-body table-responsive">
            {{
                GridRender::setGridId("tpsPelDnGrid")
                ->enableFilterToolbar()
                ->setGridOption('url', URL::to('/tpsonline/pelabuhandn/grid-data'))
                ->setGridOption('editurl',URL::to('/tpsonline/pelabuhandn/crud'))
                ->setGridOption('rowNum', 20)
                ->setGridOption('shrinkToFit', true)
                ->setGridOption('sortname','TPSPELDNXML_PK')
                ->setGridOption('rownumbers', true)
                ->setGridOption('height', '295')
                ->setGridOption('rowList',array(20,50,100))
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
                ->addColumn(array('key'=>true,'index'=>'TPSPELDNXML_PK','hidden'=>true))
                ->addColumn(array('label'=>'Kode Pelabuhan','index'=>'KODE_PELABUHAN', 'width'=>300, 'align'=>'center', 'editable' => true, 'editrules' => array('required' => true)))
                ->addColumn(array('label'=>'Nama Pelabuhan','index'=>'NAMA_PELABUHAN', 'width'=>400, 'editable' => true, 'editrules' => array('required' => true)))
                ->renderGrid()
            }}
    </div>
  
</div>

@endsection