<?php

use function PHPSTORM_META\type;

class DataBaseConnector
{

    private static $db;
    private $conn;
    private final function __construct()
    {
        $this->conn = mysqli_connect('localhost', 'root','', 'mydb');
            // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed");
        }
    }

    public static function getConnect()
    {
        
        if (!isset(self::$db)) {
            self::$db = new DataBaseConnector();
            
        }
        return self::$db->conn;
    }

}


?>