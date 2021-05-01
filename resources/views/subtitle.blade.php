@extends('layouts.app')
@section('content')
<div class="container my-4">
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
   <div class="d-flex align-items-start row mt-4">
      <div class="nav flex-column col-auto nav-pills bg-light border p-1" id="v-pills-tab" role="tablist" aria-orientation="vertical">
         @php
            $Languages = App\Language::all();
            $total_languageKey = App\LanguageKey::all()->count();            
         @endphp
         @foreach($Languages as $Language)

            <button class="nav-link btn btn-sm btn-outline-primary p-1 m-1 @if($loop->index==0) active @endif" data-bs-toggle="pill" data-bs-target="#v-pills-{{$Language->id}}">
               {{$Language->name}}
            </button>
         @endforeach
      </div>

      <div class="tab-content col" id="v-pills-tabContent">
         @foreach($Languages as $Language)
            @php  $total_complete_subtitle = App\Subtitle::where('language_id', $Language->id)->get()->count(); 
                  $total_incomplete_subtitle = $total_languageKey - $total_complete_subtitle;
            @endphp
            <div class="tab-pane fade show @if($loop->index==0) active @endif" id="v-pills-{{$Language->id}}">
               <div class="nav nav-tabs" id="nav-tab" role="tablist">
                  <button class="nav-link btn-sm bg-danger text-light @if($loop->index==0) active @endif" data-bs-toggle="tab" data-bs-target="#nav-{{$Language->id}}_code">Incomplete Subtitle[{{$total_incomplete_subtitle}}/{{$total_languageKey}}]</button>
                  <button class="nav-link btn-sm bg-success text-light" data-bs-toggle="tab" data-bs-target="#nav-{{$Language->id}}_output">Complete Subtitle[{{$total_complete_subtitle}}/{{$total_languageKey}}]</button>
               </div>

               <div class="tab-content" id="nav-tabContent">
                  <div class="tab-pane fade show active resp-tab-content" id="nav-{{$Language->id}}_code" role="tabpanel" aria-labelledby="nav-{{$Language->id}}_code-tab">
                     <div class="row">
                        <div class="col">
                           <div class="card">
                              <div class="card-body">                       
                                 <div class="card-header bg-danger mb-2">{{$Language->name}}</div>
                                    <table class="table table-striped table-bordered">
                                       <thead class="text-center">
                                          <tr>
                                             <th>KeyId</th>
                                             <th>Key value</th>
                                             <th>Enter Subtitle</th>
                                             <th>Action</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          @php
                                             $subtitleKeys = 
                                                App\LanguageKey::join('subtitles', 'subtitles.languageKey_id', '=', 'language_keys.id')
                                                   ->join('languages', 'languages.id', '=', 'subtitles.language_id')
                                                   ->where('subtitles.language_id', '=', $Language->id)
                                                   ->select('subtitles.languagekey_id')->get();

                                             $subtitleKeys = collect($subtitleKeys)->pluck('languagekey_id');
                                             $keys = App\LanguageKey::all();
                                             $allKeys = collect($keys)->pluck('id');
                                             $unSubtitles = $allKeys->diff($subtitleKeys);  
                                          @endphp
                                             @foreach($unSubtitles as $id)                                            
                                                @php 
                                                   $LanguageKey = App\LanguageKey::find($id);
                                                @endphp
                                                <tr>
                                                   <form action="{{ url('addSubtitle') }}" method="post">
                                                      @csrf
                                                         <td>
                                                            <input type="hidden" name="languageKey_id" value="{{$LanguageKey->id}}"> {{$LanguageKey->id}}
                                                         </td>
                                                         <td>
                                                            <input type="hidden" name="language_id" value="{{$Language->id}}"> {{ $LanguageKey->key}}
                                                         </td>
                                                         <td >
                                                            <input type="" class="subtitle_input" name="subtitle" required>
                                                         </td>
                                                         <td>
                                                            <button class="btn btn-sm btn-danger text-light">Add Subtitle</button>
                                                         </td>
                                                   </form>
                                                </tr>
                                             @endforeach
                                       </tbody>
                                    </table>                                   
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane fade" id="nav-{{$Language->id}}_output" role="tabpanel" aria-labelledby="nav-{{$Language->id}}_output-tab">
                      <div class="row">
                        <div class="col">
                           <div class="card">
                              <div class="card-body">                       
                                 <div class="card-header bg-success mb-2">{{$Language->name}}</div>
                                    <table class="table table-striped table-bordered">
                                       <thead class="text-center">
                                          <tr>
                                             <th>KeyId</th>
                                             <th>Key value</th>
                                             <th>Subtitle</th>
                                             <th>Action</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          @php
                                             $subtitleKeys = 
                                                App\LanguageKey::join('subtitles', 'subtitles.languageKey_id', '=', 'language_keys.id')
                                                   ->join('languages', 'languages.id', '=', 'subtitles.language_id')
                                                   ->where('subtitles.language_id', '=', $Language->id)
                                                   ->select('subtitles.id','subtitles.languagekey_id', 'subtitles.subtitle')->get();
                                          @endphp
                                          @foreach($subtitleKeys as $subtitleKey)
                                             @php
                                                $LanguageKeys = App\LanguageKey::where('id', '=', $subtitleKey->languagekey_id)->get();
                                             @endphp
                                             @foreach($LanguageKeys as $LanguageKey)
                                                <tr>
                                                   <td>{{ $LanguageKey->id}}</td>
                                                   <td>{{ $LanguageKey->key}}</td>
                                                   <td>{{ $subtitleKey->subtitle}}</td>
                                                   <td>
                                                      <a class="btn btn-sm btn-success text-light" data-toggle="modal" data-target="#editSubtitle" data-id="{{$subtitleKey->id}}" data-language_key="{{$LanguageKey->key}}" data-subtitle="{{$subtitleKey->subtitle}}">Edit</a>
                                                   </td>
                                                </tr>
                                             @endforeach                               
                                          @endforeach                                            
                                       </tbody>
                                    </table>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>                   
               </div>
            </div>
         @endforeach
      </div>
   </div>
</div>
@endsection