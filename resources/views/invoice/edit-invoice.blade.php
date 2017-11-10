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
        <div class="col-xs-12 text-center margin-bottom">
            <h2><b>INVOICE</b></h2>
        </div>
      <div class="col-sm-4 invoice-col">
          <table>
              <tr>
                  <td><b>Kepada Yth.</b></td>
              </tr>
              <tr>
                  <td><b>Consignee</b></td>
              </tr>
              <tr>
                  <td><b>Ex. Kapal</b></td>
              </tr>
              <tr>
                  <td><b>No. B/L / D/O</b></td>
              </tr>
              <tr>
                  <td><b>Party</b></td>
              </tr>
              <tr>
                  <td>&nbsp;</td>
              </tr>
              <tr>
                  <td><b>Ex. Cont</b></td>
              </tr>
              <tr>
                  <td><b>Tempat Penumpukan</b></td>
              </tr>
          </table>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <table>
              <tr>
                  <td>:&nbsp;&nbsp;&nbsp;&nbsp;<b>{{ $manifest->NAMACONSOLIDATOR }}</b></td>
              </tr>
              <tr>
                  <td>:&nbsp;&nbsp;&nbsp;&nbsp;{{ $manifest->CONSIGNEE }}</td>
              </tr>
              <tr>
                  <td>:&nbsp;&nbsp;&nbsp;&nbsp;{{ $manifest->VESSEL }}</td>
              </tr>
              <tr>
                  <td>:&nbsp;&nbsp;&nbsp;&nbsp;{{ $manifest->NOHBL }}</td>
              </tr>
              <tr>
                  <td>:&nbsp;&nbsp;&nbsp;&nbsp;{{ $manifest->WEIGHT }} KGS</td>
              </tr>
              <tr>
                  <td>:&nbsp;&nbsp;&nbsp;&nbsp;{{ $manifest->MEAS }} CBM</td>
              </tr>
              <tr>
                  <td>:&nbsp;&nbsp;&nbsp;&nbsp;{{ $manifest->NOCONTAINER }} / {{ $manifest->SIZE }}</td>
              </tr>
              <tr>
                  <td>:&nbsp;&nbsp;&nbsp;&nbsp;Gudang PRIMANATA</td>
              </tr>
          </table>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
          <table>
              <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td align="right">( {{ $manifest->INVOICE }} )</td>
              </tr>
              <tr>
                  <td>&nbsp;</td>
              </tr>
              <tr>
                  <td><b>Tgl. Masuk</b></td>
                  <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                  <td>{{ date('d-M-y', strtotime($manifest->tglmasuk)) }}</td>
              </tr>
              <tr>
                  <td><b>Tgl. ETA</b></td>
                  <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                  <td>{{ date('d-M-y', strtotime($manifest->ETA)) }}</td>
              </tr>
              <tr>
                  <td><b>Tgl. Keluar</b></td>
                  <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                  <td>{{ date('d-M-y', strtotime($manifest->tglrelease)) }}</td>
              </tr>
              <tr>
                  <td>&nbsp;</td>
              </tr>
              <tr>
                  <td><b>No. Invoice</b></td>
                  <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                  <td>{{ $invoice->no_invoice }}</td>
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
        <table class="table table-striped" border="0">
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
            <td>{{ number_format($invoice->cbm * 1000, 0, '.', ',') }} Cbm x {{ $invoice->hari }} hari</td>
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
            <td>{{ number_format($invoice->cbm, 3, '.', ',') }} Cbm</td>
            <td align="right">Rp.</td>
            <td align="right">{{ number_format($tarif->rdm) }}</td>
            <td align="right">Rp.</td>
            <td align="right">{{ number_format($invoice->rdm) }}</td>
          </tr>
          <tr>
            <td>3</td>
            <td>Behandle</td>
            <td>{{ number_format($invoice->behandle, 3, '.', ',') }} Cbm</td>
            <td align="right">Rp.</td>
            <td align="right">{{ number_format($tarif->behandle) }}</td>
            <td align="right">Rp.</td>
            <td align="right">{{ number_format($invoice->harga_behandle) }}</td>
          </tr>
          <tr>
            <td>4</td>
            <td>Surcharge > 2.5 Ton</td>
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
<!--          <tr>
            <td>7</td>
            <td>Sticker</td>
            <td>-</td>
            <td align="right">Rp.</td>
            <td align="right">{{ number_format(10000) }}</td>
            <td align="right">Rp.</td>
            <td align="right">{{ number_format(10000) }}</td>
          </tr>-->
          @endif
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-xs-6">
        <p>Terbilang:</p>
        <p class="text-muted well well-sm no-shadow" style="margin-top: 10px; color: #000;">
          {{ $terbilang }}
        </p>
      </div>
      <!-- /.col -->
      <div class="col-xs-6">
        <!--<p class="lead">Amount Due 2/22/2014</p>-->

        <div class="table-responsive">
          <table class="table">
            <tbody>
<!--            <tr>
              <th style="width:50%" align="right">Subtotal:</th>
              <td align="right">Rp.</td>
              <td align="right">{{ number_format($invoice->sub_total) }}</td>
            </tr>-->
<!--            <tr>
              <th align="right">PPN ({{ $tarif->ppn }}%)</th>
              <td align="right">Rp.</td>
              <td align="right">{{ number_format($invoice->ppn) }}</td>
            </tr>-->
            <tr>
              <th align="right">Total:</th>
              <td align="right"><b>Rp.</b></td>
              <td align="right"><b>{{ number_format($invoice->sub_total + $invoice->ppn) }}</b></td>
            </tr>
          </tbody></table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- this row will not appear when printing -->
    <div class="row no-print">
      <div class="col-xs-12">
          <button id="print-invoice-btn" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
<!--        <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
        </button>
        <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
          <i class="fa fa-download"></i> Generate PDF
        </button>-->
      </div>
    </div>
  </section>

@endsection

@section('custom_css')

@endsection

@section('custom_js')

<script type="text/javascript">
    $('#print-invoice-btn').click(function() {
        window.open("{{ route('invoice-print',$invoice->id) }}","preview invoice ","width=600,height=600,menubar=no,status=no,scrollbars=yes");
    });
</script>

@endsection