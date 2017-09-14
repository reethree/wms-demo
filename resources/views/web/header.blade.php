<header id="header" class="header">
    <!-- primary header Start Here -->
    <div class="primary-header">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <div class="mail">
                        <img src="{{ asset('assets/images/icon-mail.png') }}" alt="" />
                        <span>Email us at : <a class="email-us" href="mailto:info@prjp.co.id">info@prjp.co.id</a></span>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="social-wrap clearfix">
                        <a href="#" class="request">track & trace</a>
                        <ul class="social">
                            <li>
                                <a href="#"> <i class="fa fa-facebook"></i> </a>
                            </li>
                            <li>
                                <a href="#"> <i class="fa fa-twitter"></i> </a>
                            </li>
                            <li>
                                <a href="#"> <i class="fa fa-google-plus"></i> </a>
                            </li>
                            <li>
                                <a href="#"> <i class="fa fa-instagram"></i> </a>
                            </li>
                            <li>
                                <a href="#"> <i class="fa fa-youtube-play"></i> </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- primary header Ends Here -->
    <!-- main header Starts Here -->
    <div class="main-header">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 hidden-xs">

                    <div class="call-us">
                        <ul>
                            <li>
                                <img src="{{ asset('assets/images/iphone.png') }}" alt="" />
                                <span class="transport">CALL US NOW FOR <span></span> MORE INFORMATION</span>
                            </li>
                            <li>
                                <a href="tel:+622143909892">+6221 4393 2077</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-3">
                    <a href="{{ route('web-index') }}" class="logo"> <img src="{{ asset('assets/images/primanata-logo.png') }}" alt="" /> </a>

                </div>
                <div class="col-xs-12 col-sm-9 custom-nav">
                    <nav>
                        <div id='cssmenu'>
                            <ul class="navigation">
                                <li class='active'>
                                    <a href='{{ route('web-index') }}'>Home</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">About us</a>
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="{{ route('web-pages', 'our-history') }}">Our History</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('web-pages', 'our-value')}}">Our Value</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('web-pages', 'our-legal') }}">Our Legal</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">Our services</a>
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="{{ route('web-warehouse-management') }}">Warehouse Management</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('web-multimodal') }}">Multimodal Transportation</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('web-track-trace') }}">Track & Trace</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">Business</a>

                                    <ul class="sub-menu">
                                        <li>
                                            <a href="{{ route('web-operasional-gudang') }}">Operasionalisasi Gudang</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('web-operasional-lapangan') }}">Operasionalisasi Lapangan</a>
                                        </li>
                                    </ul>

                                </li>
                                <li>
                                    <a href="javascript:void(0);">Facilities</a>
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="{{ route('web-fasilitas-gudang') }}">Gudang</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('web-fasilitas-lapangan') }}">Lapangan</a>
                                        </li>
                                    </ul>
                                </li>
                                
                                <li>
                                    <a href="{{ route('web-contact-us') }}">Contact Us</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <div class="nav-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- main header Ends Here -->
</header>