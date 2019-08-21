@extends('print')

@section('title')
    {{ 'View Photo B/L in Container '.$manifests[0]->NOCONTAINER }}
@stop

@section('content')
<style>
.clearfix:after {
  content: "";
  display: table;
  clear: both;
}

.left {
    float: left;
}

.right {
    float: right;
}

.text-right {
    text-align: right;
}

.text-center {
    text-align: center;
}

.text-left {
    text-align: left;
}

a {
  color: #0087C3;
  text-decoration: none;
}

body {
  position: relative;
  width: 100%;  
  height: 100%; 
  margin: 0 auto; 
  color: #555555;
  background: #FFFFFF; 
  font-family: Arial, sans-serif; 
  font-size: 14px; 
}

#invoice .date {
  font-size: 1.1em;
  color: #777777;
}

table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
  font-size: 12px;
  border-color: #000;
}

table th,
table td {
  padding: 2px 0;
/*  background: #EEEEEE;*/
  /*text-align: center;*/
  /*border-bottom: 1px solid #FFFFFF;*/
}
table.table td {
    border-bottom: 1px solid #000;
}
table th {
  white-space: nowrap;        
  font-weight: normal;
  padding: 5px;
    border-bottom: 1px solid;
    font-weight: bold;
}

table td {
  text-align: left;
  padding: 3px;
}

table.grid td {
    border-right: 1px solid;
}

table td.padding-10 {
    padding: 0 10px;
}

table td h3{
  color: #57B223;
  font-size: 1.2em;
  font-weight: normal;
  margin: 0 0 0.2em 0;
}

table .no {
  color: #FFFFFF;
  font-size: 1.6em;
  background: #57B223;
}

table .desc {
  text-align: left;
}

table .unit {
  background: #DDDDDD;
}

table .qty {
}

table .total {
  background: #57B223;
  color: #FFFFFF;
}

table td.unit,
table td.qty,
table td.total {
  font-size: 1.2em;
}

table tbody tr:last-child td {
  border-bottom: none;
}

table tfoot td {
  padding: 10px 20px;
  background: #FFFFFF;
  border-bottom: none;
  font-size: 1.2em;
  white-space: nowrap; 
  border-top: 1px solid #000; 
}

table tfoot tr:first-child td {
  border-top: none; 
}

table tfoot tr:last-child td {
  color: #57B223;
  font-size: 1.4em;
  border-top: 1px solid #000; 

}

table tfoot tr td:first-child {
  border: none;
}

</style>
<div id="details" class="clearfix" style="padding: 20px;">
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped" border="1" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th width="25%"><b>NO. B/L</b></th>
                        <th><b>PHOTO</b></th>
                    </tr>
                </thead>
                <tbody>                
                    @foreach($manifests as $manifest)
                    <?php
                        $photos = json_decode($manifest->photo_stripping)
                    ?>
                    <tr>
                        <td>{{ $manifest->NOHBL }}</td>
                        <td>
                            @if(is_array($photos))
                                @foreach($photos as $photo)
                                    <img src="{{url("uploads/photos/manifest/".$photo)}}" style="width: 150px;padding:5px;" />
                                @endforeach
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
<div id="details" class="clearfix">
@stop
