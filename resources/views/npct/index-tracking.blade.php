@extends('layout')

@section('content')
<style>
    .datepicker.dropdown-menu {
        z-index: 100 !important;
    }
</style>
<script>
    
    $(document).ready(function()
    {        
        $('#getdata-tracking-btn').on("click", function(){
            $('#getdata-tracking-modal').modal('show');
        });
        
    });
    
</script>
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Data Tracking</h3>
        <div class="box-tools">
            <button class="btn btn-block btn-info btn-sm" id="getdata-tracking-btn"><i class="fa fa-plus"></i> Get Data</button>
        </div>
    </div>
    <div class="box-body table-responsive">
        {{
            GridRender::setGridId("npctTrackingGrid")
            ->enableFilterToolbar()
            ->setGridOption('mtype', 'POST')
            ->setGridOption('url', URL::to('/npct/tracking/grid-data?_token='.csrf_token()))
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
//            ->setGridEvent('gridComplete', 'gridCompleteEvent')
            ->addColumn(array('key'=>true,'index'=>'id','hidden'=>true))
            ->addColumn(array('label'=>'Vessel','index'=>'vessel_name', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Voy','index'=>'voyage', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Call Sign','index'=>'call_sign', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'ETA','index'=>'eta', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'ATA','index'=>'ata', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'POD','index'=>'pod', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'POL','index'=>'pol', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Line','index'=>'line', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'No. Container','index'=>'cont_no', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Size','index'=>'cont_size', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Height','index'=>'cont_height', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'ISO Code','index'=>'cont_isocode', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Cont. Status','index'=>'cont_status', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Cont. Type','index'=>'cont_type', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Net Weight','index'=>'cont_netweight', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Gross Weight','index'=>'cont_grossweight', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Tare Weight','index'=>'cont_tareweight', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Reefer','index'=>'cont_reefer', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'IMDG','index'=>'cont_imdg', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'IMDG Value','index'=>'cont_imdg_value', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'OOG','index'=>'cont_oog', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'OOG Value','index'=>'cont_oog_value', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Discharge','index'=>'cont_discharge', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Stacking','index'=>'cont_stacking', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Truck In Terminal','index'=>'truck_in_terminal', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Truck Out Terminal','index'=>'truck_out_terminal', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Truck In CG','index'=>'truck_in_cg', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Truck Out CG','index'=>'truck_out_cg', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Status','index'=>'status', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Created','index'=>'created_at', 'width'=>120,'align'=>'center', 'editable' => true, 'editrules' => array('required' => true)))
            ->addColumn(array('label'=>'UID','index'=>'uid', 'width'=>150, 'editable' => true, 'editrules' => array('required' => true)))
            ->renderGrid()
        }}
    </div>
  
</div>

<div id="getdata-tracking-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Input Data Tracking</h4>
            </div>
            <form id="create-invoice-form" class="form-horizontal" action="{{ route("getdata-tracking") }}" method="POST" enctype="multipart/form-data">
                <div class="modal-body"> 
                    <div class="row">
                        <div class="col-md-12">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                            <div class="form-group">
                                <label class="col-sm-3 control-label">No. Container</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="container" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="roles" class="col-sm-3 control-label">Direction</label>
                                <div class="col-sm-8">
                                    <select class="form-control select2 select2-hidden-accessible" name="direction" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                        <option value="IMPORT" selected>Import</option>
                                        <option value="EXPORT">Export</option>
                                    </select>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Get Data Tracking</button>
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