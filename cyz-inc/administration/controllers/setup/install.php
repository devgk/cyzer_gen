<?php
/**
 * Cyzer Installation Main File
 * Contains installation settings and functions
 *
 * @package Cyzer
 */


/** Include URL Fetcher to fetch URLs */
require_once(CYZ_COMPONENTS.'/routing/fetch.php');


/** Include Templating Engine */
require_once(CYZ_LIB.'/templating/engine.php');


/** Attach Install View */
require_once(CYZ_VIEWS.'/instances/setup/index.php');
