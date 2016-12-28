@extends('layout')

@section('content')
<style type="text/css" media="screen">
    th.ui-th-column div{
        white-space:normal !important;
        height:auto !important;
        padding:2px;
    }
</style>
<script>
    var grid = $("#invTarifItemGrid"), headerRow, rowHight, resizeSpanHeight;

    // get the header row which contains
    headerRow = grid.closest("div.ui-jqgrid-view")
        .find("table.ui-jqgrid-htable>thead>tr.ui-jqgrid-labels");

    // increase the height of the resizing span
    resizeSpanHeight = 'height: ' + headerRow.height() +
        'px !important; cursor: col-resize;';
    headerRow.find("span.ui-jqgrid-resize").each(function () {
        this.style.cssText = resizeSpanHeight;
    });

    // set position of the dive with the column header text to the middle
    rowHight = headerRow.height();
    headerRow.find("div.ui-jqgrid-sortable").each(function () {
        var ts = $(this);
        ts.css('top', (rowHight - ts.outerHeight()) / 2 + 'px');
    });

    function gridCompleteEvent()
    {
        var ids = jQuery("#invTarifItemGrid").jqGrid('getDataIDs'),
            edt = '',
            del = ''; 
        for(var i=0;i < ids.length;i++){ 
            var cl = ids[i];
            
            edt = '<a title="Edit" href="{{ route("invoice-tarif-item-edit",'') }}/'+cl+'"><i class="fa fa-pencil"></i></a> ';
//            del = '<a href="{{ route("lcl-register-delete",'') }}/'+cl+'" onclick="if (confirm(\'Are You Sure ?\')){return true; }else{return false; };"><i class="fa fa-close"></i></a>';
            jQuery("#invTarifItemGrid").jqGrid('setRowData',ids[i],{action:edt}); 
        } 
    }
    
</script>
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Daftar Item Tarif</h3>
<!--        <div class="box-tools">
            <a href="{{ route('consolidator-create') }}" type="button" class="btn btn-block btn-info btn-sm"><i class="fa fa-plus"></i> Add New</a>
        </div>-->
    </div>
    <div class="box-body table-responsive">
            {{
                GridRender::setGridId("invTarifItemGrid")
                ->enableFilterToolbar()
                ->setGridOption('url', URL::to('/invoice/tarif/item/grid-data?tarif_id='.$tarif->id))
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

                ->addColumn(array('label'=>'Item Description','index'=>'description', 'width'=>200, 'align'=>'left'))
                ->addColumn(array('label'=>'Unit','index'=>'unit', 'width'=>100, 'align'=>'center'))
                ->addColumn(array('label'=>'Batasan','index'=>'batasan', 'width'=>100, 'align'=>'center'))
                ->addColumn(array('label'=>'Nilai<br />Batasan','index'=>'nilai_batasan', 'width'=>100, 'align'=>'center'))
                ->addColumn(array('label'=>'Harga<br />Batasan','index'=>'harga_batasan', 'width'=>100, 'align'=>'center', 'formatter'=>'currency', 'formatoptions'=>array('decimalSeparator'=>',', 'thousandsSeparator'=> '.', 'decimalPlaces'=> '2')))
                ->addColumn(array('label'=>'Batasan2','index'=>'batasan2', 'width'=>100, 'align'=>'center'))
                ->addColumn(array('label'=>'Nilai<br />Batasan2','index'=>'nilai_batasan2', 'width'=>100, 'align'=>'center'))
                ->addColumn(array('label'=>'Refund','index'=>'refund', 'width'=>100, 'align'=>'center'))
                ->addColumn(array('label'=>'Royalti','index'=>'royalti', 'width'=>100, 'align'=>'center'))
                ->addColumn(array('label'=>'Masa1<br />Dari','index'=>'masa1_start', 'width'=>100, 'align'=>'center'))
                ->addColumn(array('label'=>'Masa1<br />Sampai','index'=>'masa1_end', 'width'=>100, 'align'=>'center'))
                ->addColumn(array('label'=>'Harga<br />Masa1','index'=>'harga_masa1', 'width'=>100, 'align'=>'center', 'formatter'=>'currency', 'formatoptions'=>array('decimalSeparator'=>',', 'thousandsSeparator'=> '.', 'decimalPlaces'=> '2')))
                ->addColumn(array('label'=>'Masa2<br />Dari','index'=>'masa2_start', 'width'=>100, 'align'=>'center'))
                ->addColumn(array('label'=>'Masa2<br />Sampai','index'=>'masa2_end', 'width'=>100, 'align'=>'center'))
                ->addColumn(array('label'=>'Harga<br />Masa2','index'=>'harga_masa2', 'width'=>100, 'align'=>'center', 'formatter'=>'currency', 'formatoptions'=>array('decimalSeparator'=>',', 'thousandsSeparator'=> '.', 'decimalPlaces'=> '2')))
                ->addColumn(array('label'=>'Masa3<br />Dari','index'=>'masa3_start', 'width'=>100, 'align'=>'center'))
                ->addColumn(array('label'=>'Masa3<br />Sampai','index'=>'masa3_end', 'width'=>100, 'align'=>'center'))
                ->addColumn(array('label'=>'Harga<br />Masa3','index'=>'harga_masa3', 'width'=>100, 'align'=>'center', 'formatter'=>'currency', 'formatoptions'=>array('decimalSeparator'=>',', 'thousandsSeparator'=> '.', 'decimalPlaces'=> '2')))
                ->addColumn(array('label'=>'Masa1 DG<br />Dari','index'=>'masa_dg1_start', 'width'=>100, 'align'=>'center'))
                ->addColumn(array('label'=>'Masa1 DG<br />Sampai','index'=>'masa_dg1_end', 'width'=>100, 'align'=>'center'))
                ->addColumn(array('label'=>'Harga<br />Masa DG1','index'=>'harga_masa_dg1', 'width'=>100, 'align'=>'center', 'formatter'=>'currency', 'formatoptions'=>array('decimalSeparator'=>',', 'thousandsSeparator'=> '.', 'decimalPlaces'=> '2')))
                ->addColumn(array('label'=>'Masa2 DG<br />Dari','index'=>'masa_dg2_start', 'width'=>100, 'align'=>'center'))
                ->addColumn(array('label'=>'Masa2 DG<br />Sampai','index'=>'masa_dg2_end', 'width'=>100, 'align'=>'center'))
                ->addColumn(array('label'=>'Harga<br />Masa DG2','index'=>'harga_masa_dg2', 'width'=>100, 'align'=>'center', 'formatter'=>'currency', 'formatoptions'=>array('decimalSeparator'=>',', 'thousandsSeparator'=> '.', 'decimalPlaces'=> '2')))
                ->addColumn(array('label'=>'Discount','index'=>'discount', 'width'=>100, 'align'=>'center'))
                ->addColumn(array('label'=>'PPN','index'=>'ppn', 'width'=>100, 'align'=>'center'))
                ->addColumn(array('label'=>'Created','index'=>'created_at', 'width'=>150, 'align'=>'center'))
                ->addColumn(array('label'=>'Updated','index'=>'updated_at', 'width'=>150, 'align'=>'center'))
                ->addColumn(array('label'=>'UID','index'=>'uid', 'width'=>150, 'align'=>'center'))
        
                ->renderGrid()
            }}
    </div>
  
</div>

@endsection