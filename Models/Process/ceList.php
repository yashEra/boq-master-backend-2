<?php
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "boq_master";

error_reporting(E_ALL);
ini_set('display_errors', 1);


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM professional WHERE proType = 'CivilEngineer'";
$result = $conn->query($sql);

$professionals = array();

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $professionals[] = $row;
    }
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

echo json_encode($professionals);
?>
