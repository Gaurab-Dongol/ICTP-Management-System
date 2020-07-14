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
    
    if(isset($_POST['submit'])){

        $sql = "UPDATE diary SET UCRemarks = ? where studentid = ? and internshipid = ? and status = ?"; 
        //$sql = "INSERT INTO test (name)VALUES (?)"; 
        if($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssss" , $param_mr,$param_sid,$param_iid, $param_stat);
            
            $param_stat = trim($_POST["stat"]);
            $param_mr = trim($_POST["ucmarks"]);
            //$param_mr = 'ac'; 
            $param_id = trim($_POST["diaryid"]); 
            $param_sid = trim($_POST["studentid"]); 
            $param_iid = trim($_POST["internshipid"]); 
            //$param_id = trim($_GET["ID"]); 
            if(mysqli_stmt_execute($stmt)){
                // Redirect to add page
                //header("location: weeklydiary_admin.php?UID=$UID");
                //echo "records have been updated";
            } else{
                echo "not working";
            }
        }
    }    

?>
<style>
.cell {
  max-width: 50px; /* tweak me please */
  white-space : nowrap;
  overflow : hidden;
}
</style>

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
            <h1>Final Report</h1>
                <div class="table-responsive table--no-card m-b-40">
                    <table class="table table-borderless table-striped table-earning">
                    <thead>
                        <tr>
                            <th>SID</th>
                            <th>Student Name</th>
                            <th>Description</th>
                            <th>Remarks</th>
                            <th>View</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $UID = $_GET['UID'];
                    $query= "SELECT f.DateSubmitted,f.StudentComment, f.UCRemarks, s.FirstName, s.LastName, s.StudentID FROM finalreport f INNER JOIN student s ON f.StudentID = s.StudentID";
                    $rs = mysqli_query($conn,$query);               
                        foreach($rs as $row){
                    ?>   
                        <tr>
                        <td><?php echo $row["StudentID"]?></td>
                            <td><?php echo $row["FirstName"]  .  $row["LastName"]?></td>
                            <td class="cell"><?php echo $row["StudentComment"]?></td>
                            <td class="cell"> 
                                <?php echo $row["UCRemarks"]?>
                                <!--<input class="form-control" type="text" name="ucmarks" placeholder="<?php //echo $row["UCRemarks"]; ?>" style="width: 300px;">   -->
                            </td> 
                            <td><a href="report.php?UID=<?php echo $_GET['UID']?>&SID=<?php echo $row["StudentID"]?>" class="btn au-btn-icon au-btn--green btn-sm" data-toggle="modal" data-target="#myModalProfile"><button type="submit" name="submit" >
                            View</button></a></td>             
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

        <div id="myModalProfile" class="modal fade" role="dialog">
                <div class="modal-dialog">
                <!-- Modal content-->
                    <div class="modal-content">
                    <?php
                            $query=" SELECT * from finalreport";
                            $student = mysqli_query($conn,$query);
                            $rs = mysqli_fetch_array($student);
                    ?> 
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-header">
                                <strong>Final Report</strong>
                            </div>
                            <form action="" method="POST">
                            <div class="card-body card-block">
                                <div class="form-group">
                                <label class=" form-control-label">Report</label>
                                <textarea class="ckeditor" name="StudentComment" disabled><?php echo $rs["StudentComment"]?></textarea>
                                </div>
                                <div class="form-group">
                                <label class=" form-control-label">Remarks</label>
                                <input type="text" value="<?php echo $rs["Remarks"]?>" class="form-control" name="lastName">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default" name="Update">Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
                </div>
                </div>
        </div>
        </form>
            <!-- Modal Code Finish-->
<?php require_once('layouts/footer.php'); ?>