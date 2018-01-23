<?php
require_once './config.php';
class Database
{
    private $conn;
    private static $instance;
    public static function getInstance()
    {
        if (!isset(Database::$instance)) {
            Database::$instance = new Database();
        }
        return Database::$instance;
    }

    private function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, USER, PASSWORD);
        } catch (Exception $e) {
            die("The following error has occured:" . $e);
        }
    }
    public function getConn(){
        return $this->conn;
    }
  
}
