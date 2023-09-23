<?php

session_start(); 


use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer-master/src/PHPMailer.php';
require './PHPMailer-master/src/Exception.php';
require './PHPMailer-master/src/SMTP.php';




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address.";
        exit;
    }
    // $sql = "SELECT * FROM students WHERE email_id = '$email'";
    // $result = $conn->query($sql);

    // if ($result->num_rows === 1){
    //     $row = $result->fetch_assoc();
    //     if ($email == $row["email_id"]){
        $temporaryPassword = bin2hex(random_bytes(8)); // Change 8 to the desired length

        $_SESSION['temporaryPassword'] = $temporaryPassword;

        $_SESSION['userEmail'] = $email;

        $subject = "Password Reset";
        $message = "Your temporary password: $temporaryPassword"; // You can customize the message

    
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'tahsinahmed.iit@gmail.com';
        $mail->Password = 'marwxrrkpsdxcufw';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;
        $mail->setFrom('tahsinahmed.iit@gmail.com', 'Tahsin Ahmed');
        $mail->addAddress($email);
        $mail->Subject = $subject;
        $mail->Body = $message;

        if ($mail->send()) {
            echo "<script>window.location.href = 'submitCode.php'</script>";
        } else {
            echo "Error sending email: " . $mail->ErrorInfo;
        }
            }
        //}

    // Generate a random temporary password
    

//}
?>



<!DOCTYPE html>
<html>

<head>
    <title>Forgot Password Page</title>
    <style>
        body {
            background-color: white;
            font-family: Poppins, Poppins Light;
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 50px;
            margin-left: 100px;
            margin-right: 100px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px #888888;
        }

        .left-container {
            flex: 1;
            background-color: white;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .logo {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .logo img {
            width: 100%;
            max-width: 200px;
        }

        .right-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: rgb(76, 93, 105);
            color: white;
            padding: 100px;
            border-radius: 10px;
        }

        h1 {
            font-size: 24px;
            color: #333333;
            margin-bottom: 20px;
            font-family: 'Barlow Condensed';
            font-weight: bold;
            font-style: italic;
            font-size: 24px;
        }

        p.subtitle {
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: left;
            width: 100%;
        }

        input[type=email] {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border-style: none none solid none;
            border-color: #ccc;
            width: 100%;
            font-size: 16px;
            color: #333333;
            background-color: white;
            outline: none;
            box-shadow: none;
            height: auto;
            line-height: normal;
            resize: none;
            font-family: 'Poppins', Poppins Light;
            font-weight: normal;
            text-transform: none;
            text-indent: 0;
            text-shadow: none;
            display: block;
            padding-left: 0.5em;
            padding-right: .5em;
        }

        input[type=submit] {
            background-color: #ff8533;
            width: 105%;
            border-radius: 5px;
            border-style: none;
            border-width: 0px;
            color: #fff;
            cursor: pointer;
            font-size: .9em;
            font-weight: bold;
            margin-top: .5em;
            padding: .8em .5em .8em .5em;
            text-align: center;
        }

        input[type=submit]:hover {
            background-color: #ff6600;
        }

        input[type=submit]:active {
            transform: scale(0.95);
        }

        a {
            color: rgb(248, 170, 14);
        }

        a:hover {
            color: #ff8533;
        }

        .error-message {
            color: red;
        }

        .success-message {
            color: green;
        }

        @media only screen and (max-width: 768px) {
            body {
                margin-top: -20px;
            }

            h1 {
                font-size: 20px;
            }

            input[type=email] {
                font-size: .8em;
            }

            input[type=submit] {
                font-size: .8em;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="left-container">
            <h1>EXAM PILOT</h1>
            <div class="logo">
                <img src="logo.jpeg" alt="Logo">
                <p class="subtitle">An automated examination management system by NSTU</p>
            </div>
        </div>
        <div class="right-container">
            <h1 style="font-family: 'Poppins Medium'; color: rgb(248, 170, 14);">Forget Password?</h1>
            <p class="subtitle" style="font-family: 'Poppins Light'; color:rgb(223, 219, 226); ">
                Enter your email to receive a verification code</p>

            <form action="" method="post">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Give your educational mail" required>
                <input type="submit" value="Get Code">
            </form>
        </div>
    </div>
</body>

</html>