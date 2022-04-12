<!DOCTYPE html>
<html>
<head>
	<title>Create</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<?php require_once 'process.php';?>

<?php
if (isset($_SESSION['message'])):?>

<div class = "alert alert-<?=$_SESSION['msg_type']?>">

	<?php
		echo $_SESSION['message'];
		unset($_SESSION['message'])	;
	?>	
</div>
<?php endif ?>	

<div class = "container">

<?php
	$mysqli = new mysqli('localhost','root','','crudoperation') or die (mysqli_error($mysqli));
	$result = $mysqli->query("SELECT*FROM crud") or die($mysqli->error);
	//pre_r($result);
	
	?>
	
	<div class="row justify-content-center">
		<table class = "table">
			<thead>
				<tr>
					<th>NAME</th>
					<th>LOCATION</th>
					<th colspan = "2">ACTION</th>
			</thead>
	<?php
			while ($row = $result->fetch_assoc()):?>
				<tr>
					<td><?php echo $row ['name'];?></td>
					<td><?php echo $row ['location'];?></td>
					<td>
						<a href="index.php?edit=<?php echo $row['id'];?>"
							class = "btn btn-info">Edit</a>	
						<a href="process.php?delete=<?php echo $row['id'];?>"
							class = "btn btn-danger">Delete</a>	
					</td>
				</tr>
			<?php endwhile;?>
			</table>
	</div>
	<?php	
	function pre_r($array){
		echo '<pre>';
		print_r($array);
		echo '</pre>'; 
	}
?>

<div class="row justify-content-center">
  <form action="process.php" method="POST">	
  <input type = "hidden" name="id" value ="<?php echo $id;?>">
    <div class="form-group">
      <label>Name</label>
      <input type="text" class="form-control" value="<?php echo $name; ?>" placeholder="Enter Name" name="name">
    </div>
    <div class="form-group">
      <label>Location</label>		
      <input type="text" class="form-control" value="<?php echo $location; ?>" placeholder="Enter Location" name="location">
    </div>
	<div class="form-group">
	<?php
	if($update == true):	
	?>
	<button type="submit" class="btn btn-info" name="update">Update</button>
	<?php else: ?>
    <button type="submit" class="btn btn-primary" name="save">Save</button>
	<?php endif;?>
	</div>
  </form>
</div>	
</body>
</html>
