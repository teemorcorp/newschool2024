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
    
    $progid = $_GET['id'];
?>
    <!-- <body> -->
    <div class="height-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2">
                    <?php
                    admmenu();
                    ?>
                </div>
                <div class="col-10">
                    <div class="row " style="padding-top:10px;">
                        <div class="col-12">
                            <!-- *******************************************************************************************
                            **********  POPULAR PRODUCTS
                            *********************************************************************************************-->
                            <section name="Website Options" style="padding-top:20px;">
                                <h1>Modify Program</h1>
                                <center>
                                    <?php echo $_SESSION['msg']; ?>
                                    <br>
                                    
                                </center>
                                <br>
                                <?php
                                // Attempt select query execution
                                if ($result = $mysqli->query("SELECT * FROM $programs_tablename WHERE progid = '$progid'")) {
                                    if(mysqli_num_rows($result) > 0){
                                        $row = mysqli_fetch_array($result);
                                        $progid = $row['progid'];
                                        $progname = $row['progname'];
                                        $progdesc = stripslashes($row['progdesc']);
                                        $isenabled = $row['isenabled'];
                                        $cost = $row['cost'];
                                        $charge = $row['charge'];
                                        $accordian_header = $row['accordian_header'];
                                        $progtype = $row['progtype'];
                                        // Free result set
                                        mysqli_free_result($result);
                                    } else{
                                        $msg = "<font color='#FF0000'><strong>Account not found!</strong></font>";
                                        main_form();
                                        exit;
                                    }
                                } else{
                                    echo "ERROR: Was not able to execute Query on line #152. " . mysqli_error($mysqli);
                                }
                                // End attempt select query execution
                                ?>
                                <div class="card text-dark bg-light mb-1" id="boxdisplay">
                                    <div class="card-header">
                                        <font size="+2"><strong><?php echo $progname; ?></strong></font>
                                    </div>
                                    <div class="card-body">
                                        <form action="<?php echo $PHP_SELF ?>" method="POST">
                                            <div class="mb-3">
                                                <label for="progname" class="form-label">Program Name</label>
                                                <input type="text" class="form-control" id="progname" name="progname" value="<?php echo $progname; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="progdesc" class="form-label">Program Description</label>
                                                <textarea class="form-control" id="progdesc" name="progdesc"><?php echo $progdesc; ?></textarea>
                                            </div>
                                            <div class="form-check mb-3">
                                                <div>
                                                    <strong>Enabled</strong>
                                                </div>
                                                <div>
                                                    <?php
                                                    if($isenabled == true){
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
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="cost" class="form-label">Program Cost</label>
                                                <input type="text" class="form-control" id="cost" name="cost" value="<?php echo $cost; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="charge" class="form-label">Program Charge</label>
                                                <input type="text" class="form-control" id="charge" name="charge" value="<?php echo $charge; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="accordian_header" class="form-label">Accordian Header</label>
                                                <input type="text" class="form-control" id="accordian_header" name="accordianheader" value="<?php echo $accordian_header; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="progtype" class="form-label">Program Type</label>
                                                <select class="form-select" aria-label="Default select example" id="progtype" name="progtype">
                                                    <option value="<?php echo $progtype; ?>" selected><?php echo $progtype; ?></option>
                                                    <option value="0">Certificate Program</option>
                                                    <option value="1">Associate Program</option>
                                                    <option value="2">Bachelor Program</option>
                                                    <option value="3">Master Program</option>
                                                    <option value="4">Doctorate Program</option>
                                                </select>
                                            </div>
                                            <input type="hidden" name="progid" value="<?php echo $progid ?>">
                                            <input class="btn btn-primary btn-sm" type="submit" name="action" value="Done" />&nbsp;
                                            <input class="btn btn-primary btn-sm" type="submit" name="action" value="Delete" />
                                            <!-- <button class="btn btn-primary btn-sm" name="action" type="submit" value="Done">Done</button> -->
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
                                                            // if(!$sqlb) error_message("Error in $courses_tablename (programs) line #263");
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
                                                        <input class='btn btn-primary btn-sm' name="action" type="submit" value="Add Course" />
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
                                                                    <input class='btn btn-danger' name="action" type="submit" value="REMOVE" />
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
                            </section>
                
                            <div id="boxed" style="margin-top: 50px;">&nbsp;</div>                 

                        </div>
                    </div>
                    
                </div>
            </div>   
        </div>
    </div>
    <script>
        tinymce.init({
            selector: '#progdesc',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo| bold italic underline strikethrough | bullist numlist indent outdent  | link image media table | align lineheight| emoticons charmap | removeformat | blocks fontfamily fontsize ',
            width: '100%',
            height: 420,
            readonly: 0
        });
    </script>

<?php
include "tmp/footer.php";
}


//*******************************************************
//*******************  SUBMIT FORM  *********************
//*******************************************************
function submit_form(){
    global $PHP_SELF, $mysqli, $msg;
    global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $coursedesc, $overview, $credits, $filename, $validcourse, $brief_desc, $course_photo, $course_cost, $course_discount, $hours, $videos, $cont_one, $cont_one_desc, $cont_two, $cont_two_desc, $cont_three, $cont_three_desc, $head_photo, $top_course;
    include "tmp/globals.php";
    dbconnect();
    if (!$mysqli) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // $g = filter_var($gfine, FILTER_SANITIZE_STRING);

    $courseid = $_POST['courseid'];
    $coursecode = $_POST['coursecode'];
    $coursename = $_POST['coursename'];
    $coursedesc = stripslashes($_POST['coursedesc']);
    $overview = stripslashes($_POST['overview']);
    $credits = $_POST['credits'];
    $filename = $_POST['filename'];
    $validcourse = $_POST['validcourse'];
    // if($validcourse == "1"){
    //     echo "ON<br>";
    // }else{
    //     echo "OFF<br>";
    // }
    // echo "validcourse: ".$validcourse;
    // exit;
    $brief_desc = stripslashes($_POST['briefdesc']);
    $course_photo = $_POST['coursephoto'];
    $course_cost = $_POST['coursecost'];
    $course_discount = $_POST['coursediscount'];
    $hours = $_POST['hours'];
    $videos = $_POST['videos'];
    $cont_one = $_POST['contone'];
    $cont_one_desc = stripslashes($_POST['contonedesc']);
    $cont_two = $_POST['conttwo'];
    $cont_two_desc = stripslashes($_POST['conttwodesc']);
    $cont_three = $_POST['contthree'];
    $cont_three_desc = stripslashes($_POST['contthreedesc']);
    $head_photo = $_POST['headphoto'];
    $top_course = $_POST['topcourse'];
    // if($top_course == "1"){
    //     echo "ON<br>";
    // }else{
    //     echo "OFF<br>";
    // }
    // echo "top_course: ".$top_course;
    // exit;

    // $_SESSION['msg'] = "Test1";
    
    $sql = "UPDATE $courses_tablename SET coursecode = '$coursecode', coursename = '$coursename', coursedesc = '$coursedesc', credits = '$credits', filename = '$filename', validcourse = '$validcourse', brief_desc = '$brief_desc', course_photo = '$course_photo', course_cost = '$course_cost', course_discount = '$course_discount', hours = '$hours', videos = '$videos', cont_one = '$cont_one', cont_one_desc = '$cont_one_desc', cont_two = '$cont_two', cont_two_desc = '$cont_two_desc', cont_three = '$cont_three', cont_three_desc = '$cont_three_desc', head_photo = '$head_photo', top_course = '$top_course' WHERE courseid = '$courseid'";
    if (mysqli_query($mysqli, $sql)) {
        $msg = "<div class='alert alert-success' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>SUCCESS!</strong> Record updated successfully!
        </div>";
        $_SESSION['msg'] = "Test2";
        // main_form();
    } else {
        $msg = "<div class='alert alert-danger' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>ERROR!</strong> Error updating record: " . mysqli_error($mysqli) . "
        </div>";
        $_SESSION['msg'] = "Test3";
        // main_form();
    }

    $mysqli->close();

    header('Location: courses.php');
}


//*******************************************************
//*********************  DO EDIT  ***********************
//*******************************************************
function do_edit(){
    global $PHP_SELF, $mysqli, $msg, $result, $dbhost, $dbuser, $dbpwd, $dbname;
    global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
    global $prog_det_tablename, $progdetid, $progid, $courseid, $coursecode, $coursename, $coursecredits;
    global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $coursedesc, $credits, $filename, $validcourse;
    global $progcourses_tablename, $pgid, $progid, $courseid;
    global $programs_tablename, $progid, $progname, $progdesc, $isenabled, $cost, $charge, $accordian_header, $progtype;
    
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
    $progname = stripslashes($_POST['progname']);
    $progdesc = stripslashes($_POST['progdesc']);
    $isenabled = $_POST['isenabled'];
    $cost = $_POST['cost'];
    $charge = $_POST['charge'];
    $accordian_header = stripslashes($_POST['accordianheader']);
    $progtype = $_POST['progtype'];
    
    // Attempt select query execution
    $sql = "UPDATE $programs_tablename SET progname = '$progname', progdesc = '$progdesc', isenabled = '$isenabled', cost = '$cost', charge = '$charge', accordian_header = '$accordian_header', progtype = '$progtype' WHERE progid = '$progid'";
    if ($result = mysqli_query($mysqli, $sql)) {
        $_SESSION['msg'] = "<div class='alert alert-success' role='alert' style='margin-top: 20px;'>
        <button type='button' class='close' data-bs-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>SUCCESS!</strong> Record updated successfully!
        </div>";
    } else {
        $_SESSION['msg'] = "<div class='alert alert-danger' role='alert' style='margin-top: 20px;'>
        <button type='button' class='close' data-bs-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>ERROR!</strong> Error updating record: " . mysqli_error($mysqli) . "
        </div>";
    }
    // End attempt select query execution
?>
	<script type="text/javascript">
        <!--
        window.top.location.href = "programs.php"; 
        -->
    </script>
<?php
}


//*******************************************************
//**********************  DO ADD  ***********************
//*******************************************************
function delete_prog(){
    global $PHP_SELF, $mysqli, $msg;
    global $programs_tablename, $progid, $progname, $progdesc, $isenabled, $cost, $charge, $accordian_header, $progtype;

    include 'tmp/globals.php';
    dbconnect();
    if (!$mysqli) {
        die("Connection failed: " . mysqli_connect_error());
    }
	
    $progid = $_POST['progid'];

    $query = mysqli_query($mysqli, "DELETE FROM $programs_tablename WHERE progid = '$progid'");
    // if(!$query) error_message("Error fetching data from $programs_tablename (delete_prod) line #388");

    ?>
	<script type="text/javascript">
        <!--
        window.top.location.href = "programs.php"; 
        -->
    </script>
<?php
}


//*******************************************************
//**********************  DO ADD  ***********************
//*******************************************************
function delete_course(){
    global $PHP_SELF, $mysqli, $msg;
    global $prog_det_tablename, $progdetid, $progid, $courseid, $coursecode, $coursename, $coursecredits;

    include 'tmp/globals.php';
    dbconnect();
    if (!$mysqli) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $progid = $_POST['progid'];
    $courseid = $_POST['courseid'];

    $query = mysqli_query($mysqli, "DELETE FROM $prog_det_tablename WHERE progid = '$progid' AND courseid = '$courseid'");
    // if(!$query) error_message("Error fetching data from $prog_det_tablename (delete_prod) line #388");
    
    ?>
	<script type="text/javascript">
        <!--
        window.top.location.href = "program_modify.php?id=<?php echo $progid; ?>"; 
        // window.top.location.href = "programs.php"; 
        -->
    </script>
    <?php
}


//*******************************************************
//**********************  DO ADD  ***********************
//*******************************************************
function add_course(){
    global $PHP_SELF, $mysqli, $msg;
    global $programs_tablename, $progid, $progname, $progdesc, $isenabled, $cost, $charge, $accordian_header, $progtype;
    global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $coursedesc, $credits, $filename, $validcourse;
    global $prog_det_tablename, $progdetid, $progid, $courseid, $coursecode, $coursename, $coursecredits;

    include 'tmp/globals.php';
    dbconnect();
    if (!$mysqli) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $progid = $_POST['progid'];
    $courseid = $_POST['courseid'];


    // Attempt select query execution
    if ($result = $mysqli->query("SELECT * FROM $courses_tablename WHERE courseid = '$courseid'")) {
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            $coursecode = $row['coursecode'];
            $coursename = $row['coursename'];
            $coursedesc = addslashes($row['coursedesc']);
            $credits = $row['credits'];
            $filename = $row['filename'];
            $validcourse = $row['validcourse'];
            // Free result set
            mysqli_free_result($result);
        } else{
            $msg = "<font color='#FF0000'><strong>Account not found!</strong></font>";
            main_form();
            exit;
        }
    } else{
        echo "ERROR: Was not able to execute Query on line #152. " . mysqli_error($mysqli);
    }
    // End attempt select query execution

    $sql = $mysqli->query("INSERT INTO $prog_det_tablename VALUES(NULL, '$progid', '$courseid', '$coursecode', '$coursename', '$credits')");
    // if(!$sql) error_message("Error fetching data from $programs_tablename (programs) line #345");
    
    ?>
	<script type="text/javascript">
        <!--
        window.top.location.href = "program_modify.php?id=<?php echo $progid; ?>"; 
        // window.top.location.href = "programs.php"; 
        -->
    </script>
    <?php
}

//*******************************************************
//**********************  SWITCH  ***********************
//*******************************************************
switch ($action) {
	case "REMOVE":
		delete_course();
    break;
	case "Delete":
		delete_prog();
    break;
	case "Done":
		do_edit();
    break;
    case "Add Course":
        add_course();
    break;
    default:
        main_form();
    break;
}
?>