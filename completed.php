<?php
include 'controller.php';
$id = $_SESSION['currentUser']['id'];
$class = $_SESSION['classroomId'];

$result = showResult($id, $class);

if (!isActive() or $_SESSION['currentUser']['user_type'] != 2)
    header("location:error404.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Main</title>
    <link rel="stylesheet" type="text/css" href="css/main2.css">
    <link rel="icon" type="image/x-icon" href="./img/icon.png">
    <?php include 'extentions/bootstrap.php' ?>

    <style>
        .bg-primary {
            background-color: #3D48C9 !important;
        }

        .container {

            border-radius: 20px;
            min-height: 600px;

        }
    </style>
</head>

<body>
    <img class="bkg" src="img/bkg.png" alt="">
    <?php include "extentions/navbar.php" ?>

    <div class="container bg-light mt-5 shadow">
        <div class="row no-gutters p-0">
            <div class="col-lg-12 px-3 px-lg-5 py-5 m-0">
                <div class="">
                    <div class="row">
                        <div class="col text-start">
                            <h3 class="">Completed</h3>
                        </div>
                        <div class="col text-end">
                            <form class="" action="controllerPart2.php" method="Post">
                                <button class="btn btn-warning" name="backToDash">Go back</button>
                            </form>
                        </div>
                    </div>
                    <!-- <h4>Completed</h4> -->
                    <form action="controllerPart2.php" method="Post" class="py-3">
                        <table class="table table-striped table-primary table-hover">
                            <thead class="">
                                <th>Title</th>
                                <th>Type</th>
                                <th>Date Submitted</th>
                                <th>Score</th>
                            </thead>
                            <tbody>
                                <?php
                                if (mysqli_num_rows($result)) {
                                    while ($data = $result->fetch_assoc()) { ?>
                                        <tr>
                                            <td><?= $data['title']; ?></td>
                                            <td><?= $data['Type']; ?></td>
                                            <td><?= date("F j, Y, g:i a", strtotime($data['Date_Submitted'])); ?></td>
                                            <td><?= $data['Score']; ?></td>
                                        </tr>
                                    <?php }
                                } else { ?>
                                    <tr>
                                        <td colspan="4">
                                            <div class=" mx-4 text-center py-2">no data found</div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                    </form>
                </div>
            </div>
        </div>
        <div>

        </div>
    </div>
</body>

</html>