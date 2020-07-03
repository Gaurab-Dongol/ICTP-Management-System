<?php 
	session_start();
	
	if(!isset($_SESSION['RoleId']))
	{
		header('location:login.php?lmsg=true');
		exit;
    }		
    require_once('inc/config.php');
    require_once('layouts/header.php'); 

    if(isset($_POST["SubmitBtn"]))
    {
        $target = "report/";
        $target = $target . basename($_FILES['file-input']['name']);
        $ok = 1;
        if (move_uploaded_file($_FILES['file-input']['tmp_name'], $target))
        {
            $comment = $_POST["comment"];
            $insert = $conn->query("INSERT into finalreport (InternshipId, StudentID, DateSubmitted, Filename, WeekNo, StudentComment) VALUES ('19513498','19513498','','".$fileName."','','$comment')");
        }
        else
        {
            echo "Sorry, there was a problem uploading your file.";
        }
    }
    
    $UID = $_GET['UID'];
    $file= "SELECT f.Filename,f.StudentComment FROM finalreport f INNER JOIN student s ON f.StudentID = s.StudentID where s.USERID=$UID";
    $f = mysqli_query($conn, $file);
    $ms = mysqli_fetch_array($f);
    $word = $ms["Filename"];
    $comment = $ms["Studentcomment"];
    $file1 = 'report/'.$word;
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
    <div class="col-lg-6">
        <h2 class="title-1 m-b-25">Final Report</h2>
            <div class="card">
                <div class="card-body card-block">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="textarea-input" class=" form-control-label">Comment</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <textarea class="ckeditor" name="comment" id="textarea-input" class="form-control"><?php echo $comment?></textarea>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="file-input" class=" form-control-label">File input</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="file" id="file-input" name="file-input" class="form-control-file">
                            </div>
                        </div>
                </div>
                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-sm" name="SubmitBtn">
                        <i class="fa fa-dot-circle-o"></i> Submit
                    </button>
                    </form> 
                </div>
            </div>      
        </div>

    <div class="col-lg-6">
    <iframe src='<?php echo $file1;?>' width='500px' height='800px'></iframe>
    </div>
    </div>
 
<?php require_once('layouts/footer.php'); ?>