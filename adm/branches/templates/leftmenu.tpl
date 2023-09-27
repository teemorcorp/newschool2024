<div style="background-color:#1c262f; height: 100vh; padding-bottom: 0px;">
    <div class="accordion" id="accordionExample">

<!--*************************************************************************************************
****  DASHBOARD
**************************************************************************************************-->

        <div class="card">
            <div class="card-header headermargin" id="headingDMin" style="background-color:#1c262f">
                <h2 class="mb-0 botline">
                    <button class="btn btn-link btn-block text-left collapsed headermargin" type="button" data-toggle="collapse" data-target="#logout" aria-expanded="false" aria-controls="logout">
                        <div style="bpadding-left: 10px;" class="headermargin">
                            <a href="../../dashboard.php" style="padding-left: 0px;"><font color="#ffffff"><i class="fas fa-home"></i>&nbsp;&nbsp;&nbsp;Dashboard</font></a>
                        </div>
                    </button>
                </h2>
            </div>
        </div>

<!--*************************************************************************************************
****  ADMIN REDIRECT
**************************************************************************************************-->

        <?php
        if($_SESSION['isadmin']){
            ?>
            <div class="card">
                <div class="card-header headermargin" id="headingDMin" style="background-color:#1c262f">
                    <h2 class="mb-0 botline">
                        <button class="btn btn-link btn-block text-left collapsed headermargin" type="button" data-toggle="collapse" data-target="#logout" aria-expanded="false" aria-controls="logout">
                            <div style="bpadding-left: 10px;" class="headermargin">
                                <a href="/index.php" style="padding-left: 0px;"><font color="#ffffff"><i class="fas fa-graduation-cap"></i>&nbsp;&nbsp;&nbsp;Back To School</font></a>
                            </div>
                        </button>
                    </h2>
                </div>
            </div>
            <?php
        }
        ?>

<!--*************************************************************************************************
****  MANAGE ACADEMICS
**************************************************************************************************-->

        <div class="card">
            <div class="card-header headermargin" id="headingDMin" style="background-color:#1c262f">
                <h2 class="mb-0 headermargin">
                    <button class="btn btn-link btn-block text-left collapsed headermargin" type="button" data-toggle="collapse" data-target="#dfyproducts" aria-expanded="false" aria-controls="dfyproducts">
                        <div style="bpadding-left: 10px;" class="headermargin">
                            <font color="#ffffff"><i class="fas fa-book-reader"></i>&nbsp;&nbsp;&nbsp;<img src="../../img/undercon.gif" width="20"> Manage Academics<i class="fas fa-angle-double-right" style="float: right; padding-top: 10px;"></i></font>
                        </div>
                    </button>
                </h2>
            </div>
            <div id="dfyproducts" class="collapse headermargin" aria-labelledby="headingDMin" data-parent="#accordionExample" style="background-color:#2f3d4a;">
                <div class="card-body headermargin">
                    <table width="100%" style="padding-left:10px;">
                        <tr>
                            <td>
                                <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                <img src="../../img/undercon.gif" width="20"> <a href="#" class="mnutext">School Clubs</a></font>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                <img src="../../img/undercon.gif" width="20"> <a href="#" class="mnutext">Manage Circular</a></font>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

<!--*************************************************************************************************
****  MANAGE EMPLOYEES
**************************************************************************************************-->

        <div class="card">
            <div class="card-header headermargin" id="headingDMin" style="background-color:#1c262f">
                <h2 class="mb-0 headermargin">
                    <button class="btn btn-link btn-block text-left collapsed headermargin" type="button" data-toggle="collapse" data-target="#orders" aria-expanded="false" aria-controls="orders">
                        <div style="bpadding-left: 10px;" class="headermargin">
                            <font color="#ffffff"><i class="fas fa-hand-holding-usd"></i>&nbsp;&nbsp;&nbsp;Manage Employees<i class="fas fa-angle-double-right" style="float: right; padding-top: 10px;"></i></font>
                        </div>
                    </button>
                </h2>
            </div>
            <div id="orders" class="collapse headermargin" aria-labelledby="headingDMin" data-parent="#accordionExample" style="background-color:#2f3d4a;">
                <div class="card-body headermargin">
                    <table width="100%" style="padding-left:10px;">
                        <tr>
                            <td>
                                <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                <a href="../../teachers.php" class="mnutext">Teachers</a></font>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                <img src="../../img/undercon.gif" width="20"> <a href="#" class="mnutext">Librarians</a></font>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                <img src="../../img/undercon.gif" width="20"> <a href="#" class="mnutext">Human Resources</a></font>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

<!--*************************************************************************************************
****  MANAGE STUDENTS
**************************************************************************************************-->

        <div class="card">
            <div class="card-header headermargin" id="headingDMin" style="background-color:#1c262f">
                <h2 class="mb-0 headermargin">
                    <button class="btn btn-link btn-block text-left collapsed headermargin" type="button" data-toggle="collapse" data-target="#products" aria-expanded="false" aria-controls="products">
                        <div style="bpadding-left: 10px;" class="headermargin">
                            <font color="#ffffff"><i class="fas fa-users"></i>&nbsp;&nbsp;&nbsp;Manage Students<i class="fas fa-angle-double-right" style="float: right; padding-top: 10px;"></i></font>
                        </div>
                    </button>
                </h2>
            </div>
            <div id="products" class="collapse headermargin" aria-labelledby="headingDMin" data-parent="#accordionExample" style="background-color:#2f3d4a;">
                <div class="card-body headermargin">
                    <table width="100%" style="padding-left:10px;">
                        <tr>
                            <td>
                                <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                <img src="../../img/undercon.gif" width="20"> <a href="#" class="mnutext">Administration Form</a></font>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                <a href="../../students.php" class="mnutext">Student Management</a></font>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                <img src="../../img/undercon.gif" width="20"> <a href="#" class="mnutext">Student Categories</a></font>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                <img src="../../img/undercon.gif" width="20"> <a href="#" class="mnutext">Student House</a></font>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                <img src="../../img/undercon.gif" width="20"> <a href="#" class="mnutext">Student Activity</a></font>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                <img src="../../img/undercon.gif" width="20"> <a href="#" class="mnutext">Social Category</a></font>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

<!--*************************************************************************************************
****  MANAGE AFRICAN BRANCHES
**************************************************************************************************-->

        <div class="card">
            <div class="card-header headermargin" id="headingDMin" style="background-color:#1c262f">
                <h2 class="mb-0 headermargin">
                    <button class="btn btn-link btn-block text-left collapsed headermargin" type="button" data-toggle="collapse" data-target="#african" aria-expanded="false" aria-controls="african">
                        <div style="bpadding-left: 10px;" class="headermargin">
                            <font color="#ffffff"><i class="fas fa-globe-africa"></i>&nbsp;&nbsp;&nbsp;Manage African Branches<i class="fas fa-angle-double-right" style="float: right; padding-top: 10px;"></i></font>
                        </div>
                    </button>
                </h2>
            </div>
            <div id="african" class="collapse headermargin" aria-labelledby="headingDMin" data-parent="#accordionExample" style="background-color:#2f3d4a;">
                <div class="card-body headermargin">
                    <table width="100%" style="padding-left:10px;">
                        <tr>
                            <td>
                                <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                <a href="../../branches/nyarugusu/" class="mnutext">Nyarugusu</a></font>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                <a href="../../branches/drcongo/" class="mnutext">D.R. Congo</a></font>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                <a href="../../branches/arusha/" class="mnutext">Arusha</a></font>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                <a href="../../branches/mozambique/" class="mnutext">Mozambique</a></font>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                <a href="../../branches/zimbabwe/" class="mnutext">Zimbabwe</a></font>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                <a href="../../branches/burundi/" class="mnutext">Burundi</a></font>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

<!--*************************************************************************************************
****  MANAGE ATTENDANCE
**************************************************************************************************-->

        <div class="card">
            <div class="card-header headermargin" id="headingDMin" style="background-color:#1c262f">
                <h2 class="mb-0 headermargin">
                    <button class="btn btn-link btn-block text-left collapsed headermargin" type="button" data-toggle="collapse" data-target="#affiliates" aria-expanded="false" aria-controls="affiliates">
                        <div style="bpadding-left: 10px;" class="headermargin">
                            <font color="#ffffff"><i class="fas fa-clipboard-list"></i>&nbsp;&nbsp;&nbsp;<img src="../../img/undercon.gif" width="20"> Manage Attendance<i class="fas fa-angle-double-right" style="float: right; padding-top: 10px;"></i></font>
                        </div>
                    </button>
                </h2>
            </div>
            <div id="affiliates" class="collapse headermargin" aria-labelledby="headingDMin" data-parent="#accordionExample" style="background-color:#2f3d4a;">
                <div class="card-body headermargin">
                    <table width="100%" style="padding-left:10px;">
                        <tr>
                            <td>
                                <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                <img src="../../img/undercon.gif" width="20"> <a href="#" class="mnutext">Mark Attendance</a></font>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                <img src="../../img/undercon.gif" width="20"> <a href="#" class="mnutext">View Attendance</a></font>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

<!--*************************************************************************************************
****  DOWNLOAD PAGE
**************************************************************************************************-->

        <div class="card">
            <div class="card-header headermargin" id="headingDMin" style="background-color:#1c262f">
                <h2 class="mb-0 headermargin">
                    <button class="btn btn-link btn-block text-left collapsed headermargin" type="button" data-toggle="collapse" data-target="#customers" aria-expanded="false" aria-controls="customers">
                        <div style="bpadding-left: 10px;" class="headermargin">
                            <font color="#ffffff"><i class="fas fa-download"></i>&nbsp;&nbsp;&nbsp;<img src="../../img/undercon.gif" width="20"> Download Page<i class="fas fa-angle-double-right" style="float: right; padding-top: 10px;"></i></font>
                        </div>
                    </button>
                </h2>
            </div>
            <div id="customers" class="collapse headermargin" aria-labelledby="headingDMin" data-parent="#accordionExample" style="background-color:#2f3d4a;">
                <div class="card-body headermargin">
                    <table width="100%" style="padding-left:10px;">
                        <tr>
                            <td>
                                <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                <img src="../../img/undercon.gif" width="20"> <a href="#" class="mnutext">Assignments</a></font>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                <img src="../../img/undercon.gif" width="20"> <a href="#" class="mnutext">Study Materials</a></font>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
 
<!--*************************************************************************************************
****  CLASS INFORMATION
**************************************************************************************************-->
       
        <div class="card">
            <div class="card-header headermargin" id="headingDMin" style="background-color:#1c262f">
                <h2 class="mb-0 headermargin">
                    <button class="btn btn-link btn-block text-left collapsed headermargin" type="button" data-toggle="collapse" data-target="#vendors" aria-expanded="false" aria-controls="vendors">
                        <div style="bpadding-left: 10px;" class="headermargin">
                            <font color="#ffffff"><i class="fas fa-info"></i>&nbsp;&nbsp;&nbsp;<img src="../../img/undercon.gif" width="20"> Class Information<i class="fas fa-angle-double-right" style="float: right; padding-top: 10px;"></i></font>
                        </div>
                    </button>
                </h2>
            </div>
            <div id="vendors" class="collapse headermargin" aria-labelledby="headingDMin" data-parent="#accordionExample" style="background-color:#2f3d4a;">
                <div class="card-body headermargin">
                    <table width="100%" style="padding-left:10px;">
                        <tr>
                            <td>
                                <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                <img src="../../img/undercon.gif" width="20"> <a href="#" class="mnutext">Manage Classes</a></font>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                <img src="../../img/undercon.gif" width="20"> <a href="#" class="mnutext">Manage Sections</a></font>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
 
<!--*************************************************************************************************
****  MANAGE SUBJECTS
**************************************************************************************************-->

        <!--div class="card">
            <div class="card-header headermargin" id="headingDMin" style="background-color:#1c262f">
                <h2 class="mb-0 botline">
                    <button class="btn btn-link btn-block text-left collapsed headermargin" type="button" data-toggle="collapse" data-target="#logout" aria-expanded="false" aria-controls="logout">
                        <div style="bpadding-left: 10px;" class="headermargin">
                            <a href="#" style="padding-left: 0px;"><font color="#ffffff"><i class="fas fa-headset"></i>&nbsp;&nbsp;&nbsp;Manage Subjects</font></a>
                        </div>
                    </button>
                </h2>
            </div>
        </div-->

<!--*************************************************************************************************
****  COURSE MANAGEMENT
**************************************************************************************************-->

        <div class="card">
            <div class="card-header headermargin" id="headingDMin" style="background-color:#1c262f">
                <h2 class="mb-0 headermargin">
                    <button class="btn btn-link btn-block text-left collapsed headermargin" type="button" data-toggle="collapse" data-target="#vendorVerify" aria-expanded="false" aria-controls="vendorVerify">
                        <div style="bpadding-left: 10px;" class="headermargin">
                            <font color="#ffffff"><i class="fas fa-tasks"></i>&nbsp;&nbsp;&nbsp;Course Management<i class="fas fa-angle-double-right" style="float: right; padding-top: 10px;"></i></font>
                        </div>
                    </button>
                </h2>
            </div>
            <div id="vendorVerify" class="collapse headermargin" aria-labelledby="headingDMin" data-parent="#accordionExample" style="background-color:#2f3d4a;">
                <div class="card-body headermargin">
                    <table width="100%" style="padding-left:10px;">
                        <tr>
                            <td>
                                <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                <a href="../../programs.php" class="mnutext">Program Management</a></font>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                <a href="../../courses.php" class="mnutext">Course Management</a></font>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                <a href="../../exams.php" class="mnutext">Exam Management</a></font>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

<!--*************************************************************************************************
****  REPORT CARDS
**************************************************************************************************-->

        <div class="card">
            <div class="card-header headermargin" id="headingDMin" style="background-color:#1c262f">
                <h2 class="mb-0 headermargin">
                    <button class="btn btn-link btn-block text-left collapsed headermargin" type="button" data-toggle="collapse" data-target="#manageCategories" aria-expanded="false" aria-controls="manageCategories">
                        <div style="bpadding-left: 10px;" class="headermargin">
                            <font color="#ffffff"><i class="fas fa-check"></i>&nbsp;&nbsp;&nbsp;<img src="../../img/undercon.gif" width="20"> Report Cards<i class="fas fa-angle-double-right" style="float: right; padding-top: 10px;"></i></font>
                        </div>
                    </button>
                </h2>
            </div>
            <div id="manageCategories" class="collapse headermargin" aria-labelledby="headingDMin" data-parent="#accordionExample" style="background-color:#2f3d4a;">
                <div class="card-body headermargin">
                    <table width="100%" style="padding-left:10px;">
                        <tr>
                            <td>
                                <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                <img src="../../img/undercon.gif" width="20"> <a href="#" class="mnutext">Class Teacher</a></font>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                <img src="../../img/undercon.gif" width="20"> <a href="#" class="mnutext">Subject Teacher</a></font>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                <img src="../../img/undercon.gif" width="20"> <a href="#" class="mnutext">Scores by SMS</a></font>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                <img src="../../img/undercon.gif" width="20"> <a href="#" class="mnutext">Terminal Report</a></font>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

<!--*************************************************************************************************
****  HUMAN RESOURCES
**************************************************************************************************-->

        <div class="card">
            <div class="card-header headermargin" id="headingDMin" style="background-color:#1c262f">
                <h2 class="mb-0 headermargin">
                    <button class="btn btn-link btn-block text-left collapsed headermargin" type="button" data-toggle="collapse" data-target="#blog" aria-expanded="false" aria-controls="blog">
                        <div style="bpadding-left: 10px;" class="headermargin">
                            <font color="#ffffff"><i class="far fa-user-circle"></i>&nbsp;&nbsp;&nbsp;<img src="../../img/undercon.gif" width="20"> Human Resources<i class="fas fa-angle-double-right" style="float: right; padding-top: 10px;"></i></font>
                        </div>
                    </button>
                </h2>
            </div>
            <div id="blog" class="collapse headermargin" aria-labelledby="headingDMin" data-parent="#accordionExample" style="background-color:#2f3d4a;">
                <div class="card-body headermargin">
                    <table width="100%" style="padding-left:10px;">
                        <tr>
                            <td>
                                <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                <img src="../../img/undercon.gif" width="20"> <a href="#" class="mnutext">Department</a></font>
                            </td>
                        </tr>
                        <!--tr>
                            <td>
                                <div class="card">
                                    <div class="card-header botline headermargin" id="headingDMin" style="background-color:<?php echo $sub_background_color; ?>;">
                                        <h2 class="mb-0 headermargin">
                                            <button class="btn btn-link btn-block text-left collapsed headermargin" type="button" data-toggle="collapse" data-target="#messages" aria-expanded="false" aria-controls="messages">
                                                <div style="bpadding-left: 10px;" class="headermargin">
                                                    <font color="#ffffff"><i class="fas fa-envelope-open-text"></i>&nbsp;&nbsp;&nbsp;Recruitment<i class="fas fa-angle-double-right" style="float: right; padding-top: 10px;"></i></font>
                                                </div>
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="messages" class="collapse headermargin" aria-labelledby="headingDMin" data-parent="#accordionExample" style="background-color:#2f3d4a;">
                                        <div class="card-body headermargin">
                                            <table width="100%" style="padding-left:10px;">
                                                <tr>
                                                    <td>
                                                        <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                                        <a href="#" class="mnutext">Vacancies</a></font>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                                        <a href="#" class="mnutext">Applications</a></font>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr-->
                        <tr>
                            <td>
                                <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                <img src="../../img/undercon.gif" width="20"> <a href="#" class="mnutext">Leave</a></font>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                <img src="../../img/undercon.gif" width="20"> <a href="#" class="mnutext">Manage Award</a></font>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

<!--*************************************************************************************************
****  EXPENSES
**************************************************************************************************-->

        <div class="card">
            <div class="card-header headermargin" id="headingDMin" style="background-color:#1c262f">
                <h2 class="mb-0 headermargin">
                    <button class="btn btn-link btn-block text-left collapsed headermargin" type="button" data-toggle="collapse" data-target="#manuPage" aria-expanded="false" aria-controls="manuPage">
                        <div style="bpadding-left: 10px;" class="headermargin">
                            <font color="#ffffff"><i class="fas fa-dollar-sign"></i>&nbsp;&nbsp;&nbsp;<img src="../../img/undercon.gif" width="20"> Expenses<i class="fas fa-angle-double-right" style="float: right; padding-top: 10px;"></i></font>
                        </div>
                    </button>
                </h2>
            </div>
            <div id="manuPage" class="collapse headermargin" aria-labelledby="headingDMin" data-parent="#accordionExample" style="background-color:#2f3d4a;">
                <div class="card-body headermargin">
                    <table width="100%" style="padding-left:10px;">
                        <tr>
                            <td>
                                <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                <img src="../../img/undercon.gif" width="20"> <a href="#" class="mnutext">Expense</a></font>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                <img src="../../img/undercon.gif" width="20"> <a href="#" class="mnutext">Expense Category</a></font>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

<!--*************************************************************************************************
****  MANAGE LIBRARY
**************************************************************************************************-->

        <div class="card">
            <div class="card-header headermargin" id="headingDMin" style="background-color:#1c262f">
                <h2 class="mb-0 headermargin">
                    <button class="btn btn-link btn-block text-left collapsed headermargin" type="button" data-toggle="collapse" data-target="#siteConfig" aria-expanded="false" aria-controls="siteConfig">
                        <div style="bpadding-left: 10px;" class="headermargin">
                            <font color="#ffffff"><i class="fas fa-book"></i>&nbsp;&nbsp;&nbsp;<img src="../../img/undercon.gif" width="20"> Manage Library<i class="fas fa-angle-double-right" style="float: right; padding-top: 10px;"></i></font>
                        </div>
                    </button>
                </h2>
            </div>
            <div id="siteConfig" class="collapse headermargin" aria-labelledby="headingDMin" data-parent="#accordionExample" style="background-color:#2f3d4a;">
                <div class="card-body headermargin">
                    <table width="100%" style="padding-left:10px;">
                        <tr>
                            <td>
                                <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                <img src="../../img/undercon.gif" width="20"> <a href="#" class="mnutext">Master Data</a></font>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                <img src="../../img/undercon.gif" width="20"> <a href="#" class="mnutext">Book Publisher</a></font>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                <img src="../../img/undercon.gif" width="20"> <a href="#" class="mnutext">Book Category</a></font>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                <img src="../../img/undercon.gif" width="20"> <a href="#" class="mnutext">Book Author</a></font>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                <img src="../../img/undercon.gif" width="20"> <a href="#" class="mnutext">Register Student</a></font>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                <img src="../../img/undercon.gif" width="20"> <a href="#" class="mnutext">Request Book</a></font>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

<!--*************************************************************************************************
****  COMMUNICATIONS
**************************************************************************************************-->

        <div class="card">
            <div class="card-header headermargin" id="headingDMin" style="background-color:#1c262f">
                <h2 class="mb-0 headermargin">
                    <button class="btn btn-link btn-block text-left collapsed headermargin" type="button" data-toggle="collapse" data-target="#emailConfig" aria-expanded="false" aria-controls="emailConfig">
                        <div style="bpadding-left: 10px;" class="headermargin">
                            <font color="#ffffff"><i class="fas fa-satellite-dish"></i>&nbsp;&nbsp;&nbsp;<img src="../../img/undercon.gif" width="20"> Communications<i class="fas fa-angle-double-right" style="float: right; padding-top: 10px;"></i></font>
                        </div>
                    </button>
                </h2>
            </div>
            <div id="emailConfig" class="collapse headermargin" aria-labelledby="headingDMin" data-parent="#accordionExample" style="background-color:#2f3d4a;">
                <div class="card-body headermargin">
                    <table width="100%" style="padding-left:10px;">
                        <tr>
                            <td>
                                <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                <img src="../../img/undercon.gif" width="20"> <a href="#" class="mnutext">Manage Events</a></font>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                <img src="../../img/undercon.gif" width="20"> <a href="#" class="mnutext">Send Email Message</a></font>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

<!--*************************************************************************************************
****  SYSTEM SETTINGS
**************************************************************************************************-->

        <div class="card">
            <div class="card-header headermargin" id="headingDMin" style="background-color:#1c262f">
                <h2 class="mb-0 headermargin">
                    <button class="btn btn-link btn-block text-left collapsed headermargin" type="button" data-toggle="collapse" data-target="#paymentConfig" aria-expanded="false" aria-controls="paymentConfig">
                        <div style="bpadding-left: 10px;" class="headermargin">
                            <font color="#ffffff"><i class="fas fa-money-check-alt"></i>&nbsp;&nbsp;&nbsp;<img src="../../img/undercon.gif" width="20"> System Settings<i class="fas fa-angle-double-right" style="float: right; padding-top: 10px;"></i></font>
                        </div>
                    </button>
                </h2>
            </div>
            <div id="paymentConfig" class="collapse headermargin" aria-labelledby="headingDMin" data-parent="#accordionExample" style="background-color:#2f3d4a;">
                <div class="card-body headermargin">
                    <table width="100%" style="padding-left:10px;">
                        <tr>
                            <td>
                                <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                <img src="../../img/undercon.gif" width="20"> <a href="#" class="mnutext">General Settings</a></font>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                <img src="../../img/undercon.gif" width="20"> <a href="#" class="mnutext">Manage SMS API</a></font>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

<!--*************************************************************************************************
****  GENERATE REPORTS
**************************************************************************************************-->

        <div class="card">
            <div class="card-header headermargin" id="headingDMin" style="background-color:#1c262f">
                <h2 class="mb-0 headermargin">
                    <button class="btn btn-link btn-block text-left collapsed headermargin" type="button" data-toggle="collapse" data-target="#socialLinks" aria-expanded="false" aria-controls="socialLinks">
                        <div style="bpadding-left: 10px;" class="headermargin">
                            <font color="#ffffff"><i class="fas fa-list-ol"></i>&nbsp;&nbsp;&nbsp;<img src="../../img/undercon.gif" width="20"> Generate Reports<i class="fas fa-angle-double-right" style="float: right; padding-top: 10px;"></i></font>
                        </div>
                    </button>
                </h2>
            </div>
            <div id="socialLinks" class="collapse headermargin" aria-labelledby="headingDMin" data-parent="#accordionExample" style="background-color:#2f3d4a;">
                <div class="card-body headermargin">
                    <table width="100%" style="padding-left:10px;">
                        <tr>
                            <td>
                                <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                <img src="../../img/undercon.gif" width="20"> <a href="#" class="mnutext">Student Payments</a></font>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                <img src="../../img/undercon.gif" width="20"> <a href="#" class="mnutext">Attendance Report</a></font>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                <img src="../../img/undercon.gif" width="20"> <a href="#" class="mnutext">Exam Mark Report</a></font>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

<!--*************************************************************************************************
****  ROLE MANAGEMENT
**************************************************************************************************-->

        <div class="card">
            <div class="card-header headermargin" id="headingDMin" style="background-color:#1c262f">
                <h2 class="mb-0 headermargin">
                    <button class="btn btn-link btn-block text-left collapsed headermargin" type="button" data-toggle="collapse" data-target="#languageOptions" aria-expanded="false" aria-controls="languageOptions">
                        <div style="bpadding-left: 10px;" class="headermargin">
                            <font color="#ffffff"><i class="fas fa-user-tag"></i>&nbsp;&nbsp;&nbsp;<img src="../../img/undercon.gif" width="20"> Role Management<i class="fas fa-angle-double-right" style="float: right; padding-top: 10px;"></i></font>
                        </div>
                    </button>
                </h2>
            </div>
            <div id="languageOptions" class="collapse headermargin" aria-labelledby="headingDMin" data-parent="#accordionExample" style="background-color:#2f3d4a;">
                <div class="card-body headermargin">
                    <table width="100%" style="padding-left:10px;">
                        <tr>
                            <td>
                                <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                <img src="../../img/undercon.gif" width="20"> <a href="#" class="mnutext">New Admin</a></font>
                            </td>
                        </tr>
                        <!--tr>
                            <td>
                                <font color="#ffffff"><i class="fas fa-bible"></i>&nbsp;&nbsp;&nbsp;
                                <img src="../../img/undercon.gif" width="20"> <a href="#" class="mnutext">Coming Soon . . .</a></font>
                            </td>
                        </tr-->
                    </table>
                </div>
            </div>
        </div>
<!--*************************************************************************************************
****  EXTRAS
**************************************************************************************************-->
        <!--div class="card">
            <div class="card-header headermargin" id="headingDMin" style="background-color:#1c262f">
                <h2 class="mb-0 botline">
                    <button class="btn btn-link btn-block text-left collapsed headermargin" type="button" data-toggle="collapse" data-target="#logout" aria-expanded="false" aria-controls="logout">
                        <div style="bpadding-left: 10px;" class="headermargin">
                            <a href="socialshare.php" style="padding-left: 0px;"><font size="-1" color="#ffffff"><i class="fas fa-share-alt"></i>&nbsp;&nbsp;&nbsp;Social Share</font></a>
                        </div>
                    </button>
                </h2>
            </div>
        </div>

        <div class="card">
            <div class="card-header headermargin" id="headingDMin" style="background-color:#1c262f">
                <h2 class="mb-0 botline">
                    <button class="btn btn-link btn-block text-left collapsed headermargin" type="button" data-toggle="collapse" data-target="#logout" aria-expanded="false" aria-controls="logout">
                        <div style="bpadding-left: 10px;" class="headermargin">
                            <a href="vendorplans.php" style="padding-left: 0px;"><font size="-1" color="#ffffff"><i class="fas fa-dollar-sign"></i>&nbsp;&nbsp;&nbsp;Vendor Subscription Plans</font></a>
                        </div>
                    </button>
                </h2>
            </div>
        </div-->
        
        <div class="card">
            <div class="card-header headermargin" id="headingDMin" style="background-color:#1c262f">
                <h2 class="mb-0 botline">
                    <button class="btn btn-link btn-block text-left collapsed headermargin" type="button" data-toggle="collapse" data-target="#logout" aria-expanded="false" aria-controls="logout">
                        <div style="bpadding-left: 10px;" class="headermargin">
                            <a href="../../logout.php" style="padding-left: 0px;"><font size="-1" color="#ffffff"><i class="fas fa-users-cog"></i>&nbsp;&nbsp;&nbsp;Logout</font></a>
                        </div>
                    </button>
                </h2>
            </div>
        </div><!-- card -->

    </div><!-- accordion -->
</div>