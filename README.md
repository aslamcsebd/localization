<a href="https://localization.aslambd.com/" target="_blank">
   <img src="storage/images/click_me.png" width="auto" height="260">
</a>

### Laravel Localization [Details]

1) Make Three(3) Model [Language, LanguageKey, Subtitle]
   <p>Migration</p>
	   1) <p>php artisan make:model Language -m</p>
		   <p>database/migrations/language</p>
		      <p>
			      Schema::create('languages', function (Blueprint $table) {
			         $table->id();
			         $table->string('name');
			         $table->string('countryImage');
			         $table->timestamps();
			     	});
		      </p>

		2) <p>php artisan make:model LanguageKey -m</p>
		   <p>database/migrations/language_keys</p>
		      <p>
		          Schema::create('language_keys', function (Blueprint $table) {
		            $table->id();
		            $table->string('key');
		            $table->timestamps();
		        });
		      </p>

		3) <p>php artisan make:model Subtitle -m</p>
		   <p>database/migrations/subtitles</p>
		      <p>
		        	Schema::create('subtitles', function (Blueprint $table) {
		            $table->id();
		            $table->integer('languageKey_id');
		            $table->integer('language_id');
		            $table->text('subtitle');
		            $table->timestamps();
		        	});
		      </p>

2) Model edit
	1) app/Language.php
		<p>
			<?php
			namespace App;
			use Illuminate\Database\Eloquent\Model;
			class Language extends Model {
			   protected $fillable = ['name', 'countryImage'];

			   public function subtitle(){
			        return $this->hasOne(Subtitle::class);
			   }
			}
		</p>

	2) app/Subtitle.php
		<p>
			<?php
			namespace App;
			use Illuminate\Database\Eloquent\Model;

			class Subtitle extends Model{

			   protected $fillable = ['languageKey_id', 'language_id', 'subtitle'];

				public function languageKey(){
			        return $this->belongsTo('App\LanguageKey','languageKey_id', 'id');
			   }

			   public function language(){
			        return $this->belongsTo('App\Language','language_id', 'id');
			   }
			}
		</p>

3) Middleware command
	<p>php artisan make:middleware Localization</p>
	<details>
      <summary>Localization.php</summary>
      <p>app/Http/Middleware/Localization.php</p>
      <pre>
      	<?php
				// Localization.php
				namespace App\Http\Middleware;
				use Closure;
				use App;
				class Localization {
				   public function handle($request, Closure $next) {
				      if (session()->has('locale')) {
				         App::setLocale(session()->get('locale'));
				      }
				      return $next($request);
				   }
				}
      </pre>
   </details>

4) Localization Middleware
	<p>App\Http\Kernel's $middlewareGroup's array</p>
	<details>
      <summary>Kernel.php</summary>
      <p>app/Http/Middleware/Localization.php</p>
      <pre>
      	protected $middlewareGroups = [
	        'web' => [
	            \App\Http\Middleware\EncryptCookies::class,
	            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
	            \Illuminate\Session\Middleware\StartSession::class,
	            // \Illuminate\Session\Middleware\AuthenticateSession::class,
	            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
	            \App\Http\Middleware\VerifyCsrfToken::class,
	            \Illuminate\Routing\Middleware\SubstituteBindings::class,
	            \App\Http\Middleware\Localization::class,
	        	],

	        	'api' => [
	            'throttle:60,1',
	            'bindings',
	        	],
	    	];
      </pre>
   </details>

5) HomeController.php
	<p>app/http/controllers/HomeController.php</p>

6) lang
	<p>Make folder: All_Language</p>
	<p>resources/lang/All_Language/language.php</p>
	<p>
		<?php
		$languageId = session()->get('languageId');
		$lange = App\Subtitle::where('language_id', $languageId)->select('languageKey_id', 'subtitle')->get();
		$output = array();

		foreach ($lange as $lang) {
			$output[$lang->languageKey->key]= $lang->subtitle;
		}
		return $output;
	</p>

7) Blade page
	1) app.blade.php
      <p>resources/views/layouts/app.blade.php</p>

      <!doctype html>
		<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
			<head>
				@include('includes.head')
			</head>
			<body>
				@include('includes.header')
				@yield('content')
				@include('includes.modal')
				@include('includes.footer')
				
			</body>
		</html>

	2) head.blade.php
      <p>resources/views/includes/head.blade.php</p>
      	<p>
	      	<meta charset="utf-8">
			   <meta name="viewport" content="width=device-width, initial-scale=1">
			   {{-- <meta http-equiv="refresh" content="2" /> --}}


			   <!-- CSRF Token -->
			   <meta name="csrf-token" content="{{ csrf_token() }}">
			   <title>{{ config('app.name', 'Laravel') }}</title>

			   <!-- Fonts -->
			   <link rel="dns-prefetch" href="//fonts.gstatic.com">
			   <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
			  
			   <!-- Styles -->

			   <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css">
			   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

			   <link href="{{ asset('assets/style.css') }}" rel="stylesheet">
   		</p>

	3) header.blade.php
      <p>resources/views/includes/header.blade.php</p>
      <p>
      	<nav class="navbar navbar-expand-md navbar-light navbar-laravel" style="background-color: cyan;">
			   <div class="container">
			      <a class="navbar-brand" href="{{ url('/') }}">
			         {{ config('app.name', 'Laravel') }}
			      </a>
			      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
			         <span class="navbar-toggler-icon"></span>
			      </button>
			      <div class="collapse navbar-collapse" id="navbarSupportedContent">
			         <ul class="navbar-nav m-auto">
			            <li class="nav-item">
			               <a class="nav-link btn btn-sm btn-primary text-light" data-toggle="modal" data-original-title="test" data-target="#addLanguage">Add Language</a>
			            </li>
			            <li class="nav-item mx-2">
			               <a class="nav-link btn btn-sm btn-success text-light" data-toggle="modal" data-original-title="test" data-target="#addKey">Add Key</a>
			            </li>
			             <li class="nav-item">
			               <a class="nav-link btn btn-sm btn-secondary text-light" href="{{url('subtitle')}}">Add Subtitle</a>
			            </li>
			         </ul>
			         
			         <ul class="navbar-nav ml-auto">
			            <li class="nav-item dropdown">
			               <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
			                  Language <span class="caret"></span>
			               </a>

			               @php
			                  if(session()->get('languageId')){
			                     $languageId = session()->get('languageId');
			                     $id=$languageId;
			                     $Language = App\Language::find($id);
			                  }else{
			                     $languageId = 1;
			                     $id=$languageId;
			                     $Language = App\Language::find($id);
			                  }
			               @endphp

			               @switch($languageId)    
			                  @case($id)
			                     <img src="{{asset($Language->countryImage)}}" width="30px" height="20x"> {{$Language->name}}
			                  @break
			                  @default
			                     <img src="{{asset('assets/flag/us.png')}}" width="30px" height="20x"> English
			               @endswitch
			               {{-- Top side --}}
			               <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
			                  @php
			                     $Languages = App\Language::all();
			                  @endphp

			                  @foreach($Languages as $Language)
			                     <a class="dropdown-item" href="{{url('lang', ['All_Language', $Language->id])}}">
			                        <img src="{{asset($Language->countryImage)}}" width="30px" height="20x">&nbsp; {{$Language->name}}
			                     </a>
			                  @endforeach
			               </div>
			            </li>
			         </ul>
			      </div>
			   </div>
			</nav>
      </p>

	4) modal.blade.php
      <p>resources/views/includes/modal.blade.php</p>
      <p>
	      {{-- Add Language --}}
			   <div class="modal fade" id="addLanguage" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			      <div class="modal-dialog" role="document">
			         <div class="modal-content">
			            <div class="modal-header">
			               <h5 class="modal-title f-w-600" id="exampleModalLabel">Add Language</h5>
			               <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
			            </div>
			            <div class="modal-body">
			               
			               <form action="{{ url('addLanguage') }}" method="post" enctype="multipart/form-data" class="needs-validation" >
			                  @csrf
			                  <div class="form"> 
			                     <div class="form-group">
			                        <label for="name" class="mb-1">Language Full Name:</label>
			                        <input name="name" class="form-control" id="name" type="text" value="{{ old('name')}}" placeholder="Ex: Bangladesh, Japan, India" required>
			                     </div>

			                     <div class="form-group">
			                        <label for="codeTitle" class="mb-1">Country Image/Logo:</label>
			                        <input type="file" class="form-control" name="flag" required>
			                     </div>
			                  </div>
			                  <div class="modal-footer">
			                     <button class="btn btn-primary" type="submit">Add Now</button>
			                     <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
			                  </div>
			               </form>
			            </div>
			         </div>
			      </div>
			   </div>

			{{-- Add Key --}}
			   <div class="modal fade" id="addKey" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			      <div class="modal-dialog" role="document">
			         <div class="modal-content">
			            <div class="modal-header">
			               <h5 class="modal-title f-w-600" id="exampleModalLabel">Add Key</h5>
			               <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
			            </div>
			            <div class="modal-body">
			               
			               <form action="{{ url('addKey') }}" method="post" enctype="multipart/form-data" class="needs-validation" >
			                  @csrf
			                  <div class="form">                     
			                     <div class="form-group">
			                        <label for="key" class="mb-1">Key Name:</label>
			                        <input name="key" class="form-control" id="key" type="text" value="{{ old('key')}}" placeholder="Ex: Home_Page, Profile_page" required>
			                     </div>
			                  </div>
			                  <div class="modal-footer">
			                     <button class="btn btn-primary" type="submit">Add Now</button>
			                     <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
			                  </div>
			               </form>
			            </div>
			         </div>
			      </div>
			   </div>

			{{-- Edit Subtitle --}}
		   <div class="modal fade" id="editSubtitle" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		      <div class="modal-dialog" role="document">
		         <div class="modal-content">
		            <div class="modal-header">
		               <h5 class="modal-title f-w-600" id="exampleModalLabel">Edit code</h5>
		               <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
		            </div>
		            <div class="modal-body">
		               
		               <form action="{{ url('editSubtitle') }}" method="post" enctype="multipart/form-data" class="needs-validation" >
		                  @csrf
		                  <div class="form">
		                     <div class="form-group">
		                        <label for="language_key" class="mb-2">Key Id :</label>
		                        <input name="id" class="form-control" id="id" readonly>
		                     </div>                     
		                     <div class="form-group">
		                        <label for="language_key" class="mb-2">Language key :</label>
		                        <input name="language_key" class="form-control" id="language_key" type="text" readonly>
		                     </div>
		                     <div class="form-group">
		                        <label for="subtitle" class="mb-2">Subtitle Code :</label>
		                        <textarea name="subtitle" class="form-control" id="subtitle" type="text" rows="5"></textarea>
		                     </div>
		                  </div>
		                  <div class="modal-footer">
		                     <button class="btn btn-primary" type="submit">Change Code</button>
		                     <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
		                  </div>
		               </form>
		               
		            </div>
		         </div>
		      </div>
		   </div>
		</p>

	5) footer.blade.php
      <p>resources/views/includes/footer.blade.php</p>
      <p>
      	<script type="text/javascript" src="{{ asset('assets/js/jquery.min.js')}}"></script>
			<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script> 
			<script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js')}}"></script>
			<script type="text/javascript" src="{{ asset('assets/js/jquery.dataTables.min.js')}}"></script>
			   
			<script type="text/javascript">
			   $(document).ready( function () {
			      $('.table').DataTable();
			   } );
			</script>

			{{-- Edit subtitle --}}
			   <script type="text/javascript">
			      $('#editSubtitle').on('show.bs.modal', function (event) {
			         console.log('Model Opened')
			         var button = $(event.relatedTarget)

			         var id = button.data('id') 
			         // var codeTitle = button.data('codeTitle') [Camel case not allow. So don't use it]
			         var language_key = button.data('language_key') 
			         var subtitle = button.data('subtitle') 
			         
			         var modal = $(this)
			         
			         modal.find('.modal-body #id').val(id);
			         modal.find('.modal-body #language_key').val(language_key);
			         modal.find('.modal-body #subtitle').val(subtitle);
			      })
			   </script>

			   <script type="text/javascript">
			      window.setTimeout(function() {
			          $(".alert").fadeTo(500, 0).slideUp(500, function(){
			              $(this).remove(); 
			          });
			      }, 5000);
			   </script>

			   <script type="text/javascript">
			      $(".alert").each(function(){
			        var txt =  $(this).text().replace(/\s+/g,' ').trim() ;
			        $(this).text(txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase());
			      });
			   </script>
      </p>

   6) home.blade.php
      <p>resources/views/home.blade.php</p>
      <p>
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

			               <div class="card-body">
			                  <p> {{ trans('language.Hellow, how are you?')}}  </p>
			                  <p> {{ trans('language.Enter Full Name')}}  </p>
			                  <p> {{ __('language.Enter Father\'s name')}} </p>
			                  <p> @lang('language.Hellow, how are you?')  </p>
			                  <p>{{ trans('language.Enter your Password')}}</p>
			                  {{-- Space allow on laravel --}}

			                </div>
			            </div> <br>
			            <a class="btn btn-info" href="{{url('/')}}">Back page</a>
			            </div>
			        </div>
			    </div>
			</div>
			@endsection
      </p>

   7) subtitle.blade.php
      <p>resources/views/subtitle.blade.php</p>
      <p>
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
			      <div class="nav flex-column col-auto nav-pills bg-light border border-danger p-1" id="v-pills-tab" role="tablist" aria-orientation="vertical">
			         @php
			            $Languages = App\Language::all();
			            $total_languageKey = App\LanguageKey::all()->count();            
			         @endphp
			         @foreach($Languages as $Language)

			            <button class="av-link btn btn-outline-primary p-1 m-1 @if($loop->index==0) active @endif" data-bs-toggle="pill" data-bs-target="#v-pills-{{$Language->id}}">
			               {{$Language->name}}
			            </button>
			         @endforeach
			      </div>
			      <div class="tab-content col" id="v-pills-tabContent">             
			         @foreach($Languages as $Language)
			            @php  $total_complete_subtitle = App\Subtitle::where('language_id', $Language->id)->get()->count(); 
			                  $total_incomplete_subtitle = $total_languageKey - $total_complete_subtitle;
			            @endphp
			            <div class="tab-pane fade show border border-primary @if($loop->index==0) active @endif" id="v-pills-{{$Language->id}}">
			               <div class="nav nav-tabs" id="nav-tab" role="tablist">
			                  <button class="nav-link bg-danger text-light @if($loop->index==0) active @endif" data-bs-toggle="tab" data-bs-target="#nav-{{$Language->id}}_code">Incomplete Subtitle[{{$total_incomplete_subtitle}}/{{$total_languageKey}}]</button>
			                  <button class="nav-link bg-success text-light" data-bs-toggle="tab" data-bs-target="#nav-{{$Language->id}}_output">Complete Subtitle[{{$total_complete_subtitle}}/{{$total_languageKey}}]</button>
			               </div>

			               <div class="tab-content" id="nav-tabContent">
			                  <div class="tab-pane fade show active resp-tab-content" id="nav-{{$Language->id}}_code" role="tabpanel" aria-labelledby="nav-{{$Language->id}}_code-tab">
			                     <div class="row">
			                        <div class="col">
			                           <div class="card">
			                              <div class="card-body">                       
			                                 <div class="card-header bg-danger mb-2">{{$Language->name}}</div>
			                                    <table class="table table-bordered">
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
			                                                            <button class="btn btn-danger text-light">Add Subtitle</button>
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
			                                    <table class="table table-bordered">
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
			                                                      <a class="btn btn-success text-light" data-toggle="modal" data-target="#editSubtitle" data-id="{{$subtitleKey->id}}" data-language_key="{{$LanguageKey->key}}" data-subtitle="{{$subtitleKey->subtitle}}">Edit</a>
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
      </p>

	8) welcome.blade.php
      <p>resources/views/welcome.blade.php</p>
      <p>
      	@extends('layouts.app')
			@section('content')
			<div class="container">
			   <div class="row justify-content-center">
			      <div class="col-md-8">
			         <div class="card">
			            <div class="card-header bg-success mb-2">Example Subtitle</div>
			            <div class="card-body">
			               <p> {{ trans('language.Hellow, how are you?')}}  </p>
			               <p> {{ __('language.Enter Father\'s name')}} </p>
			               <p> @lang('language.Forget your password?')  </p>
			               <p>{{ trans('language.Enter your Password')}}</p>
			               {{-- Space allow on laravel --}}
			            </div>
			         </div> <br>
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
      </p>

8) Routes
	<p>routes/web.php</p>
	<p>
		<?php
			use Illuminate\Support\Facades\Route;

			Route::get('lang/{locale}/{langId}', 'HomeController@lang');

			Route::get('/', function () {
			    return view('welcome');
			});

			Auth::routes();

			Route::post('addLanguage', 'HomeController@addLanguage')->name('addLanguage');
			Route::post('addKey', 'HomeController@addKey')->name('addKey');

			Route::get('subtitle', 'HomeController@subtitle')->name('subtitle');
			Route::post('addSubtitle', 'HomeController@addSubtitle')->name('addSubtitle');
			Route::post('editSubtitle', 'HomeController@editSubtitle')->name('editSubtitle');

			Route::get('next', 'HomeController@home')->name('home');
	</p>

9) public folder structure
	
	public
		assets
			css/
			js/
			flag/ 
				->English.png
				->French.png
				->Japan.png
				->Spanish.

			N:B: Image will be upload by system when language will be added.
					Image size should be 80*50 for better position.[Not mandatory]

Link:

	Laravel Dynamic Localization

	1) https://appdividend.com/2019/04/01/how-to-create-multilingual-website-using-laravel-localization/

	2) See only this time (3:30 - 3:40)
		-> For create  database table
		-> Call Table from database and convert array[]
	https://www.youtube.com/watch?v=cmmJ-upACd8&ab_channel=ProgrammerSayed
