<?php
	session_start();

		$uid="";
		$timestamp="";
		$id='';
		$msg='';
		if (isset($_SESSION['login'])) {

			$uid=$_SESSION['login'];
			$conn=mysqli_connect('localhost','root','','myBlog');

			if (isset($_POST['title']) && isset($_POST['body']) && isset($_POST['submit'])) {

				$postImg="uploadBlog/".basename($_FILES['blogimg']['name']);
				$blogimg=$_FILES['blogimg']['name'];
				$title=$_POST['title'];
				$body=$_POST['body'];
				$sql="insert into blog(uid,title,body,blogimg) values('$uid','$title','$body','$blogimg')";
				mysqli_query($conn,$sql);
				if (move_uploaded_file($_FILES['blogimg']['tmp_name'], $postImg)) {
					$msg = "image upload Successfully";
				}else{
					$msg = "some error occured";
				}

			}

		}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>MyBlog | Blog</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="icon/logo.png">
	<!--Font Awesome Icons-->
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>


	<!--Navigation bar-->

	<?php
		$page=2;
		include 'header.php';
	?>

	<!--Blog part-->

	<div class="header">
		<h2 style="color: #f1f1f1; text-shadow: 4px 4px #FF0000;">TechBlog</h2>
	</div>

	<?php

		$conn=mysqli_connect('localhost','root','','myBlog');
		$sqls="select users.name,blog.title,blog.body,blog.timestamp,blog.blogimg from users,blog where blog.uid=users.id";
		$results=mysqli_query($conn,$sqls);
		while($row=mysqli_fetch_assoc($results)) {
	?>
	
		<div class="leftcolumn">
			<div class="card" style="background-color: #dbd4d4; border-radius: 10px;">
				<h2><?php echo $row['title']; ?></h2>
				<h5>Posted By, <?php echo $row['name']; ?> </h5>
				<h5><?php echo $row['timestamp']; ?></h5>
				<img src="uploadBlog/<?php echo $row['blogimg']; ?>" height=200 id="fakeimg" alt="">
				<p><?php echo $row['body']; ?></p>
				<!--<span><a href="#" id="like" style="text-decoration: none; background: #34495e; color: white; border-radius: 5px; padding: 7px;">like</a></span>-->
			</div>
		</div>

		<?php
		}
		?>

		<?php

		if (isset($_SESSION['login'])) { ?>
			<div class="rightcolumn" style="margin-left: 71%;">
				<form action="blog.php" method="POST" enctype="multipart/form-data">
				    <h2>What is on your mind?</h2>
				    <h3>Title</h3>
				    <textarea name="title" cols="63" rows="2"></textarea>
					<h3>Body</h3>
					<textarea name="body" cols="63" rows="6"></textarea>
					<input type="hidden" name="size" value="1000000">
					<div>
						<input type="file" name="blogimg">
					</div>
					<input class="submitPost" type="submit" name="submit" value="Submit">
				</form>
			</div>
			
		<?php
		}
		?>

		<!-- Add jquery for like unlike post 

	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			//when the user clicks on like
			$('#like').click(function(){
				alert("you have liked");
			});
		});

	</script>-->

</body>
</html>