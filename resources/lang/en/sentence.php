<?php

// sentence.php

// return [
//    'welcome' => 'Welcome Friend',
//    'hellow' => 'hellow Friend',
// ];


$lange = App\language::select('key','en')->get();
$output = array();

foreach ($lange as $lang) {
   $output [$lang->key] = $lang->en;
}
return $output;

