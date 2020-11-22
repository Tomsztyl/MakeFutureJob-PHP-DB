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
    <title>Active Code Make Future</title>
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
            <h1>Active Code</h1>
            <form action="" method="POST">
                <p>Username</p>
                <input type="text" name="activecodeUser" placeholder="Enter Username">
                <p>Active Code</p>
                <input type="password" name="activecodePass" placeholder="Enter Active Code">
                <?php
                if (isset($_POST["activecodeUser"])&&isset($_POST["activecodePass"]))
                {
                    if (!empty($_POST["activecodeUser"])&&!empty($_POST["activecodePass"]))
                    {
                        //Change Varaibles !!
                        $servername = "localhost";
                        $username = "username";
                        $password = "password";
                        $dbname = "myDB";
                    
                    //Variables Session
                    $_SESSION["activecodeUser"]=$_POST["activecodeUser"];
                    $_SESSION["activecodePass"]=$_POST["activecodePass"];

                    //variables submited by user
                    $loginUser=$_SESSION["activecodeUser"];
                    $loginPass=$_SESSION["activecodePass"];

                    if ($loginUser!=""|| $loginPass!="")
                    {

                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    //Check login data
                    $sql = "SELECT codeconfirmation FROM users WHERE username='" .$loginUser."'";

                    $result = $conn->query($sql);


                    if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        if ($row["codeconfirmation"]=="0")
                        {
                            //No confirmation code;

                            $sqlCode = "SELECT codeactivate FROM users WHERE username='" .$loginUser."'";

                            $resultCode = $conn->query($sqlCode);

                            if ($resultCode->num_rows>0)
                            {
                            //output data of each row
                            while ($row=$resultCode->fetch_assoc())
                            {
                                if ($row["codeactivate"]==$loginPass)
                                {
                                // echo '<a href="/singup/login.php" class="executive_text">Your code has been verified!</a><br>';
                                $sqlCodeUpdate= "UPDATE users SET codeconfirmation='1' WHERE codeconfirmation='0' AND username='" .$loginUser."'";
                                if ($conn->query($sqlCodeUpdate) === TRUE) 
                                {
                                    echo '<a href="/singup/login.php" class="executive_text">Your code has been verified!</a><br>';
                                } 
                                else 
                                {
                                    // echo "Error updating record: " . $conn->error;
                                    echo '<a href="#" class="executive_text">Something went wrong please try again!'.$conn->error.'</a><br>';                                    
                                }

                                }
                                else
                                {
                                echo '<a href="#" class="executive_text">Invalid verification code!</a><br>';
                                }
                            }
                            }
                        }
                        else
                        {
                            echo '<a href="/singup/login.php" class="executive_text">Your code has already been active!</a><br>';
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
                <input type="submit" name="" value="Verify Code">
                <a href="/singup/login.php" class="loginbox_interactive">You already have an account? Login!</a>
                <a href="/singup/register.php" class="loginbox_interactive">Don't have an account? Register now!</a>
            </form>
            
        </div>
        <script src="/script/mainsingup.js"></script>
</body>
</html>