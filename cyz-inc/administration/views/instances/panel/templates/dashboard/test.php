<?php
/**
 * @package:  test
 * view-name:   home page
 * View Type:   page
 * Page Name: alpha
 */
/*
Plugin Name: 	Akismet
Plugin URI: http://akismet.com/?return=true
Description: Used by millions, Akismet is quite possibly the best way in the world to <strong>protect your blog from comment and trackback spam</strong>. It keeps your site protected from spam even while you sleep. To get started: 1) Click the "Activate" link to the left of this description, 2) <a href="http://akismet.com/get/?return=true">Sign up for an Akismet API key</a>, and 3) Go to your <a href="admin.php?page=akismet-key-config">Akismet configuration</a> page, and save your API key.
Version: 2.5.6
Author: Automattic
Author URI: http://automattic.com/wordpress-plugins/
License: GPLv2 or later
*/
?>

<?php
  $context = '';

  $default_headers = array('Page Name', 'View Type', 'Template File');

  $fp = fopen(__DIR__.'/test.php', 'r');

  $file_data = fread($fp, 8192);

  fclose($fp);

  $file_data = str_replace("\r", "\n", $file_data);

  $result = array();

  foreach($default_headers as $key => $regex){

      if ( preg_match( '/^[ \t\/*#@]*' . preg_quote( $regex, '/' ) . ':(.*)$/mi', $file_data, $match ) && $match[1] ) {
          $default_headers[ $key ] = trim( preg_replace( '/\s*(?:\*\/|\?>).*/', '', $match[1]  ) );
      } else {
          $default_headers[ $key ] = '';
      }

      $result[$regex] = $default_headers[ $key ];
  }

  foreach($result as $key => $value){
    if(!empty($value)) echo '"'.$key.'" => "'.$value.'" <br />';
  }
?>
