<?php
include('Connection.php');

class Users extends Connection {
    public function register ($a, $b)
    {
        $hash = password_hash($b,PASSWORD_DEFAULT);

        $db = $this->connect();
        $stmt = $db->prepare("INSERT INTO users( username, password) VALUES (?,?)");
        $stmt->execute();
    }
}