@extends('print')

@section('title')
    {{ 'Invoice '.$invoice->no_invoice }}
@stop

@section('content')
<br/><br/><br/><br/><br/>    
<div id="details" class="clearfix">
    <div class="row invoice-info" style="border-top: 2px solid;">
        <div class="col-xs-12 margin-bottom">
            <h3><b>NOTA DAN PERHITUNGAN PELAYANAN JASA :</b><span style="font-weight: lighter;">&nbsp;&nbsp;PENUMPUKAN DAN GERAKAN EKSTRA</span></h3>
        </div>
        <div class="col-sm-4 invoice-col">
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td rowspan="2" style="vertical-align: top;width: 100px;"><b>Perusahaan</b></td>
                    <td rowspan="2" style="vertical-align: top;">:&nbsp;&nbsp;&nbsp;&nbsp;{{ $invoice->consignee }}</td>
                    <td style="width: 100px;"><b>Nomor Invoice</b></td>
                    <td style="width: 20px;">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td>{{ $invoice->no_invoice }}</td>
                </tr>
                <tr>
<!--                    <td>&nbsp;</td>
                    <td>&nbsp;</td>-->
                    <td><b>Nomor Pajak</b></td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td>{{ $invoice->no_pajak }}</td>
                </tr>
                <tr>
                    <td><b>NPWP/NPPKP</b></td>
                    <td>:&nbsp;&nbsp;&nbsp;&nbsp;{{ $invoice->npwp }}</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td rowspan="2" style="vertical-align: top;"><b>Alamat</b></td>
                    <td rowspan="2" style="vertical-align: top;width: 270px;">:&nbsp;&nbsp;&nbsp;&nbsp;{{ $invoice->alamat }}</td>
                    <td style="vertical-align: top;"><b>Nomor D.O</b></td>
                    <td style="vertical-align: top;">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td style="vertical-align: top;">{{ $invoice->no_do }}</td>
                </tr>
                <tr>
<!--                    <td>&nbsp;</td>
                    <td>&nbsp;</td>-->
                    <td style="vertical-align: top;"><b>Nomor B.L</b></td>
                    <td style="vertical-align: top;">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td style="vertical-align: top;">{{ $invoice->no_bl }}</td>
                </tr>
                <tr>
                    <td><b>Kapal / Voy</b></td>
                    <td>:&nbsp;&nbsp;&nbsp;&nbsp;{{ $invoice->vessel.' / '.$invoice->voy }}</td>
                    <td><b>ETA</b></td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td>{{ date("d/m/Y", strtotime($invoice->eta)) }}</td>
                </tr>
                <tr>
                    <td><b>Out Terminal</b></td>
                    <td>:&nbsp;&nbsp;&nbsp;&nbsp;{{ date("d/m/Y", strtotime($invoice->gateout_terminal)) }}</td>
                    <td><b>Out TPS</b></td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td>{{ date("d/m/Y", strtotime($invoice->gateout_tps)) }}</td>
                </tr>
            </table>
        </div>
    </div>
    
    <div class="row invoice-info" style="border-top: 2px solid;">
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
                        <th>MASA IV</th>
                        <th>TOTAL SEWA</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $grand_total_p = 0;?>
                    @foreach($penumpukan as $p)
                    <tr>
                        <td>{{ $p->lokasi_sandar }}</td>
                        <td style="text-align: center;">{{ $p->size }}</td>
                        <td>({{ date("d/m/Y", strtotime($p->startdate)).' - '.date("d/m/Y", strtotime($p->enddate)) }}) {{ $p->lama_timbun }} hari</td>
                        <td style="text-align: center;">{{ $p->qty }}</td>
                        <td style="text-align: center;">{{ (($p->size == 20) ? number_format(27200) : number_format(54400)) }}</td>
                        <td style="text-align: right;">{{ number_format($p->masa1) }}</td>
                        <td style="text-align: right;">{{ number_format($p->masa2) }}</td>
                        <td style="text-align: right;">{{ number_format($p->masa3) }}</td>
                        <td style="text-align: right;">{{ number_format($p->masa4) }}</td>
                        <td style="text-align: right;">{{ number_format($p->total) }}</td>
                        <?php $grand_total_p += $p->total;?>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="10"><div style="border-top:1px dashed !important;width: 100%;height: 1px;">&nbsp;</div></td>
                    </tr>
                    <tr>
                        <th style="text-align: left;" colspan="8">PENUMPUKAN</th>
                        <th style="text-align: right;"><b>Rp.</b></th>
                        <th style="text-align: right;"><b>{{ number_format($grand_total_p) }}</b></th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="row invoice-info" style="border-top: 2px solid;">
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
                    <td style="text-align: center;">{{ $g->size }}</td>
                    <td>{{ $g->jenis_gerakan }}</td>
                    <td style="text-align: center;">{{ $g->qty }}</td>
                    <td style="text-align: right;">{{ number_format($g->tarif_dasar) }}</td>
<!--                    <td style="text-align: center;">{{ number_format($g->jumlah_shift) }}</td>
                    <td style="text-align: center;">{{ number_format($g->start_stop_plugging) }}</td>-->
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td style="text-align: right;">{{ number_format($g->total) }}</td>
                </tr>
                <?php $grand_total_g += $g->total;?>
                @endforeach
                <tr>
                    <td colspan="8"><div style="border-top:1px dashed !important;width: 100%;height: 1px;">&nbsp;</div></td>
                </tr>
                <tr>
                    <th style="text-align: left;" colspan="6">SUB JUMLAH GERAKAN</th>
                    <th style="text-align: right;"><b>Rp.</b></th>
                    <th style="text-align: right;"><b>{{ number_format($grand_total_g) }}</b></th>
                </tr>
            </table>
        </div>
    </div>
    
    <div class="row invoice-info" style="border-top: 2px solid;">
        <div class="col-xs-12 table-responsive">
            <table class="table">
                <tr>
                    <td style="text-align: right;">Administrasi</td>
                    <td style="width: 50px;text-align: right;">= Rp.</td>
                    <td style="width: 100px;text-align: right;">{{ number_format($invoice->administrasi) }}</td>
                </tr>
                <tr>
                    <td style="text-align: right;">Jumlah Sebelum PPN</td>
                    <td style="text-align: right;">= Rp.</td>
                    <td  style="text-align: right;">{{ number_format($invoice->total_non_ppn) }}</td>
                </tr>
                <tr>
                    <td style="text-align: right;">PPN 10%</td>
                    <td style="text-align: right;">= Rp.</td>
                    <td  style="text-align: right;">{{ number_format($invoice->ppn) }}</td>
                </tr>
                <tr>
                    <td style="text-align: right;">Materai</td>
                    <td style="text-align: right;">= Rp.</td>
                    <td  style="text-align: right;">{{ number_format($invoice->materai) }}</td>
                </tr>
                <tr>
                    <td style="text-align: right;"><b>Jumlah Dibayarkan</b></td>
                    <td style="text-align: right;"><b>= Rp.</b></td>
                    <td  style="text-align: right;"><b>{{ number_format($invoice->total) }}</b></td>
                </tr>
            </table>
        </div>
    </div>
    
    <div class="row invoice-info">
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
                <tr>
                    <td style="width: 80px;"><i>TERBILANG</i></td>
                    <td style="width: 30px;">&nbsp;&nbsp;=&nbsp;&nbsp;</td>
                    <td><i>{{ $terbilang }}</i></td>
                </tr>
                <tr>
                    <td><b>TPS</b></td>
                    <td><b>&nbsp;&nbsp;=&nbsp;&nbsp;</b></td>
                    <td><b>PRIMANATA JASA PERSADA PT.</b></td>
                </tr>
            </table>
        </div>
    </div>
    
    <div class="row invoice-info" style="border-top: 2px solid;">
        <div class="col-xs-12 table-responsive">
            <table class="table">
                <tr>
                    <td>Ketentuan :</td>
                    <td style="text-align: center;">{{ date("l, d F Y") }}</td>
                </tr>
                <tr>
                    <td>
                        <ol style="padding-left: 15px;font-size: 10px;margin: 0;">
                            <li>Dalam waktu 8 hari kerja setelah nota ini diterima, tidak ada pengajuan keberatan, saudara dianggap setuju</li>
                            <li>Terhadap nota yang diajukan koreksi harus dilunasi terlebih dahulu</li>
                            <li>Tidak dibenrkan memmberi imbalan kepada petugas</li>
                        </ol>
                    </td>
                    <td style="vertical-align: top;text-align: center;">KASIR</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td style="text-align: center;"><br/><br/><br/><br/>YADI</td>
                </tr>
            </table>
        </div>
    </div>
</div>
        
@stop