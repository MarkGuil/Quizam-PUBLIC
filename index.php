<?php
include 'controller.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="./img/icon.png">
	<?php include 'extentions/bootstrap.php' ?>
</head>

<body class="overflow-x-hidden vh-100">
	<img class="bkg" src="img/bkg.png" alt="">
	<div class="d-md-flex flex-row no-gutters align-items-center min-vh-100 pb-5">
		<div class="col-12 col-md-5 col-xxl-6 no-gutters">
			<div class="leftside container px-1 py-5 text-center">
				<div class="wtq">Welcome To <span>Quizam</span></div>
				<p>This web-app allows you to manage and conduct online<br>
					online assessments. There are many that you can do like<br>
					setting functions the way you want</p>
				<div class="btn">Learn More</div>
			</div>
		</div>
		<div class="col-12 col-md-7 col-xxl-6 no-gutters ">
			<div class="rightside">
				<div class="row no-gutters py-4">
					<div class="col no-gutters">
						<div class="left-form-box">
							<h1><span>Login</span></h1>
							<form action="index.php" method="Post">
								<h6><span>Email</span></h6><input class="ibox" type="email" name="loginEmail" placeholder="(e.g. example123@example.com)" required><br><br>
								<h6><span>Password</span></h6><input class="ibox" type="password" name="loginPassword" placeholder="Password" pattern=".{8,}" title="Eight or more characters" required><br><br>
								<button class="btn-submit" type="submit" name="loginBtn">Login</button><br>
								<div class="f-pass mt-5">
									<a class="lnk-pass" href="forgotPassword.php">Forgot Password</a>
								</div>
								<div class="reg">
									<p>Don't have an account? <a href="register.php"> Register</a></p>
								</div>
							</form>
						</div>
					</div>
					<div class="d-none d-xl-block col no-gutters d-flex align-items-center ">
						<img src="img/img1.png" class="w-100 h-100">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal" id="myModal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-primary text-light">
					<h4 class="modal-title">Invalid</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body bg-dark text-light">
					The email or password you entered is Invalid!
				</div>
				<div class="modal-footer bg-dark text-light">
					<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!-- <div class="space2"></div> -->
	<?php include 'extentions/footer.php'; ?>
	<?php if ($_SESSION['loginFailed']) : ?>
		<script>
			$('#myModal').modal('show');
		</script>
		<?php $_SESSION['loginFailed'] = false; ?>
	<?php endif; ?>
</body>

</html>