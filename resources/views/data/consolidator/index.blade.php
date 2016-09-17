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
            var rowdata = $('#consolidatorGrid').getRowData(cl);
            var dataid = rowdata.TCONSOLIDATOR_PK;
            
            edt = '<a href="{{ route("consolidator-edit",'') }}/'+dataid+'"><i class="fa fa-pencil"></i></a> ';
            del = '<a href="{{ route("consolidator-delete",'') }}/'+dataid+'" onclick="if (confirm(\'Are You Sure ?\')){return true; }else{return false; };"><i class="fa fa-close"></i></a>';
            jQuery("#consolidatorGrid").jqGrid('setRowData',ids[i],{action:edt+' '+del}); 
        } 
    }
    
    function selectRowEvent(rowid,status,e)
    {
        console.log(rowid);
    }
    
</script>

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Consolidator</h3>
        <div class="box-tools">
            <a href="{{ route('consolidator-create') }}" type="button" class="btn btn-block btn-info btn-sm"><i class="fa fa-plus"></i> Add New</a>
        </div>
    </div>
    <div class="box-body table-responsive">
            {{
                GridRender::setGridId("consolidatorGrid")
                ->enableFilterToolbar()
                ->setGridOption('url', URL::to('/consolidator/grid-data'))
                ->setGridOption('rowNum', 20)
                ->setGridOption('shrinkToFit', true)
                ->setGridOption('sortname','TCONSOLIDATOR_PK')
                ->setGridOption('rownumbers', true)
                ->setGridOption('height', '295')
                ->setGridOption('rowList',array(20,50,100))
                ->setGridOption('useColSpanStyle', true)
                ->setNavigatorOptions('navigator', array('viewtext'=>'view'))
                ->setNavigatorOptions('view',array('closeOnEscape'=>false))
                ->setFilterToolbarOptions(array('autosearch'=>true))
                ->setGridEvent('gridComplete', 'gridCompleteEvent')
                ->setGridEvent('onSelectRow', 'selectRowEvent')
//                ->setNavigatorEvent('view', 'beforeShowForm', 'beforeShowFormEvent')
//                ->setNavigatorEvent('view', 'afterclickPgButtons', 'afterclickPgButtonsEvent')               
//                  ->setFilterToolbarEvent('beforeSearch', 'function(){}')
                ->addColumn(array('index'=>'TCONSOLIDATOR_PK','hidden'=>true))
                ->addColumn(array('label'=>'Nama','index'=>'NAMACONSOLIDATOR','width'=>320))
                ->addColumn(array('label'=>'NPWP','index'=>'NPWP', 'width'=>150))
                ->addColumn(array('label'=>'Alamat','index'=>'ALAMAT','hidden'=>true,'viewable'=>true,'editrules'=>array('edithidden'=>true) ))
                ->addColumn(array('label'=>'Telp','index'=>'NOTELP', 'width'=>120, 'align'=>'right'))
                ->addColumn(array('label'=>'CP','index'=>'CONTACTPERSON', 'width'=>180))
                ->addColumn(array('label'=>'Updated','index'=>'last_update', 'width'=>150, 'search'=>false))
                ->addColumn(array('label'=>'Action','index'=>'action', 'width'=>80, 'search'=>false, 'sortable'=>false, 'align'=>'center'))
                ->renderGrid()
            }}
    </div>
    
    
</div>
    
@endsection