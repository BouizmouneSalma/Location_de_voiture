<?php

class DatabaseConnection {
    private $host = "localhost";
    private $username = "root";
    private $password = "1234";
    private $database = "location_voiture";
    private $connection;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        } else {
            echo "Connection successful!";
        }
    }

    public function getConnection() {
        return $this->connection;
    }

    public function closeConnection() {
        if ($this->connection) {
            $this->connection->close();
            echo "Connection closed.";
        }
    }
}



?>
