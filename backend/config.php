<?php
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
            echo "Connection finished!";
           } catch (PDOException $e) {
               die("Connection failed: " . $e->getMessage());
           }
       }
       return self::$connection;
   }
}
?>