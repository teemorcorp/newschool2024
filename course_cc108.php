<?php
/****************************************************
****   IHN Bible College
****   Designed by: Tom Moore
****   Written by: Tom Moore
****   (c) 2001 - 2021 TEEMOR eBusiness Solutions
****************************************************/
include 'includes/globals.php';
include 'templates/functions.php';
session_start();
db_connect();

if($mysqli->connect_error) {
	echo 'Failed to connect to server: (' . $mysqli->connect_error . ') ' . $mysqli->connect_error;
}

global $PHP_SELF, $mysqli, $msg, $nextpage, $prevpage, $perpage;
global $users_tablename, $userid, $useremail , $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $corecompletedate;
global $system_tablename;
global $progenroll_tablename, $progenrollid, $enrprogid, $enruserid;
global $enrollments_tablename, $enrollid, $euserid, $eprogid, $ecourseid, $examscore, $passed;
global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $coursedesc, $credits, $filename, $validcourse;
global $courselessons_tablename, $lessonid, $courseid, $lessonnumber, $lessonname, $lessondetail, $videourl, $fileurl, $qdetid, $isvalid;
global $quizzes_tablename, $quizid, $excourseid, $qdetid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;
global $quizdet_tablename, $qdetid, $quizname, $courseid;
global $answerquiz_tablename, $answerid, $userid, $courseid, $quizid, $qdetid, $answer, $score;

$main_background_color = "#3f3a7a";
$sub_background_color = "#534ba5";
$child_background_color = "#4872ff";

$userid = $_SESSION['userid'];
$courseid = "16";

// Attempt select query execution
$sql = "SELECT * FROM $users_tablename WHERE userid = '$userid'";
if($result = mysqli_query($mysqli, $sql)){
    if(mysqli_num_rows($result) > 0){
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
        if(empty($usermname)){
            $fullname = $userfname." ".$userlname;
        }else{
            $fullname = $userfname." ".$usermname." ".$userlname;
        }
        // Free result set
        mysqli_free_result($result);
    } else{
        $msg = "<font color='#FF0000'><strong>Account Does Not Exsist!</strong></font>";
        ?>
        <script type="text/javascript">
            <!--
            window.location = "../index.php"
            -->
        </script>
        <?php
    }
} else{
    echo "ERROR: Was not able to execute Query on line #152. " . mysqli_error($mysqli);
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

$gpa = (4.0 + 3.5) / 2;

include 'templates/include.tpl';
include "templates/style.tpl";
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
                <?php echo $msg; ?>
                <div><font size="+4"><strong><?php echo $coursecode; ?> - <?php echo $coursename; ?></strong></font></div>
                <p><?php echo $coursedesc; ?></p>
                <!--br>
                <a href="https://ihnbible.org/courses/CC101-CreativeBibleStudy.pdf" target="_blank">Download Study Materials</a-->
                <br><br>
                <?php
                //$lessnum = 1;
                ?>
                <div id="accordion">
                    <?php
                    // Attempt select query execution
                    $sql = "SELECT * FROM courselessons WHERE courseid = '$courseid' ORDER BY lessonnumber ASC";
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
                                <div class="card">
                                    <div class="card-header" id="lesson<?php echo $lessonnumber; ?>">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#less<?php echo $lessonnumber; ?>" aria-expanded="false" aria-controls="less<?php echo $lessonnumber; ?>">
                                            Lesson <?php echo $lessonnumber; ?> - <?php echo $lessonname; ?>
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="less<?php echo $lessonnumber; ?>" class="collapse" aria-labelledby="lesson<?php echo $lessonnumber; ?>" data-parent="#accordion">
                                        <div class="card-body">
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
                                            <?php echo $lessondetail; ?>
                                            
                                            <?php
                                            if(!empty($fileurl)){
                                                ?>
                                                <br><br>
                                                <a href="<?php echo $fileurl; ?>" target="_blank">Download Study Materials</a>
                                                <?php
                                            }

                                            $sqlx = $mysqli->query("SELECT COUNT(*) AS 'TotalQuestions' FROM quizzes WHERE excourseid = '$courseid' AND qdetid = '$qdetid'");
                                            //if(!$sqlx) error_message("Error in $quizzes_tablename (exams) line #293");
                                            $rowx = $sqlx->fetch_assoc();	
                                            $total_questions = $rowx['TotalQuestions'];
                                            
                                            $sqly = $mysqli->query("SELECT COUNT(*) AS 'TotalAnswers' FROM answerquiz WHERE userid = '$userid' AND qdetid = '$qdetid'");
                                            //if(!$sqlx) error_message("Error in $quizzes_tablename (exams) line #293");
                                            $rowy = $sqly->fetch_assoc();	
                                            $total_answers = $rowy['TotalAnswers'];

                                            $newscore = (100 / $total_questions) * $total_answers;

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
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                            <div class="card">
                                <div class="card-header" id="lessonFinalExam">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#lessFinalExam" aria-expanded="false" aria-controls="lessFinalExam">
                                        Final Exam
                                        </button>
                                    </h5>
                                </div>
                                <div id="lessFinalExam" class="collapse" aria-labelledby="lessonFinalExam" data-parent="#accordion">
                                    <div class="card-body">
                                        <a href="exam.php?id=<?php echo $courseid; ?>">Take Final Exam</a>
                                    </div>
                                </div>
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
                <br><br>

                    <!-- *******************************************************************************************
                    **********  BOTTOM SPACING
                    *********************************************************************************************-->
                    <section style="padding-top:20px;">
                        <div class="row clearfix" style="padding-top:10px;">
                            <div class="col-sm-12">
                                &nbsp;
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
</div>
</body>
</html>