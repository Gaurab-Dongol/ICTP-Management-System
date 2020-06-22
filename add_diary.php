<?php 
	session_start();
	
	if(!isset($_SESSION['RoleId']))
	{
		header('location:login.php?lmsg=true');
		exit;
    }		
    require_once('inc/config.php');
    require_once('layouts/header.php'); 

    if(isset($_POST["Delete"]))
    {
     
    }

    //Fetch data of student from database for input type
    $UID = $_GET['UID'];
    $fetch = "SELECT * FROM login AS A LEFT OUTER JOIN student AS B ON A.USERID = B.USERID LEFT OUTER JOIN staff AS C ON B.USERID = C.USERID LEFT OUTER JOIN companyuser AS D ON C.USERID = D.UserId WHERE A.USERID = '".$UID."'";
    $s = mysqli_query($conn, $fetch);
    $r = mysqli_fetch_array($s);
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
                                <!-- DATA TABLE -->
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                <h3 class="title-5 m-b-35">My Diary</h3>
                                    </div>
                                    <div class="table-data__tool-right">
                                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                            <i class="zmdi zmdi-plus"></i><a href="diary.php?UID=<?php echo $_GET['UID']?>">add item</a></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive table-responsive-data2">
                                    <table class="table table-data2">
                                        <thead>
                                            <tr>
                                                <th>Version No</th>
                                                <th>Total hours</th>
                                                <th>Task Description</th>
                                                <th>Date submitted</th>
                                                <th>Edit/Delete</th>
                                                <!--<th>Manager Remarks</th>
                                                <th>status</th>
                                                <th>price</th>
                                                <th></th>-->
                                            </tr>
                                        </thead>
                                        <?php
                                            //Display Student List
                                            $UID = $_GET['UID'];
                                            $query= "SELECT student.StudentID, Diary.* FROM student INNER JOIN Diary ON student.StudentID=Diary.StudentID WHERE student.USERID='$UID'";
                                            //$query='select * from diary';
                                            $rs = mysqli_query($conn,$query);
                                            $count = 1;
                                                foreach($rs as $row){
                                        ?> 
                                        <tbody>
                                            <tr class="tr-shadow">
                                                <td><?php echo $count?></td>
                                                <td>
                                                    <span class="block-email"><?php echo $row["TotalHours"]?></span>
                                                </td>
                                                <td class="desc"><?php echo $row["TaskDesc"]?></td>
                                                <td class="desc"><?php echo $row["DateSubmitted"]?></td>
                                                <td>
                                                    <div class="table-data-feature">
                                                            <button class="item" data-toggle="modal" data-target="#myModalProfile" name="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete" name="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <?php } ?>
                                    </table>
                                </div>
                                <!-- END DATA TABLE -->
                            </div> 
                    </div>
                </div>
            </div>
    
    <div id="myModalProfile" class="modal fade" role="dialog">
              <div class="modal-dialog">
              <!-- Modal content-->
                <div class="modal-content">
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
                              <input type="text" value="<?php echo $r["FirstName"];?>"class="form-control" name="firstname">
                            </div>
                            <div class="form-group">
                              <label class=" form-control-label">Last Name</label>
                              <input type="text" value="<?php echo $r["LastName"];?>" class="form-control" name="lastName">
                            </div>
                            <div class="form-group">
                              <label class=" form-control-label">Specialisation</label>
                              <input type="text" value="<?php echo $r["Specialisation"];?>" class="form-control" name="Specialisation">
                            </div>
                            <div class="form-group">
                              <label class=" form-control-label">Email</label>
                              <input type="text" value="<?php echo $r["EmailAddress"];?>" class="form-control" name="Email">
                            </div>
                            <div class="form-group">
                             <label class=" form-control-label">Contact No</label>
                             <input type="text" value="<?php echo $r["ContactNo"];?>" class="form-control" name="ContactNo">
                            </div>
                            
                            <div class="form-group">
                             <label class=" form-control-label">Nationality</label>
                             <input type="text" value="<?php echo $r["Nationality"];?>" class="form-control" name="Nationality">
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

            </div>
    </div>
<?php require_once('layouts/footer.php'); ?>