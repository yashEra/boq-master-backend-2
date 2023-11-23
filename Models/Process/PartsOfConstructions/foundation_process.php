<?php
header("Content-Type: application/json");

header("Access-Control-Allow-Origin: http://localhost:3000"); 

header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Methods: POST, OPTIONS");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
  http_response_code(204);
  exit();
}

require_once '../../Classess/PartsOfConstructions/Foundation.php';

use classes\Foundation;

require_once '../../Classess/PartsOfConstructions/UnitRates.php';

use RowMaterials\UnitRates;

$data = json_decode(file_get_contents("php://input"));

$unit = $data->unit;
$qt = $data->noOfFoundation;

if($unit ==="feet"){

  $length = number_format(($data->length) * 0.3048, 2);
  $width = number_format(($data->width) * 0.3048, 2);
  $height = number_format(($data->height) * 0.3048, 2);
  


}else{
  
  $length = $data->length;
  $width = $data->width;
  $height = $data->height; 
}

$cobj = new Foundation($length, $width, $height, $qt);
$unitRateobj = new UnitRates();

$response = array(
  "message" => "Data received successfully",
  "concrete" => $cobj->getTotalCostForConcrete(),
  "reinforcement" => $cobj->getTotalCostForReinforcement(),
  "formworks" => $cobj->getTotalCostForFrameWork(),
  "concreteQuantity" => $cobj->getVolOfFoundation(),
  "reinforcementQuantity" => $cobj->getVolOfFoundation(),
  "formworksQuantity" => $cobj->getVolOfFoundation(),
  "concreteUnitPrice" => $unitRateobj->getRatesOfConcreteOne(),
  "reinforcementUnitPrice" => $unitRateobj->getRatesOfRainforcement(),
  "formworksUnitPrice" => $unitRateobj->getRatesOfFormworks(),

);



echo json_encode($response);
?>
