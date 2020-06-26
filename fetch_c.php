<?php
require_once('inc/config.php');

$query = "SELECT concat(b.lastname, ', ', b.firstname) as 'fullname', a.internshipID from internship a inner join companyuser b on a.companyuserid = b.companyuserid where internshipid = '".$_POST['cid']."'";
//$query = " SELECT * from companyuser ";
$result = mysqli_query($conn, $query);
while($row = mysqli_fetch_assoc($result))
  {
   $output .= '<option value="'.$row["internshipID"].'">'.$row["fullname"].'</option>';
  } 
   echo $output;
?>