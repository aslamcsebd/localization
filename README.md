<<<<<<< HEAD
### Laravel Localization
<a href="https://localization.aslambd.com/" target="_blank">
	<img src="storage/images/click_me.png" width="auto" height="260">
</a>

### Documentation

<details>
   <summary>1) Make Three(3) Model [Language, LanguageKey, Subtitle]</summary>

		i) php artisan make:model Language -m
		   app/database/migrations/language
		      
		      Schema::create('languages', function (Blueprint $table) {
		         $table->id();
		         $table->string('name');
		         $table->string('countryImage');
		         $table->timestamps();
		     	});

		ii) php artisan make:model LanguageKey -m
		    app/database/migrations/language_keys

		      Schema::create('language_keys', function (Blueprint $table) {
		         $table->id();
		         $table->string('key');
		         $table->timestamps();
		     	});
	      

		iii) php artisan make:model Subtitle -m
		     App/database/migrations/subtitles

		     	Schema::create('subtitles', function (Blueprint $table) {
		         $table->id();
		         $table->integer('languageKey_id');
		         $table->integer('language_id');
		         $table->text('subtitle');
		         $table->timestamps();
		     	});

		iv) php artisan migrate
</details>

<details>
   <summary>2) Model edit</summary>

		i) app/Language.php
			
			<?php
				namespace App;
				use Illuminate\Database\Eloquent\Model;
				class Language extends Model {
				   protected $fillable = ['name', 'countryImage'];
				   public function subtitle(){
				        return $this->hasOne(Subtitle::class);
				   }
				}

		ii) app/Subtitle.php

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
</details>

<details>
   <summary>3) Middleware command</summary>

		php artisan make:middleware Localization
		app/Http/Middleware/Localization.php

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
</details>

<details>
   <summary>4) Localization MiddlewareKernel.php</summary>
		App\Http\Kernel's $middlewareGroup's array
   
   	protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \App\Http\Middleware\Localization::class, /*Insert this line only*/
        	],

        	'api' => [
            'throttle:60,1',
            'bindings',
        	],
    	]; 
</details>

<details>
   <summary>5) HomeController.php</summary>
		app/http/controllers/HomeController.php

		<?php
			namespace App\Http\Controllers;
			use Illuminate\Http\Request;
			use DB;
			use App;
			use App\Language;
			use App\LanguageKey;
			use App\Subtitle;
			class HomeController extends Controller{
			   public function lang($locale, $languageId){
			      App::setLocale($locale);
			      session()->put('locale', $locale);
			      session()->put('languageId', $languageId);
			      return redirect()->back();
			   }

			   public function home(){     
			      return view('home');
			   }

			   // addLanguage
			   public function addLanguage(Request $request){

			      $validator = $request->validate([
			         'name'=>'required|unique:languages,name',
			         'flag'=>'required'
			      ]);

			      if ($request->hasFile('flag')){
			         if($files=$request->file('flag')){
			            $countryName = $request->name;
			            $countryImage = $request->flag;
			            $fullName=$countryName.".".$countryImage->getClientOriginalExtension();
			            $files->move('assets/flag/', $fullName);
			            $imageLink = "assets/flag/". $fullName;

			            Language::insert([
			               'name'=>$request->name,    
			               'countryImage'=>$imageLink
			            ]);
			         }
			         return back()->with('success','Language add Successfully');
			      }else{
			         return back()->with('fail','Sorry! Language add Fail. Try new language.');
			      }
			   }

			   // addKey
			   public function addKey(Request $request){
			      $validator = $request->validate([
			         'key'=>'required|unique:language_keys,key'
			      ]);

			      $languageKey_id = LanguageKey::insertGetId([
			            'key'=>$request->key
			      ]);

			      Subtitle::insert([
			         'languageKey_id'=>$languageKey_id,    
			         'language_id'=>1,    
			         'subtitle'=>$request->key
			      ]);
			      return back()->with('success','Language key add Successfully');
			   }

			   //Subtitle
			   public function subtitle(){
			      return view('subtitle');
			   }
			   
			   public function addSubtitle(Request $request){
			      Subtitle::insert([
			         'languageKey_id'=>$request->languageKey_id,    
			         'language_id'=>$request->language_id,  
			         'subtitle'=>$request->subtitle
			      ]);
			      return back()->with('success','Subtitle add Successfully');
			   }

			   public function editSubtitle(Request $request){

			      Subtitle::find($request->id)->update([
			         'subtitle'=>$request->subtitle
			      ]);
			      return back();
			   }

			}
</details>

<details>
   <summary>6) lang</summary>

		i)	resources/lang/en/language.php
			Make file: language.php

			<?php
				//Language Default [English] which id no == 1

				$languageId = 1;
				$lange = App\Subtitle::where('language_id', $languageId)->select('languageKey_id', 'subtitle')->get();
				$output = array();

				foreach ($lange as $lang) {
				   $output[$lang->languageKey->key]= $lang->subtitle;
				}
				return $output;

   	ii) Make folder: All_Language
			resources/lang/All_Language/language.php</p>
	
			<?php
				$languageId = session()->get('languageId');
				$lange = App\Subtitle::where('language_id', $languageId)->select('languageKey_id', 'subtitle')->get();
				$output = array();

				foreach ($lange as $lang) {
					$output[$lang->languageKey->key]= $lang->subtitle;
				}
				return $output;		
</details>

<details>
   <summary>7) Blade page</summary>

		i) app.blade.php
	      resources/views/layouts/app.blade.php

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

		ii) head.blade.php
	      resources/views/includes/head.blade.php

			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			{{-- <meta http-equiv="refresh" content="2" /> --}}
			<!-- CSRF Token -->
			<meta name="csrf-token" content="{{ csrf_token() }}">
			<title>{{ config('app.name', 'Laravel') }}</title>

			<!-- Fonts -->
			<link rel="dns-prefetch" href="//fonts.gstatic.com">
			<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
			<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
			<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
			<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

			<link href="{{ asset('assets/style.css') }}" rel="stylesheet">

		iii) header.blade.php
	      resources/views/includes/header.blade.php

			<nav class="navbar navbar-expand-md navbar-light navbar-laravel" style="background-color: cyan;">
			   <div class="container">
			      <a class="navbar-brand" href="{{ url('/') }}">
			         {{ config('app.name', 'Localization') }}
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

			                  {{-- Language <span class="caret"></span> --}}
			                  <i class="fas fa-globe"></i> 
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
			                        {{$Language->name}}
			                     @break
			                     @default
			                        English
			                  @endswitch
			               </a>

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
   
		iv) modal.blade.php
      	resources/views/includes/modal.blade.php

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

		v) footer.blade.php
     		resources/views/includes/footer.blade.php

	     	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script> 
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
			<script type="text/javascript" src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

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
		      $(document).ready( function () {
		         $('.table').DataTable();
		      } );
		   </script>

		   <script type="text/javascript">
		      window.setTimeout(function() {
		          $(".alert").fadeTo(500, 0).slideUp(500, function(){
		              $(this).remove(); 
		          });
		      }, 5000);
		   </script>
  
   	vi) home.blade.php
      	resources/views/home.blade.php

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
			               <p> {{ trans('language.Hellow, how are you?')}}</p>
			               <p> @lang('language.Hellow,how are you?')  </p>
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

   	vii) subtitle.blade.php
	      resources/views/subtitle.blade.php
	      
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
			                                                   <td
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

		viii) welcome.blade.php
	      resources/views/welcome.blade.php

	   	@extends('layouts.app')
			@section('content')
			<div class="container">
			   <div class="row justify-content-center">
			      <div class="col-md-8">
			         <div class="card">
			            <div class="card-header bg-success mb-2">Example Subtitle</div>
			            <div class="card-body p-2">
			               <p> {{ trans('language.Hellow, how are you?')}}  </p>
			               <p> {{ __('language.Enter Father\'s name')}} </p>
			               <p> @lang('language.Forget your password?')  </p
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
</details>

<details>
   <summary>8) Routes</summary>
		routes/web.php

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
</details>

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
