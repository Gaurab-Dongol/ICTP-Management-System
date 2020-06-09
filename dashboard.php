    <?php 
	session_start();
	
	if(!isset($_SESSION['RoleId']))
	{
		header('location:login.php?lmsg=true');
		exit;
	}		

	require_once('inc/config.php');
	require_once('layouts/header.php'); 
	
	//Upload .csv file
	if(isset($_POST["submit"]))
	{
		if($_FILES['file']['name'])
		{
			$filename = explode(".", $_FILES['file']['name']);
			if($filename[1] == 'csv')
		{
			$handle = fopen($_FILES['file']['tmp_name'], "r");
			//Skips first row of excel file
			fgetcsv($handle);	
		while($data = fgetcsv($handle))
		{
			$item1 = mysqli_real_escape_string($conn, $data[0]);  
			$item2 = mysqli_real_escape_string($conn, $data[1]);
			$item3 = mysqli_real_escape_string($conn, $data[2]);  
			$item4 = mysqli_real_escape_string($conn, $data[3]);
			$item5 = mysqli_real_escape_string($conn, $data[4]);  
			$item6 = mysqli_real_escape_string($conn, $data[5]);
			$query = "INSERT INTO Student (`SID`,`First_Name`, `Last_Name`, `Email`, `Contact`,`Specialisation`,`UserID`) VALUES ('$item1','$item2', '$item3', '$item4', '$item5', '$item6', '3')";
			mysqli_query($conn, $query);
		}
			fclose($handle);
			echo "<script>alert('Import done');</script>";
		}
		}
	}
    ?>

    <div class="page-wrapper">
        <!-- PAGE CONTAINER-->
        <div class="page-container">
            
            <!-- LEFT SIDEBAR-->
            <?php 
            require_once('layouts/left_sidebar.php'); 
            ?>

            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">
                                <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for datas &amp; reports..." />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                            <div class="header-button">
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="images/icon/avatar-01.jpg" alt="John Doe" />
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">john doe</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="images/icon/avatar-01.jpg" alt="John Doe" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#">john doe</a>
                                                    </h5>
                                                    <span class="email">johndoe@example.com</span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-settings"></i>Setting</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-money-box"></i>Billing</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="#">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->
            
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                    <?php 
                    //only visible to admin 
                    if($_SESSION['RoleId'] == 3){}?>
                    
                    <div class="row">
                            <div class="col-md-12">
                                <div class="au-card">
                                    <div>
                                        <div class="table-button" align="right">
                                            <button class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal" data-target="#myModalProfile">
                                                <i class="fas fa-edit"></i>Edit</button>
                                        </div>
                                        <h2>Yash Parekh</h2>
                                        <h4>ICT Engineer</h4>
                                        <h4>yash@gmail.com</h4>
                                        <h4>0437564XXXX</h4>
                                    </div>
                                    <hr>
                                    <div>
                                        <div class="table-button" align="right">
                                            <button class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal" data-target="#myModalWorkEx">
                                                <i class="fas fa-edit"></i>Edit</button>
                                        </div>
                                        <h2>Work Experience</h2>
                                        <h3>Software Developer</h3>
                                        <h3>TGP Global</h3>
                                        <h4>Sydney NSW</h4>
                                        <h4>December 2019 to Current</h4>
                                        <p>Worked with team towards developing PHP Applications and Building Websites using PHP, JavaScript, AJAX, JSON. Involved in architecting internal CRM Dashboard using various tools like Trello, Slack and Git Web application was implemented using Bootstrap, PHP, Node.js and MongoDB. Developed dynamic and interactive UI and UX for various responsive websites. REST API Testing and Documentation using Postman.r</p>
                                    </div>    
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mdal Code Start -->
           	<div id="myModalProfile" class="modal fade" role="dialog">
              <div class="modal-dialog">
              <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <div class="card">
                        <div class="card-header">
                            <strong>Profile</strong>
                          </div>
                          <div class="card-body card-block">
                            <div class="form-group">
                              <label for="qualification" class=" form-control-label">Name</label>
                              <input type="text" id="qualification" placeholder="Enter your Full Name" class="form-control">
                            </div>
                            <div class="form-group">
                              <label for="email" class=" form-control-label">Email</label>
                              <input type="text" id="email" placeholder="17364724@student.westernstydney.edu.au" class="form-control">
                            </div>
                            <div class="form-group">
                             <label for="contact" class=" form-control-label">Contact No</label>
                             <input type="tel" id="contact" placeholder="Enter Contact No" class="form-control">
                            </div>
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-default">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- Modal Code Finish-->

            <!-- Mdal Code Start -->
            <div id="myModalWorkEx" class="modal fade" role="dialog">
              <div class="modal-dialog">
              <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <div class="card">
                        <div class="card-header">
                            <strong>Work Experience</strong>
                          </div>
                          <div class="card-body card-block">
                            <div class="form-group">
                              <label for="designation" class=" form-control-label">Designation</label>
                              <input type="text" id="designation" placeholder="Enter your Designation" class="form-control">
                            </div>
                            <div class="form-group">
                              <label for="email" class=" form-control-label">Employer</label>
                              <input type="text" id="email" placeholder="Company Name" class="form-control">
                            </div>
                            <div class="form-group">
                             <label for="location" class=" form-control-label">Location</label>
                             <input type="text" id="location" placeholder="Enter Location" class="form-control">
                            </div>

                            <div class="form-group">
                             <label for="duration" class=" form-control-label">Duration</label>
                                <div class="col col-md-3">
                                <label for="select" class=" form-control-label">Years</label>
                                </div>
                                <div class="col-12 col-md-9">
                                  <select name="selectYears" id="selectYears" class="form-control">
                                    <option value="0">Less then one year</option>
                                    <option value="1">1 Year</option>
                                    <option value="2">2 Years</option>
                                    <option value="3">3 Years</option>
                                  </select>
                                </div>
                            </div>

                            <div class="form-group">
                             <label for="duration" class=" form-control-label">Duration</label>
                                <div class="col col-md-3">
                                <label for="select" class=" form-control-label">Years</label>
                                </div>
                                <div class="col-12 col-md-9">
                                  <select name="selectYears" id="selectYears" class="form-control">
                                    <option value="0">Less then one year</option>
                                    <option value="1">1 Year</option>
                                    <option value="2">2 Years</option>
                                    <option value="3">3 Years</option>
                                  </select>
                                </div>
                            </div>

                            <div class="form-group">
                             <label for="discription" class=" form-control-label">Description</label>
                             <textarea rows="4" cols="50" id="discription" placeholder="Description" class="form-control"> </textarea>
                            </div>
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-default">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- Modal Code Finish-->

                        <?php 
		                //only visible to admin 
		                if($_SESSION['RoleId'] == 1){?>
                        <div class="row">
                            <div class="col-lg-12">
                                <h2 class="title-1 m-b-25">Student List</h2>
                                <div class="table-responsive table--no-card m-b-40">
                                    <table class="table table-borderless table-striped table-earning">
                                    <thead>
                                            <tr>
												<th>No.</th>
												<th>SID</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Email</th>
                                                <th>Contact</th>
                                                <th>Specialisation</th>
                                                <th>Year Enrolled</th>
                                                <th>Nationality</th>
                                            </tr>
                                        </thead>
										<tbody>
											<?php
												//Display Student List
												$query="select * from Student";
												$rs = mysqli_query($conn,$query);
												$count = 0;
													foreach($rs as $row){
											?>  
											<tr>
												<td><?php echo ++$count;?> </td>
												<td><?php echo $row["StudentID"]?></td>
												<td><?php echo $row["FirstName"];?></td>
												<td><?php echo $row["LastName"];?></td>
												<td><?php echo $row["EmailAddress"];?></td>
												<td><?php echo $row["Contact"];?></td>
												<td><?php echo $row["Specialisation"];?></td>
                                                <td><?php echo $row["YearEnrolled"];?></td>
												<td><?php echo $row["Nationality"];?></td>
											</tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <!-- Mdal Code Start -->
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
        </div>

    </div>
    <?php } ?>

    <?php require_once('layouts/footer.php'); ?>
