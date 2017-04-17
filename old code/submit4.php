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
$loginname = mysqli_real_escape_string($con,$_POST['loginname']);
$hashword = mysqli_real_escape_string($con,$_POST['hashword']);

$hash = password_hash($hashword,PASSWORD_BCRYPT,$options);
$sql="INSERT INTO hashLogin (loginname, hashword)
VALUES ('$loginname', '$hash')";
//check for error
if(!mysqli_query($con,$sql))
{
die('Error basic code:' .mysqli_error());
}
echo "New password added";



mysqli_close($con);
?>