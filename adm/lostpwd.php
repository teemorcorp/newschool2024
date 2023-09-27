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

?>
<script language="JavaScript">
    function function1() {
        document.all.Uname.focus();
    }
</script>
<html>
<head>
<title>Forgot Password</title>
<style type="text/css">
#Uname
{
	width: 200px;
}

body{
	background-color:#FFF;
	color:#000;
}
</style>
</head>
<body onLoad="document.all.Uname.focus()">
<center>
<p><b>Please enter your email address below and click on the submit button. You will be sent a link in your email.<br>When you get it just click the link which will take you to a page that allows you to enter a new password.</b></p>
<br>
<br>
</center>
<form action="<?php echo $PHP_SELF ?>" method="post">
    <table align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td style="text-align: right">
                Email Address:</td>
            <td>
                <input maxlength="50" id="Uname" name="email" size="30" type="text" value="" /></td>
        </tr>
        <tr>
            <td colspan="2">
            <center><input name="action" type="submit" value="Submit" /></center>
        </tr>
    </table>
</form>
</body>
</html>
<?php
}

//*******************************************************
//*******************  CHECK LOGIN  *********************
//*******************************************************

function check_login() {
	global $PHP_SELF, $mysqli, $msg;
	global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;

$email = $_POST['email'];

$sql = $mysqli->query("SELECT * FROM $users_tablename WHERE useremail = '$email'");
if(!$sql) error_message("Error fetching data from $users_tablename (lostpwd) line #79");
$row = $sql->fetch_assoc();
$uid = $row['userid'];
$_SESSION['uid'] = $uid;

if(empty($email)) {
	echo "\rYou Must Enter An Email Address";
?>
<FORM METHOD="POST" ACTION="<?php echo $PHP_SELF ?>">
	<INPUT TYPE="SUBMIT" VALUE="Try Again" name="action">
</FORM>
<?php
	exit;
}
else
if(!$uid or empty($uid)) {
	echo "\rNo account found with that email address!";
?>
<FORM METHOD="POST" ACTION="<?php echo $PHP_SELF ?>">
    <INPUT TYPE="SUBMIT" VALUE="Try Again" name="action">
</FORM>
<?php
	exit;
}
welcome_back();
}

//*******************************************************
//*******************  WELCOME BACK  ***********************
//*******************************************************
function welcome_back() {
	global $PHP_SELF, $mysqli, $msg;
	global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;

$uid = $_SESSION['uid'];

?>
	<script type="text/javascript">
		<!--
		window.location = "changepwd.php?uid=<?php echo $uid ?>"
		-->
	</script>
<?php
}

//*******************************************************
//**********************  SWITCH  ***********************
//*******************************************************


switch($action) {
   case "Try Again":
      main_form();
   break;
   case "Submit":
      check_login();
   break;
   default:
	  main_form();
   break;
}

?>