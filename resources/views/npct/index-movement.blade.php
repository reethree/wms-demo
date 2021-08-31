@extends('layout')

@section('content')
<style>
    .datepicker.dropdown-menu {
        z-index: 100 !important;
    }
    .datepicker.dropdown-menu {
        z-index: 9999 !important;
    }
</style>
<script>
    function gridCompleteEvent()
    {
        var ids = jQuery("#npctMovementGrid").jqGrid('getDataIDs'),
            send = '',
            edt = '',
            del = ''; 
        for(var i=0;i < ids.length;i++){ 
            var cl = ids[i];
//            edt = '<a href="/'+cl+'" onclick="if (confirm(\'Are You Sure ?\')){return true; }else{return false; };"><i class="fa fa-pencil" aria-hidden="true"></i></a>';
            edt = '<button style="margin:5px;" class="btn btn-danger btn-xs" data-id="'+cl+'" onclick="editMovement('+cl+');"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
            jQuery("#npctMovementGrid").jqGrid('setRowData',ids[i],{edit:edt}); 
        } 
    }
       
    function editMovement($id)
    {
        $("#movement_id").val($id);
        $('#movement-modal').modal('show');
    }
       
    $(document).ready(function()
    { 
        function uploadMovement(action, movementId){
            $.ajax({
                type: 'POST',
                data: {
                    movement_id : movementId,
                    action : action,
                    _token : '{{ csrf_token() }}'
                },
                dataType : 'json',
                url: '{{route("movement-upload")}}',
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Something went wrong, please try again later.');
                },
                beforeSend:function()
                {

                },
                success:function(json)
                {
                    console.log(json);
                    if(json.success) {
                      $('#alert').showAlertAfterElement('alert-success alert-custom', json.message, 5000);
                    } else {
                      $('#alert').showAlertAfterElement('alert-danger alert-custom', json.message, 5000);
                    }
                    
                    $('#npctMovementGrid').jqGrid().trigger("reloadGrid");
                }
            });
        }
        
        $('#create-report-btn').on("click", function(){
            var $grid = $("#npctMovementGrid"), selIds = $grid.jqGrid("getGridParam", "selarrrow"), i, n,
                cellValues = [];
            for (i = 0, n = selIds.length; i < n; i++) {
                cellValues.push($grid.jqGrid("getCell", selIds[i], "id"));
            }
            
            var containerId = cellValues.join(",");
            
            if(!containerId) {alert('Please Select Container');return false;}  
            
            if(!confirm('Apakah anda yakin akan membuat laporan movement?')){return false;}
            
            uploadMovement('CREATE', containerId);
        });
        
        $('#update-report-btn').on("click", function(){
            var $grid = $("#npctMovementGrid"), selIds = $grid.jqGrid("getGridParam", "selarrrow"), i, n,
                cellValues = [];
            for (i = 0, n = selIds.length; i < n; i++) {
                cellValues.push($grid.jqGrid("getCell", selIds[i], "id"));
            }
            
            var containerId = cellValues.join(",");
            
            if(!containerId) {alert('Please Select Container');return false;}  
            
            if(!confirm('Apakah anda yakin akan mengupdate laporan movement?')){return false;}
            
            uploadMovement('UPDATE', containerId);
        });
        
        $('#cancel-report-btn').on("click", function(){
            var $grid = $("#npctMovementGrid"), selIds = $grid.jqGrid("getGridParam", "selarrrow"), i, n,
                cellValues = [];
            for (i = 0, n = selIds.length; i < n; i++) {
                cellValues.push($grid.jqGrid("getCell", selIds[i], "id"));
            }
            
            var containerId = cellValues.join(",");
            
            if(!containerId) {alert('Please Select Container');return false;}  
            
            if(!confirm('Apakah anda yakin akan membatalkan laporan movement?')){return false;}
            
            uploadMovement('CANCEL', containerId);
        });       
    });
    
</script>
<div class="box">
    <div id="alert" style="display: block;"></div>
    <div class="box-header with-border">
        <h3 class="box-title">Laporan Data Movement</h3>
        <div class="box-tools">
            <button class="btn btn-info btn-sm" id="create-report-btn"><i class="fa fa-plus"></i> Create</button>
            <button class="btn btn-warning btn-sm" id="update-report-btn"><i class="fa fa-repeat"></i> Update</button>
            <button class="btn btn-danger btn-sm" id="cancel-report-btn"><i class="fa fa-close"></i> Cancel</button>
        </div>
    </div>
    <div class="box-body table-responsive">
        {{
            GridRender::setGridId("npctMovementGrid")
            ->enableFilterToolbar()
            ->setGridOption('mtype', 'POST')
            ->setGridOption('url', URL::to('/npct/movement/grid-data?_token='.csrf_token()))
            ->setGridOption('rowNum', 20)
            ->setGridOption('shrinkToFit', true)
            ->setGridOption('multiselect', true)
            ->setGridOption('sortname','id')
            ->setGridOption('sortorder','DESC')
            ->setGridOption('rownumbers', true)
            ->setGridOption('rownumWidth', 50)
            ->setGridOption('height', '395')
            ->setGridOption('rowList',array(20,50,100))
            ->setGridOption('useColSpanStyle', true)
            ->setNavigatorOptions('navigator', array('viewtext'=>'view'))
            ->setNavigatorOptions('view',array('closeOnEscape'=>false))
            ->setFilterToolbarOptions(array('autosearch'=>true))
//                    ->setGridEvent('onSelectRow', 'onSelectRowEvent')
            ->setGridEvent('gridComplete', 'gridCompleteEvent')
            ->addColumn(array('key'=>true,'index'=>'id','hidden'=>true))
            ->addColumn(array('label'=>'Edit','index'=>'edit', 'width'=>60, 'search'=>false, 'sortable'=>false, 'align'=>'center'))
            ->addColumn(array('label'=>'Action','index'=>'action','width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Type','index'=>'message_type','width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'No. Container','index'=>'container_no','width'=>160,'editable' => true, 'editrules' => array('required' => true)))  
            ->addColumn(array('label'=>'No. PLP','index'=>'request_no','width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl. PLP','index'=>'request_date','width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'Kode Gudang','index'=>'warehouse_code','width'=>120,'align'=>'center')) 
            ->addColumn(array('label'=>'Action Time','index'=>'action_time','width'=>150,'align'=>'center'))
            ->addColumn(array('label'=>'Response','index'=>'response', 'width'=>150,'align'=>'center'))
            ->addColumn(array('label'=>'UID','index'=>'uid','align'=>'center', 'width'=>150))
            ->renderGrid()
        }}
    </div>
  
</div>

<div id="movement-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Edit Movement Date</h4>
            </div>
            <form id="create-invoice-form" class="form-horizontal" action="{{route("movement-update")}}" method="POST" enctype="multipart/form-data">
                <div class="modal-body"> 
                    <div class="row">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                        <input name="movement_id" type="hidden" id="movement_id">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Tgl. Movement</label>
                            <div class="col-sm-8">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" id="tgl_movement" name="tgl_movement" class="form-control pull-right datepicker" required>
                                </div>
                            </div>
                        </div>

                        <div class="bootstrap-timepicker">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Jam Movement</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" id="jam_movement" name="jam_movement" class="form-control timepicker" required>
                                        <div class="input-group-addon">
                                              <i class="fa fa-clock-o"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

@section('custom_css')

<!--<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" />-->
<link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/plugins/datepicker/datepicker3.css") }}">
<link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/plugins/timepicker/bootstrap-timepicker.min.css") }}">

@endsection

@section('custom_js')

<script src="{{ asset("/bower_components/AdminLTE/plugins/datepicker/bootstrap-datepicker.js") }}"></script>
<script src="{{ asset("/bower_components/AdminLTE/plugins/timepicker/bootstrap-timepicker.min.js") }}"></script>
<!--<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>-->
<script type="text/javascript">
//    $('.select2').select2();

    $('.datepicker').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'yyyy-mm-dd' 
    });
    $('.timepicker').timepicker({ 
        showMeridian: false,
        showInputs: false,
        showSeconds: true,
        minuteStep: 1,
        secondStep: 1
    });
    $(".timepicker").mask("99:99:99");
    $(".datepicker").mask("9999-99-99");
</script>

@endsection
