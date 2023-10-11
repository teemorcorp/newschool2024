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
global $programs_tablename, $progid, $progname, $enabled, $cost, $charge;
global $prog_det_tablename, $progdetid, $progid, $courseid, $coursecode, $coursename, $coursecredits;
global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $coursedesc, $credits, $filename, $validcourse;
global $progcourses_tablename, $pgid, $progid, $courseid;
global $exams_tablename, $examid, $excourseid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;
global $quizzes_tablename, $quizid, $courseid, $quizname;

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

// // Attempt select query execution
// $sql = "SELECT * FROM $users_tablename WHERE userid = '$userid'";
// if($result = mysqli_query($mysqli, $sql)){
//     if(mysqli_num_rows($result) > 0){
//         $row = mysqli_fetch_array($result);
//         $userid = $row['userid'];
//         $useremail = $row['useremail'];
//         $isadmin = $row['isadmin'];
//         $userfname = $row['userfname'];
//         $userlname = $row['userlname'];
//         $imagepath = $row['imagepath'];
//         $fullname = $userfname." ".$userlname;
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

// if(!isset($courseid) or $courseid != $_SESSION['courseid']){
// 	$courseid = $_GET['courseid'];
// 	$_SESSION['courseid'] = $courseid;
// }else{
// 	$courseid = $_SESSION['courseid'];
// }


// $sqla = $mysqli->query("SELECT * FROM $courses_tablename WHERE courseid = '$courseid'");
// if(!$sqla) error_message("Error in $courses_tablename (quest_edit) line #50");
// $rowa = $sqla->fetch_assoc();	
// $cprogid = $rowa['cprogid'];
// $coursecode = $rowa['coursecode'];
// $coursename = $rowa['coursename'];
// $credits = $rowa['credits'];
// $filename = $rowa['filename'];
// $validcourse = $rowa['validcourse'];
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
                        <section style="padding-top:20px;">
                            <h1>Exam Management</h1>
                            <center>
                            <?php echo $msg; ?>
                            <br>
                            <br>
                            <div class="card text-dark bg-light mb-1" id="boxdisplay">
                                <div class="card-header">
                                    <font size="+2"><strong>Add Quiz/Exam</strong></font>
                                </div>
                                <div class="card-body">
                                    <form action="<?php echo $PHP_SELF ?>" method="post">

                                        <div class="mb-3 row">
                                            <label for="coursecode" class="col-sm-2 col-form-label">Course Code</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="coursecode" id="coursecode" style="width: 100px;" required>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <!-- <form action="< ?php echo $PHP_SELF ?>" method="post"> -->
                                                <select class="input_text" name="courseid">
                                                    <option value="0"><<< MAKE A SELECTION >>></option>
                                                    <?php
                                                    $sqlb = $mysqli->query("SELECT courseid, coursename FROM $courses_tablename ORDER BY coursename ASC");
                                                    if(!$sqlb) error_message("Error in $courses_tablename (programs) line #263");
                                                    $sqlb->data_seek(0);
                                                    while($rowb = $sqlb->fetch_assoc()) {
                                                        $courseid = $rowb['courseid'];
                                                        $coursename = $rowb['coursename'];
                                                        
                                                    ?>
                                                    <option value="<?php echo $courseid ?>"><?php echo $coursename ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            <!-- </form> -->
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="coursecode" class="col-sm-2 col-form-label">Course Code</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="coursecode" id="coursecode" style="width: 100px;" required>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="coursename" class="col-sm-2 col-form-label">Course Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="coursename" id="coursename" style="width: 250px;" required>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="credits" class="col-sm-2 col-form-label">Course Credits</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="credits" id="credits" style="width: 50px;" required>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="filename" class="col-sm-2 col-form-label">File Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="filename" id="filename" style="width: 300px;" required>
                                            </div>
                                        </div>

                                        <div class="form-check mb-3" style="align-items: left;">
                                            <div>
                                                <strong>Enabled</strong>
                                            </div>
                                            <div>
                                                <?php
                                                if($validcourse == true){
                                                    ?>
                                                    <input type="radio" name="validcourse" value="1" checked> Yes
                                                    <input type="radio" name="validcourse" value="0"> No
                                                    <?php
                                                }else{
                                                    ?>
                                                    <input type="radio" name="validcourse" value="1"> Yes
                                                    <input type="radio" name="validcourse" value="0" checked> No
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <br /><br />
                                        <input type="hidden" name="cprogid" value="<?php echo $cprogid ?>">
                                        <input type="hidden" name="courseid" value="<?php echo $courseid ?>">
                                        <input class="btn btn-success" type="submit" name="action" value="Save Exam" />
                                    </form>
                                    <form action="<?php echo $PHP_SELF ?>" method="post">
                                        <table id="boxes" width="100%" cellpadding="10" cellspacing="10" align="left">
                                            <tr>
                                                <td width="75" align="right" valign="top">
                                                    <form action="<?php echo $PHP_SELF ?>" method="post">
                                                        <select class="input_text" name="courseid">
                                                            <option value="0"><<< MAKE A SELECTION >>></option>
                                                            <?php
                                                            $sqlb = $mysqli->query("SELECT courseid, coursename FROM $courses_tablename ORDER BY coursename ASC");
                                                            if(!$sqlb) error_message("Error in $courses_tablename (programs) line #263");
                                                            $sqlb->data_seek(0);
                                                            while($rowb = $sqlb->fetch_assoc()) {
                                                                $courseid = $rowb['courseid'];
                                                                $coursename = $rowb['coursename'];
                                                                
                                                            ?>
                                                            <option value="<?php echo $courseid ?>"><?php echo $coursename ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </form>
                                            </tr>
                                            <tr>
                                                <td width="75" align="right" valign="top">
                                                    <strong>Quiz/Exam Name</strong>
                                                </td>
                                                <td width="325" align="left" valign="top">
                                                    <input maxlength="50" name="quizname" size="30" type="text" value="" />
                                                </td>
                                            </tr>
                                        </table>
                                        <br /><br />
                                        <input class="btn btn-success" type="submit" name="action" value="Save Exam" />
                                    </form>
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
//*********************  SAVE EXAM  *********************
//*******************************************************
function save_exam(){
	global $PHP_SELF, $mysqli, $msg;
	global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
	global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $credits, $filename, $validcourse;
	global $exams_tablename, $examid, $excourseid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;
	global $quizzes_tablename, $quizid, $courseid, $quizname;

    $courseid = $_POST['courseid'];
    $quizname = addslashes($_POST['quizname']);

    $query = $mysqli->query("INSERT INTO $quizzes_tablename (quizid, courseid, quizname) VALUES (NULL, '$courseid', '$quizname')");
    if(!$query) error_message("Error fetching data from $quizzes_tablename (quest_edit) line #510");

    $msg = "Updated!<br><br>";

    //main_form();
    ?>
    <script type="text/javascript">
        <!--
        window.location = "exams.php"
        -->
    </script>
    <?php
}


//*******************************************************
//**********************  SWITCH  ***********************
//*******************************************************
switch($action) {
	case "Save Exam":
		save_exam();
	break;
	default:
		main_form();
	break;
}
?>