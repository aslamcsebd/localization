<?php

// sentence.php

// return [
//   'welcome' => 'Bienvenue mon ami'
// ];

$lange = App\language::select('key','fr')->get();
$output = array();
foreach ($lange as $lang) {
	$output[$lang->key]= $lang->fr;
}
	return $output;