<?php

// HomeController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Language;
use App\LanguageKey;


class HomeController extends Controller{
   public function lang($locale){
      App::setLocale($locale);
      session()->put('locale', $locale);
      return redirect()->back();
   }

   public function home(){
      return view('home');
   }

   // addLanguage
   public function addLanguage(Request $request){
      Language::insert([
            'name'=>$request->name,    
            'countryImage'=>'Image'
      ]);
      return back()->with('success','Language add Successfully');
   }

   // addKey
   public function addKey(Request $request){
      LanguageKey::insert([
            'key'=>$request->key
      ]);
      return back()->with('success','Language key add Successfully');
   }

    //Subtitle
   public function subtitle(Request $request){
      return view('subtitle');
   }
    public function addSubtitle(Request $request){
      echo "string";
      // LanguageKey::insert([
      //       'key'=>$request->key
      // ]);
      // return back()->with('success','Language key add Successfully');
   }

}

