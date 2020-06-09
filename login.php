<?php 
session_start();

require_once('inc/config.php');
require_once('layouts/header.php'); 

if(isset($_POST['login']))
{
	if(!empty($_POST['username']) && !empty($_POST['password']))
	{
		$username 	= trim($_POST['username']);
		$password 	= trim($_POST['password']);
		
		//$md5Password = md5($password);
		
		$sql = "select * from login where username = '".$username."' and password = '".$password."'";
		$rs = mysqli_query($conn,$sql);
        $getNumRows = mysqli_num_rows($rs);
       
		if($getNumRows == 1)
		{
			$getUserRow = mysqli_fetch_assoc($rs);
			unset($getUserRow['password']);
			
			$_SESSION = $getUserRow;
						
			header("location:dashboard.php");
			exit;
		}
		else
		{
			$errorMsg = "Wrong email or password";
		}
	}
}

if(isset($_GET['lmsg']) && $_GET['lmsg'] == true)
{
	$errorMsg = "Login required to access dashboard";
}
?>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="images/456.png" alt="WSU">
                            </a>
                        </div>
                        <div class="login-form">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="au-input au-input--full" type="email" name="username" placeholder="18763523@student.westernsydney.edu.au" required>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password" required>
                                </div>
                                <div class="login-checkbox">
                                    <label>
                                        <input type="checkbox" name="remember">Remember Me
                                    </label>
                                    <label>
                                        <a href="#">Forgotten Password?</a>
                                    </label>
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" name="login">sign in</button>
                                
                            </form>
                            <div class="register-link">
                                <p>
                                    Don't you have account?
                                    <a href="register.php">Sign Up Here</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php require_once('layouts/footer.php'); ?>