<?php

/*************************************************************
 ** IHN Bible College Online
 ** Author: TJ Moore
 ** tjmooredev@gmail.com
 ** Copyright (c) 2001 - 2021 Thomas J. Moore, D.D.
 **************************************************************/
include 'includes/globals.php';
session_start();
db_connect();

if ($mysqli->connect_error) {
    echo 'Failed to connect to server: (' . $mysqli->connect_error . ') ' . $mysqli->connect_error;
}

// Grab action
if (isset($_POST['action'])) {
    $action = $_POST['action'];
} else {
    $action = '';
}

//*******************************************************
//*******************  MAIN FORM  ***********************
//*******************************************************
function main_form()
{
    global $PHP_SELF, $mysqli, $msg;
    global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
    global $messages_tablename, $msgid, $typeid, $msgtitle, $msgbody, $msgdate;

    $main_background_color = "#1c262f";
    $sub_background_color = "#26333c";
    $child_background_color = "#2f3d4a";

    $_SESSION['userid'] = "1";
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
            $userlname = $row['userlname'];
            $imagepath = $row['imagepath'];
            $fullname = $userfname . " " . $userlname;
            // Free result set
            mysqli_free_result($result);
        } else {
            $msg = "<font color='#FF0000'><strong>Account Does Not Exsist!</strong></font>";
            main_form();
            exit;
        }
    } else {
        echo "ERROR: Was not able to execute Query on line #152. " . mysqli_error($mysqli);
    }
    // End attempt select query execution

    if (!isset($msgid) or $msgid != $_SESSION['msgid']) {
        $msgid = $_GET['msgid'];
        $_SESSION['msgid'] = $msgid;
    } else {
        $msgid = $_SESSION['msgid'];
    }

    $sqla = $mysqli->query("SELECT * FROM $messages_tablename WHERE msgid = '$msgid'");
    //if(!$sqla) error_message("Error in $messages_tablename (quest_edit) line #50");
    $rowa = $sqla->fetch_assoc();
    $msgid = $rowa['msgid'];
    $typeid = $rowa['typeid'];
    $msgtitle = $rowa['msgtitle'];
    $msgbody = $rowa['msgbody'];

    include 'templates/include.tpl';
    include "templates/style.tpl";
?>
    <script>
        tinymce.init({
            selector: 'textarea#text-body',
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
            <?php
            include "templates/topmenu.tpl";
            ?>

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
                                <section style="padding-top:20px;">
                                    <h1>Edit Message</h1>
                                    <center>
                                        <?php echo $msg; ?>
                                        <br>
                                        <br>
                                        <div class="card text-dark bg-light mb-1" id="boxdisplay">
                                            <div class="card-header">
                                                <font size="+2"><strong>Message</strong></font>
                                            </div>
                                            <div class="card-body">
                                                <form action="<?php echo $PHP_SELF ?>" method="post">
                                                    <table class="table">
                                                        <tr>
                                                            <td>
                                                                <strong>MSG ID</strong>
                                                            </td>
                                                            <td>
                                                                <?php echo $msgid ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <strong>Type</strong>
                                                            </td>
                                                            <td>
                                                                <select class="input_text" name="typeid">
                                                                    <option value="<?php echo $typeid; ?>"><?php echo $typeid; ?></option>
                                                                    <option value="Home Room">Home Room</option>
                                                                    <option value="System">System</option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <strong>Msg Title</strong>
                                                            </td>
                                                            <td>
                                                                <input type="text" name="msgtitle" size="30" value="<?php echo $msgtitle ?>">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <strong>Msg Body</strong>
                                                            </td>
                                                            <td>
                                                                <textarea id="text-body" name="msgbody" cols="60"><?php echo $msgbody ?></textarea>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <p>&nbsp;</p>
                                                    <input type="hidden" name="msgid" value="<?php echo $msgid ?>">
                                                    <input type="hidden" name="msgdate" value="<?php echo $msgdate ?>">
                                                    <input class="btn btn-success" type="submit" name="action" value="Save Message" />
                                                    <input class="btn btn-danger" type="submit" name="action" value="Delete" />
                                                    <br /><br />
                                                </form>
                                            </div>
                                        </div>
                                    </center>

                                    <script>
                                        tinymce.init({
                                            selector: 'textarea#text-body',
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
                                </section>
                                <br><br>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <br><br>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="js/pushy.min.js"></script>
    </body>

    </html>
<?php
}


//*******************************************************
//*********************  SAVE EXAM  *********************
//*******************************************************
function save_message()
{
    global $PHP_SELF, $mysqli, $msg;
    global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
    global $messages_tablename, $msgid, $typeid, $msgtitle, $msgbody, $msgdate;

    $msgid = $_POST['msgid'];
    $typeid = $_POST['typeid'];
    $msgtitle = stripslashes($_POST['msgtitle']);
    $msgbody = stripslashes($_POST['msgbody']);
    $msgdate = date('Ymd');

    $query = $mysqli->query("UPDATE $messages_tablename SET typeid = '$typeid', msgtitle = '$msgtitle', msgbody = '$msgbody', msgbody = '$msgbody' WHERE msgid = '$msgid'");
    if (!$query) error_message("Error fetching data from $messages_tablename (quest_edit) line #510");

    $msg = "Updated!<br><br>";

?>
    <script type="text/javascript">
        <!--
        window.location = "homemsg.php"
        -->
    </script>
<?php
}

//*******************************************************
//********************  DELETE NOW  *********************
//*******************************************************
function delete_now()
{
    global $PHP_SELF, $mysqli, $msg;
    global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
    global $messages_tablename, $msgid, $typeid, $msgtitle, $msgbody, $msgdate;

    $msgid = $_POST['msgid'];
    $msgtitle = $_POST['msgtitle'];
    $_SESSION['msgid'] = $msgid;


?>
    <center>
        Are you sure you want to delete <strong><?php echo $msgtitle ?></strong> Message ID #<strong><?php echo $msgid ?></strong>?
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
function do_delete()
{
    global $PHP_SELF, $mysqli, $msg;
    global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
    global $messages_tablename, $msgid, $typeid, $msgtitle, $msgbody, $msgdate;

    $msgid = $_SESSION['msgid'];

    $query = $mysqli->query("DELETE FROM $messages_tablename WHERE msgid = '$msgid'");
    if (!$query) error_message("Error fetching data from $messages_tablename (quest_edit) line #588");

    $msg = "Updated!<br><br>";

    main_form();
}



//*******************************************************
//**********************  SWITCH  ***********************
//*******************************************************
switch ($action) {
    case "Delete":
        delete_now();
        break;
    case "Yes":
        do_delete();
        break;
    case "No":
        main_form();
        break;
    case "Save Message":
        save_message();
        break;
    default:
        main_form();
        break;
}
?>