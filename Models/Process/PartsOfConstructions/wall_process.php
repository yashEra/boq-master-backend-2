<?php

// use PartsOfConstructions\Walls;

header("Content-Type: application/json");

header("Access-Control-Allow-Origin: http://localhost:3000");

header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Methods: POST, OPTIONS");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
  http_response_code(204);
  exit();
}

require_once '../../Classess/PartsOfConstructions/Walls.php';

use PartsOfConstructions\Walls;

// Get the posted data
$data = json_decode(file_get_contents("php://input"));

// Example: Accessing the "height", "length", and "unit" fields
// $height = $data->height;
// $length = $data->length;
$unit = $data->unit;
$brickTypes = $data->brickTypes;

if($unit ==="ft"){

  $height = ($data->height)*0.3048;
  $length = ($data->length)*0.3048;

}else{
  $height = $data->height;
  $length = $data->length;
}

$wallobj = new Walls($height, $length, $brickTypes);

$noOfBricks = $wallobj->getBricksQuantity();

// Process the data or perform necessary actions
$response = array(
  "message" => "Data received successfully",
  "numberOfBricks" => $wallobj->getBricksQuantity(),
  "length" => $length,
  "unit" => $unit,
  "brickType" => $brickTypes,
  "CementKg" =>$wallobj->getcementQuantity(),
  "Sand" =>$wallobj->getSandQuantity(),
  "cost" => $wallobj->getWallCost()
);



echo json_encode($response);
?>
