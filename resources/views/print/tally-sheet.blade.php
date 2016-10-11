@extends('print')

@section('title')
    {{ 'Manifest Tally Sheet' }}
@stop

@section('content')
        
    <div id="details" class="clearfix">
        <div id="title">TALLY SHEET STRIPPING</div>
        <table border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td>
                    <table border="0" cellspacing="0" cellpadding="0" style="font-size: 12px;">
                        <tr>
                            <td>Consolidator</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ $container->NAMACONSOLIDATOR }}</td>
                        </tr>
                        <tr>
                            <td>No. Container</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ $container->NOCONTAINER }}/{{ $container->SIZE }}</td>
                        </tr>
                        <tr>
                            <td>Kondisi Container</td>
                            <td class="padding-10 text-center">:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>No. Segel</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ $container->NO_SEAL }}</td>
                        </tr>
                        <tr>
                            <td>No. MBL</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ $container->NOMBL }}</td>
                        </tr>
                    </table> 
                </td>
                <td>
                    <table border="0" cellspacing="0" cellpadding="0" style="font-size: 12px;">
                        <tr>
                            <td>No. Order</td>
                            <td class="padding-10 text-center">:</td>
                            <td>000384772</td>
                        </tr>
                        <tr>
                            <td>Tangal</td>
                            <td class="padding-10 text-center">:</td>
                            <td>10/1/2016</td>
                        </tr>
                        <tr>
                            <td>Kapal</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ $container->VESSEL }}</td>
                        </tr>
                        <tr>
                            <td>Voy</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ $container->VOY }}</td>
                        </tr>
                        <tr>
                            <td>Tgl.Tiba</td>
                            <td class="padding-10 text-center">:</td>
                            <td>{{ date("d/m/Y", strtotime($container->VESSEL)) }}</td>
                        </tr>
                    </table>
                </td>
            </tr>          
            
        </table>
    </div>
    <div class="clearfix"></div>
    <table border="1" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th>NO</th>
                <th>CONSIGNEE</th>
                <th>MARKING</th>
                <th>PCKGs</th>
                <th>TALLY</th>
                <th>TOTAL</th>
                <th>WEIGHT<br/>MEAS</th>
                <th>NO TALLY<br/>NO HBL</th>
                <th>KETERANGAN</th>
            </tr>
        </thead>
        <tbody>
            @foreach($manifests as $manifest)
            <tr>
                <td class="text-center">{{ $manifest->TMANIFEST_PK }}</td>
                <td>{{ $manifest->CONSIGNEE }}</td>
                <td>{{ $manifest->MARKING }}</td>
                <td class="text-center">{{ $manifest->QUANTITY.' '.$manifest->NAMAPACKING }}</td>
                <td></td>
                <td></td>
                <td>{{ $manifest->WEIGHT }}<br/>{{ $manifest->MEAS }}</td>
                <td>{{ $manifest->NOTALLY }}<br/>{{ $manifest->NOHBL }}</td>
                <td></td>
            </tr>
            @endforeach         
        </tbody>
    </table>
    <table border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td class="text-center">Kerani</td>
                <td class="text-center">Koordinator</td>
                <td class="text-center">Supervisor</td>
                <td>Konsolidator<br /><span>Jika ada</span></td>
            </tr>
            <tr>
                <td style="padding-top: 80px;"><hr /></td>
                <td style="padding-top: 80px;"><hr /></td>
                <td style="padding-top: 80px;"><hr /></td>
                <td style="padding-top: 80px;"><hr /></td>
            </tr>
        </tbody>
    </table>
    
@stop