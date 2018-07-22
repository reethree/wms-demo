@extends('layout')

@section('content')
<script>
 
    function gridCompleteEvent()
    {
        var ids = jQuery("#lclManifestGrid").jqGrid('getDataIDs'),
            edt = '',
            del = ''; 
        for(var i=0;i < ids.length;i++){ 
            var cl = ids[i];
            
            edt = '<a href="{{ route("lcl-manifest-edit",'') }}/'+cl+'"><i class="fa fa-pencil"></i></a> ';
            del = '<a href="{{ route("lcl-manifest-delete",'') }}/'+cl+'" onclick="if (confirm(\'Are You Sure ?\')){return true; }else{return false; };"><i class="fa fa-close"></i></a>';
            jQuery("#lclManifestGrid").jqGrid('setRowData',ids[i],{action:edt+' '+del}); 
        } 
    }
    
</script>

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">LCL Manifest Lists</h3>
<!--        <div class="box-tools">
            <a href="{{ route('lcl-manifest-create') }}" type="button" class="btn btn-block btn-info btn-sm"><i class="fa fa-plus"></i> Add New</a>
        </div>-->
    </div>
    <div class="box-body table-responsive">       
        {{
            GridRender::setGridId("lclManifestGrid")
            ->enableFilterToolbar()
            ->setGridOption('mtype', 'POST')
            ->setGridOption('url', URL::to('/lcl/register/grid-data?_token='.csrf_token()))
            ->setGridOption('rowNum', 25)
            ->setGridOption('shrinkToFit', true)
            ->setGridOption('sortname','TCONTAINER_PK')
            ->setGridOption('rownumbers', true)
            ->setGridOption('rownumWidth', 50)
            ->setGridOption('height', '400')
            ->setGridOption('rowList',array(25,50,100))
            ->setGridOption('useColSpanStyle', true)
            ->setNavigatorOptions('navigator', array('viewtext'=>'view'))
            ->setNavigatorOptions('view',array('closeOnEscape'=>false))
            ->setFilterToolbarOptions(array('autosearch'=>true))
            ->setGridEvent('gridComplete', 'gridCompleteEvent')
            ->addColumn(array('label'=>'Action','index'=>'action', 'width'=>80, 'search'=>false, 'sortable'=>false, 'align'=>'center'))
            ->addColumn(array('key'=>true,'index'=>'TCONTAINER_PK','hidden'=>true))
            ->addColumn(array('label'=>'No. Container','index'=>'NOCONTAINER','width'=>160))
            ->addColumn(array('label'=>'No. Joborder','index'=>'NoJob','width'=>160))
            ->addColumn(array('label'=>'No. MBL','index'=>'NOMBL','width'=>160))
            ->addColumn(array('label'=>'Tgl. MBL','index'=>'TGL_MASTER_BL','width'=>150,'align'=>'center'))
            ->addColumn(array('label'=>'Size','index'=>'SIZE', 'width'=>80,'align'=>'center'))
//            ->addColumn(array('label'=>'Teus','index'=>'TEUS', 'width'=>80,'align'=>'center'))
            ->addColumn(array('label'=>'No. Seal','index'=>'NO_SEAL', 'width'=>120,'align'=>'right'))
            ->addColumn(array('label'=>'TPS Asal','index'=>'KD_TPS_ASAL', 'width'=>80,'align'=>'center'))
            ->addColumn(array('label'=>'Consolidator','index'=>'NAMACONSOLIDATOR','width'=>250))
            ->addColumn(array('label'=>'UID','index'=>'UID', 'width'=>150,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl. Entry','index'=>'TGLENTRY', 'width'=>150,'align'=>'center'))
            ->addColumn(array('label'=>'Updated','index'=>'last_update', 'width'=>150, 'search'=>false,'align'=>'center'))
//            ->addColumn(array('label'=>'Action','index'=>'action', 'width'=>80, 'search'=>false, 'sortable'=>false, 'align'=>'center'))
            ->renderGrid()
        }}
    </div>
</div>

@endsection