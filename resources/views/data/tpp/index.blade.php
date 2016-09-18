@extends('layout')

@section('content')

<script>
    function gridCompleteEvent()
    {
        var ids = jQuery("#tppGrid").jqGrid('getDataIDs'),
            edt = '',
            del = ''; 
        for(var i=0;i < ids.length;i++){ 
            var cl = ids[i];
            var rowdata = $('#tppGrid').getRowData(cl);
            var dataid = rowdata.TPERUSAHAAN_PK;

            edt = '<a href="{{ route("tpp-edit",'') }}/'+dataid+'"><i class="fa fa-pencil"></i></a> ';
            del = '<a href="{{ route("tpp-delete",'') }}/'+dataid+'" onclick="if (confirm(\'Are You Sure ?\')){return true; }else{return false; };"><i class="fa fa-close"></i></a>';
            jQuery("#tppGrid").jqGrid('setRowData',ids[i],{action:edt+' '+del}); 
        } 
    }
</script>

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">TPP</h3>
<!--        <div class="box-tools">
            <a href="{{ route('tpp-create') }}" type="button" class="btn btn-block btn-info btn-sm"><i class="fa fa-plus"></i> Add New</a>
        </div>-->
    </div>
    <div class="box-body table-responsive">
            {{
                GridRender::setGridId("tppGrid")
                ->enableFilterToolbar()
                ->setGridOption('url', URL::to('/tpp/grid-data'))
                ->setGridOption('editurl',URL::to('/tpp/crud'))
                ->setGridOption('rowNum', 20)
                ->setGridOption('shrinkToFit', true)
                ->setGridOption('sortname','TTPP_PK')
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
                ->addColumn(array('key'=>true,'index'=>'TTPP_PK','hidden'=>true))
                ->addColumn(array('label'=>'Nama TPP','index'=>'NAMATPP','width'=>250,'editable' => true, 'editrules' => array('required' => true)))
                ->addColumn(array('label'=>'Telp','index'=>'NOTELP', 'width'=>120, 'align'=>'right','editable' => true,'editrules'=>array('number'=>true)))
                ->addColumn(array('label'=>'Fax','index'=>'NOFAX', 'width'=>120, 'align'=>'right','editable' => true,'editrules'=>array('number'=>true)))
                ->addColumn(array('label'=>'E-mail','index'=>'EMAIL', 'width'=>120,'editable' => true,'editrules'=>array('email'=>true)))
                ->addColumn(array('label'=>'CP','index'=>'CONTACTPERSON', 'width'=>120,'editable' => true))
                ->addColumn(array('label'=>'Alamat','index'=>'ALAMAT','hidden'=>true,'viewable'=>true,'editable' => true,'edittype' => 'textarea','editrules'=>array('edithidden'=>true) ))
                ->addColumn(array('label'=>'UID','index'=>'UID', 'width'=>120))
                ->addColumn(array('label'=>'Updated','index'=>'last_update', 'width'=>150, 'search'=>false))
//                ->addColumn(array('label'=>'Action','index'=>'action', 'width'=>80, 'search'=>false, 'sortable'=>false, 'align'=>'center'))
                ->renderGrid()
            }}
    </div>
    
    
</div>
    
@endsection