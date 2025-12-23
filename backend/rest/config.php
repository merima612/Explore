<?php
// Set the reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL ^ (E_NOTICE | E_DEPRECATED));


class Config
{
   public static function DB_NAME()
   {
       return 'explore_db'; 
   }
   
   public static function DB_PORT()
   {
       return 3306;
   }
   
   public static function DB_USER()
   {
       return 'root';
   }
   
   public static function DB_PASSWORD()
   {
       return ''; 
   }
   
   public static function DB_HOST()
   {
       return 'localhost'; 
   }
   
   public static function JWT_SECRET() {
       return 'merima_secret_key_webprogramming';
   }
}
/*
class Database {
   private static $host = 'localhost';
   private static $dbName = 'explore_db';
   private static $username = 'root';
   private static $password = 'root123';
   private static $port = '3307';
   private static $connection = null;


   public static function connect() {
       if (self::$connection === null) {
           try {
            self::$connection = new PDO(
                "mysql:host=" . self::$host . ";port=" . self::$port . ";dbname=" . self::$dbName,
                self::$username,
                self::$password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]
);

           } catch (PDOException $e) {
               die("Connection failed: " . $e->getMessage());
           }
       }
       return self::$connection;
   }
}
*/
?>