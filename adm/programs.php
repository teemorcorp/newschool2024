<?php
/****************************************************
****   IHN Bible College
****   Designed by: Tom Moore
****   Written by: Tom Moore
****   (c) 2001 - 2023 TEEMOR eBusiness Solutions
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
global $programs_tablename, $progid, $progname, $progdesc, $isenabled, $cost, $charge, $accordian_header, $progtype;
global $prog_det_tablename, $progdetid, $progid, $courseid, $coursecode, $coursename, $coursecredits;
global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $coursedesc, $credits, $filename, $validcourse;
global $progcourses_tablename, $pgid, $progid, $courseid;

include "tmp/header.php";
dbconnect();
if (!$mysqli) {
    die("Connection failed: " . mysqli_connect_error());
}

if(!empty($_SESSION['userid'] && $_SESSION['isadmin'])){
    $userid = $_SESSION['userid'];
}else{
    header('Location: ../index.php');
}
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
                                        <input class='btn btn-primary btn-sm' name="action" type="submit" value="Add New" />
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
                                                        global $programs_tablename, $progid, $progname, $progdesc, $isenabled, $cost, $charge, $accordian_header, $progtype;

                                                        // Attempt select query execution
                                                        $sql = "SELECT * FROM $programs_tablename ORDER BY progname ASC";
                                                        if($result = mysqli_query($mysqli, $sql)){
                                                            if(mysqli_num_rows($result) > 0){
                                                                while($row = mysqli_fetch_array($result)){
                                                                    $progid = $row['progid'];
                                                                    $progname = $row['progname'];
                                                                    $isenabled = $row['isenabled'];
                                                                    if($isenabled){
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


//*******************************************************
//*********************  DO EDIT  ***********************
//*******************************************************
function add_new(){
    global $PHP_SELF, $mysqli, $msg;
    global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
    global $programs_tablename, $progid, $progname, $progdesc, $isenabled, $cost, $charge, $accordian_header, $progtype;
    global $prog_det_tablename, $progdetid, $progid, $courseid, $coursecode, $coursename, $coursecredits;
    global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $coursedesc, $credits, $filename, $validcourse;
    global $progcourses_tablename, $pgid, $progid, $courseid;

    include "tmp/header.php";
    dbconnect();
    if (!$mysqli) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if(!empty($_SESSION['userid'] && $_SESSION['isadmin'])){
        $userid = $_SESSION['userid'];
    }else{
        header('Location: ../index.php');
    }
	
    $progid = $_POST['progid'];

    // Attempt select query execution
    $totalpos = 0;
    if ($resultx = $mysqli->query("SELECT * FROM $programs_tablename WHERE progid = '$progid'")) {
        if(mysqli_num_rows($resultx) > 0){
            while($rowx = mysqli_fetch_array($resultx)){
                $progname = $rowx['progname'];
                $isenabled = $rowx['isenabled'];	
            }
            // Free result set
            mysqli_free_result($resultx);
        } else{
            $msg = "<font color='#FF0000'><strong>Account not found!</strong></font>";
            main_form();
            exit;
        }
    } else{
        echo "ERROR: Was not able to execute Query on line #55. " . mysqli_error($mysqli);
    }
    // End attempt select query execution
				
    $_SESSION['progname'] = $progname;
    $_SESSION['isenabled'] = $isenabled;
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
                    if($_SESSION['isenabled'] == true){
                        ?>
                        <input type="radio" name="isenabled" value="1" checked> Yes
                        <input type="radio" name="isenabled" value="0"> No
                        <?php
                    }else{
                        ?>
                        <input type="radio" name="isenabled" value="1"> Yes
                        <input type="radio" name="isenabled" value="0" checked> No
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
    global $programs_tablename, $progid, $progname, $progdesc, $isenabled, $cost, $charge, $accordian_header, $progtype;
    global $prog_det_tablename, $progdetid, $progid, $courseid, $coursecode, $coursename, $coursecredits;
    global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $coursedesc, $credits, $filename, $validcourse;
    global $progcourses_tablename, $pgid, $progid, $courseid;
	
    $progid = $_POST['progid'];
    $progname = $_POST['progname'];
    $progdesc = $_POST['progdesc'];
    $isenabled = $_POST['isenabled'];
    $cost = $_POST['cost'];
    $charge = $_POST['charge'];
    $accordian_header = $_POST['accordian_header'];
    $progtype = $_POST['progtype'];

    $sql = $mysqli->query("INSERT INTO $programs_tablename VALUES(NULL, '$progname', '$progdesc', '$isenabled', '$cost', '$charge', '$accordian_header', '$progtype')");
    if(!$sql) error_message("Error fetching data from $programs_tablename (programs) line #345");

    main_form();
}


//*******************************************************
//**********************  DO ADD  ***********************
//*******************************************************
function add_course(){
    global $PHP_SELF, $mysqli, $msg;
    global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
    global $programs_tablename, $progid, $progname, $isenabled, $cost, $charge;
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
    global $programs_tablename, $progid, $progname, $isenabled, $cost, $charge;
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
	case "View/Modify":
        header('Location: program_modify.php?id='.$_POST['progid']);
	break;
	case "Add New":
        header('Location: program_add.php?id='.$_POST['progid']);
		// add_new();
	break;
	default:
		main_form();
	break;
}
?>