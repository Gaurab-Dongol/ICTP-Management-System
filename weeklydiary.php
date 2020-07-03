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

        $sql = "UPDATE diary SET ManagerRemarks = ?, status = ? where id = ? "; 
        //$sql = "INSERT INTO test (name)VALUES (?)"; 
        if($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "sss" , $param_mr ,$param_stat, $param_id);
            
            $param_stat = trim($_POST["selectstatus"]);
            $param_mr = trim($_POST["rmarks"]);
            //$param_mr = 'ac'; 
            $param_id = trim($_POST["diaryid"]); 
            //$param_id = trim($_GET["ID"]); 
            if(mysqli_stmt_execute($stmt)){
                // Redirect to add page
                header("location: weeklydiary.php?UID=$UID");
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
        <h1 class="title-1 m-b-25">Weekly Diary</h1>
       
        <h3> Pending   </h3>
        <div class="table-responsive table--no-card m-b-40">
            <table class="table table-borderless table-striped table-earning">
            <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>WeekNo</th>
                        <th>Start Date</th>
                        <th>Total Hours</th>
                        <th>Completed Task</th>
                        <th>Status</th>
                        <th>Manager Remarks</th>
                        <th>Update</th>
                        
                    </tr>
                </thead>
                <tbody>
                <?php
                   $query="select concat(b.FirstName , ' ', b.LastName) as 'fullname', a.totalhours, a.Task_StartDate, a.Task_EndDate, a.TaskDesc, a.status, a.ManagerRemarks, a.id, a.weekno from diary a inner join student b on a.studentid = b.studentid inner join internship c on a.internshipid = c.internshipid inner join companyuser d on d.companyuserid =c.CompanyUserId where a.status = 'Pending' and c.companyuserid = (select companyuserid from companyuser where userid = $UID) order by fullname, weekno";
                   $rs = mysqli_query($conn,$query);
                
                       foreach($rs as $row){
                ?>   
                    <tr>
                        <td><?php echo $row["fullname"]?></td>
                        <td><?php echo $row["weekno"]?></td>
                        <td><?php echo $row["Task_StartDate"]?></td>
                        <td><?php echo $row["totalhours"]?></td>
                        <td><?php echo $row["TaskDesc"]?></td>
                        <form action="" method="POST">  
                        <td>
                            <select name="selectstatus" id="selectstatus" class="form-control" style="width: 120px;">
                                
                                <option <?php if ($row["status"]=='Pending')echo ' selected="selected"'?>>Pending</option>
                                <option style = 'color:green;' <?php if ($row["status"]=='Approved')echo ' selected="selected"'?>> Approved </option>
                                <option <?php if ($row["status"]=='Rejected')echo ' selected="selected"'?>>Rejected</option>
                              </select>
                        </td>
                        <td> 
                        
                            <input class="form-control" type="text" name="rmarks" placeholder="Enter your Remarks" style="width: 300px;"> 
                           
            
                        </td>

                        <td> 
                    
                        <div class="form-actions form-group">
                        <input type="hidden" name="diaryid" id="diaryid" value="<?php echo $row["id"]; ?>"> 
                                                <button type="submit" name="submit" 
                                                class="btn au-btn-icon au-btn--green btn-sm">
                                                  submit</button>             
                                    </div>  
                                    
                                </td>
                                </form>        
                    </tr>

                    <?php }?> 
                </tbody>
             </table>
        </div> 
             <h1>    </h1>
             <h3> Non-Pending  </h3>
             <!-- Approved -->
             <div class="table-responsive table--no-card m-b-40">
            <table class="table table-borderless table-striped table-earning">
            <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>WeekNo</th>
                        <th>Start Date</th>
                        <th>Total Hours</th>
                        <th>Completed Task</th>
                        <th>Status</th>
                        <th>Manager Remarks</th>
                        <th>Update</th>
                        
                    </tr>
                </thead>
                <tbody>
                <?php
                   $query="select concat(b.FirstName , ' ', b.LastName) as 'fullname', a.totalhours, a.Task_StartDate, a.Task_EndDate, a.TaskDesc, a.status, a.ManagerRemarks, a.id, a.weekno from diary a inner join student b on a.studentid = b.studentid inner join internship c on a.internshipid = c.internshipid inner join companyuser d on d.companyuserid =c.CompanyUserId where a.status != 'Pending' and c.companyuserid = (select companyuserid from companyuser where userid = $UID) order by fullname, weekno";
                   $rs = mysqli_query($conn,$query);
                
                       foreach($rs as $row){
                ?>   
                    <tr>
                        <td><?php echo $row["fullname"]?></td>
                        <td><?php echo $row["weekno"]?></td>
                        <td><?php echo $row["Task_StartDate"]?></td>
                        <td><?php echo $row["totalhours"]?></td>
                        <td><?php echo $row["TaskDesc"]?></td>
                        <form action="" method="POST">  
                        <td>
                            <select name="selectstatus" id="selectstatus" class="form-control" style="width: 120px;">
                                
                                <option <?php if ($row["status"]=='Pending')echo ' selected="selected"'?>>Pending</option>
                                <option style = 'color:green;' <?php if ($row["status"]=='Approved')echo ' selected="selected"'?>> Approved </option>
                                <option <?php if ($row["status"]=='Rejected')echo ' selected="selected"'?>>Rejected</option>
                              </select>
                        </td>
                        <td> 
                        <!-- <input class="form-control" type="text" name="rmarks" placeholder="Enter your Remarks" style="width: 500px;"> -->
                        <?php echo $row["ManagerRemarks"]?>
            
                        </td>

                        <td> 
                    
                        <div class="form-actions form-group">
                        <input type="hidden" name="diaryid" id="diaryid" value="<?php echo $row["id"]; ?>"> 
                                                <button type="submit" name="submit" 
                                                class="btn au-btn-icon au-btn--green btn-sm">
                                                  submit</button>             
                                    </div>  
                                    
                                </td>
                                </form>        
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