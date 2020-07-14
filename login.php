<html>
 <head>
  <title>Omae Wa Mou Shindeiru</title>
</head>
<IMG STYLE="position:absolute; TOP:0px; LEFT:1220px; WIDTH:150px; HEIGHT:120px" SRC="mugiwara.jpg">
 <body>
 <h2>Login Page</h2>
  <?php
    echo '<a href="index.php"><-back<br/><br/></a>';
  ?>
	<form method="post" action="checklogin.php">
           Enter Username: <input type="text" name="username" required="required" > <br/>
           Enter password: <input type="password" name="password" required="required" > <br/>
           <input type="submit" value="Login">
    </form>
 </body>
</html>
