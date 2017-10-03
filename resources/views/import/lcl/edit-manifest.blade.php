@extends('layout')

@section('content')
<style>
    .datepicker.dropdown-menu {
        z-index: 110 !important;
    }
</style>

@include('partials.form-alert')

<div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">LCL Registrer Information</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <!-- /.box-header -->
    <form class="form-horizontal" action="#" method="POST">
        <div class="box-body">            
            
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No.SPK</label>
                        <div class="col-sm-9">
                            <input type="text" readonly="" name="NOJOBORDER" class="form-control" value="{{ $container->NoJob }}" required="">
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Consolidator</label>
                        <div class="col-sm-9">
                            <input type="text" readonly="" name="NAMACONSOLIDATOR" class="form-control" value="{{ $container->NAMACONSOLIDATOR }}" required="">
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Vessel</label>
                        <div class="col-sm-9">
                            <input type="text" readonly="" name="VESSEL" class="form-control" value="{{ $container->VESSEL }}" required="">
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Voy</label>
                        <div class="col-sm-9">
                            <input type="text" readonly="" name="VOY" class="form-control" value="{{ $container->VOY }}" required="">
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Pelabuhan</label>
                        <div class="col-sm-8">
                            <input type="text" readonly="" name="NAMAPELABUHAN" class="form-control" value="{{ $container->NAMAPELABUHAN }}" required="">
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">ETA</label>
                        <div class="col-sm-9">
                            <input type="text" readonly="" name="ETA" class="form-control" value="{{ date('d-m-Y', strtotime($container->ETA)) }}" required="">
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">No.BC11</label>
                        <div class="col-sm-8">
                            <input type="text" readonly="" name="NO_BC11" id="C_NO_BC11" class="form-control" value="{{ $container->NO_BC11 }}" required="">
                        </div>
                    </div>
                </div>
                <input type="hidden" id="C_NO_PLP" name="NO_PLP" value="{{ $container->NO_PLP }}">
                <input type="hidden" id="C_TGL_PLP" name="TGL_PLP" value="{{ $container->TGL_PLP }}">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Tgl.BC11</label>
                        <div class="col-sm-8">
                            <input type="text" readonly="" name="TGL_BC11" id="C_TGL_BC11" class="form-control" value="{{ date('d-m-Y', strtotime($container->TGL_BC11)) }}" required="">
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No.MBL</label>
                        <div class="col-sm-9">
                            <input type="text" readonly="" name="NOMBL" class="form-control" value="{{ $container->NOMBL }}" required="">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">No.Container/Size/No.Segel</label>
                        <div class="col-sm-8">
                            <input type="text" readonly="" name="NOCONTAINER" class="form-control" value="{{ $container->NOCONTAINER.' / '.$container->SIZE.' / '.$container->NO_SEAL }}" required="">
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Tgl.Stripping</label>
                        <div class="col-sm-8">
                            <input type="text" readonly="" name="NOJOBORDER" class="form-control" value="{{ date('d-m-Y', strtotime($container->TGLSTRIPPING)) }}" required="">
                        </div>
                    </div>
                </div>
                
            </div>
            
        </div>
    </form>
</div>

<script>
 
    function gridCompleteEvent()
    {
        var ids = jQuery("#lclManifestGrid").jqGrid('getDataIDs'),
            apv = ''; 
    
        $('#btn-group-5').enableButtonGroup();   
            
        for(var i=0;i < ids.length;i++){ 
            var cl = ids[i];
            
            rowdata = $('#lclManifestGrid').getRowData(cl);
            if(rowdata.VALIDASI == 'N') {
                apv = '<button style="margin:5px;" class="btn btn-danger btn-xs approve-manifest-btn" data-id="'+cl+'" onclick="if (confirm(\'Are You Sure ?\')){ approveManifest('+cl+'); }else{return false;};"><i class="fa fa-check"></i> Approve</button>';
                $('#btn-group-5').disabledButtonGroup();
            } else {
                apv = '<button style="margin:5px;" class="btn btn-danger btn-xs approve-manifest-btn" data-id="'+cl+'" disabled><i class="fa fa-check"></i> Approve</button>';
                $("#" + cl).find("td").css("color", "#999999");
            }
            if(rowdata.flag_bc == 'Y') {
                $("#" + cl).find("td").css("color", "#FF0000");
            }
            jQuery("#lclManifestGrid").jqGrid('setRowData',ids[i],{action:apv}); 
        } 
    }
    
    function approveManifest($id)
    {
        $.ajax({
            type: 'GET',
            dataType : 'json',
            url: $('#manifest-form').attr('action') + '/approve/'+$id,
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
        $('#btn-group-2').enableButtonGroup();
    }
    
    $(document).ready(function()
    {
        $('#btn-toolbar').disabledButtonGroup();
        $('#btn-group-4').enableButtonGroup();
        $('#btn-group-3').enableButtonGroup();
        $('#btn-group-1').enableButtonGroup();
        $('#btn-group-6').enableButtonGroup();

      //Binds onClick event to the "Refresh" button.
      $('#btn-refresh').click(function()
      {
            $('#lclManifestGrid').jqGrid().trigger("reloadGrid");
            
            $('#manifest-form')[0].reset();
            $('.select2').val(null).trigger("change");
            $('#TNOTIFYPARTY_FK').val('Same of Consignee').trigger("change");
            $('#DG_SURCHARGE').val('N').trigger("change");
            $('#WEIGHT_SURCHARGE').val('N').trigger("change");
            $('#flag_bc').val('N').trigger("change");
            $('#id').val("");
            
            //Disables all buttons within the toolbar
            $('#btn-toolbar').disabledButtonGroup();
            $('#btn-group-4').enableButtonGroup();
            $('#btn-group-3').enableButtonGroup();
            $('#btn-group-1').enableButtonGroup();
      });

//      //Binds onClick event to the "xls" button.
//      $('#export-xls').click(function()
//      {
//        //Triggers the grid XLS export functionality.
//        $('#BookGridXlsButton').click();
//      });
//
//      //Binds onClick event to the "csv" button.
//      $('#export-csv').click(function()
//      {
//        //Triggers the grid CSV export functionality.
//        $('#BookGridCsvButton').click();
//      });
        
      //Bind onClick event to the "Edit" button.
      $('#btn-edit').click(function()
      {
        //Gets the selected row id.
        rowid = $('#lclManifestGrid').jqGrid('getGridParam', 'selrow');
        rowdata = $('#lclManifestGrid').getRowData(rowid);
        $('#id').val(rowid);
        populateFormFields(rowdata, '');
           
        $("#TSHIPPER_FK").append('<option value="'+rowdata.TSHIPPER_FK+'" selected="selected">'+rowdata.SHIPPER+'</option>');
        $("#TSHIPPER_FK").trigger('change');
        $("#TCONSIGNEE_FK").append('<option value="'+rowdata.TCONSIGNEE_FK+'" selected="selected">'+rowdata.CONSIGNEE+'</option>');
        $("#TCONSIGNEE_FK").trigger('change');
           
//        $("#TSHIPPER_FK").val(rowdata.TSHIPPER_FK).trigger("change");
//        $("#TCONSIGNEE_FK").val(rowdata.TCONSIGNEE_FK).trigger("change");
        if(rowdata.TNOTIFYPARTY_FK){
//            $("#TNOTIFYPARTY_FK").val(rowdata.TNOTIFYPARTY_FK).trigger("change");
            $("#TNOTIFYPARTY_FK").append('<option value="'+rowdata.TNOTIFYPARTY_FK+'" selected="selected">'+rowdata.NOTIFYPARTY+'</option>');
            $("#TNOTIFYPARTY_FK").trigger('change');
        }
        $("#TPACKING_FK").val(rowdata.TPACKING_FK).trigger("change");
        $("#DG_SURCHARGE").val(rowdata.DG_SURCHARGE).trigger("change");
        $("#WEIGHT_SURCHARGE").val(rowdata.WEIGHT_SURCHARGE).trigger("change");
        $("#flag_bc").val(rowdata.flag_bc).trigger("change");
        
        $("#TGL_HBL").datepicker('setDate', rowdata.TGL_HBL);
        $("#TGL_BC11").val(rowdata.TGL_BC11);
        $("#TGL_PLP").val(rowdata.TGL_PLP);
        $("#NO_BC11").val(rowdata.NO_BC11);
        $("#NO_PLP").val(rowdata.NO_PLP);
        $("#NO_POS_BC11").val(rowdata.NO_POS_BC11);
        
//        console.log(rowdata);
        $('#btn-toolbar').disabledButtonGroup();
        $('#btn-group-1').enableButtonGroup();
        $('#btn-group-3').enableButtonGroup();
      });

      //Bind onClick event to the "Delete" button.
      $('#btn-delete').click(function()
      {
        //Gets the selected row id
        rowid = $('#lclManifestGrid').jqGrid('getGridParam', 'selrow');
        rowdata = $('#lclManifestGrid').getRowData(rowid);
        
        $.ajax({
          type: 'GET',
          dataType : 'json',
          url: $('#manifest-form').attr('action') + '/delete/'+rowid,
          error: function (jqXHR, textStatus, errorThrown)
          {
            $('#app-loader').addClass('hidden');
            $('#main-panel-fieldset').removeAttr('disabled');
            alert('Something went wrong, please try again later.');
          },
          beforeSend:function()
          {
            $('#app-loader').removeClass('hidden');
            $('#main-panel-fieldset').attr('disabled','disabled');
          },
          success:function(json)
          {
            if(json.success) {
                $('#btn-toolbar').showAlertAfterElement('alert-success alert-custom', json.message, 5000);
            } else {
                $('#btn-toolbar').showAlertAfterElement('alert-danger alert-custom', json.message, 5000);
            }

            //Triggers the "Refresh" button funcionality.
            $('#btn-refresh').click();
          }
        });

      });

      //Bind onClick event to the "Save" button.
    $('#btn-save').click(function(){
        if(!confirm('Apakah anda yakin?')){return false;}
          
        var url = $('#manifest-form').attr('action');

        if($('#id').val()) {
            url += '/edit/'+$('#id').val();
        } else {
            url += '/create';
        }
        
        //Send an Ajax request to the server.
        $.ajax({
          type: 'POST',
          data: JSON.stringify($('#manifest-form').formToObject('')),
          dataType : 'json',
          url: url,
          error: function (jqXHR, textStatus, errorThrown)
          {
            $('#app-loader').addClass('hidden');
            $('#main-panel-fieldset').removeAttr('disabled');
            alert('Something went wrong, please try again later.');
          },
          beforeSend:function()
          {
            $('#app-loader').removeClass('hidden');
            $('#main-panel-fieldset').attr('disabled','disabled');
          },
          success:function(json)
          {
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
    
    $('#btn-upload').click(function(){
        if(!confirm('Apakah anda yakin?')){return false;}
        
        if($('#C_NO_BC11').val() == ''){
            alert('No. BC11 masih kosong!');
            return false;
        }else if($('#C_TGL_BC11').val() == ''){
            alert('Tgl. BC11 masih kosong!');
            return false;
        }else if($('#C_NO_PLP').val() == ''){
            alert('No. PLP masih kosong!');
            return false;
        }else if($('#C_TGL_PLP').val() == ''){
            alert('Tgl. PLP masih kosong!');
            return false;
        }
        
        var url = '{{ route("lcl-manifest-upload") }}';
            
        $.ajax({
            type: 'POST',
            data: 
            {
                'container_id' : $('#TCONTAINER_FK').val(),
                '_token' : '{{ csrf_token() }}'
            },
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
                
                $('#tpsonline-modal-text').html(json.message+', Apakah anda ingin mengirimkan COARI Kemasan XML data sekarang?');
                $("#tpsonline-send-btn").attr("href", "{{ route('tps-coariKms-upload','') }}/"+json.insert_id);

                $('#tpsonline-modal').modal('show');
            }
        });
        
    });
    
    $("#btn-approve-all").on("click", function() {
        if(!confirm('Apakah anda yakin?')){return false;}
        
        $.ajax({
            type: 'GET',
            dataType : 'json',
            url: $('#manifest-form').attr('action') + '/approve-all/'+{{$container->TCONTAINER_PK}},
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
                } else {
                    $('#btn-toolbar').showAlertAfterElement('alert-danger alert-custom', json.message, 5000);
                }

                //Triggers the "Refresh" button funcionality.
                $('#btn-refresh').click();
            }
        });
    });

});
    
</script>

<div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Mainfest Detail</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="form-horizontal">
        <div class="box-body">            
            <div class="row" style="margin-bottom: 30px;">
                <div class="col-md-12">         
                    {{
                        GridRender::setGridId("lclManifestGrid")
                        ->enableFilterToolbar()
                        ->setGridOption('mtype', 'POST')
                        ->setGridOption('url', URL::to('/lcl/manifest/grid-data?containerid='.$container->TCONTAINER_PK.'&_token='.csrf_token()))
                        ->setGridOption('rowNum', 10)
                        ->setGridOption('shrinkToFit', true)
                        ->setGridOption('sortname','TMANIFEST_PK')
                        ->setGridOption('rownumbers', true)
                        ->setGridOption('height', '295')
                        ->setGridOption('rowList',array(10,20,50))
                        ->setGridOption('useColSpanStyle', true)
                        ->setNavigatorOptions('navigator', array('viewtext'=>'view'))
                        ->setNavigatorOptions('view',array('closeOnEscape'=>false))
                        ->setFilterToolbarOptions(array('autosearch'=>true))
                        ->setGridEvent('gridComplete', 'gridCompleteEvent')
                        ->setGridEvent('onSelectRow', 'onSelectRowEvent')
                        ->addColumn(array('key'=>true,'index'=>'TMANIFEST_PK','hidden'=>true))
                        ->addColumn(array('label'=>'Action','index'=>'action', 'width'=>120, 'search'=>false, 'sortable'=>false, 'align'=>'center'))
                        ->addColumn(array('label'=>'Validasi','index'=>'VALIDASI','width'=>80, 'align'=>'center'))
                        ->addColumn(array('label'=>'No.HBL','index'=>'NOHBL', 'width'=>160, 'align'=>'center'))
                        ->addColumn(array('label'=>'Tgl.HBL','index'=>'TGL_HBL', 'width'=>160, 'align'=>'center'))
                        ->addColumn(array('label'=>'No. Tally','index'=>'NOTALLY','width'=>160))
                        ->addColumn(array('label'=>'Shipper','index'=>'SHIPPER','width'=>230))
                        ->addColumn(array('label'=>'Consignee','index'=>'CONSIGNEE','width'=>250))
                        ->addColumn(array('label'=>'Notify Party','index'=>'NOTIFYPARTY','width'=>160))
                        ->addColumn(array('label'=>'Qty','index'=>'QUANTITY', 'width'=>80,'align'=>'center'))
                        ->addColumn(array('label'=>'Packing','index'=>'NAMAPACKING', 'width'=>120))
                        ->addColumn(array('label'=>'Kode Kemas','index'=>'KODE_KEMAS', 'width'=>100,'align'=>'center'))
                        ->addColumn(array('label'=>'UID','index'=>'UID', 'width'=>150,'hidden'=>true))
                        ->addColumn(array('index'=>'TSHIPPER_FK', 'width'=>150,'hidden'=>true))
                        ->addColumn(array('index'=>'TCONSIGNEE_FK', 'width'=>150,'hidden'=>true))
                        ->addColumn(array('index'=>'TNOTIFYPARTY_FK', 'width'=>150,'hidden'=>true))
                        ->addColumn(array('index'=>'TPACKING_FK', 'width'=>150,'hidden'=>true))
                        ->addColumn(array('label'=>'Marking','index'=>'MARKING', 'width'=>150,'hidden'=>true)) 
                        ->addColumn(array('label'=>'Desc of Goods','index'=>'DESCOFGOODS', 'width'=>150,'hidden'=>false))              
                        ->addColumn(array('label'=>'Weight','index'=>'WEIGHT', 'width'=>120,'hidden'=>false, 'align'=>'right'))               
                        ->addColumn(array('label'=>'Meas','index'=>'MEAS', 'width'=>120,'hidden'=>false, 'align'=>'right'))
                        ->addColumn(array('label'=>'No.BC11','index'=>'NO_BC11', 'width'=>150,'hidden'=>true))
                        ->addColumn(array('label'=>'Tgl.BC11','index'=>'TGL_BC11', 'width'=>150,'hidden'=>true))
                        ->addColumn(array('label'=>'No.POS BC11','index'=>'NO_POS_BC11', 'width'=>150, 'align'=>'center'))
                        ->addColumn(array('label'=>'No.PLP','index'=>'NO_PLP', 'width'=>150,'hidden'=>true))                
                        ->addColumn(array('label'=>'Tgl.PLP','index'=>'TGL_PLP', 'width'=>150,'hidden'=>true))                
                        ->addColumn(array('label'=>'Surcharge (DG)','index'=>'DG_SURCHARGE', 'width'=>150,'hidden'=>true))
                        ->addColumn(array('label'=>'Surcharge (Weight)','index'=>'WEIGHT_SURCHARGE', 'width'=>150,'hidden'=>true))      
                        ->addColumn(array('label'=>'Flag','index'=>'flag_bc','width'=>80, 'align'=>'center'))
                        ->addColumn(array('label'=>'Tgl. Entry','index'=>'tglentry', 'width'=>120))
                        ->addColumn(array('label'=>'Jam. Entry','index'=>'jamentry', 'width'=>70,'hidden'=>true))
                        ->addColumn(array('label'=>'Updated','index'=>'last_update', 'width'=>150, 'search'=>false,'hidden'=>true))
                        ->renderGrid()
                    }}
                    
                    <div id="btn-toolbar" class="section-header btn-toolbar" role="toolbar" style="margin: 10px 0;">
                        <div id="btn-group-1" class="btn-group">
                            <button class="btn btn-default" id="btn-refresh"><i class="fa fa-refresh"></i> New/Refresh</button>
                        </div>
                        <div id="btn-group-2" class="btn-group">
                            <button class="btn btn-default" id="btn-edit"><i class="fa fa-edit"></i> Edit</button>
                            <button class="btn btn-default" id="btn-delete"><i class="fa fa-minus"></i> Delete</button>
                        </div>
                        <div id="btn-group-3" class="btn-group toolbar-block">
                            <button class="btn btn-default" id="btn-save"><i class="fa fa-save"></i> Save</button>
                        </div>
                        <div id="btn-group-4" class="btn-group pull-right">
                            <button class="btn btn-default" id="btn-print-tally" onclick="window.open('{{ route('lcl-manifest-cetak', array('id'=>$container->TCONTAINER_PK,'type'=>'tally')) }}','preview tally sheet','width=600,height=600,menubar=no,status=no,scrollbars=yes');"><i class="fa fa-print"></i> Cetak Tally Sheet</button>
                            <button class="btn btn-default" id="btn-print-log" onclick="window.open('{{ route('lcl-manifest-cetak', array('id'=>$container->TCONTAINER_PK,'type'=>'log')) }}','preview log stripping','width=600,height=600,menubar=no,status=no,scrollbars=yes');"><i class="fa fa-print"></i> Cetak Log Stripping</button>
                        </div>
                        <div id="btn-group-5" class="btn-group pull-right">
                            <button class="btn btn-default" id="btn-upload"><i class="fa fa-upload"></i> Upload TPS Online</button>
                        </div>
                        <div id="btn-group-6" class="btn-group pull-right">
                            <button class="btn btn-default" id="btn-approve-all"><i class="fa fa-check"></i> Approve All</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <form class="form-horizontal" id="manifest-form" action="{{ route('lcl-manifest-index') }}" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                        <input name="TCONTAINER_FK" id="TCONTAINER_FK" type="hidden" value="{{ $container->TCONTAINER_PK }}">
                        <input name="id" id="id" type="hidden">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">No. HBL</label>
                            <div class="col-sm-8">
                                <input type="text" id="NOHBL" name="NOHBL" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Tgl. HBL</label>
                            <div class="col-sm-8">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" id="TGL_HBL" name="TGL_HBL" class="form-control pull-right datepicker" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Shipper</label>
                            <div class="col-sm-8">
                                <select class="form-control select2" id="TSHIPPER_FK" name="TSHIPPER_FK" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                    <option value="">Choose Shipper</option>
<!--                                    @foreach($perusahaans as $perusahaan)
                                        <option value="{{ $perusahaan->id }}">{{ $perusahaan->name }}</option>
                                    @endforeach-->
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Consignee</label>
                            <div class="col-sm-6">
                                <select class="form-control select2" id="TCONSIGNEE_FK" name="TCONSIGNEE_FK" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                    <option value="">Choose Consignee</option>
<!--                                    @foreach($perusahaans as $perusahaan)
                                        <option value="{{ $perusahaan->id }}">{{ $perusahaan->name }}</option>
                                    @endforeach-->
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <button type="button" class="btn btn-info" id="add-consignee-btn">Add Consignee</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Notify Party</label>
                            <div class="col-sm-8">
                                <select class="form-control select2" id="TNOTIFYPARTY_FK" name="TNOTIFYPARTY_FK" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                    <option value="Same of Consignee">Same of Consignee</option>
<!--                                    @foreach($perusahaans as $perusahaan)
                                        <option value="{{ $perusahaan->id }}">{{ $perusahaan->name }}</option>
                                    @endforeach-->
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Marking</label>
                          <div class="col-sm-8">
                              <textarea class="form-control" id="MARKING"  name="MARKING" rows="3"></textarea>
                          </div>
                        </div>

                    </div>
                    <div class="col-md-6"> 
                        <div class="form-group">
                            <label class="col-sm-3 control-label">No.BC11</label>
                            <div class="col-sm-3">
                                <input type="text" id="NO_BC11" name="NO_BC11" class="form-control" required readonly>
                            </div>
                            <label class="col-sm-2 control-label">Tgl.BC11</label>
                            <div class="col-sm-3">
                                <!--<div class="input-group date">-->
                                    <input type="text" id="TGL_BC11" name="TGL_BC11" class="form-control pull-right" required readonly>
                                <!--</div>-->
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">No.PLP</label>
                            <div class="col-sm-3">
                                <input type="text" id="NO_PLP" name="NO_PLP" class="form-control" required readonly>
                            </div>
                            <label class="col-sm-2 control-label">Tgl.PLP</label>
                            <div class="col-sm-3">
                                <!--<div class="input-group date">-->
                                    <input type="text" id="TGL_PLP" name="TGL_PLP" class="form-control pull-right" required readonly>
                                <!--</div>-->
                            </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Desc of Goods</label>
                          <div class="col-sm-8">
                              <textarea class="form-control" id="DESCOFGOODS" name="DESCOFGOODS" rows="3"></textarea>
                          </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">QTY</label>
                            <div class="col-sm-2">
                                <input type="number" id="QUANTITY" name="QUANTITY" class="form-control" required>
                            </div>
                            <label class="col-sm-2 control-label">Packing</label>
                            <div class="col-sm-4">
                                <select class="form-control select2" id="TPACKING_FK" name="TPACKING_FK" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                    <option value="">Choose Packing</option>
                                    @foreach($packings as $packing)
                                        <option value="{{ $packing->id }}">{{ $packing->name.' ('.$packing->code.')' }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Weight</label>
                            <div class="col-sm-3">
                                <input type="text" id="WEIGHT" name="WEIGHT" class="form-control" required>
                            </div>
                            <label class="col-sm-2 control-label">Meas</label>
                            <div class="col-sm-3">
                                <input type="text" id="MEAS" name="MEAS" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="col-sm-3 control-label">No.POS BC11</label>
                          <div class="col-sm-8">
                              <input type="text" id="NO_POS_BC11" name="NO_POS_BC11" class="form-control" required>
                          </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Surcharge(DG)</label>
                            <div class="col-sm-2">
                                <select class="form-control select2" id="DG_SURCHARGE" name="DG_SURCHARGE" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                    <option value="N">N</option>
                                    <option value="Y">Y</option>
                                </select>
                            </div>
                            <label class="col-sm-4 control-label">Surcharge(Weight)</label>
                            <div class="col-sm-2">
                                <select class="form-control select2" id="WEIGHT_SURCHARGE" name="WEIGHT_SURCHARGE" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                    <option value="N">N</option>
                                    <option value="Y">Y</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">FLAG</label>
                            <div class="col-sm-2">
                                <select class="form-control select2" id="flag_bc" name="flag_bc" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                    <option value="N">N</option>
                                    <option value="Y">Y</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="consignee-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="modal">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Add New Consignee</h4>
            </div>
            <form class="form-horizontal" id="create-consignee-form" action="{{ route('perusahaan-store') }}" method="POST">
                <div class="modal-body"> 
                    <div class="row">
                        <div class="col-md-12">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Nama Perusahaan</label>
                                <div class="col-sm-8">
                                    <input type="text" name="NAMAPERUSAHAAN" class="form-control" required /> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">NPWP</label>
                                <div class="col-sm-8">
                                    <input type="text" id="npwp" name="NPWP" class="form-control" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Telepon</label>
                                <div class="col-sm-8">
                                    <input type="tel" name="NOTELP" class="form-control" /> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="email" name="EMAIL" class="form-control" /> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">CP</label>
                                <div class="col-sm-8">
                                    <input type="text" name="CONTACTPERSON" class="form-control" /> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Alamat</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="ALAMAT"></textarea>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary">Save</button>
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

<script src="{{ asset("/bower_components/AdminLTE/plugins/datepicker/bootstrap-datepicker.js") }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
<script type="text/javascript">
    $('select').select2();
    $('#npwp').mask("99.999.999.9-999.999");
    $('.datepicker').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'yyyy-mm-dd' 
    });
    $('.approve-manifest-btn').on('click', function() {
        console.log('ok');
        console.log($(this).data('id'));
    });
    
    $("#add-consignee-btn").on("click", function(e){
        e.preventDefault();
        $("#consignee-modal").modal('show');
        return false;
    });
    
    $("#create-consignee-form").on("submit", function(){
        console.log(JSON.stringify($(this).formToObject('')));
        var url = $(this).attr('action');

        $.ajax({
            type: 'POST',
            data: JSON.stringify($(this).formToObject('')),
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
                    $("#TCONSIGNEE_FK").append('<option value="'+json.data.id+'" selected="selected">'+json.data.NAMAPERUSAHAAN+'</option>');
                    $("#TCONSIGNEE_FK").trigger('change');
                    $("#consignee-modal").modal('hide');
                } else {
                    $('#btn-toolbar').showAlertAfterElement('alert-danger alert-custom', json.message, 5000);
                }
//                
//                //Triggers the "Close" button funcionality.
//                $('#btn-refresh').click();
            }
        });
        
        return false;
    });
    
    $("#TSHIPPER_FK,#TCONSIGNEE_FK,#TNOTIFYPARTY_FK").select2({
        ajax: {
          url: "{{ route('getDataPerusahaan') }}",
          dataType: 'json',
          delay: 250,
          data: function (params) {
            return {
              q: params.term, // search term
//              page: params.page
            };
          },
          processResults: function (data, params) {
//              console.log(data);
            // parse the results into the format expected by Select2
            // since we are using custom formatting functions we do not need to
            // alter the remote JSON data, except to indicate that infinite
            // scrolling can be used
            params.page = params.page || 1;

            return {
              results: data.items,
//              pagination: {
//                more: (params.page * 30) < data.total_count
//              }
            };
          },
          cache: true
        },
        escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
        minimumInputLength: 3,
//        templateResult: formatRepo, // omitted for brevity, see the source of this page
//        templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
    });
    
</script>

@endsection