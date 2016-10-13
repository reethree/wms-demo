@extends('print')

@section('title')
    {{ 'Delivery Surat Jalan' }}
@stop

@section('content')

    <div id="details" class="clearfix">
        <div id="title">SURAT JALAN</div>
        <table border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td>
                    <table border="0" cellspacing="0" cellpadding="0" style="font-size: 12px;">
                        <tr>
                            <td>Kepada Yth.</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ $manifest->NAMACONSOLIDATOR }}</td>
                        </tr>
                        <tr>
                            <td>No. Surat Jalan </td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ $manifest->NOTALLY }}</td>
                        </tr>
                        <tr>
                            <td>Ex. Kapal</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ $manifest->VESSEL }}</td>
                        </tr>
                        <tr>
                            <td>Voy</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ $manifest->VOY }}</td>
                        </tr>
                        <tr>
                            <td>No. HBL </td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ $manifest->NOHBL }}</td>
                        </tr>
                        <tr>
                            <td>No. Truck</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ $manifest->NOPOL }}</td>
                        </tr>

                    </table>
                </td>
                <td style="vertical-align: top;">
                    <table border="0" cellspacing="0" cellpadding="0" style="font-size: 12px;">
                        <tr>
                            <td>No. Bea Cukai</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ $manifest->NO_SPPB }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        
        
        <table border="1" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th rowspan="2">MERK</th>
                    <th rowspan="2">JENIS BARANG</th>
                    <th colspan="2">JUMLAH BARANG</th>
                    <th rowspan="2">KETERANGAN</th>
                </tr>
                <tr>
                    <th>QUANTITY</th>
                    <th class="text-center">MT</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $manifest->NAMACONSOLIDATOR }}</td>
                    <td>{{ $manifest->MARKING }}</td>
                    <td>{{ $manifest->QUANTITY }}/{{ $manifest->NAMAPACKING }}</td>
                    <td>{{ $manifest->MEAS }}</td>
                    <td>{{ $manifest->DESCOFGOODS }}</td>
                </tr>
            </tbody>
        </table>
        
        <table border="0" cellspacing="0" cellpadding="0">
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
        </table>
        <!--<div style="page-break-after: always;"></div>-->
        <table border="0" cellspacing="0" cellpadding="0">
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
        </table>
    </div>
        
@stop