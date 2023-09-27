<?php
/*************************************************************
** IHN Bible College Online
** Author: TJ Moore
** tjmooredev@gmail.com
** Copyright (c) 2001 - 2021 Thomas J. Moore, D.D.
**************************************************************/
include '../../includes/globals.php';
session_start();
db_connect();

if($mysqli->connect_error) {
	echo 'Failed to connect to server: (' . $mysqli->connect_error . ') ' . $mysqli->connect_error;
}

if(!isset($_SESSION['pages'])) {
	$_SESSION['pages'] = 10;
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
global $PHP_SELF, $mysqli, $msg, $nextpage, $prevpage, $perpage, $page;
global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $corecompletedate, $branchid;
global $branches_tablename, $branchid, $branchname, $location;

$main_background_color = "#3f3a7a"; //1c262f
$sub_background_color = "#534ba5"; //26333c
$child_background_color = "#4872ff"; //2f3d4a

$_SESSION['userid'] = "1";
$userid = $_SESSION['userid'];

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
        $fullname = $userfname." ".$userlname;
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

include '../templates/include.tpl';
include "../templates/style.tpl";



// Attempt select query execution
$sql = "SELECT COUNT(*) AS 'TotalItems' FROM $users_tablename WHERE branchid = '1'";
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
    echo "ERROR: Was not able to execute Query on line #182. " . mysqli_error($hdmysqli);
}
// End attempt select query execution

$total_graduate = "0";
$total_teachers = "0";
?>
<body>
<div class='container-fluid'>
<?php
include "../templates/topmenu.tpl";
?>

<!-- *****************************************************************************************************
*******  MAIN
*******************************************************************************************************-->    
<section>
    <div class="row" style="height: 100vh;">
        <div class="col-sm-2" style="padding-left: 0px;">
            <?php include "../templates/leftmenu.tpl"; ?>
        </div>
        <div class="col-10">
            <div class="row " style="padding-top:10px;">
                <div class="col-12">
                    <!-- *******************************************************************************************
                    **********  CARDS
                    *********************************************************************************************-->
                    <section name="Website Options" style="padding-top:20px;">
                        <div class="row clearfix" style="padding-top:10px;">
                            <div class="col-4">
                                <div class="card text-dark bg-warning" id="boxdisplay">
                                    <div class="card-header"><font size="+2"><strong>Total Nyarugusu Students</strong></font></div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <font size="+4"><strong><?php echo $total_records; ?></strong></font>
                                                <br><br>
                                                <button type="button" id="btnrounded" class="btn btn-light">View All</button>
                                            </div>
                                            <div class="col" align="center">
                                                <font size="+5"><i class="fas fa-users"></i></font>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card text-white bg-primary" id="boxdisplay">
                                    <div class="card-header"><font size="+2"><strong>Graduated This Year</strong></font></div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <font size="+4"><strong><?php echo $total_graduate; ?></strong></font>
                                                <br><br>
                                                <button type="button" id="btnrounded" class="btn btn-light">View All</button>
                                            </div>
                                            <div class="col" align="center">
                                                <font size="+5"><i class="fas fa-user-graduate"></i></font>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card text-white bg-success" id="boxdisplay">
                                    <div class="card-header"><font size="+2"><strong>Total Teachers</strong></font></div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <font size="+4"><strong><?php echo $total_teachers; ?></strong></font>
                                                <br><br>
                                                <button type="button" id="btnrounded" class="btn btn-light">View All</button>
                                            </div>
                                            <div class="col" align="center">
                                                <font size="+5"><i class="fas fa-chalkboard-teacher"></i></font>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- *******************************************************************************************
                    **********  POPULAR PRODUCTS
                    *********************************************************************************************-->
                    <section name="Website Options" style="padding-top:20px;">
                        <div class="card text-dark bg-light mb-1" id="boxdisplay">
                            <div class="card-header"><font size="+2"><strong>IHN Bible College - Nyarugusu Branch</strong></font></div>
                            <div class="card-body">
                                <table class="table">
                                    <tr>
                                        <td colspan="7">
                                            <?php
                                            if(!isset($_SESSION['pages'])) {
                                                $_SESSION['pages'] = 10;
                                            }
                                            
                                            if ($_SESSION['pages'] <= 1) {
                                                $_SESSION['pages'] = 10;
                                            }

                                            if(!isset($_SESSION['perpage'])) {
                                                $perpage = 10;
                                                $_SESSION['perpage'] = $perpage;
                                            } else {
                                                $perpage = $_SESSION['perpage'];
                                            }
                                            
                                            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
                                            $start_from = ($page-1) * $perpage; 

                                            $total_pages = ceil($total_records / $perpage);
                                            ?>
                                            <center>
                                            <form method="post" action="<?php echo $PHP_SELF ?>">
                                                Records Per Page
                                                <select name="perpage">
                                                    <?php
                                                    if($perpage == 10){
                                                        ?>
                                                        <option value="10" selected>10</option>
                                                        <?php
                                                    }else{
                                                        ?>
                                                        <option value="10">10</option>
                                                        <?php
                                                    }
                                                    
                                                    if($perpage == 25){
                                                        ?>
                                                        <option value="25" selected>25</option>
                                                        <?php
                                                    }else{
                                                        ?>
                                                        <option value="25">25</option>
                                                        <?php
                                                    }
                                                    
                                                    if($perpage == 50){
                                                        ?>
                                                        <option value="50" selected>50</option>
                                                        <?php
                                                    }else{
                                                        ?>
                                                        <option value="50">50</option>
                                                        <?php
                                                    }
                                                    
                                                    if($perpage == 100){
                                                        ?>
                                                        <option value="100" selected>100</option>
                                                        <?php
                                                    }else{
                                                        ?>
                                                        <option value="100">100</option>
                                                        <?php
                                                    }
                                                    ?>
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
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="col">Ticket #</th>
                                        <th scope="col">Student Name</th>
                                        <th scope="col">Completed Date</th>
                                        <th scope="col">Program</th>
                                        <th scope="col">Saved?</th>
                                        <th scope="col">Baptized?</th>
                                        <th scope="col"></th>
                                    </tr>
                                    <tbody>
                                        <?php
                                        global $users_tablename, $userid, $useremail, $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $corecompletedate, $branchid;
                                        // Attempt select query execution
                                        $sql = "SELECT * FROM $users_tablename WHERE branchid = '1' ORDER BY userfname DESC LIMIT $start_from, $perpage";
                                        if($result = mysqli_query($mysqli, $sql)){
                                            if(mysqli_num_rows($result) > 0){
                                                while($row = mysqli_fetch_array($result)){
                                                    $trackid = $row['userid'];
                                                    $userfname = $row['userfname'];
                                                    $usermname = $row['usermname'];
                                                    $userlname = $row['userlname'];
                                                    $usersaved = $row['usersaved'];
                                                    $baptized = $row['baptized'];
                                                    $corecompletedate = $row['corecompletedate'];

                                                    if(empty($usermname)){
                                                        $fullname = $userfname." ".$userlname;
                                                    }else{
                                                        $fullname = $userfname." ".$usermname." ".$userlname;//
                                                    }

                                                    if($usersaved == '1'){
                                                        $saved = "Yes";
                                                    }else{
                                                        $saved = "No";
                                                    }

                                                    if($baptized == "1"){
                                                        $bap = "Yes";
                                                    }else{
                                                        $bap = "No";
                                                    }
                                                ?>
                                                <tr>
                                                    <td><?php echo $trackid; ?></td>
                                                    <td><?php echo $fullname; ?></td>
                                                    <td><?php echo $corecompletedate; ?></td>
                                                    <td><?php echo "Bachelor of Biblical Studies"; ?></td>
                                                    <td><?php echo $saved; ?></td>
                                                    <td><?php echo $bap; ?></td>
                                                    <td><button type="submit" name="action" class="btn btn-primary btn-block" value="view">View/Modify</button></td>
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
                                                //$msg = "<font color='#FF0000'><strong>No Records Found!</strong></font>";
                                                //main_form();
                                                //exit;
                                            }
                                        } else{
                                            echo "ERROR: Was not able to execute Query on line #276. " . mysqli_error($hdmysqli);
                                        }
                                        // End attempt select query execution
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>


                    <!-- *******************************************************************************************
                    **********  TOP REFERALS / MOST USED OS
                    *********************************************************************************************-->
                    <section name="Website Options" style="padding-top:20px;">
                            <div class="row clearfix" style="padding-top:10px;">
                                <div class="col-sm-3">
                                    <div class="card text-dark bg-light mb-1" id="boxdisplay">
                                        <div class="card-header"><font size="+2"><strong>Manage Students</strong></font></div>
                                        <div class="card-body">
                                            <form action="<?php echo $PHP_SELF ?>" method="post">
                                                <button type="submit" name="action" class="btn btn-primary btn-block" value="manual">Manually Enter a Student</button>
                                                <button type="submit" name="action" class="btn btn-primary btn-block" value="current">View All Current Students</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card text-dark bg-light mb-1" id="boxdisplay">
                                        <div class="card-header"><font size="+2"><strong>Manage Students</strong></font></div>
                                        <div class="card-body">
                                            <form action="<?php echo $PHP_SELF ?>" method="post">
                                                <button type="submit" name="action" class="btn btn-primary btn-block" value="manual">Manually Enter a Student</button>
                                                <button type="submit" name="action" class="btn btn-primary btn-block" value="current">View All Current Students</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card text-dark bg-light mb-1" id="boxdisplay">
                                        <div class="card-header"><font size="+2"><strong>Manage Students</strong></font></div>
                                        <div class="card-body">
                                            <form action="<?php echo $PHP_SELF ?>" method="post">
                                                <button type="submit" name="action" class="btn btn-primary btn-block" value="manual">Manually Enter a Student</button>
                                                <button type="submit" name="action" class="btn btn-primary btn-block" value="current">View All Current Students</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card text-dark bg-light mb-1" id="boxdisplay">
                                        <div class="card-header"><font size="+2"><strong>Manage Students</strong></font></div>
                                        <div class="card-body">
                                            <form action="<?php echo $PHP_SELF ?>" method="post">
                                                <button type="submit" name="action" class="btn btn-primary btn-block" value="manual">Manually Enter a Student</button>
                                                <button type="submit" name="action" class="btn btn-primary btn-block" value="current">View All Current Students</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </section>
                </div>
                <!--div class="col-sm-1"></div-->
            </div>
        </div>
    </div>
</section>

<br><br>
<?php
//include 'templates/footer.tpl';
?>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="js/pushy.min.js"></script>
</body>
</html>
<?php
}

//*******************************************************
//********************   PERPAGE   **********************
//*******************************************************
function per_page() {
	global $PHP_SELF, $mysqli, $hdmysqli, $msg, $perpage, $page;
    global $branches_tablename, $branchid, $branchname , $location;

    $perpage = $_POST['perpage'];
    if(!isset($perpage)) {
        $perpage = 10;
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
    case "GO":
        per_page();
    break;
    default:
        main_form();
    break;
}

?>