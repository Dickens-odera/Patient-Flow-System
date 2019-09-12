@extends('admin.partials.includes.base')
@section('content')
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="box">
            <div class="box-header bg-info text-uppercase text-white">{{ __('All Doctors') }}</div>
            <div class="box-body">
                <table class="table table-bordered table-striped table-responsive" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                        @if(count($doctors) > 0)
                            @foreach($doctors as $key=>$value)
                                <tbody>
                                    {{ $doctors->links() }}
                                    <td>{{ $value->id }}</td>
                                    <td><img src="/storage/uploads/images/doctors/{{ $value->avartar }}" alt="{{$value->name."'s passport"}}" style="width:50px; height:30px; border-radius:50%"></td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td>{{ $value->phone }}</td>
                                    <td class="btn-group btn-group-sm">
                                        <a href="#" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i> Edit</a>
                                        <a href="#" class="btn btn-sm btn-danger" onclick="if(!confirm('Are you sure you want to delete'.' '.$value->name.' '.'?'))return false"><i class="fa fa-trash"></i> Delete</a>
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
    <div class="col-md-2"></div>
@endsection
