<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>MyBlog | Contact</title>
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
		$page=3;
		include 'header.php';
	?>

	<!--contact part-->
		<div class="contactHeader">
			<u>Send an <strong style="color: red;">EMAIL</strong></u>
		</div>

		<form>

			<div class="row">
				<div class="contactInformation">
					<input type="text" placeholder="Name" name="name">
					<input style="margin-left: 20px;" type="text" placeholder="Email" name="email"><br>
					<textarea class="messageBox" placeholder="Message" cols="90" rows="10"></textarea>
					<input class="sendButton" type="submit" name="submit" value="Send it!">
				</div>
	
			<div class="aboutUs">
				<h2>About Us</h2>
				<p>
					Abinash Mohapatra<br>
					Student<br>
					+918249166148<br>
				</p>
				<div class="elsewhere">
					<h2>Social Media</h2>
				</div>
			</div>	
		</div>

	</form>


</body>
</html>