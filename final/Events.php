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
		echo '<input type="submit" name="log"></br>';
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
<p>Searching: </p>
<div class="bodyV">
<form action=""  method="post" id="eventForm">
Title:<input type="text" name="Etitle" size="30"  value="John"/><br>
Date:<input type="date" name="Edate" /><br>
Search:<input type="checkbox" name="Search"/><br>

<input type="submit" name="search"></br>
</form>
</br>
</div>

<?php
	// Check connection
	if (mysqli_connect_errno()) 
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error(); 
	} 
	if($foo)
	{
		
		$sql = "SELECT id ,title, location, eventDate, description, display FROM eventTable";
		


		if(!mysqli_query($con,$sql))
		{
		die('Error basic code:' .mysqli_error());
		}

		$result = $con->query($sql);
		
		if ($result->num_rows > 0) {
			

			// output data of each row
			while($row = $result->fetch_assoc()) {
				echo "<div class='bodyV'>";
				echo "ID: '$row[id]'<br>";
				echo "<form action=''  method='post' id='eventForm'>";
				echo "Title:<input type='text' name='Etitle' size='30'  value='$row[title]'/><br>";
				echo "Location:<input type='text' name='Elocate' size='30'  value='$row[location]'/><br>";
				echo "Description:<br>";
				echo "<textarea name='Edescript' form='eventForm'>'$row[description]'</textarea><br>";
				echo "Display:<input type='checkbox' name='Edisplay'/><br>";
				echo "<input type='number' name='Eid' value='$row[id]'/><br>";
				echo "<input type='submit' name='form1'></br>";
				echo "</div>";
			
			}
		
			
			if(isset($_POST["form1"]))
			{
				if($_SERVER["REQUEST_METHOD"] == "POST") 
				{
					$Etitle = mysqli_real_escape_string($con,$_POST['Etitle']);
					$Elocate = mysqli_real_escape_string($con,$_POST['Elocate']);
					$Edescript = mysqli_real_escape_string($con,$_POST['Edescript']);
					$Edate = mysqli_real_escape_string($con,$_POST['Edate']);
					if(isset($_POST['Edisplay'])){
						$Edisplay = 1;
					}else{
						$Edisplay = 0;
					}
					$Eid = mysqli_real_escape_string($con,$_POST['Eid']);
					$sql="
					UPDATE eventTable 
					SET title = '$Etitle' , location = '$Elocate', eventDate = '$Edate', display = '$Edisplay', description = '$Edescript'
					WHERE id = '$Eid'";
					//check for error

					if(!mysqli_query($con,$sql))
					{
					die('Error basic code:' .mysqli_error());
					}
					echo "Event changed";
					
				}
			}
			
		} 
		else 
		{
			echo "0 results";
		}
		
	}
	else
	{
		if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["search"])) 
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
			
			$sql = "SELECT id ,title, location, eventDate, description FROM eventTable WHERE display = 1";
			


			if(!mysqli_query($con,$sql))
			{
			die('Error basic code:' .mysqli_error());
			}

			$result = $con->query($sql);

			if ($result->num_rows > 0) {
				/*
				echo "<table border = '1'>
				<tr>
					<th>id</th>
					<th>title</th>
					<th>location</th>
					<th>eventDate</th>
					<th>description</th>

				</tr>";*/
				// output data of each row
				while($row = $result->fetch_assoc()) {
					echo "<div class='bodyV'>";
					echo "<p>Event Title:'$row[title]'</p>";
					echo "<p>Date:'$row[eventDate]'</p>";
					echo "Location: '$row[location]'</br>";
					echo "<p>Description: </p>";
					echo "<p>	'$row[description]'</p></br>";
					echo "</div>";
					/*
					 echo
					"<tr><td>".$row["id"].
					"</td><td>".$row["title"].
					"</td><td>".$row["location"].
					"</td><td>".$row["eventDate"].		
					"</td><td>".$row["description"].
					"</td></tr>";
					*/
				}
				echo "</table>";
			} else {
				echo "0 results";
			}

		}
	}


mysqli_close($con);
?>

</div>

<div class="twitternav">

<a class="twitter-timeline" data-width="100%" data-height="200" data-tweet-limit="4" data-theme="dark"   data-chrome="nofooter noborders" href="https://twitter.com/fake_Student419">Tweets by fake_Student419</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
</div>


</br>
</body>
</html>
