<?php 
include("Config.php");
session_start();
//Verify login user else back to login screen
if(!isset($_SESSION['login_user'])){
	//header("location:login.php");
	$foo = False;
   }
   else{
	   	$foo = True;

   }
?>

<html>
<head>
<title>Dan's Kung Pow Chicken: Menu</title>
</head>
<link rel="stylesheet" type="text/css" href="style.css">

<body>

<div class="centerheader">
	
	<div class="headernav">
		<div class="boxed">
			<img src="http://cgi.soic.indiana.edu/~btung/c491/Images/cap1.JPG" height="95%" width="95%">
		</div>
	</div>
	<div class="bodymain">
	<div class="boxed">
		<h1>ChickenFu!!!</h1>
		<h2>The place that sells only so much Chicken!</h2>
	</div>
	</div>
	<div class="twitternav">
		<div class="boxed">
			<?php 
				// if foo = true then logged in
				//if foo = false then logged out
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
	</div>

</div>
<div class="bodynav">
<div class="boxedicon">
<h2>Navigate:</h2>
</div>
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
<div class="bodytalk">

<h1>Menu:</h1>
</div>
<p>We only have 5 chicken legs per 7 days per week!
	Each cost only $15.99 US dollars.
	Stock is limited!
</p>
</div>

<div class="twitternav">

<a class="twitter-timeline" data-width="100%" data-height="200" data-tweet-limit="4" data-theme="dark"   data-chrome="nofooter noborders" href="https://twitter.com/fake_Student419">Tweets by fake_Student419</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
</div>


</br>
</body>
</html>
