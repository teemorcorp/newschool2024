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
	global $PHP_SELF, $mysqli, $msg, $notice, $notice_header, $notice_body;
    global $system_tablename, $sysid, $president , $vice, $treasurer, $secretary, $directorafrica, $deanedu, $corecourses, $followers, $facebook, $twitter, $youtube, $linkedin, $info, $updatedate, $cookietime, $sysadminver, $verdate, $releasenotes, $currentnotes, $goalamt, $curgoal;
    global $users_tablename, $userid, $useremail , $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $corecompletedate, $branchid, $role, $messages, $core_complete, $resetpwd;
    global $menuid, $goal, $current, $pct;
    global $progenroll_tablename, $progenrollid, $enrprogid , $enruserid, $enrolldate;
    global $programs_tablename, $progid, $progname, $progdesc, $isenabled, $cost, $charge, $accordian_header, $progtype;
    global $selected_progid, $selected_progname , $selected_enabled, $selected_cost, $selected_charge, $selected_accordian_header, $selected_progtype;
    global $volunteers_tablename, $vid, $vfname , $vmname, $vlname, $vemail, $vphone, $vaddress, $vcity, $vstate, $vzip;
    global $volunteerpos_tablename, $vposid, $vtitle, $vdescription, $vneeded;
    global $enrollments_tablename, $enrollid, $euserid , $eprogid, $ecourseid, $examscore, $passed, $compdate, $rating;
    global $courses_tablename, $courseid, $cprogid , $coursecode, $coursename, $coursedesc, $overview, $credits, $filename, $validcourse, $brief_desc, $course_photo, $course_cost, $course_discount, $hours, $videos, $cont_one, $cont_one_desc, $cont_two, $cont_two_desc, $cont_three, $cont_three_desc, $head_photo, $top_course;
	global $exams_tablename, $examid, $excourseid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;
	global $quizzes_tablename, $quizid, $excourseid, $qdetid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;
    global $quizdet_tablename, $qdetid, $quizname, $courseid;
    global $answerquiz_tablename, $answerid, $userid, $courseid, $quizid, $qdetid, $answer, $score;
    global $lessons_tablename, $lessonid, $courseid, $lesson_name, $lesson_number;

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

    // *******************************************************************************************
    // ********   FINANCIAL GOAL CALCULATIONS
    // *******************************************************************************************
    // Attempt select query execution
    if ($result = $mysqli->query("SELECT releasenotes, currentnotes, goalamt, curgoal FROM $system_tablename")) {
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            $releasenotes = $row['releasenotes'];
            $currentnotes = $row['currentnotes'];
            $goalamt = $row['goalamt'];
            $curgoal = $row['curgoal'];
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

    $g = $goalamt;
    $c = $curgoal;

    $gresult = str_replace('$', '', $g);
    $goal = str_replace(',', '', $gresult);
    
    $cresult = str_replace('$', '', $c);
    $current = str_replace(',', '', $cresult);

    $pct = ($current / $goal) * 100;

    // *******************************************************************************************
    // ********   VOLUNTEER CALCULATIONS
    // *******************************************************************************************
    // Attempt select query execution
    $totalpos = 0;
    if ($resultx = $mysqli->query("SELECT vneeded FROM $volunteerpos_tablename")) {
        if(mysqli_num_rows($resultx) > 0){
            while($rowx = mysqli_fetch_array($resultx)){
                $vneeded = $rowx['vneeded'];
                $totalpos += $vneeded;
            }
            // Free result set
            mysqli_free_result($resultx);
        } else{
            $msg = "<font color='#FF0000'><strong>Account not found!</strong></font>";
            main_form();
            exit;
        }
    } else{
        echo "ERROR: Was not able to execute Query on line #55. " . mysqli_error($mysqli);
    }
    // End attempt select query execution

    // Attempt select query execution
    if ($result = $mysqli->query("SELECT COUNT(*) AS 'totalv' FROM $volunteers_tablename")) {
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            $totalv = $row[0];
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

    // $vpercent = ($vneeded / $totalv) * 100;
    $vpercent = ($totalv / $totalpos) * 100;

    // *******************************************************************************************
    // ********   END VOLUNTEER CALCULATIONS
    // *******************************************************************************************

    // *******************************************************************************************
    // ********   STUDENTS CALCULATIONS
    // *******************************************************************************************
    // Attempt select query execution
    $sql = "SELECT COUNT(*) AS 'totalStudents' FROM $users_tablename";
    if($result = mysqli_query($mysqli, $sql)){
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            $totalStudents = $row['totalStudents'];
            // Free result set
            mysqli_free_result($result);
        } else{
            $msg = "<font color='#FF0000'><strong>No Records Found!</strong></font>";
            main_form();
            exit;
        }
    } else{
        echo "ERROR: Was not able to execute Query on line #145. " . mysqli_error($mysqli);
    }
    // End attempt select query execution

    // *******************************************************************************************
    // ********   COURSE ENROLLMENTS
    // *******************************************************************************************
    // Attempt select query execution
    $sql = "SELECT COUNT(*) AS 'totalEnrollments' FROM $enrollments_tablename";
    if($result = mysqli_query($mysqli, $sql)){
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            $totalEnrollments = $row['totalEnrollments'];
            // Free result set
            mysqli_free_result($result);
        } else{
            $msg = "<font color='#FF0000'><strong>No Records Found!</strong></font>";
            main_form();
            exit;
        }
    } else{
        echo "ERROR: Was not able to execute Query on line #145. " . mysqli_error($mysqli);
    }
    // End attempt select query execution

    // *******************************************************************************************
    // ********   PROGRAM ENROLLMENTS
    // *******************************************************************************************
    // Attempt select query execution
    $sql = "SELECT COUNT(*) AS 'totalProgEnroll' FROM $progenroll_tablename";
    if($result = mysqli_query($mysqli, $sql)){
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            $totalProgEnroll = $row['totalProgEnroll'];
            // Free result set
            mysqli_free_result($result);
        } else{
            $msg = "<font color='#FF0000'><strong>No Records Found!</strong></font>";
            main_form();
            exit;
        }
    } else{
        echo "ERROR: Was not able to execute Query on line #145. " . mysqli_error($mysqli);
    }
    // End attempt select query execution

    // *******************************************************************************************
    // ********   TOTAL PROGRAMS
    // *******************************************************************************************
    // Attempt select query execution
    $sql = "SELECT COUNT(*) AS 'totalPrograms' FROM $programs_tablename";
    if($result = mysqli_query($mysqli, $sql)){
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            $totalPrograms = $row['totalPrograms'];
            // Free result set
            mysqli_free_result($result);
        } else{
            $msg = "<font color='#FF0000'><strong>No Records Found!</strong></font>";
            main_form();
            exit;
        }
    } else{
        echo "ERROR: Was not able to execute Query on line #145. " . mysqli_error($mysqli);
    }
    // End attempt select query execution

    // *******************************************************************************************
    // ********   TOTAL ACTIVE PROGRAMS
    // *******************************************************************************************
    // Attempt select query execution
    $sql = "SELECT COUNT(*) AS 'totalActivePrograms' FROM $programs_tablename WHERE isenabled = '1'";
    if($result = mysqli_query($mysqli, $sql)){
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            $totalActivePrograms = $row['totalActivePrograms'];
            // Free result set
            mysqli_free_result($result);
        } else{
            $msg = "<font color='#FF0000'><strong>No Records Found!</strong></font>";
            main_form();
            exit;
        }
    } else{
        echo "ERROR: Was not able to execute Query on line #145. " . mysqli_error($mysqli);
    }
    // End attempt select query execution

    // *******************************************************************************************
    // ********   TOTAL COURSES
    // *******************************************************************************************
    // Attempt select query execution
    $sql = "SELECT COUNT(*) AS 'totalCourses' FROM $courses_tablename";
    if($result = mysqli_query($mysqli, $sql)){
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            $totalCourses = $row['totalCourses'];
            // Free result set
            mysqli_free_result($result);
        } else{
            $msg = "<font color='#FF0000'><strong>No Records Found!</strong></font>";
            main_form();
            exit;
        }
    } else{
        echo "ERROR: Was not able to execute Query on line #145. " . mysqli_error($mysqli);
    }
    // End attempt select query execution

    // *******************************************************************************************
    // ********   TOTAL ACTIVE COURSES
    // *******************************************************************************************
    // Attempt select query execution
    $sql = "SELECT COUNT(*) AS 'totalActiveCourses' FROM $courses_tablename WHERE validcourse = '1'";
    if($result = mysqli_query($mysqli, $sql)){
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            $totalActiveCourses = $row['totalActiveCourses'];
            // Free result set
            mysqli_free_result($result);
        } else{
            $msg = "<font color='#FF0000'><strong>No Records Found!</strong></font>";
            main_form();
            exit;
        }
    } else{
        echo "ERROR: Was not able to execute Query on line #145. " . mysqli_error($mysqli);
    }
    // End attempt select query execution

    // *******************************************************************************************
    // ********   TOTAL EXAMS
    // *******************************************************************************************
    // Attempt select query execution
    $sql = "SELECT COUNT(*) AS 'totalExams' FROM $exams_tablename";
    if($result = mysqli_query($mysqli, $sql)){
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            $totalExams = $row['totalExams'];
            // Free result set
            mysqli_free_result($result);
        } else{
            $msg = "<font color='#FF0000'><strong>No Records Found!</strong></font>";
            main_form();
            exit;
        }
    } else{
        echo "ERROR: Was not able to execute Query on line #145. " . mysqli_error($mysqli);
    }
    // End attempt select query execution

    // *******************************************************************************************
    // ********   TOTAL QUIZZES
    // *******************************************************************************************
    // Attempt select query execution
    $sql = "SELECT COUNT(*) AS 'totalQuizzes' FROM $quizzes_tablename";
    if($result = mysqli_query($mysqli, $sql)){
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            $totalQuizzes = $row['totalQuizzes'];
            // Free result set
            mysqli_free_result($result);
        } else{
            $msg = "<font color='#FF0000'><strong>No Records Found!</strong></font>";
            main_form();
            exit;
        }
    } else{
        echo "ERROR: Was not able to execute Query on line #145. " . mysqli_error($mysqli);
    }
    // End attempt select query execution

    ?>
    <div class="height-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2">
                    <?php
                    admmenu();
                    ?>
                </div>
                <div class="col-sm-10">
                    <?php
                    echo $_SESSION['msg'];
                    $_SESSION['msg'] = "";
                    ?>
                    <br>
                    <div id="boxed">
                        <div class="card-group">
                            <?php
                            /***********************************************************************************************
                            *******   GOAL SETTINGS
                            ***********************************************************************************************/
                            ?>
                            <div class="card card_margins text-bg-light mb-3">
                                <!-- <img src="..." class="card-img-top" alt="..."> -->
                                <form action="<?php echo $PHP_SELF ?>" method="post">
                                    <div class="card-body card-body-height">
                                        <h4 class="card-title">Financial Goal Settings</h4>
                                        <div class="mb-3 row">
                                            <label for="totalGoalAmt" class="col-sm-8 col-form-label">Goal Amount</label>
                                            <div class="col-sm-3" style="text-align: right;">
                                                <input style="width: 100px;" type="text" name="goal" class="form-control" id="totalGoalAmt" value="<?php echo $g; ?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="amtCollected" class="col-sm-8 col-form-label">Amount Collected</label>
                                            <div class="col-sm-3" style="text-align: right;">
                                                <input style="width: 100px;" type="text" name="current" class="form-control" id="amtCollected" value="<?php echo $c; ?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="pctCollected" class="col-sm-8 col-form-label">Percentage Collected</label>
                                            <div class="col-sm-3" style="text-align: right;">
                                                <input style="width: 100px; text-align: right;" type="text" name="pct" readonly class="form-control-plaintext" id="pctCollected" value="<?php echo $pct."%"; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="d-grid gap-2">
                                            <span class="d-inline-block btn-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-custom-class="custom-popover" data-bs-trigger="hover focus" data-bs-title="Help" data-bs-content="Once you have entered the correct values in the top section, click the 'Save Goals' button and the information will be saved.">
                                                <button type="submit" name="action" style="width: 100%;" class="btn btn-success btn-small btn-block" value="Save Goals">Save Goals</button>
                                            </span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <?php
                            /***********************************************************************************************
                            *******   VOLUNTEERS
                            ***********************************************************************************************/
                            ?>
                            <div class="card card_margins text-bg-light mb-3">
                                <form action="<?php echo $PHP_SELF ?>" method="post">
                                    <div class="card-body card-body-height">
                                        <h4 class="card-title">Volunteers</h4>
                                        <div class="mb-3 row">
                                            <div class="col-sm-8">
                                                Positions Available
                                            </div>
                                            <div class="col-sm-3" style="text-align: right;">
                                                <span style="width: 100px; text-align: right;"><?php echo $totalpos; ?></span>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="col-sm-8">
                                                Positions Filled
                                            </div>
                                            <div class="col-sm-3" style="text-align: right;">
                                                <span style="width: 100px; text-align: right;"><?php echo $totalv; ?></span>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="col-sm-8">
                                                Percentage Filled
                                            </div>
                                            <div class="col-sm-3" style="text-align: right;">
                                                <span style="width: 100px; text-align: right;"><?php echo $vpercent."%"; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="d-grid gap-2">
                                            <span class="d-inline-block btn-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-custom-class="custom-popover" data-bs-trigger="hover focus" data-bs-title="Help" data-bs-content="This will take you to the Volunteer Management area.">
                                                <button type="submit" name="action" style="width: 100%;" class="btn btn-success btn-small btn-block" value="Go somewhere">Manage Volunteers</button>
                                            </span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <?php
                            /***********************************************************************************************
                            *******   ENROLLMENT INFORMATION
                            ***********************************************************************************************/
                            ?>
                            <div class="card card_margins text-bg-light mb-3">
                                <form action="<?php echo $PHP_SELF ?>" method="post">
                                    <div class="card-body card-body-height">
                                        <h4 class="card-title">Enrollment Information</h4>
                                        <div class="mb-3 row">
                                            <div class="col-sm-8">
                                                Total Students<br>
                                                Course Enrollments<br>
                                                Programs Enrolled<br>
                                            </div>
                                            <div class="col-sm-3" style="text-align: right;">
                                                <span style="width: 100px; text-align: right;"><?php echo $totalStudents; ?></span><br>
                                                <span style="width: 100px; text-align: right;"><?php echo $totalEnrollments; ?></span><br>
                                                <span style="width: 100px; text-align: right;"><?php echo $totalProgEnroll; ?></span><br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="d-grid gap-2">
                                            <span class="d-inline-block btn-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-custom-class="custom-popover" data-bs-trigger="hover focus" data-bs-title="Help" data-bs-content="This will take you to the User Management area.">
                                                <button type="submit" name="action" style="width: 100%;" class="btn btn-success btn-small btn-block" value="Go somewhere">Manage Users</button>
                                            </span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <?php
                            /***********************************************************************************************
                            *******   COURSE INFORMATION
                            ***********************************************************************************************/
                            ?>
                            <div class="card card_margins text-bg-light mb-3">
                                <!-- <img src="..." class="card-img-top" alt="..."> -->
                                <form action="<?php echo $PHP_SELF ?>" method="post">
                                    <div class="card-body card-body-height">
                                        <h4 class="card-title">Programs & Courses</h4>
                                        <div class="mb-3 row">
                                            <div class="col-sm-8">
                                                Total Programs<br>
                                                Total Active Programs<br>
                                                Total Courses<br>
                                                Total Active Courses<br>
                                                Total Exam Questions<br>
                                                Total Quiz Questions<br>
                                            </div>
                                            <div class="col-sm-3" style="text-align: right;">
                                                <span style="width: 100px; text-align: right;"><?php echo $totalPrograms; ?></span><br>
                                                <span style="width: 100px; text-align: right;"><?php echo $totalActivePrograms; ?></span><br>
                                                <span style="width: 100px; text-align: right;"><?php echo $totalCourses; ?></span><br>
                                                <span style="width: 100px; text-align: right;"><?php echo $totalActiveCourses; ?></span><br>
                                                <span style="width: 100px; text-align: right;"><?php echo $totalExams; ?></span><br>
                                                <span style="width: 100px; text-align: right;"><?php echo $totalQuizzes; ?></span><br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="gap-2 text-center">
                                            <span class="d-inline-block btn-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-custom-class="custom-popover" data-bs-trigger="hover focus" data-bs-title="Help" data-bs-content="This will take you to the Program Management area.">
                                                <button type="submit" name="action" class="btn btn-success btn-small btn-block" value="manage_progs">Manage Programs</button>
                                            </span> 
                                            <span class="d-inline-block btn-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-custom-class="custom-popover" data-bs-trigger="hover focus" data-bs-title="Help" data-bs-content="This will take you to the Course Management area."><button type="submit" name="action" class="btn btn-success btn-small btn-block" value="courses">Manage Courses</button>
                                            </span> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
        
                    <!-- <br>
                    <div class="d-flex">
                        <div id="boxed">
                            <div class="card-group">

                                <div class="card card_margins text-bg-light mb-3" style="width: 100%;">
                                    <form action="<?php echo $PHP_SELF ?>" method="post">
                                        <div class="card-body release-body-height">
                                            <h4 class="card-title">Add Notes</h4>
                                            <textarea name="relnotes" id="relnotes" style="width: 100%; height: 400px;"></textarea>
                                        </div>
                                        <div class="card-footer">
                                            <div class="d-grid gap-2">
                                                <button name="action" type="submit" value="addnotes" class="btn btn-success btn-block">Add Notes</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="card card_margins text-bg-light mb-3" style="width: 100%;">
                                    <form action="<?php echo $PHP_SELF ?>" method="post">
                                        <div class="card-body release-body-height">
                                            <h4 class="card-title">View Notes</h4>
                                            <textarea name="allnotes" id="allnotes" style="width: 100%; height: 400px;"><?php echo $releasenotes; ?></textarea>
                                        </div>
                                        <div class="card-footer">
                                            <div class="d-grid gap-2">
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div> -->

                    <br>
                    <div class="card-group">

                        <div class="card">
                            <form action="<?php echo $PHP_SELF ?>" method="post">
                                <div class="card-body release-body-height">
                                    <h4 class="card-title">Add Notes</h4>
                                    <textarea name="relnotes" id="relnotes" style="width: 100%; height: 400px;"></textarea>
                                </div>
                                <div class="card-footer">
                                    <div class="d-grid gap-2">
                                        <span class="d-inline-block btn-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-custom-class="custom-popover" data-bs-trigger="hover focus" data-bs-title="Help" data-bs-content="Release notes are a compilation of notes added from here. When you add a new note it will be added to the rest of the notes.">
                                            <button name="action" type="submit" style="width: 100%;" value="addnotes" class="btn btn-success btn-block">Add Release Notes</button>
                                        </span>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="card">
                            <form action="<?php echo $PHP_SELF ?>" method="post">
                                <div class="card-body release-body-height">
                                    <h4 class="card-title">Update Current Notes</h4>
                                    <textarea name="currentnotes" id="currentnotes" style="width: 100%; height: 400px;"><?php echo $currentnotes; ?></textarea>
                                </div>
                                <div class="card-footer">
                                    <div class="d-grid gap-2">
                                        <span class="d-inline-block btn-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-custom-class="custom-popover" data-bs-trigger="hover focus" data-bs-title="Help" data-bs-content="Whatever you enter into this area will replace the current notes. You can make changes to existing notes or delete all and enter new notes.">
                                        <button name="action" type="submit" style="width: 100%;" class="btn btn-success btn-block" value="updatenotes">Update Current Notes</button>
                                        </span>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                    
                    <div id="boxed" style="margin-top: 50px;">&nbsp;</div>
                    
                </div>
            </div>
        </div>
    </div>                    

    <script>
        tinymce.init({
            selector: '#relnotes',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo| bold italic underline strikethrough | bullist numlist indent outdent  | link image media table | align lineheight| emoticons charmap | removeformat | blocks fontfamily fontsize ',
            width: '100%',
            height: 420,
            readonly: 0
        });
    </script>

    <script>
        tinymce.init({
            selector: '#currentnotes',
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
//*******************  CHECK LOGIN  *********************
//*******************************************************

function save_goals() {
    global $PHP_SELF, $mysqli, $sql, $msg, $pwd, $useremail1, $userpassword1, $useremail2, $userpassword2, $result;
    global $system_tablename, $sysid, $president , $vice, $treasurer, $secretary, $directorafrica, $deanedu, $corecourses, $followers, $facebook, $twitter, $youtube, $linkedin, $info, $updatedate, $cookietime, $sysadminver, $verdate, $releasenotes, $currentnotes, $goalamt, $curgoal;
    global $menuid, $goal, $current, $intgoal, $gfine, $gresult, $intcurrent, $cfine, $cresult;
    include "tmp/globals.php";
    dbconnect();
    if (!$mysqli) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $gresult = str_replace('$', '', $_POST['goal']);
    $gfine = str_replace(',', '', $gresult);
    $g = filter_var($gfine, FILTER_SANITIZE_STRING);

    $cresult = str_replace('$', '', $_POST['current']);
    $cfine = str_replace(',', '', $cresult);
    $c = filter_var($cfine, FILTER_SANITIZE_STRING);
    
    $goal = "$".number_format($g);
    $current = "$".number_format($c);

    if (empty($goal)) {
        $msg = "You Must Enter A Goal";
        main_form();
        exit;
    }

    if (empty($current)) {
        $msg = "You Must Enter A Current Amount";
        main_form();
        exit;
    }

    $sql = "UPDATE $system_tablename SET goalamt = '$goal', curgoal = '$current'";
    if (mysqli_query($mysqli, $sql)) {
        $msg = "<div class='alert alert-success' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>SUCCESS!</strong> Record updated successfully!
        </div>";
    } else {
        $msg = "<div class='alert alert-danger' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>ERROR!</strong> Error updating record: " . mysqli_error($mysqli) . "
        </div>";
    }

    $mysqli->close();

    echo "Line #492<br>";
    header('Location: admin.php');
}

//*******************************************************
//*******************  CHECK LOGIN  *********************
//*******************************************************

function select_program() {
    global $PHP_SELF, $mysqli, $sql, $msg, $pwd, $useremail1, $userpassword1, $useremail2, $userpassword2, $result;
    global $system_tablename, $sysid, $president , $vice, $treasurer, $secretary, $directorafrica, $deanedu, $corecourses, $followers, $facebook, $twitter, $youtube, $linkedin, $info, $updatedate, $cookietime, $sysadminver, $verdate, $releasenotes, $currentnotes, $goalamt, $curgoal;
    global $menuid, $goal, $current;
    global $selected_progid, $selected_progname , $selected_enabled, $selected_cost, $selected_charge, $selected_accordian_header, $selected_progtype;
    
    $progname = filter_var($_POST['progname'], FILTER_SANITIZE_STRING);
    $selected_progid = filter_var($_POST['selected_progid'], FILTER_SANITIZE_STRING);
    $selected_progname = filter_var($_POST['selected_progname'], FILTER_SANITIZE_STRING);
    $selected_enabled = filter_var($_POST['selected_enabled'], FILTER_SANITIZE_STRING);
    $selected_cost = filter_var($_POST['selected_cost'], FILTER_SANITIZE_STRING);
    $selected_charge = filter_var($_POST['selected_charge'], FILTER_SANITIZE_STRING);
    $selected_accordian_header = filter_var($_POST['selected_accordian_header'], FILTER_SANITIZE_STRING);
    $selected_progtype = filter_var($_POST['selected_progtype'], FILTER_SANITIZE_STRING);

    $selected_progname = $progname;

    // echo "progname: ".$progname."<br>";
    // echo "selected_progid: ".$selected_progid."<br>";
    // echo "selected_progname: ".$selected_progname."<br>";
    // echo "selected_enabled: ".$selected_enabled."<br>";
    // echo "selected_cost: ".$selected_cost."<br>";
    // echo "selected_charge: ".$selected_charge."<br>";
    // echo "selected_accordian_header: ".$selected_accordian_header."<br>";
    // echo "selected_progtype: ".$selected_progtype."<br>";
    // exit;

    // if (empty($goal)) {
    //     $msg = "You Must Enter A Goal";
    //     main_form();
    //     exit;
    // }

    // if (empty($current)) {
    //     $msg = "You Must Enter A Current Amount";
    //     main_form();
    //     exit;
    // }

    // Attempt select query execution
    // $sql = "UPDATE $system_tablename SET goalamt = '$goal', curgoal = '$current'";
    // if ($mysqli->query($sql) === TRUE) {
    //     $msg = "<div class='alert alert-success' role='alert'>
    //     <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    //     <strong>SUCCESS!</strong> Record updated successfully!
    //     </div>";
    //     //exit;
    // } else {
    //     $msg = "<div class='alert alert-danger' role='alert'>
    //     <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    //     <strong>ERROR!</strong> Error updating record: " . $mysqli->error . "
    //     </div>";
    // }
    // End attempt select query execution

    main_form();
}

//*******************************************************
//*******************  SAVE NOTES  **********************
//*******************************************************
function save_notes(){
    global $PHP_SELF, $mysqli, $msg;
    global $system_tablename, $sysid, $president , $vice, $treasurer, $secretary, $directorafrica, $deanedu, $corecourses, $followers, $facebook, $twitter, $youtube, $linkedin, $info, $updatedate, $cookietime, $sysadminver, $verdate, $releasenotes, $currentnotes, $goalamt, $curgoal;

    // $newreleasenotes = filter_var(addslashes($_POST['relnotes']), FILTER_SANITIZE_STRING);
    $newreleasenotes = addslashes($_POST['relnotes']);

    if (empty($newdelenotes) || $newdelenotes == null) {
        $msg = "<div class='alert alert-danger' role='alert'>
        <button type='button' class='close' data-bs-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>ERROR!</strong> Error updating Developer Note record: Empty release notes field.
        </div>";
        main_form();
    }

    date_default_timezone_set('America/Phoenix');
    $newdate = date("m/d/Y");

    // Attempt select query execution
    $sql = "SELECT * FROM $system_tablename";
    if ($result = mysqli_query($mysqli, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            $sysadminver = $row['sysadminver'];
            $verdate = $row['verdate'];
            $releasenotes = $row['releasenotes'];
            // Free result set
            mysqli_free_result($result);
        } else {
            $_SESSION['msg'] = "<font color='#FF0000'><strong>Account Does Not Exsist!</strong></font>";
            main_form();
            exit;
        }
    } else {
        echo "ERROR: Was not able to execute Query on line #228. " . mysqli_error($mysqli);
    }
    // End attempt select query execution

    if (empty($newreleasenotes) || $newreleasenotes == null) {
        $msg = "<div class='alert alert-danger' role='alert'>
        <button type='button' class='close' data-bs-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>ERROR!</strong> Error updating User record: Empty release notes field.
        </div>";
        main_form();
    }

    $relnotes = $newreleasenotes . "<br><br><strong>" . $newdate . "</strong><hr>" . $releasenotes;


    // Attempt select query execution
    $sql = "UPDATE $system_tablename SET releasenotes = '$relnotes'";
    if($result = mysqli_query($mysqli, $sql)){
        $msg = "<div class='alert alert-success' role='alert'>
        <button type='button' class='close' data-bs-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>SUCCESS!</strong> User Record successfully!
        </div>";
        //exit;
    } else{
        $msg = "<div class='alert alert-danger' role='alert'>
        <button type='button' class='close' data-bs-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>ERROR!</strong> Error updating User record: " . $mysqli->error . "
        </div>";
    }
    // End attempt select query execution

    // Attempt select query execution
    $sql = "UPDATE $system_tablename SET  sysadminver = '$sysadminver', verdate = '$newdate'";
    if ($mysqli->query($sql) === TRUE) {
        //header("Location:admin.php");
    } else {
        //
    }
    // End attempt select query execution

    main_form();
}

//*******************************************************
//*******************  SAVE NOTES  **********************
//*******************************************************
function current_notes(){
    global $PHP_SELF, $mysqli, $msg;
    global $system_tablename, $sysid, $president , $vice, $treasurer, $secretary, $directorafrica, $deanedu, $corecourses, $followers, $facebook, $twitter, $youtube, $linkedin, $info, $updatedate, $cookietime, $sysadminver, $verdate, $releasenotes, $currentnotes, $goalamt, $curgoal;
    include 'tmp/globals.php';
    session_start();
    dbconnect();
    if (!$mysqli) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $curnotes = addslashes($_POST['currentnotes']);

    if (empty($curnotes) || $curnotes == null) {
        $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>
        <button type='button' class='close' data-bs-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>ERROR!</strong> Error updating Current Notes: Empty Current Notes field.
        </div>";
        main_form();
    }

    date_default_timezone_set('America/Phoenix');
    $newdate = date("m/d/Y");

    if (empty($curnotes) || $curnotes == null) {
        $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>
        <button type='button' class='close' data-bs-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>ERROR!</strong> Error updating Current Notes: Empty release notes field.
        </div>";
        main_form();
    }

    $relnotes = $curnotes . "<br><br><strong>" . $newdate . "</strong>";


    // Attempt select query execution
    $sql = "UPDATE $system_tablename SET currentnotes = '$curnotes'";
    if($result = mysqli_query($mysqli, $sql)){
        $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>
        <button type='button' class='close' data-bs-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>SUCCESS!</strong> Current Notes Updated successfully!
        </div>";
        //exit;
    } else{
        $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>
        <button type='button' class='close' data-bs-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>ERROR!</strong> Error updating Current Notes: " . $mysqli->error . "
        </div>";
    }
    // End attempt select query execution

    header('Location: admin.php');
}

//*******************************************************
//**********************  SWITCH  ***********************
//*******************************************************
switch($action) {
    case "Select Program":
        select_program();
    break;
    case "Save Goals":
        save_goals();
    break;
    case "courses":
        header('Location: courses.php');
    break;
    case "updatenotes":
        current_notes();
        break;
    case "addnotes":
        save_notes();
        break;
    case "manage_progs":
        header('Location: programs.php');
    break;
    case "Register":
        header('Location: register.php');
    break;
    default:
        main_form();
    break;
}

?>