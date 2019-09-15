@extends('doctor.main')
@include('doctor.header')
@section('content')
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="box">
            <div class="box-header bg-info text-uppercase text-white">{{ __('Your Aproved Booking') }}</div>
            @include('includes.errors.custom')
            <div class="box-body">
                <table class="table table-bordered table-striped table-responsive" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Department</th>
                            <th>Nurse</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Status</th>
                        </tr>
                        @if(count($approved_bookings) > 0)
                            @foreach($approved_bookings as $key=>$value)
                                <tbody>
                                    {{ $approved_bookings->links() }}
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->department }}</td>
                                    <td>{{ $value->nurse }}</td>
                                    <td>{{ $value->date }}</td>
                                    <td>{{ $value->time }}</td>
                                    <td>{{ $value->status }}</td>
                                </tbody>
                            @endforeach
                        @else
                        <p class="alert-warning">You have not approved any appointments yet</p>
                        @endif
                    </thead>
                </table>
            </div>
            <div class="box-footer">
                <!-- Some footer content here -->
            </div>
        </div>
    </div>
    <div class="col-md-2"></div>
@endsection
