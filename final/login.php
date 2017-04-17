<?php 
include("Config.php");
session_start(); /* Starts the session */
function test_input($data) {
  $data = htmlspecialchars($data);
  $data = trim($data);
  $data = stripslashes($data);
  
  return $data;
}
if($_SERVER["REQUEST_METHOD"] == "POST") 
{
      // username and password sent from form 
	  $myusername = mysqli_real_escape_string($con,$_POST['username']);
      $mypassword = mysqli_real_escape_string($con,$_POST['password']); 
      $sql = "SELECT hashword FROM hashLogin 
		WHERE loginname = '$myusername'";
      $result = mysqli_query($con,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $count = mysqli_num_rows($result);
      // If result matched $myusername, table row must be 1 row
	if($count == 1) 
	{
		   // Verify hashed password is correct
		if (password_verify($mypassword,$row["hashword"])) 
		{
			$_SESSION['login_user'] = $myusername;
			//header("location:Home.php");
			header('Location: ' . $_SERVER["HTTP_REFERER"] );

			exit;
		}
		else
		{
			echo "Your Login Name or Password is invalid1";
		}
	}
	else 
	{
		echo "Your Login Name or Password is invalid";
	}
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login Page</title>
</head>
<body>
<form action = "" method = "post">
    <label>UserName  :</label><input type = "text" name = "username" class = "box"/><br /><br />
    <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
    <input type = "submit" value = " Submit "/><br />
</form>
</body>
</html>

