@extends('layout')

@section('content')

<script>
    function gridCompleteEvent()
    {
        var ids = jQuery("#depomtyGrid").jqGrid('getDataIDs'),
            edt = '',
            del = ''; 
        for(var i=0;i < ids.length;i++){ 
            var cl = ids[i];
            var rowdata = $('#depomtyGrid').getRowData(cl);
            var dataid = rowdata.TDEPOMTY_PK;
            
            edt = '<a href="{{ route("depomty-edit",'') }}/'+dataid+'"><i class="fa fa-pencil"></i></a> ';
            del = '<a href="{{ route("depomty-delete",'') }}/'+dataid+'"><i class="fa fa-close"></i></a>';
            jQuery("#depomtyGrid").jqGrid('setRowData',ids[i],{action:edt+' '+del}); 
        } 
    }
</script>

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Depo MTY</h3>
        <div class="box-tools">
            <a href="{{ route('depomty-create') }}" type="button" class="btn btn-block btn-info btn-sm"><i class="fa fa-plus"></i> Add New</a>
        </div>
    </div>
    <div class="box-body table-responsive">
            {{
                GridRender::setGridId("depomtyGrid")
                ->enableFilterToolbar()
                ->setGridOption('url', URL::to('/depomty/grid-data'))
                ->setGridOption('rowNum', 20)
                ->setGridOption('shrinkToFit', false)
                ->setGridOption('sortname','TDEPOMTY_PK')
                ->setGridOption('rownumbers', true)
                ->setGridOption('height', 'auto')
                ->setGridOption('rowList',array(20,50,100))
                ->setGridOption('useColSpanStyle', true)
                ->setNavigatorOptions('navigator', array('viewtext'=>'view'))
                ->setNavigatorOptions('view',array('closeOnEscape'=>false))
                ->setFilterToolbarOptions(array('autosearch'=>true))
                ->setGridEvent('gridComplete', 'gridCompleteEvent')
//                  ->setNavigatorEvent('view', 'beforeShowForm', 'function(){}')
//                  ->setFilterToolbarEvent('beforeSearch', 'function(){}')
                ->addColumn(array('index'=>'TDEPOMTY_PK', 'hidden'=>true))
                ->addColumn(array('label'=>'Nama Depo MTY','index'=>'NAMADEPOMTY','width'=>320))
                ->addColumn(array('label'=>'UID','index'=>'UID', 'width'=>150))
                ->addColumn(array('label'=>'Updated','index'=>'last_update', 'width'=>150, 'search'=>false))
                ->addColumn(array('label'=>'Action','index'=>'action', 'width'=>80, 'search'=>false, 'sortable'=>false, 'align'=>'center'))
                ->renderGrid()
            }}
    </div>
    
    
</div>
    
@endsection