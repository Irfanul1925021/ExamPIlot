<?php
session_start();
if (!isset($_SESSION["teacher_id"])) {
    header("Location: http://localhost:3000/Login/login.php");
    exit();
}
// header("Content-Type: application/octet-stream");


$teacher_id = $_SESSION["teacher_id"];

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

function decryptFile($inputFile, $outputFile, $decryptionKey, $iv)
{
    // $fileContent = file_get_contents($inputFile);
    // if($fileContent!=true){
    //     echo "File Can't Read";
    // }
    $filecontent = file_get_contents($inputFile);
    $decryptedContent = openssl_decrypt($filecontent, 'aes-256-cbc', $decryptionKey, 0, $iv);

    file_put_contents($outputFile, $decryptedContent);
}

?>



<!DOCTYPE html>
<html>

<head>
    <title>Receive Questions</title>
    <link rel=" stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" type="text/css" href="styles2.css">
    <link rel="stylesheet" type="text/css" href="/Exam Controller/send questions/send question/send questions/pdf/">


</head>

<body>
    <div class="container">
        <div class="menu">
            <div class="sidebar">
                <div class="sidebar-header">
                    <h2><i class="fas fa-graduation-cap"></i> Teacher Panel</h2>
                </div>
                <ul class="nav">
                    <li><a href="/Teacher Dashboard/Home/Home/index.php"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="/Teacher Dashboard/Pending Request/Pending Request/index1.php"><i class="fas fa-user-clock"></i> Pending Request</a>
                    </li>
                    <!-- <li><a href=""><i class="fas fa-question-circle"></i> Send Question</a> -->
                    </li>
                    <li><a href="/Teacher Dashboard/Enter Marks/Enter Marks/index.php"><i class="fas fa-edit"></i> Enter Marks</a></li>
                    <li><a href="/Teacher Dashboard/Mark Attendance/Mark Attendance//index.php"><i class="fas fa-clipboard-list"></i> Mark
                            Attendance</a></li>
                    <li><a href="/Teacher Dashboard/Attendance Report/Attendance Report/index.php"><i class="fas fa-file-alt"></i> Attendance
                            Report</a></li>
                    <li><a href="/Teacher Dashboard/Assigned Subject/Assigned Subjects/index.php"><i class="fas fa-book"></i> Assigned Subjects</a>
                    </li>
                    <li><a href="/Teacher Dashboard/Marksheet Report/Marksheet Report/index.php"><i class="fas fa-file-signature"></i> Marksheet Report</a></li>
                    <li><a href="/Teacher Dashboard/send question/index.php"><i class="fas fa-file-signature"></i> Send Question</a></li>

                    <li class="active"><a href="/Exam Controller//send questions/send question/send questions/index.php"><i class="fas fa-file-signature"></i> Receive Questions</a></li>
                    <li><a href="/Teacher Dashboard/Notification/notification.php"><i class="fas fa-bell"></i> Notifications</a></li>
                    <li><a href="/Teacher Dashboard/Update Profile/Update Profile/index.php"><i class="fas fa-user"></i> Update Profile</a></li>
                    <li><a href="/Teacher Dashboard/Log Out/logout.php"><i class="fas fa-sign-out"></i> Log Out</a></li>
                </ul>
            </div>
            <div class="content">
                <!-- <a href="64f8f3b405a2d_student_marks.pdf" target="_blank">Click Question</a> -->
                <div class="section-title">Received Questions</div>
                <!-- <embed src="C:\Users\TANIM\Desktop\Upload Dir\ <?php echo $syllabusFilePath . ".pdf"; ?>" type="application/pdf" width="700" height="700> -->
                <?php if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {


                        $requestId = $row["question_number"];
                        $department = $row["department_name"];
                        $semester = $row["semester"];
                        $courseName = $row["course_name"];
                        $courseCode = $row["course_code"];
                        $questionFile = $row["question_file_path"];
                        $encryptedFilePath = $row["encrypted_file_path"];
                        $secretKey = $row["secret_key"];
                        $iv = $row["iv"];

                        $storedDateTime = $row["time"];
                        date_default_timezone_set("Asia/Dhaka");
                        $currDateTime = time();
                        $currentTime = date("Y-m-d H:i:s", $currDateTime);

                        $uploadDir = "./pdf/";


                        $inputFile = $uploadDir . $encryptedFilePath;
                        $questionFilepath = $uploadDir . $questionFile;
                        // $questionPatternFilePath = $uploadDir . $questionPatternFileName;
                        $decryptedFileName = "_decrypted_" . $questionFile;

                        $outputFile = $uploadDir . $decryptedFileName;
                        // $ciphertext = file_get_contents($inputFile);

                        decryptFile($inputFile, $outputFile, $secretKey, $iv);

                        echo '<div class="mainCard">';
                        echo '<div class="title">';
                        echo "<h3>You have received a question paper</h3>";
                        echo '</div>';
                        echo '<div class="para">';
                        echo "Subject Code: $courseCode <br>";
                        echo "Course Name: $courseName <br>";
                        echo "Semester: $semester <br>";
                        echo "Dept Name: $department <br>";
                        echo "Exam Time : $storedDateTime <br>";
                        echo "Curr Date : $currentTime <br>";

                        // echo "Encrypted File: $inputFile <br>";
                        // echo "Decrypted File: $outputFile <br>";

                        echo "Sent From: Exam Controller <br>";

                        echo '</div>';
                        if($currentTime>= $storedDateTime){
                            echo '<div class="btn">';
                            echo "<a class='btn1' href='download_question.php?file=$decryptedFileName' target='_blank'>Download Question</a>";
                            echo "<iframe id='questionFrame' src='' width='100%' height='500px' style='display:none;'></iframe>";

                            // echo "<button class='btn1' onclick='showFile(\"questionFrame\", \"$outputFile\")'>Show Question</button>";
                            // echo "<iframe id='questionFrame' src='' width='100%' height='500px' style='display:none;'></iframe>";

                            echo '</div>';
                        }else{
                            echo '<div class="message">';
                            echo "This question will be available for download very soon";
                            echo '</div>';
                        }
                        

                        echo '</div>';
                    }
                } else {
                    echo "No requests found for this teacher.";
                }
                $conn->close();
                ?>
            </div>
        </div>
        <script>
            function showFile(iframeId, filePath) {
                const iframe = document.getElementById(iframeId);
                iframe.src = filePath;
                // iframe.style.display = 'block';
            }
        </script>
        <!-- <script src="script.js"></script> -->
</body>

</html>