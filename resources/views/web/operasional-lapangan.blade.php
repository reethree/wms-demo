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
                  Penggunaan jasa dapat mengurus sendiri overbrengen CY atau menyerahkan pengurusannya kepada kami, pengguna cukup mengurus delivery atas containernya. PT. Primanata Jasa Persada bertanggung jawab atas barang-barang selama dalam penyimpanan. Dalam hal-hal tertentu, terbuka kemungkinan pengguna menyewa untuk kurun waktu tertentu
                  </p>
                  <p>
Dalam hal-hal tertentu, terbuka kemungkinan pengguna menyewa untuk kurun waktu tertentu.
</p>

<h5>Freight Forwader</h5>
<p>
Melayani segala bentuk jasa ekspedisi muat kapal laut, baik barang-barang import/export maupun interinsuler, serta document clearance lainnya.
</p>

<h5>Bongkar Muat Barang / Cargo</h5>
<p>
Melayani jasa bongkar muat khususnya barang-barang cargo ex. Import (beras, gula, kedelai, pupuk dan lain-lain) sampai dengan pengantarannya ke gudang penyimpanan.    
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