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
    $sql = "SELECT eventtitle, events FROM $notes_tablename";
    if ($result = mysqli_query($mysqli, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            $eventtitle = $row['eventtitle'];
            $events = $row['events'];
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
                                    <h4 class="card-title"><input type="text" name="eventtitle" id="eventtitle" value="<?php echo $eventtitle; ?>"></h4>
                                    <textarea name="events" id="coursenews" style="width: 100%; height: 400px;"><?php echo $events; ?></textarea>
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

    $eventtitle = addslashes($_POST['eventtitle']);
    $events = addslashes($_POST['events']);

    if (empty($eventtitle) || $eventtitle == null) {
        $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>
        <button type='button' class='close' data-bs-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>ERROR!</strong> Error updating Current Notes: Empty Current Notes field.
        </div>";
        main_form();
    }

    // Attempt select query execution
    $sql = "UPDATE $notes_tablename SET eventtitle = '$eventtitle', events = '$events'";
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