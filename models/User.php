<?php 

include_once '../../config/DInterface.php';

  class User {
    // DB stuff
    private $conn;
    private $db;
    private $table = 'users';

    // User Properties
    public $id;
    public $firstname;
    public $lastname;
    public $phonenumber;

    // Constructor with DB
    public function __construct(ApiDbInterface $db) {
      $this->db = $db;
      $this->db->connect('localhost', 'api_db', 'root', '');
    }

    // Get Users
    public function read() {
      // Create query
      $query = 'SELECT * FROM ' . $this->table;
      
      // Prepare statement
      $stmt = $this->db->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single User
    public function read_single() {
          // Create query
          $query = 'SELECT * FROM ' . $this->table . '
                                    WHERE
                                      users.id = ?
                                    LIMIT 0,1';

          // Prepare statement
          $stmt = $this->db->conn->prepare($query);

          // Bind ID
          $stmt->bindParam(1, $this->id);

          // Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // Set properties
          $this->id = $row['id'];
          $this->firstname = $row['firstname'];
          $this->lastname = $row['lastname'];
          $this->phonenumber = $row['phonenumber'];
    }

    // Create User
    public function create() {
          // Create query
          $query = 'INSERT INTO ' . $this->table . ' SET firstname = :firstname, lastname = :lastname, phonenumber = :phonenumber';

          // Prepare statement
          $stmt = $this->db->conn->prepare($query);

          // Clean data
          //$this->id = htmlspecialchars(strip_tags($this->id));
          $this->firstname = htmlspecialchars(strip_tags($this->firstname));
          $this->lastname = htmlspecialchars(strip_tags($this->lastname));
          $this->phonenumber = htmlspecialchars(strip_tags($this->phonenumber));

          // Bind data
          //$stmt->bindParam(':id', $this->id);
          $stmt->bindParam(':firstname', $this->firstname);
          $stmt->bindParam(':lastname', $this->lastname);
          $stmt->bindParam(':phonenumber', $this->phonenumber);

          // Execute query
          if($stmt->execute()) {
            return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }
    
  }