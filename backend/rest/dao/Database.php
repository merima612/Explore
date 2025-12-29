<?php
// Učitavamo config.php koji se nalazi u folderu iznad
require_once(__DIR__ . "/../config.php");

class Database {
    private static $connection = null;

    /**
     * Kreira i vraća PDO konekciju na bazu podataka.
     * Koristi port 3307 jer je tvoj XAMPP tako konfigurisan.
     */
    public static function connect() {
        if (self::$connection === null) {
            try {
                // Definišemo DSN sa portom 3307 i charsetom za podršku našim slovima (č, ć, đ...)
                $dsn = "mysql:host=" . Config::DB_HOST() . 
                       ";port=3307" . 
                       ";dbname=" . Config::DB_NAME() . 
                       ";charset=utf8mb4";
                
                // Kreiramo novu PDO instancu
                self::$connection = new PDO(
                    $dsn, 
                    Config::DB_USER(), 
                    Config::DB_PASSWORD(), 
                    [
                        // Postavljamo PDO da izbacuje Exception u slučaju greške
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        // Postavljamo da defaultni rezultat bude asocijativni niz
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        // Isključujemo emulaciju pripremljenih izvještaja zbog sigurnosti
                        PDO::ATTR_EMULATE_PREPARES => false
                    ]
                );
            } catch (PDOException $e) {
                // Ako konekcija ne uspije, šaljemo JSON odgovor umjesto običnog teksta
                header('Content-Type: application/json');
                http_response_code(500);
                
                echo json_encode([
                    "error" => "Baza podataka nije dostupna",
                    "details" => $e->getMessage(),
                    "code" => $e->getCode()
                ]);
                
                // Zaustavljamo dalju skriptu kako ne bi bilo dodatnog teksta u odgovoru
                exit;
            }
        }
        return self::$connection;
    }
}
?>