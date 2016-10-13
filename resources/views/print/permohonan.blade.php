@extends('print')

@section('content')

<div class="invoice">
    
    <div class="row">
        <div class="col-sm-6 invoice-col">
            Jakarta, {{ date('d M Y') }}<br /><br />
            NO.  {{ $info['no_surat'] }}<br /><br />
            Kepada Yth.<br />
            {{ $lokasisandar['JABATANPERMOHONAN'] }}<br />
            {{ $lokasisandar['PERUSAHAANPERMOHONAN'] }}<br /><br />
            {{ $lokasisandar['PELABUHANPERMOHONAN'] }}<br />
            {{ $lokasisandar['KOTAPERMOHONAN'] }}<br />
            {{ $lokasisandar['NEGARAPERMOHONAN'] }}<br /><br/>
        </div>
        <div class="col-sm-12 invoice-col">
            <b>Perihal: {{ $info['prihal_surat'] }}</b><br/><br/>
        </div>
        <div class="col-sm-12 invoice-col">
            Dengan hormat, <br/>
            <p>Sehubungan dengan kedatangan barang import mitra kami, maka kami memohon agar kiranya dapat melaksanakan Over Brengen (OB) ke Gudang PRIMANATA JASA PERSADA</p>
            <p>Adapun data-datanya adalah sebagai berikut:</p>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-8 table-responsive">
            <table class="table" style="font-size: 14px;">
                <tbody>
                    <tr>
                        <td>NO. B/L</td>
                        <td> : </td>
                        <td>{{ $container['NOMBL'] }}</td>
                    </tr>
                    <tr>
                        <td>Vessel</td>
                        <td> : </td>
                        <td>{{ $container['VESSEL'] }}</td>
                    </tr>
                    <tr>
                        <td>ETA</td>
                        <td> : </td>
                        <td>{{ date("d-m-Y", strtotime($container['ETA'])) }}</td>
                    </tr>
                    <tr>
                        <td>Party</td>
                        <td> : </td>
                        <td>{{ "1x".$container['SIZE'] }}</td>
                    </tr>
                    <tr>
                        <td>NO. Container</td>
                        <td> : </td>
                        <td>{{ $container['NOCONTAINER'] }}</td>
                    </tr>
                    <tr>
                        <td>Pkgs/Brutto</td>
                        <td> : </td>
                        <td>{{ $container['WEIGHT'].' Pkgs' }} / {{ $container['MEAS'].' Brutto' }}</td>
                    </tr>
                    <tr>
                        <td>NO./TGL BC11</td>
                        <td> : </td>
                        <td>{{ $container['NO_BC11'].' / '.date("d-M-Y", strtotime($container['TGL_BC11'])) }}</td>
                    </tr>
                    <tr>
                        <td>PSM</td>
                        <td> : </td>
                        <td>{{ $container['NAMACONSOLIDATOR'] }}</td>
                    </tr>
                    <tr>
                        <td>SOR</td>
                        <td> : </td>
                        <td>{{ $info['sor'] }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-12 invoice-col">
            <p>Demikian surat permohonan kami ini. atas perhatian dan kerjasamanya kami ucapkan terima kasih.</p>
            <p>Segala biaya / resiko yang timbul menjadi beban pemohon.</p><br />
        </div>
        <div class="col-sm-12 invoice-col" style="margin-bottom: 50px;">
            Hormat Kami,<br />
            PT. Primanata Jasa Persada
        </div>
        <div class="col-sm-12 invoice-col">
            {{ $info['penandatangan'] }}<br />
            {{ $info['jabatan'] }}
        </div>
    </div>
    
</div>
        
@stop