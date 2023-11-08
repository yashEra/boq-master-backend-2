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

require_once '../../Classess/PartsOfConstructions/Tiebeam.php';
use classes\Tiebeam;

// Get the posted data
$data = json_decode(file_get_contents("php://input"));

$unit = $data->unit;
$noOfTiebeams = $data->noOfTiebeams;

if($unit ==="ft"){

  $length = ($data->length)*0.3048;
  $width = ($data->width)*0.3048;
  $height = ($data->height)*0.3048;


}else{
  
  $length = $data->length;
  $width = $data->width;
  $height = $data->height;

  
}

$tiebeamObj = new Tiebeam($length, $width, $height, $noOfTiebeams);

// Process the data or perform necessary actions
$response = array(
  "message" => "Data received successfully",
  "matel" => $tiebeamObj->getMetalQuantityForTiebeam(),
  "cement" => $tiebeamObj->getCementQuantityForTiebeam(),
  "sand" => $tiebeamObj->getSandQuantityForTiebeam(),
  "rainforcementBars" => $tiebeamObj->getReinforcementQuantityForTiebeam(),
  "bindingWires" => $tiebeamObj->getBindingWiresQuantityForTiebeam(),
  "cost" => $tiebeamObj->getTotalCostForTiebeam(),
  "rs" => $tiebeamObj->getReinforcementPriceForTiebeam(),

);



echo json_encode($response);
?>
