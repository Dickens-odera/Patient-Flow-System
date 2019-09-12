@extends('admin.partials.includes.base')

@section('content')
    <div class="box">
      <div class="box-header bg-info text-uppercase text-white">{{ __('admin dashboard') }}</div>
      <div class="box-body">
        <!-- admin content should go here -->
        @include('admin.partials.includes.main')
      </div>
      <div class="box-footer">
        <!-- admin footer content go here -->
      </div>
    </div>
@endsection