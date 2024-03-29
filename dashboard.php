<?php 
	session_start();
	
	if(!isset($_SESSION['RoleId']))
	{
		header('location:login.php?lmsg=true');
		exit;
	}		

	require_once('inc/config.php');
	require_once('layouts/header.php'); 
	
	//Upload .csv file
	if(isset($_POST["submit"]))
	{
		if($_FILES['file']['name'])
		{
			$filename = explode(".", $_FILES['file']['name']);
			if($filename[1] == 'csv')
		{
			$handle = fopen($_FILES['file']['tmp_name'], "r");
			//Skips first row of excel file
			fgetcsv($handle);	
		while($data = fgetcsv($handle))
		{
			$item1 = mysqli_real_escape_string($conn, $data[0]);  
			$item2 = mysqli_real_escape_string($conn, $data[1]);
			$item3 = mysqli_real_escape_string($conn, $data[2]);  
			$item4 = mysqli_real_escape_string($conn, $data[3]);
			$item5 = mysqli_real_escape_string($conn, $data[4]);  
			$item6 = mysqli_real_escape_string($conn, $data[5]);
			$query = "INSERT INTO Student (`SID`,`First_Name`, `Last_Name`, `Email`, `Contact`,`Specialisation`,`UserID`) VALUES ('$item1','$item2', '$item3', '$item4', '$item5', '$item6', '3')";
			mysqli_query($conn, $query);
		}
			fclose($handle);
			echo "<script>alert('Import done');</script>";
		}
		}
    }

    if(isset($_POST["submitEX"]))
    {
      $sql = "INSERT INTO studentexperience (studentid, role, company, location, duration, description) VALUES (?,?,?,?,?,?)";
      if ($stmt = mysqli_prepare($conn, $sql)) {
      
      mysqli_stmt_bind_param($stmt, "ssssss", $param_sid, $param_role, $param_cname, $param_location, $param_duration, $param_desc );

        $UID = $_GET['UID'];
        $sql3 = "select studentid from student where userid = '" . $UID . "'";
        $rs = mysqli_query($conn, $sql3);
        $row = mysqli_fetch_row($rs);
        $param_sid = $row[0];
        $param_role = $_POST['role'];
        $param_cname = $_POST['cname'];
        $param_location = $_POST['location'];
        $param_duration = $_POST['duration'];
        $param_desc = $_POST['description'];
 
        if (mysqli_stmt_execute($stmt)) {
          header("location: dashboard.php?UID=$UID");
      } else {
          echo "Please check that you have entered the correct details.";
      }
      mysqli_stmt_close($stmt);
    }
  }

    if(isset($_POST["Update"]))
    {
        $UID = $_GET['UID'];
        $firstname = $_POST['firstname'];
        $lastName = $_POST['lastName'];
        $Email = $_POST['Email'];
        $ContactNo = $_POST['ContactNo'];
        $Specialisation = $_POST['Specialisation'];
        $Nationality = $_POST['Nationality'];
        $update = "UPDATE student SET FirstName='$firstname',LastName='$lastName',EmailAddress='$Email',ContactNo='$ContactNo',Specialisation='$Specialisation',Nationality='$Nationality' where USERID='".$UID."'";
        mysqli_query($conn, $update);
    }

    if(isset($_POST["UpdateCom"]))
    {
        $UID = $_GET['UID'];
        $firstname = $_POST['firstname'];
        $lastName = $_POST['lastName'];
        $role = $_POST['role'];
        $Email = $_POST['Email'];
        $ContactNo = $_POST['ContactNo'];
        $update = "UPDATE companyuser SET Role = '$role', FirstName='$firstname',LastName='$lastName',EmailAddress='$Email',ContactNo='$ContactNo' where USERID='".$UID."'";
        mysqli_query($conn, $update);
    }

    //Fetch data of student from database for input type
    $UID = $_GET['UID'];
    $fetch = "SELECT * from student";
    $student = mysqli_query($conn, $fetch);
    $rstudent = mysqli_fetch_array($student);
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
                    
                    <?php 
                    if($_SESSION['RoleId'] == 4){?>
                      <div class="row">
                              <div class="col-md-12">
                                  <div class="au-card">
                                      <div>
                                          <div class="table-button" align="right">
                                              <button class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal" data-target="#myModalProfileCom">
                                                  <i class="fas fa-edit"></i>Edit</button>
                                          </div>
                                          <?php
                                              //Display 
                                              $UID = $_GET['UID'];
                                              $query="select a.*, b.companyname from companyuser a inner join company b on a.companyid = b.companyid where a.USERID=$UID";
                                              $rs = mysqli_query($conn,$query);
                                              //$count = 0;
                                                  foreach($rs as $row){
                                          ?> 
                                          <h2><?php echo $row["FirstName"]." ".$row["LastName"]?></h2>
                                          <h4><?php echo $row["companyname"]?></h4>
                                          <h4><?php echo $row["Role"]?></h4>
                                          <h4><?php echo $row["EmailAddress"]?></h4>
                                          <h4><?php echo $row["ContactNo"]?></h4>
                                         
                                          <?php } ?>
                                      </div>
                                       
                              </div>
                              </div>
                          </div>
                      </div>
                      <?php } ?>
                    
                    <?php 
                 
                    if($_SESSION['RoleId'] == 3){?>
                    <div class="row">
                            <div class="col-md-12">
                                <div class="au-card">
                                    <div>
                                        <div class="table-button" align="right">
                                            <button class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal" data-target="#myModalProfile">
                                                <i class="fas fa-edit"></i>Edit</button>
                                        </div>
                                        <?php
                                            //Display Student List
                                            $UID = $_GET['UID'];
                                            $query="select * from student where USERID=$UID";
                                            $rs = mysqli_query($conn,$query);
                                            //$count = 0;
                                                foreach($rs as $row){
                                        ?> 
                                        <h2><?php echo $row["FirstName"]." ".$row["LastName"]?></h2>
                                        <h4><?php echo $row["Specialisation"]?></h4>
                                        <h4><?php echo $row["EmailAddress"]?></h4>
                                        <h4><?php echo $row["ContactNo"]?></h4>
                                        <h4><?php echo $row["Nationality"]?></h4>
                                                <?php } ?>
                                    </div>
                                    <hr>
                                    <div>
                                        <div class="table-button" align="right">
                                            <button class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal" data-target="#myModalWorkEx">
                                                <i class="fas fa-edit"></i>ADD</button>
                                        </div>
                                       
                                       
                                        <h2>Work Experience</h2>
                                      
        <table class="table table-borderless table-striped table-earning">
            <thead>
                    <tr>
                        <th>Role</th>
                        <th>Company</th>
                        <th>Location</th>
                        <th>Duration</th>
                        <th>Open Description</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                   $query="select a.* from studentexperience a inner join student b on a.studentid = b.studentid  where b.USERID=$UID";
                   $rs = mysqli_query($conn,$query);
                      foreach($rs as $row){
                ?>   
                    <tr>                
                        <td><?php echo $row["Role"]?></td>
                        <td><?php echo $row["Company"]?></td>
                        <td><?php echo $row["Location"]?></td>
                        <td><?php echo $row["Duration"]?></td>
                        <form action="" method="POST">                    
                        <td>
                            
                        <div class="form-actions form-group">
                        <input type="hidden" name="exid" id="exid" value="<?php echo $row["id"]; ?>"> 
                        <a href="workex.php?UID=<?php echo $_GET["UID"]?>?abcau=<?php echo $row['id']?>">VIEW</a>
                                             
                        </div>  
             
                        </td>
                               
                    </tr>
                    <?php } ?>
                    <?php }?> 
                       
                </tbody>
             </table>
          
                            
                        </div>
                    </div>
                    <!-- Mdal Code Start -->
           	
                    <!-- Modal Code Finish-->
                    <?php 
                    //only visible to admin 
                    if($_SESSION['RoleId'] == 1 || $_SESSION['RoleId'] == 2){?>
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="title-1 m-b-25">Student List</h2>
                            <div class="table-responsive table--no-card m-b-40">
                                <table class="table table-borderless table-striped table-earning">
                                <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>SID</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Contact</th>
                                            <th>Specialisation</th>
                                            <th>Year Enrolled</th>
                                            <th>Nationality</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            //Display Student List
                                            $query="select * from Student";
                                            $rs = mysqli_query($conn,$query);
                                            $count = 0;
                                                foreach($rs as $row){
                                        ?>  
                                        <tr>
                                            <td><?php echo ++$count;?> </td>
                                            <td><?php echo $row["StudentID"]?></td>
                                            <td><?php echo $row["FirstName"];?></td>
                                            <td><?php echo $row["LastName"];?></td>
                                            <td><?php echo $row["EmailAddress"];?></td>
                                            <td><?php echo $row["ContactNo"];?></td>
                                            <td><?php echo $row["Specialisation"];?></td>
                                            <td><?php echo $row["YearEnrolled"];?></td>
                                            <td><?php echo $row["Nationality"];?></td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                      </div>
                        <?php } ?>
                    </div>
                    <!-- Mdal Code Start -->
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->


            <div id="myModalProfileCom" class="modal fade" role="dialog">
              <div class="modal-dialog">
              <!-- Modal content-->
                <div class="modal-content">
                <?php
                          $query=" select a.*, b.companyname from companyuser a inner join company b on a.companyid = b.companyid where a.USERID=$UID";
                          $student = mysqli_query($conn,$query);
                          $rs = mysqli_fetch_array($student);
                  ?> 
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <div class="card">
                        <div class="card-header">
                        
                            <strong>Profile</strong>
                          </div>
                          <form action="" method="POST">
                          <div class="card-body card-block">
                            <div class="form-group">
                              <label class=" form-control-label">First Name</label>
                              <input type="text" value="<?php echo $rs["FirstName"]?>"class="form-control" name="firstname">
                            </div>
                            <div class="form-group">
                              <label class=" form-control-label">Last Name</label>
                              <input type="text" value="<?php echo $rs["LastName"]?>" class="form-control" name="lastName">
                            </div>
                            <div class="form-group">
                              <label class=" form-control-label">Role</label>
                              <input type="text" value="<?php echo $rs["Role"]?>" class="form-control" name="role">
                            </div>
                            <div class="form-group">
                              <label class=" form-control-label">Email</label>
                              <input type="text" value="<?php echo $rs["EmailAddress"]?>" class="form-control" name="Email">
                            </div>
                            <div class="form-group">
                             <label class=" form-control-label">Contact No</label>
                             <input type="text" value="<?php echo $rs["ContactNo"]?>" class="form-control" name="ContactNo">
                            </div>                                           
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-default" name="UpdateCom">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
              
              </div>
            </div>
            </form>
            <!-- Modal Code Finish-->            
            

            <div id="myModalProfile" class="modal fade" role="dialog">
              <div class="modal-dialog">
              <!-- Modal content-->
                <div class="modal-content">
                <?php
                          $query=" SELECT * from student where userid =  $UID ";
                          $student = mysqli_query($conn,$query);
                          $rs = mysqli_fetch_array($student);
                  ?> 
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <div class="card">
                        <div class="card-header">
                        
                            <strong>Profile</strong>
                          </div>
                          <form action="" method="POST">
                          <div class="card-body card-block">
                            <div class="form-group">
                              <label class=" form-control-label">First Name</label>
                              <input type="text" value="<?php echo $rs["FirstName"]?>"class="form-control" name="firstname">
                            </div>
                            <div class="form-group">
                              <label class=" form-control-label">Last Name</label>
                              <input type="text" value="<?php echo $rs["LastName"]?>" class="form-control" name="lastName">
                            </div>
                            <div class="form-group">
                              <label class=" form-control-label">Specialisation</label>
                              <input type="text" value="<?php echo $rs["Specialisation"]?>" class="form-control" name="Specialisation">
                            </div>
                            <div class="form-group">
                              <label class=" form-control-label">Email</label>
                              <input type="text" value="<?php echo $rs["EmailAddress"]?>" class="form-control" name="Email">
                            </div>
                            <div class="form-group">
                             <label class=" form-control-label">Contact No</label>
                             <input type="text" value="<?php echo $rs["ContactNo"]?>" class="form-control" name="ContactNo">
                            </div>
                            
                            <div class="form-group">
                             <label class=" form-control-label">Nationality</label>
                             <input type="text" value="<?php echo $rs["Nationality"]?>" class="form-control" name="Nationality">
                            </div>
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-default" name="Update">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
              
              </div>
            </div>
            </form>
            <!-- Modal Code Finish-->



            <!-- Mdal Code Start -->
            <div id="myModalWorkEx" class="modal fade" role="dialog">
              <div class="modal-dialog">
              <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <div class="card">
                        <div class="card-header">
                            <strong>Work Experience</strong>
                          </div>
                          <form action="" method="POST">
                          <div class="card-body card-block">
                            <div class="form-group">
                              <label for="designation" class=" form-control-label">Designation</label>
                              <input type="text" id="role" name="role" placeholder="Enter your Designation" class="form-control">
                            </div>
                            <div class="form-group">
                              <label for="company" class=" form-control-label">Company</label>
                              <input type="text" id="cname" name="cname" placeholder="Company Name" class="form-control">
                            </div>
                            <div class="form-group">
                             <label for="location" class=" form-control-label">Location</label>
                             <input type="text" id="location" name="location" placeholder="Enter Location" class="form-control">
                            </div>
                            <div class="form-group">
                             <label for="duration" class=" form-control-label">Duration</label>
                             <input type="text" id="duration" name="duration" placeholder="e.g Jan 2018 - June 2020" class="form-control">
                            </div>
                            <div class="form-group">
                             <label for="discription" class=" form-control-label">Description</label>
                             <textarea rows="4" cols="50" id="description" name="description" placeholder="Description" class="form-control"> </textarea>
                            </div>
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-default" name="submitEX">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            <?php require_once('layouts/footer.php'); ?>
