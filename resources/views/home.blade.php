@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Language') }}</div>

                  <div class="card-body">
                       @if (session('status'))
                           <div class="alert alert-success" role="alert">
                               {{ session('status') }}
                           </div>
                       @endif
                      <p>{{ trans('sentence.c')}}</p>
                   </div>
                  <a class="btn btn-info" href="{{url('/')}}">Back page</a>
            </div>
        </div>
    </div>
</div>
@endsection
