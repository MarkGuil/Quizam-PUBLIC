<?php
include 'controller.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Verify</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="./img/icon.png">
	<?php include 'extentions/bootstrap.php' ?>
</head>

<body class="overflow-x-hidden vh-100">
	<img class="bkg" src="img/bkg.png" alt="">

	<div class="d-flex flex-row row no-gutters justify-content-center align-items-center vh-100 pb-5">

		<div class="col no-gutters">
			<div class="leftside container-fluid text-center">
				<div class="wtq" style="color:yellow;">Finalize Registration</div>
				<p style="font-size: 23px;">We sent a verification Code on the email address you entered. <br>
					Please Enter Code
					to finalize your registration.</We>
				</p>
			</div>
		</div>

		<div class="col no-gutters">
			<div class="rightside">
				<div class="row no-gutters">
					<div class="col no-gutters py-4">
						<div class="left-form-box">
							<h1><span>Verify</span></h1>
							<form action="verify.php" method="Post">
								<br><br>
								<h6><span>Enter Code</span></h6><input class="ibox" type="number" name="vCode" placeholder="Enter Verification Code" pattern=".{6,}" title="Six digit code" required><br><br>
								<button class="btn-submit" type="submit" name="verifyBtn">Verify</button><br>
								<div class="reg">
									<br><br>
									<a href="register.php"> Go Back</a>
								</div>
							</form>
						</div>
					</div>

					<div class="d-md-none d-lg-block col no-gutters d-flex align-items-center ">
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
				<div class="modal-body">
					The code you entered is Incorrect!
					Please try again!
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<?php include 'extentions/footer.php' ?>
</body>
<?php if ($_SESSION['regFailed']) : ?>
	<script>
		$('#myModal').modal('show');
	</script>
	<?php $_SESSION['regFailed'] = false; ?>
<?php endif; ?>

</html>