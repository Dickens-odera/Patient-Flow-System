@extends('nurses.main')
@include('nurses.header')
@section('content')
    <div class="box">
        <div class="box-header text-uppercase bg-info text-white"><h4> {{ __('Maternity Emergency Requests') }}</h4></div>
        <div class="box-body">
            <!-- body content should go here -->
            <table class="table table-bordered table-striped table-responsive">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Patient Name</th>
                        <th>Phone Number</th>
                        <th>Location</th>
                        <th>Street</th>
                        <th>Status</th>
                        <th>Date and Time Reported</th>
                        <th>Action</th>
                    </tr>
                </thead>
                @if(count($maternity) > 0)
                            @foreach($maternity as $key=>$value)
                                <tbody>
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->patient_name }}</td>
                                    <td>{{ $value->phone }}</td>
                                    <td>{{ $value->location }}</td>
                                    <td>{{ $value->street }}</td>
                                    <td>{{ $value->status }}</td>
                                    <td>{{ $value->created_at }}</td>
                                    <td class="btn-group btn-group-sm">
                                        <a href="{{ route('nurse.emergencies.maternity.detail',['id'=>$value->id]) }}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i> {{ __('View') }}</a>
                                        <a href="" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> {{ __('Edit') }}</a>
                                        <a href="" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> {{ __('Delete') }}</a>
                                    </td>
                                </tbody>
                            @endforeach
                @else
                    <tr>
                        <td class="alert alert-warning">No Maternity Requets Yet</td>
                    </tr>
                @endif
            </table>
        </div>
        <div class="box-footer">
            <!--  Some footer content should go here-->
        </div>
    </div>
@endsection