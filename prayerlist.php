<?php
/****************************************************
****   IHN Bible College
****   Designed by: Tom Moore
****   Written by: Tom Moore
****   (c) 2001 - 2021 TEEMOR eBusiness Solutions
****************************************************/
session_start();

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
	global $PHP_SELF, $mysqli, $msg, $notice, $status, $fullname;
    global $system_tablename, $sysid, $president , $vice, $treasurer, $secretary, $directorafrica, $deanedu, $corecourses, $followers, $facebook, $twitter, $youtube, $linkedin, $info, $updatedate, $cookietime, $sysadminver, $verdate, $releasenotes, $currentnotes, $goalamt, $curgoal;
    global $users_tablename, $userid, $useremail , $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $corecompletedate, $branchid, $role, $messages, $core_complete, $resetpwd;
    global $menuid, $goal, $current, $pct, $userid;
    global $prayers_tablename, $prayerid, $prayee, $prayer_request, $answered;

    include "tmp/header.php";
    information_modal();

    if(!empty($_SESSION['userid'])){
        $userid = $_SESSION['userid'];
    }

    $status = $_SESSION['answered'];

    // $_SESSION['answered'] = "";
    ?>
    <div class="height-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2"><?php menu(); ?></div>
                <div class="col-sm-10">
                    <br>
                    <div id="boxed">
                        <div class="row ml-12 mr-12 clearfix">
                            <p class="text-center"><span style="font-size: 32px;">Join Us In Prayer</span></p>
                                <p>
                                    <?php
                                    echo $_SESSION['msg']."<br>";
                                    $_SESSION['msg'] = "";
                                    ?>
                                </p>
                            <div class="col-sm-2"></div>
                            <div class="col-sm-2 text-center">
                                <form action="<?php echo $PHP_SELF; ?>" method="post">
                                    <button name="action" type="submit" class="btn btn-primary btn-sm" value="add_prayer">Add Prayer Request</button>
                                </form>
                            </div>
                            <div class="col-sm-2 text-center">
                                <form action="<?php echo $PHP_SELF; ?>" method="post">
                                    <button name="action" type="submit" class="btn btn-primary btn-sm" value="answered_only">View Answered Only</button>
                                </form>
                            </div>
                            <div class="col-sm-2 text-center">
                                <form action="<?php echo $PHP_SELF; ?>" method="post">
                                    <button name="action" type="submit" class="btn btn-primary btn-sm" value="unanswered_only">View Unanswered Only</button>
                                </form>
                            </div>
                            <div class="col-sm-2 text-center">
                                <form action="<?php echo $PHP_SELF; ?>" method="post">
                                    <button name="action" type="submit" class="btn btn-primary btn-sm" value="allrequests">View All Requests</button>
                                </form>
                            </div>
                            <div class="col-sm-2"></div>
                        </div>

                        <div class="row" style="margin-top: 20px;">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-6 text-center">
                                <?php
                                if(!isset($_SESSION['pages'])) {
                                    $_SESSION['pages'] = 25;
                                }
                                
                                if ($_SESSION['pages'] <= 1) {
                                    $_SESSION['pages'] = 25;
                                }

                                if(!isset($_SESSION['perpage'])) {
                                    $perpage = 25;
                                    $_SESSION['perpage'] = $perpage;
                                } else {
                                    $perpage = $_SESSION['perpage'];
                                }
                                
                                if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
                                $start_from = ($page-1) * $perpage; 
                                
                                // Attempt select query execution
                                if($status == 0){
                                    $sql = "SELECT COUNT(*) AS 'TotalItems' FROM $prayers_tablename WHERE answered = 0";
                                }elseif($status == 1){
                                    $sql = "SELECT COUNT(*) AS 'TotalItems' FROM $prayers_tablename WHERE answered = 1";
                                }elseif($status == 2){
                                    $sql = "SELECT COUNT(*) AS 'TotalItems' FROM $prayers_tablename";
                                }else{
                                    $sql = "SELECT COUNT(*) AS 'TotalItems' FROM $prayers_tablename";
                                }

                                // $sql = "SELECT COUNT(*) AS 'TotalItems' FROM $prayers_tablename";
                                if($result = mysqli_query($mysqli, $sql)){
                                    if(mysqli_num_rows($result) > 0){
                                        $row = mysqli_fetch_array($result);
                                        $total_records = $row['TotalItems'];
                                        // Free result set
                                        mysqli_free_result($result);
                                    } else{
                                        $msg = "<font color='#FF0000'><strong>No Records Found!</strong></font>";
                                        main_form();
                                        exit;
                                    }
                                } else{
                                    echo "ERROR: Was not able to execute Query on line #145. " . mysqli_error($mysqli);
                                }
                                // End attempt select query execution

                                $total_pages = ceil($total_records / $perpage);
                                ?>
                                <center>
                                <form method="post" action="<?php echo $PHP_SELF ?>">
                                    Records Per Page
                                    <select name="perpage" >
                                        <option value="10" selected="">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                    <input type="submit" value="GO" name="action">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total Items: &nbsp;<?php echo $total_records; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <?php 
                                    $prevpage = ($page - 1);
                                    if ($prevpage < 1) {
                                    } else {
                                        echo "<a href='$PHP_SELF?page=".$prevpage."&userid=".$userid."&username=".$username."&userfname=".$userfname."'>PREVIOUS</a>";
                                    }
                                    ?>
                                    Page &nbsp;<?php echo $page; ?> of &nbsp;<?php echo $total_pages; ?>
                                    <?php 
                                    $nextpage = ($page + 1);
                                    if ($nextpage > $total_pages) {
                                    } else {
                                        echo "<a href='$PHP_SELF?page=".$nextpage."&userid=".$userid."&username=".$username."&userfname=".$userfname."'>NEXT</a>";
                                    }
                                    ?>
                                </form>
                                </center>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>

                        <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8">
                                <table class="table">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Person in Need</th>
                                        <th scope="col">Request</th>
                                        <th scope="col">Answered?</th>
                                    </tr>
                                    <?php
                                    // Attempt select query execution
                                    if($status == 0){
                                        $sql = "SELECT * FROM $prayers_tablename WHERE answered = 0";
                                    }elseif($status == 1){
                                        $sql = "SELECT * FROM $prayers_tablename WHERE answered = 1";
                                    }elseif($status == 2){
                                        $sql = "SELECT * FROM $prayers_tablename";
                                    }else{
                                        $sql = "SELECT * FROM $prayers_tablename";
                                    }
                                    if($result = mysqli_query($mysqli, $sql)){
                                        if(mysqli_num_rows($result) > 0){
                                            while($row = mysqli_fetch_array($result)){
                                                $prayerid = $row['prayerid'];
                                                $prayee = $row['prayee'];
                                                $prayer_request = $row['prayer_request'];
                                                $answered = $row['answered'];
                                                ?>
                                                <tr>
                                                    <td><?php echo $prayerid; ?></td>
                                                    <td><?php echo $prayee; ?></td>
                                                    <td><?php echo $prayer_request; ?></td>
                                                    <td>
                                                        <form action="<?php echo $PHP_SELF; ?>" method="post">
                                                            <?php
                                                            if($answered){
                                                                ?>
                                                                <input type="hidden" name="answeredid" value="<?php echo $prayerid; ?>">
                                                                <button name="action" type="submit" class="btn btn-success btn-sm" style="width; 100%;" value="answered">ANSWERED</button>
                                                                <?php
                                                            }else{
                                                                ?>
                                                                <input type="hidden" name="answeredid" value="<?php echo $prayerid; ?>">
                                                                <button name="action" type="submit" class="btn btn-warning btn-sm" style="width; 100%;" value="unanswered">NOT ANSWERED</button>
                                                                <?php
                                                            }
                                                            ?>
                                                        </form>
                                                    </td>
                                                <tr>
                                                <?php
                                            }
                                            // Free result set
                                            mysqli_free_result($result);
                                        } else{
                                            echo "<font color='#FF0000'><strong>No record found!</strong></font>";
                                        }
                                    } else{
                                        echo "ERROR: Was not able to execute Query on line #51. " . mysqli_error($mysqli);
                                    }
                                    // End attempt select query execution
                                ?>
                                </table>
                            </div>
                            <div class="col-sm-2"></div>
                        </div>
                    </div>
                    <div id="boxed" style="margin-bottom: 50px;">&nbsp;</div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php
include "tmp/footer.php";
}

//*******************************************************
//******************   ADD PRAYER   *********************
//*******************************************************
function add_prayer() {
	global $PHP_SELF, $mysqli, $msg;
    global $prayers_tablename, $prayerid, $prayee, $prayer_request, $answered;
    ?>
    <br>
    <div id="boxed">
        <div class="row ml-12 mr-12 clearfix">
            <form method="post" action="<?php echo $PHP_SELF ?>">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Who or what to pray for.</label>
                    <input name="prayee" type="text" class="form-control" id="exampleFormControlInput1">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Prayer Request</label>
                    <textarea name="prayer" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <button name="action" type="submit" class="btn btn-primary" value="add_request">Submit Request</button>
            <form>
        </div>
    </div>
    <?php
    main_form();
}

//*******************************************************
//******************   ADD REQUEST   ********************
//*******************************************************
function add_request() {
	global $PHP_SELF, $mysqli, $perpage;
    global $prayers_tablename, $prayerid, $prayee, $prayer_request, $answered;
    include 'tmp/globals.php';
    session_start();
    dbconnect();

    if (!$mysqli) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $prayee = $_POST['prayee'];
    $prayer_request = $_POST['prayer'];

    if(empty($prayee)){
        $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>
        <button type='button' class='close' data-bs-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>ERROR!</strong> You must enter a name to pray for.
        </div>";
        main_form();
        exit;
    }

    if(empty($prayer_request)){
        $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>
        <button type='button' class='close' data-bs-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>ERROR!</strong> You must enter a prayer request.
        </div>";
        main_form();
        exit;
    }

    // Attempt select query execution
    $sql = "INSERT INTO $prayers_tablename VALUES (NULL, '$prayee', '$prayer_request', '0')";
    if ($mysqli->query($sql) === TRUE) {
        $msg = "<div class='alert alert-success' role='alert'>
        <button type='button' class='close' data-bs-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>SUCCESS!</strong> Prayer added successfully!
        </div>";
        //exit;
    } else {
        $msg = "<div class='alert alert-danger' role='alert'>
        <button type='button' class='close' data-bs-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>ERROR!</strong> Error adding prayer: " . $mysqli->error . "
        </div>";
    }
    // End attempt select query execution

    header('Location: prayerlist.php');
}

//*******************************************************
//********************   PERPAGE   **********************
//*******************************************************
function per_page() {
	global $PHP_SELF, $perpage;
    global $prayers_tablename, $prayerid, $prayee, $prayer_request, $answered;

    // $perpage = $_POST['perpage'];
    // if(!isset($perpage)) {
    //     $perpage = 25;
    // } else {
    //     $perpage = $_POST['perpage'];
    // }
    // $_SESSION['pages'] = $perpage;
    // $_SESSION['perpage'] = $perpage;
    main_form();
}

//*******************************************************
//*******************   ANSWERED   **********************
//*******************************************************
function answered() {
	global $PHP_SELF, $mysqli, $perpage;
    global $prayers_tablename, $prayerid, $prayee, $prayer_request, $answered;
    include 'tmp/globals.php';
    session_start();
    dbconnect();

    if (!$mysqli) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $prayerid = $_POST['answeredid'];

    // Attempt select query execution
    $sql = "UPDATE $prayers_tablename SET answered = '0' WHERE prayerid = '$prayerid'";
    if ($mysqli->query($sql) === TRUE) {
        $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>
        <button type='button' class='close' data-bs-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>SUCCESS!</strong> Changed answered to not answered!
        </div>";
        //exit;
    } else {
        $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>
        <button type='button' class='close' data-bs-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>ERROR!</strong> Error updating answer: " . $mysqli->error . "
        </div>";
    }
    // End attempt select query execution

    header('Location: prayerlist.php');
}

//*******************************************************
//*****************   NOT ANSWERED   ********************
//*******************************************************
function not_answered() {
	global $PHP_SELF, $mysqli, $perpage;
    global $prayers_tablename, $prayerid, $prayee, $prayer_request, $answered;
    include 'tmp/globals.php';
    session_start();
    dbconnect();

    if (!$mysqli) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $prayerid = $_POST['answeredid'];

    // Attempt select query execution
    $sql = "UPDATE $prayers_tablename SET answered = '1' WHERE prayerid = '$prayerid'";
    if ($mysqli->query($sql) === TRUE) {
        $msg = "<div class='alert alert-success' role='alert'>
        <button type='button' class='close' data-bs-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>SUCCESS!</strong> Changed not answered to answered!
        </div>";
        //exit;
    } else {
        $msg = "<div class='alert alert-danger' role='alert'>
        <button type='button' class='close' data-bs-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>ERROR!</strong> Error updating answer: " . $mysqli->error . "
        </div>";
    }
    // End attempt select query execution

    header('Location: prayerlist.php');
}

//*******************************************************
//**********************  SWITCH  ***********************
//*******************************************************
switch($action) {
    case "GO":
        per_page();
    break;
    case "answered":
        answered();
    break;
    case "unanswered":
        not_answered();
    break;
    case "allrequests":
        $_SESSION['answered'] = 2;
        // echo "answered = ".$_SESSION['answered'];
        // exit;
		header('Location: prayerlist.php');
    break;
    case "answered_only":
        $_SESSION['answered'] = 1;
        // echo "answered = ".$_SESSION['answered'];
        // exit;
		header('Location: prayerlist.php');
    break;
    case "unanswered_only":
        $_SESSION['answered'] = 0;
        // echo "answered = ".$_SESSION['answered'];
        // exit;
		header('Location: prayerlist.php');
    break;
    case "add_prayer":
        add_prayer();
    break;
    case "add_request":
        add_request();
    break;
	default:
		main_form();
	break;
}
?>