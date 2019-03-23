<?php


/** Include Apache HTACCESS setup file */
attach_controller('/session-verify.php', 'gateway', true); 

download_cyz_zip(); ?>


<!-- Attach SU Panel Header -->
<?php attach_view_part('/panel/templates/header/header.php', false); ?>


<div class="content-base">

  <!-- Attach SU Panel Navigation -->
  <?php attach_view_part('/panel/templates/header/nav.php', false); ?>
  
  <!-- Attach SU Panel Body -->
  <?php attach_view('/panel/templates/dashboard/body.php', false); ?>

</div>


<!-- Attach SU Panel Footer -->
<?php attach_view_part('/panel/templates/footer/footer.php', false);

if(isset($_GET['maintenance']) && 'yes' == $_GET['maintenance']){
  enable_maintenance();
}
