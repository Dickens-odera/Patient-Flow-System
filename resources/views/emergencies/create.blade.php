@include('includes.errors.custom')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>{{ env('APP_NAME') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
             html, body {
                background-color:#4B0082;
                color: #fff;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
             }
        </style>
    </head>
    <body>
        <div class="container" style="margin-top:2% !important; border:1px solid #fff; padding:20px !important;">
            <div class="row">
                <div class="col-md-12 text-center text-uppercase" style="margin-bottom:20px;color:#fff;font-size:50px">
                        <h1 class="" style="border:2px solid #80888; padding:2px">{{ __('Emergency Request Form') }}</h1>
                </div>
                <div class="col-md-12 row">
                    
                    <div class="col-md-2"></div>
                    <div class="col-md-8" id="form-request">
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
                            <div class="col-md-8 col-md-offset-8 text-center" >
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
    </body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>
