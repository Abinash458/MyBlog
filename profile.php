<?php
	session_start();

	//profile data get

	$email='';
	$number='';
	$bio='';
	$gender='';
	$dp='';
	$timestamp='';
	$id='';
	$title='';
	$body='';
	$name='';
	if (isset($_SESSION['login'])) {
		$id=$_SESSION['login'];

		//photo upload start
		if (isset($_POST['pic'])) {
			$fileName=$_FILES['dp']['name'];
			if (move_uploaded_file($_FILES['dp']['tmp_name'],'uploads/'.$fileName)) {
				$conn=mysqli_connect('localhost','root','','myBlog');
				$sql1= "update users set dp='$fileName' where id='$id'";
				$results=mysqli_query($conn,$sql1);
				if ($results) {
					echo "Success";
				}
				else{
					echo "error";
				}

			}
			else
				echo "Fail";
		}




		$conn=mysqli_connect('localhost','root','','myBlog');
		$sql= "select name,email,number,bio,gender,dp from users where id='$id'";
		$result=mysqli_query($conn,$sql);
		if (mysqli_num_rows($result)==1) {
			$row=mysqli_fetch_assoc($result);
			$name=$row['name'];
			$email=$row['email'];
			$number=$row['number'];
			$bio=$row['bio'];
			$gender=$row['gender'];
			$dp=$row['dp'];
		}
	}

	else{

		header('Location: login.php');

	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>MyBlog | Profile</title>
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
		$page=4;
		include 'header.php';
	?>

	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#fileType').hide();
			$('#upload').click(function(){
				$('#fileType').click();
				return false;
			});
			$('#fileType').change(function(e){
					$('#form1').submit();
			});
			
		});
	</script>

	
		<div class="profilecol">
			<div class="topbar">
				<img src="uploads/<?php echo $dp; ?>" width=250 id="profile_pic" alt="">
	            <form action="profile.php" id='form1' method="POST" enctype="multipart/form-data">
	            	<input id="fileType" type="file" name="dp">
	            	<input class="upld" type="submit" id="upload" name="upload" value="upload">
	            	<input type="hidden" name="pic" value='1'>
	            </form>
			</div>
			<div class="content_base">
				<h1 id="title"><?php echo $name; ?></h1>
				<h2 id="profession">Student</h2>
				<p id="content">
	            	<strong>Bio: </strong>
	            	<?php echo $bio; ?>
		            <br><br>
		            <strong>gender: </strong> <?php echo $gender; ?>
		            <br><br>
		            <strong>email: </strong> <?php echo $email; ?>
		            <br><br>
		            <strong>phone number: </strong> <?php echo $number; ?>
	        	</p>
			</div>
		</div>
		<u><h1 style="text-align: center;">My Post</h1></u>
		<?php
			$conn=mysqli_connect('localhost','root','','myBlog');
			$sql2="select * from blog where uid='$id'";
			$result1=mysqli_query($conn,$sql2);
			while($row1=mysqli_fetch_assoc($result1)) {
		?>

		<div class="mypost">
			<div class="card" style="background-color: #dbd4d4; border-radius: 10px;">
				
				<h2><?php echo $row1['title']; ?></h2>
				<a style="text-decoration: none; border: 1px solid black; padding: 2px; color: white; background-color: red; border-radius: 2px; float: right;" href="deletePost.php?id=<?php echo $row1['id'];?>">Delete</a>
				<img src="uploadBlog/<?php echo $row1['blogimg']; ?>" height=200 id="fakeimg" alt="">
				<p><?php echo $row1['body']; ?></p>
			</div>
		</div>

		<?php
			}
		?>


	</div>

</body>
</html>