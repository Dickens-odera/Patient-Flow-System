@extends('staff.main')
@include('staff.header')
@section('content')
    <div class="box">
        @include('includes.errors.custom')
        <div class="box-header text-uppercase bg-info"><h4>{{ __('Accident Responses from the doctor') }}</h4></div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Patient Name</th>
                        <th>Prescription</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                @if(count($doctor_accident_res) > 0)
                    @foreach($doctor_accident_res as $key=>$value)
                        <tbody>
                            <td>{{ $value->id}}</td>
                            <td>{{ $value->patient}}</td>
                            <td>{{ $value->prescription}}</td>
                            <td>{{ $value->status }}</td>
                            <td class="btn-group btn-group-sm">
                                <a href="{{ route('pharmacists.patient.transactions.detail',['id'=>$value->id]) }}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> View More</a>
                                <a href="" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</a>
                            </td>
                        </tbody>
                    @endforeach
                @endif
            </table>
        </div>
        <div class="box-footer">
            <!--  footer content go here -->
        </div>
    </div>
@endsection