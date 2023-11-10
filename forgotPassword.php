<?php
include 'controller.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Forgot Password</title>
    <link rel="stylesheet" type="text/css" href="css/fpstyle.css">
    <link rel="icon" type="image/x-icon" href="./img/icon.png">
    <?php include 'extentions/bootstrap.php' ?>
</head>

<body class="overflow-x-hidden vh-100">
    <img class="bkg" src="img/bkg.png" alt="">
    <div class="d-md-flex flex-row no-gutters align-items-center min-vh-100 pb-5">
        <div class="col-12 col-md-6 no-gutters">
            <div class="leftside container px-sm-0 text-center">
                <div class="wtq">Welcome To <span>Quizam</span></div>
                <p>This web-app allows you to manage and conduct online<br>
                    online assessments. There are many that you can do like<br>
                    setting functions the way you want</p>
                <div class="btn">Learn More</div>
            </div>
        </div>
        <div class="col-12 col-md-6 no-gutters">
            <div class="rightside">
                <div class="row no-gutters py-4">
                    <div class="col no-gutters">
                        <div class="left-form-box">
                            <h2><span>Forgot Your Password</span></h2>
                            <p>Please enter your email address.</p>
                            <form action="forgotPassword.php" method="Post">
                                <h6><span>Email</span></h6><input class="ibox" type="email" name="resetEmail" placeholder="(e.g. example123@example.com)" required><br><br>
                                <button class="btn-reset" type="submit" name="resetBtn">Send Password</button><br>
                                <div class="f-pass">
                                    <a class="lnk-pass" href="index.php">Go Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="d-none d-xl-block col no-gutters d-flex align-items-center">
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
                    The email you entered was not yet registered on our system. Please check the email address and try again.
                </div>
                <div class="modal-footer bg-dark text-light">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <form action="controller.php" method='Post'>
        <div class="modal" id="myModal2">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-light">
                        <h4 class="modal-title">Email Sent</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body bg-light text-dark">
                        Please Follow the instructions we sent on your email so you can reset your password.
                    </div>
                    <div class="modal-footer bg-light text-dark">
                        <button type="submit" class="btn btn-primary" name='goToLogin'>Okay</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <?php include 'extentions/footer.php'; ?>

    <?php if ($_SESSION['emailNotFound']) : ?>
        <script>
            $('#myModal').modal('show');
        </script>
    <?php $_SESSION['emailNotFound'] = false;
    endif; ?>

    <?php if ($_SESSION['passwordSent']) : ?>
        <script>
            $('#myModal2').modal('show');
        </script>
    <?php $_SESSION['passwordSent'] = false;
    endif; ?>

</body>

</html>