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
    global $answers_tablename, $answerid, $userid, $courseid, $examid, $answer, $score, $gpa;
    global $system_tablename, $sysid, $president , $vice, $treasurer, $secretary, $directorafrica, $deanedu, $corecourses, $followers, $facebook, $twitter, $youtube, $linkedin, $info, $updatedate, $cookietime, $sysadminver, $verdate, $releasenotes, $currentnotes, $goalamt, $curgoal;
    global $users_tablename, $userid, $useremail , $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $corecompletedate, $branchid, $role, $messages, $core_complete, $resetpwd;
    global $menuid, $goal, $current, $pct, $userid;
    global $prayers_tablename, $prayerid, $prayee, $prayer_request, $answered;
    global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $credits, $filename, $validcourse;
    global $progenroll_tablename, $progenrollid, $enrprogid, $enruserid, $enrolldate;

    information_modal();

    if(!empty($_SESSION['userid'])){
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
                $suspended = $row['suspended'];
                $highgrade = $row['highgrade'];
                $dob = $row['dob'];
                $usersaved = $row['usersaved'];
                $baptized = $row['baptized'];
                $baptismdate = $row['baptismdate'];
                $profile = $row['profile'];
                $imagepath = $row['imagepath'];
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

        // *******************************************************
        // TOTAL PROGRAMS ENROLLED
        // *******************************************************
        // Attempt select query execution
        $sqld = "SELECT COUNT(*) AS 'TotalPrograms' FROM progenroll WHERE enruserid = '$userid'";
        if ($resultd = mysqli_query($mysqli, $sqld)) {
            if (mysqli_num_rows($resultd) > 0) {
                $rowd = mysqli_fetch_array($resultd);
                $total_Programs = $rowd['TotalPrograms'];
                // Free result set
                mysqli_free_result($resultd);
            }
        }
        // End attempt select query execution

        // *******************************************************
        // TOTAL COURSES ENROLLED
        // *******************************************************
        // Attempt select query execution
        $sqld = "SELECT COUNT(*) AS 'TotalCourses' FROM enrollments WHERE  euserid = '$userid'";
        if ($resultd = mysqli_query($mysqli, $sqld)) {
            if (mysqli_num_rows($resultd) > 0) {
                $rowd = mysqli_fetch_array($resultd);
                $total_enrolled = $rowd['TotalCourses'];
                // Free result set
                mysqli_free_result($resultd);
            }
        }
        // End attempt select query execution

        // *******************************************************
        // TOTAL COURSES COMPLETED
        // *******************************************************
        // Attempt select query execution
        $sqld = "SELECT COUNT(*) AS 'TotalCompleted' FROM enrollments WHERE euserid = '$userid' AND passed = '1'";
        if ($resultd = mysqli_query($mysqli, $sqld)) {
            if (mysqli_num_rows($resultd) > 0) {
                $rowd = mysqli_fetch_array($resultd);
                $total_completed = $rowd['TotalCompleted'];
                // Free result set
                mysqli_free_result($resultd);
            }
        }
        // End attempt select query execution
    }
    ?>
    <div class="height-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2"><?php menu(); ?></div>
                <div class="col-sm-10">
                    <?php
                    WelcomeToDashboard();
                    DonateGoals();
                    JoinUs();
                    GetFamiliar();
                    PersonalStats();
                    ?>
                        
                        <!-- <div class="card spacing">
                            <div class="card-header">
                                My Courses
                            </div>
                            <div class="card-body">
                                < ?php
                                global $enrollments_tablename, $enrollid, $euserid , $eprogid, $ecourseid, $examscore, $passed, $compdate, $rating;
                                global $courses_tablename, $courseid, $cprogid , $coursecode, $coursename, $coursedesc, $overview, $credits, $filename, $validcourse, $brief_desc, $course_photo, $course_cost, $course_discount, $hours, $videos, $cont_one, $cont_one_desc, $cont_two, $cont_two_desc, $cont_three, $cont_three_desc, $head_photo, $top_course;
                                $totalcr = 0;
                                ?>
                                <table class="table">
                                    <thead>
                                        <tr>
                                        <th scope="col">Course</th>
                                        <th scope="col">Course Status</th>
                                        <th scope="col">Credits</th>
                                        <th scope="col">Completion Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        < ?php
                                        // Attempt select query execution
                                        if ($result = $mysqli->query("SELECT eprogid, ecourseid, passed, compdate FROM $enrollments_tablename WHERE euserid = '$userid'")) {
                                            if(mysqli_num_rows($result) > 0){
                                                while($row = mysqli_fetch_array($result)){
                                                    $eprogid = $row['eprogid'];
                                                    $ecourseid = $row['ecourseid'];
                                                    $psd = $row['passed'];
                                                    $compdate = $row['compdate'];
                                                    // Attempt select query execution
                                                    if ($resultb = $mysqli->query("SELECT courseid, coursecode, coursename, credits FROM $courses_tablename WHERE courseid = '$ecourseid'")) {
                                                        if(mysqli_num_rows($resultb) > 0){
                                                            $rowb = mysqli_fetch_array($resultb);
                                                            $courseid = $rowb['courseid'];
                                                            $coursecode = $rowb['coursecode'];
                                                            $coursename = addslashes($rowb['coursename']);
                                                            $credits = $rowb['credits'];
                                                            $totalcr += $credits;
                                                            if($psd){
                                                                $passed = "<a href='course.php?coursename=".$coursename."&courseid=".$courseid."' class='btn btn-success' style='width: 200px;'><span style='font-size: 18px;'>COMPLETED</span></a>";
                                                            }else{
                                                                $passed = "<a href='course.php?coursename=".$coursename."' class='btn btn-success' style='width: 200px;'><span style='font-size: 18px;'>INCOMPLETE</span></a>";
                                                            }
                                                            ?>
                                                            <tr>
                                                                < ?php
                                                                if($psd){
                                                                    ?>
                                                                    <td>< ?php echo $coursecode; ?> - < ?php echo $coursename; ?></td>
                                                                    < ?php
                                                                }else{
                                                                    ?>
                                                                    <td><a href="#">< ?php echo $coursecode; ?> - < ?php echo $coursename; ?></a></td>
                                                                    < ?php
                                                                }
                                                                ?>
                                                                <td>< ?php echo $passed; ?></td>
                                                                <td>< ?php echo $credits; ?></td>
                                                                <td>< ?php echo $compdate; ?></td>
                                                            </tr>
                                                            < ?php
                                                            // Free result set
                                                            // mysqli_free_result($result);
                                                        } else{
                                                            $msg = "<font color='#FF0000'><strong>Account not found!</strong></font>";
                                                            main_form();
                                                            exit;
                                                        }
                                                    } else{
                                                        echo "ERROR: Was not able to execute Query on line #152. " . mysqli_error($mysqli);
                                                    }
                                                    // End attempt select query execution
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
                                        ?>
                                        <tr>
                                            <td></td>
                                            <td>< ?php echo "Total Credits: ".$totalcr; ?></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div> -->
                    
                    <div id="boxed" style="margin-bottom: 50px;">&nbsp;</div>
                    
                </div>
            </div>
        </div>
    </div>


    <?php
        $news = $currentnotes;
    ?>


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

    <!-- Welcome Video -->
    <div class="modal fade" id="videoOne" tabindex="-1" role="dialog" aria-labelledby="videoOneLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="margin-top: 80px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Welcome Video</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" align="center">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/4liWMlkpupg" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- How to Use This Site Video -->
    <div class="modal fade" id="videoTwo" tabindex="-1" role="dialog" aria-labelledby="videoTwoLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="margin-top: 80px;">
                <div class="modal-header">
                    <!-- <h5 class="modal-title" id="exampleModalLabel">How to Use This Site</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> -->
                </div>
                <div class="modal-body" align="center">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/nTL5gtP0nyg" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- How to Enroll Video -->
    <div class="modal fade" id="videoThree" tabindex="-1" role="dialog" aria-labelledby="videoThreeLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="margin-top: 80px;">
                <div class="modal-header">
                    <!-- <h5 class="modal-title" id="exampleModalLabel">How to Enroll</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> -->
                </div>
                <div class="modal-body" align="center">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/D7Ef4kM5BLg" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
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
function goto_course(){
    $coursename = $_GET['coursename'];

    echo "coursename: ".$coursename."<br>";
    exit;
}

//*******************************************************
//**********************  SWITCH  ***********************
//*******************************************************
switch($action) {
    case "completed":
        goto_course();
    break;
	default:
		main_form();
	break;
}
?>