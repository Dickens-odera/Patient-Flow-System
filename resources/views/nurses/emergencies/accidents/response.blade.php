@extends('nurses.main')
@include('nurses.header')
@section('content')
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 mb-2">
    <div class="box">
        <div class="header bg-info text-white text-uppercase">
    
        </div>
        <div class="box-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label for="patient" class="col-md-4 form-label text-md-right">{{ __('Patient') }}</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" value="{{ $patient }}">
                        </div>
                    </div>
                </form>
        </div>
        <div class="box-footer">

        </div>
    </div>
</div>
<div class="col-md-3"></div>
</div>
@endsection