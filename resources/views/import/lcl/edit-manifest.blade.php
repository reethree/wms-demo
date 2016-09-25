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
                            <input type="text" readonly="" name="NO_BC11" class="form-control" value="{{ $container->NO_BC11 }}" required="">
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Tgl.BC11</label>
                        <div class="col-sm-8">
                            <input type="text" readonly="" name="TGL_BC11" class="form-control" value="{{ date('d-m-Y', strtotime($container->TGL_BC11)) }}" required="">
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
            edt = '',
            del = ''; 
        for(var i=0;i < ids.length;i++){ 
            var cl = ids[i];
            
            edt = '<a href="{{ route("lcl-manifest-edit",'') }}/'+cl+'"><i class="fa fa-pencil"></i></a> ';
            del = '<a href="{{ route("lcl-manifest-delete",'') }}/'+cl+'" onclick="if (confirm(\'Are You Sure ?\')){return true; }else{return false; };"><i class="fa fa-close"></i></a>';
            jQuery("#lclManifestGrid").jqGrid('setRowData',ids[i],{action:edt+' '+del}); 
        } 
    }
    
    function onSelectRowEvent()
    {
        $('#btn-group-2').enableButtonGroup();
    }
    
    $(document).ready(function()
    {
        $('#btn-toolbar').disabledButtonGroup();
        $('#btn-group-3').enableButtonGroup();
        $('#btn-group-1').enableButtonGroup();

      //Binds onClick event to the "Refresh" button.
      $('#btn-refresh').click(function()
      {
            //When toolbar is enabled, this method should be use to clean the toolbar and refresh the grid.
            $('#lclManifestGrid')[0].clearToolbar();
            //Disables all buttons within the toolbar
            $('#btn-toolbar').disabledButtonGroup();
            //Enables the first button group (new, refresh and export)
            $('#btn-group-1').enableButtonGroup();
            $('#btn-group-3').enableButtonGroup();
            $('#manifest-form')[0].reset();
            $("select").select2("val", "");
            $('#id').val("");
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
        
        $('#btn-reset').click(function(){
            $('#manifest-form')[0].reset();
            $("select").select2("val", "");
            $('#id').val("");
            $('#btn-toolbar').disabledButtonGroup();
            //Enables the first button group (new, refresh and export)
            $('#btn-group-1').enableButtonGroup();
            $('#btn-group-3').enableButtonGroup();
        })
        
      //Bind onClick event to the "Edit" button.
      $('#btn-edit').click(function()
      {
        //Gets the selected row id.
        rowid = $('#lclManifestGrid').jqGrid('getGridParam', 'selrow');
        rowdata = $('#lclManifestGrid').getRowData(rowid);
        $('#id').val(rowid);
        populateFormFields(rowdata, '');
           
        $("#TSHIPPER_FK").val(rowdata.TSHIPPER_FK).trigger("change")
        $("#TCONSIGNEE_FK").val(rowdata.TCONSIGNEE_FK).trigger("change")
        if(rowdata.TNOTIFYPARTY_FK){
            $("#TNOTIFYPARTY_FK").val(rowdata.TNOTIFYPARTY_FK).trigger("change")
        }
        $("#TPACKING_PK").val(rowdata.TPACKING_PK).trigger("change")
        $("#DG_SURCHARGE").val(rowdata.DG_SURCHARGE).trigger("change")
        $("#WEIGHT_SURCHARGE").val(rowdata.WEIGHT_SURCHARGE).trigger("change")
        $("#VALIDASI").val(rowdata.VALIDASI).trigger("change")
        
        $("#TGL_HBL").datepicker('setDate', rowdata.TGL_HBL)
        $("#TGL_BC11").datepicker('setDate', rowdata.TGL_BC11)
        $("#TGL_PLP").datepicker('setDate', rowdata.TGL_PLP)
        
        $("#NO_BC11").val(rowdata.NO_BC11)
        $("#NO_PLP").val(rowdata.NO_PLP)
        
//        console.log(rowdata);
        $('#btn-toolbar').disabledButtonGroup();
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
    $('#btn-save').click(function()
      {
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
                        ->setGridOption('url', URL::to('/lcl/manifest/grid-data?containerid='.$container->TCONTAINER_PK))
                        ->setGridOption('rowNum', 10)
                        ->setGridOption('shrinkToFit', true)
                        ->setGridOption('sortname','TMANIFEST_PK')
                        ->setGridOption('rownumbers', true)
                        ->setGridOption('height', '150')
                        ->setGridOption('rowList',array(10,20,50))
                        ->setGridOption('useColSpanStyle', true)
                        ->setNavigatorOptions('navigator', array('viewtext'=>'view'))
                        ->setNavigatorOptions('view',array('closeOnEscape'=>false))
                        ->setFilterToolbarOptions(array('autosearch'=>true))
                        ->setGridEvent('gridComplete', 'gridCompleteEvent')
                        ->setGridEvent('onSelectRow', 'onSelectRowEvent')
        //                    ->addColumn(array('label'=>'Action','index'=>'action', 'width'=>80, 'search'=>false, 'sortable'=>false, 'align'=>'center'))
                        ->addColumn(array('key'=>true,'index'=>'TMANIFEST_PK','hidden'=>true))
                        ->addColumn(array('label'=>'Status','index'=>'VALIDASI','width'=>80, 'align'=>'center'))
                        ->addColumn(array('label'=>'No. Tally','index'=>'NOTALLY','width'=>160))
                        ->addColumn(array('label'=>'Shipper','index'=>'SHIPPER','width'=>160))
                        ->addColumn(array('label'=>'Consignee','index'=>'CONSIGNEE','width'=>160))
                        ->addColumn(array('label'=>'Notify Party','index'=>'NOTIFYPARTY','width'=>160))
                        ->addColumn(array('label'=>'Qty','index'=>'QUANTITY', 'width'=>80,'align'=>'center'))
                        ->addColumn(array('label'=>'Packing','index'=>'NAMAPACKING', 'width'=>80))
                        ->addColumn(array('label'=>'Kode Kemas','index'=>'KODE_KEMAS', 'width'=>100,'align'=>'center'))
                        ->addColumn(array('label'=>'UID','index'=>'UID', 'width'=>150,'hidden'=>true))
                        ->addColumn(array('label'=>'No.HBL','index'=>'NOHBL', 'width'=>150,'hidden'=>true))
                        ->addColumn(array('label'=>'Tgl.HBL','index'=>'TGL_HBL', 'width'=>150,'hidden'=>true))
                        ->addColumn(array('index'=>'TSHIPPER_FK', 'width'=>150,'hidden'=>true))
                        ->addColumn(array('index'=>'TCONSIGNEE_FK', 'width'=>150,'hidden'=>true))
                        ->addColumn(array('index'=>'TNOTIFYPARTY_FK', 'width'=>150,'hidden'=>true))
                        ->addColumn(array('index'=>'TPACKING_PK', 'width'=>150,'hidden'=>true))
                        ->addColumn(array('label'=>'Marking','index'=>'MARKING', 'width'=>150,'hidden'=>true)) 
                        ->addColumn(array('label'=>'Desc of Goods','index'=>'DESCOFGOODS', 'width'=>150,'hidden'=>true))              
                        ->addColumn(array('label'=>'Weight','index'=>'WEIGHT', 'width'=>150,'hidden'=>true))               
                        ->addColumn(array('label'=>'Meas','index'=>'MEAS', 'width'=>150,'hidden'=>true))
                        ->addColumn(array('label'=>'No.BC11','index'=>'NO_BC11', 'width'=>150,'hidden'=>true))
                        ->addColumn(array('label'=>'Tgl.BC11','index'=>'TGL_BC11', 'width'=>150,'hidden'=>true))
                        ->addColumn(array('label'=>'No.PLP','index'=>'NO_PLP', 'width'=>150,'hidden'=>true))                
                        ->addColumn(array('label'=>'Tgl.PLP','index'=>'TGL_PLP', 'width'=>150,'hidden'=>true))                
                        ->addColumn(array('label'=>'Surcharge (DG)','index'=>'DG_SURCHARGE', 'width'=>150,'hidden'=>true))
                        ->addColumn(array('label'=>'Surcharge (Weight)','index'=>'WEIGHT_SURCHARGE', 'width'=>150,'hidden'=>true))
                        ->addColumn(array('label'=>'Validasi','index'=>'VALIDASI', 'width'=>150,'hidden'=>true))                        
                        ->addColumn(array('label'=>'Tgl. Entry','index'=>'tglentry', 'width'=>120))
                        ->addColumn(array('label'=>'Jam. Entry','index'=>'jamentry', 'width'=>70,'hidden'=>true))
                        ->addColumn(array('label'=>'Updated','index'=>'last_update', 'width'=>150, 'search'=>false,'hidden'=>true))
                        ->renderGrid()
                    }}
                    
                    <div id="btn-toolbar" class="section-header btn-toolbar" role="toolbar" style="margin-top: 10px;">
                        <div id="btn-group-1" class="btn-group">
                            <button class="btn btn-default" id="btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>
                        </div>
                        <div id="btn-group-2" class="btn-group">
                            <button class="btn btn-default" id="btn-edit"><i class="fa fa-edit"></i> Edit</button>
                            <button class="btn btn-default" id="btn-delete"><i class="fa fa-minus"></i> Delete</button>
                        </div>
                        <div id="btn-group-3" class="btn-group toolbar-block">
                            <button class="btn btn-default" id="btn-save"><i class="fa fa-save"></i> Save</button>
                            <button class="btn btn-default" id="btn-reset"><i class="fa fa-close"></i> Cancel/Reset</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <form class="form-horizontal" id="manifest-form" action="{{ route('lcl-manifest-index') }}" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                        <input name="TCONTAINER_FK" type="hidden" value="{{ $container->TCONTAINER_PK }}">
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
                                    @foreach($perusahaans as $perusahaan)
                                        <option value="{{ $perusahaan->id }}">{{ $perusahaan->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Consignee</label>
                            <div class="col-sm-8">
                                <select class="form-control select2" id="TCONSIGNEE_FK" name="TCONSIGNEE_FK" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                    <option value="">Choose Consignee</option>
                                    @foreach($perusahaans as $perusahaan)
                                        <option value="{{ $perusahaan->id }}">{{ $perusahaan->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Notify Party</label>
                            <div class="col-sm-8">
                                <select class="form-control select2" id="TNOTIFYPARTY_FK" name="TNOTIFYPARTY_FK" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                    <option value="Same of Consignee">Same of Consignee</option>
                                    @foreach($perusahaans as $perusahaan)
                                        <option value="{{ $perusahaan->id }}">{{ $perusahaan->name }}</option>
                                    @endforeach
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
                                <select class="form-control select2" id="TPACKING_PK" name="TPACKING_PK" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
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
                            <label class="col-sm-3 control-label">No.BC11</label>
                            <div class="col-sm-3">
                                <input type="text" id="NO_BC11" name="NO_BC11" class="form-control" required>
                            </div>
                            <label class="col-sm-2 control-label">Tgl.BC11</label>
                            <div class="col-sm-3">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" id="TGL_BC11" name="TGL_BC11" class="form-control pull-right datepicker" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">No.PLP</label>
                            <div class="col-sm-3">
                                <input type="text" id="NO_PLP" name="NO_PLP" class="form-control" required>
                            </div>
                            <label class="col-sm-2 control-label">Tgl.PLP</label>
                            <div class="col-sm-3">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" id="TGL_PLP" name="TGL_PLP" class="form-control pull-right datepicker" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Surcharge(DG)</label>
                            <div class="col-sm-2">
                                <select class="form-control select2" id="DG_SURCHARGE" name="DG_SURCHARGE" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                    <option value="N">N</option>
                                    <option value="Y">Y</option>
                                </select>
                            </div>
                            <label class="col-sm-2 control-label">(Weight)</label>
                            <div class="col-sm-2">
                                <select class="form-control select2" id="WEIGHT_SURCHARGE" name="WEIGHT_SURCHARGE" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                    <option value="N">N</option>
                                    <option value="Y">Y</option>
                                </select>
                            </div>
                            <label class="col-sm-2 control-label">Validasi</label>
                            <div class="col-sm-2">
                                <select class="form-control select2" id="VALIDASI" name="VALIDASI" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
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
    $('.datepicker').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'yyyy-mm-dd' 
    });
</script>

@endsection