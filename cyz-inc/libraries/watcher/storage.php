<?php

/**
 * Watcher Storage: Keeps the record in array */
class watcher_storage{
  /** View Storage Variable */
  private $storage = array();

  /** Add view method */
  function update($key, $value){
    $storage[$key] = $value;
  }
}
