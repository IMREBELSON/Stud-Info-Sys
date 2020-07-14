<html>
 <head>
  <title>Omae Wa Mou Shindeiru</title>
</head>
<IMG STYLE="position:absolute; TOP:0px; LEFT:1220px; WIDTH:150px; HEIGHT:120px" SRC="mugiwara.jpg">
 <body>
 <h2>Registration Page</h2>
<?php
  echo '<a href="index.php"><-back</a><br/><br/>';
?>
	<form method="post" action="register.php">
           Enter Username: <input type="text" name="username" required="required" > <br/>
           Enter password: <input type="password" name="password" required="required" > <br/>
           <input type="submit" value="Register">
    </form>
 </body>
</html>
<?php 
   $con = mysqli_connect("localhost","root","");
   if($_SERVER["REQUEST_METHOD"] == "POST")
   {
	   $username = mysqli_real_escape_string($con,$_POST['username']);
	   $password = mysqli_real_escape_string($con,$_POST['password']);
	   $bool = true;
       mysqli_connect("localhost", "root","") or die(mysqli_error()); //Connect to server
	   mysqli_select_db($con,"first_db") or die("Cannot connect to database"); //Connect to database
	   $query = mysqli_query($con,"Select * from user"); //Query the users table
	   while($row = mysqli_fetch_array($query)) //display all rows from query
	   {
		 $table_user = $row['username']; // the first username row is passed on to $table_users, and so on until the query is finished
		 if($username == $table_user) // checks if there are any matching fields
		 {
			$bool = false; // sets bool to false
			Print '<script>alert("Username has been taken!");</script>'; //Prompts the user
			Print '<script>window.location.assign("register.php");</script>'; // redirects to register.php
		 }
	   }

	   if($bool) // checks if bool is true
	   {
		 mysqli_query($con,"INSERT INTO user (username, password) VALUES ('$username','$password')"); //Inserts the value to table users
		 Print '<script>alert("Successfully Registered!");</script>'; // Prompts the user
		 Print '<script>window.location.assign("index.php");</script>'; // redirects to register.php
	   }
   }
?>