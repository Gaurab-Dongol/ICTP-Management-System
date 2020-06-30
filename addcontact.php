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
    $uname_err = "";
    
    if(isset($_POST['submit']))
    {
        $sql = "SELECT userid FROM login WHERE username = ?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            
            mysqli_stmt_bind_param($stmt, "s", $param_username);
    
            $param_username = trim($_POST["emailadd"]);
    
            if (mysqli_stmt_execute($stmt)) {
    
                mysqli_stmt_store_result($stmt);
    
                if (mysqli_stmt_num_rows($stmt) > 0) {
                    $uname_err = "This email -" . $param_username . "- is already registered.";
                } else {
                    $uname = trim($_POST["emailadd"]);
                }
            } else {
                echo "Something went wrong. Please check that you have entered the correct details.";
            }    

            mysqli_stmt_close($stmt);
        } 
        
        if (empty($uname_err)) {

        $sql = "INSERT INTO login (username, password, roleid) VALUES (?, ?,?)";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            
            mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_password, $param_role);

            $param_username = trim($_POST["emailadd"]);
            //$param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_password = trim($_POST["password"]);
            $param_role = 4;  #company user
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        
        $sql2 = "INSERT INTO companyuser (firstname, lastname, role, emailaddress, contactno, companyid, USERID) VALUES (?,?,?,?,?,?,?)";
        if ($stmt = mysqli_prepare($conn, $sql2)) {
            mysqli_stmt_bind_param($stmt, "sssssss", $param_fname, $param_lname, $param_role, $param_emailadd, $param_cno, $param_cid, $param_uid);
            
           
            $param_fname = trim($_POST["firstName"]);
            $param_lname =  trim($_POST["lastName"]);
            $param_role = trim($_POST["role"]);
            $param_emailadd = trim($_POST["emailadd"]);
            $param_cno = trim($_POST["contactNo"]);
            $param_cid = trim($_POST["companynm"]);
            $sql3 = "select userid from login where username = '" . $param_emailadd . "'";
            $rs = mysqli_query($conn, $sql3);
            $row = mysqli_fetch_row($rs);
            $param_uid = $row[0];

            if (mysqli_stmt_execute($stmt)) {                
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
                                <center>ADD COMPANY <b> CONTACT </b> </center>
                            </h3>
                            <form action="addcontact.php?UID=<?php echo $_GET['UID']?>" method="post">
 
                                    <div class="form-group">
                                    <label for="select" class=" form-control-label">COMPANY NAME </label>
                                    <select name="companynm" id="companynm" class="form-control" required>
                                    <option value="" disabled selected>Select Company</option>
                                    <?php
                                    $query = "SELECT * from company order by companyname";
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
                                    <input class="au-input au-input--full" type="text" name="role" placeholder="e.g Manager" required>
                                </div>
                                <div class="form-group">
                                    <label>EMAIL ADDRESS</label>
                                    <input class="au-input au-input--full" type="text" name="emailadd" placeholder="Email Address" required >
                                    <?php echo  "<p> <font color=red> $uname_err </font> </p>"; ?>
                                </div>
                                <div class="form-group">
                                    <label>CONTACT NUMBER</label>
                                    <input class="au-input au-input--full" type="text" name="contactNo" placeholder="Contact Number" required>
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