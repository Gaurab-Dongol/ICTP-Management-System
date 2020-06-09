<?php 
	session_start(); // we will use it later  to store logged in user information such as username
	define("HOST","localhost");
	define("DB_USER","root");
	define("DB_PASS","root");
	define("DB_NAME","ICTP-MNG-SYS");
	
	
	$conn = mysqli_connect(HOST,DB_USER,DB_PASS,DB_NAME);
	
	if(!$conn)
	{
		die(mysqli_error());
	}
	
	function getUserAccessRoleByID($id)
	{
		global $conn;
		
		$query = "select RoleId from role where RoleId = ".$id;
	
		$rs = mysqli_query($conn,$query);
        $row = mysqli_fetch_assoc($rs);
		
		return $row['RoleId'];
	}
?>