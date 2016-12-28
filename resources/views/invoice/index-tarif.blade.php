@extends('layout')

@section('content')
<script>
 
    function gridCompleteEvent()
    {
        var ids = jQuery("#invTarifGrid").jqGrid('getDataIDs'),
            edt = '',
            del = ''; 
        for(var i=0;i < ids.length;i++){ 
            var cl = ids[i];
            
            edt = '<a title="View Detail" href="{{ route("invoice-tarif-view",'') }}/'+cl+'"><i class="fa fa-pencil"></i></a> ';
//            del = '<a href="{{ route("lcl-register-delete",'') }}/'+cl+'" onclick="if (confirm(\'Are You Sure ?\')){return true; }else{return false; };"><i class="fa fa-close"></i></a>';
            jQuery("#invTarifGrid").jqGrid('setRowData',ids[i],{action:edt}); 
        } 
    }
    
</script>
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">List Tarif Kesepakatan Aptesindo</h3>
<!--        <div class="box-tools">
            <a href="{{ route('consolidator-create') }}" type="button" class="btn btn-block btn-info btn-sm"><i class="fa fa-plus"></i> Add New</a>
        </div>-->
    </div>
    <div class="box-body table-responsive">
            {{
                GridRender::setGridId("invTarifGrid")
                ->enableFilterToolbar()
                ->setGridOption('url', URL::to('/invoice/tarif/grid-data'))
                ->setGridOption('rowNum', 20)
                ->setGridOption('shrinkToFit', true)
                ->setGridOption('sortname','id')
                ->setGridOption('rownumbers', true)
                ->setGridOption('height', '295')
                ->setGridOption('rowList',array(20,50,100))
                ->setGridOption('useColSpanStyle', true)
                ->setNavigatorOptions('navigator', array('viewtext'=>'view'))
                ->setNavigatorOptions('view',array('closeOnEscape'=>false))
                ->setNavigatorOptions('navigator', array('add' => false, 'edit' => false, 'del' => false, 'view' => true, 'refresh' => false))
                ->setFilterToolbarOptions(array('autosearch'=>true))
                ->setGridEvent('gridComplete', 'gridCompleteEvent')
                ->addColumn(array('key'=>true,'index'=>'id','hidden'=>true))
                ->addColumn(array('label'=>'Action','index'=>'action', 'width'=>80, 'search'=>false, 'sortable'=>false, 'align'=>'center'))
                ->addColumn(array('label'=>'Type','index'=>'type', 'width'=>200, 'align'=>'center'))
                ->addColumn(array('label'=>'Link','index'=>'link', 'width'=>200, 'align'=>'center'))
                ->addColumn(array('label'=>'Service','index'=>'service', 'width'=>200, 'align'=>'center'))
                ->addColumn(array('label'=>'Update','index'=>'update_at', 'width'=>200, 'align'=>'center'))
                ->addColumn(array('label'=>'UID','index'=>'uid', 'width'=>200, 'align'=>'center'))
                ->renderGrid()
            }}
    </div>
  
</div>

@endsection