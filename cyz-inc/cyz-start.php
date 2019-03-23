<?php
/**
 * Starts the Cyzer environment.
 *
 * @package Cyzer
 */


/** Require - Global Path Definitions */
require_once(ABSPATH.'/cyz-inc/components/dir-path.php');


/** Require - URL Modding - to construct request URL */
require_once(CYZ_COMPONENTS.'/url-rewrite.php');


/** Re-write Completed - Setting Up App Started Flag */
if(!defined('APP_STARTED')) define('APP_STARTED', true);


/** Check if Cyzer is configured */
if(file_exists(CYZ_CONFIG.'/cyz-config.php')):


  // Set CYZ Configured to true
  define('CYZ_CONFIGURED', true);


  /** Check Pre prerequisite */
  /** Include CYZER Configuration File */
  require_once(CYZ_CONFIG.'/cyz-config.php');


  /** Initialize Cyzer Application */
  require_once(CYZ_INC.'/initialize.php');


  /** Check if Cyzer is configured 
   *  Start Cyzer setup */
else:


  // Set CYZ Configured to false
  define('CYZ_CONFIGURED', false);


  /** App Installation */
  require_once(CYZ_ADMIN_CTRL.'/setup/install.php');


/** End If Statement */
endif;
