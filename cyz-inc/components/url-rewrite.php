<?php
/**
 * Cyzer URL Rewrite
 * Contains URL Rewrite logic
 *
 * @package Cyzer
 */


// Get The Domain
$domain = (isset($_SERVER['HTTPS']) ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'];


// Define Current Domain
if(!defined('CURR_DOMAIN')) define('CURR_DOMAIN', $domain);


// Get the URL path without query
$request_uri = strtok($_SERVER['REQUEST_URI'],'?');


// Define Current Domain
if(!defined('REQUEST_URI')) define('REQUEST_URI', $request_uri);


// pattern for repeating forward slash
$pattern = '/(\/{2,})/';


// Check if there is no forward slash at the end
// Or hash repeating forward slashes
if(substr($request_uri, -1) !== '/' || preg_match($pattern, $request_uri)):


  // Adds forward slash to the end and remove extra repetition
  $request_url = rtrim($request_uri.'/', '/').'/';


  // Remove forward slash repetition in between the request URL String 
  $request_url = preg_replace($pattern, '/', $request_url);


  // Create final URL
  $full_url = $domain.$request_url;


  // Basename of full URL
  $base_name = basename($full_url);


  // Check if request URI is not domain / host
  if($base_name != $_SERVER['HTTP_HOST']) {
    // Get the query string separately and redirect to new URL
    header("Location: ".$full_url.parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY));
    exit;
  }


// End If Statement
endif;
