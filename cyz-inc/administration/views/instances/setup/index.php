<?php
/**
 * Cyzer View
 * Contains Setup View Main File
 *
 * @package Cyzer
 */



/** Attach Install View Header */
attach_view_part('/setup/templates/header/header.php', false);



/** Check Get Parameter
 *  If setup parameter found than attach different views */
if(isset($_GET['setup'])):



  /** Setup Error View */
  if($_GET['setup'] == 'error'):

    /** Get Welcome View Instance Template */
    attach_view_part('/setup/templates/body/error.php', false);




  /** Setup Apache htaccess View */
  elseif($_GET['setup'] == 'apache'):

    /** Include Apache HTACCESS setup file */
    attach_controller('/functions/apache.setup.php', 'setup', true);




  /** Setup Database */
  elseif($_GET['setup'] == 'db'):
    /** Include DB Setup script 
     *  DB Script Process POST request
     *  on form submit - during installation */
    attach_controller('/functions/db/setup.php', 'setup', true);

    /** Show DB Setup view after processing post request */
    attach_view_part('/setup/templates/body/db-setup.php', false);




  /** Setup Super User Credential */
  elseif($_GET['setup'] == 'su'):
    /** Include SU Setup script 
    *  SU Script Process POST request
    *  on form submit - during installation */
   attach_controller('/functions/su.setup.php', 'setup', true);

   /** Show DB Setup view after processing post request */
   attach_view_part('/setup/templates/body/su-setup.php', false);




   // End If Statement
  endif;




/** If there is no GET parameter */
else:
  
  
  
  /** Get Welcome View Instance Template */
  attach_view_part('/setup/templates/body/welcome.php', false);



// End If Statement
endif;


/** Get Footer */
attach_view_part('/setup/templates/footer/footer.php', false);
