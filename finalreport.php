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
        <h2 class="title-1 m-b-25">Final Report</h2>
        <div class="table-responsive table--no-card m-b-40">
            <table class="table table-borderless table-striped table-earning">
            <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Role</th>
                        <th>Date submitted</th>
                        <th>Report</th>
                        <th>Status</th>
                        <th>Manager Remarks</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Krupali Valand</td>
                        <td>Web Developer</td>
                        <td>07/05/2020</td>
                        <td>
                            <button class="au-btn au-btn--block au-btn--green m-b-20" name="view">View</button>

                        </td>
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
                        <td>Web Designer</td>
                        <td>10/05/2020</td>
                        <td>
                            <button class="au-btn au-btn--block au-btn--green m-b-20" name="view">View</button>

                        </td>
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
                        <td>Tester</td>
                        <td>15/05/2020</td>
                        <td>
                            <button class="au-btn au-btn--block au-btn--green m-b-20" name="view">View</button>

                        </td>
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
                        <td>Data Analyst</td>
                        <td>16/05/2020</td>
                        <td>
                            <button class="au-btn au-btn--block au-btn--green m-b-20" name="view">View</button>

                        </td>
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
                        <td>UI Desiner</td>
                        <td>25/05/2020</td>
                        <td>
                            <button class="au-btn au-btn--block au-btn--green m-b-20" name="view">View</button>

                        </td>
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
                        <td>Back-End Developer</td>
                        <td>05/06/2020</td>
                        <td>
                            <button class="au-btn au-btn--block au-btn--green m-b-20" name="view">View</button>

                        </td>
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

<?php require_once('layouts/footer.php'); ?>