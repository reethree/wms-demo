<html>
    <head>
        <title>Email Report Gateout FCL - Primanata Jasa Persada</title>
        <style>
            body{
                background:#f2f2f2;
                font-size: 14px;
                font-family: 'Open Sans', sans-serif;
            }
            .container{
                width:100%;
                max-width: 800px;
                margin: 0 auto;
            }
            .content{
                background:#FFF;
                padding:20px;
            }
            th,td{
                font-size: 10px;
            }
        </style>
    </head>
    <body>
        
        <div class="container">
            
            <div class="content">
 
                <p>Kepada Yth.<br />Pihak Pelayaran (Shipping Line)</p>

                <p>Bersama Email ini kami lampirkan data Gate Out FCL Tanggal {{date('d F Y', strtotime($data->tgl_laporan))}}.</p><br />
                
                <p><strong>Nama Depo : Primanata Jasa Persada</strong></p>
                <table border="1" cellpadding="10" cellspacing="0" width="100%" id="emailBody">
                    <tr>
                        <th>No. Container</th>
                        <th>Size</th>
                        <th>Ex. Vessel</th>
                        <th>VOY</th>
                        <th>Port</th>
                        <th>Shipping Line</th>
                        <th>Consignee</th>
                        <th>ETA</th>
                        <th colspan="2">Gate IN</th>
                        <th colspan="2">Gate OUT</th>
                    </tr>
                    @foreach($containers as $container)
                    <tr>
                        <td>{{$container->NOCONTAINER}}</td>
                        <td>{{$container->SIZE}}</td>
                        <td>{{$container->VESSEL}}</td>
                        <td>{{$container->VOY}}</td>
                        <td>{{$container->KD_TPS_ASAL}}</td>
                        <td>{{$container->SHIPPINGLINE}}</td>
                        <td>{{$container->CONSIGNEE}}</td>
                        <td>{{date('d-m-y', strtotime($container->ETA))}}</td>
                        <td>{{date('d-m-y', strtotime($container->TGLMASUK))}}</td>
                        <td>{{$container->JAMMASUK}}</td>
                        <td>{{date('d-m-y', strtotime($container->TGLRELEASE))}}</td>
                        <td>{{$container->JAMRELEASE}}</td>
                    </tr>
                    @endforeach
                </table>
                <br /><br />
                <p>Salam hormat,</p>
                <img src="{{ asset('assets/images/primanata-logo.png') }}" alt="" style="width: 200px;" />
                <p>
                    <h3 style="margin: 0;">Team Primanata Jasa Persada</h3><br />
                    Jl. Enggano No. 40 E<br />
                    Tanjung Priok, Jakarta Utara<br />
                    Tlp : 021-43909873<br />
                    WA : 0821-10683570<br />
                </p>
            </div>
            
        </div>

    </body>
</html>