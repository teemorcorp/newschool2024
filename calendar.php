<?php
/****************************************************
****   IHN Bible College
****   Designed by: Tom Moore
****   Written by: Tom Moore
****   (c) 2001 - 2021 TEEMOR eBusiness Solutions
****************************************************/
include "tmp/header.php";

global $system_tablename, $sysid, $president , $vice, $treasurer, $secretary, $directorafrica, $deanedu, $corecourses, $followers, $facebook, $twitter, $youtube, $linkedin, $info, $updatedate, $cookietime, $sysadminver, $verdate, $releasenotes, $goalamt, $curgoal;
global $menuid, $goal, $current, $pct, $userid;
global $notes_tablename, $noteid, $newstitle, $news, $eventtitle, $events, $schedtitle, $schedule, $newtitle, $newadded;

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
                    <p class="text-center"><span style="font-size: 32px;">Calendar</span></p>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="d-flex justify-content-center">
                                <span style="fornt-size: 18px; font-weight: bold;">Calendar</span><br>
                            </div>
                            <div class="d-flex justify-content-center">
                                <div id="datepicker"></div>
                            </div>
                        </div>
                        <div class="col-sm-6 d-flex justify-content-center">
                            <iframe src="https://calendar.google.com/calendar/embed?height=600&wkst=1&bgcolor=%23ffffff&ctz=America%2FPhoenix&showTitle=0&showPrint=0&showTabs=1&showCalendars=0&src=aWhuYmlibGVAZ21haWwuY29t&src=YWRkcmVzc2Jvb2sjY29udGFjdHNAZ3JvdXAudi5jYWxlbmRhci5nb29nbGUuY29t&color=%23039BE5&color=%2333B679" style="border:solid 1px #777" width="800" height="600" frameborder="0" scrolling="no"></iframe>
                        </div>
                        <div class="col-sm-3">
                            <div id="accordion" class="justify-content-center">
                                <?php
                                global $notes_tablename, $noteid, $newstitle, $news, $eventtitle, $events, $schedtitle, $schedule, $newtitle, $newadded;
                                // Attempt select query execution
                                $sql = "SELECT * FROM $notes_tablename";
                                if($result = mysqli_query($mysqli, $sql)){
                                    if(mysqli_num_rows($result) > 0){
                                        $row = mysqli_fetch_array($result);
                                        $noteid = $row['noteid'];
                                        $newstitle = $row['newstitle'];
                                        $news = $row['news'];
                                        $eventtitle = $row['eventtitle'];
                                        $events = $row['events'];
                                        $schedtitle = $row['schedtitle'];
                                        $schedule = $row['schedule'];
                                        $newtitle = $row['newtitle'];
                                        $newadded = $row['newadded'];
                                        // Free result set
                                        mysqli_free_result($result);
                                    } else{
                                        $msg = "<font color='#FF0000'><strong>Account Does Not Exsist!</strong></font>";
                                    }
                                } else{
                                    echo "ERROR: Was not able to execute Query on line #152. " . mysqli_error($mysqli);
                                }
                                // End attempt select query execution
                                ?>
                                <h3><?php echo $newstitle; ?></h3>
                                <div>
                                    <?php echo substr_replace($news, "", 700); ?>
                                </div>
                                <h3><?php echo $eventtitle; ?></h3>
                                <div>
                                    <?php echo substr_replace($events, "", 700); ?>
                                </div>
                                <h3><?php echo $schedtitle; ?></h3>
                                <div>
                                    <?php echo substr_replace($schedule, "", 700); ?>
                                </div>
                                <h3><?php echo $newtitle; ?></h3>
                                <div>
                                    <?php echo substr_replace($newadded, "", 700); ?>
                                </div>
                            </div>
                        
                        <!-- <button id="toggle">Toggle icons</button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="boxed" style="margin-bottom: 50px;">&nbsp;</div>
</div>
<?php
include "tmp/footer.php";
?>

