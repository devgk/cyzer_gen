<?php

class cyz_json_db_base{
  /** Initialized Flag */
  private $initialized = false;

  /** DB file location */
  private $db_loc;

  // Constructor Function
  function __construct($name){
    if('APP_STARTED') {
      $dir = ABSPATH.'/cyz-gen/json-db/';

      // Set DB file location on memory
      if(empty($this->db_loc))
      $this->db_loc = $dir.$name.'.db.json';

      // Create DB if exists
      if($this->db_exits()){
        // Check if DB File is writable
        if(is_writable($this->db_loc)){
          // Set initialized flag to true
          $this->initialized = true;
        }
      } else {
        /** Remove any file with directory name */
        if(file_exists($dir)) unlink($dir);

        // Create Directory if does not exists
        if(!is_dir($dir)) mkdir($dir);

        // Check if DB Directory is writable
        if(is_writable($dir)){
          // Create Blank DB
          $db = $this->update_db();

          // Set initialized flag to true
          $this->initialized = true;
        }
      }
    }
  }

  /** Check function is safe to execute */
  Protected function safe_to_execute(){
    if(!$this->initialized) return array(
      'status' => false,
      'description' => 'Check directory permission. Unauthorised Access!'
    );
  }

  private function db_exits(){
    /** Check if this function is safe to execute */
    $this->safe_to_execute();

    if(file_exists($this->db_loc)) return true;
    else return false;
  }

  Protected function delete_db(){
    /** Check if this function is safe to execute */
    $this->safe_to_execute();

    if($this->db_exits()) unlink($this->db_loc);
    
    // incase error return false
    return false;
  }

  Protected function read_db(){
    /** Check if this function is safe to execute */
    $this->safe_to_execute();

    /** Open db in memory */
    $db = file_get_contents($this->db_loc);

    // Decode JSON and sve it into an array
    $db = json_decode($db, true);
    
    if(empty($db)) return null;
    else return $db;
  }

  Protected function update_db($data = null){
    /** Check if this function is safe to execute */
    $this->safe_to_execute();

    // If data is null, create blank data array
    if(empty($data)) $data = null;
    else $data = json_encode($data);

    // Open the db file to write updated content
    $db = @fopen($this->db_loc, "w");

    /** Check file is valid */
    if($db){
      @fwrite($db, $data);
      @fclose($db);

      /** File updated successfully => return true */
      return true;
    }

    // incase error return false
    return false;
  }
}
