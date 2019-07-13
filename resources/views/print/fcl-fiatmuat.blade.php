@extends('print')

@section('title')
    {{ 'Woriking Order Fiat Muat' }}
@stop

@section('content')
    <style>
        @media print {
            body {
                background: #FFF;
                font-weight: bold;
                color: #000;
            }
            table {
                font-weight: bold;
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
        <table style="font-size:14px;" width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td width="20%">
                    <img src="{{ url('assets/images/logo/logo.png') }}" alt="PT. Primanata Jasa Persada" width="100px" />
                </td>
                <td width="80%" valign="top">
                    <h1>PT. PRIMANATA JASA PERSADA</h1>
                    <p>
                        Jl. Enggano No. 40E Jakarta 14310 – Indonesia<br />
                        Telp.: (021) 43909872, 43932077. Fax.: (021) 43932087<br />
                        Email: primanatajp@yahoo.co.id<br />
                    </p>
                </td>
            </tr>
        </table>
        <hr style="border-color: #000;" />
        <hr /><br />
        
        <div id="title">WORKING ORDER<br /></div>
        
        <table border="0" cellspacing="0" cellpadding="0" width="100%">
            <tr>
                <td style="vertical-align: top;">
                    <table border="0" cellspacing="0" cellpadding="0" style="font-size: 14px;">
                        <tr>
                            <td width="20%">NO. SPPB</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ $container->NO_SPPB }}</td>
                        </tr>
                        <tr>
                            <td>TGL. SPPB</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ date('d-m-Y',strtotime($container->TGL_SPPB)) }}</td>
                        </tr>
                        <tr>
                            <td>JENIS DOKUMEN</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ $container->KODE_DOKUMEN }}</td>
                        </tr>
                        <tr>
                            <td>TPS ASAL</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ $container->KD_TPS_ASAL }}</td>
                        </tr>
                        <tr>
                            <td>NO. PLP</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ $container->NO_PLP }}</td>
                        </tr>
                        <tr>
                            <td>TGL. PLP</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ date('d-m-Y',strtotime($container->TGL_PLP)) }}</td>
                        </tr>
                        <tr>
                            <td>NO. BC11</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ $container->NO_BC11 }}</td>
                        </tr>
                        <tr>
                            <td>TGL. BC11</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ date('d-m-Y',strtotime($container->TGL_BC11)) }}</td>
                        </tr>
                        <tr>
                            <td>NO. B/L AWB</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ $container->NO_BL_AWB }}</td>
                        </tr>
                        <tr>
                            <td>CONSIGNEE</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ $container->CONSIGNEE }}</td>
                        </tr>
                        <tr>
                            <td>TGL. GATE IN TPS</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ date('d-m-Y',strtotime($container->TGLMASUK)) }}</td>
                        </tr>
                        <tr>
                            <td>JAM GATE IN TPS</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ date('H:i:s',strtotime($container->JAMMASUK)) }}</td>
                        </tr>
                        <tr>
                            <td>NO. POL MOBIL</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ $container->NOPOL_OUT }}</td>
                        </tr>
                    </table>
                </td>
<!--                <td style="vertical-align: top;">
                    <table border="0" cellspacing="0" cellpadding="0" style="font-weight: bold;">
                        <tr>
                            <td>NO.URUT</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ str_pad(intval($container->TMANIFEST_PK), 4, '0', STR_PAD_LEFT) }}</td>
                        </tr>
                        <tr>
                            <td>NO.TRUCK</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ $container->NOPOL }}</td>
                        </tr>
                        <tr>
                            <td>LOKASI GUDANG</td>
                            <td class="padding-10 text-center">:</td>
                            <td>PNJP</td>
                        </tr>
                    </table>
                    <table border="1" cellspacing="0" cellpadding="0">                       
                        <tr>
                            <td class="text-center" style="font-size: 14px;font-weight: bold;">Time Release Jam</td>
                        </tr>
                        <tr>
                            <td>
                                <table border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td>Adm</td>
                                        <td>:</td>
                                        <td>......................</td>
                                    </tr>
                                    <tr>
                                        <td>Security</td>
                                        <td>:</td>
                                        <td>......................</td>
                                    </tr>
                                    <tr>
                                        <td>Krani Release</td>
                                        <td>:</td>
                                        <td>......................</td>
                                    </tr>
                                    <tr>
                                        <td>Start Idle</td>
                                        <td>:</td>
                                        <td>......................</td>
                                    </tr>
                                    <tr>
                                        <td>Finish Idle</td>
                                        <td>:</td>
                                        <td>......................</td>
                                    </tr>
                                    <tr>
                                        <td>Adm SJ</td>
                                        <td>:</td>
                                        <td>......................</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>EMKL</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>(...............)</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>SPPB / BC 2.3 :</td>
                        </tr>
                        <tr>
                            <td style="padding-bottom: 20px;">Note :</td>
                        </tr>
                    </table>
                </td>-->
            </tr>
        </table>

        <table border="1" cellspacing="0" cellpadding="0" width="100%" style="font-size: 14px;">
            <thead>
                <tr>
                    <td><b>NO. CONTAINER</b></td>
                    <td width="20%" style="text-align:center;"><b>SIZE</b></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td height="50">{{ $container->NOCONTAINER }}</td>
                    <td class="text-center">{{ $container->SIZE }}</td>
                </tr>
            </tbody>
        </table>
        
        <table border="0" cellspacing="0" cellpadding="0" style="font-size: 10px;">
            <tr><td height="20">&nbsp;</td></tr>
            <tr>
                <td>
                    CATATAN :
                    <ul>
                        <li>DILARANG MEMBERIKAN/MENERIMA UANG TIP.</li>
                        <li>PETUGAS LAPANGAN PRIMANATA HARUS MENGECEK FISIK CONTAINER YANG AKAN MUAT SESUAI DENGAN DOKUMEN WORKING ORDER.</li>
                        <li>PEMILIK BARANG HARUS MENGECEK FISIK CONTAINER YANG AKAN MUAT SESUAI DENGAN DOKUMEN WORKING ORDER.</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td>Jakarta, {{ date('d F Y') }}</td>
            </tr>
        </table>
        
        <table border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td>PETUGAS LAPANGAN TPS</td>
                <td class="text-center">PEMILIK BARANG</td>
                <td class="text-center">PETUGAS SP2</td>
            </tr>
            <tr><td height="100" style="font-size: 100px;line-height: 0;">&nbsp;</td></tr>
            <tr>
                <td>(..................)</td>
                <td class="text-center">(..................)</td>
                <td class="text-center">(..................)</td>
            </tr>
        </table>
    </div>
         
@stop