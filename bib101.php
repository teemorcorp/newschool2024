<?php
/****************************************************
****   IHN Bible College
****   Designed by: Tom Moore
****   Written by: Tom Moore
****   (c) 2001 - 2021 TEEMOR eBusiness Solutions
****************************************************/
include "tmp/header.php";

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
	global $PHP_SELF, $mysqli, $msg, $notice, $fullname;
    global $system_tablename, $sysid, $president , $vice, $treasurer, $secretary, $directorafrica, $deanedu, $corecourses, $followers, $facebook, $twitter, $youtube, $linkedin, $info, $updatedate, $cookietime, $sysadminver, $verdate, $releasenotes, $currentnotes, $goalamt, $curgoal;
    global $users_tablename, $userid, $useremail , $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $corecompletedate, $branchid, $role, $messages, $core_complete, $resetpwd;
    global $progenroll_tablename, $progenrollid, $enrprogid, $enruserid;
    global $enrollments_tablename, $enrollid, $euserid, $eprogid, $ecourseid, $examscore, $passed;
    global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $coursedesc, $credits, $filename, $validcourse;
    global $courselessons_tablename, $lessonid, $courseid, $lessonnumber, $lessonname, $lessondetail, $videourl, $fileurl, $qdetid, $isvalid;
    global $quizzes_tablename, $quizid, $excourseid, $qdetid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;
    global $quizdet_tablename, $qdetid, $quizname, $courseid;
    global $answers_tablename, $answerid, $userid, $courseid, $examid, $answer, $score, $gpa;
    global $answerquiz_tablename, $answerid, $userid, $courseid, $quizid, $qdetid, $answer, $score;

    information_modal();

    $userid = $_SESSION['userid'];
    $courseid = "1";

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
            if (empty($usermname)) {
                $fullname = $userfname . " " . $userlname;
            } else {
                $fullname = $userfname . " " . $usermname . " " . $userlname;
            }
            // Free result set
            mysqli_free_result($result);
        } else {
            $msg = "<font color='#FF0000'><strong>Account Does Not Exsist!</strong></font>";
            header('Location: ../index.php');
        }
    } else {
        echo "ERROR: Was not able to execute Query on line #71. " . mysqli_error($mysqli);
    }
    // End attempt select query execution

    // Attempt select query execution
    $sql = "SELECT * FROM $courses_tablename WHERE courseid = '$courseid'";
    if($result = mysqli_query($mysqli, $sql)){
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            $courseid = $row['courseid'];
            $cprogid = $row['cprogid'];
            $coursecode = $row['coursecode'];
            $coursename = $row['coursename'];
            $coursedesc = $row['coursedesc'];
            $credits = $row['credits'];
            $filename = $row['filename'];
            $validcourse = $row['validcourse'];
            // Free result set
            mysqli_free_result($result);
        } else{
            $msg = "<font color='#FF0000'><strong>Account Does Not Exsist!</strong></font>";
        }
    } else{
        echo "ERROR: Was not able to execute Query on line #152. " . mysqli_error($mysqli);
    }
    // End attempt select query execution
    ?>
<div class="height-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2"><?php menu(); ?></div>
            <div class="col-sm-10">
                <?php
                WelcomeToDashboard();
                ?>
                <!-- <h4>Dashboard</h4> -->
                <br>

                <div id="boxed" style="padding: 20px;">
                    <div><span style="font-size: 40px; font-weight: bold;"><strong><?php echo $coursecode; ?> - <?php echo $coursename; ?></strong></font></div>
                    <p><?php echo $coursedesc; ?></p>
                </div>

                <div id="boxed">
                    <p class="text-center"><span style="font-size: 32px; font-weight: bold;">Lessons</span></p>

                    <div class="row">
                        <div class="col-sm-12" id="asc">
                            <div id="accordion" class="justify-content-center">
                                <?php
                                // Attempt select query execution
                                $sql = "SELECT * FROM $courselessons_tablename WHERE courseid = '$courseid' ORDER BY lessonnumber ASC";
                                if($result = mysqli_query($mysqli, $sql)){
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_array($result)){
                                            $lessonid = $row['lessonid'];
                                            $lessonnumber = $row['lessonnumber'];
                                            $lessonname = $row['lessonname'];
                                            $lessondetail = $row['lessondetail'];
                                            $videourl = $row['videourl'];
                                            $fileurl = $row['fileurl'];
                                            $qdetid = $row['qdetid'];
                                            $isvalid = $row['isvalid'];
                                            ?>
                                            <h3>Lesson <?php echo $lessonnumber; ?> - <?php echo $lessonname; ?></h3>
                                            <div>
                                                <font size="+1"><strong><?php echo $lessonname; ?></strong></font>
                                                <?php
                                                if(!empty($videourl)){
                                                    ?>
                                                    <br><br>
                                                    <iframe width="450" height="271" src="<?php echo $videourl; ?>" title="IHN Bible College" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                    <?php
                                                }
                                                ?>
                                                <br><br>
                                                <?php
                                                echo $lessondetail;
                                                
                                                if(!empty($fileurl)){
                                                    ?>
                                                    <br><br>
                                                    <a href="<?php echo $fileurl; ?>" target="_blank">Download Study Materials</a>
                                                    <?php
                                                }

                                                // Attempt select query execution
                                                $sqlx = "SELECT COUNT(*) AS 'TotalQuestions' FROM $quizzes_tablename WHERE excourseid = '$courseid' AND qdetid = '$qdetid'";
                                                if ($resultx = mysqli_query($mysqli, $sqlx)) {
                                                    if (mysqli_num_rows($resultx) > 0) {
                                                        $rowx = mysqli_fetch_array($resultx);
                                                        $total_questions = $rowx['TotalQuestions'];
                                                        // Free result set
                                                        mysqli_free_result($resultx);
                                                    } else {
                                                        $msg = "<font color='#FF0000'><strong>Account Does Not Exsist!</strong></font>";
                                                        header('Location: ../index.php');
                                                    }
                                                } else {
                                                    echo "ERROR: Was not able to execute Query on line #71. " . mysqli_error($mysqli);
                                                }
                                                // End attempt select query execution

                                                // Attempt select query execution
                                                $sqly = "SELECT COUNT(*) AS 'TotalAnswers' FROM $answerquiz_tablename WHERE userid = '$userid' AND qdetid = '$qdetid'";
                                                if ($resulty = mysqli_query($mysqli, $sqly)) {
                                                    if (mysqli_num_rows($resulty) > 0) {
                                                        $rowy = mysqli_fetch_array($resulty);
                                                        $total_answers = $rowy['TotalAnswers'];
                                                        // Free result set
                                                        mysqli_free_result($resulty);
                                                    } else {
                                                        $msg = "<font color='#FF0000'><strong>Account Does Not Exsist!</strong></font>";
                                                        header('Location: ../index.php');
                                                    }
                                                } else {
                                                    echo "ERROR: Was not able to execute Query on line #71. " . mysqli_error($mysqli);
                                                }
                                                // End attempt select query execution
                                                
                                                if($total_questions == 0 && $total_answers == 0){
                                                    //
                                                }else{
                                                    $newscore = (100 / $total_questions) * $total_answers;
                                                }

                                                if(!empty($qdetid)){
                                                    echo "<br><br>Total Score: ".round($newscore);
                                                    ?>
                                                    <br><br>
                                                    <a href="quiz.php?qid=<?php echo $qdetid; ?>&cid=<?php echo $courseid; ?>">Take Quiz</a>
                                                    <?php
                                                }
                                                ?>
                                                <br><br>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <h3>Final Exam</h3>
                                        <div>
                                            <a href="exam.php?id=<?php echo $courseid; ?>">Take Final Exam</a>
                                        </div>
                                        <?php
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
                                    echo "ERROR: Was not able to execute Query on line #101. " . mysqli_error($mysqli);
                                }
                                // End attempt select query execution
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="margin-bottom: 50px;">&nbsp;</div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="margin-top: 80px;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Latest News</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo $news; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php
include "tmp/footer.php";
}

//*******************************************************
//**********************  SWITCH  ***********************
//*******************************************************
switch($action) {
    // case "completed":
    //     goto_course();
    // break;
	default:
		main_form();
	break;
}
?>