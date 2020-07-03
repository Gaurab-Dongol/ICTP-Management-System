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
        $fetch = "SELECT * from company";
        $company = mysqli_query($conn, $fetch);
        $rcompany = mysqli_fetch_array($company);
        $err_msg="";

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
                        header("location: companylist.php?UID=$UID");
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

             <div class="row">
                        <div class="col-lg-12">
                        <div class="table-button" align="right">
                                            <button class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal" data-target="#addModalCompany">
                                                <i class="fas fa-edit"></i>Add</button>
                                        </div>
                            <h2 class="title-1 m-b-25">Company List</h2>
                            <?php echo  "<p> <font color=red> $err_msg </font> </p>"; ?>
                            <div class="table-responsive table--no-card m-b-40">
                                <table class="table table-borderless table-striped table-earning">
                                <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Company ID</th>
                                            <th>Company Name</th>
                                            <th>Industry</th>
                                            <th>Website</th>
                                            <th>Office No</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            //Display Student List
                                            $query="select * from company order by companyname";
                                            $rs = mysqli_query($conn,$query);
                                            $count = 0;
                                                foreach($rs as $row){
                                        ?>  
                                        <tr>
                                            <td><?php echo ++$count;?> </td>
                                            <td><?php echo $row["CompanyId"]?></td>
                                            <td><?php echo $row["CompanyName"];?></td>
                                            <td><?php echo $row["Industry"];?></td>
                                            <td><?php echo $row["Website"];?></td>
                                            <td><?php echo $row["OfficeNo"];?></td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                      </div>
                    </div>
        </div>       
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>

    <div id="addModalCompany" class="modal fade" role="dialog">
              <div class="modal-dialog">
              <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <div class="card">
                        <div class="card-header">
                        
                            <strong>Add Company</strong>
                          </div>
                          <form action="" method="POST">
                          <div class="card-body card-block">
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
                           
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-default" name="submit">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
              
              </div>
            </div>
            </form>
            <!-- Modal Code Finish-->    

    <?php require_once('layouts/footer.php'); ?>
