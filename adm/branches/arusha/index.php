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

global $PHP_SELF, $mysqli, $msg, $nextpage, $prevpage, $perpage;
global $users_tablename, $userid, $useremail , $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $corecompletedate;
global $system_tablename;

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
                    **********  POPULAR PRODUCTS
                    *********************************************************************************************-->
                    <section name="Website Options" style="padding-top:20px;">
                        <div class="card text-dark bg-light mb-1" id="boxdisplay">
                            <div class="card-header"><font size="+2"><strong>IHN Bible College - Arusha Branch</strong></font></div>
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
                                        <?php
                                        if(!$tbl){
                                            ?>
                                            <tr>
                                                <td colspan="5"><center>No data available in table</center></td>
                                            </tr>
                                            <?php
                                        }else{
                                            ?>
                                            <tr>
                                                <td>Mark</td>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>@mdo</td>
                                                <td>@mdo</td>
                                            </tr>
                                            <?php
                                        }
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