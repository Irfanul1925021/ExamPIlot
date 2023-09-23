<!DOCTYPE html>
<html>

<head>
    <title>Submit Code Page</title>
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

        input[type=number] {
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

            input[type=number] {
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
                <img src="image/logo.jpeg" alt="Logo">
                <p class="subtitle">An automated examination management system by NSTU</p>
            </div>
        </div>
        <div class="right-container">
            <h1 style="font-family: 'Poppins Medium'; color: rgb(248, 170, 14);">Submit the code</h1>
            <p class="subtitle" style="font-family: 'Poppins Light'; color:rgb(223, 219, 226); ">
                Please verify your identity to re-add the password</p>

            <form action="resetPass.html" method="post">
                <label for="verification-code">Verification Code:</label>
                <input type="number" id="verification-code" name="verification-code" placeholder="Please enter the code"
                    required>
                <input type="submit" value="Verify">
            </form>
            <a href="#">I haven't received the code.</a>
        </div>
    </div>
</body>

</html>