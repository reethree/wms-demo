<div>
{{ $barcode['id'] }}
{{ $barcode['type'] }}
</div>
<div>
{!!QrCode::margin(0)->size(150)->generate('My First QR code')!!}
</div>