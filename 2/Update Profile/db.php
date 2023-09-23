<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "exam pilot";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_name = $_POST["student_name"];
    $email = $_POST["email"];
    $contact = $_POST["contact"];
    $password = $_POST["password"];
    $dept_name = $_POST["dept_name"];
    $student_id = $_POST["student_id"];



    // Update the student data in the database
    $sql = "UPDATE students SET student_name='$student_name', email_id='$email', contact='$contact', dept_name='$dept_name', password='$password'  WHERE student_id= '$student_id' ";

    if ($conn->query($sql) === TRUE) {
        echo "Student data updated successfully.";
    } else {
        echo "Error updating Student data: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
