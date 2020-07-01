<!-- jQuery library -->
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script>
function getCompany(val) {
	$.ajax({
	type: "POST",
	url: "fetch.php",
	data:'cid='+val,
	success: function(data){
		$("#contact-Nm").html(data);
	}
	});
}
</script>   

<?php 
	session_start();
	
	if(!isset($_SESSION['RoleId']))
	{
		header('location:login.php?lmsg=true');
		exit;
	}		

	require_once('inc/config.php');
    require_once('layouts/header.php'); 

    $UID = $_GET['UID'];
    $company = "";
    $query = "SELECT companyid, CompanyName  from company order by companyname";
    $results = mysqli_query($conn,$query);
    while ($rows = mysqli_fetch_array($results))
    {
     $company .= '<option value="'.$rows["companyid"].'">'.$rows["CompanyName"] .'</option>';
    }
     
    $err_msg = "";

    if(isset($_POST['submit']))
    {
        if (empty (trim($_POST["companynm"])) || empty (trim($_POST["contactNm"]))) {

            $err_msg = "Please set a valid company name and contact name.";
        }

        if(empty($err_msg)){
        $sql = "INSERT INTO internship (companyid, companyuserid, jobrole, description, closingdate, location) VALUES (?,?,?,?,?,?)";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            
            mysqli_stmt_bind_param($stmt, "ssssss", $param_companyid, $param_companyuid, $param_jobrole, $param_desc, $param_cdate, $param_loc);
            $param_companyid =   trim($_POST["companynm"]);
            $param_companyuid = trim($_POST["contactNm"]);
            $param_jobrole = trim($_POST["JobRl"]); 
            $param_desc = trim($_POST["InternDesc"]);
            
            $timestamp = strtotime($_POST["cdate"]);
            $param_cdate = date("Y-m-d", $timestamp);
            
            $param_loc = trim($_POST["location"]);    
        
            if (mysqli_stmt_execute($stmt)) {
                header("location: opportunities.php?UID=$UID");
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
                                <center>ADD INTERNSHIP</center>
                              
                            </h3>
                            <small> <?php echo  "<p> <font color=red> $err_msg </font> </p>"; ?> </small>
                            <form action="addinternship.php?UID=<?php echo $_GET['UID']?>" method="POST">                                
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Company Name</strong>
                                    </div>
                                    <div class="form-group">
                                    <label for="select" class=" form-control-label"></label>
                                    
                                    <select name="companynm" id="companynm" class="form-control action" onChange="getCompany(this.value);" require>
                                    <option value="" disabled selected>Select Company</option>
                                    <?php echo $company; ?>
                                    </select>
                  
                                    </div>
                                    <div class="form-actions form-group">
                                                <button type="submit" 
                                                class="btn au-btn-icon au-btn--green btn-sm">
                                                <a href="add_company.php?UID=<?php echo $_GET['UID']?>"> Add New Company</a></button>             
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header">
                                        <strong>Contact Name</strong>
                                        <!--<small> Form</small> -->
                                    </div>
                                    <div class="form-group">
                                
                                    <label for="select" class=" form-control-label"></label>
                                    <select name="contactNm" id="contact-Nm" class="form-control" require>
                                    <option value="" disabled selected>Select Contact</option>
                                    
                                    </select>
                                    </div>
                                    <div class="form-actions form-group">
                                                <button type="submit" 
                                                class="btn au-btn-icon au-btn--green btn-sm">
                                                <a href="addcontact.php?UID=<?php echo $_GET['UID']?>"> Add Contact Name</a></button>             
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label> <strong>Job Role</strong></label>
                                    <input class="au-input au-input--full" type="text" name="JobRl" placeholder="Internship Role" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="textarea-input" class="form-control-label"> <strong> Internship Description </strong><small><i>(in bullet form)</i></small> </label>
                                    </div>
                                    <div class="form-group">
                                    <textarea class="ckeditor" name="InternDesc"></textarea>
                                </div>
                                <div class="form-group">
                                    <label><strong>Location</strong></label>
                                    <input class="au-input au-input--full" type="text" name="location" required>
                                </div>
                                <div class="form-group">
                                    <label><strong>Close Date</strong></label>
                                    <input class="au-input au-input--full" type="date" name="cdate" required>
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