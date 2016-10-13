@extends('print')

@section('title')
    {{ 'Woriking Order Behandle' }}
@stop

@section('content')
    
    <div id="details" class="clearfix">
        <div id="title">WORKING ORDER<br /><span style="font-size: 12px;">Release Cargo</span></div>
        
        <table border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td style="vertical-align: top;">
                    <table border="0" cellspacing="0" cellpadding="0" style="font-size: 12px;">
                        <tr>
                            <td>No. WO</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ $manifest->NOTALLY }}</td>
                        </tr>
                        <tr>
                            <td>No. Order</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ $manifest->NOJOBORDER }}</td>
                        </tr>
                        <tr>
                            <td>Consolidator</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ $manifest->NAMACONSOLIDATOR }}</td>
                        </tr>
                        <tr>
                            <td>No. Container</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ $manifest->NOCONTAINER }}</td>
                        </tr>
                        <tr>
                            <td>No. HB/L</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ $manifest->NOHBL }}</td>
                        </tr>
                        <tr>
                            <td>Shipper</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ $manifest->SHIPPER }}</td>
                        </tr>
                        <tr>
                            <td>Consignee</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ $manifest->CONSIGNEE }}</td>
                        </tr>
                        <tr>
                            <td>Importir</td>
                            <td class="padding-10 text-center">:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>No. Bea / Cukai</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ $manifest->NO_SPPB }}</td>
                        </tr>
                        <tr>
                            <td>No. Kuitansi</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ $manifest->NO_KUITANSI }} / {{ date('d-m-Y') }}</td>
                        </tr>
                        <tr>
                            <td>No. RAK</td>
                            <td class="padding-10 text-center">:</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>No. POS</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ $manifest->NO_POS_BC11 }}</td>
                        </tr>
                        <tr>
                            <td>No. BC11 / Tgl. BC11</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ $manifest->NO_BC11 }} / {{ date('d-m-Y',strtotime($manifest->TGL_BC11)) }}</td>
                        </tr>
                    </table>
                </td>
                <td style="vertical-align: top;">
                    <table border="0" cellspacing="0" cellpadding="0" style="font-weight: bold;">
                        <tr>
                            <td>NO.URUT</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ str_pad(intval($manifest->TMANIFEST_PK), 4, '0', STR_PAD_LEFT) }}</td>
                        </tr>
                        <tr>
                            <td>NO.TRUCK</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ $manifest->NOPOL }}</td>
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
                </td>
            </tr>
        </table>

        <table border="1" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th>QUANTITY</th>
                    <th>TONANSE</th>
                    <th>CBM</th>
                    <th>MARKING</th>
                    <th>DESC OF GOOD</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $manifest->QUANTITY }}/{{ $manifest->NAMAPACKING }}</td>
                    <td>{{ number_format($manifest->WEIGHT,4) }}</td>
                    <td>{{ number_format($manifest->MEAS,4) }}</td>
                    <td>{{ $manifest->MARKING }}</td>
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
                <td class="text-center">(admin)</td>
                <td class="text-center">(..................)</td>
            </tr>
        </table>
    </div>
         
@stop