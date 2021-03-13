<?php

// sentence.php

// return [
//   'welcome' => 'Bienvenido amigo'
// ];

$lange = App\language::select('key','es')->get();
$output = array();
foreach ($lange as $lang) {
	$output[$lang->key]= $lang->es;
}
	return $output;