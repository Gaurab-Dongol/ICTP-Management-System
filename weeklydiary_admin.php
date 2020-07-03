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

        $sql = "UPDATE diary SET UCRemarks = ? where studentid = ? and internshipid = ? and status = ?"; 
        //$sql = "INSERT INTO test (name)VALUES (?)"; 
        if($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssss" , $param_mr,$param_sid,$param_iid, $param_stat);
            
            $param_stat = trim($_POST["stat"]);
            $param_mr = trim($_POST["ucmarks"]);
            //$param_mr = 'ac'; 
            $param_id = trim($_POST["diaryid"]); 
            $param_sid = trim($_POST["studentid"]); 
            $param_iid = trim($_POST["internshipid"]); 
            //$param_id = trim($_GET["ID"]); 
            if(mysqli_stmt_execute($stmt)){
                // Redirect to add page
                header("location: weeklydiary_admin.php?UID=$UID");
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
                        <th>Aggregated Hours</th>
                        <th>Completed Task</th>
                        <th>Status</th>
                        <th>Unit Coordinator Remarks</th>
                        <th>Update</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                  $query="select concat(b.FirstName , ' ', b.LastName) as 'fullname', sum(a.totalhours) as totalhours,  a.status,      GROUP_CONCAT(concat (concat('<h4>WEEK','' ,concat(a.weekno,'','</h4>')), ' ',a.TaskDesc) SEPARATOR '<p></p>') as Task, GROUP_CONCAT(a.Weekno SEPARATOR '//') as Weekno, a.studentid, a.internshipid, a.UCRemarks from diary a inner join student b on a.studentid = b.studentid inner join internship c on a.internshipid = c.internshipid where a.status = 'Pending' group by a.studentid, a.internshipid, a.status order by b.lastname";
                  $rs = mysqli_query($conn,$query);               
                       foreach($rs as $row){
                ?>   
                    <tr>
                    <td><?php echo $row["fullname"]?></td>
                        <td><?php echo $row["totalhours"]?></td>

                        <td><?php echo $row["Task"]?></td>
                        <form action="" method="POST">  
                        <td > 
                             <?php echo $row['status']?>   
                        </td>
                        <td> 
                            <input class="form-control" type="text" name="ucmarks" placeholder="<?php echo $row["UCRemarks"]; ?>" style="width: 300px;">   
                        </td> 
                         
                        <td>
                        <div class="form-actions form-group">
                        <!--<input type="hidden" name="diaryid" id="diaryid" value="<?php echo $row["id"]; ?>">  -->
                        <input type="hidden" name="studentid" id="studentid" value="<?php echo $row["studentid"]; ?>">
                        <input type="hidden" name="internshipid" id="internshipid" value="<?php echo $row["internshipid"]; ?>">
                        <input type="hidden" name="stat" id="stat" value="<?php echo $row["status"]; ?>">
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
             <h3> Non-Pending   </h3>
             <!-- Approved -->
             <div class="table-responsive table--no-card m-b-40">
            <table class="table table-borderless table-striped table-earning">
            <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Aggregated Hours</th>
                        <th>Completed Task</th>
                        <th>Status</th>
                        <th>Unit Coordinator Remarks</th>
                        <th>Update</th>
                        
                    </tr>
                </thead>
                <tbody>
                <?php
                   $query="select concat(b.FirstName , ' ', b.LastName) as 'fullname', sum(a.totalhours) as totalhours,  a.status,      GROUP_CONCAT( concat (concat (concat('<h4>WEEK','' ,concat(a.weekno,'','</h4>')), ' ',a.TaskDesc), 'Manager Remarks: ',a.ManagerRemarks ) SEPARATOR '<p></p>') as Task, GROUP_CONCAT(a.Weekno SEPARATOR '//') as Weekno, a.studentid, a.internshipid, a.UCRemarks from diary a inner join student b on a.studentid = b.studentid inner join internship c on a.internshipid = c.internshipid where a.status != 'Pending' group by a.studentid, a.internshipid, a.status order by b.lastname";
                   $rs = mysqli_query($conn,$query);
                
                       foreach($rs as $row){
                ?>   
                    <tr>
                        <td><?php echo $row["fullname"]?></td>
                        <td><?php echo $row["totalhours"]?></td>

                        <td><?php echo $row["Task"]?></td>
                        <form action="" method="POST">  
                        <td > 
                             <?php echo $row['status']?>   
                        </td>
                        <td> 
                            <input class="form-control" type="text" name="ucmarks" placeholder="<?php echo $row["UCRemarks"]; ?>" style="width: 300px;">   
                        </td> 
                         
                        <td>
                        <div class="form-actions form-group">
                        <!--<input type="hidden" name="diaryid" id="diaryid" value="<?php echo $row["id"]; ?>">  -->
                        <input type="hidden" name="studentid" id="studentid" value="<?php echo $row["studentid"]; ?>">
                        <input type="hidden" name="internshipid" id="internshipid" value="<?php echo $row["internshipid"]; ?>">
                        <input type="hidden" name="stat" id="stat" value="<?php echo $row["status"]; ?>">
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