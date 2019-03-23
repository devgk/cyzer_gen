<?php

include_once(CYZ_LIB.'/db/core.php');

/** DB Connect and disconnect object */
class wee_db_prime extends wee_db_config{
    static protected $connection_obj;
    static protected $is_connected;

    static public function connect(){
        // Variables
        $db_host = self::$db_host;
        $db_name = self::$db_name;
        $db_charset = self::$db_charset;
        $db_username = self::$db_username;
        $db_password = self::$db_password;

        // Data Source Name
        $pdo_dsn = "mysql:host=$db_host;dbname=$db_name;charset=$db_charset";
        $pdo_options = self::$pdo_options;

        try {
            self::$connection_obj = new PDO($pdo_dsn, $db_username, $db_password, $pdo_options);
            self::$is_connected = true;
        } catch (\PDOException $e) {
            // throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    static public function disconnect(){
        self::$connection_obj = null;
        self::$is_connected = false;
    }
}
