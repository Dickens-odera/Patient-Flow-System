@extends('patients.main')
@include('patients.header')
@section('content')
<div class="col-md-2"></div>
<div class="col-md-8">
    @include('includes.errors.custom')
    <div class="box">
        <div class="box-header bg-info text-uppercase text-white">{{ __('Book a Doctor') }}</div>
        <div class="box-body">
                <form action="{{ route('patient.doctor.booking.submit') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label for="doctor" class="col-md-4 form-label text-md-right">{{ __('Doctor') }}</label>
                        <div class="col-md-8">
                            <select name="doctor" id="doctor" class="form-control">
                                @if(count($doctors) > 0)
                                <option value="">Select...</option>
                                    @foreach($doctors as $key=>$value)
                                        <option value="{{ $value->name }}">{{ $value->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="department" class="col-md-4 form-label text-md-right">{{ __('Department') }}</label>
                        <div class="col-md-8">
                            <select name="department" id="department" class="form-control">
                                @if(count($departments) > 0)
                                    @foreach($departments as $key=>$value)
                                        <option value="">Select...</option>
                                        <option value="{{ $value->name }}">{{ $value->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nurse" class="col-md-4 form-label">{{ __('Nurse') }}</label>
                        <div class="col-md-8">
                            <select name="nurse" id="nurse" class="form-control">
                                @if(count($nurses) > 0)
                                    @foreach($nurses as $key=>$value)
                                        <option value="">Select...</option>
                                        <option value="{{ $value->name }}">{{ $value->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                            <label for="date" class="col-md-4 form-label">{{ __('Date') }}</label>
                            <div class="col-md-8">
                                <input type="date" class="form-control" name="date" value="{{ old('date') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                                <label for="time" class="col-md-4 form-label">{{ __('Time') }}</label>
                                <div class="col-md-8">
                                    <input type="time" class="form-control" name="time" value="{{ old('time') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="comment" class="col-md-4 form-label text-md-right">{{ __('Comments') }}</label>
                        <div class="col-md-8">
                            <textarea name="comment" id="comment" cols="30" rows="10" class="form-control">
                                {{ old('comments') }}
                            </textarea>
                        </div>
                    </div>
                    <div class="col-md-8 col-md-offset-4">
                        <button class="btn btn-sm btn-success" type="submit">
                            <i class="fa fa-send"></i> {{ __('Submit') }}
                        </button>
                        <a href="{{ route('patient.dashboard') }}" class="btn btn-danger btn-sm pull-right">
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