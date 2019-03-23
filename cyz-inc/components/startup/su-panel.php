<?php


/** Initialize With Libraries and Components */
require_once(CYZ_ADMIN_CTRL.'/libraries.php');


/** Include app DB main library */
require_once(CYZ_COMPONENTS.'/core/includes/app.db.php');


/** Include Watcher Scripts */
require_once(CYZ_COMPONENTS.'/core/functions/watcher.php');


// Get App integration file for configuration
require_once(CYZ_APP.'/controllers/integrate.php');


/** Include Compiler Scripts */
require_once(CYZ_COMPONENTS.'/core/functions/compiler.php');


/** Include Pre Rendering Scripts */
require_once(CYZ_COMPONENTS.'/core/pre.render.php');


/** Get Admin Routing */
require_once(CYZ_ADMIN_CTRL.'/routing.php');
