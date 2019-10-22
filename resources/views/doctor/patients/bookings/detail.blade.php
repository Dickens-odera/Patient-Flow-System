@extends('doctor.main')
@include('doctor.header')
@section('content')
<div class="col-md-2"></div>
<div class="col-md-8">
    @include('includes.errors.custom')
    <div class="box">
        <div class="box-header bg-info text-uppercase text-white">{{ __('Booking Information') }}</div>
        <div class="box-body">
                <form action="{{ route('doctor.patient.booking.approve', ['id'=>$booking ->id]) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label for="name" class="col-md-4 form-label text-md-right">{{ __('Patient Name') }}</label>
                        <div class="col-md-8">
                            <input type="text" name="name" class="form-control" value="{{ $booking ->patient }}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-4 form-label text-md-right">{{ __('Request Department') }}</label>
                        <div class="col-md-8">
                            <input type="email" class="form-control" name="email" value="{{ $booking ->department }}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-md-4 form-label">{{ __('Request Nurse') }}</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="phone" value="{{ $booking ->nurse }}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                            <label for="date" class="col-md-4 form-label">{{ __('Date') }}</label>
                            <div class="col-md-8">
                                <input type="date" class="form-control" name="date" value="{{ $booking ->date }}" disabled>
                            </div>
                    </div>
                    <div class="form-group row">
                            <label for="time" class="col-md-4 form-label">{{ __('Time') }}</label>
                            <div class="col-md-8">
                                <input type="time" class="form-control" name="time" value="{{ $booking ->time }}" disabled>
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="avartar" class="col-md-4 form-label text-md-right">{{ __('Comments') }}</label>
                        <div class="col-md-8">
                            <textarea name="coments" id="comments" cols="30" rows="10" class="form-control" disabled>
                                {{ $booking->comment }}
                            </textarea>
                        </div>
                    </div>
                    <div class="col-md-8 col-md-offset-4">
                        <button class="btn btn-sm btn-success" type="submit">
                            <i class="fa fa-send"></i> {{ __('Aprrove Appointment') }}
                        </button>
                        <a href="{{ route('doctor.dashboard') }}" class="btn btn-danger btn-sm pull-right">
                            <i class="fa fa-window-close"></i> Exit
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