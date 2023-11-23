<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: http://localhost:3000"); 
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Methods: POST, OPTIONS");
$data = json_decode(file_get_contents("php://input"), true);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "boq_master";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// $input = $_POST; 
// $selectedDescription = $data->type;
// echo $selectedDescription;

$sql = "SELECT * FROM roof WHERE description = 'Roof Max Roofing Sheet'";
$stmt = $conn->prepare($sql);
// $stmt->bind_param("s", "Roof Max Roofing Sheet");
$stmt->execute();
$result = $stmt->get_result();

if ($result) {
    $selectedRoof = $result->fetch_assoc();

    // $quantity = $data->quantity;
    $quantity = 100;

    $totalPrice = $quantity * $selectedRoof['rate'];

    $response = [
        'description' => $selectedRoof['description'],
        'rate' => $selectedRoof['rate'],
        'quantity' => $quantity,
        'totalPrice' => $totalPrice,
    ];

    echo json_encode($response);
} else {
    echo json_encode(['error' => 'Roofing sheet not found']);
}

$stmt->close();
$conn->close();

?>
