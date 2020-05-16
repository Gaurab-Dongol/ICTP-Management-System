<?php include('config.php'); ?>
<?php
// variable declaration
$username = "";
$email  = "";
$errors  = [];
// SIGN UP USER
if (isset($_POST['signup_btn'])) {
	// validate form values
	$errors = validateUser($_POST, ['signup_btn']);

	// receive all input values from the form. No need to escape... bind_param takes care of escaping
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = md5($_POST['password']); //encrypt the password before saving in the database
	$profile_picture = uploadProfilePicture();
	//$created_at = date('Y-m-d H:i:s');

	// if no errors, proceed with signup
	if (count($errors) === 0) {
		// insert user into database
		$query = "INSERT INTO users SET user_role_id=?, first_name=?, last_name=?, email=?, md5(password=?)";
		$stmt = $conn->prepare($query);
		$stmt->bind_param('sssss', $user_role_id, $first_name, $last_name, $email, $password);
		$result = $stmt->execute();
		if ($result) {
		  $user_id = $stmt->insert_id;
			$stmt->close();
			loginById($user_id); // log user in
		 } else {
			 $_SESSION['error_msg'] = "Database error: Could not register user";
		}
	 }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>UserAccounts - Sign up</title>
  <!-- Bootstrap CSS -->
  <!--<div class="container">
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <form class="form" action="signup.php" method="post" enctype="multipart/form-data">
          <h2 class="text-center">Sign up</h2>
          <div class="form-group">
            <label class="control-label">Sing Up As</label>
            <select class="selectpicker" multiple>
                <option value="1">Admin</option>
                <option value="2">Unit Cordinator</option>
                <option value="3">Student</option>
                <option value="4">Company</option>
            </select>
          </div>
          <hr>
          <div class="form-group">
            <label class="control-label">First Name</label>
            <input type="text" name="username" class="form-control">
          </div>
          <div class="form-group">
            <label class="control-label">Email Address</label>
            <input type="email" name="email" class="form-control">
          </div>
          <div class="form-group">
            <label class="control-label">Password</label>
            <input type="password" name="password" class="form-control">
          </div>
          <div class="form-group">
            <label class="control-label">Password confirmation</label>
            <input type="password" name="passwordConf" class="form-control">
          </div>
          <div class="form-group" style="text-align: center;">
            <img src="http://via.placeholder.com/150x150" id="profile_img" style="height: 100px; border-radius: 50%" alt="">
            <!-- hidden file input to trigger with JQuery  -->
            <!--<input type="file" name="profile_picture" id="profile_input" value="" style="display: none;">
          </div>
          <div class="form-group">
            <button type="submit" name="signup_btn" class="btn btn-success btn-block">Sign up</button>
          </div>
          <p>Aready have an account? <a href="login.php">Sign in</a></p>
        </form>
      </div>
    </div>
  </div>-->

  <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Account</h3></div>
                                    <div class="card-body">
                                        <form>
                                            <div class="form-group">
                                             <div class="col-md-12">
                                                    <div class="form-group"><label class="small mb-1">Sing Up As</label>
                                                      <select class="form-control py-4">
                                                        <option value="3">Student</option>
                                                        <option value="4">Company</option>
                                                      </select>
                                              </div>
                                            </div>
</div>
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <div class="form-group"><label class="small mb-1" for="inputFirstName">First Name</label>
                                                    <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Enter first name" /></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group"><label class="small mb-1" for="inputLastName">Last Name</label>
                                                    <input class="form-control py-4" id="inputLastName" type="text" placeholder="Enter last name" /></div>
                                                </div>
                                            </div>
                                            <div class="form-group"><label class="small mb-1" for="inputEmailAddress">Email</label>
                                            <input class="form-control py-4" id="inputEmailAddress" type="email" aria-describedby="emailHelp" placeholder="Enter email address" /></div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group"><label class="small mb-1" for="inputPassword">Password</label>
                                                    <input class="form-control py-4" id="inputPassword" type="password" placeholder="Enter password" /></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group"><label class="small mb-1" for="inputConfirmPassword">Confirm Password</label>
                                                    <input class="form-control py-4" id="inputConfirmPassword" type="password" placeholder="Confirm password" /></div>
                                                </div>
                                            </div>
                                            <div class="form-group mt-4 mb-0"><a class="btn btn-primary btn-block" href="login.html">Create Account</a></div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="register.html">Have an account? Go to login</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
  <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css" />
  <!-- Custom styles -->
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include(INCLUDE_PATH . "/layouts/footer.php") ?>