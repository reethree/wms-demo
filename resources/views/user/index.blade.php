@extends('layout')

@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">User Lists</h3>
    </div>
    <div class="box-body table-responsive">
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
                  ->addColumn(array('index'=>'id', 'width'=>80))
                  ->addColumn(array('label'=>'Name','index'=>'name','width'=>200))
                  ->addColumn(array('label'=>'Username','index'=>'username', 'width'=>200))
                  ->addColumn(array('label'=>'Email','index'=>'email', 'width'=>200))
                  ->addColumn(array('label'=>'Created','index'=>'created_at', 'width'=>200))
                  ->addColumn(array('label'=>'Updated','index'=>'updated_at', 'width'=>200))
                  ->renderGrid()
            }}
    </div>
</div>
    
@endsection