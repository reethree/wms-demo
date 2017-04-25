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
            
            edt = '<a title="Edit" href="{{ route("invoice-tarif-edit",'') }}/'+cl+'"><i class="fa fa-pencil"></i></a> ';
            del = '<a href="{{ route("invoice-tarif-delete",'') }}/'+cl+'" onclick="if (confirm(\'Are You Sure ?\')){return true; }else{return false; };"><i class="fa fa-close"></i></a>';
            jQuery("#invTarifGrid").jqGrid('setRowData',ids[i],{action:edt+' '+del}); 
        } 
    }
    
</script>
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Daftar Tarif Consolidator</h3>
        <div class="box-tools">
            <a href="{{ route('invoice-tarif-create') }}" type="button" class="btn btn-block btn-info btn-sm"><i class="fa fa-plus"></i> Add New</a>
        </div>
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
                ->addColumn(array('index'=>'consolidator_id','hidden'=>true))
                ->addColumn(array('label'=>'Action','index'=>'action', 'width'=>80, 'search'=>false, 'sortable'=>false, 'align'=>'center'))
                ->addColumn(array('label'=>'Type','index'=>'type', 'width'=>80, 'align'=>'center'))
                ->addColumn(array('label'=>'Consolidator','index'=>'NAMACONSOLIDATOR', 'width'=>300, 'align'=>'left'))
                ->addColumn(array('label'=>'RDM','index'=>'rdm', 'width'=>150, 'align'=>'center', 'formatter'=>'currency', 'formatoptions'=>array('decimalSeparator'=>',', 'thousandsSeparator'=> '.', 'decimalPlaces'=> '2')))
                ->addColumn(array('label'=>'Storage','index'=>'storage', 'width'=>150, 'align'=>'center', 'formatter'=>'currency', 'formatoptions'=>array('decimalSeparator'=>',', 'thousandsSeparator'=> '.', 'decimalPlaces'=> '2')))
                ->addColumn(array('label'=>'Masa I','index'=>'storage_masa1', 'width'=>150, 'align'=>'center', 'formatter'=>'currency', 'formatoptions'=>array('decimalSeparator'=>',', 'thousandsSeparator'=> '.', 'decimalPlaces'=> '2')))
                ->addColumn(array('label'=>'Masa II','index'=>'storage_masa2', 'width'=>150, 'align'=>'center', 'formatter'=>'currency', 'formatoptions'=>array('decimalSeparator'=>',', 'thousandsSeparator'=> '.', 'decimalPlaces'=> '2')))
                ->addColumn(array('label'=>'Masa III','index'=>'storage_masa3', 'width'=>150, 'align'=>'center', 'formatter'=>'currency', 'formatoptions'=>array('decimalSeparator'=>',', 'thousandsSeparator'=> '.', 'decimalPlaces'=> '2')))
                ->addColumn(array('label'=>'Behandle','index'=>'behandle', 'width'=>150, 'align'=>'center', 'formatter'=>'currency', 'formatoptions'=>array('decimalSeparator'=>',', 'thousandsSeparator'=> '.', 'decimalPlaces'=> '2')))
                ->addColumn(array('label'=>'Admin','index'=>'adm', 'width'=>150, 'align'=>'center', 'formatter'=>'currency', 'formatoptions'=>array('decimalSeparator'=>',', 'thousandsSeparator'=> '.', 'decimalPlaces'=> '2')))
                ->addColumn(array('label'=>'Surcharge','index'=>'surcharge_price', 'width'=>150, 'align'=>'center', 'formatter'=>'currency', 'formatoptions'=>array('decimalSeparator'=>',', 'thousandsSeparator'=> '.', 'decimalPlaces'=> '2')))
                ->addColumn(array('label'=>'> 2.5Ton','index'=>'surcharge', 'width'=>120, 'align'=>'center'))
                ->addColumn(array('label'=>'X CBM','index'=>'cbm', 'width'=>120, 'align'=>'center'))
                ->addColumn(array('label'=>'Pembulatan','index'=>'pembulatan', 'width'=>120, 'align'=>'center'))
                ->addColumn(array('label'=>'Created','index'=>'created_at', 'width'=>160, 'align'=>'center'))
                ->addColumn(array('label'=>'Update','index'=>'update_at', 'width'=>160, 'align'=>'center'))
                ->addColumn(array('label'=>'UID','index'=>'uid', 'width'=>160, 'align'=>'center'))
                ->renderGrid()
            }}
    </div>
  
</div>

@endsection