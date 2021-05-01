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