@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                   {{-- <p>{{ trans('sentence.a')}}</p> --}}
                   {{-- <p>{{ trans('sentence.b')}}</p> --}}
                </div>
            </div>
         <a class="btn btn-info" href="{{url('next')}}">Next page</a>
         </div>
    </div>
</div>
@endsection