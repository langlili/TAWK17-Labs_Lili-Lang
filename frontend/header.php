		
<?php
	include('config.php');
?>

<!doctype html>
<html>
<head>
	<title>Labs</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="header">
		<div class="float">
			<div class="float-logo">
				<img src="https://s3-us-west-2.amazonaws.com/i.cdpn.io/28275.cFDhy.7e19a5d2-4307-494b-aaf1-c711d1ce3783.png">
			</div>
			
			<div class="float-title">
				<h2>Redoing Labs</h2>
			</div>
		</div>

		<nav>
			<ul>
				<li><a class="active <?php echo ($current_page == 'contact.php' ) ? 'selected' : NULL ?>" href="contact.php">Contact Us</a></li>
				<li><a class="active <?php echo ($current_page == 'about.php' ) ? 'selected' : NULL ?>" href="about.php">About Us</a></li>
				<li><a class="active <?php echo ($current_page == 'mybooks.php' ) ? 'selected' : NULL ?>"href="mybooks.php">My Books</a></li>
				<li><a class="active <?php echo ($current_page == 'gallery.php' ) ? 'selected' : NULL ?>" href="gallery.php">Gallery</a></li>
				<li><a class="active <?php echo ($current_page == 'search.php' ) ? 'selected' : NULL ?>" href="search.php">Search</a></li>
				<li><a class="active <?php echo ($current_page == 'login.php' ) ? 'selected' : NULL ?>" href="login.php">Login</a></li>
				<li><a class="active <?php echo ($current_page == 'index.php' || $current_page == '') ? 'selected' : NULL ?>" href="index.php">Home</a></li>
			</ul>
		</nav>
	</div>
</body>
</html>