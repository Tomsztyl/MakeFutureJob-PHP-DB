<?php
session_start();
if (isset($_SESSION["loginUser"])&&isset($_SESSION["loginPass"]))
                {
                    if (!empty($_SESSION["loginUser"])&&!empty($_SESSION["loginPass"]))
                    {
                        //Change Varaibles !!
                        $servername = "localhost";
                        $username = "username";
                        $password = "password";
                        $dbname = "myDB";

                    //zabezpieczenie
                    //Add this
                    // $zieminna=htmlentities($zieminna);
                    // $zieminna=$poloczeniesql->mysqli_real_escape_string($zieminna);
                    

                    //variables submited by user
                    $loginUser=$_SESSION["loginUser"];
                    $loginPass=$_SESSION["loginPass"];

                    if ($loginUser!=""|| $loginPass!="")
                    {

                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    //Check login data
                    $sql = "SELECT password FROM users WHERE username='" .$loginUser."'";

                    $result = $conn->query($sql);


                    if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        if ($row["password"]==$loginPass)
                        {
                            //echo "Login Success";

                            $sqlCode = "SELECT codeconfirmation FROM users WHERE username='" .$loginUser."'";

                            $resultCode = $conn->query($sqlCode);

                            if ($resultCode->num_rows>0)
                            {
                            //output data of each row
                            while ($row=$resultCode->fetch_assoc())
                            {
                                if ($row["codeconfirmation"]=="1")
                                {
                                    //Is Check
                                }
                                else
                                {
                                    session_destroy();
                                    header("Location: /singup/login.php");
                                }
                            }
                            }
                        }
                        else
                        {
                            session_destroy();
                            header("Location: /singup/login.php");
                        }
                    }
                    } else {
                        session_destroy();
                        header("Location: /singup/login.php");
                    }
                    $conn->close();
                    }
                    }
                    else
                    {
                        //Is empty
                        session_destroy();
                        header("Location: /singup/login.php");
                    }
                }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/53dfc2c2bc.js" crossorigin="anonymous"></script>
    <link rel="icon" href="/image/logo.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Yanone+Kaffeesatz">
    <link rel="icon" href="/image/logo.png">
    <title>Contact Make Future</title>
    <link rel="stylesheet" href="/style/styleenlargement.css">
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
    <div class="hamburger">
        <i class="fas fa-bars"></i>
    </div>
    <div class="container">
        <div class="menu">           
            <ul>
                <li class="logo" ><img src="/image/logo.png" alt=""></li>
                <li><a href="/index.php" class="active_menu">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Job offers
                </a></li>
                <li><a href="/menusubdomain/brands.php" class="active_menu">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Brands
                </a></li>
                <li><a href="/singupenlargement/styleenlargement.php" class="active_menu">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Create Offert
                </a></li>
                <?php
                    if (isset($_SESSION["loginUser"])||isset($_SESSION["loginPass"]))
                    {
                        echo '<li><a href="/singupenlargement/manageraccount.php" class="login-btn">';
                        echo '<span class="singup-btn">'.$_SESSION["loginUser"].'</span>';
                        echo '</a></li>';
                        echo '<li><a href="/singup/loggingOut.php" class="register-btn"><span class="singup-btn">Log out</span></a></li>';
                    }
                    else
                    {
                        echo '<li><a href="/singup/login.php" class="login-btn">';
                        echo '<span class="singup-btn">Login</span>';
                        echo '</a></li>';
                        echo '<li><a href="/singup/register.php" class="register-btn"><span class="singup-btn">Register</span></a></li>';
                    }
                ?>
                <!-- <li><a href="singup/login.php" class="login-btn">
                    <span class="singup-btn">Login</span>                   
                </a></li>
                <li><a href="singup/register.php" class="register-btn"><span class="singup-btn">Register</span></a></li> -->
            </ul>
        </div>
        <header>
            <div class="banner">
            <div class="contactbox">
                <h1>Contact Make Future</h1>
                    <form class="contact_creator" action="" method="POST">
                        <p>Subject</p>
                        <input type="text" name="subjectFormEmail" placeholder="Enter Subject">
                        <p>Email</p>
                        <input type="email" name="emailFormEmail" placeholder="Enter Email">
                        <p>Message Content</p>
                        <input type="text" name="contentFormEmail" placeholder="Enter Message Content">
                        <?php
                            if (isset($_POST["subjectFormEmail"])&&isset($_POST["emailFormEmail"])&&isset($_POST["contentFormEmail"]))
                            {
                                if (!empty($_POST["subjectFormEmail"])&&!empty($_POST["emailFormEmail"])&&!empty($_POST["contentFormEmail"]))
                                {
                                    //Change Send to Email

                                    $sendtoEmail="testEmial@gmail.com";

                                    //send email acitave code
                        
                                    $to      = $sendtoEmail;
                                    $subject = 'Contact Manager:('.$_POST["subjectFormEmail"].') - unitysnakebytomsztyl';
                                    $message = 'Send From: ~ '.$_POST["emailFormEmail"].' ~  MESSAGE: '.$_POST["contentFormEmail"];
                                    $headers = array(
                                    'From' => 'unitysnakebytomsztyl@gmail.com',
                                    'Reply-To' => 'unitysnakebytomsztyl@gmail.com'
                                    );
                                    
                                    mail($to, $subject, $message, $headers);

                                    echo '<a href="#" class="contactbox_interactive">Application sent!</a><br>';
                                }
                                else
                                {
                                    echo '<a href="#" class="contactbox_interactive">Complete all fields!</a><br>';
                                }
                            }
                        ?>                
                        <input type="submit" name="" value="Send">
                    </form> 
                </div> 
            </div>           
        </header>
        <footer>
            <div class="footer-obj" >
                <div class="footer-icons">
                    <a class="icon-fb" href="#">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="icon-yt" href="#">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <a class="icon-tw" href="#">
                        <i class="fab fa-twitter"></i>
                    </a>
                </div>
                <p> Tomasz Jelito © 2020. ALL RIGHTS RESERVED. PROJECTS ARE MADE FOR EDUCATIONAL PURPOSES.</p>  
            </div>
        </footer>
    </div>
    <script src="/script/main.js"></script>
</body>
</html>