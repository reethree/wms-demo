@extends('layout')

@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">User Lists</h3>
    </div>
    <div class="box-body table-responsive no-padding">
            {{
                GridRender::setGridId("userGrid")
                  ->enableFilterToolbar()
                  ->setGridOption('url', URL::to('/users/grid-data'))
                  ->setGridOption('rowNum', 10)
                  ->setGridOption('shrinkToFit', false)
                  ->setGridOption('sortname','id')
        //          ->setGridOption('caption','User Lists')
                  ->setGridOption('useColSpanStyle', true)
                  ->setNavigatorOptions('navigator', array('viewtext'=>'view'))
                  ->setNavigatorOptions('view',array('closeOnEscape'=>false))
                  ->setFilterToolbarOptions(array('autosearch'=>true))
        //          ->setGridEvent('gridComplete', 'gridCompleteEvent') //gridCompleteEvent must be previously declared as a javascript function.
//                  ->setNavigatorEvent('view', 'beforeShowForm', 'function(){}')
//                  ->setFilterToolbarEvent('beforeSearch', 'function(){}')
                  ->addColumn(array('index'=>'id', 'width'=>55))
                  ->addColumn(array('label'=>'Name','index'=>'name','width'=>200))
                  ->addColumn(array('label'=>'Username','index'=>'username', 'width'=>150))
                  ->addColumn(array('label'=>'Email','index'=>'email', 'width'=>150))
        //          ->addColumn(array('label'=>'Note','index'=>'note','index'=>'note', 'width'=>55,'searchoptions'=>array('attr'=>array('title'=>'Note title'))))
                  ->renderGrid()
            }}
    </div>
</div>
    
@endsection