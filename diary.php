<?php 
session_start();
	
if(!isset($_SESSION['RoleId']))
{
    header('location:login.php?lmsg=true');
    exit;
}		

require_once('inc/config.php');
require_once('layouts/header.php'); 


// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$fname_err = $email_err = $username_err = $password_err = $confirm_password_err = "";
 
$UID = $_GET['UID'];
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO diary (InternshipId, StudentID, TotalHours, TaskDesc ) VALUES (?,?,?,?)";

        if($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_InternshipId, $param_sid, $param_totalHour, $param_taskDesc);
            
            // Set parameters
            //$param_InternshipId = trim($_POST[""])
            //$param_InternshipId = '888';
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
            // Attempt to execute the prepared statement

            if(mysqli_stmt_execute($stmt)){
                // Redirect to add page
                header("location: add_diary.php?UID=$UID");
            } else{
                echo "not working";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($conn);
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
                        <h3><center>Diary</center></h3>
                            <form action="" method="POST">
                               

                                    <div class="form-group">
                                    <div class="form-group">
                                    <label>Task Description</label>
                                    <input class="au-input au-input--full" type="text" name="TaskDesc" required>
                                </div>
                                    <label>Enter Numbers of Hour</label>
                                    <input class="au-input au-input--full" type="number" name="NoHours" required>
                                   
                                    </div>
                                    <!--<div class="form-group">
                                    <label>Enter start Date:</label>
                                    <input class="au-input au-input--full" type="date" name="start" required>
                                
                                </div>
                                <div class="form-group">
                                
                                    <label>Enter end Date:</label>
                                    <input class="au-input au-input--full" type="date" name="end" required>
                                
                                </div>
                                <div class="form-group">
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