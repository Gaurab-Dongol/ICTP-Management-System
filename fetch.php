<?php
require_once('inc/config.php');

$query = "SELECT concat(LastName, ', ', FirstName) as 'fullname',  companyuserID from companyuser where companyid = '".$_POST['cid']."' order by lastname, firstname";
//$query = " SELECT * from companyuser ";
$result = mysqli_query($conn, $query);
$output .= '<option value="" disabled selected>Select Contact</option>';
while($row = mysqli_fetch_assoc($result))
  {
   $output .= '<option value="'.$row["companyuserID"].'">'.$row["fullname"].'</option>';
  } 
   echo $output;
?>