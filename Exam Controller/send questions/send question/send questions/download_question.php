<?php
session_start();

if (!isset($_SESSION["teacher_id"])) {
    header("Location: http://localhost:3000/Login/login.php");
    exit();
}

$teacher_id = $_SESSION["teacher_id"];

if (isset($_GET["file"])) {
    $file = $_GET["file"];
    $filePath = "./pdf/" . $file; // Adjust the path to your decrypted files directory.

    // Check if the file exists.
    if (file_exists($filePath)) {
        // Check if the teacher is authorized to access this file.
        if (isTeacherAuthorized($teacher_id)) {
            // Serve the file for download.
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=" . basename($filePath));
            readfile($filePath);
            exit();
        } else {
            // Handle unauthorized access (e.g., show an error message).
            echo "Unauthorized access.";
            exit();
        }
    } else {
        // Handle file not found (e.g., show an error message).
        echo "File not found.";
        exit();
    }
} else {
    // Handle invalid file request (e.g., show an error message).
    echo "Invalid file request.";
    exit();
}

// Function to check if the teacher is authorized to access the file.
function isTeacherAuthorized($teacher_id)
{

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "exam pilot";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM send_question WHERE recipient_teacher = '$teacher_id'";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
        return false;
    }
    // Implement your custom logic here to check if the teacher is authorized.
    // You can query your database to check if the teacher_id and file association exists.
    // Example SQL query (assuming you have a 'teachers_files' table):
    // $sql = "SELECT COUNT(*) FROM teachers_files WHERE teacher_id = '$teacher_id' AND file_name = '$file'";
    // Execute the query, fetch the result, and return true if the association exists.

    // For security, you should also validate the file name to prevent directory traversal attacks.

    return true; // Return true if authorized, false if not authorized.
}
