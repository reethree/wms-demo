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
                      <li><a tabindex="-1" href="#">Manifest</a></li>
                      <li class="dropdown-submenu">
                        <a class="submenu" href="#">Realisasi Planning <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="">Realisasi Masuk</a></li>
                            <li><a href="">Realisasi Stripping</a></li>
                            <li><a href="">Penomoran Tally Racking</a></li>
                            <li><a href="">Realisasi Manifest Racking</a></li>
                            <li><a href="">Realisasi Buang MTY</a></li>
                            <li><a href="">Update</a></li>
                        </ul>
                      </li>
                      <li class="dropdown-submenu">
                        <a class="submenu" href="#">Delivery <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="">Behandle</a>
                                </li>
                                <li>
                                    <a href="">Fiat Muat</a>
                                </li>
                                <li>
                                    <a href="">Surat Jalan</a>
                                </li>
                                <li>
                                    <a href="">Release</a>
                                </li>
                        </ul>
                      </li>
                      <li class="dropdown-submenu">
                        <a class="submenu" href="#">Report <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="">Delivery Harian</a>
                                </li>
                                <li>
                                    <a href="">Rekap Import</a>
                                </li>
                                <li>
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
                                </li>
                        </ul>
                      </li>
                    </ul>
                  </li>
                  <li class="dropdown-submenu">
                    <a class="submenu" tabindex="-1" href="#">Import FCL <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a tabindex="-1" href="#">Register</a></li>
                      <li><a tabindex="-1" href="#">Manifest</a></li>
                      <li class="dropdown-submenu">
                        <a class="submenu" href="#">Realisasi Planning <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="">Realisasi Masuk</a></li>
                            <li><a href="">Realisasi Stripping</a></li>
                            <li><a href="">Penomoran Tally Racking</a></li>
                            <li><a href="">Realisasi Manifest Racking</a></li>
                            <li><a href="">Realisasi Buang MTY</a></li>
                            <li><a href="">Update</a></li>
                        </ul>
                      </li>
                      <li class="dropdown-submenu">
                        <a class="submenu" href="#">Delivery <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="">Behandle</a>
                                </li>
                                <li>
                                    <a href="">Fiat Muat</a>
                                </li>
                                <li>
                                    <a href="">Surat Jalan</a>
                                </li>
                                <li>
                                    <a href="">Release</a>
                                </li>
                        </ul>
                      </li>
                      <li class="dropdown-submenu">
                        <a class="submenu" href="#">Report <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="">Delivery Harian</a>
                                </li>
                                <li>
                                    <a href="">Rekap Import</a>
                                </li>
                                <li>
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
                                </li>
                        </ul>
                      </li>
                    </ul>
                  </li>
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