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

function checkStatus()
{

    $result = mysql_query(
        "SELECT * FROM test 
WHERE LastName = '$lastname' and FirstName = '$firstname' and Email = '$email'
LIMIT 1");

    if(mysql_fetch_array($result) !== false){
		        echo 'Found';
	}
	else{
		    echo 'not Found';
	}
}

checkStatus();
//check for error
/*
if(!mysqli_query($con,$sql))
{
die('Error basic code:' .mysqli_error());
}
echo "record found";
*/



mysqli_close($con);
?>