<?php


/** Include Apache HTACCESS setup file */
attach_controller('/session-verify.php', 'gateway', true); 

// $string = file_get_contents("https://raw.githubusercontent.com/devgk/cyzer_gen/master/index.php");

// if(false != $string) read_comment($string, ['Version'])['Version'];

?>


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
