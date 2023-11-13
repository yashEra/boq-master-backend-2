<?php

use RowMaterials\Windows;
require_once '../../Classess/PartsOfConstructions/Windows.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

$data = json_decode(file_get_contents("php://input"));

$windowTypeId = isset($_POST['windowTypeId']) ? $_POST['windowTypeId'] : null;

$windowTypeId = isset($data->windowTypeId) ? $data->windowTypeId : null;


// $id = $windowTypeId;
$windowType = $data->windowType;
$size = $data->size;
$quantity = $data->quantity;

$window = new Windows($windowTypeId, $size, $quantity);

$price = $window->priceOfWindows();
$area = $window->areaOfWindows();

$response = array('status' => '1', 'area' => $area, 'windowType' => $windowType, 'quantity' => $quantity, 'size' => $size, 'price' => $price);
echo json_encode($response);
?>
