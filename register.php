<?php
include 'controller.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="css/regstyle.css">
    <?php include 'extentions/bootstrap.php' ?>
</head>

<body class="overflow-x-hidden vh-100">
    <img class="bkg" src="img/bkg.png" alt="">
    <div class="d-md-flex flex-row no-gutters align-items-center min-vh-100 pb-5">
        <div class="col-12 col-md-6 no-gutters">
            <div class="leftside container text-center">
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
                            <h1><span>Register</span></h1>
                            <form action="register.php" method="Post" class="mx-5 mt-5">
                                <h6><span>Email</span></h6>
                                <input class="ibox" type="email" name="email" placeholder="(e.g. example123@example.com)" required><br><br>
                                <div class="row">
                                    <div class="col-12 col-md-6 ">
                                        <h6><span>First Name</span></h6>
                                        <input class="ibox2" type="text" name="fname" placeholder="First name" required>
                                    </div>
                                    <div class="col-12 col-md-6 ">
                                        <h6><span>Last Name</span></h6>
                                        <input class="ibox2" type="text" name="lname" placeholder="Last Name" required>
                                    </div>
                                </div><br>
                                <h6><span>Password</span></h6>
                                <input id="pswrd1" class="ibox" type="password" name="password1" placeholder="Password" pattern=".{8,}" title="Eight or more characters" required><br><br>
                                <h6><span>Confirm Password</span></h6>
                                <input id="pswrd2" class="ibox" type="password" name="password2" placeholder="Password" pattern=".{8,}" title="Eight or more characters" required><br><br>
                                <div class="f-box">
                                    <div class="b-box">
                                        <div id="bttn"></div>
                                        <button type="button" class="toggle-bttn" id="tc" name="userType" onclick="leftClick()">Student</button>
                                        <button type="button" class="toggle-bttn" id="tc1" name="userType" onclick="rightClick()">Teacher</button>
                                    </div>
                                </div><br>
                                <button class="btn-reg" type="submit" name="regBtn" id="regBtn" value='2'>Register</button>
                                <div class="reg">
                                    <p>Already have an account? <a href="index.php"> Login</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="d-none d-xl-block col no-gutters d-flex align-items-center">
                        <img src="img/img1.png" class="myimg img-fluid">
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
                    First password and the second password are not matched!
                </div>
                <div class="modal-footer bg-dark text-light">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="myModal2">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-light">
                    <h4 class="modal-title">Invalid</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body bg-dark text-light">
                    The email address you entered is already registered in our system. Please try other email.
                </div>
                <div class="modal-footer bg-dark text-light">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <?php include 'extentions/footer.php'; ?>
    <script src="js/script.js"></script>
    <?php if (!$_SESSION['uniqueEmail']) : ?>
        <script>
            $('#myModal2').modal('show');
        </script>
        <?php $_SESSION['uniqueEmail'] = true; ?>
    <?php endif; ?>
</body>

</html>