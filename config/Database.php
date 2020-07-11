<?php 
include_once 'DInterface.php';

  class ApiDatabase implements ApiDbInterface{
    // DB Params
    protected $host;
    protected $db_name;
    protected $username;
    protected $password;
    public $conn;

    // DB Connect
    public function connect($host, $db_name, $username, $password) {
      $this->host = $host;
      $this->db_name = $db_name;
      $this->username = $username;
      $this->password = $password;
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

  $apiDB = new ApiDatabase();
  $apiDB->connect('localhost', 'api_db', 'root', '');
?>