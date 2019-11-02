<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
<?php
	include 'include/db_credentials.php';
	
	# Let's make a connection to the database
	$connection = mysqli_connect($server, $username, $password, $database);
	echo("<h1>Connecting to database.</h1>");
	# If there is no connection made we can quit, as there is an error
	if (!$connection) {
		die("Connection failed: " . mysqli_connect_error());
	}
	echo "Connected successfully";
	
	# Let's import our database file
	$fileName = "./data/orderdb_sql.ddl";
	# Import the data from the file
	$file = file_get_contents($fileName, true);
	# Create an array of all of the file contents
	$lines = explode(";", $file);
	echo("<p>foobar"+$lines[0]+"</p>");

	echo("<ol>");
	# For each line in the file
	foreach ($lines as $line){
		# Trime the line
		$line = trim($line);
		# As long as the line isn't blank
		if($line != ""){
			# Print it out in a list
			echo("<li>".$line . ";</li><br/>");
			# Run a query on the line
			$result = mysqli_query($connection, $line);
			if($result == FALSE){
				printf("error: %s\n", mysqli_error($connection));
			}
		}
	}

	# Finally let's close this connection
	mysqli_close($connection); 
	echo("</p><h2>Database loading complete!</h2>");
?>
</body>
</html>