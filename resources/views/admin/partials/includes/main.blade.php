<section class="content-header">
        <h1>
          Dashboard
          <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Dashboard</li>
        </ol>
      </section>
  
      <!-- Main content -->
      <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
              <div class="inner">
                <div class="hidden">
                  {{ $doctors = App\Doctors::latest()->paginate(5) }}
                  {{ $nurses = App\Nurse::latest()->paginate(5) }}
                  {{ $departmets= App\Departments::latest()->paginate(5) }}
                  {{ $patients = App\Patients::latest()->paginate(5) }}
                </div>
                <h3>{{ count($doctors)}}</h3>
  
                <p class="text-uppercase">Doctors</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <a href="{{ route('admin.doctors.view.all') }}" class="small-box-footer">View All <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3>{{ count($nurses) }}</h3>
  
                <p class="text-uppercase">Nurses</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <a href="{{ route('admin.nurses.view.all') }}" class="small-box-footer">View All <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3>{{ count($departmets) }}</h3>
  
                <p class="text-uppercase">Departments</p>
              </div>
              <div class="icon">
                <i class="ion ion-grid"></i>
              </div>
              <a href="{{ route('admin.departments.view.all') }}" class="small-box-footer">View All <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
                <h3>{{ count($patients) }}</h3>
  
                <p class="text-uppercase">Patients</p>
              </div>
              <div class="icon">
                <i class="ion ion-man"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <div class="col-md-6">
              <div class="box">
                  <div class="box-header text-white text-uppercase bg-success">{{ __('Patients') }}</div>
                  <div class="box-body">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Avartar</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th>Type</th>
                        </tr>
                      </thead>
                      @if(count($patients) > 0)
                        @foreach($patients as $key=>$value)
                          <tbody>
                            <tr>
                              <td>{{ $value->id }}</td>
                              <td><img src="/storage/uploads/images/patients/{{ $value->avartar }}" alt="Admin Image" class="img-circle" style="width:50px; height:50px"></td>
                              <td>{{ $value->name }}</td>
                              <td>{{ $value->email }}</td>
                              <td>{{ $value->phone }}</td>
                              <td>{{ $value->type}}</td>
                            </tr>
                          </tbody>
                        @endforeach
                      @endif
                    </table>
                    {{ $patients->links() }}
                  </div>
                  <div class="box-footer"></div>
                </div>
          </div>
          <div class="col-md-6">
            <div class="box">
              <div class="box-header bg-info text-white text-uppercase">Nurses</div>
              <div class="box-body">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Avatar</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>phone</th>
                      </tr>
                    </thead>
                    @if(count($nurses) > 0)
                      @foreach($nurses as $key=>$value)
                        <tbody>
                          <tr>
                            <td>{{ $value->id }}</td>
                            <td><img src="/storage/uploads/images/nurses/{{ $value->avartar }}" alt="Admin Image" class="img-circle" style="width:50px; height:50px"></td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->email }}</td>
                            <td>{{ $value->phone }}</td>
                          </tr>
                        </tbody>
                      @endforeach
                    @endif
                  </table>
                  {{ $nurses->links() }}
              </div>
              <div class="box-footer">
                <!--  Some footer content go here-->
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
              <div class="box">
                  <div class="box-header bg-success text-white text-uppercase">Doctors</div>
                  <div class="box-body">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Avartar</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Phone</th>
                        </tr>
                      </thead>
                      @if(count($doctors) > 0)
                          @foreach($doctors as $key => $value )
                          <tbody>
                            <td>{{ $value->id }}</td>
                            <td>
                              <img src="/storage/uploads/images/doctors/{{ $value->avartar }}" alt="Admin Image" class="img-circle" style="width:50px; height:50px">
                            </td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->email }}</td>
                            <td>{{ $value->phone }}</td>
                          </tbody>
                          @endforeach
                      @endif
                    </table>
                    {{ $doctors->links() }}
                  </div>
                  <div class="box-footer"></div>
                </div>
          </div>
          <div class="col-md-6">
              <div class="box">
                  <div class="box-header bg-info text-white text-uppercase">{{ __('Departments') }}</div>
                  <div class="box-body">
                    <table class="table  table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Name</th>
                        </tr>
                      </thead>
                      @if(count($departmets) > 0)
                        @foreach($departmets as $key=>$value)
                          <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->name }}</td>
                          </tr>
                        @endforeach
                      @endif
                    </table>
                    {{ $departmets->links() }}
                  </div>
                  <div class="box-footer"></div>
                </div>
          </div>
        </div>
        