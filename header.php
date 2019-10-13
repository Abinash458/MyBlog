<div class="navbar">
	<a href="index.php"><strong>TechBlog </strong><span style="font-size: 0.6rem;">New Thinking. New Technology</span></a>
	<div class="dropdown" style="float: right">
		<button class="dropbtn">Dropdown
			<i class="fa fa-user" style="border-radius: 100%;"></i>
		</button>
		<div class="dropdown-content">
			<a <?php if ($page==4) {
		echo "class='active'";
	} ?> href=<?php if (isset($_SESSION['login'])) {echo "profile.php";} else{echo "login.php";}?>>
	<?php 
		if (isset($_SESSION['login'])){
			echo "View Profile";} else {echo "Login";}
			?> </a>
			<a href="logout.php"><i class="fa fa-sign-out"></i> Log Out</a>
		</div>
	</div>
	<a <?php if ($page==3) {echo "class='active'";} ?> href="contact.php" style="float: right">Contact</a>
	<a <?php if ($page==2) {echo "class='active'";} ?> href="blog.php" style="float: right">Blog</a>
	<a <?php if ($page==1) {echo "class='active'";} ?> href="index.php" style="float: right"><i class="fa fa-home"></i> Home</a>
</div>