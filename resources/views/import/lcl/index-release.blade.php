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
        var ids = jQuery("#lclReleaseGrid").jqGrid('getDataIDs');   
            
        for(var i=0;i < ids.length;i++){ 
            var cl = ids[i];
            
            rowdata = $('#lclReleaseGrid').getRowData(cl);
            if(rowdata.VALIDASI == 'Y') {
                $("#" + cl).find("td").css("color", "#666");
            }
            if(rowdata.perubahan_hbl == 'Y') {
                $("#" + cl).find("td").css("background-color", "#3dc6f2");
            }
            if(rowdata.flag_bc == 'Y') {
                $("#" + cl).find("td").css("background-color", "#FF0000");
            }
            if(rowdata.status_bc == 'HOLD') {
                $("#" + cl).find("td").css("background-color", "#ffe500");
            }
            if(rowdata.status_bc == 'INSPECT') {
                $("#" + cl).find("td").css("background-color", "#3caea3");
            } 
              
            if(rowdata.photo_release != ''){
                vi = '<button style="margin:5px;" class="btn btn-default btn-xs approve-manifest-btn" data-id="'+cl+'" onclick="viewPhoto('+cl+')"><i class="fa fa-photo"></i> View Photo</button>';
            }else{
                vi = '<button style="margin:5px;" class="btn btn-default btn-xs approve-manifest-btn" disabled><i class="fa fa-photo"></i> Not Found</button>';
            }
            
            jQuery("#lclReleaseGrid").jqGrid('setRowData',ids[i],{photo:vi});
        } 
    }
    
    function viewPhoto(manifestID)
    {

        $.ajax({
            type: 'GET',
            dataType : 'json',
            url: '{{route("lcl-report-inout-view-photo","")}}/'+manifestID,
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Something went wrong, please try again later.');
            },
            beforeSend:function()
            {
                $('#release-photo').html('');
            },
            success:function(json)
            {
                if(json.data.photo_release){
                    var photos_release = $.parseJSON(json.data.photo_release);
                    var html_release = '';
                    $.each(photos_release, function(i, item) {
                        /// do stuff
                        html_release += '<img src="{{url("uploads/photos/manifest")}}/'+item+'" style="width: 200px;padding:5px;" />';
                    });
                    $('#release-photo').html(html_release);
                }
 
                $("#title-photo").html('PHOTO HBL NO. '+json.data.NOHBL);
            }
        });
        
        $('#view-photo-modal').modal('show');
    }
    
    function onSelectRowEvent()
    {
        $('#btn-group-1,#btn-group-6').enableButtonGroup();
    }
    
    $(document).ready(function()
    {
        $('#release-form').disabledFormGroup();
        $('#btn-toolbar,#btn-sppb, #btn-photo').disabledButtonGroup();
        $('#btn-group-3').enableButtonGroup();
        $(".hide-kddoc,#btn-group-7,#btn-group-8").hide();
        
        $("#KD_DOK_INOUT").on("change", function(){
            var $this = $(this).val();
            
            $('#NO_SPPB').val("");
            $('#TGL_SPPB').val("");
//            console.log($this);
            if($this == 9){
                $(".select-bcf-consignee").show();
            }else{
                $(".select-bcf-consignee").hide();
            }
            
            if($this == 2){
                $(".pabean-field").show();
            }else{
                $(".pabean-field").hide();
            }
            
            if($this){
                $(".hide-kddoc").show();
            }else{
                $(".hide-kddoc").hide();
            }
            
            if($this == 1){
                @role('super-admin')
                    
                @else
                    $('#NO_SPPB').attr('disabled','disabled');
                    $('#TGL_SPPB').attr('disabled','disabled');
                @endrole
            }else{
                if($this == ''){
                    $('#NO_SPPB').attr('disabled','disabled');
                    $('#TGL_SPPB').attr('disabled','disabled');
                }else{
                    $('#NO_SPPB').removeAttr('disabled');
                    $('#TGL_SPPB').removeAttr('disabled');
                }   
            }
        });
        
        $('#get-sppb-btn').click(function(){
            
            if(!confirm('Apakah anda yakin?')){return false;}
            
            var kd_dok = $("#KD_DOK_INOUT").val();
            if(kd_dok == ''){
                alert('Kode Dokumen masih kosong!!!');
                return false;
            }
            
            $this = $(this);
            $this.html('<i class="fa fa-spin fa-spinner"></i> Please wait...');
            $this.attr('disabled','disabled');

            var url = '{{ route("lcl-delivery-release-getdatasppb") }}';

            $.ajax({
                type: 'POST',
                data: 
                {
                    'id' : $('#TMANIFEST_PK').val(),
                    'kd_dok' : kd_dok,
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
                        
                        var datasppb = json.data; 
                        $('#NO_SPPB').val(datasppb.NO_SPPB);
                        $('#TGL_SPPB').val(datasppb.TGL_SPPB);
                        $('#ID_CONSIGNEE').val(datasppb.NPWP);
                    } else {
                      $('#btn-toolbar').showAlertAfterElement('alert-danger alert-custom', json.message, 5000);
                    }
                    
                    $this.html('<i class="fa fa-download"></i> Get Data');
                    $this.removeAttr('disabled');

                }
            });
        });
        
        $('#btn-edit').click(function() {
            //Gets the selected row id.
            rowid = $('#lclReleaseGrid').jqGrid('getGridParam', 'selrow');
            rowdata = $('#lclReleaseGrid').getRowData(rowid);
            
            if(!rowid) {alert('Please Select Row');return false;} 
            
            populateFormFields(rowdata, '');
            $('#TMANIFEST_PK').val(rowid);
            $('#NO_BC11').val(rowdata.NO_BC11);
            $('#TGL_BC11').val(rowdata.TGL_BC11);
            $('#NO_POS_BC11').val(rowdata.NO_POS_BC11);
            $('#no_pabean').val(rowdata.no_pabean);
            $('#tgl_pabean').val(rowdata.tgl_pabean);
            $('#ID_CONSIGNEE').val(rowdata.ID_CONSIGNEE);
            $('#NOPOL_RELEASE').val(rowdata.NOPOL_RELEASE);
            $('#PENAGIHAN').val(rowdata.PENAGIHAN).trigger("change");
            $('#LOKASI_TUJUAN').val(rowdata.LOKASI_TUJUAN).trigger("change");
            $('#REF_NUMBER_OUT').val(rowdata.REF_NUMBER_OUT);
            $('#UIDRELEASE').val(rowdata.UIDRELEASE);
            $('#KD_DOK_INOUT').val(rowdata.KD_DOK_INOUT).trigger('change');
            $('#NO_SPPB').val(rowdata.NO_SPPB);
            $('#TGL_SPPB').val(rowdata.TGL_SPPB);
            $('#bcf_consignee').val(rowdata.bcf_consignee).trigger('change');
            $('#telp_ppjk').val(rowdata.telp_ppjk);
            
            $('#upload-title').html('Upload Photo for '+rowdata.NOHBL);
            $('#no_hbl').val(rowdata.NOHBL);
            $('#id_hbl').val(rowdata.TMANIFEST_PK);
            $('#id_hold').val(rowdata.TMANIFEST_PK);
            $('#load_photos').html('');
            $('#delete_photo').val('N');
            
            if(rowdata.photo_release){
                var html = '';
                var photos = $.parseJSON(rowdata.photo_release);
                $.each(photos, function(i, item) {
                    /// do stuff
                    html += '<img src="{{url("uploads/photos/manifest")}}/'+item+'" style="width: 200px;padding:5px;" />';
                });
                $('#load_photos').html(html);
            }
            $('#btn-group-2,#btn-sppb,#btn-photo').enableButtonGroup();
            $('#release-form').enableFormGroup();
            $('#btn-group-4').enableButtonGroup();
            $('#btn-group-5').enableButtonGroup();
            
            if(rowdata.KD_DOK_INOUT == 1){
                @role('super-admin')
                    
                @else
                    $('#NO_SPPB').attr('disabled','disabled');
                    $('#TGL_SPPB').attr('disabled','disabled');
                @endrole
            }
            
            if(!rowdata.tglrelease && !rowdata.jamrelease) {

            }else{ 
                @role('super-admin')

                @else
                    $('#tglrelease').attr('disabled','disabled');
                    $('#jamrelease').attr('disabled','disabled');
                @endrole
            }
  
            if(rowdata.status_bc == 'HOLD'){
                $('#tglrelease').attr('disabled','disabled');
                $('#jamrelease').attr('disabled','disabled');
                $('#NOPOL_RELEASE').attr('disabled','disabled');
            }else{
//                $('#tglrelease').removeAttr('disabled');
//                $('#jamrelease').removeAttr('disabled');
//                $('#NOPOL_RELEASE').removeAttr('disabled');
            }
            
            if(rowdata.status_bc == 'INSPECT'){
                $('#btn-group-8').enableButtonGroup();     
                $("#btn-group-8").show();   
                $('#btn-group-7').disabledButtonGroup();     
                $("#btn-group-7").hide();
            }else{
                $('#btn-group-8').disabledButtonGroup();     
                $("#btn-group-8").hide();
                if(rowdata.status_bc != 'HOLD' && rowdata.KD_DOK_INOUT == 1){
                    $('#btn-group-7').enableButtonGroup();     
                    $("#btn-group-7").show();
                }else{
                    $('#btn-group-7').disabledButtonGroup();     
                    $("#btn-group-7").hide();
                }
            }

            if(rowdata.flag_bc == 'Y'){
                $('#btn-group-4').disabledButtonGroup();
                $('#btn-group-5').disabledButtonGroup();
                $('#btn-sppb,#btn-photo').disabledButtonGroup();
                $('#release-form').disabledFormGroup();
                $('#btn-group-2').disabledFormGroup();
            }            

            $('#telp_ppjk').removeAttr('disabled');
        });
        
        $('#btn-invoice').click(function() {
            if(!confirm('Apakah anda yakin?')){return false;}
            
            var manifestId = $('#TMANIFEST_PK').val();
            var url = '{{ route("lcl-delivery-release-invoice") }}';
            
            $.ajax({
                type: 'POST',
                data: 
                {
                    'id' : manifestId,
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
                }
            });
            
        });

        $('#btn-save').click(function() {
            
            if(!confirm('Apakah anda yakin?')){return false;}
            
            rowid = $('#lclReleaseGrid').jqGrid('getGridParam', 'selrow');
            rowdata = $('#lclReleaseGrid').getRowData(rowid);
            
            var nosppb = $('#NO_SPPB').val();
            var tglsppb = $('#TGL_SPPB').val();
            
//            if(nosppb && tglsppb){
            
                var manifestId = $('#TMANIFEST_PK').val();
                var url = "{{route('lcl-delivery-release-update','')}}/"+manifestId;

                $.ajax({
                    type: 'POST',
                    data: JSON.stringify($('#release-form').formToObject('')),
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
                
//            }else{
//                $('#btn-toolbar').showAlertAfterElement('alert-danger alert-custom', 'NO. SPPB & TGL. SPPB Belum diisi.', 5000);
//                return false;
//            }
        });
        
        $('#btn-cancel').click(function() {
            $('#btn-refresh').click();
        });
        
        $('#btn-refresh').click(function() {
            $('#lclReleaseGrid').jqGrid().trigger("reloadGrid");
            
            $('#release-form').disabledFormGroup();
            $('#btn-toolbar,#btn-sppb, #btn-photo').disabledButtonGroup();
            $('#btn-group-3').enableButtonGroup();
            
            $('#release-form')[0].reset();
            $('.select2').val(null).trigger("change");
            $('#TMANIFEST_PK').val("");
            
            $("#btn-group-7,#btn-group-8").hide();
        });
        
        $('#btn-print-sj').click(function() {
            var id = $('#lclReleaseGrid').jqGrid('getGridParam', 'selrow');
            var rowdata = $('#lclReleaseGrid').getRowData(id);
            
            if(rowdata.status_bc == 'INSPECT'){
                alert("Dokumen masih dalam pemeriksaan.");
                return false;
            }
            
            window.open("{{ route('lcl-delivery-suratjalan-cetak', '') }}/"+id,"preview wo fiat muat","width=600,height=600,menubar=no,status=no,scrollbars=yes");
        });
        
        $('#btn-print-wo').click(function() {
            var id = $('#lclReleaseGrid').jqGrid('getGridParam', 'selrow');
            window.open("{{ route('lcl-delivery-fiatmuat-cetak', '') }}/"+id,"preview wo fiat muat","width=600,height=600,menubar=no,status=no,scrollbars=yes");   
        });
        
        $('#btn-print-barcode').click(function() {

            var $grid = $("#lclReleaseGrid"), selIds = $grid.jqGrid("getGridParam", "selarrrow"), i, n,
                cellValues = [];
            for (i = 0, n = selIds.length; i < n; i++) {
                cellValues.push($grid.jqGrid("getCell", selIds[i], "TMANIFEST_PK"));
            }
            
            var manifestId = cellValues.join(",");
            
            if(!manifestId) {alert('Please Select Row');return false;}               

            if(cellValues.length > 1){
            if(!confirm('Apakah anda yakin?')){return false;}    
                window.open("{{ route('cetak-barcode', array('','','')) }}/"+manifestId+"/manifest/release","preview barcode","width=305,height=600,menubar=no,status=no,scrollbars=yes");
            }else{
                var rowdata = $('#lclReleaseGrid').getRowData(manifestId);
                $('#barcode_no_hbl').html(rowdata.NOHBL);
                $('#id_hbl_barcode').val(rowdata.TMANIFEST_PK);
            
                $('#print-barcode-modal').modal('show');
            }
        });
        
        $('#print-barcode-single').click(function(){
            var manifestId = $("#id_hbl_barcode").val();
            var car = $("#jumlah_mobil").val();
            $('#print-barcode-modal').modal('hide');
            
            window.open("{{ route('cetak-barcode', array('','','')) }}/"+manifestId+"/manifest/release/"+car,"preview barcode","width=305,height=600,menubar=no,status=no,scrollbars=yes");
        });
        
        $('#btn-upload').click(function() {
            
            if(!confirm('Apakah anda yakin?')){return false;}

            var url = '{{ route("lcl-delivery-release-upload") }}';

            $.ajax({
                type: 'POST',
                data: 
                {
                    'id' : $('#TMANIFEST_PK').val(),
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
//                    console.log(json);

                    if(json.success) {
                      $('#btn-toolbar').showAlertAfterElement('alert-success alert-custom', json.message, 5000);
                    } else {
                      $('#btn-toolbar').showAlertAfterElement('alert-danger alert-custom', json.message, 5000);
                    }

                    //Triggers the "Close" button funcionality.
                    $('#btn-refresh').click();
                    
                    $('#tpsonline-modal-text').html(json.message+', Apakah anda ingin mengirimkan CODECO Kemasan XML data sekarang?');
                    $("#tpsonline-send-btn").attr("href", "{{ route('tps-codecoKms-upload','') }}/"+json.insert_id);
                    
                    $('#tpsonline-modal').modal('show');
                }
            });
            
        });
        
        $("#btn-unhold").on("click", function(e){
            e.preventDefault();
            if(!confirm('Apakah anda yakin pemeriksaan sudah selesai?')){return false;}
            
            var url = '{{ route("lcl-release-unhold") }}';

            $.ajax({
                type: 'POST',
                data: 
                {
                    'id' : $('#TMANIFEST_PK').val(),
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

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">LCL Delivery Release</h3>
<!--        <div class="box-tools">
            <a href="{{ route('lcl-manifest-create') }}" type="button" class="btn btn-block btn-info btn-sm"><i class="fa fa-plus"></i> Add New</a>
        </div>-->
    </div>
    <div class="box-body">
        @role('bea-cukai')
        <div class="row">
            <div class="col-md-12"> 
                {{
                    GridRender::setGridId("lclReleaseGrid")
                    ->enableFilterToolbar()
                    ->setGridOption('mtype', 'POST')
                    ->setGridOption('url', URL::to('/lcl/manifest/grid-data?module=release&_token='.csrf_token()))
                    ->setGridOption('rowNum', 20)
                    ->setGridOption('shrinkToFit', true)
                    ->setGridOption('sortname','TMANIFEST_PK')
                    ->setGridOption('rownumbers', true)
                    ->setGridOption('rownumWidth', 50)
                    ->setGridOption('height', '395')
                    ->setGridOption('rowList',array(20,50,100))
                    ->setGridOption('useColSpanStyle', true)
                    ->setNavigatorOptions('navigator', array('viewtext'=>'view'))
                    ->setNavigatorOptions('view',array('closeOnEscape'=>false))
                    ->setFilterToolbarOptions(array('autosearch'=>true))
                    ->setGridEvent('gridComplete', 'gridCompleteEvent')
                    ->setGridEvent('onSelectRow', 'onSelectRowEvent')
                    ->addColumn(array('key'=>true,'index'=>'TMANIFEST_PK','hidden'=>true))
                    ->addColumn(array('label'=>'Photo','index'=>'photo', 'width'=>120, 'search'=>false, 'sortable'=>false, 'align'=>'center'))
                    ->addColumn(array('label'=>'Status BC','index'=>'status_bc','width'=>100, 'align'=>'center'))
                    ->addColumn(array('label'=>'Segel Merah','index'=>'flag_bc','width'=>80, 'align'=>'center'))
                    ->addColumn(array('label'=>'Validasi','index'=>'VALIDASI','width'=>80, 'align'=>'center'))
                    ->addColumn(array('label'=>'No. SPK','index'=>'NOJOBORDER', 'width'=>150,'hidden'=>false))
                    ->addColumn(array('label'=>'No. Container','index'=>'NOCONTAINER', 'width'=>150,'hidden'=>false))
                    ->addColumn(array('label'=>'Vessel','index'=>'VESSEL','width'=>120,'align'=>'center'))
                    ->addColumn(array('label'=>'TPS Asal','index'=>'KD_TPS_ASAL','width'=>80,'align'=>'center'))
                    ->addColumn(array('label'=>'No. MBL','index'=>'NOMBL','width'=>160,'hidden'=>true))
                    ->addColumn(array('label'=>'Tgl. MBL','index'=>'TGL_MASTER_BL', 'width'=>150,'hidden'=>true, 'align'=>'center'))
                    ->addColumn(array('label'=>'No. HBL','index'=>'NOHBL','width'=>160))
                    ->addColumn(array('label'=>'Tgl. HBL','index'=>'TGL_HBL', 'width'=>150,'hidden'=>false, 'align'=>'center'))
                    ->addColumn(array('label'=>'No. Tally','index'=>'NOTALLY','width'=>160,'hidden'=>true))
                    
                    ->addColumn(array('label'=>'Consolidator','index'=>'NAMACONSOLIDATOR','width'=>250))
                    ->addColumn(array('label'=>'Consignee','index'=>'CONSIGNEE','width'=>250))
                    ->addColumn(array('label'=>'Weight','index'=>'WEIGHT', 'width'=>120, 'align'=>'center'))               
                    ->addColumn(array('label'=>'Meas','index'=>'MEAS', 'width'=>120, 'align'=>'center'))
                    ->addColumn(array('label'=>'Qty','index'=>'QUANTITY', 'width'=>80,'align'=>'center'))
                    ->addColumn(array('label'=>'Packing','index'=>'NAMAPACKING', 'width'=>120, 'align'=>'center'))
                    ->addColumn(array('label'=>'Kode Kemas','index'=>'KODE_KEMAS', 'width'=>100,'align'=>'center'))
                    ->addColumn(array('label'=>'No.PLP','index'=>'NO_PLP', 'width'=>120,'hidden'=>false, 'align'=>'center'))                
                    ->addColumn(array('label'=>'Tgl.PLP','index'=>'TGL_PLP', 'width'=>120,'hidden'=>false, 'align'=>'center'))
                    ->addColumn(array('label'=>'No.BC11','index'=>'NO_BC11', 'width'=>120,'hidden'=>false, 'align'=>'center'))
                    ->addColumn(array('label'=>'Tgl.BC11','index'=>'TGL_BC11', 'width'=>120,'hidden'=>false, 'align'=>'center'))
                    ->addColumn(array('label'=>'No.POS BC11','index'=>'NO_POS_BC11', 'width'=>120, 'align'=>'center'))
                    ->addColumn(array('label'=>'No. SPPB','index'=>'NO_SPPB', 'width'=>120,'hidden'=>false, 'align'=>'center'))
                    ->addColumn(array('label'=>'Tgl. SPPB','index'=>'TGL_SPPB', 'width'=>120,'hidden'=>false, 'align'=>'center'))
                    ->addColumn(array('label'=>'Kode Dokumen','index'=>'KD_DOK_INOUT', 'width'=>120,'hidden'=>false, 'align'=>'center'))
                    ->addColumn(array('label'=>'Nama Dokumen','index'=>'KODE_DOKUMEN', 'width'=>150,'hidden'=>false, 'align'=>'center'))  
                    ->addColumn(array('label'=>'Tgl. Release','index'=>'tglrelease', 'width'=>120, 'align'=>'center'))
                    ->addColumn(array('label'=>'Jam. Release','index'=>'jamrelease', 'width'=>120,'hidden'=>false, 'align'=>'center'))
                    ->addColumn(array('label'=>'No. POL','index'=>'NOPOL_RELEASE', 'width'=>100,'hidden'=>false, 'align'=>'center'))
                    ->addColumn(array('index'=>'location_id', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('label'=>'Location','index'=>'location_name','width'=>200, 'align'=>'center'))
                    ->addColumn(array('label'=>'No. Pabean','index'=>'no_pabean', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('label'=>'Tgl. Pabean','index'=>'tgl_pabean', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('label'=>'No. SPJM','index'=>'NO_SPJM', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('label'=>'Tgl. SPJM','index'=>'TGL_SPJM', 'width'=>150,'hidden'=>true))
               
                    ->addColumn(array('label'=>'Kode Kuitansi','index'=>'NO_KUITANSI', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('label'=>'Shipper','index'=>'SHIPPER','width'=>160,'hidden'=>true))
                    ->addColumn(array('label'=>'Notify Party','index'=>'NOTIFYPARTY','width'=>160,'hidden'=>true))
                    
                    ->addColumn(array('label'=>'No. Rack','index'=>'RACKING', 'width'=>150,'hidden'=>true)) 
                    ->addColumn(array('label'=>'UID','index'=>'UID', 'width'=>150,'hidden'=>true))          
                    ->addColumn(array('index'=>'TSHIPPER_FK', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('index'=>'TCONSIGNEE_FK', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('label'=>'Consignee','index'=>'CONSIGNEE', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('label'=>'NPWP Consignee','index'=>'ID_CONSIGNEE', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('index'=>'TNOTIFYPARTY_FK', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('index'=>'TPACKING_FK', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('label'=>'Marking','index'=>'MARKING', 'width'=>150,'hidden'=>true)) 
                    ->addColumn(array('label'=>'Desc of Goods','index'=>'DESCOFGOODS', 'width'=>150,'hidden'=>true))              
                    ->addColumn(array('label'=>'Tgl.Behandle','index'=>'tglbehandle', 'width'=>150,'hidden'=>true)) 
                    ->addColumn(array('label'=>'Surcharge (DG)','index'=>'DG_SURCHARGE', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('label'=>'Surcharge (Weight)','index'=>'WEIGHT_SURCHARGE', 'width'=>150,'hidden'=>true))
                    
                    ->addColumn(array('label'=>'Nama EMKL','index'=>'NAMAEMKL', 'width'=>150,'hidden'=>true)) 
                    ->addColumn(array('label'=>'Telp. EMKL','index'=>'TELPEMKL', 'width'=>150,'hidden'=>true)) 
                    ->addColumn(array('label'=>'Telp. PPJK','index'=>'telp_ppjk', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('label'=>'No. Truck','index'=>'NOPOL', 'width'=>150,'hidden'=>true)) 
                    ->addColumn(array('label'=>'No. POL Release','index'=>'NOPOL_RELEASE', 'width'=>150,'hidden'=>true)) 
                    ->addColumn(array('label'=>'Tgl. Surat Jalan','index'=>'TGLSURATJALAN', 'width'=>120,'hidden'=>true))
                    ->addColumn(array('label'=>'Jam. Surat Jalan','index'=>'JAMSURATJALAN', 'width'=>70,'hidden'=>true))
                    ->addColumn(array('label'=>'Petugas Surat Jalan','index'=>'UIDSURATJALAN', 'width'=>70,'hidden'=>true))
                    ->addColumn(array('label'=>'Petugas Release','index'=>'UIDRELEASE', 'width'=>120,'hidden'=>false, 'align'=>'center'))
                    ->addColumn(array('label'=>'Penagihan','index'=>'PENAGIHAN', 'width'=>70,'hidden'=>true))
                    ->addColumn(array('label'=>'BCF Consignee','index'=>'bcf_consignee', 'width'=>70,'hidden'=>true))
                    ->addColumn(array('label'=>'Ref Number','index'=>'REF_NUMBER_OUT', 'width'=>70,'hidden'=>true))
                    ->addColumn(array('label'=>'Tgl. Fiat Muat','index'=>'tglfiat', 'width'=>120,'hidden'=>true))
                    ->addColumn(array('label'=>'Jam. Fiat Muat','index'=>'jamfiat', 'width'=>70,'hidden'=>true))
                    ->addColumn(array('label'=>'Tgl. Entry','index'=>'tglentry', 'width'=>120, 'align'=>'center'))
                    ->addColumn(array('label'=>'Jam. Entry','index'=>'jamentry', 'width'=>120,'hidden'=>false, 'align'=>'center'))
                    ->addColumn(array('label'=>'Perubahan HBL','index'=>'perubahan_hbl','width'=>100, 'align'=>'center'))
                    ->addColumn(array('label'=>'Alasan Perubahan','index'=>'alasan_perubahan','width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'Alasan Segel','index'=>'alasan_segel','width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'Photo Release','index'=>'photo_release', 'width'=>70,'hidden'=>true))
                    ->addColumn(array('label'=>'Lokasi Tujuan','index'=>'LOKASI_TUJUAN', 'width'=>70,'hidden'=>true))
                    ->addColumn(array('label'=>'Updated','index'=>'last_update', 'width'=>150, 'search'=>false,'hidden'=>true))
                    ->renderGrid()
                }}
            </div>
        </div>
        @else
        <div class="row" style="margin-bottom: 30px;">
            <div class="col-md-12"> 
                {{
                    GridRender::setGridId("lclReleaseGrid")
                    ->enableFilterToolbar()
                    ->setGridOption('mtype', 'POST')
                    ->setGridOption('url', URL::to('/lcl/manifest/grid-data?module=release&_token='.csrf_token()))
                    ->setGridOption('rowNum', 20)
                    ->setGridOption('shrinkToFit', true)
                    ->setGridOption('sortname','TMANIFEST_PK')
                    ->setGridOption('rownumbers', true)
                    ->setGridOption('rownumWidth', 50)
                    ->setGridOption('multiselect', true)
                    ->setGridOption('height', '300')
                    ->setGridOption('rowList',array(20,50,100))
                    ->setGridOption('useColSpanStyle', true)
                    ->setNavigatorOptions('navigator', array('viewtext'=>'view'))
                    ->setNavigatorOptions('view',array('closeOnEscape'=>false))
                    ->setFilterToolbarOptions(array('autosearch'=>true))
                    ->setGridEvent('gridComplete', 'gridCompleteEvent')
                    ->setGridEvent('onSelectRow', 'onSelectRowEvent')
                    ->addColumn(array('key'=>true,'index'=>'TMANIFEST_PK','hidden'=>true))
                    ->addColumn(array('label'=>'Photo','index'=>'photo', 'width'=>120, 'search'=>false, 'sortable'=>false, 'align'=>'center'))
                    ->addColumn(array('label'=>'Status BC','index'=>'status_bc','width'=>100, 'align'=>'center'))
                    ->addColumn(array('label'=>'Segel Merah','index'=>'flag_bc','width'=>80, 'align'=>'center'))
                    ->addColumn(array('label'=>'Validasi','index'=>'VALIDASI','width'=>80, 'align'=>'center','hidden'=>false))
                    ->addColumn(array('label'=>'No. SPK','index'=>'NOJOBORDER', 'width'=>150,'hidden'=>false))
                    ->addColumn(array('label'=>'No. Container','index'=>'NOCONTAINER', 'width'=>150,'hidden'=>false))
                    ->addColumn(array('label'=>'Vessel','index'=>'VESSEL','width'=>120,'align'=>'center'))
                    ->addColumn(array('label'=>'TPS Asal','index'=>'KD_TPS_ASAL','width'=>80,'align'=>'center'))
                    ->addColumn(array('label'=>'No. MBL','index'=>'NOMBL','width'=>160,'hidden'=>false))
                    ->addColumn(array('label'=>'Tgl. MBL','index'=>'TGL_MASTER_BL', 'width'=>150,'hidden'=>true, 'align'=>'center'))
                    ->addColumn(array('label'=>'No. HBL','index'=>'NOHBL','width'=>160))
                    ->addColumn(array('label'=>'Tgl. HBL','index'=>'TGL_HBL', 'width'=>150,'hidden'=>false, 'align'=>'center'))
                    ->addColumn(array('label'=>'No. Tally','index'=>'NOTALLY','width'=>160,'hidden'=>true))
                    
                    ->addColumn(array('label'=>'Consolidator','index'=>'NAMACONSOLIDATOR','width'=>250))
                    ->addColumn(array('label'=>'Consignee','index'=>'CONSIGNEE','width'=>250))
                    ->addColumn(array('label'=>'Weight','index'=>'WEIGHT', 'width'=>120, 'align'=>'center'))               
                    ->addColumn(array('label'=>'Meas','index'=>'MEAS', 'width'=>120, 'align'=>'center'))
                    ->addColumn(array('label'=>'Qty','index'=>'QUANTITY', 'width'=>80,'align'=>'center'))
                    ->addColumn(array('label'=>'Packing','index'=>'NAMAPACKING', 'width'=>120, 'align'=>'center'))
                    ->addColumn(array('label'=>'Kode Kemas','index'=>'KODE_KEMAS', 'width'=>100,'align'=>'center'))
                    ->addColumn(array('label'=>'No.PLP','index'=>'NO_PLP', 'width'=>120,'hidden'=>false, 'align'=>'center'))                
                    ->addColumn(array('label'=>'Tgl.PLP','index'=>'TGL_PLP', 'width'=>120,'hidden'=>false, 'align'=>'center'))
                    ->addColumn(array('label'=>'No.BC11','index'=>'NO_BC11', 'width'=>120,'hidden'=>false, 'align'=>'center'))
                    ->addColumn(array('label'=>'Tgl.BC11','index'=>'TGL_BC11', 'width'=>120,'hidden'=>false, 'align'=>'center'))
                    ->addColumn(array('label'=>'No.POS BC11','index'=>'NO_POS_BC11', 'width'=>120, 'align'=>'center'))
                    ->addColumn(array('label'=>'No. SPPB','index'=>'NO_SPPB', 'width'=>120,'hidden'=>false, 'align'=>'center'))
                    ->addColumn(array('label'=>'Tgl. SPPB','index'=>'TGL_SPPB', 'width'=>120,'hidden'=>false, 'align'=>'center'))
                    ->addColumn(array('label'=>'Kode Dokumen','index'=>'KD_DOK_INOUT', 'width'=>120,'hidden'=>true, 'align'=>'center'))
                    ->addColumn(array('label'=>'Nama Dokumen','index'=>'KODE_DOKUMEN', 'width'=>150,'hidden'=>false, 'align'=>'center'))  
                    ->addColumn(array('label'=>'Tgl. Release','index'=>'tglrelease', 'width'=>120, 'align'=>'center'))
                    ->addColumn(array('label'=>'Jam. Release','index'=>'jamrelease', 'width'=>120,'hidden'=>false, 'align'=>'center'))
                    ->addColumn(array('label'=>'No. POL','index'=>'NOPOL_RELEASE', 'width'=>100,'hidden'=>false, 'align'=>'center'))
                    ->addColumn(array('index'=>'location_id', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('label'=>'Location','index'=>'location_name','width'=>200, 'align'=>'center'))
                    ->addColumn(array('label'=>'No. Pabean','index'=>'no_pabean', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('label'=>'Tgl. Pabean','index'=>'tgl_pabean', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('label'=>'No. SPJM','index'=>'NO_SPJM', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('label'=>'Tgl. SPJM','index'=>'TGL_SPJM', 'width'=>150,'hidden'=>true))
               
                    ->addColumn(array('label'=>'Kode Kuitansi','index'=>'NO_KUITANSI', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('label'=>'Shipper','index'=>'SHIPPER','width'=>160,'hidden'=>true))
                    ->addColumn(array('label'=>'Notify Party','index'=>'NOTIFYPARTY','width'=>160,'hidden'=>true))
                    
                    ->addColumn(array('label'=>'No. Rack','index'=>'RACKING', 'width'=>150,'hidden'=>true)) 
                    ->addColumn(array('label'=>'UID','index'=>'UID', 'width'=>150,'hidden'=>true))          
                    ->addColumn(array('index'=>'TSHIPPER_FK', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('index'=>'TCONSIGNEE_FK', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('label'=>'Consignee','index'=>'CONSIGNEE', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('label'=>'NPWP Consignee','index'=>'ID_CONSIGNEE', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('index'=>'TNOTIFYPARTY_FK', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('index'=>'TPACKING_FK', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('label'=>'Marking','index'=>'MARKING', 'width'=>150,'hidden'=>true)) 
                    ->addColumn(array('label'=>'Desc of Goods','index'=>'DESCOFGOODS', 'width'=>150,'hidden'=>true))              
                    
                    ->addColumn(array('label'=>'Tgl.Behandle','index'=>'tglbehandle', 'width'=>150,'hidden'=>true)) 
                    ->addColumn(array('label'=>'Surcharge (DG)','index'=>'DG_SURCHARGE', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('label'=>'Surcharge (Weight)','index'=>'WEIGHT_SURCHARGE', 'width'=>150,'hidden'=>true))
                    
                    ->addColumn(array('label'=>'Nama EMKL','index'=>'NAMAEMKL', 'width'=>150,'hidden'=>true)) 
                    ->addColumn(array('label'=>'Telp. EMKL','index'=>'TELPEMKL', 'width'=>150,'hidden'=>true)) 
                    ->addColumn(array('label'=>'Telp. PPJK','index'=>'telp_ppjk', 'width'=>150,'hidden'=>true))
                    ->addColumn(array('label'=>'No. Truck','index'=>'NOPOL', 'width'=>150,'hidden'=>true)) 
                    ->addColumn(array('label'=>'No. POL Release','index'=>'NOPOL_RELEASE', 'width'=>150,'hidden'=>true)) 
                    ->addColumn(array('label'=>'Tgl. Surat Jalan','index'=>'TGLSURATJALAN', 'width'=>120,'hidden'=>true))
                    ->addColumn(array('label'=>'Jam. Surat Jalan','index'=>'JAMSURATJALAN', 'width'=>70,'hidden'=>true))
                    ->addColumn(array('label'=>'Petugas Surat Jalan','index'=>'UIDSURATJALAN', 'width'=>70,'hidden'=>true))
                    ->addColumn(array('label'=>'Petugas Release','index'=>'UIDRELEASE', 'width'=>120,'hidden'=>false, 'align'=>'center'))
                    ->addColumn(array('label'=>'Penagihan','index'=>'PENAGIHAN', 'width'=>70,'hidden'=>true))
                    ->addColumn(array('label'=>'BCF Consignee','index'=>'bcf_consignee', 'width'=>70,'hidden'=>true))
                    ->addColumn(array('label'=>'Ref Number','index'=>'REF_NUMBER_OUT', 'width'=>70,'hidden'=>true))
                    ->addColumn(array('label'=>'Tgl. Fiat Muat','index'=>'tglfiat', 'width'=>120,'hidden'=>true))
                    ->addColumn(array('label'=>'Jam. Fiat Muat','index'=>'jamfiat', 'width'=>70,'hidden'=>true))
                    ->addColumn(array('label'=>'Tgl. Entry','index'=>'tglentry', 'width'=>120, 'align'=>'center','hidden'=>true))
                    ->addColumn(array('label'=>'Jam. Entry','index'=>'jamentry', 'width'=>120,'hidden'=>true, 'align'=>'center'))
                    ->addColumn(array('label'=>'Perubahan HBL','index'=>'perubahan_hbl','width'=>100, 'align'=>'center'))
                    ->addColumn(array('label'=>'Alasan Perubahan','index'=>'alasan_perubahan','width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'Alasan Segel','index'=>'alasan_segel','width'=>150,'align'=>'center'))
                    ->addColumn(array('label'=>'Photo Release','index'=>'photo_release', 'width'=>70,'hidden'=>true))
                    ->addColumn(array('label'=>'Lokasi Tujuan','index'=>'LOKASI_TUJUAN', 'width'=>70,'hidden'=>true))
                    ->addColumn(array('label'=>'Updated','index'=>'last_update', 'width'=>150, 'search'=>false,'hidden'=>true))
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
                    <div id="btn-group-4" class="btn-group">
                        <button class="btn btn-default" id="btn-print-wo"><i class="fa fa-print"></i> Cetak WO</button>
                        <button class="btn btn-default" id="btn-print-sj"><i class="fa fa-print"></i> Cetak Surat Jalan</button>
                    </div>
                    <div id="btn-group-6" class="btn-group">
                        <button class="btn btn-danger" id="btn-print-barcode"><i class="fa fa-print"></i> Print Barcode</button>
                    </div>
                    <div id="btn-group-5" class="btn-group pull-right">
                        <button class="btn btn-success" id="btn-upload"><i class="fa fa-upload"></i> Upload TPS Online</button>
                    </div>
                    <div id="btn-group-7" class="btn-group pull-right" style="display: none;">
                        <button class="btn btn-warning" id="btn-hold"><i class="fa fa-lock"></i> Inspection</button>
                    </div> 
                    <div id="btn-group-8" class="btn-group pull-right" style="display: none;">
                        <button class="btn btn-info" id="btn-unhold"><i class="fa fa-unlock"></i> Inspection Complete</button>
                    </div>
                </div>
            </div>
            
        </div>
        <form class="form-horizontal" id="release-form" action="{{ route('lcl-delivery-release-index') }}" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    <input id="TMANIFEST_PK" name="TMANIFEST_PK" type="hidden">
                    <input name="delete_photo" id="delete_photo" value="N" type="hidden">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. HBL</label>
                        <div class="col-sm-8">
                            <input type="text" id="NOHBL" name="NOHBL" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. SPK</label>
                        <div class="col-sm-8">
                            <input type="text" id="NOJOBORDER" name="NOJOBORDER" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. Container</label>
                        <div class="col-sm-8">
                            <input type="text" id="NOCONTAINER" name="NOCONTAINER" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. Tally</label>
                        <div class="col-sm-8">
                            <input type="text" id="NOTALLY" name="NOTALLY" class="form-control" readonly>
                        </div>
                    </div>
<!--                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl.Surat Jalan</label>
                        <div class="col-sm-8">
                            <input type="text" id="TGLSURATJALAN" name="TGLSURATJALAN" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Jam Surat Jalan</label>
                        <div class="col-sm-8">
                            <input type="text" id="JAMSURATJALAN" name="JAMSURATJALAN" class="form-control" readonly>
                        </div>
                    </div>-->
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No.BC11</label>
                        <div class="col-sm-3">
                            <input type="text" id="NO_BC11" name="NO_BC11" class="form-control" readonly>
                        </div>
                        <label class="col-sm-2 control-label">Tgl.BC11</label>
                        <div class="col-sm-3">
                            <input type="text" id="TGL_BC11" name="TGL_BC11" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. POS BC11</label>
                        <div class="col-sm-8">
                            <input type="text" id="NO_POS_BC11" name="NO_POS_BC11" class="form-control">
                        </div>
                    </div>
<!--                    <div class="form-group">
                        <label class="col-sm-3 control-label">No.SPJM</label>
                        <div class="col-sm-3">
                            <input type="text" id="NO_SPJM" name="NO_SPJM" class="form-control" readonly>
                        </div>
                        <label class="col-sm-2 control-label">Tgl.SPJM</label>
                        <div class="col-sm-3">
                            <input type="text" id="TGL_SPJM" name="TGL_SPJM" class="form-control" readonly>
                        </div>
                    </div>-->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Consolidator</label>
                        <div class="col-sm-8">
                            <input type="text" id="NAMACONSOLIDATOR" name="NAMACONSOLIDATOR" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Consignee</label>
                        <div class="col-sm-8">
                            <input type="text" id="CONSIGNEE" name="CONSIGNEE" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">NPWP Consignee</label>
                        <div class="col-sm-8">
                            <input type="text" id="ID_CONSIGNEE" name="ID_CONSIGNEE" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Telp. PPJK</label>
                        <div class="col-sm-8">
                            <input type="text" id="telp_ppjk" name="telp_ppjk" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kode Dokumen</label>
                        <div class="col-sm-8">
                            <select class="form-control select2" id="KD_DOK_INOUT" name="KD_DOK_INOUT" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                <option value="">Choose Document</option>
                                @foreach($kode_doks as $kode)
                                    <option value="{{ $kode->kode }}">({{$kode->kode}}) {{ $kode->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group hide-kddoc">
                        <div class="col-sm-11" id="btn-sppb">
                            <button type="button" class="btn btn-info pull-right" id="get-sppb-btn"><i class="fa fa-download"></i> Get Data</button>
                        </div>
                    </div>
                    <div class="form-group hide-kddoc">
                        <label class="col-sm-3 control-label">No.SPPB/BC.23</label>
                        <div class="col-sm-8">
                            <input type="text" id="NO_SPPB" name="NO_SPPB" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group hide-kddoc">
                        <label class="col-sm-3 control-label">Tgl.SPPB/BC.23</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" id="TGL_SPPB" name="TGL_SPPB" class="form-control pull-right datepicker" required>
                            </div>
                        </div>
                    </div>
                    
<!--                    <div class="form-group">
                        <label class="col-sm-3 control-label">Status BC</label>
                        <div class="col-sm-8">
                            <select class="form-control select2" id="status_bc" name="status_bc" style="width: 100%;" tabindex="-1" aria-hidden="true" required disabled>
                                <option value="">Choose Status</option>
                                <option value="HOLD">HOLD</option>
                                <option value="RELEASE">RELEASE</option>
                            </select>
                        </div>
                    </div>-->
                    <div class="form-group select-bcf-consignee" style="display:none;">
                        <label class="col-sm-3 control-label">BCF 1.5 Consignee</label>
                        <div class="col-sm-8">
                            <select class="form-control select2" id="bcf_consignee" name="bcf_consignee" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                <option value="">Choose Consignee</option>
                                <option value="PT. LAYANAN LANCAR LINTAS LOGISTINDO">PT. LAYANAN LANCAR LINTAS LOGISTINDO</option>
                                <option value="PT. MULTI SEJAHTERA ABADI">PT. MULTI SEJAHTERA ABADI</option>
                                <option value="PT. TRANSCON INDONESIA">PT. TRANSCON INDONESIA</option>
                                <option value="PT. TRI PANDU PELITA">PT. TRI PANDU PELITA</option>
                            </select>
                        </div>
                    </div>
<!--                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. Kuitansi</label>
                        <div class="col-sm-8">
                            <input type="text" id="NO_KUITANSI" name="NO_KUITANSI" class="form-control" required>
                        </div>
                    </div>-->
                    <div class="form-group hide-kddoc">
                        <label class="col-sm-3 control-label">Ref. Number</label>
                        <div class="col-sm-8">
                            <input type="text" id="REF_NUMBER_OUT" name="REF_NUMBER_OUT" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6"> 
                    <div class="form-group pabean-field" style="display:none;">
                        <label class="col-sm-3 control-label">No. Pabean</label>
                        <div class="col-sm-8">
                            <input type="text" id="no_pabean" name="no_pabean" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group pabean-field" style="display:none;">
                        <label class="col-sm-3 control-label">Tgl. Pabean</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" id="tgl_pabean" name="tgl_pabean" class="form-control pull-right datepicker" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group hide-kddoc">
                        <label class="col-sm-3 control-label">Tgl.Release</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" id="tglrelease" name="tglrelease" class="form-control pull-right datepicker" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bootstrap-timepicker hide-kddoc">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Jam Release</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="text" id="jamrelease" name="jamrelease" class="form-control timepicker" required>
                                    <div class="input-group-addon">
                                          <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group hide-kddoc">
                        <label class="col-sm-3 control-label">Petugas</label>
                        <div class="col-sm-8">
                            <input type="text" id="UIDRELEASE" name="UIDRELEASE" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group hide-kddoc">
                        <label class="col-sm-3 control-label">No. POL</label>
                        <div class="col-sm-8">
                            <input type="text" id="NOPOL_RELEASE" name="NOPOL_RELEASE" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group hide-kddoc" id="btn-photo">
                        <label class="col-sm-3 control-label">Photo</label>
                        <div class="col-sm-8">
                            <button type="button" class="btn btn-warning" id="upload-photo-btn">Upload Photo</button>
                            <button type="button" class="btn btn-danger" id="delete-photo-btn">Delete Photo</button>
                        </div>
                    </div>
                    <div class="form-group hide-kddoc">
                        <div class="col-sm-12">
                            <div id="load_photos" style="text-align: center;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </form>  
        @endrole
    </div>
</div>
<div id="photo-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="modal">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="upload-title"></h4>
            </div>
            <form class="form-horizontal" id="upload-photo-form" action="{{ route('lcl-manifest-upload-photo','photo_release') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-body"> 
                    <div class="row">
                        <div class="col-md-12">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            <input type="hidden" id="id_hbl" name="id_hbl" required>   
                            <input type="hidden" id="no_hbl" name="no_hbl" required>    
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Photo</label>
                                <div class="col-sm-8">
                                    <input type="file" name="photos[]" class="form-control" multiple="true" required>
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div id="view-photo-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="title-photo">Photo</h4>
            </div>
            <div class="modal-body"> 
                <div class="row">
                    <div class="col-md-12">
                        <h4>RELEASE</h4>
                        <div id="release-photo"></div>
                    </div>
                </div>
            </div>    
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->    
<div id="print-barcode-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="title-photo">Print Barcode <span id="barcode_no_hbl"></span></h4>
            </div>
            <div class="modal-body"> 
                <div class="row">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    <input type="hidden" id="id_hbl_barcode" required>   
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Jumlah Mobil</label>
                        <div class="col-sm-8">
                            <input type="number" id="jumlah_mobil" name="jumlah_mobil" class="form-control" value="1" />
                        </div>
                    </div>
                </div>
            </div>    
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" id="print-barcode-single" class="btn btn-primary">Create</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 
<div id="hold-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Inspection Document BC 2.0</h4>
            </div>
            <form class="form-horizontal" method="POST" id="hold-form" action="{{ route('lcl-release-hold') }}">
                <input name="_token" type="hidden" value="{{ csrf_token() }}">
                <input type="hidden" id="id_hold" name="id_hold" required>
                <div class="modal-body"> 
                    <div class="row">                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Description</label>
                                <div class="col-sm-8">
                                    <textarea name="inspect_desc" class="form-control" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-warning"><i class="fa fa-lock"></i> Inspection</button>
                </div>
            </form>
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
    
    $("#upload-photo-btn").on("click", function(e){
        e.preventDefault();
        $("#photo-modal").modal('show');
        return false;
    });
    
    $("#delete-photo-btn").on("click", function(e){
        if(!confirm('Apakah anda yakin akan menghapus photo?')){return false;}
        
        $('#load_photos').html('');
        $('#delete_photo').val('Y');
    });
    
    $("#btn-hold").on("click", function(e){
        e.preventDefault();
        $("#hold-modal").modal('show');
        return false;
    });
    
    $('.datepicker').datepicker({
        autoclose: true,
        todayHighlight: false,
        format: 'yyyy-mm-dd' 
    });
    $('.timepicker').timepicker({ 
        showMeridian: false,
        showInputs: false,
        showSeconds: true,
        minuteStep: 1,
        secondStep: 1
    });
    $("#JAMSURATJALAN").mask("99:99:99");
    $("#jamrelease").mask("99:99:99");
    $(".datepicker").mask("9999-99-99");
    $("#ID_CONSIGNEE").mask("99.999.999.9-999.999");
</script>

@endsection