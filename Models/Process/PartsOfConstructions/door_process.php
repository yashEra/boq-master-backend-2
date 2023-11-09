<?php
// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Methods: POST, OPTIONS");
// header("Access-Control-Allow-Headers: Content-Type");


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

$data = json_decode(file_get_contents("php://input"));
$doorType = $data->doorType;
$size = $data->size;
$quantity = $data->quantity;

$response = array('status' => '1','doorType' => $doorType, 'quantity' =>$quantity,'size'=>$size,'price' =>$quantity);
echo json_encode($response);
