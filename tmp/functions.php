<?php
/*************************************************************************
 **  RELEASE NOTES MODAL
 *************************************************************************/
function information_modal(){
    global $PHP_SELF, $mysqli, $hdmysqli, $bkcolor, $perpage, $page, $msg;
    global $system_tablename, $sysid, $president , $vice, $treasurer, $secretary, $directorafrica, $deanedu, $corecourses, $followers, $facebook, $twitter, $youtube, $linkedin, $info, $updatedate, $cookietime, $sysadminver, $verdate, $releasenotes, $goalamt, $curgoal;

    // Attempt select query execution
    $sql = "SELECT * FROM $system_tablename";
    if ($result = mysqli_query($mysqli, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            $sysadminver = $row['sysadminver'];
            $verdate = $row['verdate'];
            $releasenotes = $row['releasenotes'];
            // Free result set
            mysqli_free_result($result);
        } else {
            $msg = "<font color='#FF0000'><strong>Account Does Not Exsist!</strong></font>";
            main_form();
            exit;
        }
    } else {
        echo "ERROR: Was not able to execute Query in functions line #3. " . mysqli_error($mysqli);
    }
    // End attempt select query execution

    ?>
    <div class="modal fade" id="information_modal" tabindex="-1" role="dialog" aria-labelledby="informationLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="width: 750px; margin-left: -120px; height: 750px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="informationLabel">Release Notes</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <textarea class="form-control" id="mytextarea">
                        <?php echo $releasenotes; ?>
                    </textarea>
                </div>
                <div class="modal-footer">
                    <!-- <form action="generate_pdf.php" target="_blank" method="post">
                        <button name="action" type="submit" value="DateMonth" class="btn btn-primary"><i class="fas fa-print"></i> Print Release Notes</button>
                    </form> -->
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.tiny.cloud/1/qa5ollct4qx4a9lkzbhdh1ki6763pwyi6jx3m0s5ut86u8by/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#mytextarea',
            toolbar: '',
            menubar: '',
            width: 720,
            height: 570,
            readonly: 1
        });
    </script>
<?php
}


function menu(){
    ?>
    <div class="card" style="width: 100%; padding-left: 0px; margin-top: 20px;">
        <ul id="menu">
            <?php
            if($_SESSION['isadmin']){
                ?>
                <li class="list-group-item"><a class="nav-link" href="admin.php"><i class='bx bx-cog nav_icon'></i>&nbsp;&nbsp;Administration</a></li>
                <?php
            }
            ?>
            <li class="list-group-item"><a class="nav-link" href="index.php"><i class='bx bx-grid-alt nav_icon'></i>&nbsp;&nbsp;Dashboard</a></li>
            <li class="list-group-item"><a class="nav-link" href="about.php"><i class='bx bx-universal-access nav_icon'></i>&nbsp;&nbsp;About</a></li>
            <li class="list-group-item"><a class="nav-link" href="calendar.php"><i class='bx bx-calendar nav_icon' title="Calendar"></i>&nbsp;&nbsp;Calendar</a></li>
            <li class="list-group-item"><a class="nav-link" href="courses.php"><i class='bx bx-book-reader nav_icon' title="Courses"></i>&nbsp;&nbsp;Courses</a></li>
            <li class="list-group-item"><a class="nav-link" href="admissions.php"><i class='bx bxs-school nav_icon' title="Admissions"></i>&nbsp;&nbsp;Admissions</a></li>
            <!-- <li>
                <div>Playback</div>
                <ul>
                    <li>
                        <div><span class="ui-icon ui-icon-seek-start"></span>Prev</div>
                    </li>
                    <li>
                        <div><span class="ui-icon ui-icon-stop"></span>Stop</div>
                    </li>
                    <li>
                        <div><span class="ui-icon ui-icon-play"></span>Play</div>
                    </li>
                    <li>
                        <div><span class="ui-icon ui-icon-seek-end"></span>Next</div>
                    </li>
                </ul>
            </li>
            <li>
                <div>Learn more about this menu</div>
            </li> -->
            
            <?php
            if(!empty($_SESSION['userid'])){
                ?>
                <li class="list-group-item"><a class="nav-link" href="logout.php"><i class="bx bx-log-out nav_icon" title="Logout"></i>&nbsp;&nbsp;Logout</a></li>
                <?php
            }else{
                ?>
                <li class="list-group-item"><a class="nav-link" href="login.php"><i class='bx bx-log-in nav_icon' title="Student Login"></i>&nbsp;&nbsp;Student Login</a></li>
                <?php
            }
            ?>
        </ul>
    </div>
    <?php
}
?>