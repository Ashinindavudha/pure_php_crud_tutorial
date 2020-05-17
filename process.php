<?php 

session_start(); // for alert message
$mysqli = new mysqli('localhost', 'root', '', 'php_crud') or die(mysqli_error($mysqli)); // database connection
$id = 0;
$update = false;
$name = '';
$location = '';
if (isset($_POST['save'])) { //start data check
	$name = $_POST['name'];
	$location = $_POST['location']; // end data check 

	
	$mysqli->query("INSERT INTO data (name, location) VALUE('$name', '$location')") or die($mysqli->error); // insert data into database 

	$_SESSION['message'] = "Record has been saved!"; // alert message
	$_SESSION['msg_type'] = "success";

	header("location: index.php"); // for page reload

}

//for delete button

//data check
if (isset($_GET['delete'])) {
	$id = $_GET['delete'];
	$mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error()); 
	$_SESSION['message'] = "Your Data has been Deleted!"; // alert message
	$_SESSION['msg_type'] = "danger";

	header("location: index.php"); // for page reload
}

if (isset($_GET['edit'])) {
	$id = $_GET['edit'];
	$update = true;
	$result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());
	if (count($result)==1) {
		$row = $result->fetch_array();
		$name = $row['name'];
		$location = $row['location'];	
	}
}

if (isset($_POST['update'])) {
	$id = $_POST['id'];
	$name = $_POST['name'];
	$location = $_POST['location'];
	$mysqli->query("UPDATE data SET name='$name', location='$location' WHERE id=$id") or die($mysqli->error);
	header("location: index.php"); // for page reload

}
?> 