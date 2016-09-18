@extends('layout')

@section('content')

<script>
 
    function gridCompleteEvent()
    {
        var ids = jQuery("#consolidatorGrid").jqGrid('getDataIDs'),
            edt = '',
            del = ''; 
        for(var i=0;i < ids.length;i++){ 
            var cl = ids[i];
            
            edt = '<a href="{{ route("consolidator-edit",'') }}/'+cl+'"><i class="fa fa-pencil"></i></a> ';
            del = '<a href="{{ route("consolidator-delete",'') }}/'+cl+'" onclick="if (confirm(\'Are You Sure ?\')){return true; }else{return false; };"><i class="fa fa-close"></i></a>';
            jQuery("#consolidatorGrid").jqGrid('setRowData',ids[i],{action:edt+' '+del}); 
        } 
    }
    
</script>

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Consolidator</h3>
<!--        <div class="box-tools">
            <a href="{{ route('consolidator-create') }}" type="button" class="btn btn-block btn-info btn-sm"><i class="fa fa-plus"></i> Add New</a>
        </div>-->
    </div>
    <div class="box-body table-responsive">
            {{
                GridRender::setGridId("consolidatorGrid")
                ->enableFilterToolbar()
                ->setGridOption('url', URL::to('/consolidator/grid-data'))
                ->setGridOption('editurl',URL::to('/consolidator/crud'))
                ->setGridOption('rowNum', 20)
                ->setGridOption('shrinkToFit', true)
                ->setGridOption('sortname','TCONSOLIDATOR_PK')
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
                ->setGridEvent('gridComplete', 'gridCompleteEvent')
//                ->setGridEvent('onSelectRow', 'selectRowEvent')
                ->addColumn(array('key'=>true,'index'=>'TCONSOLIDATOR_PK','hidden'=>true))
                ->addColumn(array('label'=>'Nama','index'=>'NAMACONSOLIDATOR','width'=>320,'editable' => true, 'editrules' => array('required' => true)))
                ->addColumn(array('label'=>'NPWP','index'=>'NPWP', 'width'=>150,'editable' => true, 'editrules' => array('required' => true,'number'=>true)))
                ->addColumn(array('label'=>'Alamat','index'=>'ALAMAT','hidden'=>true,'viewable'=>true,'editrules'=>array('edithidden'=>true),'editable' => true, 'edittype' => 'textarea' ))
                ->addColumn(array('label'=>'Telp','index'=>'NOTELP', 'width'=>120, 'align'=>'right','editable' => true, 'editrules' => array('number'=>true)))
                ->addColumn(array('label'=>'Contact Person','index'=>'CONTACTPERSON', 'width'=>180,'editable' => true))
                ->addColumn(array('label'=>'Updated','index'=>'last_update', 'width'=>150, 'search'=>false))
//                ->addColumn(array('label'=>'Action','index'=>'action', 'width'=>80, 'search'=>false, 'sortable'=>false, 'align'=>'center'))
                ->renderGrid()
            }}
    </div>
    
    
</div>
    
@endsection