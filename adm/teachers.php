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
global $teachers_tablename, $teacherid, $teacherfname, $teachermname, $teacherlname, $teacheremail, $role;

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
        $role = $row['role'];
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
        <div class="col">
            <!-- *******************************************************************************************
            **********  TEACHER MANAGEMENT
            *********************************************************************************************-->
            <section style="padding-top:20px;">
                <h1>Staff Management</h1>
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
                        <font size="+2"><strong>School Staff</strong></font>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo $PHP_SELF ?>" method="post">
                            <table class="table">
                                <tr>
                                    <td><font size="+1"><strong>Staff ID</strong></font></td>
                                    <td><font size="+1"><strong>Teacher Name</strong></font></td>
                                    <td><font size="+1"><strong>Email</strong></font></td>
                                    <td><font size="+1"><strong>Role</strong></font></td>
                                    <td align="right"><font size="+1"><strong>View/Modify</strong></font></td>
                                </tr>
                                <tbody>
                                <tr>
                                    <?php
                                    // Attempt select query execution
                                    $sql = "SELECT * FROM $users_tablename WHERE isadmin = '1' ORDER BY userfname ASC";
                                    if($result = mysqli_query($mysqli, $sql)){
                                        if(mysqli_num_rows($result) > 0){
                                            while($row = mysqli_fetch_array($result)){
                                                $teacherid = $row['userid'];
                                                $isadmin = $row['isadmin'];
                                                $userfname = $row['userfname'];
                                                $usermname = $row['usermname'];
                                                $userlname = $row['userlname'];
                                                $useremail = $row['useremail'];
                                                $role = $row['role'];
                                                if(empty($usermname)){
                                                    $fullname = $userfname." ".$userlname;
                                                }else{
                                                    $fullname = $userfname." ".$usermname." ".$userlname;
                                                }
                                                ?>
                                                <tr>
                                                    <form action="<?php echo $PHP_SELF ?>" method="post">
                                                        <td><?php echo $teacherid; ?></td>
                                                        <td><?php echo $fullname; ?></td>
                                                        <td><?php echo $useremail; ?></td>
                                                        <td><?php echo $role; ?></td>
                                                        <td align="right">
                                                            <input type="hidden" name="teacherid" value="<?php echo $teacherid ?>">
                                                            <button class="btn btn-success" name="action" type="submit" value="View/Modify">View/Modify</button>
                                                            <?php if($_SESSION['isadmin'] == '1' && $_SESSION['role'] == "Administrator"){ ?>
                                                                <button class="btn btn-danger" name="action" type="submit" value="Delete">Delete</button>
                                                            <?php } ?>
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


//************************************************************************************************************
//***  EDIT RECORD
//************************************************************************************************************
function edit_record(){
    global $PHP_SELF, $mysqli, $msg;
    global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
    global $teachers_tablename, $teacherid, $teacherfname, $teachermname, $teacherlname, $teacheremail, $role;
	
    $main_background_color = "#1c262f";
    $sub_background_color = "#26333c"; 
    $child_background_color = "#2f3d4a";

    $teacherid = $_POST['teacherid'];
    
    // Attempt select query execution
    $sql = "SELECT * FROM $users_tablename WHERE userid = '$teacherid'";
    if($result = mysqli_query($mysqli, $sql)){
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            $teacherid = $row['userid'];
            $teacheremail = $row['useremail'];
            $teacherfname = $row['userfname'];
            $teachermname = $row['usermname'];
            $teacherlname = $row['userlname'];
            $role = $row['role'];
            $fullname = $teacherfname." ".$teacherlname;
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
                        <!-- ***************************************************************************************
                        **********  POPULAR PRODUCTS
                        *****************************************************************************************-->
                        <section style="padding-top:20px;">
                            <form action="<?php echo $PHP_SELF ?>" method="post">
                                <center>
                                <table class="table">
                                    <tr>
                                        <td colspan="2">
                                            <center><font size="+3">Modify Staff Member</font></center>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Staff ID:
                                        </td>
                                        <td>
                                            <?php echo $teacherid; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right" valign="top">
                                            First Name
                                        </td>
                                        <td align="left" valign="top">
                                            <input type="text" name="tfname" size="30" value="<?php echo $teacherfname; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right" valign="top">
                                            Middle Name
                                        </td>
                                        <td align="left" valign="top">
                                            <input type="text" name="tmname" size="30" value="<?php echo $teachermname; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right" valign="top">
                                            Last Name
                                        </td>
                                        <td align="left" valign="top">
                                            <input type="text" name="tlname" size="30" value="<?php echo $teacherlname; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right" valign="top">
                                            Email Address
                                        </td>
                                        <td align="left" valign="top">
                                            <input type="text" name="temail" size="30" value="<?php echo $teacheremail; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right" valign="top">
                                            Role
                                        </td>
                                        <td align="left" valign="top">
                                            <input type="text" name="role" size="30" value="<?php echo $role; ?>">
                                        </td>
                                    </tr>
                                </table>
                                <input type="hidden" name="teacherid" value="<?php echo $teacherid ?>">
                                <button class="btn btn-primary" type="submit" name="action" value="Done">Submit</button>
                                </center>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <br><br>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="js/pushy.min.js"></script>
    </body>
    </html>
<?php
}


//*******************************************************
//*********************  DO EDIT  ***********************
//*******************************************************
function do_edit(){
    global $PHP_SELF, $mysqli, $msg;
    global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
    global $teachers_tablename, $teacherid, $teacherfname, $teachermname, $teacherlname, $teacheremail, $role;
	
    $teacherid = $_POST['teacherid'];
    $teacheremail = $_POST['temail'];
    $teacherfname = addslashes($_POST['tfname']);
    $teachermname = addslashes($_POST['tmname']);
    $teacherlname = addslashes($_POST['tlname']);
    $role = $_POST['role'];

    $sql = $mysqli->query("UPDATE $users_tablename SET useremail = '$teacheremail', userfname = '$teacherfname', usermname = '$teachermname', userlname = '$teacherlname', role = '$role' WHERE userid = '$teacherid'");
    if(!$sql) error_message("Error fetching data from $users_tablename (programs) line #355");

    main_form();
}


//*******************************************************
//*********************  ADD NEW  ***********************
//*******************************************************
function add_new(){
    global $PHP_SELF, $mysqli, $msg;
    global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
    global $teachers_tablename, $teacherid, $teacherfname, $teachermname, $teacherlname, $teacheremail, $role;
	
    $main_background_color = "#1c262f";
    $sub_background_color = "#26333c"; 
    $child_background_color = "#2f3d4a";

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
                        <!-- ***************************************************************************************
                        **********  POPULAR PRODUCTS
                        *****************************************************************************************-->
                        <section style="padding-top:20px;">
                            <form action="<?php echo $PHP_SELF ?>" method="post">
                                <center>
                                <table class="table">
                                    <tr>
                                        <td colspan="2">
                                            <center><font size="+3">Add New Instructor</font></center>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right" valign="top">
                                            First Name
                                        </td>
                                        <td align="left" valign="top">
                                            <input type="text" name="tfname" size="30" value="<?php echo $teacherfname; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right" valign="top">
                                            Middle Name
                                        </td>
                                        <td align="left" valign="top">
                                            <input type="text" name="tmname" size="30" value="<?php echo $teachermname; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right" valign="top">
                                            Last Name
                                        </td>
                                        <td align="left" valign="top">
                                            <input type="text" name="tlname" size="30" value="<?php echo $teacherlname; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right" valign="top">
                                            Email Address
                                        </td>
                                        <td align="left" valign="top">
                                            <input type="text" name="temail" size="30" value="<?php echo $teacheremail; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right" valign="top">
                                            Role
                                        </td>
                                        <td align="left" valign="top">
                                            <input type="text" name="role" size="30" value="<?php echo $role; ?>">
                                        </td>
                                    </tr>
                                </table>
                                <button class="btn btn-primary" type="submit" name="action" value="Submit">Submit</button>
                                </center>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <br><br>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="js/pushy.min.js"></script>
    </body>
    </html>
<?php
}


//*******************************************************
//**********************  DO ADD  ***********************
//*******************************************************
function do_add(){
    global $PHP_SELF, $mysqli, $msg;
    global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
    global $teachers_tablename, $teacherid, $teacherfname, $teachermname, $teacherlname, $teacheremail, $role;
	
    $tfname = $_POST['tfname'];
    $tmname = $_POST['tmname'];
    $tlname = $_POST['tlname'];
    $temail = $_POST['temail'];
    $role = $_POST['role'];

    $sql = $mysqli->query("INSERT INTO $users_tablename (useremail, isadmin, userfname, usermname, userlname, role) VALUES ('$temail', '1', '$tfname', '$tmname', '$tlname', '$role')");
    if(!$sql) error_message("Error fetching data from $teachers_tablename (programs) line #503");

    main_form();
}


//*******************************************************
//**********************  DO ADD  ***********************
//*******************************************************
function add_course(){
    global $PHP_SELF, $mysqli, $msg;
    global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
    global $teachers_tablename, $teacherid, $teacherfname, $teachermname, $teacherlname, $teacheremail, $role;
	
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
    if(!$sql) error_message("Error fetching data from $programs_tablename (programs) line #554");
    main_form();
}


//*******************************************************
//****************** DELETE STAFF  **********************
//*******************************************************
function delete_staff(){
    global $PHP_SELF, $mysqli, $msg;
    global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
    global $teachers_tablename, $teacherid, $teacherfname, $teachermname, $teacherlname, $teacheremail, $role;
	
    $teacherid = $_POST['teacherid'];

    $query = mysqli_query($mysqli, "DELETE FROM $users_tablename WHERE userid = '$teacherid'");
    if(!$query) error_message("Error fetching data from $users_tablename (delete_prod) line #508");

    main_form();
}


//*******************************************************
//**********************  SWITCH  ***********************
//*******************************************************
switch($action) {
	case "Delete":
		delete_staff();
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