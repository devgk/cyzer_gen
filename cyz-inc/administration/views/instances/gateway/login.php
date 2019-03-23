<?php

/** Include Apache HTACCESS setup file */
attach_controller('/login.php', 'gateway', true);


/** Attach Install View Header */
attach_view_part('/gateway/templates/header/header.php', false);


/** Get Welcome View Instance Template */
attach_view_part('/gateway/templates/body/login.php', false);


/** Get Footer */
attach_view_part('/gateway/templates/footer/footer.php', false);
?>
