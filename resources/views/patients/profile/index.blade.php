@extends('patients.main')
@include('patients.header')
@section('content')
   <div class="box">
       <div class="box-header text-uppercase bg-info text-white"><h4>{{ __('My Profile') }}</h4></div>
       <div class="box-body">
           <!-- bodyb content go here -->
           <div class="col-md-2">
           </div>
           <div class="col-md-8">
                @include('includes.errors.custom')
                <form action="{{ route('patient.profile.update',['id'=>Auth::user()->id]) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label for="name" class="col-md-4 form-label text-md-right">{{ __('Name') }}</label>
                        <div class="col-md-8">
                            <input type="text" name="name" class="form-control" value="{{ $patient_details->name }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-4 form-label text-md-right">{{ __('Email') }}</label>
                        <div class="col-md-8">
                            <input type="email" name="email" class="form-control" value="{{ $patient_details->email }}">
                        </div>
                    </div>
                    <div class="form-group row">
                            <label for="phone" class="col-md-4 form-label text-md-right">{{ __('Phone') }}</label>
                            <div class="col-md-8">
                                <input type="text" name="phone" class="form-control" value="{{ $patient_details->phone }}">
                            </div>
                        </div>
                    <div class="form-group row">
                            <label for="avartar" class="col-md-4 form-label text-md-right">{{ __('Passport Photo') }}</label>
                            <div class="col-md-8">
                                <div class="col-md-8">
                                    <img src="/storage/uploads/images/patients/{{ $patient_details->avartar}}" alt="" class="img-circle" style="width:200px;height:150px; border: 1px solid #000">
                                </div>
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="avartar" class="col-md-4 form-label text-md-right">{{ __('New Passport Photo') }}</label>
                        <div class="col-md-8">
                            <input type="file" name="avartar">
                        </div>
                    </div>
                    <div class="form-group col-md-offset-4">
                        <button class="btn btn-success btn-sm">
                            <i class="fa fa-send"></i> {{ __('Update') }}
                        </button>
                        <a href="{{ route('patient.dashboard') }}" class="btn btn-danger btn-sm pull-right"><i class="fa fa-window-close"></i> {{ __('Cancel') }}</a> 
                    </div>
                </form>
           </div>
           <div class="col-md-2"></div>
       </div>
       <div class="box-footer">
           <!-- Some footer content should go here -->
       </div>
   </div>
@endsection