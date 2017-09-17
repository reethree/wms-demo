@extends('web-layout')

@section('content')

<!--banner Section starts Here -->
  <div class="banner spacetop">
    <div class="banner-image-plane parallax" style="background: url('{{ asset('assets/images/header/IMG_5497_resize.jpg') }}') no-repeat;background-attachment: fixed;background-size: cover;"> </div>
    <div class="banner-text">
      <div class="container">
        <div class="row">
<!--          <div class="col-xs-12"> <a href="#" class="shipping">ground shipping</a>
            <h1>warehousing</h1>
          </div>-->
        </div>
      </div>
    </div>
  </div>
  <!--banner Section ends Here --> 
  <!--Section area starts Here -->
  <section id="section"> 
    <!--Section box starts Here -->
    <div class="section  team-wrap  storage warehouse">
      <div class="team">
        <div class="container">
          <div class="row">
            <div class="col-md-9 col-sm-8 col-xs-12">
              <div class="heading">
                <h2 class="h3"> {{ $page->name }} </h2>
              </div>
                <table class="table table-bordered" style="color: #60707d;font-size: 14px;">
                    <tr>
                        <th style="width: 30%;">Nama Perusahaan</th>
                        <td align="center">:</td>
                        <td>PT. Primanata Jasa Persada</td>
                    </tr>
                    <tr>
                        <th>Alamat Perusahaan</th>
                        <td align="center">:</td>
                        <td>Jl. Enggano No. 40 E<br/>
                            Jakarta 14310 Indonesia<br/>
                            Telp. (021) 43932076/77<br/>
                            Fax. (021) 43932087<br/>
                        </td>
                    </tr>
                    <tr>
                        <th>Akte Notaris</th>
                        <td align="center">:</td>
                        <td>Afdal Gozali, SH<br/>
                            No. 168 tangal 8 April 1997<br/>
                            Fhifi Alfhian Ronie,S.H<br/>
                            No.32 tanggal 24 Feuari 2011
                        </td>
                    </tr>
                    <tr>
                        <th>NPWP</th>
                        <td align="center">:</td>
                        <td>01.804.713.4.042.000</td>
                    </tr>
                    <tr>
                        <th>Ijin Usaha / SIUP</th>
                        <td align="center">:</td>
                        <td>B.136/AL.003/KW.IX/97</td>
                    </tr>
                    <tr>
                        <th>Tanda Daftar Perusahaan</th>
                        <td align="center">:</td>
                        <td>09.01.1.63.21649</td>
                    </tr>
                    <tr>
                        <th>Penanggung Jawab & Pemilik Perusahaan</th>
                        <td align="center">:</td>
                        <td>H. Soekarno (Direktur Utama)</td>
                    </tr>
                </table>

            </div>
            
              @include('web.rightbar')
              
          </div>
        </div>
      </div>
    </div>
    
    <!--Section box ends Here --> 
  </section>

@endsection

@section('custom_css')

@endsection

@section('custom_js')

@endsection