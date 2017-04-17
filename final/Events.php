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
<title>Dan's Kung Pow Chicken: Events</title>
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

<form action=""  method="post" id="eventForm">
Title:<input type="text" name="Etitle" size="30"  value="John"/><br>
Date:<input type="date" name="Edate" /><br>
Search:<input type="checkbox" name="Search"/><br>

<input type="submit"></br>
</form>
<?php
	// Check connection
	if (mysqli_connect_errno()) 
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error(); 
	} 
	if(foo){
		
	}
	else{
		
	}

	if($_SERVER["REQUEST_METHOD"] == "POST") 
	{

		$Etitle = mysqli_real_escape_string($con,$_POST['Etitle']);
		$Edate = mysqli_real_escape_string($con,$_POST['Edate']);
		//$Edisplay = mysqli_real_escape_string($con,$_POST['Edisplay']);
		echo "searching for $Etitle or $Edate.";
		$sql = "SELECT id ,title, location, eventDate, description FROM eventTable WHERE eventDate = '$Edate' OR title = '$Etitle'";
		if(!mysqli_query($con,$sql))
		{
		die('Error basic code:' .mysqli_error());
		}

		$result = $con->query($sql);

		if ($result->num_rows > 0) {
			echo "<table border = '1'>
			<tr>
				<th>id</th>
				<th>title</th>
				<th>location</th>
				<th>eventDate</th>
				<th>description</th>

			</tr>";
			// output data of each row
			while($row = $result->fetch_assoc()) {

				
				echo 
				"<tr><td>".$row["id"].
				"</td><td>".$row["title"].
				"</td><td>".$row["location"].
				"</td><td>".$row["eventDate"].		
				"</td><td>".$row["description"].
				"</td></tr>";
				
			}
			echo "</table>";
		} else {
			echo "0 results";
		}


		
	}
	else
	{
		echo "searching for all.";
		$sql = "SELECT id ,title, location, eventDate, description FROM eventTable";
		


		if(!mysqli_query($con,$sql))
		{
		die('Error basic code:' .mysqli_error());
		}

		$result = $con->query($sql);

		if ($result->num_rows > 0) {
			echo "<table border = '1'>
			<tr>
				<th>id</th>
				<th>title</th>
				<th>location</th>
				<th>eventDate</th>
				<th>description</th>

			</tr>";
			// output data of each row
			while($row = $result->fetch_assoc()) {

				
				echo 
				"<tr><td>".$row["id"].
				"</td><td>".$row["title"].
				"</td><td>".$row["location"].
				"</td><td>".$row["eventDate"].		
				"</td><td>".$row["description"].
				"</td></tr>";
				
			}
			echo "</table>";
		} else {
			echo "0 results";
		}

	}
mysqli_close($con);
?>
<p>This is a paragraph.</p>
</div>

<div class="twitternav">

<a class="twitter-timeline" data-width="100%" data-height="200" data-tweet-limit="4" data-theme="dark"   data-chrome="nofooter noborders" href="https://twitter.com/fake_Student419">Tweets by fake_Student419</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
</div>


</br>
</body>
</html>
