<?php

/** Main DB Configuration file */
class wee_db_config{
    // Database Connection Details
    static protected $db_host = DB_HOST;
    static protected $db_name = DB_NAME;
    static protected $db_charset = DB_CHARSET;

    // Database Credentials
    static protected $db_username = DB_USERNAME;
    static protected $db_password = DB_PASSWORD;

    // PDO options
    static protected $pdo_options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
}
