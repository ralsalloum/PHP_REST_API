<?php 
  class Database {
    // DB Params
    private $host;
    private $db_name;
    private $username;
    private $password;
    private $conn;


    // Constructor DB
    public function __construct($host, $db_name, $username, $password) {
      $this->host = $host;
      $this->db_name = $db_name;
      $this->username = $username;
      $this->password = $password;
    }

    // DB Connect
    public function connect() {
      $this->conn = null;

      try { 
        $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
        echo 'Connection Error: ' . $e->getMessage();
      }

      return $this->conn;
    }
  }