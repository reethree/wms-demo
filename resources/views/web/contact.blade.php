@extends('web-layout')

@section('content')
<!--banner Section starts Here -->
<div class="banner service-banner spacetop">
    <div class="banner-image-plane parallax"> </div>
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
              <div class="contact-form-box " ng-controller="FormController">
                <form ng-submit="submitForm()" name="contactForm" method="post"  novalidate id="contact">
                  <div ng-class="{'successMessage' : successsubmission}" ng-bind="successsubmissionMessage" id="success"></div>
                  <div class="row">
                    <input id="name" class="contact-name" type="text" placeholder="Name*" ng-model="formData.name" ng-class="{'error' : errorName}"/>
                    <input id="email" class="contact-mail" type="text" placeholder="Email*" ng-model="formData.email" ng-class="{'error' : errorEmail}"/>
                    <input id="sub" class="contact-subject" type="text" placeholder="Subject*" ng-class="{'error' : errorSubject}" ng-model="formData.subject"/>
                    <textarea placeholder="Comment*" id="message" ng-model="formData.message" ng-class="{'error' : errorTextarea}"></textarea>
                    <!--<input id="submit" class="comment-submit qoute-sub" type="button"  value="submit">-->
                    <button type="submit" class="comment-submit qoute-sub" ng-disabled="submitButtonDisabled">Submit</button>
                  </div>
                  <div ng-class="{'submissionMessage' : submission}" ng-bind="submissionMessage" style="float:right; color: red;"></div>
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
<script src="http://maps.google.com/maps/api/js?sensor=true"></script> 
<script type="text/javascript" src="assets/js/gmap.js"></script> 
@endsection