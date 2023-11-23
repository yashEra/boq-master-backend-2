<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Methods: POST, OPTIONS");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
  http_response_code(204);
  exit();
}

require_once '../../Classess/PartsOfConstructions/Tiebeam.php';
use classes\Tiebeams;

require_once '../../Classess/PartsOfConstructions/UnitRates.php';

use RowMaterials\UnitRates;

$data = json_decode(file_get_contents("php://input"));

$unit = $data->unit;
$noOfTiebeams = $data->noOfTiebeams;

if($unit ==="feet"){

  $length = ($data->length)*0.3048;
  $width = ($data->width)*0.3048;
  $height = ($data->height)*0.3048;


}else{
  
  $length = $data->length;
  $width = $data->width;
  $height = $data->height;

  
}

$tiebeamObj = new Tiebeams($length, $width, $height, $noOfTiebeams);
$unitRateobj = new UnitRates();

// Process the data or perform necessary actions
$response = array(
  "message" => "Data received successfully",
  "concreteCost" => round($tiebeamObj->getTotalCostForConcrete(), 2),
  "reinforcementCost" => round($tiebeamObj->getTotalCostForReinforcement(), 2),
  "formworksCost" => round($tiebeamObj->getTotalCostForFrameWork(), 2),
  "concreteQuantity" => round($tiebeamObj->getVolOfTiebeams(), 2),
  "reinforcementQuantity" => round($tiebeamObj->getVolOfTiebeams(), 2),
  "formworksQuantity" => round($tiebeamObj->getVolOfTiebeams(), 2),
  "concreteUnitPrice" => $unitRateobj->getRatesOfConcreteOne(),
  "reinforcementUnitPrice" => $unitRateobj->getRatesOfRainforcement(),
  "formworksUnitPrice" => $unitRateobj->getRatesOfFormworks(),

);



echo json_encode($response);
?>
