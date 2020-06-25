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

<!-- HEADER DESKTOP-->
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
    <div class="col-lg-12">
        <h2 class="title-1 m-b-25">
            <center>Add  Feedback</center>
        </h2>


        <div class="login-wrap">
        <div class="login-content">
            <div class="login-form">
                <div class="diary-form">
                <form action="" method="post">
                   <!-- <div class="form-group">
                        <label for="textarea-input" class="form-control-label">Feedback  </label>
                     </div>-->
                     <div>
                        <textarea name="feedback" id="textarea-input" rows="8" placeholder=" add feedback " class="form-control"></textarea>
                        </div>
                    
                    <button class="au-btn au-btn--block au-btn--green m-b-20" action="#" type="submit" name="submit">Submit</button>
</div>
</form>
</div>
</div>
</div>
</div>
<?php require_once('layouts/footer.php'); ?>
