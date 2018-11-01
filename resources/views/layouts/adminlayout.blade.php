<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Admin Dashboard | </title>

  <!-- Bootstrap core CSS -->

  <link href="{{ asset('public/admin/css/bootstrap.min.css') }}" rel="stylesheet">

  <link href="{{ asset('public/admin/fonts/css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('public/admin/css/animate.min.css') }}" rel="stylesheet">

  <!-- Custom styling plus plugins -->
  <link href="{{ asset('public/admin/css/custom.css') }}" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{ asset('public/admin/css/maps/jquery-jvectormap-2.0.3.css') }}" />
  <link href="{{ asset('public/admin/css/icheck/flat/green.css') }}" rel="stylesheet">
  <link href="{{ asset('public/admin/css/floatexamples.css') }}" rel="stylesheet" />

    <link href="{{ asset('public/admin/js/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/admin/js/datatables/buttons.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

  <script src="{{ asset('public/admin/js/jquery.min.js') }}"></script>

  <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>


<body class="nav-md">

  <div class="container body">


    <div class="main_container">

      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">

          <div class="navbar nav_title" style="border: 0;">
            <a href="{{ url('/admin') }}" class="site_title"><i class="fa fa-paw"></i> <span>Admin Panel !</span></a>
          </div>
          <div class="clearfix"></div>


          <!-- menu prile quick info -->
          <div class="profile">
            <div class="profile_pic">
              <img src="{{ asset('public/admin/images/avatar5.png') }}" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Welcome,</span>
              <h2>{{ ucfirst(Auth::user()->name)  }}</h2>
            </div>
          </div>
          <!-- /menu prile quick info -->

          <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

            <div class="menu_section">
              <h3>&nbsp;</h3>
              <ul class="nav side-menu">
                <li {{{ (Request::is('admin/category*') ? 'data-customclass=active' : '') }}}><a ><i class="fa fa-tags"></i> Manage Categories <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="{{ route('category.create') }}"><i class="fa fa-plus" style="width:15px;font-size: 15px"></i> Add Category</a></li>
                    <li><a href="{{ route('category.index') }}"><i class="fa fa-list" style="width:15px;font-size: 15px"></i> Manage Categories</a></li>
                  </ul>
                </li>
                <li {{{ (Request::is('admin/skill*') ? 'data-customclass=active' : '') }}}><a ><i class="fa fa-cubes"></i> Manage Skills Set <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="{{ route('skill.create') }}"><i class="fa fa-plus" style="width:15px;font-size: 15px"></i> Add Skill</a></li>
                    <li><a href="{{ route('skill.index') }}"><i class="fa fa-list" style="width:15px;font-size: 15px"></i> Manage Skills</a></li>
                  </ul>
                </li>
                <li {{{ (Request::is('admin/celebrity*') ? 'data-customclass=active' : '') }}}><a ><i class="fa fa-users"></i> Manage Celebrities <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="{{ route('celebrity.create') }}"><i class="fa fa-plus" style="width:15px;font-size: 15px"></i> Add Celebrity</a></li>
                    <li><a href="{{ route('celebrity.index') }}"><i class="fa fa-list" style="width:15px;font-size: 15px"></i> Manage Celebrities</a></li>
                    <li><a href="{{ url('celebrity/import_csv') }}"><i class="fa fa-upload" style="width:15px;font-size: 15px"></i> Import Csv</a></li>
                  </ul>
                </li>

                <li {{{ (Request::is('admin/poll*') ? 'data-customclass=active' : '') }}}><a ><i class="fa fa-bar-chart-o"></i> Manage Polls <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="{{ route('poll.create') }}"><i class="fa fa-plus" style="width:15px;font-size: 15px"></i> Add Polls</a></li>
                    <li><a href="{{ route('poll.index') }}"><i class="fa fa-list" style="width:15px;font-size: 15px"></i> Manage Polls</a></li>
                  </ul>
                </li>

                <li {{{ (Request::is('admin/activity*') ? 'data-customclass=active' : '') }}}><a ><i class="fa fa-bar-chart-o"></i> Manage Activity <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="{{url('manage_activity')}}"><i class="fa fa-list" style="width:15px;font-size: 15px"></i> Manage Activity</a></li>
                  </ul>
                </li>


              <!--
                <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="index.html">Dashboard</a>
                    </li>
                    <li><a href="index2.html">Dashboard2</a>
                    </li>
                    <li><a href="index3.html">Dashboard3</a>
                    </li>
                  </ul>
                </li>
                <li><a><i class="fa fa-edit"></i> Forms <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="form.html">General Form</a>
                    </li>
                    <li><a href="form_advanced.html">Advanced Components</a>
                    </li>
                    <li><a href="form_validation.html">Form Validation</a>
                    </li>
                    <li><a href="form_wizards.html">Form Wizard</a>
                    </li>
                    <li><a href="form_upload.html">Form Upload</a>
                    </li>
                    <li><a href="form_buttons.html">Form Buttons</a>
                    </li>
                  </ul>
                </li>
                <li><a><i class="fa fa-desktop"></i> UI Elements <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="general_elements.html">General Elements</a>
                    </li>
                    <li><a href="media_gallery.html">Media Gallery</a>
                    </li>
                    <li><a href="typography.html">Typography</a>
                    </li>
                    <li><a href="icons.html">Icons</a>
                    </li>
                    <li><a href="glyphicons.html">Glyphicons</a>
                    </li>
                    <li><a href="widgets.html">Widgets</a>
                    </li>
                    <li><a href="invoice.html">Invoice</a>
                    </li>
                    <li><a href="inbox.html">Inbox</a>
                    </li>
                    <li><a href="calender.html">Calender</a>
                    </li>
                  </ul>
                </li>
                <li><a><i class="fa fa-table"></i> Tables <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="tables.html">Tables</a>
                    </li>
                    <li><a href="tables_dynamic.html">Table Dynamic</a>
                    </li>
                  </ul>
                </li>
                <li><a><i class="fa fa-bar-chart-o"></i> Data Presentation <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="chartjs.html">Chart JS</a>
                    </li>
                    <li><a href="chartjs2.html">Chart JS2</a>
                    </li>
                    <li><a href="morisjs.html">Moris JS</a>
                    </li>
                    <li><a href="echarts.html">ECharts </a>
                    </li>
                    <li><a href="other_charts.html">Other Charts </a>
                    </li>
                  </ul>
                </li>
              -->
              </ul>
            </div>
            <!--
            <div class="menu_section">
              <h3>Live On</h3>
              <ul class="nav side-menu">
                <li><a><i class="fa fa-bug"></i> Additional Pages <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="e_commerce.html">E-commerce</a>
                    </li>
                    <li><a href="projects.html">Projects</a>
                    </li>
                    <li><a href="project_detail.html">Project Detail</a>
                    </li>
                    <li><a href="contacts.html">Contacts</a>
                    </li>
                    <li><a href="profile.html">Profile</a>
                    </li>
                  </ul>
                </li>
                <li><a><i class="fa fa-windows"></i> Extras <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="page_404.html">404 Error</a>
                    </li>
                    <li><a href="page_500.html">500 Error</a>
                    </li>
                    <li><a href="plain_page.html">Plain Page</a>
                    </li>
                    <li><a href="login.html">Login Page</a>
                    </li>
                    <li><a href="pricing_tables.html">Pricing Tables</a>
                    </li>

                  </ul>
                </li>
                <li><a><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a>
                </li>
              </ul>
            </div>
            -->
          </div>
          <!-- /sidebar menu -->


        </div>
      </div>

      <!-- top navigation -->
      <div class="top_nav">

        <div class="nav_menu">
          <nav class="" role="navigation">
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
              <li class="">
                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <img src="{{ asset('public/admin/images/img.jpg') }}" alt="">{{ ucfirst(Auth::user()->name)  }}
                  <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                  <!-- <li><a href="javascript:;">  Profile</a> -->
                  </li>
                  <li>
                    <a href="{{ url('/admin/changepassword') }}">
                      <span>Change Password</span>
                    </a>
                  </li>

                  <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                  </li>
                </ul>
              </li>

              <li role="presentation" class="dropdown">
                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-envelope-o"></i>
                  <span class="badge bg-green">6</span>
                </a>
                <ul id="menu1" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">
                  <li>
                    <a>
                      <span class="image">
                                        <img src="{{ asset('public/admin/images/img.jpg') }}" alt="Profile Image" />
                                    </span>
                      <span>
                                        <span>John Smith</span>
                      <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where...
                                    </span>
                    </a>
                  </li>
                  <li>
                    <a>
                      <span class="image">
                                        <img src="{{ asset('public/admin/images/img.jpg') }}" alt="Profile Image" />
                                    </span>
                      <span>
                                        <span>John Smith</span>
                      <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where...
                                    </span>
                    </a>
                  </li>
                  <li>
                    <a>
                      <span class="image">
                                        <img src="{{ asset('public/admin/images/img.jpg') }}" alt="Profile Image" />
                                    </span>
                      <span>
                                        <span>John Smith</span>
                      <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where...
                                    </span>
                    </a>
                  </li>
                  <li>
                    <a>
                      <span class="image">
                                        <img src="{{ asset('public/admin/images/img.jpg') }}" alt="Profile Image" />
                                    </span>
                      <span>
                                        <span>John Smith</span>
                      <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where...
                                    </span>
                    </a>
                  </li>
                  <li>
                    <div class="text-center">
                      <a>
                        <strong>See All Alerts</strong>
                        <i class="fa fa-angle-right"></i>
                      </a>
                    </div>
                  </li>
                </ul>
              </li>

            </ul>
          </nav>
        </div>

      </div>
      <!-- /top navigation -->


      <!-- page content -->
      <div class="right_col" role="main"><br />

      @yield('pagecontent')

      </div>
      <!-- /page content -->
    </div>


  </div>

  <div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
  </div>

  <script src="{{ asset('public/admin/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('public/admin/js/nicescroll/jquery.nicescroll.min.js') }}"></script>

  <!-- bootstrap progress js -->
  <script src="{{ asset('public/admin/js/progressbar/bootstrap-progressbar.min.js') }}"></script>
  <!-- icheck -->
  <script src="{{ asset('public/admin/js/icheck/icheck.min.js') }}"></script>
  <!-- daterangepicker -->
  <script type="text/javascript" src="{{ asset('public/admin/js/moment/moment.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('public/admin/js/datepicker/daterangepicker.js') }}"></script>
  <!-- chart js -->
  <script src="{{ asset('public/admin/js/chartjs/chart.min.js') }}"></script>
  <!-- sparkline -->
  <script src="{{ asset('public/admin/js/sparkline/jquery.sparkline.min.js') }}"></script>

  <script src="{{ asset('public/admin/js/custom.js') }}"></script>

  <!-- flot js -->
  <!--[if lte IE 8]><script type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
  <script type="text/javascript" src="{{ asset('public/admin/js/flot/jquery.flot.js') }}"></script>
  <script type="text/javascript" src="{{ asset('public/admin/js/flot/jquery.flot.pie.js') }}"></script>
  <script type="text/javascript" src="{{ asset('public/admin/js/flot/jquery.flot.orderBars.js') }}"></script>
  <script type="text/javascript" src="{{ asset('public/admin/js/flot/jquery.flot.time.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('public/admin/js/flot/date.js') }}"></script>
  <script type="text/javascript" src="{{ asset('public/admin/js/flot/jquery.flot.spline.js') }}"></script>
  <script type="text/javascript" src="{{ asset('public/admin/js/flot/jquery.flot.stack.js') }}"></script>
  <script type="text/javascript" src="{{ asset('public/admin/js/flot/curvedLines.js') }}"></script>
  <script type="text/javascript" src="{{ asset('public/admin/js/flot/jquery.flot.resize.js') }}"></script>


  <script src="{{ asset('public/admin/js/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('public/admin/js/datatables/dataTables.bootstrap.js') }}"></script>



  <!-- pace -->
  <script src="{{ asset('public/admin/js/pace/pace.min.js') }}"></script>
  <!-- flot -->


  @yield('footer_scripts')
</body>

</html>
