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
                    <div class="row ml-12 mr-12 clearfix">
                        <div class="col" align="center">
                                <?php
                                if(empty($_SESSION['userid'])){
                                    ?>
                                    <font size="+3"><strong>Welcome to Our Courses, Visitor!</strong></font>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <?php
                                }else{
                                    ?>
                                    <font size="+3"><strong>Welcome to Your Courses, <?php echo $userfname; ?>!</strong></font>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <?php
                                }
                                ?>
                                <!-- <button type="button" id="btnrounded" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#information_modal">Update as of <?php echo date('m/d/Y'); ?></button> -->
                                <br>
                                <button type="button" class="btn btn-warning" id="opener">Update as of <?php echo date('m/d/Y'); ?></button>
                                <br><br>
                        </div>
                    </div>
                </div>

                <div id="boxed" class="text-center">
                    <p><span style="font-size: 32px;">Get familiar with our online campus!</span></p>
                            
                    <div class="row ml-12 mr-12 clearfix">
                        <div class="col-sm-4" align="center">
                            <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#videoOne">
                                Watch this Introduction video!
                            </button> -->
                        </div>
                        <div class="col-sm-4" align="center">
                            <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#videoTwo">
                                How to use this site
                            </button> -->
                        </div>
                        <div class="col-sm-4" align="center">
                            <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#videoThree">
                                How to enroll into a degree program
                            </button> -->
                        </div>
                        <!--div class="col-sm-2" align="center">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#videoOne">
                                Coming Soon . . .
                            </button>
                        </div-->
                        <div class="col-sm-2" align="center"></div>
                    </div>
                </div>

                <div id="boxed" class="text-center">
                    <p><span style="font-size: 32px;">Check out our </span><span style="font-size: 40px; font-weight: bold;">Programs</span> <span style="font-size: 32px;">and</span> <span style="font-size: 40px; font-weight: bold;">Courses</span> <span style="font-size: 32px;">!</span></p>

                    <div class="card-group center-cards">
                        <a href="prog_abs.php" class="card-link">
                            <div class="card-boarder card_color_associate">
                                <span style="font-weight: bold;">Associate Degree of Biblical Studies</span>
                                <br><br>
                                <p class="card-text">Prerequisite to all programs.</p>
                                <p class="card-text"><small class="text-muted">20 Courses 60 Credits</small></p>
                            </div>
                        </a>

                        <!-- BACHELOR STUDIES -->
                        <a href="#bbs" class="card-link">
                            <div class="card-boarder card_color_bachelor">
                                <span style="font-weight: bold;">Bachelor Degree of Biblical Studies</span>
                                <br><br>
                                <p class="card-text"><img src="img/undercon.gif" alt=""> Under Construction</p>
                                <p class="card-text"><small class="text-muted">12 Courses 48 Credits</small></p>
                            </div>
                        </a>
                        <a href="#bth" class="card-link">
                            <div class="card-boarder card_color_bachelor">
                                <span style="font-weight: bold;">Bachelor Degree of Theology</span>
                                <br><br>
                                <p class="card-text"><img src="img/undercon.gif" alt=""> Under Construction</p>
                                <p class="card-text"><small class="text-muted">12 Courses 48 Credits</small></p>
                            </div>
                        </a>
                        <a href="#bsw" class="card-link">
                            <div class="card-boarder card_color_bachelor">
                                <span style="font-weight: bold;">Bachelor Degree of Social Work</span>
                                <br><br>
                                <p class="card-text"><img src="img/undercon.gif" alt=""> Under Construction</p>
                                <p class="card-text"><small class="text-muted">12 Courses 48 Credits</small></p>
                            </div>
                        </a>
                        <a href="#bcl" class="card-link">
                            <div class="card-boarder card_color_bachelor">
                                <span style="font-weight: bold;">Bachelor Degree of Christian Leadership</span>
                                <br><br>
                                <p class="card-text"><img src="img/undercon.gif" alt=""> Under Construction</p>
                                <p class="card-text"><small class="text-muted">12 Courses 48 Credits</small></p>
                            </div>
                        </a>
                        <a href="#bce" class="card-link">
                            <div class="card-boarder card_color_bachelor">
                                <span style="font-weight: bold;">Bachelor Degree of Christian Education</span>
                                <br><br>
                                <p class="card-text"><img src="img/undercon.gif" alt=""> Under Construction</p>
                                <p class="card-text"><small class="text-muted">12 Courses 48 Credits</small></p>
                            </div>
                        </a>
                        <a href="#bmn" class="card-link">
                            <div class="card-boarder card_color_bachelor">
                                <span style="font-weight: bold;">Bachelor Degree of Ministry</span>
                                <br><br>
                                <p class="card-text"><img src="img/undercon.gif" alt=""> Under Construction</p>
                                <p class="card-text"><small class="text-muted">12 Courses 48 Credits</small></p>
                            </div>
                        </a>

                        <!-- MASTER STUDIES -->
                        <!-- <div class="card-boarder card_color_master">
                            <span style="font-weight: bold;">Master Degree of Biblical Studies</span>
                            <br><br>
                            <p class="card-text"><img src="img/undercon.gif" alt=""> Under Construction</p>
                            <p class="card-text"><small class="text-muted">10 Courses 40 Credits</small></p>
                        </div>
                        <div class="card-boarder card_color_master">
                            <span style="font-weight: bold;">Master Degree of Theology</span>
                            <br><br>
                            <p class="card-text"><img src="img/undercon.gif" alt=""> Under Construction</p>
                            <p class="card-text"><small class="text-muted">10 Courses 40 Credits</small></p>
                        </div>
                        <div class="card-boarder card_color_master">
                            <span style="font-weight: bold;">Master Degree of Social Work</span>
                            <br><br>
                            <p class="card-text"><img src="img/undercon.gif" alt=""> Under Construction</p>
                            <p class="card-text"><small class="text-muted">10 Courses 40 Credits</small></p>
                        </div>
                        <div class="card-boarder card_color_master">
                            <span style="font-weight: bold;">Master Degree of Christian Leadership</span>
                            <br><br>
                            <p class="card-text"><img src="img/undercon.gif" alt=""> Under Construction</p>
                            <p class="card-text"><small class="text-muted">10 Courses 40 Credits</small></p>
                        </div> -->

                        <!-- DOCTORATE STUDIES -->
                        <!-- <div class="card-boarder card_color_doctor">
                            <span style="font-weight: bold;">Doctorate Degree of Biblical Studies</span>
                            <br><br>
                            <p class="card-text"><img src="img/undercon.gif" alt=""> Under Construction</p>
                            <p class="card-text"><small class="text-muted">10 Courses 40 Credits</small></p>
                        </div>
                        <div class="card-boarder card_color_doctor">
                            <span style="font-weight: bold;">Doctorate Degree of Theology</span>
                            <br><br>
                            <p class="card-text"><img src="img/undercon.gif" alt=""> Under Construction</p>
                            <p class="card-text"><small class="text-muted">10 Courses 40 Credits</small></p>
                        </div>
                        <div class="card-boarder card_color_doctor">
                            <span style="font-weight: bold;">Doctorate Degree of Social Work</span>
                            <br><br>
                            <p class="card-text"><img src="img/undercon.gif" alt=""> Under Construction</p>
                            <p class="card-text"><small class="text-muted">10 Courses 40 Credits</small></p>
                        </div>
                        <div class="card-boarder card_color_doctor">
                            <span style="font-weight: bold;">Doctorate Degree of Christian Leadership</span>
                            <br><br>
                            <p class="card-text"><img src="img/undercon.gif" alt=""> Under Construction</p>
                            <p class="card-text"><small class="text-muted">10 Courses 40 Credits</small></p>
                        </div> -->
                        
                        <!-- CERTIFICATIONS -->
                        <a href="#" class="card-link">
                            <div class="card-boarder card_color_cert">
                                <span style="font-weight: bold;">IHN College Teaching Certificate</span>
                                <br><br>
                                <p class="card-text"><img src="img/undercon.gif" alt=""> Under Construction</p>
                                <p class="card-text"><small class="text-muted">10 Courses 40 Credits</small></p>
                            </div>
                        </a>
                        <a href="#" class="card-link">
                            <div class="card-boarder card_color_cert">
                                <span style="font-weight: bold;">IHN College Pastoral Certificate</span>
                                <br><br>
                                <p class="card-text"><img src="img/undercon.gif" alt=""> Under Construction</p>
                                <p class="card-text"><small class="text-muted">10 Courses 40 Credits</small></p>
                            </div>
                        </a>
                        <a href="#" class="card-link">
                            <div class="card-boarder card_color_cert">
                                <span style="font-weight: bold;">IHN College Counseling Certificate</span>
                                <br><br>
                                <p class="card-text"><img src="img/undercon.gif" alt=""> Under Construction</p>
                                <p class="card-text"><small class="text-muted">10 Courses 40 Credits</small></p>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12" id="bbs">
                        <div class="card spacing">
                            <div class="card-body">
                                <span style="font-weight: bold; font-size: 18px;">Bachelor Degree of Biblical Studies</span>
                                <p class="card-text">12 Courses 48 Credits</p>
                                <div class="row">
                                    <div class="col-4">
                                        <strong>BIB201</strong><br>Acts of the Apostles<br>
                                        <strong>BIB202</strong><br>Basic Doctrine I<br>
                                        <strong>MIN202</strong><br>Discipleship<br>
                                        <strong>MIN203</strong><br>Evangelism<br>
                                    </div>
                                    <div class="col-4">
                                        <strong>BIB205</strong><br>Genesis<br>
                                        <strong>THE201</strong><br>Holy Spirit<br>
                                        <strong>BIB206</strong><br>Interpreting the Scriptures<br>
                                        <strong>ETH204</strong><br>Life Management I<br>
                                    </div>
                                    <div class="col-4">
                                        <strong>BIB207</strong><br>Life of Christ<br>
                                        <strong>BIB208</strong><br>Life of Moses<br>
                                        <strong>MIN209</strong><br>Victorious Christianity<br>
                                        <strong>MIN211</strong><br>Walking in Present Truth<br>
                                    </div>
                                </div>
                                <a href="#" class="btn btn-primary" style="margin-top: 20px;">Enroll Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12" id="bth">
                        <div class="card spacing">
                            <div class="card-body">
                                <span style="font-weight: bold; font-size: 18px;">Bachelor Degree of Theology</span>
                                <p class="card-text">12 Courses 48 Credits</p>
                                <div class="row">
                                    <div class="col-4">
                                        <strong>BIB201</strong><br>Acts of the Apostles<br>
                                        <strong>BIB202</strong><br>Basic Doctrine I<br>
                                        <strong>BIB203</strong><br>Basic Doctrine II<br>
                                        <strong>BIB205</strong><br>Genesis<br>
                                    </div>
                                    <div class="col-4">
                                        <strong>THE201</strong><br>Holy Spirit<br>
                                        <strong>MIN204</strong><br>Homiletics<br>
                                        <strong>BIB206</strong><br>Interpreting the Scriptures<br>
                                        <strong>BIB209</strong><br>New Testament Survey II<br>
                                    </div>
                                    <div class="col-4">
                                        <strong>BIB210</strong><br>Old Testament Survey II<br>
                                        <strong>BIB211</strong><br>Prayer and Personal Bible Study<br>
                                        <strong>BIB207</strong><br>Life of Christ<br>
                                        <strong>BIB208</strong><br>Life of Moses<br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12" id="bcc">
                        <div class="card spacing">
                            <div class="card-body">
                                <span style="font-weight: bold; font-size: 18px;">Bachelor Degree of Christian Counseling</span>
                                <p class="card-text">12 Courses 48 Credits</p>
                                <div class="row">
                                    <div class="col-4">
                                        <strong>BIB202</strong><br>Basic Doctrine I<br>
                                        <strong>SOC201</strong><br>Biblical Counseling<br>
                                        <strong>SOC202</strong><br>Current Trends<br>
                                        <strong>MIN202</strong><br>Discipleship<br>
                                    </div>
                                    <div class="col-4">
                                        <strong>ETH203</strong><br>Family Issues<br>
                                        <strong>ETH204</strong><br>Life Management I<br>
                                        <strong>MIN207</strong><br>Ministering to Personal Needs<br>
                                        <strong>BIB211</strong><br>Prayer and Personal Bible Study<br>
                                    </div>
                                    <div class="col-4">
                                        <strong>ETH207</strong><br>Social Roles & Relationships<br>
                                        <strong>MIN209</strong><br>Victorious Christianity<br>
                                        <strong>MIN210</strong><br>Visions and Values<br>
                                        <strong>MIN211</strong><br>Walking in Present Truth<br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12" id="bcl">
                        <div class="card spacing">
                            <div class="card-body">
                                <span style="font-weight: bold; font-size: 18px;">Bachelor Degree of Christian Leadership</span>
                                <p class="card-text">12 Courses 48 Credits</p>
                                <div class="row">
                                    <div class="col-4">
                                        <strong>BIB202</strong><br>Basic Doctrine I<br>
                                        <strong>SOC201</strong><br>Biblical Counseling<br>
                                        <strong>MIN201</strong><br>Church Planting<br>
                                        <strong>MIN202</strong><br>Discipleship<br>
                                    </div>
                                    <div class="col-4">
                                        <strong>MIN205</strong><br>Leadership<br>
                                        <strong>ETH204</strong><br>Life Management I<br>
                                        <strong>BIB207</strong><br>Life of Christ<br>
                                        <strong>BIB208</strong><br>Life of Moses<br>
                                    </div>
                                    <div class="col-4">
                                        <strong>MIN206</strong><br>Local Church<br>
                                        <strong>MIN208</strong><br>Pastoral Ministry<br>
                                        <strong>ETH207</strong><br>Social Roles & Relationships<br>
                                        <strong>MIN210</strong><br>Visions and Values<br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12" id="bce">
                        <div class="card spacing">
                            <div class="card-body">
                                <span style="font-weight: bold; font-size: 18px;">Bachelor Degree of Christian Education</span>
                                <p class="card-text">12 Courses 48 Credits</p>
                                <div class="row">
                                    <div class="col-4">
                                        <strong>BIB201</strong><br>Acts of the Apostles<br>
                                        <strong>BIB202</strong><br>Basic Doctrine I<br>
                                        <strong>SOC201</strong><br>Biblical Counseling<br>
                                        <strong>SOC202</strong><br>Current Trends<br>
                                    </div>
                                    <div class="col-4">
                                        <strong>MIN202</strong><br>Discipleship<br>
                                        <strong>MIN204</strong><br>Homiletics<br><br>
                                        <strong>BIB206</strong><br>Interpreting the Scriptures<br>
                                        <strong>MIN205</strong><br>Leadership<br>
                                    </div>
                                    <div class="col-4">
                                        <strong>ETH204</strong><br>Life Management I<br>
                                        <strong>BIB209</strong><br>New Testament Survey II<br>
                                        <strong>BIB210</strong><br>Old Testament Survey II<br>
                                        <strong>MIN211</strong><br>Walking in Present Truth<br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12" id="bmn">
                        <div class="card spacing">
                            <div class="card-body">
                                <span style="font-weight: bold; font-size: 18px;">Bachelor Degree of Ministry</span>
                                <p class="card-text">12 Courses 48 Credits</p>
                                <div class="row">
                                    <div class="col-4">
                                        <strong>BIB201</strong><br>Acts of the Apostles<br>
                                        <strong>MIN201</strong><br>Church Planting<br>
                                        <strong>MIN202</strong><br>Discipleship<br>
                                        <strong>MIN203</strong><br>Evangelism<br>
                                    </div>
                                    <div class="col-4">
                                        <strong>THE201</strong><br>Holy Spirit<br>
                                        <strong>BIB206</strong><br>Interpreting the Scriptures<br>
                                        <strong>MIN205</strong><br>Leadership<br>
                                        <strong>BIB207</strong><br>Life of Christ<br>
                                    </div>
                                    <div class="col-4">
                                        <strong>MIN206</strong><br>Local Church<br>
                                        <strong>MIN207</strong><br>Ministering to Personal Needs<br>
                                        <strong>MIN208</strong><br>Pastoral Ministry<br>
                                        <strong>BIB211</strong><br>Prayer and Personal Bible Study<br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php
        $news = $currentnotes;
    ?>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="margin-top: 80px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Latest News</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo $news; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Welcome Video -->
    <div class="modal fade" id="videoOne" tabindex="-1" role="dialog" aria-labelledby="videoOneLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="margin-top: 80px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Welcome Video</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" align="center">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/4liWMlkpupg" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- How to Use This Site Video -->
    <div class="modal fade" id="videoTwo" tabindex="-1" role="dialog" aria-labelledby="videoTwoLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="margin-top: 80px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">How to Use This Site</h5>
                    <!-- <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> -->
                </div>
                <div class="modal-body" align="center">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/nTL5gtP0nyg" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- How to Enroll Video -->
    <div class="modal fade" id="videoThree" tabindex="-1" role="dialog" aria-labelledby="videoThreeLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="margin-top: 80px;">
                <div class="modal-header">
                    <!-- <h5 class="modal-title" id="exampleModalLabel">How to Enroll</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> -->
                </div>
                <div class="modal-body" align="center">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/D7Ef4kM5BLg" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div id="dialog" class="selector" title="Latest News">
        <?php echo $news; ?>
    </div>

    <div id="boxed" style="margin-bottom: 50px;">&nbsp;</div>
</div>
<?php
include "tmp/footer.php";
?>