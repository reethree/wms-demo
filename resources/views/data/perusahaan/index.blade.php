@extends('layout')

@section('content')

<script>
    function gridCompleteEvent()
    {
        var ids = jQuery("#perusahaanGrid").jqGrid('getDataIDs'),
            edt = '',
            del = ''; 
        for(var i=0;i < ids.length;i++){ 
            var cl = ids[i];
            var rowdata = $('#perusahaanGrid').getRowData(cl);
            var dataid = rowdata.TPERUSAHAAN_PK;

            edt = '<a href="{{ route("perusahaan-edit",'') }}/'+dataid+'"><i class="fa fa-pencil"></i></a> ';
            del = '<a href="{{ route("perusahaan-delete",'') }}/'+dataid+'"><i class="fa fa-close"></i></a>';
            jQuery("#perusahaanGrid").jqGrid('setRowData',ids[i],{action:edt+' '+del}); 
        } 
    }
</script>

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Perusahaan</h3>
        <div class="box-tools">
            <a href="{{ route('perusahaan-create') }}" type="button" class="btn btn-block btn-info btn-sm"><i class="fa fa-plus"></i> Add New</a>
        </div>
    </div>
    <div class="box-body table-responsive">
            {{
                GridRender::setGridId("perusahaanGrid")
                ->enableFilterToolbar()
                ->setGridOption('url', URL::to('/perusahaan/grid-data'))
                ->setGridOption('rowNum', 20)
                ->setGridOption('shrinkToFit', true)
                ->setGridOption('sortname','TPERUSAHAAN_PK')
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
                ->addColumn(array('index'=>'TPERUSAHAAN_PK','hidden'=>true))
                ->addColumn(array('label'=>'Nama Perusahaan','index'=>'NAMAPERUSAHAAN','width'=>200))
                ->addColumn(array('label'=>'NPWP','index'=>'NPWP', 'width'=>150))
                ->addColumn(array('label'=>'Telp','index'=>'NOTELP', 'width'=>120, 'align'=>'right'))
                ->addColumn(array('label'=>'E-mail','index'=>'EMAIL', 'width'=>120,))
                ->addColumn(array('label'=>'CP','index'=>'CONTACTPERSON', 'width'=>120))
                ->addColumn(array('label'=>'Alamat','index'=>'ALAMAT','hidden'=>true,'viewable'=>true,'editrules'=>array('edithidden'=>true) ))
                ->addColumn(array('label'=>'UID','index'=>'UID', 'width'=>120))
                ->addColumn(array('label'=>'Updated','index'=>'last_update', 'width'=>150, 'search'=>false))
                ->addColumn(array('label'=>'Action','index'=>'action', 'width'=>80, 'search'=>false, 'sortable'=>false, 'align'=>'center'))
                ->renderGrid()
            }}
    </div>
    
    
</div>
    
@endsection