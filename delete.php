<?php
	session_start(); //starts the session
	if($_SESSION['user']){ //checks if user is logged in
	}
	else{
		header("location:index.php"); // redirects if user is not logged in
	}
	$con = mysqli_connect("localhost","root","");
	if($_SERVER['REQUEST_METHOD'] == "GET")
	{
		mysqli_connect("localhost", "root","") or die(mysqli_error()); //Connect to server
		mysqli_select_db($con,"first_db") or die("Cannot connect to database"); //Connect to database
		$Reg_No = $_GET['Reg_No'];
		mysqli_query($con,"DELETE FROM list WHERE Reg_No='$Reg_No'");
		header("location: home.php");
	}
?>