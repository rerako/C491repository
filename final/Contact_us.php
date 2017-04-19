<?php 

session_start();
//Verify login user else back to login screen
if(!isset($_SESSION['login_user'])){
	//header("location:login.php");
	$foo = False;
   }
   else{
	   	$foo = True;

   }
function test_input($data) {
  $data = htmlspecialchars($data);
  $data = trim($data);
  $data = stripslashes($data);
  
  return $data;
}
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
?>

<html>
<head>
<title>Dan's Kung Pow Chicken: Contact Us</title>
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
		</div>
	</div>
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

<h1>Shop Location: </h1>
</div>
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3093.221235770528!2d-86.53614158456968!3d39.16969097952955!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x886c66dc13b64b9d%3A0x92447861fa38dd93!2s403+N+Walnut+St%2C+Bloomington%2C+IN+47404!5e0!3m2!1sen!2sus!4v1491332142007" width= "100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
<div class="bodytalk">

<h1>Contact Us:</h1>
</div>
<div class="bodyL">
<?php 
if($foo)
{
	echo '<br>Contact Search:';

}
else{
	echo '<br>Vip Subscribe:';

}
?>
<form action=""  method="post">
Firstname:<input type="text" name="firstname" /><br>
Lastname:<input type="text" name="lastname" /><br>
Email:<input type="email" name="email"><br>
DOB:<input type="date" name="DOB"><br>
<input type="submit" name="form1"></br>
</form>
<?php
include("Config.php");

if($foo)
	{
		if(isset($_POST["form1"]))
		{
			if($_SERVER["REQUEST_METHOD"] == "POST") 
			{
				$firstname = mysqli_real_escape_string($con,$_POST['firstname']);
				$lastname = mysqli_real_escape_string($con,$_POST['lastname']);
				$email = mysqli_real_escape_string($con,$_POST['email']);
				$sql = "SELECT LastName, FirstName, Email, DOB FROM vipList WHERE LastName = '$lastname' OR FirstName = '$firstname' OR Email = '$email'";
				
			}
			else{
				$sql = "SELECT LastName, FirstName, Email, DOB FROM vipList";
			}
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
			} 
			else {
				echo "0 results";
			}
		}

	}
	else
	{
		if(isset($_POST["form1"]))
		{
			if($_SERVER["REQUEST_METHOD"] == "POST") 
			{
				$valid = True;
				$lastname = mysqli_real_escape_string($con,$_POST['lastname']);
				$firstname = mysqli_real_escape_string($con,$_POST['firstname']);
				$email = mysqli_real_escape_string($con,$_POST['email']);
				$DOB = mysqli_real_escape_string($con,$_POST['DOB']);
				
				if (empty($firstname)) {
					$nameErr = "Name is required ";
					$valid = False;
					}
					else 
					{
						$name = test_input($firstname);
						// check if name only contains letters and whitespace
						if (!preg_match("/^[a-zA-Z ]*$/",$name)) 
						{
							$valid = False;
							$nameErr = "Only letters and white space allowed "; 
						}
					}
				  if (empty($lastname)) {
					$LnameErr = "Last Name is required ";
					$valid = False;
					}
					else 
					{
						$lname = test_input($lastname);
						// check if name only contains letters and whitespace
						if (!preg_match("/^[a-zA-Z ]*$/",$lname)) 
						{
							$valid = False;
							$LnameErr = "Only letters and white space allowed"; 
						}
					}
			  if (empty($email)) 
			  {
					$valid = False;

					$emailErr = "Email is required ";
			  } 
			  else 
			  {
				// check if e-mail address is well-formed
					if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
					{
					$emailErr = "Invalid email format"; 
					$valid = False;

					}
					
			  }
			  
			if($valid)
			  {
				if (mysqli_connect_errno()) 
				{
					echo "Failed to connect to MySQL: " . mysqli_connect_error(); 
				} 
				


				$sql="INSERT INTO vipList (LastName, FirstName, Email, DOB)
				VALUES ('$lastname', '$firstname', '$email','$DOB')";
				//check for error
				if(!mysqli_query($con,$sql))
				{
				die('Error basic code:' .mysqli_error());
				}
				echo "New Contact added";
			  }
			  else{
					echo "FirstName: '$nameErr'";
					echo "LastName: '$LnameErr'";
					echo "Email: '$emailErr'";

			  }


			}
		}
		
	}
	mysqli_close($con);
?>
</div>
<div class="bodyR">
<p>Leave a Message:</p>
<form action=""  method="post" id="messageForm">
Email:<input type="email" name="email">
<br>Message:<br>
<textarea name="message" form="messageForm">Enter text here...</textarea><br>
<input type="submit" name="form2"></br>
</form>
<?php 
include("Config.php");
if(isset($_POST["form2"]))
{
	if($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		$valid = True;
		$email = mysqli_real_escape_string($con,$_POST['email']);
		$message = mysqli_real_escape_string($con,$_POST['message']);
		if (empty($email)) 
		{
					$valid = False;

					$emailErr = "Email is required! ";
		} 
		if (empty($message)) 
		{
					$valid = False;
					$messageErr = "No message typed! ";
		}  
		if($valid)	  
		{
			$sql="INSERT INTO messageTable (email, message)
			VALUES ('$email', '$message')";
			//check for error

			if(!mysqli_query($con,$sql))
			{
			die('Error basic code:' .mysqli_error());
			}
			echo "Message Sent";

		}
		else
		{
			echo "Email: '$emailErr'";
			echo "Message: '$LnameErr'";
		}


	}
}
?>
</div>
</div>

<div class="twitternav">

<a class="twitter-timeline" data-width="100%" data-height="200" data-tweet-limit="4" data-theme="dark"   data-chrome="nofooter noborders" href="https://twitter.com/fake_Student419">Tweets by fake_Student419</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
</div>


</br>
</body>
</html>
