@extends('web-layout')

@section('content')

<!--banner Section starts Here -->
  <div class="banner spacetop">
    <div class="banner-image-plane parallax" style="background: url('{{ asset('assets/images/header/IMG_5546_resize.jpg') }}') no-repeat;background-attachment: fixed;background-size: cover;"> </div>
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
                    Banyak bentuk kerjasama penggunaan gudang/ lapangan, namun pada prinsipnya, kerjasama dimaksud harus menguntungkan kedua pihak dengan memperhatikan suasana ekonomi Nasional pada umumnya maupun lalu lintas barang di Pelabuhan Tanjung Priok pada khususnya.
                  </p>
                  <p>
                    Bentuk kerjasama dapat dilakukan dengan pengelolaan gudang secara bersama dalam bentuk KSO, dimana ada pemilik dan pengguna gudang. Dalam hal ini PT. Primanata Jasa Persada adalah sebagai pemilik gudang yang menyediakan tempat/gudang dan melibatkan personalia dalam administrasi maupun pelayanan. Pengguna gudang yang berarti memasukkan komoditas barang sekaligus mengelola administrasi dan pelayanannya.
                  </p>
                  <p>
                    Gudang dapat dioperasikan sendiri secara mandiri oleh PT. Primanata Jasa Persada dengan pengguna cukup menyerahkan dokumen kepada kami yang pada saatnya pengguna/pemilik barang tinggal mengambil barang yang bersangkutan dari gudang tersebut.     
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