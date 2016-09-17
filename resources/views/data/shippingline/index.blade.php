@extends('layout')

@section('content')

<script>
    function gridCompleteEvent()
    {
        var ids = jQuery("#shippinglineGrid").jqGrid('getDataIDs'),
            edt = '',
            del = ''; 
        for(var i=0;i < ids.length;i++){ 
            var cl = ids[i];
            var rowdata = $('#shippinglineGrid').getRowData(cl);
            var dataid = rowdata.TPERUSAHAAN_PK;

            edt = '<a href="{{ route("shippingline-edit",'') }}/'+dataid+'"><i class="fa fa-pencil"></i></a> ';
            del = '<a href="{{ route("shippingline-delete",'') }}/'+dataid+'"><i class="fa fa-close"></i></a>';
            jQuery("#shippinglineGrid").jqGrid('setRowData',ids[i],{action:edt+' '+del}); 
        } 
    }
</script>

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Shipping Line</h3>
        <div class="box-tools">
            <a href="{{ route('shippingline-create') }}" type="button" class="btn btn-block btn-info btn-sm"><i class="fa fa-plus"></i> Add New</a>
        </div>
    </div>
    <div class="box-body table-responsive">
            {{
                GridRender::setGridId("shippinglineGrid")
                ->enableFilterToolbar()
                ->setGridOption('url', URL::to('/shippingline/grid-data'))
                ->setGridOption('rowNum', 20)
                ->setGridOption('shrinkToFit', true)
                ->setGridOption('sortname','TSHIPPINGLINE_PK')
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
                ->addColumn(array('index'=>'tshippingline_pk','hidden'=>true))
                ->addColumn(array('label'=>'Shipping Line','index'=>'shippingline','width'=>250))
                ->addColumn(array('label'=>'Kapal','index'=>'kapal', 'width'=>120))
                ->addColumn(array('label'=>'E-mail','index'=>'email', 'width'=>120))
                ->addColumn(array('label'=>'CC','index'=>'cc_email', 'width'=>120))
                ->addColumn(array('label'=>'Keterangan','index'=>'keterangan','hidden'=>true,'viewable'=>true,'editrules'=>array('edithidden'=>true) ))
                ->addColumn(array('label'=>'UID','index'=>'UID', 'width'=>120))
                ->addColumn(array('label'=>'Updated','index'=>'last_update', 'width'=>150, 'search'=>false))
                ->addColumn(array('label'=>'Action','index'=>'action', 'width'=>80, 'search'=>false, 'sortable'=>false, 'align'=>'center'))
                ->renderGrid()
            }}
    </div>
    
    
</div>
    
@endsection