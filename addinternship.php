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
    if(isset($_POST["submit"]))
    {
        $UID = $_GET['UID'];
        $firstname = $_POST['firstname'];
        $lastName = $_POST['lastName'];
        $Email = $_POST['Email'];
        $ContactNo = $_POST['ContactNo'];
        $Specialisation = $_POST['Specialisation'];
        $Nationality = $_POST['Nationality'];
        $update = "UPDATE student SET FirstName='$firstname',LastName='$lastName',EmailAddress='$Email',ContactNo='$ContactNo',Specialisation='$Specialisation',Nationality='$Nationality' where USERID='".$UID."'";
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
                                </div>
                                <div class="form-group">
                                    <label>CONTACT EMAIL</label>
                                    <input class="au-input au-input--full" type="email" name="EMAIL" placeholder="EMAIL"required>
                                </div>-->
                                <div class="form-group">
                                    <label> INTERNSHIP DESCRIPTION</label>
                                    <input class="au-input au-input--full" type="text" name="INTERNSHIP DESCRIPTION" placeholder="INTERNSHIP DESCRIPTION" required>
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