<?php
header('Content-Type: application/json');

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "boq_master";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the request method
$method = $_SERVER['REQUEST_METHOD'];

// Handle different request methods
switch ($method) {
    case 'POST':
        // Handle POST requests (insert data)
        $data = $_POST;

        $project_name = $data['project_name'];
        $project_type = $data['project_type'];
        $project_description = $data['project_description'];

        // Handle file uploads
        $image1 = uploadFile($_FILES['image_1']);
        $image2 = uploadFile($_FILES['image_2']);
        $image3 = uploadFile($_FILES['image_3']);
        $image4 = uploadFile($_FILES['image_4']);

        insertProject($conn, $project_name, $project_description, $image1, $image2, $image3, $image4);

        break;

    default:
        // Unsupported method
        http_response_code(405);
        echo json_encode(array("message" => "Method Not Allowed"));
}

// Function to insert project into the database
function insertProject($conn, $project_name, $project_description, $image1, $image2, $image3, $image4)
{
    $sql = "INSERT INTO portfolio (project_name, project_discription, image1, image2, image3, image4)
            VALUES ('$project_name', '$project_description', '$image1', '$image2', '$image3', '$image4')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("status" => "1", "message" => "Project added successfully"));
    } else {
        http_response_code(500);
        echo json_encode(array("status" => "0", "message" => "Error adding project: " . $conn->error));
    }
}

// Function to handle file uploads
function uploadFile($file)
{
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($file["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file already exists
    if (file_exists($target_file)) {
        $uploadOk = 0;
    }

    // Check file size
    if ($file["size"] > 500000) {
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        return "";
    } else {
        // if everything is ok, try to upload file
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            return $target_file;
        } else {
            return "";
        }
    }
}

// Close the database connection
$conn->close();
?>
