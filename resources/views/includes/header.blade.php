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
            @php
               $locale = session()->get('locale');
            @endphp
            <li class="nav-item dropdown">
               <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  Language <span class="caret"></span>
               </a>
               @switch($locale)
                  @case('fr')
                     <img src="{{asset('img/fr.png')}}" width="30px" height="20x"> French
                  @break
                  @case('es')
                     <img src="{{asset('img/jp.png')}}" width="30px" height="20x"> Spain
                  @break
                  @case('jp')
                     <img src="{{asset('img/jp.png')}}" width="30px" height="20x"> Japanese
                  @break
                  @default
                     <img src="{{asset('img/us.png')}}" width="30px" height="20x"> English
               @endswitch
               <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  {{-- <a class="dropdown-item" href="{{url('lang', 'us')}}"><img src="{{asset('img/us.png')}}" width="30px" height="20x"> English</a> --}}
                  <a class="dropdown-item" href="lang/us"><img src="{{asset('img/us.png')}}" width="30px" height="20x"> English</a>
                  <a class="dropdown-item" href="lang/fr"><img src="{{asset('img/fr.png')}}" width="30px" height="20x"> French</a>
                  <a class="dropdown-item" href="lang/es"><img src="{{asset('img/es.png')}}" width="30px" height="20x"> Spanish</a>
                  <a class="dropdown-item" href="lang/jp"><img src="{{asset('img/jp.png')}}" width="30px" height="20x"> Japanese</a>
               </div>
            </li>
         </ul>
      </div>
   </div>
</nav>