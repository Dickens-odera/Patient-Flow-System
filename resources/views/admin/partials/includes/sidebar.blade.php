 <!-- Left side column. contains the logo and sidebar -->
 <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{!! asset('admin/dist/img/user2-160x160.jpg') !!}" class="img-circle" alt="User Image"> 
              {{-- <img src="/storage/uploads/images/admins/{{ Auth::user()->avartar}}" class="img-circle" alt="User Image"> --}}
            </div>
            <div class="pull-left info">
              <p>{{ Auth::user()->name}}</p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          {{-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                  </span>
            </div>
          </form> --}}
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            {{-- <li class="active treeview">
              <a href="{{ route('admin.dashboard') }}">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
                <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
              </ul>
            </li> --}}
            <li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Transactions</span>
                <span class="pull-right-container">
                  <span class="label label-primary pull-right">4</span>
                </span>
              </a>
              <ul class="treeview-menu">
                {{-- <li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li> --}}
                {{-- <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li> --}}
                {{-- <li><a href="pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li> --}}
                {{-- <li><a href="pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li> --}}
              </ul>
            </li>
            {{-- <li>
              <a href="pages/widgets.html">
                <i class="fa fa-th"></i> <span>Widgets</span>
                <span class="pull-right-container">
                  <small class="label pull-right bg-green">new</small>
                </span>
              </a>
            </li> --}}
            <li class="treeview">
              <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>Doctors</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('admin.doctor.add') }}"><i class="fa fa-circle-o"></i> New</a></li>
                <li><a href="{{ route('admin.doctors.view.all') }}"><i class="fa fa-circle-o"></i> View All</a></li>
                {{-- <li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li> --}}
                {{-- <li><a href="pages/charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li> --}}
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Nurses</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('admin.nurses.add') }}"><i class="fa fa-circle-o"></i> New</a></li>
                <li><a href="{{ route('admin.nurses.view.all') }}"><i class="fa fa-circle-o"></i> View All</a></li>
                {{-- <li><a href="pages/UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li> --}}
                {{-- <li><a href="pages/UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li> --}}
                {{-- <li><a href="pages/UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li> --}}
                {{-- <li><a href="pages/UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li> --}}
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Departments</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('admin.department.add') }}"><i class="fa fa-circle-o"></i> New</a></li>
                <li><a href="{{ route('admin.departments.view.all')}}"><i class="fa fa-circle-o"></i> View All</a></li>
                {{-- <li><a href="pages/forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li> --}}
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-table"></i> <span>Patients</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('admin.patients.view.all') }}"><i class="fa fa-circle-o"></i> View All</a></li>
                {{-- <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Data tables</a></li> --}}
              </ul>
            </li>
            {{-- <li>
              <a href="pages/calendar.html">
                <i class="fa fa-calendar"></i> <span>Calendar</span>
                <span class="pull-right-container">
                  <small class="label pull-right bg-red">3</small>
                  <small class="label pull-right bg-blue">17</small>
                </span>
              </a>
            </li> --}}
            {{-- <li>
              <a href="pages/mailbox/mailbox.html">
                <i class="fa fa-envelope"></i> <span>Mailbox</span>
                <span class="pull-right-container">
                  <small class="label pull-right bg-yellow">12</small>
                  <small class="label pull-right bg-green">16</small>
                  <small class="label pull-right bg-red">5</small>
                </span>
              </a>
            </li> --}}
            {{-- <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Examples</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/examples/invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
                <li><a href="pages/examples/profile.html"><i class="fa fa-circle-o"></i> Profile</a></li>
                <li><a href="pages/examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>
                <li><a href="pages/examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>
                <li><a href="pages/examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
                <li><a href="pages/examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
                <li><a href="pages/examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
                <li><a href="pages/examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
                <li><a href="pages/examples/pace.html"><i class="fa fa-circle-o"></i> Pace Page</a></li>
              </ul>
            </li> --}}
            {{-- <li class="treeview">
              <a href="#">
                <i class="fa fa-share"></i> <span>Multilevel</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                <li class="treeview">
                  <a href="#"><i class="fa fa-circle-o"></i> Level One
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                    <li class="treeview">
                      <a href="#"><i class="fa fa-circle-o"></i> Level Two
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                      </a>
                      <ul class="treeview-menu">
                        <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                      </ul>
                    </li>
                  </ul>
                </li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
              </ul>
            </li> --}}
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>