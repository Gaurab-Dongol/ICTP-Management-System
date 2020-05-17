<?php 
	session_start();
	
	if(!isset($_SESSION['id'],$_SESSION['user_role_id']))
	{
		header('location:index.php?lmsg=true');
		exit;
	}		

	require_once('inc/config.php');
	require_once('layouts/header.php'); 
	require_once('layouts/left_sidebar.php'); 
	
	//Upload .csv file
	if(isset($_POST["submit"]))
	{
		if($_FILES['file']['name'])
		{
			$filename = explode(".", $_FILES['file']['name']);
			if($filename[1] == 'csv')
		{
			$handle = fopen($_FILES['file']['tmp_name'], "r");
			//Skips first row of excel file
			fgetcsv($handle);	
		while($data = fgetcsv($handle))
		{
			$item1 = mysqli_real_escape_string($conn, $data[0]);  
			$item2 = mysqli_real_escape_string($conn, $data[1]);
			$item3 = mysqli_real_escape_string($conn, $data[2]);  
			$item4 = mysqli_real_escape_string($conn, $data[3]);
			$item5 = mysqli_real_escape_string($conn, $data[4]);  
			//$item6 = mysqli_real_escape_string($conn, $data[5]);
			$query = "INSERT INTO Student (`First_Name`, `Last_Name`, `Email`, `Contact`,`Specialisation`,`UserID`) VALUES ('$item1', '$item2', '$item3', '$item4', '$item5', '3')";
			mysqli_query($conn, $query);
			
		}
			fclose($handle);
			echo "<script>alert('Import done');</script>";
		}
		}
	}
?>

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        
      </ol>
      <h1>Welcome to Dashboard</h1>
      <hr>
	  <p>You are login as <strong><?php echo getUserAccessRoleByID($_SESSION['user_role_id']); ?></strong></p>
	  <?php 
		//only visible to admin and editor
		if($_SESSION['user_role_id'] == 1){?>
        <div class="card mb-4">
                            <div class="card-header"><i class="fa fa-table mr-1"></i>Student List</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
												<th>No.</th>
												<th>SID</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Email</th>
                                                <th>Contact</th>
                                                <th>Specialisation</th>
                                            </tr>
                                        </thead>
										<tbody>
											<?php
												//Display Student List
												$query="select * from Student";
												$rs = mysqli_query($conn,$query);
												$count = 0;
													foreach($rs as $row){
											?>  
											<tr>
												<td><?php echo ++$count;?> </td>
												<td><?php echo $row["SID"]?></td>
												<td><?php echo $row["First_Name"];?></td>
												<td><?php echo $row["Last_Name"];?></td>
												<td><?php echo $row["Email"];?></td>
												<td><?php echo $row["Contact"];?></td>
												<td><?php echo $row["Specialisation"];?></td>
											</tr>
											<?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
							<form method="post" enctype="multipart/form-data">
   	
    <label>Select CSV File:</label>
    <input type="file" name="file" />
    <br />
    <input type="submit" name="submit" value="Import" class="btn btn-info" />
   
  </form>
                        </div>
      <div style="height: 1000px;"></div>
	</div> 
	<?php }?>
		</div>
    <!-- /.container-fluid-->
	
<?php require_once('layouts/footer.php'); ?>	