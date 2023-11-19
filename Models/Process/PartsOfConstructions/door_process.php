<?php

use RowMaterials\Doors;
require_once '../../Classess/PartsOfConstructions/Doors.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

$data = json_decode(file_get_contents("php://input"));

$doorTypeId = isset($_POST['doorTypeId']) ? $_POST['doorTypeId'] : null;

$doorTypeId = isset($data->doorTypeId) ? $data->doorTypeId : null;


// $id = $windowTypeId;
$doorType = $data->doorType;
$material= $data->material;
$quantity = $data->quantity;

$door = new Doors($doorTypeId, $material, $quantity);

$price = $door->priceOfDoor();
$area = $door->areaOfDoor();

$response = array('status' => '1', 'area' => $area, 'doorType' => $doorType, 'quantity' => $quantity, 'material' => $material, 'price' => $price);
echo json_encode($response);
?>