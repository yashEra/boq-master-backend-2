<?php
header("Content-Type: application/json");

// Allow requests from your React app's origin
header("Access-Control-Allow-Origin: http://localhost:3000"); // Update with your React app's URL

// Allow specific headers and methods
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Methods: POST, OPTIONS");

// Check for preflight (OPTIONS) request
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
  http_response_code(204);
  exit();
}

require_once '../../Classess/PartsOfConstructions/ColumnFootings.php';
use classes\ColumnFootings;

require_once '../../Classess/PartsOfConstructions/UnitRates.php';

use RowMaterials\UnitRates;

// Get the posted data
$data = json_decode(file_get_contents("php://input"));

$unit = $data->unit;

if($unit ==="ft"){

  $length = ($data->Length)*0.3048;
  $width = ($data->Width)*0.3048;
  $height = ($data->height)*0.3048;


}else{
  
  $length = $data->length;
  $width = $data->width;
  $height = $data->height; 
}

$cfootingobj = new ColumnFootings($length, $width, $height);
$unitRateobj = new UnitRates();

$response = array(
    "message" => "Data received successfully",
    "concrete" => $cfootingobj->getTotalCostForConcrete(),
    "reinforcement" => $cfootingobj->getTotalCostForReinforcement(),
    "formworks" => $cfootingobj->getTotalCostForFrameWork(),
    "concreteQuantity" => $cfootingobj->getVolOfFootings(),
    "reinforcementQuantity" => $cfootingobj->getVolOfFootings(),
    "formworksQuantity" => $cfootingobj->getVolOfFootings(),
    "concreteUnitPrice" => $unitRateobj->getRatesOfConcreteOne(),
    "reinforcementUnitPrice" => $unitRateobj->getRatesOfRainforcement(),
    "formworksUnitPrice" => $unitRateobj->getRatesOfFormworks(),

);

echo json_encode($response);
?>
