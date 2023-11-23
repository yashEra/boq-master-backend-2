<?php
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "boq_master";

$your_db_connection = mysqli_connect($servername, $username, $password, $dbname);

if (!$your_db_connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT * FROM Client";
$result = mysqli_query($your_db_connection, $query);

$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

mysqli_close($your_db_connection);

echo json_encode($data);
?>

