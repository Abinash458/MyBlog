<?php

	if (isset($_GET['id'])) {
		$id=$_GET['id'];
		$conn=mysqli_connect('localhost','root','','myBlog');
		$sql="delete from blog where id='$id'";
		$result=mysqli_query($conn,$sql);
	}
	header('Location: profile.php');
?>