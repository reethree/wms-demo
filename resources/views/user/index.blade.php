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
            del = '<a href="{{ route("user-delete",'') }}/'+cl+'" onclick="if (confirm(\'Are You Sure ?\')){return true; }else{return false; };"><i class="fa fa-close"></i></a>';
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
                ->setGridOption('rowNum', 20)
                ->setGridOption('shrinkToFit', false)
                ->setGridOption('sortname','users.id')
                ->setGridOption('rownumbers', true)
                ->setGridOption('height', 295)
                ->setGridOption('rowList',array(20,50,100))
                ->setGridOption('useColSpanStyle', true)
                ->setNavigatorOptions('navigator', array('viewtext'=>'view'))
                ->setNavigatorOptions('view',array('closeOnEscape'=>false))
                ->setFilterToolbarOptions(array('autosearch'=>true))
                ->setGridEvent('gridComplete', 'gridCompleteEvent')
//                  ->setNavigatorEvent('view', 'beforeShowForm', 'function(){}')
//                  ->setFilterToolbarEvent('beforeSearch', 'function(){}')
                ->addColumn(array('key'=>true,'index'=>'id', 'hidden'=>true))
                ->addColumn(array('label'=>'Name','index'=>'name','width'=>150))
                ->addColumn(array('label'=>'Username','index'=>'username', 'width'=>150))
                ->addColumn(array('label'=>'Email','index'=>'email', 'width'=>180))
                ->addColumn(array('label'=>'Roles','index'=>'roles.name', 'width'=>150, 'align'=>'center'))
                ->addColumn(array('label'=>'Status','index'=>'status', 'width'=>80, 'align'=>'center'))
                ->addColumn(array('label'=>'Created','index'=>'created_at', 'width'=>140, 'search'=>false,'align'=>'center'))
                ->addColumn(array('label'=>'Updated','index'=>'updated_at', 'width'=>140, 'search'=>false,'align'=>'center'))
                ->addColumn(array('label'=>'Action','index'=>'action', 'width'=>80, 'search'=>false, 'sortable'=>false, 'align'=>'center'))
                ->renderGrid()
            }}
    </div>
    
    
</div>
    
@endsection