@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
      @if (session('success'))
         <div class="alert alert-success" role="alert">
             {{ session('success') }}
         </div>
      @endif
      @if (session('fail'))
         <div class="alert alert-danger" role="alert">
             {{ session('fail') }}
         </div>
      @endif
      <div class="col-md-8">
         <div class="card">
            <div class="card-header bg-success mb-2">Example Subtitle</div>
            <div class="card-body p-2">
               <p> {{ trans('language.Hellow, how are you?')}}</p>
               <p> @lang('language.Enter Your address')  </p>
               <p>{{ __('language.Enter your Password')}}</p>
               {{-- Space allow on laravel --}}
            </div>
         </div>
         <br>
         <a class="btn btn-info" href="{{url('/')}}">Back page</a>
      </div>
   </div>
</div>
@endsection