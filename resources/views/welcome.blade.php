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
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
             }
            
            /*
            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            } */
        </style>
    </head>
    <body>
        <div class="container" style="margin-top:10% !important; border:1px solid #fff; padding:100px !important">
            <div class="row">
                <div class="col-md-12 text-center text-uppercase" style="margin-bottom:20px;color:#fff;font-size:50px">
                        <h4 class="" style="border:2px solid #80888; padding:5px">{{ env('APP_NAME') }}</h4>
                </div>
                <div class="col-md-12 row">
                    <div class="col-md-3">
                        <div class="card card-primary">
                            <div class="card-header text-uppercase text-white bg-info">{{ __('Doctor') }}
                                    <i class="fa fa-user pull-right" style="font-size:50px"></i>
                            </div>
                            <div class="card-body">
                                <!-- body content -->
                                    @if(Auth::guard('doctor')->check())
                                        <a href="{{ route('doctor.dashboard') }}" class="btn btn-success btn-sm" style="width:100%"><i class="fa fa-icon-wrench"></i>{{ __('Proceed to dashboard') }}</a>
                                    @else
                                        <a href="{{ route('doctor.login') }}" class="btn btn-sm btn-success" style="width:100%"><i class="fa fa-icon-wrench"></i> {{__('Login Here')}}</a>
                                    @endif

                            </div>
                            <div class="card-footer">
                                <!--  footer content goes here-->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-primary">
                            <div class="card-header text-uppercase text-white bg-info">{{ __('Patient') }}
                                <i class="fa fa-user pull-right" style="font-size:50px"></i>
                            </div>
                            <div class="card-body">
                                <!-- body content -->
                                <form action="" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-group row">
                                        <label for="service" class="col-md-6 form-label text-md-right">{{ __('Action') }}</label>
                                        <div class="col-md-6">
                                            <select name="service" id="service" class="form-control">
                                                <option value="">Select...</option>
                                                @if(Auth::guard('patient')->check())
                                                    <option value="dashboard"><a href="{{ route('patient.dashboard') }}"></a> My Dashboard</option>
                                                @else
                                                    <option value="login"><a href="{{ route('patient.login') }}"></a> Login</option>
                                                @endif
                                                <option value="register">{{ __('Create Account') }}</option>
                                                <option value="emergency">{{ __('Emergency') }}</option>
                                                <option value="booking">{{ __('Book a Doctor') }}</option>
                                                <option value="pharmacy">{{ __('Talk to a Nurse') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-offset-4">
                                        <button class="btn btn-sm btn-success" type="submit" style="width:100%">
                                            <i class="fa fa-send"></i> {{ __('Send Request') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer">
                                <!--  footer content goes here-->
                            </div>
                        </div>                    </div>
                    <div class="col-md-3">
                        <div class="card card-primary">
                            <div class="card-header text-uppercase text-white bg-info">{{ __('Nurse') }}
                                    <i class="fa fa-user pull-right" style="font-size:50px"></i>
                            </div>
                            <div class="card-body">
                                <!-- body content -->
                                @if(Auth::guard('nurse')->check())
                                    <a href="{{ route('nurse.dashboard') }}" class="btn btn-sm btn-success" style="width:100%">{{ __('Proceed Dashboard') }}</a>
                                @else
                                    <a href="{{ route('nurse.login') }}" class="btn btn-sm btn-success" style="width:100%">{{ __('Login Here') }}</a>
                                @endif
                            </div>
                            <div class="card-footer">
                                <!--  footer content goes here-->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-primary">
                            <div class="card-header text-uppercase text-white bg-info">{{ __('Hospital Staff') }}
                                    <i class="fa fa-user pull-right" style="font-size:50px"></i>
                            </div>
                            <div class="card-body">
                                <!-- body content -->
                                @if(Auth::guard('staff')->check())
                                    <a href="{{ route('staff.dashboard') }}" class="btn btn-sm btn-success" style="width:100%">{{ __('Proceed to Dashboard') }}</a>
                                @else
                                    <a href="{{ route('nurse.login') }}" class="btn btn-success btn-sm" style="width:100%">{{ __('Login Here') }}</a>
                                @endif
                            </div>
                            <div class="card-footer">
                                <!--  footer content goes here-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>
