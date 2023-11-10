<?php
include 'controller.php';
if (!isset($_SESSION['username'])) {
	header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="./img/icon.png">
	<?php include 'extentions/bootstrap.php' ?>
</head>

<body class="overflow-x-hidden vh-100">
	<img class="bkg" src="img/bkg.png" alt="">
	<div class="d-flex flex-row row no-gutters justify-content-center align-items-center vh-100 pb-5">
		<div class="col no-gutters py-4">
			<div class="leftside container-fluid text-center">
				<div class="wtq">Hi <span><?= $_SESSION['username']; ?></span></div>
				<div class="wtq">Welcome To <span>Quizam</span></div>
				<p>This web-app allows you to manage and conduct online<br>
					online assessments. There are many that you can do like<br>
					setting functions the way you want</p>
				<a href="index.php" class="btn">Get Started</a>
			</div>
		</div>
	</div>
	<?php include 'extentions/footer.php' ?>
</body>

</html>