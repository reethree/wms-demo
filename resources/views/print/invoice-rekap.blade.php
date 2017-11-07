@extends('print')

@section('title')
    {{ $consolidator->NAMACONSOLIDATOR.' '.date('d-m-Y') }}
@stop

@section('content')
<br /><br />
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
            <td style="text-align: center;">Biaya Penumpukan Barang LCL ({{ $invoices['0']->INVOICE }}) Gudang Primanata</td>
        </tr>
        <tr>
            <td style="text-align: center;">Tanggal : {{ date('d F Y', strtotime($invoices['0']->tglrelease)) }}</td>
        </tr>
    </table>
    
    <table border="0" cellspacing="0" cellpadding="0" style="border-top: 1px solid;border-right: 1px solid">
        
        <tr>
            <th style="text-align: center;width: 20px;border: 1px solid;">NO</th>
            <th style="text-align: center;border: 1px solid;">CONSIGNEE</th>
            <th style="text-align: center;width: 80px;border: 1px solid;">NO<br />INVOICE</th>
            <th style="text-align: center;border: 1px solid;" colspan="2">JUMLAH</th>
        </tr>
        
        <?php $i=1; ?>
        @foreach($invoices as $invoice)
            <tr>
                <td style="text-align: center;border-right: 1px solid;border-left: 1px solid;">{{ $i }}</td>
                <td style="border-right: 1px solid;">{{ $invoice->CONSIGNEE }}</td>
                <td style="text-align: center;border-right: 1px solid;">{{ $invoice->no_invoice }}</td>
                <td style="width: 30px;">Rp.</td>
                <td style="text-align: right;width: 150px;">{{ number_format($invoice->sub_total) }}</td>
            </tr>
        <?php $i++;?>
        @endforeach
        
        <tr>
            <td colspan="2" style="border-top:1px solid;"></td>
            <td style="text-align: center;border-top:1px solid;border-right: 1px solid;border-left: 1px solid;">Sub Total</td>
            <td style="border-top:1px solid;">Rp.</td>
            <td style="text-align: right;border-top:1px solid;">{{ number_format($sub_total) }}</td>
        </tr>
        @if($ppn > 0)
        <tr>
            <td colspan="2"></td>
            <td style="text-align: center;border-right: 1px solid;border-left: 1px solid;">PPn 10%</td>
            <td>Rp.</td>
            <td style="text-align: right;border-right: 1px solid;">{{ number_format($ppn) }}</td>
        </tr>
        @endif
        <tr>
            <td colspan="2"></td>
            <td style="text-align: center;border-right: 1px solid;border-left: 1px solid;">Materai</td>
            <td>Rp.</td>
            <td style="text-align: right;">{{ number_format($materai) }}</td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td style="text-align: center;border: 1px solid;"><b>TOTAL</b></td>
            <td style="border-bottom: 1px solid;border-top: 1px solid;"><b>Rp.</b></td>
            <td style="text-align: right;border-bottom: 1px solid;border-top: 1px solid;"><b>{{ number_format($total) }}</b></td>
        </tr>
        <p><b><i># {{ $terbilang }} #</i></b></p>
    </table>
    
    <table border="0" cellspacing="0" cellpadding="0">
        <tr><td height="50" style="font-size: 50px;line-height: 0;">&nbsp;</td></tr>
        <tr>
            <td>&nbsp;</td>
            <td class="text-center">Jakarta, {{ date('d F Y') }}</td>
        </tr>
        <tr>
            <td width='60%'>
                <p>
                    Pembayaran dapat dilakukan melalui :<br />
                    Rekening : PT. PRIMANATA JASA PERSADA<br />
                    Bank Mandiri Cabang Enggano<br />
                    a/c no : 120.000.6122639
                </p>
            </td>
            <td class="text-center">&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td class="text-center">ARMUDIA<br />Direktur Komersil</td>
        </tr>
    </table>
    
    @endif
</div>

@stop