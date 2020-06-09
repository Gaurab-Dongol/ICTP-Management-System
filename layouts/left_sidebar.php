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
		if(($_SESSION['user_role_id'] != 1 && $_SESSION['user_role_id'] != 3)){?>
                        <li>
                            <a href="chart.html">
                                <i class="fas fa-chart-bar"></i>Student</a>
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="#">Internship</a>
                                </li>
                                <li>
                                    <a href="#">Completed</a>
                                </li>
                            </ul>
                        </li>
                        <?php } ?> 
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

    
    <?php 
		//only visible to unit co-ordinator
		if(($_SESSION['user_role_id'] != 1 && $_SESSION['user_role_id'] != 3)){?>
		
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-wrench"></i>
            <span class="nav-link-text">Student</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseComponents">
            <li>
              <a href="#">Internship</a>
            </li>
            <li>
              <a href="#">Completed</a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-file"></i>
            <span class="nav-link-text">Company</span>
          </a>
          <!--<ul class="sidenav-second-level collapse" id="collapseExamplePages">
            <li>
              <a href="#">Login Page</a>
            </li>
            <li>
              <a href="#">Registration Page</a>
            </li>
            <li>
              <a href="#">Forgot Password Page</a>
            </li>
            <li>
              <a href="#">Blank Page</a>
            </li>
          </ul>-->
        </li>
  
    <?php } ?> 
    
    <?php 
		//only visible to student
		if(($_SESSION['user_role_id'] != 1 && $_SESSION['user_role_id'] != 2)){?>
		
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-wrench"></i>
            <span class="nav-link-text">Profile</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-file"></i>
            <span class="nav-link-text">Opportunites</span>
          </a>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-file"></i>
            <span class="nav-link-text">My Internship</span>
          </a>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-address-book-o"></i>
            <span class="nav-link-text">My Diary</span>
          </a>
        </li>
  
    <?php } ?>

    <?php 
		//only visible to Organization
		if(($_SESSION['user_role_id'] != 1 && $_SESSION['user_role_id'] != 2) || ($_SESSION['user_role_id'] != 2 && $_SESSION['user_role_id'] != 3)){?>
		
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-wrench"></i>
            <span class="nav-link-text">Profile</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-file"></i>
            <span class="nav-link-text">Opportunites</span>
          </a>
        </li>
          </a>
        </li>
  
    <?php } ?>
		<?php 
		//only visible to admin
		if($_SESSION['user_role_id'] == 1){?>
		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Link">
			<a class="nav-link" href="#">
				<i class="fa fa-fw fa fa-gear"></i>
				<span class="nav-link-text">Settings</span>
			</a>
		</li>
		
		<?php	} ?>
        
      </ul>
     
	 
	 
      <ul class="navbar-nav ml-auto">

        <li class="nav-item">
          <a class="nav-link" href="index.php?logout=true">
            <i class="fa fa-fw fa-sign-out"></i>Logout
		  </a>
        </li>
      </ul>
    </div>
  </nav>