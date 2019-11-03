@extends('doctor.main')
@include('doctor.header')
@section('content')
    {{-- <div class="col-md-2"></div> --}}
    <div class="col-md-12">
        <div class="box">
            <div class="box-header bg-info text-uppercase text-white">{{ __('Reported Maternity Emergencies') }}</div>
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
                            <th>Nurse</th>
                            <th>Status</th>
                            <th>Date Reported</th>
                            <th>Action</th>
                        </tr>
                        @if(count($maternity_responses) > 0)
                            @foreach($maternity_responses as $key=>$value)
                                <tbody>
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->patient }}</td>
                                    <td>{{ $value->nurse }}</td>
                                    <td>{{ $value->status }}</td>
                                    <td>{{ $value->updated_at }}</td>
                                    <td class="btn-group btn-group-sm">
                                        <a href="{{ route('doctor.emergencies.maternity.detail', ['id'=>$value->id,'patient'=>$value->patient]) }}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> {{ __('View More') }}</a>
                                        <a href="{{ route('doctor.emergencies.accident.delete',['id'=>$value->id])}}" class="btn btn-sm btn-danger" onclick="if(!confirm('Are you sure you want to delete this particular record?')){return false}"><i class="fa fa-trash"></i> {{ __('Delete') }}</a>
                                    </td>
                                </tbody>
                            @endforeach
                        @else
                        <p class="alert-warning">No Doctors yet</p>
                        @endif
                    </thead>
                </table>
                {{ $maternity_responses->links() }}
            </div>
            <div class="box-footer">
                <!-- Some footer content here -->
            </div>
        </div>
    </div>
    {{-- <div class="col-md-2"></div> --}}
@endsection
