<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    	$name = htmlspecialchars($_POST['name']);
    	$location = htmlspecialchars($_POST['location']);

	$servername = "localhost";
	$username = "root";
	$password = "password";
	$dbname = "Myproject1";
	$conn = new mysqli($servername,$username,$password,$dbname);
	if($conn->connect_error)
	{
    		die("connection failed" . $conn->connect_error);
	}
	$sql = "INSERT INTO mytable1 (name,location) VALUES('$name','$location')";
	if($conn->query($sql))
	{
    		echo "Created successfully"; 
	}    

	else
	{
    		echo "Something went wrong" . $sql . "<br>" . $conn->error;
	}
    	echo "<h2>Registration Successful!</h2>";
    	echo "name: <strong>" . $name . "</strong><br>";
    	echo "location: <strong>" . $location . "</strong><br>";
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    	<meta charset="UTF-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<title>Simple Registration Form</title>
</head>


<body>
    	<h1>Registration Form</h1>
	<form action="index.php" method="POST">
        		<label for="name">Name:</label>
	        	<input type="text" id="name" name="name" required><br><br>
		<label for="location">Location:</label>
	        	<input type="loaction" id="location" name="location" required><br><br>
		<input type="submit" value="Register">
    	</form>
</body>
</html>
