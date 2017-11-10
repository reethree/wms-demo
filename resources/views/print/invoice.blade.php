@extends('print-with-noheader')

@section('title')
    {{ 'Invoice '.$invoice->no_invoice }}
@stop

@section('content')
<style>
    @media print {
        @page {
            size: auto;   /* auto is the initial value */
            margin-top: 0;
            margin-bottom: 0;/* this affects the margin in the printer settings */
        }
        .print-btn {
            display: none;
        }
    }
</style>

<div id="details" class="clearfix" style="font-weight: 900;font-family: Tahoma, Geneva, sans-serif;display: block;letter-spacing: 4px;">
        <div class="row invoice-info" style="border: 1px solid;padding: 0 10px;">
        <div class="col-xs-12 text-center margin-bottom">
            <h2 style="letter-spacing: 8px;"><b>INVOICE</b></h2>
        </div>
      <div class="col-sm-4 invoice-col">
          <table border="0" cellspacing="0" cellpadding="0">
              <tr>
                  <td><b>Kepada Yth.</b></td>
                  <td colspan="3">:&nbsp;&nbsp;&nbsp;&nbsp;<b>{{ $manifest->NAMACONSOLIDATOR }}</b></td>
<!--                  <td>&nbsp;</td>
                  <td>&nbsp;</td>-->
                  <td align="right">( {{ $manifest->INVOICE }} )</td>
              </tr>
              <tr>
                  <td><b>Consignee</b></td>
                  <td colspan="4">:&nbsp;&nbsp;&nbsp;&nbsp;{{ $manifest->CONSIGNEE }}</td>
<!--                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>-->
              </tr>
              <tr>
                  <td><b>Ex. Kapal</b></td>
                  <td>:&nbsp;&nbsp;&nbsp;&nbsp;{{ $manifest->VESSEL }}</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
              </tr>
              <tr>
                  <td><b>No. B/L / D/O</b></td>
                  <td>:&nbsp;&nbsp;&nbsp;&nbsp;{{ $manifest->NOHBL }}</td>
                  <td><b>Tgl. Masuk</b></td>
                  <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                  <td>{{ date('d-M-y', strtotime($manifest->tglmasuk)) }}</td>
              </tr>
              <tr>
                  <td><b>Party</b></td>
                  <td>:&nbsp;&nbsp;&nbsp;&nbsp;{{ $manifest->WEIGHT }} KGS</td>
                  <td><b>Tgl. ETA</b></td>
                  <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                  <td>{{ date('d-M-y', strtotime($manifest->ETA)) }}</td>
              </tr>
              <tr>
                  <td>&nbsp;</td>
                  <td>:&nbsp;&nbsp;&nbsp;&nbsp;{{ $manifest->MEAS }} CBM</td>
                  <td><b>Tgl. Keluar</b></td>
                  <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                  <td>{{ date('d-M-y', strtotime($manifest->tglrelease)) }}</td>
              </tr>
              <tr>
                  <td><b>Ex. Cont</b></td>
                  <td>:&nbsp;&nbsp;&nbsp;&nbsp;{{ $manifest->NOCONTAINER }} / {{ $manifest->SIZE }}</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
              </tr>
              <tr>
                  <td><b>Tempat Penumpukan</b></td>
                  <td>:&nbsp;&nbsp;&nbsp;&nbsp;Gudang PRIMANATA</td>
                  <td><b>No. Invoice</b></td>
                  <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                  <td>{{ $invoice->no_invoice }}</td>
              </tr>
          </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <br />
    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table border="0" cellspacing="0" cellpadding="0">
          <thead>
            <tr>
              <th>&nbsp;</th>
              <th>Kegiatan</th>
              <th>Quantity</th>     
              <th class="text-center" colspan="2">Tarif</th>
              <th class="text-center" colspan="2">Jumlah Biaya</th>
            </tr>
            </thead>
            <tbody>
            @if($invoice->storage > 0)
            <tr>
              <td>&nbsp;</td>
              <td style="height: 30px;"><b>Biaya Penumpukan</b></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>1</td>           
              <td>Storage</td>
              <td>{{ number_format($invoice->cbm * 1000, 0, ',', '.') }} Cbm x {{ $invoice->hari }} hari</td>
              <td align="right">Rp.</td>
              <td align="right">{{ number_format($tarif->storage) }}</td>
              <td align="right">Rp.</td>
              <td align="right">{{ number_format($invoice->storage) }}</td>
            </tr>
            @else
            <tr>
                <td>1</td>
                <td>Biaya Storage</td>
                <td colspan="5">&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Masa I (1-3 Hari)</td>
                <td>{{ number_format($invoice->cbm, 2, '.', ',') }} Cbm x {{ $invoice->hari_masa1 + 1 }} hari</td>
                <td align="right">Rp.</td>
                <td align="right">{{ number_format($tarif->storage_masa1) }}</td>
                <td align="right">Rp.</td>
                <td align="right">{{ number_format($invoice->storage_masa1) }}</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Masa II (4-5 Hari)</td>
                <td>{{ number_format($invoice->cbm, 2, '.', ',') }} Cbm x {{ $invoice->hari_masa2 }} hari</td>
                <td align="right">Rp.</td>
                <td align="right">{{ number_format($tarif->storage_masa2) }}</td>
                <td align="right">Rp.</td>
                <td align="right">{{ number_format($invoice->storage_masa2) }}</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Masa III (6 Hari - dst)</td>
                <td>{{ number_format($invoice->cbm, 2, '.', ',') }} Cbm x {{ $invoice->hari_masa3 }} hari</td>
                <td align="right">Rp.</td>
                <td align="right">{{ number_format($tarif->storage_masa3) }}</td>
                <td align="right">Rp.</td>
                <td align="right">{{ number_format($invoice->storage_masa3) }}</td>
            </tr>
            @endif
            <tr>
              <td>2</td>
              <td>RDM</td>
              <td>{{ number_format($invoice->cbm * 1000, 2, ',', '.') }} Cbm</td>
              <td align="right">Rp.</td>
              <td align="right">{{ number_format($tarif->rdm) }}</td>
              <td align="right">Rp.</td>
              <td align="right">{{ number_format($invoice->rdm) }}</td>
            </tr>
            <tr>
              <td>3</td>
              <td>Behandle</td>
              <td>{{ number_format($invoice->behandle, 2, '.', ',') }} Cbm</td>
              <td align="right">Rp.</td>
              <td align="right">{{ number_format($tarif->behandle) }}</td>
              <td align="right">Rp.</td>
              <td align="right">{{ number_format($invoice->harga_behandle) }}</td>
            </tr>
              <tr>
              <td>4</td>
              <td>Surharge > 2.5 Ton</td>
              <td>-</td>
              <td align="right">{{ ($tarif->surcharge_price > 100) ? 'Rp.' : '%' }}</td>
              <td align="right">{{ number_format($tarif->surcharge_price) }}</td>
              <td align="right">Rp.</td>
              <td align="right">{{ number_format($invoice->weight_surcharge) }}</td>
            </tr>
            <tr>
              <td>5</td>
              <td>Adm / Doc</td>
              <td>-</td>
              <td align="right">Rp.</td>
              <td align="right">{{ number_format($tarif->adm) }}</td>
              <td align="right">Rp.</td>
              <td align="right">{{ number_format($invoice->adm) }}</td>
            </tr>
            @if($tarif->consolidator_id == 24 && $manifest->INVOICE == 'BB')
            <tr>
              <td>6</td>
              <td>Surcharge</td>
              <td>-</td>
              <td align="right">Rp.</td>
              <td align="right">{{ number_format(300000) }}</td>
              <td align="right">Rp.</td>
              <td align="right">{{ number_format(300000) }}</td>
            </tr>
<!--            <tr>
              <td>7</td>
              <td>Sticker</td>
              <td>-</td>
              <td align="right">Rp.</td>
              <td align="right">{{ number_format(10000) }}</td>
              <td align="right">Rp.</td>
              <td align="right">{{ number_format(10000) }}</td>
            </tr>-->
            @endif    
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td colspan="2">Terbilang:</td>
                <td>&nbsp;</td>
                <th align="right">TOTAL:</th>
                <td align="right"><b>Rp.</b></td>
                <td align="right"><b>{{ number_format($invoice->sub_total + $invoice->ppn) }}</b></td>
<!--              <th align="right">Subtotal:</th>
              <td align="right">Rp.</td>
              <td align="right">{{ number_format($invoice->sub_total) }}</td>-->
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td colspan="2" class="dotted"><b>{{ strtoupper($terbilang) }}</b></td>
                <td>&nbsp;</td>
<!--              <th align="right">PPN ({{ $tarif->ppn }}%)</th>
              <td align="right">Rp.</td>
              <td align="right">{{ number_format($invoice->ppn) }}</td>-->
            </tr>
<!--            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              <th align="right">TOTAL:</th>
              <td align="right"><b>Rp.</b></td>
              <td align="right"><b>{{ number_format($invoice->sub_total + $invoice->ppn) }}</b></td>
            </tr>-->
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

 
    <table border="0" cellspacing="0" cellpadding="0">
        <tr><td height="30" style="font-size: 30px;line-height: 0;">&nbsp;</td></tr>
        <tr>
            <td>Catatan :</td>
            <td class="text-center">Jakarta, {{ ($invoice->tgl_cetak != "") ? date("d F Y", strtotime($invoice->tgl_cetak)) : date("d F Y") }}</td>
        </tr>
        <tr>
            <td width='60%'>
                <ol>
                    <li>Jika terdapat kekeliruan/keberatan harap diajukan dalam waktu 7 hari setelah kwitansi diterima, lewat batas waktu tersebut kami tidak melayani.</li>
                    <li>Pengambilan/koreksi faktur pajak standard hatap diajukan paling lambat 14 hari setelah kwitansi diterima, lewat batas waktu tersebut kami tidak melayani.</li>
                </ol>
            </td>
            <td class="text-center">&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td class="text-center">ADE SRI</td>
        </tr>
    </table>
    </div>
    <a href="#" class="print-btn" type="button" onclick="window.print();">PRINT</a>
@stop