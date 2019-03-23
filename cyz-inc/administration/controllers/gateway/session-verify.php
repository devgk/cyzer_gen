<?php

// Create new user session object
$user_session = new cyz_user_session('SU', true);

/** If verification fails */
if(false == $user_session->verify_session()){
  // Logout User
  $user_session->logout('/su-panel/login');
}
