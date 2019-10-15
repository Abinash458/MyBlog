<?php
  $conn=mysqli_connect('localhost','root','','myBlog');

  if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['number']) && isset($_POST['gender']) && isset($_POST['bio']) && isset($_POST['password']) && isset($_POST['repassword'])) {

    $name=$_POST['name'];
    $email=$_POST['email'];
    $number=$_POST['number'];
    $gender=$_POST['gender'];
    $bio=$_POST['bio'];
    $password=$_POST['password'];
    $repassword=$_POST['repassword'];

    $sql="insert into users(name,email,number,gender,bio,password,repassword) values('$name','$email','$number','$gender','$bio','$password','$repassword')";

    $result=mysqli_query($conn,$sql);

    if ($result) {
      echo "<span style='color:red;'>Sign up Successful</span>";
    }
    else{
      echo "some error occured.";
    }
  }

?>



<html>
<head>
	<title>My Blog | Sign Up</title>
	<link rel="stylesheet" type="text/css" href="css/loginstyle.css">
  <link rel="icon" type="image/png" href="icon/logo.png">
</head>
<body>
	<div class="container">
		<div class="signup">
			<h1>Sign Up</h1>
			<p>Please fill in this form to create an account.</p>
			<hr>
      <form id="second_form" action="signup.php" method="POST">
          <label for="name"><b>Name</b></label>
          <input type="text" id="newName" name="name" placeholder="Enter Full Name">
          <span id="nameError" style="color: red; display: none;">Please Provide your Name</span><br>

      		<label for="email"><b>Email</b></label>
      		<input type="text" id="newEmail" name="email" placeholder="Enter Email">
          <span id="emailError" style="color: red; display: none;">Please Provide your Email.</span>
          <span id="validEmail" style="color: red; display: none;">Invalid Email.</span><br>

          <label for="num"><b>Number</b></label>
          <input type="text" id="newNumber" name="number" placeholder="Enter Phone Number">
          <span id="numError" style="color: red; display: none;">Please Provide your Phone Number</span>
          <span id="validNum" style="color: red; display: none;">Provide a valid number</span><br>

          <label for="gender"><b>Gender</b></label><br>
          <input type="radio" id="validButton" name="gender" value="male">Male
          <input type="radio" id="validButton" name="gender" value="female">Female<br>

          <label for="bio"><b>Bio</b></label><br>
          <textarea id="txtArea" name="bio" placeholder="Write Something About Yourself"></textarea>
          <span id="txtAreaError" style="color: red; display: none;">Please Enter something about yourself.</span><br>

      		<label for="psw"><b>Password</b></label>
      		<input type="password" id="newPassword" placeholder="Enter Password" name="password" id="newPassword">
          <span id="passError" style="color: red; display: none;">Please provide a Password</span>
          <span id="validPass" style="color: red; display: none;">Password must not be less than 8 characters.</span><br>

      		<label for="psw-repeat"><b>Repeat Password</b></label>
      		<input type="password" id="re_newPassword" placeholder="Repeat Password" name="repassword" id="re_newPassword">
          <span id="re_passError" style="color: red; display: none;">Enter the same password</span>
          <span id="re_validPass" style="color: red; display: none;">Password is not matching</span><br>

      		<p>
            <label>
            <input type="checkbox" id="remember_me" name="remember" style="margin-bottom:15px"> Remember me
      		  </label>
          </p>

      		By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.

      		<div class="clearfix">
            <input type="submit" value="Sign Up">
        		Aready have an account? <a href="login.php">login</a> 
      		</div>
        </form>
		</div>
	</div>

  <script type="text/javascript" src="js/jquery.js"></script>

 <script type="text/javascript">
  $(document).ready(function(){
    $('#second_form').submit(function(){

      $('#nameError').hide();
      $('#emailError').hide();
      $('#numError').hide();
      $('#txtAreaError').hide();
      $('#passError').hide();
      $('#re_passError').hide();
      $('#validEmail').hide();
      $('#validNum').hide();
      $('#validPass').hide();
      $('#re_validPass').hide();

      var name=$('#newName').val();
      var mail=$('#newEmail').val();
      var number=$('#newNumber').val();
      var password=$('#newPassword').val();
      var retype=$('#re_newPassword').val();
      var textArea=$('#txtArea').val();
      var checkbox=$('#remember_me').is(':checked');
      var radioBtn=$('#validButton').is(':checked');

      if (name=="") {
        $('#nameError').show();
        $('#newName').focus();
        return false;
      }

      if (mail=="") {
        $('#emailError').show();
        $('#newEmail').focus();
        return false;
      }

      var emailFormat=/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
      if (emailFormat.test(mail)==false) {
        $("#validEmail").show();
        $("#newEmail").focus();
        return false;
        }

      if (number=="") {
        $('#numError').show();
        $('#newNumber').focus();
        return false;
      }

      var phoneFormat=/^\d{10}$/;
      if (phoneFormat.test(number)==false) {
        $('#validNum').show();
        $('#newNumber').focus();
        return false;
      }

      if (radioBtn==false) {
        alert("Please select a gender");
        return false;
      }

      if (textArea=="") {
        $('#txtAreaError').show();
        $('#txtArea').focus();
        return false;
      }

      if (password=="") {
        $('#passError').show();
        $('#newPassword').focus();
        return false;
      }

      if (password.length<8) {
        $('#validPass').show();
        $('#newPassword').focus();
        return false;
      }

      if (retype=="") {
        $('#re_passError').show();
        $('#re_newPassword').focus();
        return false;
      }

      if (retype!=password) {
        $('#re_validPass').show();
        $('#re_newPassword').focus();
        return false;
      }

      if (checkbox==false) {
        alert('You must checked');
        return false;
      }
      return true;
    });
  });

    /*function validate(){
      var newName = document.getElementById('newName');
      var newEmail = document.getElementById('newEmail');
      var newNumber = document.getElementById('newNumber');
      var newPassword = document.getElementById('newPassword');
      var re_newPassword = document.getElementById('re_newPassword');
      var nameError = document.getElementById('nameError');
      var emailError = document.getElementById('emailError');
      var numError = document.getElementById('numError');
      var passError = document.getElementById('passError');
      var re_passError = document.getElementById('re_passError');
      var checkbox = document.getElementById('remember_me');

      nameError.style.display='none';
      emailError.style.display='none';
      numError.style.display='none';
      passError.style.display='none';
      re_passError.style.display='none';

      var name = newName.value;
      var mail = newEmail.value;
      var number = newNumber.value;
      var password = newPassword.value;
      var retype = re_newPassword.value;

      if (name=="") {
        nameError.style.display='block';
        return false;
      }

      //mail validation
      if (mail=="") {
        emailError.style.display='block';
        return false;
      }
   
      var emailFormat=/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
      if (emailFormat.test(mail)==false) {
        emailError.innerHTML="invalid Email";
        emailError.style.display='block';
        return false;
      }

      //number validation
      if (number=="" || isNaN(number)) {
        numError.style.display='block';
        return false;
      }

      //password validation
      if (password=="") {
        passError.style.display='block';
        return false;
      }
      if (password.length<8) {
        passError.innerHTML="Password must not be less than 8 character.";
        passError.style.display='block';
        return false;
      }

      if (retype=="") {
        re_passError.style.display='block';
        return false;
      }
      if (retype.length<8) {
        re_passError.innerHTML="Password must not be less than 8 character.";
        re_passError.style.display='block';
        return false;
      }
      if (checkbox.checked==false) {
        alert("you must checked");
      }
      return true;
    }

    function change(evt) {
        var text=event.which;
        if (text>47 && text<58) {
          return true;
        }
        else
          return false;
    }*/

    </script>
</body>
</html>