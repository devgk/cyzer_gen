<?php


/** Include URL Fetcher to fetch URLs */
require_once(CYZ_LIB.'/json_db/main.php');


/** Initialize APP JSON DB Object */
$app_json_db = new cyz_json_db('app');


/** Setting Global - APP JSON DB Object */
global $app_json_db;


/** Get app data from JSON DB */
function get_app_data($table_name){
  /** Using Global - APP JSON DB Object */
  global $app_json_db;

  return $app_json_db->get_rows($table_name);
}


/** Add app data to JSON DB */
function update_app_data($table_name, $table_data){
  /** Using Global - APP JSON DB Object */
  global $app_json_db;

  return $app_json_db->update_table($table_name, $table_data);
}
