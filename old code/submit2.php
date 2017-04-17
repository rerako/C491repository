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

$firstname = mysqli_real_escape_string($con,$_POST['firstname']);
$lastname = mysqli_real_escape_string($con,$_POST['lastname']);
$email = mysqli_real_escape_string($con,$_POST['email']);

$sql="INSERT INTO test (LastName, FirstName, Email)
VALUES ('$lastname', '$firstname', '$email')";
//check for error
if(!mysqli_query($con,$sql))
{
die('Error basic code:' .mysqli_error());
}
echo "I record added";


$sql = "SELECT LastName, FirstName, Email FROM test";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    echo "<table border = '1'>
	<tr>
		<th>last_name</th>
		<th>first_name</th>
		<th>email</th>
	</tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo 
		"<tr><td>".$row["last_name"].
		"</td><td>".$row["first_name"].
		"</td><td>".$row["email"].
		"</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}


mysqli_close($con);
?>