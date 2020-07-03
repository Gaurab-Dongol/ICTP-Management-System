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
    $uname_err =  $err_msg= $err_msg2= $err_msg3= "";

    if(isset($_POST['submit'])){
        // Check input error
        $sql = "SELECT semester FROM semester where semester = ? ";
    
        if ($stmt = mysqli_prepare($conn, $sql)) {  
            mysqli_stmt_bind_param($stmt, "s", $param_year );
    
            $param_sem  = trim($_POST["year"]); 
    
            if (mysqli_stmt_execute($stmt)) {
    
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) > 0) {
                    $err_msg = "This semester - " . $param_sem . " already exists.";
                } else {
                    $err_msg = "";
                }
            } else {
                echo "Something went wrong. Please check that you have entered the correct details.";
            }
            mysqli_stmt_close($stmt);
        }
    
        if (empty($err_msg)) {
            $sql = "INSERT INTO semester (semester) VALUES (?)";
            if ($stmt = mysqli_prepare($conn, $sql)) {
                
                mysqli_stmt_bind_param($stmt, "s", $param_sem);
    
                $param_sem = trim($_POST["sem"]);
            
                if (mysqli_stmt_execute($stmt)) {
                    // Redirect to login page
                    header("location: basetable.php?UID=$UID");
                }else {
                    echo "Something went wrong. Please check that you have entered the correct details.";
                }
                mysqli_stmt_close($stmt);
                }
            }
            } 
            
            
if(isset($_POST['submitEY'])){
        // Check input error
        $sql = "SELECT year FROM enrollmentyear where year = ? ";
    
        if ($stmt = mysqli_prepare($conn, $sql)) {  
            mysqli_stmt_bind_param($stmt, "s", $param_year );
    
            $param_year  = trim($_POST["year"]); 
    
            if (mysqli_stmt_execute($stmt)) {
    
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) > 0) {
                    $err_msg2 = "This year - " . $param_year . " already exists.";
                } else {
                    $err_msg2 = "";
                }
            } else {
                echo "Something went wrong. Please check that you have entered the correct details.";
            }
            mysqli_stmt_close($stmt);
        }
    
        if (empty($err_msg2)) {
            $sql = "INSERT INTO enrollmentyear (year) VALUES (?)";
            if ($stmt = mysqli_prepare($conn, $sql)) {
                
                mysqli_stmt_bind_param($stmt, "s", $param_year);
    
                $param_year = trim($_POST["year"]);
            
                if (mysqli_stmt_execute($stmt)) {
                    // Redirect to login page
                    header("location: basetable.php?UID=$UID");
                }else {
                    echo "Something went wrong. Please check that you have entered the correct details.";
                }
                mysqli_stmt_close($stmt);
                }
            }
            }             

if(isset($_POST['submitSpec'])){
        // Check input error
        $sql = "SELECT description FROM specialisation where description = ? ";
    
        if ($stmt = mysqli_prepare($conn, $sql)) {  
            mysqli_stmt_bind_param($stmt, "s", $param_desc );
    
            $param_desc  = trim($_POST["spec"]); 
    
            if (mysqli_stmt_execute($stmt)) {
    
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) > 0) {
                    $err_msg3 = "This specialisation - " . $param_desc . " already exists.";
                } else {
                    $err_msg3 = "";
                }
            } else {
                echo "Something went wrong. Please check that you have entered the correct details.";
            }
            mysqli_stmt_close($stmt);
        }
    
        if (empty($err_msg3)) {
            $sql = "INSERT INTO specialisation (description) VALUES (?)";
            if ($stmt = mysqli_prepare($conn, $sql)) {
                
                mysqli_stmt_bind_param($stmt, "s", $param_desc);
    
                $param_desc = trim($_POST["spec"]);
            
                if (mysqli_stmt_execute($stmt)) {
                    // Redirect to login page
                    header("location: basetable.php?UID=$UID");
                }else {
                    echo "Something went wrong. Please check that you have entered the correct details.";
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
                        <div class="col-lg-6">
                        <div class="table-button" align="right">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal" data-target="#addModalSem">
                                <i class="fas fa-edit"></i>Add</button>
                        </div>
                            <h2 class="title-1 m-b-25">Semeter List</h2>
                            <?php echo  "<p> <font color=red> $err_msg </font> </p>"; ?>
                            <div class="table-responsive table--no-card m-b-40">
                                <table class="table table-borderless table-striped table-earning">
                                <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Semester</th>
                                            <th>Activation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            //Display Student List
                                            $query="select id as 'semid', semester, activation from semester";
                                            $rs = mysqli_query($conn,$query);
                                            $count = 0;
                                                foreach($rs as $row){
                                        ?>  
                                        <tr>
                                            <td><?php echo $row["semid"]?></td>
                                            <td><?php echo $row["semester"];?></td>
                                            <td><?php echo $row["activation"];?></td>                        
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                        <div class="table-button" align="right">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal" data-target="#addModalEY">
                                <i class="fas fa-edit"></i>Add</button>
                        </div>
                            <h2 class="title-1 m-b-25">Enrollment Year List</h2>
                            <?php echo  "<p> <font color=red> $err_msg2 </font> </p>"; ?>
                            <div class="table-responsive table--no-card m-b-40">
                                <table class="table table-borderless table-striped table-earning">
                                <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Year</th>
                                            <th>Activation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            //Display Student List
                                            $query="select id as 'eyid', year, activation from enrollmentyear";
                                            $rs = mysqli_query($conn,$query);
                                            $count = 0;
                                                foreach($rs as $row){
                                        ?>  
                                        <tr>
                                            <td><?php echo $row["eyid"]?></td>
                                            <td><?php echo $row["year"];?></td>
                                            <td><?php echo $row["activation"];?></td>                        
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>

                      </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="table-button" align="right">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal" data-target="#addModalSpec">
                                <i class="fas fa-edit"></i>Add</button>
                        </div>
                            <h2 class="title-1 m-b-25">Specialisation List</h2>
                            <?php echo  "<p> <font color=red> $err_msg3 </font> </p>"; ?>
                            <div class="table-responsive table--no-card m-b-40">
                                <table class="table table-borderless table-striped table-earning">
                                <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Description</th>
                                            <th>Activation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            //Display Student List
                                            $query="select id as 'specid', description, activation from specialisation";
                                            $rs = mysqli_query($conn,$query);
                                            $count = 0;
                                                foreach($rs as $row){
                                        ?>  
                                        <tr>
                                            <td><?php echo $row["specid"]?></td>
                                            <td><?php echo $row["description"];?></td>
                                            <td><?php echo $row["activation"];?></td>                        
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>                    
                    
                    </div>
                        <!-- END MAIN CONTENT-->
                </div>
            </div>

             <!-- Start Modal-->
            <div id="addModalSem" class="modal fade" role="dialog">
              <div class="modal-dialog">
              <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <div class="card">
                        <div class="card-header">
                        
                            <strong>Add semester</strong>
                          </div>
                          <form action="" method="POST">
                          <div class="card-body card-block">
                            
                                <div class="form-group">
                                    <label>Semester</label>
                                    <input class="au-input au-input--full" type="text" name="sem" placeholder="Semester" required>
                                </div>            

                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-default" name="submit">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
              
              </div>
            </div>
            </form>
            <!-- Modal Code Finish-->   

            
  <!-- Start Modal-->
  <div id="addModalEY" class="modal fade" role="dialog">
              <div class="modal-dialog">
              <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <div class="card">
                        <div class="card-header">
                        
                            <strong>Add Enrollment Year</strong>
                          </div>
                          <form action="" method="POST">
                          <div class="card-body card-block">
                            
                                <div class="form-group">
                                    <label>Year</label>
                                    <input class="au-input au-input--full" type="int" name="year" placeholder="Year" required>
                                </div>            

                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-default" name="submitEY">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
              
              </div>
            </div>
            </form>
<!-- Modal Code Finish-->  

<!-- Start Modal-->
<div id="addModalSpec" class="modal fade" role="dialog">
              <div class="modal-dialog">
              <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <div class="card">
                        <div class="card-header">
                        
                            <strong>Add Specialisation</strong>
                          </div>
                          <form action="" method="POST">
                          <div class="card-body card-block">
                            
                                <div class="form-group">
                                    <label>Specialisation</label>
                                    <input class="au-input au-input--full" type="text" name="spec" placeholder="specialisation" required>
                                </div>            

                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-default" name="submitSpec">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
              
              </div>
            </div>
            </form>
<!-- Modal Code Finish-->  


 <?php require_once('layouts/footer.php'); ?>