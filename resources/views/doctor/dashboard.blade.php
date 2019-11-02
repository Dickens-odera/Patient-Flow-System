<div class="hidden">
    {{ $accidents = App\NurseAccidentResponse::where('doctor','=',Auth::user()->name)->latest()->paginate(5) }}
    {{ $maternity = App\NurseMatrenityResponse::where('doctor','=',Auth::user()->name)->latest()->paginate(5) }}
    {{ $bookings = App\Bookings::where('doctor','=',Auth::user()->name)->latest()->paginate(5)  }}
</div>
@extends('doctor.main')
@include('doctor.header')
@section('content')
    <div class="box">
        <div class="box-header text-uppercase bg-info text-white"><h4>{{ __('Doctor Dashboard') }}</h4></div>
        <div class="box-body">
            <!-- body content go here -->
            <div class="col-md-12 text-uppercase text-white text-center mb-2" style="background:cadetblue; padding:10px; margin:0;font-size:18px; color:white">
                {{ __('Emergencies Reported by the nurses') }}
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="box">
                        <div class="box-header bg-info text-uppercase text-white">{{ __('Accident Emergencies') }}</div>
                        <div class="box-body">
                            <table class="table table-bordered table-responsive" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Patient</th>
                                        <th>Nurse</th>
                                        <th>Accident Type</th>
                                        <th>Damage Type</th>
                                    </tr>
                                </thead>
                            @if(count($accidents) > 0)
                                @foreach($accidents as $key=>$value)
                                    <tbody>
                                        <tr>
                                            <td>{{ $value->id }}</td>
                                            <td>{{ $value->patient }}</td>
                                            <td>{{ $value->nurse }}</td>
                                            <td>{{ $value->accident_type }}</td>
                                            <td>{{ $value->damage_type }}</td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            @endif
                            </table>
                            <a href="{{ route('doctor.emergencies.accidents') }}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i> {{ __('View More') }}</a>
                        </div>
                        <div class="box-footer">

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box">
                        <div class="box-header bg-info text-uppercase text-white">{{ __('Maternity Emergencies') }}</div>
                        <div class="box-body">
                            <table class="table table-bordered table-responsive" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Patient</th>
                                        <th>Nurse</th>
                                        <th>Doctor</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                            @if(count($maternity) > 0)
                                @foreach($maternity as $key=>$value)
                                    <tbody>
                                        <tr>
                                            <td>{{ $value->id }}</td>
                                            <td>{{ $value->patient }}</td>
                                            <td>{{ $value->nurse }}</td>
                                            <td>{{ $value->doctor }}</td>
                                            <td>{{ $value->status }}</td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            @endif
                            </table>
                            <a href="{{ route('doctor.emergencies.maternity') }}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i> {{ __('View More') }}</a>
                        </div>
                        <div class="box-footer">

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box">
                        <div class="box-header bg-info text-uppercase text-white">{{ __('First Aid Emergencies') }}</div>
                        <div class="box-body">
                            <table class="table table-bordered table-responsive" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Patient</th>
                                        <th>Nurse</th>
                                        <th>Doctor</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                            @if(count($maternity) > 0)
                                @foreach($maternity as $key=>$value)
                                    <tbody>
                                        <tr>
                                            <td>{{ $value->id }}</td>
                                            <td>{{ $value->patient }}</td>
                                            <td>{{ $value->nurse }}</td>
                                            <td>{{ $value->doctor }}</td>
                                            <td>{{ $value->status }}</td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            @endif
                            </table>
                            <a href="{{ route('doctor.emergencies.first-aid') }}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i> {{ __('View More') }}</a>
                        </div>
                        <div class="box-footer">

                        </div>
                    </div>
                </div>
                <div class="col-md-12 text-uppercase text-white text-center mb-2" style="background:cadetblue; padding:10px; margin:0;font-size:18px; color:white">
                    {{ __('Patient Bookings') }}
                </div>
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header bg-info text-uppercase text-white">{{ __('General Bookings') }}</div>
                        <div class="box-body">
                            <table class="table table-bordered table-responsive" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Patient</th>
                                        <th>Nurse</th>
                                        <th>Department</th>
                                        <th>Request Date</th>
                                        <th>Request Time</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                            @if(count($bookings) > 0)
                                @foreach($bookings as $key=>$value)
                                    <tbody>
                                        <tr>
                                            <td>{{ $value->id }}</td>
                                            <td>{{ $value->patient }}</td>
                                            <td>{{ $value->nurse }}</td>
                                            <td>{{ $value->department }}</td>
                                            <td>{{ $value->date }}</td>
                                            <td>{{ $value->time }}</td>
                                            <td>{{ $value->status }}</td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            @endif
                            </table>
                            <a href="{{ route('doctor.patient.bookings.request') }}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i> {{ __('View More') }}</a>
                        </div>
                        <div class="box-footer"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <!--  footer content-->
        </div>
    </div>

@endsection