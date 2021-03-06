<?php 
session_start();
	
if(!isset($_SESSION['RoleId']))
{
    header('location:login.php?lmsg=true');
    exit;
}		

require_once('inc/config.php');
require_once('layouts/header.php'); 
 
$err_msg = "";
$m ="";
$UID = $_GET['UID'];

//if($_SERVER["REQUEST_METHOD"] == "POST"){
if(isset($_POST['submit'])){
  // Check input error     
     $sql2a = "SELECT status FROM student_intern WHERE status not in ('cancelled', 'rejected', 'pending','marked') and studentid = (select studentid from student where USERID= ? )";
     if ($stmt = mysqli_prepare($conn, $sql2a)) {
        
         mysqli_stmt_bind_param($stmt, "s", $UID );
 
         if (mysqli_stmt_execute($stmt)) {
             mysqli_stmt_store_result($stmt);
 
             if (mysqli_stmt_num_rows($stmt) != 1) {
                 $err_msg = "There is no approved or on-going internship. Please have your internship approved first";
             } else {
                 $m ="";

             }
         } else {
             echo "Something went wrong. Please check that you have entered the correct details.";
         }
 
         mysqli_stmt_close($stmt);
     }



    if(empty($err_msg)){
    

        $sql = "INSERT INTO diary (InternshipId, StudentID, TotalHours, TaskDesc, Task_StartDate, Task_EndDate, WeekNo ) VALUES (?,?,?,?,?,?,?)";

        if($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssssss", $param_InternshipId, $param_sid, $param_totalHour, $param_taskDesc, $param_start, $param_end, $param_weekno);
            
            $sql4 = "select studentid from student where USERID='".$UID."'";
            $rs = mysqli_query($conn, $sql4);
            $row = mysqli_fetch_row($rs);
            $SID = $row[0];
            
            $sql1a = "select internshipid from student_intern where studentid = '".$SID."'";
            $rs = mysqli_query($conn, $sql1a);
            $row = mysqli_fetch_row($rs);
            $param_InternshipId = $row[0];
        
            $sql2a = "select studentid from student_intern where studentid = '".$SID."'";
            $rs = mysqli_query($conn, $sql2a);
            $row = mysqli_fetch_row($rs);
            $param_sid = $row[0];

            $param_totalHour = trim($_POST["NoHours"]);
            $param_taskDesc = trim($_POST["TaskDesc"]);
            //$param_start = '2020-02-28';
            $timestamp = strtotime($_POST["start"]);
            $param_start = date("Y-m-d", $timestamp);
            
            $timestamp = strtotime($_POST["end"]);
            $param_end = date("Y-m-d", $timestamp);
            $param_weekno = trim($_POST["weekno"]);

            if(mysqli_stmt_execute($stmt)){
                // Redirect to add page
                header("location: add_diary.php?UID=$UID");
            } else{
                echo "not working";
            }

            mysqli_stmt_close($stmt);
        }
    }
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
                        <h3><center>Weekly Diary</center></h3>
                        <?php echo  "<p> <font color=red> $err_msg </font> </p>"; ?>
                            <form action="" method="POST">
                                    <div class="form-group">
                                    <label>Week No:</label>
                                    <input class="au-input au-input--full" type="number" name="weekno" required>
                                    </div>
                                    <div class="form-group">
                                    <label>Enter Start Date:</label>
                                    <input class="au-input au-input--full" type="date" name="start" required>
                                    </div>
                                    <div class="form-group">
                                    <label>Enter End Date:</label>
                                    <input class="au-input au-input--full" type="date" name="end" required>
                                     </div>
                                    <div class="form-group">
                                    <label for="textarea-input" class="form-control-label">Completed Task <small><i>(in bullet form)</i></small> </label>
                                    </div>
                                    <div class="form-group">
                                    <textarea class="ckeditor" name="TaskDesc" required></textarea>
                                    </div>
                                    <div class="form-group">
                                    <label>Enter Numbers of Hour</label>
                                    <input class="au-input au-input--full" type="number" name="NoHours" required>
                                    </div>
                                <!-- <div class="form-group">
                                    <label>Manager Remarks</label>
                                    <input class="au-input au-input--full" type="text" name="manager remarks" required>
                                </div>
                                <div class="form-group">
                                    <label>Unit coordinator Remarks</label>
                                    <input class="au-input au-input--full" type="text" name="unit co remarks" required>
                                </div>-->
                                <button class="au-btn au-btn--block au-btn--green m-b-20" action="#" type="submit" name="submit">Submit</button>
                                
                            </form>
                            
                        </div>
                    </div>
                </div>
        </div>
    <?php require_once('layouts/footer.php'); ?>