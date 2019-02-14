<?php
	include('header.php');

	session_start();
	if(!isset($_SESSION['username'])) {
			header("location: login.php");
	  }
?>

<!doctype html>
<html>
<head>
	<title>Labs</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="center-textbox">
	<img src="http://www.pngpix.com/wp-content/uploads/2016/03/Books-PNG-Image-500x402.png">
	</div>
</body>
	<?php include('footer.php'); ?>
</html>
