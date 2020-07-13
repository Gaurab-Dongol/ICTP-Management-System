<?php 
	session_start();
	
	if(!isset($_SESSION['RoleId']))
	{
		header('location:login.php?lmsg=true');
		exit;
	}		
	require_once('inc/config.php');
    require_once('layouts/header.php'); 

    //include 'feedback.php';
    $err_msg = "";
    $ID = substr($_GET['UID'], strpos($_GET['UID'], "abcau=")+6);    
    $_GET['UID'] = substr($_GET['UID'] , 0, strpos($_GET['UID'] , "?abc"));
    $UID = $_GET['UID'];

    if(isset($_POST['submit']))
    {
        if ($_GET['RoleID']==4)
         {header("location: feedback.php?UID=$UID");  
         }else {
            header("location: feedback_admin.php?UID=$UID");  
        }
             
    }
    
?>

<!-- HEADER DESKTOP-->
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
    <h2 class="title-1 m-b-25">FEEDBACK FORM </h2>
    
                <div class="card">
                    <div class="card-body card-block">
                <form action="" method="POST">
                    
                    <?php
                     //Display 
                     //$query="select a.*, concat(b.FirstName , ' ', b.LastName) as 'student', b.studentid as studentid, c.jobrole, concat(e.FirstName , ' ', e.LastName) as 'employer',  d.CompanyName AS companyname, e.EmailAddress AS emailaddress,e.ContactNo AS contactno from feedback a inner join student b on a.studentid = b.studentid inner join internship c on a.InternshipId = c.internshipid inner join company d on d.companyid = c.companyid inner join companyuser e on e.companyuserid = c.companyuserid where c.companyuserid = (select companyuserid from companyuser where userid =  $UID ) and id = $ID";
                     $query="select a.*, concat(b.FirstName , ' ', b.LastName) as 'student', b.studentid as studentid, c.jobrole, concat(e.FirstName , ' ', e.LastName) as 'employer',  d.CompanyName AS companyname, e.EmailAddress AS emailaddress,e.ContactNo AS contactno from feedback a inner join student b on a.studentid = b.studentid inner join internship c on a.InternshipId = c.internshipid inner join company d on d.companyid = c.companyid inner join companyuser e on e.companyuserid = c.companyuserid where id = $ID";
                     $rs = mysqli_query($conn,$query);
                         foreach($rs as $row){
                     ?> 
                    <div class="row">
                        <div class="col-lg-6">
                        <label>EMPLOYER NAME</label>
                        <input class="au-input au-input--full" style="font-weight: bold;" type="text" name="emp" value="<?php echo $row["employer"]?>" readonly>
                        <input type="hidden" name="iidn" id="iidn" value="<?php echo $row["internshipid"]; ?>"> 
                        </div>
                        <div class="col-lg-6">
                        <label>ORGANISATION NAME</label>
                        <input class="au-input au-input--full" style="font-weight: bold;" type="text" name="orgname" value="<?php echo $row["companyname"]?>" readonly>
                        </div>
                    </div>

                    <div class="row">
                    <div class="col-lg-6">
                        <label>EMAIL</label>
                        <input class="au-input au-input--full"  type="text" name="email" value="<?php echo $row["emailaddress"]?>" readonly>
                    </div>
                    <div class="col-lg-6">
                        <label>PHONE</label>
                        <input class="au-input au-input--full" type="text" name="contactno" value="<?php echo $row["contactno"]?>" readonly>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-lg-6">
                        <label>STUDENT NAME</label>
                        <input class="au-input au-input--full" style="font-weight: bold;" type="text" name="student" value="<?php echo $row["student"]?>" readonly>
                    </div>
                    <div class="col-lg-6">
                        <label>STUDENT NUMBER</label>
                        <input class="au-input au-input--full" type="text" name="studentid" value="<?php echo $row["studentid"]?>" readonly>
                    </div>
                    </div>

                    <div class="row">
                    <div class="col-lg-4">
                        <label>POSITION OR ASSIGNMENT</label>
                        <input class="au-input au-input--full" type="text" name="role" value="<?php echo $row["jobrole"]?>" readonly>
                    </div>

                    <?php } ?>
                    <div class="col-lg-4">
                        <label>Start Date:</label>
                        <input class="au-input au-input--full" type="date" name="start" value="<?php echo $row["StartDate"]?>" readonly >
                    </div>
                    <div class="col-lg-4">   
                        <label>End Date:</label>
                        <input class="au-input au-input--full" type="date" name="end" value="<?php echo $row["EndDateDate"]?>" readonly >
                    </div>
                    </div>
                    <br>
                    <div class="row">
                    <div class="col-lg-12">
                        <p>PLEASE COMPLETE THIS EVALUATION AT THE END OF THE STUDENT’S WORK PERIOD.  YOU ARE ENCOURAGED TO DISCUSS THE COMPLETED FORM WITH THE STUDENT TO AID IN THEIR PROFESSIONAL DEVELOPMENT. PLEASE USE THE SCALE BELOW TO EVALUATE YOUR STUDENT’S PERFORMANCE:</p> 
                            <p style="margin-left: 40px">        <tab>1. NEEDS MORE TRAINING OR EDUCATION</tab></p>
                            <p style="margin-left: 40px">        2. PERFORMING BELOW EXPECTATIONS</p>
                            <p style="margin-left: 40px">        3. ACCEPTABLE PERFORMANCE</p>
                            <p style="margin-left: 40px">        4. ABOVE AVERAGE PERFORMANCE</p>
                            <p style="margin-left: 40px">        5. SUPERIOR PERFORMANCE</p>
                            <p style="margin-left: 40px">        6. NOT OBSERVED</p>
                        
                    </div>
                    </div>
                    <br>
                    <div class="row">
                    <div class="col-lg-6">
                        <label >1. GENERAL WORKPLACE PERFORMANCE</label>
                            <br>
                            <label for="select" class=" form-control-label">ATTENDANCE</label>
                            <select name="q1a" id="q1a" class="form-control" disabled>
                            <option value=""> <?php echo $row["Q1A"]?> </option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            </select>
                            <label for="select" class=" form-control-label">PUNTUALITY</label>
                            <select name="q1b" id="q1b" class="form-control" disabled>
                            <option value=""><?php echo $row["Q1B"]?></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            </select>
                            <label for="select" class=" form-control-label">ATTITUDE</label>
                            <select name="q1c" id="q1c" class="form-control" disabled>
                            <option value=""><?php echo $row["Q1C"]?></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            </select>
                            <label for="select" class=" form-control-label">ACCEPTANCE CRITICISM</label>
                            <select name="q1d" id="q1d" class="form-control" disabled>
                            <option value=""><?php echo $row["Q1D"]?></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            </select>
                            <label for="select" class=" form-control-label">ASKS APPROPRIATE QUESTIONS</label>
                            <select name="q1e" id="q1e" class="form-control" disabled> 
                            <option value=""><?php echo $row["Q1E"]?></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            </select>
                            <label for="select" class=" form-control-label">SELF MOTIVATED</label>
                            <select name="q1f" id="q1f" class="form-control" disabled>
                            <option value=""><?php echo $row["Q1F"]?></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            </select>
                            <label for="select" class=" form-control-label">PRACICES ETHICAL BEHAVIOR</label>
                            <select name="q1g" id="q1g" class="form-control" disabled>
                            <option value=""><?php echo $row["Q1G"]?></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            </select>
                    </div>
                    <div class="col-lg-6">
                        <label >2. SPECIFIC JOB ASSIGNMENT PERFORMANCE</label>
                            <br>
                            <label for="select" class=" form-control-label">SUFFICIENT KNOWLEDGE TO PERFORM TASKS</label>
                            <select name="q2a" id="q2a" class="form-control" disabled>
                            <option value=""><?php echo $row["Q2A"]?></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            </select>
                            <label for="select" class=" form-control-label">VERBAL COMMUNICATION SKILLS</label>
                            <select name="q2b" id="q2b" class="form-control" disabled>
                            <option value=""><?php echo $row["Q2B"]?></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            </select>
                            <label for="select" class=" form-control-label">WRITTEN COMMUNICATION SKILLS</label>
                            <select name="q2c" id="q2c" class="form-control" disabled>
                            <option value=""><?php echo $row["Q2C"]?></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            </select>
                            <label for="select" class=" form-control-label">ANALYTICAL SKILLS – ANALYSES PROBLEMS AND TAKES APPROPRIATE ACTION</label>
                            <select name="q2d" id="q2d" class="form-control" disabled>
                            <option value=""><?php echo $row["Q2D"]?> </option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            </select>
                            <label for="select" class=" form-control-label">USES TECHNICAL SKILLS REQUIRED FOR THE POSITION</label>
                            <select name="q2e" id="q2e" class="form-control" disabled>
                            <option value=""><?php echo $row["Q2E"]?></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            </select>
                            <label for="select" class=" form-control-label">MEETS DEADLINES</label>
                            <select name="q2f" id="q2f" class="form-control" disabled>
                            <option value=""><?php echo $row["Q2F"]?></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            </select>
                            <label for="select" class=" form-control-label">TAKES INITIATIVE TO GET A JOB DONE, INCLUDING OVERCOMING OBSTACLES</label>
                            <select name="q2g" id="q2g" class="form-control" disabled>
                            <option value=""><?php echo $row["Q2G"]?></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            </select>
                            <label for="select" class=" form-control-label">SETS PRIORITIES</label>
                            <select name="q2h" id="q2h" class="form-control" disabled>
                            <option value=""><?php echo $row["Q2H"]?></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            </select>
                    </div>
                    </div>
                    <br>
                    <div class="col-lg-6">
                        <label>3. HOW WOULD YOU ASSESS THE STUDENT’S OVERALL PERFORMANCE?</label>
                        <select name="q3" id="q3" class="form-control" disabled>
                            <option value=""><?php echo $row["OverallPerformance3"]?></option>
                            <option value="OUTSTANDING">OUTSTANDING</option>
                            <option value="ABOVE AVERAGE">ABOVE AVERAGE</option>
                            <option value="SATISFACTORY">SATISFACTORY</option>
                            <option value="BELOW AVERAGE">BELOW AVERAGE</option>
                            <option value="UNSATISFACTORY">UNSATISFACTORY</option>
                        </select>
                    </div>
                    <br>                 
                    <div class="form-group">
                        <label for="textarea-input" class="form-control-label">4. WHAT DO YOU CONSIDER THE MAJOR STRENGTHS OF THIS STUDENT? </label>
                    </div>            
                   <div class="form-group">
                        <textarea class="au-input au-input--full" name="q4" readonly> <?php echo $row["Strength4"]?> </textarea>
                    </div>
                    <div class="form-group" >
                            <label for="textarea-input" class="form-control-label">5. WHAT AREAS NEED IMPROVEMENT?</label>
                    </div>
                    <div class="form-group" >
                            <textarea class="au-input au-input--full" name="q5" readonly> <?php echo $row["Improvement5"]?> </textarea>
                    </div>
                    <div class="form-group" >
                        <label for="textarea-input" class="form-control-label">6. WHAT WOULD YOU RECOMMEND TO MAKE THIS STUDENT BETTER PREPARED FOR THE WORKPLACE? (E.G. COURSES, ACTIVITIES, SKILLS ACQUISITION, PROGRAMS)?</label>
                    </div>
                    <div class="form-group" >
                        <textarea class="au-input au-input--full" name="q6" readonly><?php echo $row["Recommendation6"]?> </textarea>
                    </div>
                    <div class="form-group" >
                        <label for="textarea-input" class="form-control-label">7. OTHER COMMENTS, COMMENDATIONS, OR RECOMMENDATIONS:</label>
                </div>
                <div class="form-group" >
                        <textarea class="au-input au-input--full" name="q7" readonly> <?php echo $row["Comment7"]?> </textarea>
                </div>
                <div class="form-group">
                    <label>THANK YOU FOR YOUR TIME IN COMPLETING THIS EVALUATION!</label>
                </div>
               <!--  <div align="right" class="form">
                    <label>Signature</label>
                    <input type="signature" class="au-input au-input--full">
                </div> -->
                <div class="col-lg-6" align="left" >
                    <label>Date Submitted</label>
                    <input type="text" name="datesub" class="au-input au-input--full" value="<?php echo $row["CreatedDate"]?>" readonly required>
                </div> 
                <br>
                <br>
                <button class="au-btn au-btn--block au-btn--blue m-b-20" action="" type="submit" name="submit">CLOSE</button>
</div>
</form>
</div>
</div>
</div>
</div>
<?php require_once('layouts/footer.php'); ?>
