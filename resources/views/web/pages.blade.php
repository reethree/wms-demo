@extends('web-layout')

@section('content')

<!--banner Section starts Here -->
  <div class="banner spacetop">
    <div class="banner-image-plane parallax"> </div>
    <div class="banner-text">
      <div class="container">
        <div class="row">
          <div class="col-xs-12"> <a href="#" class="shipping">ground shipping</a>
            <h1>warehousing</h1>
          </div>
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
              <div class="heading"> <span>our</span>
                <h2 class="h3"> {{ $page->name }} </h2>
              </div>
              <div class="air-fright-img-part"> <img src="assets/images/shape-one.jpg" alt="" />
                <p> Etiam in mauris vestibulum ullamcorper sapien eget sodales feugiat etiam ut justo ut sem molestie viverraid act de pellentesque non tellus urna donec at dolor orci nulla et erat consequat porta tellus nec lacinia lacus vivamus  ultrices risus nu laoreet turpis non eleifend felis tortor quis diam praesent feugiat mi in metus tempor faucibus maecenas eget consectetur curabitur hendrerit ed fringill nsequat porta tellus nec lacinia lacus eget sodales feugiat enim justo. </p>
              </div>
              <div class="air-fright-cont-wrap">
                <h3 class="h5"> Benefits from </h3>
                <ul class="air-fright-cont clearfix">
                  <li class="clearfix">
                    <div class="img-cont"> <img src="assets/svg/bullet-svg.svg" alt="" class="svg"/> </div>
                    <span class="member-profile">Nam ac ligula sed tortor sodales act porta </span> </li>
                  <li class="clearfix">
                    <div class="img-cont"> <img src="assets/svg/bullet-svg.svg" alt="" class="svg"/> </div>
                    <span class="member-profile">Pellentesque interdum quam feugiat condimentum</span> </li>
                  <li class="clearfix">
                    <div class="img-cont"> <img src="assets/svg/bullet-svg.svg" alt="" class="svg"/> </div>
                    <span class="member-profile">Cras elit magna viverra dictum laoreet tincidunt</span> </li>
                  <li class="clearfix">
                    <div class="img-cont"> <img src="assets/svg/bullet-svg.svg" alt="" class="svg"/> </div>
                    <span class="member-profile">Integer lacinia malesuada justo sit amet vestibul orci</span> </li>
                </ul>
              </div>
              <div class="service-list-wrap">
                <h3 class="h5"> warehousing solutions </h3>
                <p> Praesent ullamcorper sapien eget sodales feugiat etiam ut justo ut sem molestie viverra id a massade pellentesque non tell donc urnadonec at dolor orci nulla et erat consequat porta tellus nec lacinia lacus vivamus placerat padictum nam luctus ac venenat mauris et luctus sem mauris et luctus sem lacinia et. </p>
                <p> Morbi lectus arcu sodales eget lacus nec laoreet ultricies arcu fusce vel tincidunt nisi pellentesque interdum quam libero feugiat dignissim mi id a massade turpis condimentum at pellent esque volutpat. </p>
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