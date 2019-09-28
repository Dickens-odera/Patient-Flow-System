@extends('nurses.main')
@include('nurses.header')
@section('content')
    <div class="box">
        <div class="box-header text-uppercase bg-info text-white"><h4> {{ __('Maternity Request Number ').$maternity_detail->id }}</h4></div>
        <div class="box-body">
            <!-- body content should go here -->
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <form action="" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label for="name" class="col-md-4 form-label text-md-right">{{ __('Patient Name') }}</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="name" value="{{ $maternity_detail->patient_name }}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-md-4 form-label text-md-right">{{ __('Phone Number') }}</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="phone" value="{{ $maternity_detail->phone }}" disabled> 
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="location" class="col-md-4 form-label text-md-right">{{ __('Location') }}</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="location" value="{{ $maternity_detail->location}}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="street" class="col-md-4 form-label text-md-right">{{ __('Street') }}</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="street" value="{{ $maternity_detail->street}}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-md-4 form-label text-md-right">{{ __ ('Description') }}</label>
                        <div class="col-md-8">
                            <textarea name="description" id="description" cols="30" rows="10" class="form-control" disabled>
                            {{ $maternity_detail->comments }}
                            </textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="date" class="col-md-4 form-label text-md-right">{{ __('Date Posted') }}</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="date" value="{{ $maternity_detail->created_at }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-8 col-md-offset-4">
                        <a href="{{ route('nurse.emergencies.maternity.all') }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> {{ __('Back') }}</a>
                    </div>
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>
        <div class="box-footer">
            <!--  Some footer content should go here-->
        </div>
    </div>
@endsection
