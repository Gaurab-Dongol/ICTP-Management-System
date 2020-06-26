<?php
require_once('inc/config.php');

$query = "SELECT concat(b.companyname, ' - ', a.jobrole) as 'job', a.internshipID from internship a inner join company b on a.companyid = b.companyid where internshipid = '".$_POST['cid']."'";
//$query = " SELECT * from companyuser ";
$result = mysqli_query($conn, $query);
while($row = mysqli_fetch_assoc($result))
  {
   $output .= '<option value="'.$row["internshipID"].'">'.$row["job"].'</option>';
  } 
   echo $output;
  
?>