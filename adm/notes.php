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
	global $PHP_SELF, $mysqli, $msg, $conn, $notice, $notice_header, $notice_body;
    global $system_tablename, $sysid, $president , $vice, $treasurer, $secretary, $directorafrica, $deanedu, $corecourses, $followers, $facebook, $twitter, $youtube, $linkedin, $info, $updatedate, $cookietime, $sysadminver, $verdate, $releasenotes, $currentnotes, $goalamt, $curgoal;
    global $users_tablename, $userid, $useremail , $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $corecompletedate, $branchid, $role, $messages, $core_complete, $resetpwd;
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

    // *******************************************************************************************
    // ********   NOTES
    // *******************************************************************************************

    // Attempt select query execution
    $sql = "SELECT * FROM $notes_tablename";
    if($result = mysqli_query($mysqli, $sql)){
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            $noteid = $row['noteid'];
            $newstitle = $row['newstitle'];
            $news = $row['news'];
            $eventtitle = $row['eventtitle'];
            $events = $row['events'];
            $schedtitle = $row['schedtitle'];
            $schedule = $row['schedule'];
            $newtitle = $row['newtitle'];
            $newadded = $row['newadded'];
            // Free result set
            mysqli_free_result($result);
        } else{
            $msg = "<font color='#FF0000'><strong>Account Does Not Exsist!</strong></font>";
        }
    } else{
        echo "ERROR: Was not able to execute Query on line #152. " . mysqli_error($mysqli);
    }
    // End attempt select query execution
    
    /*************************************************************************
    **  RELEASE NOTES MODAL
    *************************************************************************/
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

                        <div id="boxed" class="card" style="margin-right: 10px;">
                            <form action="<?php echo $PHP_SELF ?>" method="post">
                                <div class="card-body release-body-height">
                                    <h4 class="card-title"><input type="text" name="newstitle" value="<?php echo $newstitle; ?>"></h4>
                                    <textarea name="news" id="currentnews" style="width: 100%; height: 400px;"><?php echo $news; ?></textarea>
                                </div>
                                <div class="card-footer">
                                    <div class="d-grid gap-2">
                                        <button name="action" type="submit" value="updatenews" class="btn btn-success btn-block">Update <?php echo $newstitle; ?></button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div id="boxed" class="card" style="margin-left: 10px;">
                            <form action="<?php echo $PHP_SELF ?>" method="post">
                                <div class="card-body release-body-height">
                                    <h4 class="card-title"><input type="text" name="eventtitle" value="<?php echo $eventtitle; ?>"></h4>
                                    <textarea name="events" id="events" style="width: 100%; height: 400px;"><?php echo $events; ?></textarea>
                                </div>
                                <div class="card-footer">
                                    <div class="d-grid gap-2">
                                        <button name="action" type="submit" value="updateevents" class="btn btn-success btn-block">Update <?php echo $eventtitle; ?></button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>

                    <div class="card-group">

                        <div id="boxed" class="card" style="margin-right: 10px;">
                            <form action="<?php echo $PHP_SELF ?>" method="post">
                                <div class="card-body release-body-height">
                                    <h4 class="card-title"><input type="text" name="schedtitle" value="<?php echo $schedtitle; ?>"></h4>
                                    <textarea name="schedule" id="schedule" style="width: 100%; height: 400px;"><?php echo $schedule; ?></textarea>
                                </div>
                                <div class="card-footer">
                                    <div class="d-grid gap-2">
                                        <button name="action" type="submit" value="updateschedule" class="btn btn-success btn-block">Update <?php echo $schedtitle; ?></button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div id="boxed" class="card" style="margin-left: 10px;">
                            <form action="<?php echo $PHP_SELF ?>" method="post">
                                <div class="card-body release-body-height">
                                    <h4 class="card-title"><input type="text" name="newtitle" value="<?php echo $newtitle; ?>"></h4>
                                    <textarea name="newadded" id="newadd" style="width: 100%; height: 400px;"><?php echo $newadded; ?></textarea>
                                </div>
                                <div class="card-footer">
                                    <div class="d-grid gap-2">
                                        <button name="action" type="submit" value="updateadded" class="btn btn-success btn-block">Update <?php echo $newtitle; ?></button>
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
            selector: '#currentnews',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo| bold italic underline strikethrough | bullist numlist indent outdent  | link image media table | align lineheight| emoticons charmap | removeformat | blocks fontfamily fontsize ',
            width: '100%',
            height: 420,
            readonly: 0
        });
    </script>

    <script>
        tinymce.init({
            selector: '#events',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo| bold italic underline strikethrough | bullist numlist indent outdent  | link image media table | align lineheight| emoticons charmap | removeformat | blocks fontfamily fontsize ',
            width: '100%',
            height: 420,
            readonly: 0
        });
    </script>

    <script>
        tinymce.init({
            selector: '#schedule',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo| bold italic underline strikethrough | bullist numlist indent outdent  | link image media table | align lineheight| emoticons charmap | removeformat | blocks fontfamily fontsize ',
            width: '100%',
            height: 420,
            readonly: 0
        });
    </script>

    <script>
        tinymce.init({
            selector: '#newadd',
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
//******************  UPDATE NEWS  **********************
//*******************************************************
function update_news(){
    include "tmp/config.php";
    global $PHP_SELF, $mysqli, $msg, $con, $dbhost, $dbuser, $dbpwd, $dbname;
    global $notes_tablename, $noteid, $newstitle, $news, $eventtitle, $events, $schedtitle, $schedule, $newtitle, $newadded;

    $newstitle = filter_var(addslashes($_POST['newstitle']), FILTER_SANITIZE_STRING);
    $news = filter_var(addslashes($_POST['news']), FILTER_SANITIZE_STRING);

    if (empty($news) || $news == null) {
        $msg = "<div class='alert alert-danger' role='alert'>
        <button type='button' class='close' data-bs-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>ERROR!</strong> Error updating news: Empty release notes field.
        </div>";
        main_form();
    }

    // Create connection
    $conn = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        exit;
    }

    $id = 1;
    $sql = "UPDATE notes SET newstitle=?, news=? WHERE noteid=?";
    $stmt= $conn->prepare($sql);
    $stmt->bind_param("ssi", $newstitle, $news, $id);
    $stmt->execute();

    main_form();
}

//*******************************************************
//******************  UPDATE EVENTS  **********************
//*******************************************************
function update_events(){
    include "tmp/config.php";
    global $PHP_SELF, $mysqli, $msg, $con, $dbhost, $dbuser, $dbpwd, $dbname;
    global $notes_tablename, $noteid, $newstitle, $news, $eventtitle, $events, $schedtitle, $schedule, $newtitle, $newadded;

    $eventtitle = filter_var(addslashes($_POST['eventtitle']), FILTER_SANITIZE_STRING);
    $events = filter_var(addslashes($_POST['events']), FILTER_SANITIZE_STRING);

    if (empty($events) || $events == null) {
        $msg = "<div class='alert alert-danger' role='alert'>
        <button type='button' class='close' data-bs-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>ERROR!</strong> Error updating events: Empty release notes field.
        </div>";
        main_form();
    }

    // Create connection
    $conn = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $id = 1;
    $sql = "UPDATE notes SET eventtitle=?, events=? WHERE noteid=?";
    $stmt= $conn->prepare($sql);
    $stmt->bind_param("ssi", $eventtitle, $events, $id);
    $stmt->execute();

    main_form();
}

//*******************************************************
//******************  UPDATE SCHEDULE  ******************
//*******************************************************
function update_schedule(){
    include "tmp/config.php";
    global $PHP_SELF, $mysqli, $msg, $con, $dbhost, $dbuser, $dbpwd, $dbname;
    global $notes_tablename, $noteid, $newstitle, $news, $eventtitle, $events, $schedtitle, $schedule, $newtitle, $newadded;

    $schedtitle = filter_var(addslashes($_POST['schedtitle']), FILTER_SANITIZE_STRING);
    $schedule = filter_var(addslashes($_POST['schedule']), FILTER_SANITIZE_STRING);

    if (empty($schedule) || $schedule == null) {
        $msg = "<div class='alert alert-danger' role='alert'>
        <button type='button' class='close' data-bs-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>ERROR!</strong> Error updating schedule: Empty release notes field.
        </div>";
        main_form();
    }

    // Create connection
    $conn = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $id = 1;
    $sql = "UPDATE notes SET schedtitle=?, schedule=? WHERE noteid=?";
    $stmt= $conn->prepare($sql);
    $stmt->bind_param("ssi", $schedtitle, $schedule, $id);
    $stmt->execute();

    main_form();
}

//*******************************************************
//******************  UPDATE ADDED  **********************
//*******************************************************
function update_added(){
    include "tmp/config.php";
    global $PHP_SELF, $mysqli, $msg, $con, $dbhost, $dbuser, $dbpwd, $dbname;
    global $notes_tablename, $noteid, $newstitle, $news, $eventtitle, $events, $schedtitle, $schedule, $newtitle, $newadded;

    $newtitle = filter_var(addslashes($_POST['newtitle']), FILTER_SANITIZE_STRING);
    $newadded = filter_var(addslashes($_POST['newadded']), FILTER_SANITIZE_STRING);

    if (empty($newadded) || $newadded == null) {
        $msg = "<div class='alert alert-danger' role='alert'>
        <button type='button' class='close' data-bs-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>ERROR!</strong> Error updating newadded: Empty release notes field.
        </div>";
        main_form();
    }

    // Create connection
    $conn = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $id = 1;
    $sql = "UPDATE notes SET newtitle=?, newadded=? WHERE noteid=?";
    $stmt= $conn->prepare($sql);
    $stmt->bind_param("ssi", $newtitle, $newadded, $id);
    $stmt->execute();

    main_form();
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
    case "updatenews":
        update_news();
        break;
    case "updateevents":
        update_events();
        break;
    case "updateschedule":
        update_schedule();
        break;
    case "updateadded":
        update_added();
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