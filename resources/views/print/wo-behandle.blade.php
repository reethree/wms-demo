@extends('print')

@section('title')
    {{ 'Woriking Order Behandle' }}
@stop

@section('content')
    
    <div id="details" class="clearfix">
        <div id="title">WORKING ORDER<br /><span style="font-size: 12px;">Custom Inspection / Behandle</span></div>
        
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
                <td>No. HBL </td>
                <td class="padding-10 text-center">:</td>
                <td>{{ $manifest->NOHBL }}</td>
            </tr>
            <tr>
                <td>Consolidator</td>
                <td class="padding-10 text-center">:</td>
                <td>{{ $manifest->NAMACONSOLIDATOR }}</td>
            </tr>
            <tr>
                <td>Consignee</td>
                <td class="padding-10 text-center">:</td>
                <td>{{ $manifest->CONSIGNEE }}</td>
            </tr>
            <tr>
                <td>Lokasi Gudang</td>
                <td class="padding-10 text-center">:</td>
                <td>PNJP</td>
            </tr>
            <tr>
                <td>No. RAK</td>
                <td class="padding-10 text-center">:</td>
                <td>-</td>
            </tr>
            <tr>
                <td>No. SPJM</td>
                <td class="padding-10 text-center">:</td>
                <td>{{ $manifest->NO_SPJM }} / {{ $manifest->TGL_SPJM }}</td>
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
            <tr><td height="50" style="font-size: 50px;line-height: 0;">&nbsp;</td></tr>
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