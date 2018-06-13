@foreach($barcodes as $barcode)

<div style="text-align: center;margin: 0 auto;">
    <h2>GATE PASS</h2>
    <h4>TPS PRIMANATA JASA PERSADA</h4>
    {!!QrCode::margin(0)->size(150)->generate($barcode->barcode)!!}
    <p>{{$barcode->NOCONTAINER}}</p>
</div>
<div style="display:block; page-break-before:always;"></div>

@endforeach
