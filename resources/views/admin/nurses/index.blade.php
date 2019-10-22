@extends('admin.partials.includes.base')
@section('content')
    {{-- <div class="col-md-2"></div> --}}
    <div class="col-md-12">
        <div class="box">
            <div class="box-header bg-info text-uppercase text-white">{{ __('All Nurses') }}</div>
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
                            <th>Action</th>
                        </tr>
                        @if(count($nurses) > 0)
                            @foreach($nurses as $key=>$value)
                                <tbody>
                                    {{ $nurses->links() }}
                                    <td>{{ $value->id }}</td>
                                    <td><img src="/storage/uploads/images/nurses/{{ $value->avartar }}" alt="{{$value->name."'s passport"}}" style="width:50px; height:30px; border-radius:50%"></td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td>{{ $value->phone }}</td>
                                    <td class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.nurse.edit.form', ['id'=>$value->id]) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i> Edit</a>
                                        <a href="{{ route('admin.nurse.delete',['id'=>$value->id])}}" class="btn btn-sm btn-danger" onclick="if(!confirm('Are you sure you want to delete this particular record?')){return false}"><i class="fa fa-trash"></i> Delete</a>
                                    </td>
                                </tbody>
                            @endforeach
                        @else
                        <p class="alert-warning">No Nurses yet</p>
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
