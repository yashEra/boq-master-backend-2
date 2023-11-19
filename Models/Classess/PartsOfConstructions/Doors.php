<?php

namespace RowMaterials;
// include 'DbConnect.php';

// use RowMaterials\DbConnect;
use PDO;
use PDOException;



class Doors{

    private $id;
    private $material;
    private $qt;
    // private $area;

    public function __construct($id, $material, $qt)
    {
        $this->material = $material;
        $this->id = $id;
        $this->qt = $qt;
    }

public function getPriceOfDoor()
{
    $dbobj = new DbConnect();
    $conn = $dbobj->getConnection();

    $sql = "SELECT * FROM door RIGHT JOIN door_sizes ON door.id = door_sizes.type_id WHERE door.id='$this->id' AND material = '$this->material'";

    $pstmt = $conn->prepare($sql);
    $pstmt->execute();

    $result = $pstmt->fetch(PDO::FETCH_ASSOC);

    if ($result !== false) {
        // $this->area = $result['area'];
        return $result['price'];
    } else {
        return null;
    }
}

public function getAreaOfDoor()
{
    $dbobj = new DbConnect();
    $conn = $dbobj->getConnection();

    $sql = "SELECT * FROM door RIGHT JOIN door_sizes ON door.id = door_sizes.type_id WHERE door.id='$this->id' AND material = '$this->material'";

    $pstmt = $conn->prepare($sql);
    $pstmt->execute();

    $result = $pstmt->fetch(PDO::FETCH_ASSOC);

    if ($result !== false) {
        return $result['area'];
    } else {
        return null;
    }
}

public function areaOfDoor(){
    return $this->getAreaOfdoor() * $this->qt;
}

public function priceOfDoor(){
    return $this->getPriceOfDoor() * $this->qt;
}

}

class DbConnect {
    private $server = 'localhost';
    private $dbname = 'boq_master';
    private $user = 'root';
    private $pass = '';

    public function getConnection() {
        try {
            $conn = new PDO('mysql:host=' .$this->server .';dbname=' . $this->dbname, $this->user, $this->pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            echo "Database Error: " . $e->getMessage();
        }
    }
    
}
