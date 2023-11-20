<?php
header("Content-Type: application/json");

// Allow requests from React app's origin
header("Access-Control-Allow-Origin: http://localhost:3000"); // Update with React app's URL

// Allow specific headers and methods
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Methods: POST, OPTIONS");

// Check for preflight (OPTIONS) request
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
  http_response_code(204);
  exit();
}

require_once '../../Classess/PartsOfConstructions/Stairs.php';
use classes\Stairs;
require_once '../../Classess/PartsOfConstructions/UnitRates.php';

use RowMaterials\UnitRates;

// Get the posted data
$data = json_decode(file_get_contents("php://input"));

$unit = $data->unit;
$noOfSteps = $data->noOfSteps;

if($unit ==="ft"){

  $length = ($data->length)*0.3048;
  $riser = ($data->riser)*0.3048;

  $thread = ($data->thread)*0.3048;

  $width = ($data->width)*0.3048;
  $thickness = ($data->thickness)*0.3048;


}else{
  
  $length = $data->length;
  $riser = $data->riser;

  $thread = $data->thread;

  $width = $data->width;
  $thickness = $data->thickness;

  
}

$stairsobj = new Stairs($thickness, $length, $width, $riser, $thread, $noOfSteps);
$unitRateobj = new UnitRates();

$response = array(
  "message" => "Data received successfully",
  "concrete" => $stairsobj->concreteRate(),
  "reinforcement" => $stairsobj->rainforcementRate(),
  "formworks" => $stairsobj->formworkRate(),
  "concreteQuantity" => ($stairsobj->getStairsTotVol()+$stairsobj->getStairsCaseVol()),
  "reinforcementQuantity" => ($stairsobj->getStairsTotVol()+$stairsobj->getStairsCaseVol()),
  "formworksQuantity" => $stairsobj->getStairsCaseArea(),
  "concreteUnitPrice" => $unitRateobj->getRatesOfFormworks(),
  "reinforcementUnitPrice" => $unitRateobj->getRatesOfRainforcement(),
  "formworksUnitPrice" => $unitRateobj->getRatesOfFormworks(),

);



echo json_encode($response);
?>
