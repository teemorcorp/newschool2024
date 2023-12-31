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
    global $exams_tablename, $examid, $excourseid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;

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
                                <h1>Exam Management</h1>
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
                                        <font size="+2"><strong>Exams</strong></font>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-striped">
                                            <tr>
                                                <td>
                                                    <strong>Course Code</strong>
                                                </td>
                                                <td>
                                                    <strong>Course Name</strong>
                                                </td>
                                                <td>
                                                    <strong>File Name</strong>
                                                </td>
                                                <td>
                                                    <strong># of Q</strong>
                                                </td>
                                                <td>
                                                    <strong>Credits</strong>
                                                </td>
                                                <td>
                                                    <strong>Enabled</strong>
                                                </td>
                                                <td>
                                                    <strong>View/Modify</strong>
                                                </td>
                                            </tr>
                                            <?php
                                            $sqlb = $mysqli->query("SELECT * FROM $courses_tablename ORDER BY coursecode ASC");
                                            if(!$sqlb) error_message("Error in $courses_tablename (select_exam) line #92");
                                            $sqlb->data_seek(0);
                                            while($rowb = $sqlb->fetch_assoc()) {
                                                $courseid = $rowb['courseid'];
                                                $coursecode = $rowb['coursecode'];
                                                $coursename = $rowb['coursename'];
                                                $credits = $rowb['credits'];
                                                $filename = $rowb['filename'];
                                                $validcourse = $rowb['validcourse'];
                                                
                                                
                                                $sqlx = $mysqli->query("SELECT COUNT(*) AS 'TotalQuestions' FROM $exams_tablename WHERE excourseid = '$courseid'");
                                                if(!$sqlx) error_message("Error in $exams_tablename (main) line #106");
                                                $rowx = $sqlx->fetch_assoc();	
                                                $total_questions = $rowx['TotalQuestions'];

                                                
                                                if($bgcolor == "#99FFFF"){
                                                    $bgcolor = "#CCFFFF";
                                                }else{
                                                    $bgcolor = "#99FFFF";
                                                }
                                            ?>
                                            <form action="quest_edit.php?courseid=<?php echo $courseid ?>" method="post">
                                                <tr>
                                                    <td>
                                                        <?php echo $coursecode ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $coursename ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $filename ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $total_questions ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $credits ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $validcourse ?>
                                                    </td>
                                                    <td>
                                                        <input type="hidden" name="courseid" value="<?php echo $courseid ?>">
                                                        <button class="btn btn-success" name="action" type="submit" value="View/Modify">View/Modify</button>
                                                        <!--a href="quest_edit.php?courseid=< ?php echo $courseid ?>">View/Modify</a-->
                                                    </td>
                                                </tr>
                                            </form>
                                            <?php
                                            }
                                            ?>
                                        </table>
                                    </div>
                                </div>
                            </section>
                        </div>
                    
                        <div id="boxed" style="margin-top: 50px;">&nbsp;</div>                 

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


//****************************************************************************
//***  EDIT RECORD
//****************************************************************************
function edit_record(){
    global $PHP_SELF, $mysqli, $msg;
    global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
    global $programs_tablename, $progid, $progname, $progdesc, $isenabled, $cost, $charge, $accordian_header, $progtype;
    global $prog_det_tablename, $progdetid, $progid, $courseid, $coursecode, $coursename, $coursecredits;
    global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $coursedesc, $credits, $filename, $validcourse;
    global $progcourses_tablename, $pgid, $progid, $courseid;

    $main_background_color = "#1c262f";
    $sub_background_color = "#26333c"; 
    $child_background_color = "#2f3d4a";
	
    $courseid = $_POST['courseid'];

    $sql = $mysqli->query("SELECT * FROM $courses_tablename WHERE courseid = '$courseid'");
    if(!$sql) error_message("Error in $courses_tablename (courses) line #174");
    $row = $sql->fetch_assoc();	
    $cprogid = $row['cprogid'];
    $coursecode = $row['coursecode'];
    $coursename = $row['coursename'];
    $coursedesc = addslashes($row['coursedesc']);
    $credits = $row['credits'];
    $filename = $row['filename'];
    $validcourse = $row['validcourse'];
    
    $_SESSION['cprogid'] = $cprogid;
    $_SESSION['coursecode'] = $coursecode;
    $_SESSION['coursename'] = $coursename;
    $_SESSION['coursedesc'] = $coursedesc;
    $_SESSION['credits'] = $credits;
    $_SESSION['filename'] = $filename;
    $_SESSION['validcourse'] = $validcourse;

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
                                    <td>
                                        Course Code
                                    </td>
                                    <td>
                                        <input type="text" name="coursecode" size="30" value="<?php echo $_SESSION['coursecode'] ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Course Name
                                    </td>
                                    <td>
                                        <input type="text" name="coursename" size="30" value="<?php echo $_SESSION['coursename'] ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Course Description
                                    </td>
                                    <td>
                                        <textarea name="coursedesc" size="30"><?php echo $_SESSION['coursedesc'] ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Credits
                                    </td>
                                    <td>
                                        <input type="text" name="credits" size="2" value="<?php echo $_SESSION['credits'] ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        File Name
                                    </td>
                                    <td>
                                        <input type="text" name="filename" size="30" value="<?php echo $_SESSION['filename'] ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Valid
                                    </td>
                                    <td>
                                        <?php
                                        if($_SESSION['validcourse'] == Yes){
                                        ?>
                                        <input type="radio" name="validcourse" value="Yes" checked> Yes
                                        <input type="radio" name="validcourse" value="No"> No
                                        <?php
                                        }else{
                                        ?>
                                        <input type="radio" name="validcourse" value="Yes"> Yes
                                        <input type="radio" name="validcourse" value="No" checked> No
                                        <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </table>
                            <input type="hidden" name="courseid" value="<?php echo $courseid ?>">
                            <input type="submit" name="action" value="Done" />
                            </center>
                        </form>
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
    global $programs_tablename, $progid, $progname, $progdesc, $isenabled, $cost, $charge, $accordian_header, $progtype;
    global $prog_det_tablename, $progdetid, $progid, $courseid, $coursecode, $coursename, $coursecredits;
    global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $coursedesc, $credits, $filename, $validcourse;
    global $progcourses_tablename, $pgid, $progid, $courseid;
	
    $courseid = $_POST['courseid'];
    $coursecode = $_POST['coursecode'];
    $coursename = addslashes($_POST['coursename']);
    $coursedesc = addslashes($_POST['coursedesc']);
    $credits = $_POST['credits'];
    $filename = $_POST['filename'];
    $validcourse = $_POST['validcourse'];

    $sql = $mysqli->query("UPDATE $courses_tablename SET coursecode = '$coursecode', coursename = '$coursename', coursedesc = '$coursedesc', credits = '$credits', filename = '$filename', validcourse = '$validcourse' WHERE courseid = '$courseid'");
    if(!$sql) error_message("Error fetching data from $courses_tablename (programs) line #397");

    main_form();
}


//*******************************************************
//*********************  ADD NEW  ***********************
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
    //echo "user_id = ".$user_id."<br>";
    //exit;

    // $sql = $mysqli->query("SELECT * FROM $programs_tablename WHERE progid = '$progid'");
    // if(!$sql) error_message("Error in $courses_tablename (courses) line #135");
    // $row = $sql->fetch_assoc();		
    // $progname = $row['progname'];
    // $isenabled = $row['isenabled'];
    // $cost = $row['cost'];
    // $charge = $row['charge'];		
                    
    // $_SESSION['progname'] = $progname;
    // $_SESSION['isenabled'] = $isenabled;
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
    $isenabled = $_POST['isenabled'];
    $cost = $_POST['cost'];
    $charge = $_POST['charge'];

    $sql = $mysqli->query("INSERT INTO $programs_tablename VALUES(NULL, '$progname', '$isenabled', '$cost', '$charge')");
    if(!$sql) error_message("Error fetching data from $programs_tablename (programs) line #523");

    main_form();
}


//*******************************************************
//**********************  DO ADD  ***********************
//*******************************************************
function add_course(){
    global $PHP_SELF, $mysqli, $msg;
    global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
    global $programs_tablename, $progid, $progname, $progdesc, $isenabled, $cost, $charge, $accordian_header, $progtype;
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
    if(!$sql) error_message("Error fetching data from $programs_tablename (programs) line #554");
    main_form();
}


//*******************************************************
//**********************  DO ADD  ***********************
//*******************************************************
function delete_course(){
    global $PHP_SELF, $mysqli, $msg;
    global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
    global $programs_tablename, $progid, $progname, $progdesc, $isenabled, $cost, $charge, $accordian_header, $progtype;
    global $prog_det_tablename, $progdetid, $progid, $courseid, $coursecode, $coursename, $coursecredits;
    global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $coursedesc, $credits, $filename, $validcourse;
    global $progcourses_tablename, $pgid, $progid, $courseid;
	
    $courseid = $_POST['courseid'];

    $query = mysqli_query($mysqli, "DELETE FROM $courses_tablename WHERE courseid = '$courseid'");
    if(!$query) error_message("Error fetching data from $courses_tablename (delete_prod) line #573");

    main_form();
}


//*******************************************************
//**********************  SWITCH  ***********************
//*******************************************************
    global $progcourses_tablename, $pgid, $progid, $courseid;
switch($action) {
	case "Delete":
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
        ?>
        <script type="text/javascript">
            <!--
            window.top.location.href = "quest_edit.php?courseid=<?php echo $courseid ?>"; 
            //window.location = "main.php"
            -->
        </script>
        <?php
	break;
	case "Add New":
        ?>
        <script type="text/javascript">
            <!--
            window.top.location.href = "exam_add.php";
            -->
        </script>
        <?php
	break;
	default:
		main_form();
	break;
}
?>