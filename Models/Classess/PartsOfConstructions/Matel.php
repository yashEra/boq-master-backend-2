<?php

namespace RowMaterials;
// include 'DbConnect.php';

// use RowMaterials\DbConnect;
use PDO;
use PDOException;

class Matel{
    public function getPriceOfMetal()
{
    $dbobj = new DbConnector();
    $conn = $dbobj->getConnection();

    $sql = "SELECT material_price FROM raw_materials WHERE material_name='metal'";

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

class DbConnector {
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