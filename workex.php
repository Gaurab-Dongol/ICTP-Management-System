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
         {header("location: dashboard.php?UID=$UID");  
         }else {
            header("location: dashboard.php?UID=$UID");  
        }
             
    }

    if(isset($_POST["Del"]))
    {
        

        $del = "DELETE FROM  studentexperience where ID='".$ID."'";
        mysqli_query($conn, $del);
        header("location: dashboard.php?UID=$UID");

    }
    
    if(isset($_POST["Upd"]))
    {
        $UID = $_GET['UID'];
        $param_role = $_POST['role'];
        $param_cname = $_POST['cname'];
        $param_location = $_POST['location'];
        $param_duration = $_POST['duration'];
        $param_desc = $_POST['description'];

        $update = "UPDATE studentexperience SET Role='$param_role', Company='$param_cname',Location='$param_location',Duration='$param_duration',Description='$param_desc' where ID='".$ID."'";
        mysqli_query($conn, $update);
        header("location: dashboard.php?UID=$UID");

    }

    
?>

<div class="page-wrapper">
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
                <div class="login-wrap">
                    <div class="login-content">
                        <!--<div class="login-logo">
                            <a href="#">
                                <img src="images/456.png" alt="WSU">
                            </a>
                        </div>-->
                        <div class="diary-form">
                        <h3><center>Work Experience</center></h3>
                        <?php echo  "<p> <font color=red> $err_msg </font> </p>"; ?>
                            <form action="" method="POST">
                             
                            <?php
                          //Display 
                          //$query="select a.*, concat(b.FirstName , ' ', b.LastName) as 'student', b.studentid as studentid, c.jobrole, concat(e.FirstName , ' ', e.LastName) as 'employer',  d.CompanyName AS companyname, e.EmailAddress AS emailaddress,e.ContactNo AS contactno from feedback a inner join student b on a.studentid = b.studentid inner join internship c on a.InternshipId = c.internshipid inner join company d on d.companyid = c.companyid inner join companyuser e on e.companyuserid = c.companyuserid where c.companyuserid = (select companyuserid from companyuser where userid =  $UID ) and id = $ID";
                          $query="select * from studentexperience where id = $ID";
                          $rs = mysqli_query($conn,$query);
                          foreach($rs as $row){
                          ?> 
                            <div class="card-body card-block">
                            <div class="form-group">
                              <label for="designation" class=" form-control-label">Designation</label>
                              <input type="text" id="role" name="role" value="<?php echo $row["Role"]?>" class="form-control">
                            </div>
                            <div class="form-group">
                              <label for="company" class=" form-control-label">Company</label>
                              <input type="text" id="cname" name="cname" value="<?php echo $row["Company"]?>" class="form-control">
                            </div>
                            <div class="form-group">
                             <label for="location" class=" form-control-label">Location</label>
                             <input type="text" id="location" name="location" value="<?php echo $row["Location"]?>" class="form-control">
                            </div>
                            <div class="form-group">
                             <label for="duration" class=" form-control-label">Duration</label>
                             <input type="text" id="duration" name="duration" value="<?php echo $row["Duration"]?>" class="form-control">
                            </div>
                            <div class="form-group">
                             <label for="discription" class=" form-control-label">Description</label>
                             <textarea rows="4" cols="50" id="description" name="description" placeholder="Description" class="form-control"> <?php echo $row["Description"]?> </textarea>
                            </div>
                          </div>
                          <?php }?> 
                          <button type="submit" class="btn btn-primary btn-sm" name="Upd">
                            <i class="fa fa-dot-circle-o"></i> Update
                          </button>
                          <button type="upload" class="btn btn-primary btn-sm" name="Del">
                            <i class="fa fa-dot-circle-o"></i> Delete
                          </button>
                            </form>
                            
                        </div>
                    </div>
                </div>
        </div>
    <?php require_once('layouts/footer.php'); ?>