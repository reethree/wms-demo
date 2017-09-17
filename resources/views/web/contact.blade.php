@extends('web-layout')

@section('content')
<!--banner Section starts Here -->
<div class="banner service-banner spacetop">
    <div class="banner-image-plane parallax" style="background: url('{{ asset('assets/images/header/IMG_5512_resize.jpg') }}') no-repeat;background-attachment: fixed;background-size: cover;"> </div>
    <div class="banner-text">
      <div class="container">
        <div class="row">
          <div class="col-xs-12"> 
              <!--<a href="#" class="shipping">ground shipping</a>-->
            <h1>contact us</h1>
          </div>
        </div>
      </div>
    </div>
</div>
<section id="section"> 
    <!--Section box starts Here -->
    <div class="section">
      <div class="contact-form">
        <div class="container">
          <div class="row">
            <div class="col-xs-12 col-sm-6">
              <div class="heading ">
                <h3>contact form</h3>
              </div>
              <div class="contact-form-box ">
                <form name="contactForm" method="post" id="contact" action="#">
                  <div class="row">
                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                        <input id="name" class="contact-name" name="name" type="text" placeholder="Name*" required="required" />
                        <input id="email" class="contact-mail" name="email" type="email" placeholder="Email*" required="required" />
                        <input id="phone" class="contact-phone" name="phone" type="tel" placeholder="Phone*" required="required" />
                        <textarea placeholder="Message*" name="message" id="message" required="required"></textarea>
                        <button type="submit" class="comment-submit qoute-sub">Submit</button>
                  </div>
                </form>
              </div>
            </div>
            <div class="col-xs-12 col-sm-6">
              <div class="map-box " id="map-box"></div>
            </div>
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHIkZ8AuBwhOt1M6kjIMNfFCCLjhickRM&sensor=true"></script> 
<script type="text/javascript" src="{{asset('assets/js/gmap.js')}}"></script> 
@endsection