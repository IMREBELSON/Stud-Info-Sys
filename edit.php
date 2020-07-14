<html>
	<head>
		<title>Omae Wa Mou Shindeiru</title>
	</head>
	<IMG STYLE="position:absolute; TOP:0px; LEFT:1220px; WIDTH:150px; HEIGHT:120px" SRC="mugiwara.jpg">
	<?php
	session_start(); //starts the session
	if($_SESSION['user']){ //checks if user is logged in
	}
	else{
		header("location:index.php"); // redirects if user is not logged in
	}
	$user = $_SESSION['user']; //assigns user value
	$Reg_No_exists = false;
	?>
	<body>
		<h2>Home Page</h2>
		<p>Konnichiwa <?php Print "$user"?>!</p> <!--Displays user's name-->
		<a href="logout.php">Click here to logout</a><br/><br/>
		<a href="home.php">Return to Home page</a>
		<h2 align="center">Currently Selected</h2>
		<table border="1px" width="100%">
			<tr>
				<th>Reg. No.</th>
				<th>Name</th>
				<th>DOB</th>
				<th>Percentage</th>
				<th>Year</th>
				<th>Rank</th>
				<th>Public Post</th>
			</tr>
			<?php
				if(!empty($_GET['Reg_No']))
				{
					$Reg_No = $_GET['Reg_No'];
					$_SESSION['Reg_No'] = $Reg_No;
					$Reg_No_exists = true;
					$con = mysqli_connect("localhost","root","");
					mysqli_connect("localhost", "root","") or die(mysqli_error()); //Connect to server
					mysqli_select_db($con,"first_db") or die("Cannot connect to database"); //connect to database
					$query = mysqli_query($con,"Select * from list Where Reg_No='$Reg_No'"); // SQL Query
					$count = mysqli_num_rows($query);
					if($count > 0)
					{
						while($row = mysqli_fetch_array($query))
						{
							Print "<tr>";
							Print '<td align="center">'. $row['Reg_No'] . "</td>";
							Print '<td align="center">'. $row['Name'] . "</td>";
							Print '<td align="center">'. $row['DOB'] . "</td>";
							Print '<td align="center">'. $row['Percentage'] . "</td>";
							Print '<td align="center">'. $row['Year'] . "</td>";
							Print '<td align="center">'. $row['Rank'] . "</td>";
							Print '<td align="center">'. $row['public']. "</td>";
							Print "</tr>";
						}
					}
					else
					{
						$Reg_No_exists = false;
					}
				}
			?>
		</table>
		<br/>
		<?php
		if($Reg_No_exists)
		{
		Print '
		<form action="edit.php" method="POST">
			Reg. No.: <input type="text" name="Reg_No"/><br/>
			Name: <input type="text" name="Name"/><br/>
			DOB: <input type="date" name="DOB"/><br/>
			Percentage: <input type="text" name="Percentage"/><br/>
			Year: <input type="text" name="Year"/><br/>
			Rank: <input type="text" name="Rank"/><br/>
			public post? <input type="checkbox" name="public[]" value="yes"/><br/>
			<input type="submit" value="Update List"/>
		</form>
		';
		}
		else
		{
			Print '<h2 align="center">There is no data to be edited.</h2>';
		}
		?>
	</body>
</html>

<?php
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$con = mysqli_connect("localhost","root","");
		mysqli_connect("localhost", "root","") or die(mysqli_error()); //Connect to server
		mysqli_select_db($con,"first_db") or die("Cannot connect to database"); //Connect to database
		$Reg_No = mysqli_real_escape_string($con,$_POST['Reg_No']);
		$Name = mysqli_real_escape_string($con,$_POST['Name']);
		$DOB = mysqli_real_escape_string($con,$_POST['DOB']);
		$Percentage = mysqli_real_escape_string($con,$_POST['Percentage']);
		$Year = mysqli_real_escape_string($con,$_POST['Year']);
		$Rank = mysqli_real_escape_string($con,$_POST['Rank']);
		$public = "no";

		foreach($_POST['public'] as $list)
		{
			if($list != null)
			{
				$public = "yes";
			}
		}
		mysqli_query($con,"UPDATE list SET Reg_No='$Reg_No', Name='$Name', DOB='$DOB', Percentage='$Percentage', Year='$Year', Rank='$Rank', public='$public' WHERE Reg_No='$Reg_No'") ;

		header("location: home.php");
	}
?>