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
    $UID = $_GET['UID'];
    $mik =  $pr;

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
    <h2 class="title-1 m-b-25">FEEDBACK FORM</h2>
                <div class="card">
                    <div class="card-body card-block">
                <form action="" method="post">
                    
                    <?php
                     //Display 
                     $UID = $_GET['UID'];
                     $query="select * from v_comp_user where userid=$UID";
                     $rs = mysqli_query($conn,$query);
                         foreach($rs as $row){
                     ?> 
                    <div class="row">
                        <div class="col-lg-6">
                        <label>EMPLOYER NAME</label>
                        <input class="au-input au-input--full" style="font-weight: bold;" type="text" name="emp" value="<?php echo $row["employer"]?>" readonly required>
                        <?php echo  "<p> <font color=red> $mik </font> </p>"; ?>
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
                    <?php } ?>


                    <div class="row">
                    <div class="col-lg-6">
                        <label>STUDENT NAME</label>
                        <input class="au-input au-input--full" type="stname" name="username" placeholder="STUDENT NAME"required>
                    </div>
                    <div class="col-lg-6">
                        <label>STUDENT NUMBER</label>
                        <input class="au-input au-input--full" type="stnumber" name="username" placeholder="STUDENT NUMBER"required>
                    </div>
                    </div>

                    <div class="row">
                    <div class="col-lg-4">
                        <label>POSITION OR ASSIGNMENT</label>
                        <input class="au-input au-input--full" type="empname" name="username" >
                    </div>
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
                            <select name="criteria" id="PERFORMANCE SCALE" class="form-control">
                            <option value="0">Please select</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            </select>
                            <label for="select" class=" form-control-label">PUNTUALITY</label>
                            <select name="criteria" id="PERFORMANCE SCALE" class="form-control">
                            <option value="0">Please select</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            </select>
                            <label for="select" class=" form-control-label">ATTITUDE</label>
                            <select name="criteria" id="PERFORMANCE SCALE" class="form-control">
                            <option value="0">Please select</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            </select>
                            <label for="select" class=" form-control-label">ACCEPTANCE CRITICISM</label>
                            <select name="criteria" id="PERFORMANCE SCALE" class="form-control">
                            <option value="0">Please select</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            </select>
                            <label for="select" class=" form-control-label">ASKS APPROPRIATE QUESTIONS</label>
                            <select name="criteria" id="PERFORMANCE SCALE" class="form-control">
                            <option value="0">Please select</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            </select>
                            <label for="select" class=" form-control-label">SELF MOTIVATED</label>
                            <select name="criteria" id="PERFORMANCE SCALE" class="form-control">
                            <option value="0">Please select</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            </select>
                            <label for="select" class=" form-control-label">PRACICES ETHICAL BEHAVIOR</label>
                            <select name="criteria" id="PERFORMANCE SCALE" class="form-control">
                            <option value="0">Please select</option>
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
                            <select name="criteria" id="PERFORMANCE SCALE" class="form-control">
                            <option value="0">Please select</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            </select>
                            <label for="select" class=" form-control-label">VERBAL COMMUNICATION SKILLS</label>
                            <select name="criteria" id="PERFORMANCE SCALE" class="form-control">
                            <option value="0">Please select</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            </select>
                            <label for="select" class=" form-control-label">WRITTEN COMMUNICATION SKILLS</label>
                            <select name="criteria" id="PERFORMANCE SCALE" class="form-control">
                            <option value="0">Please select</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            </select>
                            <label for="select" class=" form-control-label">ANALYTICAL SKILLS – ANALYSES PROBLEMS AND TAKES APPROPRIATE ACTION</label>
                            <select name="criteria" id="PERFORMANCE SCALE" class="form-control">
                            <option value="0">Please select</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            </select>
                            <label for="select" class=" form-control-label">USES TECHNICAL SKILLS REQUIRED FOR THE POSITION</label>
                            <select name="criteria" id="PERFORMANCE SCALE" class="form-control">
                            <option value="0">Please select</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            </select>
                            <label for="select" class=" form-control-label">MEETS DEADLINES</label>
                            <select name="criteria" id="PERFORMANCE SCALE" class="form-control">
                            <option value="0">Please select</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            </select>
                            <label for="select" class=" form-control-label">TAKES INITIATIVE TO GET A JOB DONE, INCLUDING OVERCOMING OBSTACLES</label>
                            <select name="criteria" id="PERFORMANCE SCALE" class="form-control">
                            <option value="0">Please select</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            </select>
                            <label for="select" class=" form-control-label">SETS PRIORITIES</label>
                            <select name="criteria" id="PERFORMANCE SCALE" class="form-control">
                            <option value="0">Please select</option>
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
                    <div class="form">
                        <label>3. HOW WOULD YOU ASSESS THE STUDENT’S OVERALL PERFORMANCE?</label>
                        <br>
                        <input type="radio" id="OUTSTANDING" name="PERFORMANCE" value="OUTSTANDING" aria-label="OUTSTANDING">
                        <label for="OUTSTANDING">OUTSTANDING</label><br>
                        <input type="radio" id="ABOVE AVERAGE" name="PERFORMANCE" value="ABOVE AVERAGE">
                        <label for="ABOVE AVERAGE">ABOVE AVERAGE</label><br>
                        <input type="radio" id="SATISFACTORY" name="PERFORMANCE" value="SATISFACTORY">
                        <label for="SATISFACTORY">SATISFACTORY</label><br>
                        <input type="radio" id="BELOW AVERAGE" name="PERFORMANCE" value="BELOW AVERAGE">
                        <label for="BELOW AVERAGE">BELOW AVERAGE</label><br>
                        <input type="radio" id="UNSATISFACTORY" name="PERFORMANCE" value="UNSATISFACTORY">
                        <label for="UNSATISFACTORY">UNSATISFACTORY</label>
                    </div>
                    <br>                 
                    <div class="form-group">
                        <label for="textarea-input" class="form-control-label">4. WHAT DO YOU CONSIDER THE MAJOR STRENGTHS OF THIS STUDENT? </label>
                    </div>
                    <div class="form-group">
                        <textarea class="au-input au-input--full" name="TaskDesc"></textarea>
                    </div>
                    <div class="form-group">
                            <label for="textarea-input" class="form-control-label">5. WHAT AREAS NEED IMPROVEMENT?</label>
                    </div>
                    <div class="form-group">
                            <textarea class="au-input au-input--full" name="TaskDesc"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="textarea-input" class="form-control-label">6. WHAT WOULD YOU RECOMMEND TO MAKE THIS STUDENT BETTER PREPARED FOR THE WORKPLACE? (E.G. COURSES, ACTIVITIES, SKILLS ACQUISITION, PROGRAMS)?</label>
                    </div>
                    <div class="form-group">
                        <textarea class="au-input au-input--full" name="TaskDesc"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="textarea-input" class="form-control-label">7. OTHER COMMENTS, COMMENDATIONS, OR RECOMMENDATIONS:</label>
                </div>
                <div class="form-group">
                        <textarea class="au-input au-input--full" name="TaskDesc"></textarea>
                </div>
                <div class="form-group">
                    <label>THANK YOU FOR YOUR TIME IN COMPLETING THIS EVALUATION!</label>
                </div>
                <div align="right" class="form">
                    <label>Signature</label>
                    <input type="signature" class="au-input au-input--full">
                </div>
                <div align="right" >
                    <label>Date</label>
                    <input type="text" class="au-input au-input--full">
                </div>
                    <button class="au-btn au-btn--block au-btn--green m-b-20" action="#" type="submit" name="submit">Submit</button>
</div>
</form>
</div>




















</div>
</div>
</div>
<?php require_once('layouts/footer.php'); ?>
