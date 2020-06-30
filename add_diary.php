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
     
    $param_total = "0";
    
    $query2="SELECT sum(TotalHours) as totalhr from diary where studentid = (select studentid from student where userid = '$UID') and status in ('on-going','approved') group by InternshipId, StudentID"; 
    $results = mysqli_query($conn,$query2);
    while ($rows = mysqli_fetch_array($results))
    {
        $param_total = $rows["totalhr"];
    } 

    $agg_msg = "This is your total approved hours - " . $param_total . ".";


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
                                <h3 class="title-5 m-b-35">My Weekly Diary</h3>
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
                                                <th>Week No</th>
                                                <th>Total hours</th>
                                                <th>Task Description</th>
                                                <th>Status</th>
                                                <th>Manager Remarks</th>
                                                <th>Unit Coordinator Remarks</th>
                                                <th>Edit/Delete</th>
                                                
                                            </tr>
                                        </thead>
                                        <?php
                                            //Display Student List
                                            $UID = $_GET['UID'];
                                            $query= "SELECT student.StudentID, Diary.* FROM student INNER JOIN Diary ON student.StudentID=Diary.StudentID WHERE student.USERID='$UID' order by weekno";
                                            //$query='select * from diary';
                                            $rs = mysqli_query($conn,$query);
                                            $count = 1;
                                                foreach($rs as $row){
                                        ?> 
                                        <tbody>
                                            <tr class="tr-shadow">
                                                <td class="desc"><?php echo $row["WeekNo"]?></td>
                                                <td>
                                                    <span class="block-email"><?php echo $row["TotalHours"]?></span>
                                                </td>
                                                <td class="desc"><?php echo $row["TaskDesc"]?></td>
                                                <td class="desc"><?php echo $row["status"]?></td>
                                                <td class="desc"><?php echo $row["ManagerRemarks"]?></td>
                                                <td class="desc"><?php echo $row["UCRemarks"]?></td>
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
                                <large> <?php echo  "<p> <font color=blue> $agg_msg </font> </p>"; ?> </large>
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
                          <strong>Weekly Diary</strong>
                          </div>
                          <form action="" method="POST">
                          <div class="card-body card-block">
                          <div class="form-group">
                          <label for="textarea-input" class="form-control-label">Completed Task <small><i>(in bullet form)</i></small> </label>
                          </div>
                          <div class="form-group">
                          <textarea class="ckeditor" name="TaskDesc"></textarea>
                           </div>
                           <div class="form-group">
                           <label>Numbers of Hour</label>
                          <input class="au-input au-input--full" type="number" name="NoHours" required>
                          </div>
                          <div class="form-group">
                          <label>Start Date:</label>
                          <input class="au-input au-input--full" type="date" name="start" required>
                          </div>
                          <div class="form-group">
                          <label>End Date:</label>
                          <input class="au-input au-input--full" type="date" name="end" required>
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