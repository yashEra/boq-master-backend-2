<?php
require_once '../../config/DbConnector.php';
// include '../../../config/DbConnector.php';

// use config\DbConnector;

// use PDO;
// use PDOException;

class Person
{

    private $username;
    private $fname;
    private $lname;
    private $email;
    private $utype;
    private $address;
    private $phone;
    private $protype;
    private $password;

    public function __construct($username, $fname, $lname, $email, $phone, $utype, $password)
    {
        $this->username = $username;
        $this->fname = $fname;
        $this->lname = $lname;
        $this->email = $email;
        $this->phone = $phone;
        $this->utype = $utype;
        $this->password = $password;
    }
    

    public function signup()
    {
        $dbcon = new DbConnector();
        $conn = $dbcon->getConnection();
    
        $sql = "INSERT INTO user(userName, firstName, lastName, email, phoneNumber, accountType, password) VALUES(?, ?, ?, ?, ?, ?, ?)";
    
        try {
            $pstmt = $conn->prepare($sql);
            $pstmt->bindParam(1, $this->username);
            $pstmt->bindParam(2, $this->fname);
            $pstmt->bindParam(3, $this->lname);
            $pstmt->bindParam(4, $this->email);
            $pstmt->bindParam(5, $this->phone);
            $pstmt->bindParam(6, $this->utype);
            $pstmt->bindParam(7, $this->password);
    
            if ($pstmt->execute()) {
                echo "Success";
            } else {
                echo "Failed to insert data.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
}
