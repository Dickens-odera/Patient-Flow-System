 <!-- Left side column. contains the logo and sidebar -->
 <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="/storage/uploads/images/admins/{{ Auth::user()->avartar }}" alt="Admin Image" class="img-circle">
            </div>
            <div class="pull-left info">
              <p>{{ Auth::user()->name}}</p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview">
              <a href="{{ route('admin.dashboard') }}">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>
            <li class="treeview">
              <a href="">
                <i class="fa fa-files-o"></i>
                <span>Transactions</span>
                <span class="pull-right-container">
                  <span class="label label-primary pull-right">4</span>
                </span>
              </a>
              <ul class="treeview-menu">
              </ul>
            </li>
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
              </ul>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>