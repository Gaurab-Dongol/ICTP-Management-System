<?php 
	session_start();
	
	if(!isset($_SESSION['RoleId']))
	{
		header('location:login.php?lmsg=true');
		exit;
	}		

	require_once('inc/config.php');
    require_once('layouts/header.php'); 
    $pwd_format = "Should be at least 8 characters with at least a lowercase, an uppercase, a number and a special character ";
    $UID = $_GET['UID'];
	if(isset($_POST['submit']))
    {
        $sql = "INSERT INTO login (username, password, roleid) VALUES (?, ?,?)";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_password, $param_role);

            // Set parameters
            $param_username = trim($_POST["EMAIL"]);
            //$param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_password = trim($_POST["password"]);
            $param_role = 2;  #staff coordinator
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        $sql1 = "INSERT INTO staff (StaffID,FirstName,LastName,EmailAddress,ContactNo,Position,USERID) VALUES (?,?,?,?,?,?,?)";
        if ($stmt = mysqli_prepare($conn, $sql1)) {
            mysqli_stmt_bind_param ($stmt, "sssssss",$staffid, $firstName, $lastname, $email, $contactnumber,$position,$param_uid);
            $staffid = $_POST['STAFFID'];
            $firstName = $_POST['FIRSTNAME'];
            $lastname = $_POST['LASTNAME'];
            $email = $_POST['EMAIL'];
            $contactnumber = $_POST['CONTACTNUMBER'];
            $position = $_POST['POSITION'];
            $param_username = trim($_POST["EMAIL"]);
            $sql3 = "select userid from login where username = '" . $param_username . "'";
            $rs = mysqli_query($conn, $sql3);
            $row = mysqli_fetch_row($rs);
            $param_uid = $row[0];

            if (mysqli_stmt_execute($stmt)) {
                header("location: staff.php?UID=$UID");
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
                                <center>ADD STAFF</center>
                            </h3>
                            <form action="addstaff.php?UID=<?php echo $_GET['UID']?>" method="post">
                                <div class="form-group">
                                    <label>STAFF ID</label>
                                    <input class="au-input au-input--full" type="number" name="STAFFID" placeholder="STAFF ID" required>
                                </div>
                                <div class="form-group">
                                    <label>FIRST NAME</label>
                                    <input class="au-input au-input--full" type="text" name="FIRSTNAME" placeholder="FIRST NAME" required>
                                </div>
                                <div class="form-group">
                                    <label>LAST NAME</label>
                                    <input class="au-input au-input--full" type="text" name="LASTNAME" placeholder="LAST NAME" required>
                                </div
                                <div class="form-group">
                                    <label>STAFF EMAIL</label>
                                    <input class="au-input au-input--full" type="email" name="EMAIL" placeholder="EMAIL"required>
                                </div>
                                <div class="form-group">
                                    <label>STAFF CONTACT NUMBER</label>
                                    <input class="au-input au-input--full" type="tel" name="CONTACTNUMBER" placeholder="+61XXXXXXXXX"required>
                                </div>
                                <div class="form-group">
                                    <label>POSITION</label>
                                    <input class="au-input au-input--full" type="text" name="POSITION" placeholder="POSITION" required>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" pattern = "^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$" id="password" placeholder="Password" required>
                                    <?php echo  "<p> <font color=blue> <small> $pwd_format </small> </font> </p>"; ?>
                                </div>
                                <div class="form-group">
                                    <label>Re Enter Password</label>
                                    <input class="au-input au-input--full" type="password" name="repassword" pattern = "^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$" id="repassword" placeholder="Re Enter Password" required>
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
        <script type="text/javascript">
        var password = document.getElementById("password"),
            repassword = document.getElementById("repassword");

        function validatePassword() {
            if (password.value != repassword.value) {
                repassword.setCustomValidity("Passwords Don't Match");
            } else {
                repassword.setCustomValidity('');
            }
        }

        password.onchange = validatePassword;
        repassword.onkeyup = validatePassword;
        </script>
        <!-- Jquery JS-->
        <script src="vendor/jquery-3.2.1.min.js"></script>
            
    <?php require_once('layouts/footer.php'); ?>