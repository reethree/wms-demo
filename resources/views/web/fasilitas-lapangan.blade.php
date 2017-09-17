@extends('web-layout')

@section('content')

<!--banner Section starts Here -->
  <div class="banner spacetop">
    <div class="banner-image-plane parallax" style="background: url('{{ asset('assets/images/header/IMG_5526_resize.jpg') }}') no-repeat;background-attachment: fixed;background-size: cover;"> </div>
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
                <h2 class="h3"> {{ $page->title }} </h2>
              </div>
              <div class="air-fright-img-part">
                  <p>
                  <table class="table table-bordered" style="color: #60707d;font-size: 14px;">
                      <tr>
                          <td>Nama</td>
                          <td>:</td>
                          <td>Lapangan PT.Primanata Jasa Persada</td>
                      </tr>
                      <tr>
                          <td>Lokasi</td>
                          <td>:</td>
                          <td>Jl. Nusantara II Pelabuhan Tanjung Priok, Jakarta Utara</td>
                      </tr>
                      <tr>
                          <td>Luas</td>
                          <td>:</td>
                          <td>9.765 m2</td>
                      </tr>
                      <tr>
                          <td>Daya Tampung</td>
                          <td>:</td>
                          <td>1.456 Teus</td>
                      </tr>
                      <tr>
                          <td>Peralatan</td>
                          <td>:</td>
                          <td>
                              <ul style="padding-left: 15px;">
                                  <li>Alat-alat berat stacker untuk lift off dan lift on</li>
                                  <li>Forklift</li>
                                  <li>Peralatan/perlengkapan lain sesuai persyaratan TPS</li>
                              </ul>
                          </td>
                      </tr>
                      <tr>
                          <td>Penggunaan</td>
                          <td>:</td>
                          <td> 
                              <ul style="padding-left: 15px;">                              
                                  <li>Melayani container import FCL (overbrengen atau penitipan sementara sebelum siap uitslag)</li>
                                  <li>Sebagai Lapangan perpanjangan dermaga debarkasi, baik untuk penyimpanan < 10 hari atau > 10 hari setelah kedatangan</li>
                            </ul>
                          </td>
                      </tr>
                  </table>
                    
                  </p>
                  
              </div>
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