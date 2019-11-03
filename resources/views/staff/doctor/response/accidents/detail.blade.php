@extends('staff.main')
@include('staff.header')
@section('content')
    <div class="col-md-6 mb-2">
        <div class="box">
            <div class="box-header bg-info text-uppercase text-white">{{ __('reported res emergency details on') }} <span class="text-success" style="font-weight:bold; font-size:18px; font-family:cursive">{{ $res->patient }}</span></div>
            <div class="box-body">
               <form action="" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label for="patient_name" class="col-md-4 form-label text-md-right">{{ __('Patient Name') }}</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="patient_name" disabled value="{{ $res->patient }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nurse" class="col-md-4 form-label text-md-right">{{ __('Prescription') }}</label>
                        <div class="col-md-8">
                            <input type="nurse" class="form-control" disabled value="{{ $res->prescription }}">
                        </div>
                    </div>
                    {{-- <div class="form-group row">
                        <label for="res_type" class="col-md-4 form-label text-md-right">{{ __('res Type') }}</label>
                        <div class="col-md-8">
                            <input type="res_type" class="form-control" disabled value="{{ $res->res_type }}">
                        </div>
                    </div> --}}
                    {{-- <div class="form-group row">
                        <label for="" class="form-label col-md-4 text-md-right">{{ __('Damage Type') }}</label>
                        <div class="col-md-8">
                            <input type="damage_type" class="form-control" disabled value="{{ $res->damage_type }}">
                        </div>
                    </div> --}}
                    <div class="form-group row">
                        <label for="date" class="col-md-4 form-label text-md-right">{{ __('Date Reported') }}</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" disabled value="{{ $res->updated_at}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="comments" class="col-md-4 form-label text-md-right">{{ __('Description') }}</label>
                        <div class="col-md-8">
                            <textarea name="comments" id="" cols="30" rows="10" class="form-control" disabled>
                                {{ $res->comments }}
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
            @include('includes.errors.custom')
        <div class="box">
            <div class="box-header bg-info text-uppercase text-white">{{ __('Prescription Cost') }}</div>
            <div class="box-body">
                @if($res->status === 'incomplete')
                <form action="{{ route('pharmacists.patient.transactions.charge',['id'=>$res->id]) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div id="doctor-response-form" style="">
                        <div class="form-group row">
                            <label for="date" class="form-label col-md-4 text-md-right">{{ __('Date') }}</label>
                            <div class="col-md-8">
                                <input type="date" class="form-control" value="{{ old('date') }}" name="date">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="amount" class="form-label col-md-4 text-md-right">{{ __('Cost') }}</label>
                            <div class="col-md-8">
                                <input type="number" name="amount" class="form-control" value="{{ old('cost') }}">
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
                                <i class="fa fa-send"></i> {{ __('Send Charges to patient') }}
                            </button>
                        </div>
                    </div>
                </form>
                @else
                    <div class="alert-warning">
                        <p> You had responded to this emergency record</p>
                    </div>
                @endif
            </div>
            <div class="box-footer">

            </div>
        </div>
    </div>
    <script>
        $(function () {
            $("#yes").click(function () {
                if ($(this).is(":checked")) {
                    $("#doctor-response-form").show();
                    //$('#yes').hide();
                } else {
                    $("#doctor-response-form").hide();
                    //$('#yes').show();
                }
            });
            });
</script>
@endsection
<script
src="https://code.jquery.com/jquery-3.4.1.min.js"
integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
crossorigin="anonymous"></script>