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
    $uname_err = $sid_err = "";

    if (isset($_POST['submit'])) {
        $sql = "SELECT userid FROM login WHERE username = ?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            
            mysqli_stmt_bind_param($stmt, "s", $param_username);
    
            $param_username = trim($_POST["uname"]);
    
            if (mysqli_stmt_execute($stmt)) {
    
                mysqli_stmt_store_result($stmt);
    
                if (mysqli_stmt_num_rows($stmt) > 0) {
                    $uname_err = "This email -" . $param_username . "- is already registered.";
                } else {
                    $uname = trim($_POST["uname"]);
                }
            } else {
                echo "Something went wrong. Please check that you have entered the correct details.";
            }
    
    
            mysqli_stmt_close($stmt);
        } 
        
        $sql5 = "SELECT studentid FROM student WHERE studentid = ?";

        if ($stmt = mysqli_prepare($conn, $sql5)) {
       
        mysqli_stmt_bind_param($stmt, "s", $param_sid );

        $param_sid = trim($_POST["studentid"]);

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) > 0) {
                $sid_err = "This studentid -" . $param_sid . "- is already registered.";
            } else {
                $param_sid = trim($_POST["studentid"]);
            }
        } else {
            echo "Something went wrong. Please check that you have entered the correct details.";
        }

        mysqli_stmt_close($stmt);
        }



        if (empty($uname_err) && empty($sid_err)) {

        $sql = "INSERT INTO login (username, password) VALUES (?, ?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
           
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

            $param_username = trim($_POST["uname"]);
            //$param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_password = trim($_POST["password"]);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
		
		$sql2 = "INSERT INTO student (studentid, firstname, lastname, contactNo, specialisation, YearEnrolled, Nationality, EmailAddress, Userid ) VALUES (?,?,?,?,?,?,?,?,?)";

        if ($stmt2 = mysqli_prepare($conn, $sql2)) {
            mysqli_stmt_bind_param($stmt2, "sssssssss", $param_sid, $param_fname, $param_lname, $param_cno, $param_spec, $param_yren, $param_natio, $param_email, $param_uid);

            $param_sid = trim($_POST["studentid"]);
            $param_fname = trim($_POST["firstname"]);
            $param_lname = trim($_POST["lastname"]);
            $param_cno = trim($_POST["contactno"]);
            $param_spec = trim($_POST["specialisation"]);
            $param_yren = trim($_POST["yearenrolled"]);
            $param_natio = trim($_POST["nationality"]);
            $param_email = trim($_POST["uname"]);
            $param_username = trim($_POST["uname"]);
            $sql3 = "select userid from login where username = '" . $param_username . "'";
            $rs = mysqli_query($conn, $sql3);
            $row = mysqli_fetch_row($rs);
            $param_uid = $row[0];
            
            if (mysqli_stmt_execute($stmt2)) {
                header("location: dashboard.php?UID=$UID");
            }else {
                echo "Something went wrong. Please check that you have entered the correct details.";
            }
            mysqli_stmt_close($stmt2);
            }

}}
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
                                <center>ADD STUDENT</center>
                            </h3>
                            <form action="addstudent.php?UID=<?php echo $_GET['UID']?>" method="post">

                                <div class="form-group">
                                    <label>STUDENT ID</label>
                                    <input class="au-input au-input--full" type="number" name="studentid" placeholder="STUDENT ID" required>
                                    <?php echo  "<p> <font color=red> $sid_err </font> </p>"; ?>
                                </div>
                                <div class="form-group">
                                    <label>FIRST NAME</label>
                                    <input class="au-input au-input--full" type="text" name="firstname" placeholder="FIRST NAME" required>
                                </div>
                                <div class="form-group">
                                    <label>LAST NAME</label>
                                    <input class="au-input au-input--full" type="text" name="lastname" placeholder="LAST NAME" required>
                                </div
                                <div class="form-group">
                                    <label>UNIVERSITY EMAIL</label>
                                    <input class="au-input au-input--full" type="email" name="uname" placeholder="UNIVERSITY EMAIL"required>
                                    <?php echo  "<p> <font color=red> $uname_err </font> </p>"; ?>
                                </div>
                                <div class="form-group">
                                    <label>CONTACT NUMBER</label>
                                    <input class="au-input au-input--full" type="tel" name="contactno" placeholder="+61XXXXXXXXX"required>
                                </div>

                                <div class="form-group">
                                    <label for="select" class=" form-control-label">Specialisation</label>
                                    <select name="specialisation" id="specialisation" class="form-control" required>
                                        <option value="" disabled selected>Please select</option>
                                        <?php
                                    $query = "SELECT * from specialisation order by Description";
                                    $results = mysqli_query($conn,$query);
                                    while ($rows = mysqli_fetch_assoc($results))
                                    { 
                                    ?>
                                    <option value="<?php echo $rows['Description']?>"><?php echo $rows['Description']?></option>
                                    <?php
                                    } 
                                    ?>
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label for="select" class=" form-control-label">Year Enrolled</label>
                                    <select name="yearenrolled" id="yearenrolled" class="form-control" required>
                                        <option value="" disabled selected>Please select</option>
                                        <?php
                                    $query = "SELECT * from enrollmentyear order by year";
                                    $results = mysqli_query($conn,$query);
                                    while ($rows = mysqli_fetch_assoc($results))
                                    { 
                                    ?>
                                    <option value="<?php echo $rows['Year']?>"><?php echo $rows['Year']?></option>
                                    <?php
                                    } 
                                    ?>
                                    </select>
                                </div>                                

                                <div class="form-group">
                                    <label for="select" class=" form-control-label">Nationality</label>
                                    <select name="nationality" id="nationality" class="form-control">
                                        <option value="" disabled selected>Please select</option>
                                        <option value="Afganistan">Afghanistan</option>
                                        <option value="Albania">Albania</option>
                                        <option value="Algeria">Algeria</option>
                                        <option value="American Samoa">American Samoa</option>
                                        <option value="Andorra">Andorra</option>
                                        <option value="Angola">Angola</option>
                                        <option value="Anguilla">Anguilla</option>
                                        <option value="Antigua & Barbuda">Antigua & Barbuda</option>
                                        <option value="Argentina">Argentina</option>
                                        <option value="Armenia">Armenia</option>
                                        <option value="Aruba">Aruba</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Austria">Austria</option>
                                        <option value="Azerbaijan">Azerbaijan</option>
                                        <option value="Bahamas">Bahamas</option>
                                        <option value="Bahrain">Bahrain</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Barbados">Barbados</option>
                                        <option value="Belarus">Belarus</option>
                                        <option value="Belgium">Belgium</option>
                                        <option value="Belize">Belize</option>
                                        <option value="Benin">Benin</option>
                                        <option value="Bermuda">Bermuda</option>
                                        <option value="Bhutan">Bhutan</option>
                                        <option value="Bolivia">Bolivia</option>
                                        <option value="Bonaire">Bonaire</option>
                                        <option value="Bosnia & Herzegovina">Bosnia & Herzegovina</option>
                                        <option value="Botswana">Botswana</option>
                                        <option value="Brazil">Brazil</option>
                                        <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
                                        <option value="Brunei">Brunei</option>
                                        <option value="Bulgaria">Bulgaria</option>
                                        <option value="Burkina Faso">Burkina Faso</option>
                                        <option value="Burundi">Burundi</option>
                                        <option value="Cambodia">Cambodia</option>
                                        <option value="Cameroon">Cameroon</option>
                                        <option value="Canada">Canada</option>
                                        <option value="Canary Islands">Canary Islands</option>
                                        <option value="Cape Verde">Cape Verde</option>
                                        <option value="Cayman Islands">Cayman Islands</option>
                                        <option value="Central African Republic">Central African Republic</option>
                                        <option value="Chad">Chad</option>
                                        <option value="Channel Islands">Channel Islands</option>
                                        <option value="Chile">Chile</option>
                                        <option value="China">China</option>
                                        <option value="Christmas Island">Christmas Island</option>
                                        <option value="Cocos Island">Cocos Island</option>
                                        <option value="Colombia">Colombia</option>
                                        <option value="Comoros">Comoros</option>
                                        <option value="Congo">Congo</option>
                                        <option value="Cook Islands">Cook Islands</option>
                                        <option value="Costa Rica">Costa Rica</option>
                                        <option value="Cote DIvoire">Cote DIvoire</option>
                                        <option value="Croatia">Croatia</option>
                                        <option value="Cuba">Cuba</option>
                                        <option value="Curaco">Curacao</option>
                                        <option value="Cyprus">Cyprus</option>
                                        <option value="Czech Republic">Czech Republic</option>
                                        <option value="Denmark">Denmark</option>
                                        <option value="Djibouti">Djibouti</option>
                                        <option value="Dominica">Dominica</option>
                                        <option value="Dominican Republic">Dominican Republic</option>
                                        <option value="East Timor">East Timor</option>
                                        <option value="Ecuador">Ecuador</option>
                                        <option value="Egypt">Egypt</option>
                                        <option value="El Salvador">El Salvador</option>
                                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                                        <option value="Eritrea">Eritrea</option>
                                        <option value="Estonia">Estonia</option>
                                        <option value="Ethiopia">Ethiopia</option>
                                        <option value="Falkland Islands">Falkland Islands</option>
                                        <option value="Faroe Islands">Faroe Islands</option>
                                        <option value="Fiji">Fiji</option>
                                        <option value="Finland">Finland</option>
                                        <option value="France">France</option>
                                        <option value="French Guiana">French Guiana</option>
                                        <option value="French Polynesia">French Polynesia</option>
                                        <option value="French Southern Ter">French Southern Ter</option>
                                        <option value="Gabon">Gabon</option>
                                        <option value="Gambia">Gambia</option>
                                        <option value="Georgia">Georgia</option>
                                        <option value="Germany">Germany</option>
                                        <option value="Ghana">Ghana</option>
                                        <option value="Gibraltar">Gibraltar</option>
                                        <option value="Great Britain">Great Britain</option>
                                        <option value="Greece">Greece</option>
                                        <option value="Greenland">Greenland</option>
                                        <option value="Grenada">Grenada</option>
                                        <option value="Guadeloupe">Guadeloupe</option>
                                        <option value="Guam">Guam</option>
                                        <option value="Guatemala">Guatemala</option>
                                        <option value="Guinea">Guinea</option>
                                        <option value="Guyana">Guyana</option>
                                        <option value="Haiti">Haiti</option>
                                        <option value="Hawaii">Hawaii</option>
                                        <option value="Honduras">Honduras</option>
                                        <option value="Hong Kong">Hong Kong</option>
                                        <option value="Hungary">Hungary</option>
                                        <option value="Iceland">Iceland</option>
                                        <option value="Indonesia">Indonesia</option>
                                        <option value="India">India</option>
                                        <option value="Iran">Iran</option>
                                        <option value="Iraq">Iraq</option>
                                        <option value="Ireland">Ireland</option>
                                        <option value="Isle of Man">Isle of Man</option>
                                        <option value="Israel">Israel</option>
                                        <option value="Italy">Italy</option>
                                        <option value="Jamaica">Jamaica</option>
                                        <option value="Japan">Japan</option>
                                        <option value="Jordan">Jordan</option>
                                        <option value="Kazakhstan">Kazakhstan</option>
                                        <option value="Kenya">Kenya</option>
                                        <option value="Kiribati">Kiribati</option>
                                        <option value="Korea North">Korea North</option>
                                        <option value="Korea Sout">Korea South</option>
                                        <option value="Kuwait">Kuwait</option>
                                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                                        <option value="Laos">Laos</option>
                                        <option value="Latvia">Latvia</option>
                                        <option value="Lebanon">Lebanon</option>
                                        <option value="Lesotho">Lesotho</option>
                                        <option value="Liberia">Liberia</option>
                                        <option value="Libya">Libya</option>
                                        <option value="Liechtenstein">Liechtenstein</option>
                                        <option value="Lithuania">Lithuania</option>
                                        <option value="Luxembourg">Luxembourg</option>
                                        <option value="Macau">Macau</option>
                                        <option value="Macedonia">Macedonia</option>
                                        <option value="Madagascar">Madagascar</option>
                                        <option value="Malaysia">Malaysia</option>
                                        <option value="Malawi">Malawi</option>
                                        <option value="Maldives">Maldives</option>
                                        <option value="Mali">Mali</option>
                                        <option value="Malta">Malta</option>
                                        <option value="Marshall Islands">Marshall Islands</option>
                                        <option value="Martinique">Martinique</option>
                                        <option value="Mauritania">Mauritania</option>
                                        <option value="Mauritius">Mauritius</option>
                                        <option value="Mayotte">Mayotte</option>
                                        <option value="Mexico">Mexico</option>
                                        <option value="Midway Islands">Midway Islands</option>
                                        <option value="Moldova">Moldova</option>
                                        <option value="Monaco">Monaco</option>
                                        <option value="Mongolia">Mongolia</option>
                                        <option value="Montserrat">Montserrat</option>
                                        <option value="Morocco">Morocco</option>
                                        <option value="Mozambique">Mozambique</option>
                                        <option value="Myanmar">Myanmar</option>
                                        <option value="Nambia">Nambia</option>
                                        <option value="Nauru">Nauru</option>
                                        <option value="Nepal">Nepal</option>
                                        <option value="Netherland Antilles">Netherland Antilles</option>
                                        <option value="Netherlands">Netherlands (Holland, Europe)</option>
                                        <option value="Nevis">Nevis</option>
                                        <option value="New Caledonia">New Caledonia</option>
                                        <option value="New Zealand">New Zealand</option>
                                        <option value="Nicaragua">Nicaragua</option>
                                        <option value="Niger">Niger</option>
                                        <option value="Nigeria">Nigeria</option>
                                        <option value="Niue">Niue</option>
                                        <option value="Norfolk Island">Norfolk Island</option>
                                        <option value="Norway">Norway</option>
                                        <option value="Oman">Oman</option>
                                        <option value="Pakistan">Pakistan</option>
                                        <option value="Palau Island">Palau Island</option>
                                        <option value="Palestine">Palestine</option>
                                        <option value="Panama">Panama</option>
                                        <option value="Papua New Guinea">Papua New Guinea</option>
                                        <option value="Paraguay">Paraguay</option>
                                        <option value="Peru">Peru</option>
                                        <option value="Phillipines">Philippines</option>
                                        <option value="Pitcairn Island">Pitcairn Island</option>
                                        <option value="Poland">Poland</option>
                                        <option value="Portugal">Portugal</option>
                                        <option value="Puerto Rico">Puerto Rico</option>
                                        <option value="Qatar">Qatar</option>
                                        <option value="Republic of Montenegro">Republic of Montenegro</option>
                                        <option value="Republic of Serbia">Republic of Serbia</option>
                                        <option value="Reunion">Reunion</option>
                                        <option value="Romania">Romania</option>
                                        <option value="Russia">Russia</option>
                                        <option value="Rwanda">Rwanda</option>
                                        <option value="St Barthelemy">St Barthelemy</option>
                                        <option value="St Eustatius">St Eustatius</option>
                                        <option value="St Helena">St Helena</option>
                                        <option value="St Kitts-Nevis">St Kitts-Nevis</option>
                                        <option value="St Lucia">St Lucia</option>
                                        <option value="St Maarten">St Maarten</option>
                                        <option value="St Pierre & Miquelon">St Pierre & Miquelon</option>
                                        <option value="St Vincent & Grenadines">St Vincent & Grenadines</option>
                                        <option value="Saipan">Saipan</option>
                                        <option value="Samoa">Samoa</option>
                                        <option value="Samoa American">Samoa American</option>
                                        <option value="San Marino">San Marino</option>
                                        <option value="Sao Tome & Principe">Sao Tome & Principe</option>
                                        <option value="Saudi Arabia">Saudi Arabia</option>
                                        <option value="Senegal">Senegal</option>
                                        <option value="Seychelles">Seychelles</option>
                                        <option value="Sierra Leone">Sierra Leone</option>
                                        <option value="Singapore">Singapore</option>
                                        <option value="Slovakia">Slovakia</option>
                                        <option value="Slovenia">Slovenia</option>
                                        <option value="Solomon Islands">Solomon Islands</option>
                                        <option value="Somalia">Somalia</option>
                                        <option value="South Africa">South Africa</option>
                                        <option value="Spain">Spain</option>
                                        <option value="Sri Lanka">Sri Lanka</option>
                                        <option value="Sudan">Sudan</option>
                                        <option value="Suriname">Suriname</option>
                                        <option value="Swaziland">Swaziland</option>
                                        <option value="Sweden">Sweden</option>
                                        <option value="Switzerland">Switzerland</option>
                                        <option value="Syria">Syria</option>
                                        <option value="Tahiti">Tahiti</option>
                                        <option value="Taiwan">Taiwan</option>
                                        <option value="Tajikistan">Tajikistan</option>
                                        <option value="Tanzania">Tanzania</option>
                                        <option value="Thailand">Thailand</option>
                                        <option value="Togo">Togo</option>
                                        <option value="Tokelau">Tokelau</option>
                                        <option value="Tonga">Tonga</option>
                                        <option value="Trinidad & Tobago">Trinidad & Tobago</option>
                                        <option value="Tunisia">Tunisia</option>
                                        <option value="Turkey">Turkey</option>
                                        <option value="Turkmenistan">Turkmenistan</option>
                                        <option value="Turks & Caicos Is">Turks & Caicos Is</option>
                                        <option value="Tuvalu">Tuvalu</option>
                                        <option value="Uganda">Uganda</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                        <option value="Ukraine">Ukraine</option>
                                        <option value="United Arab Erimates">United Arab Emirates</option>
                                        <option value="United States of America">United States of America</option>
                                        <option value="Uraguay">Uruguay</option>
                                        <option value="Uzbekistan">Uzbekistan</option>
                                        <option value="Vanuatu">Vanuatu</option>
                                        <option value="Vatican City State">Vatican City State</option>
                                        <option value="Venezuela">Venezuela</option>
                                        <option value="Vietnam">Vietnam</option>
                                        <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
                                        <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
                                        <option value="Wake Island">Wake Island</option>
                                        <option value="Wallis & Futana Is">Wallis & Futana Is</option>
                                        <option value="Yemen">Yemen</option>
                                        <option value="Zaire">Zaire</option>
                                        <option value="Zambia">Zambia</option>
                                        <option value="Zimbabwe">Zimbabwe</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" pattern = "^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$" id="password" placeholder="Password" required>
                                    <?php echo  "<p> <font color=blue> <small> $pwd_format </small></font> </p>"; ?>
                                </div>
                                <div class="form-group">
                                    <label>Re Enter Password</label>
                                    <input class="au-input au-input--full" type="password" name="repassword" pattern = "^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$" id="repassword" placeholder="Re Enter Password" required>
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