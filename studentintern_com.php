<?php 
	session_start();
	
	if(!isset($_SESSION['RoleId']))
	{
		header('location:login.php?lmsg=true');
		exit;
	}		
	require_once('inc/config.php');
    require_once('layouts/header.php');
    
    $err_msg = "";
    $m ="";
    $UID = $_GET['UID'];
    
    if(isset($_POST['submit'])){

        $sql = "UPDATE student_intern SET Status = ? WHERE internshipid = ? and studentid = ? "; 
        //$sql = "UPDATE student_intern SET Status = ?";
        //$sql = "INSERT INTO test (name)VALUES (?)"; 
        if($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "sss" , $param_stat, $param_id, $param_sid);
            
            //$param_stat = trim($_POST["selectstatus"]);
            $param_stat = trim($_POST["selectstatus"]); 
            $param_id = trim($_POST["iid"]); 
            $param_sid = trim($_POST["sid"]); 
            //$param_id = trim($_GET["ID"]); 
            if(mysqli_stmt_execute($stmt)){
                // Redirect to add page
                header("location: studentintern.php?UID=$UID");
                echo "records have been updated";
            } else{
                echo "not working";
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
            require_once('layouts/usersetting.php'); 
        ?>
       
        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
<div class="row">
    <div class="col-lg-12">
        <h1 class="title-1 m-b-25">Student Internship Record</h1>
       
        <div class="table-responsive table--no-card m-b-40">
            <table class="table table-borderless table-striped table-earning">
            <thead>
                    <tr>
                        <th>StudentID</th>
                        <th>Student Name</th>
                        <th>Student's email</th>
                        <th>Semester</th>
                        <th>Job Role</th>
                        <th>Company</th>
                        <th>Location</th>
                        <th>Supervisor</th>
                        <th>Supervisor's email</th>
                        <th>Job Responsibility</th>
                        <th>Status</th>
                        
                    </tr>
                </thead>
                <tbody>
                <?php
                   //$query="select concat(a.internshipid , '', a.studentid) as 'siid', a.studentid, concat(b.FirstName , ' ', b.LastName) as 'fullname', c.JobRole, d.companyname, d.website, concat(e.FirstName , ' ', e.LastName) as 'supervisor', c.location, e.emailaddress, a.status, a.jobresponsibility, b.emailaddress from student_intern a inner join student b on a.studentid = b.studentid inner join internship c on a.internshipid = c.internshipid inner join company d on d.companyid = c.companyid inner join companyuser e on e.companyuserid = c.companyuserid where a.Status != 'Pending' ";
                   $query="select a.internshipid , a.studentid, concat(b.FirstName , ' ', b.LastName) as 'fullname', d.website, c.location, c.JobRole, d.companyname, concat(e.FirstName , ' ', e.LastName) as 'supervisor', e.emailaddress, a.status, a.jobresponsibility, a.semester, b.emailaddress as 'semailadd' from student_intern a inner join student b on a.studentid = b.studentid inner join internship c on a.internshipid = c.internshipid inner join company d on d.companyid = c.companyid inner join companyuser e on e.companyuserid = c.companyuserid where a.Status != 'Pending' and  c.companyuserid = (select companyuserid from companyuser where userid =  $UID  )  order by semester, fullname ";
                   $rs = mysqli_query($conn,$query);
                
                       foreach($rs as $row){
                ?>   
                    <tr>
                        <td><?php echo $row["studentid"]?></td>
                        <td><?php echo $row["fullname"]?></td>
                        <td><?php echo $row["semailadd"]?></td>
                        <td><?php echo $row["semester"]?></td>
                        <td><?php echo $row["JobRole"]?></td>
                        <td><?php echo $row["companyname"]?></td>
                        <td><?php echo $row["location"]?></td>
                        <td><?php echo $row["supervisor"]?></td>
                        <td><?php echo $row["emailaddress"]?></td>
                        <td><?php echo $row["jobresponsibility"]?></td>
                        <form action="" method="POST">  
                        <td>
                        <?php echo $row["status"]?>
                       
                               
                    </tr>

                    <?php }?> 
                </tbody>
             </table>
        </div> 
             <h1>    </h1>
                     
    </div>
    </div>
</div>
</div>
</div>
</div>
</div>
<?php require_once('layouts/footer.php'); ?>