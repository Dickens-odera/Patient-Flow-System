@extends('patients.main')
@include('patients.header')
@section('content')
    {{-- <div class="col-md-2"></div> --}}
    <div class="col-md-12">
        <div class="box">
            <div class="box-header bg-info text-uppercase text-white">{{ __('Your Booking History') }}</div>
            @include('includes.errors.custom')
            <div class="box-body">
                <table class="table table-bordered table-striped table-responsive" style="width:100%">
                    <thead>
                        <tr>

                            <div class="col-md-11">
                                    <input type="text" class="form-control" placeholder="search by doctor name or status" style="width:100%">
                            </div>
                            <div class="col-md-1">
                                    <a href="#" class="btn btn-sm btn-success pull-right"><i class="fa fa-search"></i></a>
                            </div>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>Doctor</th>
                            <th>Department</th>
                            <th>Nurse</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        @if(count($bookings) > 0)
                            @foreach($bookings as $key=>$value)
                                <tbody>
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->doctor }}</td>
                                    <td>{{ $value->department }}</td>
                                    <td>{{ $value->nurse }}</td>
                                    <td>{{ $value->date }}</td>
                                    <td>{{ $value->time }}</td>
                                    <td>{{ $value->status }}</td>
                                    <td class="btn-group btn-group-sm">
                                        @if($value->status === 'pending')
                                            <form action="{{ route('patient.doctor.booking.cancel',['id'=>$value->id]) }}" method="post">
                                               {{ csrf_field() }}
                                                <button class="btn btn-sm btn-primary" type="submit">
                                                        <i class="fa fa-window-close"></i>Cancel
                                                </button>
                                            </form>
                                        @endif
                                        <a href="{{ route('patient.doctor.booking.history.delete',['id'=>$value->id])}}" class="btn btn-sm btn-danger" onclick="if(!confirm('Are you sure you want to delete this particular record?')){return false}"><i class="fa fa-trash"></i> Delete</a>
                                    </td>
                                </tbody>
                            @endforeach
                        @else
                        <tr>
                            <td class="alert alert-warning">
                                    No Bookings yet
                            </td>
                        </tr>
                        @endif
                    </thead>
                </table>
                {{ $bookings->links() }}
            </div>
            <div class="box-footer">
                <!-- Some footer content here -->
            </div>
        </div>
    </div>
    {{-- <div class="col-md-2"></div> --}}
@endsection
