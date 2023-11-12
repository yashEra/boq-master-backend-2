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
    private $retypePassword;

    public function __construct($username, $fname, $lname, $email, $phone, $utype, $protype,$password, $retypePassword)
    {
        $this->username = $username;
        $this->fname = $fname;
        $this->lname = $lname;
        $this->email = $email;
        $this->phone = $phone;
        $this->utype = $utype;
        $this->protype = $protype;
        $this->password = $password;
        $this->retypePassword = $retypePassword;
    }
    

    public function signup()
    {
        $dbcon = new DbConnector();
        $conn = $dbcon->getConnection();
    
        $sql = "INSERT INTO user(userName, firstName, lastName, email, phoneNumber, accountType, proType, password) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
    
        try {
            $pstmt = $conn->prepare($sql);
            $pstmt->bindParam(1, $this->username);
            $pstmt->bindParam(2, $this->fname);
            $pstmt->bindParam(3, $this->lname);
            $pstmt->bindParam(4, $this->email);
            $pstmt->bindParam(5, $this->phone);
            $pstmt->bindParam(6, $this->utype);
            $pstmt->bindParam(7, $this->protype);
            $pstmt->bindParam(8, $this->password);
    
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
