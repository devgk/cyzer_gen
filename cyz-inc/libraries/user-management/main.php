<?php

require_once(CYZ_LIB.'/user-management/session.php');

class cyz_user_session extends cyz_user_session_base{
  /** DB Type */
  private $db_type;
  /** DB Table Name */
  private $table_name;
  /** DB Salt Field Name */
  private $db_salt = 'su_login_salt';


  /** Main constructor function */
  function __construct($db_table_name,  $db_type = false){
    /** Call parent Constructor */
    parent::__construct();

    /** Setting up database type */
    if(true == $db_type) $this->db_type = 'json_db';
    else $this->db_type = 'sql_db';

    /** Setting up table name */
    if(isset($db_table_name)) $this->table_name = $db_table_name;
  }


  /** Create New Session */
  function create_session($username, $password, $remember){

    // Super User Session Management
    if('json_db' == $this->db_type && 'SU' == $this->table_name) {
      $user_db = new cyz_json_db('su');

      // get all super user data
      $users_data = $user_db->get_rows($this->table_name);

      foreach($users_data as $key => $user_data){
        if($username == $user_data['su_username']){

          // Encrypt password hash
          $password = md5($password);

          /**
           * Compare password hash
           * return false if password hash comparison fails */
          if($password != $user_data['su_password']) return array(
            'status'      => false,
            'description' => 'Password does not match!'
          );

          // Create new super user session
          parent::create_session($username, $password, $remember);
    
          // Update DB with session salt
          $user_db->update_column(
            $this->table_name, $key,
            $this->db_salt,
            parent::get_cookie_salt()
          );
    
          // Close DB connection
          $user_db = null;
    
          return array(
            'status'      => true,
            'description' => 'Success'
          );
        }
      }

      return array(
        'status'      => false,
        'description' => 'Superuser does not exits!'
      );
    }

    return array(
      'status'      => false,
      'description' => 'Wrong configuration'
    );
  }


  /** Verify Session */
  function verify_session(){
    $user_id = parent::verify_session();

    /** User ID not valid
     *  Destroy session and logout */
    if(false === $user_id) return false;

    if('IP CHANGED' == $user_id){

      // Get Cookie Data
      $cookie_data = parent::get_cookie();

      // If cookie is not set or does not exits return false 
      if(!isset($cookie_data) || !is_array($cookie_data)) return false;

      /** User ID */
      $user_id = $cookie_data[0];
      /** User Password [Double Encrypted] */
      $password = $cookie_data[1];
      /** Cookie session salt */
      $salt = $cookie_data[2];

      // Super User Session Management
      if('json_db' == $this->db_type && 'SU' == $this->table_name) {
        $user_db = new cyz_json_db('su');

        // get all super user data
        $users_data = $user_db->get_rows($this->table_name);

        foreach($users_data as $key => $user_data){

          // Check user ID
          if($user_id != cyz_base64_encode($user_data['su_username'])) return false;

          // Check password
          if($password != md5($user_data['su_password'])) return false;

          // Check session salt
          if($salt != $user_data['su_login_salt']) return false;

          // Set user ID
          if(!defined('SU_ID')) define('SU_ID', $user_id);

          // Update User IP
          parent::update_ip();

          // Return true
          return $user_id;
        }
      }
    }

    else{
      // Set user ID
      if(!defined('SU_ID')) define('SU_ID', $user_id);

      // Return User ID
      return $user_id;
    }

    // return false in case error
    return false;
  }

  function logout($slug = null){
    // Something went wrong
    if(!defined('SU_ID')) define('SU_ID', null);

    // Delete Session
    parent::delete_session();

    // redirect
    if(isset($slug)) header("Location: ".get_home_url().$slug);
    else header("Location: ".get_home_url());
    exit;
  }
}
