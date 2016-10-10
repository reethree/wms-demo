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
                <td>LCL03716/16.008</td>
            </tr>
            <tr>
                <td>No. Order</td>
                <td class="padding-10 text-center">:</td>
                <td>LCL03716/16/td>
            </tr>
            <tr>
                <td>No. HBL </td>
                <td class="padding-10 text-center">:</td>
                <td>SMRTE16080072</td>
            </tr>
            <tr>
                <td>Consolidator</td>
                <td class="padding-10 text-center">:</td>
                <td>PT.Logistic Solution Indonesia</td>
            </tr>
            <tr>
                <td>Consignee</td>
                <td class="padding-10 text-center">:</td>
                <td>PT. MRO INDONESIA</td>
            </tr>
            <tr>
                <td>Lokasi Gudang</td>
                <td class="padding-10 text-center">:</td>
                <td>GUDANG 1</td>
            </tr>
            <tr>
                <td>No. RAK</td>
                <td class="padding-10 text-center">:</td>
                <td>-</td>
            </tr>
            <tr>
                <td>No. SPJM</td>
                <td class="padding-10 text-center">:</td>
                <td>408523 / 30-9-2016</td>
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
                    <td>27/Carton</td>
                    <td>1,006.75</td>
                    <td>2.63</td>
                    <td>CARTONS NO. 1-27</td>
                    <td>SAID TO CONTAIN 27 CARTONS OF STEP LIGHTING</td>
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