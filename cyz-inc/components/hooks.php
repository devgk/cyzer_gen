<?php

// function add_action($type, $function_name){
// 	if('su-routing' == $type){
// 		global $SU_ROUTING;
// 		if(empty($SU_ROUTING)) $SU_ROUTING = array();
// 		array_push($SU_ROUTING, $function_name);
// 	}
// }

function add_route($slug, $instance){
  if(REQUEST_URI == $slug){
    require_once(CYZ_APP.$instance);
  }
}

function add_route_su($slug, $instance){
  if(REQUEST_URI == $slug){
    require_once(CYZ_VIEWS.$instance);
  }
}

function cyz_lib($file_path){
  require_once(CYZ_LIB.$file_path);
}

function get_view_resource_dir($folder_name = null){
  
  if(!empty($folder_name) && is_dir(CYZ_APP.'/'.$folder_name))
  return get_home_url().'cyz-app/'.$folder_name;

  else
  return get_home_url().'cyz-app/assets';
}
