<?php

namespace RowMaterials;

include 'DbConnect.php';

use RowMaterials\DbConnect;

use PDO;

$dbobj = new DbConnect();


class Bricks{

   private $clayBlength = 0.215;
   private $clayBheight = 0.065;
   private $clayBwidth = 0.102;

   private $cementBlength = 0.215;
   private $cementBheight = 0.065;
   private $cementBwidth = 0.102;
   

public function getVolOfClayBricks(){

    $vol = $this->clayBheight*$this->clayBlength*$this->clayBwidth;

    return $vol;

}

public function getVolOfCementBricks(){

    $vol = $this->cementBheight*$this->cementBlength*$this->cementBwidth;

    return $vol;

}

public function getPriceOfClayBrick()
{
    $dbobj = new DbConnect();
    $conn = $dbobj->getConnection();

    $sql = "SELECT material_price FROM raw_materials WHERE material_name='clayBrick'";

    $pstmt = $conn->prepare($sql);
    $pstmt->execute();

    // Fetch the result
    $result = $pstmt->fetch(PDO::FETCH_ASSOC);

    if ($result !== false) {
        return $result['material_price'];
    } else {
        // Handle the case where no result is found
        return null;
    }
}

public function getPriceOfCementBrick()
{
    $dbobj = new DbConnect();
    $conn = $dbobj->getConnection();

    $sql = "SELECT material_price FROM raw_materials WHERE material_name='cementBrick'";

    $pstmt = $conn->prepare($sql);
    $pstmt->execute();

    // Fetch the result
    $result = $pstmt->fetch(PDO::FETCH_ASSOC);

    if ($result !== false) {
        return $result['material_price'];
    } else {
        // Handle the case where no result is found
        return null;
    }
}

}