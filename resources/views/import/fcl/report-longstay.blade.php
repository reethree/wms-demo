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
        var ids = jQuery("#fcllongstayGrid").jqGrid('getDataIDs'),
            apv = '', sgl = '';   
            
        for(var i=0;i < ids.length;i++){ 
            var cl = ids[i];
            
            rowdata = $('#fcllongstayGrid').getRowData(cl); 
            
            @role('p2')
            if(rowdata.flag_bc == 'Y') {
                sgl = '<button style="margin:5px;" class="btn btn-info btn-xs" data-id="'+cl+'" onclick="if (confirm(\'Apakah anda yakin ingin membuka Segel Merah ?\')){ changeStatusFlag('+cl+',\'unlock\'); }else{return false;};"><i class="fa fa-unlock"></i> UNLOCK</button>';
            }else{
                sgl = '<button style="margin:5px;" class="btn btn-info btn-xs" data-id="'+cl+'" onclick="if (confirm(\'Apakah anda yakin ingin mengunci Segel Merah ?\')){ changeStatusFlag('+cl+',\'lock\'); }else{return false;};"><i class="fa fa-lock"></i> LOCK</button>';
            }
            @else
            if(rowdata.status_bc == 'HOLD') {
                apv = '<button style="margin:5px;" class="btn btn-danger btn-xs" data-id="'+cl+'" onclick="if (confirm(\'Are You Sure to change status HOLD to RELEASE ?\')){ changeStatus('+cl+'); }else{return false;};"><i class="fa fa-check"></i> RELEASE</button>';
            }else{
                apv = '';
            }    
            @endrole
            
            if(rowdata.flag_bc == 'Y') {
                $("#" + cl).find("td").css("background-color", "#FF0000");
            } 
            if(rowdata.status_bc == 'HOLD') {
                $("#" + cl).find("td").css("background-color", "#ffe500");
            }
            
            jQuery("#fcllongstayGrid").jqGrid('setRowData',ids[i],{action:apv+' '+sgl});
            
        } 
    }
    
    function changeStatus($id)
    {
        $.ajax({
            type: 'GET',
            dataType : 'json',
            url: "{{ route('fcl-change-status','') }}/"+$id,
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Something went wrong, please try again later.');
            },
            beforeSend:function()
            {

            },
            success:function(json)
            {
                if(json.success) {
                    $('#btn-toolbar').showAlertAfterElement('alert-success alert-custom', json.message, 5000);
                    $('#fcllongstayGrid').jqGrid().trigger("reloadGrid");
                } else {
                    $('#btn-toolbar').showAlertAfterElement('alert-danger alert-custom', json.message, 5000);
                }

                //Triggers the "Refresh" button funcionality.
                $('#btn-refresh').click();
            }
        });
    }
    
    function changeStatusFlag($id,$action)
    {
        if($action == 'lock'){
            $("#container_id").val($id);
            $('#lock-flag-modal').modal('show');
        }else{
            $("#container_unlock_id").val($id);
            $('#unlock-flag-modal').modal('show');
//            $.ajax({
//                type: 'GET',
//                dataType : 'json',
//                url: "{{ route('fcl-change-status-flag','') }}/"+$id,
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
//                    if(json.success) {
//                        $('#btn-toolbar').showAlertAfterElement('alert-success alert-custom', json.message, 5000);
//                        $('#fcllongstayGrid').jqGrid().trigger("reloadGrid");
//                    } else {
//                        $('#btn-toolbar').showAlertAfterElement('alert-danger alert-custom', json.message, 5000);
//                    }
//
//                    //Triggers the "Refresh" button funcionality.
//                    $('#btn-refresh').click();
//                }
//            });
        }
    }
    
</script>
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">FCL Inventory</h3>
    </div>
    <div class="box-body table-responsive">
        <div class="row" style="margin-bottom: 30px;margin-right: 0;">
            <div class="col-md-8">
                <div class="col-xs-12">Search By Date</div>
                <div class="col-xs-12">&nbsp;</div>
                <div class="col-xs-3">
                    <select class="form-control select2" id="by" name="by" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option value="ETA">Tgl. ETA</option>
                        <option value="TGLMASUK">Tgl. GateIn</option>
                        <option value="TGL_BC11">Tgl. BC1.1</option> 
                    </select>
                </div>
                <div class="col-xs-3">
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" id="startdate" class="form-control pull-right datepicker">
                    </div>
                </div>
                <div class="col-xs-1">
                    s/d
                </div>
                <div class="col-xs-3">
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" id="enddate" class="form-control pull-right datepicker">
                    </div>
                </div>
                <div class="col-xs-2">
                    <button id="searchByDateBtn" class="btn btn-default">Search</button>
                </div>
            </div>
        </div>
        <div id="btn-toolbar" class="section-header btn-toolbar" role="toolbar" style="margin: 10px 0;"></div>
        {{
            GridRender::setGridId("fcllongstayGrid")
            ->enableFilterToolbar()
            ->setGridOption('mtype', 'POST')
            ->setGridOption('url', URL::to('/container/grid-data-cy?module=longstay&report=1&_token='.csrf_token()))
            ->setGridOption('rowNum', 20)
            ->setGridOption('shrinkToFit', true)
            ->setGridOption('sortname','TCONTAINER_PK')
            ->setGridOption('rownumbers', true)
            ->setGridOption('rownumWidth', 50)
            ->setGridOption('height', '395')
            ->setGridOption('rowList',array(20,50,100))
            ->setGridOption('useColSpanStyle', true)
            ->setNavigatorOptions('navigator', array('viewtext'=>'view'))
            ->setNavigatorOptions('view',array('closeOnEscape'=>false))
            ->setFilterToolbarOptions(array('autosearch'=>true))
//            ->setGridEvent('onSelectRow', 'onSelectRowEvent')
            ->setGridEvent('gridComplete', 'gridCompleteEvent')
            ->addColumn(array('key'=>true,'index'=>'TCONTAINER_PK','hidden'=>true))
            ->addColumn(array('label'=>'Action','index'=>'action', 'width'=>120, 'search'=>false, 'sortable'=>false, 'align'=>'center'))
            ->addColumn(array('label'=>'Segel Merah','index'=>'flag_bc','width'=>100, 'align'=>'center'))
            ->addColumn(array('label'=>'Status BC','index'=>'status_bc','width'=>100, 'align'=>'center'))
            ->addColumn(array('label'=>'Nama Dokumen','index'=>'KODE_DOKUMEN', 'width'=>130))
            ->addColumn(array('label'=>'No. SPK','index'=>'NoJob', 'width'=>150))
            ->addColumn(array('label'=>'No. Container','index'=>'NOCONTAINER', 'width'=>150,'align'=>'center'))
            ->addColumn(array('label'=>'Size','index'=>'SIZE', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Nama Angkut','index'=>'VESSEL','width'=>160))  
            ->addColumn(array('label'=>'VOY','index'=>'VOY','width'=>100,'align'=>'center','hidden'=>false))
            ->addColumn(array('label'=>'Call Sign','index'=>'CALLSIGN','width'=>100,'align'=>'center','hidden'=>false))
            ->addColumn(array('label'=>'ETA','index'=>'ETA', 'width'=>120,'align'=>'center','hidden'=>false))
            ->addColumn(array('label'=>'TPS Asal','index'=>'KD_TPS_ASAL', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Consolidator','index'=>'NAMACONSOLIDATOR','width'=>250,'hidden'=>true))
            ->addColumn(array('label'=>'Consignee','index'=>'CONSIGNEE', 'width'=>250))
            ->addColumn(array('label'=>'No.PLP','index'=>'NO_PLP', 'width'=>120,'align'=>'center'))                
            ->addColumn(array('label'=>'Tgl.PLP','index'=>'TGL_PLP', 'width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'No.BC 1.1','index'=>'NO_BC11', 'width'=>150,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl.BC 1.1','index'=>'TGL_BC11', 'width'=>150,'align'=>'center'))
            ->addColumn(array('label'=>'No.POS BC11','index'=>'NO_POS_BC11', 'width'=>150,'align'=>'center'))
            ->addColumn(array('label'=>'Tgl. Gate In','index'=>'TGLMASUK', 'width'=>120,'align'=>'center'))
            ->addColumn(array('label'=>'Jam. Gate In','index'=>'JAMMASUK', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'No.POL IN','index'=>'NOPOL', 'width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'No. Segel','index'=>'no_flag_bc','width'=>100,'align'=>'center'))
            ->addColumn(array('label'=>'Alasan Segel','index'=>'alasan_segel','width'=>150,'align'=>'center'))
            ->addColumn(array('label'=>'Lama Timbun (Hari)','index'=>'timeSinceUpdate', 'width'=>150, 'search'=>false, 'align'=>'center'))
            ->renderGrid()
        }}
    </div>
</div>

<div id="lock-flag-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Silahkan pilih alasan segel</h4>
            </div>
            <form id="create-invoice-form" class="form-horizontal" action="{{ route('fcl-lock-flag') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-body"> 
                    <div class="row">
                        <div class="col-md-12">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                            <input name="id" type="hidden" id="container_id" />
                            <div class="form-group">
                                <label class="col-sm-3 control-label">No. Segel</label>
                                <div class="col-sm-8">
                                    <input type="text" id="no_flag_bc" name="no_flag_bc" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Alasan Segel</label>
                                <div class="col-sm-8">
                                    <select class="form-control select2" id="alasan_segel" name="alasan_segel" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                        <option value="Nota Hasil Intelijen (NHI)" selected>Nota Hasil Intelijen (NHI)</option>
                                        <option value="Surveilance P2">Surveilance P2</option>
                                        <option value="P2 Pusat">P2 Pusat</option>
                                        <option value="SPBL">SPBL</option>
                                        <option value="IKP / Temuan Lapangan">IKP / Temuan Lapangan</option>
                                        <option value="Eks. Pemeriksaan Fisik">Eks. Pemeriksaan Fisik</option>
                                        <option value="Hico Scan">Hico Scan</option>
                                        <option value="Eks. Ambil Contoh">Eks. Ambil Contoh</option>
                                        <option value="CNT">CNT</option>
                                        <option value="Penegahan">Penegahan</option>
                                        <option value="Nota Pemberitahuan Barang Lartas (PFPD)">Nota Pemberitahuan Barang Lartas (PFPD)</option>
                                        <option value="Selisih Bongkar">Selisih Bongkar</option>
                                        <option value="Seal Pelayaran Hilang">Seal Pelayaran Hilang</option>
                                        <option value="Stripping MMEA">Stripping MMEA</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Keterangan</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="description_flag_bc"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary">Lock</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="unlock-flag-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Silahkan pilih alasan lepas segel</h4>
            </div>
            <form id="create-invoice-form" class="form-horizontal" action="{{ route('fcl-unlock-flag') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-body"> 
                    <div class="row">
                        <div class="col-md-12">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                            <input name="id" type="hidden" id="container_unlock_id" />
<!--                            <div class="form-group">
                                <label class="col-sm-3 control-label">No. Segel</label>
                                <div class="col-sm-8">
                                    <input type="text" id="no_flag_bc" name="no_flag_bc" class="form-control" required>
                                </div>
                            </div>-->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Alasan Lepas Segel</label>
                                <div class="col-sm-8">
                                    <select class="form-control select2" id="alasan_lepas_segel" name="alasan_lepas_segel" style="width: 100%;" tabindex="-1" aria-hidden="true" required>                                        
                                        <option value="SPBL">SPPB</option>
                                        <option value="SPPBE">SPPBE</option>
                                        <option value="Re Ekspor">Re Ekspor</option>
                                        <option value="Pemusnahan">Pemusnahan</option>
                                        <option value="Lelang">Lelang</option>
                                        <option value="Serah Terima">Serah Terima</option>
                                        <option value="Surveilance">Surveilance</option>
                                        <option value="Selesai Hico">Selesai Hico</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>
                            </div>
<!--                            <div class="form-group">
                                <label class="col-sm-3 control-label">Keterangan</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="description_flag_bc"></textarea>
                                </div>
                            </div>-->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary">Unlock</button>
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
<script type="text/javascript">
    $('.datepicker').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'yyyy-mm-dd',
        zIndex: 99
    });
    
//    $('#alasan_segel').on("change", function(){
//        var val = $(this).val();
//        console.log($(this).val());
//        if(val == 'Lainnya'){
//            $("#alasan_lainnya").show();
//            $("textarea[name='alasan_lainnya']").attr("required", "required");
//        }else{
//            $("#alasan_lainnya").hide();
//            $("textarea[name='alasan_lainnya']").removeAttr("required");
//        }
//    });
    
    $('#searchByDateBtn').on("click", function(){
        var by = $("#by").val();
        var startdate = $("#startdate").val();
        var enddate = $("#enddate").val();
        var string_filters = '';
        var filters = '{"groupOp":"AND","rules":[{"field":"'+by+'","op":"ge","data":"'+startdate+'"},{"field":"'+by+'","op":"le","data":"'+enddate+'"}]}';

        var current_filters = jQuery("#fcllongstayGrid").getGridParam("postData").filters;
        
        if (current_filters) {
            var get_filters = $.parseJSON(current_filters);
            if (get_filters.rules !== undefined && get_filters.rules.length > 0) {

                var tempData = get_filters.rules;
                
                tempData.push( { "field":by,"op":"ge","data":startdate } );
                tempData.push( { "field":by,"op":"le","data":enddate } );
                
                string_filters = JSON.stringify(tempData);
                
                filters = '{"groupOp":"AND","rules":'+string_filters+'}';
            }
        }

        jQuery("#fcllongstayGrid").jqGrid("setGridParam", { postData: {filters} }).trigger("reloadGrid");
        
        return false;
    });
</script>

@endsection