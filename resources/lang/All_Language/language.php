<?php

$languageId = session()->get('languageId');
$lange = App\Subtitle::where('language_id', $languageId)->select('languageKey_id', 'subtitle')->get();
$output = array();

foreach ($lange as $lang) {
	$output[$lang->languageKey->key]= $lang->subtitle;
}
return $output;