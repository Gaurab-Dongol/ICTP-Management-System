<aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="images/icon/logo.png" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                    <?php 
		                //only visible to admin 
		                    if($_SESSION['user_role_id'] == 1){?>
                        <li class="active has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
                        <li class="active has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-table"></i>Student</a>
                        </li>
                        <li class="active has-sub">
                            <a class="js-arrow" href="#">
                                <i class="far fa-check-square"></i>Intership</a>
                        </li>
                        <?php } ?>

                        <?php 
		                    //only visible to unit co-ordinator
		                    if(($_SESSION['user_role_id'] != 1 && $_SESSION['user_role_id'] != 3)){
                        ?>
                        <li>
                            <a href="chart.html">
                                <i class="fas fa-chart-bar"></i>Internship</a>
                        </li>
                        <?php } ?>

                        <?php 
		                    //only visible to student
                        if(($_SESSION['user_role_id'] != 1 && $_SESSION['user_role_id'] != 2))
                        {?>
                        <li>
                            <a href="table.html">
                                <i class="fas fa-table"></i>Profile</a>
                        </li>
                        <li>
                            <a href="form.html">
                                <i class="far fa-check-square"></i>Opportunites</a>
                        </li>
                        <li>
                            <a href="calendar.html">
                                <i class="fas fa-calendar-alt"></i>My Internship</a>
                        </li>
                        <li>
                            <a href="map.html">
                                <i class="fas fa-map-marker-alt"></i>My Diary</a>
                        </li>
                        <?php } ?>
                    </ul>
                </nav>
            </div>
        </aside>
