<?php

namespace RowMaterials;

// include 'DbConnect.php';

// use RowMaterials\DbConnect;

use PDO;



class UnitRates{

public function getRateOfwall($brickType, $type)
{
    $dbobj = new DbCon();
    $conn = $dbobj->getConnection();

    $sql = "SELECT * FROM rates WHERE brick_type='$brickType' AND type='$type'";

    $pstmt = $conn->prepare($sql);
    $pstmt->execute();

    // Fetch the result
    $result = $pstmt->fetch(PDO::FETCH_ASSOC);

    if ($result !== false) {
        return $result['unit_rate'];
        } else {
        // Handle the case where no result is found
        return null;
    }
}

public function getDecOfwall($brickType, $type)
{
    $dbobj = new DbConnect();
    $conn = $dbobj->getConnection();

    $sql = "SELECT * FROM rates WHERE brick_type='$brickType' AND type='$type'";

    $pstmt = $conn->prepare($sql);
    $pstmt->execute();

    // Fetch the result
    $result = $pstmt->fetch(PDO::FETCH_ASSOC);

    if ($result !== false) {
        return $result['description'];
        } else {
        // Handle the case where no result is found
        return null;
    }
}

/***************************************************************
 * Concrete Rates
 **************************************************************/

 public function getRateOfConcrete()
{
    $dbobj = new DbCon();
    $conn = $dbobj->getConnection();

    $sql = "SELECT * FROM concrete_rates";

    $pstmt = $conn->prepare($sql);
    $pstmt->execute();

    $result = $pstmt->fetch(PDO::FETCH_ASSOC);

    if ($result !== false) {
        return $result['rate'];
        } else {
        return null;
    }
}


public function getDecOConcrete()
{
    $dbobj = new DbConnect();
    $conn = $dbobj->getConnection();

    $sql = "SELECT * FROM concrete_rates";

    $pstmt = $conn->prepare($sql);
    $pstmt->execute();

    $result = $pstmt->fetch(PDO::FETCH_ASSOC);

    if ($result !== false) {
        return $result['description'];
        } else {
        return null;
    }
}

/***************************************************************
 * Frame Works
 **************************************************************/

 //Slabs
public function getRateOFrameWork()
{
    $dbobj = new DbConnect();
    $conn = $dbobj->getConnection();

    $sql = "SELECT * FROM `fw_rates` WHERE type = 'slab'";

    $pstmt = $conn->prepare($sql);
    $pstmt->execute();

    $result = $pstmt->fetch(PDO::FETCH_ASSOC);

    if ($result !== false) {
        return $result['rate'];
        } else {
        return null;
    }
}
public function getDecOFrameWork()
{
    $dbobj = new DbConnect();
    $conn = $dbobj->getConnection();

    $sql = "SELECT * FROM `fw_rates` WHERE type = 'slab'";

    $pstmt = $conn->prepare($sql);
    $pstmt->execute();

    $result = $pstmt->fetch(PDO::FETCH_ASSOC);

    if ($result !== false) {
        return $result['description'];
        } else {
        return null;
    }
}

//Column



}


use PDOException;


class DbCon {
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