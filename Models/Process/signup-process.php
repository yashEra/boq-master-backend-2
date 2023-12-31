<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

require_once '../Classess/SystemUsers/Person.php';

$data = json_decode(file_get_contents("php://input"), true);


$user = $_POST;
$method = $_SERVER['REQUEST_METHOD'];

$userName = $data['userName'];
$firstName = $data['firstName'];
$lastName = $data['lastName'];
$email = $data['email'];
$phoneNumber = $data['phoneNumber'];
$accountType = $data['accountType'];
$password = $data['password'];
$professionalType = $data['professionalType'];
$retypePassword = $data['retypePassword'];



switch ($method) {
    case 'POST':
         $person = new Person($userName, $firstName, $lastName, $email, $phoneNumber, $accountType, $professionalType, $password, $retypePassword);
         $status = $person->signup();

        if ($status =="processSuccess") {
            $response = ['success' => true, 'message' => 'Registration successfully.'];
        } else {
            $response = ['status' => 0, 'message' => 'Failed to Register.'];
        }
        echo json_encode($response);
        break;
}