<?php
/****************************************************
****   IHN Bible College
****   Designed by: Tom Moore
****   Written by: Tom Moore
****   (c) 2001 - 2023 TEEMOR eBusiness Solutions
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
    global $PHP_SELF, $mysqli, $msg, $perpage, $page;
    global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $corecompletedate, $branchid, $role, $messages, $core_complete, $resetpwd;
    global $programs_tablename, $progid, $progname, $enabled, $cost, $charge;
    global $prog_det_tablename, $progdetid, $progid, $courseid, $coursecode, $coursename, $coursecredits;
    global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $coursedesc, $credits, $filename, $validcourse;
    global $progcourses_tablename, $pgid, $progid, $courseid;

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
                                <h1>Student Management</h1>
                                <center>
                                <?php echo $msg; ?>
                                <br>
                                <form action="<?php echo $PHP_SELF ?>" method="post">
                                    <input class='btn btn-primary' name="action" type="submit" value="Add New" />
                                </form>
                                </center>
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
                                $sql = "SELECT COUNT(*) AS 'TotalItems' FROM $users_tablename";
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
                                <br>
                                <div class="card text-dark bg-light mb-1" id="boxdisplay">
                                    <div class="card-header">
                                        <font size="+2"><strong>Students</strong></font>
                                    </div>
                                    <div class="card-body">
                                        <form action="<?php echo $PHP_SELF ?>" method="post">
                                            <table class="table">
                                                <tr>
                                                    <td><font size="+1"><strong>Student ID</strong></font></td>
                                                    <td><font size="+1"><strong>Student Name</strong></font></td>
                                                    <td><font size="+1"><strong>Email</strong></font></td>
                                                    <td><font size="+1"><strong>Country</strong></font></td>
                                                    <td align="right"><font size="+1"><strong>View/Modify</strong></font></td>
                                                </tr>
                                                <tbody>
                                                    <tr>
                                                        <?php
                                                        // Attempt select query execution
                                                        $sql = "SELECT * FROM $users_tablename ORDER BY userfname ASC LIMIT $start_from, $perpage";
                                                        if($result = mysqli_query($mysqli, $sql)){
                                                            if(mysqli_num_rows($result) > 0){
                                                                while($row = mysqli_fetch_array($result)){
                                                                    $studentid = $row['userid'];
                                                                    $useremail = $row['useremail'];
                                                                    $userfname = $row['userfname'];
                                                                    $usermname = $row['usermname'];
                                                                    $userlname = $row['userlname'];
                                                                    $usercountry = $row['usercountry'];
                                                                    if(empty($usermname)){
                                                                        $fullname = $userfname." ".$userlname;
                                                                    }else{
                                                                        $fullname = $userfname." ".$usermname." ".$userlname;
                                                                    }
                                                                    ?>
                                                                    <tr>
                                                                        <form action="<?php echo $PHP_SELF ?>" method="post">
                                                                            <td><?php echo $studentid; ?></td>
                                                                            <td><?php echo $fullname; ?></td>
                                                                            <td><?php echo $useremail; ?></td>
                                                                            <td><?php echo $usercountry; ?></td>
                                                                            <td align="right">
                                                                                <input type="hidden" name="studentid" value="<?php echo $studentid ?>">
                                                                                <!--input class='btn btn-success' name="action" type="submit" value="View/Modify" /-->
                                                                                <button class="btn btn-success" name="action" type="submit" value="View/Modify">View/Modify</button>
                                                                            </td>
                                                                        </form>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                                // Free result set
                                                                mysqli_free_result($result);
                                                            } else{
                                                                ?>
                                                                <tr>
                                                                    <td colspan="5"><center>No data available in table</center></td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        } else{
                                                            echo "ERROR: Was not able to execute Query on line #213. " . mysqli_error($mysqli);
                                                        }
                                                        // End attempt select query execution
                                                        ?>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </form>
                                    </div>
                                </div>
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


//********************************************************************************************************************************
//***  EDIT RECORD
//********************************************************************************************************************************
function edit_record(){
    global $PHP_SELF, $mysqli, $msg;
    global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $corecompletedate, $branchid, $role, $messages, $core_complete, $resetpwd;

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
	
    $studentid = $_POST['studentid'];

    // Attempt select query execution
    $sql = "SELECT * FROM $users_tablename WHERE userid = '$studentid'";
    if($result = mysqli_query($mysqli, $sql)){
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            $useremail = $row['useremail'];
            $userpassword = $row['userpassword'];
            $isadmin = $row['isadmin'];
            $userfname = $row['userfname'];
            $usermname = $row['usermname'];
            $userlname = $row['userlname'];
            $usercity = $row['usercity'];
            $userstate = $row['userstate'];
            $userzip = $row['userzip'];
            $userphone = $row['userphone'];
            $suspended = $row['suspended'];
            $highgrade = $row['highgrade'];
            $dob = $row['dob'];
            $usersaved = $row['usersaved'];
            $baptized = $row['baptized'];
            $baptismdate = $row['baptismdate'];
            $profile = $row['profile'];
            $imagepath = $row['imagepath'];
            $corecompletedate = $row['corecompletedate'];
            $branchid = $row['branchid'];
            $role = $row['role'];
            $messages = $row['messages'];
            $core_complete = $row['core_complete'];
            $resetpwd = $row['resetpwd'];
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
                            <div id="boxed" style="margin-top: 10px;">
                                <h1>Modify Student/User</h1>
                                <center>
                                    <?php echo $_SESSION['msg']; ?>
                                    <br>
                                    
                                </center>
                                <br>
                                <form action="<?php echo $PHP_SELF ?>" method="post">

                                    <div class="mb-3 row">
                                        <label for="staticEmail" class="col-sm-2 col-form-label">Student/User ID</label>
                                        <div class="col-sm-10">
                                            <?php echo $studentid; ?>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="userfname" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="userfname" name="userfname" value="<?php echo $userfname; ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="usermname" class="form-label">Middle Name</label>
                                        <input type="text" class="form-control" id="usermname" name="usermname" value="<?php echo $usermname; ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="userlname" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="userlname" name="userlname" value="<?php echo $userlname; ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="useremail" class="form-label">Email address</label>
                                        <input type="email" class="form-control" id="useremail" name="useremail" placeholder="name@example.com" value="<?php echo $useremail; ?>">
                                    </div>

                                    <hr>

                                    <?php
                                    if($isadmin == 1){
                                        ?>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" value="1" name="isadmin" id="isadmin1" checked>
                                            <label class="form-check-label" for="isadmin1">
                                                Is Admin
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" value="0" name="isadmin" id="isadmin2">
                                            <label class="form-check-label" for="isadmin2">
                                                Is Not Admin
                                            </label>
                                        </div>
                                        <?php
                                    }else{
                                        ?>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" value="1" name="isadmin" id="isadmin1">
                                            <label class="form-check-label" for="isadmin1">
                                                Is Admin
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" value="0" name="isadmin" id="isadmin2" checked>
                                            <label class="form-check-label" for="isadmin2">
                                                Is Not Admin
                                            </label>
                                        </div>
                                        <?php
                                    }
                                    ?>

                                    <hr>

                                    <div class="mb-3">
                                        <label for="useraddress" class="form-label">Mailing Address</label>
                                        <input type="text" class="form-control" id="useraddress" name="useraddress" value="<?php echo $useraddress; ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="usercity" class="form-label">City</label>
                                        <input type="text" class="form-control" id="usercity" name="usercity" value="<?php echo $usercity; ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="userstate" class="form-label">State/Region</label>
                                        <input type="text" class="form-control" id="userstate" name="userstate" value="<?php echo $userstate; ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="userzip" class="form-label">Postal Code</label>
                                        <input type="text" class="form-control" id="userzip" name="userzip" value="<?php echo $userzip; ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="usercountry" class="form-label">Country</label>
                                        <input type="text" class="form-control" id="usercountry" name="usercountry" value="<?php echo $usercountry; ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="userphone" class="form-label">Phone</label>
                                        <input type="text" class="form-control" id="userphone" name="userphone" value="<?php echo $userphone; ?>">
                                    </div>

                                    <hr>

                                    <?php
                                    if($suspended == 1){
                                        ?>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" value="1" name="suspended" id="suspended1" checked>
                                            <label class="form-check-label" for="suspended1">
                                                Is Suspended
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" value="0" name="suspended" id="suspended2">
                                            <label class="form-check-label" for="suspended2">
                                                Is Not Suspended
                                            </label>
                                        </div>
                                        <?php
                                    }else{
                                        ?>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" value="1" name="suspended" id="suspended1">
                                            <label class="form-check-label" for="suspended1">
                                                Is Suspended
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" value="0" name="suspended" id="suspended2" checked>
                                            <label class="form-check-label" for="suspended2">
                                                Is Not Suspended
                                            </label>
                                        </div>
                                        <?php
                                    }
                                    ?>

                                    <hr>

                                    <div class="mb-3">
                                        <label for="highgrade" class="form-label">Highest Grade</label>
                                        <input type="text" class="form-control" id="highgrade" name="highgrade" value="<?php echo $highgrade; ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="dob" class="form-label">Date of Birth</label>
                                        <input type="text" class="form-control" id="dob" name="dob" value="<?php echo $dob; ?>">
                                    </div>

                                    <hr>

                                    <?php
                                    if($usersaved == 1){
                                        ?>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" value="1" name="usersaved" id="usersaved1" checked>
                                            <label class="form-check-label" for="usersaved1">
                                                Is Saved
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" value="0" name="usersaved" id="usersaved2">
                                            <label class="form-check-label" for="usersaved2">
                                                Is Not Saved
                                            </label>
                                        </div>
                                        <?php
                                    }else{
                                        ?>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" value="1" name="usersaved" id="usersaved1">
                                            <label class="form-check-label" for="usersaved1">
                                                Is Saved
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" value="0" name="usersaved" id="usersaved2" checked>
                                            <label class="form-check-label" for="usersaved2">
                                                Is Not Saved
                                            </label>
                                        </div>
                                        <?php
                                    }
                                    ?>

                                    <hr>

                                    <?php
                                    if($baptized == 1){
                                        ?>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" value="1" name="baptized" id="baptized1" checked>
                                            <label class="form-check-label" for="baptized1">
                                                Is Baptized
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" value="0" name="baptized" id="baptized2">
                                            <label class="form-check-label" for="baptized2">
                                                Is Not Baptized
                                            </label>
                                        </div>
                                        <?php
                                    }else{
                                        ?>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" value="1" name="baptized" id="baptized1">
                                            <label class="form-check-label" for="baptized1">
                                                Is Baptized
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" value="0" name="baptized" id="baptized2" checked>
                                            <label class="form-check-label" for="baptized2">
                                                Is Not Baptized
                                            </label>
                                        </div>
                                        <?php
                                    }
                                    ?>

                                    <hr>

                                    <div class="mb-3">
                                        <label for="baptismdate" class="form-label">Babtism Date</label>
                                        <input type="text" class="form-control" id="baptismdate" name="baptismdate" value="<?php echo $baptismdate; ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="profile" class="form-label">Profile</label>
                                        <textarea class="form-control" id="profile" name="profile"><?php echo $profile; ?></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="imagepath" class="form-label">Image</label>
                                        <input type="text" class="form-control" id="imagepath" name="imagepath" value="<?php echo $imagepath; ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="corecompletedate" class="form-label">Core Completion Date</label>
                                        <input type="text" class="form-control" id="corecompletedate" name="corecompletedate" value="<?php echo $corecompletedate; ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="branchid" class="form-label">Branch ID</label>
                                        <input type="text" class="form-control" id="branchid" name="branchid" value="<?php echo $branchid; ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="role" class="form-label">Role</label>
                                        <input type="text" class="form-control" id="role" name="role" value="<?php echo $role; ?>">
                                    </div>

                                    <hr>

                                    <?php
                                    if($messages == 1){
                                        ?>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" value="1" name="messages" id="messages1" checked>
                                            <label class="form-check-label" for="messages1">
                                                Allow Messages
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" value="0" name="messages" id="messages2">
                                            <label class="form-check-label" for="messages2">
                                                Do Not Allow Messages
                                            </label>
                                        </div>
                                        <?php
                                    }else{
                                        ?>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" value="1" name="messages" id="messages1">
                                            <label class="form-check-label" for="messages1">
                                                Allow Messages
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" value="0" name="messages" id="messages2" checked>
                                            <label class="form-check-label" for="messages2">
                                                Do Not Allow Messages
                                            </label>
                                        </div>
                                        <?php
                                    }
                                    ?>

                                    <hr>

                                    <?php
                                    if($core_complete == 1){
                                        ?>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" value="1" name="core_complete" id="core_complete1" checked>
                                            <label class="form-check-label" for="core_complete1">
                                                Core Is Completed
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" value="0" name="core_complete" id="core_complete2">
                                            <label class="form-check-label" for="core_complete2">
                                                Core Is Not Completed
                                            </label>
                                        </div>
                                        <?php
                                    }else{
                                        ?>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" value="1" name="core_complete" id="core_complete1">
                                            <label class="form-check-label" for="core_complete1">
                                                Core Is Completed
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" value="0" name="core_complete" id="core_complete2" checked>
                                            <label class="form-check-label" for="core_complete2">
                                                Core Is Not Completed
                                            </label>
                                        </div>
                                        <?php
                                    }
                                    ?>

                                    <hr>

                                    <?php
                                    if($resetpwd == 1){
                                        ?>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" value="1" name="resetpwd" id="resetpwd1">
                                            <label class="form-check-label" for="resetpwd1">
                                                Reset Password
                                            </label>
                                        </div>
                                        <?php
                                    }else{
                                        ?>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" value="0" name="resetpwd" id="resetpwd2" checked>
                                            <label class="form-check-label" for="resetpwd2">
                                                Do Not Reset Password
                                            </label>
                                        </div>
                                        <?php
                                    }
                                    ?>

                                    <hr>

                                    <input type="hidden" name="studentid" value="<?php echo $studentid ?>">
                                    <input class="btn btn-primary btn-sm" type="submit" name="action" value="Done" />
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
            selector: '#profile',
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
//*********************  DO EDIT  ***********************
//*******************************************************
function do_edit(){
    global $PHP_SELF, $mysqli, $msg;
    global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $corecompletedate, $branchid, $role, $messages, $core_complete, $resetpwd;
    
    include "tmp/globals.php";
    dbconnect();
    if (!$mysqli) {
        die("Connection failed: " . mysqli_connect_error());
    }
	
    $studentid = $_POST['studentid'];
    $useremail = $_POST['useremail'];
    $userpassword = $_POST['userpassword'];
    $isadmin = $_POST['isadmin'];
    $userfname = $_POST['userfname'];
    $usermname = $_POST['usermname'];
    $userlname = $_POST['userlname'];
    $useraddress = $_POST['useraddress'];
    $usercity = $_POST['usercity'];
    $userstate = $_POST['userstate'];
    $userzip = $_POST['userzip'];
    $usercountry = $_POST['usercountry'];
    $userphone = $_POST['userphone'];
    $suspended = $_POST['suspended'];
    $highgrade = $_POST['highgrade'];
    $dob = $_POST['dob'];
    $usersaved = $_POST['usersaved'];
    $baptized = $_POST['baptized'];
    $baptismdate = $_POST['baptismdate'];
    $profile = addslashes($_POST['profile']);
    $imagepath = $_POST['imagepath'];
    $corecompletedate = $_POST['corecompletedate'];
    $branchid = $_POST['branchid'];
    $role = $_POST['role'];
    $messages = $_POST['messages'];
    $core_complete = $_POST['core_complete'];
    $resetpwd = $_POST['resetpwd'];

    $sql = $mysqli->query("UPDATE $users_tablename SET useremail = '$useremail', userpassword = '', isadmin = '$isadmin', userfname = '$userfname', usermname = '$usermname', userlname = '$userlname', useraddress = '$useraddress', usercity = '$usercity', userstate = '$userstate', userzip = '$userzip', usercountry = '$usercountry', userphone = '$userphone', suspended = '$suspended', highgrade = '$highgrade', dob = '$dob', usersaved = '$usersaved', baptized = '$baptized', baptismdate = '$baptismdate', profile = '$profile', imagepath = '$imagepath', corecompletedate = '$corecompletedate', branchid = '$branchid', role = '$role', messages = '$messages', core_complete = '$core_complete', resetpwd = '$resetpwd' WHERE userid = '$studentid'");
    // if(!$sql) error_message("Error fetching data from $programs_tablename (programs) line #248");

    ?>
    <script type="text/javascript">
        <!--
        window.top.location.href = "students.php"; 
        -->
    </script>
    <?php
}


//*******************************************************
//*********************  DO EDIT  ***********************
//*******************************************************
function add_new(){
    global $PHP_SELF, $mysqli, $msg;
    global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $corecompletedate, $branchid, $role, $messages, $core_complete, $resetpwd;
    global $programs_tablename, $progid, $progname, $enabled, $cost, $charge;
    global $prog_det_tablename, $progdetid, $progid, $courseid, $coursecode, $coursename, $coursecredits;
    global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $coursedesc, $credits, $filename, $validcourse;
    global $progcourses_tablename, $pgid, $progid, $courseid;
    
    include "tmp/header.php";
    dbconnect();
    if (!$mysqli) {
        die("Connection failed: " . mysqli_connect_error());
    }
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
                                <h1>Add Student/User</h1>
                                <center>
                                    <?php echo $_SESSION['msg']; ?>
                                    <br>
                                    
                                </center>
                                <br>
                                <form action="<?php echo $PHP_SELF ?>" method="post">

                                    <div class="mb-3">
                                        <label for="userfname" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="userfname" name="userfname">
                                    </div>

                                    <div class="mb-3">
                                        <label for="usermname" class="form-label">Middle Name</label>
                                        <input type="text" class="form-control" id="usermname" name="usermname">
                                    </div>

                                    <div class="mb-3">
                                        <label for="userlname" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="userlname" name="userlname">
                                    </div>

                                    <div class="mb-3">
                                        <label for="useremail" class="form-label">Email address</label>
                                        <input type="email" class="form-control" id="useremail" name="useremail" placeholder="name@example.com">
                                    </div>

                                    <hr>

                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" value="1" name="isadmin" id="isadmin1">
                                        <label class="form-check-label" for="isadmin1">
                                            Is Admin
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" value="0" name="isadmin" id="isadmin2" checked>
                                        <label class="form-check-label" for="isadmin2">
                                            Is Not Admin
                                        </label>
                                    </div>

                                    <hr>

                                    <div class="mb-3">
                                        <label for="useraddress" class="form-label">Mailing Address</label>
                                        <input type="text" class="form-control" id="useraddress" name="useraddress">
                                    </div>

                                    <div class="mb-3">
                                        <label for="usercity" class="form-label">City</label>
                                        <input type="text" class="form-control" id="usercity" name="usercity">
                                    </div>

                                    <div class="mb-3">
                                        <label for="userstate" class="form-label">State/Region</label>
                                        <input type="text" class="form-control" id="userstate" name="userstate">
                                    </div>

                                    <div class="mb-3">
                                        <label for="userzip" class="form-label">Postal Code</label>
                                        <input type="text" class="form-control" id="userzip" name="userzip">
                                    </div>

                                    <div class="mb-3">
                                        <label for="usercountry" class="form-label">Country</label>
                                        <input type="text" class="form-control" id="usercountry" name="usercountry">
                                    </div>

                                    <div class="mb-3">
                                        <label for="userphone" class="form-label">Phone</label>
                                        <input type="text" class="form-control" id="userphone" name="userphone">
                                    </div>

                                    <hr>

                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" value="1" name="suspended" id="suspended1">
                                        <label class="form-check-label" for="suspended1">
                                            Is Suspended
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" value="0" name="suspended" id="suspended2" checked>
                                        <label class="form-check-label" for="suspended2">
                                            Is Not Suspended
                                        </label>
                                    </div>

                                    <hr>

                                    <div class="mb-3">
                                        <label for="highgrade" class="form-label">Highest Grade</label>
                                        <input type="text" class="form-control" id="highgrade" name="highgrade">
                                    </div>

                                    <div class="mb-3">
                                        <label for="dob" class="form-label">Date of Birth</label>
                                        <input type="text" class="form-control" id="dob" name="dob">
                                    </div>

                                    <hr>

                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" value="1" name="usersaved" id="usersaved1">
                                        <label class="form-check-label" for="usersaved1">
                                            Is Saved
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" value="0" name="usersaved" id="usersaved2" checked>
                                        <label class="form-check-label" for="usersaved2">
                                            Is Not Saved
                                        </label>
                                    </div>

                                    <hr>

                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" value="1" name="baptized" id="baptized1">
                                        <label class="form-check-label" for="baptized1">
                                            Is Baptized
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" value="0" name="baptized" id="baptized2" checked>
                                        <label class="form-check-label" for="baptized2">
                                            Is Not Baptized
                                        </label>
                                    </div>

                                    <hr>

                                    <div class="mb-3">
                                        <label for="baptismdate" class="form-label">Babtism Date</label>
                                        <input type="text" class="form-control" id="baptismdate" name="baptismdate">
                                    </div>

                                    <div class="mb-3">
                                        <label for="profile" class="form-label">Profile</label>
                                        <textarea class="form-control" id="profile" name="profile"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="imagepath" class="form-label">Image</label>
                                        <input type="text" class="form-control" id="imagepath" name="imagepath">
                                    </div>

                                    <div class="mb-3">
                                        <label for="corecompletedate" class="form-label">Core Completion Date</label>
                                        <input type="text" class="form-control" id="corecompletedate" name="corecompletedate">
                                    </div>

                                    <div class="mb-3">
                                        <label for="branchid" class="form-label">Branch ID</label>
                                        <input type="text" class="form-control" id="branchid" name="branchid">
                                    </div>

                                    <div class="mb-3">
                                        <label for="role" class="form-label">Role</label>
                                        <input type="text" class="form-control" id="role" name="role">
                                    </div>

                                    <hr>

                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" value="1" name="messages" id="messages1">
                                        <label class="form-check-label" for="messages1">
                                            Allow Messages
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" value="0" name="messages" id="messages2" checked>
                                        <label class="form-check-label" for="messages2">
                                            Do Not Allow Messages
                                        </label>
                                    </div>

                                    <hr>

                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" value="1" name="core_complete" id="core_complete1">
                                        <label class="form-check-label" for="core_complete1">
                                            Core Is Completed
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" value="0" name="core_complete" id="core_complete2" checked>
                                        <label class="form-check-label" for="core_complete2">
                                            Core Is Not Completed
                                        </label>
                                    </div>

                                    <hr>

                                    <hr>

                                    <!-- <input type="hidden" name="progid" value="< ?php echo $progid ?>"> -->
                                    <input class="btn btn-primary btn-sm" type="submit" name="action" value="Submit" />
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
            selector: '#profile',
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
//**********************  DO ADD  ***********************
//*******************************************************
function do_add(){
    global $PHP_SELF, $mysqli, $msg;
    global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $corecompletedate, $branchid, $role, $messages, $core_complete, $resetpwd;

    include 'tmp/globals.php';
    dbconnect();
    if (!$mysqli) {
        die("Connection failed: " . mysqli_connect_error());
    }
	
    $studentid = $_POST['studentid'];
    $useremail = $_POST['useremail'];
    $userpassword = $_POST['userpassword'];
    $isadmin = $_POST['isadmin'];
    $userfname = $_POST['userfname'];
    $usermname = $_POST['usermname'];
    $userlname = $_POST['userlname'];
    $useraddress = $_POST['useraddress'];
    $usercity = $_POST['usercity'];
    $userstate = $_POST['userstate'];
    $userzip = $_POST['userzip'];
    $usercountry = $_POST['usercountry'];
    $userphone = $_POST['userphone'];
    $suspended = $_POST['suspended'];
    $highgrade = $_POST['highgrade'];
    $dob = $_POST['dob'];
    $usersaved = $_POST['usersaved'];
    $baptized = $_POST['baptized'];
    $baptismdate = $_POST['baptismdate'];
    $profile = addslashes($_POST['profile']);
    $imagepath = $_POST['imagepath'];
    $corecompletedate = $_POST['corecompletedate'];
    $branchid = $_POST['branchid'];
    $role = $_POST['role'];
    $messages = $_POST['messages'];
    $core_complete = $_POST['core_complete'];
    $resetpwd = 1;

    $sql = $mysqli->query("INSERT INTO $users_tablename VALUES(NULL, '$useremail', '$userpassword', '$isadmin', '$userfname', '$usermname', '$userlname', '$useraddress', '$usercity', '$userstate', '$userzip', '$usercountry', '$userphone', '$suspended', '$highgrade', '$dob', '$usersaved', '$baptized', '$baptismdate', '$profile', '$imagepath', '$corecompletedate', '$branchid', '$role', '$messages', '$core_complete', '$resetpwd')");
    // if(!$sql) error_message("Error fetching data from $programs_tablename (programs) line #345");

    ?>
    <script type="text/javascript">
        <!--
        window.top.location.href = "students.php"; 
        -->
    </script>
    <?php
}


//*******************************************************
//**********************  DO ADD  ***********************
//*******************************************************
function add_course(){
    global $PHP_SELF, $mysqli, $msg;
    global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $corecompletedate, $branchid, $role, $messages, $core_complete, $resetpwd;
    global $programs_tablename, $progid, $progname, $enabled, $cost, $charge;
    global $prog_det_tablename, $progdetid, $progid, $courseid, $coursecode, $coursename, $coursecredits;
    global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $coursedesc, $credits, $filename, $validcourse;
    global $progcourses_tablename, $pgid, $progid, $courseid;
	
    $progid = $_POST['progid'];
    $courseid = $_POST['courseid'];

    $sql = $mysqli->query("SELECT * FROM $courses_tablename WHERE courseid = '$courseid'");
    // if(!$sql) error_message("Error in $courses_tablename (courses) line #338");
    $row = $sql->fetch_assoc();	
    $coursecode = $row['coursecode'];
    $coursename = addslashes($row['coursename']);
    $coursedesc = addslashes($row['coursedesc']);
    $credits = $row['credits'];
    $filename = $row['filename'];
    $validcourse = $row['validcourse'];

    $sql = $mysqli->query("INSERT INTO $prog_det_tablename VALUES(NULL, '$progid', '$courseid', '$coursecode', '$coursename', '$credits')");
    // if(!$sql) error_message("Error fetching data from $programs_tablename (programs) line #345");
    edit_record();
}


//*******************************************************
//**********************  DO ADD  ***********************
//*******************************************************
function delete_course(){
    global $PHP_SELF, $mysqli, $msg;
    global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $corecompletedate, $branchid, $role, $messages, $core_complete, $resetpwd;
    global $programs_tablename, $progid, $progname, $enabled, $cost, $charge;
    global $prog_det_tablename, $progdetid, $progid, $courseid, $coursecode, $coursename, $coursecredits;
    global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $coursedesc, $credits, $filename, $validcourse;
    global $progcourses_tablename, $pgid, $progid, $courseid;
	
    $progid = $_POST['progid'];
    $courseid = $_POST['courseid'];

    /*echo "progid: ".$progid."<br>";
    echo "courseid: ".$courseid."<br>";
    exit;*/

    $query = mysqli_query($mysqli, "DELETE FROM $prog_det_tablename WHERE progid = '$progid' AND courseid = '$courseid'");
    // if(!$query) error_message("Error fetching data from $prog_det_tablename (delete_prod) line #388");


    edit_record();
}

//*******************************************************
//********************   PERPAGE   **********************
//*******************************************************
function per_page() {
	global $PHP_SELF, $bkcolor, $perpage;
    global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $corecompletedate, $branchid, $role, $messages, $core_complete, $resetpwd;

    $perpage = $_POST['perpage'];

    if(!isset($perpage)) {
        $perpage = 25;
    } else {
        $perpage = $_POST['perpage'];
    }
    $_SESSION['pages'] = $perpage;
    $_SESSION['perpage'] = $perpage;
    main_form();
}


//*******************************************************
//**********************  SWITCH  ***********************
//*******************************************************
switch($action) {
	case "DELETE":
		delete_course();
	break;
	case "Add Course":
		add_course();
	break;
	case "Submit":
		do_add();
	break;
	case "Done":
		do_edit();
	break;
	case "View/Modify":
		edit_record();
	break;
	case "Add New":
		add_new();
	break;
    case "GO":
        per_page();
    break;
	default:
		main_form();
	break;
}
?>