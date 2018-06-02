<div>
{{ $barcode['ref_id'] }}
{{ $barcode['ref_type'] }}
</div>
<div>
{!!QrCode::margin(0)->size(150)->generate($barcode['barcode'])!!}
</div>