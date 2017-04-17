<?php
$servername = "db.soic.indiana.edu";
$username = "caps16_team46";
$password = "my+sql=caps16_team46";
$dbname = "caps16_team46";

// Create connection
$con = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (mysqli_connect_errno()) 
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error(); 
} 


echo "<form action='search.php'  method='post' id='eventForm'>";
echo "Title:<input type='text' name='Etitle' size='30'  value='John'/><br>";
echo "Date:<input type='date' name='Edate' /><br>";
echo "Search:<input type='checkbox' name='Search'/><br>";
echo "<input type='submit' name='submit' value='submit'></br>";
echo "</form>";


mysqli_close($con);
?>