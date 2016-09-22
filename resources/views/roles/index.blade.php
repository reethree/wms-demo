@extends('layout')

@section('content')

<script>
    
    function gridCompleteEvent()
    {
        var ids = jQuery("#userRoleGrid").jqGrid('getDataIDs'),
            edt = '';
        for(var i=0;i < ids.length;i++){ 
            var cl = ids[i];
            
            edt = '<a href="{{ route("role-edit",'') }}/'+cl+'" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Edit Permission</a> ';
            jQuery("#userRoleGrid").jqGrid('setRowData',ids[i],{action:edt}); 
        } 
    }
</script>

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">User Roles</h3>
    </div>
    <div class="box-body table-responsive">
            {{
                GridRender::setGridId("userRoleGrid")
                ->enableFilterToolbar()
                ->setGridOption('url', URL::to('/roles/grid-data'))
                ->setGridOption('editurl',URL::to('/roles/crud'))
                ->setGridOption('rowNum', 20)
                ->setGridOption('shrinkToFit', false)
                ->setGridOption('sortname','id')
                ->setGridOption('rownumbers', true)
                ->setGridOption('height', 295)
                ->setGridOption('rowList',array(20,50,100))
                ->setGridOption('useColSpanStyle', true)
                ->setNavigatorOptions('navigator', array('add' => true, 'edit' => true, 'del' => true, 'view' => false, 'refresh' => false))
                ->setNavigatorOptions('add', array('closeAfterAdd' => true))
                ->setNavigatorEvent('add', 'afterSubmit', 'afterSubmitEvent')
                ->setNavigatorOptions('edit', array('closeAfterEdit' => true))
                ->setNavigatorEvent('edit', 'afterSubmit', 'afterSubmitEvent')
                ->setNavigatorEvent('del', 'afterSubmit', 'afterSubmitEvent')
                ->setNavigatorOptions('view',array('closeOnEscape'=>false))
                ->setGridEvent('gridComplete', 'gridCompleteEvent')
                ->setFilterToolbarOptions(array('autosearch'=>true))
                ->addColumn(array('key'=>true,'index'=>'id', 'hidden'=>true))
                ->addColumn(array('label'=>'Name','index'=>'name','width'=>150,'editable' => true, 'editrules' => array('required' => true)))
                ->addColumn(array('label'=>'Description','index'=>'description', 'width'=>250, 'editable' => true, 'edittype' => 'textarea'))
                ->addColumn(array('label'=>'Special','index'=>'special', 'width'=>80, 'align'=>'center','editable' => true, 'editoptions' => array('value' => 'none:None;all-access:All Access;no-access:No Access'), 'edittype' => 'select', 'formatter' => 'select', 'editrules' => array('required' => true)))
                ->addColumn(array('label'=>'Created','index'=>'created_at', 'width'=>140, 'search'=>false,'align'=>'center','editable' => false))
                ->addColumn(array('label'=>'Updated','index'=>'updated_at', 'width'=>140, 'search'=>false,'align'=>'center','editable' => false))
                ->addColumn(array('label'=>'Action','index'=>'action', 'width'=>150, 'search'=>false, 'sortable'=>false, 'align'=>'center'))
                ->renderGrid()
            }}
    </div>
    
    
</div>
    
@endsection