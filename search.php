<?php 
$output = NULL;
if (isset($_POST['submit'])) {
	//connection to the database
$mysqli = new mysqli('localhost', 'root', '', 'php_crud') or die(mysqli_error($mysqli)); // database connection

$search = $mysqli->real_escape_string($_POST['search']) ;

// Query the Database
$resultSet = $mysqli->query("SELECT * FROM data WHERE name LIKE '%$search'");
if ($resultSet->num_rows > 0) {
	while ($rows = $resultSet->fetch_assoc()) {
	    $name = $rows['name'];
	    $location = $rows['location'];
	    $output .= "Name: $name <br /> location: $location";
	}
}else {
	echo $output = "No Result";
}

}
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Search</title>
</head>
<body>
	<form action="" method="post">
		<input type="text" name="search">

		<input type="submit" name="submit" value="Search">
	</form>
	<?php echo $output; ?>
</body>
</html>