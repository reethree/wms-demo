@extends('print')

@section('title')
    {{ 'Izin Stripping' }}
@stop

@section('content')
    <style>
        body {font-size: 14px;}
        table, table tr, table tr td{
            font-size: 14px;
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
                <td style="text-align: right;">Jakarta, {{ date('d F Y', strtotime($tgl_surat)) }}</td>
            </tr>
            <tr><td colspan="2"></td></tr>
            <tr><td colspan="2"></td></tr>
            <tr>
                <td colspan="2">Kepada Yth.</td>
            </tr>
            <tr>
                <td>Kepala Hanggar Bea & Cukai<br />
                    Gudang PT. PRIMANATA JASA PERSADA<br />
                    Tanjung Priok
                </td>
            </tr>
        </table>
    </div>
    <p><b><i>Perihal : Permohonan Stripping Cargo LCL di Gudang Primanata</i></b></p>
    <br />
    <p>Dengan Hormat,</p>
    <p>Dengan ini kami mengajukan permohonan kepada Bapak / Ibu agar dapat diberikan ijin untuk melaksanakan stripping cargo LCL di gudang Primanata, adapun data-datanya sebagai berikut :</p>

    <table class="table">
        <tbody>
        <tr>
            <td style="width: 150px;">No. Container</td>
            <td style="width: 5px;"> : </td>
            <td>
                <?php $co = array(); ?>
                @foreach($containers as $cont)
                    <?php $co[] = $cont['NOCONTAINER'].' / '.$cont['SIZE']; ?>
                @endforeach
                {{ implode(' - ', $co) }}
            </td>
        </tr>
        <tr>
            <td>No. Seal</td>
            <td> : </td>
            <td>
                <?php $seal = array(); ?>
                @foreach($containers as $cont)
                    <?php $seal[] = $cont['NO_SEAL']; ?>
                @endforeach
                {{ implode(' - ', $seal) }}
            </td>
        </tr>
        <tr>
            <td>Ex Kapal / Voy</td>
            <td> : </td>
            <td>{{ $reg['VESSEL'] }} VOY. {{ $reg['VOY'] }}</td>
        </tr>

        <tr>
            <td>Tanggal Tiba</td>
            <td> : </td>
            <td>{{ date("d F Y", strtotime($reg['ETA'])) }}</td>
        </tr>
        <tr>
            <td>Master B/L</td>
            <td> : </td>
            <td>{{ $reg->NOMBL }}</td>
        </tr>
        <tr>
            <td>Jumlah House B/L</td>
            <td> : </td>
            <td>{{ $sum_bl }} POS</td>
        </tr>
        <tr>
            <td style="width: 150px;">Customer</td>
            <td style="width: 5px;"> : </td>
            <td>{{ $reg->NAMACONSOLIDATOR }}</td>
        </tr>
        </tbody>
    </table>

    <p>Demikian permohonan ini Kami sampaikan, atas perhatian dan kerjasamanya yang baik kami ucapkan banyak terima kasih.</p>
    <br />
    <table>
        <tr>
            <td>
                <div style="margin-bottom: 100px;">
                    Hormat Kami,<br />
                    Supervisor Gudang dan Lapangan
                </div>
                <div>
                    <span>H A P N I</span>
                </div>
            </td>
            <td style="text-align: center;">
                <div style="margin-bottom: 100px;">
                    Bea dan Cukai<br />
                    Supervisor / Petugas
                </div>
                <div>
                    <span>.............................</span>
                </div>
            </td>
        </tr>
    </table>

@stop