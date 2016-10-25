@extends('print')

@section('title')
    {{ 'Woriking Order Fiat Muat' }}
@stop

@section('content')
    
    <div id="details" class="clearfix">
        <div id="title">WORKING ORDER<br /><span style="font-size: 12px;">Release Cargo</span></div>
        
        <table border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td style="vertical-align: top;">
                    <table border="0" cellspacing="0" cellpadding="0" style="font-size: 12px;">
                        <tr>
                            <td>No. Order</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ $container->NOJOBORDER }}</td>
                        </tr>
                        <tr>
                            <td>Consolidator</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ $container->NAMACONSOLIDATOR }}</td>
                        </tr>
                        <tr>
                            <td>No. Container</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ $container->NOCONTAINER }}</td>
                        </tr>
                        <tr>
                            <td>Consignee</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ $container->CONSIGNEE }}</td>
                        </tr>
                        <tr>
                            <td>Importir</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ $container->NAMA_IMP }}</td>
                        </tr>
                        <tr>
                            <td>No/Tgl. SPJM</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ $container->NO_SPJM }} / {{ date('d-m-y', strtotime($container->TGL_SPJM)) }}</td>
                        </tr>
                        <tr>
                            <td>No. Kuitansi</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ $container->NO_KUITANSI }} / {{ date('d-m-Y') }}</td>
                        </tr>
                        <tr>
                            <td>No/Tgl. MB/L</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ $container->NOMBL }} / {{ date('d-m-y', strtotime($container->TGLMBL)) }}</td>
                        </tr>
                        <tr>
                            <td>No/ Tgl. Bea Cukai</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ $container->NO_SPPB }} / {{ date('d-m-Y',strtotime($container->TGL_SPPB)) }}</td>
                        </tr>
                        <tr>
                            <td>Tgl. Behandle(*)</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ date('d-m-y', strtotime($container->TGLBEHANDLE)) }} {{ date('H:i:s', strtotime($container->JAMBEHANDLE)) }}</td>
                        </tr>
                        <tr>
                            <td>Activity</td>
                            <td class="padding-10 text-center">:</td>
                            <td>CY/DG</td>
                        </tr>
                    </table>
                </td>
                <td style="vertical-align: top;">
<!--                    <table border="0" cellspacing="0" cellpadding="0" style="font-weight: bold;">
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
                    </table>-->
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
                </td>
            </tr>
        </table>

        <table border="1" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th>No. Container</th>
                    <th>Size</th>
                    <th>Weight</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $container->NOCONTAINER }}</td>
                    <td class="text-center">{{ $container->SIZE }}</td>
                    <td class="text-center">{{ number_format($container->WEIGHT,4) }}</td>
                </tr>
            </tbody>
        </table>
        
        <table border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td colspan="50"></td>
            </tr>
        </table>
        
        <table border="0" cellspacing="0" cellpadding="0">
            <tr><td height="150" style="font-size: 150px;line-height: 0;">&nbsp;</td></tr>
            <tr>
                <td>CATATAN : DILARANG MEMBERIKAN / MENERIMA UANG TIP</td>
            </tr>
            <tr>
                <td>Jakarta, {{ date('d-m-Y H:i:s') }}</td>
            </tr>
        </table>
        
        <table border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td class="text-center">Petugas Jaga</td>
                <td class="text-center">Koordinator</td>
            </tr>
            <tr><td height="50" style="font-size: 50px;line-height: 0;">&nbsp;</td></tr>
            <tr>
                <td class="text-center">(..................)</td>
                <td class="text-center">(..................)</td>
            </tr>
        </table>
    </div>
         
@stop