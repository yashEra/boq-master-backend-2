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

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT * FROM windows_sizes";
$result = mysqli_query($conn, $query);

$windowSizes = [];

while ($row = mysqli_fetch_assoc($result)) {
    $windowSizes[] = $row;
}

echo json_encode($windowSizes);

mysqli_close($conn);
?>
