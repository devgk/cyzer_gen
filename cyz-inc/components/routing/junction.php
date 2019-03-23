<?php


// Get Slug Array From Request URI
$slug_array_raw = explode('/', REQUEST_URI);


// Create Blank Slug Array
$slug_array = array();


// ReCreate Slug Array using For Loop
foreach($slug_array_raw as $val){
	if($val) array_push($slug_array, $val);
}


// Define Slug Array
if(!defined('SLUG_ARRAY')) define('SLUG_ARRAY', $slug_array);


// Load App Start
if(empty($slug_array[0]) || SU_SLUG != $slug_array[0]) require_once(CYZ_COMPONENTS.'/startup/app.php');


// Load SU Panel Start
elseif(SU_SLUG == $slug_array[0]) require_once(CYZ_COMPONENTS.'/startup/su-panel.php');
