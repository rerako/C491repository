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
<title>Dan's Kung Pow Chicken: Events</title>
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
	</div>	</div>
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

<h1>Events:</h1>
</div>
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
		
		//add event HERE
				echo "<div class='bodyV'>";
				echo "<h2>Create new Event:</h2>";
				echo "<form action=''  method='post' id='addeventForm'>";
				echo "Title:<input type='text' name='Etitle' size='30'/><br>";
				echo "Location:<input type='text' name='Elocate' size='30'/><br>";
				echo "Description:<br>";
				echo "<textarea name='Edescript' form='eventForm'></textarea><br>";
				echo "Date:<input type='date' name='Edate'/><br>";
				echo "Display:<input type='checkbox' name='Edisplay'/><br>";
				echo "<input type='submit' name='form4'></br>";
				echo "</form></div>";
		
		if(isset($_POST["form4"]))
			{
				if($_SERVER["REQUEST_METHOD"] == "POST") 
				{
					$Etitle = mysqli_real_escape_string($con,$_POST['Etitle']);
					$Elocate = mysqli_real_escape_string($con,$_POST['Elocate']);
					$Edescript = $_POST['Edescript'];
					$Edate = mysqli_real_escape_string($con,$_POST['Edate']);
					if(isset($_POST['Edisplay'])){
						$Edisplay = 1;
					}else{
						$Edisplay = 0;
					}
					if(empty($Etitle)){
						$valid = false;
						echo "no time";
					}
					if(empty($Elocate)){
						$valid = false;
						echo "no location";
					}
					if(empty($Edescript)){
						$valid = false;
						echo "no description";
					}
					if(empty($Edate)){
						$valid = false;
						echo "no date";
					}
					if($valid){
					$sql4 ="INSERT INTO eventTable (title, location, eventDate, display, description) 
					VALUES( '$Etitle' ,'$Elocate','$Edate', '$Edisplay', '$Edescript')";
					
					
					

					//check for error

					if(!mysqli_query($con,$sql4))
					{
						die('Error basic code:' .mysqli_error());
					}
					echo "Event added";
					}

					
				}
			}
		
		
		
		
		
		
		
		
		
		
		
		$sql = "SELECT id ,title, location, eventDate, description, display FROM eventTable";
		


		if(!mysqli_query($con,$sql))
		{
		die('Error basic code:' .mysqli_error());
		}

		$result = $con->query($sql);
		
		if ($result->num_rows > 0) 
		{
			// output data of each row
			while($row = $result->fetch_assoc()) {
				echo "<div class='bodyV'>";
				echo "ID: ".$row[id]."<br>";
				echo "<form action=''  method='post' id='eventForm'>";
				echo "Title:<input type='text' name='Etitle' size='30'  value='$row[title]'/><br>";
				echo "Location:<input type='text' name='Elocate' size='30'  value='$row[location]'/><br>";
				echo "Description:<br>";
				echo "<textarea name='Edescript' form='eventForm'>".$row[description]."</textarea><br>";
				echo "Date:<input type='date' name='Edate'/><br>";
				echo "Display:<input type='checkbox' name='Edisplay'/><br>";
				echo "Delete This?:<input type='checkbox' name='Edelete'/><br>";
				echo "<input type='number' name='Eid' value='$row[id]'/><br>";
				echo "Edit: <input type='submit' name='form1'></br>";
				echo "</form></div>";
			
			}
		
			
			if(isset($_POST["form1"]))
			{
				if($_SERVER["REQUEST_METHOD"] == "POST") 
				{
					
					$valid = true;
					
					$Etitle = mysqli_real_escape_string($con,$_POST['Etitle']);
					$Elocate = mysqli_real_escape_string($con,$_POST['Elocate']);
					$Edescript = $_POST['Edescript'];
					$Edate = mysqli_real_escape_string($con,$_POST['Edate']);
					if(isset($_POST['Edelete'])){
						$Edelete = true;
					}
					else{
						$Edelete = false;

					}
					$Eid = mysqli_real_escape_string($con,$_POST['Eid']);
					if(empty($Etitle)){
						$valid = false;
						echo "no time";
					}
					if(empty($Elocate)){
						$valid = false;
						echo "no location";
					}
					if(empty($Edescript)){
						$valid = false;
						echo "no description";
					}
					if(empty($Edate)){
						$valid = false;
						echo "no date";
					}
					if(isset($_POST['Edisplay'])){
						$Edisplay = 1;
					}else{
						$Edisplay = 0;
					}

					if($valid ||$Edelete )
					{
						if($Edelete)
						{
							$sql2="DELETE from eventTable where id = '$Eid'";
							
							if(!mysqli_query($con,$sql2))
							{
							die('Error basic code:' .mysqli_error());
							}
							echo "Event changed #: '$Eid'";
						}
						else
						{
								/*
							$sql2 = "UPDATE eventTable 
							SET title = '$Etitle' , location = '$Elocate', eventDate = '$Edate', display = '$Edisplay', description = '$Edescript'
							WHERE id = '$Eid'";*/
							$sql2="DELETE from eventTable where id = '$Eid'";
							if(!mysqli_query($con,$sql2))
							{
							die('Error basic code:' .mysqli_error());
							}
							echo "Event changed #: '$Eid'";
							$sql2 =" INSERT INTO eventTable (title, location, eventDate, display, description) 
							VALUES( '$Etitle' ,'$Elocate','$Edate', '$Edisplay', '$Edescript')";
							
							if(!mysqli_query($con,$sql2))
							{
							die('Error basic code:' .mysqli_error());
							}
							echo "Event changed #: '$Eid'";
						
						}
						
					}

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
		if(isset($_POST["search"]) && $_SERVER["REQUEST_METHOD"] == "POST") 
		{

			$Etitle = mysqli_real_escape_string($con,$_POST['Etitle']);
			$Edate = mysqli_real_escape_string($con,$_POST['Edate']);
			//$Edisplay = mysqli_real_escape_string($con,$_POST['Edisplay']);
			echo "searching for $Etitle or $Edate.";
			$sql3 = "SELECT id ,title, location, eventDate, description FROM eventTable WHERE (eventDate = '$Edate' OR title = '$Etitle') AND display = 1";
			if(!mysqli_query($con,$sql3))
			{
			die('Error basic code:' .mysqli_error());
			}

			$result = $con->query($sql3);

			if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
					echo "<div class='bodyV'>";
					echo "Event#: ".$row[id]."";
					echo "<div class='boxed'>";
					echo "<h1> Event Title: " .$row['title']. "</h1>";
					echo "</div>";
					echo "Location: '$row[location]' </br>";
					echo "Date: '$row[eventDate]'</br>";
					echo "<div class='boxed'>";
					echo "<h3> Event Description: </h3>";
					echo "".$row[description]."</br>";
					echo "</div>";
					echo "</div>";
					
				}
				echo "</table>";
			} else {
				echo "0 results";
			}


			
		}
		else
		{
			
			$sql3 = "SELECT id ,title, location, eventDate, description FROM eventTable WHERE display = 1";
			


			if(!mysqli_query($con,$sql3))
			{
			die('Error basic code:' .mysqli_error());
			}

			$result = $con->query($sql3);

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
