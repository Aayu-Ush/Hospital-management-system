<?php
include'connect.php';
if(isset($_GET['deleteid'])){
	$id=$_GET['deleteid'];

	$sql="DELETE FROM appointments WHERE id=$id";
	$result=mysqli_query($conn,$sql);
	if($result){
		header('location:appointments.php');
	}
	else{
		die(mysqli_error($conn));
	}
}
?>