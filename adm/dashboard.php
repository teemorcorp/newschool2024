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
global $PHP_SELF, $mysqli, $msg, $nextpage, $prevpage, $perpage, $fullname;
global $users_tablename, $userid, $useremail , $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $corecompletedate;
global $system_tablename, $sysid, $president, $vice, $treasurer, $secretary, $directorafrica, $deanedu, $corecourses, $followers, $facebook, $twitter, $youtube, $linkedin, $info;
global $programs_tablename, $progid, $progname, $enabled, $cost, $charge;
global $courses_tablename, $courseid, $cprogid, $coursecode, $coursename, $coursedesc, $credits, $filename, $validcourse;

$main_background_color = "#1c262f";
$sub_background_color = "#26333c"; 
$child_background_color = "#2f3d4a";

//$_SESSION['userid'] = "1";
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
    echo "ERROR: Was not able to execute Query on line #152. " . mysqli_error($mysqli);
}
// End attempt select query execution

/**********************************************************************************
****  COUNT ENROLLMENTS
**********************************************************************************/
// Attempt select query execution
$sql = "SELECT COUNT(*) AS 'TotalEnrolled' FROM $users_tablename WHERE isadmin = '0'";
if($result = mysqli_query($mysqli, $sql)){
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        $total_enrolled = $row['TotalEnrolled'];
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

/**********************************************************************************
****  COUNT PROGRAMS
**********************************************************************************/
// Attempt select query execution
$sql = "SELECT COUNT(*) AS 'TotalProgs' FROM $programs_tablename";
if($result = mysqli_query($mysqli, $sql)){
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        $total_progs = $row['TotalProgs'];
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

/**********************************************************************************
****  COUNT COURSES
**********************************************************************************/
// Attempt select query execution
$sql = "SELECT COUNT(*) AS 'TotalCourses' FROM $courses_tablename";
if($result = mysqli_query($mysqli, $sql)){
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        $total_courses = $row['TotalCourses'];
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

include 'templates/include.tpl';
include "templates/style.tpl";
?>
<body>
<div class='container-fluid'>
<?php
include "templates/topmenu.tpl";
// echo "Line #135";
// exit;
?>

<!-- *****************************************************************************************************
*******  MAIN
*******************************************************************************************************-->    
<section>
    <div class="row" style="height: 100vh;">
        <div class="col-sm-2" style="background-color:#1c262f; padding-left: 0px;">
            <?php include "templates/leftmenu.tpl"; ?>
        </div>
        <div class="col" style="height: 100vh;">
            <div class="row " style="padding-top:10px;">
                <div class="col">
                    <!-- *******************************************************************************************
                    **********  CARDS
                    *********************************************************************************************-->
                    <section style="padding-top:20px;">
                            <div class="row clearfix" style="padding-top:10px;">
                                <div class="col-4">
                                    <div class="card text-dark bg-warning" id="boxdisplay">
                                        <div class="card-header"><font size="+2"><strong>Total Students</strong></font></div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <font size="+4"><strong><?php echo $total_enrolled; ?></strong></font>
                                                    <br><br>
                                                </div>
                                                <div class="col" align="center">
                                                    <font size="+5"><i class="fas fa-users"></i></font>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <form action="<?php echo $PHP_SELF ?>" method="post">
                                                        <button type="submit" id="btnrounded" name="action" class="btn btn-light btn-block" value="viewstudents">View All</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="card text-white bg-primary" id="boxdisplay">
                                        <div class="card-header"><font size="+2"><strong>Total Programs</strong></font></div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <font size="+4"><strong><?php echo $total_progs; ?></strong></font>
                                                    <br><br>
                                                </div>
                                                <div class="col" align="center">
                                                    <font size="+5"><i class="fas fa-book-open"></i></font>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <form action="<?php echo $PHP_SELF ?>" method="post">
                                                        <button type="submit" id="btnrounded" name="action" class="btn btn-light btn-block" value="viewprogs">View All</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="card text-white bg-success" id="boxdisplay">
                                        <div class="card-header"><font size="+2"><strong>Total Courses</strong></font></div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <font size="+4"><strong><?php echo $total_courses; ?></strong></font>
                                                    <br><br>
                                                </div>
                                                <div class="col" align="center">
                                                    <font size="+5"><i class="fas fa-book-reader"></i></font>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <form action="<?php echo $PHP_SELF ?>" method="post">
                                                        <button type="submit" id="btnrounded" name="action" class="btn btn-light btn-block" value="viewcourses">View All</button>
                                                    </form>
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
                    <section style="padding-top:20px;">
                        <p>
                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                            Show More
                        </button>
                        </p>
                        <div class="collapse divrounded outlined" id="collapseExample">
                        <div class="card card-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                        </div>
                        </div>
                    </section>


                    <!-- *******************************************************************************************
                    **********  RECENT PRODUCTS
                    *********************************************************************************************-->
                    <!--section style="padding-top:20px;">
                        <div class="card text-dark bg-light mb-1" id="boxdisplay">
                            <div class="card-header"><font size="+2"><strong>Popular Product(s)</strong></font></div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Featured Image</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        < ?php
                                        if(!$tbl){
                                            ?>
                                            <tr>
                                                <td colspan="5"><center>No data available in table</center></td>
                                            </tr>
                                            < ?php
                                        }else{
                                            ?>
                                            <tr>
                                                <td>Mark</td>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>@mdo</td>
                                                <td>@mdo</td>
                                            </tr>
                                            < ?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section-->


                    <!-- *******************************************************************************************
                    **********  TOTAL SALES IN LAST 30 DAYS
                    *********************************************************************************************-->
                    <!--section style="padding-top:20px;">
                        <div class="card text-dark bg-light mb-1" id="boxdisplay">
                            <div class="card-header"><font size="+2"><strong>Popular Product(s)</strong></font></div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Featured Image</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        < ?php
                                        if(!$tbl){
                                            ?>
                                            <tr>
                                                <td colspan="5"><center>No data available in table</center></td>
                                            </tr>
                                            < ?php
                                        }else{
                                            ?>
                                            <tr>
                                                <td>Mark</td>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>@mdo</td>
                                                <td>@mdo</td>
                                            </tr>
                                            < ?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section-->


                    <!-- *******************************************************************************************
                    **********  TOP REFERALS / MOST USED OS
                    *********************************************************************************************-->
                    <!--section style="padding-top:20px;">
                        <div class="row clearfix" style="padding-top:10px;">
                            <div class="col-sm-6">
                                <div class="card text-dark bg-light mb-1" id="boxdisplay">
                                    <div class="card-header"><font size="+2"><strong>Top Referals</strong></font></div>
                                    <div class="card-body">
                                        <h5 class="card-title">Warning card title</h5>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card text-dark bg-light mb-1" id="boxdisplay">
                                    <div class="card-header"><font size="+2"><strong>Most Used OS</strong></font></div>
                                    <div class="card-body">
                                        <h5 class="card-title">Warning card title</h5>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section-->
                </div>
            </div>
        </div>
    </div>
</section>

<!--br><br-->
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
//**********************  SWITCH  ***********************
//*******************************************************
switch($action) {
	case "DELETE":
		delete_course();
	break;
	case "viewprogs":
		?>
            <script type="text/javascript">
                <!--
                //window.location = "main.php";
                window.top.location.href = "programs.php"; 
                -->
            </script>
        <?php
	break;
	case "viewcourses":
		?>
            <script type="text/javascript">
                <!--
                //window.location = "main.php";
                window.top.location.href = "courses.php"; 
                -->
            </script>
        <?php
	break;
	case "viewstudents":
		?>
            <script type="text/javascript">
                <!--
                //window.location = "main.php";
                window.top.location.href = "students.php"; 
                -->
            </script>
        <?php
	break;
	case "View/Modify":
		edit_record();
	break;
	case "Add New":
		add_new();
	break;
	default:
		main_form();
	break;
}
?>