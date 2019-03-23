<?php
/**
 * Cyzer Installation Main File
 * Contains installation settings and functions
 *
 * @package Cyzer
 */


// Check if CYZER is configured
if(false === CYZ_CONFIGURED) return null;


/** Include URL Fetcher to fetch URLs */
require_once(CYZ_COMPONENTS.'/routing/fetch.php');


/** Include Hook */
require_once(CYZ_COMPONENTS.'/hooks.php');


/** Include Templating Engine */
require_once(CYZ_LIB.'/templating/engine.php');


/** Include Junction PHP to start corresponding CYZER Application Parts */
require_once(CYZ_COMPONENTS.'/routing/junction.php');
