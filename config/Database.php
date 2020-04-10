<?php
class Database{
    // Database Parameters
    const DB_HOST = 'localhost';
    const DB_DBNAME = 'myblog';
    const DB_USERNAME = 'root';
    const DB_PASSWORD = '';
    private $pdo = null;

    // open database connection
    public function connect(){
        $dsn = sprintf("mysql:host=%s;dbname=%s", self::DB_HOST,  self::DB_DBNAME);
        try {
            $this->pdo = new PDO($dsn, self::DB_USERNAME, self::DB_PASSWORD);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection error: ".$e->getMessage());
        }
        return $this->pdo;
    }
    // close database connection
    public function __destruct(){
        $this->pdo = null;
    }
}
