@extends('layout')

@section('content')
<style>
    .bootstrap-timepicker-widget {
        left: 27%;
    }
</style>
<script>
    
    function gridCompleteEvent()
    {
        var ids = jQuery("#fclReleaseGrid").jqGrid('getDataIDs');   
            
        for(var i=0;i < ids.length;i++){ 
            var cl = ids[i];
            
            rowdata = $('#fclReleaseGrid').getRowData(cl);
            if(rowdata.VALIDASI == 'Y') {
                $("#" + cl).find("td").css("color", "#666");
            }
            if(rowdata.status_bc == 'HOLD') {
                $("#" + cl).find("td").css("background-color", "#ffe500");
            }
            if(rowdata.flag_bc == 'Y') {
                $("#" + cl).find("td").css("color", "#FF0000");
            } 
        } 
    }
    
    function onSelectRowEvent()
    {
        $('#btn-group-1,#btn-group-6').enableButtonGroup();
    }
    
    $(document).ready(function()
    {        
        $('#btn-movement').on("click", function(){
 
            var $grid = $("#fclReleaseGrid"), selIds = $grid.jqGrid("getGridParam", "selarrrow"), i, n,
                cellValues = [];
            for (i = 0, n = selIds.length; i < n; i++) {
                cellValues.push($grid.jqGrid("getCell", selIds[i], "TCONTAINER_PK"));
            }
            
            var containerId = cellValues.join(",");
            
            if(!containerId) {alert('Please Select Container');return false;}  
            
            if(!confirm('Apakah anda yakin?')){return false;}
            
            $.ajax({
                type: 'POST',
                data: {
                    container_id : containerId,
                    _token : '{{ csrf_token() }}'
                },
                dataType : 'json',
                url: '{{route("movement-container-create")}}',
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
                }
            });
            
        });
    });
    
</script>

<div class="box">
    <div id="alert" style="display: block;"></div>
    <div class="box-header with-border">
        <h3 class="box-title">Data Container Release</h3>
        <div class="box-tools" id="btn-toolbar">
            <div id="btn-group-4">
                <button class="btn btn-info btn-sm" id="btn-movement"><i class="fa fa-print"></i> Create Movement</button>
            </div>
        </div>
        
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-12"> 
                {{
                    GridRender::setGridId("fclReleaseGrid")
                    ->enableFilterToolbar()
                    ->setGridOption('mtype', 'POST')
                    ->setGridOption('url', URL::to('/container/grid-data-cy?module=release_movement&_token='.csrf_token()))
                    ->setGridOption('rowNum', 20)
                    ->setGridOption('shrinkToFit', true)
                    ->setGridOption('multiselect', true)
                    ->setGridOption('sortname','TCONTAINER_PK')
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
//                    ->setGridEvent('gridComplete', 'gridCompleteEvent')
                    ->addColumn(array('key'=>true,'index'=>'TCONTAINER_PK','hidden'=>true))
                    ->addColumn(array('label'=>'No. Container','index'=>'NOCONTAINER','width'=>160,'editable' => true, 'editrules' => array('required' => true)))  
                    ->addColumn(array('label'=>'Size','index'=>'SIZE', 'width'=>60,'align'=>'center','editable' => true, 'editrules' => array('required' => true,'number'=>true),'edittype'=>'select','editoptions'=>array('value'=>"20:20;40:40")))
                    ->addColumn(array('label'=>'No. BL/AWB','index'=>'NO_BL_AWB', 'width'=>120,'align'=>'center'))
                    ->addColumn(array('label'=>'Tgl. BL/AWB','index'=>'TGL_BL_AWB', 'width'=>120,'align'=>'center'))
                    ->addColumn(array('label'=>'Consignee','index'=>'CONSIGNEE','width'=>250))
                    ->addColumn(array('label'=>'NPWP Consignee','index'=>'ID_CONSIGNEE','width'=>160,'hidden'=>true))
                    ->addColumn(array('label'=>'Consolidator','index'=>'NAMACONSOLIDATOR','width'=>250))
                    ->addColumn(array('label'=>'No. BC11','index'=>'NO_BC11','width'=>100,'align'=>'center'))
                    ->addColumn(array('label'=>'Tgl. BC11','index'=>'TGL_BC11','width'=>120,'align'=>'center'))
                    ->addColumn(array('label'=>'Tgl. POS BC11','index'=>'NO_POS_BC11','width'=>120,'align'=>'center'))
                    ->addColumn(array('label'=>'No. PLP','index'=>'NO_PLP','width'=>100,'align'=>'center'))
                    ->addColumn(array('label'=>'Tgl. PLP','index'=>'TGL_PLP','width'=>120,'align'=>'center'))
                    ->addColumn(array('label'=>'ETA','index'=>'ETA', 'width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'Tgl. Keluar TPK','index'=>'TGLKELUAR_TPK','width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'Jam. Keluar TPK','index'=>'JAMKELUAR_TPK', 'width'=>120,'align'=>'center'))
                    ->addColumn(array('label'=>'Tgl. Masuk','index'=>'TGLMASUK','width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'Jam. Masuk','index'=>'JAMMASUK', 'width'=>120,'align'=>'center'))
                    ->addColumn(array('label'=>'Tgl. Release','index'=>'TGLRELEASE','width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'Jam. Release','index'=>'JAMRELEASE', 'width'=>120,'align'=>'center'))
                    ->addColumn(array('label'=>'UID','index'=>'UID','align'=>'center', 'width'=>150))
                    ->renderGrid()
                }}

            </div>           
        </div>        
    </div>
</div>

@endsection

@section('custom_css')

<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/plugins/datepicker/datepicker3.css") }}">
<link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/plugins/timepicker/bootstrap-timepicker.min.css") }}">

@endsection

@section('custom_js')

<script src="{{ asset("/bower_components/AdminLTE/plugins/datepicker/bootstrap-datepicker.js") }}"></script>
<script src="{{ asset("/bower_components/AdminLTE/plugins/timepicker/bootstrap-timepicker.min.js") }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
<script type="text/javascript">
    $('.select2').select2();

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
