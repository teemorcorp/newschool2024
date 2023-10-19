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

    global $courselessons_tablename, $lessonid, $courseid, $lessonnumber, $lessonname, $lessondetail, $videourl, $fileurl, $qdetid, $isvalid;
    global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $coursedesc, $credits, $filename, $validcourse;
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
    
    $lessonid = $_GET['id'];

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
                                <h1>Modify Lesson</h1>
                                <center>
                                    <?php echo $_SESSION['msg']; ?>
                                    <br>
                                    
                                </center>
                                <br>
                                <?php
                                // Attempt select query execution
                                if ($result = $mysqli->query("SELECT * FROM $courselessons_tablename WHERE lessonid = '$lessonid'")) {
                                    if(mysqli_num_rows($result) > 0){
                                        $row = mysqli_fetch_array($result);
                                        $lessonid = $row['lessonid'];
                                        $courseid = $row['courseid'];
                                        $lessonnumber = $row['lessonnumber'];
                                        $lessonname = $row['lessonname'];
                                        $lessondetail = $row['lessondetail'];
                                        $videourl = $row['videourl'];
                                        $fileurl = $row['fileurl'];
                                        $qdetid = $row['qdetid'];
                                        $isvalid = $row['isvalid'];
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
                                        <font size="+2"><strong><?php echo $lessonname; ?></strong></font>
                                    </div>
                                    <div class="card-body">
                                        <form action="<?php echo $PHP_SELF ?>" method="post">

                                            <div class="mb-3">
                                                <label for="courseid" class="form-label">Course ID</label>
                                                <input type="test" name="courseid" class="form-control" id="courseid" value="<?php echo $courseid; ?>">
                                            </div>

                                            <div class="mb-3">
                                                <label for="lessonnumber" class="form-label">Lesson #</label>
                                                <input type="test" name="lessonnumber" class="form-control" id="lessonnumber" value="<?php echo $lessonnumber; ?>">
                                            </div>

                                            <div class="mb-3">
                                                <label for="lessonname" class="form-label">Course Name</label>
                                                <input type="test" name="lessonname" class="form-control" id="lessonname" value="<?php echo $lessonname; ?>">
                                            </div>

                                            <div class="mb-3">
                                                <label for="lessondetail" class="form-label">Lesson Details</label>
                                                <textarea name="lessondetail" class="form-control" id="lessondetail" rows="3"><?php echo $lessondetail; ?></textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label for="videourl" class="form-label">Video URL</label>
                                                <input type="test" name="videourl" class="form-control" id="videourl" value="<?php echo $videourl; ?>">
                                            </div>

                                            <div class="mb-3">
                                                <label for="fileurl" class="form-label">File URL</label>
                                                <input type="test" name="fileurl" class="form-control" id="fileurl" value="<?php echo $fileurl; ?>">
                                            </div>

                                            <!-- <div class="mb-3">
                                                <label for="qdetid" class="form-label">Quiz Detail ID</label>
                                                <input type="test" name="qdetid" class="form-control" id="qdetid" value="<?php echo $qdetid; ?>">
                                            </div> -->
                                            
                                            <?php
                                            // Attempt select query execution
                                            if ($result = $mysqli->query("SELECT quizname FROM $quizdet_tablename WHERE qdetid = '$qdetid'")) {
                                                if(mysqli_num_rows($result) > 0){
                                                    $row = mysqli_fetch_array($result);
                                                    $quizname = $row['quizname'];
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
                                                
                                            <label class="form-label">Quiz Name: </label>
                                            <select class="input_text mb-3" name="qdetid">
                                                <option value="<?php echo $qdetid; ?>"><?php echo $quizname; ?></option>
                                                <?php
                                                $sqlb = $mysqli->query("SELECT qdetid, quizname FROM $quizdet_tablename ORDER BY quizname ASC");
                                                $sqlb->data_seek(0);
                                                while($rowb = $sqlb->fetch_assoc()) {
                                                    $qdetid = $rowb['qdetid'];
                                                    $quizname = $rowb['quizname'];
                                                    
                                                ?>
                                                <option value="<?php echo $qdetid ?>"><?php echo $quizname ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>

                                            <div class="form-check mb-3">
                                                <div>
                                                    <strong>Enabled</strong>
                                                </div>
                                                <div>
                                                    <?php
                                                    if($isvalid == true){
                                                    ?>
                                                    <input type="radio" name="isvalid" value="1" checked> Yes
                                                    <input type="radio" name="isvalid" value="0"> No
                                                    <?php
                                                    }else{
                                                    ?>
                                                    <input type="radio" name="isvalid" value="1"> Yes
                                                    <input type="radio" name="isvalid" value="0" checked> No
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <input type="hidden" name="lessonid" value="<?php echo $lessonid; ?>">
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
            selector: '#lessondetail',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo| bold italic underline strikethrough | bullist numlist indent outdent  | link image media table | align lineheight| emoticons charmap | removeformat | blocks fontfamily fontsize ',
            width: '100%',
            height: 450,
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
    global $courselessons_tablename, $lessonid, $courseid, $lessonnumber, $lessonname, $lessondetail, $videourl, $fileurl, $qdetid, $isvalid;
    include "tmp/globals.php";
    dbconnect();
    if (!$mysqli) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // $g = filter_var($gfine, FILTER_SANITIZE_STRING);

    $lessonid = $_POST['lessonid'];
    $courseid = $_POST['courseid'];
    $lessonnumber = $_POST['lessonnumber'];
    $lessonname = addslashes($_POST['lessonname']);
    $lessondetail = addslashes($_POST['lessondetail']);
    $videourl = $_POST['videourl'];
    $fileurl = $_POST['fileurl'];
    $qdetid = $_POST['qdetid'];
    $isvalid = $_POST['isvalid'];
    // if($isvalid == "1"){
    //     echo "ON<br>";
    // }else{
    //     echo "OFF<br>";
    // }
    // echo "isvalid: ".$isvalid;
    // exit;
    
    $sql = "UPDATE $courselessons_tablename SET courseid = '$courseid', lessonnumber = '$lessonnumber', lessonname = '$lessonname', lessondetail = '$lessondetail', videourl = '$videourl', fileurl = '$fileurl', qdetid = '$qdetid', isvalid = '$isvalid' WHERE lessonid = '$lessonid'";
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

    header('Location: lessons.php');
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