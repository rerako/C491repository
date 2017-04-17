<?php 
include("Config.php");
session_start();
//Verify login user else back to login screen
if(!isset($_SESSION['login_user'])){
	//header("location:login.php");
	echo 'logged out';
	$foo = False;
   }
   else{
	   	echo 'logged in?';
		print_r($_SESSION);

	   	$foo = True;

   }
?>

<html>
<head>
<title>Dan's Kung Pow Chicken: News</title>
</head>
<link rel="stylesheet" type="text/css" href="style.css">

<body>
<div class="centerheader">
<h1>This is a Heading</h1>
<?php 
if($foo){
      echo '<a href="logout.php">Click here</a> to Logout.';
   }
   else{
	  //echo '<a href="login.php">Click here</a> to login.';
	  echo '<form action="login.php"  method="post">';
		echo 'Login name:<input type="text" name="username" /><br>';
		echo 'Password:<input type="password" name="password" /><br>';
		echo '<input type="submit"></br>';
	  echo '</form>';

   }
?>
</div>
<div class="bodynav">
  <ul>
    <li><a href="http://cgi.soic.indiana.edu/~btung/c491/Home.php">Home</a></li>
    <li><a href="http://cgi.soic.indiana.edu/~btung/c491/About_us.php">About Us</a></li>
    <li><a href="http://cgi.soic.indiana.edu/~btung/c491/News.php">News</a></li>
    <li><a href="http://cgi.soic.indiana.edu/~btung/c491/Events.php">Events</a></li>
	<li><a href="http://cgi.soic.indiana.edu/~btung/c491/Menu.php">Menu</a></li>
	<li><a href="http://cgi.soic.indiana.edu/~btung/c491/Contact_us.php">Contacts</a></li>
  </ul>
</div>
<div class="bodymain">

<p>This is a paragraph.</p>
</div>

<div class="twitternav">

<a class="twitter-timeline" data-width="100%" data-height="200" data-tweet-limit="4" data-theme="dark"   data-chrome="nofooter noborders" href="https://twitter.com/fake_Student419">Tweets by fake_Student419</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
</div>


</br>
</body>
</html>
