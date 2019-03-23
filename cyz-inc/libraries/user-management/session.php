<?php

class cyz_user_session_base{
  /** User ID */
  private $user_id;
  /** User IP */
  private $user_ip;
  /** User's browser identity */
  private $browser_id;


  /** Session Cookie Variable name */
  private $cookie_name = 'CYZ_SU_CRED';
  /** Session Cookie Salt */
  private $cookie_salt;


  /** PHP Session Variable */
  private $session_variable = 'CYZ_SU_CRED';


  /** Base Constructor Function */
  function __construct(){
    // Set IP
    $this->user_ip = $this->get_ip();

    // Set SU Agent
    $this->browser_id = cyz_base64_encode($_SERVER['HTTP_USER_AGENT']);
  }


  /** Get user IP address */
  private function get_ip(){
		if (     getenv('HTTP_CLIENT_IP')       ) return getenv('HTTP_CLIENT_IP');
		else if( getenv('HTTP_X_FORWARDED_FOR') ) return getenv('HTTP_X_FORWARDED_FOR');
		else if( getenv('HTTP_X_FORWARDED')     ) return getenv('HTTP_X_FORWARDED');
		else if( getenv('HTTP_FORWARDED_FOR')   ) return getenv('HTTP_FORWARDED_FOR');
		else if( getenv('HTTP_FORWARDED')       ) return getenv('HTTP_FORWARDED');
		else if( getenv('REMOTE_ADDR')          ) return getenv('REMOTE_ADDR');
		return 'UNKNOWN';
  }


  /** Set Cookie Salt */
  private function set_cookie_salt(){
    /** Encoded time as cookie salt */
    $this->cookie_salt = cyz_base64_encode('cyz_session_salt'.time());
  }


  /** Get Cookie Salt */
  function get_cookie_salt(){
    return $this->cookie_salt;
  }


  /** Create cookie for first time */
  private function create_cookie($value, $remember){

    /** If remember me flag is true than set cookie for 30 days
     *  else set it fot five minute */
    if(true === $remember) $cookie_time = time() + 2592000;
    else $cookie_time = time() + 300;

    // Set Domain
    $domain = $_SERVER['HTTP_HOST'];

    // Set cookie as secure
    $secure = (isset($_SERVER['HTTPS']) ? 1 : 0);
    
    // Create Cookie
    setcookie($this->cookie_name, $value, $cookie_time, "/", $domain, $secure);
  }


  /** Get Cookie Data */
  function get_cookie(){
    /**
     * check cookie exits and
     * return cookie data in array */
    if(isset($_COOKIE[$this->cookie_name])) return explode('&&', $_COOKIE[$this->cookie_name]);

    /** Return false in case of error */
    return false;
  }


  /** Extends Cookie Time
   * @param: Cookie Time in minute */
  private function extend_cookie_life($cookie_time = null){
    // Check cookie exists return null if does not
    if(isset($_COOKIE[$this->cookie_name])) return null;

    // Fetch Cookie Value
    $value = $_COOKIE[$this->cookie_name];

    /** Extend cookie lifetime for 5Min if cookie expiration
     *  time is not provided
     *  else extend cookie time as provided */
    if(null == $cookie_time) $cookie_time = 300;
    else $cookie_time = time() + (60 * $cookie_time);

    // Set Domain
    $domain = '"'.$_SERVER['HTTP_HOST'].'"';

    // Set cookie as secure
    $secure = (isset($_SERVER['HTTPS']) ? 1 : 0);

    // Create Cookie
    setcookie($this->cookie_name, $value, $cookie_time, "/", $domain, $secure);
  }


  /** Delete cookie on session exit */
  private function delete_cookie(){
    // Check cookie exists return null if does not
    if(isset($_COOKIE[$this->cookie_name])) return null;

    // Set Cookie Expiry to past
    $cookie_time = time() - 3600;

    // Set Domain
    $domain = '"'.$_SERVER['HTTP_HOST'].'"';

    // Set cookie as secure
    $secure = (isset($_SERVER['HTTPS']) ? 1 : 0);

    // Create Cookie
    setcookie($this->cookie_name, '', $cookie_time, "/", $domain, $secure);
  }


  /** Update session IP in  PHP Session */
  function update_ip(){
    // Get PHP Session DATA
    $session_data = $_SESSION[$this->session_variable];

    // Phrase Session data - Set it into sda AKA Session Data Array
    $sda = explode('&&', $session_data);

    // Create new Session DATA
    $new_session_data = $sda[0].'&&'.$this->user_ip.'&&'.$sda[2];

    // Set new session data
    $_SESSION['CYZ_SU_CRED'] = $new_session_data;

    // Regenerate Session
    session_regenerate_id();
  }


  /** Create New Session */
  function create_session($username, $password, $remember){
    // Set Super Encoded User Name and SU ID
    $this->user_id = cyz_base64_encode($username);

    // Set Password - Double Encrypted
    $this->su_pass = md5($password);

    // Set Remember Flag
    $remember = ($remember ? true : false);

    // Set Cookie Salt
    $this->set_cookie_salt();

    // Set cookie expiry data
    if($remember) $end_of_cookie = '30DAYS';
    else $end_of_cookie = 'TEMP';
    
    // Set cookie data
    $cookie_val = $this->user_id.'&&'.$this->su_pass.'&&'.$this->cookie_salt.'&&'.$end_of_cookie;

    // Create Cookie
    $this->create_cookie($cookie_val, $remember);

    // Start PHP Session
    if(session_status() == PHP_SESSION_NONE) session_start();

    // Save Session Data in PHP Session
    $_SESSION[$this->session_variable] = $this->browser_id.'&&'.$this->user_ip.'&&'.$this->user_id;
  }


  /** Session Verification */
  function verify_session(){
    // Start PHP Session
    if(session_status() == PHP_SESSION_NONE) session_start();

    // Check PHP Session Data
    if(!empty($_SESSION[$this->session_variable])){
      // Get PHP Session DATA
      $session_data = $_SESSION[$this->session_variable];

      // Regenerate Session
      session_regenerate_id();
    }
    // Return false in case session data is empty
    else return false;

    // Phrase Session data
    $session_data_array = explode('&&', $session_data);

    // Return false if user agent (Browser Spec) does not match
    if($this->browser_id != $session_data_array[0]) return false;

    // Get Cookie Data
    $cookie_data = $this->get_cookie();

    /** Return false if cookie does not exits */
    if(false === $cookie_data) return false;

    // Extend Cookie
    if('30DAYS' == $cookie_data[3]) $this->extend_cookie_life(43200);
    elseif('TEMP' == $cookie_data[3]) $this->extend_cookie_life();
    
    // Check if IP has changed
    if($this->user_ip != $session_data_array[1]) return 'IP CHANGED';

    // Return user id
    return $session_data_array[2];
  }


  /** Delete Session */
  function delete_session(){
    // Delete SU CRED cookie created
    $this->delete_cookie();

    // Start PHP Session
    if(session_status() == PHP_SESSION_NONE) session_start();

    // Empty session variable
    $_SESSION[$this->session_variable] = null;
  }
}
