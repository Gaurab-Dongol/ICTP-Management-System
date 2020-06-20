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

<div class="row">
                            <div class="col-md-12">
                                <div class="au-card">
                                <div class="row">
                            <div class="col-md-12">
                                <!-- DATA TABLE -->
                               
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                        <div class="rs-select2--light rs-select2--sm">
                                            <select class="js-select2" name="time">
                                                <option selected="selected">Today</option>
                                                <option value="">3 Days</option>
                                                <option value="">1 Week</option>
                                                <option value="">2 Week</option>
                                                <option value="">3 Week</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive table-responsive-data2">
                                    <table class="table table-data2">
                                        <thead>
                                            <tr>
                                                <th>Position</th>
                                                <th>Company</th>
                                                <th>Website</th>
                                                <th>Description</th>
                                                <th>Closes</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <?php
                                            //Display Student List
                                            $query='SELECT internship.*, company.* FROM internship INNER JOIN company ON internship.CompanyID=company.CompanyId';
                                            $rs = mysqli_query($conn,$query);
                                            //$count = 0;
                                                foreach($rs as $row){
                                        ?> 
                                        <tbody>
                                            <tr class="tr-shadow">
                                                <td><?php echo $row["JobRole"]?></td>
                                                <td><?php echo $row["CompanyName"]?></td>
                                                <td>
                                                    <span class="block-email"><?php echo $row["Website"]?></span>
                                                </td>
                                                <td class="desc"><?php echo $row["Description"]?></td>
                                                <td>2020-06-17</td>
                                                <td>
                                                    <div class="table-data-feature">
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
                                                            <i class="zmdi zmdi-mail-send"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                                <?php } ?>
                                    </table>
                                </div>
                                <!-- END DATA TABLE -->
                            </div>
                        </div>
        <!-- END MAIN CONTENT-->
        </div>
    </div>

    <?php require_once('layouts/footer.php'); ?>