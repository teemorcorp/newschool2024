<?php
/****************************************************
****   IHN Bible College
****   Designed by: Tom Moore
****   Written by: Tom Moore
****   (c) 2001 - 2021 TEEMOR eBusiness Solutions
****************************************************/

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

include "tmp/header.php";
dbconnect();
if (!$mysqli) {
    die("Connection failed: " . mysqli_connect_error());
}

$main_background_color = "#1c262f";
$sub_background_color = "#26333c"; 
$child_background_color = "#2f3d4a";


if(!empty($_SESSION['userid'] && $_SESSION['isadmin'])){
    $userid = $_SESSION['userid'];
}else{
    header('Location: ../index.php');
}

// // Attempt select query execution
// $sql = "SELECT * FROM $users_tablename WHERE userid = '$userid'";
// if($result = mysqli_query($mysqli, $sql)){
//     if(mysqli_num_rows($result) > 0){
//         $row = mysqli_fetch_array($result);
//         $userid = $row['userid'];
//         $useremail = $row['useremail'];
//         $isadmin = $row['isadmin'];
//         // Free result set
//         mysqli_free_result($result);
//     } else{
//         $msg = "<font color='#FF0000'><strong>Account Does Not Exsist!</strong></font>";
//         main_form();
//         exit;
//     }
// } else{
//     echo "ERROR: Was not able to execute Query on line #152. " . mysqli_error($mysqli);
// }
// // End attempt select query execution

// include 'templates/include.tpl';
// include "templates/style.tpl";
?>
<body>

<!-- *****************************************************************************************************
*******  MAIN
*******************************************************************************************************-->    
<section>
    <div class="height-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2">
                    <?php
                    // menu();
                    admmenu();
                    ?>
                </div>
                <div class="col-sm-10">
                    <?php
                    echo $_SESSION['msg'];
                    $_SESSION['msg'] = "";
                    ?>
                    <br>
                    <div id="boxed">
                        <div class="row " style="padding-top:10px;">
                            <div class="col-12">
                                

                                <!-- *******************************************************************************************
                                **********  PROGRAMS
                                *********************************************************************************************-->
                                <section name="Website Options" style="padding-top:20px;">
                                    <h1>Program Management</h1>
                                    <center>
                                    <?php echo $msg; ?>
                                    <br>
                                    <form action="<?php echo $PHP_SELF ?>" method="post">
                                        <input class='button_gradient_green' name="action" type="submit" value="Add New" />
                                    </form>
                                    </center>
                                    <br>
                                    <div class="card text-dark bg-light mb-1" id="boxdisplay">
                                        <div class="card-header">
                                            <font size="+2"><strong>School Programs</strong></font>
                                        </div>
                                        <div class="card-body">
                                            <form action="<?php echo $PHP_SELF ?>" method="post">
                                                <table class="table table-striped">
                                                    <tr>
                                                        <td><font size="+1"><strong>Program ID</strong></font></td>
                                                        <td><font size="+1"><strong>Program Name</strong></font></td>
                                                        <td><font size="+1"><strong>Enabled</strong></font></td>
                                                        <td align="right"><font size="+1"><strong>View/Modify</strong></font></td>
                                                    </tr>
                                                    <tbody>
                                                    <tr>
                                                        <?php
                                                        global $progcourses_tablename, $pgid, $progid, $courseid;
                                                        global $programs_tablename, $progid, $progname, $enabled, $cost, $charge;

                                                        // Attempt select query execution
                                                        $sql = "SELECT * FROM $programs_tablename ORDER BY progname ASC";
                                                        if($result = mysqli_query($mysqli, $sql)){
                                                            if(mysqli_num_rows($result) > 0){
                                                                while($row = mysqli_fetch_array($result)){
                                                                    $progid = $row['progid'];
                                                                    $progname = $row['progname'];
                                                                    $enabled = $row['enabled'];
                                                                    if($enabled){
                                                                        $en = "<font color='green'><strong>Yes</strong></font>";
                                                                    }else{
                                                                        $en = "<font color='#F00'><strong>No</strong></font>";
                                                                    }
                                                                    ?>
                                                                    <tr>
                                                                        <form action="<?php echo $PHP_SELF ?>" method="post">
                                                                            <td><?php echo $progid; ?></td>
                                                                            <td><?php echo $progname; ?></td>
                                                                            <td><?php echo $en; ?></td>
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
                                                            echo "ERROR: Was not able to execute Query on line #213. " . mysqli_error($hdmysqli);
                                                        }
                                                        // End attempt select query execution
                                                        ?>
                                                    </tr>
                                                </table>
                                            </form>
                                        </div>
                                    </div>
                                </section>


                            </div>
                            <!--div class="col-sm-1"></div-->
                        </div>
                    </div>
                    
                    <div id="boxed" style="margin-top: 50px;">&nbsp;</div>
                    
                </div>
            </div>
        </div>
    </div>
</section>

<br><br>
<?php
    include "tmp/footer.php";
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

    include "tmp/header.php";
    dbconnect();
    if (!$mysqli) {
        die("Connection failed: " . mysqli_connect_error());
    }

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
    <div class="height-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2">
                    <?php
                    // menu();
                    admmenu();
                    ?>
                </div>
                <div class="col-sm-10">
                    <?php
                    echo $_SESSION['msg'];
                    $_SESSION['msg'] = "";
                    ?>
                    <br>

                    <div id="boxed">
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
                    
                    <div id="boxed" style="margin-top: 50px;">&nbsp;</div>
                    
                </div>
            </div>
        </div>
    </div>
<?php
    include "tmp/footer.php";
}


//*******************************************************
//*********************  DO EDIT  ***********************
//*******************************************************
function do_edit(){
    global $PHP_SELF, $mysqli, $msg;
    global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
    global $prog_det_tablename, $progdetid, $progid, $courseid, $coursecode, $coursename, $coursecredits;
    global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $coursedesc, $credits, $filename, $validcourse;
    global $progcourses_tablename, $pgid, $progid, $courseid;
    global $programs_tablename, $progid, $progname, $enabled, $cost, $charge, $accordian_header, $progtype;
	
    $progid = $_POST['progid'];
    $progname = $_POST['progname'];
    $enabled = $_POST['enabled'];

    // echo "progid: ".$progid."<br>";
    // echo "progname: ".$progname."<br>";
    // echo "enabled: ".$enabled."<br>";
    // exit;

    // Attempt select query execution
    $sql = "UPDATE $programs_tablename SET progname = '$progname', enabled = '$enabled' WHERE progid = '$progid'";
echo "Line #436<br>";
    if($result = mysqli_query($mysqli, $sql)){
echo "Line #438<br>";
        if(mysqli_num_rows($result) > 0){
echo "Line #441<br>";
            // $row = mysqli_fetch_array($result);
            // $userid = $row['userid'];
            // $useremail = $row['useremail'];
            // $isadmin = $row['isadmin'];
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
echo "Line #445<br>";

	// $sql = $mysqli->query("UPDATE $programs_tablename SET progname = '$progname', enabled = '$enabled', cost = '$cost', charge = '$charge' WHERE progid = '$progid'");
    // $sql = $mysqli->query("UPDATE $programs_tablename SET progname = '$progname', enabled = '$enabled', cost = '$cost', charge = '$charge' WHERE progid = '$progid'");
    // if(!$sql) error_message("Error fetching data from $programs_tablename (programs) line #248");

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