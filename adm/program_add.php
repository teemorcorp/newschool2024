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
    global $programs_tablename, $progid, $progname, $progdesc, $isenabled, $cost, $charge, $accordian_header, $progtype;
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
    
    $progid = $_GET['id'];
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
                            <h1>Add Program</h1>
                            <center>
                                <?php echo $_SESSION['msg']; ?>
                                <br>
                                
                            </center>
                            <br>
                            <div class="card text-dark bg-light mb-1" id="boxdisplay">
                                <div class="card-header">
                                    <font size="+2"><strong>Program Entry Form</strong></font>
                                </div>
                                <div class="card-body">
                                    <form action="<?php echo $PHP_SELF ?>" method="POST">
                                        <div class="mb-3">
                                            <label for="progname" class="form-label">Program Name</label>
                                            <input type="text" class="form-control" id="progname" name="progname" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="progdesc" class="form-label">Program Description</label>
                                            <textarea class="form-control" id="progdesc" rows="3" name="progdesc"></textarea>
                                        </div>
                                        <div class="form-check mb-3">
                                            <div>
                                                <strong>Enabled</strong>
                                            </div>
                                            <div>
                                                <?php
                                                if($isenabled == true){
                                                    ?>
                                                    <input type="radio" name="isenabled" value="1" checked> Yes
                                                    <input type="radio" name="isenabled" value="0"> No
                                                    <?php
                                                }else{
                                                    ?>
                                                    <input type="radio" name="isenabled" value="1"> Yes
                                                    <input type="radio" name="isenabled" value="0" checked> No
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="cost" class="form-label">Program Cost</label>
                                            <input type="text" class="form-control" id="cost" name="cost">
                                        </div>
                                        <div class="mb-3">
                                            <label for="charge" class="form-label">Program Charge</label>
                                            <input type="text" class="form-control" id="charge" name="charge">
                                        </div>
                                        <div class="mb-3">
                                            <label for="accordian_header" class="form-label">Accordian Header</label>
                                            <input type="text" class="form-control" id="accordian_header" name="accordianheader" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="progtype" class="form-label">Program Type</label>
                                            <select class="form-select" aria-label="Default select example" id="progtype" name="progtype">
                                                <option selected><<< SELECT TYPE >>></option>
                                                <option value="0">Certificate Program</option>
                                                <option value="1">Associate Program</option>
                                                <option value="2">Bachelor Program</option>
                                                <option value="3">Master Program</option>
                                                <option value="4">Doctorate Program</option>
                                            </select>
                                        </div>
                                        <button class="btn btn-primary btn-sm" name="action" type="submit" value="Done">Done</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                    
                
                <div id="boxed" style="margin-top: 50px;">&nbsp;</div>
            
            </div>
        </div>
    </div>
</div>

            <br><br>                    

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
//*********************  DO EDIT  ***********************
//*******************************************************
function do_add(){
    global $PHP_SELF, $mysqli, $msg, $result, $dbhost, $dbuser, $dbpwd, $dbname;
    global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $isgm, $isinstructor;
    global $prog_det_tablename, $progdetid, $progid, $courseid, $coursecode, $coursename, $coursecredits;
    global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $coursedesc, $credits, $filename, $validcourse;
    global $progcourses_tablename, $pgid, $progid, $courseid;
    global $programs_tablename, $progid, $progname, $progdesc, $isenabled, $cost, $charge, $accordian_header, $progtype;
    
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
	
    $progname = $_POST['progname'];
    // $progdesc = stripslashes($_POST['progdesc']);
    $progdesc = $_POST['progdesc'];
    $isenabled = $_POST['isenabled'];
    $cost = $_POST['cost'];
    $charge = $_POST['charge'];
    $accordian_header = $_POST['accordianheader'];
    $progtype = $_POST['progtype'];
    
    // Attempt select query execution
    $sql = "INSERT INTO $programs_tablename VALUES (NULL, '$progname', '$progdesc', '$isenabled', '$cost', '$charge', '$accordian_header', '$progtype')";
    if ($result = mysqli_query($mysqli, $sql)) {
        $_SESSION['msg'] = "<div class='alert alert-success' role='alert' style='margin-top: 20px;'>
        <button type='button' class='close' data-bs-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>SUCCESS!</strong> Record updated successfully!
        </div>";
    } else {
        $_SESSION['msg'] = "<div class='alert alert-danger' role='alert' style='margin-top: 20px;'>
        <button type='button' class='close' data-bs-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>ERROR!</strong> Error updating record: " . mysqli_error($mysqli) . "
        </div>";
    }
    // End attempt select query execution
    ?>
	<script type="text/javascript">
        <!--
        window.top.location.href = "programs.php"; 
        -->
    </script>
<?php
}

//*******************************************************
//**********************  SWITCH  ***********************
//*******************************************************
switch ($action) {
	case "Done":
		do_add();
	    break;
    default:
        main_form();
        break;
}
?>