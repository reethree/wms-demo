@extends('layout')

@section('content')

<script>
    function gridCompleteEvent()
    {
        var ids = jQuery("#userGrid").jqGrid('getDataIDs'),
            edt = '',
            del = ''; 
        for(var i=0;i < ids.length;i++){ 
            var cl = ids[i];
            edt = '<a href="{{ route("user-edit",'') }}/'+cl+'"><i class="fa fa-pencil"></i></a> ';
            del = '<a href="{{ route("user-delete",'') }}/'+cl+'"><i class="fa fa-close"></i></a>';
            jQuery("#userGrid").jqGrid('setRowData',ids[i],{action:edt+' '+del}); 
        } 
    }
</script>

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">User Lists</h3>
        <div class="box-tools">
            <a href="{{ route('user-create') }}" type="button" class="btn btn-block btn-info btn-sm"><i class="fa fa-plus"></i> Add New</a>
        </div>
    </div>
    <div class="box-body table-responsive">
            {{
                GridRender::setGridId("userGrid")
                ->enableFilterToolbar()
                ->setGridOption('url', URL::to('/users/grid-data'))
                ->setGridOption('rowNum', 10)
                ->setGridOption('shrinkToFit', false)
                ->setGridOption('sortname','id')
                ->setGridOption('rownumbers', true)
                ->setGridOption('height', 225)
                ->setGridOption('rowList',array(10,30,50,100))
                ->setGridOption('useColSpanStyle', true)
                ->setNavigatorOptions('navigator', array('viewtext'=>'view'))
                ->setNavigatorOptions('view',array('closeOnEscape'=>false))
                ->setFilterToolbarOptions(array('autosearch'=>true))
                ->setGridEvent('gridComplete', 'gridCompleteEvent')
//                  ->setNavigatorEvent('view', 'beforeShowForm', 'function(){}')
//                  ->setFilterToolbarEvent('beforeSearch', 'function(){}')
                ->addColumn(array('index'=>'id', 'width'=>60, 'align'=>'center'))
                ->addColumn(array('label'=>'Name','index'=>'name','width'=>150))
                ->addColumn(array('label'=>'Username','index'=>'username', 'width'=>150))
                ->addColumn(array('label'=>'Email','index'=>'email', 'width'=>180))
                ->addColumn(array('label'=>'Roles','index'=>'role', 'width'=>150))
                ->addColumn(array('label'=>'Created','index'=>'created_at', 'width'=>150, 'search'=>false))
                ->addColumn(array('label'=>'Updated','index'=>'updated_at', 'width'=>150, 'search'=>false))
                ->addColumn(array('label'=>'Action','index'=>'action', 'width'=>80, 'search'=>false, 'sortable'=>false, 'align'=>'center'))
                ->renderGrid()
            }}
    </div>
    
    
</div>
    
@endsection