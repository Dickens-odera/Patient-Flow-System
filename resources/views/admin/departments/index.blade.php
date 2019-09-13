@extends('admin.partials.includes.base')
@section('content')
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="box">
            <div class="box-header bg-info text-uppercase text-white">{{ __('All Doctors') }}</div>
            @include('includes.errors.custom')
            <div class="box-body">
                <table class="table table-bordered table-striped table-responsive" style="">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            {{-- <th>Description</th> --}}
                            <th>Action</th>
                        </tr>
                        @if(count($departments) > 0)
                            @foreach($departments as $key=>$value)
                                <tbody>
                                    {{ $departments->links() }}
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->name }}</td>
                                    {{-- <td><textarea name="" id="" cols="30" rows="10">{{ $value->description}}</textarea></td> --}}
                                    <td class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.department.show',['id'=>$value->id]) }}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                                        {{-- <a href="{{ route('admin.department.edit.form', ['id'=>$value->id]) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i> Edit</a> --}}
                                        <a href="{{ route('admin.department.delete',['id'=>$value->id])}}" class="btn btn-sm btn-danger" onclick="if(!confirm('Are you sure you want to delete this particular record?')){return false}"><i class="fa fa-trash"></i> Delete</a>
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
