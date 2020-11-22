<?php
//Security In
session_start();
if (isset($_SESSION["loginUser"])||isset($_SESSION["loginPass"]))
{
    header("Location: /index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/53dfc2c2bc.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Yanone+Kaffeesatz">
    <link rel="icon" href="/image/logo.png">
    <script src="https://kit.fontawesome.com/53dfc2c2bc.js" crossorigin="anonymous"></script>
    <title>Register to Make Future</title>
    <link rel="stylesheet" href="/style/stylessingup.css">
</head>
<body>
<div class="canvas">
    <div class="loading">
        <div class="obj"></div>
        <div class="obj"></div>
        <div class="obj"></div>
        <div class="obj"></div>
        <div class="obj"></div>
        <div class="obj"></div>
        <div class="obj"></div>
        <div class="obj"></div>
    </div>
    </div>
    <div class="loginbox">
        <img src="/image/avataruser(2).png" class="avatar">
            <h1>Register</h1>
            <form action="" method="POST">
                <p>Username</p>
                <input type="text" name="usernameReg" placeholder="Enter Username">
                <p>Email</p>
                <input type="email" name="emailReg" placeholder="Enter Email">
                <p>Password</p>
                <input type="password" name="passwordReg" placeholder="Enter Password">
                <?php
                if (isset($_POST["usernameReg"])&&isset($_POST["emailReg"])&&isset($_POST["passwordReg"]))
                {
                    if (!empty($_POST["usernameReg"])&&!empty($_POST["emailReg"])&&!empty($_POST["passwordReg"]))
                    {
                        //Change Varaibles !!
                        $servername = "localhost";
                        $username = "username";
                        $password = "password";
                        $dbname = "myDB";
                        
                        //Variables Session
                        $_SESSION["usernameReg"]=$_POST["usernameReg"];
                        $_SESSION["emailReg"]=$_POST["emailReg"];
                        $_SESSION["passwordReg"]=$_POST["passwordReg"];

                        //Variables submitted by user
                        $registerUser=$_SESSION["usernameReg"];
                        $registerMail=$_SESSION["emailReg"];
                        $registerPass=$_SESSION["passwordReg"];
                        
                        
                        if ($registerUser!=""|| $registerMail!="" || $registerPass!="")
                        {
                        
                        //Variable Random AcitaveCode
                        $activatecode=rand(10000,99999999);
                        
                        //Variable Date
                        $date = new DateTime('now');
                        $convertDateNow=$date->format("Y-m-d H:i:s");
                        
                        // Create connection
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        
                        // Check connection
                        if ($conn->connect_error) {
                          die("Connection failed: " . $conn->connect_error);
                        }
                        
                        $sql="SELECT  username FROM users WHERE username='" .$registerUser."' OR email='".$registerMail."'";
                        
                        $result = $conn->query($sql);
                        
                        if ($result->num_rows > 0) {
                            echo '<a href="#" class="executive_text">It is exists!</a><br>';
                        } else {
                            //echo "Username does not exists.";
                            $sql = "INSERT INTO users (username, password,email,codeactivate,creationdate,creationdatecodeactivate)
                            VALUES ('$registerUser','$registerPass','$registerMail','$activatecode','$convertDateNow','$convertDateNow')";
                           
                            //send email acitave code
                        
                            $to      = $registerMail;
                            $subject = 'Security code - unitysnakebytomsztyl';
                            $message = 'Hello, if you got an e-mail, you have probably registered an
                             account. Your security code is: '. $activatecode.' 
                                                                                                                         
                             If you don t recognize this message, please ignore it';
                            $headers = array(
                            'From' => 'unitysnakebytomsztyl@gmail.com',
                            'Reply-To' => 'unitysnakebytomsztyl@gmail.com'
                            );
                        
                            mail($to, $subject, $message, $headers);
                        
                            if ($conn->query($sql) === TRUE) {
                             echo '<a href="#" class="executive_text">New user is create!</a><br>';
                            } else {
                            echo '<a href="#" class="executive_text">'."Error: " . $sql . "<br>" . $conn->error.'</a><br>';
                            }
                        }
                        $conn->close();
                        }
                        
                    }
                    else
                    {
                        //Is empty
                        echo '<a href="#" class="executive_text">Complete all fields!</a><br>';
                    }
                }
                ?>
                <input type="submit" name="" value="Register">
                <a href="/singup/activecode.php" class="loginbox_interactive">Message has not arrived? Click here!</a><br>
                <a href="/singup/login.php" class="loginbox_interactive">You already have an account? Login!</a>
            </form>
            
        </div>
        <script src="/script/mainsingup.js"></script>
</body>
</html>