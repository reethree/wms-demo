@extends('print')

@section('title')
    Barcode Report
@stop

@section('content')
    <div id="details" class="clearfix">
        <table border="1" cellspacing="0" cellpadding="0" style="font-size: 12px;">
            <tr>
                <th>No</th>
                <th>Gate Pass</th>
                <th>Dok</th>
                <th>No. SPPB</th>
                <th>Tgl. SPPB</th>
                <th>Perusahaan</th>
                <th>NPWP</th>
                <th>No. Container</th>
                <th>TPS Asal</th>
                <th>Masuk</th>
                <th>Keluar</th>
                <th>Jenis</th>
                <th>Action</th>
                <th>Status</th>
            </tr>
            <?php $i=1; ?>
            @foreach($barcode as $bc)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$bc->barcode}}</td>
                    <td>{{$bc->doc}}</td>
                    <td>{{$bc->no_sppb}}</td>
                    <td>{{$bc->tgl_sppb}}</td>
                    <td>{{$bc->company}}</td>
                    <td>{{$bc->npwp}}</td>
                    <td>{{$bc->ref_number}}</td>
                    <td>{{$bc->tps_asal}}</td>
                    <td>{{$bc->time_in}}</td>
                    <td>{{$bc->time_out}}</td>
                    <td>{{$bc->ref_type}}</td>
                    <td>{{$bc->ref_action}}</td>
                    <td>{{$bc->status}}</td>
                </tr>
                <?php $i++; ?>
            @endforeach
        </table>
    </div>
@stop