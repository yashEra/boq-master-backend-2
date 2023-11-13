<?php
require_once '../../config/DbConnector.php';

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

    public function __construct($username, $fname, $lname, $email, $phone, $utype, $protype, $password, $retypePassword)
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
    private function sanitizeEmail($email)
    {
        return filter_var($email, FILTER_SANITIZE_EMAIL);
    }

    private function validatePhoneNumber($phone)
    {
        return preg_match("/^[0-9]{10}$/", $phone);
    }

    private function validatePassword($password,$retypePassword)
    {
        return $password == $retypePassword;
    }

    public function signup()
    {
        $dbcon = new DbConnector();
        $conn = $dbcon->getConnection();

        $sanitizedEmail = $this->sanitizeEmail($this->email);


        // if ($this->password !== $this->retypePassword) {
        //     echo "Passwords do not match.";
        //     return;
        // }

        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);

        if ($this->utype == "professional") {

            $sql = "INSERT INTO professional(userName, firstName, lastName, email, phoneNumber, accountType, proType, password) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";

            try {
                $pstmt = $conn->prepare($sql);
                $pstmt->bindParam(1, $this->username);
                $pstmt->bindParam(2, $this->fname);
                $pstmt->bindParam(3, $this->lname);
                $pstmt->bindParam(4, $sanitizedEmail);
                $pstmt->bindParam(5, $this->phone);
                $pstmt->bindParam(6, $this->utype);
                $pstmt->bindParam(7, $this->protype);
                $pstmt->bindParam(8, $hashedPassword);

                if ($pstmt->execute()) {
                    echo "Success";
                } else {
                    echo "Failed to insert data.";
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            $sql = "INSERT INTO client(userName, firstName, lastName, email, phoneNumber, accountType, password) VALUES(?, ?, ?, ?, ?, ?, ?)";
            try {
                $pstmt = $conn->prepare($sql);
                $pstmt->bindParam(1, $this->username);
                $pstmt->bindParam(2, $this->fname);
                $pstmt->bindParam(3, $this->lname);
                $pstmt->bindParam(4, $sanitizedEmail);
                $pstmt->bindParam(5, $this->phone);
                $pstmt->bindParam(6, $this->utype);
                $pstmt->bindParam(7, $hashedPassword);

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
}
