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

$Etitle = mysqli_real_escape_string($con,$_POST['Etitle']);
$Edate = mysqli_real_escape_string($con,$_POST['Edate']);
//$Edisplay = mysqli_real_escape_string($con,$_POST['Edisplay']);

if(isset($_POST['Search'])){
	$Esearch = 1;
}else{
	$Esearch = 0;
}

if($Esearch == 1){
	echo "searching for $Etitle or $Edate.";
	$sql = "SELECT id ,title, location, eventDate, description FROM eventTable WHERE eventDate = '$Edate' OR title = '$Etitle'";
}else{
	echo "searching for all.";
	$sql = "SELECT id ,title, location, eventDate, description FROM eventTable";
	

}




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


mysqli_close($con);
?>