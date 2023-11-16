<?php
namespace PartsOfConstructions;

include_once 'Bricks.php';

use RowMaterials\Bricks;

include_once 'UnitRates.php';

use RowMaterials\UnitRates;

// $bricks = new Bricks();

// include './DbConnector.php';

// use config\DbConnector;

// $dbobj = new DbConnector();

// use RowMaterials\Bricks;

class Walls

{
    private $height;
    private $width;
    private $length;
    private $typeOfBrick;
    private $numberOfClayBricks = 45.56 ; //for 1 squre meeter
    private $numberOfCementBricks = 71.46;
    private $CementBrickPrice = 100;
    private $clayBrickPrice = 100;
    private $cement = 1;
    private $sand= 100;
    private $cementPrice = 3000/50;
    private $sandPrice= 100;//for 1 unit
    private $type;




    public function __construct($height, $length, $typeOfBrick, $type)
    {
        $this->height = $height;
        $this->length = $length;
        $this->typeOfBrick = $typeOfBrick;
        $this->type=$type;
    }

    public function getWallArea()
    {
        $wallArea = $this->height * $this->length;

        return $wallArea;
    }

    public function getWallDec()
    {
        $unitRatesObj = new UnitRates();
        $wallDes = $unitRatesObj->getDecOfwall($this->typeOfBrick,$this->type);

        return $wallDes;
    }

    public function getBricksQuantity()
    {
        if ($this->typeOfBrick === "clayBrick") {
            $bricksQuantity = $this->numberOfClayBricks * $this->getWallArea();
        } else {
            $bricksQuantity = $this->numberOfCementBricks * $this->getWallArea();
        }
        return $bricksQuantity;
    }


    public function getCement()
    {
        $cementQuantity = 0;

        if ($this->typeOfBrick === "clayBrick") {
            $cementQuantity = 1;
        } else {
        }


        return $cementQuantity;
    }

    public function getSand()
    {
        $sandQuantity = 0;
        if ($this->typeOfBrick === "clayBrick") {
            $sandQuantity = "";
        } else {
        }


        return $sandQuantity;
    }

/***************************************************************************************** 
WALLCOST
**************************************************************************************** */

    // public function getWallCost()
    // {
    //     $bricksObj = new Bricks();
    //     $cost2 = $bricksObj->getPriceOfClayBrick();

    //     $cost = 0;
    //     $sandPrice = $this->sandPrice *$this->getWallArea()*$cost2;
    //     $cement = $this->cementPrice *$this->getWallArea();

    //     if ($this->typeOfBrick === "Clay Brick") {
    //         $cost = (($this->numberOfClayBricks *  $this->getWallArea()) *  $this->clayBrickPrice) + ($sandPrice)+ ($cement);
    //     }else{

    //         $cost = (($this->numberOfCementBricks *  $this->getWallArea()) *  $this->clayBrickPrice) + ($sandPrice)+ ($cement);
    //     }
    //     return $cost;
    // }

    public function getWallCost()
    {
        $unitRatesObj = new UnitRates();
        $cost = $unitRatesObj->getRateOfwall($this->typeOfBrick, $this->type);

        return $this->getWallArea()*$cost;
    }



    /***************************************************************************************** 
WALLQuantity
**************************************************************************************** */
public function getBrickQuantity()
{
    $bricksQuantity = 0;

    if ($this->typeOfBrick === "Clay Brick") {
        $bricksQuantity = ($this->numberOfClayBricks *  $this->getWallArea());
    }else{

        $bricksQuantity = ($this->numberOfCementBricks *  $this->getWallArea());
    }
    return $bricksQuantity;
}

public function getcementQuantity()
{
    $cementQuantity = 0;

        $cementQuantity = ($this->cement *  $this->getWallArea());

    return $cementQuantity;
}

public function getSandQuantity()
{
    $sandQuantity = 0;

        $sandQuantity = ($this->sand *  $this->getWallArea());

    return $sandQuantity;
}

    /*************************************************************************************************** */


    public function getHeight()
    {
        return $this->height;
    }

    public function setHeight($height)
    {
        $this->height = $height;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function setWidth($width)
    {
        $this->width = $width;
    }

    public function getLength()
    {
        return $this->length;
    }

    public function setLength($length)
    {
        $this->length = $length;
    }
}

// class DbConnector {
//     private $server = 'localhost';
//     private $dbname = 'boq_master';
//     private $user = 'root';
//     private $pass = '';

//     public function getConnection() {
//         try {
//             $conn = new PDO('mysql:host=' .$this->server .';dbname=' . $this->dbname, $this->user, $this->pass);
//             $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//             return $conn;
//         } catch (PDOException $e) {
//             echo "Database Error: " . $e->getMessage();
//         }
//     }
    
// }
