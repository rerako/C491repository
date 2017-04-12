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

$lastname = mysqli_real_escape_string($con,$_POST['lastname']);
$firstname = mysqli_real_escape_string($con,$_POST['firstname']);

$email = mysqli_real_escape_string($con,$_POST['email']);
$DOB = mysqli_real_escape_string($con,$_POST['DOB']);

$sql="INSERT INTO vipList (LastName, FirstName, Email, DOB)
VALUES ('$lastname', '$firstname', '$email','$DOB')";
//check for error
if(!mysqli_query($con,$sql))
{
die('Error basic code:' .mysqli_error());
}
echo "New record added";


$sql = "SELECT LastName, FirstName, Email, DOB FROM vipList";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    echo "<table border = '1'>
	<tr>
		<th>last_name</th>
		<th>first_name</th>
		<th>email</th>
		<th>date</th>

	</tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo 
		"<tr><td>".$row["LastName"].
		"</td><td>".$row["FirstName"].
		"</td><td>".$row["Email"].
		"</td><td>".$row["DOB"].

		"</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}


mysqli_close($con);
?>