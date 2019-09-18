@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center text-uppercase">
                    <h5>Emmergency Request Form</h5>
                </div>
                <div class="col-md-12 row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        @include('includes.errors.custom')
                        <form action="{{ route('patient.emergency.request.submit') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label for="patient_name" class="col-md-4 form-label text-md-right">{{ __('Name') }}</label>
                                <div class="col-md-8">
                                    <input type="text" name="patient_name" class="form-control" value="{{ old('patient_name') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="type" class="col-md-4 form-label text-md-right">{{ __('Emergency Type') }}</label>
                                <div class="col-md-8">
                                    <select name="type" id="type" class="form-control">
                                        <option value="">Select Emergency Type</option>
                                        <option value="accident">{{ __('Accident') }}</option>
                                        <option value="maternity">{{ __('Maternity') }}</option>
                                        <option value="first_aid">{{ __('First Aid') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="location" class="col-md-4 form-label text-md-right">{{ __('Your Location') }}</label>
                                <div class="col-md-8">
                                    <input type="text" name="location" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="street" class="col-md-4 form-label text-md-right">{{ __('Street') }}</label>
                                <div class="col-md-8">
                                    <input type="text" name="street" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="address" class="col-md-4 form-label text-md-right">{{ __('Address') }}</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="address">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="phone" class="col-md-4 form-label text-md-right">{{ __('Phone') }}</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="phone">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="gender" class="col-md-4 form-label text-md-right">{{ __('Gender') }}</label>
                                <div class="col-md-8">
                                    <select name="gender" id="gender" class="form-control">
                                        <option value="">Select Your Gender</option>
                                        <option value="male">{{ __('Male') }}</option>
                                        <option value="female">{{ __('Female') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="for-group row">
                                <label for="comments" class="col-md-4 form-label text-md-right">{{__('Description') }}</label>
                                <div class="col-md-8">
                                    <textarea name="comments" id="comments" cols="30" rows="10" class="form-control">
                                        {{ old('comments') }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-md-8 col-md-offset-4">
                                <button class="btn btn-sm btn-success">
                                    <i class="fa fa-send"></i> {{__('Submit Request') }}
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
        </div>
    </div>
@endsection