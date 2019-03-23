<?php

// Create new user session object
$user_session = new cyz_user_session('SU', true);

// Logout User
$user_session->logout();
