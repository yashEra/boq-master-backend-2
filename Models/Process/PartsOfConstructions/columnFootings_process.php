<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: http://localhost:3000"); 
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Methods: POST, OPTIONS");

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

if($unit ==="feet"){

  $length = ($data->length)*0.3048;
  $width = ($data->width)*0.3048;
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
    "concrete" => round($cfootingobj->getTotalCostForConcrete(), 2),
    "reinforcement" => round($cfootingobj->getTotalCostForReinforcement(), 2),
    "formworks" => round($cfootingobj->getTotalCostForFrameWork(), 2),
    "concreteQuantity" => round($cfootingobj->getVolOfFootings(), 2),
    "reinforcementQuantity" => round($cfootingobj->getVolOfFootings(), 2),
    "formworksQuantity" => round($cfootingobj->getVolOfFootings(), 2),    
    "concreteUnitPrice" => $unitRateobj->getRatesOfConcreteOne(),
    "reinforcementUnitPrice" => $unitRateobj->getRatesOfRainforcement(),
    "formworksUnitPrice" => $unitRateobj->getRatesOfFormworks(),

);

echo json_encode($response);
?>
