@extends('layout')

@section('content')
<style>
    .bootstrap-timepicker-widget {
        left: 27%;
    }
</style>
<script>
    
    function onSelectRowEvent()
    {
//        $('#btn-group-4').enableButtonGroup();
//        
//        rowid = $('#fclReleaseGrid').jqGrid('getGridParam', 'selrow');
//        rowdata = $('#fclReleaseGrid').getRowData(rowid);
//
//        $("#manifest_id").val(rowdata.TMANIFEST_PK);
    }
    
    $(document).ready(function()
    {
//        $('#release-form').disabledFormGroup();
//        $('#btn-toolbar').disabledButtonGroup();
        
        
        $('#btn-invoice').on("click", function(){
            
            
            var $grid = $("#fclReleaseGrid"), selIds = $grid.jqGrid("getGridParam", "selarrrow"), i, n,
                cellValues = [];
            for (i = 0, n = selIds.length; i < n; i++) {
                cellValues.push($grid.jqGrid("getCell", selIds[i], "TCONTAINER_PK"));
            }
            
            var containerId = cellValues.join(",");
            if(!containerId) {alert('Please Select Row');return false;}
            
            $('#create-invoice-modal').modal('show');
            
            $('#consignee_id').val($grid.jqGrid("getCell", selIds[0], "TCONSIGNEE_FK"));
            $('#consignee').val($grid.jqGrid("getCell", selIds[0], "CONSIGNEE"));
            $('#npwp').val($grid.jqGrid("getCell", selIds[0], "ID_CONSIGNEE"));
            $('#container_id_selected').val(containerId);
            
        });
        
        $('#create-invoice-form').on("submit", function(){
            if(!confirm('Apakah anda yakin?')){return false;}
        });
        
//        $('#btn-invoice').click(function() {
//            
//            var $grid = $("#fclReleaseGrid"), selIds = $grid.jqGrid("getGridParam", "selarrrow"), i, n,
//                cellValues = [];
//            for (i = 0, n = selIds.length; i < n; i++) {
//                cellValues.push($grid.jqGrid("getCell", selIds[i], "TCONTAINER_PK"));
//            }
////            console.log(cellValues.join(","));
//            
//            var containerId = cellValues.join(",");
//            
//            if(!containerId) {alert('Please Select Row');return false;}
//            
//            if(!confirm('Apakah anda yakin?')){return false;}
//            
//            //Gets the selected row id.
////            rowid = $('#fclReleaseGrid').jqGrid('getGridParam', 'selrow');
////            rowdata = $('#fclReleaseGrid').getRowData(rowid);
//            
//            var url = '{{ route("fcl-delivery-release-invoice-nct") }}';
//
//            $.ajax({
//                type: 'POST',
//                data: 
//                {
//                    'id' : containerId,
//                    '_token' : '{{ csrf_token() }}'
//                },
//                dataType : 'json',
//                url: url,
//                error: function (jqXHR, textStatus, errorThrown)
//                {
//                    alert('Something went wrong, please try again later.');
//                },
//                beforeSend:function()
//                {
//
//                },
//                success:function(json)
//                {
//                    console.log(json);
//
//                    if(json.success) {
//                      $('#alert-message').showAlertAfterElement('alert-success alert-custom', json.message, 5000);
//                    } else {
//                      $('#alert-message').showAlertAfterElement('alert-danger alert-custom', json.message, 5000);
//                    }
//
//                    //Triggers the "Close" button funcionality.
//                    $('#btn-refresh').click();
//                }
//            });
//            
//        });
        
    });
    
</script>

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">FCL Delivery Release</h3>
        <div class="box-tools" id="btn-toolbar">
            <div id="btn-group-4">
                <button class="btn btn-info btn-sm" id="btn-invoice"><i class="fa fa-print"></i> Create Invoice</button>
            </div>
        </div>
    </div>
    <div class="box-body">
        <div id="alert-message"></div>
        <div class="row">
            <div class="col-md-12"> 
                {{
                    GridRender::setGridId("fclReleaseGrid")
                    ->enableFilterToolbar()
                    ->setGridOption('mtype', 'POST')
                    ->setGridOption('url', URL::to('/container/grid-data-cy?module=release-invoice&_token='.csrf_token()))
                    ->setGridOption('rowNum', 20)
                    ->setGridOption('shrinkToFit', true)
                    ->setGridOption('sortname','TCONTAINER_PK')
                    ->setGridOption('rownumbers', true)
                    ->setGridOption('height', '350')
                    ->setGridOption('rowList',array(20,50,100))
                    ->setGridOption('useColSpanStyle', true)
                    ->setGridOption('multiselect', true)
                    ->setNavigatorOptions('navigator', array('viewtext'=>'view'))
                    ->setNavigatorOptions('view',array('closeOnEscape'=>false))
                    ->setFilterToolbarOptions(array('autosearch'=>true))
                    ->setGridEvent('onSelectRow', 'onSelectRowEvent')
                    ->addColumn(array('key'=>true,'index'=>'TCONTAINER_PK','hidden'=>true))
                    ->addColumn(array('label'=>'Vessel','index'=>'VESSEL','width'=>160))
                    ->addColumn(array('label'=>'VOY','index'=>'VOY','width'=>120,'align'=>'center'))
                    ->addColumn(array('label'=>'No. Container','index'=>'NOCONTAINER','width'=>160,'editable' => true, 'editrules' => array('required' => true)))
                    ->addColumn(array('label'=>'Size','index'=>'SIZE', 'width'=>80,'align'=>'center','editable' => true, 'editrules' => array('required' => true,'number'=>true),'edittype'=>'select','editoptions'=>array('value'=>"20:20;40:40")))
                    ->addColumn(array('label'=>'Teus','index'=>'TEUS', 'width'=>80,'align'=>'center','editable' => false))
                    ->addColumn(array('index'=>'TCONSIGNEE_FK','hidden'=>true))
                    ->addColumn(array('label'=>'Consignee','index'=>'CONSIGNEE','width'=>300))
                    ->addColumn(array('label'=>'ETA','index'=>'ETA', 'width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'Tgl. Keluar TPK','index'=>'TGLKELUAR_TPK', 'width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'Jam Keluar TPK','index'=>'JAMKELUAR_TPK', 'width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'No. SPK','index'=>'NoJob','width'=>160))
                    ->addColumn(array('label'=>'No. MBL','index'=>'NOMBL','width'=>160,'hidden'=>true))
                    ->addColumn(array('label'=>'Tgl. MBL','index'=>'TGLMBL','width'=>150,'align'=>'center','hidden'=>true))
                    ->addColumn(array('label'=>'Consolidator','index'=>'NAMACONSOLIDATOR','width'=>300))
                    ->addColumn(array('label'=>'Tgl. Behandle','index'=>'TGLBEHANDLE','width'=>150,'align'=>'center','hidden'=>true))
                    ->addColumn(array('label'=>'Jam. Behandle','index'=>'JAMBEHANDLE', 'width'=>150,'align'=>'center','hidden'=>true))
                    ->addColumn(array('label'=>'Tgl. Fiat','index'=>'TGLFIAT','width'=>150,'align'=>'center','hidden'=>true))
                    ->addColumn(array('label'=>'Jam. Fiat','index'=>'JAMFIAT', 'width'=>150,'align'=>'center','hidden'=>true))
                    ->addColumn(array('label'=>'Tgl. Surat Jalan','index'=>'TGLSURATJALAN','width'=>150,'align'=>'center','hidden'=>true))
                    ->addColumn(array('label'=>'Jam. Surat Jalan','index'=>'JAMSURATJALAN', 'width'=>150,'align'=>'center','hidden'=>true))
                    ->addColumn(array('label'=>'Tgl. Release','index'=>'TGLRELEASE','width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'Jam. Release','index'=>'JAMRELEASE', 'width'=>150,'align'=>'center','hidden'=>false))
                    ->addColumn(array('label'=>'No. BC11','index'=>'NO_BC11','width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'Tgl. BC11','index'=>'TGL_BC11','width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'Tgl. POS BC11','index'=>'NO_POS_BC11','width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'No. PLP','index'=>'NO_PLP','width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'Tgl. PLP','index'=>'TGL_PLP','width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'No. SPJM','index'=>'NO_SPJM', 'width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'Tgl. SPJM','index'=>'TGL_SPJM', 'width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'No. SPPB','index'=>'NO_SPPB', 'width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'Tgl. SPPB','index'=>'TGL_SPPB', 'width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'Kode Dokumen','index'=>'KODE_DOKUMEN', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('index'=>'KD_DOK_INOUT', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('label'=>'Kode Kuitansi','index'=>'NO_KUITANSI', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('label'=>'NPWP Consignee','index'=>'ID_CONSIGNEE','width'=>160,'hidden'=>true))
                    ->addColumn(array('label'=>'Importir','index'=>'NAMA_IMP','width'=>160,'hidden'=>true))
                    ->addColumn(array('label'=>'NPWP Importir','index'=>'NPWP_IMP','width'=>160,'hidden'=>true))
                    ->addColumn(array('label'=>'Alamat Importir','index'=>'ALAMAT_IMP','width'=>160,'hidden'=>true))
                    
                    ->addColumn(array('label'=>'No. Seal','index'=>'NOSEGEL', 'width'=>120,'editable' => true, 'align'=>'right'))
//                    ->addColumn(array('label'=>'Weight','index'=>'WEIGHT', 'width'=>120,'editable' => true, 'align'=>'right','editrules' => array('required' => true)))
//                    ->addColumn(array('label'=>'Measurment','index'=>'MEAS', 'width'=>120,'editable' => true, 'align'=>'right','editrules' => array('required' => true)))
                    ->addColumn(array('label'=>'Layout','index'=>'layout', 'width'=>80,'editable' => true,'align'=>'center','editoptions'=>array('defaultValue'=>"C-1")))
                    ->addColumn(array('label'=>'UID','index'=>'UID', 'width'=>150))
                    ->addColumn(array('label'=>'Nama EMKL','index'=>'NAMAEMKL', 'width'=>150,'hidden'=>true)) 
                    ->addColumn(array('label'=>'Telp. EMKL','index'=>'TELPEMKL', 'width'=>150,'hidden'=>true)) 
                    ->addColumn(array('label'=>'No. Truck','index'=>'NOPOL', 'width'=>150,'hidden'=>true)) 
                    ->addColumn(array('label'=>'No. POL','index'=>'NOPOLCIROUT', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('label'=>'No. POL Out','index'=>'NOPOL_OUT', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('label'=>'Ref. Number Out','index'=>'REF_NUMBER_OUT', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('label'=>'Tgl. Entry','index'=>'TGLENTRY', 'width'=>150, 'search'=>false))
                    ->addColumn(array('label'=>'Jam. Entry','index'=>'JAMENTRY', 'width'=>150, 'search'=>false, 'hidden'=>true))
                    ->addColumn(array('label'=>'Updated','index'=>'last_update', 'width'=>150, 'search'=>false))
                    ->renderGrid()
                }}
                
                <div id="btn-toolbar" class="section-header btn-toolbar" role="toolbar" style="margin: 10px 0;">

                </div>
            </div>
            
        </div>
    </div>
</div>

<div id="create-invoice-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Please Insert All Field</h4>
            </div>
            <form id="create-invoice-form" class="form-horizontal" action="{{ route("fcl-delivery-release-invoice-nct") }}" method="POST" enctype="multipart/form-data">
                <div class="modal-body"> 
                    <div class="row">
                        <div class="col-md-12">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                            <input name="id" type="hidden" id="container_id_selected" />
                            <input name="consignee_id" type="hidden" id="consignee_id" />
                            <div class="form-group">
                                <label class="col-sm-3 control-label">No. Invoice</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="no_invoice" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">No. Pajak</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="no_pajak" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">No. DO</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="no_do" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">No. B/L</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="no_bl" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Consignee</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="consignee" id="consignee" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">NPWP Consignee</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="npwp" id="npwp" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Alamat</label>
                                <div class="col-sm-6">
                                    <textarea class="form-control" name="alamat" id="alamat"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                  <button type="submit" class="btn btn-primary">Create Invoice</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection

@section('custom_css')

<!-- Bootstrap Switch -->
<!--<link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/plugins/bootstrap-switch/bootstrap-switch.min.css") }}">-->

<!--<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/plugins/datepicker/datepicker3.css") }}">
<link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/plugins/timepicker/bootstrap-timepicker.min.css") }}">-->

@endsection

@section('custom_js')

<!--<script src="{{ asset("/bower_components/AdminLTE/plugins/bootstrap-switch/bootstrap-switch.min.js") }}"></script>-->
<script type="text/javascript">
//    $.fn.bootstrapSwitch.defaults.size = 'mini';
//    $.fn.bootstrapSwitch.defaults.onColor = 'danger';
//    $.fn.bootstrapSwitch.defaults.onText = 'Yes';
//    $.fn.bootstrapSwitch.defaults.offText = 'No';
//    $("input[type='checkbox']").bootstrapSwitch();

    $("#npwp").mask("99.999.999.9-999.999");

</script>

@endsection