@extends('web-layout')

@section('content')

<div class="bannercontainer spacetop">
    <div class="banner">
        <ul>
            <!-- THE BOXSLIDE EFFECT EXAMPLES  WITH LINK ON THE MAIN SLIDE EXAMPLE -->

            <li data-transition="random" data-slotamount="1">
                <img src="{{ asset('assets/images/slider/slider1.jpg') }}" alt="" />
<!--                <div class="banner-text">
                    <div class="caption sft big_white" data-x="0" data-y="100" data-speed="center" data-start="1700" data-easing="Power4.easeInOut">
                        <a href="#" class="shipping">ground shipping</a>
                    </div>
                    <div class="caption sfb big_orange clearfix"  data-x="100" data-y="350" data-speed="500" data-start="1900" data-easing="Power4.easeInOut">
                        <h2>ONE STOP SOLUTION
                        YOUR TRANSPORT
                        REQUIREMENTS</h2>
                    </div>
                    <div class="caption lfr medium_grey"  data-x="left" data-y="center" data-speed="300" data-start="2000">
                        <a href="#" class="services-link">our services</a>
                    </div>
                </div>-->
            </li>
            <li data-transition="random" data-slotamount="1">
                <img src="{{ asset('assets/images/slider/slider2.jpg') }}" alt="" />
<!--                <div class="banner-text">
                    <div class="caption sft big_white" data-x="0" data-y="100" data-speed="700" data-start="1700" data-easing="Power4.easeInOut">
                        <a href="#" class="shipping">ground shipping</a>
                    </div>
                    <div class="caption sfb big_orange clearfix"  data-x="100" data-y="350" data-speed="500" data-start="1900" data-easing="Power4.easeInOut">
                        <h2>ONE STOP SOLUTION
                        YOUR TRANSPORT
                        REQUIREMENTS</h2>
                    </div>
                    <div class="caption lfr medium_grey" data-x="left" data-y="center" data-speed="300" data-start="2000">
                        <a href="#" class="services-link">our services</a>
                    </div>
                </div>-->
            </li>
            <li data-transition="random" data-slotamount="1">
                <img src="{{ asset('assets/images/slider/slider3.jpg') }}" alt="" />
<!--                <div class="banner-text">
                    <div class="caption sft big_white" data-x="0" data-y="100" data-speed="700" data-start="1700" data-easing="Power4.easeInOut">
                        <a href="#" class="shipping">ground shipping</a>
                    </div>
                    <div class="caption sfb big_orange clearfix"  data-x="100" data-y="350" data-speed="500" data-start="1900" data-easing="Power4.easeInOut">
                        <h2>ONE STOP SOLUTION
                        YOUR TRANSPORT
                        REQUIREMENTS</h2>
                    </div>
                    <div class="caption lfr medium_grey"  data-x="left" data-y="center" data-speed="300" data-start="2000">
                        <a href="#" class="services-link">our services</a>
                    </div>
                </div>-->
            </li>

        </ul>
    </div>
</div>

<div class="about-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 left-spacer">
                <div class="about-figure">
                    <figure class="fig-design">
                        <a href="#"> <img alt="" src="{{ asset('assets/images/train-5.jpg') }}"> </a>
                    </figure>
                </div>
            </div>
            <div class="col-sm-8 left-manage">
                <div class="about-blog">
                    <div class="heading">
                        <span>LITTLE ABOUT US</span>
                        <h3>ABOUT PRIMANATA JASA PERSADA, PT</h3>
                    </div>
                    <p style="font-size: 16px;color: #333;text-align: justify;">
                        <b>PT. Primanata Jasa Persada</b> memulai aktivitas usaha sejak September 1996 dengan nama PT. Primanata Jasa Sentosa. 
                        Kemudian karena sesuatu kebutuhan pengembangan usaha, maka sejak awal tahun 1997, tepatnya tanggal 08 April 1997 disamping sebagai perusahaan Ekspedisi Muatan Kapal Laut juga mengembangkan jasa-jasa lainnya dengan nama 
                        PT. Primanata Jasa Persada.
                    </p>
                    <a class="services-link button button-hover" href="#">read more</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="features">
    <div class="container">
        <div class="heading">
                <span>BUSSINES</span>
                <h3>WE OFFER QUICK &amp; POWERFUL SOLUTION FOR TRANSPORT</h3>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-4">
                <div class="features-tab" style="padding: 20px;text-align: center;background: #fff;">
                    <div class="tab-text" style="margin: 0; width: 100%;">
                        
                        <h3 class="counter-count" style="font-family: inherit;color: #010080;margin: 5px 0;">
                            987634
                        </h3>
                        <h5>KAPASITAS LAPANGAN</h5>
                    </div>
                </div>
                <div class="features-tab" style="padding: 20px;text-align: center;background: #fff;">
                    <div class="tab-text" style="margin: 0; width: 100%;">
                        
                        <h3 class="counter-count" style="font-family: inherit;color: #010080;margin: 5px 0;">
                            67
                        </h3>
                        <h5>FORKLIFT</h5>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4">
                <div class="features-tab" style="padding: 20px;text-align: center;background: #fff;">
                    <div class="tab-text" style="margin: 0; width: 100%;">
                        
                        <h3 class="counter-count" style="font-family: inherit;color: #010080;margin: 5px 0;">
                            12938
                        </h3>
                        <h5>KAPASITAS GUDANG</h5>
                    </div>
                </div>
                <div class="features-tab" style="padding: 20px;text-align: center;background: #fff;">
                    <div class="tab-text" style="margin: 0; width: 100%;">
                        
                        <h3 class="counter-count" style="font-family: inherit;color: #010080;margin: 5px 0;">
                            553
                        </h3>
                        <h5>FELECTRINIK SEAL</h5>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4">
                <div class="features-tab" style="padding: 20px;text-align: center;background: #fff;">
                    <div class="tab-text" style="margin: 0; width: 100%;">
                        
                        <h3 class="counter-count" style="font-family: inherit;color: #010080;margin: 5px 0;">
                            632
                        </h3>
                        <h5>REACH STECKER</h5>
                    </div>
                </div>
                <div class="features-tab" style="padding: 20px;text-align: center;background: #fff;">
                    <div class="tab-text" style="margin: 0; width: 100%;">
                        <!--<i class="fa fa-truck"></i>-->
                        
                        <h3 class="counter-count" style="font-family: inherit;color: #010080;margin: 5px 0;">
                            834
                        </h3>
                        <h5>TRUCKING</h5>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

<div class="features-section" style="background: #FFF;padding-bottom: 100px !important;">
    <div class="container">
        <div class="row">
            <div class="col-xs-6">
                <div class="heading">
                    <hr style="border: 1px solid #010080;margin-top: 8px;" />
                    <h5>VIDEO</h5>
                    <hr style="margin-top: 8px;" />
                </div>
                <iframe width="560" height="315" src="https://www.youtube.com/embed/MA4vAV5U4SA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="col-xs-6">
                <ul class="features-tabing clearfix">
                    <li class="active">
                        <div class="tab-wrap">
                            <!--<i class="icon-ship"></i>-->
                            <div class="heading">
                                    <h5>OPERASIONAL LAPANGAN</h5>
                            </div>
                        </div>
                        <div class="tab-content active-tab">
<!--                                                    <div class="heading">
                                        <h5>OPERASIONAL LAPANGAN</h5>
                                </div>-->
                                <p style="font-size: 16px;color: #333;text-align: justify;">
                                    <b>Penggunaan jasa</b> dapat mengurus sendiri overbrengen CY atau menyerahkan pengurusannya kepada kami, pengguna cukup mengurus delivery atas containernya. PT. Primanata Jasa Persada bertanggung jawab atas barang-barang selama dalam penyimpanan.
                                </p>
                                <a class="services-link" href="">read more</a>
                        </div>
                    </li>
                    <li class="">
                        <div class="tab-wrap">
                                <!--<i class="icon-plane"></i>-->
                                <div class="heading">
                                        <h5>OPERASIONAL GUDANG</h5>
                                </div>
                        </div>
                        <div class="tab-content active-tab">
<!--                                                    <div class="heading">
                                        <h5>OPERASIONAL GUDANG</h5>
                                </div>-->
                                <p style="font-size: 16px;color: #333;text-align: justify;">
                                    <b>Banyak bentuk kerjasama</b> penggunaan gudang/lapangan, namun pada prinsipnya, kerjasama dimaksud harus menguntungkan kedua pihak dengan memperhatikan suasana ekonomi Nasional pada umumnya maupun lalu lintas barang di Pelabuhan Tanjung Priok pada khususnya.
                                </p>
                                <a class="services-link" href="">read more</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!--<div class="features">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-4">
                <div class="features-text">
                    <div class="heading">
                        <span>AMAZING FEATURES</span>
                        <h3>WE OFFER QUICK &amp;
                        SMART SOLUTION
                        FOR YOUR LOGISTICS SERVICE</h3>
                    </div>

                    <p>
                    </p>
                    <a href="service.html" class="services-link button button-hover">our value</a>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4">
                <div class="features-tab">

                    <i class="icon-ship"></i>
                    <div class="tab-text">
                        <h5>PROSES OB FCL</h5>
                        <p>
                            Lorem ipsum dolor sit amet, cons
                            ctetur adipiscing elit. Aenean in
                            ante magna. Quisque
                        </p>
                    </div>
                </div>
                <div class="features-tab">
                    <i class="icon-plane"></i>
                    <div class="tab-text">
                        <h5>GROUND SHIPPING</h5>
                        <p>
                            Lorem ipsum dolor sit amet, cons
                            ctetur adipiscing elit. Aenean in
                            ante magna. Quisque
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4">
                <div class="features-tab">
                    <i class="icon-train"></i>
                    <div class="tab-text">
                        <h5>FAST AIR FREIGHT</h5>
                        <p>
                            Lorem ipsum dolor sit amet, cons
                            ctetur adipiscing elit. Aenean in
                            ante magna. Quisque
                        </p>
                    </div>
                </div>
                <div class="features-tab">
                    <i class="icon-clock"></i>
                    <div class="tab-text">
                        <h5>TIMELY DELIVERY</h5>
                        <p>
                            Lorem ipsum dolor sit amet, cons
                            ctetur adipiscing elit. Aenean in
                            ante magna. Quisque
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>-->

@endsection

@section('custom_css')

@endsection

@section('custom_js')

<!-- jQuery REVOLUTION Slider  -->
<script type="text/javascript" src="{{ asset('assets/js/jquery.themepunch.tools.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery.themepunch.revolution.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/revolution.js') }}"></script>

<script>
    
    $('.counter-count').each(function () {
        $(this).prop('Counter',0).animate({
            Counter: $(this).text()
        }, {
            duration: 5000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });
    
</script>

@endsection