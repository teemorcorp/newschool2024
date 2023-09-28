<?php
/****************************************************
****   IHN Bible College
****   Designed by: Tom Moore
****   Written by: Tom Moore
****   (c) 2001 - 2021 TEEMOR eBusiness Solutions
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
    global $programs_tablename, $progid, $progname , $enabled, $cost, $charge, $accordian_header, $progtype;
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

    if(!empty($_SESSION['userid'] && $_SESSION['isadmin'])){
        $userid = $_SESSION['userid'];
    }else{
        header('Location: ../index.php');
    }

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
    $sql = "SELECT COUNT(*) AS 'totalActivePrograms' FROM $programs_tablename WHERE enabled = '1'";
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
                    // menu();
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
                                            <label for="totalGoalAmt" class="col-sm-9 col-form-label">Goal Amount</label>
                                            <div class="col-sm-3" style="text-align: right;">
                                                <input type="text" name="goal" class="form-control" id="totalGoalAmt" value="<?php echo $g; ?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="amtCollected" class="col-sm-9 col-form-label">Amount Collected</label>
                                            <div class="col-sm-3" style="text-align: right;">
                                                <input type="text" name="current" class="form-control" id="amtCollected" value="<?php echo $c; ?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="pctCollected" class="col-sm-9 col-form-label">Percentage Collected</label>
                                            <div class="col-sm-3" style="text-align: right;">
                                                <input type="text" name="pct" readonly class="form-control-plaintext" id="pctCollected" value="<?php echo $pct."%"; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="d-grid gap-2">
                                            <button type="submit" name="action" class="btn btn-success btn-small btn-block" value="Save Goals">Save Goals</button>
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
                                            <div class="col-sm-9">
                                                Positions Available
                                            </div>
                                            <div class="col-sm-3" style="text-align: right;">
                                                <?php echo $totalpos; ?>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="col-sm-9">
                                                Positions Filled
                                            </div>
                                            <div class="col-sm-3" style="text-align: right;">
                                                <?php echo $totalv; ?>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="col-sm-9">
                                                Percentage Filled
                                            </div>
                                            <div class="col-sm-3" style="text-align: right;">
                                                <?php echo $vpercent."%"; ?>
                                            </div>
                                            <!-- <div class="col-sm-6">
                                                <input type="text" name="pct" readonly class="form-control-plaintext" id="pctCollected" value="<?php echo $vpercent."%"; ?>">
                                            </div> -->
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="d-grid gap-2">
                                            <button type="submit" name="action" class="btn btn-success btn-small btn-block" value="Go somewhere">Manage Volunteers</button>
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
                                            <div class="col-sm-9">
                                                Total Students<br>
                                                Course Enrollments<br>
                                                Programs Enrolled<br>
                                            </div>
                                            <div class="col-sm-3" style="text-align: right;">
                                                <?php echo $totalStudents; ?><br>
                                                <?php echo $totalEnrollments; ?><br>
                                                <?php echo $totalProgEnroll; ?><br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="d-grid gap-2">
                                            <button type="submit" name="action" class="btn btn-success btn-small btn-block" value="Go somewhere">Manage Users</button>
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
                                            <div class="col-sm-9">
                                                Total Programs<br>
                                                Total Active Programs<br>
                                                Total Courses<br>
                                                Total Active Courses<br>
                                                Total Exam Questions<br>
                                                Total Quiz Questions<br>
                                            </div>
                                            <div class="col-sm-3" style="text-align: right;">
                                                <?php echo $totalPrograms; ?><br>
                                                <?php echo $totalActivePrograms; ?><br>
                                                <?php echo $totalCourses; ?><br>
                                                <?php echo $totalActiveCourses; ?><br>
                                                <?php echo $totalExams; ?><br>
                                                <?php echo $totalQuizzes; ?><br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="gap-2 text-center">
                                            <button type="submit" name="action" class="btn btn-success btn-small btn-block" value="manage_progs">Manage Programs</button> <button type="submit" name="action" class="btn btn-success btn-small btn-block" value="Go somewhere">Manage Courses</button>
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
                                        <button name="action" type="submit" value="addnotes" class="btn btn-success btn-block">Add Release Notes</button>
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
                                        <button name="action" type="submit" class="btn btn-success btn-block" value="updatenotes">Update Current Notes</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>

                    <div class="card">
                        <div class="card-header">
                            Programs
                        </div>
                        <div class="card-body">
                            <form action="<?php echo $PHP_SELF ?>" method="post">
                                <div class="row">
                                    <div class="col-3">
                                        <select name="progname" id="">
                                            <option value="">SELECT PROGRAM</option>
                                            <?php
                                            global $progenroll_tablename, $progenrollid, $enrprogid , $enruserid, $enrolldate;
                                            global $programs_tablename, $progid, $progname , $enabled, $cost, $charge, $accordian_header, $progtype;
                                            // Attempt select query execution
                                            if ($result = $mysqli->query("SELECT * FROM $programs_tablename ORDER BY progname ASC")) {
                                                if(mysqli_num_rows($result) > 0){
                                                    while($row = mysqli_fetch_array($result)){
                                                        $progid = $row['progid'];
                                                        $progname = $row['progname'];
                                                        $enabled = $row['enabled'];
                                                        $cost = $row['cost'];
                                                        $charge = $row['charge'];
                                                        $accordian_header = $row['accordian_header'];
                                                        $progtype = $row['progtype'];
                                                        ?>
                                                        <div class="card-group">
                                                            <option value="<?php echo $progname; ?>"><?php echo $progname; ?></option>
                                                        </div>
                                                        <?php
                                                    }
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
                                            global $programs_tablename, $progid, $progname , $enabled, $cost, $charge, $accordian_header, $progtype;
                                            global $selected_progid, $selected_progname , $selected_enabled, $selected_cost, $selected_charge, $selected_accordian_header, $selected_progtype;
                                            ?>
                                        </select>
                                        <div class="d-grid gap-2" style="margin-top: 10px;">
                                            <!-- <input type="hidden" name="progname" value="<?php echo $progname; ?>"> -->
                                            <button type="submit" name="action" class="btn btn-primary btn-small btn-block" value="Select Program">Select Program</button>
                                        </div>
                                        <div class="d-grid gap-2" style="margin-top: 10px;">
                                            <button type="submit" name="action" class="btn btn-info btn-small btn-block" value="Add Program">Add Program</button>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="mb-3 row">
                                            <label for="staticPID" class="col-sm-5 col-form-label">Program ID:</label>
                                            <div class="col-sm-7">
                                                <input type="text" readonly class="form-control-plaintext" name="selected_progid" value="<?php echo $selected_progid; ?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="inputPassword" class="col-sm-5 col-form-label">Program Name:</label>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control" name="selected_progname" value="<?php echo $selected_progname; ?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="staticEmail" class="col-sm-5 col-form-label">Enabled:</label>
                                            <div class="col-sm-7">
                                                <input type="text"  class="form-control" name="selected_enabled" value="<?php echo $selected_enabled; ?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="inputPassword" class="col-sm-5 col-form-label">Cost:</label>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control" id="inputPassword" name="selected_cost" value="<?php echo $selected_cost; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="mb-3 row">
                                            <label for="inputPassword" class="col-sm-5 col-form-label">Charge:</label>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control" id="inputPassword" name="selected_charge" value="<?php echo $selected_charge; ?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="staticEmail" class="col-sm-5 col-form-label">Accordian Header:</label>
                                            <div class="col-sm-7">
                                                <input type="text"  class="form-control" name="selected_accordian_header" value="<?php echo $selected_accordian_header; ?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="inputPassword" class="col-sm-5 col-form-label">Program Type:</label>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control" id="inputPassword" name="selected_progtype" value="<?php echo $selected_progtype; ?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 d-grid gap-2">
                                            <!-- <form action="<?php echo $PHP_SELF ?>" method="post"> -->
                                                <button type="submit" name="action" class="btn btn-success btn-small btn-block" value="Add Program">Submit Program</button>
                                            <!-- </form> -->
                                        </div>
                                    </div>
                                    <div class="col-3"></div>
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