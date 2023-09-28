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
global $quizzes_tablename, $quizid, $excourseid, $qdetid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;
global $quizdet_tablename, $qdetid, $quizname, $courseid;

$main_background_color = "#1c262f";
$sub_background_color = "#26333c"; 
$child_background_color = "#2f3d4a";

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
}else{
    echo "ERROR: Was not able to execute Query on line #152. " . mysqli_error($mysqli);
}
// End attempt select query execution

if(!isset($qdetid) or $qdetid != $_SESSION['qdetid']){
	$qdetid = $_GET['qdetid'];
	$_SESSION['qdetid'] = $qdetid;
}else{
	$qdetid = $_SESSION['qdetid'];
}

$sqla = $mysqli->query("SELECT * FROM $quizdet_tablename WHERE qdetid = '$qdetid'");
//if(!$sqla) error_message("Error in $quizzes_tablename (quest_edit) line #50");
$rowa = $sqla->fetch_assoc();	
$qdetid = $rowa['qdetid'];
$quizname = $rowa['quizname'];
$courseid = $rowa['courseid'];

$sqlb = $mysqli->query("SELECT courseid, coursename FROM $courses_tablename WHERE courseid = '$courseid'");
//if(!$sqlb) error_message("Error in $courses_tablename (quest_edit) line #50");
$rowb = $sqlb->fetch_assoc();
$courseidb = $rowb['courseid'];
$coursename = $rowb['coursename'];

    /*echo "qdetid: ".$qdetid."<br>";
    echo "quizname: " . $quizname . "<br>";
    echo "courseid: " . $courseid . "<br>";
    echo "courseidb: " . $courseidb . "<br>";
    echo "coursename: " . $coursename . "<br>";
    exit;*/

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
                        <h1>Quiz Management</h1>
                        <center>
                        <?php echo $msg; ?>
                        <br>
                        <br>
                        <div class="card text-dark bg-light mb-1" id="boxdisplay">
                            <div class="card-header">
                                <font size="+2"><strong>Quiz Questions</strong></font>
                            </div>
                            <div class="card-body">
                                <form action="<?php echo $PHP_SELF ?>" method="post">
                                    <table id="boxes" width="100%" cellpadding="10" cellspacing="10" align="left">
                                        <tr>
                                            <td width="75" align="right" valign="top">
                                                <strong>Quiz ID</strong>
                                            </td>
                                            <td width="325" align="left" valign="top">
                                                <?php echo $qdetid ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="75" align="right" valign="top">
                                                <strong>Quiz Name</strong>
                                            </td>
                                            <td width="325" align="left" valign="top">
                                                <input maxlength="50" name="quizname" size="30" type="text" value="<?php echo $quizname ?>" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="75" align="right" valign="top">
                                                <strong>Course Name</strong>
                                            </td>
                                            <td width="325" align="left" valign="top">
                                                <!--form action="< ?php echo $PHP_SELF ?>" method="post"-->
                                                    <select class="input_text" name="cid">
                                                        <option value="<?php echo $courseid; ?>"><?php echo $coursename; ?></option>
                                                        <?php
                                                        $sqlb = $mysqli->query("SELECT courseid, coursename FROM $courses_tablename ORDER BY coursename ASC");
                                                        //if(!$sqlb) error_message("Error in $courses_tablename (programs) line #263");
                                                        $sqlb->data_seek(0);
                                                        while($rowb = $sqlb->fetch_assoc()) {
                                                            $cid = $rowb['courseid'];
                                                            $cname = $rowb['coursename'];
                                                        ?>
                                                        <option value="<?php echo $cid ?>"><?php echo $cname ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                <!--/form-->
                                            </td>
                                        </tr>
                                    </table>
                                    <br /><br />
                                    <input type="hidden" name="qdetid" value="<?php echo $qdetid ?>">
                                    <!--input type="hidden" name="coursename" value="< ?php echo $coursename ?>"-->
                                    <input class="btn btn-success" type="submit" name="action" value="Save Exam" />
                                    <br /><br />
                                    <input type="hidden" name="courseid" value="<?php echo $courseid ?>">
                                    <input class="btn btn-success" type="submit" name="action" value="Add Question" />&nbsp;&nbsp;&nbsp;<input class="btn btn-success" type="submit" name="action" value="Print Questions" />
                                    <br><br>
                                </form>
                                <table Class="table table-striped">
                                    <tr>
                                        <td>
                                            <strong>CID</strong>
                                        </td>
                                        <td>
                                            <strong>EID</strong>
                                        </td>
                                        <td>
                                            <strong>Q #</strong>
                                        </td>
                                        <td>
                                            <strong>Question</strong>
                                        </td>
                                        <td>
                                            <strong>Correct Answer</strong>
                                        </td>
                                        <td>
                                            <strong>Delete/Modify</strong>
                                        </td>
                                    </tr>
                                    <?php
                                    $sqlb = $mysqli->query("SELECT * FROM $quizzes_tablename WHERE excourseid = '$courseid' AND qdetid = '$qdetid' ORDER BY questnumber ASC");
                                    //if(!$sqlb) error_message("Error in $quizzes_tablename (quest_edit) line #178");
                                    $sqlb->data_seek(0);
                                    while($rowb = $sqlb->fetch_assoc()) {
                                        $quizid = $rowb['quizid'];
                                        $excourseid = $rowb['excourseid'];
                                        $qdetid = $rowb['qdetid'];
                                        $instruct = $rowb['instruct'];
                                        $questnumber = $rowb['questnumber'];
                                        $question = $rowb['question'];
                                        $ansone = $rowb['ansone'];
                                        $anstwo = $rowb['anstwo'];
                                        $ansthree = $rowb['ansthree'];
                                        $ansfour = $rowb['ansfour'];
                                        $correct = $rowb['correct'];
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $quizid ?>
                                            </td>
                                            <td>
                                                <?php echo $qdetid ?>
                                            </td>
                                            <td>
                                                <?php echo $questnumber ?>
                                            </td>
                                            <td>
                                                <?php echo $question ?>
                                            </td>
                                            <td>
                                                <?php echo $correct ?>
                                            </td>
                                            <td>
                                                <form action="<?php echo $PHP_SELF ?>" method="post">
                                                    <input type="hidden" name="coursename" value="<?php echo $coursename ?>">
                                                    <input type="hidden" name="quizid" value="<?php echo $quizid ?>">
                                                    <button class="btn btn-primary" type="submit" name="action" value="Edit">Edit</button>
                                                    <button class="btn btn-danger" type="submit" name="action" value="Delete">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </table>
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
//*******************  ADD PROGRAM  *********************
//*******************************************************
function add_question(){

    global $PHP_SELF, $mysqli, $msg;
    global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
    global $programs_tablename, $progid, $progname, $enabled, $cost, $charge;
    global $prog_det_tablename, $progdetid, $progid, $courseid, $coursecode, $coursename, $coursecredits;
    global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $coursedesc, $credits, $filename, $validcourse;
    global $progcourses_tablename, $pgid, $progid, $courseid;
    global $exams_tablename, $examid, $excourseid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;
    global $quizzes_tablename, $quizid, $excourseid, $qdetid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;
    global $quizdet_tablename, $qdetid, $quizname, $courseid;
    
    $main_background_color = "#1c262f";
    $sub_background_color = "#26333c"; 
    $child_background_color = "#2f3d4a";

    $qdetid = $_POST['qdetid'];
    $courseid = $_POST['courseid'];
    
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
                    

                    <!-- *******************************************************************************************
                    **********  POPULAR PRODUCTS
                    *********************************************************************************************-->
                    <section name="Website Options" style="padding-top:20px;">
                        <h1>Quiz Management</h1>
                        <center>
                        <?php echo $msg; ?>
                        <br>
                        </center>
                        <br>
        
                        <center>
                        <form action="<?php echo $PHP_SELF ?>" method="post">
                            <table width="600" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="300" align="left" valign="top">
                                        Instructions:
                                    </td>
                                    <td width="300" align="left" valign="top">
                                        <textarea cols="60" rows="5" name="instruct" type="text"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top">
                                        Question #:
                                    </td>
                                    <td align="left" valign="top">
                                        <input maxlength="5" name="questnumber" size="5" type="text" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top">
                                        Question:
                                    </td>
                                    <td align="left" valign="top">
                                        <textarea cols="60" rows="5" name="question" type="text"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top">
                                        Answer 1:
                                    </td>
                                    <td align="left" valign="top">
                                        <input maxlength="255" name="ansone" size="60" type="text" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top">
                                        Answer 2:
                                    </td>
                                    <td align="left" valign="top">
                                        <input maxlength="255" name="anstwo" size="60" type="text" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top">
                                        Answer 3:
                                    </td>
                                    <td align="left" valign="top">
                                        <input maxlength="255" name="ansthree" size="60" type="text" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top">
                                        Answer 4:
                                    </td>
                                    <td align="left" valign="top">
                                        <input maxlength="255" name="ansfour" size="60" type="text" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top">
                                        Correct Answer:
                                    </td>
                                    <td align="left" valign="top">
                                        <input maxlength="3" name="correct" size="3" type="text" value="">
                                    </td>
                                </tr>
                            </table>
                            <input type="hidden" name="qdetid" value="<?php echo $qdetid ?>">
                            <input type="hidden" name="courseid" value="<?php echo $courseid ?>">
                            <input class="btn btn-success" style="width: 150px;" name="action" type="submit" value="Save New Question" />
                        </form>
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
//*******************  ADD PROGRAM  *********************
//*******************************************************
function add_now(){
	global $PHP_SELF, $mysqli, $msg;
	global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
	global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $credits, $filename, $validcourse;
	global $exams_tablename, $examid, $excourseid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;
    global $quizzes_tablename, $quizid, $excourseid, $qdetid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;
    global $quizdet_tablename, $qdetid, $quizname, $courseid;

    $qdetid = $_POST['qdetid'];
    $excourseid = $_POST['courseid'];
    $quizname = "";
    $instruct = addslashes($_POST['instruct']);
    $questnumber = $_POST['questnumber'];
    $question = addslashes($_POST['question']);
    $ansone = addslashes($_POST['ansone']);
    $anstwo = addslashes($_POST['anstwo']);
    $ansthree = addslashes($_POST['ansthree']);
    $ansfour = addslashes($_POST['ansfour']);
    $correct = $_POST['correct'];

	$sql = $mysqli->query("INSERT INTO $quizzes_tablename VALUES(NULL, '$excourseid', '$qdetid', '$instruct', '$questnumber', '$question', '$ansone', '$anstwo', '$ansthree', '$ansfour', '$correct')");
	//if(!$sql) error_message("Error fetching data from $quizzes_tablename (quest_edit) line #353");

    main_form();
}


//*******************************************************
//*******************  EDIT PROGRAM  ********************
//*******************************************************
function edit_now(){

    global $PHP_SELF, $mysqli, $msg;
    global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
    global $programs_tablename, $progid, $progname, $enabled, $cost, $charge;
    global $prog_det_tablename, $progdetid, $progid, $courseid, $coursecode, $coursename, $coursecredits;
    global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $coursedesc, $credits, $filename, $validcourse;
    global $progcourses_tablename, $pgid, $progid, $courseid;
    global $exams_tablename, $examid, $excourseid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;
    global $quizzes_tablename, $quizid, $excourseid, $qdetid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct, $isvalid;
    global $quizdet_tablename, $qdetid, $quizname, $courseid;
    
    $main_background_color = "#1c262f";
    $sub_background_color = "#26333c"; 
    $child_background_color = "#2f3d4a";

    $coursename = $_POST['coursename'];
    $quizid = $_POST['quizid'];

    $sqla = $mysqli->query("SELECT * FROM $quizzes_tablename WHERE quizid = '$quizid'");
    //if(!$sqla) error_message("Error in $quizzes_tablename (quest_edit) line #50");
    $rowa = $sqla->fetch_assoc();	
    $quizid = $rowa['quizid'];
    $excourseid = $rowa['excourseid'];
    $instruct = $rowa['instruct'];
    $questnumber = $rowa['questnumber'];
    $question = $rowa['question'];
    $ansone = $rowa['ansone'];
    $anstwo = $rowa['anstwo'];
    $ansthree = $rowa['ansthree'];
    $ansfour = $rowa['ansfour'];
    $correct = $rowa['correct'];
    $isvalid = $rowa['isvalid'];
    
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
                    

                    <!-- *******************************************************************************************
                    **********  POPULAR PRODUCTS
                    *********************************************************************************************-->
                    <section name="Website Options" style="padding-top:20px;">
                        <h1>Edit Questions</h1>
                        <center>
                        <?php echo $msg; ?>
                        <br>
                        </center>
                        <br>
        
                        <center>
                        <form action="<?php echo $PHP_SELF ?>" method="post">
                            <table width="600" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="300" align="left" valign="top">
                                        Quiz ID:
                                    </td>
                                    <td width="300" align="left" valign="top">
                                        <?php echo $quizid ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top">
                                        Instructions:
                                    </td>
                                    <td align="left" valign="top">
                                        <textarea cols="60" rows="5" name="instruct" type="text" /><?php echo $instruct ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top">
                                        Question #:
                                    </td>
                                    <td align="left" valign="top">
                                        <input maxlength="3" name="questnumber" size="3" type="text" value="<?php echo $questnumber ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top">
                                        Question:
                                    </td>
                                    <td align="left" valign="top">
                                        <textarea cols="60" rows="5" name="question" type="text" /><?php echo $question ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top">
                                        Answer 1:
                                    </td>
                                    <td align="left" valign="top">
                                        <input maxlength="255" name="ansone" size="60" type="text" value="<?php echo $ansone ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top">
                                        Answer 2:
                                    </td>
                                    <td align="left" valign="top">
                                        <input maxlength="255" name="anstwo" size="60" type="text" value="<?php echo $anstwo ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top">
                                        Answer 3:
                                    </td>
                                    <td align="left" valign="top">
                                        <input maxlength="255" name="ansthree" size="60" type="text" value="<?php echo $ansthree ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top">
                                        Answer 4:
                                    </td>
                                    <td align="left" valign="top">
                                        <input maxlength="255" name="ansfour" size="60" type="text" value="<?php echo $ansfour ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top">
                                        Correct Answer:
                                    </td>
                                    <td align="left" valign="top">
                                        <input maxlength="3" name="correct" size="3" type="text" value="<?php echo $correct ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top">
                                        Is Valid:
                                    </td>
                                    <td align="left" valign="top">
                                        <?php
                                        if($isvalid == 'Yes'){
                                        ?>
                                        <input type="radio" name="isvalid" value="Yes" checked> Yes
                                        <input type="radio" name="isvalid" value="No"> No
                                        <?php
                                        }else{
                                        ?>
                                        <input type="radio" name="isvalid" value="Yes"> Yes
                                        <input type="radio" name="isvalid" value="No" checked> No
                                        <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </table>
                            <input type="hidden" name="coursename" value="<?php echo $coursename ?>">
                            <input type="hidden" name="quizid" value="<?php echo $quizid ?>">
                            <input class="btn btn-success" name="action" type="submit" value="Save Question" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="btn btn-danger" type="submit" name="action" value="Delete" />
                        </form>
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
//*********************  SAVE NOW  **********************
//*******************************************************
function save_question(){
	global $PHP_SELF, $mysqli, $msg;
	global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
	global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $credits, $filename, $validcourse;
	global $exams_tablename, $examid, $excourseid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;
    global $quizzes_tablename, $quizid, $excourseid, $qdetid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct, $isvalid;
    global $quizdet_tablename, $qdetid, $quizname, $courseid;

    $quizid = $_POST['quizid'];
    $instruct = addslashes($_POST['instruct']);
    $questnumber = $_POST['questnumber'];
    $question = addslashes($_POST['question']);
    $ansone = addslashes($_POST['ansone']);
    $anstwo = addslashes($_POST['anstwo']);
    $ansthree = addslashes($_POST['ansthree']);
    $ansfour = addslashes($_POST['ansfour']);
    $correct = $_POST['correct'];
    $isvalid = $_POST['isvalid'];

    /*echo "quizid: ".$quizid."<br>";
    echo "instruct: ".$instruct."<br>";
    echo "questnumber: ".$questnumber."<br>";
    echo "question: ".$question."<br>";
    echo "ansone: ".$ansone."<br>";
    echo "anstwo: ".$anstwo."<br>";
    echo "ansthree: ".$ansthree."<br>";
    echo "ansfour: ".$ansfour."<br>";
    echo "correct: ".$correct."<br>";
    exit;*/

    $query = $mysqli->query("UPDATE $quizzes_tablename SET instruct = '$instruct', questnumber = '$questnumber', question = '$question', ansone = '$ansone', anstwo = '$anstwo', ansthree = '$ansthree', ansfour = '$ansfour', correct = '$correct' WHERE quizid = '$quizid'");
    //if(!$query) error_message("Error fetching data from $quizzes_tablename (quest_edit) line #487");

    $msg = "Updated!<br><br>";

    main_form();
}

//*******************************************************
//*********************  SAVE EXAM  *********************
//*******************************************************
function save_exam(){
	global $PHP_SELF, $mysqli, $msg;
	global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
	global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $credits, $filename, $validcourse;
	global $exams_tablename, $examid, $excourseid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;
    global $quizzes_tablename, $quizid, $excourseid, $qdetid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct, $isvalid;
    global $quizdet_tablename, $qdetid, $quizname, $courseid;

    $qdetid = $_POST['qdetid'];
    $quizname = $_POST['quizname'];
    //$courseid = $_POST['courseid'];
    $cid = $_POST['cid'];

    /*echo "qdetid: ".$qdetid."<br>";
    echo "quizname: ".$quizname."<br>";
    echo "courseid: ". $courseid."<br>";
    echo "cid: " . $cid . "<br>";
    exit;*/

    $query = $mysqli->query("UPDATE $quizdet_tablename SET quizname = '$quizname', courseid = '$cid' WHERE qdetid = '$qdetid'");
    //if(!$query) error_message("Error fetching data from $quizdet_tablename (quest_edit) line #510");

    $msg = "Updated!<br><br>";

    //main_form();
    header('Location: quizzes.php');
}

//*******************************************************
//********************  DELETE NOW  *********************
//*******************************************************
function delete_now(){
	global $PHP_SELF, $mysqli, $msg;
	global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
	global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $credits, $filename, $validcourse;
	global $exams_tablename, $examid, $excourseid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;
    global $quizzes_tablename, $quizid, $excourseid, $qdetid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct, $isvalid;
    global $quizdet_tablename, $qdetid, $quizname, $courseid;

    $quizid = $_POST['quizid'];
    $coursename = $_POST['coursename'];

    $_SESSION['quizid'] = $quizid;
    $_SESSION['coursename'] = $coursename;


    ?>
    <center>
    Are you sure you want to delete <strong><?php echo $coursename ?></strong> Quiz ID #<strong><?php echo $quizid ?></strong>?
    <br><br>
    <form action="<?php echo $PHP_SELF ?>" method="post">
        <input class="button_gradient_drk_red" name="action" type="submit" value="Yes" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="button_gradient_blue" type="submit" name="action" value="No" />
    </form>
    </center>
    <?php
}



//*******************************************************
//********************  DELETE NOW  *********************
//*******************************************************
function do_delete(){
	global $PHP_SELF, $mysqli, $msg;
	global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
	global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $credits, $filename, $validcourse;
	global $exams_tablename, $examid, $excourseid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;
    global $quizzes_tablename, $quizid, $excourseid, $qdetid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct, $isvalid;
    global $quizdet_tablename, $qdetid, $quizname, $courseid;

    $quizid = $_SESSION['quizid'];
    $coursename = $_SESSION['coursename'];

    //echo "examid = ".$examid."<br>";
    //echo "coursename = ".$coursename."<br>";
    //exit;

    $query = $mysqli->query("DELETE FROM $quizzes_tablename WHERE quizid = '$quizid'");
    //if(!$query) error_message("Error fetching data from $quizzes_tablename (quest_edit) line #588");

    $msg = "Updated!<br><br>";

    main_form();
}



//*******************************************************
//*********************  SAVE EXAM  *********************
//*******************************************************
function print_questions(){
	global $PHP_SELF, $mysqli, $msg;
	global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
	global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $credits, $filename, $validcourse;
	global $exams_tablename, $examid, $excourseid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;
    global $quizzes_tablename, $quizid, $excourseid, $qdetid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct, $isvalid;
    global $quizdet_tablename, $qdetid, $quizname, $courseid;

    $progid = $_POST['cprogid'];
    $courseid = $_POST['courseid'];
    ?>

    <script language="JavaScript">
        function printSpecial(){
            var gAutoPrint = true; // Tells whether to automatically call the print function
            if (document.getElementById != null){
                var html = '<HTML>\n<HEAD>\n';

                if (document.getElementsByTagName != null){
                    var headTags = document.getElementsByTagName("head");
                    if (headTags.length > 0) html += headTags[0].innerHTML;
                }

                html += '\n</HE>\n<BODY>\n';

                var printReadyElem = document.getElementById("printReady");

                if (printReadyElem != null){
                    html += printReadyElem.innerHTML;
                }else{
                    alert("Could not find the printReady function");
                    return;
                }

                html += '\n</BO>\n</HT>';

                var printWin = window.open("","printSpecial");
                printWin.document.open();
                printWin.document.write(html);
                printWin.document.close();
                if (gAutoPrint) printWin.print();
            }else{
                alert("The print ready feature is only available if you are using an browser. Please update your browswer.");
            }
        }
    </script>

    <form id="printMe" name="printMe"> <input type="button" name="printMe" onClick="printSpecial()" value="Print this Page"></form>
    <form action="possearch.php?userid=<?php echo $userid ?>" method="post" style="text-align: center">
    <div id="printReady">
    <?php
    $sqla = $mysqli->query("SELECT coursename FROM $courses_tablename WHERE courseid = '$courseid'");
    //if(!$sqla) error_message("Error in $courses_tablename (quest_edit) line #610");
    $rowa = $sqla->fetch_assoc();	
    $coursename = $rowa['coursename'];
    ?>
    <h1><?php echo $coursename ?></h1>
    <table id="boxes" width="100%" cellpadding="2" cellspacing="0" align="center">
        <?php
        $sqlb = $mysqli->query("SELECT * FROM $exams_tablename WHERE excourseid = '$courseid' ORDER BY questnumber ASC");
        //if(!$sqlb) error_message("Error in $exams_tablename (quest_edit) line #618");
        $sqlb->data_seek(0);
        while($rowb = $sqlb->fetch_assoc()) {
            $examid = $rowb['examid'];
            $instruct = $rowb['instruct'];
            $questnumber = $rowb['questnumber'];
            $question = $rowb['question'];
            $ansone = $rowb['ansone'];
            $anstwo = $rowb['anstwo'];
            $ansthree = $rowb['ansthree'];
            $ansfour = $rowb['ansfour'];
            $correct = $rowb['correct'];
        ?>
            <tr>
                <td align="right" valign="top" width="10%">
                    Question #:
                </td>
                <td align="left" valign="top" width="40%">
                    <font size="+2"><strong><?php echo $questnumber ?></strong></font>
                </td>
                <td align="right" valign="top" width="10%">
                    Exam ID:
                </td>
                <td align="left" valign="top" width="40%">
                    <strong><?php echo $examid ?></strong>
                </td>
            </tr>
            <tr>
                <td align="right" valign="top">
                    Course ID:
                </td>
                <td align="left" valign="top">
                    <strong><?php echo $courseid ?></strong>
                </td>
                <td align="right" valign="top">
                    Correct #:
                </td>
                <td align="left" valign="top">
                    <strong><?php echo $correct ?></strong>
                </td>
            </tr>
            <tr>
                <td align="right" valign="top">
                    Instructions:
                </td>
                <td align="left" valign="top">
                    <strong><?php echo $instruct ?></strong>
                </td>
                <td align="right" valign="top">
                    Question:
                </td>
                <td align="left" valign="top">
                    <strong><?php echo $question ?></strong>
                </td>
            </tr>
            <tr>
                <td align="right" valign="top">
                    Answer #1:
                </td>
                <td align="left" valign="top">
                    <strong><?php echo $ansone ?></strong>
                </td>
                <td align="right" valign="top">
                    Answer #2:
                </td>
                <td align="left" valign="top">
                    <strong><?php echo $anstwo ?></strong>
                </td>
            </tr>
            <tr>
                <td align="right" valign="top">
                    Answer #3:
                </td>
                <td align="left" valign="top">
                    <strong><?php echo $ansthree ?></strong>
                </td>
                <td align="right" valign="top">
                    Answer #4:
                </td>
                <td align="left" valign="top">
                    <strong><?php echo $ansfour ?></strong>
                </td>
            </tr>
            <tr>
                <td align="right" valign="top" colspan="4">
                    <hr>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
    <br /><br />
    </div> 
    </form>
<?php
}


//*******************************************************
//**********************  SWITCH  ***********************
//*******************************************************
switch($action) {
	case "Delete":
		delete_now();
	break;
	case "Yes":
		do_delete();
	break;
	case "No":
		main_form();
	break;
	case "Edit":
		edit_now();
	break;
	case "Add Question":
		add_question();
	break;
	case "Print Questions":
		print_questions();
	break;
	case "Save New Question":
		add_now();
	break;
	case "Save Question":
		save_question();
	break;
	case "Save Exam":
		save_exam();
	break;
	default:
		main_form();
	break;
}
?>