<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>PHP CRUD APPLICATION</title>
	<link rel="stylesheet" href="asset/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<?php require_once 'process.php'; ?>

		<!-- message alert start -->
<?php if (isset($_SESSION['message'])): ?>

<div class="alert alert-<?=$_SESSION['msg_type']?>">
	<?php echo $_SESSION['message'];
	unset($_SESSION['message']);
	 ?>
</div>
<?php endif ?>
<!-- message alert end -->
		<?php 
$mysqli = new mysqli('localhost', 'root', '', 'php_crud') or die(mysqli_error($mysqli)); // database connection
$result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
//pre_r($result); 
//pre_r($result->fetch_assoc()); 
//pre_r($result->fetch_assoc()); 
?>
<div class="row justify-content-center">
	<table class="table">
		<thead>
			<tr>
				<th>Name</th>
				<th>Location</th>
				<th colspan="2">Action</th>
			</tr>
		</thead>
		<?php 
		while ($row = $result->fetch_assoc()): 
			?>
			<tr>
				<td><?php echo $row['name']; ?></td>
				<td><?php echo $row['location']; ?></td>
				<td>
					<a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-info" >Edit</a>
					<a href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
				</td>

			</tr>
		<?php endwhile; ?>
	</table>

</div>
<?php
function pre_r($array)
{
	echo '<pre>';
	print_r($array);
	echo '</pre>';
}
?>
<div class="row justify-content-center">
	<form action="process.php" method="POST">
		<input type="hidden" name="id" value="<?php echo $id; ?>">
		<div class="form-group">
			<label for="name">Name</label>
			<input type="text" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="Enter Your Name">
		</div>
		<div class="form-group">
			<label for="location">Location</label>
			<input type="text" class="form-control" name="location" value="<?php echo $location; ?>" placeholder="Enter Your Location">
		</div>
		<div class="form-group">
			<?php if ($update == true): ?>
			<button type="submit" class="btn btn-info" name="update">Update</button>
			<?php else: ?>
			<button type="submit" class="btn btn-primary" name="save">Save</button>
		<?php endif; ?>
		</div>
	</form>
</div>

</div>
<script src="asset/js/jquery-3.4.1.slim.min.js"></script>
<script src="asset/js/popper.min.js"></script>
<script src="asset/js/bootstrap.min.js"></script>
</body>
</html>