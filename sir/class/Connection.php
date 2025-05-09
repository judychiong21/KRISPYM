<?php

class connection
{
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbname = 'delivery';

    public function connect()
    {
        $stmt = new Mysqli(
            $this->host,
            $this->username,
            $this->password,
            $this->dbname
        );

        return $stmt;
    }
}
