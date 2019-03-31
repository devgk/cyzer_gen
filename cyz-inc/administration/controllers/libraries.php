<?php


// Include required scripts from CYZ library
cyz_lib('/base64.mod.php');
cyz_lib('/user-management/main.php');
cyz_lib('/file-management/file-operator.php');
cyz_lib('/cmd/main.php');


// Include required scripts from CYZ SU Core
require_once(CYZ_COMPONENTS.'/update/update.php');
require_once(CYZ_COMPONENTS.'/maintenance/main.php');
require_once(CYZ_COMPONENTS.'/core/functions/read-header.php');
