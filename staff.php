<?php 
	session_start();
	
	if(!isset($_SESSION['RoleId']))
	{
		header('location:login.php?lmsg=true');
		exit;
	}		

	require_once('inc/config.php');
    require_once('layouts/header.php'); 

    



?>

    <div class="page-wrapper">
        <!-- PAGE CONTAINER-->
        <div class="page-container">
            
            <!-- LEFT SIDEBAR-->
            <?php 
            require_once('layouts/left_sidebar.php'); 
            require_once('layouts/usersetting.php'); 
            ?>
            
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="title-1 m-b-25">Staff List</h2>
                            <div class="table-responsive table--no-card m-b-40">
                                <table class="table table-borderless table-striped table-earning">
                                <thead>
                                        <tr>
                                            <th>Staff</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Contact</th>
                                            <th>position</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            //Display Student List
                                            $query="select * from staff";
                                            $rs = mysqli_query($conn,$query);
                                            $count = 0;
                                                foreach($rs as $row){
                                        ?>  
                                        <tr>
                                            <td><?php echo $row["StaffID"]?></td>
                                            <td><?php echo $row["FirstName"];?></td>
                                            <td><?php echo $row["LastName"];?></td>
                                            <td><?php echo $row["EmailAddress"];?></td>
                                            <td><?php echo $row["ContactNo"];?></td>
                                            <td><?php echo $row["Position"];?></td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                      </div>
                    </div>
                    </div>
                        <!-- END MAIN CONTENT-->
                </div>
            </div>
            
    <?php require_once('layouts/footer.php'); ?>