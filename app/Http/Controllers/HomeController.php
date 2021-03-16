<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App;
use App\Language;
use App\LanguageKey;
use App\Subtitle;


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
      }
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
   public function subtitle(){
      return view('subtitle');
   }
   
   public function addSubtitle(Request $request){
      Subtitle::insert([
         'languageKey_id'=>$request->languageKey_id,    
         'language_id'=>$request->language_id,    
         'subtitle'=>$request->subtitle
      ]);
      return back()->with('success','Language key add Successfully');
   }

   public function editSubtitle(Request $request){

      Subtitle::find($request->id)->update([
         'subtitle'=>$request->subtitle
      ]);
      return back();
   }

}

