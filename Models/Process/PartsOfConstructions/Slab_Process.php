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

require_once '../../Classess/PartsOfConstructions/Slabs.php';
use classes\Slabs;

require_once '../../Classess/PartsOfConstructions/UnitRates.php';

use RowMaterials\UnitRates;

// Get the posted data
$data = json_decode(file_get_contents("php://input"));

$unit = $data->unit;

if($unit ==="feet"){

  $length = ($data->length)*0.3048;
  $width = ($data->width)*0.3048;
  $thickness = ($data->thickness)*0.3048;


}else{
  
  $length = $data->length;
  $width = $data->width;
  $thickness = $data->thickness; 
}

$slabobj = new Slabs($length, $width, $thickness);
$unitRateobj = new UnitRates();

$response = array(
  "concreteCost" => round($slabobj->getTotalCostForConcrete(), 2),
  "formworksCost" => round($slabobj->getTotalCostForFrameWork(), 2),
  "reinforcementCost" => round($unitRateobj->getRatesOfRainforcement() * $slabobj->getSqOfSlab(), 2),
  "area" => round($slabobj->getSqOfSlab(), 2),
  "volume" => round($slabobj->getVolOfSlab(), 2),  
  "descriptionConcrete" => $unitRateobj->getDecOConcrete(),
  "descriptionFormworks" => $unitRateobj->getDecOFrameWork(),
  "unitC" => $unitRateobj->getRateOfConcrete(),
  "unitF" => $unitRateobj->getRatesOfFormworks(),
  "unitR" => $unitRateobj->getRatesOfRainforcement(),

);



echo json_encode($response);
?>
