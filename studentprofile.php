<?php 
	session_start();
	
	if(!isset($_SESSION['RoleId']))
	{
		header('location:login.php?lmsg=true');
		exit;
	}		

	require_once('inc/config.php');
	require_once('layouts/header.php'); 
    
        //Fetch data of student from database for input type
        $UID = $_GET['UID'];
        $fetch = "SELECT * from student";
        $student = mysqli_query($conn, $fetch);
        $rstudent = mysqli_fetch_array($student);
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
                                            <td><?php echo $row["ContactNo"];?></td>
                                            <td><?php echo $row["Specialisation"];?></td>
                                            <td><?php echo $row["YearEnrolled"];?></td>
                                            <td><?php echo $row["Nationality"];?></td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                      </div>
                    </div>
        </div>       
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    <?php require_once('layouts/footer.php'); ?>
