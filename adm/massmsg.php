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

if($mysqli->connect_error) {
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
function main_form() {
global $PHP_SELF, $mysqli, $msg;
global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $corecompletedate, $messages;
global $system_tablename, $sysid, $president, $vice, $treasurer, $secretary, $directorafrica, $deanedu, $corecourses, $followers, $facebook, $twitter, $youtube, $linkedin, $info, $updatedate;

if(!empty($_SESSION['userid'] && $_SESSION['isadmin'])){
    $userid = $_SESSION['userid'];
}else{
    header('Location: ../index.php');
}

// Attempt select query execution
$sql = "SELECT * FROM $users_tablename WHERE userid = '$userid'";
if($result = mysqli_query($mysqli, $sql)){
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        $userid = $row['userid'];
        $useremail = $row['useremail'];
        $isadmin = $row['isadmin'];
        $userfname = $row['userfname'];
        $userlname = $row['userlname'];
        $imagepath = $row['imagepath'];
        $role = $row['role'];
        $_SESSION['role'] = $role;
        $fullname = $userfname." ".$userlname;
        // Free result set
        mysqli_free_result($result);
    } else{
        $msg = "<font color='#FF0000'><strong>Account Does Not Exsist!</strong></font>";
        main_form();
        exit;
    }
} else{
    echo "ERROR: Was not able to execute Query on line #39. " . mysqli_error($mysqli);
}
// End attempt select query execution

include 'templates/include.tpl';
include "templates/style.tpl";
?>
<!--script>
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
</script-->

<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
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
                        <?php
                        //echo "info: ".$info."<br>";
                        //echo "updatedate: ".$updatedate."<br>";
                        //exit;
                        ?>
                        <h1>Mass Message Students</h1>
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
                                                <textarea id="text-body" name="message" style="width: 100%;" rows="10"></textarea>
                                            </td>
                                        </tr>
                                    </table>
                                    <p>&nbsp;</p>
                                    <input class="btn btn-success" type="submit" name="action" value="Send Message" />
                                    <br /><br />
                                </form>
                            </div>
                        </div>
                        
                        <!--script>
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
                        </script-->
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
//*********************  SAVE INFO  *********************
//*******************************************************
function send_message(){
    global $PHP_SELF, $mysqli, $msg;
    global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $corecompletedate, $messages;
    global $studentmsg_tablename, $smid, $userid, $studentid, $message;

    $message = addslashes($_POST['message']);
    $userid = $_SESSION['userid'];

    // Attempt select query execution
    $sql = "SELECT userid FROM $users_tablename WHERE messages = '1'";
    if ($result = mysqli_query($mysqli, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $uid = $row['userid'];

                // Attempt select query execution
                $sqla = $mysqli->query("INSERT INTO $studentmsg_tablename VALUES (NULL, '$userid', '$uid', '$message')");
                if ($resulta = mysqli_query($mysqli, $sqla)) {
                    /*$msg = "<div class='alert alert-success' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    <strong>SUCCESS!</strong> Message has been sent!
                    </div>";*/
                }else{
                    $msg = "<div class='alert alert-danger' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    <strong>ERROR!</strong> Error sending messages: ".$mysqli->error."
                    </div>";
                }
                // End attempt select query execution
            }
            // Free result set
            mysqli_free_result($result);
        } else{
            $msg = "<br><div class='alert alert-danger' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
            <strong>ERROR!</strong> There was a problem sending message!<br>
            </div>";
            $msg = "<font color='#FF0000'><strong>Problem with sending message!</strong></font>";
            main_form();
            exit;
        }
    } else{
        echo "ERROR: Was not able to execute Query on line #39. " . mysqli_error($mysqli);
    }
    // End attempt select query execution

    $msg = "<div class='alert alert-success' role='alert'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>SUCCESS!</strong> Message has been sent!
    </div>";

    main_form();
}



//*******************************************************
//**********************  SWITCH  ***********************
//*******************************************************
switch($action) {
	case "Send Message":
		send_message();
	break;
	default:
		main_form();
	break;
}
?>