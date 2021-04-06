@extends('print-with-header')

@section('title')
    {{ 'Laporan Harian LCL' }}
@stop

@section('content')
<style>
    body {
        color: #000;
        background: #fff;
        font-size: 11px;
    }
    table, th, tr, td {
        font-size: 10px;
    }
    @media print {
        body {
            color: #000;
            background: #fff;
            font-size: 11px;
        }
        table, th, tr, td {
            font-size: 10px;
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
<a href="#" class="print-btn" type="button" onclick="window.print();">PRINT</a>
<div id="details" class="clearfix">
    <div id="lap-masuk" @if($type == 'out') style="display: none;" @endif>
        <div class="row invoice-info">
            <div style="text-align: center;">
                <h3 style="margin-bottom: 0;">LAPORAN PEMASUKAN CARGO GUDANG LCL IMPOR</h3>
                <h4 style="margin-bottom: 0;margin-top: 0;">GUDANG TPS PT. PRIMANATA JASA PERSADA</h4>
                <p style="margin-top: 0;font-size: 14px;">Tanggal {{date('d F Y', strtotime($date))}}</p>
            </div>
        </div>

        <div class="row">
          <div class="col-xs-12 table-responsive">
              <table border="1" cellspacing="0" cellpadding="0">
                  <thead>
                    <tr>
                        <th rowspan="2">NO.</th>
                        <th rowspan="2">EX<br />CONTAINER</th>
                        <th rowspan="2">EX-KAPAL</th>
                        <th colspan="2">TANGGAL</th> 
                        <th rowspan="2">CONSIGNEE</th>
                        <th colspan="4">PARTY</th>
                        <th rowspan="2">NO. B/L</th>
                        <th rowspan="2">TGL. B/L</th>
                        <th rowspan="2">TPS ASAL</th>
                        <th colspan="2">BC 1.1</th>
                        <th rowspan="2">NO. POS</th>
                    </tr>
                    <tr>
                        <th>TIBA</th>
                        <th>OB</th>
                        <th>JML</th>
                        <th>PACKING</th>
                        <th>KGS</th>
                        <th>M3</th>
                        <th>NO</th>
                        <th>TGL</th>
                    </tr>

                  </thead>
                  <tbody>
                      <?php $i = 1;?>
                      @foreach($in as $masuk)
                      <tr>
                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ $i }}</td>
                          <td style="text-align: left;border-top: none;border-bottom: none;">{{ $masuk->NOCONTAINER }}</td>
                          <td style="text-align: left;border-top: none;border-bottom: none;">{{ $masuk->VESSEL }}</td>
                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ date('d-M-y',strtotime($masuk->ETA)) }}</td>
                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ date('d-M-y',strtotime($masuk->tglmasuk)) }}</td>
                          <td style="text-align: left;border-top: none;border-bottom: none;">{{ $masuk->CONSIGNEE }}</td>
                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ $masuk->QUANTITY }}</td>
                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ $masuk->NAMAPACKING }}</td>
                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ $masuk->WEIGHT }}</td>
                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ $masuk->MEAS }}</td>
                          <td style="text-align: left;border-top: none;border-bottom: none;">{{ $masuk->NOHBL }}</td>
                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ date('d-M-y',strtotime($masuk->TGL_HBL)) }}</td>                      
                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ $masuk->KD_TPS_ASAL }}</td>
                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ $masuk->NO_BC11 }}</td>
                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ date('d-M-y',strtotime($masuk->TGL_BC11)) }}</td>
                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ $masuk->NO_POS_BC11 }}</td>
                      </tr>
                      <?php $i++;?>
                      @endforeach
                  </tbody>
              </table>
          </div>
            <div class="col-xs-4 table-responsive" style="max-width: 300px;">
                <table border="1" cellspacing="0" cellpadding="0">
                    <tbody>
                        @foreach($sum_bl_in as $key=>$value)
                        <tr>
                            <th style="border-top: none;border-bottom: none;">{{ $key }}</th>
                            <td  style="border-top: none;border-bottom: none;text-align: center;">{{ $value }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div id="lap-keluar" @if($type == 'in') style="display: none;" @endif>
        <div class="row invoice-info">
            <div style="text-align: center;">
                <h3 style="margin-bottom: 0;">LAPORAN PENGELUARAN CARGO GUDANG LCL IMPOR</h3>
                <h4 style="margin-bottom: 0;margin-top: 0;">GUDANG TPS PT. PRIMANATA JASA PERSADA</h4>
                <p style="margin-top: 0;font-size: 14px;">Tanggal {{date('d F Y', strtotime($date))}}</p>
            </div>
        </div>

        <div class="row">
          <div class="col-xs-12 table-responsive">
              <table border="1" cellspacing="0" cellpadding="0">
                  <thead>
                    <tr>
                        <th rowspan="2">NO.</th>
                        <th rowspan="2">EX<br />CONTAINER</th>
                        <th rowspan="2">EX-KAPAL</th>
                        <th colspan="2">TANGGAL</th> 
                        <th rowspan="2">CONSIGNEE</th>
                        <th colspan="4">PARTY</th>
                        <th rowspan="2">NO. B/L</th>
                        <th colspan="3">DOKUMEN</th>
                        <th rowspan="2">TPS ASAL</th>
                        <th colspan="2">BC 1.1</th>
                        <th rowspan="2">NO. POS</th>
                    </tr>
                    <tr>
                        <th>TIBA</th>
                        <th>OB</th>
                        <th>JML</th>
                        <th>PACKING</th>
                        <th>KGS</th>
                        <th>M3</th>
                        <th>KODE</th>
                        <th>NO</th>
                        <th>TGL</th>
                        <th>NO</th>
                        <th>TGL</th>
                    </tr>

                  </thead>
                  <tbody>
                      <?php $i = 1;?>
                      @foreach($out as $keluar)
                      <tr>
                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ $i }}</td>
                          <td style="text-align: left;border-top: none;border-bottom: none;">{{ $keluar->NOCONTAINER }}</td>
                          <td style="text-align: left;border-top: none;border-bottom: none;">{{ $keluar->VESSEL }}</td>
                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ date('d-M-y',strtotime($keluar->ETA)) }}</td>
                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ date('d-M-y',strtotime($keluar->tglmasuk)) }}</td>
                          <td style="text-align: left;border-top: none;border-bottom: none;">{{ $keluar->CONSIGNEE }}</td>
                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ $keluar->QUANTITY }}</td>
                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ $keluar->NAMAPACKING }}</td>
                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ $keluar->WEIGHT }}</td>
                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ $keluar->MEAS }}</td>
                          <td style="text-align: left;border-top: none;border-bottom: none;">{{ $keluar->NOHBL }}</td>
                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ $keluar->KODE_DOKUMEN }}</td>
                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ $keluar->NO_SPPB }}</td>
                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ date('d-M-y',strtotime($keluar->TGL_SPPB)) }}</td>                      
                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ $keluar->KD_TPS_ASAL }}</td>
                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ $keluar->NO_BC11 }}</td>
                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ date('d-M-y',strtotime($keluar->TGL_BC11)) }}</td>
                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ $keluar->NO_POS_BC11 }}</td>
                      </tr>
                      <?php $i++;?>
                      @endforeach
                  </tbody>
              </table>
          </div>

        </div>

        <div class="row">
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td>
                        <div class="col-xs-4 table-responsive">
                            <p>RINCIAN JENIS DOKUMEN PENGELUARAN</p>
                            <table border="1" cellspacing="0" cellpadding="0" style="width: 300px;">
                                <thead>
                                    <tr>
                                      <th>No.</th>
                                      <th>Jenis Dokumen</th>
                                      <th>Jumlah</th>
                                    </tr>
                                      <?php $sumdoc = 0;$i = 1;?>
                                      @foreach($countbydoc as $key=>$value)
                                      <tr>
                                          <td style="text-align: center;border-top: none;border-bottom: none;">{{$i}}</td>
                                          <td style="border-top: none;border-bottom: none;">{{ $key }}</td>
                                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ $value }}</td>
                                      </tr>
                                      <?php $sumdoc += $value;$i++;?>
                                      @endforeach
                                      <tr>
                                          <th colspan="2">Jumlah Total</th>
                                          <th align="center" style="text-align: center;">{{$sumdoc}}</th>
                                      </tr>
                                </thead>
                            </table>
                        </div>
                    </td>
                    <td>
                        <div class="col-xs-4 table-responsive">
                            <table border="1" cellspacing="0" cellpadding="0">
                                <tbody>
                                    @foreach($sum_bl_out as $key=>$value)
                                    <tr>
                                        <th style="border-top: none;border-bottom: none;">{{ $key }}</th>
                                        <td  style="border-top: none;border-bottom: none;text-align: center;">{{ $value }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </td>

                </tr>
            </table>
        </div>
    </div>
    
    <div class="row">
        <div class="table-responsive">
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="text-align: center;">Mengetahui,</td>
                    <td style="text-align: center;">Jakarta, {{ date('d F Y', strtotime($date)) }}</td>
                </tr>
                <tr>
                    <td style="text-align: center;">Bea Cukai TPS PT PRIMANATA JASA PERSADA</td>
                    <td style="text-align: center;">TPS PT PRIMANATA JASA PERSADA</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align: center;"><b>..................................</b></td>
                    <td style="text-align: center;"><b>..................................</b></td>
                </tr>
            </table>
        </div>
    </div>
</div>
@stop