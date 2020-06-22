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
	if(isset($_POST['submit']))
    {
        $sql2 = "INSERT INTO companyuser (firstname, lastname, role, emailaddress, contactno) VALUES (?,?,?,?,?)";
        if ($stmt = mysqli_prepare($conn, $sql2)) {
            mysqli_stmt_bind_param($stmt, "sssss", $param_fname, $param_lname, $param_role, $param_emailadd, $param_cno);

            $param_fname = trim($_POST["firstName"]);
            $param_lname =  trim($_POST["lastName"]);
            $param_role = trim($_POST["role"]);
            $param_emailadd = trim($_POST["emailadd"]);
            $param_cno = trim($_POST["contactNo"]);
            $cid = "1002";
            //$param_uid = 1;


            if (mysqli_stmt_execute($stmt)) {
                // Redirect to login page
                header("location: addinternship.php?UID=$UID");
            }else {
                echo "Something went wrong. Please check that you have entered the correct details.";
            }
            mysqli_stmt_close($stmt);
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
                    <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-form">
                            <h3>
                                <center>ADD COMPANY <b> CONTACT </b> </center>
                            </h3>
                            <form action="add_company.php?UID=<?php echo $_GET['UID']?>" method="post">
                                <div class="form-group">
                                    <label>FIRST NAME</label>
                                    <input class="au-input au-input--full" type="text" name="firstName" placeholder="First Name" required>
                                </div>
                                <div class="form-group">
                                    <label>LAST NAME</label>
                                    <input class="au-input au-input--full" type="text" name="lastName" placeholder="Last Name" required>
                                </div>
                                <div class="form-group">
                                    <label>ROLE</label>
                                    <input class="au-input au-input--full" type="text" name="role" placeholder="e.g Manager" >
                                </div>
                                <div class="form-group">
                                    <label>EMAIL ADDRESS</label>
                                    <input class="au-input au-input--full" type="text" name="emailadd" placeholder="Email Address" >
                                    
                                </div>
                                <div class="form-group">
                                    <label>CONTACT NUMBER</label>
                                    <input class="au-input au-input--full" type="text" name="contactNo" placeholder="Contact Number" >
                                </div>
                                
                                <button class="au-btn au-btn--block au-btn--green m-b-20" action="#" type="submit" name="submit">Submit</button>
                                </form>
                        </div>
                    </div>
                    </div>
                    </div>
                        <!-- END MAIN CONTENT-->
                </div>
            </div>
            
    <?php require_once('layouts/footer.php'); ?>