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
    global $programs_tablename, $progid, $progname, $enabled, $cost, $charge;
    global $prog_det_tablename, $progdetid, $progid, $courseid, $coursecode, $coursename, $coursecredits;
    global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $coursedesc, $overview, $credits, $filename, $validcourse, $brief_desc, $course_photo, $course_cost, $course_discount, $hours, $videos, $cont_one, $cont_one_desc, $cont_two, $cont_two_desc, $cont_three, $cont_three_desc, $head_photo, $top_course;
    global $progcourses_tablename, $pgid, $progid, $courseid;
    global $courselessons_tablename, $lessonid, $courseid, $lessonnumber, $lessonname, $lessondetail, $videourl, $fileurl, $qdetid, $isvalid;
    global $exams_tablename, $examid, $excourseid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;
    global $quizzes_tablename, $quizid, $excourseid, $qdetid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;
    global $quizdet_tablename, $qdetid, $quizname, $courseid;
    
    // $msg = "test1";

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
    
    $courseid = $_GET['id'];

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

    <!-- <body> -->
    <div class="height-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2">
                    <?php
                    // menu();
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
                                <h1>Modify Course</h1>
                                <center>
                                    <?php echo $_SESSION['msg']; ?>
                                    <br>
                                    
                                </center>
                                <br>
                                <?php
                                // Attempt select query execution
                                if ($result = $mysqli->query("SELECT * FROM $courses_tablename WHERE courseid = '$courseid'")) {
                                    if(mysqli_num_rows($result) > 0){
                                        $row = mysqli_fetch_array($result);
                                        $cprogid = $row['cprogid'];
                                        $coursecode = $row['coursecode'];
                                        $coursename = $row['coursename'];
                                        $coursedesc = stripslashes($row['coursedesc']);
                                        $overview = stripslashes($row['overview']);
                                        $credits = $row['credits'];
                                        $filename = $row['filename'];
                                        $validcourse = $row['validcourse'];
                                        $brief_desc = $row['brief_desc'];
                                        $course_photo = $row['course_photo'];
                                        $course_cost = $row['course_cost'];
                                        $course_discount = $row['course_discount'];
                                        $hours = $row['hours'];
                                        $videos = $row['videos'];
                                        $cont_one = $row['cont_one'];
                                        $cont_one_desc = $row['cont_one_desc'];
                                        $cont_two = $row['cont_two'];
                                        $cont_two_desc = $row['cont_two_desc'];
                                        $cont_three = $row['cont_three'];
                                        $cont_three_desc = $row['cont_three_desc'];
                                        $head_photo = $row['head_photo'];
                                        $top_course = $row['top_course'];
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
                                <div class="card text-dark bg-light mb-1" id="boxdisplay">
                                    <div class="card-header">
                                        <font size="+2"><strong><?php echo $coursename; ?></strong></font>
                                    </div>
                                    <div class="card-body">
                                        <form action="<?php echo $PHP_SELF ?>" method="post">
                                            <div class="mb-3">
                                                <label for="coursecode" class="form-label">Course Code</label>
                                                <input type="test" name="coursecode" class="form-control" id="coursecode" value="<?php echo $coursecode; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="coursename" class="form-label">Course Name</label>
                                                <input type="test" name="coursename" class="form-control" id="coursename" value="<?php echo $coursename; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="coursedesc" class="form-label">Course Description</label>
                                                <textarea name="coursedesc" class="form-control" id="coursedesc" rows="3"><?php echo $coursedesc; ?></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="overview" class="form-label">Course Overview</label>
                                                <textarea name="overview" class="form-control" id="overview" rows="7"><?php echo $overview; ?></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="credits" class="form-label">Course Credits</label>
                                                <input type="test" name="credits" class="form-control" id="credits" value="<?php echo $credits; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="filename" class="form-label">Downloadable File Name</label>
                                                <input type="test" name="filename" class="form-control" id="filename" value="<?php echo $filename; ?>">
                                            </div>
                                            <!-- <div class="form-check mb-3">
                                                <input class="form-check-input" type="radio" name="validcourse" id="flexRadioDefault1">
                                                <label class="form-check-label" for="flexRadioDefault1">Is Enabled</label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="radio" name="validcourse" id="flexRadioDefault2" checked>
                                                <label class="form-check-label" for="flexRadioDefault2">Is Not Enabled</label>
                                            </div> -->
                                            <div class="form-check mb-3">
                                                <div>
                                                    <strong>Enabled</strong>
                                                </div>
                                                <div>
                                                    <?php
                                                    if($validcourse == true){
                                                    ?>
                                                    <input type="radio" name="validcourse" value="1" checked> Yes
                                                    <input type="radio" name="validcourse" value="0"> No
                                                    <?php
                                                    }else{
                                                    ?>
                                                    <input type="radio" name="validcourse" value="1"> Yes
                                                    <input type="radio" name="validcourse" value="0" checked> No
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="briefdesc" class="form-label">Brief Description</label>
                                                <textarea name="briefdesc" class="form-control" id="briefdesc" rows="3"><?php echo $brief_desc; ?></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <img style="width: 100px;" src="../img/school_books/<?php echo $course_photo; ?>" alt="<?php echo $coursename; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="coursecost" class="form-label">Course Cost</label>
                                                <input type="test" name="coursecost" class="form-control" id="coursecost" value="<?php echo $course_cost; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="coursediscount" class="form-label">Course Discount</label>
                                                <input type="test" name="coursediscount" class="form-control" id="coursediscount" value="<?php echo $course_discount; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="hours" class="form-label">Hours of Videos</label>
                                                <input type="test" name="hours" class="form-control" id="hours" value="<?php echo $hours; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="videos" class="form-label"># of Videos</label>
                                                <input type="test" name="videos" class="form-control" id="videos" value="<?php echo $videos; ?>">
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="contone" class="form-label">Content #1</label>
                                                <input type="test" name="contone" class="form-control" id="contone" value="<?php echo $cont_one; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="contonedesc" class="form-label">Brief Description</label>
                                                <textarea name="contonedesc" class="form-control" id="contonedesc" rows="3"><?php echo $cont_one_desc; ?></textarea>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="conttwo" class="form-label">Content #1</label>
                                                <input type="test" name="conttwo" class="form-control" id="conttwo" value="<?php echo $cont_two; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="conttwodesc" class="form-label">Brief Description</label>
                                                <textarea name="conttwodesc" class="form-control" id="conttwodesc" rows="3"><?php echo $cont_two_desc; ?></textarea>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="contthree" class="form-label">Content #1</label>
                                                <input type="test" name="contthree" class="form-control" id="contthree" value="<?php echo $cont_three; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="contthreedesc" class="form-label">Brief Description</label>
                                                <textarea name="contthreedesc" class="form-control" id="contthreedesc" rows="3"><?php echo $cont_three_desc; ?></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <img style="width: 100px;" src="../img/school_books/<?php echo $head_photo; ?>" alt="<?php echo $coursename; ?>">
                                            </div>
                                            <div class="form-check mb-3">
                                                <div>
                                                    <strong>Is Top Course</strong>
                                                </div>
                                                <div>
                                                    <?php
                                                    if($top_course == true){
                                                    ?>
                                                    <input type="radio" name="topcourse" value="1" checked> Yes
                                                    <input type="radio" name="topcourse" value="0"> No
                                                    <?php
                                                    }else{
                                                    ?>
                                                    <input type="radio" name="topcourse" value="1"> Yes
                                                    <input type="radio" name="topcourse" value="0" checked> No
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <input type="hidden" name="courseid" value="<?php echo $courseid; ?>">
                                            <button class="btn btn-primary btn-sm" name="action" type="submit" value="submit">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </section>


                        </div>
                    </div>
                </div>
            </div>

            <br><br>                    

    <script>
        tinymce.init({
            selector: '#overview',
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
//*******************  SUBMIT FORM  *********************
//*******************************************************
function submit_form(){
    global $PHP_SELF, $mysqli, $msg;
    global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $coursedesc, $overview, $credits, $filename, $validcourse, $brief_desc, $course_photo, $course_cost, $course_discount, $hours, $videos, $cont_one, $cont_one_desc, $cont_two, $cont_two_desc, $cont_three, $cont_three_desc, $head_photo, $top_course;
    include "tmp/globals.php";
    dbconnect();
    if (!$mysqli) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // $g = filter_var($gfine, FILTER_SANITIZE_STRING);

    $courseid = $_POST['courseid'];
    $coursecode = $_POST['coursecode'];
    $coursename = $_POST['coursename'];
    $coursedesc = stripslashes($_POST['coursedesc']);
    $overview = stripslashes($_POST['overview']);
    $credits = $_POST['credits'];
    $filename = $_POST['filename'];
    $validcourse = $_POST['validcourse'];
    // if($validcourse == "1"){
    //     echo "ON<br>";
    // }else{
    //     echo "OFF<br>";
    // }
    // echo "validcourse: ".$validcourse;
    // exit;
    $brief_desc = stripslashes($_POST['briefdesc']);
    $course_photo = $_POST['coursephoto'];
    $course_cost = $_POST['coursecost'];
    $course_discount = $_POST['coursediscount'];
    $hours = $_POST['hours'];
    $videos = $_POST['videos'];
    $cont_one = $_POST['contone'];
    $cont_one_desc = stripslashes($_POST['contonedesc']);
    $cont_two = $_POST['conttwo'];
    $cont_two_desc = stripslashes($_POST['conttwodesc']);
    $cont_three = $_POST['contthree'];
    $cont_three_desc = stripslashes($_POST['contthreedesc']);
    $head_photo = $_POST['headphoto'];
    $top_course = $_POST['topcourse'];
    // if($top_course == "1"){
    //     echo "ON<br>";
    // }else{
    //     echo "OFF<br>";
    // }
    // echo "top_course: ".$top_course;
    // exit;

    // $_SESSION['msg'] = "Test1";
    
    $sql = "UPDATE $courses_tablename SET coursecode = '$coursecode', coursename = '$coursename', coursedesc = '$coursedesc', credits = '$credits', filename = '$filename', validcourse = '$validcourse', brief_desc = '$brief_desc', course_photo = '$course_photo', course_cost = '$course_cost', course_discount = '$course_discount', hours = '$hours', videos = '$videos', cont_one = '$cont_one', cont_one_desc = '$cont_one_desc', cont_two = '$cont_two', cont_two_desc = '$cont_two_desc', cont_three = '$cont_three', cont_three_desc = '$cont_three_desc', head_photo = '$head_photo', top_course = '$top_course' WHERE courseid = '$courseid'";
    if (mysqli_query($mysqli, $sql)) {
        $msg = "<div class='alert alert-success' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>SUCCESS!</strong> Record updated successfully!
        </div>";
        $_SESSION['msg'] = "Test2";
        // main_form();
    } else {
        $msg = "<div class='alert alert-danger' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>ERROR!</strong> Error updating record: " . mysqli_error($mysqli) . "
        </div>";
        $_SESSION['msg'] = "Test3";
        // main_form();
    }

    $mysqli->close();

    header('Location: courses.php');
}

//*******************************************************
//**********************  SWITCH  ***********************
//*******************************************************
switch ($action) {
    case "submit":
        submit_form();
        break;
    default:
        main_form();
        break;
}
?>