@extends('print')

@section('title')
    {{ 'Delivery Surat Jalan' }}
@stop

@section('content')
<style>
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
        <div id="title" style="color: transparent;">SURAT JALAN</div>
        <table border="0" cellspacing="0" cellpadding="0" style="margin-bottom: 0;">
            <tr>
                <td width='70%'>
                    <table border="0" cellspacing="0" cellpadding="0" style="font-size: 12px;margin-bottom: 0;">
                        <tr>
                            <td style="color: transparent;">Kepada Yth.</td>
                            <td class="padding-10 text-center" style="color: transparent;">:</td>
                            <!--<td>{{ $manifest->NAMACONSOLIDATOR }}</td>-->
                            <td>PT. PRIMANATA JASA PERSADA</td>
                        </tr>
                        <tr>
                            <td style="color: transparent;">Ex. Kapal/Voy</td>
                            <td class="padding-10 text-center" style="color: transparent;">:</td>
                            <td>{{ $manifest->VESSEL.' V.'.$manifest->VOY }}</td>
                        </tr>
                        <tr>
                            <td style="color: transparent;">Tanggal Tiba </td>
                            <td class="padding-10 text-center" style="color: transparent;">:</td>
                            <td>{{ date("d-m-Y", strtotime($manifest->ETA)) }}</td>
                        </tr>
                        
                        <tr>
                            <td style="color: transparent;">Truk No. Pol</td>
                            <td class="padding-10 text-center" style="color: transparent;">:</td>
                            <td>{{ $manifest->NOPOL }}</td>
                        </tr>
                        <tr>
                            <td style="color: transparent;">No. DO</td>
                            <td class="padding-10 text-center" style="color: transparent;">:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="color: transparent;">No. BL</td>
                            <td class="padding-10 text-center" style="color: transparent;">:</td>
                            <td>{{ $manifest->NOHBL }}</td>
                        </tr>
                        <tr>
                            <td style="color: transparent;">No. Container</td>
                            <td class="padding-10 text-center" style="color: transparent;">:</td>
                            <td>{{ $manifest->NOCONTAINER.' / '.$manifest->SIZE }}</td>
                        </tr>

                    </table>
                </td>
                <td style="vertical-align: top;">
                    <table border="0" cellspacing="0" cellpadding="0" style="font-size: 12px;margin-bottom: 0;">
                        <tr>
                            <td style="color: transparent;">No. Bea Cukai</td>
                            <td class="padding-10 text-center" style="color: transparent;">:</td>
                            <td style="color: transparent;">{{ $manifest->NO_SPPB }}</td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3">{{ $manifest->CONSIGNEE }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        
        
        <table border="0" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th rowspan="3" style="color: transparent;">NO</th>
                    <!--<th rowspan="3">MERK</th>-->
                    <th rowspan="3" style="color: transparent;">JENIS BARANG</th>
                    <th colspan="3" style="color: transparent;">JUMLAH BARANG</th>
                    <th rowspan="3" style="color: transparent;">KETERANGAN</th>
                </tr>
                <tr>
                    <th style="color: transparent;">Colly</th>
                    <th style="color: transparent;">Ton</th>
                    <th style="color: transparent;">Cbm</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>&nbsp;</td>
                    <!--<td>{{ $manifest->NAMACONSOLIDATOR }}</td>-->
                    <td width='30%'>{{ $manifest->MARKING }}</td>
                    <td>{{ $manifest->QUANTITY }}/{{ $manifest->NAMAPACKING }}</td>
                    <td>{{ $manifest->WEIGHT }}</td>
                    <td>{{ $manifest->MEAS }}</td>
                    <td width='30%'>{{ $manifest->DESCOFGOODS }}</td>
                </tr>
            </tbody>
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
<!--        <table border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td>Penerima</td>
                <td>Sopir Truck</td>
                <td>Petugas APW</td>
                <td class="text-center" style="border: 1px solid;">Custodian</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td height="70" style="font-size: 70px;line-height: 0;border: 1px solid;"></td>
            </tr>
            <tr>
                <td>(..................)</td>
                <td>(..................)</td>
                <td>(..................)</td>
                <td>&nbsp;</td>
            </tr>
        </table>-->
    </div>
        
@stop