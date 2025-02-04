<?php

namespace Core;

class Database
{
    private static $host;
    private static $dbname;
    private static $username;
    private static $password;
    private static $pdo = null;

    public static function connect()
    {
        self::$host = $_ENV['DB_HOST'] ?? getenv('DB_HOST') ?? '127.0.0.1';
        self::$dbname = $_ENV['DB_NAME'] ?? getenv('DB_NAME') ?? 'GEPO';
        self::$username = $_ENV['DB_USERNAME'] ?? getenv('DB_USERNAME') ?? 'root';
        self::$password = $_ENV['DB_PASSWORD'] ?? getenv('DB_PASSWORD') ?? '';

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
