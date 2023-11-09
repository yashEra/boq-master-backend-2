<?php
// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Methods: POST, OPTIONS");
// header("Access-Control-Allow-Headers: Content-Type");


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

$data = json_decode(file_get_contents("php://input"));
$windowType = $data->windowType;
$size = $data->size;
$quantity = $data->quantity;

$response = array('status' => '1','windowType' => $windowType, 'quantity' =>$quantity,'size'=>$size,'price' =>$quantity);
echo json_encode($response);
