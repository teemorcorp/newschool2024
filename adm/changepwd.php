<?php
/****************************************************
****   IHN Bible College
****   Designed by: Tom Moore
****   Written by: Tom Moore
****   (c) 2019 TEEMOR eBusiness Solutions
****************************************************/
include "include/globals.php";
session_start();
db_connect();

$uid = $_GET["uid"];
//echo "UID = ".$uid."<br>";

//***************************************************************
$sql = $mysqli->query("SELECT * FROM $users_tablename WHERE userid = '$uid'");
if(!$sql) error_message("Error fetching data from $users_tablename (changepwd) line #16");
$row = $sql->fetch_assoc();	
$uid = $row['userid'];
$email = $row['useremail'];

$to = $email;
$subject = "Password Reset Request";
$url = "http://ihnbible.org/resetpwd.php?uid=".$uid;
$message = "<html><head><title></title></head><body><p><b>Someone has requested your password be changed. If this is not you then simply disregard this email. Nothing more will happen.<br><br>However, if you did requst to change your password please click the link below to reset your password now.</b></p>".$url."</body></html>";
$from = "support@ihnbible.org";
$headers = "From:".$from . "\r\n";
$headers .= 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

if (mail($to, $subject, $message, $headers)) {
   echo("<p>Message successfully sent!</p>");
  } else {
   echo("<p>Message delivery failed...</p>");
  }
echo "Mail Sent.";

//***************************************************************
?>
<html>
<head>
<style>
body{
	background-color:#FFF;
	color:#000;
}
</style>
</head>
<body>
Please check your inbox. If you do not see an email from "support" with a subject line of "IHN Bible College password reset" then<br><br><strong>please check your spam box and mark our emails as NOT SPAM</strong>.<br><br>We promise not to spam. Thank you very much.
</body>
</html>