@extends('layout')

@section('content')
<style>
    .bootstrap-timepicker-widget {
        left: 27%;
    }
</style>
<script>
    
    var arrtSetting = function (rowId, val, rawObject, cm) {
        var attr = rawObject.NO_CONT, result;
        if (attr.rowspan) {
            result = ' rowspan=' + '"' + attr.rowspan + '"';
        } else if (attr.display) {
            result = ' style="display:' + attr.display + '"';
        }
        return result;
    };
    
    function gridCompleteEvent()
    {
        var ids = jQuery("#lclDispatcheGrid").jqGrid('getDataIDs'),
            apv = '',
            upl = '';    
            
        for(var i=0;i < ids.length;i++){ 
            var cl = ids[i];
            
            rowdata = $('#lclDispatcheGrid').getRowData(cl);
            if(rowdata.STATUS_DISPATCHE == 'S') {
                apv = '<button style="margin:5px;" class="btn btn-info btn-xs approve-manifest-btn" data-id="'+cl+'" onclick="viewStatusDispatche('+cl+')"><i class="fa fa-check"></i> View</button>';
                upl = '<button style="margin:5px;" class="btn btn-warning btn-xs approve-manifest-btn" data-id="'+cl+'" onclick="if (confirm(\'Are You Sure ?\')){uploadDispatche('+cl+'); }else{return false;};"><i class="fa fa-upload"></i> Upload</button>';
            }else if(rowdata.STATUS_DISPATCHE == 'Y') {
                apv = '<button style="margin:5px;" class="btn btn-info btn-xs approve-manifest-btn" data-id="'+cl+'" onclick="viewStatusDispatche('+cl+');"><i class="fa fa-check"></i> View</button>';
                upl = '';
                $("#" + cl).find("td").css("color", "#999999");
            } else {
                apv = '<button style="margin:5px;" class="btn btn-danger btn-xs approve-manifest-btn" disabled><i class="fa fa-close"></i></button>';
                upl = '';
//                $("#" + cl).find("td").css("color", "#999999");
            }
            jQuery("#lclDispatcheGrid").jqGrid('setRowData',ids[i],{action:apv+' '+upl}); 
        } 
    }
    
    function uploadDispatche($ob_id)
    {
        $.ajax({
            type: 'POST',
            data: {
                _token : '{{ csrf_token() }}',
                ob_id : $ob_id
            },
            dataType : 'json',
            url: '{{ route("easygo-inputdo") }}',
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
                  $('#btn-toolbar').showAlertAfterElement('alert-success alert-custom', json.message, 5000);
                } else {
                  $('#btn-toolbar').showAlertAfterElement('alert-danger alert-custom', json.message, 5000);
                }

                //Triggers the "Close" button funcionality.
                $('#btn-refresh').click();
            }
        });
    }
    
    function viewStatusDispatche($ob_id)
    {
//        alert('view:'+$ob_id);
        
        if($ob_id){
            $('#view-dispatche-modal').modal('show');
        }else{
            alert('Not Found.');
            return false;
        }
        
        $.ajax({
            type: 'GET',
            dataType : 'json',
            url: '{{ route("easygo-get-detail","") }}/'+$ob_id,
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Something went wrong, please try again later.');
            },
            beforeSend:function()
            {

            },
            success:function(json)
            {
                if(json.id) {
                    $("#detail_do_id").html(json.DO_ID);
                    $("#detail_esealcode").html(json.ESEALCODE)
                    $("#detail_no_pol").html(json.NOPOL);
                    $("#detail_no_cont").html(json.NOCONTAINER);
                    $("#detail_no_plp").html(json.NO_PLP);
                    $("#detail_tgl_plp").html(json.TGL_PLP)
                    $("#detail_tps_asal").html(json.KD_TPS_ASAL);
                    $("#detail_tps_tujuan").html(json.KD_TPS_TUJUAN);
                    $("#detail_tgl_dispatche").html(json.TGL_DISPATCHE+' '+json.JAM_DISPATCHE);
                    $("#detail_address").html(json.Address);
                    $("#detail_lat_lon").html(json.Lat+'/'+json.Lon);
                    $("#detail_gps_time").html(json.GPS_TIME);
                    $("#detail_kode").html(json.KODE_DISPATCHE);
                    $("#detail_response").html(json.RESPONSE_DISPATCHE);
                    $("#detail_status").html(json.STATUS_DISPATCHE);
                    $("#detail_status_do").html(json.Status_DO);
                   
                } else {
                    $('#btn-toolbar').showAlertAfterElement('alert-danger alert-custom', json.message, 5000);
                }

                //Triggers the "Refresh" button funcionality.
                $('#btn-refresh').click();
            }
        });
    }
    
    function onSelectRowEvent()
    {
        $('#btn-group-1, #btn-group-4, #btn-group-5').enableButtonGroup();
    }
    
    $(document).ready(function()
    {
        $('#dispatche-form').disabledFormGroup();
        $('#btn-toolbar').disabledButtonGroup();
        $('#btn-group-3').enableButtonGroup();
        
        $('#btn-edit').click(function() {
            //Gets the selected row id.
            rowid = $('#lclDispatcheGrid').jqGrid('getGridParam', 'selrow');
            rowdata = $('#lclDispatcheGrid').getRowData(rowid);

            populateFormFields(rowdata, '');
            $('#ob_id').val(rowid);
            $('#NO_PLP').val(rowdata.NO_PLP);
            $('#TGL_PLP').val(rowdata.TGL_PLP);
            $('#NO_CONT').val(rowdata.NO_CONT);
            $('#UK_CONT').val(rowdata.UK_CONT);
            $('#TGL_TIBA').val(rowdata.TGL_TIBA);
            $('#NO_VOY_FLIGHT').val(rowdata.NO_VOY_FLIGHT);
            $('#NM_ANGKUT').val(rowdata.NM_ANGKUT);
            $('#KD_TPS_ASAL').val(rowdata.KD_TPS_ASAL);
            $('#ESEALCODE').val(rowdata.ESEALCODE).trigger('change');
            $('#RESPONSE_DISPATCHE').val(rowdata.RESPONSE_DISPATCHE);
            $('#STATUS_DISPATCHE').val(rowdata.STATUS_DISPATCHE);
            $('#KODE_DISPATCHE').val(rowdata.KODE_DISPATCHE);
            $('#DO_ID').val(rowdata.DO_ID);

//            if(!rowdata.TGLRELEASE && !rowdata.JAMRELEASE) {
                $('#btn-group-2').enableButtonGroup();
                $('#dispatche-form').enableFormGroup();
//            }else{
//                $('#btn-group-2').disabledButtonGroup();
//                $('#dispatche-form').disabledFormGroup();
//            }

        });
        
        $('#btn-print').click(function() {
            
        });
        
        $('#btn-upload').click(function() {
            if(!confirm('Apakah anda yakin?')){return false;}
            
            if($('#NO_PLP').val() == ''){
                alert('No. PLP masih kosong!');
                return false;
            }else if($('#TGL_PLP').val() == ''){
                alert('Tgl. PLP masih kosong!');
                return false;
            }else if($('#ESEALCODE').val() == ''){
                alert('E-Seal masih kosong!');
                return false;
            }else if($('#NOPOL').val() == ''){
                alert('No. POL masih kosong!');
                return false;
            }
            
            $.ajax({
                type: 'POST',
                data: JSON.stringify($('#dispatche-form').formToObject('')),
                dataType : 'json',
                url: '{{ route("easygo-inputdo") }}',
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
                      $('#btn-toolbar').showAlertAfterElement('alert-success alert-custom', json.message, 5000);
                    } else {
                      $('#btn-toolbar').showAlertAfterElement('alert-danger alert-custom', json.message, 5000);
                    }

                    //Triggers the "Close" button funcionality.
                    $('#btn-refresh').click();
                }
            });
            
        });

        $('#btn-save').click(function() {
            
            if(!confirm('Apakah anda yakin?')){return false;}
            
            var containerId = $('#ob_id').val();
            var url = "{{route('lcl-dispatche-update','')}}/"+containerId;

            $.ajax({
                type: 'POST',
                data: JSON.stringify($('#dispatche-form').formToObject('')),
                dataType : 'json',
                url: url,
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
                      $('#btn-toolbar').showAlertAfterElement('alert-success alert-custom', json.message, 5000);
                    } else {
                      $('#btn-toolbar').showAlertAfterElement('alert-danger alert-custom', json.message, 5000);
                    }

                    //Triggers the "Close" button funcionality.
                    $('#btn-refresh').click();
                }
            });
        });
        
        $('#btn-cancel').click(function() {
            $('#btn-refresh').click();
        });
        
        $('#btn-refresh').click(function() {
            $('#lclDispatcheGrid').jqGrid().trigger("reloadGrid");
            $('#dispatche-form').disabledFormGroup();
            $('#btn-toolbar').disabledButtonGroup();
            $('#btn-group-3').enableButtonGroup();
            
            $('#dispatche-form')[0].reset();
            $('.select2').val(null).trigger("change");
            $('#TMANIFEST_PK').val("");
        });
        
    });
    
</script>

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">LCL Dispatche E-Seal</h3>
    </div>
    <div class="box-body">
        <div class="row" style="margin-bottom: 30px;">
            <div class="col-md-12"> 
                {{
                    GridRender::setGridId("lclDispatcheGrid")
//                    ->setGridAsPivot()
                    ->enableFilterToolbar()
                    ->setGridOption('mtype', 'POST')
                    ->setGridOption('url', URL::to('/tpsonline/penerimaan/ob-lcl/grid-data?jenis=L&group=1&_token='.csrf_token()))
                    ->setGridOption('rowNum', 20)
                    ->setGridOption('shrinkToFit', true)
                    ->setGridOption('sortname','TPSOBXML_PK')
                    ->setGridOption('rownumbers', true)
                    ->setGridOption('height', '295')
                    ->setGridOption('rowList',array(20,50,100))
                    ->setGridOption('useColSpanStyle', true)
                    ->setGridOption('grouping', true)
                    ->setGridOption('groupingView', array('groupField'=>['NO_CONT']))
                    ->setNavigatorOptions('navigator', array('viewtext'=>'view'))
                    ->setNavigatorOptions('view',array('closeOnEscape'=>false))
                    ->setFilterToolbarOptions(array('autosearch'=>true))
                    ->setGridEvent('onSelectRow', 'onSelectRowEvent')
                    ->setGridEvent('gridComplete', 'gridCompleteEvent')
                    ->addColumn(array('key'=>true,'index'=>'TPSOBXML_PK','hidden'=>true))
                    ->addColumn(array('label'=>'Action','index'=>'action', 'width'=>160, 'search'=>false, 'sortable'=>false, 'align'=>'center'))
                    ->addColumn(array('label'=>'No. Container','index'=>'NO_CONT','width'=>200, 'cellattr'=>'arrtSetting'))
                    ->addColumn(array('label'=>'Ukuran Cont.','index'=>'UK_CONT','width'=>120,'align'=>'center'))		
                    ->addColumn(array('label'=>'No. Segel','index'=>'NO_SEGEL','width'=>160,'align'=>'center','hidden'=>true))	
                    ->addColumn(array('label'=>'Janis Cont.','index'=>'JNS_CONT','width'=>80,'align'=>'center','align'=>'center'))
                    ->addColumn(array('index'=>'DO_ID','width'=>160,'hidden'=>false))
                    ->addColumn(array('index'=>'STATUS_DISPATCHE','width'=>160,'hidden'=>true))
                    ->addColumn(array('index'=>'KODE_DISPATCHE','width'=>160,'hidden'=>false))
                    ->addColumn(array('index'=>'RESPONSE_DISPATCHE','width'=>160,'hidden'=>false))
                    ->addColumn(array('index'=>'WAKTU_DISPATCHE','width'=>180,'align'=>'center'))
                    ->addColumn(array('index'=>'ID_CONSIGNEE','width'=>160,'hidden'=>true))		
                    ->addColumn(array('label'=>'Consignee','index'=>'CONSIGNEE','width'=>350))
                    ->addColumn(array('label'=>'Ref Number','index'=>'REF_NUMBER','width'=>160,'hidden'=>true))			
                    ->addColumn(array('label'=>'No. Surat PLP','index'=>'NO_SURAT_PLP','width'=>250,'hidden'=>true))			
                    ->addColumn(array('label'=>'Tgl. Surat PLP','index'=>'TGL_SURAT_PLP','width'=>160,'align'=>'center','hidden'=>true))			
                    ->addColumn(array('label'=>'Kode Kantor','index'=>'KD_KANTOR','width'=>160,'align'=>'center','hidden'=>true))			
                    ->addColumn(array('label'=>'Kode Dokumen','index'=>'KD_DOK','width'=>160,'hidden'=>true))			
                    ->addColumn(array('label'=>'No. PLP','index'=>'NO_PLP','width'=>160,'align'=>'center'))			
                    ->addColumn(array('label'=>'Tgl. PLP','index'=>'TGL_PLP','width'=>160,'align'=>'center'))			
                    ->addColumn(array('label'=>'Kode TPS Asal','index'=>'KD_TPS_ASAL','width'=>160,'align'=>'center'))		
                    ->addColumn(array('label'=>'TPS Asal','index'=>'TPS_ASAL','width'=>160,'hidden'=>true))	
                    ->addColumn(array('label'=>'Nama Angkut','index'=>'NM_ANGKUT','width'=>160))		
                    ->addColumn(array('label'=>'No. VOY Flight','index'=>'NO_VOY_FLIGHT','width'=>160,'align'=>'center'))	
                    ->addColumn(array('label'=>'Call Sign','index'=>'CALL_SIGN','width'=>160,'align'=>'center'))	
                    ->addColumn(array('label'=>'Tgl. Tiba','index'=>'TGL_TIBA','width'=>160,'align'=>'center'))	
                    ->addColumn(array('label'=>'Gudang Tujuan','index'=>'GUDANG_TUJUAN','width'=>160,'align'=>'center'))	                   	                   
                    ->addColumn(array('label'=>'No. A11','index'=>'NO_A11','width'=>160,'hidden'=>true))	
                    ->addColumn(array('label'=>'Tgl. A11','index'=>'TGL_A11','width'=>160,'hidden'=>true))		
                    ->addColumn(array('label'=>'No. BL AWB','index'=>'NO_BL_AWB','width'=>160,'hidden'=>true))		
                    ->addColumn(array('label'=>'Tgl. BL AWB','index'=>'TGL_BL_AWB','width'=>160,'hidden'=>true))		
                    ->addColumn(array('label'=>'No. MBL AWB','index'=>'NO_MASTER_BL_AWB','width'=>160,'hidden'=>true))		
                    ->addColumn(array('label'=>'Tgl. MBL AWB','index'=>'TGL_MASTER_BL_AWB','width'=>160,'hidden'=>true))			
                    ->addColumn(array('label'=>'Bruto','index'=>'BRUTO','width'=>80,'align'=>'center','hidden'=>true))	
                    ->addColumn(array('label'=>'No. BC11','index'=>'NO_BC11','width'=>160,'align'=>'center'))			
                    ->addColumn(array('label'=>'Tgl. BC11','index'=>'TGL_BC11','width'=>160,'align'=>'center'))			
                    ->addColumn(array('label'=>'No. POS BC11','index'=>'NO_POS_BC11','width'=>160,'align'=>'center'))		
                    ->addColumn(array('label'=>'ISO Code','index'=>'ISO_CODE','width'=>160,'hidden'=>true))		
                    ->addColumn(array('label'=>'Pel. Muat','index'=>'PEL_MUAT','width'=>160,'hidden'=>true))			
                    ->addColumn(array('label'=>'Pel. Transit','index'=>'PEL_TRANSIT','width'=>160,'hidden'=>true))		
                    ->addColumn(array('label'=>'Pel. Bongkar','index'=>'PEL_BONGKAR','width'=>160,'hidden'=>true))	
                    ->addColumn(array('label'=>'Tgl. Upload','index'=>'TGLUPLOAD','width'=>160,'align'=>'center','hidden'=>true))
                    ->addColumn(array('label'=>'Status','index'=>'STATUS','width'=>160,'hidden'=>true))		
                    ->addColumn(array('label'=>'Updated','index'=>'LASTUPDATE','width'=>160,'hidden'=>true))		
                    ->addColumn(array('label'=>'Reg. Code','index'=>'REGCODE','width'=>160,'hidden'=>true))
                    ->addColumn(array('index'=>'INSDATETIME','width'=>160,'hidden'=>true))
                    ->addColumn(array('index'=>'REGCODEDATA','width'=>160,'hidden'=>true))
                    ->addColumn(array('index'=>'ID_BOOKING','width'=>160,'hidden'=>true))		
                    ->addColumn(array('index'=>'REFNUM_COARI','width'=>160,'hidden'=>true))			
                    ->addColumn(array('index'=>'REFDATE_COARI','width'=>160,'hidden'=>true))	
                    ->addColumn(array('index'=>'GATEIN_DEPO','width'=>160,'hidden'=>true))		
                    ->addColumn(array('index'=>'FLAG_UPD','width'=>160,'hidden'=>true))
                    ->addColumn(array('label'=>'No. SPPB','index'=>'NO_SPPB','width'=>160,'hidden'=>true))		
                    ->addColumn(array('label'=>'Tgl. SPPN','index'=>'TGL_SPPB','width'=>160,'hidden'=>true))
                    ->addColumn(array('label'=>'No. SPJM','index'=>'NO_PIB','width'=>160,'hidden'=>true))	
                    ->addColumn(array('label'=>'Tgl. SPJM','index'=>'TGL_PIB','width'=>160,'hidden'=>true))
                    ->addColumn(array('index'=>'REFNUM_CODECO','width'=>160,'hidden'=>true))	
                    ->addColumn(array('index'=>'REFDATE_CODECO','width'=>160,'hidden'=>true))
                    ->addColumn(array('index'=>'GATEOUT_DEPO','width'=>160,'hidden'=>true))
                    ->renderGrid()
                }}
                
                <div id="btn-toolbar" class="section-header btn-toolbar" role="toolbar" style="margin: 10px 0;">
                    <div id="btn-group-3" class="btn-group">
                        <button class="btn btn-default" id="btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>
                    </div>
                    <div id="btn-group-1" class="btn-group">
                        <button class="btn btn-default" id="btn-edit"><i class="fa fa-edit"></i> Edit</button>
                    </div>
                    <div id="btn-group-2" class="btn-group toolbar-block">
                        <button class="btn btn-default" id="btn-save"><i class="fa fa-save"></i> Save</button>
                        <button class="btn btn-default" id="btn-cancel"><i class="fa fa-close"></i> Cancel</button>
                    </div>  
<!--                    <div id="btn-group-4" class="btn-group">
                        <button class="btn btn-default" id="btn-print"><i class="fa fa-print"></i> Cetak Surat Jalan</button>
                    </div>-->
<!--                    <div id="btn-group-5" class="btn-group pull-right">
                        <button class="btn btn-default" id="btn-upload"><i class="fa fa-upload"></i> Upload EasyGO</button>
                    </div>-->
                </div>
            </div>
            
        </div>
        <form class="form-horizontal" id="dispatche-form" action="" method="POST">
            <div class="row">
                <div class="col-md-6">
                    
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    <input id="ob_id" name="ob_id" type="hidden">
                    <input id="TYPE" name="TYPE" type="hidden" value="L">
<!--                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. SPK</label>
                        <div class="col-sm-8">
                            <input type="text" id="NOJOBORDER" name="NOJOBORDER" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. MBL</label>
                        <div class="col-sm-8">
                            <input type="text" id="NOMBL" name="NOMBL" class="form-control" readonly>
                        </div>
                    </div>-->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. Container</label>
                        <div class="col-sm-8">
                            <input type="text" id="NO_CONT" name="NO_CONT" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Size</label>
                        <div class="col-sm-8">
                            <input type="text" id="UK_CONT" name="UK_CONT" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Vessel</label>
                        <div class="col-sm-8">
                            <input type="text" id="NM_ANGKUT" name="NM_ANGKUT" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. PLP</label>
                        <div class="col-sm-3">
                            <input type="text" id="NO_PLP" name="NO_PLP" class="form-control" readonly>
                        </div>
                        <label class="col-sm-2 control-label">Tgl. PLP</label>
                        <div class="col-sm-3">
                            <input type="text" id="TGL_PLP" name="TGL_PLP" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">TPS Asal</label>
                        <div class="col-sm-8">
                            <input type="text" id="KD_TPS_ASAL" name="KD_TPS_ASAL" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">ETA</label>
                        <div class="col-sm-8">
                            <input type="text" id="TGL_TIBA" name="TGL_TIBA" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Voy</label>
                        <div class="col-sm-8">
                            <input type="text" id="NO_VOY_FLIGHT" name="NO_VOY_FLIGHT" class="form-control" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">E-Seal</label>
                        <div class="col-sm-8">
                            <select class="form-control select2" id="ESEALCODE" name="ESEALCODE" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                <option value="">Choose E-Seal</option>
                                @foreach($eseals as $eseal)
                                    <option value="{{ $eseal->code }}">{{ $eseal->code }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. POL</label>
                        <div class="col-sm-8">
                            <input type="text" id="NOPOL" name="NOPOL" class="form-control" required>
                        </div>
                    </div>
<!--                    <div class="form-group">
                        <label class="col-sm-4 control-label">Status Dispatche</label>
                        <div class="col-sm-2">
                            <input type="text" id="STATUS_DISPATCHE" name="STATUS_DISPATCHE" class="form-control" required readonly>
                        </div>
                        <div class="col-sm-2">
                            <input type="text" id="KODE_DISPATCHE" name="KODE_DISPATCHE" class="form-control" required readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Response Dispatche</label>
                        <div class="col-sm-8">
                            <input type="text" id="RESPONSE_DISPATCHE" name="RESPONSE_DISPATCHE" class="form-control" required readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">DO ID</label>
                        <div class="col-sm-8">
                            <input type="text" id="DO_ID" name="DO_ID" class="form-control" required readonly>
                        </div>
                    </div>-->
                </div>
                <div class="col-md-6"> 
                                     
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl. Dispatche</label>
                        <div class="col-sm-4">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" id="TGL_DISPATCHE" name="TGL_DISPATCHE" class="form-control pull-right datepicker" required value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <input type="text" id="JAM_DISPATCHE" name="JAM_DISPATCHE" class="form-control timepicker" value="{{ date('H:i:s') }}" required>
                                <div class="input-group-addon">
                                      <i class="fa fa-clock-o"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bootstrap-timepicker">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Tgl. Keluar TPK</label>
                            <div class="col-sm-4">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" id="TGL_KELUAR_TPK_ESEAL" name="TGL_KELUAR_TPK_ESEAL" class="form-control pull-right datepicker" required value="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <input type="text" id="JAM_KELUAR_TPK_ESEAL" name="JAM_KELUAR_TPK_ESEAL" class="form-control timepicker" value="{{ date('H:i:s') }}" required>
                                    <div class="input-group-addon">
                                          <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </form>  
    </div>
</div>

<div id="view-dispatche-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Dispatche Detail</h4>
            </div>
            <div class="modal-detail" style="padding: 30px;">
                <table>
                    <tr>
                        <td>DO ID</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td id="detail_do_id"></td>
                    </tr>
                    <tr>
                        <td>Eseal Code</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td id="detail_esealcode"></td>
                    </tr>
                    <tr>
                        <td>No. Pol</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td id="detail_no_pol"></td>
                    </tr>
                    <tr>
                        <td>No. Container</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td id="detail_no_cont"></td>
                    </tr>
                    <tr>
                        <td>No. PLP</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td id="detail_no_plp"></td>
                    </tr>
                    <tr>
                        <td>Tgl. PLP</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td id="detail_tgl_plp"></td>
                    </tr>
                    <tr>
                        <td>TPS Asal</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td id="detail_tps_asal"></td>
                    </tr>
                    <tr>
                        <td>TPS Tujuan</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td id="detail_tps_tujuan"></td>
                    </tr>
                    <tr>
                        <td>Waktu Dispatche</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td id="detail_tgl_dispatche"></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td id="detail_address"></td>
                    </tr>
                    <tr>
                        <td>Lat/Lon</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td id="detail_lat_lon"></td>
                    </tr>
                    <tr>
                        <td>GPS Time</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td id="detail_gps_time"></td>
                    </tr>
                    <tr>
                        <td>Kode Dispatche</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td id="detail_kode"></td>
                    </tr>
                    <tr>
                        <td>Response Dispatche</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td id="detail_response"></td>
                    </tr>
                    <tr>
                        <td>Status Dispatche</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td id="detail_status"></td>
                    </tr>
                    <tr>
                        <td>Status DO</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td id="detail_status_do"></td>
                    </tr>
                </table>
            </div>
            
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

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