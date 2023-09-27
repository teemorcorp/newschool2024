<?php
/*************************************************************
** IHN Bible College Online
** Author: TJ Moore
** tjmooredev@gmail.com
** Copyright (c) 2001 - 2021 Thomas J. Moore, D.D.
**************************************************************/
include 'includes/globals.php';
session_start();
db_connect();

if($mysqli->connect_error) {
	echo 'Failed to connect to server: (' . $mysqli->connect_error . ') ' . $mysqli->connect_error;
}

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
global $programs_tablename, $progid, $progname, $enabled, $cost, $charge;
global $progenroll_tablename, $progenrollid, $enrprogid, $enruserid;

$main_background_color = "#1c262f";
$sub_background_color = "#26333c"; 
$child_background_color = "#2f3d4a";

//$_SESSION['userid'] = "1";
$userid = $_SESSION['userid'];

// Attempt select query execution
$sql = "SELECT * FROM $users_tablename WHERE userid = '$userid'";
if($result = mysqli_query($mysqli, $sql)){
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        $userid = $row['userid'];
        $useremail = $row['useremail'];
        $isadmin = $row['isadmin'];
        $userfname = $row['userfname'];
        $userlname = $row['userlname'];
        $imagepath = $row['imagepath'];
        $fullname = $userfname." ".$userlname;
        // Free result set
        mysqli_free_result($result);
    } else{
        $msg = "<font color='#FF0000'><strong>Account Does Not Exsist!</strong></font>";
        main_form();
        exit;
    }
} else{
    echo "ERROR: Was not able to execute Query on line #152. " . mysqli_error($mysqli);
}
// End attempt select query execution

include 'templates/include.tpl';
include "templates/style.tpl";
?>
<body>
<div class='container-fluid'>
<?php
include "templates/topmenu.tpl";
?>

<!-- *****************************************************************************************************
*******  MAIN
*******************************************************************************************************-->    
<section>
    <div class="row" style="height: 100vh;">
        <div class="col-sm-2" style="background-color:#1c262f; padding-left: 0px;">
            <?php include "templates/leftmenu.tpl"; ?>
        </div>
        <div class="col-10">
            <div class="row " style="padding-top:10px;">
                <div class="col-12">
                    

                    <!-- *******************************************************************************************
                    **********  POPULAR PRODUCTS
                    *********************************************************************************************-->
                    <section style="padding-top:20px;">
                        <h1>Enroller</h1>
                        <center>
                        <?php echo $msg; ?>
                        </center>
                        <br>
                        <br>
                        <div class="card text-dark bg-light mb-1" id="boxdisplay">
                            <div class="card-header">
                                <font size="+2"><strong>Add Enrollment</strong></font>
                            </div>
                            <div class="card-body">
                                <form action="<?php echo $PHP_SELF ?>" method="post">
                                    <table class="table">
                                        <tr>
                                            <td>
                                                <strong>Program</strong>
                                            </td>
                                            <td>
                                                <select class="input_text" name="progid">
                                                    <!--option value="0"><<< MAKE A SELECTION >>></option-->
                                                    <?php
                                                    $sqlb = $mysqli->query("SELECT progid, progname FROM $programs_tablename ORDER BY progid ASC");
                                                    if(!$sqlb) error_message("Error in $programs_tablename (programs) line #109");
                                                    $sqlb->data_seek(0);
                                                    while($rowb = $sqlb->fetch_assoc()) {
                                                        $progid = $rowb['progid'];
                                                        $progname = $rowb['progname'];
                                                        
                                                    ?>
                                                    <option value="<?php echo $progid ?>"><?php echo $progname ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>User ID</strong>
                                            </td>
                                            <td>
                                                <input maxlength="50" name="uid" size="30" type="text" value="" />
                                            </td>
                                        </tr>
                                    </table>
                                    <br /><br />
                                    <input class="btn btn-success" type="submit" name="action" value="Save Enrollment" />
                                </form>
                                <br /><br />
                            </div>
                        </div>
                    </section>
                    <br><br>
                </div>
            </div>
        </div>
    </div>
</section>

<br><br>
<?php
?>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="js/pushy.min.js"></script>
</body>
</html>
<?php
}

//*******************************************************
//*********************  SAVE EXAM  *********************
//*******************************************************
function save_enrollment(){
    global $PHP_SELF, $mysqli, $msg;
    global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
    global $programs_tablename, $progid, $progname, $enabled, $cost, $charge;
    global $progenroll_tablename, $progenrollid, $enrprogid, $enruserid;

    $progid = $_POST['progid'];
    $uid = $_POST['uid'];

    $query = $mysqli->query("INSERT INTO $progenroll_tablename (progenrollid, enrprogid, enruserid) VALUES (NULL, '$progid', '$uid')");
    if(!$query) error_message("Error fetching data from $progenroll_tablename (quest_edit) line #171");

    $msg = "Updated!<br><br>";

    main_form();
}


//*******************************************************
//**********************  SWITCH  ***********************
//*******************************************************
switch($action) {
	case "Save Enrollment":
		save_enrollment();
	break;
	default:
		main_form();
	break;
}
?>