<style>
.dropdown-submenu {
    position: relative;
}

.dropdown-submenu .dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: -1px;
}
</style>
<!-- Main Header -->
<header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="{{ route('index') }}" class="navbar-brand"><b>PRIMANATA</b></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
<!--            <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>-->
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Data <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ route('consolidator-index') }}">Consolidator</a></li>
                <li><a href="{{ route('depomty-index') }}">Depo MTY</a></li>
                <li><a href="{{ route('lokasisandar-index') }}">Lokasi Sandar</a></li>
                <li><a href="{{ route('negara-index') }}">Negara</a></li>
                <li><a href="{{ route('packing-index') }}">Packing</a></li>
                <li><a href="{{ route('pelabuhan-index') }}">Pelabuhan</a></li>
                <li><a href="{{ route('perusahaan-index') }}">Perusahaan</a></li>
                <li><a href="{{ route('tpp-index') }}">TPP</a></li>
                <li><a href="{{ route('shippingline-index') }}">Shipping Line</a></li>
                <li><a href="{{ route('eseal-index') }}">E-Seal</a></li>
                <li><a href="{{ route('vessel-index') }}">Vessel</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Import<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                  <li class="dropdown-submenu">
                    <a class="submenu" tabindex="-1" href="#">Import LCL <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a tabindex="-1" href="{{ route('lcl-register-index') }}">Register</a></li>
                      <li><a tabindex="-1" href="{{ route('lcl-manifest-index') }}">Manifest</a></li>
                      <li><a tabindex="-1" href="{{ route('lcl-dispatche-index') }}">Dispatche E-Seal</a></li>
                      <li class="dropdown-submenu">
                        <a class="submenu" href="#">Realisasi <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('lcl-realisasi-gatein-index') }}">Masuk / Gate In</a></li>
                            <li><a href="{{ route('lcl-realisasi-stripping-index') }}">Stripping</a></li>
                            <!--<li><a href="">Penomoran Tally Racking</a></li>-->
                            <!--<li><a href="">Realisasi Manifest Racking</a></li>-->
                            <li><a href="{{ route('lcl-realisasi-buangmty-index') }}">Buang MTY</a></li>
                            <!--<li><a href="">Update</a></li>-->
                        </ul>
                      </li>
                      <li class="dropdown-submenu">
                        <a class="submenu" href="#">Delivery <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('lcl-delivery-behandle-index') }}">Behandle</a></li>
<!--                            <li><a href="{{ route('lcl-delivery-fiatmuat-index') }}">Fiat Muat</a></li>
                            <li><a href="{{ route('lcl-delivery-suratjalan-index') }}">Surat Jalan</a></li>-->
                            <li><a href="{{ route('lcl-delivery-release-index') }}">Release / Gate Out</a></li>
                        </ul>
                      </li>
                      <li class="dropdown-submenu">
                        <a class="submenu" href="#">Report <span class="caret"></span></a>
                        <ul class="dropdown-menu"> 
                            <li><a href="{{ route('lcl-report-container') }}">Report Container</a></li>
                            <li><a href="{{ route('lcl-report-inout') }}">Report Stock</a></li>    
                            <li><a href="{{ route('lcl-report-longstay') }}">Inventory</a></li>
<!--                            <li><a href="{{ route('lcl-report-harian') }}">Rekap Delivery</a></li>
                            <li><a href="{{ route('lcl-report-rekap') }}">Rekap Import</a></li>
                            <li><a href="{{ route('lcl-report-stock') }}">Rekap Stock</a></li>-->
<!--                                <li>
                                    <a href="">Utilitas Gudang Harian</a>
                                </li>
                                <li>
                                    <a href="">Utilitas Gudang Bulanan</a>
                                </li>
                                <li>
                                    <a href="">Rekap Stock Cargo > 30 Hari</a>
                                </li>
                                <li>
                                    <a href="">Status Rack Cargo</a>
                                </li>
                                <li>
                                    <a href="">Monitoring Rack Tally Release</a>
                                </li>-->
                        </ul>
                      </li>
                    </ul>
                  </li>
                  <li class="dropdown-submenu">
                    <a class="submenu" tabindex="-1" href="#">Import FCL <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a tabindex="-1" href="{{ route('fcl-register-index') }}">Register</a></li>
                      <li><a tabindex="-1" href="{{ route('fcl-dispatche-index') }}">Dispatche E-Seal</a></li>
                      <!--<li><a tabindex="-1" href="#">Manifest</a></li>-->
                      <li class="dropdown-submenu">
                        <a class="submenu" href="#">Realisasi <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('fcl-realisasi-gatein-index') }}">Masuk / Gate In</a></li>
<!--                            <li><a href="">Realisasi Stripping</a></li>
                            <li><a href="">Penomoran Tally Racking</a></li>
                            <li><a href="">Realisasi Manifest Racking</a></li>
                            <li><a href="">Realisasi Buang MTY</a></li>
                            <li><a href="">Update</a></li>-->
                        </ul>
                      </li>
                      <li class="dropdown-submenu">
                        <a class="submenu" href="#">Delivery <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('fcl-delivery-behandle-index') }}">Behandle</a></li>
<!--                            <li><a href="{{ route('fcl-delivery-fiatmuat-index') }}">Fiat Muat</a></li>
                            <li><a href="{{ route('fcl-delivery-suratjalan-index') }}">Surat Jalan</a></li>-->
                            <li><a href="{{ route('fcl-delivery-release-index') }}">Release / Gate Out</a></li>
                        </ul>
                      </li>
                      <li class="dropdown-submenu">
                        <a class="submenu" href="#">Report <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <!--<li><a href="{{ route('fcl-report-harian') }}">Delivery Harian</a></li>-->
                            <li><a href="{{ route('fcl-report-rekap') }}">Report Container</a></li>
                            <li><a href="{{ route('fcl-report-longstay') }}">Inventory</a></li>
                            <!--<li><a href="{{ route('fcl-report-stock') }}">Rekap Stock</a></li>-->
<!--                                <li>
                                    <a href="">Utilitas Gudang Harian</a>
                                </li>
                                <li>
                                    <a href="">Utilitas Gudang Bulanan</a>
                                </li>
                                <li>
                                    <a href="">Rekap Stock Cargo > 30 Hari</a>
                                </li>
                                <li>
                                    <a href="">Status Rack Cargo</a>
                                </li>
                                <li>
                                    <a href="">Monitoring Rack Tally Release</a>
                                </li>-->
                        </ul>
                      </li>
                    </ul>
                  </li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">TPS Online <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                  <li class="dropdown-submenu">
                  <a class="submenu" href="#">Import <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-submenu">
                                <a class="submenu" href="#">Table <span class="caret"></span></a>
                                  <ul class="dropdown-menu">
                                      <li><a href="{{ route('gudang-index') }}">Gudang</a></li>
                                      <li><a href="{{ route('pelabuhandn-index') }}">Pelabuhan DN</a></li>
                                      <li><a href="{{ route('pelabuhanln-index') }}">Pelabuhan LN</a></li>
                                  </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <a class="submenu" href="#">Penerimaan Data <span class="caret"></span></a>
                                  <ul class="dropdown-menu">
                                    <li><a href="{{ route('tps-responPlp-index') }}">Data Respon PLP</a></li>
                                    <li><a href="{{ route('tps-responBatalPlp-index') }}">Data Respon Batal PLP</a></li>
                                    <li><a href="{{ route('tps-obLcl-index') }}">Data OB LCL</a></li>
                                    <li><a href="{{ route('tps-obFcl-index') }}">Data OB FCL</a></li>
                                    <li><a href="{{ route('tps-spjm-index') }}">Data SPJM</a></li>
                                    <li><a href="{{ route('tps-dokManual-index') }}">Data Dok Manual</a></li>
                                    <li><a href="{{ route('tps-sppbPib-index') }}">Data SPPB</a></li>
                                    <li><a href="{{ route('tps-sppbBc-index') }}">Data SPPB BC23</a></li>
                                  </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <a class="submenu" href="#">Pengiriman Data <span class="caret"></span></a>
                                  <ul class="dropdown-menu">
                                      <li class="dropdown-submenu">
                                            <a class="submenu" href="#">Coari (Cargo Masuk) <span class="caret"></span></a>
                                              <ul class="dropdown-menu">
                                                  <li><a href="{{ route('tps-coariCont-index') }}">Coari Cont</a></li>
                                                  <li><a href="{{ route('tps-coariKms-index') }}">Coari KMS</a></li>
                                              </ul>
                                        </li>
                                        <li class="dropdown-submenu">
                                            <a class="submenu" href="#">Codeco (Cargo Keluar) <span class="caret"></span></a>
                                              <ul class="dropdown-menu">
                                                  <li><a href="{{ route('tps-codecoContFcl-index') }}">Codeco Cont FCL</a></li>
                                                  <li><a href="{{ route('tps-codecoContBuangMty-index') }}">Codeco Cont Buang MTY</a></li>
                                                  <li><a href="{{ route('tps-codecoKms-index') }}">Codeco KMS</a></li>
                                              </ul>
                                        </li>
                                  </ul>
                            </li>
                            <li><a href="{{ route('tps-reject-index') }}">Coari Codeco Reject</a></li>
                            <li><a href="{{ route('tps-terkirim-index') }}">Coari Codeco Terkirim</a></li>
                            <li><a href="{{ route('tps-gagal-index') }}">Coari Codeco Gagal</a></li>
                            <li><a href="#">TPS Log Sevice</a></li>
                            
                        </ul>
                  </li>
              </ul>
            </li>
            
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Invoice <span class="caret"></span></a>
                <ul class="dropdown-menu" role="manu">
                    <li class="dropdown-submenu">
                        <a class="submenu" href="#">LCL <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                                <li><a href="{{route('invoice-tarif-index')}}">Data Tarif</a></li>
                                <li><a href="{{route('invoice-release-index')}}">Data Release/Gate Out</a></li>
                                <li><a href="{{route('invoice-index')}}">Data Invoice</a></li>
                          </ul>
                    </li>
                    <li class="dropdown-submenu">
                        <a class="submenu" href="#">FCL <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                              <li><a href="{{route('invoice-tarif-nct-index')}}">Data Tarif NCT1</a></li>
                              <li><a href="{{route('invoice-release-nct-index')}}">Data Release/Gate Out</a></li>
                              <li><a href="{{route('invoice-nct-index')}}">Data Invoice</a></li>
                          </ul>
                    </li>
                </ul>
            </li>
            
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Payment <span class="caret"></span></a>
                <ul class="dropdown-menu" role="manu">
                    <li><a href="{{route('payment-bni-index')}}">BNI E-Collection</a></li>
                </ul>
            </li>
            
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Users <span class="caret"></span></a>
                <ul class="dropdown-menu" role="manu">
                    <li><a href="{{route('user-index')}}">User Lists</a></li>
                    <li><a href="{{route('role-index')}}">Roles</a></li>
                    <li><a href="{{route('permission-index')}}">Permissions</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#">Settings</a>
            </li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <!--<img src="../../dist/img/user2-160x160.jpg" class="user-image" alt="User Image">-->
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs">Welcome, {{ \Auth::getUser()->name }}</span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
<!--                <li class="user-header">
                  <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                  <p>
                    Alexander Pierce - Web Developer
                    <small>Member since Nov. 2012</small>
                  </p>
                </li>-->
                <!-- Menu Body -->
                <li class="user-body">
                  <div class="row">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </div>
                  <!-- /.row -->
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                    <a href="{{ route('logout') }}" class="btn btn-default btn-flat">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
</header>