<?php

// sentence.php

// return [
//   'welcome' => 'ようこそ友達'
// ];

$lange = App\language::select('key','jp')->get();
$output = array();

foreach ($lange as $lang) {
	$output[$lang->key]= $lang->jp;
}
	return $output;
