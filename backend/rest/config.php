<?php
// Set the reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL ^ (E_NOTICE | E_DEPRECATED));

class Config
{
   public static function DB_NAME() { return 'explore_db'; }
   public static function DB_PORT() { return 3307; }
   public static function DB_USER() { return 'root'; }
   public static function DB_PASSWORD() { return 'root123'; }
   public static function DB_HOST() { return '127.0.0.1'; } // Koristi 127.0.0.1 umjesto localhost
   public static function JWT_SECRET() { return 'merima_secret_key_webprogramming'; }
}
?>