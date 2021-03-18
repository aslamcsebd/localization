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
