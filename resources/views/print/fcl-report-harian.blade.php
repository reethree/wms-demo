@extends('print-with-header')

@section('title')
    {{ 'Laporan Harian FCL' }}
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
                <h3 style="margin-bottom: 0;">LAPORAN HARIAN PEMASUKAN CONTAINER FULL</h3>
                <h4 style="margin-bottom: 0;margin-top: 0;">LAPANGAN TPS PT. PRIMANATA JASA PERSADA</h4>
                <p style="margin-top: 0;font-size: 14px;">Tanggal {{date('d F Y', strtotime($date))}}</p>
            </div>
        </div>

        <div class="row">
          <div class="col-xs-12 table-responsive">
              <table border="1" cellspacing="0" cellpadding="0">
                  <thead>
                    <tr>
                        <th rowspan="2">NO.</th>
                        <th rowspan="2">NOMOR<br />CONTAINER</th>
                        <th colspan="3">SIZE</th> 
                        <th rowspan="2">TYPE</th>
                        <th rowspan="2">EX-KAPAL</th>
                        <th rowspan="2">TANGGAL<br />TIBA</th>
                        <th rowspan="2">TANGGAL<br />OB</th>
                        <th rowspan="2">CONSIGNEE</th>
                        <th rowspan="2">OPERATOR<br />OB</th>
                        <th colspan="2">PEMASUKAN PLP</th>
                        <th rowspan="2">TPS ASAL</th>
                        <th colspan="2">BC 1.1</th>
                        <th rowspan="2">JAM</th>
                    </tr>
                    <tr>
                        <th>20'</th>
                        <th>40'</th>
                        <th>45'</th>
                        <th>NO</th>
                        <th>TGL</th>
                        <th>NO</th>
                        <th>TGL</th>
                    </tr>

                  </thead>
                  <tbody>
                      <?php $i = 1; $c20 = 0; $c40 = 0; $c45 = 0;?>
                      @foreach($in as $masuk)
                      <tr>
                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ $i }}</td>
                          <td style="text-align: left;border-top: none;border-bottom: none;">{{ $masuk->NOCONTAINER }}</td>

                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ ($masuk->SIZE == 20) ? '1' : '' }}</td>
                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ ($masuk->SIZE == 40) ? '1' : '' }}</td>
                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ ($masuk->SIZE == 45) ? '1' : '' }}</td>

                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ $masuk->jenis_container }}</td>
                          <td style="text-align: left;border-top: none;border-bottom: none;">{{ $masuk->VESSEL }}</td>
                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ date('d-M-y',strtotime($masuk->ETA)) }}</td>
                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ date('d-M-y',strtotime($masuk->TGLMASUK)) }}</td>
                          <td style="text-align: left;border-top: none;border-bottom: none;">{{ $masuk->CONSIGNEE }}</td>
                          <td style="text-align: center;border-top: none;border-bottom: none;"></td>

                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ $masuk->NO_PLP }}</td>
                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ date('d-M-y',strtotime($masuk->TGL_PLP)) }}</td>

                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ $masuk->KD_TPS_ASAL }}</td>

                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ $masuk->NO_BC11 }}</td>
                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ date('d-M-y',strtotime($masuk->TGL_BC11)) }}</td>

                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ $masuk->JAMMASUK }}</td>
                      </tr>
                      <?php 
                            $i++;
                            if($masuk->SIZE == 20){$c20++;}
                            if($masuk->SIZE == 40){$c40++;}
                            if($masuk->SIZE == 45){$c45++;}
                        ?>
                      @endforeach
                      <tr>
                          <td>&nbsp;</td>
                          <th>TOTAL</th>
                          <th>{{$c20}}</th>
                          <th>{{$c40}}</th>
                          <th>{{$c45}}</th>
                          <th colspan="2">= {{$c20+$c40+$c45}} Box</th>
                          <td colspan="10">&nbsp;</td>
                      </tr>
                  </tbody>
              </table>
          </div>
        </div>
    </div>
    
    <div id="lap-keluar" @if($type == 'in') style="display: none;" @endif>
        <div class="row invoice-info">
            <div style="text-align: center;">
                <h3 style="margin-bottom: 0;">LAPORAN HARIAN PENGELUARAN CONTAINER FULL</h3>
                <h4 style="margin-bottom: 0;margin-top: 0;">LAPANGAN TPS PT. PRIMANATA JASA PERSADA</h4>
                <p style="margin-top: 0;font-size: 14px;">Tanggal {{date('d F Y', strtotime($date))}}</p>
            </div>
        </div>

        <div class="row">
          <div class="col-xs-12 table-responsive">
              <table border="1" cellspacing="0" cellpadding="0">
                  <thead>
                    <tr>
                        <th rowspan="2">NO.</th>
                        <th rowspan="2">NOMOR<br />CONTAINER</th>
                        <th colspan="3">SIZE</th> 
                        <th rowspan="2">TYPE</th>
                        <th rowspan="2">EX-KAPAL</th>
                        <th rowspan="2">TANGGAL<br />TIBA</th>
                        <th rowspan="2">TANGGAL<br />OB</th>
                        <th rowspan="2">CONSIGNEE</th>
                        <th rowspan="2">OPERATOR<br />OB</th>
                        <th colspan="3">DOK PENGELUARAN</th>
                        <th rowspan="2">TPS ASAL</th>
                        <th colspan="2">BC 1.1</th>
                        <th rowspan="2">JAM</th>
                    </tr>
                    <tr>
                        <th>20'</th>
                        <th>40'</th>
                        <th>45'</th>
                        <th>KODE</th>
                        <th>NO</th>
                        <th>TGL</th>
                        <th>NO</th>
                        <th>TGL</th>
                    </tr>

                  </thead>
                  <tbody>
                      <?php $i = 1; $oc20 = 0; $oc40 = 0; $oc45 = 0;?>
                      @foreach($out as $keluar)
                      <tr>
                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ $i }}</td>
                          <td style="text-align: left;border-top: none;border-bottom: none;">{{ $keluar->NOCONTAINER }}</td>

                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ ($keluar->SIZE == 20) ? '1' : '' }}</td>
                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ ($keluar->SIZE == 40) ? '1' : '' }}</td>
                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ ($keluar->SIZE == 45) ? '1' : '' }}</td>

                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ $keluar->jenis_container }}</td>
                          <td style="text-align: left;border-top: none;border-bottom: none;">{{ $keluar->VESSEL }}</td>
                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ date('d-M-y',strtotime($keluar->ETA)) }}</td>
                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ date('d-M-y',strtotime($keluar->TGLMASUK)) }}</td>
                          <td style="text-align: left;border-top: none;border-bottom: none;">{{ $keluar->CONSIGNEE }}</td>
                          <td style="text-align: center;border-top: none;border-bottom: none;"></td>

                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ $keluar->KODE_DOKUMEN }}</td>
                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ $keluar->NO_SPPB }}</td>
                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ date('d-M-y',strtotime($keluar->TGL_SPPB)) }}</td>

                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ $keluar->KD_TPS_ASAL }}</td>

                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ $keluar->NO_BC11 }}</td>
                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ date('d-M-y',strtotime($keluar->TGL_BC11)) }}</td>

                          <td style="text-align: center;border-top: none;border-bottom: none;">{{ $keluar->JAMRELEASE }}</td>
                      </tr>
                      <?php
                            $i++;
                            if($keluar->SIZE == 20){$oc20++;}
                            if($keluar->SIZE == 40){$oc40++;}
                            if($keluar->SIZE == 45){$oc45++;}
                      ?>
                      @endforeach
                        <tr>
                          <td>&nbsp;</td>
                          <th>TOTAL</th>
                          <th>{{$oc20}}</th>
                          <th>{{$oc40}}</th>
                          <th>{{$oc45}}</th>
                          <th colspan="2">= {{$oc20+$oc40+$oc45}} Box</th>
                          <td colspan="11">&nbsp;</td>
                      </tr>
                  </tbody>
              </table>
          </div>
        </div>

        <div class="row">
            <div class="table-responsive" style="max-width: 300px;">
              <p>RINCIAN JENIS DOKUMEN PENGELUARAN</p>
              <table border="1" cellspacing="0" cellpadding="0">
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