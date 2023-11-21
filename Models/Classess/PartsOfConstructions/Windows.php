<?php

namespace RowMaterials;
// include 'DbConnect.php';

// use RowMaterials\DbConnect;
use PDO;
use PDOException;



class Windows{

    private $id;
    private $size;
    private $qt;

    public function __construct($id, $size, $qt)
    {
        $this->size = $size;
        $this->id = $id;
        $this->qt = $qt;
    }

public function getPriceOfwindow()
{
    $dbobj = new DbConnect();
    $conn = $dbobj->getConnection();

    $sql = "SELECT * FROM windows_sizes WHERE type_id=$this->id AND size = '$this->size'";

    $pstmt = $conn->prepare($sql);
    $pstmt->execute();

    $result = $pstmt->fetch(PDO::FETCH_ASSOC);

    if ($result !== false) {
        return $result['price'];
    } else {
        return null;
    }
}

public function getAreaOfwindow()
{
    $dbobj = new DbConnect();
    $conn = $dbobj->getConnection();

    $sql = "SELECT * FROM windows_sizes WHERE type_id=$this->id AND size = '$this->size'";
   
    $pstmt = $conn->prepare($sql);
    $pstmt->execute();

    $result = $pstmt->fetch(PDO::FETCH_ASSOC);

    if ($result !== false) {
        return $result['area'];
    } else {
        return null;
    }
}

public function areaOfWindows(){
    return $this->getAreaOfwindow() * $this->qt;
}

public function priceOfWindows(){
    return $this->getPriceOfwindow() * $this->qt;
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
