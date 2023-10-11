<?php
/****************************************************
****   IHN Bible College
****   Designed by: Tom Moore
****   Written by: Tom Moore
****   (c) 2001 - 2021 TEEMOR eBusiness Solutions
****************************************************/
ob_start();  // Turns on output buffering

date_default_timezone_set("America/Phoenix");

global $PHP_SELF, $mysqli, $msg, $con, $dbhost, $dbuser, $dbpwd, $dbname;

// SERVER
$dbhost = "localhost";
$dbuser = "teemorco_ihnschl";
$dbpwd = "1nh15nam3";
$dbname = "teemorco_ihnschool";

// LOCAL
// $dbhost = "localhost";
// $dbuser = "school2";
// $dbpwd = "1nh15nam3";
// $dbname = "school2";

// try{
//     // SERVER
//     $con = new PDO("mysql:dbname=teemorco_ihnschool;host=localhost", "teemorco_ihnschl", "1nh15nam3");
//     // LOCALHOST
//     // $con = new PDO("mysql:dbname=school2;host=localhost", "school2", "1nh15nam3");
    
//     $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
// }
// catch(PDOException $e){
//     echo "Connection failed: " . $e->getMessage();
// }
?>