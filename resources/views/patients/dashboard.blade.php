@extends('patients.main')
@include('patients.header')
@section('content')
   <div class="box">
       <div class="box-header text-uppercase bg-info text-white"><h4>{{ __('Patient Dashboard') }}</h4></div>
       <div class="box-body">
           <!-- bodyb content go here -->
           @include('includes.errors.custom')
       </div>
       <div class="box-footer">
           <!-- Some footer content should go here -->
       </div>
   </div>
@endsection