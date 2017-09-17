@extends('web-layout')

@section('content')

<!--banner Section starts Here -->
  <div class="banner spacetop">
    <div class="banner-image-plane parallax" style="background: url('{{ asset('assets/images/header/IMG_5550_resize.jpg') }}') no-repeat;background-attachment: fixed;background-size: cover;"> </div>
<!--    <div class="banner-text">
      <div class="container">
        <div class="row">
          <div class="col-xs-12"> <a href="#" class="shipping">ground shipping</a>
            <h1>warehousing</h1>
          </div>
        </div>
      </div>-->
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
                      PT.Primanata Jasa Persada  mengoperasikan gudang dan lapangan di dalam area Pelabuhan Tanjung Priok dengan luas gudang 4..000 M2 dengan lapangan seluas 9.765 M2, digunakan untuk menangani distribusi barang dan sebagai tempat pemeriksaan fisik terpadu (TPFT) antara Bea Cukai dan Karantina. Lokasi merupakan elemen kunci dalam distribusi barang sehingga dengan keberadaan gudang kami di dalam pelabuhan, distribusi barang dari pelabuhan ke gudang consignee akan lebih mudah dan efisien.
                  </p>
                  <p>
                      Gudang kami telah dilengkapi dengan warehouse management system dan peralatan bongkar muat yang modern untuk menunjang kegiatan penumpukan dan distribusi barang yang lebih cepat & efisien sehingga diharapkan dapat berdampak pada penurunan biaya logistic dan pemenuhan kepuasan pelanggan.
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