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
	?>
	<body>
		<h2>Home Page</h2>
		<p>Konnichiwa <?php Print "$user"?>!</p> <!--Displays user's name-->
		<a href="logout.php">Click here to logout</a><br/><br/>
		<form action="add.php" method="POST">
			Reg. No.: <input type="text" name="Reg_No"/><br/>
			Name: <input type="text" name="Name"/><br/>
			DOB: <input type="date" name="DOB"/><br/>
			Percentage: <input type="text" name="Percentage"/><br/>
			Year: <input type="text" name="Year"/><br/>
			Rank: <input type="text" name="Rank"/><br/>
			public post? <input type="checkbox" name="public[]" value="yes"/><br/>
			<input type="submit" value="Add to list"/>
		</form>
		<h2 align="center">Student list</h2>
		<table border="1px" width="100%">
			<tr>
				<th>Reg. No.</th>
				<th>Name</th>
				<th>DOB</th>
				<th>Percentage</th>
				<th>Year</th>
				<th>Rank</th>
				<th>Edit</th>
				<th>Delete</th>
				<th>Public Post</th>
			</tr>
			<?php
				$con = mysqli_connect("localhost","root","");
				mysqli_connect("localhost", "root","") or die(mysql_error()); //Connect to server
				mysqli_select_db($con,"first_db") or die("Cannot connect to database"); //connect to database
				$query = mysqli_query($con,"Select * from list"); // SQL Query
				while($row = mysqli_fetch_array($query))
				{
					Print "<tr>";
						Print '<td align="center">'. $row['Reg_No'] . "</td>";
						Print '<td align="center">'. $row['Name'] . "</td>";
						Print '<td align="center">'. $row['DOB'] . "</td>";
						Print '<td align="center">'. $row['Percentage'] . "</td>";
						Print '<td align="center">'. $row['Year'] . "</td>";
						Print '<td align="center">'. $row['Rank'] . "</td>";
						Print '<td align="center"><a href="edit.php?Reg_No='. $row['Reg_No'] .'">edit</a> </td>';
						Print "<td><a onClick='confirmationDelete(this);return false;' href='delete.php?Reg_No=".$row['Reg_No']."'>delete</a></td>";
						Print '<td align="center">'. $row['public']. "</td>";
					Print "</tr>";
				}
			?>
		</table>
		<script>
			function confirmationDelete(anchor)
			{
				var conf = confirm('Are you sure want to delete this record?');
				if(conf)
				window.location=anchor.attr("href");
			}
		</script>
	</body>
</html>