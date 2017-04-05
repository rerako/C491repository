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


$sql = "SELECT LastName, FirstName, Email FROM test";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    echo "<table border = '1'>
	<tr>
		<th>LastName</th>
		<th>FirstName</th>
		<th>Email</th>
	</tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo 
		"<tr><td>".$row["LastName"].
		"</td><td>".$row["FirstName"].
		"</td><td>".$row["Email"].
		"</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
if(!mysqli_query($con,$sql))
{
die('Error basic code:' .mysqli_error());
}
echo "This is all";

mysqli_close($con);
?>