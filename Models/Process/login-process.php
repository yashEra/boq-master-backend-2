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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userName = isset($_POST["userName"]) ? $_POST["userName"] : '';
    $password = isset($_POST["password"]) ? $_POST["password"] : '';

    try {
        $stmt = $conn->prepare("SELECT id, password, 'professional' as accountType FROM professional WHERE userName = :userName");
        $stmt->bindParam(':userName', $userName);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result && password_verify($password, $result['password'])) {
            $response = ['success' => true, 'id' => $result['id'], 'accountType' => $result['accountType'], 'type' => 'professional'];
        } else {
            $stmt = $conn->prepare("SELECT id, password, 'client' as accountType FROM client WHERE userName = :userName");
            $stmt->bindParam(':userName', $userName);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result && password_verify($password, $result['password'])) {
                $response = ['success' => true, 'id' => $result['id'], 'accountType' => $result['accountType'], 'type' => 'client'];
            } else {
                $response = ['success' => false, 'error' => 'Invalid username or password'];
            }
        }

        echo json_encode($response);
    } catch (PDOException $e) {
        $response = ['success' => false, 'error' => $e->getMessage()];
        echo json_encode($response);
    }
}
?>
