<?php	

session_start();


$mysqli = new mysqli('localhost','root','','crudoperation') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$name = '';
$location = '';


if (isset($_POST['save'])){
	$name = $_POST['name'];
	$location = $_POST['location'];
	$mysqli -> query("INSERT INTO crud(name, location)VALUES('$name','$location')") or die($mysqli->error);
	$_SESSION['message'] = 	"Record has been saved!";
	$_SESSION['msg_type'] =  "Success" ;
	header("location: Index.php");
}	

if (isset($_GET['delete'])){
	$id = $_GET['delete'];
	$mysqli->query("DELETE from crud WHERE id = $id") or die ($mysqli->error());
	
	$_SESSION['message'] = 	"Record has been deleted!";
	$_SESSION['msg_type'] =  "Danger" ;
	
	header("location: Index.php");
}

if (isset($_GET['edit'])){
	$id = $_GET['edit'];
	$update = true;
	$result = $mysqli->query("SELECT * FROM crud WHERE id = $id")or die ($mysqli->error());
	if ($result){
		$row = $result->fetch_array();
		$name = $row['name'];
		$location = $row ['location']; 
	}
} 

if (isset($_POST['update'])){
	$id = $_POST['id'];
	$name = $_POST['name'];
	$location = $_POST['location'];
	$mysqli->query("UPDATE crud SET name='$name',location='$location' WHERE id = $id")or die ($mysqli->error());
	$_SESSION['message'] = 	"Record has been Updated!";
	$_SESSION['msg_type'] =  "warning" ;
	header('location: Index.php');
}