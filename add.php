<?php
	session_start();
	$con = mysqli_connect("localhost","root","");
	if($_SESSION['user']){
	}
	else{
		header("location:index.php");
	}

	if($_SERVER['REQUEST_METHOD'] = "POST") //Added an if to keep the page secured
	{
		$Reg_No = mysqli_real_escape_string($con,$_POST['Reg_No']);
		$Name = mysqli_real_escape_string($con,$_POST['Name']);
		$DOB = mysqli_real_escape_string($con,$_POST['DOB']);
		$Percentage = mysqli_real_escape_string($con,$_POST['Percentage']);
		$Year = mysqli_real_escape_string($con,$_POST['Year']);
		$Rank = mysqli_real_escape_string($con,$_POST['Rank']);
		$decision ="no";
		
		mysqli_connect("localhost", "root","") or die(mysqli_error()); //Connect to server
		mysqli_select_db($con,"first_db") or die("Cannot connect to database"); //Connect to database
		foreach($_POST['public'] as $each_check) //gets the data from the checkbox
 		{
 			if($each_check !=null ){ //checks if the checkbox is checked
 				$decision = "yes"; //sets teh value
 			}
 		}
		
		mysqli_query($con,"INSERT INTO list (Reg_No, Name, DOB, Percentage, Year, Rank, public) VALUES ('$Reg_No', '$Name', '$DOB', '$Percentage', '$Year', '$Rank', '$decision')"); //SQL query
		header("location: home.php");
	}
	else
	{
		header("location:home.php"); //redirects back to hom
	}
?>