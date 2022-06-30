<?php

class Database{
    public $conn;

    function __construct(){
        try {
            $conn = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER_NAME, DB_PASSWORD);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn = $conn;
        } catch(PDOException $e) {
            $result['message'] = "Error Connect Database: " . $e->getMessage();
            $response= new Output();
            $response->out($result, 500);
        }

    }

}
?>