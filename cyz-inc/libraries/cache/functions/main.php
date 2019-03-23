<?php

class cyzer_cache{
    private $cache_handler;
    private $permission = false;
    private $cache_dir = CYZ_CONTENTS.'/cache/';

    function __construct(){
        /** File Operator Object */
        $this->cache_handler = new cyz_file_operator();

        /** Check write permission */
        $is_dir_writeable = $this->cache_handler->has_write_permission($config_dir);

        if($is_dir_writeable['status']){
            $this->permission = true;
        }
    }

    private function get_pattern($key){
        return 'CYZ'.(string)((int)$key + 1000).'-*.cache';
    }

    private function get_file(){
        // Get the key pattern
        $cache_pattern = $this->get_pattern($key);

        // Get cache file using key pattern
        return glob($this->cache_dir.$cache_pattern);
    }

    function set($key, $value, $life){
        $cache_files = $this->get_file($key);

        $cache_file = $cache_files[0];

        // clean garbage and unlink all the files
        for($i = 0; $i < sizeof($cache_files); $i++){
            if($i !== 0) @unlink($cache_files[$i]);
        }

        /** Create new/update htaccess file */
        $cache_updated = $this->cache_handler->cyz_update_file($file, $content);

        // cache exists
        if($cache_file){
            $cache_to_set = @fopen($cache_file, "w");

            if($cache_to_set){
                $cache_data = base64_encode($value);
                @fwrite($cache_to_set, $value);
                @fclose($cache_to_set);
            }
        }
    }

    function get($key){
        $cache_file = $this->get_file($key)[0];

        // cache exists
        if($cache_file){
            $cache = @fopen($cache_file, "rb");

            $cache_val = base64_encode( fread($cache, filesize("$cache_file")) );

            @fclose($cache);

            return $cache_val;
        }

        else return null;
    }
}
