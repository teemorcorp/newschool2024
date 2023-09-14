<?php
/****************************************************
****   IHN Bible College
****   Designed by: Tom Moore
****   Written by: Tom Moore
****   (c) 2001 - 2021 TEEMOR eBusiness Solutions
****************************************************/
include 'tmp/globals.php';
session_start();
dbconnect();
if (!$mysqli) {
    die("Connection failed: " . mysqli_connect_error());
}

global $PHP_SELF, $mysqli, $msg, $notice, $notice_header, $notice_body, $fullname;
global $users_tablename, $userid, $useremail , $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $corecompletedate, $branchid, $role, $messages, $core_complete, $resetpwd;
global $system_tablename, $sysid, $president , $vice, $treasurer, $secretary, $directorafrica, $deanedu, $corecourses, $followers, $facebook, $twitter, $youtube, $linkedin, $info, $updatedate, $cookietime, $sysadminver, $verdate, $releasenotes, $goalamt, $curgoal;
global $menuid, $goal, $current, $pct, $userid;
    
    include "functions.php";
    
    if(!empty($_SESSION['userid'])){
        $userid = $_SESSION['userid'];

        // Attempt select query execution
        $sqla = "SELECT * FROM $users_tablename WHERE userid = '$userid'";
        if ($resulta = mysqli_query($mysqli, $sqla)) {
            if (mysqli_num_rows($resulta) > 0) {
                $rowa = mysqli_fetch_array($resulta);
                $isadmin = $rowa['isadmin'];
                $userfname = $rowa['userfname'];
                $userlname = $rowa['userlname'];
                $imagepath = $rowa['imagepath'];
                $fullname = $userfname." ".$userlname;
                // $uid = $rowa['userid'];
                // $email = $rowa['useremail'];
                // Free result set
                mysqli_free_result($resulta);
            } else {
                $msg = "<div class='alert alert-danger' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                <strong>ERROR!</strong> UserID Not Found!
                </div>";
            }
        } else {
            $msg = "<div class='alert alert-danger' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
            <strong>ERROR!</strong> Error updating record: " . $mysqli->error . "
            </div>";
        }
        // End attempt select query execution


        // // Attempt select query execution
        // // $sql = "SELECT * FROM $users_tablename WHERE userid = '$userid'";
        // echo "Line #24 Header<br>";
        // if ($result = $mysqli->query("SELECT * FROM $users_tablename WHERE userid = '$userid'")) {
        //     echo "Line #26 Header<br>";
        //     if(mysqli_num_rows($result) > 0){
        //         echo "Line #28 Header<br>";
        //         $row = mysqli_fetch_array($result);
        //         $isadmin = $row['isadmin'];
        //         $userfname = $row['userfname'];
        //         $userlname = $row['userlname'];
        //         $imagepath = $row['imagepath'];
        //         $fullname = $userfname." ".$userlname;
        //         // Free result set
        //         mysqli_free_result($result);
        //     } else{
        //         echo "Line #37 Header<br>";
        //         $msg = "<font color='#FF0000'><strong>Account not found!</strong></font>";
        //         main_form();
        //         exit;
        //     }
        // } else{
        //     echo "Line #43 Header<br>";
        //     echo "ERROR: Was not able to execute Query on line #152. " . mysqli_error($mysqli);
        // }
        // // End attempt select query execution
    }else{
        $imagepath = "NoPhoto.jpg";
        $fullname = 'Visitor';
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>IHN Bible College Online Campus</title>
		<meta name="author" content="TEEMOR eBiz Builder" />
		<meta name="keywords" content="" />
		<meta name="description" content="" />
		<link rel="shortcut icon" href="img/ihn_logo.png" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

        <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet" />

        <!-- **********************  TintMCE  ****************************************************************** -->
        <script src="https://cdn.tiny.cloud/1/qa5ollct4qx4a9lkzbhdh1ki6763pwyi6jx3m0s5ut86u8by/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <!-- **********************  END TintMCE  ******************************************************************-->

        <!-- **********************  JQUERY  ********************************************************************** -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
        <!-- **********************  END JQUERY  ******************************************************************-->

        <!-- ********************************************************************************************************
        *******  DATE PICKER / CALENDAR
        ***********************************************************************************************************-->
        <script>
            $( function() {
                $( "#datepicker" ).datepicker();
            } );
        </script>

        <!-- ********************************************************************************************************
        *******  ACCORDIAN
        ***********************************************************************************************************-->
        <script>
            $(function(){
                var icons = {
                    header: "ui-icon-circle-arrow-e",
                    activeHeader: "ui-icon-circle-arrow-s"
                };

                $("#accordion").accordion({
                    icons: icons
                });

                $("#toggle").button().on( "click", function(){
                    if ($("#accordion").accordion("option", "icons")){
                        $("#accordion").accordion("option", "icons", null);
                    }else{
                        $("#accordion").accordion("option", "icons", icons);
                    }
                });
            });
        </script>

        <link href="css/styles.css" rel="stylesheet" />
        
        <style>
            .modal {
                width: 800px;
                height: 800px;
                background-color: #ffffff;
                border: 1px solid #cccccc;
                padding: 20px;
                position: absolute;
                top: 40%;
                left: 50%;
                transform: translate(-50%, -50%);
                box-shadow: 0px 0px 10px #cccccc;
                border-radius: 10px;
                z-index:1000;
            }
        </style>
    </head>
    <body class="main" id="body-pd">
        <header class="header" id="header">
            <div class="header_toggle">
                <i class="bx bx-menu" id="header-toggle"></i>
            </div>
            <div class="text-white d-flex">
                <?php
                $msgcnt = 0;
                $mailcnt = 0;
                if(!empty($_SESSION['userid'])){
                    ?>
                    <div class="menu_icons">
                        <a class="btn btn-primary position-relative btn-circle" onClick="Javascript:window.location.href = 'notifications.php';">
                        <i class='bx bx-bell'></i>
                        <?php
                        if($msgcnt >= 1){
                            ?>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                <?php
                                    if($msgcnt >= 100){
                                        echo "99+";
                                    }else{
                                        echo $msgcnt;
                                    }
                                ?>
                                <span class="visually-hidden">unread messages</span>
                            </span>
                            <?php
                        }
                        ?>
                        </a>
                    </div>

                    <div class="menu_icons">
                        <a class="btn btn-primary position-relative btn-circle" onClick="Javascript:window.location.href = 'studentmail.php';">
                        <i class='bx bx-envelope'></i>
                        <?php
                        if($mailcnt >= 1){
                            ?>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                <?php
                                    if($mailcnt >= 100){
                                        echo "99+";
                                    }else{
                                        echo $mailcnt;
                                    }
                                ?>
                                <span class="visually-hidden">unread messages</span>
                            </span>
                            <?php
                        }
                        ?>
                        <!-- <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            <?php echo $mailcnt; ?>
                            <span class="visually-hidden">unread Mail</span>
                        </span> -->
                        </a>
                    </div>
                    <!-- <div class="menu_icons">
                        <a onClick="Javascript:window.location.href = 'notifications.php';"><i class='bx bx-bell'></i><span style="font-size: 18px;"> Notifications</span></a>
                    </div>
                    <div class="menu_icons">
                        <a onClick="Javascript:window.location.href = 'studentmail.php';"><i class='bx bx-envelope'></i><span style="font-size: 18px;"> Mail</span></a>
                    </div> -->
                    <?php
                }else{
                    ?>
                    <div class="menu_icons">
                        <a onClick="Javascript:window.location.href = 'admissions.php';"><i class='bx bxs-school nav_icon'></i><span style="font-size: 18px;"> Enroll Now</span></a>
                    </div>
                    <div class="menu_icons">
                        <a onClick="Javascript:window.location.href = 'login.php';"><i class='bx bx-log-in nav_icon'></i><span style="font-size: 18px;"> Student Login</span></a>
                    </div>
                    <?php
                }
                ?>
                <img class="header_img" src="img/portraits/<?php echo $imagepath; ?>" alt="" /> <div style="margin-top: 10px; margin-left: 10px;"><?php echo $fullname; ?></div>
            </div>
        </header>