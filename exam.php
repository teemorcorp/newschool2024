<?php

/****************************************************
 ****   IHN Bible College
 ****   Designed by: Tom Moore
 ****   Written by: Tom Moore
 ****   (c) 2001 - 2021 TEEMOR eBusiness Solutions
 ****************************************************/
include 'includes/globals.php';
session_start();
db_connect();

if ($mysqli->connect_error) {
    echo 'Failed to connect to server: (' . $mysqli->connect_error . ') ' . $mysqli->connect_error;
}

global $PHP_SELF, $mysqli, $msg, $nextpage, $prevpage, $perpage, $array, $question_num;
global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $corecompletedate;
global $system_tablename;
global $progenroll_tablename, $progenrollid, $enrprogid, $enruserid;
global $enrollments_tablename, $enrollid, $euserid, $eprogid, $ecourseid, $examscore, $passed;
global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $coursedesc, $credits, $filename, $validcourse;
global $courselessons_tablename, $lessonid, $courseid, $lessonnumber, $lessonname, $lessondetail, $videourl, $fileurl, $quizid;

//unset($array);
//unset($_SESSION['question_num']);

$main_background_color = "#3f3a7a";
$sub_background_color = "#534ba5";
$child_background_color = "#4872ff";

$userid = $_SESSION['userid'];

// Attempt select query execution
$sql = "SELECT * FROM $users_tablename WHERE userid = '$userid'";
if ($result = mysqli_query($mysqli, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $userid = $row['userid'];
        $useremail = $row['useremail'];
        $isadmin = $row['isadmin'];
        $userfname = $row['userfname'];
        $usermname = $row['usermname'];
        $userlname = $row['userlname'];
        $useraddress = $row['useraddress'];
        $usercity = $row['usercity'];
        $userzip = $row['userzip'];
        $usercountry = $row['usercountry'];
        $userphone = $row['userphone'];
        if (empty($usermname)) {
            $fullname = $userfname . " " . $userlname;
        } else {
            $fullname = $userfname . " " . $usermname . " " . $userlname;
        }
        // Free result set
        mysqli_free_result($result);
    } else {
        $msg = "<font color='#FF0000'><strong>Account Does Not Exsist!</strong></font>";
        header("Location: ../index.php");
    }
} else {
    echo "ERROR: Was not able to execute Query on line #152. " . mysqli_error($mysqli);
}
// End attempt select query execution

include 'templates/include.tpl';
include "templates/style.tpl";

// Grab action
if (isset($_POST['action'])) {
    $action = $_POST['action'];
} else {
    $action = '';
}
//*******************************************************
//*******************  MAIN FORM  ***********************
//*******************************************************

function main_form()
{
    global $PHP_SELF, $mysqli, $msg, $array;
    global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
    global $answers_tablename, $answerid, $userid, $courseid, $examid, $answer, $score;
    global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $credits, $filename, $validcourse;
    global $enrollments_tablename, $enrollid, $euserid, $eprogid, $ecourseid, $examscore, $passed;
    global $exams_tablename, $examid, $excourseid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;

    $courseid = $_GET['id'];

    $sqla = $mysqli->query("SELECT * FROM courses WHERE courseid = '$courseid'");
    //if(!$sqla) error_message("Error in $courses_tablename (exams) line #45");
    $rowa = $sqla->fetch_assoc();
    $coursename = $rowa['coursename'];

    $sql = $mysqli->query("SELECT COUNT(*) AS 'TotalQuestions' FROM exams WHERE excourseid = '$courseid'");
    //if(!$sql) error_message("Error in $exams_tablename (exams) line #59");
    $row = $sql->fetch_assoc();
    $total_questions = $row['TotalQuestions'];
    $_SESSION['total_questions'] = $total_questions;

    //$count = $total_questions;
    /*
    if(empty($array)){
        $array = array();
        for ($x = 1; $x <= $count; $x++){
            array_push($array, $x);
        }
        shuffle($array);
    }*/

    if (!isset($_SESSION['question_num'])) {
        $question_num = 0;
        $_SESSION['question_num'] = $question_num;
    } else {
        $question_num = $_SESSION['question_num'];
    }
?>
    </head>

    <body>
        <div class='container-fluid'>
            <?php include "templates/topmenu.tpl"; ?>
            <!-- *****************************************************************************************************
    *******  MAIN
    *******************************************************************************************************-->
            <section>
                <div class="row" style="height: 100vh;">
                    <div class="col-sm-2" style="background-color:#1c262f; padding-left: 0px;">
                        <?php include "templates/leftmenu.tpl"; ?>
                    </div>
                    <div class="col">
                        <div class="row " style="padding-top:10px;">
                            <div class="col-12">
                                <?php
                                if ($question_num == 0) {
                                ?>
                                    <center>
                                        <h1><?php echo $coursename; ?> Final Exam</h1>
                                    </center>
                                    <br><br>
                                    This is the final exam for the course titled <?php echo $coursename; ?>. Read ALL direction so you clearly understand how to take this exam properly.
                                    <br /><br />
                                    There are <font color="#FF0000"><strong><?php echo $total_questions; ?></strong></font> questions in this exam. If you quit or loose connection before completing this exam your score will not be posted correctly and you will have to retake the exam.
                                    <br /><br />
                                    <form action="<?php echo $PHP_SELF ?>" method="post">
                                        <input class="button_gradient_green" type="submit" name="action" value="Continue" />
                                    </form>
                                    </center>
                                <?php
                                } else {
                                    $sqlb = $mysqli->query("SELECT * FROM exams WHERE excourseid = '$courseid' AND questnumber = '$question_num'");
                                    //if(!$sqlb) error_message("Error in $exams_tablename (exams) line #95");
                                    $rowb = $sqlb->fetch_assoc();
                                    $examid = $rowb['examid'];
                                    $instruct = $rowb['instruct'];
                                    $question = $rowb['question'];
                                    $ansone = $rowb['ansone'];
                                    $anstwo = $rowb['anstwo'];
                                    $ansthree = $rowb['ansthree'];
                                    $ansfour = $rowb['ansfour'];
                                    $correct = $rowb['correct'];

                                    $userid = $_SESSION['userid'];

                                    $sqlc = $mysqli->query("SELECT * FROM answers WHERE userid = '$userid' AND courseid = '$courseid' AND examid = '$examid'");
                                    //if(!$sqlc) error_message("Error fetching data from $answers_tablename (exams) line #112");
                                    $rowc = $sqlc->fetch_assoc();
                                    $answerid = $rowc['answerid'];
                                    $answer = $rowc['answer'];
                                    $score = $rowc['score'];
                                    $_SESSION['answer'] = $answer;
                                ?>
                                    <script>
                                        window.onload = init;

                                        function init() {
                                            document.getElementById("answer").focus();
                                        }
                                    </script>

                                    <center>
                                        <h1><?php echo $coursename; ?> Final Exam</h1>
                                    </center>
                                    <form action="<?php echo $PHP_SELF ?>" method="post">
                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td width="100%" align="left" valign="top">
                                                    <font size="+2">Question #<?php echo $question_num; ?></font>
                                                    <?php echo $msg; ?>
                                                    <br /><br />
                                                    <font size="+1" color="#000000"><strong>Instructions:</strong></font>&nbsp;&nbsp;
                                                    <font size="+1" color="#009933"><strong><?php echo $instruct; ?></strong></font>
                                                    <br /><br />
                                                    <font size="+1" color="#000000"><strong>Question:</strong></font>&nbsp;&nbsp;
                                                    <font size="+1" color="#0000FF"><?php echo $question; ?></font>
                                                    <br /><br />
                                                    <!--strong>Select an answer from the choices below.</strong>
                                        <br /><br /-->
                                                    [1] <?php echo $ansone; ?>

                                                    <br /><br />
                                                    [2] <?php echo $anstwo; ?>

                                                    <?php
                                                    if (!empty($ansthree)) {
                                                    ?>
                                                        <br /><br />
                                                        [3] <?php echo $ansthree; ?>
                                                    <?php
                                                    }
                                                    ?>

                                                    <?php
                                                    if (!empty($ansfour)) {
                                                    ?>
                                                        <br /><br />
                                                        [4] <?php echo $ansfour; ?>
                                                    <?php
                                                    }
                                                    ?>
                                                    <br /><br />
                                                    <strong>Enter answer here:</strong>
                                                    <select class="input_text" name="answer">
                                                        <option value="<?php echo $_SESSION['answer'] ?>"><?php echo $_SESSION['answer'] ?></option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                    </select>

                                                    <br /><br />
                                                </td>
                                            </tr>
                                        </table>

                                        <input type="hidden" name="courseid" value="<?php echo $courseid ?>">
                                        <input type="hidden" name="userid" value="<?php echo $userid ?>">
                                        <input type="hidden" name="examid" value="<?php echo $examid ?>">
                                        <input type="hidden" name="instruct" value="<?php echo $instruct ?>">
                                        <input type="hidden" name="question" value="<?php echo $question ?>">
                                        <input type="hidden" name="ansone" value="<?php echo $ansone ?>">
                                        <input type="hidden" name="anstwo" value="<?php echo $anstwo ?>">
                                        <input type="hidden" name="ansthree" value="<?php echo $ansthree ?>">
                                        <input type="hidden" name="ansfour" value="<?php echo $ansfour ?>">
                                        <input type="hidden" name="correct" value="<?php echo $correct ?>">
                                        <center>
                                            <input class="button_gradient_green" type="submit" name="action" value="Previous" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input class="button_gradient_green" type="submit" name="action" value="Next" />
                                        </center>
                                    </form>
                                <?php
                                }
                                ?>
                                <br /><br />
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="js/fadealert.js"></script>
    </body>

    </html>
<?php
}

//*******************************************************
//******************  CONTINUE NEXT  ********************
//*******************************************************

function continue_next()
{
    global $PHP_SELF, $mysqli, $msg;
    global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
    global $answers_tablename, $answerid, $userid, $courseid, $examid, $answer, $score;
    global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $credits, $filename, $validcourse;
    global $enrollments_tablename, $enrollid, $euserid, $eprogid, $ecourseid, $examscore, $passed;
    global $exams_tablename, $examid, $excourseid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;

    $_SESSION['question_num'] = $_SESSION['question_num'] + 1;
    $userid = $_GET['userid'];
    $courseid = $_GET['courseid'];
    $examid = $_GET['examid'];


    main_form();
}

//*******************************************************
//******************  PREVIOUS FORM  ********************
//*******************************************************

function previous_form()
{
    global $PHP_SELF, $mysqli, $msg;
    global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
    global $answers_tablename, $answerid, $userid, $courseid, $examid, $answer, $score;
    global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $credits, $filename, $validcourse;
    global $enrollments_tablename, $enrollid, $euserid, $eprogid, $ecourseid, $examscore, $passed;
    global $exams_tablename, $examid, $excourseid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;

    $_SESSION['question_num'] = $_SESSION['question_num'] - 1;
    $question_num = $_SESSION['question_num'];
    $userid = $_GET['userid'];
    $courseid = $_GET['courseid'];
    $examid = $_GET['examid'];
    $examid = $examid - 1;

    main_form();
}

//*******************************************************
//********************  NEXT FORM  **********************
//*******************************************************

function next_form()
{
    global $PHP_SELF, $mysqli, $msg;
    global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
    global $answers_tablename, $answerid, $userid, $courseid, $examid, $answer, $score;
    global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $credits, $filename, $validcourse;
    global $enrollments_tablename, $enrollid, $euserid, $eprogid, $ecourseid, $examscore, $passed, $compdate;
    global $exams_tablename, $examid, $excourseid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;

    $courseid = $_POST['courseid'];
    $userid = $_POST['userid'];
    $examid = $_POST['examid'];
    $instruct = $_POST['instruct'];
    $question = $_POST['question'];
    $ansone = $_POST['ansone'];
    $anstwo = $_POST['anstwo'];
    $ansthree = $_POST['ansthree'];
    $ansfour = $_POST['ansfour'];
    $correct = $_POST['correct'];
    $answer = $_POST['answer'];

    $lastanswer = 2;

    if (!empty($ansthree)) {
        $lastanswer = 3;
    }

    if (!empty($ansfour)) {
        $lastanswer = 4;
    }


    if ($answer < 1 or $answer > $lastanswer) {
        $msg = "<br><br><font color='#FF0000' size='+1'>Your answer must be one of the numbers in front of the answer choices given!</font>";
        main_form();
        exit;
    }

    if ($answer == $correct) {
        $score = 1;
    } else {
        $score = 0;
    }

    $sqlb = $mysqli->query("DELETE FROM answers WHERE userid = '$userid' AND courseid = '$courseid' AND examid = '$examid'");
    //if(!$sqlb) error_message("Error in $enrollments_tablename (exams) line #276");

    $sql = $mysqli->query("INSERT INTO answers VALUES(NULL, '$userid', '$courseid', '$examid', '$answer', '$score')");
    //if(!$sql) error_message("Error fetching data from $answers_tablename (exams) line #279");

    $_SESSION['question_num'] = $_SESSION['question_num'] + 1;

    if ($_SESSION['question_num'] > $_SESSION['total_questions']) {
        $_SESSION['question_num'] = $_SESSION['total_questions'];

        $sqlq = $mysqli->query("SELECT SUM(score) AS 'TotalCorrectAnswer' FROM answers WHERE courseid = '$courseid' AND userid = '$userid'");
        //if(!$sqlq) error_message("Error in $answers_tablename (exams) line #287");
        $rowq = $sqlq->fetch_assoc();
        $total_correct = $rowq['TotalCorrectAnswer'];


        $sqlx = $mysqli->query("SELECT COUNT(*) AS 'TotalQuestions' FROM exams WHERE excourseid = '$courseid'");
        //if(!$sqlx) error_message("Error in $exams_tablename (exams) line #293");
        $rowx = $sqlx->fetch_assoc();
        $total_questions = $rowx['TotalQuestions'];

        $total_questions = $_SESSION['total_questions'];


        $examscore = ($total_correct / $total_questions) * 100;
        //$totalscore = $totalscore + $examscore;

        if ($examscore  >= 60) {
            $passed = 1;
            $compdate = date("m/d/Y");
        } else {
            $passed = 0;
            $compdate = "INCOMPLETE";
        }

        // Attempt select query execution
        $sql = "SELECT * FROM $enrollments_tablename WHERE euserid = '$userid' AND ecourseid = '$courseid'";
        if ($result = mysqli_query($mysqli, $sql)) {
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);
                mysqli_free_result($result);
            } else {
                $query = $mysqli->query("INSERT INTO $enrollments_tablename VALUES (null, '$userid', '9', '$courseid', '0', '0', '')");
            }
        } else {
            echo "ERROR: Was not able to execute Query on line #405. " . mysqli_error($mysqli);
            exit;
        }
        // End attempt select query execution

        $query = $mysqli->query("UPDATE $enrollments_tablename SET examscore = '$examscore', passed = '$passed', compdate = '$compdate' WHERE euserid = '$userid' AND ecourseid = '$courseid'");
        //if(!$query) error_message("Error fetching data from $enrollments_tablename (exams) line #308");
    } else {
        main_form();
        exit;
    }

    //header("Location: dashboard.php");
?>
    <script type="text/javascript">
        <!--
        window.top.location.href = "dashboard.php";
        //window.location = "main.php"
        -->
    </script>
<?php
}

//*******************************************************
//**********************  SWITCH  ***********************
//*******************************************************
switch ($action) {
    case "Previous":
        previous_form();
        break;
    case "Next":
        next_form();
        break;
    case "Continue":
        continue_next();
        break;
    default:
        main_form();
        break;
}

?>