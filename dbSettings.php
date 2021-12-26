<?php
abstract class dbSettings
{
    public $dbHost = 'localhost';
    public $dbUser = 'root';
    public $dbPass = '';
    public $dbName = 'crud';
    public function connect()
    {
        $conn = new mysqli($this->dbHost, $this->dbUser, $this->dbPass, $this->dbName);
        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        }
        return $conn;
    }
}
