@extends('layout')

@section('content')

<script>
    function gridCompleteEvent()
    {
        var ids = jQuery("#lokasisandarGrid").jqGrid('getDataIDs'),
            edt = '',
            del = ''; 
        for(var i=0;i < ids.length;i++){ 
            var cl = ids[i];

            edt = '<a href="{{ route("lokasisandar-edit",'') }}/'+cl+'"><i class="fa fa-pencil"></i></a> ';
            del = '<a href="{{ route("lokasisandar-delete",'') }}/'+cl+'" onclick="if (confirm(\'Are You Sure ?\')){return true; }else{return false; };"><i class="fa fa-close"></i></a>';
            jQuery("#lokasisandarGrid").jqGrid('setRowData',ids[i],{action:edt+' '+del}); 
        } 
    }
</script>

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Lokasi Sandar</h3>
<!--        <div class="box-tools">
            <a href="{{ route('lokasisandar-create') }}" type="button" class="btn btn-block btn-info btn-sm"><i class="fa fa-plus"></i> Add New</a>
        </div>-->
    </div>
    <div class="box-body table-responsive">
            {{
                GridRender::setGridId("lokasisandarGrid")
                ->enableFilterToolbar()
                ->setGridOption('url', URL::to('/lokasisandar/grid-data'))
                ->setGridOption('editurl',URL::to('/lokasisandar/crud'))
                ->setGridOption('rowNum', 20)
                ->setGridOption('shrinkToFit', true)
                ->setGridOption('sortname','TLOKASISANDAR_PK')
                ->setGridOption('rownumbers', true)
                ->setGridOption('height', '295')
                ->setGridOption('rowList',array(20,50,100))
                ->setGridOption('emptyrecords','Nothing to display')
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
                ->setGridEvent('gridComplete', 'gridCompleteEvent')
//                  ->setNavigatorEvent('view', 'beforeShowForm', 'function(){}')
//                  ->setFilterToolbarEvent('beforeSearch', 'function(){}')
                ->addColumn(array('key'=>true,'index'=>'TLOKASISANDAR_PK','hidden'=>true))
                ->addColumn(array('label'=>'Nama Lokasi Sandar','index'=>'NAMALOKASISANDAR','width'=>320,'editable' => true,'editrules'=>array('required'=>true)))
                ->addColumn(array('label'=>'KD TPS Asal','index'=>'KD_TPS_ASAL','width'=>150,'editable' => true,'editrules'=>array('required'=>true)))
                ->addColumn(array('label'=>'Jabatan','index'=>'JABATANPERMOHONAN','hidden'=>true,'viewable'=>true,'editable' => true,'editrules'=>array('edithidden'=>true) ))
                ->addColumn(array('label'=>'Perusahaan','index'=>'PERUSAHAANPERMOHONAN','hidden'=>true,'viewable'=>true,'editable' => true,'editrules'=>array('edithidden'=>true) ))
                ->addColumn(array('label'=>'Pelabuhan','index'=>'PELABUHANPERMOHONAN','hidden'=>true,'viewable'=>true,'editable' => true,'editrules'=>array('edithidden'=>true) ))
                ->addColumn(array('label'=>'Kota','index'=>'KOTAPERMOHONAN','hidden'=>true,'viewable'=>true,'editable' => true,'editrules'=>array('edithidden'=>true) ))
                ->addColumn(array('label'=>'Negara','index'=>'NEGARAPERMOHONAN','hidden'=>true,'viewable'=>true,'editable' => true,'editrules'=>array('edithidden'=>true) ))
                ->addColumn(array('label'=>'UID','index'=>'UID', 'width'=>150))
                ->addColumn(array('label'=>'Updated','index'=>'last_update', 'width'=>150, 'search'=>false))
//                ->addColumn(array('label'=>'Action','index'=>'action', 'width'=>80, 'search'=>false, 'sortable'=>false, 'align'=>'center'))
                ->renderGrid()
            }}
    </div>
    
    
</div>
    
@endsection