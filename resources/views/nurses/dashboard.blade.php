@extends('nurses.main')
@include('nurses.header')
@section('content')
    <div class="box">
        <div class="box-header text-uppercase bg-info text-white"><h4> {{ __('Nurse Dashboard') }}</h4></div>
        <div class="box-body">
            <!-- body content should go here -->
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header bg-primary text-white text-uppercase text-center" style="width:100%; color:white">{{ __('Accident Emergencies') }}</div>
                        <div class="box-body">
                            <table class="table table-resposive table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Patient</th>
                                        <th>Phone</th>
                                        <th>Location</th>
                                        <th>Street</th>
                                        <th>Date Reported</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                    @if(count($accidents) > 0)
                                        @foreach($accidents as $key=>$value)
                                        <tbody>
                                            <td>{{ $value->id }}</td>
                                            <td>{{ $value->patient }}</td>
                                            <td>{{ $value->phone }}</td>
                                            <td>{{ $value->location }}</td>
                                            <td>{{ $value->street }}</td>
                                            <td>{{ $value->created_at }}</td>
                                            <td>{{ $value->status }}</td>
                                        @endforeach
                                    </tbody>
                                    @endif
                            </table>
                        </div>
                        <div class="box-footer">
                            <a href="{{ route('nurse.emergencies.accidents.all') }}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i> {{ __('View More') }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header bg-primary text-white text-uppercase text-center" style="color:white">{{ __('Maternity Emergencies') }}</div>
                        <div class="box-body">
                            <table class="table table-resposive table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Patient</th>
                                        <th>Phone</th>
                                        <th>Location</th>
                                        <th>Street</th>
                                        <th>Date Reported</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                    @if(count($maternity) > 0)
                                        @foreach($maternity as $key=>$value)
                                        <tbody>
                                            <td>{{ $value->id }}</td>
                                            <td>{{ $value->patient }}</td>
                                            <td>{{ $value->phone }}</td>
                                            <td>{{ $value->location }}</td>
                                            <td>{{ $value->street }}</td>
                                            <td>{{ $value->created_at }}</td>
                                            <td>{{ $value->status }}</td>
                                        @endforeach
                                    </tbody>
                                    @endif
                            </table>
                        </div>
                        <div class="box-footer">
                            <a href="{{ route('nurse.emergencies.maternity.all') }}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> {{ __('View More') }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header bg-primary text-white text-uppercase text-center" style="color:white">{{ __('First Aid Emergencies') }}</div>
                        <div class="box-body">
                            <table class="table table-resposive table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Patient</th>
                                        <th>Phone</th>
                                        <th>Location</th>
                                        <th>Street</th>
                                        <th>Date Reported</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                    @if(count($first_aid_requests) > 0)
                                        @foreach($first_aid_requests as $key=>$value)
                                        <tbody>
                                            <td>{{ $value->id }}</td>
                                            <td>{{ $value->patient }}</td>
                                            <td>{{ $value->phone }}</td>
                                            <td>{{ $value->location }}</td>
                                            <td>{{ $value->street }}</td>
                                            <td>{{ $value->created_at }}</td>
                                            <td>{{ $value->status }}</td>
                                        @endforeach
                                    </tbody>
                                    @endif
                            </table>
                        </div>
                        <div class="box-footer">
                            <a href="{{ route('nurse.emergencies.first_aid.all') }}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> {{ __('View More') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <!--  Some footer content should go here-->
        </div>
    </div>
@endsection