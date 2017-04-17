<?php
/*
$servername = "db.soic.indiana.edu";
$username = "caps16_team46";
$password = "my+sql=caps16_team46";
$dbname = "caps16_team46";

// Create connection
$con = mysqli_connect($servername, $username, $password, $dbname);
*/
include("Config.php");
   $con = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

// Check connection
if (mysqli_connect_errno()) 
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error(); 
} 
$loginname = mysqli_real_escape_string($con,$_POST['loginname']);
$password = mysqli_real_escape_string($con,$_POST['password']);


$sql = "SELECT hashword FROM hashLogin 
		WHERE loginname = '$loginname'
		LIMIT 1";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
	$note = $row["hashword"];
    }
} else {
    echo "0 results";
}
//comparing passwords
	if(password_verify($password,$note))
	{
		echo "Yes,</br> user found";
	}
	else{    
		echo "User found</br>";
		echo "Wrong password</br>";
	}
	
mysqli_close($con);
?>