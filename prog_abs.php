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
    global $users_tablename, $userid, $useremail , $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $corecompletedate, $branchid, $role, $messages, $core_complete, $resetpwd;
    global $system_tablename, $sysid, $president , $vice, $treasurer, $secretary, $directorafrica, $deanedu, $corecourses, $followers, $facebook, $twitter, $youtube, $linkedin, $info, $updatedate, $cookietime, $sysadminver, $verdate, $releasenotes, $goalamt, $curgoal;
    global $menuid, $goal, $current, $pct, $userid;
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
    }
    ?>
<div class="height-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2"><?php menu(); ?></div>
            <div class="col-sm-10">
                <?php
                WelcomeToDashboard();
                ?>

                <div id="boxed">
                    <p class="text-center"><span style="font-size: 32px;">INTRODUCTION</span></p>
                            
                    <div class="row ml-12 mr-12">
                        <div class="col-sm-6" style="text-align: left;">
                            <h3>The Program</h3>
                            <p>Our Associates Degree of Biblical Studies (also known as a Diploma Program) is offered to give a well-balanced education in the Bible. It is designed as an introduction to all other studies. There is nothing more important to the Christian student than to have a strong, working knowledge of the Bible and its contents.</p>
                        </div>
                        <div class="col-sm-6" style="text-align: left;">
                            <h3>Requirements</h3>
                            <p>The requirement for enrollment is very easy and open to anyone. Anyone can study and receive a certificate of completion. However, if you are seeking a diploma you will need to provide your High School transcripts which show a successful graduation or a GED equivalent.</p>
                            <p>If this is the first time you are enrolling, you will need to go to the <a href="admissions.php">Admissions page</a> and fill out an application. Once this is done you will be sent a response to your email account with login instructions.</p>
                        </div>
                    </div>
                </div>

                <div id="boxed">
                    <p class="text-center"><span style="font-size: 32px; font-weight: bold;">Associates of Biblical Studies Program</span></p>

                    <div class="row">
                        <div class="col-sm-12" id="asc">
                            <div class="card spacing">
                                <div class="card-body">
                                    <span style="font-weight: bold; font-size: 18px;">Associates Degree of Biblical Studies</span>
                                    <p class="card-text">20 Courses 60 Credits</p>
                                    <?php
                                    if(empty($_SESSION['userid'])){
                                        ?>
                                        <div class="row">
                                            <div class="col-4">
                                                <strong>BIB101</strong><br>Old Testament Survey I<br>
                                                <strong>BIB102</strong><br>New Testament Survey I<br>
                                                <strong>BIB103</strong><br>Faith Foundations<br>
                                                <strong>BIB104</strong><br>Bible Study Methods I<br>
                                                <strong>BIB105</strong><br>Biblical World View<br>
                                                <strong>BIB106</strong><br>Kingdom Living<br>
                                                <strong>BIB107</strong><br>Knowing God's Voice<br>
                                            </div>
                                            <div class="col-4">
                                                <strong>MIN108</strong><br>Management By Objectives<br>
                                                <strong>MIN109</strong><br>Environmental Analysis<br>
                                                <strong>BIB110</strong><br>Spiritual Warfare<br>
                                                <strong>MIN111</strong><br>Mobilization Methodologies<br>
                                                <strong>MIN112</strong><br>Introduction to Evangelism<br>
                                                <strong>MIN113</strong><br>Spiritual Harvest<br>
                                                <strong>MIN114</strong><br>Holy Spirit Ministry<br>
                                            </div>
                                            <div class="col-4">
                                                <strong>MIN115</strong><br>Multiplication Methodologies<br>
                                                <strong>MIN116</strong><br>Jail And Prison Ministry<br>
                                                <strong>BIB117</strong><br>Women: A Biblical Profile<br>
                                                <strong>MIN118</strong><br>Intercessory Prayer<br>
                                                <strong>BIB119</strong><br>Power Principles<br>
                                                <strong>MIN120</strong><br>Introduction to the Principles of Teaching<br>
                                            </div>
                                        </div>
                                        <a href="admissions.php" class="btn btn-primary" style="margin-top: 20px;">Enroll Now</a>
                                        <?php
                                    }else{
                                        ?>
                                        <div class="row">
                                            <div class="col-4">
                                                <a href="bib101.php"><strong>BIB101</strong> - Old Testament Survey I<br></a>
                                                <a href="course_cc110.php"><strong>BIB102</strong> - New Testament Survey I<br></a>
                                                <a href="course_cc102.php"><strong>BIB103</strong> - Faith Foundations<br></a>
                                                <a href="course_cc101.php"><strong>BIB104</strong> - Bible Study Methods I<br></a>
                                                <a href="course_cc103.php"><strong>BIB105</strong> - Biblical World View<br></a>
                                                <a href="course_cc104.php"><strong>BIB106</strong> - Kingdom Living<br></a>
                                                <a href="course_cc105.php"><strong>BIB107</strong> - Knowing God's Voice<br></a>
                                            </div>
                                            <div class="col-4">
                                                <a href="course_cc108.php"><strong>MIN108</strong> - Management By Objectives<br></a>
                                                <a href="course_cc107.php"><strong>MIN109</strong> - Environmental Analysis<br></a>
                                                <a href="course_cc106.php"><strong>BIB110</strong> - Spiritual Warfare<br></a>
                                                <a href="course_cc111.php"><strong>MIN111</strong> - Mobilization Methodologies<br></a>
                                                <a href="course_cc112.php"><strong>MIN112</strong> - Introduction to Evangelism<br></a>
                                                <a href="course_cc113.php"><strong>MIN113</strong> - Spiritual Harvest<br></a>
                                                <a href="course_cc114.php"><strong>MIN114</strong> - Holy Spirit Ministry<br></a>
                                            </div>
                                            <div class="col-4">
                                                <a href="course_cc115.php"><strong>MIN115</strong> - Multiplication Methodologies<br></a>
                                                <a href="course_cc116.php"><strong>MIN116</strong> - Jail And Prison Ministry<br></a>
                                                <a href="course_cc117.php"><strong>BIB117</strong> - Women: A Biblical Profile<br></a>
                                                <a href="course_cc118.php"><strong>MIN118</strong> - Intercessory Prayer<br></a>
                                                <a href="course_cc119.php"><strong>BIB119</strong> - Power Principles<br></a>
                                                <a href="course_cc120.php"><strong>MIN120</strong> - Introduction to the Principles of Teaching<br></a>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="margin-bottom: 50px;">&nbsp;</div>
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