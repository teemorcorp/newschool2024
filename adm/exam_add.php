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
                            <?php echo $msg; ?>
                            <br>
                            <br>
                            <div class="card text-dark bg-light mb-1" id="boxdisplay">
                                <div class="card-header">
                                    <font size="+2"><strong>Add Quiz/Exam</strong></font>
                                </div>
                                <div class="card-body">
                                    <form action="<?php echo $PHP_SELF ?>" method="post">

                                        <div class="mb-3">
                                            <label for="courseid" class="col-sm-2 col-form-label">Course</label>
                                            <select class="input_text" name="courseid">
                                                <option value="0"><<< MAKE A SELECTION >>></option>
                                                <?php
                                                $sqlb = $mysqli->query("SELECT courseid, coursename FROM $courses_tablename ORDER BY coursename ASC");
                                                // if(!$sqlb) error_message("Error in $courses_tablename (programs) line #263");
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
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="quizname" class="col-sm-2 col-form-label">Quiz Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="quizname" id="quizname" style="width: 300px;" required>
                                            </div>
                                        </div>
                                        <br /><br />
                                        <input type="hidden" name="courseid" value="<?php echo $courseid ?>">
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
	global $quizzes_tablename, $quizid, $excourseid, $qdetid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;

    include 'tmp/globals.php';
    dbconnect();
    if (!$mysqli) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $courseid = $_POST['courseid'];
    $quizname = addslashes($_POST['quizname']);

echo "Line #144<br>";
    // $query = $mysqli->query("INSERT INTO $quizzes_tablename VALUES (NULL, '$courseid', '$quizname')");
    // if(!$query) error_message("Error fetching data from $quizzes_tablename (quest_edit) line #510");
    $sql = $mysqli->query("INSERT INTO $quizzes_tablename VALUES(NULL, '$courseid', '$quizname'')");
    // if(!$sql) error_message("Error fetching data from $programs_tablename (programs) line #345");

echo "Line #151<br>";
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