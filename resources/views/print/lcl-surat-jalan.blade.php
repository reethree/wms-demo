@extends('print')

@section('title')
    {{ 'Delivery Surat Jalan' }}
@stop

@section('content')
<style>
    td {
        vertical-align: top;
    }
    @media print {
        body {
            background: #FFF;
        }
        @page {
            size: auto;   /* auto is the initial value */
/*            margin-top: 114px;
            margin-bottom: 90px;
            margin-left: 38px;
            margin-right: 75px;*/
            font-weight: bold;
        }
        .print-btn {
            display: none;
        }
    }
</style>
<a href="#" class="print-btn" type="button" onclick="window.print();">PRINT</a>
    <div id="details" class="clearfix">
        <div id="title" style="font-weight: bold;">SURAT JALAN <br /><span style="font-size: 14px;">No. {{$manifest->NOJOBORDER}}</span></div>
        <p></p>
        <table border="0" cellspacing="0" cellpadding="0" style="margin-bottom: 0;">
            <tr>
                <td width='60%'>
                    <table border="0" cellspacing="0" cellpadding="0" style="font-size: 12px;margin-bottom: 0;">
                        <tr>
                            <td colspan="3"><h4>CARGO DETAILS</h4></td>
                        </tr>
                        <tr>
                            <td>HBL</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ $manifest->NOHBL }}</td>
                        </tr>
                        <tr>
                            <td>DATE</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ date("d-m-Y", strtotime($manifest->TGL_HBL)) }}</td>
                        </tr>
<!--                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>-->
                        <tr>
                            <td style="vertical-align: top;">QUANTITY</td>
                            <td class="padding-10 text-center" style="vertical-align: top;">:</td>
                            <td>{{ $manifest->QUANTITY.' '.$manifest->NAMAPACKING }}<br />{{ $manifest->WEIGHT.' KGS '.$manifest->MEAS.' CBM' }}</td>
                        </tr>
<!--                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>-->
                        <tr>
                            <td>EX CONTAINER</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ $manifest->NOCONTAINER.' / '.$manifest->SIZE }}</td>
                        </tr>
                        <tr>
                            <td>EX VASSEL/VOY</td>
                            <td class="padding-10 text-center" style="color: transparent;">:</td>
                            <td>{{ $manifest->VESSEL.' V.'.$manifest->VOY }}</td>
                        </tr>
                        <tr>
                            <td>DATE OF ARRIVAL</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ date("d-m-Y", strtotime($manifest->ETA)) }}</td>
                        </tr>
                        <tr>
                            <td>DATE IN</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ date("d-m-Y", strtotime($manifest->tglmasuk)) }}</td>
                        </tr>
                        <tr>
                            <td>IMO CLASS</td>
                            <td class="padding-10 text-center">:</td>
                            <td></td>
                        </tr>
                    </table>
                </td>
                <td style="vertical-align: top;">
                    <table border="0" cellspacing="0" cellpadding="0" style="font-size: 12px;margin-bottom: 0;">
                        <tr>
                            <td colspan="3"><h4>DELIVERY TO</h4></td>
                        </tr>
                        <tr>
                            <td>CONSIGNEE :<br /><b>{{ $consignee->NAMAPERUSAHAAN }}</b></td>
                        </tr>
                        <tr><td></td></tr>
                        <tr>
                            <td>ADDRESS :<br /><b>{{ $consignee->ALAMAT }}</b></td>
                        </tr>
                        <tr><td></td></tr>
                        <tr>
                            <td>BY TRUCK :<br /><b>{{ $manifest->NOPOL_RELEASE }}</b></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        
        <br />
        <table border="1" cellspacing="0" cellpadding="0">
            <tr>
                <td width='50%'>
                    <h4>DESCRIPTION : </h4>
                    <p>{{ str_limit($manifest->DESCOFGOODS, 150) }}</p>
                    <br />
                </td>
                <td width='50%'>
                    <h4>MARKS : </h4>
                    <p>{{ $manifest->MARKING }}</p>
                    <br />
                </td>
            </tr>
            <tr>
                <td width='50%'>
                    <h4>NOTES : </h4>
                    <br />
                </td>
                <td width='50%'>
                    <h4>RACK / LOCATION :</h4>
                    <p>{{ $manifest->location_name }}</p>
                    <br />
                </td>
            </tr>
<!--            <thead>
                <tr>
                    <th rowspan="3">NO</th>
                    <th rowspan="3">MERK</th>
                    <th rowspan="3">JENIS BARANG</th>
                    <th colspan="3">JUMLAH BARANG</th>
                    <th rowspan="3">KETERANGAN</th>
                </tr>
                <tr>
                    <th>Colly</th>
                    <th>Ton</th>
                    <th>Cbm</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>&nbsp;</td>
                    <td>{{ $manifest->NAMACONSOLIDATOR }}</td>
                    <td width='30%'>{{ $manifest->MARKING }}</td>
                    <td>{{ $manifest->QUANTITY }}/{{ $manifest->NAMAPACKING }}</td>
                    <td>{{ $manifest->WEIGHT }}</td>
                    <td>{{ $manifest->MEAS }}</td>
                    <td width='30%'>{{ $manifest->DESCOFGOODS }}</td>
                </tr>
            </tbody>-->
        </table>
        
<!--        <table border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td colspan="50"></td>
            </tr>
        </table>
        
        <table border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td style="border: 1px solid;">&nbsp;&nbsp;</td>
                <td>Barang dalam keadaan baik, lengkap dan sesuai DO.</td>
            </tr>
            <tr><td style="border-bottom: 1px solid;"></td><td></td></tr>
            <tr>
                <td style="border: 1px solid;">&nbsp;&nbsp;</td>
                <td>Barang dalam keadaan rusak/cacat/tidak lengkap (Lampiran berita acara)</td>
            </tr>
        </table>
        
        <table border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td>Tanjung Priok, {{ date('d-m-Y H:i:s') }}</td>
            </tr>
        </table>-->
        <!--<div style="page-break-after: always;"></div>-->
        <table border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width='33%' style="text-align: center;vertical-align: bottom;">Penerima<br />Nama Terang</td>
                <td width='33%' style="text-align: center;vertical-align: bottom;"">Sopir Truck<br />Nama Terang</td>
                <td width='33%' style="text-align: center;">Tanjung Priok, {{date('d F Y')}}<br />PT. Primanata Jasa Persada<br />Petugas</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: center;">(.............................)</td>
                <td style="text-align: center;">(.............................)</td>
                <td style="text-align: center;">(.............................)</td>
            </tr>
        </table>
    </div>
        
@stop