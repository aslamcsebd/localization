@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
               <div class="card-body">
                  <p> {{ trans('language.hi')}}  </p>
                  <p> {{ __('language.hellow')}} </p>
                  <p> @lang('language.welcome')  </p>
                  <p>{{ trans('language.Enter your Password')}}</p>
                  {{-- Space allow on laravel --}}

                </div>
            </div>
                  <a class="btn btn-info" href="{{url('/')}}">Back page</a>
            </div>
        </div>
    </div>
</div>
@endsection


