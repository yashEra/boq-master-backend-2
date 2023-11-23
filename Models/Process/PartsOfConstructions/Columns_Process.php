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

require_once '../../Classess/PartsOfConstructions/Columns.php';
use classes\Columns;

require_once '../../Classess/PartsOfConstructions/UnitRates.php';

use RowMaterials\UnitRates;

// Get the posted data
$data = json_decode(file_get_contents("php://input"));

$unit = $data->unit;
$no_of_columns=$data->noOfColumns;

if($unit ==="feet"){

  $length = ($data->length)*0.3048;
  $width = ($data->width)*0.3048;
  $height = ($data->height)*0.3048;


}else{
  
  $length = $data->length;
  $width = $data->width;
  $height = $data->height; 
}

$cobj = new Columns($length, $width, $height, $no_of_columns);
$unitRateobj = new UnitRates();

$response = array(
    "message" => "Data received successfully",
    "concrete" => round($cobj->getTotalCostForConcrete(), 2),
    "reinforcement" => round($cobj->getTotalCostForReinforcement(), 2),
    "formworks" => round($cobj->getTotalCostForFrameWork(), 2),
    "concreteQuantity" => round($cobj->getVolOfColumn(), 2),
    "reinforcementQuantity" => round($cobj->getVolOfColumn(), 2),
    "formworksQuantity" => round($cobj->getVolOfColumn(), 2),    
    "concreteUnitPrice" => $unitRateobj->getRatesOfConcreteOne(),
    "reinforcementUnitPrice" => $unitRateobj->getRatesOfRainforcement(),
    "formworksUnitPrice" => $unitRateobj->getRatesOfFormworks(),

);

echo json_encode($response);
?>
