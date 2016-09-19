@extends('layout')

@section('content')

<script>
    function gridCompleteEvent()
    {
        var ids = jQuery("#pelabuhanGrid").jqGrid('getDataIDs'),
            edt = '',
            del = ''; 
        for(var i=0;i < ids.length;i++){ 
            var cl = ids[i];

            edt = '<a href="{{ route("pelabuhan-edit",'') }}/'+cl+'"><i class="fa fa-pencil"></i></a> ';
            del = '<a href="{{ route("pelabuhan-delete",'') }}/'+cl+'" onclick="if (confirm(\'Are You Sure ?\')){return true; }else{return false; };"><i class="fa fa-close"></i></a>';
            jQuery("#pelabuhanGrid").jqGrid('setRowData',ids[i],{action:edt+' '+del}); 
        } 
    }
</script>

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Pelabuhan</h3>
<!--        <div class="box-tools">
            <a href="{{ route('pelabuhan-create') }}" type="button" class="btn btn-block btn-info btn-sm"><i class="fa fa-plus"></i> Add New</a>
        </div>-->
    </div>
    <div class="box-body table-responsive">
            {{
                GridRender::setGridId("pelabuhanGrid")
                ->enableFilterToolbar()
                ->setGridOption('url', URL::to('/pelabuhan/grid-data'))
                ->setGridOption('editurl',URL::to('/pelabuhan/crud'))
                ->setGridOption('rowNum', 20)
                ->setGridOption('shrinkToFit', true)
                ->setGridOption('sortname','TPELABUHAN_PK')
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
                ->addColumn(array('key'=>true,'index'=>'TPELABUHAN_PK','hidden'=>true))
                ->addColumn(array('label'=>'Nama Pelabuhan','index'=>'NAMAPELABUHAN','width'=>200,'editable'=>true,'editrules'=>array('required'=>true)))
                ->addColumn(array('label'=>'Kode','index'=>'KODEPELABUHAN','width'=>100, 'align'=>'center','editable'=>true,'editrules'=>array('required'=>true)))
                ->addColumn(array('label'=>'Janis','index'=>'JENIS','width'=>80, 'align'=>'center','editable'=>true,'edittype'=>'select','editoptions'=>array('value'=>array('L'=>'L','D'=>'D'))))
                ->addColumn(array('label'=>'Nama Negara','index'=>'NAMANEGARA','width'=>200,'editable'=>true,'editrules'=>array('required'=>true),'edittype'=>'select','editoptions'=>array('value'=>$negara)))
                ->addColumn(array('label'=>'Kode','index'=>'KODENEGARA','width'=>100, 'align'=>'center'))
                ->addColumn(array('label'=>'UID','index'=>'UID', 'width'=>150))
                ->addColumn(array('label'=>'Updated','index'=>'last_update', 'width'=>150, 'search'=>false))
//                ->addColumn(array('label'=>'Action','index'=>'action', 'width'=>80, 'search'=>false, 'sortable'=>false, 'align'=>'center'))
                ->renderGrid()
            }}
    </div>
    
    
</div>
    
@endsection