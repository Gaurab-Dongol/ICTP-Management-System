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
  $err_msg ="";
  
 

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
                                       <div class="table-responsive table--no-card m-b-40">
            <table class="table table-borderless table-striped table-earning">
            <thead>
                    <tr>
                        <th>SID</th>
                        <th>Student Name</th>
                        <th>Job Role</th>
                        <th>Feedback Status</th>
                        <th>Open Feedback</th>
                    </tr>
                </thead>
                <tbody>
                <?php

                   
                   $query="select a.internshipid , a.studentid, concat(b.FirstName , ' ', b.LastName) as 'fullname', d.website, c.location, c.JobRole, d.companyname, concat(e.FirstName , ' ', e.LastName) as 'supervisor', e.emailaddress, a.status, a.jobresponsibility, a.semester, b.emailaddress as 'semailadd' from student_intern a inner join student b on a.studentid = b.studentid inner join internship c on a.internshipid = c.internshipid inner join company d on d.companyid = c.companyid inner join companyuser e on e.companyuserid = c.companyuserid where a.Status != 'Pending' and  c.companyuserid = (select companyuserid from companyuser where userid =  $UID  )  order by semester, fullname ";
                   $rs = mysqli_query($conn,$query);
                
                       foreach($rs as $row){
                ?>   
                    <tr>
                   
                        <td><?php echo $row["studentid"]?></td>
                        <td><?php echo $row["fullname"]?></td>
                        <td><?php echo $row["JobRole"]?></td>
                        <td>Pending</td>
                        <form action="" method="POST">                    
                        <td>
                            
                        <div class="form-actions form-group">
                        <!--<input type="hidden" name="diaryid" id="diaryid" value="<?php echo $row["id"]; ?>">  -->
                        <input type="hidden" name="sidn" id="sidn" value="<?php echo $row["studentid"]; ?>">
                        <?php echo  "<p> <font color=red> $err_msg </font> </p>"; ?>
                        <input type="hidden" name="internshipid" id="internshipid" value="<?php echo $row["internshipid"]; ?>">
                        <input type="hidden" name="stat" id="stat" value="<?php echo $row["status"]; ?>">
          
                        <a href="f.php?UID=<?php echo $_GET["UID"]?>?abcau=<?php echo $row['studentid']?>">Fill Out</a>
                        </div>  
             
                        </td>
                               
                    </tr>
                     
                    <?php }?> 
                       
                </tbody>
             </table>
        </div>
                                        
                                    </div>
                                    <hr>
   
                                </div>
                            </div>
                        </div>
                      </div>
                  </div>
                </div>
          </div>
    </div>
            <!-- END MAIN CONTENT-->
    </div>
            </div>
            
            <!-- Modal Code Finish-->

            
    <?php require_once('layouts/footer.php'); ?>
