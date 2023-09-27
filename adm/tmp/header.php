<?php
/****************************************************
****   IHN Bible College
****   Designed by: Tom Moore
****   Written by: Tom Moore
****   (c) 2001 - 2021 TEEMOR eBusiness Solutions
****************************************************/
include 'globals.php';
session_start();
dbconnect();
if (!$mysqli) {
    die("Connection failed: " . mysqli_connect_error());
}

global $PHP_SELF, $mysqli, $msg, $menuid, $fullname;
global $users_tablename, $userid, $useremail , $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $corecompletedate, $branchid, $role, $messages, $core_complete, $resetpwd;
global $system_tablename, $sysid, $president , $vice, $treasurer, $secretary, $directorafrica, $deanedu, $corecourses, $followers, $facebook, $twitter, $youtube, $linkedin, $info, $updatedate, $cookietime, $sysadminver, $verdate, $releasenotes, $goalamt, $curgoal;
global $prayers_tablename, $prayerid, $prayee, $prayer_request, $answered;
    
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
		<meta name="author" content="TEEMOR eBusiness Solutions" />
		<meta name="keywords" content="" />
		<meta name="description" content="" />
		<link rel="shortcut icon" href="../img/ihn_logo.png" />

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
            $(function(){
                $("#datepicker").datepicker();
            });
        </script>

        <!-- ********************************************************************************************************
        *******  SIDE MENU
        ***********************************************************************************************************-->
        <script>
            $( function() {
                $( "#menu" ).menu();
            } );
        </script>
        <style>
            .ui-menu { width: 100%; }
        </style>

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

        <!-- ********************************************************************************************************
        *******  MODAL
        ***********************************************************************************************************--> 
        <script>
            $(function(){
                $("#dialog").dialog({
                    autoOpen: false,
                    show:{
                        effect: "blind",
                        duration: 1000
                    },
                    hide:{
                        effect: "explode",
                        duration: 1000
                    }
                });
            
                $("#opener").on("click", function(){
                    $("#dialog").dialog("open");
                });

                $(".selector").dialog({
                    width: 800
                });

                $(".selector").dialog({
                    buttons: [{
                        text: "Ok",
                        icon: "ui-icon-heart",
                        click: function() {
                            $( this ).dialog( "close" );
                        }
                    
                        // Uncommenting the following line would hide the text,
                        // resulting in the label being used as a tooltip
                        //showText: false
                    }]
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
    <body>
        <nav class="navbar navbar-expand-lg bg-body-tertiary header">
            <div class="container-fluid d-flex">
                <a class="navbar-brand text-white" href="#"><img src="../img/ihnbible_logo_900x150.jpg" style="width: 200px;" alt="IHN Bible"></a>
                <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon text-white"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <!-- <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                        </li> -->
                    </ul>
                    <span class="navbar-text d-flex text-white">
                        <?php
                        $msgcnt = 0;
                        $mailcnt = 0;
                        if(!empty($_SESSION['userid'])){
                            ?>
                            <div class="menu_icons">
                                <a class="btn btn-primary position-relative btn-circle" onClick="Javascript:window.location.href = '../notifications.php';">
                                    <span style="font-weight: bold;"><i class='bx bx-bell text-white' style="font-weight: bold; font-size: 18px;"></i></span>
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
                                <a class="btn btn-primary position-relative btn-circle" onClick="Javascript:window.location.href = '../studentmail.php';">
                                    <span style="font-weight: bold;"><i class='bx bx-envelope text-white' style="font-weight: bold; font-size: 18px;"></i></span>
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
                                </a>
                            </div>
                            <?php
                        }else{
                            ?>
                            <div class="menu_icons">
                                <a onClick="Javascript:window.location.href = '../admissions.php';"><i class='bx bxs-school nav_icon'></i><span style="font-size: 18px;"> Enroll Now</span></a>
                            </div>
                            <div class="menu_icons">
                                <a onClick="Javascript:window.location.href = '../login.php';"><i class='bx bx-log-in nav_icon'></i><span style="font-size: 18px;"> Student Login</span></a>
                            </div>
                            <?php
                        }

                        if(empty($imagepath)){
                            ?>
                            <img class="header_img" style="margin-top: 2px;" src="../img/portraits/NoPhoto.jpg" alt="" /> <div style="margin-top: 13px; margin-left: 10px;"><?php echo $fullname; ?></div>
                            <?php
                        }else{
                            ?>
                            <img class="header_img" style="margin-top: 2px;" src="../img/portraits/<?php echo $imagepath; ?>" alt="" /> <div style="margin-top: 13px; margin-left: 10px;"><?php echo $fullname; ?></div>
                            <?php
                        }
                        ?>
                    </span>
                </div>
            </div>
        </nav>