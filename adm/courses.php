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
    global $PHP_SELF, $mysqli, $msg;
    global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
    global $programs_tablename, $progid, $progname, $progdesc, $isenabled, $cost, $charge, $accordian_header, $progtype;
    global $prog_det_tablename, $progdetid, $progid, $courseid, $coursecode, $coursename, $coursecredits;
    global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $coursedesc, $credits, $filename, $validcourse;
    global $progcourses_tablename, $pgid, $progid, $courseid;
    global $courselessons_tablename, $lessonid, $courseid, $lessonnumber, $lessonname, $lessondetail, $videourl, $fileurl, $qdetid, $isvalid;
    global $exams_tablename, $examid, $excourseid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;
    global $quizzes_tablename, $quizid, $excourseid, $qdetid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;
    global $quizdet_tablename, $qdetid, $quizname, $courseid;

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
        echo "ERROR: Was not able to execute Query on line #152. " . mysqli_error($mysqli);
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
                <div class="col-10">
                    <div class="row " style="padding-top:10px;">
                        <div class="col-12">
                            <!-- *******************************************************************************************
                            **********  POPULAR PRODUCTS
                            *********************************************************************************************-->
                            <section name="Website Options" style="padding-top:20px;">
                                <h1>Course Management</h1>
                                <center>
                                    <?php echo $msg; ?>
                                    <br>
                                    <form action="<?php echo $PHP_SELF ?>" method="post">
                                        <input class='btn btn-primary' name="action" type="submit" value="Add New" />
                                    </form>
                                </center>
                                <br>
                                <div class="card text-dark bg-light mb-1" id="boxdisplay">
                                    <div class="card-header">
                                        <font size="+2"><strong>School Programs</strong></font>
                                    </div>
                                    <div class="card-body">
                                        <form action="<?php echo $PHP_SELF ?>" method="post">
                                            <table class="table">
                                                <tr>
                                                    <td>
                                                        <font size="+1"><strong>Course Code</strong></font>
                                                    </td>
                                                    <td>
                                                        <font size="+1"><strong>Course Name</strong></font>
                                                    </td>
                                                    <td>
                                                        <font size="+1"><strong>File Name</strong></font>
                                                    </td>
                                                    <td>
                                                        <font size="+1"><strong>Credits</strong></font>
                                                    </td>
                                                    <td>
                                                        <font size="+1"><strong>Enabled</strong></font>
                                                    </td>
                                                    <td align="right">
                                                        <font size="+1"><strong>View/Modify</strong></font>
                                                    </td>
                                                </tr>
                                                <tbody>
                                                    <tr>
                                                        <?php
                                                        global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $coursedesc, $credits, $filename, $validcourse;

                                                        // Attempt select query execution
                                                        $sql = "SELECT * FROM $courses_tablename ORDER BY coursename ASC";
                                                        if ($result = mysqli_query($mysqli, $sql)) {
                                                            if (mysqli_num_rows($result) > 0) {
                                                                while ($row = mysqli_fetch_array($result)) {
                                                                    $courseid = $row['courseid'];
                                                                    $coursecode = $row['coursecode'];
                                                                    $coursename = $row['coursename'];
                                                                    $credits = $row['credits'];
                                                                    $filename = $row['filename'];
                                                                    $validcourse = $row['validcourse'];
                                                                    if ($validcourse == "1") {
                                                                        $en = "<font color='green'><strong>Yes</strong></font>";
                                                                    } else {
                                                                        $en = "<font color='#F00'><strong>No</strong></font>";
                                                                    }
                                                        ?>
                                                    <tr>
                                                        <form action="<?php echo $PHP_SELF ?>" method="post">
                                                            <td><?php echo $coursecode; ?></td>
                                                            <td><?php echo $coursename; ?></td>
                                                            <td><?php echo $filename; ?></td>
                                                            <td><?php echo $credits; ?></td>
                                                            <td><?php echo $en; ?></td>
                                                            <td align="right">
                                                                <input type="hidden" name="courseid" value="<?php echo $courseid ?>">
                                                                <!--input class='btn btn-success' name="action" type="submit" value="View/Modify" /-->
                                                                <button class="btn btn-success btn-sm" name="action" type="submit" value="View/Modify">View/Modify</button>&nbsp;<button class="btn btn-danger btn-sm" name="action" type="submit" value="Delete">Delete</button>
                                                            </td>
                                                        </form>
                                                    </tr>
                                                    <?php
                                                    }
                                                        // Free result set
                                                        mysqli_free_result($result);
                                                    } else {
                                                        ?>
                                                        <tr>
                                                            <td colspan="5">
                                                                <center>No data available in table</center>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                } else {
                                                    echo "ERROR: Was not able to execute Query on line #213. " . mysqli_error($hdmysqli);
                                                }
                                                // End attempt select query execution
                                                ?>
                                        </tr>
                                            </table>
                                    </div>
                                </div>
                            </section>


                        </div>
                    </div>
                </div>
            </div>

            <br><br>

<?php
include "tmp/footer.php";
}


//*****************************************************************************************************
//***  EDIT LESSONS
//*****************************************************************************************************
function edit_lesson()
{
    global $PHP_SELF, $mysqli, $msg;
    global $prog_det_tablename, $progdetid, $progid, $courseid, $coursecode, $coursename, $coursecredits;
    global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $coursedesc, $credits, $filename, $validcourse;
    global $progcourses_tablename, $pgid, $progid, $courseid;
    global $courselessons_tablename, $lessonid, $courseid, $lessonnumber, $lessonname, $lessondetail, $videourl, $fileurl, $qdetid, $isvalid;
    global $exams_tablename, $examid, $excourseid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;
    global $quizzes_tablename, $quizid, $excourseid, $qdetid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;
    global $quizdet_tablename, $qdetid, $quizname, $courseid;

    $lessonid = $_POST['lessonid'];

    $sql = $mysqli->query("SELECT * FROM $courselessons_tablename WHERE lessonid = '$lessonid'");
    //if(!$sql) error_message("Error in $courselessons_tablename (courses) line #174");
    $row = $sql->fetch_assoc();
    $lessonid = $row['lessonid'];
    $courseid = $row['courseid'];
    $lessonnumber = $row['lessonnumber'];
    $lessonname = $row['lessonname'];
    $lessondetail = $row['lessondetail'];
    $videourl = $row['videourl'];
    $fileurl = $row['fileurl'];
    $qdetid = $row['qdetid'];
    $isvalid = $row['isvalid'];

    $_SESSION['lessonid'] = $lessonid;
    $_SESSION['courseid'] = $courseid;
    $_SESSION['lessonnumber'] = $lessonnumber;
    $_SESSION['lessonname'] = $lessonname;
    $_SESSION['lessondetail'] = $lessondetail;
    $_SESSION['videourl'] = $videourl;
    $_SESSION['fileurl'] = $fileurl;
    $_SESSION['qdetid'] = $qdetid;

    $sql = $mysqli->query("SELECT quizname FROM $quizdet_tablename WHERE qdetid = '$qdetid'");
    //if(!$sql) error_message("Error in $courselessons_tablename (courses) line #174");
    $row = $sql->fetch_assoc();
    $quizname = $row['quizname'];
    $_SESSION['quizname'] = $quizname;

    include 'templates/include.tpl';
    include "templates/style.tpl";
    ?>
        <script>
            tinymce.init({
                selector: 'textarea#basic-example',
                height: 300,
                menubar: false,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table paste code wordcount'
                ],
                toolbar: 'undo redo | formatselect | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat',
                content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
            });
        </script>

        <body>
            <div class='container-fluid'>
                <section>
                    <div style="height: 60px;">
                        <div class="row" style="background-color: #a90329; background-image: linear-gradient(to bottom, #00c3ff, #0084ff); height: 60px; padding-top: 0px;">
                            <div class="col-sm-6" align="left" style="padding-top: 0px;">
                                <a class="navbar-brand" href="#">
                                    <img src="img/IHN_Logo_1000x1000_trans.png" style="height: 40px; margin-top: 5px;">
                                    <font color="#ffffff" style="margin-bottom: 40px;"><strong>IHN BIBLE COLLEGE</strong></font>
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
                                    <form action="<?php echo $PHP_SELF ?>" method="post">
                                        <center>
                                            <table class="table">
                                                <tr>
                                                    <td>
                                                        Course ID
                                                    </td>
                                                    <td>
                                                        <input type="text" name="courseid" size="5" value="<?php echo $_SESSION['courseid'] ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Lesson Number
                                                    </td>
                                                    <td>
                                                        <input type="text" name="lessonnumber" size="5" value="<?php echo $_SESSION['lessonnumber'] ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Lesson Name
                                                    </td>
                                                    <td>
                                                        <input type="text" name="lessonname" size="60" value="<?php echo $_SESSION['lessonname'] ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Details
                                                    </td>
                                                    <td>
                                                        <textarea id="basic-example" name="lessondetail" rows="5" cols="80"><?php echo $_SESSION['lessondetail'] ?></textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Video URL
                                                    </td>
                                                    <td>
                                                        <input type="text" name="videourl" size="60" value="<?php echo $_SESSION['videourl'] ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        File URL
                                                    </td>
                                                    <td>
                                                        <input type="text" name="fileurl" size="60" value="<?php echo $_SESSION['fileurl'] ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Quiz
                                                    </td>
                                                    <td>
                                                        <!--input type="text" name="qdetid" size="10" value="< ?php echo $_SESSION['qdetid'] ?>"-->

                                                        <select class="input_text" name="qdetid">
                                                            <option value="<?php echo $_SESSION['qdetid'] ?>"><?php echo $_SESSION['quizname'] ?></option>
                                                            <?php
                                                            $sqlb = $mysqli->query("SELECT qdetid, quizname FROM $quizdet_tablename WHERE courseid = '$courseid' ORDER BY quizname ASC");
                                                            //if(!$sqlb) error_message("Error in $courses_tablename (programs) line #263");
                                                            $sqlb->data_seek(0);
                                                            while ($rowb = $sqlb->fetch_assoc()) {
                                                                $qdetid = $rowb['qdetid'];
                                                                $quizname = $rowb['quizname'];
                                                            ?>
                                                                <option value="<?php echo $qdetid; ?>"><?php echo $quizname; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Is Valid
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($isvalid == 'Yes') {
                                                        ?>
                                                            <input type="radio" name="isvalid" value="Yes" checked> Yes
                                                            <input type="radio" name="isvalid" value="No"> No
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <input type="radio" name="isvalid" value="Yes"> Yes
                                                            <input type="radio" name="isvalid" value="No" checked> No
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                            </table>
                                            <input type="hidden" name="lessonid" value="<?php echo $lessonid ?>">
                                            <input class="btn btn-primary" type="submit" name="action" value="Save Changes" />
                                        </center>
                                    </form>
                                    <br /><br />

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        <?php
    }


    //*******************************************************
    //*********************  DO EDIT  ***********************
    //*******************************************************
    function do_edit()
    {
        global $PHP_SELF, $mysqli, $msg;
        global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
        global $programs_tablename, $progid, $progname, $enabled, $cost, $charge;
        global $prog_det_tablename, $progdetid, $progid, $courseid, $coursecode, $coursename, $coursecredits;
        global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $coursedesc, $credits, $filename, $validcourse;
        global $progcourses_tablename, $pgid, $progid, $courseid;
        global $exams_tablename, $examid, $excourseid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;
        global $quizzes_tablename, $quizid, $excourseid, $qdetid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;
        global $quizdet_tablename, $qdetid, $quizname, $courseid;

        $courseid = $_POST['courseid'];
        $coursecode = $_POST['coursecode'];
        $coursename = addslashes($_POST['coursename']);
        $coursedesc = addslashes($_POST['coursedesc']);
        $credits = $_POST['credits'];
        $filename = addslashes($_POST['filename']);
        $validcourse = $_POST['validcourse'];

        $sql = "UPDATE $courses_tablename SET coursecode = '$coursecode', coursename = '$coursename', coursedesc = '$coursedesc', credits = '$credits', filename = '$filename', validcourse = '$validcourse' WHERE courseid = '$courseid'";

        if ($mysqli->query($sql) === TRUE) {
            $msg = "Updated!<br><br>";
        } else {
            $msg = "Error: " . $sql . "<br>" . $mysqli->error;
        }

        main_form();
    }


    //*******************************************************
    //**************  DO EDIT LESSON  ***********************
    //*******************************************************
    function do_edit_lesson()
    {
        global $PHP_SELF, $mysqli, $msg;
        global $prog_det_tablename, $progdetid, $progid, $courseid, $coursecode, $coursename, $coursecredits;
        global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $coursedesc, $credits, $filename, $validcourse;
        global $progcourses_tablename, $pgid, $progid, $courseid;
        global $courselessons_tablename, $lessonid, $courseid, $lessonnumber, $lessonname, $lessondetail, $videourl, $fileurl, $qdetid, $isvalid;
        global $exams_tablename, $examid, $excourseid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;
        global $quizzes_tablename, $quizid, $excourseid, $qdetid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;
        global $quizdet_tablename, $qdetid, $quizname, $courseid;

        $lessonid = $_POST['lessonid'];
        $courseid = $_POST['courseid'];
        $lessonnumber = $_POST['lessonnumber'];
        $lessonname = addslashes($_POST['lessonname']);
        $lessondetail = addslashes($_POST['lessondetail']);
        $videourl = addslashes($_POST['videourl']);
        $fileurl = addslashes($_POST['fileurl']);
        $qdetid = $_POST['qdetid'];
        $isvalid = $_POST['isvalid'];

        $sql = $mysqli->query("UPDATE $courselessons_tablename SET lessonnumber = '$lessonnumber', lessonname = '$lessonname', lessondetail = '$lessondetail', videourl = '$videourl', fileurl = '$fileurl', qdetid = '$qdetid', isvalid = '$isvalid' WHERE lessonid = '$lessonid'");

        edit_record();
    }


    //*****************************************************************************************************
    //***  EDIT LESSONS
    //*****************************************************************************************************
    function add_lesson()
    {
        global $PHP_SELF, $mysqli, $msg;
        global $prog_det_tablename, $progdetid, $progid, $courseid, $coursecode, $coursename, $coursecredits;
        global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $coursedesc, $credits, $filename, $validcourse;
        global $progcourses_tablename, $pgid, $progid, $courseid;
        global $courselessons_tablename, $lessonid, $courseid, $lessonnumber, $lessonname, $lessondetail, $videourl, $fileurl, $qdetid, $isvalid;
        global $exams_tablename, $examid, $excourseid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;
        global $quizzes_tablename, $quizid, $excourseid, $qdetid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;
        global $quizdet_tablename, $qdetid, $quizname, $courseid;

        $courseid = $_POST['courseid'];

        include 'templates/include.tpl';
        include "templates/style.tpl";
        ?>
            <script>
                tinymce.init({
                    selector: 'textarea#basic-example',
                    height: 300,
                    width: 800,
                    menubar: false,
                    plugins: [
                        'advlist autolink lists link image charmap print preview anchor',
                        'searchreplace visualblocks code fullscreen',
                        'insertdatetime media table paste code wordcount'
                    ],
                    toolbar: 'undo redo | formatselect | ' +
                        'bold italic backcolor | alignleft aligncenter ' +
                        'alignright alignjustify | bullist numlist outdent indent | ' +
                        'removeformat',
                    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
                });
            </script>

            <body>
                <div class='container-fluid'>
                    <section>
                        <div style="height: 60px;">
                            <div class="row" style="background-color: #a90329; background-image: linear-gradient(to bottom, #00c3ff, #0084ff); height: 60px; padding-top: 0px;">
                                <div class="col-sm-6" align="left" style="padding-top: 0px;">
                                    <a class="navbar-brand" href="#">
                                        <img src="img/IHN_Logo_1000x1000_trans.png" style="height: 40px; margin-top: 5px;">
                                        <font color="#ffffff" style="margin-bottom: 40px;"><strong>IHN BIBLE COLLEGE</strong></font>
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
                                        <form action="<?php echo $PHP_SELF ?>" method="post">
                                            <center>
                                                <table class="table">
                                                    <tr>
                                                        <td>
                                                            Course ID
                                                        </td>
                                                        <td>
                                                            <input type="text" name="courseid" size="5" value="<?php echo $courseid; ?>">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Lesson Number
                                                        </td>
                                                        <td>
                                                            <input type="text" name="lessonnumber" size="5" value="">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Lesson Name
                                                        </td>
                                                        <td>
                                                            <input type="text" name="lessonname" size="60" value="">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Details
                                                        </td>
                                                        <td>
                                                            <textarea id="basic-example" name="lessondetail" rows="5" width="100%"></textarea>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Video URL
                                                        </td>
                                                        <td>
                                                            <input type="text" name="videourl" size="60" value="">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            File URL
                                                        </td>
                                                        <td>
                                                            <input type="text" name="fileurl" size="60" value="">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Quiz ID
                                                        </td>
                                                        <td>
                                                            <input type="text" name="quizid" size="10" value="">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Valid
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($_SESSION['isvalid'] == 'Yes') {
                                                            ?>
                                                                <input type="radio" name="isvalid" value="Yes" checked> Yes
                                                                <input type="radio" name="isvalid" value="No"> No
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <input type="radio" name="isvalid" value="Yes"> Yes
                                                                <input type="radio" name="isvalid" value="No" checked> No
                                                            <?php
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <input type="hidden" name="lessonid" value="<?php echo $lessonid ?>">
                                                <input class="btn btn-primary" type="submit" name="action" value="Save New Lesson" />
                                            </center>
                                        </form>
                                        <br /><br />

                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            <?php
        }


        //*******************************************************
        //*********************  ADD NEW  ***********************
        //*******************************************************
        function add_new(){
            global $PHP_SELF, $mysqli, $msg;
            global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
            global $programs_tablename, $progid, $progname, $progdesc, $isenabled, $cost, $charge, $accordian_header, $progtype;
            global $prog_det_tablename, $progdetid, $progid, $courseid, $coursecode, $coursename, $coursecredits;
            global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $coursedesc, $overview, $credits, $filename, $validcourse, $brief_desc, $course_photo, $course_cost, $course_discount, $hours, $videos, $cont_one, $cont_one_desc, $cont_two, $cont_two_desc, $cont_three, $cont_three_desc, $head_photo, $top_course;

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
            ?>
            <body>
            
            <!-- *****************************************************************************************************
            *******  MAIN
            *******************************************************************************************************-->
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
                                <div class="row " style="padding-top:10px;">
                                    <div class="col-12">
                                        <form action="<?php echo $PHP_SELF ?>" method="post">
                                            <div style="margin-top: 40px;">
                                                <h1>Add Course</h1>
                                                <div class="mb-3">
                                                    <label for="coursecode" class="form-label">Course Code</label>
                                                    <input type="text" name="coursecode" class="form-control" id="coursecode">
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label for="coursename" class="form-label">Course Name</label>
                                                    <input type="text" name="coursename" class="form-control" id="coursename">
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label for="coursedesc" class="form-label">Course Description</label>
                                                    <textarea class="form-control" name="coursedesc" id="coursedesc" rows="3"></textarea>
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label for="overview" class="form-label">Course Overview</label>
                                                    <textarea class="form-control" name="overview" id="overview" rows="3"></textarea>
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label for="credits" class="form-label">Course Credits</label>
                                                    <input type="text" name="credits" class="form-control" id="credits">
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label for="filename" class="form-label">File Name</label>
                                                    <input type="text" name="filename" class="form-control" id="filename">
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label for="enabled" class="form-label">Is Enabled</label>
                                                    <?php
                                                    if ($_SESSION['enabled'] == true) {
                                                    ?>
                                                        <input type="radio" name="enabled" value="1" checked> Yes
                                                        <input type="radio" name="enabled" value="0"> No
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <input type="radio" name="enabled" value="1"> Yes
                                                        <input type="radio" name="enabled" value="0" checked> No
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label for="briefdesc" class="form-label">Brief Deswcription</label>
                                                    <textarea class="form-control" name="briefdesc" id="briefdesc" rows="3"></textarea>
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label for="coursephoto" class="form-label">Course Photo</label>
                                                    <input type="text" name="coursephoto" class="form-control" id="coursephoto">
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label for="coursecost" class="form-label">Course Cost</label>
                                                    <input type="text" name="coursecost" class="form-control" id="coursecost">
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label for="coursediscount" class="form-label">Course Discount</label>
                                                    <input type="text" name="coursediscount" class="form-control" id="coursediscount">
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label for="hours" class="form-label">Total Video Hours</label>
                                                    <input type="text" name="hours" class="form-control" id="hours">
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label for="videos" class="form-label"># of Videos</label>
                                                    <input type="text" name="videos" class="form-control" id="videos">
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label for="contone" class="form-label">Content One</label>
                                                    <input type="text" name="contone" class="form-control" id="contone">
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label for="contonedesc" class="form-label">Content One Description</label>
                                                    <textarea class="form-control" name="contonedesc" id="contonedesc" rows="3"></textarea>
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label for="conttwo" class="form-label">Content Two</label>
                                                    <input type="text" name="conttwo" class="form-control" id="conttwo">
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label for="conttwodesc" class="form-label">Content Two Description</label>
                                                    <textarea class="form-control" name="conttwodesc" id="conttwodesc" rows="3"></textarea>
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label for="contthree" class="form-label">Content Three</label>
                                                    <input type="text" name="contthree" class="form-control" id="contthree">
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label for="contthreedesc" class="form-label">Content Two Description</label>
                                                    <textarea class="form-control" name="contthreedesc" id="contthreedesc" rows="3"></textarea>
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label for="headphoto" class="form-label">Header Photo</label>
                                                    <input type="text" name="headphoto" class="form-control" id="headphoto">
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label for="topcourse" class="form-label">Is Top Course</label>
                                                    <?php
                                                    if ($_SESSION['topcourse'] == true) {
                                                    ?>
                                                        <input type="radio" name="topcourse" value="1" checked> Yes
                                                        <input type="radio" name="topcourse" value="0"> No
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <input type="radio" name="topcourse" value="1"> Yes
                                                        <input type="radio" name="topcourse" value="0" checked> No
                                                    <?php
                                                    }
                                                    ?>
                                                </div>

                                                <input type="hidden" name="progid" value="<?php echo $progid ?>">
                                                <input class="btn btn-primary" type="submit" name="action" value="Submit" />
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                    
                            <div id="boxed" style="margin-top: 50px;">&nbsp;</div>
                    
                        </div>
                    </div>
                </div>
            </div>

        <script>
            tinymce.init({
                selector: '#coursedesc',
                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                toolbar: 'undo redo| bold italic underline strikethrough | bullist numlist indent outdent  | link image media table | align lineheight| emoticons charmap | removeformat | blocks fontfamily fontsize ',
                width: '100%',
                height: 300,
                readonly: 0
            });
        </script>

        <script>
            tinymce.init({
                selector: '#overview',
                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                toolbar: 'undo redo| bold italic underline strikethrough | bullist numlist indent outdent  | link image media table | align lineheight| emoticons charmap | removeformat | blocks fontfamily fontsize ',
                width: '100%',
                height: 400,
                readonly: 0
            });
        </script>

        <script>
            tinymce.init({
                selector: '#briefdesc',
                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                toolbar: 'undo redo| bold italic underline strikethrough | bullist numlist indent outdent  | link image media table | align lineheight| emoticons charmap | removeformat | blocks fontfamily fontsize ',
                width: '100%',
                height: 300,
                readonly: 0
            });
        </script>

        <script>
            tinymce.init({
                selector: '#contonedesc',
                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                toolbar: 'undo redo| bold italic underline strikethrough | bullist numlist indent outdent  | link image media table | align lineheight| emoticons charmap | removeformat | blocks fontfamily fontsize ',
                width: '100%',
                height: 300,
                readonly: 0
            });
        </script>

        <script>
            tinymce.init({
                selector: '#conttwodesc',
                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                toolbar: 'undo redo| bold italic underline strikethrough | bullist numlist indent outdent  | link image media table | align lineheight| emoticons charmap | removeformat | blocks fontfamily fontsize ',
                width: '100%',
                height: 300,
                readonly: 0
            });
        </script>

        <script>
            tinymce.init({
                selector: '#contthreedesc',
                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                toolbar: 'undo redo| bold italic underline strikethrough | bullist numlist indent outdent  | link image media table | align lineheight| emoticons charmap | removeformat | blocks fontfamily fontsize ',
                width: '100%',
                height: 300,
                readonly: 0
            });
        </script>

        <?php
            include "tmp/footer.php";
        }


        //*******************************************************
        //**********************  DO ADD  ***********************
        //*******************************************************
        function do_add(){
            global $PHP_SELF, $mysqli, $msg;
            global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
            global $programs_tablename, $progid, $progname, $progdesc, $isenabled, $cost, $charge, $accordian_header, $progtype;
            global $prog_det_tablename, $progdetid, $progid, $courseid, $coursecode, $coursename, $coursecredits;
            global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $coursedesc, $overview, $credits, $filename, $validcourse, $brief_desc, $course_photo, $course_cost, $course_discount, $hours, $videos, $cont_one, $cont_one_desc, $cont_two, $cont_two_desc, $cont_three, $cont_three_desc, $head_photo, $top_course;
            global $progcourses_tablename, $pgid, $progid, $courseid;

            include "tmp/globals.php";
            dbconnect();
            if (!$mysqli) {
                die("Connection failed: " . mysqli_connect_error());
            }
            
            $coursecode = $_POST['coursecode'];
            $coursename = stripslashes($_POST['coursename']);
            $coursedesc = stripslashes($_POST['coursedesc']);
            $overview = stripslashes($_POST['overview']);
            $credits = $_POST['credits'];
            $filename = $_POST['filename'];
            $validcourse = $_POST['validcourse'];
            $brief_desc = stripslashes($_POST['brief_desc']);
            $course_photo = $_POST['course_photo'];
            $course_cost = $_POST['course_cost'];
            $course_discount = $_POST['course_discount'];
            $hours = $_POST['hours'];
            $videos = $_POST['videos'];
            $cont_one = $_POST['cont_one'];
            $cont_one_desc = stripslashes($_POST['cont_one_desc']);
            $cont_two = $_POST['cont_two'];
            $cont_two_desc = stripslashes($_POST['cont_two_desc']);
            $cont_three = $_POST['cont_three'];
            $cont_three_desc = stripslashes($_POST['cont_three_desc']);
            $head_photo = $_POST['head_photo'];
            $top_course = $_POST['top_course'];
            
            $sql = $mysqli->query("INSERT INTO $courses_tablename VALUES(NULL, '0', '$coursecode', '$coursename', '$coursedesc', '$overview', '$credits', '$filename', '$validcourse', '$brief_desc', '$course_photo', '$course_cost', '$course_discount', '$hours', '$videos', '$cont_one', '$cont_one_desc', '$cont_two', '$cont_two_desc', '$cont_three', '$cont_three_desc', '$head_photo', '$top_course')");
            
            ?>
            <script type="text/javascript">
                <!--
                window.top.location.href = "courses.php"; 
                -->
            </script>
            <?php
        }


        //*******************************************************
        //******************  DO ADD LESSON  ********************
        //*******************************************************
        function do_add_lesson(){
            global $PHP_SELF, $mysqli, $msg;
            global $prog_det_tablename, $progdetid, $progid, $courseid, $coursecode, $coursename, $coursecredits;
            global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $coursedesc, $overview, $credits, $filename, $validcourse, $brief_desc, $course_photo, $course_cost, $course_discount, $hours, $videos, $cont_one, $cont_one_desc, $cont_two, $cont_two_desc, $cont_three, $cont_three_desc, $head_photo, $top_course;
            global $progcourses_tablename, $pgid, $progid, $courseid;
            global $courselessons_tablename, $lessonid, $courseid, $lessonnumber, $lessonname, $lessondetail, $videourl, $fileurl, $quizid, $isvalid;

            $courseid = $_POST['courseid'];
            $lessonnumber = $_POST['lessonnumber'];
            $lessonname = stripslashes($_POST['lessonname']);
            $lessondetail = stripslashes($_POST['lessondetail']);
            $videourl = stripslashes($_POST['videourl']);
            $fileurl = stripslashes($_POST['fileurl']);
            $quizid = $_POST['quizid'];
            $isvalid = $_POST['isvalid'];

            $sql = $mysqli->query("INSERT INTO $courselessons_tablename VALUES(NULL, '$courseid', '$lessonnumber', '$lessonname', '$lessondetail', '$videourl', '$fileurl', '$quizid', '$isvalid')");

            main_form();
        }


        //*******************************************************
        //**********************  DO ADD  ***********************
        //*******************************************************
        function add_course(){
            global $PHP_SELF, $mysqli, $msg;
            global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
            global $programs_tablename, $progid, $progname, $progdesc, $isenabled, $cost, $charge, $accordian_header, $progtype;
            global $prog_det_tablename, $progdetid, $progid, $courseid, $coursecode, $coursename, $coursecredits;
            global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $coursedesc, $overview, $credits, $filename, $validcourse, $brief_desc, $course_photo, $course_cost, $course_discount, $hours, $videos, $cont_one, $cont_one_desc, $cont_two, $cont_two_desc, $cont_three, $cont_three_desc, $head_photo, $top_course;
            global $progcourses_tablename, $pgid, $progid, $courseid;

            $progid = $_POST['progid'];
            $courseid = $_POST['courseid'];

            $sql = $mysqli->query("SELECT * FROM $courses_tablename WHERE courseid = '$courseid'");
            $row = $sql->fetch_assoc();
            $coursecode = $row['coursecode'];
            $coursename = stripslashes($row['coursename']);
            $coursedesc = stripslashes($row['coursedesc']);
            $credits = $row['credits'];
            $filename = $row['filename'];
            $validcourse = $row['validcourse'];

            $sql = $mysqli->query("INSERT INTO $prog_det_tablename VALUES(NULL, '$progid', '$courseid', '$coursecode', '$coursename', '$credits')");
            main_form();
        }


        //*******************************************************
        //**********************  DO ADD  ***********************
        //*******************************************************
        function delete_course(){
            global $PHP_SELF, $mysqli, $msg;
            global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
            global $programs_tablename, $progid, $progname, $progdesc, $isenabled, $cost, $charge, $accordian_header, $progtype;
            global $prog_det_tablename, $progdetid, $progid, $courseid, $coursecode, $coursename, $coursecredits;
            global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $coursedesc, $overview, $credits, $filename, $validcourse, $brief_desc, $course_photo, $course_cost, $course_discount, $hours, $videos, $cont_one, $cont_one_desc, $cont_two, $cont_two_desc, $cont_three, $cont_three_desc, $head_photo, $top_course;
            global $progcourses_tablename, $pgid, $progid, $courseid;

            include "tmp/globals.php";
            dbconnect();
            if (!$mysqli) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $courseid = $_POST['courseid'];

            $query = mysqli_query($mysqli, "DELETE FROM $courses_tablename WHERE courseid = '$courseid'");
            
            ?>
            <script type="text/javascript">
                <!--
                window.top.location.href = "courses.php"; 
                -->
            </script>
            <?php
        }


        //*******************************************************
        //******************  DELETE LESSON  ********************
        //*******************************************************
        function delete_lesson(){
            global $PHP_SELF, $mysqli, $msg;
            global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $coursedesc, $overview, $credits, $filename, $validcourse, $brief_desc, $course_photo, $course_cost, $course_discount, $hours, $videos, $cont_one, $cont_one_desc, $cont_two, $cont_two_desc, $cont_three, $cont_three_desc, $head_photo, $top_course;
            global $courselessons_tablename, $lessonid, $courseid, $lessonnumber, $lessonname, $lessondetail, $videourl, $fileurl, $quizid;

            $lessonid = $_POST['lessonid'];

            $query = mysqli_query($mysqli, "DELETE FROM $courselessons_tablename WHERE lessonid = '$lessonid'");

            main_form();
        }


        //*******************************************************
        //**********************  SWITCH  ***********************
        //*******************************************************
        switch ($action) {
            case "Delete":
                delete_course();
                break;
            case "Add Course":
                add_course();
                break;
            case "NewLesson":
                add_lesson();
                break;
            case "Submit":
                do_add();
                break;
            case "Save New Lesson":
                do_add_lesson();
                break;
            case "Done":
                do_edit();
                break;
            case "Save Changes":
                do_edit_lesson();
                break;
            case "View/Modify":
                header('Location: courses_modify.php?id='.$_POST['courseid']);
                // edit_record();
                break;
            case "DeleteLesson":
                delete_lesson();
                break;
            case "ModifyLesson":
                edit_lesson();
                break;
            case "Add New":
                add_new();
                break;
            default:
                main_form();
                break;
        }
            ?>