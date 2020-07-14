<html>
	<head>
		<title>Omae Wa Mou Shindeiru</title>
	</head>
<IMG STYLE="position:absolute; TOP:0px; LEFT:1220px; WIDTH:150px; HEIGHT:120px" SRC="mugiwara.jpg">
	<body>
		<?php
			echo "<h2><p>Konnichiwa</p></h2>";
			echo '<a href="login.php">Login</a>&emsp;&emsp;';
			echo '<a href="register.php">Register</a>';
		?>
	</body>
	<br/>
	<h2 align="center">List</h2>
	<table width="100%" border="1px">
			<tr>
				<th>Reg. No.</th>
				<th>Name</th>
				<th>DOB</th>
				<th>Percentage</th>
				<th>Year</th>
				<th>Rank</th>
			</tr>
			<?php
			    $con=mysqli_connect("localhost", "root","");
				mysqli_connect("localhost", "root","") or die(mysql_error()); //Connect to server
				mysqli_select_db($con,"first_db") or die("Cannot connect to database"); //connect to database
				$query = mysqli_query($con,"Select * from list Where public='yes'"); // SQL Query
				while($row = mysqli_fetch_array($query))
				{
					Print "<tr>";
						Print '<td align="center">'. $row['Reg_No'] . "</td>";
						Print '<td align="center">'. $row['Name'] . "</td>";
						Print '<td align="center">'. $row['DOB'] . "</td>";
						Print '<td align="center">'. $row['Percentage'] . "</td>";
						Print '<td align="center">'. $row['Year'] . "</td>";
						Print '<td align="center">'. $row['Rank'] . "</td>";
					Print "</tr>";
				}
			?>
	</table>
</html>