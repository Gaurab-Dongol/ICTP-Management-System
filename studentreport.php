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
    $file= "SELECT f.DateSubmitted,f.StudentComment FROM finalreport f INNER JOIN student s ON f.StudentID = s.StudentID where s.USERID='".$UID."'";
    $f = mysqli_query($conn, $file);
    $ms = mysqli_fetch_array($f);
    //$word = $ms["Filename"];
    $comment = $ms["StudentComment"];
    $getdate = $ms["DateSubmitted"];
    $gdate= date('Y-m-d', strtotime($getdate));
    //$file1 = 'report/'.$word;

    if (isset($_POST["SubmitBtn"]))
    {
            $insert = "INSERT into finalreport (InternshipId, StudentID, DateSubmitted, Filename, WeekNo, StudentComment) VALUES (?,?,?,?,?,?)";
            if($stmt = mysqli_prepare($conn, $insert)) {
                mysqli_stmt_bind_param($stmt, "ssssss", $param_InternshipId, $param_sid, $param_Date, $param_file, $param_weekno, $param_commment);
                
                $sql4 = "select studentid from student where USERID='".$UID."'";
                $rs = mysqli_query($conn, $sql4);
                $row = mysqli_fetch_row($rs);
                $SID = $row[0];
                
                $sql1a = "select internshipid from student_intern where studentid = '".$SID."'";
                $rs = mysqli_query($conn, $sql1a);
                $row = mysqli_fetch_row($rs);
                $param_InternshipId = $row[0];
            
                $sql2a = "select studentid from student_intern where studentid = '".$SID."'";
                $rs = mysqli_query($conn, $sql2a);
                $row = mysqli_fetch_row($rs);
                $param_sid = $row[0];
    
                $param_file = '';
                $param_weekno= '';
                //$param_start = '2020-02-28';
                $date = strtotime($_POST["Date"]);
                $param_Date = date("Y-m-d", $date);
                $param_commment = trim($_POST["comment"]);

                if(mysqli_stmt_execute($stmt)){
                    // Redirect to add page
                    header("location: studentreport.php?UID=$UID");
                } else{
                    echo "not working";
                }
    
                mysqli_stmt_close($stmt);
        }
    else if (isset($_POST["UpdateBtn"]))
    {
    $sql4 = "select studentid from student where USERID='".$UID."'";
    $rs = mysqli_query($conn, $sql4);
    $row = mysqli_fetch_row($rs);
    $StudentID = $row[0];

    $sql2a = "select studentid from student_intern where studentid = '".$StudentID."'";
    $rs = mysqli_query($conn, $sql2a);
    $row = mysqli_fetch_row($rs);
    $sid = $row[0];

    $comment = $_POST["comment"];
    $udate = strtotime($_POST["DateSubmitted"]);
    $sdate = date("Y-m-d H:i:s", $udate);
    $update = "UPDATE finalreport SET StudentComment='test123',DateSubmitted='2020-06-02 23:58:34' where StudentID='19513498'";
    mysqli_query($conn, $update);
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
        <div class="row">
        <div class="col-lg-12">
            <h2 class="title-1 m-b-25">Final Report</h2>
                <div class="card">
                    <div class="card-body card-block">
                        <form action="" method="post" class="form-horizontal">
                        
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="textarea-input" class="form-control-label">Submitted Date</label>
                                </div>
                                <div class="col-12 col-md-3">
                                    <input class="form-control" value="<?php echo $gdate;?>" type="date" name="Date" required>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="textarea-input" class=" form-control-label">Comment</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <textarea class="ckeditor" name="comment" id="textarea-input" class="form-control"><?php echo $comment; ?></textarea>
                                </div>
                            </div>
                    </div>
                        <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm" name="SubmitBtn">
                            <i class="fa fa-dot-circle-o"></i> Insert
                        </button>
                        <button type="upload" class="btn btn-primary btn-sm" name="UpdateBtn">
                            <i class="fa fa-dot-circle-o"></i> Update
                        </button>
                        </form> 
                    </div>
                </div>      
            </div>
        </div>
 
<?php require_once('layouts/footer.php'); ?>