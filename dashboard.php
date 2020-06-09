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
											<?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <?php } ?>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
        </div>

    </div>

    <?php require_once('layouts/footer.php'); ?>
