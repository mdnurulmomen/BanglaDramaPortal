<?php
	session_start();	
	$UserName=$_POST['userName'];
	$userPsw=$_POST['userPsw'];
	
	$requiredName='Admin';
	$requiredPsw='123456';
	
	if (strcmp($UserName,$requiredName)==0 && strcmp($userPsw,$requiredPsw)==0){
		$_SESSION['login_user']= $requiredName;
		header("Location:welcome.php");
	}else{
		$Message = "Wrong Username or Password";
		header("Location:index.php?Message={$Message}");
	}
		
?>