<?php

function set_home_url(){
  // If home URL is set or defined
  if(defined('HOME_URL')) return null;


  // Set Current directory
  $dir = __DIR__;


  // Current Directory URI - Get currently executing directory
  $dir_uri = str_replace('\\', '/', realpath($dir));


  // Get the current domain
  $domain = CURR_DOMAIN;


  // Check if server contest prefix is available
  if(!empty($_SERVER['CONTEXT_PREFIX'])) {
    $domain .= $_SERVER['CONTEXT_PREFIX'];
    $domain .= substr($dir_uri, (strlen($_SERVER['CONTEXT_DOCUMENT_ROOT']) - 1));
  }


  // If not
  else $domain .= substr($dir_uri, (strlen($_SERVER['DOCUMENT_ROOT']) - 1));


  // Removing extra sub directories
  $path_array = array_reverse(explode('/', $domain));
  $path_array = array_reverse(array_slice($path_array, 3));


  // Empty variable
  $home_url = '';


  // Convert array to string
  foreach($path_array as $slug) $home_url .= $slug.'/';


  // Define home URL
  define('HOME_URL', $home_url);
}


set_home_url();



function get_home_url(){
  if(defined('HOME_URL')) return HOME_URL;

  // Return false - Incase HOME_URL is not set
  return false;
}



function get_current_url(){
  if(defined('HOME_URL') && defined(REQUEST_URI)) return HOME_URL.REQUEST_URI;

  // Return false - Incase HOME_URL is not set
  return false;
}



function get_admin_assets_dir_url(){
  if(defined('HOME_URL')) return HOME_URL.'cyz-inc/administration/views/assets';

  // Return false - Incase HOME_URL is not set
  return false;
}



function get_assets_dir_url(){
  if(defined('HOME_URL')) return HOME_URL.'cyz-app/assets';

  // Return false - Incase HOME_URL is not set
  return false;
}
