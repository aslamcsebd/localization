<?php

//Language Default [English] which id no == 1

$languageId = 1;
$lange = App\Subtitle::where('language_id', $languageId)->select('languageKey_id', 'subtitle')->get();
$output = array();

foreach ($lange as $lang) {
   $output[$lang->languageKey->key]= $lang->subtitle;
}
return $output;