<?php
header("Content-Type: application/json");

header("Access-Control-Allow-Origin: http://localhost:3000");

header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Methods: POST, OPTIONS");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
  http_response_code(204);
  exit();
}

require_once '../../Classess/PartsOfConstructions/Walls.php';
require_once '../../Classess/PartsOfConstructions/UnitRates.php';

use RowMaterials\UnitRates;
use PartsOfConstructions\Walls;

// Get the posted data
$data = json_decode(file_get_contents("php://input"));


$unit = $data->unit;
$brickTypes = $data->brickTypes;
$type=$data->brickTypeOption;


if ($brickTypes =='cementBrick' || $brickTypes =='Cement Brick') {
  $type = 'N/A';
}

if($unit ==="ft"){

  $height = ($data->height)*0.3048;
  $length = ($data->length)*0.3048;

}else{
  $height = $data->height;
  $length = $data->length;
}
$fwallUnitRate = 1000;
// $rate = 999;
// echo $brickTypes;
$wallobj = new Walls($height, $length, $brickTypes, $type);
$ratesobj = new UnitRates();

$noOfBricks = $wallobj->getBricksQuantity();

// Process the data or perform necessary actions
$response = array(
  "message" => "Data received successfully",
  "description" => $wallobj->getWallDec(),
  "unitRate" => $ratesobj->getRateOfwall($brickTypes, $type),
  "area" =>$wallobj->getWallArea(),
  "wallFinishingCost" =>$wallobj->getWallArea()*$fwallUnitRate,
  "cost" => $wallobj->getWallCost(),
);



echo json_encode($response);
?>
