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
                        <li class="active has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-tachometer-alt"></i>Student</a>
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="dashboard.php?UID=<?php echo $_GET['UID']?>">Student List</a>
                                </li>
                                <li>
                                    <a href="addstudent.php?UID=<?php echo $_GET['UID']?>">Add Student</a>
                                </li>
                            </ul>
                        </li>
                        <li class="active has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-tachometer-alt"></i>Internship</a>
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
<<<<<<< HEAD
                                    <a href="opportunities.php?UID=<?php echo $_GET['UID']?>">Internship List</a>
=======
                                    <a href="opportunities.php?UID=<?php echo $_GET['UID']?>">Internship</a>
>>>>>>> 29dffb9195ce6e6622becba8ae4842cac7f4d113
                                </li>
                                <li>
                                    <a href="addinternship.php?UID=<?php echo $_GET['UID']?>">Add Internship</a>
                                </li>
                            </ul>
                        </li>
                        <li class="active has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-tachometer-alt"></i>Unit Coordinator</a>
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="staff.php?UID=<?php echo $_GET['UID']?>">UC List</a>
                                </li>
                                <li>
                                    <a href="addstaff.php?UID=<?php echo $_GET['UID']?>">Add Staff</a>
                                </li>
                            </ul>
                        </li>
                        <?php } ?>

                        <?php 
		                    //only visible to unit co-ordinator
		                    if(($_SESSION['RoleId'] != 1 && $_SESSION['RoleId'] != 3)){
                        ?>
                        <li class="active has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-table"></i>Student</a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-chart-bar"></i>Internship</a>
                        </li>
                        <?php } ?>

                        <?php 
		                    //only visible to student
                        if(($_SESSION['RoleId'] != 1 && $_SESSION['RoleId'] != 2))
                        {?>
                        <li>
                            <a href="dashboard.php?UID=<?php echo $_GET['UID']?>">
                                <i class="fas fa-table"></i>Profile</a>
                        </li>
                        <li>
                            <a href="add_diary.php?UID=<?php echo $_GET['UID']?>">
                                <i class="fas fa-map-marker-alt"></i>My Diary</a>
                        </li>
                        <li>
                            <a href="opportunities.php?UID=<?php echo $_GET['UID']?>">
                                <i class="far fa-check-square"></i>Internship</a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-calendar-alt"></i>My Internship</a>
                        </li>
                        <?php } ?>
                    </ul>
                </nav>
            </div>
        </aside>
