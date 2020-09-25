@extends('layout')

@section('content')
<style>
    .datepicker.dropdown-menu {
        z-index: 9999 !important;
    }
    th.ui-th-column div{
        white-space:normal !important;
        height:auto !important;
        padding:2px;
    }
</style>
<script>
    
    $(document).ready(function()
    {
        
        $('#btn-sp2').on("click", function(){

            var $grid = $("#fclContainerOutGrid"), selIds = $grid.jqGrid("getGridParam", "selarrrow"), i, n,
                cellValues = [];
            for (i = 0, n = selIds.length; i < n; i++) {
                cellValues.push($grid.jqGrid("getCell", selIds[i], "TCONTAINER_PK"));
            }
            
            var containerId = cellValues.join(",");
            if(!containerId) {alert('Please Select Row');return false;}
            
            $('#create-sp2-modal').modal('show');
            
            $('#consignee_id').val($grid.jqGrid("getCell", selIds[0], "TCONSIGNEE_FK"));
            $('#consignee').val($grid.jqGrid("getCell", selIds[0], "CONSIGNEE"));
            $('#npwp').val($grid.jqGrid("getCell", selIds[0], "ID_CONSIGNEE"));
            $('#container_id_selected').val(containerId);
            
        });
        
        $('#create-sp2-form').on("submit", function(){
            if(!confirm('Apakah anda yakin?')){return false;}
        });
        
    });
    
</script>
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"></h3>
        <div class="box-tools" id="btn-toolbar">
            <div id="btn-group-4">
                <button class="btn btn-info btn-sm" id="btn-sp2"><i class="fa fa-plus"></i> &nbsp;CREATE SP2</button>
            </div>
        </div>
    </div>
    <div class="box-body table-responsive">
        <div class="row" style="margin-bottom: 30px;margin-right: 0;">
            <div class="col-md-12">
                <form action="" method="GET">
                    <div class="col-xs-12">Search By Date</div>
                    <div class="col-xs-12">&nbsp;</div>
                    <div class="col-xs-3">
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" id="date" name="date" class="form-control pull-right datepicker" value="{{$date}}">
                        </div>
                    </div>
                    <div class="col-xs-2">
                        <button id="searchByDateBtn" class="btn btn-default" type="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>
        {{
            GridRender::setGridId("fclContainerOutGrid")
            ->enableFilterToolbar()
            ->setGridOption('filename', 'FCL_DailyReportContOut_'.Auth::getUser()->name)
            ->setGridOption('mtype', 'POST')
            ->setGridOption('url', URL::to('/container/grid-data-cy?report=1&date='.$date.'&type=out&_token='.csrf_token()))
            ->setGridOption('rowNum', 50)
            ->setGridOption('shrinkToFit', true)
            ->setGridOption('sortname','TCONTAINER_PK')
            ->setGridOption('sortorder','DESC')
            ->setGridOption('rownumbers', true)
            ->setGridOption('height', '300')
            ->setGridOption('rownumWidth', 50)
            ->setGridOption('multiselect', false)
            ->setGridOption('rowList',array(50,100,200))
            ->setGridOption('useColSpanStyle', true)
            ->setGridOption('multiselect', true)
            ->setNavigatorOptions('navigator', array('viewtext'=>'view'))
            ->setNavigatorOptions('view',array('closeOnEscape'=>false))
            ->setFilterToolbarOptions(array('autosearch'=>true))
            ->addColumn(array('key'=>true,'index'=>'TCONTAINER_PK','hidden'=>true))
            ->addColumn(array('label'=>'No. Container','index'=>'NOCONTAINER', 'width'=>150,'align'=>'center'))
            ->addColumn(array('label'=>'Size','index'=>'SIZE', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Type','index'=>'jenis_container','width'=>100,'align'=>'center'))  
            ->addColumn(array('label'=>'Ex Kapal','index'=>'VESSEL','width'=>160,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl. Tiba','index'=>'ETA', 'width'=>120,'align'=>'center','hidden'=>false))
            ->addColumn(array('label'=>'Tgl. OB','index'=>'TGLMASUK', 'width'=>120,'align'=>'center','hidden'=>false))
            ->addColumn(array('index'=>'TCONSIGNEE_FK','hidden'=>true))
            ->addColumn(array('label'=>'Consignee','index'=>'CONSIGNEE', 'width'=>350))
            ->addColumn(array('label'=>'NPWP Consignee','index'=>'ID_CONSIGNEE','width'=>160))
            ->addColumn(array('label'=>'No. PLP','index'=>'NO_PLP', 'width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl. PLP','index'=>'TGL_PLP', 'width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'Kode Dokumen','index'=>'KD_DOK_INOUT', 'width'=>120,'align'=>'center','hidden'=>true))
            ->addColumn(array('label'=>'Nama Dokumen','index'=>'KODE_DOKUMEN', 'width'=>120))
            ->addColumn(array('label'=>'No. Dokumen','index'=>'NO_SPPB', 'width'=>160,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl. Dokumen','index'=>'TGL_SPPB', 'width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'TPS Asal','index'=>'KD_TPS_ASAL', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'No.BC 1.1','index'=>'NO_BC11', 'width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl.BC 1.1','index'=>'TGL_BC11', 'width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'Jam Keluar','index'=>'JAMRELEASE', 'width'=>100,'align'=>'center'))
            ->renderGrid()
        }}
    </div>  
</div>

<div id="create-sp2-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Please Insert Optional Field</h4>
            </div>
            <form id="create-invoice-form" class="form-horizontal" action="{{ route("nle-sp2-create") }}" method="POST" enctype="multipart/form-data">
                <div class="modal-body"> 
                    <div class="row">
                        <div class="col-md-12">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                            <input name="id" type="hidden" id="container_id_selected" />
                            <input name="consignee_id" type="hidden" id="consignee_id" />
                            <div class="form-group">
                                <label class="col-sm-3 control-label">NLE Server</label>
                                <div class="col-sm-6">
                                    <select class="form-control select2" id="server" name="server" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                        <option value="dev" selected="">Development</option>
                                        <option value="prod">Production</option>                     
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Consignee</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="nm_cargoowner" id="consignee" readonly="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">NPWP Consignee</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="npwp_cargo_owner" id="npwp" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Paid Thrud Date</label>
                                <div class="col-sm-6">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" name="paid_thrud_date" class="form-control pull-right datepicker">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Proforma</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="proforma" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Proforma Date</label>
                                <div class="col-sm-6">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" name="proforma_date" class="form-control pull-right datepicker">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Price</label>
                                <div class="col-sm-6">
                                    <input type="number" class="form-control" name="price" />
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                  <button type="submit" class="btn btn-primary">Create SP2</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection

@section('custom_css')

<link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/plugins/datepicker/datepicker3.css") }}">

@endsection

@section('custom_js')

<script src="{{ asset("/bower_components/AdminLTE/plugins/datepicker/bootstrap-datepicker.js") }}"></script>
<script src="{{ asset("/assets/js/jquery.timeago.js") }}"></script>
<script src="{{ asset("/assets/js/jquery.timeago.id.js") }}"></script>
<script type="text/javascript">
    $('.datepicker').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'yyyy-mm-dd',
        zIndex: 99
    });
</script>

@endsection