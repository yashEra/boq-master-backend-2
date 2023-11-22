<?php
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json");

// Assuming you have a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "boq_master";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['pro_id'];

$sql = "SELECT * FROM portfolio WHERE pro_id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $architect = $result->fetch_assoc();
    echo json_encode($architect);
} else {
    echo json_encode(['error' => 'Architect not found']);
}

$conn->close();
?>
