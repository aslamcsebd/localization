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

