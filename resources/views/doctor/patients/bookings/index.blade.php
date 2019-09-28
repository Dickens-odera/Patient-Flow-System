@extends('doctor.main')
@include('doctor.header')
@section('content')
    {{-- <div class="col-md-2"></div> --}}
    <div class="col-md-12">
        <div class="box">
            <div class="box-header bg-info text-uppercase text-white">{{ __('Your patient appointment Bookings') }}</div>
            @include('includes.errors.custom')
            <div class="box-body">
                <table class="table table-bordered table-striped table-responsive" style="width:100%">
                    <thead>
                        <tr>
                            <input type="text" class="form-control" name="search" placeholder="Search by patient name or id">
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>Patient Name</th>
                            <th>Request Department</th>
                            <th>Nurse</th>
                            <th>Appointment Date</th>
                            <th>Time</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        @if(count($patient_bookings) > 0)
                            @foreach($patient_bookings as $key=>$value)
                                <tbody>
                                    {{ $patient_bookings->links() }}
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->patient }}</td>
                                    <td>{{ $value->department }}</td>
                                    <td>{{ $value->nurse }}</td>
                                    <td>{{ $value->date }}</td>
                                    <td>{{ $value->time }}</td>
                                    <td>{{ $value->status }}</td>
                                    <td class="btn-group btn-group-sm">
                                        <a href="{{ route('doctor.patient.booking.detail', ['id'=>$value->id,'patient'=>$value->patient]) }}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> {{ __('View More') }}</a>
                                        <a href="{{ route('admin.doctor.delete',['id'=>$value->id])}}" class="btn btn-sm btn-danger" onclick="if(!confirm('Are you sure you want to delete this particular record?')){return false}"><i class="fa fa-trash"></i> {{ __('Delete') }}</a>
                                    </td>
                                </tbody>
                            @endforeach
                        @else
                        <p class="alert-warning">No Doctors yet</p>
                        @endif
                    </thead>
                </table>
            </div>
            <div class="box-footer">
                <!-- Some footer content here -->
            </div>
        </div>
    </div>
    {{-- <div class="col-md-2"></div> --}}
@endsection
