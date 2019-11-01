@extends('nurses.main')
@include('nurses.header')
@section('content')
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 mb-2">
        @include('includes.errors.custom')
    <div class="box">
        <div class="header bg-info text-white text-uppercase">
        </div>
        <div class="box-body">
                <form action="{{ route('nurse.emergencies.accident.response.post',['id'=>$patient_id]) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label for="patient" class="col-md-4 form-label text-md-right">{{ __('Patient') }}</label>
                        <div class="col-md-8">
                            <input type="text" name="patient" class="form-control" value="{{ $patient }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="doctor" class="col-md-4 form-label text-md-right">{{ __('Doctor') }}</label>
                        <div class="col-md-8">
                            <select name="doctor" id="doctor" class="form-control">
                                <option value="">Select Doctor ...</option>
                                @if(count($doctors) > 0)
                                    @foreach($doctors as $key=>$value)
                                        <option value="{{ $value->name }}">{{ $value->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="accident_type" class="col-md-4 form-label text-md-right">{{ __('Accident Type') }}</label>
                        <div class="col-md-8">
                            <select name="accident_type" id="" class="form-control">
                                <option value="">Select....</option>
                                <option value="car">Car Accident</option>
                                <option value="mortorcycle">Mortorbike</option>
                                <option value="burns">Fire Burns</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="damage_type" class="col-md-4 form-label text-md-right">{{ __('Damage Type') }}</label>
                        <div class="col-md-8">
                            <select name="damage_type" id="" class="form-control">
                                <option value="">Select ...</option>
                                <option value="savere">Savere</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="comments" class="col-md-4 form-label text-md-right">{{ __('Additional Comments') }}</label>
                        <div class="col-md-8">
                            <textarea name="comments" id="comments" cols="30" rows="10" class="form-control">{{ old('comments') }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-8 col-md-offset-4">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-send"></i> {{ __('Send Response to Doctor') }}
                        </button>
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