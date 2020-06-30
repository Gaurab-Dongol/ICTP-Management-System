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
        <h2 class="title-1 m-b-25">Weekly Diary</h2>
        <div class="table-responsive table--no-card m-b-40">
            <table class="table table-borderless table-striped table-earning">
            <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Completed Task</th>
                        <th>Status</th>
                        <th>Manager Remarks</th>
                        <th>Update</th>
                        
                    </tr>
                </thead>
                <tbody>
                <?php
                   $query="select concat(b.FirstName , ' ', b.LastName) as 'fullname', a.Task_StartDate, a.Task_EndDate, a.TaskDesc, a.status, a.ManagerRemarks from diary a inner join student b on a.studentid = b.studentid inner join internship c on a.internshipid = c.internshipid";
                   $rs = mysqli_query($conn,$query);
                   $count = 0;
                       foreach($rs as $row){
                ?>   
                    <tr>
                        <td><?php echo $row["fullname"]?></td>
                        <td><?php echo $row["Task_StartDate"]?></td>
                        <td><?php echo $row["Task_EndDate"]?></td>
                        <td><?php echo $row["TaskDesc"]?></td>
                        <td>
                            <select name="selectstatus" id="selectstatus" class="form-control" style="width: 120px;">
                                
                                <option <?php if ($row["status"]=='Pending')echo ' selected="selected"'?>>Pending</option>
                                <option style = 'color:green;' <?php if ($row["status"]=='Approved')echo ' selected="selected"'?>> Approved </option>
                                <option <?php if ($row["status"]=='Rejected')echo ' selected="selected"'?>>Rejected</option>
                              </select>
                        </td>
                        <td>
                            <input type="text" id="rmarks" placeholder="Enter your Remarks" class="form-control" style="width: 200px;">

                        </td>
                        <td>   <div class="form-actions form-group">
                                                <button type="submit" 
                                                class="btn au-btn-icon au-btn--green btn-sm">
                                                <a href="addcontact.php?UID=<?php echo $_GET['UID']?>"> UPDATE</a></button>             
                                    </div>  </td>
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
<?php require_once('layouts/footer.php'); ?>