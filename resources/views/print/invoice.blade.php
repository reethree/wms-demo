@extends('print')

@section('title')
    {{ 'Invoice '.$invoice->no_invoice }}
@stop

@section('content')
    <div id="details" class="clearfix">
        <div class="row invoice-info">
        <div class="col-xs-12 text-center margin-bottom">
            <h2><b>INVOICE</b></h2>
        </div>
      <div class="col-sm-4 invoice-col">
          <table border="0" cellspacing="0" cellpadding="0">
              <tr>
                  <td><b>Kepada Yth.</b></td>
                  <td>:&nbsp;&nbsp;&nbsp;&nbsp;<b>{{ $manifest->NAMACONSOLIDATOR }}</b></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td align="right">( {{ $manifest->INVOICE }} )</td>
              </tr>
              <tr>
                  <td><b>Consignee</b></td>
                  <td>:&nbsp;&nbsp;&nbsp;&nbsp;{{ $manifest->CONSIGNEE }}</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
              </tr>
              <tr>
                  <td><b>Ex. Kapal</b></td>
                  <td>:&nbsp;&nbsp;&nbsp;&nbsp;{{ $manifest->VESSEL }}</td>
                  <td><b>Tgl. Masuk</b></td>
                  <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                  <td>{{ date('d-M-y', strtotime($manifest->tglmasuk)) }}</td>
              </tr>
              <tr>
                  <td><b>No. B/L / D/O</b></td>
                  <td>:&nbsp;&nbsp;&nbsp;&nbsp;{{ $manifest->NOHBL }}</td>
                  <td><b>Tgl. ETA</b></td>
                  <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                  <td>{{ date('d-M-y', strtotime($manifest->ETA)) }}</td>
              </tr>
              <tr>
                  <td><b>Party</b></td>
                  <td>:&nbsp;&nbsp;&nbsp;&nbsp;{{ $manifest->WEIGHT }} KGS</td>
                  <td><b>Tgl. Keluar</b></td>
                  <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                  <td>{{ date('d-M-y', strtotime($manifest->tglrelease)) }}</td>
              </tr>
              <tr>
                  <td>&nbsp;</td>
                  <td>:&nbsp;&nbsp;&nbsp;&nbsp;{{ $manifest->MEAS }} CBM</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
              </tr>
              <tr>
                  <td><b>Ex. Cont</b></td>
                  <td>:&nbsp;&nbsp;&nbsp;&nbsp;{{ $manifest->NOCONTAINER }} / {{ $manifest->SIZE }}</td>
                  <td><b>No. Invoice</b></td>
                  <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                  <td>{{ $invoice->no_invoice }}</td>
              </tr>
              <tr>
                  <td><b>Tempat Penumpokan</b></td>
                  <td>:&nbsp;&nbsp;&nbsp;&nbsp;Gudang PRIMANATA</td>
              </tr>
          </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <br /><br />
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
          <tr>
            <td>&nbsp;</td>
            <td>Biaya Penumpukan</td>
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
          <tr>
            <td>2</td>
            <td>RDM</td>
            <td>{{ number_format($invoice->cbm * 1000, 0, ',', '.') }} Cbm</td>
            <td align="right">Rp.</td>
            <td align="right">{{ number_format($tarif->rdm) }}</td>
            <td align="right">Rp.</td>
            <td align="right">{{ number_format($invoice->rdm) }}</td>
          </tr>
          <tr>
            <td>3</td>
            <td>Behandle</td>
            <td>{{ number_format($invoice->behandle) }}</td>
            <td align="right">Rp.</td>
            <td align="right">{{ number_format($tarif->behandle) }}</td>
            <td align="right">Rp.</td>
            <td align="right">{{ number_format($invoice->harga_behandle) }}</td>
          </tr>
          <tr>
            <td>4</td>
            <td>Surharge > 2.5 Ton</td>
            <td>-</td>
            <td align="right">%</td>
            <td align="right">{{ number_format($tarif->weight_surcharge) }}</td>
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
              <th align="right">Subtotal:</th>
              <td align="right">Rp.</td>
              <td align="right">{{ number_format($invoice->sub_total) }}</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td colspan="2" class="dotted"><b>{{ $terbilang }}</b></td>
                <td>&nbsp;</td>
              <th align="right">PPN ({{ $tarif->ppn }}%)</th>
              <td align="right">Rp.</td>
              <td align="right">{{ number_format($invoice->ppn) }}</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              <th align="right">TOTAL:</th>
              <td align="right"><b>Rp.</b></td>
              <td align="right"><b>{{ number_format($invoice->sub_total + $invoice->ppn) }}</b></td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

 
    <table border="0" cellspacing="0" cellpadding="0">
        <tr><td height="50" style="font-size: 50px;line-height: 0;">&nbsp;</td></tr>
        <tr>
            <td>Catatan :</td>
            <td class="text-center">Jakarta, {{ date('d F Y') }}</td>
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
        
@stop