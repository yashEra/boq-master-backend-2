<?php
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'boq_master';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}


if (isset($_GET['action']) && $_GET['action'] === 'get_materials') {
    $sql = 'SELECT material_id, material_name, unit FROM raw_materials';
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $materials = array();
        while ($row = $result->fetch_assoc()) {
            $materials[] = $row;
        }
        echo json_encode($materials);
    } else {
        echo 'No materials found.';
    }
}


if (isset($_GET['action']) && $_GET['action'] === 'calculate_price') {
    $materialId = $_GET['material_id'];
    $quantity = $_GET['quantity'];

    $sql = "SELECT material_price FROM raw_materials WHERE material_id = $materialId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $materialPrice = $row['material_price'];

        $totalPrice = $materialPrice * $quantity;

        echo $totalPrice;
    } else {
        echo 'Material not found.';
    }
}

$conn->close();
?>
