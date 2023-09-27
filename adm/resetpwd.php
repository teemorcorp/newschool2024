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

// Grab action
if (isset($_POST['action'])) {
    $action = $_POST['action'];
} else {
    $action = '';
}
//*******************************************************
//*******************  MAIN FORM  ***********************
//*******************************************************
function main_form() {
	global $PHP_SELF, $mysqli, $msg;
	global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
//echo "TEST2!";

$uid = $_GET["uid"];
//echo "UserID = ".$uid;
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
<center>
  <h1>Update Your Password</h1></center>
<form action="<?php echo $PHP_SELF ?>" method="post">
<table align="center" cellpadding="0" cellspacing="0" width="400px">
    <tr>
        <td>
			&nbsp;Enter New Password
        </td>
        <td>
			<input type="password" name="password1" value="" maxlength="20" />
        </td>
    </tr>
    <tr>
        <td>
			&nbsp;Re-enter Password
        </td>
        <td>
			<input type="password" name="password2" value="" maxlength="20" />
        </td>
    </tr>
</table>
<center><input name="action" type="submit" value="Update" /></center>
</form>
</body>
</html>
<?php
}

//*******************************************************
//*******************  UPDATE ***************************
//*******************************************************
function update_form() {
	global $PHP_SELF, $mysqli, $msg;
	global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;

$uid = $_GET["uid"];
$password1 = $_POST['password1'];
$password2 = $_POST['password2'];

$sql = $mysqli->query("SELECT * FROM $users_tablename WHERE useremail = '$email'");
if(!$sql) error_message("Error fetching data from $users_tablename (lostpwd) line #79");
$row = $sql->fetch_assoc();
$userpassword = $row['userpassword'];

if(empty($password1)) {
	echo "\rYou must enter a password!";
?>
<FORM METHOD="POST" ACTION="<?php echo $PHP_SELF ?>">
	<INPUT TYPE="SUBMIT" VALUE="Try Again" name="action">
</FORM>
<?php
	exit;
}

if(empty($password2)) {
	echo "\rYou must re-enter a password!";
?>
<FORM METHOD="POST" ACTION="<?php echo $PHP_SELF ?>">
	<INPUT TYPE="SUBMIT" VALUE="Try Again" name="action">
</FORM>
<?php
	exit;
}

if($password1 != $password2) {
	echo"Your passwords do not match!";
?>
<FORM METHOD="POST" ACTION="<?php echo $PHP_SELF ?>">
	<INPUT TYPE="SUBMIT" VALUE="Try Again" name="action">
</FORM>
<?php
	exit;
} else {
	$password = md5($password1);
	//echo "Password = ".$password;
}
$password = md5($password1);

//echo "Old pwd = ".$userpassword."<br>";
//echo "New pwd = ".$password."<br>";
//exit;
$sql = $mysqli->query("UPDATE $users_tablename SET userpassword = '$password' WHERE userid = '$uid'");
//$sql = "UPDATE $users_tablename SET userpassword = '$password' WHERE userid = '$uid'";

?>
<script type="text/javascript">
	<!--
	window.top.location.href = "http://ihnbible.org"; 
	-->
</script>
<?php
}

//*******************************************************
//**********************  SWITCH  ***********************
//*******************************************************
switch($action) {
   case "Update":
      update_form();
   break;
   default:
	  main_form();
   break;
}
?>

