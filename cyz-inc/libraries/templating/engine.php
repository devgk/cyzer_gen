<?php
/**
 * Cyzer Templating Engine
 * Contains installation settings and functions
 *
 * @package Cyzer
 */


/** Attach controller */
function attach_controller($file_path, $container = null, $app = false){

  /** Controller not from app folder */
  if(true === $app){
    // Attach Controller from Cyzer Includes
    if('core' == $container) require_once(CYZ_LIB.$file_path);

    else{
      require_once(CYZ_ADMIN_CTRL.'/'.$container.$file_path);
    }
  }
}


// Attach view onces
function attach_view($file_path, $app = true){

  /** View from app folder */
  if($app){

    // Attach view from Cyzer Includes
    require_once(CYZ_APP.$file_path);
  }
  
  /** View not from app folder */
  else{

      // Attach view from Cyzer Includes
      require_once(CYZ_VIEWS.'/instances'.$file_path);
    }
}


// Attach view onces
function attach_view_part($file_path, $app = true){

  /** View from app folder */
  if($app){

    // Attach view from Cyzer Includes
    include(CYZ_APP.$file_path);
  }
  
  /** View not from app folder */
  else{

      // Attach view from Cyzer Includes
      include(CYZ_VIEWS.'/instances'.$file_path);
    }
}
