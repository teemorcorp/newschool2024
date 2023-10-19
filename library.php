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
                    <p class="text-center"><span style="font-size: 32px;">Library</span></p>
                    <div class="row">
                        <div class="col-sm-12 d-flex justify-content-center">
                            <div id="tabs" style="width: 100%;">
                                <ul>
                                    <li><a href="#tabs-1">Apologetics</a></li>
                                    <li><a href="#tabs-2">Bible Studies</a></li>
                                    <li><a href="#tabs-3">Bible Surveys</a></li>
                                    <li><a href="#tabs-13">Bibles</a></li>
                                    <li><a href="#tabs-4">Biographies</a></li>
                                    <li><a href="#tabs-5">Christian Counseling</a></li>
                                    <li><a href="#tabs-6">Christian Ethics</a></li>
                                    <li><a href="#tabs-7">Christian Living</a></li>
                                    <li><a href="#tabs-8">Christian References</a></li>
                                    <li><a href="#tabs-9">Doctrine</a></li>
                                    <li><a href="#tabs-10">Education</a></li>
                                    <li><a href="#tabs-11">Evangelism</a></li>
                                    <li><a href="#tabs-12">Hermeneutics/Homiletics</a></li>
                                    <li><a href="#tabs-14">Ministry/Missions</a></li>
                                    <li><a href="#tabs-15">Miscellaneous Books</a></li>
                                    <li><a href="#tabs-16">Partnership</a></li>
                                    <li><a href="#tabs-17">Philosophers/Theologians</a></li>
                                    <li><a href="#tabs-18">Philosophy/Religions</a></li>
                                    <li><a href="#tabs-19">Resources</a></li>
                                    <li><a href="#tabs-20">Theology</a></li>
                                    <li><a href="#tabs-21">Worship</a></li>
                                </ul>

                                <div id="tabs-1">
                                    <h2>Apologetics</h2>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <ul class="library">
                                                <li><a class="list" href="library/Apologetics/Apologetic Conversations by Vincent Cheung.pdf" target="_blank">Apologetic Conversations by Vincent Cheung</a></li>
                                                <li><a class="list" href="library/Apologetics/Faith With Reason.pdf" target="_blank">Faith With Reason</a></li>
                                                <li><a class="list" href="library/Apologetics/Ultimate Questions by Vincent Cheung.pdf" target="_blank">Ultimate Questions by Vincent Cheung</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <ul class="library">
                                                <li><a class="list" href="library/Apologetics/Captive to Reason.pdf" target="_blank">Captive to Reason</a></li>
                                                <li><a class="list" href="library/Apologetics/Intro to Apologetics - The Many Faces and Causes of Unbelief.pdf" target="_blank">Intro to Apologetics - The Many Faces and Causes of Unbelief</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <ul class="library">
                                                <li><a class="list" href="library/Apologetics/Defending the Faith.pdf" target="_blank">Defending the Faith</a></li>
                                                <li><a class="list" href="library/Apologetics/Presuppositional Confrontations by Vincent Cheung.pdf" target="_blank">Presuppositional Confrontations by Vincent Cheung</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div id="tabs-2">
                                    <h2>Bible Studies</h2>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <ul class="library">
                                                <li><a class="list" href="library/BibleStudies/Bible Introduction 101.pdf" target="_blank">Bible Introduction 101</a></li>
                                                <li><a class="list" href="library/BibleStudies/Commentary on the Epistles to the Seven Churches in Asia - Trench.pdf" target="_blank">Commentary on the Epistles to the Seven Churches in Asia - Trench</a></li>
                                                <li><a class="list" href="library/BibleStudies/Introduction to the New Testament.pdf" target="_blank">Introduction to the New Testament</a></li>
                                                <li><a class="list" href="library/BibleStudies/Luther on Galatians.pdf" target="_blank">Luther on Galatians</a></li>
                                                <li><a class="list" href="library/BibleStudies/Salvation in the Old Testament.pdf" target="_blank">Salvation in the Old Testament</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <ul class="library">
                                                <li><a class="list" href="library/BibleStudies/Bible Studies.pdf" target="_blank">Bible Studies</a></li>
                                                <li><a class="list" href="library/BibleStudies/Epistles of St Paul.pdf" target="_blank">Epistles of St Paul</a></li>
                                                <li><a class="list" href="library/BibleStudies/Jeremiah-Constable.pdf" target="_blank">Jeremiah-Constable</a></li>
                                                <li><a class="list" href="library/BibleStudies/Minor Prophets.pdf" target="_blank">Minor Prophets</a></li>
                                                <li><a class="list" href="library/BibleStudies/Story_of_Kingdom_Explanation_of_Bible.pdf" target="_blank">Story of Kingdom Explanation of Bible</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <ul class="library">
                                                <li><a class="list" href="library/BibleStudies/Brief Bible History - Machen.pdf" target="_blank">Brief Bible History - Machen</a></li>
                                                <li><a class="list" href="library/BibleStudies/How to Study and Teach the Bible.pdf" target="_blank">How to Study and Teach the Bible</a></li>
                                                <li><a class="list" href="library/BibleStudies/Jerusalem in the NT.pdf" target="_blank">Jerusalem in the NT</a></li>
                                                <li><a class="list" href="library/BibleStudies/Observations on Daniel - Newton.pdf" target="_blank">Observations on Daniel - Newton</a></li>
                                                <li><a class="list" href="library/BibleStudies/The Translation of the Word - Graham.pdf" target="_blank">The Translation of the Word - Graham</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div id="tabs-3">
                                    <h2>Bible Surveys</h2>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <ul class="library">
                                                <li><a class="list" href="library/BibleSurveys/Bible Introduction 101.pdf" target="_blank">Bible Introduction 101</a></li>
                                                <li><a class="list" href="library/BibleSurveys/OT Survey 1.pdf" target="_blank">OT Survey 1</a></li>
                                                <li><a class="list" href="library/BibleSurveys/Survey of the Old Testament_1.pdf" target="_blank">Survey of the Old Testament 1</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <ul class="library">
                                                <li><a class="list" href="library/BibleSurveys/Introduction to the New Testament.pdf" target="_blank">Introduction to the New Testament</a></li>
                                                <li><a class="list" href="library/BibleSurveys/OT Survey 2.pdf" target="_blank">OT Survey 2</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <ul class="library">
                                                <li><a class="list" href="library/BibleSurveys/New Testament Survey.pdf" target="_blank">New Testament Survey</a></li>
                                                <li><a class="list" href="library/BibleSurveys/OT Survey 3.pdf" target="_blank">OT Survey 3</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div id="tabs-13">
                                    <h2>Bibles</h2>
                                    <!-- <div class="col-sm-4">
                                        <ul class="library">
                                            <li><a class="list" href="library/holybibles/" target="_blank"></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-4">
                                        <ul class="library">
                                            <li><a class="list" href="library/holybibles/" target="_blank"></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-4">
                                        <ul class="library">
                                            <li><a class="list" href="library/holybibles/" target="_blank"></a></li>
                                        </ul>
                                    </div> -->
                                </div>

                                <div id="tabs-4">
                                    <h2>Biographies</h2>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <ul class="library">
                                                <li><a class="list" href="library/biographies/A Harmony of the Life of Paul.pdf" target="_blank">A Harmony of the Life of Paul</a></li>
                                                <li><a class="list" href="library/biographies/Acts of Apostles - Foak.pdf" target="_blank">Acts of Apostles - Foak</a></li>
                                                <li><a class="list" href="library/biographies/Commentary On Acts - Duve.pdf" target="_blank">Commentary On Acts - Duve</a></li>
                                                <li><a class="list" href="library/biographies/Life Ministry of Paul - Wood.pdf" target="_blank">Life Ministry of Paul - Wood</a></li>
                                                <li><a class="list" href="library/biographies/Life of St Benedict.pdf" target="_blank">Life of St Benedict</a></li>
                                                <li><a class="list" href="library/biographies/The Life of Flavius Josephus.pdf" target="_blank">The Life of Flavius Josephus</a></li>
                                                <li><a class="list" href="library/biographies/WM Ramsay Paul the Traveler & Roman Citizen.pdf" target="_blank">WM Ramsay Paul the Traveler & Roman Citizen</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <ul class="library">
                                                <li><a class="list" href="library/biographies/A Synoptic Life of the Apostle Paul.pdf" target="_blank">A Synoptic Life of the Apostle Paul</a></li>
                                                <li><a class="list" href="library/biographies/Apostle Paul - Whyt.pdf" target="_blank">Apostle Paul - Whyt</a></li>
                                                <li><a class="list" href="library/biographies/Henry Wace Christian Bio & Lit 6th Century.pdf" target="_blank">Henry Wace Christian Bio & Lit 6th Century</a></li>
                                                <li><a class="list" href="library/biographies/Life of Christ - Farrar.pdf" target="_blank">Life of Christ - Farrar</a></li>
                                                <li><a class="list" href="library/biographies/Madame Guyon Autobiography.pdf" target="_blank">Madame Guyon Autobiography</a></li>
                                                <li><a class="list" href="library/biographies/The Story of St Paul - Baco.pdf" target="_blank">The Story of St Paul - Baco</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <ul class="library">
                                                <li><a class="list" href="library/biographies/Acts of Apostles - Burnrich.pdf" target="_blank">Acts of Apostles - Burnrich</a></li>
                                                <li><a class="list" href="library/biographies/Charles Finney.pdf" target="_blank">Charles Finney</a></li>
                                                <li><a class="list" href="library/biographies/J.Wesley.pdf" target="_blank">J.Wesley</a></li>
                                                <li><a class="list" href="library/biographies/Life of Moody.pdf" target="_blank">Life of Moody</a></li>
                                                <li><a class="list" href="library/biographies/The Life and Times of Jesus the Messiah.pdf" target="_blank">The Life and Times of Jesus the Messiah</a></li>
                                                <li><a class="list" href="library/biographies/Therese Autobiography.pdf" target="_blank">Therese Autobiography</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div id="tabs-5">
                                    <h2>Christian Counseling</h2>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <ul class="library">
                                                <li><a class="list" href="library/christiancounseling/Biblical Counseling Manual.pdf" target="_blank">Biblical Counseling Manual</a></li>
                                                <li><a class="list" href="library/christiancounseling/Introduction to Biblical Counseling.pdf" target="_blank">Introduction to Biblical Counseling</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <ul class="library">
                                                <li><a class="list" href="library/christiancounseling/Biblical Counseling.pdf" target="_blank">Biblical Counseling</a></li>
                                                <li><a class="list" href="library/christiancounseling/Sex God Marriage.pdf" target="_blank">Sex God Marriage</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <ul class="library">
                                                <li><a class="list" href="library/christiancounseling/Counselling Recipes.pdf" target="_blank">Counselling Recipes</a></li>
                                                <li><a class="list" href="library/christiancounseling/SGM Study Guide.pdf" target="_blank">SGM Study Guide</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div id="tabs-6">
                                    <h2>Christian Ethics</h2>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <ul class="library">
                                                <li><a class="list" href="library/christianethics/Living Under Gods Law.pdf" target="_blank">Living Under Gods Law</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <ul class="library">
                                                <li><a class="list" href="library/christianethics/The Government of the Tongue.pdf" target="_blank">The Government of the Tongue</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <ul class="library">
                                                <!-- <li><a class="list" href="library/christianethics/" target="_blank"></a></li> -->
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div id="tabs-7">
                                    <h2>Christian Living</h2>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <ul class="library">
                                                <li><a class="list" href="library/christian-living/A Christian in a Non Christian World.pdf" target="_blank">A Christian in a Non Christian World</a></li>
                                                <li><a class="list" href="library/christian-living/Biblical EQ Emotional Transformation.pdf" target="_blank">Biblical EQ Emotional Transformation</a></li>
                                                <li><a class="list" href="library/christian-living/Excellency of Christ-01 by J Edwards.pdf" target="_blank">Excellency of Christ-01 by J Edwards</a></li>
                                                <li><a class="list" href="library/christian-living/GRACE the Forbidden Gospel.pdf" target="_blank">GRACE the Forbidden Gospel</a></li>
                                                <li><a class="list" href="library/christian-living/Normal Christian Life - Nee.pdf" target="_blank">Normal Christian Life - Nee</a></li>
                                                <li><a class="list" href="library/christian-living/Prayer & Revelation by Vincent Cheung.pdf" target="_blank">Prayer & Revelation by Vincent Cheung</a></li>
                                                <li><a class="list" href="library/christian-living/The Christian Secret of  Happy Life.pdf" target="_blank">The Christian Secret of  Happy Life</a></li>
                                                <li><a class="list" href="library/christian-living/Till He Come - Spurgeon.pdf" target="_blank">Till He Come - Spurgeon</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <ul class="library">
                                                <li><a class="list" href="library/christian-living/Absent from the Body-01 by J Edwards.pdf" target="_blank">Absent from the Body-01 by J Edwards</a></li>
                                                <li><a class="list" href="library/christian-living/Christiantynotrel.pdf" target="_blank">Christianty - Notrel</a></li>
                                                <li><a class="list" href="library/christian-living/Excellency of Christ-02 by J Edwards.pdf" target="_blank">Excellency of Christ-02 by J Edwards</a></li>
                                                <li><a class="list" href="library/christian-living/Imitation of Christ.pdf" target="_blank">Imitation of Christ</a></li>
                                                <li><a class="list" href="library/christian-living/Pilgrim Progress.pdf" target="_blank">Pilgrim Progress</a></li>
                                                <li><a class="list" href="library/christian-living/Pursuit of God - Tozer.pdf" target="_blank">Pursuit of God - Tozer</a></li>
                                                <li><a class="list" href="library/christian-living/The Necessity of Prayer by EM Bounds.pdf" target="_blank">The Necessity of Prayer by EM Bounds</a></li>
                                                <li><a class="list" href="library/christian-living/Way of Perfection.pdf" target="_blank">Way of Perfection</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <ul class="library">
                                                <li><a class="list" href="library/christian-living/Absent from the Body-02 by J Edwards.pdf" target="_blank">Absent from the Body-02 by J Edwards</a></li>
                                                <li><a class="list" href="library/christian-living/Discipleship2.pdf" target="_blank">Discipleship 2</a></li>
                                                <li><a class="list" href="library/christian-living/Excellency of Christ-03 by J Edwards.pdf" target="_blank">Excellency of Christ-03 by J Edwards</a></li>
                                                <li><a class="list" href="library/christian-living/Lawrence Practice of Presence.pdf" target="_blank">Lawrence Practice of Presence</a></li>
                                                <li><a class="list" href="library/christian-living/Power Through Prayer by EM Bounds.pdf" target="_blank">Power Through Prayer by EM Bounds</a></li>
                                                <li><a class="list" href="library/christian-living/Spirit-Union Soul-Rest.pdf" target="_blank">Spirit-Union Soul-Rest</a></li>
                                                <li><a class="list" href="library/christian-living/The Weapon of Prayer by EM Bounds.pdf" target="_blank">The Weapon of Prayer by EM Bounds</a></li>
                                                <li><a class="list" href="library/christian-living/Why Forgive.pdf" target="_blank">Why Forgive</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div id="tabs-8">
                                    <h2>Christian References</h2>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <ul class="library">
                                                <li><a class="list" href="library/christianreferences/Beginners Latin.pdf" target="_blank">Beginners Latin</a></li>
                                                <li><a class="list" href="library/christianreferences/Derickson's Notes on Theology.pdf" target="_blank">Derickson's Notes on Theology</a></li>
                                                <li><a class="list" href="library/christianreferences/Foxes Book of Martyrs.pdf" target="_blank">Foxes Book of Martyrs</a></li>
                                                <li><a class="list" href="library/christianreferences/Smith's Bible Dictionary.pdf" target="_blank">Smith's Bible Dictionary</a></li>
                                                <li><a class="list" href="library/christianreferences/The Temple by Alfred Edersheim.pdf" target="_blank">The Temple by Alfred Edersheim</a></li>
                                                <li><a class="list" href="library/christianreferences/Wesley's Notes on the Bible.pdf" target="_blank">Wesley's Notes on the Bible</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <ul class="library">
                                                <li><a class="list" href="library/christianreferences/Calvin - Commentaries.pdf" target="_blank">Calvin - Commentaries</a></li>
                                                <li><a class="list" href="library/christianreferences/Dialogue of St Catherine.pdf" target="_blank">Dialogue of St Catherine</a></li>
                                                <li><a class="list" href="library/christianreferences/Matthew Henry Concise Bible Commentary.pdf" target="_blank">Matthew Henry Concise Bible Commentary</a></li>
                                                <li><a class="list" href="library/christianreferences/Spiritual Exercises.pdf" target="_blank">Spiritual Exercises</a></li>
                                                <li><a class="list" href="library/christianreferences/Torrey's New Topical Textbook.pdf" target="_blank">Torrey's New Topical Textbook</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <ul class="library">
                                                <li><a class="list" href="library/christianreferences/Catena Aurea.pdf" target="_blank">Catena Aurea</a></li>
                                                <li><a class="list" href="library/christianreferences/Eastons Bible Dictionary.pdf" target="_blank">Eastons Bible Dictionary</a></li>
                                                <li><a class="list" href="library/christianreferences/Sketches of Jewish Social Life.pdf" target="_blank">Sketches of Jewish Social Life</a></li>
                                                <li><a class="list" href="library/christianreferences/The Holy War by Bunyan.pdf" target="_blank">The Holy War by Bunyan</a></li>
                                                <li><a class="list" href="library/christianreferences/Wesley Journal.pdf" target="_blank">Wesley Journal</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div id="tabs-9">
                                    <h2>Doctrine</h2>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <ul class="library">
                                                <li><a class="list" href="library/doctrine/A Defense of Calvinism by Spurgeon.pdf" target="_blank">A Defense of Calvinism by Spurgeon</a></li>
                                                <li><a class="list" href="library/doctrine/Beyond Denominations.pdf" target="_blank">Beyond Denominations</a></li>
                                                <li><a class="list" href="library/doctrine/Church Fathers.pdf" target="_blank">Church Fathers</a></li>
                                                <li><a class="list" href="library/doctrine/Fundamental of Bible Doctrine.pdf" target="_blank">Fundamental of Bible Doctrine</a></li>
                                                <li><a class="list" href="library/doctrine/History Protestantism Vol2 - Wylie.pdf" target="_blank">History Protestantism Vol2 - Wylie</a></li>
                                                <li><a class="list" href="library/doctrine/Relativism the Central Problem for Faith Today.pdf" target="_blank">Relativism the Central Problem for Faith Today</a></li>
                                                <li><a class="list" href="library/doctrine/The Doctrine of Endless Punishment.pdf" target="_blank">The Doctrine of Endless Punishment</a></li>
                                                <li><a class="list" href="library/doctrine/The Primal Church.pdf" target="_blank">The Primal Church</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <ul class="library">
                                                <li><a class="list" href="library/doctrine/A Refutation of Dispensationalism - Pink.pdf" target="_blank">A Refutation of Dispensationalism - Pink</a></li>
                                                <li><a class="list" href="library/doctrine/Christianity in First Three Centuries.pdf" target="_blank">Christianity in First Three Centuries</a></li>
                                                <li><a class="list" href="library/doctrine/Churches of Today - Tomlinson.pdf" target="_blank">Churches of Today - Tomlinson</a></li>
                                                <li><a class="list" href="library/doctrine/History of Religious Educators - ETowns.pdf" target="_blank">History of Religious Educators - ETowns</a></li>
                                                <li><a class="list" href="library/doctrine/History Protestantism Vol3 - Wylie.pdf" target="_blank">History Protestantism Vol3 - Wylie</a></li>
                                                <li><a class="list" href="library/doctrine/Sound Doctrine Book.pdf" target="_blank">Sound Doctrine Book</a></li>
                                                <li><a class="list" href="library/doctrine/The Early Christians.pdf" target="_blank">The Early Christians</a></li>
                                                <li><a class="list" href="library/doctrine/Way to Pentecost - Chadwick.pdf" target="_blank">Way to Pentecost - Chadwick</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <ul class="library">
                                                <li><a class="list" href="library/doctrine/Bede's Ecclesiastical History of England.pdf" target="_blank">Bede's Ecclesiastical History of England</a></li>
                                                <li><a class="list" href="library/doctrine/Church & Ministry Early Centuries.pdf" target="_blank">Church & Ministry Early Centuries</a></li>
                                                <li><a class="list" href="library/doctrine/Doctrine of the Church.pdf" target="_blank">Doctrine of the Church</a></li>
                                                <li><a class="list" href="library/doctrine/History Protestantism Vol1 - Wylie.pdf" target="_blank">History Protestantism Vol1 - Wylie</a></li>
                                                <li><a class="list" href="library/doctrine/Predestination of the Elect of God.pdf" target="_blank">Predestination of the Elect of God</a></li>
                                                <li><a class="list" href="library/doctrine/The Cross - A Call To the Fundamentals of Religion JC Ryle.pdf" target="_blank">The Cross - A Call To the Fundamentals of Religion JC Ryle</a></li>
                                                <li><a class="list" href="library/doctrine/The Object of Predestination.pdf" target="_blank">The Object of Predestination</a></li>
                                                <li><a class="list" href="library/doctrine/Westminster Confession - The Abandonment of Van Till Legacy.pdf" target="_blank">Westminster Confession - The Abandonment of Van Till Legacy</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div id="tabs-10">
                                    <h2>Education</h2>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <ul class="library">
                                                <li><a class="list" href="library/education/Being an Effective Bible Teacher.pdf" target="_blank">Being an Effective Bible Teacher</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <ul class="library">
                                                <li><a class="list" href="library/education/How to Study and Teach the Bible.pdf" target="_blank">How to Study and Teach the Bible</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <ul class="library">
                                                <!-- <li><a class="list" href="library/education/" target="_blank"></a></li> -->
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div id="tabs-11">
                                    <h2>Evangelism</h2>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <ul class="library">
                                                <li><a class="list" href="library/evangelism/An Alarm to the Unconverted.pdf" target="_blank">An Alarm to the Unconverted</a></li>
                                                <li><a class="list" href="library/evangelism/Personal Evangelism.pdf" target="_blank">Personal Evangelism</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <ul class="library">
                                                <li><a class="list" href="library/evangelism/Evangelism Made Personal.pdf" target="_blank">Evangelism Made Personal</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <ul class="library">
                                                <li><a class="list" href="library/evangelism/How To Develop An Evangelistic Lifestyle.pdf" target="_blank">How To Develop An Evangelistic Lifestyle</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div id="tabs-12">
                                    <h2>Hermeneutics/Homiletics</h2>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <ul class="library">
                                                <li><a class="list" href="library/hermeneuticshomiletics/Exegetical Fallacies.pdf" target="_blank">Exegetical Fallacies</a></li>
                                                <li><a class="list" href="library/hermeneuticshomiletics/Sacred Hermeneutics.pdf" target="_blank">Sacred Hermeneutics</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <ul class="library">
                                                <li><a class="list" href="library/hermeneuticshomiletics/How to Study and Teach the Bible.pdf" target="_blank">How to Study and Teach the Bible</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <ul class="library">
                                                <li><a class="list" href="library/hermeneuticshomiletics/My Homiletic Swimming Pool.pdf" target="_blank">My Homiletic Swimming Pool</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div id="tabs-14">
                                    <h2>Ministry/Missions</h2>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <ul class="library">
                                                <li><a class="list" href="library/ministrymissions/Being an Effective Bible Teacher.pdf" target="_blank">Being an Effective Bible Teacher</a></li>
                                                <li><a class="list" href="library/ministrymissions/Church Planting.pdf" target="_blank">Church Planting</a></li>
                                                <li><a class="list" href="library/ministrymissions/The Church.pdf" target="_blank">The Church</a></li>
                                                <li><a class="list" href="library/ministrymissions/Working for God by Andrew Murray.pdf" target="_blank">Working for God by Andrew Murray</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <ul class="library">
                                                <li><a class="list" href="library/ministrymissions/Bible Studies.pdf" target="_blank">Bible Studies</a></li>
                                                <li><a class="list" href="library/ministrymissions/Keeping Your Parish Financially Healthy.pdf" target="_blank">Keeping Your Parish Financially Healthy</a></li>
                                                <li><a class="list" href="library/ministrymissions/The Primal Church.pdf" target="_blank">The Primal Church</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <ul class="library">
                                                <li><a class="list" href="library/ministrymissions/Breaking of the Bread.pdf" target="_blank">Breaking of the Bread</a></li>
                                                <li><a class="list" href="library/ministrymissions/The Biblical Basis of Missions.pdf" target="_blank">The Biblical Basis of Missions</a></li>
                                                <li><a class="list" href="library/ministrymissions/The Urban Imperative.pdf" target="_blank">The Urban Imperative</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div id="tabs-15">
                                    <h2>Miscellaneous Books</h2>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <ul class="library">
                                                <li><a class="list" href="library/miscellaneousbooks/A Guide to Christian Self Publishing.pdf" target="_blank">A Guide to Christian Self Publishing</a></li>
                                                <li><a class="list" href="library/miscellaneousbooks/Principles of Data Analysis.pdf" target="_blank">Principles of Data Analysis</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <ul class="library">
                                                <li><a class="list" href="library/miscellaneousbooks/Invention in Rhetoric and Composition.pdf" target="_blank">Invention in Rhetoric and Composition</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <ul class="library">
                                                <li><a class="list" href="library/miscellaneousbooks/Principles of Accounting.pdf" target="_blank">Principles of Accounting</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div id="tabs-16">
                                    <h2>Partnership</h2>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <ul class="library">
                                                <li><a class="list" href="library/partnership/Budget And Finances.pdf" target="_blank">Budget And Finances</a></li>
                                                <li><a class="list" href="library/partnership/IHN_Bible_College_Catalog_2022-2023.pdf" target="_blank">IHN Bible College Catalog</a></li>
                                                <li><a class="list" href="library/partnership/Publicity.pdf" target="_blank">Publicity</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <ul class="library">
                                                <li><a class="list" href="library/partnership/Faculty Handbook.pdf" target="_blank">Faculty Handbook</a></li>
                                                <li><a class="list" href="library/partnership/Library Manual.pdf" target="_blank">Library Manual</a></li>
                                                <li><a class="list" href="library/partnership/Student Handbook.pdf" target="_blank">Student Handbook</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <ul class="library">
                                                <li><a class="list" href="library/partnership/Foundational Documents.pdf" target="_blank">Foundational Documents</a></li>
                                                <li><a class="list" href="library/partnership/Organizational Chart.pdf" target="_blank">Organizational Chart</a></li>
                                                <li><a class="list" href="library/partnership/Student Ministries Handbook.pdf" target="_blank">Student Ministries Handbook</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div id="tabs-17">
                                    <div class="row">
                                        <div id="boxed" class="text-center">
                                            <p><span style="font-size: 32px;"><h2>Philosophers/Theologians</h2></span></p>

                                            <div class="card-group center-cards">

                                                <a href="library/philosopherstheologians/Ambrose Selected Works and Letters.pdf" target="_blank" class="card-link">
                                                    <div class="card-library card_color_bachelor">
                                                        <span style="font-weight: bold;">Ambrose Selected Works and Letters</span>
                                                    </div>
                                                </a>

                                                <a href="library/philosopherstheologians/Anselm Basic Works.pdf" target="_blank" class="card-link">
                                                    <div class="card-library card_color_bachelor">
                                                        <span style="font-weight: bold;">Anselm Basic Works</span>
                                                    </div>
                                                </a>

                                                <a href="library/philosopherstheologians/Athanasious Works and Letters With Regards to Arius.pdf" target="_blank" class="card-link">
                                                    <div class="card-library card_color_bachelor">
                                                        <span style="font-weight: bold;">Athanasious Works and Letters With Regards to Arius</span>
                                                    </div>
                                                </a>

                                                <a href="library/philosopherstheologians/Athanasius Select Writtings and Letters.pdf" target="_blank" class="card-link">
                                                    <div class="card-library card_color_bachelor">
                                                        <span style="font-weight: bold;">Athanasius Select Writtings and Letters</span>
                                                    </div>
                                                </a>

                                                <a href="library/philosopherstheologians/Augustin Anti Pelagian Writings.pdf" target="_blank" class="card-link">
                                                    <div class="card-library card_color_bachelor">
                                                        <span style="font-weight: bold;">Augustin Anti Pelagian Writings</span>
                                                    </div>
                                                </a>

                                                <a href="library/philosopherstheologians/Augustin City of God and Christian Doctrine.pdf" target="_blank" class="card-link">
                                                    <div class="card-library card_color_bachelor">
                                                        <span style="font-weight: bold;">Augustin City of God and Christian Doctrine</span>
                                                    </div>
                                                </a>

                                                <a href="library/philosopherstheologians/Augustin The Writings Against the Manichaeans and Donatists.pdf" target="_blank" class="card-link">
                                                    <div class="card-library card_color_bachelor">
                                                        <span style="font-weight: bold;">Augustin The Writings Against the Manichaeans and Donatists</span>
                                                    </div>
                                                </a>

                                                <a href="library/philosopherstheologians/Barth A Brief Introduction Time and Eternity.pdf" target="_blank" class="card-link">
                                                    <div class="card-library card_color_bachelor">
                                                        <span style="font-weight: bold;">Barth A Brief Introduction Time and Eternity</span>
                                                    </div>
                                                </a>

                                                <a href="library/philosopherstheologians/Basil Letters and Select Works.pdf" target="_blank" class="card-link">
                                                    <div class="card-library card_color_bachelor">
                                                        <span style="font-weight: bold;">Basil Letters and Select Works</span>
                                                    </div>
                                                </a>

                                                <a href="library/philosopherstheologians/Bible Creeds.pdf" target="_blank" class="card-link">
                                                    <div class="card-library card_color_bachelor">
                                                        <span style="font-weight: bold;">Bible Creeds</span>
                                                    </div>
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="tabs-18">
                                    <h2>Philosophy/Religions</h2>
                                    <div class="row">
                                    <!-- <div class="col-sm-4">
                                        <ul class="library">
                                            <li><a class="list" href="library/philosophyreligions/" target="_blank"></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-4">
                                        <ul class="library">
                                            <li><a class="list" href="library/philosophyreligions/" target="_blank"></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-4">
                                        <ul class="library">
                                            <li><a class="list" href="library/philosophyreligions/" target="_blank"></a></li>
                                        </ul>
                                    </div> -->
                                    </div>
                                </div>

                                <div id="tabs-20">
                                    <h2>Theology</h2>
                                    <div class="row">
                                    <!-- <div class="col-sm-4">
                                        <ul class="library">
                                            <li><a class="list" href="library/theology/" target="_blank"></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-4">
                                        <ul class="library">
                                            <li><a class="list" href="library/theology/" target="_blank"></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-4">
                                        <ul class="library">
                                            <li><a class="list" href="library/theology/" target="_blank"></a></li>
                                        </ul>
                                    </div> -->
                                    </div>
                                </div>

                                <div id="tabs-21">
                                    <h2>Worship</h2>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <ul class="library">
                                                <li><a class="list" href="library/worship/Brief Instruction in the Worship of God.pdf" target="_blank">Brief Instruction in the Worship of God</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <ul class="library">
                                                <li><a class="list" href="library/worship/Family Worship.pdf" target="_blank">Family Worship</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <ul class="library">
                                                <li><a class="list" href="library/worship/Putting an End to Worship Wars - E. Towns.pdf" target="_blank">Putting an End to Worship Wars - E. Towns</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div id="boxed" style="margin-bottom: 50px;">&nbsp;</div>

            </div>
        </div>
    </div>

</div>
<?php
include "tmp/footer.php";
?>

