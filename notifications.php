<?php
/****************************************************
****   IHN Bible College
****   Designed by: Tom Moore
****   Written by: Tom Moore
****   (c) 2001 - 2021 TEEMOR eBusiness Solutions
****************************************************/
include "tmp/header.php";

global $PHP_SELF, $mysqli, $msg, $notice, $notice_header, $notice_body, $fullname;
global $system_tablename, $sysid, $president , $vice, $treasurer, $secretary, $directorafrica, $deanedu, $corecourses, $followers, $facebook, $twitter, $youtube, $linkedin, $info, $updatedate, $cookietime, $sysadminver, $verdate, $releasenotes, $goalamt, $curgoal;
global $users_tablename, $userid, $useremail , $userpassword, $isadmin, $userfname, $usermname, $userlname, $useraddress, $usercity, $userstate, $userzip, $usercountry, $userphone, $suspended, $highgrade, $dob, $usersaved, $baptized, $baptismdate, $profile, $imagepath, $corecompletedate, $branchid, $role, $messages, $core_complete, $resetpwd;
global $menuid, $goal, $current, $pct, $userid;

information_modal();
if(!empty($_SESSION['userid'])){
    $userid = $_SESSION['userid'];
}

?>
<div class="height-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2"><?php menu(); ?></div>
            <div class="col-sm-10">
                <!-- <h4>Dashboard</h4> -->
                <br>
                <div id="boxed">
                    <p class="text-center"><span style="font-size: 32px;">Notifications</span></p>
                </div>

                <div id="boxed" style="margin-bottom: 50px;">&nbsp;</div>
            </div>
        </div>
    </div>
</div>
<?php
include "tmp/footer.php";
?>