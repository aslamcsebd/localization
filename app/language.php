<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model {
   protected $fillable = ['name', 'countryImage'];

   public function subtitle(){
        return $this->hasOne(Subtitle::class);
   }
}
