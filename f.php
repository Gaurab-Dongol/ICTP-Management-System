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
    $SID = substr($_GET['UID'], strpos($_GET['UID'], "abcau=")+6);    
    $_GET['UID'] = substr($_GET['UID'] , 0, strpos($_GET['UID'] , "?abc"));
    $UID = $_GET['UID'];

    if(isset($_POST['submit']))
    {
      
        if(empty($err_msg)){
            $sql = "INSERT INTO feedback (InternshipId, StudentID, StartDate, EndDateDate, Q1A, Q1B, Q1C, Q1D, Q1E, Q1F, Q1G, Q2A, Q2B, Q2C, Q2D, Q2E, Q2F, Q2G, Q2H, OverallPerformance3, Strength4, Improvement5, Recommendation6, Comment7, DateSubmitted, status)  VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            #$sql = "INSERT INTO feedback (InternshipId, StudentID, StartDate, EndDateDate, Q1A) VALUES (?,?,?,?,?)";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            
            mysqli_stmt_bind_param($stmt, "ssssssssssssssssssssssssss", $param_iid, $param_sid, $param_start, $param_end, $param_q1a, $param_q1b, $param_q1c, $param_q1d, $param_q1e, $param_q1f, $param_q1g, $param_q2a, $param_q2b, $param_q2c, $param_q2d, $param_q2e, $param_q2f, $param_q2g, $param_q2h, $param_q3, $param_q4, $param_q5, $param_q6, $param_q7, $param_datesub, $param_stat);
            #mysqli_stmt_bind_param($stmt, "sssss", $param_iid, $param_sid, $param_start, $param_end, $param_q1a);
            $param_iid = trim($_POST["iidn"]); 
            $param_sid = trim($_POST["studentid"]); 

             $timestamp = strtotime($_POST["start"]);
             $param_start = date("Y-m-d", $timestamp);

             $timestamp = strtotime($_POST["end"]);
             $param_end = date("Y-m-d", $timestamp);


             $param_q1a = trim($_POST["q1a"]); 
             $param_q1b = trim($_POST["q1b"]); 
             $param_q1c = trim($_POST["q1c"]); 
             $param_q1d = trim($_POST["q1d"]); 
             $param_q1e = trim($_POST["q1e"]); 
             $param_q1f = trim($_POST["q1f"]); 
             $param_q1g = trim($_POST["q1g"]); 
             $param_q2a = trim($_POST["q2a"]); 
             $param_q2b = trim($_POST["q2b"]); 
             $param_q2c = trim($_POST["q2c"]); 
             $param_q2d = trim($_POST["q2d"]); 
             $param_q2e = trim($_POST["q2e"]); 
             $param_q2f = trim($_POST["q2f"]); 
             $param_q2g = trim($_POST["q2g"]); 
             $param_q2h = trim($_POST["q2h"]); 
             $param_q3 = trim($_POST["q3"]);

             $param_q4 = trim($_POST["q4"]); 
             $param_q5 = trim($_POST["q5"]); 
             $param_q6 = trim($_POST["q6"]); 
             $param_q7 = trim($_POST["q7"]); 

             $timestamp = strtotime($_POST["datesub"]);
             $param_datesub = date("Y-m-d", $timestamp);

             $param_stat = trim("Completed");    
        
            if (mysqli_stmt_execute($stmt)) {
                header("location: feedback.php?UID=$UID");
            }else {
                echo "Something went wrong. Please check that you have entered the correct details.";
            }
            mysqli_stmt_close($stmt);
            }
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
                     $query="select * from v_feedback_info where userid=$UID and studentid = $SID";
                     $rs = mysqli_query($conn,$query);
                         foreach($rs as $row){
                     ?> 
                    <div class="row">
                        <div class="col-lg-6">
                        <label>EMPLOYER NAME</label>
                        <input class="au-input au-input--full" style="font-weight: bold;" type="text" name="emp" value="<?php echo $row["employer"]?>" readonly required>
                        <input type="hidden" name="iidn" id="iidn" value="<?php echo $row["internshipid"]; ?>"> 
                        </div>
                        <div class="col-lg-6">
                        <label>ORGANISATION NAME</label>
                        <input class="au-input au-input--full" style="font-weight: bold;" type="text" name="orgname" value="<?php echo $row["companyname"]?>" readonly required>
                        </div>
                    </div>

                    <div class="row">
                    <div class="col-lg-6">
                        <label>EMAIL</label>
                        <input class="au-input au-input--full"  type="text" name="email" value="<?php echo $row["emailaddress"]?>" readonly required>
                    </div>
                    <div class="col-lg-6">
                        <label>PHONE</label>
                        <input class="au-input au-input--full" type="text" name="contactno" value="<?php echo $row["contactno"]?>" readonly required>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-lg-6">
                        <label>STUDENT NAME</label>
                        <input class="au-input au-input--full" style="font-weight: bold;" type="text" name="student" value="<?php echo $row["student"]?>" readonly required>
                    </div>
                    <div class="col-lg-6">
                        <label>STUDENT NUMBER</label>
                        <input class="au-input au-input--full" type="text" name="studentid" value="<?php echo $row["studentid"]?>" readonly required>
                    </div>
                    </div>

                    <div class="row">
                    <div class="col-lg-4">
                        <label>POSITION OR ASSIGNMENT</label>
                        <input class="au-input au-input--full" type="text" name="role" value="<?php echo $row["jobrole"]?>" readonly required>
                    </div>

                    <?php } ?>
                    <div class="col-lg-4">
                        <label>Start Date:</label>
                        <input class="au-input au-input--full" type="date" name="start" required>
                    </div>
                    <div class="col-lg-4">   
                        <label>End Date:</label>
                        <input class="au-input au-input--full" type="date" name="end" required>
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
                            <select name="q1a" id="q1a" class="form-control" required>
                            <option value="" disabled selected>Please select</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            </select>
                            <label for="select" class=" form-control-label">PUNTUALITY</label>
                            <select name="q1b" id="q1b" class="form-control" required>
                            <option value="" disabled selected>Please select</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            </select>
                            <label for="select" class=" form-control-label">ATTITUDE</label>
                            <select name="q1c" id="q1c" class="form-control" required>
                            <option value="" disabled selected>Please select</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            </select>
                            <label for="select" class=" form-control-label">ACCEPTANCE CRITICISM</label>
                            <select name="q1d" id="q1d" class="form-control" required>
                            <option value="" disabled selected>Please select</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            </select>
                            <label for="select" class=" form-control-label">ASKS APPROPRIATE QUESTIONS</label>
                            <select name="q1e" id="q1e" class="form-control" required> 
                            <option value="" disabled selected>Please select</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            </select>
                            <label for="select" class=" form-control-label">SELF MOTIVATED</label>
                            <select name="q1f" id="q1f" class="form-control" required>
                            <option value="" disabled selected>Please select</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            </select>
                            <label for="select" class=" form-control-label">PRACICES ETHICAL BEHAVIOR</label>
                            <select name="q1g" id="q1g" class="form-control" required>
                            <option value="" disabled selected>Please select</option>
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
                            <select name="q2a" id="q2a" class="form-control" required>
                            <option value="" disabled selected>Please select</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            </select>
                            <label for="select" class=" form-control-label">VERBAL COMMUNICATION SKILLS</label>
                            <select name="q2b" id="q2b" class="form-control" required>
                            <option value="" disabled selected>Please select</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            </select>
                            <label for="select" class=" form-control-label">WRITTEN COMMUNICATION SKILLS</label>
                            <select name="q2c" id="q2c" class="form-control" required>
                            <option value="" disabled selected>Please select</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            </select>
                            <label for="select" class=" form-control-label">ANALYTICAL SKILLS – ANALYSES PROBLEMS AND TAKES APPROPRIATE ACTION</label>
                            <select name="q2d" id="q2d" class="form-control" required>
                            <option value="" disabled selected>Please select</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            </select>
                            <label for="select" class=" form-control-label">USES TECHNICAL SKILLS REQUIRED FOR THE POSITION</label>
                            <select name="q2e" id="q2e" class="form-control" required>
                            <option value="" disabled selected>Please select</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            </select>
                            <label for="select" class=" form-control-label">MEETS DEADLINES</label>
                            <select name="q2f" id="q2f" class="form-control" required>
                            <option value="" disabled selected>Please select</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            </select>
                            <label for="select" class=" form-control-label">TAKES INITIATIVE TO GET A JOB DONE, INCLUDING OVERCOMING OBSTACLES</label>
                            <select name="q2g" id="q2g" class="form-control" required>
                            <option value="" disabled selected>Please select</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            </select>
                            <label for="select" class=" form-control-label">SETS PRIORITIES</label>
                            <select name="q2h" id="q2h" class="form-control" required>
                            <option value="" disabled selected>Please select</option>
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
                        <select name="q3" id="q3" class="form-control" required>
                            <option value="" disabled selected>Please select</option>
                            <option value="OUTSTANDING">OUTSTANDING</option>
                            <option value="ABOVE AVERAGE">ABOVE AVERAGE</option>
                            <option value="SATISFACTORY">SATISFACTORY</option>
                            <option value="BELOW AVERAGE">BELOW AVERAGE</option>
                            <option value="UNSATISFACTORY">UNSATISFACTORY</option>
                        </select>
                    </div>
                    <br>                 
                    <div class="form-group" required>
                        <label for="textarea-input" class="form-control-label" >4. WHAT DO YOU CONSIDER THE MAJOR STRENGTHS OF THIS STUDENT? </label>
                    </div>            
                   <div class="form-group" required>
                        <textarea class="au-input au-input--full" name="q4"></textarea>
                    </div>
                    <div class="form-group" required>
                            <label for="textarea-input" class="form-control-label">5. WHAT AREAS NEED IMPROVEMENT?</label>
                    </div>
                    <div class="form-group" required>
                            <textarea class="au-input au-input--full" name="q5"></textarea>
                    </div>
                    <div class="form-group" required>
                        <label for="textarea-input" class="form-control-label">6. WHAT WOULD YOU RECOMMEND TO MAKE THIS STUDENT BETTER PREPARED FOR THE WORKPLACE? (E.G. COURSES, ACTIVITIES, SKILLS ACQUISITION, PROGRAMS)?</label>
                    </div>
                    <div class="form-group" required>
                        <textarea class="au-input au-input--full" name="q6"></textarea>
                    </div>
                    <div class="form-group" required>
                        <label for="textarea-input" class="form-control-label">7. OTHER COMMENTS, COMMENDATIONS, OR RECOMMENDATIONS:</label>
                </div>
                <div class="form-group" required>
                        <textarea class="au-input au-input--full" name="q7"></textarea>
                </div>
                <div class="form-group">
                    <label>THANK YOU FOR YOUR TIME IN COMPLETING THIS EVALUATION!</label>
                </div>
               <!--  <div align="right" class="form">
                    <label>Signature</label>
                    <input type="signature" class="au-input au-input--full">
                </div> -->
                <div class="col-lg-6" align="left" >
                    <label>Date</label>
                    <input type="date" name="datesub" class="au-input au-input--full">
                </div>
                <br>
                <br>
                <button class="au-btn au-btn--block au-btn--green m-b-20" action="#" type="submit" name="submit">Submit</button>
</div>
</form>
</div>
</div>
</div>
</div>
<?php require_once('layouts/footer.php'); ?>
