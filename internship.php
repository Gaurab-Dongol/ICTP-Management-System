<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script>
function getCom(val) {
	$.ajax({
	type: "POST",
	url: "fetch_b.php",
	data:'cid='+val,
	success: function(data){
		$("#company-Nm").html(data);
	}
	});
}

function getComa(val) {
	$.ajax({
	type: "POST",
	url: "fetch_c.php",
	data:'cid='+val,
	success: function(data){
		$("#contact-Nm").html(data);
	}
	});
}
</script>   

<?php 
  session_start();
  
  if(!isset($_SESSION['RoleId']))
  {
    header('location:login.php?lmsg=true');
    exit;
  }   

  require_once('inc/config.php');
  require_once('layouts/header.php'); 
  
  $UID = $_GET['UID'];
  $error_msg ="";
  $company = $semester = $staff = "";
  $query = "SELECT internshipID FROM internship where closingdate > date_sub(curdate(),interval 90 day) order by InternshipId";
    $results = mysqli_query($conn,$query);
    while ($rows = mysqli_fetch_array($results))
    {
     $company .= '<option value="'.$rows["internshipID"].'">'.$rows["internshipID"] .'</option>';
    }  

  $query2 = "SELECT id, semester FROM semester";
  $results = mysqli_query($conn,$query2);
  while ($rows = mysqli_fetch_array($results))
  {
   $semester .= '<option value="'.$rows["semester"].'">'.$rows["semester"] .'</option>';
  } 
  
  $query3 = "SELECT staffid, concat(LastName, ', ', FirstName) as 'fullname' FROM staff";
  $results = mysqli_query($conn,$query3);
  while ($rows = mysqli_fetch_array($results))
  {
   $staff .= '<option value="'.$rows["staffid"].'">'.$rows["fullname"] .'</option>';
  } 

  if(isset($_POST['submit'])){
        // Check input error
        $sql = "SELECT internshipid, studentid FROM student_intern where studentid = (select studentid from student where userid = ?) and internshipid = ? ";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            
            mysqli_stmt_bind_param($stmt, "ss", $UID, $param_InternshipId );
            $param_InternshipId = trim($_POST["refno"]); 
            $param_cn = trim($_POST["companyNm"]); 
            if (mysqli_stmt_execute($stmt)) {
    
                mysqli_stmt_store_result($stmt);
    
                if (mysqli_stmt_num_rows($stmt) > 0) {
                    $error_msg = "You have already an existing internship record for this - " . $param_InternshipId . ".";
                } else {
                    $error_msg = "";
                }
            } else {
                echo "Something went wrong. Please check that you have entered the correct details.";
            }
    
    
            mysqli_stmt_close($stmt);
        }

        $sql2a = "SELECT status FROM student_intern WHERE status in ('Approved', 'On-Going') and studentid = (select studentid from student where USERID= ? )";
        if ($stmt = mysqli_prepare($conn, $sql2a)) {
           
            mysqli_stmt_bind_param($stmt, "s", $UID );
    
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
    
                if (mysqli_stmt_num_rows($stmt) != 0 ) {
                    $error_msg = "There is already an approved or on-going internship under your name.";
                } else {
                    $error_msg  ="";
   
                }
            } else {
                echo "Something went wrong. Please check that you have entered the correct details.";
            }
    
            mysqli_stmt_close($stmt);
        }
   


         if(empty($error_msg)){
              
              $sql = "INSERT INTO student_intern (InternshipId, StudentID, UnitCID, Semester, JobResponsibility, Status) VALUES (?,?,?,?,?,?)";
              
              if($stmt = mysqli_prepare($conn, $sql)) {
                  mysqli_stmt_bind_param($stmt, "ssssss", $param_InternshipId, $param_sid, $param_ucid, $param_semester, $param_responsibility,$param_stat); 
                  $sql4 = "select studentid from student where USERID='".$UID."'";
                  $rs = mysqli_query($conn, $sql4);
                  $row = mysqli_fetch_row($rs);
                  $param_sid = $row[0];
                  $param_InternshipId = trim($_POST["refno"]);
                  $param_ucid = trim($_POST["staff"]);
                  $param_semester = trim($_POST["sem"]);
                  $param_responsibility =  trim($_POST["JobRes"]);
                  $param_stat =  trim("Pending");
                  if(mysqli_stmt_execute($stmt)){
                      
                      header("location: internship.php?UID=$UID");
                  } else{
                      echo "not working";
                  }
      
                  mysqli_stmt_close($stmt);  
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
                            <div class="col-md-12">
                                <div class="au-card">
                                  <div>
                                        <div class="table-button" align="right">
                                            <button class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal" data-target="#myModalProfile">
                                                Add Internship</button>
                                        </div>
                                        <h3>My Internship Detail</h3>
                                        <?php echo  "<p> <font color=red> $error_msg </font> </p>"; ?>
                                    </div>
                                    <hr>
                                    <div>
                                       
                                         <?php
                                            //Display Student List
                                            $param_userid = $UID;
                                            $query="select a.status, b.internshipid, b.jobrole, d.CompanyName, b.Location, b.Description, a.JobResponsibility, concat (e.LastName, ', ' , e.FirstName) as fullname, e.ContactNo, e.EmailAddress  from student_intern a inner join internship b on a.InternshipId = b.InternshipId inner join student c on a.StudentID = c.StudentID inner JOIN company d on b.CompanyID = d.CompanyId inner join companyuser e on b.CompanyUserId = e.CompanyUserId  where a.status not in ('cancelled', 'rejected')  and  a.StudentID = (select StudentID from student where userid = '" . $param_userid . "')";
                                            $rs = mysqli_query($conn,$query);
                                            $count = 0;
                                                foreach($rs as $row){
                                        ?>  
                                    
                                        <div class="table-button" align="right" style="font-size: 24px;">Status
                                            <button class="au-btn au-btn-icon au-btn--blue au-btn--large" >
                                            <?php echo $row["status"]?></button>
                                        </div>
                                       
                                        <h3><?php echo $row["jobrole"]?></h3>
                                        <h3><?php echo $row["CompanyName"]?></h3>
                                        <h4>Location: <?php echo $row["Location"]?></h4>
                                        <h4>Supervisor: <?php echo $row["fullname"]?></h4>
                                        <h4>Supervisor Email: <?php echo $row["EmailAddress"]?></h4>
                                        <h4>Job Responsibilities:</h4>
                                        <p><?php echo $row["JobResponsibility"]?></p>
                                        <tbody>
                                        
                                        <?php }?>
                                    </tbody>
                                      </div>    
                                </div>
                            </div>
                        </div>
                      </div>
                  </div>
                </div>
          </div>
    </div>
            <!-- END MAIN CONTENT-->
    
            <div id="myModalProfile" class="modal fade" role="dialog">
              <div class="modal-dialog modal-lg">
              <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <div class="card">
                        <div class="card-header">
                        
                            <strong>Add My Internship</strong>
                          </div>
                          <form action="internship.php?UID=<?php echo $_GET['UID']?>" method="POST">
                          <div class="card-body card-block">
                            
                          <div class="card">
                                    <div class="card-header">
                                        <strong>Job Reference No</strong>
                                        <!--<small> Form</small> -->
                                    </div>
                                    <div class="form-group">
                                
                                    <label for="select" class=" form-control-label"></label>
                                    <select name="refno" id="ref-No" class="form-control action" onChange="getCom(this.value); getComa(this.value);", required>
                                    <option value="" disabled selected>Select Reference No</option>
                                    <?php echo $company; ?>
                                    </select>
                                    </div>
                                    <div class="form-group">
                                    <label for="select" class=" form-control-label">Company - Job Role</label>
                                    <select name="companyNm" id="company-Nm" class="form-control"  disabled>
                                    <option value="" disabled selected>Company - Job Role</option> 
                                    </select>
                                    </div>
                                    <div class="form-group">
                                    <label for="select" class=" form-control-label">Contact Name</label>
                                    <select name="ContactNm" id="contact-Nm" class="form-control"  disabled>
                                    <option value="" disabled selected>Contact Name</option> 
                                    </select>
                                    </div>
                                   <!-- <div class="form-actions form-group">
                                                <button type="submit" 
                                                class="btn au-btn-icon au-btn--green btn-sm">
                                                <a href="add_internshipst.php?UID=<?php echo $_GET['UID']?>"> Add Internship</a></button>             
                                    </div> -->
                                    </div>
                                    
                                    <div class="form-group">
                                    <label for="select" class=" form-control-label">Unit Coordinator</label>
                                    <select name="staff" id="staff" class="form-control" required >
                                    <option value="" disabled selected>Select Unit Coordinator</option>
                                    <?php echo $staff; ?>
                                    </select>
                                    </div>
                                    </div>

                                    <div class="form-group">
                                    <label for="select" class=" form-control-label">Semester</label>
                                    <select name="sem" id="sem" class="form-control" required>
                                    <option value="" disabled selected>Semester</option>
                                    <?php echo $semester; ?>
                                    </select>
                                    </div>
                                    </div>
                                    <div class="form-group">
                                    <label for="textarea-input" class="form-control-label">Job Responsibility<small><i>(in bullet form)</i></small> </label>
                                    </div>
                                    <div class="form-group">
                                    <textarea class="ckeditor" name="JobRes" required></textarea>
                                    </div>
                          </div>
                
                  <div class="modal-footer">
                    <button type="submit" class="btn au-btn-icon au-btn--green" name="submit">Submit</button>
                    <button type="button" class="btn btn-default au-btn--blue" data-dismiss="modal">Close</button>
                   
                    </div>
                  </div>

                  </div>
                </div>
              </div>
            </div>
            
            <!-- Modal Code Finish-->

            
    <?php require_once('layouts/footer.php'); ?>
