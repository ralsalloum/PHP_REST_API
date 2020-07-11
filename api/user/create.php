<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/User.php';

  // Instantiate DB & connect
  $database = new Database('localhost', 'api_db', 'root', '');
  $db = $database->connect();
  //$db2 = Database()->conncet()

  // Instantiate blog post object
  $user = new User($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  //$user->id = $data->id;
  $user->firstname = $data->firstname;
  $user->lastname = $data->lastname;
  $user->phonenumber = $data->phonenumber;

  // Insert one user
  if($user->create()) {
    echo json_encode(
      array('message' => 'User Created')
    );
  } else {
    echo json_encode(
      array('message' => 'User Not Created')
    );
  }

