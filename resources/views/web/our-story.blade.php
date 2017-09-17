@extends('web-layout')

@section('content')

<!--banner Section starts Here -->
  <div class="banner spacetop">
      <div class="banner-image-plane parallax" style="background: url('{{ asset('assets/images/header/IMG_5489_resize.jpg') }}') no-repeat;background-attachment: fixed;background-size: cover;"> </div>
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
                        <b>PT. Primanata Jasa Persada</b> memulai aktivitas usaha sejak September 1996 dengan nama PT. Primanata Jasa Sentosa. Kemudian karena sesuatu kebutuhan pengembangan usaha, maka sejak awal tahun 1997, tepatnya tanggal 08 April 1997 disamping sebagai perusahaan Ekspedisi Muatan Kapal Laut juga mengembangkan jasa-jasa lainnya dengan nama    	PT. Primanata Jasa Persada.
                    </p>
                    <p>
                        PT. Primanata Jasa Persada berdiri karena di dorong oleh kenyataan bahwa peluang usaha di pelabuhan terutama di pelabuhan Tanjung Priok masih sangat terbuka karena Tanjung Priok sebagai gerbang utama ekonomi Nasional dimana Indonesia sendiri merupakan Negara Kepulauan.
                    </p>
                    <p>
                        Pada awalnya kegiatan PT. Primanata Jasa Persada di mulai dengan mengelola Depo Peti Kemas sebagai operator tunggal, kemudian berkembang dengan mengoperasikan gudang CFS milik sendiri. Dengan berjalannya waktu berkembang pula bidang usaha yang dijalankan dengan melaksanakan usaha Bongkar Muat Kapal dan perusahaan PPJK.
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