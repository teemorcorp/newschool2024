<?php

/*************************************************************************
 **  RELEASE NOTES MODAL
 *************************************************************************/
function information_modal(){
    global $PHP_SELF, $mysqli, $hdmysqli, $bkcolor, $perpage, $page, $msg;
    global $system_tablename, $sysid, $president , $vice, $treasurer, $secretary, $directorafrica, $deanedu, $corecourses, $followers, $facebook, $twitter, $youtube, $linkedin, $info, $updatedate, $cookietime, $sysadminver, $verdate, $releasenotes, $currentnotes, $goalamt, $curgoal;

    // Attempt select query execution
    $sql = "SELECT * FROM $system_tablename";
    if ($result = mysqli_query($mysqli, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            $sysadminver = $row['sysadminver'];
            $verdate = $row['verdate'];
            $releasenotes = $row['releasenotes'];
            $currentnotes = $row['currentnotes'];
            // Free result set
            mysqli_free_result($result);
        } else {
            $msg = "<font color='#FF0000'><strong>Account Does Not Exsist!</strong></font>";
            main_form();
            exit;
        }
    } else {
        echo "ERROR: Was not able to execute Query in functions line #3. " . mysqli_error($mysqli);
    }
    // End attempt select query execution

    ?>
    <!-- <div class="modal fade" id="information_modal" tabindex="-1" role="dialog" aria-labelledby="informationLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="width: 750px; margin-left: -120px; height: 750px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="informationLabel">Release Notes</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <textarea class="form-control" id="mytextarea">
                        < ?php echo $releasenotes; ?>
                    </textarea>
                </div>
                <div class="modal-footer">
                    <form action="< ?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div> -->

    <script src="https://cdn.tiny.cloud/1/qa5ollct4qx4a9lkzbhdh1ki6763pwyi6jx3m0s5ut86u8by/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#mytextarea',
            toolbar: '',
            menubar: '',
            width: 720,
            height: 570,
            readonly: 1
        });
    </script>
<?php
}

/**********************************************************************************
*****   MENU
**********************************************************************************/
function menu(){
    ?>
    <style>
    main {
      margin-bottom: 200%;
    }
    .floating-menu {
      font-family: sans-serif;
      /* background: yellowgreen; */
      padding-top: 20px;
      /* padding: 5px; */
      width: 15%;
      z-index: 100;
      position: fixed;
    }
    .floating-menu a, 
    .floating-menu h3 {
      font-size: 0.9em;
      display: block;
      margin: 0 0.5em;
      color: #000;
    }
  </style>
  <nav class="floating-menu">
    <ul id="menu">
        <?php
        if($_SESSION['isadmin']){
            ?>
            <li class="list-group-item"><a class="nav-link" href="adm/admin.php"><i class='bx bx-cog nav_icon'></i>&nbsp;&nbsp;Administration</a></li>
            <?php
        }
        ?>
        <li class="list-group-item"><a class="nav-link" href="../index.php"><i class='bx bx-grid-alt nav_icon'></i>&nbsp;&nbsp;Dashboard</a></li>
        <li class="list-group-item"><a class="nav-link" href="../about.php"><i class='bx bx-universal-access nav_icon'></i>&nbsp;&nbsp;About</a></li>
        <li class="list-group-item"><a class="nav-link" href="../calendar.php"><i class='bx bx-calendar nav_icon' title="Calendar"></i>&nbsp;&nbsp;Calendar</a></li>
        <li class="list-group-item"><a class="nav-link" href="../courses.php"><i class='bx bx-book-reader nav_icon' title="Courses"></i>&nbsp;&nbsp;Courses</a></li>
        <li class="list-group-item"><a class="nav-link" href="../admissions.php"><i class='bx bxs-school nav_icon' title="Admissions"></i>&nbsp;&nbsp;Admissions</a></li>
        
        <?php
        if(!empty($_SESSION['userid'])){
            ?>
            <li class="list-group-item"><a class="nav-link" href="../logout.php"><i class="bx bx-log-out nav_icon" title="Logout"></i>&nbsp;&nbsp;Logout</a></li>
            <?php
        }else{
            ?>
            <li class="list-group-item"><a class="nav-link" href="../login.php"><i class='bx bx-log-in nav_icon' title="Student Login"></i>&nbsp;&nbsp;Student Login</a></li>
            <?php
        }
        ?>
    </ul>
  </nav>
    <?php
}

/**********************************************************************************
*****   ADMIN MENU
**********************************************************************************/
function admmenu(){
    ?>
    <style>
    main {
      margin-bottom: 200%;
    }
    .floating-admmenu {
      font-family: sans-serif;
      /* background: yellowgreen; */
      padding-top: 20px;
      /* padding: 5px; */
      width: 15%;
      z-index: 100;
      position: fixed;
    }
    .floating-admmenu a, 
    .floating-admmenu h3 {
      font-size: 0.9em;
      display: block;
      margin: 0 0.5em;
      color: #000;
    }
  </style>
  <nav class="floating-admmenu">
    <ul id="menu">
        <?php
        if($_SESSION['isadmin']){
            ?>
            <li class="list-group-item"><a class="nav-link" href="admin.php"><i class='bx bx-cog nav_icon'></i>&nbsp;&nbsp;Admin Dashboard</a></li>
            <?php
        }
        ?>
        <li class="list-group-item"><a class="nav-link" href="programs.php"><i class='bx bx-cog nav_icon'></i><span style="margin-left: 10px;">Program Management</span></a></li>
        <li class="list-group-item"><a class="nav-link" href="courses.php"><i class='bx bx-cog nav_icon'></i><span style="margin-left: 10px;">Course Management</span></a></li>
        <li class="list-group-item"><a class="nav-link" href="exams.php"><i class='bx bx-cog nav_icon'></i><span style="margin-left: 10px;">Exam Management</span></a></li>
        <li class="list-group-item"><a class="nav-link" href="quizzes.php"><i class='bx bx-cog nav_icon'></i><span style="margin-left: 10px;">Quiz Management</span></a></li>
        <li class="list-group-item"><a class="nav-link" href="#"><i class='bx bx-cog nav_icon'></i> <img src="../img/undercon.gif" alt="IHN Bible College" style="width: 20px;"><span style="margin-left: 10px;">Staff</span></a></li>
        <li class="list-group-item"><a class="nav-link" href="students.php"><i class='bx bx-cog nav_icon'></i> <img src="../img/undercon.gif" alt="IHN Bible College" style="width: 20px;"><span style="margin-left: 10px;">Student Management</span></a></li>
        <li class="list-group-item"><a class="nav-link" href="#"><i class='bx bx-cog nav_icon'></i> <img src="../img/undercon.gif" alt="IHN Bible College" style="width: 20px;"><span style="margin-left: 10px;">Home Room Messages</span></a></li>
        <li class="list-group-item"><a class="nav-link" href="#"><i class='bx bx-cog nav_icon'></i> <img src="../img/undercon.gif" alt="IHN Bible College" style="width: 20px;"><span style="margin-left: 10px;">Information</span></a></li>
        <li class="list-group-item"><a class="nav-link" href="#"><i class='bx bx-cog nav_icon'></i> <img src="../img/undercon.gif" alt="IHN Bible College" style="width: 20px;"><span style="margin-left: 10px;">Mass Message Students</span></a></li>
        <li class="list-group-item"><a class="nav-link" href="#"><i class='bx bx-cog nav_icon'></i> <img src="../img/undercon.gif" alt="IHN Bible College" style="width: 20px;"><span style="margin-left: 10px;">School Newsletter</span></a></li>
        <li class="list-group-item"><a class="nav-link" href="notes.php"><i class='bx bx-cog nav_icon'></i><span style="margin-left: 10px;">Notes</span></a></li>
        <!-- <li class="list-group-item"><a class="nav-link" href="#"><i class='bx bx-cog nav_icon'></i><span style="margin-left: 10px;">Dashboard</span></a></li>
        <li class="list-group-item"><a class="nav-link" href="#"><i class='bx bx-cog nav_icon'></i><span style="margin-left: 10px;">Dashboard</span></a></li>
        <li class="list-group-item"><a class="nav-link" href="#"><i class='bx bx-cog nav_icon'></i><span style="margin-left: 10px;">Dashboard</span></a></li>
        <li class="list-group-item"><a class="nav-link" href="#"><i class='bx bx-cog nav_icon'></i><span style="margin-left: 10px;">Dashboard</span></a></li> -->
        <hr style="color: #000;">
        <li class="list-group-item"><a class="nav-link" href="../index.php"><i class='bx bx-grid-alt nav_icon'></i><span style="margin-left: 10px;">Dashboard</span></a></li>
        <li class="list-group-item"><a class="nav-link" href="../about.php"><i class='bx bx-universal-access nav_icon'></i><span style="margin-left: 10px;">About</span></a></li>
        <li class="list-group-item"><a class="nav-link" href="../calendar.php"><i class='bx bx-calendar nav_icon' title="Calendar"></i><span style="margin-left: 10px;">Calendar</span></a></li>
        <li class="list-group-item"><a class="nav-link" href="../courses.php"><i class='bx bx-book-reader nav_icon' title="Courses"></i><span style="margin-left: 10px;">Courses</span></a></li>
        <li class="list-group-item"><a class="nav-link" href="../admissions.php"><i class='bx bxs-school nav_icon' title="Admissions"></i><span style="margin-left: 10px;">Admissions</span></a></li>
        
        <?php
        if(!empty($_SESSION['userid'])){
            ?>
            <li class="list-group-item"><a class="nav-link" href="../logout.php"><i class="bx bx-log-out nav_icon" title="Logout"></i><span style="margin-left: 10px;">Logout</span></a></li>
            <?php
        }else{
            ?>
            <li class="list-group-item"><a class="nav-link" href="../login.php"><i class='bx bx-log-in nav_icon' title="Student Login"></i><span style="margin-left: 10px;">Student Login</span></a></li>
            <?php
        }
        ?>
    </ul>
  </nav>
    <?php
}

function PersonalStats(){
	global $PHP_SELF, $mysqli, $msg, $notice, $fullname;
    global $answers_tablename, $answerid, $userid, $courseid, $examid, $answer, $score, $gpa;
    global $system_tablename, $sysid, $president , $vice, $treasurer, $secretary, $directorafrica, $deanedu, $corecourses, $followers, $facebook, $twitter, $youtube, $linkedin, $info, $updatedate, $cookietime, $sysadminver, $verdate, $releasenotes, $currentnotes, $goalamt, $curgoal;
    global $users_tablename, $userid, $useremail , $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $corecompletedate, $branchid, $role, $messages, $core_complete, $resetpwd;
    global $menuid, $goal, $current, $pct, $userid;
    global $prayers_tablename, $prayerid, $prayee, $prayer_request, $answered;
    global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $credits, $filename, $validcourse;
    global $progenroll_tablename, $progenrollid, $enrprogid, $enruserid, $enrolldate;
    ?>
    <!-- *******************************************************************************************
    **********  STUDENT STATISTICS
    *********************************************************************************************-->
    <?php
    if(!empty($userid)){
    ?>
    <div id="boxed" style="margin-bottom: 50px;">
        <div class="row clearfix">
            <div class="col-sm-4" style="padding-left: 20px;">
                <?php
                // Attempt select query execution
                $sql = "SELECT * FROM $courses_tablename WHERE cprogid = '1' AND validcourse = 'Yes'";
                if ($result = mysqli_query($mysqli, $sql)) {
                    $totalGPA = 0;
                    $totalCredit = 0;
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_array($result)) {
                            $courseid = $row['courseid'];
                            $coursename = $row['coursename'];
                            $credits = $row['credits'];

                            // Query the Total Number of Questions
                            $sqla = $mysqli->query("SELECT COUNT(*) AS 'TotalQuestions' FROM $answers_tablename WHERE courseid = '$courseid' AND userid = '$userid'");
                            $rowa = $sqla->fetch_assoc();
                            $total_Questions = $rowa['TotalQuestions'];
                            //echo "courseid: ". $courseid." TotalQuestions: ". $total_Questions."<br>";

                            // Query the Total Number of Correct answers
                            $sqlb = $mysqli->query("SELECT COUNT(score) AS 'TotalScore' FROM $answers_tablename WHERE courseid = '$courseid' AND userid = '$userid' AND score = 1");
                            $rowb = $sqlb->fetch_assoc();
                            $total_correct = $rowb['TotalScore'];

                            // Query the Total Number of Courses
                            $sqlb = $mysqli->query("SELECT COUNT(*) AS 'TotalCourses' FROM $courses_tablename WHERE cprogid = '1'");
                            $rowb = $sqlb->fetch_assoc();
                            $total_courses = $rowb['TotalCourses'];

                            // Query the Completion date
                            $sqlc = $mysqli->query("SELECT enrolldate FROM $progenroll_tablename WHERE enrprogid = '1' AND enruserid = '$userid'");
                            $rowc = $sqlc->fetch_assoc();
                            $enrolldate = $rowc['enrolldate'];

                            if (substr($enrolldate, 0, -8) == 01) {
                                $month = "January";
                            } elseif (substr($enrolldate, 0, -7) == 2) {
                                $month = "February";
                            } elseif (substr($enrolldate, 0, -7) == 3) {
                                $month = "March";
                            } elseif (substr($enrolldate, 0, -7) == 4) {
                                $month = "April";
                            } elseif (substr($enrolldate, 0, -7) == 5) {
                                $month = "May";
                            } elseif (substr($enrolldate, 0, -7) == 6) {
                                $month = "June";
                            } elseif (substr($enrolldate, 0, -7) == 7) {
                                $month = "July";
                            } elseif (substr($enrolldate, 0, -7) == 8) {
                                $month = "August";
                            } elseif (substr($enrolldate, 0, -7) == 9) {
                                $month = "September";
                            } elseif (substr($enrolldate, 0, -8) == 10) {
                                $month = "October";
                            } elseif (substr($enrolldate, 0, -8) == 11) {
                                $month = "November";
                            } elseif (substr($enrolldate, 0, -8) == 12) {
                                $month = "December";
                            }
                            //$month = "January";
                            $day = substr($enrolldate, -7, -5);
                            $year = substr($enrolldate, -4);
                            $enrollmentdate = $month . " " . $day . ", " . $year;

                            /*******************************************************
                             **   GET TOTAL SCORES AND IF PASSED
                            *******************************************************/
                            if ($total_correct <= 0) {
                                $examscore = 0;
                            } elseif ($total_correct == $total_Questions) {
                                $examscore = 100;
                            } else {
                                $examscore = 100 * ($total_correct / $total_Questions);
                                $examscore = round($examscore);
                            }

                            if ($total_correct <= 0) {
                                $examscore = 0;
                            } elseif ($total_correct == $total_Questions) {
                                $examscore = 100;
                            } else {
                                $examscore = 100 * ($total_correct / $total_Questions);
                                $examscore = round($examscore);
                            }

                            if ($examscore >= 97 && $examscore <= 100) {
                                $avggrade = "A+";
                                $gpa = 4.0;
                            }
                            if ($examscore >= 93 && $examscore <= 96.9) {
                                $avggrade = "A";
                                $gpa = 3.75;
                            }
                            if ($examscore >= 90 && $examscore <= 92.9) {
                                $avggrade = "A-";
                                $gpa = 3.5;
                            }
                            if ($examscore >= 87 && $examscore <= 89.9) {
                                $avggrade = "B+";
                                $gpa = 3.25;
                            }
                            if ($examscore >= 83 && $examscore <= 86.9) {
                                $avggrade = "B";
                                $gpa = 3;
                            }
                            if ($examscore >= 80 && $examscore <= 82.9) {
                                $avggrade = "B-";
                                $gpa = 2.5;
                            }
                            if ($examscore >= 77 && $examscore <= 79.9) {
                                $avggrade = "C+";
                                $gpa = 2.5;
                            }
                            if ($examscore >= 73 && $examscore <= 76.9) {
                                $avggrade = "C";
                                $gpa = 2.25;
                            }
                            if ($examscore >= 70 && $examscore <= 72.9) {
                                $avggrade = "C-";
                                $gpa = 2.5;
                            }
                            if ($examscore >= 67 && $examscore <= 69.9) {
                                $avggrade = "D+";
                                $gpa = 2.5;
                            }
                            if ($examscore >= 63 && $examscore <= 66.9) {
                                $avggrade = "D";
                                $gpa = 2.25;
                            }
                            if ($examscore >= 60 && $examscore <= 62.9) {
                                $avggrade = "D-";
                                $gpa = 2;
                            }
                            if ($examscore  < 60) {
                                $avggrade = "F";
                                $gpa = 0;
                            }
                            if ($examscore  >= 60) {
                                $totalCredit += $credits;
                            }
                            $totalGPA += $gpa;
                        }
                        $averageGPA = ($totalGPA / $total_courses);
                        $averageGPA = round($averageGPA, 2);
                        // Free result set
                        mysqli_free_result($result);
                    }
                } else {
                    echo "ERROR: Was not able to execute Query on line #213. " . mysqli_error($mysqli);
                }
                ?>
                <font size="+1"><strong>Personal:</strong></font>
                <div id="boxoutline" style="height: 300px;">
                    <div class="row clearfix">
                        <div class="col-sm-12">
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-4">
                            Name:
                        </div>
                        <div class="col-sm-8">
                            <strong><?php echo $fullname; ?></strong>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-4">
                            Credits:
                        </div>
                        <div class="col-sm-8">
                            <strong><?php echo $totalCredit; ?></strong>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-4">
                            GPA:
                        </div>
                        <div class="col-sm-8">
                            <strong><?php echo $averageGPA; ?></strong>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-4">
                            Enrollment Date:
                        </div>
                        <div class="col-sm-8">
                            <strong><?php echo $enrollmentdate; ?></strong>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4" style="padding-left: 20px;">
                <font size="+1"><strong>Home Room Messages:</strong></font>
                <div id="boxoutline" style="height: 300px; overflow-y: scroll;">
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <?php

                            // *******************************************************
                            // GET CURRENT MESSAGE
                            // *******************************************************
                            // Attempt select query execution

                            $sqlb = $mysqli->query("SELECT * FROM messages WHERE typeid = 'Home Room' ORDER BY msgdate DESC");
                            //if(!$sqlb) error_message("Error in $messages_tablename (quest_edit) line #178");
                            $sqlb->data_seek(0);
                            while ($rowb = $sqlb->fetch_assoc()) {
                                $msgid = $rowb['msgid'];
                                $typeid = $rowb['typeid'];
                                $msgtitle = $rowb['msgtitle'];
                                $msgbody = $rowb['msgbody'];
                                $msgdate = $rowb['msgdate'];
                                echo "<strong>" . $msgtitle . "</strong><br>";
                                echo $msgdate . "<br>";
                                echo $msgbody . "<br>";
                                echo "<hr>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 text-center">
                <span style="font-size: 20px; font-weight: bold;"><strong>IHN Space Social Media Site</strong></span>&nbsp;<!--button class="btn btn-success btn-sm" type="button" data-toggle="modal" data-target="#messages_modal">Send a Message</button-->

                <div id="boxoutline" style="height: 300px;">
                    <div class="row clearfix">
                        <div class="col-sm-12 text-center">
                            IHN Space Is Here!<br>
                            <img src="img/ihnspace1.jpg" width="80%">
                            <?php
                            // *******************************************************
                            // GET STUDENT MESSAGES
                            // *******************************************************
                            // Attempt select query execution
                            /*

                            $sqlz = "SELECT * FROM $studentmsg_tablename WHERE studentid = '$userid'";
                            if($resultz = mysqli_query($mysqli, $sqlz)){
                                while ($rowz = mysqli_fetch_array($resultz)) {
                                    $uid = $rowz['userid'];
                                    $studentid = $rowz['studentid'];
                                    $message = $rowz['message'];
                                    $sqlm = $mysqli->query("SELECT userfname, usermname, userlname, imagepath FROM $users_tablename WHERE userid = '$studentid'");
                                    if ($resultm = mysqli_query($mysqli, $sqlm)) {
                                        if (mysqli_num_rows($resultm) > 0) {
                                            $rowm = mysqli_fetch_array($resultm);
                                            $userfname = $rowm['userfname'];
                                            $usermname = $rowm['usermname'];
                                            $userlname = $rowm['userlname'];
                                            $imagepath = $rowm['imagepath'];
                                            if(empty($imagepath)){
                                                $imagepath = "images/NoPhoto.jpg";
                                            }
                                        }
                                    }
                                    echo "<img src='".$imagepath."' style='width: 50px; float: left; margin-right: 10px;'><strong>".$userfname." ".$usermname." ".$userlname."</strong><br>";
                                    echo $message . "<br>";
                                    echo "<hr>";
                                }
                                // Free result set
                                mysqli_free_result($resultd);
                            } else{
                                echo "ERROR: Was not able to execute Query on dashboard line #534. " . mysqli_error($mysqli);
                            }*/
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
}

function WelcomeToDashboard(){
	global $PHP_SELF, $mysqli, $msg, $notice, $fullname, $news;
    global $users_tablename, $userid, $useremail , $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $corecompletedate, $branchid, $role, $messages, $core_complete, $resetpwd;
    global $system_tablename, $sysid, $president , $vice, $treasurer, $secretary, $directorafrica, $deanedu, $corecourses, $followers, $facebook, $twitter, $youtube, $linkedin, $info, $updatedate, $cookietime, $sysadminver, $verdate, $releasenotes, $currentnotes, $goalamt, $curgoal;
    ?>
    <!-- <h4>Dashboard</h4> -->
    <br>
    <div id="boxed">
        <div class="row ml-12 mr-12 clearfix">
            <div class="col" align="center">
                <?php
                if(empty($_SESSION['userid'])){
                    ?>
                    <font size="+3"><strong>Welcome to the Dashboard, Visitor!</strong></font>&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php
                }else{
                    ?>
                    <font size="+3"><strong>Welcome, <?php echo $userfname; ?>!</strong></font>&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php
                }
                ?>
                <!-- <button type="button" id="btnrounded" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#information_modal">Update as of <?php echo date('m/d/Y'); ?></button> -->
                <br>
                <button type="button" class="btn btn-warning" id="opener">Update as of <?php echo date('m/d/Y'); ?></button>
                <br><br>
                <script src="//myradiostream.com/embed/ihnbible"></script>
            </div>
        </div>
    </div>

    <div id="dialog" class="selector" title="Latest News">
        <?php
            $news = $currentnotes;
            echo $news;
        ?>
    </div>

    <?php
}

function DonateGoals(){
	global $PHP_SELF, $mysqli, $msg, $notice, $fullname;
    global $system_tablename, $sysid, $president , $vice, $treasurer, $secretary, $directorafrica, $deanedu, $corecourses, $followers, $facebook, $twitter, $youtube, $linkedin, $info, $updatedate, $cookietime, $sysadminver, $verdate, $releasenotes, $currentnotes, $goalamt, $curgoal;

    // Attempt select query execution
    if ($result = $mysqli->query("SELECT goalamt, curgoal FROM $system_tablename")) {
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
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

    // $width = round(($c / $g) * 100, 2, PHP_ROUND_HALF_EVEN);
    $width = number_format(($current / $goal) * 100, 2, '.', '');
    ?>
    <div id="boxed" class="text-center">
        <p style="font-size: 28px;">Our current financial goal is <?php echo $g; ?>, which supports hundreds of students by providing satelite communications to receive education classes in remote areas. Can you pay it forward and help us reach our goal?</p>
        <p><span style="font-size: 32px;">We have received </span><span style="font-size: 40px; font-weight: bold;"><?php echo $c; ?></span> <span style="font-size: 32px;">of our</span> <span style="font-size: 40px; font-weight: bold;"><?php echo $g; ?></span> <span style="font-size: 32px;">goal!</span></p>
        
        <div class="progress" style="height: 40px;">
        <?php
        if($width >= 100){
            ?>
            <div class="progress-bar bg-success" role="progressbar" aria-label="20px high" style="width: <?php echo $width; ?>%"></div>
            <?php
        }else{
            ?>
            <div class="progress-bar bg-info" role="progressbar" aria-label="20px high" style="width: <?php echo $width; ?>%"></div>
            <?php
        }
        ?>
            <!-- <div class="progress-bar bg-info" role="progressbar" aria-label="20px high" style="width: <?php echo $width; ?>%"></div> -->
            <div style="font-size: 24px; font-weight: bold; padding-top: 4px;"><?php echo $width; ?>%</div>
        </div>

        <a href="#" class="btn btn-danger btn-lg" style="margin-top: 20px; margin-bottom: 20px;"><i class='bx bxs-heart'></i> I want to help - donate now</a>

        <p>A huge thank you to all our current supporters who make this opportunity possible by faithfully supporting this generosity-driven education.</p>
    </div>
    <?php
}

function JoinUs(){
    ?>
    <div id="boxed" class="text-center">
        <div class="row ml-12 mr-12 clearfix">
            <div class="col-sm-4" align="center">
                <div class="card" style="width: 18rem;">
                    <img src="img/card_1.jpg" style="width: 100%;" class="card-img-top" alt="...">
                    <div class="card-body">
                        <span class="card-title">Apply For Enrollment</span>
                        <p class="card-text">Fill out the admissions application below and start your Biblical education today!</p>
                    </div>
                    <div class="modal-footer card-btn">
                        <a href="admissions.php" class="btn btn-primary">Apply Now</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4" align="center">
                <div class="card" style="width: 18rem;">
                    <img src="img/card_2.jpg" style="width: 100%;" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Become a Volunteer</h5>
                        <p class="card-text">We need educators, administrators, writers, web developers, and so much more. Join our team!</p>
                    </div>
                    <div class="modal-footer card-btn">
                        <a href="volunteer.php" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4" align="center">
                <div class="card" style="width: 18rem;">
                    <img src="img/card_3.jpg" style="width: 100%;" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Join Our Prayer Warriors</h5>
                        <p class="card-text">View our prayer list and pray over the issues and concerns. Join with others and witness God's power.</p>
                    </div>
                    <div class="modal-footer card-btn">
                        <a href="prayerlist.php" class="btn btn-primary">Join Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}

function GetFamiliar(){
    ?>
    <div id="boxed" class="text-center">
        <p><span style="font-size: 32px;">Get familiar with our online campus!</span></p>
                
        <div class="row ml-12 mr-12 clearfix">
            <div class="col-sm-4" align="center">
            <!-- <div class="col-sm-4 text-center" style="padding-top: 20px;"> -->
                <img src="img/ihnlogo1.png" width="250">
                <br><br>
                <font color="#000000" size="+3"><strong>Help Support This Ministry</strong></font>
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top"><input name="cmd" type="hidden" value="_s-xclick" />
                    <input name="page_style" type="hidden" value="IHNBible" />
                    <input name="hosted_button_id" type="hidden" value="4A66KJZWR8UAG" />
                    <input alt="PayPal - The safer, easier way to pay online!" name="submit" src="https://ihnbible.org/images/paypaldonate.png" type="image" width="150" />
                    <img src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" alt="" width="1" height="1" border="0" />
                </form>
                <br>
                <font size="+2"><strong><a class="btn btn-primary" href="library/IHN_Bible_College_Catalog_2022-2023.pdf" target="_blank">Download 2022 - 2023 College Catalog</a></strong></font>
            </div>
            <div class="col-sm-4 text-center">
                <span style="font-size:20px; font-weight: bold;"><strong>From The President</strong></span>
                <br>
                <video width="100%" height="240" controls>
                    <source src="vids/WelcomeoIHNBBS.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
            <div class="col-sm-4" align="center">
                <!-- GetResponse Form -->
                <!--script style="z-index: 1;" type="text/javascript" src="https://app.getresponse.com/view_webform_v2.js?u=GnsdB&webforms_id=Bp0b6" data-webform-id="Bp0b6"></script-->
                <!-- Begin Mailchimp Signup Form -->
                <link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
                <style type="text/css">
                    #mc_embed_signup {
                        background: #fff;
                        clear: left;
                        font: 14px Helvetica, Arial, sans-serif;
                    }

                    /* Add your own Mailchimp form style overrides in your site stylesheet or in this style block.
                    We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
                </style>
                <div id="mc_embed_signup">
                    <form action="https://ihnbible.us20.list-manage.com/subscribe/post?u=885b57efdc51ceda68a907575&amp;id=fb137a88e8" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                        <div id="mc_embed_signup_scroll">
                            <h2>Subscribe To Our Newsletter</h2>
                            <div class="indicates-required"><span class="asterisk">*</span> indicates required</div>
                            <div class="mc-field-group">
                                <label for="mce-EMAIL">Email Address <span class="asterisk">*</span>
                                </label>
                                <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
                            </div>
                            <div class="mc-field-group">
                                <label for="mce-FNAME">First Name </label>
                                <input type="text" value="" name="FNAME" class="" id="mce-FNAME">
                            </div>
                            <div class="mc-field-group">
                                <label for="mce-LNAME">Last Name </label>
                                <input type="text" value="" name="LNAME" class="" id="mce-LNAME">
                            </div>
                            <div id="mce-responses" class="clear">
                                <div class="response" id="mce-error-response" style="display:none"></div>
                                <div class="response" id="mce-success-response" style="display:none"></div>
                            </div> <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                            <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_885b57efdc51ceda68a907575_fb137a88e8" tabindex="-1" value=""></div>
                            <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
                        </div>
                    </form>
                </div>
                <script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script>
                <script type='text/javascript'>
                    (function($) {
                        window.fnames = new Array();
                        window.ftypes = new Array();
                        fnames[0] = 'EMAIL';
                        ftypes[0] = 'email';
                        fnames[1] = 'FNAME';
                        ftypes[1] = 'text';
                        fnames[2] = 'LNAME';
                        ftypes[2] = 'text';
                    }(jQuery));
                    var $mcj = jQuery.noConflict(true);
                </script>
                <!--End mc_embed_signup-->
                <!-- /GetResponse Form -->
            </div>
            <div class="col-sm-2" align="center"></div>
        </div>
    </div>
    <?php
}
?>