<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "boq_master";

$connection = mysqli_connect($host, $username, $password, $database);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    // $type = $_GET['type'];

    $query = "SELECT * FROM professional WHERE id = $id";

    $result = mysqli_query($connection, $query);

    if ($result) {
        $professionalData = mysqli_fetch_assoc($result);

        header('Content-Type: application/json');
        echo json_encode($professionalData);
    } else {
        echo json_encode(['error' => 'Error fetching professional profile data']);
    }
} else {
    echo json_encode(['error' => 'id and type parameters are required']);
}

mysqli_close($connection);
?>
