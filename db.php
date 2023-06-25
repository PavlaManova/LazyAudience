<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'demo');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

class Db {
    private $connection;
    
    public function __construct() {
        $dbhost = DB_HOST;
        $dbName = DB_NAME;
        $userName = DB_USER;
        $userPassword = DB_PASSWORD;
        $this->connection = new PDO("mysql:host=$dbhost;dbname=$dbName", $userName, $userPassword, [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }

    public function getConnection() {
        return $this->connection;
    }
}

$db = new Db();
$connection = $db->getConnection();
?>