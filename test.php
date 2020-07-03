<?php
    require_once('inc/config.php');
    
    $file= "SELECT f.DateSubmitted,f.StudentComment FROM finalreport f INNER JOIN student s ON f.StudentID = s.StudentID where s.USERID='12'";
    $f = mysqli_query($conn, $file);
    $ms = mysqli_fetch_array($f);
    //$word = $ms["Filename"];
    $comment = $ms["StudentComment"];
    $getdate = $ms["DateSubmitted"]; 

echo '<h1>Here is the Document information</h1>';
echo '<strong>Created Date : </strong>'.$comment;
echo '<strong>File Name : </strong>'.$getdate;

  
?>
