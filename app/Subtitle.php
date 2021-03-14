<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subtitle extends Model{

	public function LanguageKey(){
        return $this->belongsTo(LanguageKey::class, 'languageKey_id');
    }

}
