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
  $company = "";
  $query = "SELECT internshipID FROM internship where closingdate > date_sub(curdate(),interval 90 day) order by InternshipId";
    $results = mysqli_query($conn,$query);
    while ($rows = mysqli_fetch_array($results))
    {
     $company .= '<option value="'.$rows["internshipID"].'">'.$rows["internshipID"] .'</option>';
    }  
    if(isset($_POST['Submit'])){
        // Check input error
         // if(empty($error_msg)){
              
              //$sql = "INSERT INTO student_intern (InternshipId, StudentID, UnitCID, Semester, JobResponsibility) VALUES (?,?,?,?,?)";
              $sql = "INSERT INTO test (name) values (?)";
              if($stmt = mysqli_prepare($conn, $sql)) {
                  //mysqli_stmt_bind_param($stmt, "sssss", $param_InternshipId, $param_sid, $param_ucid, $param_semester, $param_responsibility); 
                  mysqli_stmt_bind_param($stmt,"s",$param_responsibility); 
                  //$sql4 = "select studentid from student where USERID='".$UID."'";
                  //$rs = mysqli_query($conn, $sql4);
                  //$row = mysqli_fetch_row($rs);
                  //$param_sid = $row[0];
                  //$param_sid = "19493145";
                  //$param_InternshipId = trim($_POST["refno"]);
                  //$param_UCID = trim($_POST["refno"]);
                  //$param_semester = trim($_POST["sem"]);
                  //$param_UCID = "9876123";
                  //$param_semester = "tes";
                  $param_responsibility =  trim($_POST["JobRes"]);
                  if(mysqli_stmt_execute($stmt)){
                      
                      header("location: login.php?UID=$UID");
                  } else{
                      echo "not working";
                  }
      
                  mysqli_stmt_close($stmt);  
   
                
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
                                    </div>
                                    <hr>
                                    <div>
                                        <div class="table-button" align="right" style="font-size: 24px;">Status
                                            <button class="au-btn au-btn-icon au-btn--blue au-btn--large" >
                                                NOT APPROVED</button>
                                        </div>
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
                                    <select name="refno" id="ref-No" class="form-control action" onChange="getCom(this.value); getComa(this.value);"
                                    
                                    >
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
                                    <div class="form-actions form-group">
                                                <button type="submit" 
                                                class="btn au-btn-icon au-btn--green btn-sm">
                                                <a href="add_internshipst.php?UID=<?php echo $_GET['UID']?>"> Add Internship</a></button>             
                                    </div>
                                    </div>

                                    <div class="form-group">
                                    <label for="select" class=" form-control-label">Semester</label>
                                    <select name="sem" id="sem" class="form-control" >
                                    <option value="" selected>Semester</option> 
                                    </select>
                                    </div>
                                    </div>

                                    <div class="form-group">
                                    <label for="textarea-input" class="form-control-label">Job Responsibility<small><i>(in bullet form)</i></small> </label>
                                    </div>
                                    <div class="form-group">
                                    <textarea class="ckeditor" name="JobRes"></textarea>
                                    </div>
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-default au-btn--green" name="submit">Submit</button>
                    <button type="button" class="btn btn-default au-btn--blue" data-dismiss="modal">Close</button>

                  </div>
                </div>
              </div>
            </div>
            
            <!-- Modal Code Finish-->

            
    <?php require_once('layouts/footer.php'); ?>
