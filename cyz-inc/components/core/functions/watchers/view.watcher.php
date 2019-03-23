<?php


/**
 * View watcher keeps the record of all
 * the view names and types */
class view_watcher{
  /** View Storage Variable */
  private $view = array();

  /** Add view method */
  function add_view($view_name, $view_type){
    $this->view[$view_name] = $view_type;
  }

  function get_view_record(){
    return  $this->view;
  }
}


/** Create new app watcher object
 *  Set it as a global */
$view_watcher = new view_watcher;
global $view_watcher;

function define_view_type($view_name, $view_type = 'static'){
  // Use Global View Watcher
  global $view_watcher;

  // Add Static View Type
  if('static' == $view_type) $view_watcher->add_view($view_name, 'static');

  // Add Dynamic View Type
  elseif('dynamic' == $view_type) $view_watcher->add_view($view_name, 'dynamic');

  else return false;

  return true;
}
