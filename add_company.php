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
    $UID = $_GET['UID'];
	if(isset($_POST['submit']))
    {   

        $sql2a = "SELECT companyname FROM company WHERE companyname = ?";
        if ($stmt = mysqli_prepare($conn, $sql2a)) {
           
            mysqli_stmt_bind_param($stmt, "s", $param_cname );
    
            $param_cname = trim($_POST["CompanyName"]);
    
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
    
                if (mysqli_stmt_num_rows($stmt) > 0) {
                    $err_msg = "This company name -" . $param_cname . "- is already registered.";
                } else {
                    $param_cname = trim($_POST["CompanyName"]);
                }
            } else {
                echo "Something went wrong. Please check that you have entered the correct details.";
            }
    
            mysqli_stmt_close($stmt);
        }

        if (empty($err_msg)) {
        $sql = "INSERT INTO company (companyname, industry, website, officeno) VALUES (?,?,?,?)";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            
            mysqli_stmt_bind_param($stmt, "ssss", $param_companyname, $param_industry, $param_website, $param_officeno);

            $param_companyname = trim($_POST["CompanyName"]);
            $param_industry =  trim($_POST["Industry"]);
            $param_website = trim($_POST["Website"]);
            $param_officeno = trim($_POST["OfficeNo"]);
        
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to login page
                header("location: addinternship.php?UID=$UID");
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
                    <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-form">
                            <h3>
                                <center>ADD COMPANY</center>
                            </h3>
                            <form action="add_company.php?UID=<?php echo $_GET['UID']?>" method="post">
                                <div class="form-group">
                                    <label>COMPANY NAME</label>
                                    <input class="au-input au-input--full" type="text" name="CompanyName" id="CompanyName" placeholder="Company Name" required>
                                     <?php echo  "<p> <font color=red> $err_msg </font> </p>"; ?>
                                </div>
                                <div class="form-group">
                                    <label>INDUSTRY</label>
                                    <input class="au-input au-input--full" type="text" name="Industry" placeholder="Industry" required>
                                </div>
                                <div class="form-group">
                                    <label>WEBSITE</label>
                                    <input class="au-input au-input--full" type="text" name="Website" placeholder="Website" >
                                    
                                </div>
                                <div class="form-group">
                                    <label>OFFICE NUMBER</label>
                                    <input class="au-input au-input--full" type="text" name="OfficeNo" placeholder="Office Number" required>
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