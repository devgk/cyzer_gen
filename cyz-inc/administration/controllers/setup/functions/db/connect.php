<?php

include_once(CYZ_LIB.'/db/init.php');

class cyz_db_test extends wee_db_prime{
  /**
   * List all tables names
   * @return array: Name of tables
   */
  static public function is_connected(){
    if(self::$is_connected) return true;
    else return false;
  }
}
