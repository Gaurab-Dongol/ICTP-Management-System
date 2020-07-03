<aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="images/456.png" alt="ICTP" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                    <?php 
		                //only visible to admin 
                            if($_SESSION['RoleId'] == 1){?>
                        <li>
                            <a  class="js-arrow" href="#">
                                <i class="fas fa-users"></i>Student</a>
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="dashboard.php?UID=<?php echo $_GET['UID']?>">Student List</a>
                                </li>
                                <li>
                                    <a href="studentintern.php?UID=<?php echo $_GET['UID']?>">Student Internship Record</a>
                                </li>
                                <li>
                                    <a href="addstudent.php?UID=<?php echo $_GET['UID']?>">Add Student</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="js-arrow" href="#">
                                <i class="fas fa-desktop"></i>Internship</a>
                                <!-- <i class="fas fa-tachometer-alt"></i>Internship</a> -->
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="opportunities.php?UID=<?php echo $_GET['UID']?>">Internship List</a>
                                </li>
                                <li>
                                    <a href="addinternship.php?UID=<?php echo $_GET['UID']?>">Add Internship</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="js-arrow" href="#">
                                <i class="far fa-building"></i>Business Partner</a>
                                <!-- <i class="fas fa-tachometer-alt"></i>Internship</a> -->
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="companylist.php?UID=<?php echo $_GET['UID']?>">Company List</a>
                                </li>
                                <li>
                                    <a href="contactlist.php?UID=<?php echo $_GET['UID']?>">Contact List</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="js-arrow" href="#">
                                <i class="fas fa-address-card"></i>Unit Coordinator</a>
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="staff.php?UID=<?php echo $_GET['UID']?>">UC List</a>
                                </li>
                                <li>
                                    <a href="addstaff.php?UID=<?php echo $_GET['UID']?>">Add Staff</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="weeklydiary_admin.php?UID=<?php echo $_GET['UID']?>">
                                <i class="fas fa-book"></i>Weekly Diary</a>
                        </li>
                        <li>
                            <a href="basetable.php?UID=<?php echo $_GET['UID']?>">
                                <i class="far fa-edit"></i>Edit Base Table</a>
                        </li>
                        <?php } ?>

                        <?php 
		                //only visible to unit co-ordinator
		                if(($_SESSION['RoleId'] == 2)){
                        ?>
                          <li>
                            <a  class="js-arrow" href="#">
                                <i class="fas fa-users"></i>Student</a>
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="dashboard.php?UID=<?php echo $_GET['UID']?>">Student List</a>
                                </li>
                                <li>
                                    <a href="studentintern.php?UID=<?php echo $_GET['UID']?>">Student Internship Record</a>
                                </li>
                                <li>
                                    <a href="addstudent.php?UID=<?php echo $_GET['UID']?>">Add Student</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="js-arrow" href="#">
                                <i class="fas fa-desktop"></i>Internship</a>
                                <!-- <i class="fas fa-tachometer-alt"></i>Internship</a> -->
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="opportunities.php?UID=<?php echo $_GET['UID']?>">Internship List</a>
                                </li>
                                <li>
                                    <a href="addinternship.php?UID=<?php echo $_GET['UID']?>">Add Internship</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="js-arrow" href="#">
                                <i class="far fa-building"></i>Business Partner</a>
                                <!-- <i class="fas fa-tachometer-alt"></i>Internship</a> -->
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="companylist.php?UID=<?php echo $_GET['UID']?>">Company List</a>
                                </li>
                                <li>
                                    <a href="contactlist.php?UID=<?php echo $_GET['UID']?>">Contact List</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="weeklydiary_admin.php?UID=<?php echo $_GET['UID']?>">
                                <i class="fas fa-book"></i>Weekly Diary</a>
                        </li>
                        <?php } ?>

                        <?php 
		                    //only visible to student
                        if(($_SESSION['RoleId'] == 3))
                        {?>
                        <li>
                            <a href="dashboard.php?UID=<?php echo $_GET['UID']?>">
                                <i class="fas fa-user"></i>Profile</a>
                        </li>
                        <li>
                            <a href="opportunities.php?UID=<?php echo $_GET['UID']?>">
                                <i class="far fa-check-square"></i>Opportunities</a>
                        </li>
                        <li>
                            <a href="internship.php?UID=<?php echo $_GET['UID']?>">
                                <i class="fas fa-desktop"></i>My Internship</a>
                        </li>
                        <li>
                            <a href="add_diary.php?UID=<?php echo $_GET['UID']?>">
                                <i class="fas fa-book"></i>My Diary</a>
                        </li>
                        <li>
                            <a href="studentreport.php?UID=<?php echo $_GET['UID']?>">
                                <i class="fas fa-folder-open"></i>My Report</a>
                        </li>
                        <?php } ?>

                        <?php 
                        if(($_SESSION['RoleId'] == 4))
                        {?>
                        <li>
                            <a href="dashboard.php?UID=<?php echo $_GET['UID']?>">
                                <i class="fas fa-user"></i>Profile</a>
                        </li>
                        <li>
                            <a  class="js-arrow" href="#">
                                <i class="fas fa-users"></i>Student</a>
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="studentprofile_com.php?UID=<?php echo $_GET['UID']?>">Student List</a>
                                </li>
                                <li>
                                    <a href="studentintern_com.php?UID=<?php echo $_GET['UID']?>">Student Internship Record</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="weeklydiary.php?UID=<?php echo $_GET['UID']?>">
                                <i class="fas fa-book"></i>Weekly Diary</a>
                        </li>
                    
                        <li>
                            <a class="js-arrow" href="#">
                                <i class="fas fa-desktop"></i>Internship</a>
                                <!-- <i class="fas fa-tachometer-alt"></i>Internship</a> -->
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="opportunities.php?UID=<?php echo $_GET['UID']?>">Internship List</a>
                                </li>
                                <li>
                                    <a href="addinternship.php?UID=<?php echo $_GET['UID']?>">Add Internship</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="feedback.php?UID=<?php echo $_GET['UID']?>">
                                <i class="fas fa-table"></i>Add Feedback</a>
                        </li>
                        <?php } ?>
                    </ul>
                </nav>
            </div>
        </aside>
