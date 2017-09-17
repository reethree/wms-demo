@extends('web-layout')

@section('content')

<!--banner Section starts Here -->
  <div class="banner spacetop">
    <div class="banner-image-plane parallax" style="background: url('{{ asset('assets/images/header/IMG_5544_resize.jpg') }}') no-repeat;background-attachment: fixed;background-size: cover;"> </div>
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
              <div class="air-fright-img-part">
                  <p>
                        Manajemen perusahaan selalu berusaha agar PT. Primanata Jasa Persada berkembang menjadi perusahaan yang dapat dipercaya serta mampu menangani kegiatan jasa di pelabuhan mulai dari Bongkar Muat Kapal, Pergudangan, Penyelesaian Dokumen Barang dan Inland Transportation. 
                  </p>
                  <p>
                        Sebagai perusahaan yang memusatkan kegiatannya kepada pelayanan jasa pelabuhan maka prinsip pelayanan yang kami anut bagi kepuasan pengguna jasa adalah :
                  </p>
              </div>
              <div class="air-fright-cont-wrap">
                <ul class="air-fright-cont clearfix">
                  <li class="clearfix">
                    <div class="img-cont"> <img src="assets/svg/bullet-svg.svg" alt="" class="svg"/> </div>
                    <span class="member-profile">Keamanan </span> </li>
                  <li class="clearfix">
                    <div class="img-cont"> <img src="assets/svg/bullet-svg.svg" alt="" class="svg"/> </div>
                    <span class="member-profile">Kecepatan</span> </li>
                  <li class="clearfix">
                    <div class="img-cont"> <img src="assets/svg/bullet-svg.svg" alt="" class="svg"/> </div>
                    <span class="member-profile">ketepatan</span> </li>
                  <li class="clearfix">
                    <div class="img-cont"> <img src="assets/svg/bullet-svg.svg" alt="" class="svg"/> </div>
                    <span class="member-profile">Efisiensi</span> </li>
                </ul>
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