<?php

require_once(CYZ_LIB.'/json_db/base.php');

class cyz_json_db extends cyz_json_db_base{
  /** Call parent Constructor */
  function __construct($name){
    parent::__construct($name);
  }


  private function get_index($value){
    if(isset($value)){
      $in_type = gettype($value);
      if($in_type == "integer"){
        if(0 <= $value){
          return $value;
        }
      }
    }
    
    return null;
  }


  /** Check table exists or not
   * 
   * @return
   *  --> true    If table exists
   *  --> false   If table does not exists  */
  function table_exists($table_name){
    // read db
    $db = parent::read_db();

    // If DB is empty return false
    if(empty($db)) return false;

    // Loop through DB
    foreach($db as $table => $table_value){

      // Check Particular Table
      if($table == $table_name) return true;
    }

    // incase error return false
    return false;
  }


  /** Update / Add table
   * 
   * @param
   *  --> table_name
   *  --> table data: optional (Creates blank table)
   * 
   * @return
   *  --> true    If true on success
   *  --> false   Incase Error */
  function update_table($table_name, $table_data = null){
    // read db
    $db = parent::read_db();

    // If DB is empty, Initialize it as a blank array 
    if(empty($db)) $db = array();

    // Update Flag - Marks the change to DB
    $update_flag = false;

    // Loop through DB
    foreach($db as $table => $table_value){
      // If table exists
      if($table == $table_name){
        // Table is already updated - If table data not provided
        if(empty($table_data)) return true;

        // Update Table - If table data is provided
        else {
          // Update DB array
          $db[$table_name] = $table_data;

          // Change update flag
          $update_flag = true;
        }
      }
    }

    // If DB is does not exists previously
    // Update DB using new key value pair
    if(false === $update_flag) $db[$table_name] = $table_data;

    // update db
    if(parent::update_db($db)) return true;

    // incase error return false
    return false;
  }


  /** Delete Table
   * 
   * @param
   *  --> table_name */
  function delete_table($table_name){ 
    // check table exists
    if($this->table_exists($table_name)){
      // Read db
      $db = $this->read_db();

      // Deleted particular table
      unset($db[$table_name]);

      // update db
      if($this->update_db($db));
    }
  }


  /** Get all rows inside the table
   * 
   * @param
   *  --> table_name
   * 
   * @return
   *  --> data    On success
   *  --> false   Incase Error */
  function get_rows($table_name){
    // Check if table exists
    // Return null if table does not exists
    if(false === $this->table_exists($table_name)) return null;

    // read db
    $db = $this->read_db();

    // return table data
    return $db[$table_name];
  }


  /** Get row data at index
   * 
   * @param
   *  --> table_name
    * --> row_index
   * 
   * @return
   *  --> data    On success
   *  --> false   Incase Error */
  function get_row_at($table_name, $row_index){    
    // Check if table exists
    // Return null if table does not exists
    if(false == $this->table_exists($table_name)) return null;

    // Read db
    $db = $this->read_db();

    // return row data set at index
    return $db[$table_name][$row_index];
  }


  /** Update row data at index
   * 
   * @param
   *  --> table_name
   * 
   * @return
   *  --> data    On success
   *  --> false   Incase Error */
  function update_row($table_name, $row_index, $column_data){
    // Get row index filtered value
    $row_index = $this->get_index($row_index);

    // Check if table exists
    if(false == $this->table_exists($table_name)) return false;

    // Read db
    $db = parent::read_db();

    // If DB is empty, Initialize it as a blank array 
    if(empty($db)) $db = array();

    // Update Flag - Marks the change to DB
    $update_flag = false;

    // Loop through DB
    foreach($db as $table => $table_value){
      // If table exists
      if($table == $table_name){

        // Add column - if table is empty
        if(empty($table_value)){
          // Enter first row / Column data to table
          $db[$table_name] = array();
          array_push($db[$table_name], $column_data);

          // Change update flag
          $update_flag = true;
        } else {
           // Loop through DB, if table value exists
          foreach($table_value as $row => $column_data_set){
            // Check if row index exists
            if(isset($row_index) && $row_index == $row){
              // Update the column data at the specified row index
              $db[$table_name][$row_index] = $column_data;

              // Change update flag
              $update_flag = true;
            }
          }
        }

        // If row index does not exists, and DB is not updated
        // Push the row / column data to the end
        if(false === $update_flag) array_push($db[$table_name], $column_data);

        // update db
        if(parent::update_db($db)) return true;
      }
    }

    // incase error return false
    return false;
  }

  function delete_row($table_name, $row_index){
    // Get row index filtered value
    $row_index = $this->get_index($row_index);

    if($this->table_exists($table_name)){
      // Read DB
      $db = parent::read_db();

      // Deleted particular table
      foreach($db as $table => $row){
        if($table == $table_name && isset($row_index)) {
          $new_array = array();

          for($var = 0; $var < count($db[$table_name]); $var++){
            if($var != $row_index) array_push($new_array, $db[$table_name][$var]);
          }

          // Deleted particular row index inside the table
          $db[$table_name] = $new_array;

          // update db
          if(parent::update_db($db));
        }
      }
    }
  }

  function get_column_data($table_name, $row_index, $column_key){    
    // Check if table exists
    if(false == $this->table_exists($table_name)) return null;

    // Read db
    $db = $this->read_db();

    // Loop through DB
    foreach($db as $table => $row){
      if($table == $table_name){

        foreach($row as $row_pointer => $column){
          if($row_pointer == $row_index){

            foreach($column as $column_pointer => $value){

              // Check if data column key exists in DB
              if($column_pointer == $column_key) return $value;
            }
          }
        }
      }
    }

    return null;
  }

  function update_column($table_name, $row_index, $column_key, $column_data){
    // Get row index filtered value
    $row_index = $this->get_index($row_index);

    // Check if table exists
    if(false == $this->table_exists($table_name)) return false;

    // Read db
    $db = parent::read_db();

    // If DB is empty, Initialize it as a blank array 
    if(empty($db)) $db = array();

    // Update Flag - Marks the change to DB
    $update_flag = false;

    // Loop through DB
    foreach($db as $table => $table_value){
      // If table exists
      if($table == $table_name){

        // Add column - if table is empty
        if(empty($table_value)){
          // Enter first row / Column data to table
          $db[$table_name] = array();

          array_push($db[$table_name], array(
            $column_key => $column_data
          ));

          // Change update flag
          $update_flag = true;
        } else {
            // Loop through DB, if table value exists
          foreach($table_value as $row => $column_data_set){
            // Check if row index exists
            if(isset($row_index) && $row_index == $row){
              // Update the column data at the specified row index
              $db[$table_name][$row_index][$column_key] = $column_data;

              // Change update flag
              $update_flag = true;
            }
          }
        }

        // If row index does not exists, and DB is not updated
        // Push the row / column data to the end
        if(false === $update_flag) array_push($db[$table_name], array(
          $column_key => $column_data
        ));

        // update db
        if(parent::update_db($db)) return true;
      }
    }

    // incase error return false
    return false;
  }

  function delete_column($table_name, $row_index, $column_key){
    // Get row index filtered value
    $row_index = $this->get_index($row_index);

    if($this->table_exists($table_name)){
      // Read db
      $db = parent::read_db();

      // Loop through DB
      foreach($db as $table => $row){
        if($table == $table_name){

          foreach($row as $row_pointer => $column){
            if($row_pointer == ($row_index)){
              foreach($column as $column_pointer => $value){
                if($column_pointer == $column_key){
                  // Deleted particular table
                  unset($db[$table_name][$row_index][$column_key]);

                  // update db
                  if(parent::update_db($db));
                }
              }
            }
          }
        }
      }
    }
  }
}
