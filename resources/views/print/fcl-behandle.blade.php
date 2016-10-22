@extends('print')

@section('title')
    {{ 'Woriking Order Behandle' }}
@stop

@section('content')
    
    <div id="details" class="clearfix">
        <div id="title">WORKING ORDER<br /><span style="font-size: 12px;">Custom Inspection / Behandle</span></div>
        
        <table border="0" cellspacing="0" cellpadding="0" style="font-size: 12px;">
            <tr>
                <td>No. SPK</td>
                <td class="padding-10 text-center">:</td>
                <td>{{ $container->NoJob }}</td>
            </tr>
            <tr>
                <td>Consolidator</td>
                <td class="padding-10 text-center">:</td>
                <td>{{ $container->NAMACONSOLIDATOR }}</td>
            </tr>
            <tr>
                <td>Importir</td>
                <td class="padding-10 text-center">:</td>
                <td>{{ $container->NAMA_IMP }}</td>
            </tr>
            <tr>
                <td>No. SPJM</td>
                <td class="padding-10 text-center">:</td>
                <td>{{ $container->NO_SPJM }} / {{ $container->TGL_SPJM }}</td>
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
                <td class="text-center">(..................)</td>
                <td class="text-center">(..................)</td>
            </tr>
        </table>
    </div>
         
@stop