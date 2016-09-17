@extends('layout')

@section('content')

<script>
    function gridCompleteEvent()
    {
        var ids = jQuery("#packingGrid").jqGrid('getDataIDs'),
            edt = '',
            del = ''; 
        for(var i=0;i < ids.length;i++){ 
            var cl = ids[i];
            var rowdata = $('#packingGrid').getRowData(cl);
            var dataid = rowdata.TPACKING_PK;

            edt = '<a href="{{ route("packing-edit",'') }}/'+dataid+'"><i class="fa fa-pencil"></i></a> ';
            del = '<a href="{{ route("packing-delete",'') }}/'+dataid+'"><i class="fa fa-close"></i></a>';
            jQuery("#packingGrid").jqGrid('setRowData',ids[i],{action:edt+' '+del}); 
        } 
    }
</script>

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Packing</h3>
        <div class="box-tools">
            <a href="{{ route('packing-create') }}" type="button" class="btn btn-block btn-info btn-sm"><i class="fa fa-plus"></i> Add New</a>
        </div>
    </div>
    <div class="box-body table-responsive">
            {{
                GridRender::setGridId("packingGrid")
                ->enableFilterToolbar()
                ->setGridOption('url', URL::to('/packing/grid-data'))
                ->setGridOption('rowNum', 20)
                ->setGridOption('shrinkToFit', true)
                ->setGridOption('sortname','TPACKING_PK')
                ->setGridOption('rownumbers', true)
                ->setGridOption('height', '295')
                ->setGridOption('rowList',array(20,50,100))
                ->setGridOption('emptyrecords','Nothing to display')
                ->setGridOption('useColSpanStyle', true)
                ->setNavigatorOptions('navigator', array('viewtext'=>'view'))
                ->setNavigatorOptions('view',array('closeOnEscape'=>false))
                ->setFilterToolbarOptions(array('autosearch'=>true))
                ->setGridEvent('gridComplete', 'gridCompleteEvent')
//                  ->setNavigatorEvent('view', 'beforeShowForm', 'function(){}')
//                  ->setFilterToolbarEvent('beforeSearch', 'function(){}')
                ->addColumn(array('index'=>'TPACKING_PK','hidden'=>true))
                ->addColumn(array('label'=>'Nama Packing','index'=>'NAMAPACKING','width'=>320))
                ->addColumn(array('label'=>'Kode','index'=>'KODEPACKING','width'=>150, 'align'=>'center'))
                ->addColumn(array('label'=>'UID','index'=>'UID', 'width'=>150))
                ->addColumn(array('label'=>'Updated','index'=>'last_update', 'width'=>150, 'search'=>false))
                ->addColumn(array('label'=>'Action','index'=>'action', 'width'=>80, 'search'=>false, 'sortable'=>false, 'align'=>'center'))
                ->renderGrid()
            }}
    </div>
    
    
</div>
    
@endsection