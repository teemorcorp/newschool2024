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
    
    $courseid = $_GET['courseid'];

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
            main_form();
            exit;
        }
    } else{
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
                            <h1>Exam Management</h1>
                            <?php echo $msg; ?>
                            <br>
                            <br>
                            <div class="card text-dark bg-light mb-1" id="boxdisplay">
                                <div class="card-header">
                                    <font size="+2"><strong>Exam Questions</strong></font>
                                </div>
                                <div class="card-body text-left">
                                    <form action="<?php echo $PHP_SELF ?>" method="post">
                                        <div class="mb-3">
                                            <label for="courseid" class="form-label">Course ID</label> <?php echo $courseid ?>
                                        </div>

                                        <div class="mb-3">
                                            <label for="cprogid" class="form-label">Program ID</label> <?php echo $cprogid ?>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="coursecode" class="col-sm-2 col-form-label">Course Code</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="coursecode" id="coursecode" style="width: 100px;" value="<?php echo $coursecode ?>">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="coursename" class="col-sm-2 col-form-label">Course Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="coursename" id="coursename" style="width: 250px;" value="<?php echo $coursename ?>">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="credits" class="col-sm-2 col-form-label">Course Credits</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="credits" id="credits" style="width: 50px;" value="<?php echo $credits ?>">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="filename" class="col-sm-2 col-form-label">File Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="filename" id="filename" style="width: 300px;" value="<?php echo $filename ?>">
                                            </div>
                                        </div>

                                        <div class="form-check mb-3" style="align-items: left;">
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
                                        <br /><br />
                                        <input type="hidden" name="cprogid" value="<?php echo $cprogid ?>">
                                        <input type="hidden" name="courseid" value="<?php echo $courseid ?>">
                                        <input class="btn btn-success" type="submit" name="action" value="Save Exam" />
                                    </form>
                                    <br /><br />
                                    <form action="<?php echo $PHP_SELF ?>" method="post">
                                        <input type="hidden" name="courseid" value="<?php echo $courseid ?>">
                                        <input type="hidden" name="cprogid" value="<?php echo $cprogid ?>">
                                        <input class="btn btn-success" type="submit" name="action" value="Add Question" />&nbsp;&nbsp;&nbsp;<input class="btn btn-success" type="submit" name="action" value="Print Questions" />
                                        <br><br>
                                    </form>
                                    <table Class="table table-striped">
                                        <tr>
                                            <td>
                                                <strong>CID</strong>
                                            </td>
                                            <td>
                                                <strong>EID</strong>
                                            </td>
                                            <td>
                                                <strong>Q #</strong>
                                            </td>
                                            <td>
                                                <strong>Question</strong>
                                            </td>
                                            <td>
                                                <strong>Ans</strong>
                                            </td>
                                            <td>
                                                <strong>Delete/Modify</strong>
                                            </td>
                                        </tr>
                                        <?php
                                        $sqlb = $mysqli->query("SELECT * FROM $exams_tablename WHERE excourseid = '$courseid' ORDER BY questnumber ASC");
                                        //if(!$sqlb) error_message("Error in $exams_tablename (quest_edit) line #178");
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
                                                <td>
                                                    <?php echo $courseid ?>
                                                </td>
                                                <td>
                                                    <?php echo $examid ?>
                                                </td>
                                                <td>
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
                                                        <input type="hidden" name="examid" value="<?php echo $examid ?>">
                                                        <button class="btn btn-primary" type="submit" name="action" value="Edit">Edit</button>
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
                        </div>
                    
                        <div id="boxed" style="margin-top: 50px;">&nbsp;</div>                 

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

    $progid = $_POST['cprogid'];
    $courseid = $_POST['courseid'];
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
                    <?php
                    echo $_SESSION['msg'];
                    $_SESSION['msg'] = "";
                    ?>
                    <br>
                    <div id="boxed">
                        <div class="row " style="padding-top:10px;">
                            <div class="col-12">
                                <!-- *******************************************************************************************
                                **********  POPULAR PRODUCTS
                                *********************************************************************************************-->
                                <section name="Website Options" style="padding-top:20px;">
                                    <h1>Add Question</h1>
                                    <br>
                                    <form action="<?php echo $PHP_SELF ?>" method="post">
                                        <div class="mb-3 row">
                                            <label for="instruct" class="col-sm-2 col-form-label">Instructions</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" id="instruct" name="instruct"></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3 row">
                                            <label for="questnumber" class="col-sm-2 col-form-label">Question #</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="questnumber" style="width: 50px;" name="questnumber" required>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="question" class="col-sm-2 col-form-label">Question</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" id="question" name="question"></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3 row">
                                            <label for="ansone" class="col-sm-2 col-form-label">Answer #1</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="ansone" name="ansone" required>
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3 row">
                                            <label for="anstwo" class="col-sm-2 col-form-label">Answer #2</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="anstwo" name="anstwo" required>
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3 row">
                                            <label for="ansthree" class="col-sm-2 col-form-label">Answer #3</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="ansthree" name="ansthree">
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3 row">
                                            <label for="ansfour" class="col-sm-2 col-form-label">Answer #4</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="ansfour" name="ansfour">
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3 row">
                                            <label for="correct" class="col-sm-2 col-form-label">Number For Correct Answer</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="correct" name="correct" style="width: 50px;">
                                            </div>
                                        </div>
                                        
                                        <input type="hidden" name="cprogid" value="<?php echo $cprogid ?>">
                                        <input type="hidden" name="courseid" value="<?php echo $courseid ?>">
                                        <input class="btn btn-primary btn-sm" style="width: 150px;" name="action" type="submit" value="Save New Question" />
                                    </form>
                                </section>
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
            selector: '#instruct',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo| bold italic underline strikethrough | bullist numlist indent outdent  | link image media table | align lineheight| emoticons charmap | removeformat | blocks fontfamily fontsize ',
            width: '100%',
            height: 420,
            readonly: 0
        });
    </script>

<script>
    tinymce.init({
        selector: '#question',
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
function add_now(){
	global $PHP_SELF, $mysqli, $msg;
	global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
	global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $credits, $filename, $validcourse;
	global $exams_tablename, $examid, $excourseid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;

    $progid = $_POST['cprogid'];
    $courseid = $_POST['courseid'];
    $instruct = addslashes($_POST['instruct']);
    $questnumber = $_POST['questnumber'];
    $question = addslashes($_POST['question']);
    $ansone = addslashes($_POST['ansone']);
    $anstwo = addslashes($_POST['anstwo']);
    $ansthree = addslashes($_POST['ansthree']);
    $ansfour = addslashes($_POST['ansfour']);
    $correct = $_POST['correct'];

	$sql = $mysqli->query("INSERT INTO $exams_tablename VALUES(NULL, '$courseid', '$instruct', '$questnumber', '$question', '$ansone', '$anstwo', '$ansthree', '$ansfour', '$correct')");
	//if(!$sql) error_message("Error fetching data from $exams_tablename (quest_edit) line #353");


    main_form();
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
    
    $main_background_color = "#1c262f";
    $sub_background_color = "#26333c"; 
    $child_background_color = "#2f3d4a";

    $coursename = $_POST['coursename'];
    $examid = $_POST['examid'];

    $sqla = $mysqli->query("SELECT * FROM $exams_tablename WHERE examid = '$examid'");
    //if(!$sqla) error_message("Error in $exams_tablename (quest_edit) line #50");
    $rowa = $sqla->fetch_assoc();	
    $cprogid = $rowa['cprogid'];
    $excourseid = $rowa['excourseid'];
    $instruct = $rowa['instruct'];
    $questnumber = $rowa['questnumber'];
    $question = $rowa['question'];
    $ansone = $rowa['ansone'];
    $anstwo = $rowa['anstwo'];
    $ansthree = $rowa['ansthree'];
    $ansfour = $rowa['ansfour'];
    $correct = $rowa['correct'];
    
    include 'templates/include.tpl';
    include "templates/style.tpl";
    ?>
    <body>
<div class='container-fluid'>
    <div style="height: 60px;">
        <div class="row" style="background-color: #a90329; background-image: linear-gradient(to bottom, #00c3ff, #0084ff); height: 60px; padding-top: 0px;">
            <div class="col-sm-6" align="left" style="padding-top: 0px;">
                <a class="navbar-brand" href="#">
                <img src="img/IHN_Logo_1000x1000_trans.png" style="height: 40px; margin-top: 5px;"><font color="#ffffff" style="margin-bottom: 40px;"><strong>IHN BIBLE COLLEGE</strong></font>
                </a>
            </div>
            <div class="col-sm-6" align="right" style="padding-top: 10px;">
                <img src="img/tom1.jpg" width="40px;" style="border-radius: 50%;">&nbsp;&nbsp;&nbsp;<font color="#ffffff"><strong>Administrator</strong>&nbsp;&nbsp;&nbsp;<i class="fas fa-cog" style="margin-top: 10px;"></i></font>
            </div>
        </div>
    </div>

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
                    

                    <!-- *******************************************************************************************
                    **********  POPULAR PRODUCTS
                    *********************************************************************************************-->
                    <section name="Website Options" style="padding-top:20px;">
                        <h1>Edit Questions</h1>
                        <center>
                        <?php echo $msg; ?>
                        <br>
                        </center>
                        <br>
        
                        <center>
                        <form action="<?php echo $PHP_SELF ?>" method="post">
                            <table width="600" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="300" align="left" valign="top">
                                        Exam ID:
                                    </td>
                                    <td width="300" align="left" valign="top">
                                        <?php echo $examid ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top">
                                        Instructions:
                                    </td>
                                    <td align="left" valign="top">
                                        <textarea cols="60" rows="5" name="instruct" type="text" /><?php echo $instruct ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top">
                                        Question #:
                                    </td>
                                    <td align="left" valign="top">
                                        <input maxlength="3" name="questnumber" size="3" type="text" value="<?php echo $questnumber ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top">
                                        Question:
                                    </td>
                                    <td align="left" valign="top">
                                        <textarea cols="60" rows="5" name="question" type="text" /><?php echo $question ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top">
                                        Answer 1:
                                    </td>
                                    <td align="left" valign="top">
                                        <input maxlength="255" name="ansone" size="60" type="text" value="<?php echo $ansone ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top">
                                        Answer 2:
                                    </td>
                                    <td align="left" valign="top">
                                        <input maxlength="255" name="anstwo" size="60" type="text" value="<?php echo $anstwo ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top">
                                        Answer 3:
                                    </td>
                                    <td align="left" valign="top">
                                        <input maxlength="255" name="ansthree" size="60" type="text" value="<?php echo $ansthree ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top">
                                        Answer 4:
                                    </td>
                                    <td align="left" valign="top">
                                        <input maxlength="255" name="ansfour" size="60" type="text" value="<?php echo $ansfour ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top">
                                        Correct Answer:
                                    </td>
                                    <td align="left" valign="top">
                                        <input maxlength="3" name="correct" size="3" type="text" value="<?php echo $correct ?>" />
                                    </td>
                                </tr>
                            </table>
                            <input type="hidden" name="coursename" value="<?php echo $coursename ?>">
                            <input type="hidden" name="examid" value="<?php echo $examid ?>">
                            <input class="btn btn-success" name="action" type="submit" value="Save Question" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="btn btn-danger" type="submit" name="action" value="Delete" />
                        </form>
                    </section>
                    <br><br>

                </div>
            </div>
        </div>
    </div>
</section>                    

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
//*********************  SAVE NOW  **********************
//*******************************************************
function save_question(){
	global $PHP_SELF, $mysqli, $msg;
	global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
	global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $credits, $filename, $validcourse;
	global $exams_tablename, $examid, $excourseid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;

    $examid = $_POST['examid'];
    $instruct = addslashes($_POST['instruct']);
    $questnumber = $_POST['questnumber'];
    $question = addslashes($_POST['question']);
    $ansone = addslashes($_POST['ansone']);
    $anstwo = addslashes($_POST['anstwo']);
    $ansthree = addslashes($_POST['ansthree']);
    $ansfour = addslashes($_POST['ansfour']);
    $correct = $_POST['correct'];

    $query = $mysqli->query("UPDATE $exams_tablename SET instruct = '$instruct', questnumber = '$questnumber', question = '$question', ansone = '$ansone', anstwo = '$anstwo', ansthree = '$ansthree', ansfour = '$ansfour', correct = '$correct' WHERE examid = '$examid'");
    //if(!$query) error_message("Error fetching data from $exams_tablename (quest_edit) line #487");

    $msg = "Updated!<br><br>";

    main_form();
}

//*******************************************************
//*********************  SAVE EXAM  *********************
//*******************************************************
function save_exam(){
	global $PHP_SELF, $mysqli, $msg;
	global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
	global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $coursedesc, $overview, $credits, $filename, $validcourse, $brief_desc, $course_photo, $course_cost, $course_discount, $hours, $videos, $cont_one, $cont_one_desc, $cont_two, $cont_two_desc, $cont_three, $cont_three_desc, $head_photo, $top_course;
	global $exams_tablename, $examid, $excourseid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;
    
    include "tmp/globals.php";
    dbconnect();
    if (!$mysqli) {
        die("Connection failed: " . mysqli_connect_error());
    }

echo "Line #663<br>";
    $cprogid = $_POST['cprogid'];
    $courseid = $_POST['courseid'];
    $coursecode = $_POST['coursecode'];
    $coursename = addslashes($_POST['coursename']);
    $credits = $_POST['credits'];
    $filename = $_POST['filename'];
    $validcourse = $_POST['validcourse'];

echo "Line #672<br>";
    
    $sql = "UPDATE $courses_tablename SET coursecode = '$coursecode', coursename = '$coursename', credits = '$credits', filename = '$filename', validcourse = '$validcourse' WHERE courseid = '$courseid'";
echo "Line #675<br>";
    if (mysqli_query($mysqli, $sql)) {
echo "Line #677<br>";
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
echo "Line #692<br>";

    $mysqli->close();

    // $query = $mysqli->query("UPDATE $courses_tablename SET coursecode = '$coursecode', coursename = '$coursename', credits = '$credits', filename = '$filename', validcourse = '$validcourse' WHERE courseid = '$courseid'");
    // //if(!$query) error_message("Error fetching data from $courses_tablename (quest_edit) line #510");

echo "Line #699<br>";
    $msg = "Updated!<br><br>";

    //main_form();
    //header('Location: select_exam.php?progid=<?php echo $progid; ? >');
    header('Location: exams.php');
    /*
    ?>
    <script type="text/javascript">
        <!--
        window.location = "select_exam.php?progid=<?php echo $progid; ?>"
        -->
    </script>
    <?php
    */
}

//*******************************************************
//********************  DELETE NOW  *********************
//*******************************************************
function delete_now(){
	global $PHP_SELF, $mysqli, $msg;
	global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
	global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $credits, $filename, $validcourse;
	global $exams_tablename, $examid, $excourseid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;

    $examid = $_POST['examid'];
    $coursename = $_POST['coursename'];

    $_SESSION['examid'] = $examid;
    $_SESSION['coursename'] = $coursename;


    ?>
    <center>
    Are you sure you want to delete <strong><?php echo $coursename ?></strong> exam ID #<strong><?php echo $examid ?></strong>?
    <br><br>
    <form action="<?php echo $PHP_SELF ?>" method="post">
        <input class="button_gradient_drk_red" name="action" type="submit" value="Yes" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="button_gradient_blue" type="submit" name="action" value="No" />
    </form>
    </center>
    <?php
}



//*******************************************************
//********************  DELETE NOW  *********************
//*******************************************************
function do_delete(){
	global $PHP_SELF, $mysqli, $msg;
	global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
	global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $credits, $filename, $validcourse;
	global $exams_tablename, $examid, $excourseid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;

    $examid = $_SESSION['examid'];
    $coursename = $_SESSION['coursename'];

    //echo "examid = ".$examid."<br>";
    //echo "coursename = ".$coursename."<br>";
    //exit;

    $query = $mysqli->query("DELETE FROM $exams_tablename WHERE examid = '$examid'");
    //if(!$query) error_message("Error fetching data from $exams_tablename (quest_edit) line #588");

    $msg = "Updated!<br><br>";

    main_form();
}



//*******************************************************
//*********************  SAVE EXAM  *********************
//*******************************************************
function print_questions(){
	global $PHP_SELF, $mysqli, $msg;
	global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
	global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $credits, $filename, $validcourse;
	global $exams_tablename, $examid, $excourseid, $instruct, $questnumber, $question, $ansone, $anstwo, $ansthree, $ansfour, $correct;

    $progid = $_POST['cprogid'];
    $courseid = $_POST['courseid'];
    ?>
    <script language="JavaScript">
    var gAutoPrint = true; // Tells whether to automatically call the print function

    function printSpecial()
    {
    if (document.getElementById != null)
    {
    var html = '<HTML>\n<HEAD>\n';

    if (document.getElementsByTagName != null)
    {
    var headTags = document.getElementsByTagName("head");
    if (headTags.length > 0)
    html += headTags[0].innerHTML;
    }

    html += '\n</HE>\n<BODY>\n';

    var printReadyElem = document.getElementById("printReady");

    if (printReadyElem != null)
    {
    html += printReadyElem.innerHTML;
    }
    else
    {
    alert("Could not find the printReady function");
    return;
    }

    html += '\n</BO>\n</HT>';

    var printWin = window.open("","printSpecial");
    printWin.document.open();
    printWin.document.write(html);
    printWin.document.close();
    if (gAutoPrint)
    printWin.print();
    }
    else
    {
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
	case "Save Exam":
		save_exam();
	break;
	default:
		main_form();
	break;
}
?>