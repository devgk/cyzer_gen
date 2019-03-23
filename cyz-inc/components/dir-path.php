<?php
/**
 * Cyzer path definition
 * Contains global path defined variable
 *
 * @package Cyzer
 */



if(!defined('CYZ_INC'))
define('CYZ_INC', ABSPATH.'/cyz-inc');

if(!defined('CYZ_APP'))
define('CYZ_APP', ABSPATH.'/cyz-app');



if(!defined('CYZ_LIB'))
define('CYZ_LIB', ABSPATH.'/cyz-inc/libraries');



if(!defined('CYZ_COMPONENTS'))
define('CYZ_COMPONENTS', ABSPATH.'/cyz-inc/components');



if(!defined('CYZ_ADMIN_CTRL'))
define('CYZ_ADMIN_CTRL', ABSPATH.'/cyz-inc/administration/controllers');

if(!defined('CYZ_VIEWS'))
define('CYZ_VIEWS', ABSPATH.'/cyz-inc/administration/views');


if(!defined('CYZ_GEN'))
define('CYZ_GEN', ABSPATH.'/cyz-gen');

if(!defined('CYZ_CONFIG'))
define('CYZ_CONFIG', ABSPATH.'/cyz-gen/config');
