<?php
	session_start();
	if (isset($_SESSION['login'])) {
		header('Location: profile.php');
	}

	if (isset($_GET['user']) && isset($_GET['password'])) {
		$conn=mysqli_connect('localhost','root','','myBlog');
		$user=$_GET['user'];
		$password=$_GET['password'];
		$sql="select id from users where email='$user' and password='$password'";
		$result=mysqli_query($conn,$sql);
		if (mysqli_num_rows($result)==1) { //mysqli_num_rows--- it will return number of rows.
			$row=mysqli_fetch_assoc($result);
			$id=$row['id'];
			$_SESSION['login']=$id;
			header('Location:profile.php');
		}
		else{
			echo "<span style='color:red'>Some Error occured.</span>";
		}
	}

?>


<html>
<head>
	<title>My Blog | login</title>
	<link rel="stylesheet" type="text/css" href="css/loginstyle.css">
	<link rel="icon" type="image/png" href="icon/logo.png">
</head>
<body>
	<div class="container">
		<div class="login">
			<h1>Login</h1>
				<form id="first_form" action="login.php">
					<div><input type="text" name="user" id="userText" placeholder="Email or Phone Number"></div>
					<span id="userError" style="display:none; color: red; margin-left: 5px;">Email or Phone Number must not empty</span>
					<span id="validText" style="display:none; color: red; margin-left: 5px;">Invalid Email</span>
					<span id="validNum" style="display:none; color: red; margin-left: 5px;">Invalid Phone Number</span>
					<div><input type="password" name="password" id="passText" placeholder="Password"></div>
					<span id="passError" style="display:none; color: red; margin-left: 5px;">Password must not empty</span>
					<span id="validPass" style="display:none; color: red; margin-left: 5px;">Password should be greater than 8 character</span>
					<p class="remember_me">
						<label>
							<input type="checkbox" name="remember_me" id="remember_me">
							Keep me logged in
						</label>
					</p>
					<input type="submit" value="Login">
					<div class="signupbtn">
						<a style="color: white; text-decoration: none;" href="signup.php">Sign Up</a>
					</div>
				</form>
			
		</div>
		<div class="login-help">
			<p>Forget Your Password? <a href="forgetpsw.html">Click Here to reset it</a>.</p>
		</div>
		
	</div>

	<script type="text/javascript" src="js/jquery.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#first_form').submit(function(){
				$("#userError").hide();
				$('#passError').hide();
				//$('#validText').hide();
				var user=$('#userText').val();
				var password=$('#passText').val();
				var checkbox=$('#remember_me').is(':checked');

				if (user=="") {
					$("#userError").show();
					$("#userText").focus();
					return false;
				}

				var emailFormat=/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
				if (emailFormat.test(user)==false) {
					$("#validText").show();
					$("#userText").focus();
					return false;
				}

				/*var numFormat=^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]\d{3}[\s.-]\d{4}$;
				if (numFormat.test(user)==false) {
					$('#validNum').show();
					//$('#userText').focus();
					return false;
				}*/

				if (password=="") {
					$('#passError').show();
					return false;
				}
				if (password.length<8) {
					$('#validPass').show();
					return false;
				}

				if (checkbox==false) {
					alert("you must checked");
					return false;
				}
				return true;
			})
		});

		/*function validate(){
			var userText=document.getElementById('userText');
			var passText=document.getElementById('passText');
			var userError=document.getElementById('userError');
			var passError=document.getElementById('passError');
			var checkbox=document.getElementById('remember_me');
			userError.style.display='none';
			passError.style.display='none';
			var user=userText.value;
			var Password=passText.value;
			if (user=="") {
				userError.style.display='block';
				return false;
			}
			var emailFormat=/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
      		//if (index<1 || index==mail.length-1) 
      		if (emailFormat.test(user)==false) {
       			userError.innerHTML="invalid Email";
       			userError.style.display='block';
       			return false;
     		}
			if (Password=="") {
				passError.style.display='block';
				return false;
			}
			if (Password.length<8) {
				passError.innerHTML="Password must not be less than 8 character.";
				passError.style.display='block';
				return false;
			}
			if (checkbox.checked==false) {
				alert("you must checked");
			}
			return true;
		}*/
	</script>
</body>
</html>