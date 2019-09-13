@extends('admin.partials.includes.base')
@section('content')
<div class="col-md-2"></div>
<div class="col-md-8">
    @include('includes.errors.custom')
    <div class="box">
        <div class="box-header bg-info text-uppercase text-white">{{ __('Edit Department Information') }}</div>
        <div class="box-body">
                <form action="{{ route('admin.department.update', ['id'=>$department->id]) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label for="name" class="col-md-4 form-label text-md-right">{{ __('Name') }}</label>
                        <div class="col-md-8">
                            <input type="text" name="name" class="form-control" value="{{ $department->name }}">
                        </div>
                    </div>
                   
                    <div class="form-group row">
                        <label for="description" class="col-md-4 form-label text-md-right">{{ __('Description') }}</label>
                        <div class="col-md-8">
                            <textarea name="description" id="" cols="30" rows="10" class="form-control">
                                {{ $department->description }}
                            </textarea>
                        </div>
                    </div>
                    <div class="col-md-8 col-md-offset-4">
                        <button class="btn btn-sm btn-success" type="submit">
                            <i class="fa fa-send"></i> {{ __('Submit') }}
                        </button>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-danger btn-sm pull-right">
                            <i class="fa fa-window-close"></i> Cancel
                        </a>
                    </div>
                </form>
        </div>
        <div class="box-footer">
            <!-- footer content go here -->
        </div>
    </div>
</div>
    <div class="col-md-2"></div>
@endsection