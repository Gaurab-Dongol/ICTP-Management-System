<?php
    require_once('inc/config.php');
    
    $file= "SELECT * from finalreport where weekno='4'";
    $f = mysqli_query($conn, $file);
    $ms = mysqli_fetch_array($f);
    $word = $ms["Filename"];
    $file1 = 'report/'.$word; 

echo '<h1>Here is the Document information</h1>';
echo '<strong>Created Date : </strong>'.$file1;
echo '<strong>File Name : </strong>'.$word;

  
?>
<iframe src='<?php echo $file1;?>' frameborder='0'></iframe>
