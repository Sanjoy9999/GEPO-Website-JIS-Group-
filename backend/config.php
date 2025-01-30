<?php
$DB_SERVER = "localhost";
$DB_USERNAME = "root";
$DB_PASSWORD = "";
$DB_NAME = "gepodatabase";
$DB_PORT = "3306";

// Create connection
$conn = mysqli_connect($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_NAME, $DB_PORT);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "Connected successfully to the database.";
}

?>








<?php

class Database {
    private static $pdo = null;
    private static $host = "localhost";
    private static $dbname = "gepodatabase";
    private static $username = "root";
    private static $password = "";

    public static function connect() {
        if (self::$pdo === null) {
            try {
                self::$pdo = new \PDO("mysql:host=" . self::$host . ";dbname=" . self::$dbname . ";charset=utf8", self::$username, self::$password, [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,  // Enable exceptions
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC  // Fetch as associative array
                ]);
            } catch (\PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}

?>