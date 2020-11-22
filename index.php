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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Yanone+Kaffeesatz">
    <link rel="icon" href="/image/logo.png">
    <title>Make Future</title>
    <link rel="stylesheet" href="/style/styles.css">
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
                <li class="logo" ><img src="image/logo.png" alt=""></li>
                <li><a href="menusubdomain/brands.php" class="active_menu">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Brands
                </a></li>
                <li><a href="menusubdomain/contact.php" class="active_menu">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Contact
                </a></li>
                <li><a href="singupenlargement/styleenlargement.php" class="active_menu">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Create Offert
                </a></li>
                <?php
                    if (isset($_SESSION["loginUser"])||isset($_SESSION["loginPass"]))
                    {
                        echo '<li><a href="singupenlargement/manageraccount.php" class="login-btn">';
                        echo '<span class="singup-btn">'.$_SESSION["loginUser"].'</span>';
                        echo '</a></li>';
                        echo '<li><a href="singup/loggingOut.php" class="register-btn"><span class="singup-btn">Log out</span></a></li>';
                    }
                    else
                    {
                        echo '<li><a href="singup/login.php" class="login-btn">';
                        echo '<span class="singup-btn">Login</span>';
                        echo '</a></li>';
                        echo '<li><a href="singup/register.php" class="register-btn"><span class="singup-btn">Register</span></a></li>';
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
                <div class="app-text">
                    <h1>Work where and how you want!</h1>
                    <p>Tip! If you are looking for a job, look for it in big cities!<br>
                    <br>Tip! There are more and more remote work on the market!
                    </p>
                </div>            
            </div>
            <div>
                <form class="search-box" action="" method="POST">
                <input class="search-txt-job" type="txt" name="job" placeholder="Type your job">
                <input class="search-txt-city" list="city" type="txt" name="city" placeholder="Type your city">
                <datalist id="city">
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
                <button class="search-btn" type="submit">
                    <i class="fas fa-search-dollar"></i>
                </button>
            </form>
            </div>  
        </header>
        <article>

        <?php
        if (isset($_POST["job"])||isset($_POST["city"]))
        {
            $isEmpty=FALSE;

            if (empty($_POST["job"])&&empty($_POST["city"]))
            $isEmpty=TRUE;
            if (!$isEmpty)
            {
                //Change Varaibles !!
                $servername = "localhost";
                $username = "username";
                $password = "password";
                $dbname = "myDB";

                $job=$_POST["job"];
                $city=$_POST["city"];

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
                }

                if (!empty($_POST["job"])&&!empty($_POST["city"]))
                {
                    $sql = "SELECT offersID,name,company,localization,typeofcontract,offerpublication,users.username FROM offers
                    JOIN users ON offers.usersID=users.usersID WHERE name='" .$job."' AND localization='" .$city."'";
                }
                else if (!empty($_POST["job"]))
                {
                    $sql = "SELECT offersID,name,company,localization,typeofcontract,offerpublication,users.username FROM offers
                    JOIN users ON offers.usersID=users.usersID WHERE name='" .$job."'";
                }
                else if (!empty($_POST["city"]))
                {
                    $sql = "SELECT offersID,name,company,localization,typeofcontract,offerpublication,users.username FROM offers
                    JOIN users ON offers.usersID=users.usersID WHERE localization='" .$city."'";
                }

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    // echo $row["name"]."<br>";
                    // echo $row["company"]."<br>";
                    // echo $row["localization"]."<br>";
                    // echo $row["username"]."<br>";
                    // echo "End Res";
                    //Variable Get Offert Id From DB
                    $offertID=$row["offersID"];

                    echo '<div class="job_offer">';
                    echo '<h2><a href="/singupenlargement/offertwatch.php?idOffert='.$offertID.'" class="active_offer">'.$row["name"].'</h2>';
                    echo '<span></span>';
                    echo '<span></span>';
                    echo '<span></span>';
                    echo '<span></span>';
                    echo '<i class="fas fa-building"></i>';
                    echo '<h3>'.$row["company"].'/'.$row["username"].'</h3>';
                    echo '<i class="fas fa-map-marker-alt"></i>';
                    echo '<h4>'.$row["localization"].'</h4>';
                    echo '<i class="fas fa-globe-europe"></i>';
                    echo '<h5>'.$row["typeofcontract"].'</h5>';
                    echo '<h6>Opublikowane:'.$row["offerpublication"].'</h6>';
                    echo '</div>';
                }
                } else {
                    echo '<div class="job_offer">';
                    echo '<h2><a href="#" class="active_offer">No results for the criterion</h2>';
                    echo '<span></span>';
                    echo '<span></span>';
                    echo '<span></span>';
                    echo '<span></span>';
                    echo '</div>';
                }
                $conn->close();
            }
            else
            {
                //Change Varaibles !!
                $servername = "localhost";
                $username = "username";
                $password = "password";
                $dbname = "myDB";


                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT offersID,name,company,localization,typeofcontract,offerpublication,users.username FROM offers
                JOIN users ON offers.usersID=users.usersID ORDER BY RAND() limit 30";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    // echo $row["name"]."<br>";
                    // echo $row["company"]."<br>";
                    // echo $row["localization"]."<br>";
                    // echo $row["username"]."<br>";
                    // echo "End Res";
                    $offertID=$row["offersID"];

                    echo '<div class="job_offer">';
                    echo '<h2><a href="/singupenlargement/offertwatch.php?idOffert='.$offertID.'" class="active_offer">'.$row["name"].'</h2>';
                    echo '<span></span>';
                    echo '<span></span>';
                    echo '<span></span>';
                    echo '<span></span>';
                    echo '<i class="fas fa-building"></i>';
                    echo '<h3>'.$row["company"].'/'.$row["username"].'</h3>';
                    echo '<i class="fas fa-map-marker-alt"></i>';
                    echo '<h4>'.$row["localization"].'</h4>';
                    echo '<i class="fas fa-globe-europe"></i>';
                    echo '<h5>'.$row["typeofcontract"].'</h5>';
                    echo '<h6>Opublikowane:'.$row["offerpublication"].'</h6>';
                    echo '</div>';
                }
                } else {
                    echo '<div class="job_offer">';
                    echo '<h2><a href="#" class="active_offer">No results for the criterion</h2>';
                    echo '<span></span>';
                    echo '<span></span>';
                    echo '<span></span>';
                    echo '<span></span>';
                    echo '</div>';
                }
                $conn->close();
            }
        }
        ?>
        </article>
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
        
        
        <!-- <div class="app-picture">
            <img src="image/background.jpg" alt="">
        </div>   -->
            
    </div>
    <script src="/script/main.js"></script>
</body>
</html>