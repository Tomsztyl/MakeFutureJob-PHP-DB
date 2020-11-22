<?php
session_start();
if (!isset($_SESSION["loginUser"])||!isset($_SESSION["loginPass"]))
{
    header("Location: /singup/login.php");
}
else
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
    <link rel="icon" href="/image/logo.png">
    <script src="https://kit.fontawesome.com/53dfc2c2bc.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Yanone+Kaffeesatz">
    <title>Create Offert</title>
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
                <li><a href="/menusubdomain/contact.php" class="active_menu">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Contact
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
            <div class="loginbox">
            <h1>Add offert</h1>
            <form class="offet_creator" action="" method="POST">
                <p>Name</p>
                <input type="text" name="nameofferts" placeholder="Enter Name of Offert">
                <p>Company</p>
                <input type="text" name="companyofferts" placeholder="Enter Company">
                <p>Localization</p>
                <input type="text" list="localizationofferts" name="localizationofferts" placeholder="Enter Localization">
                <datalist id="localizationofferts">
                    <option value="Podlaskie">
                    <option value="Warmińsko-mazurskie">
                    <option value="Pomorskie">
                    <option value="Zachodnio-pomorskie">
                    <option value="Lubuskie">
                    <option value="Wielkopolskie">
                    <option value="Łódzkie">
                    <option value="Kujawsko-pomorskie">
                    <option value="Mazowieckie">
                    <option value="Lubelskie">
                    <option value="Świętokrzyskie">
                    <option value="Podkarpackie">
                    <option value="Małopolskie">
                    <option value="Śląskie">
                    <option value="Opolskie">
                    <option value="Dolnośląskie">
                </datalist>   
                <p>Type Of Contract</p>
                <input type="text" list="typeOfContractofferts" name="typeOfContractofferts" placeholder="Enter Type Of Contract">
                <datalist id="typeOfContractofferts">
                    <option value="Contract of employment">
                    <option value="Contract work">
                    <option value="Contract of mandate">
                    <option value="Contract B2B">
                    <option value="Contract Replacement">
                    <option value="An agency agreement">
                </datalist>
                <p>Description</p>
                <input type="text" name="descriptionofferts" placeholder="Enter Description">
                <?php
                if (isset($_POST["nameofferts"])&& isset($_POST["companyofferts"])&& isset($_POST["localizationofferts"])&& isset($_POST["typeOfContractofferts"])&& isset($_POST["descriptionofferts"]))
                {
                    if (!empty($_POST["nameofferts"])&&!empty($_POST["companyofferts"])&&!empty($_POST["localizationofferts"])&&!empty($_POST["typeOfContractofferts"])&&!empty($_POST["descriptionofferts"]))
                    {
                        //Change Varaibles !!
                        $servername = "localhost";
                        $username = "username";
                        $password = "password";
                        $dbname = "myDB";
                        
                        //Varables form
                        $nameofferts=$_POST["nameofferts"];
                        $companyofferts=$_POST["companyofferts"];
                        $localizationofferts=$_POST["localizationofferts"];
                        $typeOfContractofferts=$_POST["typeOfContractofferts"];
                        $descriptionofferts=$_POST["descriptionofferts"];
                        
                        //Variables Sesion
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

                                $sqlCode = "SELECT codeconfirmation,usersID FROM users WHERE username='" .$loginUser."'";

                                $resultCode = $conn->query($sqlCode);

                                if ($resultCode->num_rows>0)
                                {
                                //output data of each row
                                while ($row=$resultCode->fetch_assoc())
                                {
                                    if ($row["codeconfirmation"]=="1")
                                    {
                                        $userID=$row["usersID"];
                                        
                                        $date = new DateTime('now');
                                        $convertDateNow=$date->format("Y-m-d");

                                        $sql = "UPDATE users SET typeofuser='recruiter' WHERE usersID='" .$userID."'";

                                        if ($conn->query($sql) === TRUE) {
                                            echo '<a href="#" class="executive_text">You have status Recruiter!</a><br>';
                                        } else {
                                            echo '<a href="#" class="executive_text">Error: '.$sql."<br>".$conn->error.'</a><br>';
                                        }

                                        $sql = "INSERT INTO offers (name, company, localization, typeofcontract, offerpublication, description, usersID) 
                                        VALUES ('$nameofferts','$companyofferts','$localizationofferts','$typeOfContractofferts','$convertDateNow','$descriptionofferts','$userID')";
                                    
                                        if ($conn->query($sql) === TRUE) 
                                        {
                                            echo '<a href="#" class="executive_text">Offer Created!</a><br>';
                                        } 
                                        else 
                                        {
                                            echo '<a href="#" class="executive_text">Error: '.$sql."<br>".$conn->error.'</a><br>';
                                        }
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
                <input type="submit" name="" value="Create Offerts">
                <!-- <a href="/singup/activecode.php" class="loginbox_interactive">Message has not arrived? Click here!</a><br>
                <a href="/singup/login.php" class="loginbox_interactive">You already have an account? Login!</a> -->
            </form>            
            </div>
            <div class="offertsOverflow">
            <?php
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

                            $sqlCode = "SELECT codeconfirmation,usersID FROM users WHERE username='" .$loginUser."'";

                            $resultCode = $conn->query($sqlCode);

                            if ($resultCode->num_rows>0)
                            {
                            //output data of each row
                            while ($row=$resultCode->fetch_assoc())
                            {
                                if ($row["codeconfirmation"]=="1")
                                {
                                    $_SESSION["usersID"]=$row["usersID"];
                                    $sql = "SELECT offersID,name FROM offers
                                    INNER JOIN users ON offers.usersID=users.usersID WHERE users.username='" .$loginUser."'";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) 
                                    {
                                    // output data of each row
                                        while($row = $result->fetch_assoc()) 
                                        {
                                            $offertID=$row["offersID"];
                                            echo '<div class="offertsOverflowIn">';
                                            echo '<h1 class="offertsOverflowName">'.$row["name"].'</h1>';
                                            echo '<a href="/singupenlargement/deleteoffert.php?offertID='.$offertID.'"><input class="offertsOverflowButton" type="submit" value="Remove Offert"> </a>';
                                            echo '</div>';
                                        }
                                    } 
                                    else 
                                    {
                                        echo '<div class="offertsOverflowIn">';
                                        echo '<h1 class="offertsOverflowName">No results</h1>';
                                        echo '</div>';
                                    }
                                }
                                else
                                {
                                    echo '<div class="offertsOverflowIn">';
                                    echo '<h1 class="offertsOverflowName">No active code</h1>';
                                    echo '</div>';
                                }
                            }
                            }
                        }
                        else
                        {
                            echo '<div class="offertsOverflowIn">';
                            echo '<h1 class="offertsOverflowName">Wrong password</h1>';
                            echo '</div>';
                        }
                    }
                    } else {
                        echo '<div class="offertsOverflowIn">';
                        echo '<h1 class="offertsOverflowName">Username not exist</h1>';
                        echo '</div>';
                    }
                    $conn->close();
                    }
                    }
                    else
                    {
                        //Is empty
                        echo '<div class="offertsOverflowIn">';
                        echo '<h1 class="offertsOverflowName">You are not logged</h1>';
                        echo '</div>';
                    }
                }
                ?>                
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