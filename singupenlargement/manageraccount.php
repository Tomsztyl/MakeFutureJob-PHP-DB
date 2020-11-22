<?php
session_start();
if (!isset($_SESSION["loginUser"])&&!isset($_SESSION["loginPass"]))
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Yanone+Kaffeesatz">
    <link rel="icon" href="/image/logo.png">
    <script src="https://kit.fontawesome.com/53dfc2c2bc.js" crossorigin="anonymous"></script>
    <title>Manager Account</title>
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
    <div class="managerbox">
            <h1>Password Change</h1>
            <form action="" method="POST">
                <p>Old Password</p>
                <input type="password" name="changeOldPassword" placeholder="Enter Old Password">
                <p>New Password</p>
                <input type="password" name="changeNewPassword" placeholder="Enter New Password">
                <p>Repeat New Password</p>
                <input type="password" name="changeRepeatNewPassword" placeholder="Enter Repeat New Password">
                <?php
                if (isset($_POST["changeOldPassword"])&&isset($_POST["changeNewPassword"])&&isset($_POST["changeRepeatNewPassword"]))
                {
                    if (!empty($_POST["changeOldPassword"])&&!empty($_POST["changeNewPassword"])&&!empty($_POST["changeRepeatNewPassword"]))
                    {
                        if ($_POST["changeNewPassword"]==$_POST["changeRepeatNewPassword"])
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

                    //Varaibles from form
                    $changeOldPassword=$_POST["changeOldPassword"];
                    $changeNewPassword=$_POST["changeNewPassword"];
                    $changeRepeatNewPassword=$_POST["changeRepeatNewPassword"];

                    // if ($changeNewPassword!=$changeRepeatNewPassword)
                    // {
                    //     echo '<a href="#" class="executive_text">The new passwords are not similar</a><br>';
                    // }
                    

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
                                    $sql = "SELECT password FROM users WHERE username='" .$loginUser."'";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) 
                                    {
                                        while($row = $result->fetch_assoc()) 
                                        {
                                            if ($row["password"]==$changeOldPassword)
                                            {
                                                $sql = "UPDATE users SET password='" .$changeNewPassword."' WHERE username='" .$loginUser."' AND password='" .$loginPass."'";

                                                if ($conn->query($sql) === TRUE) 
                                                {
                                                    echo '<a href="#" class="executive_text">The password is change!</a><br>';                                                    
                                                }
                                                 else 
                                                {
                                                echo "Error updating record: " . $conn->error;
                                                }
                                            }
                                            else
                                            {
                                                echo '<a href="#" class="executive_text">The password is not the same!</a><br>';
                                            }
                                        }
                                    }
                                    else 
                                    {
                                        echo '<a href="#" class="executive_text">Username is not exist!</a><br>';
                                        session_destroy();
                                        header("Location: /singup/login.php");
                                    }
                                
                                } 
                                else
                                {
                                echo '<a href="/singup/activecode.php" class="executive_text">Input activate code from email!</a><br>';
                                session_destroy();
                                header("Location: /singup/login.php");
                                }
                            }
                            }
                        }
                        else
                        {
                            echo '<a href="#" class="executive_text">Wrong Password!</a><br>';
                            session_destroy();
                            header("Location: /singup/login.php");
                        }
                    }
                    } else {
                    echo '<a href="#" class="executive_text">Username does not exists!</a><br>';
                    session_destroy();
                    header("Location: /singup/login.php");
                    }
                    $conn->close();
                    }
                    }
                    else
                    {
                        echo '<a href="#" class="executive_text">The new passwords are not similar</a><br>';
                    }
                }
                    else
                    {
                        //Is empty
                        echo '<a href="#" class="executive_text">Complete all fields!</a><br>';
                    }
                }
                ?>
                <input type="submit" name="" value="Change Password">
                <a href="/index.php" class="loginbox_interactive">Jobs Offerts Chceck Now !</a>
            </form>
            
        </div>
        <script src="/script/mainsingup.js"></script>
</body>
</html>