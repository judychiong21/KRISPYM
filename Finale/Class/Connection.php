<?php

class Connection {
    private $host = 'localhost';
    private $username = 'root';  
    private $password = '';
    private $dbname = 'krispym';
    
    protected function connect() {
        $conn = new mysqli($this->host, 
        $this->username, 
        $this->password, 
        $this->dbname);

        
        if ($conn->connect_error) {
            die("connection failed: " . $conn->connect_error);
        }

        return $conn;
    }
}
?>



















































































<?php 

$sName = "localhost";
$uName = "root";
$pass = "";
$db_name = "krispym";

try {
    $conn = new PDO("mysql:host=$sName;dbname=$db_name", 
                    $uName, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
  echo "Connection failed : ". $e->getMessage();
}
?>