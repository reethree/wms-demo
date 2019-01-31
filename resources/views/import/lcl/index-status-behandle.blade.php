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
        var ids = jQuery("#lclBehandleGrid").jqGrid('getDataIDs'),
            apv = '', chk = '', info = '';   
            
        for(var i=0;i < ids.length;i++){ 
            var cl = ids[i];
            
            rowdata = $('#lclBehandleGrid').getRowData(cl); 
            
                if(rowdata.status_behandle == 'Ready') {
                    apv = '';
                    chk = '<button style="margin:5px;" class="btn btn-warning btn-xs" data-id="'+cl+'" onclick="if (confirm(\'Apakah anda yakin akan melakukan pengecekan ?\')){ changeStatusBehandle('+cl+',\'check\'); }else{return false;};"><i class="fa fa-check"></i> CHECKING</button>';
                }else if(rowdata.status_behandle == 'Checking') {
                    apv = '<button style="margin:5px;" class="btn btn-info btn-xs" data-id="'+cl+'" onclick="if (confirm(\'Apakah anda yakin telah selesai melakukan pengecekan ?\')){ changeStatusBehandle('+cl+',\'finish\'); }else{return false;};"><i class="fa fa-check"></i> FINISH</button>';
                    chk = '';
                }else if(rowdata.status_behandle == 'Finish') {
                    apv = '';
                    chk = '';
                }else{
                    apv = '';
                    chk = '';
                }  
            
            if(rowdata.status_behandle == 'Ready') {
                $("#" + cl).find("td").css("background-color", "#aae25a");
            }
            if(rowdata.status_behandle == 'Checking') {
                $("#" + cl).find("td").css("background-color", "#f4dc27");
            }
            if(rowdata.status_behandle == 'Finish') {
                $("#" + cl).find("td").css("background-color", "#6acaf7");
            }
            
            jQuery("#lclBehandleGrid").jqGrid('setRowData',ids[i],{action:apv+' '+chk});
            
        } 
    }
    
    function changeStatusBehandle($id,$action)
    {
        if($action == 'check'){
            $("#manifest_check_id").val($id);
            $('#check-modal').modal('show');
        }else{
            $("#manifest_finish_id").val($id);
            $('#finish-modal').modal('show');
        }
    }
</script>
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">LCL Status Behandle</h3>
<!--        <div class="box-tools">
            <a href="{{ route('lcl-manifest-create') }}" type="button" class="btn btn-block btn-info btn-sm"><i class="fa fa-plus"></i> Add New</a>
        </div>-->
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-12"> 
                {{
                    GridRender::setGridId("lclBehandleGrid")
                    ->enableFilterToolbar()
                    ->setGridOption('mtype', 'POST')
                    ->setGridOption('url', URL::to('/lcl/manifest/grid-data?module=status_behandle&_token='.csrf_token()))
                    ->setGridOption('rowNum', 100)
                    ->setGridOption('shrinkToFit', true)
                    ->setGridOption('sortname','TMANIFEST_PK')
                    ->setGridOption('rownumbers', true)
                    ->setGridOption('rownumWidth', 50)
                    ->setGridOption('height', '395')
                    ->setGridOption('rowList',array(100,200,300))
                    ->setGridOption('useColSpanStyle', true)
                    ->setNavigatorOptions('navigator', array('viewtext'=>'view'))
                    ->setNavigatorOptions('view',array('closeOnEscape'=>false))
                    ->setFilterToolbarOptions(array('autosearch'=>true))
                    ->setGridEvent('gridComplete', 'gridCompleteEvent')
//                    ->setGridEvent('onSelectRow', 'onSelectRowEvent')
                    ->addColumn(array('key'=>true,'index'=>'TMANIFEST_PK','hidden'=>true))
                    ->addColumn(array('label'=>'Action','index'=>'action', 'width'=>120, 'search'=>false, 'sortable'=>false, 'align'=>'center'))
                    ->addColumn(array('label'=>'Status Behandle','index'=>'status_behandle','width'=>120, 'align'=>'center'))
                    ->addColumn(array('label'=>'No. SPK','index'=>'NOJOBORDER', 'width'=>150,'hidden'=>false))
                    ->addColumn(array('label'=>'No. Container','index'=>'NOCONTAINER', 'width'=>150,'hidden'=>false))
                    ->addColumn(array('label'=>'No. MBL','index'=>'NOMBL','width'=>160))
                    ->addColumn(array('label'=>'Tgl. MBL','index'=>'TGL_MASTER_BL', 'width'=>150,'hidden'=>false, 'align'=>'center'))
                    ->addColumn(array('label'=>'No. HBL','index'=>'NOHBL','width'=>160))
                    ->addColumn(array('label'=>'Tgl. HBL','index'=>'TGL_HBL', 'width'=>150,'hidden'=>false, 'align'=>'center'))
                    ->addColumn(array('label'=>'No. Tally','index'=>'NOTALLY','width'=>160))
                    ->addColumn(array('label'=>'Consolidator','index'=>'NAMACONSOLIDATOR','width'=>250))
                    ->addColumn(array('label'=>'Consignee','index'=>'CONSIGNEE','width'=>250))
                    ->addColumn(array('label'=>'Weight','index'=>'WEIGHT', 'width'=>120, 'align'=>'right'))               
                    ->addColumn(array('label'=>'Meas','index'=>'MEAS', 'width'=>120, 'align'=>'right'))
                    ->addColumn(array('label'=>'Qty','index'=>'QUANTITY', 'width'=>80,'align'=>'center'))
                    ->addColumn(array('label'=>'Packing','index'=>'NAMAPACKING', 'width'=>120,'align'=>'center'))
                    ->addColumn(array('label'=>'Kode Kemas','index'=>'KODE_KEMAS', 'width'=>100,'align'=>'center'))
                    
                    ->addColumn(array('label'=>'No. SPJM','index'=>'NO_SPJM', 'width'=>120, 'align'=>'center','hidden'=>false))
                    ->addColumn(array('label'=>'Tgl. SPJM','index'=>'TGL_SPJM', 'width'=>150, 'align'=>'center','hidden'=>false))
                    ->addColumn(array('label'=>'Tgl. Behandle','index'=>'tglbehandle', 'width'=>120,'align'=>'center'))
                    ->addColumn(array('label'=>'Jam Behandle','index'=>'jambehandle', 'width'=>120,'align'=>'center'))
                    
                    
                    ->addColumn(array('label'=>'Shipper','index'=>'SHIPPER','width'=>230,'hidden'=>true))
                    ->addColumn(array('label'=>'Notify Party','index'=>'NOTIFYPARTY','width'=>160,'hidden'=>true))
                    
                    ->addColumn(array('label'=>'UID','index'=>'UID', 'width'=>150,'hidden'=>true))          
                    ->addColumn(array('index'=>'TSHIPPER_FK', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('index'=>'TCONSIGNEE_FK', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('index'=>'TNOTIFYPARTY_FK', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('index'=>'TPACKING_FK', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('label'=>'Marking','index'=>'MARKING', 'width'=>150,'hidden'=>true)) 
                    ->addColumn(array('label'=>'Desc of Goods','index'=>'DESCOFGOODS', 'width'=>150,'hidden'=>true))              
                    ->addColumn(array('label'=>'No.BC11','index'=>'NO_BC11', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('label'=>'Tgl.BC11','index'=>'TGL_BC11', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('label'=>'No.POS BC11','index'=>'NO_POS_BC11', 'width'=>150, 'align'=>'center'))
                    ->addColumn(array('label'=>'No.PLP','index'=>'NO_PLP', 'width'=>150,'hidden'=>true))                
                    ->addColumn(array('label'=>'Tgl.PLP','index'=>'TGL_PLP', 'width'=>150,'hidden'=>true))                
                    ->addColumn(array('label'=>'Surcharge (DG)','index'=>'DG_SURCHARGE', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('label'=>'Surcharge (Weight)','index'=>'WEIGHT_SURCHARGE', 'width'=>150,'hidden'=>true))         
                    ->addColumn(array('label'=>'Segel Merah','index'=>'flag_bc','width'=>80, 'align'=>'center'))
                    ->addColumn(array('label'=>'Tgl. Entry','index'=>'tglentry', 'width'=>120, 'align'=>'center'))
                    ->addColumn(array('label'=>'Jam. Entry','index'=>'jamentry', 'width'=>70,'hidden'=>true, 'align'=>'center'))
                    ->addColumn(array('label'=>'Updated','index'=>'last_update', 'width'=>150, 'search'=>false,'hidden'=>true))
                    ->renderGrid()
                }}
        </div>         
    </div>
</div>

<div id="check-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Checking Behandle</h4>
            </div>
            <form id="create-invoice-form" class="form-horizontal" action="{{ route('lcl-change-status-behandle') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-body"> 
                    <div class="row">
                        <div class="col-md-12">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                            <input name="id" type="hidden" id="manifest_check_id" />
                            <input name="status_behandle" type="hidden" id="status_behandle" value="Checking" />
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Keterangan</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="desc"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary">Checking</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="finish-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Finish Behandle</h4>
            </div>
            <form id="create-invoice-form" class="form-horizontal" action="{{ route('lcl-change-status-behandle') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-body"> 
                    <div class="row">
                        <div class="col-md-12">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                            <input name="id" type="hidden" id="manifest_finish_id" />
                            <input name="status_behandle" type="hidden" id="status_behandle" value="Finish" />
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Keterangan</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="desc"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary">Finish</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->    
    
@endsection