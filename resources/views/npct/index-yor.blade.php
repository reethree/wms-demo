@extends('layout')

@section('content')
<style>
    .datepicker.dropdown-menu {
        z-index: 100 !important;
    }
</style>
<script>
    function gridCompleteEvent()
    {
        var ids = jQuery("#npctYorGrid").jqGrid('getDataIDs'),
            send = '',
            edt = '',
            del = ''; 
        for(var i=0;i < ids.length;i++){ 
            var cl = ids[i];
            send = '<a href="{{ route("yor-upload",'') }}/'+cl+'" onclick="if (confirm(\'Are You Sure ?\')){return true; }else{return false; };"><i class="fa fa-floppy-o" aria-hidden="true"></i></a>';
            
            jQuery("#npctYorGrid").jqGrid('setRowData',ids[i],{action:send}); 
        } 
    }
    
    $(document).ready(function()
    {
        
        $('#create-report-btn').on("click", function(){
            $('#create-yor-modal').modal('show');
        });
        
    });
    
</script>
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Laporan Data YOR</h3>
        <div class="box-tools">
            <button class="btn btn-block btn-danger btn-sm" id="create-report-btn"><i class="fa fa-plus"></i> Create Report</button>
        </div>
    </div>
    <div class="box-body table-responsive">
        {{
            GridRender::setGridId("npctYorGrid")
            ->enableFilterToolbar()
            ->setGridOption('mtype', 'POST')
            ->setGridOption('url', URL::to('/npct/yor/grid-data?_token='.csrf_token()))
            ->setGridOption('rowNum', 50)
            ->setGridOption('shrinkToFit', true)
            ->setGridOption('sortname','id')
            ->setGridOption('sortorder','DESC')  
            ->setGridOption('rownumbers', true)
            ->setGridOption('rownumWidth', 50)
            ->setGridOption('height', '395')
            ->setGridOption('rowList',array(50,100,20))
            ->setGridOption('useColSpanStyle', true)
            ->setNavigatorOptions('navigator', array('viewtext'=>'view'))
            ->setNavigatorOptions('view',array('closeOnEscape'=>false))
            ->setNavigatorOptions('navigator', array('add' => false, 'edit' => false, 'del' => false, 'view' => true, 'refresh' => false))
            ->setNavigatorOptions('add', array('closeAfterAdd' => true))
            ->setNavigatorEvent('add', 'afterSubmit', 'afterSubmitEvent')
            ->setNavigatorOptions('edit', array('closeAfterEdit' => true))
            ->setNavigatorEvent('edit', 'afterSubmit', 'afterSubmitEvent')
            ->setNavigatorEvent('del', 'afterSubmit', 'afterSubmitEvent')
            ->setFilterToolbarOptions(array('autosearch'=>true))
            ->setGridEvent('gridComplete', 'gridCompleteEvent')
            ->addColumn(array('key'=>true,'index'=>'id','hidden'=>true))
            ->addColumn(array('label'=>'Action','index'=>'action', 'width'=>80, 'search'=>false, 'sortable'=>false, 'align'=>'center'))
            ->addColumn(array('label'=>'Kode Gudang','index'=>'warehouse_code', 'width'=>100,'align'=>'center', 'editable' => true, 'editrules' => array('required' => true)))
            ->addColumn(array('label'=>'Tipe','index'=>'warehouse_type', 'width'=>100,'align'=>'center', 'editable' => true, 'editrules' => array('required' => true)))
            ->addColumn(array('label'=>'YOR','index'=>'yor', 'width'=>100, 'align'=>'center','editable' => true, 'editrules' => array('required' => true)))
            ->addColumn(array('label'=>'Kapasitas','index'=>'capacity', 'width'=>100,'align'=>'center', 'editable' => true, 'editrules' => array('required' => true)))
            ->addColumn(array('label'=>'Status','index'=>'status', 'width'=>80,'align'=>'center', 'editable' => true, 'editrules' => array('required' => true)))
            ->addColumn(array('label'=>'Response','index'=>'response', 'width'=>250,'align'=>'center', 'editable' => true, 'editrules' => array('required' => true)))
            ->addColumn(array('label'=>'Created','index'=>'created_at', 'width'=>150,'align'=>'center', 'editable' => true, 'editrules' => array('required' => true)))
//            ->addColumn(array('label'=>'Updated','index'=>'updated_at', 'width'=>120,'align'=>'center', 'editable' => true, 'editrules' => array('required' => true)))
            ->addColumn(array('label'=>'UID','index'=>'uid', 'width'=>150, 'editable' => true, 'editrules' => array('required' => true)))

            ->renderGrid()
        }}
    </div>
  
</div>

<div id="create-yor-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Data YOR</h4>
            </div>
            <form id="create-invoice-form" class="form-horizontal" action="{{ route("yor-create-report") }}" method="POST" enctype="multipart/form-data">
                <div class="modal-body"> 
                    <div class="row">
                        <div class="col-md-12">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                            
                            <div class="form-group">
                                <label for="roles" class="col-sm-3 control-label">Kode Gudang</label>
                                <div class="col-sm-8">
                                    <select class="form-control select2 select2-hidden-accessible" name="warehouse_code" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                        <option value="">Choose Warehouse</option>
                                        <option value="ARN1">Gudang Utara (ARN1)</option>
                                        <option value="ARN3">Gudang Barat (ARN3)</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="roles" class="col-sm-3 control-label">Tipe</label>
                                <div class="col-sm-8">
                                    <select class="form-control select2 select2-hidden-accessible" name="warehouse_type" style="width: 100%;" tabindex="-1" aria-hidden="true" required>  
                                        <option value="REEFER">REEFER</option>
                                        <option value="IMDG">IMDG</option>
                                        <option value="DRY">DRY</option>
                                        <option value="OOG">OOG</option>
                                        <option value="OTHER" selected>OTHER</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-3 control-label">YOR</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="yor" required />
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Kapasitas</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="capacity" required />
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Create Report</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection

@section('custom_css')

<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/plugins/datepicker/datepicker3.css") }}">

@endsection

@section('custom_js')

<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
<script type="text/javascript">
    $('select').select2();
</script>

@endsection