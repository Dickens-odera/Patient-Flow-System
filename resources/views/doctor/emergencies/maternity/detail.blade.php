@extends('doctor.main')
@include('doctor.header')
@section('content')
    <div class="col-md-6 mb-2">
        <div class="box">
            <div class="box-header bg-info text-uppercase text-white">{{ __('reported maternity emergency details on') }} <span class="text-success" style="font-weight:bold; font-size:18px; font-family:cursive">{{ $maternity_response->patient }}</span></div>
            @include('includes.errors.custom')
            <div class="box-body">
               <form action="" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label for="patient_name" class="col-md-4 form-label text-md-right">{{ __('Patient Name') }}</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="patient_name" disabled value="{{ $maternity_response->patient }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nurse" class="col-md-4 form-label text-md-right">{{ __('Reported by Nurse') }}</label>
                        <div class="col-md-8">
                            <input type="nurse" class="form-control" disabled value="{{ $maternity_response->nurse }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="form-label col-md-4 text-md-right">{{ __('Status') }}</label>
                        <div class="col-md-8">
                            <input type="damage_type" class="form-control" disabled value="{{ $maternity_response->status }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="date" class="col-md-4 form-label text-md-right">{{ __('Date Reported') }}</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" disabled value="{{ $maternity_response->updated_at}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="comments" class="form-label col-md-4 text-md-right">{{ __('Description') }}</label>
                        <div class="col-md-8">
                            <textarea name="comments" id="" cols="30" rows="10" class="form-control" disabled>
                                {{ $maternity_response->comments }}
                            </textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="box-footer">
                <!-- Some footer content here -->
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box">
            <div class="box-header bg-info text-uppercase text-white">{{ __('Patient Examination Section') }}</div>
            <div class="box-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label for="name" class="col-md-4 text-md-right form-label">Have you seen the patient?</label>
                        <div class="col-md-8">
                           Yes <input type="radio" value="yes" name="seen_patient" id="yes">
                           No <input type="radio" value="no" name="seen_patient" id="no">
                        </div>
                    </div>
                    <div id="doctor-response-form" style="display:-moz-groupbox">
                            <div class="form-group row">
                                <label for="date" class="form-label col-md-4 text-md-right">{{ __('Date') }}</label>
                                <div class="col-md-8">
                                    <input type="date" class="form-control" value="{{ old('date') }}" name="date">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="pharmacist" class="col-md-4 form-label text-md-right">{{ __('Pharmacist') }}</label>
                                <div class="col-md-8">
                                    <select name="pharmacist" id="pharmacists" class="form-control">
                                        <option value="">Select...</option>
                                        @if(count($pharmacists) > 0)
                                            @foreach($pharmacists as $key=>$value)
                                                <option value="{{ $value->name }}">{{ $value->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="prescription" class="form-label col-md-4 text-md-right">{{ __('Prescription') }}</label>
                                <div class="col-md-8">
                                    <input type="text" name="prescription" class="form-control" value="{{ old('prescription') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="admit" class="form-label col-md-4 text-md-right">{{ __('Admit Patient?') }}</label>
                                <div class="col-md-8">
                                    Yes <input type="radio" name="admit" value="yes">
                                    No <input type="radio" name="admit" value="no">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="comments" class="form-label text-md-right col-md-4">{{ __('Comments') }}</label>
                                <div class="col-md-8">
                                    <textarea name="comments" id="comments" cols="30" rows="10" class="form-control">
                                        {{ old('comments') }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-md-8 col-md-offset-4">
                                <button class="btn btn-sm btn-success" type="submit">
                                    <i class="fa fa-send"></i> {{ __('Send Examination to Pharmacist') }}
                                </button>
                            </div>
                        </div>
                </form>
            </div>
            <div class="box-footer">
            </div>
        </div>
    </div>
    <script type="text/javascript">
      $(function () {
            $("#yes").click(function () {
                if ($(this).is(":checked")) {
                    $("#doctor-response-form").show();
                    $('#yes').hide();
                } else {
                    $("#doctor-response-form").hide();
                    $('#yes').show();
                }
            });
            });
    </script>
@endsection
<script
src="https://code.jquery.com/jquery-3.4.1.min.js"
integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
crossorigin="anonymous"></script>