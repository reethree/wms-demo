@extends('print')

@section('title')
    {{ $consolidator->NAMACONSOLIDATOR.' '.date('d-m-Y') }}
@stop

@section('content')
<style>
    @media print {
        body {
            color: #000;
            background: #fff;
        }
        @page {
            size: auto;   /* auto is the initial value */
            margin-top: 114px;
            margin-bottom: 90px;
            margin-left: 38px;
            margin-right: 75px;
            font-weight: bold;
        }
        .print-btn {
            display: none;
        }
    }
</style>
<!--<br /><br />-->
<a href="#" class="print-btn" type="button" onclick="window.print();">PRINT</a>
<div id="details" class="clearfix" style="font-weight: bold;">
    <table border="0" cellspacing="0" cellpadding="0" width="40%">
        <tr>
            <td>Kapada Yth.</td>
        </tr>
        <tr>
            <td>{{ $consolidator->NAMACONSOLIDATOR }}</td>
        </tr>
        <tr>
            <td>{{ $consolidator->ALAMAT }}</td>
        </tr>
    </table>
    
    @if(count($invoices) > 0)
    <table border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td style="text-align: center;">INVOICE</td>
        </tr>
        <tr>
            <td style="text-align: center;">REKAPITULASI PENGIRIMAN NOTA TAGIHAN</td>
        </tr>
        <tr>
            <td style="text-align: center;">Biaya Penumpukan Barang LCL ({{ $type }}) Gudang Primanata</td>
        </tr>
        <tr>
            <td style="text-align: center;">Tanggal : {{ date('d F Y', strtotime($tgl_release['start'])) .' s/d '. date('d F Y', strtotime($tgl_release['end'])) }}</td>
        </tr>
    </table>
    
    <table border="0" cellspacing="0" cellpadding="0" style="border-top: 1px solid;border-right: 1px solid">

        <tr>
            <th style="text-align: center;width: 20px;border: 1px solid;">NO</th>
            <th style="text-align: center;border: 1px solid;">TANGGAL RELEASE</th>
            <th style="text-align: center;width: 120px;border: 1px solid;">JUMLAH<br />CBM</th>
            <th style="text-align: center;width: 100px;border: 1px solid;">JUMLAH<br />INVOICE</th>
            <th style="text-align: center;border: 1px solid;" colspan="2">JUMLAH<br />BIAYA</th>
        </tr>

        <?php $i=1;$tot_cbm = 0;$tot_inv = 0; ?>
        @foreach($invoices as $invoice)
            <tr>
                <td style="text-align: center;border-right: 1px solid;border-left: 1px solid;">{{ $i }}</td>
                <td style="border-right: 1px solid;">{{ date('d F Y', strtotime($invoice->tglrelease)) }}</td>
                <td style="text-align: center;border-right: 1px solid;">{{ $invoice->total_cbm }}</td>
                <td style="text-align: center;border-right: 1px solid;">{{ $invoice->total_inv }}</td>
                <td style="width: 30px;">Rp.</td>
                <td style="text-align: right;width: 150px;">{{ (($invoice->total_rdm > 0) ? number_format($invoice->sub_total) : 0) }}</td>
            </tr>
        <?php $i++;$tot_cbm += $invoice->total_cbm;$tot_inv += $invoice->total_inv;?>
        @endforeach

        <tr>
            <td colspan="2" style="border:1px solid;text-align: center;">JUMLAH TOTAL</td>
            <td style="text-align: center;border:1px solid;">{{ $tot_cbm }}</td>
            <td style="text-align: center;border:1px solid;">{{ $tot_inv }}</td>
            <td style="border-top:1px solid;border-bottom:1px solid;">Rp.</td>
            <td style="text-align: right;border-top:1px solid;border-bottom:1px solid;">{{ (($invoices['0']->total_rdm > 0) ? number_format($sub_total) : 0) }}</td>
        </tr>
        @if($ppn > 0)
        <tr>
            <td colspan="3"></td>
            <td style="text-align: center;border-right: 1px solid;border-left: 1px solid;">PPn 10%</td>
            <td>Rp.</td>
            <td style="text-align: right;border-right: 1px solid;">{{ (($invoices['0']->total_rdm > 0) ? number_format($ppn) : 0) }}</td>
        </tr>
        @endif
        <tr>
            <td colspan="3"></td>
            <td style="text-align: center;border-right: 1px solid;border-left: 1px solid;">Materai</td>
            <td>Rp.</td>
            <td style="text-align: right;">{{ (($invoices['0']->total_rdm > 0) ? number_format($materai) : 0) }}</td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td style="text-align: center;border: 1px solid;"><b>TOTAL BIAYA</b></td>
            <td style="border-bottom: 1px solid;border-top: 1px solid;"><b>Rp.</b></td>
            <td style="text-align: right;border-bottom: 1px solid;border-top: 1px solid;"><b>{{ (($invoices['0']->total_rdm > 0) ? number_format($total) : 0) }}</b></td>
        </tr>

    </table>
    
    <p><b><i># {{ (($invoices['0']->total_rdm > 0) ? $terbilang : '' )}} #</i></b></p>
    
    <table border="0" cellspacing="0" cellpadding="0">
        <tr><td height="50" style="font-size: 50px;line-height: 0;">&nbsp;</td></tr>
        <tr>
            <td>&nbsp;</td>
            <td class="text-center">Jakarta, {{ date('d F Y', strtotime($tgl_cetak)) }}</td>
        </tr>
        <tr>
            <td width='60%'>
                @if(in_array($consolidator->TCONSOLIDATOR_PK,array(10,12)))
                <p>
                    Pembayaran dapat dilakukan melalui :<br />
                    Rekening : REZA DARMAWAN<br />
                    Bank BRI Syariah Cabang Enggano<br />
                    a/c no : 100.2575.888
                </p>
                @else
                <p>
                    Pembayaran dapat dilakukan melalui :<br />
                    Rekening : PT. PRIMANATA JASA PERSADA<br />
                    Bank Mandiri Cabang Enggano<br />
                    a/c no : 120.000.6122639
                </p>
                @endif
            </td>
            <td class="text-center">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td class="text-center">Haruchi Tyas Intani<br />FINANCE MANAGER</td>
        </tr>
    </table>
    
    @endif
</div>

@stop