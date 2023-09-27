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
global $prog_det_tablename, $progdetid, $progid, $courseid, $coursecode, $coursename, $coursecredits;
global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $coursedesc, $credits, $filename, $validcourse;
global $progcourses_tablename, $pgid, $progid, $courseid;

$main_background_color = "#1c262f";
$sub_background_color = "#26333c"; 
$child_background_color = "#2f3d4a";

$_SESSION['userid'] = "1";
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
                        <h1>Student Management</h1>
                        <center>
                        <?php echo $msg; ?>
                        <br>
                        <form action="<?php echo $PHP_SELF ?>" method="post">
                            <input class='btn btn-primary' name="action" type="submit" value="Add New" />
                        </form>
                        </center>
                        <br>
                        <div class="card text-dark bg-light mb-1" id="boxdisplay">
                            <div class="card-header">
                                <font size="+2"><strong>Students</strong></font>
                            </div>
                            <div class="card-body">
                                <form action="<?php echo $PHP_SELF ?>" method="post">
                                    <table class="table">
                                        <tr>
                                            <td><font size="+1"><strong>Student ID</strong></font></td>
                                            <td><font size="+1"><strong>Student Name</strong></font></td>
                                            <td><font size="+1"><strong>Email</strong></font></td>
                                            <td><font size="+1"><strong>Country</strong></font></td>
                                            <td align="right"><font size="+1"><strong>View/Modify</strong></font></td>
                                        </tr>
                                        <tbody>
                                        <tr>
                                            <?php
                                            // Attempt select query execution
                                            $sql = "SELECT * FROM $users_tablename ORDER BY userfname ASC";
                                            if($result = mysqli_query($mysqli, $sql)){
                                                if(mysqli_num_rows($result) > 0){
                                                    while($row = mysqli_fetch_array($result)){
                                                        $studentid = $row['userid'];
                                                        $useremail = $row['useremail'];
                                                        $userfname = $row['userfname'];
                                                        $usermname = $row['usermname'];
                                                        $userlname = $row['userlname'];
                                                        $usercountry = $row['usercountry'];
                                                        if(empty($usermname)){
                                                            $fullname = $userfname." ".$userlname;
                                                        }else{
                                                            $fullname = $userfname." ".$usermname." ".$userlname;
                                                        }
                                                        ?>
                                                        <tr>
                                                            <form action="<?php echo $PHP_SELF ?>" method="post">
                                                                <td><?php echo $studentid; ?></td>
                                                                <td><?php echo $fullname; ?></td>
                                                                <td><?php echo $useremail; ?></td>
                                                                <td><?php echo $usercountry; ?></td>
                                                                <td align="right">
                                                                    <input type="hidden" name="progid" value="<?php echo $progid ?>">
                                                                    <!--input class='btn btn-success' name="action" type="submit" value="View/Modify" /-->
                                                                    <button class="btn btn-success" name="action" type="submit" value="View/Modify">View/Modify</button>
                                                                </td>
                                                            </form>
                                                        </tr>
                                                        <?php
                                                    }
                                                    // Free result set
                                                    mysqli_free_result($result);
                                                } else{
                                                    ?>
                                                    <tr>
                                                        <td colspan="5"><center>No data available in table</center></td>
                                                    </tr>
                                                    <?php
                                                }
                                            } else{
                                                echo "ERROR: Was not able to execute Query on line #213. " . mysqli_error($mysqli);
                                            }
                                            // End attempt select query execution
                                            ?>
                                        </tr>
                                    </table>
                            </div>
                        </div>
                    </section>


                </div>
                <!--div class="col-sm-1"></div-->
            </div>
        </div>
    </div>
</section>

<br><br>
<?php
//include 'templates/footer.tpl';
?>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="js/pushy.min.js"></script>
</body>
</html>
<?php
}


//********************************************************************************************************************************
//***  EDIT RECORD
//********************************************************************************************************************************
function edit_record(){
    global $PHP_SELF, $mysqli, $msg;
    global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
    global $programs_tablename, $progid, $progname, $enabled, $cost, $charge;
    global $prog_det_tablename, $progdetid, $progid, $courseid, $coursecode, $coursename, $coursecredits;
    global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $coursedesc, $credits, $filename, $validcourse;
    global $progcourses_tablename, $pgid, $progid, $courseid;

    $main_background_color = "#1c262f";
    $sub_background_color = "#26333c"; 
    $child_background_color = "#2f3d4a";
	
    $progid = $_POST['progid'];

    $sql = $mysqli->query("SELECT * FROM $programs_tablename WHERE progid = '$progid'");
    if(!$sql) error_message("Error in $programs_tablename (programs) line #147");
    $row = $sql->fetch_assoc();	
    $progname = $row['progname'];
    $enabled = $row['enabled'];
    $cost = $row['cost'];
    $charge = $row['charge'];

    $_SESSION['progname'] = $progname;
    $_SESSION['enabled'] = $enabled;
    $_SESSION['cost'] = $cost;
    $_SESSION['charge'] = $charge;

    include 'templates/include.tpl';
    include "templates/style.tpl";
    ?>
    <body>
<div class='container-fluid'>
    <section>
        <div style="height: 60px;">
            <div class="row" style="background-color: #a90329; background-image: linear-gradient(to bottom, #00c3ff, #0084ff); height: 60px; padding-top: 0px;">
                <div class="col-sm-6" align="left" style="padding-top: 0px;">
                    <a class="navbar-brand" href="#">
                    <img src="img/IHN_Logo_1000x1000_trans.png" style="height: 40px; margin-top: 5px;"><font color="#ffffff" style="margin-bottom: 40px;"><strong>IHN BIBLE COLLEGE</strong></font>
                    </a>
                </div>
                <div class="col-sm-6" align="right" style="padding-top: 10px;">
                    <img src="img/tom1.jpg" width="40px;" style="border-radius: 50%;">&nbsp;&nbsp;&nbsp;<font color="#ffffff"><strong>Administrator</strong>&nbsp;&nbsp;&nbsp;<i class="fas fa-cog" style="margin-top: 10px;"></i></font>
                </div>
            </div>
        </div>
    </section>

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
                        <form action="<?php echo $PHP_SELF ?>" method="post">
                            <center>
                            <table class="table">
                                <tr>
                                    <td width="200" align="right" valign="top">
                                        Program ID:
                                    </td>
                                    <td width="400" align="left" valign="top">
                                        <?php echo $progid ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right" valign="top">
                                    Program Name
                                    </td>
                                    <td align="left" valign="top">
                                        <input type="text" name="progname" size="30" value="<?php echo $progname ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right" valign="top">
                                        Enabled
                                    </td>
                                    <td align="left" valign="top">
                                        <?php
                                        if($enabled == true){
                                        ?>
                                        <input type="radio" name="enabled" value="1" checked> Yes
                                        <input type="radio" name="enabled" value="0"> No
                                        <?php
                                        }else{
                                        ?>
                                        <input type="radio" name="enabled" value="1"> Yes
                                        <input type="radio" name="enabled" value="0" checked> No
                                        <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </table>
                            <input type="hidden" name="progid" value="<?php echo $progid ?>">
                            <input type="submit" name="action" value="Done" />
                            </center>
                        </form>

                        <table class="table">
                            <tr>
                                <td width="100%" align="center" valign="top">
                                    <h1>Courses</h1>
                                    <center>
                                    <?php echo $msg; ?>
                                    <br>
                                    <form action="<?php echo $PHP_SELF ?>" method="post">
                                        <select class="input_text" name="courseid">
                                            <option value="0"><<< MAKE A SELECTION >>></option>
                                            <?php
                                            $sqlb = $mysqli->query("SELECT * FROM $courses_tablename ORDER BY coursename ASC");
                                            if(!$sqlb) error_message("Error in $courses_tablename (programs) line #263");
                                            $sqlb->data_seek(0);
                                            while($rowb = $sqlb->fetch_assoc()) {
                                                $courseid = $rowb['courseid'];
                                                $coursecode = $rowb['coursecode'];
                                                $coursename = $rowb['coursename'];
                                                $credits = $rowb['credits'];
                                                
                                            ?>
                                            <option value="<?php echo $courseid ?>"><?php echo $coursename ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>

                                        <input type="hidden" name="progid" value="<?php echo $progid ?>">
                                        <input class='button_gradient_green' name="action" type="submit" value="Add Course" />
                                    </form>
                                    <br>
                                    <table class="table table-striped">
                                        <tr>
                                            <td>
                                                <strong>Program ID</strong>
                                            </td>
                                            <td>
                                                <strong>Course ID</strong>
                                            </td>
                                            <td>
                                                <strong>Course Code</strong>
                                            </td>
                                            <td>
                                                <strong>Course Name</strong>
                                            </td>
                                            <td>
                                                <strong>Credits</strong>
                                            </td>
                                            <td align="center">
                                                <strong>DELETE</strong>
                                            </td>
                                        </tr>
                                        <?php
                                        $res = $mysqli->query("SELECT * FROM $prog_det_tablename WHERE progid = '$progid' ORDER BY coursecode ASC");
                                        //if(!$res) error_message("Error in $prog_det_tablename (programs) line #85");
                                        while($row = mysqli_fetch_array($res)){
                                            $progid2 = $row['progid'];
                                            $courseid = $row['courseid'];
                                            $coursecode = $row['coursecode'];
                                            $coursename = $row['coursename'];
                                            $coursecredits = $row['coursecredits'];

                                            if($bgcolor == "#99FFFF"){
                                                $bgcolor = "#CCFFFF";
                                            }else{
                                                $bgcolor = "#99FFFF";
                                            }
                                            
                                            $totalcredits += $coursecredits;
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $progid2 ?>
                                            </td>
                                            <td>
                                                <?php echo $courseid ?>
                                            </td>
                                            <td>
                                                <?php echo $coursecode ?>
                                            </td>
                                            <td>
                                                <?php echo $coursename ?>
                                            </td>
                                            <td>
                                                <?php echo $coursecredits ?>
                                            </td>
                                            <td align="center">
                                                <form action="<?php echo $PHP_SELF ?>" method="post">
                                                    <input type="hidden" name="progid" value="<?php echo $progid ?>">
                                                    <input type="hidden" name="courseid" value="<?php echo $courseid ?>">
                                                    <input class='btn btn-danger' name="action" type="submit" value="DELETE" />
                                                </form>
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </table>
                                    <?php echo "<br>Total Credits: ".$totalcredits; ?>
                                    </center>
                                </td>
                            </tr>
                        </table>
                        <br /><br />
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php
}


//*******************************************************
//*********************  DO EDIT  ***********************
//*******************************************************
function do_edit(){
    global $PHP_SELF, $mysqli, $msg;
    global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
    global $programs_tablename, $progid, $progname, $enabled, $cost, $charge;
    global $prog_det_tablename, $progdetid, $progid, $courseid, $coursecode, $coursename, $coursecredits;
    global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $coursedesc, $credits, $filename, $validcourse;
    global $progcourses_tablename, $pgid, $progid, $courseid;
	
$progid = $_POST['progid'];
$progname = $_POST['progname'];
$enabled = $_POST['enabled'];
$cost = $_POST['cost'];
$charge = $_POST['charge'];

$sql = $mysqli->query("UPDATE $programs_tablename SET progname = '$progname', enabled = '$enabled', cost = '$cost', charge = '$charge' WHERE progid = '$progid'");
if(!$sql) error_message("Error fetching data from $programs_tablename (programs) line #248");

main_form();
}


//*******************************************************
//*********************  DO EDIT  ***********************
//*******************************************************
function add_new(){
    global $PHP_SELF, $mysqli, $msg;
    global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
    global $programs_tablename, $progid, $progname, $enabled, $cost, $charge;
    global $prog_det_tablename, $progdetid, $progid, $courseid, $coursecode, $coursename, $coursecredits;
    global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $coursedesc, $credits, $filename, $validcourse;
    global $progcourses_tablename, $pgid, $progid, $courseid;
	
$progid = $_POST['progid'];
//echo "user_id = ".$user_id."<br>";
//exit;

$sql = $mysqli->query("SELECT * FROM $programs_tablename WHERE progid = '$progid'");
if(!$sql) error_message("Error in $courses_tablename (courses) line #135");
$row = $sql->fetch_assoc();		
$progname = $row['progname'];
$enabled = $row['enabled'];
$cost = $rowb['cost'];
$charge = $rowb['charge'];		
				
$_SESSION['progname'] = $progname;
$_SESSION['enabled'] = $enabled;
?>
<form action="<?php echo $PHP_SELF ?>" method="post">
    <center>
    <table width="600" align="center" cellpadding="0" cellspacing="10">
        <tr>
            <td width="200" align="right" valign="top">
                Program ID:
            </td>
            <td width="400" align="left" valign="top">
                <?php echo $_SESSION['progname'] ?>
            </td>
        </tr>
        <tr>
            <td align="right" valign="top">
               Program Name
            </td>
            <td align="left" valign="top">
                <input type="text" name="progname" size="30" value="<?php echo $_SESSION['progname'] ?>">
            </td>
        </tr>
        <tr>
            <td align="right" valign="top">
                Enabled
            </td>
            <td align="left" valign="top">
<?php
if($_SESSION['enabled'] == true){
?>
<input type="radio" name="enabled" value="1" checked> Yes
<input type="radio" name="enabled" value="0"> No
<?php
}else{
?>
<input type="radio" name="enabled" value="1"> Yes
<input type="radio" name="enabled" value="0" checked> No
<?php
}
?>
            </td>
        </tr>
        <tr>
            <td align="right" valign="top">
               Cost
            </td>
            <td align="left" valign="top">
                <input type="text" name="cost" size="30" value="<?php echo $_SESSION['cost'] ?>">
            </td>
        </tr>
        <tr>
            <td align="right" valign="top">
                Charge
            </td>
            <td align="left" valign="top">
<?php
if($_SESSION['charge'] == true){
?>
<input type="radio" name="charge" value="Yes" checked> Yes
<input type="radio" name="charge" value="No"> No
<?php
}else{
?>
<input type="radio" name="charge" value="Yes"> Yes
<input type="radio" name="charge" value="No" checked> No
<?php
}
?>
            </td>
        </tr>
    </table>
    <input type="hidden" name="progid" value="<?php echo $progid ?>">
    <input type="submit" name="action" value="Submit" />
    </center>
</form>  
<?php
}


//*******************************************************
//**********************  DO ADD  ***********************
//*******************************************************
function do_add(){
    global $PHP_SELF, $mysqli, $msg;
    global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
    global $programs_tablename, $progid, $progname, $enabled, $cost, $charge;
    global $prog_det_tablename, $progdetid, $progid, $courseid, $coursecode, $coursename, $coursecredits;
    global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $coursedesc, $credits, $filename, $validcourse;
    global $progcourses_tablename, $pgid, $progid, $courseid;
	
$progid = $_POST['progid'];
$progname = $_POST['progname'];
$enabled = $_POST['enabled'];
$cost = $_POST['cost'];
$charge = $_POST['charge'];

$sql = $mysqli->query("INSERT INTO $programs_tablename VALUES(NULL, '$progname', '$enabled', '$cost', '$charge')");
if(!$sql) error_message("Error fetching data from $programs_tablename (programs) line #345");

main_form();
}


//*******************************************************
//**********************  DO ADD  ***********************
//*******************************************************
function add_course(){
    global $PHP_SELF, $mysqli, $msg;
    global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
    global $programs_tablename, $progid, $progname, $enabled, $cost, $charge;
    global $prog_det_tablename, $progdetid, $progid, $courseid, $coursecode, $coursename, $coursecredits;
    global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $coursedesc, $credits, $filename, $validcourse;
    global $progcourses_tablename, $pgid, $progid, $courseid;
	
$progid = $_POST['progid'];
$courseid = $_POST['courseid'];

$sql = $mysqli->query("SELECT * FROM $courses_tablename WHERE courseid = '$courseid'");
if(!$sql) error_message("Error in $courses_tablename (courses) line #338");
$row = $sql->fetch_assoc();	
$coursecode = $row['coursecode'];
$coursename = addslashes($row['coursename']);
$coursedesc = addslashes($row['coursedesc']);
$credits = $row['credits'];
$filename = $row['filename'];
$validcourse = $row['validcourse'];

$sql = $mysqli->query("INSERT INTO $prog_det_tablename VALUES(NULL, '$progid', '$courseid', '$coursecode', '$coursename', '$credits')");
if(!$sql) error_message("Error fetching data from $programs_tablename (programs) line #345");
edit_record();
}


//*******************************************************
//**********************  DO ADD  ***********************
//*******************************************************
function delete_course(){
    global $PHP_SELF, $mysqli, $msg;
    global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
    global $programs_tablename, $progid, $progname, $enabled, $cost, $charge;
    global $prog_det_tablename, $progdetid, $progid, $courseid, $coursecode, $coursename, $coursecredits;
    global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $coursedesc, $credits, $filename, $validcourse;
    global $progcourses_tablename, $pgid, $progid, $courseid;
	
$progid = $_POST['progid'];
$courseid = $_POST['courseid'];

/*echo "progid: ".$progid."<br>";
echo "courseid: ".$courseid."<br>";
exit;*/

$query = mysqli_query($mysqli, "DELETE FROM $prog_det_tablename WHERE progid = '$progid' AND courseid = '$courseid'");
if(!$query) error_message("Error fetching data from $prog_det_tablename (delete_prod) line #388");


edit_record();
}


//*******************************************************
//**********************  SWITCH  ***********************
//*******************************************************
switch($action) {
	case "DELETE":
		delete_course();
	break;
	case "Add Course":
		add_course();
	break;
	case "Submit":
		do_add();
	break;
	case "Done":
		do_edit();
	break;
	case "View/Modify":
		edit_record();
	break;
	case "Add New":
		add_new();
	break;
	default:
		main_form();
	break;
}
?>