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
            <div class="loginbox">
            <?php
            if (isset($_GET["idOffert"]))
            {
                if (!empty($_GET["idOffert"]))
                {
                    //Change Varaibles !!
                    $servername = "localhost";
                    $username = "username";
                    $password = "password";
                    $dbname = "myDB";


                    //Variable Offerts Get
                    $idOfferts=$_GET["idOffert"];

                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    // Check connection
                    if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                    }



                    $sql = "SELECT name, company,localization,typeofcontract,offerpublication,description,usersID FROM offers WHERE offersID='" .$idOfferts."'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) 
                    {
                        // output data of each row
                        while($row = $result->fetch_assoc()) 
                        {
                            $name=$row["name"];
                            $company=$row["company"];
                            $localization=$row["localization"];
                            $typeofcontract=$row["typeofcontract"];
                            $offerpublication=$row["offerpublication"];
                            $description=$row["description"];
                            $usersID=$row["usersID"];

                            $sql = "SELECT email FROM users WHERE usersID='" .$usersID."'";
                            $result = $conn->query($sql);
        
                            if ($result->num_rows > 0) 
                            {
                                // output data of each row
                                while($row = $result->fetch_assoc()) 
                                {
                                    $emailOfferts=$row["email"];
                                }
                            } 

                            echo '<h1>'.$name.'</h1>';
                            echo '<form class="offet_creator" action="mailto:'.$emailOfferts.'">';
                            echo '<p>Company</p>';
                            echo '<input type="text" disabled="disabled" name="nameofferts" placeholder="'.$company.'">';
                            echo '<p>Localization</p>';
                            echo '<input type="text" disabled="disabled" name="companyofferts" placeholder="'.$localization.'">';
                            echo '<p>Type Of Contract</p>';
                            echo '<input type="text" disabled="disabled" name="descriptionofferts" placeholder="'.$typeofcontract.'">';
                            echo '<p>Offert Publication</p>';
                            echo '<input type="text" disabled="disabled" name="descriptionofferts" placeholder="'.$offerpublication.'">';
                            echo '<p>Desctiption</p>';
                            echo '<input type="text" disabled="disabled" name="descriptionofferts" placeholder="'.$description.'">';

                            $sql = "SELECT username, email,typeofuser FROM users WHERE usersID='" .$usersID."'";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) 
                            {
                            // output data of each row
                                while($row = $result->fetch_assoc()) 
                                {
                                    $usernameOfferts=$row["username"];
                                    $typeofuserOfferts=$row["typeofuser"];

                                    echo '<p>The user who created the offer</p>';
                                    echo '<input type="text" disabled="disabled" name="descriptionofferts" placeholder="'.$usernameOfferts.'">';
                                    echo '<p>The user is</p>';
                                    echo '<input type="text" disabled="disabled" name="descriptionofferts" placeholder="'.$typeofuserOfferts.'">';
                                    echo '<p>User EMail</p>';
                                    echo '<input type="text" disabled="disabled" name="descriptionofferts" placeholder="'.$emailOfferts.'">';
                                    echo '<input type="submit" value="Apply for a position '.$name.'">';
                                }
                            } 
                            else 
                            {
                                echo '<p>The user who created the offer</p>';
                                echo '<input type="text" disabled="disabled" name="descriptionofferts" placeholder="Sorry, I lost my data, it will not happen again.">';
                                echo '<p>The user is</p>';
                                echo '<input type="text" disabled="disabled" name="descriptionofferts" placeholder="Sorry, I lost my data, it will not happen again.">';
                                echo '<p>User EMail</p>';
                                echo '<input type="text" disabled="disabled" name="descriptionofferts" placeholder="Sorry, I lost my data, it will not happen again.">';
                                echo '<input type="submit" name="" href="/index.php" value="I am missing user data. Sorry">';
                            }
                        }
                    } 
                    else 
                    {
                        header("Location: /index.php");
                        echo '<h1>NO RESULTS FOR THE CRITERION</h1>';
                            echo '<form class="offet_creator">';
                            echo '<p>Company</p>';
                            echo '<input type="text" disabled="disabled" name="nameofferts" placeholder="NO RESULTS FOR THE CRITERION">';
                            echo '<p>Localization</p>';
                            echo '<input type="text" disabled="disabled" name="companyofferts" placeholder="NO RESULTS FOR THE CRITERION">';
                            echo '<p>Type Of Contract</p>';
                            echo '<input type="text" disabled="disabled" name="descriptionofferts" placeholder="NO RESULTS FOR THE CRITERION">';
                            echo '<p>Offert Publication</p>';
                            echo '<input type="text" disabled="disabled" name="descriptionofferts" placeholder="NO RESULTS FOR THE CRITERION">';
                            echo '<p>Desctiption</p>';
                            echo '<input type="text" disabled="disabled" name="descriptionofferts" placeholder="NO RESULTS FOR THE CRITERION">';
                    }
                    $conn->close();
                }
                else
                {
                    header("Location: /index.php");
                    echo '<h1>NO RESULTS FOR THE CRITERION</h1>';
                    echo '<form class="offet_creator">';
                    echo '<p>Company</p>';
                    echo '<input type="text" disabled="disabled" name="nameofferts" placeholder="NO RESULTS FOR THE CRITERION">';
                    echo '<p>Localization</p>';
                    echo '<input type="text" disabled="disabled" name="companyofferts" placeholder="NO RESULTS FOR THE CRITERION">';
                    echo '<p>Type Of Contract</p>';
                    echo '<input type="text" disabled="disabled" name="descriptionofferts" placeholder="NO RESULTS FOR THE CRITERION">';
                    echo '<p>Offert Publication</p>';
                    echo '<input type="text" disabled="disabled" name="descriptionofferts" placeholder="NO RESULTS FOR THE CRITERION">';
                    echo '<p>Desctiption</p>';
                    echo '<input type="text" disabled="disabled" name="descriptionofferts" placeholder="NO RESULTS FOR THE CRITERION">';
                }
            }
            else
            {
                header("Location: /index.php");
                echo '<h1>NO RESULTS FOR THE CRITERION</h1>';
                echo '<form class="offet_creator">';
                echo '<p>Company</p>';
                echo '<input type="text" disabled="disabled" name="nameofferts" placeholder="NO RESULTS FOR THE CRITERION">';
                echo '<p>Localization</p>';
                echo '<input type="text" disabled="disabled" name="companyofferts" placeholder="NO RESULTS FOR THE CRITERION">';
                echo '<p>Type Of Contract</p>';
                echo '<input type="text" disabled="disabled" name="descriptionofferts" placeholder="NO RESULTS FOR THE CRITERION">';
                echo '<p>Offert Publication</p>';
                echo '<input type="text" disabled="disabled" name="descriptionofferts" placeholder="NO RESULTS FOR THE CRITERION">';
                echo '<p>Desctiption</p>';
                echo '<input type="text" disabled="disabled" name="descriptionofferts" placeholder="NO RESULTS FOR THE CRITERION">';
            }
            ?>             
                <!-- <a href="/singup/activecode.php" class="loginbox_interactive">Message has not arrived? Click here!</a><br>
                <a href="/singup/login.php" class="loginbox_interactive">You already have an account? Login!</a> -->
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