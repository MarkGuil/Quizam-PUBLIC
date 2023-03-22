<?php
include 'controller.php';
if (!isActive())
    header("location:error404.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>View Info</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <?php include 'extentions/bootstrap.php' ?>
</head>

<body>
    <img class="bkg" src="img/bkg.png" alt="">
    <?php include "extentions/navbar.php" ?>
    <div class="contaiiiner">
        <h1 class="ai-text my-4">Account Information</h1>
        <div class="cont col-sm-6 col-sm-offset-6">
            <div class="text-xs-center text-lg-center mb-4">
                <div class="contUser"><img src="<?= $_SESSION['currentUser']['pic_path']; ?>" alt=""></div>
            </div>
            <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg">Full Name</span>
                <input class="form-control" type="text" name="fullname" value="<?= $_SESSION['currentUser']['first_name']; ?> <?= $_SESSION['currentUser']['last_name']; ?>" readonly><br>
            </div>
        </div>
        <div class="cont col-sm-6 col-sm-offset-6">
            <div class="input-group input-group-lg">
                <span class="sp input-group-text" id="inputGroup-sizing-lg">Role</span>
                <input class="form-control" type="text" name="role" value="<?php if ($_SESSION['currentUser']['user_type'] == 2) echo "Student";
                                                                            else echo "Teacher"; ?>" readonly><br>
            </div>
        </div>
        <div class="cont col-sm-6 col-sm-offset-6">
            <div class="input-group input-group-lg">
                <span class="sp2 input-group-text" id="inputGroup-sizing-lg">Email</span>
                <input class="form-control" type="text" name="role" value="<?= $_SESSION['currentUser']['email']; ?>" readonly><br>
            </div>
        </div>
        <div class="butn col-sm-6 col-sm-offset-6">
            <form action="controller.php" method="Post">
                <button class="btn btn-primary" type="submit" name="btnEdit">Edit Info</button>
                <button class="btn btn-secondary" type="submit" name="btnBack" id='btnBack'>Go Back</button>
            </form>
        </div>
    </div>
</body>

</html>