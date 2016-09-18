@extends('layout')

@section('content')

<script>
    function gridCompleteEvent()
    {
        var ids = jQuery("#vesselGrid").jqGrid('getDataIDs'),
            edt = '',
            del = ''; 
        for(var i=0;i < ids.length;i++){ 
            var cl = ids[i];
            var rowdata = $('#vesselGrid').getRowData(cl);
            var dataid = rowdata.tvessel_pk;

            edt = '<a href="{{ route("vessel-edit",'') }}/'+dataid+'"><i class="fa fa-pencil"></i></a> ';
            del = '<a href="{{ route("vessel-delete",'') }}/'+dataid+'" onclick="if (confirm(\'Are You Sure ?\')){return true; }else{return false; };"><i class="fa fa-close"></i></a>';
            jQuery("#vesselGrid").jqGrid('setRowData',ids[i],{action:edt+' '+del}); 
        } 
    }
</script>

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Vessel</h3>
<!--        <div class="box-tools">
            <a href="{{ route('vessel-create') }}" type="button" class="btn btn-block btn-info btn-sm"><i class="fa fa-plus"></i> Add New</a>
        </div>-->
    </div>
    <div class="box-body table-responsive">
            {{
                GridRender::setGridId("vesselGrid")
                ->enableFilterToolbar()
                ->setGridOption('url', URL::to('/vessel/grid-data'))
                ->setGridOption('editurl',URL::to('/vessel/crud'))
                ->setGridOption('rowNum', 20)
                ->setGridOption('shrinkToFit', true)
                ->setGridOption('sortname','tvessel_pk')
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
                ->addColumn(array('key'=>true,'index'=>'tvessel_pk','hidden'=>true))
                ->addColumn(array('label'=>'Vessel Name','index'=>'vesselname','width'=>200,'editable' => true, 'editrules' => array('required' => true)))
                ->addColumn(array('label'=>'Vessel Code','index'=>'vesselcode', 'width'=>120,'editable' => true, 'editrules' => array('required' => true)))
                ->addColumn(array('label'=>'Call Sign','index'=>'callsign', 'width'=>120,'editable' => true))
                ->addColumn(array('label'=>'Negara','index'=>'nationality', 'width'=>120,'editable'=>true,'editrules'=>array('required'=>true),'edittype'=>'select','editoptions'=>array('value'=>$negara)))
                ->addColumn(array('label'=>'UID','index'=>'uid', 'width'=>120))
                ->addColumn(array('label'=>'Updated','index'=>'last_update', 'width'=>150, 'search'=>false))
//                ->addColumn(array('label'=>'Action','index'=>'action', 'width'=>80, 'search'=>false, 'sortable'=>false, 'align'=>'center'))
                ->renderGrid()
            }}
    </div>
    
    
</div>
    
@endsection