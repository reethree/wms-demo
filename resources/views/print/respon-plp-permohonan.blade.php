@extends('print')

@section('title')
    {{ 'Respon PLP Permohonan Pindah Lokasi' }}
@stop

@section('content')
        
<style>
    table, table tr, table tr td{
        font-size: 12px;
    }
    table {
        margin-bottom: 10px;
    }
    @media print {
        body {
            background: #FFF;
            color: #000;
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
        <table border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td>
                    <table border="0" cellspacing="0" cellpadding="0" style="font-size: 12px;">
                        <tr>
                            <td>Nomor</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ $respon->NO_SURAT }}</td>
                        </tr>
                        <tr>
                            <td>Lampiran</td>
                            <td class="padding-10 text-center">:</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>Hal</td>
                            <td class="padding-10 text-center">:</td>
                            <td>Permohonan Pindah Lokasi Penimbunan</td>
                        </tr>   
                    </table> 
                </td>
                <td style="vertical-align: top;">
                    <table border="0" cellspacing="0" cellpadding="0" style="font-size: 12px;">
                        <tr>
                            <td style="text-align: right;">Jakarta, {{ date('d F Y') }}</td> 
                        </tr>
                    </table>
                </td>
            </tr>   
            
            <tr>
                <td>&nbsp;</td>
            </tr>
            
            <tr>
                <td colspan="2">
                    <p>Yth. Kapala Kantor Pelayanan Umum<br />u.p. Kepala Seksi Administrasi Manifes</p>
                    <p>Dengan ini kami mengajukan permohonan Pidah Lokasi Penimbunan barang import yang belum diselesaikan kewajiban pabeannya (PLP) sebagai berikut :</p>
                    <p>BC11 : {{$respon->NO_BC11}} &nbsp;&nbsp;&nbsp;&nbsp; TANGGAL : {{date('d-m-Y', strtotime($respon->TGL_BC11))}}</p>
                </td>
            </tr>
        </table>
    </div>
    <table border="1" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th>NO</th>
                <th>PETIKEMAS</th>
                <th>UKURAN</th>
                <th>JUMLAH</th>  
                <th>KEPUTUSAN PEJABAT BC</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;?>
            @foreach($details as $detail)
            <tr>
                <td style="width: 20px; height: 25px;" class="text-center">{{ $i }}</td>
                <td style="width: 100px;" class="text-center">{{ $detail->NO_CONT }}</td>
                <td style="width: 80px;" class="text-center">{{ $detail->UK_CONT }}</td>
                <td style="width: 100px;"></td>
                <td></td>
            </tr>
            <?php $i++;?>
            @endforeach         
        </tbody>
    </table>
    <table border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td colspan="3" style="font-size: 12px;">Demikian kami sampaikan untuk dapat dipertimbangkan.</td>
            </tr>
            <tr>
                <td class="text-center" style="padding-top: 20px;">&nbsp;</td>
                <td class="text-center" style="padding-top: 20px;"><b>Pemohon</b></td>
                <td class="text-center" style="padding-top: 20px;">&nbsp;</td>
            </tr>
            <tr>
                <td class="text-center" style="padding-top: 60px;">&nbsp;</td>
                <td class="text-center" style="padding-top: 60px;"><b>(..................................)</b></td>
                <td class="text-center" style="padding-top: 60px;">&nbsp;</td>
            </tr>
        </tbody>
    </table>
    <table border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td>
                    <p>Keputusan Pejabat Bea dan Cukai</p>
                    <p>
                        Nomor : {{ $respon->NO_PLP }}<br />
                        Tanggal : {{ date('d-M-Y', strtotime($respon->TGL_PLP)) }}
                    </p>
                    <p>
                        a/n. Kepala Kantor,<br />
                        Kepala Seksi Administrasi Manifest
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
    <table border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="3">Nip : ...............................</td>
            </tr>
            <tr>
                <td style="width: 45%;">
                    <table border="0" cellspacing="0" cellpadding="0" style="border: 2px solid;">
                        <tr>
                            <td colspan="2">Pengeluaran dari TPS Asal</td>
                        </tr>
                        <tr>
                            <td style="width: 50px;">Tanggal</td>
                            <td>:</td>
                        </tr>
                        <tr>
                            <td>Pukul</td>
                            <td>:</td>
                        </tr>
                        <tr>
                            <td colspan="2">Pejabat Bea dan Cukai</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                        </tr>
                        <tr>
                            <td>NIP</td>
                            <td>:</td>
                        </tr> 
                        <tr>
                            <td colspan="2">Tanda Tangan :</td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                    </table> 
                </td>
                <td>&nbsp;</td>
                <td style="width: 45%;">
                    <table border="0" cellspacing="0" cellpadding="0" style="border: 2px solid;">
                        <tr>
                            <td colspan="2">Pengeluaran ke TPS Tujuan</td>
                        </tr>
                        <tr>
                            <td style="width: 50px;">Tanggal</td>
                            <td>:</td>
                        </tr>
                        <tr>
                            <td>Pukul</td>
                            <td>:</td>
                        </tr>
                        <tr>
                            <td colspan="2">Pejabat Bea dan Cukai</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                        </tr>
                        <tr>
                            <td>NIP</td>
                            <td>:</td>
                        </tr> 
                        <tr>
                            <td colspan="2">Tanda Tangan :</td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                    </table> 
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <p>
                        <b>
                            <i>
                        Keterangan : <br />
                        1. Formulir ini dicetak secara otomatis oleh sistem komputer dan tidak memerlukan nama, cap dinas, tanda tangan pemohon dan pejabat.<br />
                        2. Daftar petikemas / kemasan yang dicetak hanya yang diberikan persetujuan PLP.
                            </i>
                        </b>                        
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
@stop