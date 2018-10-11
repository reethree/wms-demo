@extends('layout')

@section('content')

<div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">View QR Code Data</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <div class="box-body"> 
        <div class="row">
            <div class="col-xs-12">
              <h2 class="page-header">
                {{strtoupper($barcode->ref_type).' - '.strtoupper($barcode->ref_action)}}
                <small class="pull-right">Expired Date: {{ date('d F, Y', strtotime($barcode->expired)) }}</small>
              </h2>
            </div>
            <!-- /.col -->
          </div>
        <div class="row invoice-info" style="margin: 20px 0;">
            <div class="col-sm-6 invoice-col">
                @if($barcode->ref_type == 'Manifest')
                    <table>
                        <tr>
                            <td><b>Code</b></td>
                            <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                            <td>{{ $barcode->barcode }}</td>
                        </tr>
                        <tr>
                            <td><b>Ex. Cont</b></td>
                            <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                            <td>{{ $barcode->NOCONTAINER }} / {{ $barcode->SIZE }}</td>
                        </tr>
                        <tr>
                            <td><b>Consignee</b></td>
                            <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                            <td>{{ $barcode->CONSIGNEE }}</td>
                        </tr>
                        <tr>
                            <td><b>Ex. Kapal</b></td>
                            <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                            <td>{{ $barcode->VESSEL }}</td>
                        </tr>
                        <tr>
                            <td><b>No. B/L / D/O</b></td>
                            <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                            <td>{{ $barcode->NOHBL }}</td>
                        </tr>
                        <tr>
                            <td><b>Party</b></td>
                            <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                            <td>{{ $barcode->WEIGHT }} KGS</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>{{ $barcode->MEAS }} CBM</td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td><b>Tgl. Masuk</b></td>
                            <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                            <td>{{ (isset($barcode->tglmasuk)) ? date('d F Y', strtotime($barcode->tglmasuk)) : date('d F Y', strtotime($barcode->TGLMASUK)) }}</td>
                        </tr>
                        <tr>
                            <td><b>Tgl. ETA</b></td>
                            <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                            <td>{{ date('d F Y', strtotime($barcode->ETA)) }}</td>
                        </tr>
                        <tr>
                            <td><b>Tgl. Keluar</b></td>
                            <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                            <td>{{ (isset($barcode->tglrelease)) ? date('d F Y', strtotime($barcode->tglrelease)) : date('d F Y', strtotime($barcode->TGLRELEASE)) }}</td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td><b>NO. POS BC11</b></td>
                            <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                            <td>{{$barcode->NO_POS_BC11}}</td>
                        </tr>
                        <tr>
                            <td><b>NO. BC11</b></td>
                            <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                            <td>{{$barcode->NO_BC11}}</td>
                        </tr>
                        <tr>
                            <td><b>TGL. BC11</b></td>
                            <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                            <td>{{date('d F Y', strtotime($barcode->TGL_BC11))}}</td>
                        </tr>
                    </table>
                @else
                    <table>
                        <tr>
                            <td><b>Code</b></td>
                            <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                            <td>{{ $barcode->barcode }}</td>
                        </tr>
                        <tr>
                            <td><b>Ex. Cont</b></td>
                            <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                            <td>{{ $barcode->NOCONTAINER }} / {{ $barcode->SIZE }}</td>
                        </tr>
                        <tr>
                            <td><b>Consolidator</b></td>
                            <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                            <td>{{ $barcode->NAMACONSOLIDATOR }}</td>
                        </tr>
                        <tr>
                            <td><b>Ex. Kapal</b></td>
                            <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                            <td>{{ $barcode->VESSEL }}</td>
                        </tr>
                        <tr>
                            <td><b>Voyage</b></td>
                            <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                            <td>{{ $barcode->VOY }}</td>
                        </tr>
                        <tr>
                            <td><b>Party</b></td>
                            <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                            <td>{{ $barcode->WEIGHT }} KGS</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>{{ $barcode->MEAS }} CBM</td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td><b>Tgl. Masuk</b></td>
                            <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                            <td>{{ (isset($barcode->tglmasuk)) ? date('d F Y', strtotime($barcode->tglmasuk)) : date('d F Y', strtotime($barcode->TGLMASUK)) }}</td>
                        </tr>
                        <tr>
                            <td><b>Tgl. ETA</b></td>
                            <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                            <td>{{ date('d F Y', strtotime($barcode->ETA)) }}</td>
                        </tr>
                        <tr>
                            <td><b>Tgl. Keluar</b></td>
                            <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                            <td>{{ (isset($barcode->tglrelease)) ? date('d F Y', strtotime($barcode->tglrelease)) : date('d F Y', strtotime($barcode->TGLRELEASE)) }}</td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td><b>TPS ASAL<b></td>
                            <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                            <td>{{$barcode->KD_TPS_ASAL}}</td>
                        </tr>
                        <tr>
                            <td><b>NO. PLP</b></td>
                            <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                            <td>{{$barcode->NO_PLP}}</td>
                        </tr>
                        <tr>
                            <td><b>TGL. PLP</b></td>
                            <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                            <td>{{date('d F Y', strtotime($barcode->TGL_PLP))}}</td>
                        </tr>
                    </table>
                    
                @endif
            </div>
            
            <div class="col-sm-6 invoice-col">
                <table>
                    <tr>
                        <td><b>QR</b></td>
                    </tr>
                    <tr>
                        <td>
                            {!!QrCode::margin(0)->size(100)->generate($barcode->barcode)!!}
                        </td>
                    </tr>
                    <tr>
                        <td><b>Photo IN</b></td>
                    </tr>
                    <tr>
                        <td>
                            @if($barcode->photo_in)
                            <img src="{{url("uploads/photos/autogate/".$barcode->photo_in)}}" width="400" />
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><b>Photo OUT</b></td>
                    </tr>
                    <tr>
                        <td>
                            @if($barcode->photo_out)
                            <img src="{{url("uploads/photos/autogate/".$barcode->photo_out)}}" width="400" />
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
            <!-- /.col -->
        </div>

    </div>
</div>

@endsection

@section('custom_css')


@endsection

@section('custom_js')

@endsection