<?php
include 'controller.php';

$result = requestList($_SESSION['currentClassroom']);
if (!isActive())
    header("location:error404.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Request</title>
    <link rel="stylesheet" type="text/css" href="css/main2.css">
    <link rel="icon" type="image/x-icon" href="./img/icon.png">
    <?php include 'extentions/bootstrap.php' ?>
</head>

<body>
    <img class="bkg" src="img/bkg.png" alt="">
    <?php include "extentions/navbar.php" ?>

    <div class="container bg-light mt-5 shadow">
        <div class="row no-gutters p-0">
            <div class="col-lg-12 px-3 px-lg-5 py-5 m-0">
                <div class="">
                    <div class="row text-start">
                        <div class="col studName text-start">
                            <span>Requests</span>
                        </div>
                        <div class="col text-end editStud">
                            <form class="" action="controllerPart2.php" method="Post">
                                <button class="btn btn-warning" name="backToTeacherDash">Go back</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-12 px-4 py-3">
                        <table class="table table-striped table-primary table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col">Profile</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (mysqli_num_rows($result)) {
                                    while ($r = $result->fetch_assoc()) { ?>
                                        <?php
                                        $students = getStudent($r['student_id']);
                                        $count = 1;
                                        while ($info = $students->fetch_assoc()) {
                                        ?>
                                            <tr>
                                                <form action="" method="Post">
                                                    <div class="students">
                                                        <td scope="row" class="text-center"><?= $count++ ?></td>
                                                        <td><img src="<?= $info['pic_path'] ?>" class="student_img m-0" alt=""></td>
                                                        <td><span><?= "    " . $info['first_name'] . '  ' . $info['last_name']; ?></span></td>

                                                        <input type="hidden" name="student_id" value="<?= $info['id'] ?>">
                                                        <input type="hidden" name="last_name" value="<?= $info['last_name'] ?>">
                                                        <input type="hidden" name="teacher_id" value="<?= $r['teacher_id'] ?>">
                                                        <input type="hidden" name="classroom_id" value="<?= $r['classroom_id'] ?>">

                                                        <td>
                                                            <button type="submit" name="btnDecline" type="button" class="btn btn-danger">Decline</button>
                                                            <button type="submit" name="btnAccept" type="button" class="btn btn-primary">Accept</button>
                                                        </td>
                                                    </div>
                                                </form>
                                            </tr>
                                    <?php }
                                    }
                                } else { ?>
                                    <tr>
                                        <td colspan="4">
                                            <div class=" mx-4 text-center py-2">no data found</div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

</html>