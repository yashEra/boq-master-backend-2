<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json");

require_once '../../config/DbConnector.php';

$objDb = new DbConnector;
$conn = $objDb->getConnection();
$data = json_decode(file_get_contents("php://input"), true);

// if (!isset($data['userName']) || !isset($data['password'])) {
//     $response = ['success' => false, 'error' => 'Missing username or password'];
//     echo json_encode($response);
//     exit;
// }

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userName = isset($_POST["userName"]) ? $_POST["userName"] : '';
    $password = isset($_POST["password"]) ? $_POST["password"] : '';
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// $userName = $data['userName'];
// $password = $data['password'];
}

try {
    // Check in the professional table
    $stmt = $conn->prepare("SELECT id, 'professional' as accountType FROM professional WHERE userName = :userName AND password = :password");
    $stmt->bindParam(':userName', $userName);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $response = ['success' => true, 'id' => $result['id'], 'accountType' => $result['accountType'], 'type' => 'professional'];
    } else {
        // Check in the client table if not found in the professional table
        $stmt = $conn->prepare("SELECT id, 'client' as accountType FROM client WHERE userName = :userName AND password = :password");
        $stmt->bindParam(':userName', $userName);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $response = ['success' => true, 'id' => $result['id'], 'accountType' => $result['accountType'], 'type' => 'client'];
        } else {
            $response = ['success' => false, 'error' => $userName, 'error2' => $password];
        }
    }

    echo json_encode($response);
} catch (PDOException $e) {
    $response = ['success' => false, 'error' => $e->getMessage()];
    echo json_encode($response);
}
?>
