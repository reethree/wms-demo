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
<!--          <form class="navbar-form navbar-left" role="search">
            <div class="form-group">
              <input type="text" class="form-control" id="navbar-search-input" placeholder="Search">
            </div>
          </form>-->
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->
<!--            <li class="dropdown messages-menu">
               Menu toggle button 
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-envelope-o"></i>
                <span class="label label-success">4</span>
              </a>
              <ul class="dropdown-menu">
                <li class="header">You have 4 messages</li>
                <li>
                   inner menu: contains the messages 
                  <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;"><ul class="menu" style="overflow: hidden; width: 100%; height: 200px;">
                    <li> start message 
                      <a href="#">
                        <div class="pull-left">
                           User Image 
                          <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                        </div>
                         Message title and timestamp 
                        <h4>
                          Support Team
                          <small><i class="fa fa-clock-o"></i> 5 mins</small>
                        </h4>
                         The message 
                        <p>Why not buy a new awesome theme?</p>
                      </a>
                    </li>
                     end message 
                  </ul><div class="slimScrollBar" style="width: 3px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; background: rgb(0, 0, 0);"></div><div class="slimScrollRail" style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(51, 51, 51);"></div></div>
                   /.menu 
                </li>
                <li class="footer"><a href="#">See All Messages</a></li>
              </ul>
            </li>
             /.messages-menu 

             Notifications Menu 
            <li class="dropdown notifications-menu">
               Menu toggle button 
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-bell-o"></i>
                <span class="label label-warning">10</span>
              </a>
              <ul class="dropdown-menu">
                <li class="header">You have 10 notifications</li>
                <li>
                   Inner Menu: contains the notifications 
                  <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;"><ul class="menu" style="overflow: hidden; width: 100%; height: 200px;">
                    <li> start notification 
                      <a href="#">
                        <i class="fa fa-users text-aqua"></i> 5 new members joined today
                      </a>
                    </li>
                     end notification 
                  </ul><div class="slimScrollBar" style="width: 3px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; background: rgb(0, 0, 0);"></div><div class="slimScrollRail" style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(51, 51, 51);"></div></div>
                </li>
                <li class="footer"><a href="#">View all</a></li>
              </ul>
            </li>
             Tasks Menu 
            <li class="dropdown tasks-menu">
               Menu Toggle Button 
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-flag-o"></i>
                <span class="label label-danger">9</span>
              </a>
              <ul class="dropdown-menu">
                <li class="header">You have 9 tasks</li>
                <li>
                   Inner menu: contains the tasks 
                  <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;"><ul class="menu" style="overflow: hidden; width: 100%; height: 200px;">
                    <li> Task item 
                      <a href="#">
                         Task title and progress text 
                        <h3>
                          Design some buttons
                          <small class="pull-right">20%</small>
                        </h3>
                         The progress bar 
                        <div class="progress xs">
                           Change the css width attribute to simulate progress 
                          <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                            <span class="sr-only">20% Complete</span>
                          </div>
                        </div>
                      </a>
                    </li>
                     end task item 
                  </ul><div class="slimScrollBar" style="width: 3px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; background: rgb(0, 0, 0);"></div><div class="slimScrollRail" style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(51, 51, 51);"></div></div>
                </li>
                <li class="footer">
                  <a href="#">View all tasks</a>
                </li>
              </ul>
            </li>-->
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