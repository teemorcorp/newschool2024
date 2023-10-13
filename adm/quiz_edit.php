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
    global $PHP_SELF, $mysqli, $msg;
    global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
    global $programs_tablename, $progid, $progname, $enabled, $cost, $charge;
    global $prog_det_tablename, $progdetid, $progid, $courseid, $coursecode, $coursename, $coursecredits;
    global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $coursedesc, $credits, $filename, $validcourse;
    global $progcourses_tablename, $pgid, $progid, $courseid;
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

    // $qdetid = $_GET['qdetid'];
    // $courseid = $_GET['courseid'];

    if(!isset($qdetid) or $qdetid != $_SESSION['qdetid']){
        $qdetid = $_GET['qdetid'];
        $_SESSION['qdetid'] = $qdetid;
    }else{
        $qdetid = $_SESSION['qdetid'];
    }

    if(!isset($courseid) or $courseid != $_SESSION['courseid']){
        $courseid = $_GET['courseid'];
        $_SESSION['courseid'] = $courseid;
    }else{
        $courseid = $_SESSION['courseid'];
    }

    $sqla = $mysqli->query("SELECT * FROM $quizdet_tablename WHERE qdetid = '$qdetid'");
    //if(!$sqla) error_message("Error in $quizzes_tablename (quest_edit) line #50");
    $rowa = $sqla->fetch_assoc();	
    $qdetid = $rowa['qdetid'];
    $quizname = $rowa['quizname'];
    $courseid = $rowa['courseid'];

    $sqlb = $mysqli->query("SELECT courseid, coursename FROM $courses_tablename WHERE courseid = '$courseid'");
    //if(!$sqlb) error_message("Error in $courses_tablename (quest_edit) line #50");
    $rowb = $sqlb->fetch_assoc();
    $courseidb = $rowb['courseid'];
    $coursename = $rowb['coursename'];
    ?>
    <body>
        <!-- <body> -->
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
                                <section style="padding-top:20px;">
                                    <h1>Quiz Management</h1>
                                    <center>
                                    <?php echo $msg; ?>
                                    <br>
                                    <br>
                                    <div class="card text-dark bg-light mb-1" id="boxdisplay">
                                        <div class="card-header">
                                            <font size="+2"><strong>Quiz Questions</strong></font>
                                        </div>
                                        <div class="card-body">
                                            <form action="<?php echo $PHP_SELF ?>" method="post">
                                                <table id="boxes" width="100%" cellpadding="10" cellspacing="10" align="left">
                                                    <tr>
                                                        <td width="75" align="right" valign="top">
                                                            <strong>Quiz ID</strong>
                                                        </td>
                                                        <td width="325" align="left" valign="top">
                                                            <?php echo $qdetid ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="75" align="right" valign="top">
                                                            <strong>Quiz Name</strong>
                                                        </td>
                                                        <td width="325" align="left" valign="top">
                                                            <input maxlength="50" name="quizname" size="30" type="text" value="<?php echo $quizname ?>" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="75" align="right" valign="top">
                                                            <strong>Course Name</strong>
                                                        </td>
                                                        <td width="325" align="left" valign="top">
                                                            <!--form action="< ?php echo $PHP_SELF ?>" method="post"-->
                                                                <select class="input_text" name="cid">
                                                                    <option value="<?php echo $courseid; ?>"><?php echo $coursename; ?></option>
                                                                    <?php
                                                                    $sqlb = $mysqli->query("SELECT courseid, coursename FROM $courses_tablename ORDER BY coursename ASC");
                                                                    //if(!$sqlb) error_message("Error in $courses_tablename (programs) line #263");
                                                                    $sqlb->data_seek(0);
                                                                    while($rowb = $sqlb->fetch_assoc()) {
                                                                        $cid = $rowb['courseid'];
                                                                        $cname = $rowb['coursename'];
                                                                    ?>
                                                                    <option value="<?php echo $cid ?>"><?php echo $cname ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            <!--/form-->
                                                        </td>
                                                    </tr>
                                                </table>
                                                <br /><br />
                                                <input type="hidden" name="qdetid" value="<?php echo $qdetid ?>">
                                                <!--input type="hidden" name="coursename" value="< ?php echo $coursename ?>"-->
                                                <input class="btn btn-success" type="submit" name="action" value="Save Quiz" />&nbsp;&nbsp;&nbsp;<input class="btn btn-danger" type="submit" name="action" value="Delete Quiz" />
                                                <br /><hr>
                                                <input type="hidden" name="courseid" value="<?php echo $courseid ?>">
                                                <input class="btn btn-success" type="submit" name="action" value="Add Question" />&nbsp;&nbsp;&nbsp;<input class="btn btn-success" type="submit" name="action" value="Print Questions" />
                                                <br><br>
                                            </form>
                                            <table Class="table table-striped">
                                                <tr>
                                                    <td>
                                                        <strong>Course ID</strong>
                                                    </td>
                                                    <td>
                                                        <strong>Quiz ID</strong>
                                                    </td>
                                                    <td>
                                                        <strong>Question #</strong>
                                                    </td>
                                                    <td>
                                                        <strong>Question</strong>
                                                    </td>
                                                    <td>
                                                        <strong>Correct Answer</strong>
                                                    </td>
                                                    <td style="width: 200px;">
                                                        <strong>Delete/Modify</strong>
                                                    </td>
                                                </tr>
                                                <?php
                                                $sqlb = $mysqli->query("SELECT * FROM $quizzes_tablename WHERE excourseid = '$courseid' AND qdetid = '$qdetid' ORDER BY questnumber ASC");
                                                //if(!$sqlb) error_message("Error in $quizzes_tablename (quest_edit) line #178");
                                                $sqlb->data_seek(0);
                                                while($rowb = $sqlb->fetch_assoc()) {
                                                    $quizid = $rowb['quizid'];
                                                    $excourseid = $rowb['excourseid'];
                                                    $qdetid = $rowb['qdetid'];
                                                    $instruct = $rowb['instruct'];
                                                    $questnumber = $rowb['questnumber'];
                                                    $question = $rowb['question'];
                                                    $ansone = $rowb['ansone'];
                                                    $anstwo = $rowb['anstwo'];
                                                    $ansthree = $rowb['ansthree'];
                                                    $ansfour = $rowb['ansfour'];
                                                    $correct = $rowb['correct'];
                                                    ?>
                                                    <tr>
                                                        <td style="width: 50px;">
                                                            <?php echo $quizid ?>
                                                        </td>
                                                        <td style="width: 50px;">
                                                            <?php echo $qdetid ?>
                                                        </td>
                                                        <td style="width: 50px;">
                                                            <?php echo $questnumber ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $question ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $correct ?>
                                                        </td>
                                                        <td>
                                                            <form action="<?php echo $PHP_SELF ?>" method="post">
                                                                <input type="hidden" name="coursename" value="<?php echo $coursename ?>">
                                                                <input type="hidden" name="quizid" value="<?php echo $quizid ?>">
                                                                <input type="hidden" name="quizname" value="<?php echo $quizname ?>">
                                                                <button style="width: 75px;" class="btn btn-primary btn-sm" type="submit" name="action" value="Edit">Edit</button> <button style="width: 75px;" class="btn btn-danger btn-sm" type="submit" name="action" value="Delete">Delete</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </table>
                                        </div>
                                    </div>
                                </section>
                
                                <div id="boxed" style="margin-top: 50px;">&nbsp;</div>                 

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <script>
        tinymce.init({
            selector: '#progdesc',
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
//*******************  ADD PROGRAM  *********************
//*******************************************************
function add_question(){

    global $PHP_SELF, $mysqli, $msg;
    global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
    global $programs_tablename, $progid, $progname, $enabled, $cost, $charge;
    global $prog_det_tablename, $progdetid, $progid, $courseid, $coursecode, $coursename, $coursecredits;
    global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $coursedesc, $credits, $filename, $validcourse;
    global $progcourses_tablename, $pgid, $progid, $courseid;
    global $exams_tablename, $examid, $excourseid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;
    global $quizzes_tablename, $quizid, $excourseid, $qdetid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;
    global $quizdet_tablename, $qdetid, $quizname, $courseid;

    include "tmp/header.php";
    dbconnect();
    if (!$mysqli) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $qdetid = $_POST['qdetid'];
    $courseid = $_POST['courseid'];
    ?>
    <!-- <body> -->
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
                            <div id="boxed" style="margin-top: 10px;">
                                <h1>Quiz Management</h1>
                                <center>
                                <?php echo $msg; ?>
                                <br>
                                </center>
                                <br>
                                <form action="<?php echo $PHP_SELF ?>" method="post">

                                    <div class="mb-3 row">
                                        <label for="instruct" class="col-sm-1 col-form-label">Instructions:</label>
                                        <div class="col-sm-11">
                                            <textarea class="form-control" id="instruct" rows="3" name="instruct"></textarea>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="questnumber" class="col-sm-1 col-form-label">Question #:</label>
                                        <div class="col-sm-11">
                                            <input type="text" name="questnumber" class="form-control" id="questnumber" style="width: 50px;">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="question" class="col-sm-1 col-form-label">Question:</label>
                                        <div class="col-sm-11">
                                            <textarea class="form-control" id="question" rows="3" name="question"></textarea>
                                        </div>
                                    </div>
                                        
                                    <div class="mb-3 row">
                                        <label for="ansone" class="col-sm-1 col-form-label">Answer #1</label>
                                        <div class="col-sm-11">
                                            <input type="text" class="form-control" id="ansone" name="ansone" required>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 row">
                                        <label for="anstwo" class="col-sm-1 col-form-label">Answer #2</label>
                                        <div class="col-sm-11">
                                            <input type="text" class="form-control" id="anstwo" name="anstwo" required>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 row">
                                        <label for="ansthree" class="col-sm-1 col-form-label">Answer #3</label>
                                        <div class="col-sm-11">
                                            <input type="text" class="form-control" id="ansthree" name="ansthree">
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 row">
                                        <label for="ansfour" class="col-sm-1 col-form-label">Answer #4</label>
                                        <div class="col-sm-11">
                                            <input type="text" class="form-control" id="ansfour" name="ansfour">
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 row">
                                        <label for="correct" class="col-sm-2 col-form-label">Number For Correct Answer</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="correct" name="correct" style="width: 50px;">
                                        </div>
                                    </div>

                                    <input type="hidden" name="qdetid" value="<?php echo $qdetid ?>">
                                    <input type="hidden" name="courseid" value="<?php echo $courseid ?>">
                                    <input class="btn btn-success" style="width: 150px;" name="action" type="submit" value="Save New Question" />
                                </form>
                            </div>
                
                            <div id="boxed" style="margin-top: 50px;">&nbsp;</div>                 

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        tinymce.init({
            selector: '#instruct',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo| bold italic underline strikethrough | bullist numlist indent outdent  | link image media table | align lineheight| emoticons charmap | removeformat | blocks fontfamily fontsize ',
            width: '100%',
            height: 200,
            readonly: 0
        });
    </script>
    
    <script>
        tinymce.init({
            selector: '#question',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo| bold italic underline strikethrough | bullist numlist indent outdent  | link image media table | align lineheight| emoticons charmap | removeformat | blocks fontfamily fontsize ',
            width: '100%',
            height: 200,
            readonly: 0
        });
    </script>

    <?php
    include "tmp/footer.php";
}


//*******************************************************
//*******************  ADD PROGRAM  *********************
//*******************************************************
function add_now(){
	global $PHP_SELF, $mysqli, $msg;
	global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
	global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $credits, $filename, $validcourse;
	global $exams_tablename, $examid, $excourseid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;
    global $quizzes_tablename, $quizid, $excourseid, $qdetid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;
    global $quizdet_tablename, $qdetid, $quizname, $courseid;

    include "tmp/globals.php";
    dbconnect();
    if (!$mysqli) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $qdetid = $_POST['qdetid'];
    $excourseid = $_POST['courseid'];
    $quizname = "";
    $instruct = addslashes($_POST['instruct']);
    $questnumber = $_POST['questnumber'];
    $question = addslashes($_POST['question']);
    $ansone = addslashes($_POST['ansone']);
    $anstwo = addslashes($_POST['anstwo']);
    $ansthree = addslashes($_POST['ansthree']);
    $ansfour = addslashes($_POST['ansfour']);
    $correct = $_POST['correct'];

	$sql = $mysqli->query("INSERT INTO $quizzes_tablename VALUES(NULL, '$excourseid', '$qdetid', '$instruct', '$questnumber', '$question', '$ansone', '$anstwo', '$ansthree', '$ansfour', '$correct')");
    
    ?>
    <script type="text/javascript">
        <!--
        // window.top.location.href = "quiz_edit.php?qdetid=".$qdetid."&courseid=".$excourseid; 
        window.top.location.href = "quizzes.php"; 
        -->
    </script>
    <?php
}


//*******************************************************
//*******************  EDIT PROGRAM  ********************
//*******************************************************
function edit_now(){

    global $PHP_SELF, $mysqli, $msg;
    global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
    global $programs_tablename, $progid, $progname, $enabled, $cost, $charge;
    global $prog_det_tablename, $progdetid, $progid, $courseid, $coursecode, $coursename, $coursecredits;
    global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $coursedesc, $credits, $filename, $validcourse;
    global $progcourses_tablename, $pgid, $progid, $courseid;
    global $exams_tablename, $examid, $excourseid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;
    global $quizzes_tablename, $quizid, $excourseid, $qdetid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct, $isvalid;
    global $quizdet_tablename, $qdetid, $quizname, $courseid;

    include "tmp/header.php";
    dbconnect();
    if (!$mysqli) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $coursename = $_POST['coursename'];
    $quizid = $_POST['quizid'];

    $sqla = $mysqli->query("SELECT * FROM $quizzes_tablename WHERE quizid = '$quizid'");
    //if(!$sqla) error_message("Error in $quizzes_tablename (quest_edit) line #50");
    $rowa = $sqla->fetch_assoc();	
    $quizid = $rowa['quizid'];
    $excourseid = $rowa['excourseid'];
    $instruct = $rowa['instruct'];
    $questnumber = $rowa['questnumber'];
    $question = $rowa['question'];
    $ansone = $rowa['ansone'];
    $anstwo = $rowa['anstwo'];
    $ansthree = $rowa['ansthree'];
    $ansfour = $rowa['ansfour'];
    $correct = $rowa['correct'];
    $isvalid = $rowa['isvalid'];
    ?>
    <body><!-- <body> -->
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
                            <div id="boxed" style="margin-top: 10px;">
                                <h1>Edit Questions</h1>
                                <center>
                                <?php echo $msg; ?>
                                <br>
                                </center>
                                <br>
                                <form action="<?php echo $PHP_SELF ?>" method="post">

                                    <div class="mb-3 row">
                                        <label for="questnumber" class="col-sm-1 col-form-label">Quiz ID:</label>
                                        <div class="col-sm-11">
                                            <?php echo $quizid ?>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="instruct" class="col-sm-1 col-form-label">Instructions:</label>
                                        <div class="col-sm-11">
                                            <textarea class="form-control" id="instruct" rows="3" name="instruct"><?php echo $instruct ?></textarea>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="questnumber" class="col-sm-1 col-form-label">Question #:</label>
                                        <div class="col-sm-11">
                                            <input type="text" name="questnumber" class="form-control" id="questnumber" style="width: 50px;" value="<?php echo $questnumber ?>">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="question" class="col-sm-1 col-form-label">Question:</label>
                                        <div class="col-sm-11">
                                            <textarea class="form-control" id="question" rows="3" name="question"><?php echo $question ?></textarea>
                                        </div>
                                    </div>
                                        
                                    <div class="mb-3 row">
                                        <label for="ansone" class="col-sm-1 col-form-label">Answer #1</label>
                                        <div class="col-sm-11">
                                            <input type="text" class="form-control" id="ansone" name="ansone" value="<?php echo $ansone ?>" required>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="anstwo" class="col-sm-1 col-form-label">Answer #2</label>
                                        <div class="col-sm-11">
                                            <input type="text" class="form-control" id="anstwo" name="anstwo" value="<?php echo $anstwo ?>" required>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="ansthree" class="col-sm-1 col-form-label">Answer #3</label>
                                        <div class="col-sm-11">
                                            <input type="text" class="form-control" id="ansthree" name="ansthree" value="<?php echo $ansthree ?>">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="ansfour" class="col-sm-1 col-form-label">Answer #4</label>
                                        <div class="col-sm-11">
                                            <input type="text" class="form-control" id="ansfour" name="ansfour" value="<?php echo $ansfour ?>">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="correct" class="col-sm-2 col-form-label">Number For Correct Answer</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="correct" name="correct" style="width: 50px;" value="<?php echo $correct ?>">
                                        </div>
                                    </div>
                                    
                                    <input type="hidden" name="coursename" value="<?php echo $coursename ?>">
                                    <input type="hidden" name="quizid" value="<?php echo $quizid ?>">
                                    <input class="btn btn-success" name="action" type="submit" value="Save Question" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="btn btn-danger" type="submit" name="action" value="Delete" />
                                </form>
                            </div>
                
                            <div id="boxed" style="margin-top: 50px;">&nbsp;</div>                 

                        </div>
                    </div>
                    
                </div>
            </div>   
        </div>
    </div>

    <script>
        tinymce.init({
            selector: '#instruct',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo| bold italic underline strikethrough | bullist numlist indent outdent  | link image media table | align lineheight| emoticons charmap | removeformat | blocks fontfamily fontsize ',
            width: '100%',
            height: 200,
            readonly: 0
        });
    </script>

    <script>
        tinymce.init({
            selector: '#question',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo| bold italic underline strikethrough | bullist numlist indent outdent  | link image media table | align lineheight| emoticons charmap | removeformat | blocks fontfamily fontsize ',
            width: '100%',
            height: 200,
            readonly: 0
        });
    </script>

    <?php
    include "tmp/footer.php";
}


//*******************************************************
//*********************  SAVE NOW  **********************
//*******************************************************
function save_question(){
	global $PHP_SELF, $mysqli, $msg;
	global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
	global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $credits, $filename, $validcourse;
	global $exams_tablename, $examid, $excourseid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;
    global $quizzes_tablename, $quizid, $excourseid, $qdetid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;
    global $quizdet_tablename, $qdetid, $quizname, $courseid;

    include "tmp/globals.php";
    dbconnect();
    if (!$mysqli) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $quizid = $_POST['quizid'];
    $instruct = addslashes($_POST['instruct']);
    $questnumber = $_POST['questnumber'];
    $question = addslashes($_POST['question']);
    $ansone = addslashes($_POST['ansone']);
    $anstwo = addslashes($_POST['anstwo']);
    $ansthree = addslashes($_POST['ansthree']);
    $ansfour = addslashes($_POST['ansfour']);
    $correct = $_POST['correct'];

    // echo "quizid: ".$quizid."<br>";
    // echo "instruct: ".$instruct."<br>";
    // echo "questnumber: ".$questnumber."<br>";
    // echo "question: ".$question."<br>";
    // echo "ansone: ".$ansone."<br>";
    // echo "anstwo: ".$anstwo."<br>";
    // echo "ansthree: ".$ansthree."<br>";
    // echo "ansfour: ".$ansfour."<br>";
    // echo "correct: ".$correct."<br>";
    // exit;

    $query = $mysqli->query("UPDATE $quizzes_tablename SET instruct = '$instruct', questnumber = '$questnumber', question = '$question', ansone = '$ansone', anstwo = '$anstwo', ansthree = '$ansthree', ansfour = '$ansfour', correct = '$correct' WHERE quizid = '$quizid'");
    //if(!$query) error_message("Error fetching data from $quizzes_tablename (quest_edit) line #487");
    
    ?>
    <script type="text/javascript">
        <!--
        // window.top.location.href = "quiz_edit.php?qdetid=".$qdetid."&courseid=".$excourseid; 
        window.top.location.href = "quizzes.php"; 
        -->
    </script>
    <?php
}

//*******************************************************
//*********************  SAVE EXAM  *********************
//*******************************************************
function save_quiz(){
	global $PHP_SELF, $mysqli, $msg;
	global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
    global $quizdet_tablename, $qdetid, $quizname, $courseid;

    include "tmp/globals.php";
    dbconnect();
    if (!$mysqli) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $qdetid = $_POST['qdetid'];
    $quizname = $_POST['quizname'];
    $cid = $_POST['cid'];

    $query = $mysqli->query("UPDATE $quizdet_tablename SET quizname = '$quizname', courseid = '$cid' WHERE qdetid = '$qdetid'");

    ?>
    <script type="text/javascript">
        <!--
        window.top.location.href = "quizzes.php"; 
        -->
    </script>
    <?php
}

//*******************************************************
//********************  DELETE NOW  *********************
//*******************************************************
function delete_now(){
	global $PHP_SELF, $mysqli, $msg;
	global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
	global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $credits, $filename, $validcourse;
	global $exams_tablename, $examid, $excourseid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;
    global $quizzes_tablename, $quizid, $excourseid, $qdetid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct, $isvalid;
    global $quizdet_tablename, $qdetid, $quizname, $courseid;

    include "tmp/globals.php";
    dbconnect();
    if (!$mysqli) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $quizid = $_POST['quizid'];
    $quizname = $_POST['quizname'];
    $coursename = $_POST['coursename'];

    $query = mysqli_query($mysqli, "DELETE FROM $quizzes_tablename WHERE quizid = '$quizid'");
    if(!$query){
        echo ("Error fetching data from $quizzes_tablename (delete_prod) line #768");
        exit;
    }

    ?>
    <script type="text/javascript">
        <!--
        window.top.location.href = "quizzes.php"; 
        -->
    </script>
    <?php
}

//*******************************************************
//********************  DELETE NOW  *********************
//*******************************************************
function delete_quiz(){
	global $PHP_SELF, $mysqli, $msg;
    global $quizdet_tablename, $qdetid, $quizname, $courseid;
    
    include "tmp/globals.php";
    dbconnect();
    if (!$mysqli) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $qdetid = $_POST['qdetid'];

    $query = mysqli_query($mysqli, "DELETE FROM $quizdet_tablename WHERE qdetid = '$qdetid'");
    if(!$query){
        echo ("Error fetching data from $quizdet_tablename (delete_prod) line #768");
        exit;
    }
    ?>
    <script type="text/javascript">
        <!--
        window.top.location.href = "quizzes.php"; 
        -->
    </script>
    <?php
}

//*******************************************************
//*********************  SAVE EXAM  *********************
//*******************************************************
function print_questions(){
	global $PHP_SELF, $mysqli, $msg;
	global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
	global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $credits, $filename, $validcourse;
	global $exams_tablename, $examid, $excourseid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;
    global $quizzes_tablename, $quizid, $excourseid, $qdetid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct, $isvalid;
    global $quizdet_tablename, $qdetid, $quizname, $courseid;

    $progid = $_POST['cprogid'];
    $courseid = $_POST['courseid'];
    ?>

    <script language="JavaScript">
        function printSpecial(){
            var gAutoPrint = true; // Tells whether to automatically call the print function
            if (document.getElementById != null){
                var html = '<HTML>\n<HEAD>\n';

                if (document.getElementsByTagName != null){
                    var headTags = document.getElementsByTagName("head");
                    if (headTags.length > 0) html += headTags[0].innerHTML;
                }

                html += '\n</HE>\n<BODY>\n';

                var printReadyElem = document.getElementById("printReady");

                if (printReadyElem != null){
                    html += printReadyElem.innerHTML;
                }else{
                    alert("Could not find the printReady function");
                    return;
                }

                html += '\n</BO>\n</HT>';

                var printWin = window.open("","printSpecial");
                printWin.document.open();
                printWin.document.write(html);
                printWin.document.close();
                if (gAutoPrint) printWin.print();
            }else{
                alert("The print ready feature is only available if you are using an browser. Please update your browswer.");
            }
        }
    </script>

    <form id="printMe" name="printMe"> <input type="button" name="printMe" onClick="printSpecial()" value="Print this Page"></form>
    <form action="possearch.php?userid=<?php echo $userid ?>" method="post" style="text-align: center">
    <div id="printReady">
    <?php
    $sqla = $mysqli->query("SELECT coursename FROM $courses_tablename WHERE courseid = '$courseid'");
    //if(!$sqla) error_message("Error in $courses_tablename (quest_edit) line #610");
    $rowa = $sqla->fetch_assoc();	
    $coursename = $rowa['coursename'];
    ?>
    <h1><?php echo $coursename ?></h1>
    <table id="boxes" width="100%" cellpadding="2" cellspacing="0" align="center">
        <?php
        $sqlb = $mysqli->query("SELECT * FROM $exams_tablename WHERE excourseid = '$courseid' ORDER BY questnumber ASC");
        //if(!$sqlb) error_message("Error in $exams_tablename (quest_edit) line #618");
        $sqlb->data_seek(0);
        while($rowb = $sqlb->fetch_assoc()) {
            $examid = $rowb['examid'];
            $instruct = $rowb['instruct'];
            $questnumber = $rowb['questnumber'];
            $question = $rowb['question'];
            $ansone = $rowb['ansone'];
            $anstwo = $rowb['anstwo'];
            $ansthree = $rowb['ansthree'];
            $ansfour = $rowb['ansfour'];
            $correct = $rowb['correct'];
        ?>
            <tr>
                <td align="right" valign="top" width="10%">
                    Question #:
                </td>
                <td align="left" valign="top" width="40%">
                    <font size="+2"><strong><?php echo $questnumber ?></strong></font>
                </td>
                <td align="right" valign="top" width="10%">
                    Exam ID:
                </td>
                <td align="left" valign="top" width="40%">
                    <strong><?php echo $examid ?></strong>
                </td>
            </tr>
            <tr>
                <td align="right" valign="top">
                    Course ID:
                </td>
                <td align="left" valign="top">
                    <strong><?php echo $courseid ?></strong>
                </td>
                <td align="right" valign="top">
                    Correct #:
                </td>
                <td align="left" valign="top">
                    <strong><?php echo $correct ?></strong>
                </td>
            </tr>
            <tr>
                <td align="right" valign="top">
                    Instructions:
                </td>
                <td align="left" valign="top">
                    <strong><?php echo $instruct ?></strong>
                </td>
                <td align="right" valign="top">
                    Question:
                </td>
                <td align="left" valign="top">
                    <strong><?php echo $question ?></strong>
                </td>
            </tr>
            <tr>
                <td align="right" valign="top">
                    Answer #1:
                </td>
                <td align="left" valign="top">
                    <strong><?php echo $ansone ?></strong>
                </td>
                <td align="right" valign="top">
                    Answer #2:
                </td>
                <td align="left" valign="top">
                    <strong><?php echo $anstwo ?></strong>
                </td>
            </tr>
            <tr>
                <td align="right" valign="top">
                    Answer #3:
                </td>
                <td align="left" valign="top">
                    <strong><?php echo $ansthree ?></strong>
                </td>
                <td align="right" valign="top">
                    Answer #4:
                </td>
                <td align="left" valign="top">
                    <strong><?php echo $ansfour ?></strong>
                </td>
            </tr>
            <tr>
                <td align="right" valign="top" colspan="4">
                    <hr>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
    <br /><br />
    </div> 
    </form>
<?php
}


//*******************************************************
//**********************  SWITCH  ***********************
//*******************************************************
switch($action) {
	case "Delete":
		delete_now();
	break;
	case "Yes":
		do_delete();
	break;
	case "No":
		main_form();
	break;
	case "Edit":
		edit_now();
	break;
	case "Add Question":
		add_question();
	break;
	case "Print Questions":
		print_questions();
	break;
	case "Save New Question":
		add_now();
	break;
	case "Save Question":
		save_question();
	break;
	case "Save Quiz":
		save_quiz();
	break;
	case "Delete Quiz":
		delete_quiz();
	break;
	default:
		main_form();
	break;
}
?>