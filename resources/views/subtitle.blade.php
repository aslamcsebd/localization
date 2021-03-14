@extends('layouts.app')
@section('content')
<div class="container my-4">
   <div class="d-flex align-items-start row mt-4">
      <div class="nav flex-column col-auto nav-pills bg-light border border-danger p-1" id="v-pills-tab" role="tablist" aria-orientation="vertical">
         @php
            $Languages = App\Language::all();
         @endphp
         @foreach($Languages as $Language2)
            <button class="av-link btn btn-outline-primary p-1 m-1 @if($loop->index==0) active @endif" data-bs-toggle="pill" data-bs-target="#v-pills-{{$Language2->id}}">
               {{$Language2->name}}
            </button>
         @endforeach
      </div>
      <div class="tab-content col" id="v-pills-tabContent">             
         @foreach($Languages as $Language)
            <div class="tab-pane fade show border border-primary @if($loop->index==0) active @endif" id="v-pills-{{$Language->id}}">
               <div class="nav nav-tabs" id="nav-tab" role="tablist">
                  <button class="nav-link @if($loop->index==0) active @endif" data-bs-toggle="tab" data-bs-target="#nav-{{$Language->id}}_code">Code [Add]</button>
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#nav-{{$Language->id}}_output">Output [Complete]</button>
               </div>

               <div class="tab-content" id="nav-tabContent">
                  <div class="tab-pane fade show active resp-tab-content" id="nav-{{$Language->id}}_code" role="tabpanel" aria-labelledby="nav-{{$Language->id}}_code-tab"> 
                     <div class="row">
                        <div class="col">
                           <div class="card">
                              <div class="card-body">                       
                                 <div class="card-header bg-danger mb-2">{{$Language2->name}}</div>
                                    <table class="table table-bordered">
                                       <thead class="text-center">
                                          <tr>
                                             <th>Id</th>
                                             <th>Key</th>
                                             <th>Input</th>
                                             <th>Action</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          @php
                                             $allLanguageKey = App\LanguageKey::all();
                                          @endphp
                                          @foreach($allLanguageKey as $LanguageKey)
                                             @php
                                                $subtitles = App\Subtitle::where('languageKey_id', '!=', $LanguageKey->id)->where('language_id', '!=', $Language2->id)->get();
                                             @endphp
                                             @foreach($subtitles as $subtitle)
                                                <tr>
                                                   <td>{{ $subtitle->id}}</td>
                                                   <td>{{ $subtitle->LanguageKey->key}}</td>
                                                   <td><input type="" name=""></td>
                                                   <td>
                                                      <button>Ok</button>
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
                  <div class="tab-pane fade" id="nav-{{$Language->id}}_output" role="tabpanel" aria-labelledby="nav-{{$Language->id}}_output-tab">
                      <div class="row">
                        <div class="col">
                           <div class="card">
                              <div class="card-body">                       
                                 <div class="card-header bg-success">{{$Language->name}}</div>
                                    <table class="table table-bordered">
                                       <thead class="text-center">
                                          <tr>
                                             <th>Key</th>
                                             <th>Input</th>
                                             <th>Action</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          @php
                                             $subtitles = App\Subtitle::where('languageKey_id', 2)->where('language_id', 3)->get();
                                          @endphp
                                          @foreach($subtitles as $subtitle)
                                             <tr>
                                                <td>{{ $subtitle->id}}</td>
                                                <td><input type="" name=""></td>
                                                <td>
                                                   <button>Ok</button>
                                                </td>
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
            </div>
         @endforeach
      </div>
   </div>
</div>
@endsection