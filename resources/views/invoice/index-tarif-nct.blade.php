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
//            del = '<a href="{{ route("invoice-tarif-delete",'') }}/'+cl+'" onclick="if (confirm(\'Are You Sure ?\')){return true; }else{return false; };"><i class="fa fa-close"></i></a>';
            jQuery("#invTarifGrid").jqGrid('setRowData',ids[i],{action:edt}); 
        } 
    }
    
</script>
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Daftar Tarif NCT1</h3>
    </div>
    <div class="box-body table-responsive">
            {{
                GridRender::setGridId("invTarifGrid")
                ->enableFilterToolbar()
                ->setGridOption('url', URL::to('/invoice/fcl/tarif/grid-data'))
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
                ->addColumn(array('label'=>'Lokasi Sandar','index'=>'lokasi_sandar', 'width'=>200, 'align'=>'left'))
                ->addColumn(array('label'=>'Size','index'=>'size', 'width'=>80, 'align'=>'center'))
                ->addColumn(array('label'=>'Masa I','index'=>'masa1', 'width'=>150, 'align'=>'center', 'formatter'=>'currency', 'formatoptions'=>array('decimalSeparator'=>',', 'thousandsSeparator'=> '.', 'decimalPlaces'=> '2')))
                ->addColumn(array('label'=>'Masa II','index'=>'masa2', 'width'=>150, 'align'=>'center', 'formatter'=>'currency', 'formatoptions'=>array('decimalSeparator'=>',', 'thousandsSeparator'=> '.', 'decimalPlaces'=> '2')))
                ->addColumn(array('label'=>'Masa III','index'=>'masa3', 'width'=>150, 'align'=>'center', 'formatter'=>'currency', 'formatoptions'=>array('decimalSeparator'=>',', 'thousandsSeparator'=> '.', 'decimalPlaces'=> '2')))
                ->addColumn(array('label'=>'Masa IV','index'=>'masa4', 'width'=>150, 'align'=>'center', 'formatter'=>'currency', 'formatoptions'=>array('decimalSeparator'=>',', 'thousandsSeparator'=> '.', 'decimalPlaces'=> '2')))
                ->addColumn(array('label'=>'Lift On','index'=>'lift_on', 'width'=>150, 'align'=>'center', 'formatter'=>'currency', 'formatoptions'=>array('decimalSeparator'=>',', 'thousandsSeparator'=> '.', 'decimalPlaces'=> '2')))
                ->addColumn(array('label'=>'Lift Off','index'=>'lift_off', 'width'=>150, 'align'=>'center', 'formatter'=>'currency', 'formatoptions'=>array('decimalSeparator'=>',', 'thousandsSeparator'=> '.', 'decimalPlaces'=> '2')))
                ->addColumn(array('label'=>'Pass Truck','index'=>'pass_truck', 'width'=>150, 'align'=>'center', 'formatter'=>'currency', 'formatoptions'=>array('decimalSeparator'=>',', 'thousandsSeparator'=> '.', 'decimalPlaces'=> '2')))
                ->addColumn(array('label'=>'Gate Pass','index'=>'gate_pass_admin', 'width'=>150, 'align'=>'center', 'formatter'=>'currency', 'formatoptions'=>array('decimalSeparator'=>',', 'thousandsSeparator'=> '.', 'decimalPlaces'=> '2')))
                ->addColumn(array('label'=>'Cost Rec/Surchage','index'=>'surchage', 'width'=>150, 'align'=>'center', 'formatter'=>'currency', 'formatoptions'=>array('decimalSeparator'=>',', 'thousandsSeparator'=> '.', 'decimalPlaces'=> '2')))
                ->addColumn(array('label'=>'Paket PLP','index'=>'paket_plp', 'width'=>150, 'align'=>'center', 'formatter'=>'currency', 'formatoptions'=>array('decimalSeparator'=>',', 'thousandsSeparator'=> '.', 'decimalPlaces'=> '2')))
                ->addColumn(array('label'=>'Behandle','index'=>'behandle', 'width'=>150, 'align'=>'center', 'formatter'=>'currency', 'formatoptions'=>array('decimalSeparator'=>',', 'thousandsSeparator'=> '.', 'decimalPlaces'=> '2')))
                ->addColumn(array('label'=>'Created','index'=>'created_at', 'width'=>160, 'align'=>'center'))
                ->addColumn(array('label'=>'Updated','index'=>'updated_at', 'width'=>160, 'align'=>'center'))
                ->renderGrid()
            }}
            

    </div>
  
</div>

@endsection