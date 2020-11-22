<?php
session_start();
if (!isset($_SESSION["loginUser"])||!isset($_SESSION["loginPass"])||!isset($_SESSION["usersID"]))
{
    header("Location: /index.php");
}
else
{
    if (isset($_GET["offertID"])&&!empty($_GET["offertID"])&&!empty($_SESSION["usersID"]))
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
    $usersID=$_SESSION["usersID"];
    $offertID=$_GET["offertID"];
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
                //All date is true
                    $sqlDel = "DELETE FROM `offers` WHERE offersID='" .$offertID."' AND usersID='" .$usersID."'";

                    if ($conn->query($sqlDel) === TRUE)
                    {
                        header("Location: /singupenlargement/styleenlargement.php");
                    } else 
                    {
                    //Error Delete
                        header("Location: /singupenlargement/styleenlargement.php");
                    }
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
        header("Location: /singupenlargement/styleenlargement.php");
    }
}



?>