<?php 
include("config.php");
session_start(); /* Starts the session */
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      $sql = "SELECT userpass FROM user WHERE username = '$myusername'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $count = mysqli_num_rows($result)
      // If result matched $myusername, table row must be 1 row
      if($count == 1) {
       // Verify hashed password is correct
            if (password_verify($mypassword,$row["userpass"])) {
            $_SESSION['login_user'] = $myusername;
          header("location:week14.php");
}
else{
echo "Your Login Name or Password is invalid1";}
      }else {
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

