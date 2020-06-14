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
                    <?php 
                    //only visible to admin 
                    if($_SESSION['RoleId'] == 3){?>
                    <div class="row">
                    <div class="col-md-12">
                                <!-- DATA TABLE -->
                                <h3 class="title-5 m-b-35">My Diary</h3>
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                        <div class="rs-select2--light rs-select2--md">
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <div class="rs-select2--light rs-select2--sm">
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <button class="au-btn-filter">
                                    </div>
                                    <div class="table-data__tool-right">
                                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                            <i class="zmdi zmdi-plus"></i><a href="diary.php?UID=<?php echo $_GET['UID']?>">add item</a></button>
                                        <div class="rs-select2--dark rs-select2--sm rs-select2--dark2">
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive table-responsive-data2">
                                    <table class="table table-data2">
                                        <thead>
                                            <tr>
                                                <th>Version No</th>
                                                <th>Total hours</th>
                                                <th>Task Description</th>
                                                <th>Date submitted</th>
                                                <!--<th>Manager Remarks</th>
                                                <th>status</th>
                                                <th>price</th>
                                                <th></th>-->
                                            </tr>
                                        </thead>
                                        <?php
                                            //Display Student List
                                            $UID = $_GET['UID'];
                                            $query= "SELECT student.StudentID, Diary.* FROM student INNER JOIN Diary ON student.StudentID=Diary.StudentID WHERE student.USERID='$UID'";
                                            //$query='select * from diary';
                                            $rs = mysqli_query($conn,$query);
                                            //$count = 0;
                                                foreach($rs as $row){
                                        ?> 
                                        <tbody>
                                            <tr class="tr-shadow">
                                                <td><?php echo $row["VersionNO"]?></td>
                                                <td>
                                                    <span class="block-email"><?php echo $row["TotalHours"]?></span>
                                                </td>
                                                <td class="desc"><?php echo $row["TaskDesc"]?></td>
                                                <td class="desc"><?php echo $row["DateSubmitted"]?></td>
                                                <td>
                                                    <div class="table-data-feature">
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
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
                    </div>
                    </div>
                    <?php } ?>
            </div>
    </div>

<?php require_once('layouts/footer.php'); ?>