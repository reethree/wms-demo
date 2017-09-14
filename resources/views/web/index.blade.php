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
                    <p>
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
        <div class="row">
            <div class="col-xs-12 col-sm-4">
                <div class="features-text">
                    <div class="heading">
                        <!--<span>AMAZING FEATURES</span>-->
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
</div>

@endsection

@section('custom_css')

@endsection

@section('custom_js')

<!-- jQuery REVOLUTION Slider  -->
<script type="text/javascript" src="{{ asset('assets/js/jquery.themepunch.tools.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery.themepunch.revolution.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/revolution.js') }}"></script>

@endsection