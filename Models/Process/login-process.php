<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json");

require_once '../../config/DbConnector.php';

$objDb = new DbConnector;
$conn = $objDb->getConnection();

// Assuming data is sent in JSON format
$data = json_decode(file_get_contents("php://input"), true);

// Check if required fields are provided
if (!isset($data['userName']) || !isset($data['password'])) {
    $response = ['success' => false, 'error' => 'Missing username or password'];
    echo json_encode($response);
    exit;
}

$userName = $data['userName'];
$password = $data['password'];

try {
    $stmt = $conn->prepare("SELECT id FROM client WHERE userName = :userName AND password = :password");
    $stmt->bindParam(':userName', $userName);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    // Fetch the result as an associative array
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $response = ['success' => true, 'id' => $result['id']];
    } else {
        $response = ['success' => false, 'error' => 'Invalid username or password'];
    }

    echo json_encode($response);
} catch (PDOException $e) {
    $response = ['success' => false, 'error' => $e->getMessage()];
    echo json_encode($response);
}
?>
