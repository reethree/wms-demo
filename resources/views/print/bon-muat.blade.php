@extends('print')

@section('title')
    {{ 'Bon Muat Buang MTY' }}
@stop

@section('content')
    
    <div id="details" class="clearfix">
        <div id="title">BON MUAT<br /><span style="font-size: 10px;">Ex-Stripping<br />(MTY Container)</span></div>
        
        <table border="0" cellspacing="0" cellpadding="0" style="font-size: 12px;">
            <tr>
                <td>TANGGAL</td>
                <td class="padding-10 text-center">:</td>
                <td>{{ date("d-m-Y", strtotime($container->TGLBUANGMTY)) }}</td>
            </tr>
            <tr>
                <td>JENIS KEGIATAN</td>
                <td class="padding-10 text-center">:</td>
                <td>Import Mty Container</td>
            </tr>
            <tr>
                <td>CONSOLIDATOR</td>
                <td class="padding-10 text-center">:</td>
                <td>{{ $container->NAMACONSOLIDATOR }}</td>
            </tr>
            <tr>
                <td>VESSEL / VOY</td>
                <td class="padding-10 text-center">:</td>
                <td>{{ $container->VESSEL }} / {{ $container->VOY }}</td>
            </tr>
            <tr>
                <td>NO CONTAINER</td>
                <td class="padding-10 text-center">:</td>
                <td>{{ $container->NOCONTAINER }}/{{ $container->SIZE }}</td>
            </tr>
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
        </table>
        
        <table border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td class="text-center">Operation</td>
                <td class="text-center">Petugas CS</td>
            </tr>
            <tr><td height="50" style="font-size: 50px;line-height: 0;">&nbsp;</td></tr>
            <tr>
                <td class="text-center">(admin)</td>
                <td class="text-center">(..................)</td>
            </tr>
        </table>
    </div>
        
@stop