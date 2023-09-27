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
global $exams_tablename, $examid, $excourseid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;
global $quizzes_tablename, $quizid, $courseid, $quizname;

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

if(!isset($courseid) or $courseid != $_SESSION['courseid']){
	$courseid = $_GET['courseid'];
	$_SESSION['courseid'] = $courseid;
}else{
	$courseid = $_SESSION['courseid'];
}


$sqla = $mysqli->query("SELECT * FROM $courses_tablename WHERE courseid = '$courseid'");
if(!$sqla) error_message("Error in $courses_tablename (quest_edit) line #50");
$rowa = $sqla->fetch_assoc();	
$cprogid = $rowa['cprogid'];
$coursecode = $rowa['coursecode'];
$coursename = $rowa['coursename'];
$credits = $rowa['credits'];
$filename = $rowa['filename'];
$validcourse = $rowa['validcourse'];

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