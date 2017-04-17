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
$options = ['cost' => 11,];
$Etitle = mysqli_real_escape_string($con,$_POST['Etitle']);
$Elocate = mysqli_real_escape_string($con,$_POST['Elocate']);
$Edescript = mysqli_real_escape_string($con,$_POST['Edescript']);
$Edate = mysqli_real_escape_string($con,$_POST['Edate']);
//$Edisplay = mysqli_real_escape_string($con,$_POST['Edisplay']);
if(isset($_POST['Edisplay'])){
	$Edisplay = 1;
}else{
	$Edisplay = 0;
}


$sql="INSERT INTO eventTable (title, location, eventDate, display, description)
VALUES ('$Etitle', '$Elocate', '$Edate', '$Edisplay', '$Edescript')";
//check for error

if(!mysqli_query($con,$sql))
{
die('Error basic code:' .mysqli_error());
}
echo "new event added";


$sql = "SELECT id ,title, location, eventDate, description  FROM eventTable ORDER BY eventDate";
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
		echo "<form action="search.php"  method="post" id="eventForm">
			Title:<input type="text" name="Etitle" size="30"  value="John"/><br>
			Date:<input type="date" name="Edate" /><br>
			Search:<input type="checkbox" name="Search" value="<?php echo date('Y-m-d'); ?>"/><br>
			<input type="submit"></br>
			</form>";
    }
    echo "</table>";
} else {
    echo "0 results";
}


mysqli_close($con);
?>