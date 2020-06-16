<?php 
	session_start();
	
	if(!isset($_SESSION['RoleId']))
	{
		header('location:login.php?lmsg=true');
		exit;
	}		

	require_once('inc/config.php');
	require_once('layouts/header.php'); 
	
	
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
                    //only visible to admin 
                    if($_SESSION['RoleId'] == 3){?>
                    <?php } ?>
                  

            
                        <div class="login-form">
                            <h3>
                                <center>Upload Internship</center>
                            </h3>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <div class="form-group">
                                    <label>COMPANY NAME</label>
                                    <input class="au-input au-input--full" type="text" name="COMPANY NAME" placeholder="NAME" required>
                                </div>
                                <div class="form-group">
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
                                </div>
                                <div class="form-group">
                                    <label>CONTACT EMAIL</label>
                                    <input class="au-input au-input--full" type="email" name="EMAIL" placeholder="EMAIL"required>
                                </div>
                                <div class="form-group">
                                    <label> INTERNSHIP DESCRIPTION</label>
                                    <input class="au-input au-input--full" type="text" name="INTERNSHIP DESCRIPTION" placeholder="INTERNSHIP DESCRIPTION" required>
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" action="#" type="submit" name="submit">Submit</button>
</div>
</form>


                </div>
            </div>
            <!-- END MAIN CONTENT-->
        </div>
    </div>
    

    <?php require_once('layouts/footer.php'); ?>