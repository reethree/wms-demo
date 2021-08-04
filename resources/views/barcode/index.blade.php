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

        var grid = $("#barcodeGrid"), headerRow, rowHight, resizeSpanHeight;

        // get the header row which contains
        headerRow = grid.closest("div.ui-jqgrid-view")
            .find("table.ui-jqgrid-htable>thead>tr.ui-jqgrid-labels");

        // increase the height of the resizing span
        resizeSpanHeight = 'height: ' + headerRow.height() +
            'px !important; cursor: col-resize;';
        headerRow.find("span.ui-jqgrid-resize").each(function () {
            this.style.cssText = resizeSpanHeight;
        });

        // set position of the dive with the column header text to the middle
        rowHight = headerRow.height();
        headerRow.find("div.ui-jqgrid-sortable").each(function () {
            var ts = $(this);
            ts.css('top', (rowHight - ts.outerHeight()) / 2 + 'px');
        });

        function gridCompleteEvent()
        {
            var ids = jQuery("#barcodeGrid").jqGrid('getDataIDs'),
                del = '',
                prn = '',
                edt = '';
            for(var i=0;i < ids.length;i++){
                var cl = ids[i];

                edt = '<a href="{{ route("barcode-view",'') }}/'+cl+'"><i class="fa fa-pencil"></i></a> ';
                prn = '<a href="#" onclick="rePrint('+cl+')"><i class="fa fa-print"></i></a> ';
                del = '<a href="{{ route("barcode-delete",'') }}/'+cl+'" onclick="if (confirm(\'Are You Sure want to Delete this data ?\')){return true; }else{return false; };"><i class="fa fa-close"></i></a> ';
                jQuery("#barcodeGrid").jqGrid('setRowData',ids[i],{action:prn+'  '+edt+'    '+del});
            }
        }

        function rePrint(id)
        {
            var rowdata = $('#barcodeGrid').getRowData(id);
            window.open("{{ route('cetak-barcode', array('','','')) }}/"+rowdata.ref_id+"/"+rowdata.ref_type.toLowerCase()+"/"+rowdata.ref_action+"","preview barcode","width=305,height=600,menubar=no,status=no,scrollbars=yes");
        }

    </script>
    <div class="box">
        <div class="box-header with-border" style="padding: 13px;">
            <h3 class="box-title">Gate Pass Lists</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-success" id="create-report-btn"><i class="fa fa-paperclip"></i>&nbsp; Create Report</button>
                {{--            <button class="btn btn-info" id="inquiry-btn"><i class="fa fa-info"></i>&nbsp; Inquiry</button>--}}
            </div>
        </div>
        <div class="box-body table-responsive">
            {{
                GridRender::setGridId("barcodeGrid")
                ->enableFilterToolbar()
                ->setGridOption('mtype', 'POST')
                ->setGridOption('url', URL::to('/barcode/grid-data?_token='.csrf_token()))
                ->setFileProperty('title', 'Gate Pass Auto Gate') //Laravel Excel File Property
                ->setFileProperty('creator', 'Reza') //Laravel Excel File Property
                ->setSheetProperty('fitToPage', true) //Laravel Excel Sheet Property
                ->setSheetProperty('fitToHeight', true)
                ->setGridOption('rowNum', 20)
                ->setGridOption('shrinkToFit', true)
                ->setGridOption('sortname','created_at')
                ->setGridOption('sortorder','DESC')
                ->setGridOption('rownumbers', true)
                ->setGridOption('height', '400')
                ->setGridOption('rowList',array(50,100,200))
                ->setGridOption('useColSpanStyle', true)
                ->setNavigatorOptions('navigator', array('viewtext'=>'view'))
                ->setNavigatorOptions('view',array('closeOnEscape'=>false))
                ->setFilterToolbarOptions(array('autosearch'=>true))
                ->setGridEvent('gridComplete', 'gridCompleteEvent')
                ->addColumn(array('label'=>'Action','index'=>'action', 'width'=>120, 'search'=>false, 'sortable'=>false, 'align'=>'center'))
                ->addColumn(array('key'=>true,'index'=>'id','hidden'=>true))
                ->addColumn(array('label'=>'Ref ID','index'=>'ref_id','hidden'=>true))
                ->addColumn(array('label'=>'Gate Pass','index'=>'barcode','width'=>200,'align'=>'center'))
                ->addColumn(array('label'=>'Ref Number','index'=>'ref_number','width'=>150,'align'=>'center'))
                ->addColumn(array('label'=>'Ref Type','index'=>'ref_type','width'=>100,'align'=>'center'))
                ->addColumn(array('label'=>'Action','index'=>'ref_action','width'=>100,'align'=>'center'))
                ->addColumn(array('label'=>'Date In','index'=>'time_in','width'=>150,'align'=>'center'))
                ->addColumn(array('label'=>'Date Out','index'=>'time_out','width'=>150,'align'=>'center'))
                ->addColumn(array('label'=>'Created','index'=>'created_at','width'=>150,'align'=>'center'))
                ->addColumn(array('label'=>'Expired','index'=>'expired','width'=>150,'align'=>'center'))
                ->addColumn(array('label'=>'Status','index'=>'status','width'=>100,'align'=>'center'))
                ->addColumn(array('label'=>'UID','index'=>'uid','width'=>150,'align'=>'center'))

                ->renderGrid()
            }}
        </div>
    </div>
    <div id="report-modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Cetak Report</h4>
                </div>
                <form class="form-horizontal" action="{{ route('barcode-cetak-report') }}" method="POST">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <input name="_token" type="hidden" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Tgl. Barcode</label>
                                    <div class="col-sm-3">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input autocomplete="off" type="text" name="start_date" class="form-control pull-right datepicker" required>
                                        </div>
                                    </div>
                                    <label class="col-sm-1 control-label">s/d</label>
                                    <div class="col-sm-3">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input autocomplete="off" type="text" name="end_date" class="form-control pull-right datepicker" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                        <button type="submit" class="btn btn-primary">Create</button>
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
        $(document).ready(function(){
            $('#create-report-btn').on('click', function(){
                $('#report-modal').modal('show');
            });

            $('.datepicker').datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'yyyy-mm-dd',
                zIndex: 99
            });
        });
    </script>

@endsection