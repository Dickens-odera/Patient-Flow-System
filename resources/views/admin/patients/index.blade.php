@extends('admin.partials.includes.base')
@section('content')
    {{-- <div class="col-md-2"></div> --}}
    <div class="col-md-12">
        <div class="box">
            <div class="box-header bg-info text-uppercase text-white">{{ __('All Patients') }}</div>
            @include('includes.errors.custom')
            <div class="box-body">
                <table class="table table-bordered table-striped table-responsive" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Type</th> 
                        </tr>
                        @if(count($patients) > 0)
                            @foreach($patients as $key=>$value)
                                <tbody>
                                    <td>{{ $value->id }}</td>
                                    <td><img src="/storage/uploads/images/patients/{{ $value->avartar }}" alt="{{$value->name."'s passport"}}" style="width:50px; height:30px; border-radius:50%"></td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td>{{ $value->phone }}</td>
                                    <td>{{ $value->type }}</td>
                                </tbody>
                            @endforeach
                        @else
                        <p class="alert-warning">No patientss yet</p>
                        @endif
                    </thead>
                </table>
                {{ $patients->links() }}
            </div>
            <div class="box-footer">
                <!-- Some footer content here -->
            </div>
        </div>
    </div>
    {{-- <div class="col-md-2"></div> --}}
@endsection
