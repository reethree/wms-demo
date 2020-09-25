@extends('layout')

@section('content')
<style>
    .datepicker.dropdown-menu {
        /*z-index: 100 !important;*/
    }
    th.ui-th-column div{
        white-space:normal !important;
        height:auto !important;
        padding:2px;
    }
    .ui-jqgrid tr.jqgrow td {
        word-wrap: break-word; /* IE 5.5+ and CSS3 */
        white-space: pre-wrap; /* CSS3 */
        white-space: -moz-pre-wrap; /* Mozilla, since 1999 */
        white-space: -pre-wrap; /* Opera 4-6 */
        white-space: -o-pre-wrap; /* Opera 7 */
        overflow: hidden;
        height: auto;
        vertical-align: middle;
        padding-top: 3px;
        padding-bottom: 3px
    }
</style>
<script>
 
    function gridCompleteEvent()
    {
        var ids = jQuery("#nleSp2Grid").jqGrid('getDataIDs'),
            edt = '',
            del = '',
            upl = ''; 
        for(var i=0;i < ids.length;i++){ 
            var cl = ids[i];
            
            edt = '<a href="{{ route("tps-responPlp-edit",'') }}/'+cl+'" title="View"><i class="fa fa-pencil"></i></a> ';
            del = '<a href="#" onclick="if (confirm(\'Are You Sure ?\')){return true; }else{return false; };"><i class="fa fa-close"></i></a>';
            upl = '<a href="{{ route("nle-sp2-doc-upload",'') }}/'+cl+'" title="Upload SP2" onclick="if (confirm(\'Apakah anda yakin akan mengirim Dokumen SP2 ini ?\')){return true; }else{return false; };"><i class="fa fa-upload"></i></a> ';
            jQuery("#nleSp2Grid").jqGrid('setRowData',ids[i],{action:upl}); 
        } 
    }
    
    function onSubGridRowExpanded(subgrid_id, row_id) {
        var subgrid_table_id, pager_id;
        subgrid_table_id = subgrid_id+"_t";

        var rowdata = $("#nleSp2Grid").getRowData(row_id);
        pager_id = "p_"+subgrid_table_id;
        $("#"+subgrid_id).html("<table id='"+subgrid_table_id+"' class='scroll'></table><div id='"+pager_id+"' class='scroll'></div>");
        jQuery("#"+subgrid_table_id).jqGrid({
            url:"{{ route('nle-sp2-doc-subgrid') }}",
            mtype: "POST",
            postData: {
              _token: "{{ csrf_token() }}",
              isSubGrid:true,
              id: rowdata.id
            },
            datatype: "json",
            colNames: ['No. Container', 'Size', 'Type','Gate Pass'],
            colModel: [
                    {name:"container_no",index:"container_no",width:120,align:"center",sortable:false},
                    {name:"container_size",index:"container_size",width:100, align:"center",sortable:false},
                    {name:"container_type",index:"container_type",width:100,align:"center",sortable:false},
                    {name:"gate_pass",index:"gate_pass",width:500,align:"center",sortable:false}
            ],
            rowNum:20,
            pager: pager_id,
            sortname: 'id',
            sortorder: "DESC",
            height: '100%',
        });
        
        jQuery("#"+subgrid_table_id).jqGrid('navGrid',"#"+pager_id,{edit:false,add:false,del:false,refresh:false,search:false});
      }
    
</script>

<div class="box">
<!--    <div class="box-header with-border">
        <h3 class="box-title">TPS Respon PLP</h3>
        <div class="box-tools">
            <a href="{{ route('tps-responPlp-get') }}" type="button" class="btn btn-block btn-info btn-sm"><i class="fa fa-plus"></i> Get Data</a>
        </div>
    </div>-->
    <div class="box-body table-responsive">
<!--        <div class="row" style="margin-bottom: 30px;margin-right: 0;">
            <div class="col-md-8">
                <div class="col-xs-12">Search By Date</div>
                <div class="col-xs-12">&nbsp;</div>
                <div class="col-xs-3">
                    <select class="form-control select2" id="by" name="by" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option value="TGL_UPLOAD">Tgl. Upload</option>
                        <option value="TGL_PLP">Tgl. PLP</option>
                        <option value="TGL_SURAT">Tgl. Surat</option>
                        <option value="TGL_BC11">Tgl. BC11</option>
                        <option value="TGL_TIBA">Tgl. Tiba</option>                       
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
        </div>-->
        {{
            GridRender::setGridId("nleSp2Grid")
            ->enableFilterToolbar()
            ->setGridOption('mtype', 'POST')
            ->setGridOption('url', URL::to('/nle/sp2/document/grid-data?_token='.csrf_token()))
            ->setGridOption('rowNum', 100)
            ->setGridOption('shrinkToFit', true)
            ->setGridOption('sortname','id')
            ->setGridOption('rownumbers', true)
            ->setGridOption('rownumWidth', 50)
            ->setGridOption('height', '350')
            ->setGridOption('rowList',array(100,200,300))
            ->setGridOption('useColSpanStyle', true)
            ->setGridOption('subGrid', true)
            ->setNavigatorOptions('navigator', array('viewtext'=>'view'))
            ->setNavigatorOptions('view',array('closeOnEscape'=>false))
            ->setFilterToolbarOptions(array('autosearch'=>true))
            ->setGridEvent('gridComplete', 'gridCompleteEvent')
            ->setGridEvent('subGridRowExpanded', 'onSubGridRowExpanded')
            ->addColumn(array('label'=>'Action','index'=>'action', 'width'=>80, 'search'=>false, 'sortable'=>false, 'align'=>'center'))
            ->addColumn(array('key'=>true,'index'=>'id','hidden'=>true))
            ->addColumn(array('label'=>'Server','index'=>'url_name','width'=>100,'align'=>'center','hidden'=>false))
            ->addColumn(array('label'=>'NPWP','index'=>'npwp_cargo_owner','width'=>160,'align'=>'center','hidden'=>false))
            ->addColumn(array('label'=>'Nama','index'=>'nm_cargoowner','width'=>250,'align'=>'center','hidden'=>false))
            ->addColumn(array('label'=>'Kode Dokumen<br />1=2.0|2=2.3|3=1.6','index'=>'kd_document_type','width'=>160,'align'=>'center','hidden'=>false))
            ->addColumn(array('label'=>'No. Dokumen','index'=>'document_no','width'=>120,'align'=>'center','hidden'=>false))
            ->addColumn(array('label'=>'Tgl. Dokumen','index'=>'document_date','width'=>120,'align'=>'center','hidden'=>false))
            ->addColumn(array('label'=>'No. Dokumen<br />Release','index'=>'no_doc_release','width'=>120,'align'=>'center','hidden'=>false))
            ->addColumn(array('label'=>'Tgl. Dokumen<br />Release','index'=>'date_doc_release','width'=>120,'align'=>'center','hidden'=>false))
            ->addColumn(array('label'=>'Status Dokumen','index'=>'document_status','width'=>120,'align'=>'center','hidden'=>false))
            ->addColumn(array('label'=>'No. B/L','index'=>'bl_no','width'=>160,'align'=>'center','hidden'=>false))
            ->addColumn(array('label'=>'Tgl. B/L','index'=>'bl_date','width'=>120,'align'=>'center','hidden'=>false))
            ->addColumn(array('label'=>'ID Platform','index'=>'id_platform','width'=>100,'align'=>'center','hidden'=>false))
            ->addColumn(array('label'=>'Terminal','index'=>'terminal','width'=>200,'align'=>'center','hidden'=>false))
            ->addColumn(array('label'=>'Paid Thrud Date','index'=>'paid_thrud_date','width'=>120,'align'=>'center','hidden'=>false))
            ->addColumn(array('label'=>'Proforma','index'=>'proforma','width'=>120,'align'=>'center','hidden'=>false))
            ->addColumn(array('label'=>'Proforma Date','index'=>'proforma_date','width'=>120,'align'=>'center','hidden'=>false))
            ->addColumn(array('label'=>'Harga','index'=>'price','width'=>120,'align'=>'center','hidden'=>false))
            ->addColumn(array('label'=>'Status','index'=>'status','width'=>120,'align'=>'center','hidden'=>false))
            ->addColumn(array('label'=>'Finish','index'=>'is_finished','width'=>80,'align'=>'center','hidden'=>false))
            ->addColumn(array('label'=>'Party','index'=>'party','width'=>80,'align'=>'center','hidden'=>false))
            ->addColumn(array('label'=>'Response','index'=>'response','width'=>160,'align'=>'center','hidden'=>false))
            ->addColumn(array('label'=>'Container','index'=>'container','width'=>160,'align'=>'center','hidden'=>true))
            ->addColumn(array('label'=>'Container','index'=>'data_container','width'=>160,'align'=>'center','hidden'=>true))
            ->renderGrid()
        }}

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
        format: 'yyyy-mm-dd',
        zIndex: 99
    });
    
    $('#searchByDateBtn').on("click", function(){
        var by = $("#by").val();
        var startdate = $("#startdate").val();
        var enddate = $("#enddate").val();
        console.log(by);
        jQuery("#nleSp2Grid").jqGrid('setGridParam',{url:"{{URL::to('/nle/sp2/document/grid-data')}}?startdate="+startdate+"&enddate="+enddate+"&by="+by}).trigger("reloadGrid");
        return false;
    });

</script>

@endsection