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
    <title>Account Recovery A Make Future</title>
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
            <h1>Account Recovery</h1>
            <form action="" method="POST">
                <p>Email</p>
                <input type="email" name="recoveryEmail" placeholder="Enter Username">
                <?php
//Change Varaibles !!
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDB";

if (isset($_POST["recoveryEmail"]))
{
	
if (!empty($_POST["recoveryEmail"]))
{
	
//Variables Session
$_SESSION["recoveryEmail"]=$_POST["recoveryEmail"];

//Variables submitted by user
$loginMail=$_SESSION["recoveryEmail"];	
		


//Variable Random AcitaveCode
$activatecode=rand(10000,99999999);
$generateNewPassowrd=rand(1111111,99999999);

//Variable Date
$date = new DateTime('now');
$convertDateNow=$date->format("Y-m-d H:i:s");
//Time is value and no convert (min)
$timeFromDataBase=50;
//Time dalay resendCode
$timeDelayResendCode=5;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

//Get information last generate activate code form database
$timeFromDataBase=GetTimeResendCode($servername,$username,$password,$dbname,$loginMail,$convertDateNow);


if ($timeFromDataBase>=$timeDelayResendCode && $timeFromDataBase!=NULL)
{

$sql="SELECT  email FROM users WHERE email='" .$loginMail."'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $sql =  "UPDATE users SET codeactivate='" .$activatecode."',creationdatecodeactivate='" .$convertDateNow."',codeconfirmation='0',password='" .$generateNewPassowrd."' WHERE email='" .$loginMail."'";
   
    //send email acitave code

    $to      = $loginMail;
    $subject = 'Security code - unitysnakebytomsztyl';
    $message = 'Hello, if you got an e-mail, you probably reset
     account. Your security code is: '. $activatecode.'
	Your password code is: '. $generateNewPassowrd.'
                                                                                                 
     If you don t recognize this message, please ignore it';
    $headers = array(
    'From' => 'unitysnakebytomsztyl@gmail.com',
    'Reply-To' => 'unitysnakebytomsztyl@gmail.com'
    );

    mail($to, $subject, $message, $headers);

    if ($conn->query($sql) === TRUE) {
        echo '<p>Active Code From Email</p>';
        echo '<input type="password" name="recoveryCode" placeholder="Enter Active Code From Email">';
        echo '<a href="#" class="executive_text">Email was resent!</a><br>';
     //echo "Email was resent";
    } else {
        echo '<a href="#" class="executive_text">Error: '.$sql.$conn->error.'</a><br>';
    //echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo '<a href="#" class="executive_text">Email does not exists!</a><br>';
    //echo "Username does not exists.";
}
}
else if ($timeFromDataBase==NULL)
{    
    //echo "$timeFromDataBase";
    //echo "Email does not exists.";
    echo '<a href="#" class="executive_text">Email does not exists!</a><br>';
}
else
{
    echo '<a href="#" class="executive_text">You must wait: '.DelayTimeCalculator($timeFromDataBase,$timeDelayResendCode).'</a><br>';
    //echo "You must wait: ".DelayTimeCalculator($timeFromDataBase,$timeDelayResendCode);
}
$conn->close();
}
else
{
	//Is empty
    echo '<a href="#" class="executive_text">Complete all fields!</a><br>';
}
}


function DelayTimeCalculator($minDataBase,$minDelay)
{
    $mins=$minDelay-$minDataBase;
    return "$mins"."min";
}

function GetTimeResendCode($servername,$username,$password,$dbname,$loginMail,$convertDateNow)
{
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }


    $sql = "SELECT email FROM users WHERE email='" .$loginMail."'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          if ($row["email"]==$loginMail)
          {
              $sql = "SELECT creationdatecodeactivate FROM users WHERE email='" .$loginMail."'";
              $result = $conn->query($sql);
      
              if ($result->num_rows > 0)
              {
                  // output data of each row
                  while($row = $result->fetch_assoc())
                  {
                    return CheckTimeDelayResendCode($row["creationdatecodeactivate"],$convertDateNow);
                  }
              }
          }
          else
          {
              //echo "Wrong Password";
              return NULL;
          }
        }
      } else {
        //echo "Email does not exists.";
        return NULL;
      }
      $conn->close();
     
}

function CheckTimeDelayResendCode($timestart,$timeend)
{
    $start = strtotime("$timestart");
    $end = strtotime("$timeend");

    $mins = (int)(($end - $start) / 60);//in minuts
    //$chaneRestMin=$mins%60; //in minuts convert to 60
    //echo $mins.' minutues'.'<br>';
    //echo "$chaneRestMin";

    return $mins;
}

function getUserIpAddr(){
  if(!empty($_SERVER['HTTP_CLIENT_IP'])){
      //ip from share internet
      $ip = $_SERVER['HTTP_CLIENT_IP'];
  }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
      //ip pass from proxy
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }else{
      $ip = $_SERVER['REMOTE_ADDR'];
  }
  return $ip;
}

?>
                <input type="submit" name="" value="Recovery Account">
                <a href="/singup/login.php" class="loginbox_interactive">You already have an account? Login!</a>
                <a href="/singup/register.php" class="loginbox_interactive">Don't have an account? Register now!</a>
            </form>
            
        </div>
        <script src="/script/mainsingup.js"></script>   
</body>
</html>