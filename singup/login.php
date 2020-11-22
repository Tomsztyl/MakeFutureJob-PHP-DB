<?php
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Yanone+Kaffeesatz">
    <link rel="icon" href="/image/logo.png">
    <script src="https://kit.fontawesome.com/53dfc2c2bc.js" crossorigin="anonymous"></script>
    <title>Login to Make Future</title>
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
            <h1>Login</h1>
            <form action="" method="POST">
                <p>Username</p>
                <input type="text" name="loginUser" placeholder="Enter Username">
                <p>Password</p>
                <input type="password" name="loginPass" placeholder="Enter Password">
                <?php
                if (isset($_POST["loginUser"])&&isset($_POST["loginPass"]))
                {
                    if (!empty($_POST["loginUser"])&&!empty($_POST["loginPass"]))
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
                    $loginUser=$_POST["loginUser"];
                    $loginPass=$_POST["loginPass"];

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
                                //Variables Session
                                $_SESSION["loginUser"]=$loginUser;
                                $_SESSION["loginPass"]=$loginPass;
                                echo '<a href="#" class="executive_text">Login Success!</a><br>';
                                header("Location: /index.php");
                                }
                                else
                                {
                                echo '<a href="/singup/activecode.php" class="executive_text">Input activate code from email!</a><br>';
                                }
                            }
                            }
                        }
                        else
                        {
                            echo '<a href="#" class="executive_text">Wrong Password!</a><br>';
                        }
                    }
                    } else {
                    echo '<a href="#" class="executive_text">Username does not exists!</a><br>';
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
                <input type="submit" name="" value="Login">
                <a href="/singup/accountrecovery.php" class="loginbox_interactive">You forgot your password? Don't worry, click!</a><br>
                <a href="/singup/register.php" class="loginbox_interactive">Don't have an account? Register now!</a>
            </form>
            
        </div>
        <script src="/script/mainsingup.js"></script>
</body>
</html>