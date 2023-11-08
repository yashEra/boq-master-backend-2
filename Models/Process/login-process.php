<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

//require_once '../Classess/SystemUsers/Person.php';
require_once '../../config/DbConnector.php';

$objDb = new DbConnector;
$conn = $objDb->getConnection();

$user = $_POST;
$method = $_SERVER['REQUEST_METHOD'];

$userName = $user['userName'];
$password = $user['password'];

switch ($method) {
    case 'POST':
        $stmt = $conn->prepare("SELECT * FROM user WHERE userName = :userName AND password = :password;");
        $stmt->bindParam(':userName', $userName);
        $stmt->bindParam(':password', $password);
        $stmt->execute();


        if ($stmt->rowCount() > 0) {
            $response = ['success' => true, 'row'=>$stmt->rowCount()];
            //echo 10;
        } else {
            $response = ['success' => false];
        }

        echo json_encode($response);
        break;
}
