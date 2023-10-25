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
    global $notes_tablename, $noteid, $newstitle, $news, $eventtitle, $events, $schedtitle, $schedule, $newtitle, $newadded;

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
    $sql = "SELECT newstitle, news FROM $notes_tablename";
    if ($result = mysqli_query($mysqli, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            $newstitle = $row['newstitle'];
            $news = $row['news'];
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
                    <div class="card-group">
                        <div class="card">
                            <form action="<?php echo $PHP_SELF ?>" method="post">
                                <div class="card-body release-body-height">
                                    <h4 class="card-title"><input type="text" name="newstitle" id="newstitle" value="<?php echo $newstitle; ?>"></h4>
                                    <textarea name="news" id="coursenews" style="width: 100%; height: 400px;"><?php echo $news; ?></textarea>
                                </div>
                                <div class="card-footer">
                                    <div class="d-grid gap-2">
                                        <span class="d-inline-block btn-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-custom-class="custom-popover" data-bs-trigger="hover focus" data-bs-title="Help" data-bs-content="Whatever you enter into this area will replace the current notes. You can make changes to existing notes or delete all and enter new notes.">
                                        <button name="action" type="submit" style="width: 100%;" class="btn btn-success btn-block" value="updatenews">Update Current Notes</button>
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
            selector: '#coursenews',
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
function current_news(){
    global $PHP_SELF, $mysqli, $msg;
    global $notes_tablename, $noteid, $newstitle, $news, $eventtitle, $events, $schedtitle, $schedule, $newtitle, $newadded;
    include 'tmp/globals.php';
    session_start();
    dbconnect();
    if (!$mysqli) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $newstitle = addslashes($_POST['newstitle']);
    $news = addslashes($_POST['news']);

    if (empty($newstitle) || $newstitle == null) {
        $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>
        <button type='button' class='close' data-bs-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>ERROR!</strong> Error updating Current Notes: Empty Current Notes field.
        </div>";
        main_form();
    }

    // Attempt select query execution
    $sql = "UPDATE $notes_tablename SET newstitle = '$newstitle', news = '$news'";
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
    case "updatenews":
        current_news();
        break;
    default:
        main_form();
    break;
}

?>