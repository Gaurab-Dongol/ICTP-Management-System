<?php 
	session_start();
	
	if(!isset($_SESSION['RoleId']))
	{
		header('location:login.php?lmsg=true');
		exit;
	}		

	require_once('inc/config.php');
	require_once('layouts/header.php'); 
    
    
    //ADD INTERNSHIP
    $UID = $_GET['UID'];
    if(isset($_POST["submit"]))
    {
        $sql1a = "select * from companyuser where UserID = '$UID'";
        $rs = mysqli_query($conn, $sql1a);
        $row = mysqli_fetch_row($rs);
        $companyUserid = $row['companyUserid'];
        $companyid = $rows['CompanyId'];;
        $JobRole = $_POST['JobRole'];
        $INTERNSHIPDESCRIPTION = $_POST['INTERNSHIPDESCRIPTION'];
        $update = "INSERT INTO internship (JobRole,Description,CompanyID,CompanyUserId) VALUES ('$JobRole','$INTERNSHIPDESCRIPTION','$companyid ','$companyUserid')";
        mysqli_query($conn, $update);
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
                                <center>Upload Internship</center>
                            </h3>
                            <form action="" method="post">
                                <div class="form-group">
                                
                                <label for="select" class=" form-control-label">COMPANY NAME</label>
                                    <select name="companyname"  class="form-control">
                                    <?php
                                    $query = "SELECT * from company";
                                    $results = mysqli_query($conn,$query);
                                    while ($rows = mysqli_fetch_assoc($results))
                                    { 
                                    ?>
                                    <option value="<?php echo $rows['CompanyId']?>"><?php echo $rows['CompanyName']?></option>
                                    <?php
                                    } 
                                    ?>
                                    </select>
                                </div>
                                <!--<div class="form-group">
                                    <label>INDUSTRY</label>
                                    <input class="au-input au-input--full" type="text" name="INDUSTRY" placeholder="INDUSTRY" required>
                                </div>
                                <div class="form-group">
                                    <label>WEBSITE ADDRESS </label>
                                    <input class="au-input au-input--full" type="url" id="HOMEPAGE" placeholder="HOMEPAGE" required>
                                </div>
                                <div class="form-group">
                                    <label>CONTACT NAME</label>
                                    <input class="au-input au-input--full" type="text" name="CONTACT NAME" placeholder="CONTACT NAME" required>
                                </div
                                <div class="form-group">
                                    <label>CONTACT NUMBER</label>
                                    <input class="au-input au-input--full" type="tel" name="CONTACT NUMBER" placeholder="+61XXXXXXXXX"required>
                                </div>-->
                                <div class="form-group">
                                    <label>JOB ROLE</label>
                                    <input class="au-input au-input--full" name="JobRole" placeholder="Job Role"required>
                                </div>
                                <div class="form-group">
                                    <label> INTERNSHIP DESCRIPTION</label>
                                    <input class="au-input au-input--full" type="text" name="INTERNSHIPDESCRIPTION" placeholder="INTERNSHIP DESCRIPTION" required>
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" action="#" type="submit" name="submit">Submit</button>
</div>
</form>


                </div>
            </div>
            </div>
            </div>
            <!-- END MAIN CONTENT-->
        </div>
    </div>
    

    <?php require_once('layouts/footer.php'); ?>