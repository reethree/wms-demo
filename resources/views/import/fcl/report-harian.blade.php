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

    <div class="box">
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
                    <div class="col-xs-7">
                        <button class="btn btn-info pull-right" id="btn-print-in"><i class="fa fa-print"></i> Cetak Laporan Pemasukan</button>
                    </div>
                </div>
            </div>
            {{
                GridRender::setGridId("fclContainerInGrid")
                ->enableFilterToolbar()
                ->setGridOption('filename', 'FCL_DailyReportContIn_'.Auth::getUser()->name)
                ->setGridOption('mtype', 'POST')
                ->setGridOption('url', URL::to('/container/grid-data-cy?report=1&date='.$date.'&type=in&_token='.csrf_token()))
                ->setGridOption('rowNum', 50)
                ->setGridOption('shrinkToFit', true)
                ->setGridOption('sortname','TCONTAINER_PK')
                ->setGridOption('sortorder','DESC')
                ->setGridOption('rownumbers', true)
                ->setGridOption('height', '300')
                ->setGridOption('caption', 'Data Pemasukan Container FCL')
                ->setGridOption('rownumWidth', 50)
                ->setGridOption('multiselect', false)
                ->setGridOption('rowList',array(50,100,200))
                ->setGridOption('useColSpanStyle', true)
                ->setNavigatorOptions('navigator', array('viewtext'=>'view'))
                ->setNavigatorOptions('view',array('closeOnEscape'=>false))
                ->setFilterToolbarOptions(array('autosearch'=>true))
    //            ->setGridEvent('onSelectRow', 'onSelectRowEvent')
    //            ->setGridEvent('gridComplete', 'gridCompleteEvent')
                ->addColumn(array('key'=>true,'index'=>'TCONTAINER_PK','hidden'=>true))
                ->addColumn(array('label'=>'No. Container','index'=>'NOCONTAINER', 'width'=>150,'align'=>'center'))
                ->addColumn(array('label'=>'Size','index'=>'SIZE', 'width'=>100,'align'=>'center'))
                ->addColumn(array('label'=>'Type','index'=>'jenis_container','width'=>100,'align'=>'center'))
                ->addColumn(array('label'=>'Ex Kapal','index'=>'VESSEL','width'=>160,'align'=>'center'))
                ->addColumn(array('label'=>'Tgl. Tiba','index'=>'ETA', 'width'=>120,'align'=>'center','hidden'=>false))
                ->addColumn(array('label'=>'Tgl. OB','index'=>'TGLMASUK', 'width'=>120,'align'=>'center','hidden'=>false))
                ->addColumn(array('label'=>'Consignee','index'=>'CONSIGNEE', 'width'=>350))
                ->addColumn(array('label'=>'No. PLP','index'=>'NO_PLP', 'width'=>120,'align'=>'center'))
                ->addColumn(array('label'=>'Tgl. PLP','index'=>'TGL_PLP', 'width'=>120,'align'=>'center'))
    //            ->addColumn(array('label'=>'Kode Dokumen','index'=>'KD_DOK_INOUT', 'width'=>120,'align'=>'center','hidden'=>true))
    //            ->addColumn(array('label'=>'Nama Dokumen','index'=>'KODE_DOKUMEN', 'width'=>120))
    //            ->addColumn(array('label'=>'No. Dokumen','index'=>'NO_SPPB', 'width'=>160,'align'=>'center'))
    //            ->addColumn(array('label'=>'Tgl. Dokumen','index'=>'TGL_SPPB', 'width'=>120,'align'=>'center'))
                ->addColumn(array('label'=>'TPS Asal','index'=>'KD_TPS_ASAL', 'width'=>100,'align'=>'center'))
                ->addColumn(array('label'=>'No.BC 1.1','index'=>'NO_BC11', 'width'=>120,'align'=>'center'))
                ->addColumn(array('label'=>'Tgl.BC 1.1','index'=>'TGL_BC11', 'width'=>120,'align'=>'center'))
                ->addColumn(array('label'=>'Jam Masuk','index'=>'JAMMASUK', 'width'=>100,'align'=>'center'))
                ->renderGrid()
            }}
            <br /><hr /><br />
            <div class="row" style="margin-bottom: 30px;margin-right: 0;">
                <div class="col-md-12">
                    <button class="btn btn-info pull-right" id="btn-print-out"><i class="fa fa-print"></i> Cetak Laporan Pengeluaran</button>
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
                ->setGridOption('caption', 'Data Pengeluaran Container FCL')
                ->setGridOption('rownumWidth', 50)
                ->setGridOption('multiselect', false)
                ->setGridOption('rowList',array(50,100,200))
                ->setGridOption('useColSpanStyle', true)
                ->setNavigatorOptions('navigator', array('viewtext'=>'view'))
                ->setNavigatorOptions('view',array('closeOnEscape'=>false))
                ->setFilterToolbarOptions(array('autosearch'=>true))
    //            ->setGridEvent('onSelectRow', 'onSelectRowEvent')
    //            ->setGridEvent('gridComplete', 'gridCompleteEvent')
                ->addColumn(array('key'=>true,'index'=>'TCONTAINER_PK','hidden'=>true))
                ->addColumn(array('label'=>'No. Container','index'=>'NOCONTAINER', 'width'=>150,'align'=>'center'))
                ->addColumn(array('label'=>'Size','index'=>'SIZE', 'width'=>100,'align'=>'center'))
                ->addColumn(array('label'=>'Type','index'=>'jenis_container','width'=>100,'align'=>'center'))
                ->addColumn(array('label'=>'Ex Kapal','index'=>'VESSEL','width'=>160,'align'=>'center'))
                ->addColumn(array('label'=>'Tgl. Tiba','index'=>'ETA', 'width'=>120,'align'=>'center','hidden'=>false))
                ->addColumn(array('label'=>'Tgl. OB','index'=>'TGLMASUK', 'width'=>120,'align'=>'center','hidden'=>false))
                ->addColumn(array('label'=>'Consignee','index'=>'CONSIGNEE', 'width'=>350))
    //            ->addColumn(array('label'=>'No. PLP','index'=>'NO_PLP', 'width'=>120,'align'=>'center'))
    //            ->addColumn(array('label'=>'Tgl. PLP','index'=>'TGL_PLP', 'width'=>120,'align'=>'center'))
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
            <br />
            <div class="row" style="margin-bottom: 30px;margin-right: 0;">
                <div class="col-sm-4">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <th>No.</th>
                            <th>Jenis Dokumen</th>
                            <th>Jumlah</th>
                        </tr>
                        <?php $sumdoc = 0;$i = 1;?>
                        @foreach($countbydoc as $key=>$value)
                            <tr>
                                <th style="text-align: center;">{{$i}}</th>
                                <th>{{ $key }}</th>
                                <td align="center">{{ $value }}</td>
                            </tr>
                            <?php $sumdoc += $value;$i++;?>
                        @endforeach
                        <tr>
                            <th colspan="2">Jumlah Total</th>
                            <th align="center" style="text-align: center;">{{$sumdoc}}</th>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
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

        $('#btn-print-in').click(function() {
            var date = $('#date').val();
            window.open("{{ route('fcl-report-harian-cetak',array('','')) }}/"+date+"/in","preview wo fiat muat","width=1200,height=600,menubar=no,status=no,scrollbars=yes");
        });

        $('#btn-print-out').click(function() {
            var date = $('#date').val();
            window.open("{{ route('fcl-report-harian-cetak',array('','')) }}/"+date+"/out","preview wo fiat muat","width=1200,height=600,menubar=no,status=no,scrollbars=yes");
        });
    </script>

@endsection
