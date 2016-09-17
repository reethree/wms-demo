@extends('layout')

@section('content')

<script>
    function gridCompleteEvent()
    {
        var ids = jQuery("#negaraGrid").jqGrid('getDataIDs'),
            edt = '',
            del = ''; 
        for(var i=0;i < ids.length;i++){ 
            var cl = ids[i];
            var rowdata = $('#negaraGrid').getRowData(cl);
            var dataid = rowdata.TNEGARA_PK;

            edt = '<a href="{{ route("negara-edit",'') }}/'+dataid+'" onclick="if (confirm(\'Are You Sure ?\')){return true; }else{return false; };"><i class="fa fa-pencil"></i></a> ';
            del = '<a href="{{ route("negara-delete",'') }}/'+dataid+'"><i class="fa fa-close"></i></a>';
            jQuery("#negaraGrid").jqGrid('setRowData',ids[i],{action:edt+' '+del}); 
        } 
    }
</script>

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Negara</h3>
        <div class="box-tools">
            <a href="{{ route('negara-create') }}" type="button" class="btn btn-block btn-info btn-sm"><i class="fa fa-plus"></i> Add New</a>
        </div>
    </div>
    <div class="box-body table-responsive">
            {{
                GridRender::setGridId("negaraGrid")
                ->enableFilterToolbar()
                ->setGridOption('url', URL::to('/negara/grid-data'))
                ->setGridOption('rowNum', 20)
                ->setGridOption('shrinkToFit', true)
                ->setGridOption('sortname','TNEGARA_PK')
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
                ->addColumn(array('index'=>'TNEGARA_PK','hidden'=>true))
                ->addColumn(array('label'=>'Nama Negara','index'=>'NAMANEGARA','width'=>320))
                ->addColumn(array('label'=>'Kode','index'=>'KODENEGARA','width'=>150, 'align'=>'center'))
                ->addColumn(array('label'=>'UID','index'=>'UID', 'width'=>150))
                ->addColumn(array('label'=>'Updated','index'=>'last_update', 'width'=>150, 'search'=>false))
                ->addColumn(array('label'=>'Action','index'=>'action', 'width'=>80, 'search'=>false, 'sortable'=>false, 'align'=>'center'))
                ->renderGrid()
            }}
    </div>
    
    
</div>
    
@endsection