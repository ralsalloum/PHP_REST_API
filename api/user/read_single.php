<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/User.php';

  // Instantiate DB & connect
  $database = new Database('localhost', 'api_db', 'root', '');
  $db = $database->connect();

  // Instantiate blog post object
  $user = new User($db);

  // Get ID
  $user->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get single user
  $user->read_single();

  // Create array
  $user_arr = array(
    'id' => $user->id,
    'firstname' => $user->firstname,
    'lastname' => $user->lastname,
    'phonenumber' => $user->phonenumber
  );

  // Make JSON
  print_r(json_encode($user_arr));