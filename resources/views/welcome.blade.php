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
         <a class="btn btn-info" href="{{url('next')}}">Next page</a>
         </div>

         <div class="row">
            <div class="col">
               <div class="card">
                  <div class="card-body">                       
                     <div class="card-header bg-success mb-2">All Subtitle</div>
                        <table class="table table-bordered">
                           <thead class="text-center">
                              <tr>
                                 <th>Id</th>
                                 <th>Key</th>
                                 <th>Language </th>
                                 <th>Subtitle</th>
                              </tr>
                           </thead>
                           <tbody>
                              @php
                                 $subtitles = App\Subtitle::all();
                              @endphp
                              @foreach($subtitles as $subtitle)    
                                 <tr>
                                    <td>{{ $subtitle->id}}</td>
                                    <td>{{ $subtitle->languageKey->key}}</td>
                                    <td>{{ $subtitle->language->name}}</td>
                                    <td>{{ $subtitle->subtitle}}</td>
                                 </tr>                           
                              @endforeach                                            
                           </tbody>
                        </table>
                  </div>
               </div>
            </div>
         </div>

    </div>
</div>
@endsection