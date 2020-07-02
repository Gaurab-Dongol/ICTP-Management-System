<?php
// Include DB config file
require_once('inc/config.php');

$cname = $uname = $pwd = $confirm_pwd = $fname_err = $email_err = $uname_err = $sid_err = $pwd_err = $confirm_pwd_err = $err_msg = "";
$pwd_format = "Should be at least 8 characters with at least a lowercase, an uppercase, a number and a special character ";

//if ($_SERVER['REQUEST_METHOD'] == 'POST') {
if(isset($_POST['submitmain']))  { 
    if (empty (trim($_POST["companynm"]))) {
        $err_msg = "Please set a valid company name";
    }

    $sql = "SELECT userid FROM login WHERE username = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        
        mysqli_stmt_bind_param($stmt, "s", $param_username);

        $param_username = trim($_POST["username"]);

        if (mysqli_stmt_execute($stmt)) {

            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) > 0) {
                $uname_err = "This email -" . $param_username . " is already registered.";
            } else {
                $uname = trim($_POST["username"]);
            }
        } else {
            echo "Something went wrong. Please check that you have entered the correct details.";
        }


        mysqli_stmt_close($stmt);
    }
    
    if (empty($uname_err) && empty($pwd_err) && empty($confirm_pwd_err) && empty($sid_err) && empty($err_msg)  ) {

        $sql = "INSERT INTO login (username, password) VALUES (?, ?)";
        $sql2 = "INSERT INTO companyuser (firstname, lastname, contactNo, EmailAddress, role, Userid, companyid ) VALUES (?,?,?,?,?,?,?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_pwd);

            $param_username = trim($_POST["username"]);
            //$param_pwd = password_hash($pwd, PASSWORD_DEFAULT); // Creates a password hash
            $param_pwd = trim($_POST["password"]);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        if ($stmt2 = mysqli_prepare($conn, $sql2)) {
            mysqli_stmt_bind_param($stmt2, "sssssss", $param_fname, $param_lname, $param_cno, $param_email, $param_role, $param_uid, $param_cid);

            $param_fname = trim($_POST["firstname"]);
            $param_lname = trim($_POST["lastname"]);
            $param_cno = trim($_POST["contactno"]);
            $param_email = trim($_POST["username"]);
            $param_username = trim($_POST["username"]);
            $param_role = trim($_POST["role"]);
            $sql3 = "select userid from login where username = '" . $param_username . "'";
            $rs = mysqli_query($conn, $sql3);
            $row = mysqli_fetch_row($rs);
            $param_uid = $row[0];
            $param_cid = trim($_POST["companynm"]); 

            if (mysqli_stmt_execute($stmt2)) {
                header("location: login.php");
            } else {
                echo "Please check that you have entered the correct details.";
            }
            mysqli_stmt_close($stmt2);
        }
    }

    mysqli_close($conn);
}


if(isset($_POST['submit'])){
    // Check input error
    $sql = "SELECT companyname FROM company where companyname = ? ";

    if ($stmt = mysqli_prepare($conn, $sql)) {  
        mysqli_stmt_bind_param($stmt, "s", $param_cname );

        $param_cname  = trim($_POST["CompanyName"]); 

        if (mysqli_stmt_execute($stmt)) {

            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt) > 0) {
                $err_msg = "This compnay name - " . $param_cname . " already exists.";
            } else {
                $err_msg = "";
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
                header("location: register_business.php");
            }else {
                echo "Something went wrong. Please check that you have entered the correct details.";
            }
            mysqli_stmt_close($stmt);
            }
        }
        }    

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Register</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div>
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="images/456.png" alt="WSU">
                            </a>
                        </div>
                        <div class="login-form">
                        <h2>
                                <center>ICT Practicum</center>
                            </h2>
                            <h4>
                                <center>Company Registration</center>
                            </h4>
                            <br>
                            <br>
                            <form action="" method="POST">
                                
                            <div class="card">
                            <?php
                              $query2 = "SELECT companyid,companyname FROM company";
                              $results = mysqli_query($conn,$query2);
                              while ($rows = mysqli_fetch_array($results))
                              {
                               $cname .= '<option value="'.$rows["companyid"].'">'.$rows["companyname"] .'</option>';
                              } 
                             ?>        
                                    <p> </p>
                                    <div class="card-header">
                                        <strong>Company Name</strong>
                                    </div>
                                    <div class="form-group">
                                    <label for="select" class=" form-control-label"></label>
                                    
                                    <select name="companynm" id="companynm" class="form-control action" required>
                                    <option value="" disabled selected>Select Company</option>
                                    <?php echo $cname; ?>
                                    </select>
                  
                                    </div>
                                    <?php echo  "<p> <font color=red> $err_msg </font> </p>"; ?>
                                    <div class="form-actions form-group">
                                                <button type="submit" 
                                                class="btn au-btn-icon au-btn--green btn-sm" data-toggle="modal" data-target="#myModalCompany">
                                                Add New Company></button>             
                                    </div>

                            </div>
                                
                                
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input class="au-input au-input--full" type="text" name="firstname" placeholder="John" required>
                                </div>
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input class="au-input au-input--full" type="text" name="lastname" placeholder="Doe" required>
                                </div>
                                <div class="form-group">
                                    <label>Role</label>
                                    <input class="au-input au-input--full" type="text" name="role" placeholder="e.g. Test Lead" required>
                                </div>
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="au-input au-input--full" type="email" name="username" placeholder="12345678@student.westernsydney.edu.au" required>
                                    <?php echo  "<p> <font color=red> $uname_err </font> </p>"; ?>
                                </div>
                                <div class="form-group">
                                    <label>Contact Number</label>
                                    <input class="au-input au-input--full" type="tel" name="contactno" placeholder="+61436XXXXXX" required>
                                </div>
                                
                                
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" pattern = "^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$" id="password" placeholder="Password" required>
                                    <?php echo  "<p> <font color=blue> $pwd_format </font> </p>"; ?>
                                </div>
                                <div class="form-group">
                                    <label>Re Enter Password</label>
                                    <input class="au-input au-input--full" type="password" name="repassword" pattern = "^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$" id="repassword" placeholder="Re Enter Password" required>
                                </div>
                                <div class="login-checkbox">
                                    <label>
                                        <input type="checkbox" name="remember">Remember Me
                                    </label>

                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" action="#" type="submit" name="submitmain">Register</button>

                            </form>
                            <div class="register-link">
                                <p>
                                    Do you have account?
                                    <a href="login.php">Sign In Here</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    
    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>
    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>

<div id="myModalCompany" class="modal fade" role="dialog">
              <div class="modal-dialog modal-lg">
              <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <div class="card">
                        <div class="card-header">
                        
                            <strong>Add New Company</strong>
                          </div>
                          <form action="" method="POST">
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

                  <div class="modal-footer">
                    </div>
                  </div>
                  <button class="au-btn au-btn--block au-btn--green m-b-20" action="#" type="submit" name="submit">Submit</button>
                  </form>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Modal Code Finish-->