@extends('layout')

@section('content')
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    PT. PRIMANATA JASA PERSADA
                    <small class="pull-right">Date: {{ date('d F, Y') }}</small>
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-xs-12 margin-bottom">
                <h3><b>NOTA DAN PERHITUNGAN PELAYANAN JASA&nbsp;:&nbsp;&nbsp;</b>PENUMPUKAN DAN GERAKAN EKSTRA</h3>
            </div>
            <div class="col-sm-6 invoice-col">
                <table>
                    <tr>
                        <td style="width: 150px;"><b>Consignee</b></td>
                        <td>:&nbsp;&nbsp;</td>
                        <td>{{ $invoice->consignee }}</td>
                    </tr>
                    <tr>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr>
                        <td><b>NPWP</b></td>
                        <td>:&nbsp;&nbsp;</td>
                        <td>{{ $invoice->npwp }}</td>
                    </tr>
                    <tr>
                        <td><b>Alamat</b></td>
                        <td>:&nbsp;&nbsp;</td>
                        <td>{{ $invoice->alamat }}</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td><b>Nama Kapal / Voy</b></td>
                        <td>:&nbsp;&nbsp;</td>
                        <td>{{ $invoice->vessel.' / '.$invoice->voy }}</td>
                    </tr>
                </table>
            </div>
            <!-- /.col -->
            <div class="col-sm-6 invoice-col">
                <table>
                    <tr>
                        <td style="width: 150px;"><b>No. Invoice</b></td>
                        <td>:&nbsp;&nbsp;</td>
                        <td>{{ $invoice->no_invoice }}</td>
                    </tr>
                    <tr>
                        <td style="width: 150px;"><b>No. Pajak</b></td>
                        <td>:&nbsp;&nbsp;</td>
                        <td>{{ $invoice->no_pajak }}</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td><b>No. DO</b></td>
                        <td>:&nbsp;&nbsp;</td>
                        <td>{{ $invoice->no_do }}</td>
                    </tr>
                    <tr>
                        <td><b>No. B/L</b></td>
                        <td>:&nbsp;&nbsp;</td>
                        <td>{{ $invoice->no_bl }}</td>
                    </tr>
                    <tr>
                        <td><b>ETA</b></td>
                        <td>:&nbsp;&nbsp;</td>
                        <td>{{ date("d/m/Y", strtotime($invoice->eta)) }}</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td><b>Gate Out Terminal</b></td>
                        <td>:&nbsp;&nbsp;</td>
                        <td>{{ date("d/m/Y", strtotime($invoice->gateout_terminal)) }}</td>
                    </tr>
                    <tr>
                        <td><b>Gate Out TPS</b></td>
                        <td>:&nbsp;&nbsp;</td>
                        <td>{{ date("d/m/Y", strtotime($invoice->gateout_tps)) }}</td>
                    </tr>
                    @if($invoice->extend == 'Y')
                        <tr>
                            <td><b>Perpanjangan</b></td>
                            <td>:&nbsp;&nbsp;</td>
                            <td>{{ date("d/m/Y", strtotime($invoice->tgl_extend)) }}</td>
                        </tr>
                    @endif
                </table>
            </div>
            <!-- /.col -->

            <!-- /.col -->
        </div>
        <!-- /.row -->
        <br /><br />
        <!-- Table row -->
        <div class="row" style="border-top: 2px solid;">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>LOKASI</th>
                        <th>SIZE</th>
                        <th>LAMA TIMBUN</th>
                        <th>JUMLAH</th>
                        <th>TARIF DASAR</th>
                        <th>MASA I</th>
                        <th>MASA II</th>
                        <th>MASA III</th>
                        {{--                        <th>MASA IV</th>--}}
                        <th>TOTAL SEWA</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $grand_total_p = 0;?>
                    @foreach($penumpukan as $p)
                        <tr>
                            <td>{{ $p->lokasi_sandar }}</td>
                            <td>{{ $p->size }}</td>
                            <td>({{ date("d/m/Y", strtotime($p->startdate)).' - '.date("d/m/Y", strtotime($p->enddate)) }}) {{ $p->lama_timbun }} hari</td>
                            <td>{{ $p->qty }}</td>
                            <td style="text-align: center;">
                                {{number_format($p->tarif_dasar)}}
                            </td>
                            <td>{{ number_format($p->masa1) }}</td>
                            <td>{{ number_format($p->masa2) }}</td>
                            <td>{{ number_format($p->masa3) }}</td>
                            {{--                        <td>{{ number_format($p->masa4) }}</td>--}}
                            <td align="right">{{ number_format($p->total) }}</td>
                            <?php $grand_total_p += $p->total;?>
                        </tr>
                    @endforeach
                    <tr>
                        <th colspan="7">PENUMPUKAN</th>
                        <td align="right"><b>Rp.</b></td>
                        <td align="right"><b>{{ number_format($grand_total_p) }}</b></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row" style="border-top: 2px solid;">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <tr>
                        <th>LOKASI</th>
                        <th>SIZE</th>
                        <th>JENIS GERAKAN</th>
                        <th>JUMLAH</th>
                        <th>TARIF DASAR</th>
                        <!--                    <th>JML SHIFT</th>
                                            <th>START/STOP PLUGGING</th>-->
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>BIAYA</th>
                    </tr>
                    <?php $grand_total_g = 0;?>
                    @foreach($gerakan as $g)
                        <tr>
                            <td>{{ $g->lokasi_sandar }}</td>
                            <td>{{ $g->size }}</td>
                            <td>{{ $g->jenis_gerakan }}</td>
                            <td>{{ $g->qty }}</td>
                            <td align="right">{{ number_format($g->tarif_dasar) }}</td>
                        <!--                    <td>{{ number_format($g->jumlah_shift) }}</td>
                    <td>{{ number_format($g->start_stop_plugging) }}</td>-->
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td align="right">{{ number_format($g->total) }}</td>
                        </tr>
                        <?php $grand_total_g += $g->total;?>
                    @endforeach
                    <tr>
                        <th colspan="6">SUB JUMLAH GERAKAN</th>
                        <td align="right"><b>Rp.</b></td>
                        <td align="right"><b>{{ number_format($grand_total_g) }}</b></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row" style="border-top: 2px solid;">
            <div class="col-xs-12 table-responsive">
                <table class="table">
                    <tr>
                        <td align="right">Administrasi</td>
                        <td>= Rp.</td>
                        <td align="right" style="width: 100px;">{{ number_format($invoice->administrasi) }}</td>
                    </tr>
                    @if($invoice->surcharge)
                        <tr>
                            <td align="right">Surcharge DG 25%</td>
                            <td>= Rp.</td>
                            <td align="right">{{ number_format($invoice->surcharge) }}</td>
                        </tr>
                    @endif
                    @if($invoice->perawatan_it)
                        <tr>
                            <td align="right">Perawatan IT</td>
                            <td>= Rp.</td>
                            <td align="right">{{ number_format($invoice->perawatan_it) }}</td>
                        </tr>
                    @endif
                    <tr>
                        <td align="right">Jumlah Sebelum PPN</td>
                        <td>= Rp.</td>
                        <td align="right">{{ number_format($invoice->total_non_ppn) }}</td>
                    </tr>
                    <tr>
                        <td align="right">PPN 11%</td>
                        <td>= Rp.</td>
                        <td align="right">{{ number_format($invoice->ppn) }}</td>
                    </tr>
                    <tr>
                        <td align="right">Materai</td>
                        <td>= Rp.</td>
                        <td align="right">{{ number_format($invoice->materai) }}</td>
                    </tr>
                    <tr>
                        <td align="right"><b>Jumlah Dibayarkan</b></td>
                        <td><b>= Rp.</b></td>
                        <td align="right"><b>{{ number_format($invoice->total) }}</b></td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                <button id="print-invoice-btn" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
                @if($invoice->uid == 'Platform')
                    <a href="{{route('invoice-approve-payment', $invoice->id)}}" id="approve-payment-btn" class="btn btn-success"><i class="fa fa-money"></i> Approve Payment</a>
                @endif
            </div>
        </div>

        <div id="print-modal" class="modal fade" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Pilih tanggal cetak</h4>
                    </div>
                    <form id="print-form" class="form-horizontal" action="#" method="POST">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                                    <input name="invoice_id" type="hidden" id="invoice_id" value="{{ $invoice->id }}" />

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Tgl. Cetak</label>
                                        <div class="col-sm-6">
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" name="tgl_cetak" id="tgl_cetak" class="form-control pull-right datepicker" value="{{date('Y-m-d')}}" required>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                            <button type="submit" class="btn btn-primary">Print</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    </section>

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
        $('#print-invoice-btn').click(function() {
            $('#print-modal').modal('show');
        });
        $("#print-form").on("submit", function(){
            var print_date = $("#tgl_cetak").val();
            // console.log(print_date);
            window.open("{{ route('invoice-nct-print',array('','')) .'/'.$invoice->id}}/"+print_date,"preview FCL Invoice","width=600,height=600,menubar=no,status=no,scrollbars=yes");
            $('#print-modal').modal('hide');
            return false;
        });
    </script>

@endsection