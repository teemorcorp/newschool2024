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
    global $system_tablename, $sysid, $president , $vice, $treasurer, $secretary, $directorafrica, $deanedu, $corecourses, $followers, $facebook, $twitter, $youtube, $linkedin, $info, $updatedate, $cookietime, $sysadminver, $verdate, $releasenotes, $goalamt, $curgoal;
    global $prayers_tablename, $prayerid, $prayee, $prayer_request, $answered;
    global $menuid, $goal, $current, $pct, $userid;
    include "tmp/header.php";
    information_modal();

    $menuid = 3;
    if(!empty($_SESSION['userid'])){
        $userid = $_SESSION['userid'];
    }

    testadmin();

    ?>
<div class="height-100">
    <br>
    <div id="boxed">
        <div class="row ml-12 mr-12 clearfix">
            <form action="<?php echo $PHP_SELF; ?>" method="post">
                <p class="text-center"><span style="font-size: 32px;">Join Us In Prayer</span></p>
                    <p><?php echo $msg."<br>"; ?></p>
                <div class="col-sm-2"></div>
                <div class="col-sm-4 text-center">
                    <button name="action" type="submit" class="btn btn-primary" value="add_prayer">Add Prayer Request</button>
                </div>
                <div class="col-sm-4 text-center">
                    <a href="#"></a>
                </div>
                <div class="col-sm-2"></div>
            </form>
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
                $sql = "SELECT COUNT(*) AS 'TotalItems' FROM $prayers_tablename";
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
                    if ($result = $mysqli->query("SELECT * FROM $prayers_tablename")) {
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
                                        <?php
                                        if($answered){
                                            echo "<button class='btn btn-success' style='width; 100%;'>ANSWERED</button>";
                                        }else{
                                            echo "<button class='btn btn-warning' style='width; 100%;'>NOT ANSWERED</button>";
                                        }
                                        ?>
                                    </td>
                                <tr>
                                <?php
                            }
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<font color='#FF0000'><strong>No record found!</strong></font>";
                            // main_form();
                            // exit;
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
    include 'tmp/globals.php';
    session_start();
    dbconnect();

    if (!$mysqli) {
        die("Connection failed: " . mysqli_connect_error());
    }

	global $PHP_SELF, $mysqli, $msg, $result;
    global $prayers_tablename, $prayerid, $prayee, $prayer_request, $answered;

    $prayee = $_POST['prayee'];
    $prayer_request = $_POST['prayer'];

    if(empty($prayee)){
        $msg = "<div class='alert alert-danger' role='alert'>
        <button type='button' class='close' data-bs-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>ERROR!</strong> You must enter a name to pray for.
        </div>";
        main_form();
        exit;
    }

    if(empty($prayer_request)){
        $msg = "<div class='alert alert-danger' role='alert'>
        <button type='button' class='close' data-bs-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>ERROR!</strong> You must enter a prayer request.
        </div>";
        main_form();
        exit;
    }

    // Attempt select query execution
    $sql = "INSERT INTO $prayers_tablename (prayerid, prayee, prayer_request, answered) VALUES(NULL, '$prayee', '$prayer_request', '0')";
echo "Line #251<br>";
    if($result = mysqli_query($mysqli, $sql)){
echo "Line #253<br>";
        $msg = "<div class='alert alert-success' role='alert'>
        <button type='button' class='close' data-bs-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>SUCCESS!</strong> Prayer added successfully!
        </div>";
    } else{
echo "Line #259<br>";
        $msg = "<div class='alert alert-danger' role='alert'>
        <button type='button' class='close' data-bs-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>ERROR!</strong> Error adding prayer: " . $mysqli->error . "
        </div>";
    }
    // End attempt select query execution
    
echo "Line #267<br>";
    main_form();
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
//**********************  SWITCH  ***********************
//*******************************************************
switch($action) {
    case "GO":
        per_page();
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