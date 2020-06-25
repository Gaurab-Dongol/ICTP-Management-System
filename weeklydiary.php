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
        <h2 class="title-1 m-b-25">Weekly Diary</h2>
        <div class="table-responsive table--no-card m-b-40">
            <table class="table table-borderless table-striped table-earning">
            <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Completed Task</th>
                        <th>Status</th>
                        <th>Manager Remarks</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Krupali Valand</td>
                        <td>05/05/2020</td>
                        <td>07/05/2020</td>
                        <td>Admin Dashboard</td>
                        <td>
                            <select name="selectstatus" id="selectyears" class="form-control">
                            
                                <option value="1">Pending</option>
                                <option value="2">Rejected</option>
                                <option value="3">Confirmed</option>
                              </select>
                        </td>
                        <td>
                            <input type="text" id="rmarks" placeholder="Enter your Remarks" class="form-control">

                        </td>
                    </tr>
                    <tr>
                        <td>John Remos</td>
                        <td>10/05/2020</td>
                        <td>15/05/2020</td>
                        <td>Student Dashboard</td>
                        <td>
                            <select name="selectstatus" id="selectyears" class="form-control">
                            
                                <option value="1">Pending</option>
                                <option value="2">Rejected</option>
                                <option value="3">Confirmed</option>
                              </select>
                        </td>
                        <td>
                            <input type="text" id="rmarks" placeholder="Enter your Remarks" class="form-control">

                        </td>
                    </tr>
                    <tr>
                        <td>Lian Steve</td>
                        <td>11/05/2020</td>
                        <td>15/05/2020</td>
                        <td>Company Dashboard</td>
                        <td>
                            <select name="selectstatus" id="selectyears" class="form-control">
                            
                                <option value="1">Pending</option>
                                <option value="2">Rejected</option>
                                <option value="3">Confirmed</option>
                              </select>
                        </td>
                        <td>
                            <input type="text" id="rmarks" placeholder="Enter your Remarks" class="form-control">

                        </td>
                    </tr>
                    <tr>
                        <td>Steve Max</td>
                        <td>09/05/2020</td>
                        <td>11/05/2020</td>
                        <td>Registration Page</td>
                        <td>
                            <select name="selectstatus" id="selectyears" class="form-control">
                            
                                <option value="1">Pending</option>
                                <option value="2">Rejected</option>
                                <option value="3">Confirmed</option>
                              </select>
                        </td>
                        <td>
                            <input type="text" id="rmarks" placeholder="Enter your Remarks" class="form-control">

                        </td>
                    </tr>
                    <tr>
                        <td>Sonal Rana</td>
                        <td>30/05/2020</td>
                        <td>05/06/2020</td>
                        <td>Internship</td>
                        <td>
                            <select name="selectstatus" id="selectyears" class="form-control">
                            
                                <option value="1">Pending</option>
                                <option value="2">Rejected</option>
                                <option value="3">Confirmed</option>
                              </select>
                        </td>
                        <td>
                            <input type="text" id="rmarks" placeholder="Enter your Remarks" class="form-control">

                        </td>
                    </tr>
                    <tr>
                        <td>Rajni Pithva</td>
                        <td>15/05/2020</td>
                        <td>25/05/2020</td>
                        <td>Admin and Staff</td>
                        <td>
                            <select name="selectstatus" id="selectyears" class="form-control">
                            
                                <option value="1">Pending</option>
                                <option value="2">Rejected</option>
                                <option value="3">Confirmed</option>
                              </select>
                        </td>
                        <td>
                            <input type="text" id="rmarks" placeholder="Enter your Remarks" class="form-control">

                        </td>
                    </tr>
                    
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
<?php require_once('layouts/footer.php'); ?>
