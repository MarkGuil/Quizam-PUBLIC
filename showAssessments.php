<?php
include 'controller.php';
$id = $_SESSION['currentUser']['id'];
$class_Id = $_SESSION['currentClassId'];
// $class = $_SESSION['classroomId'];

$result = loadAssessments($class_Id);

if (!isActive() or $_SESSION['currentUser']['user_type'] != 1)
    header("location:error404.php");


function type($code)
{
    if ($code == 1)
        return 'Quiz';

    return 'Exam';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Main</title>
    <link rel="stylesheet" type="text/css" href="css/main2.css">
    <?php include 'extentions/bootstrap.php' ?>

    <style>
        .bg-primary {
            background-color: #3D48C9 !important;
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
                            <h3 class="">Assessments</h3>
                        </div>
                        <div class="col text-end">
                            <form class="" action="controllerPart2.php" method="Post">
                                <button class="btn btn-warning" name="backToTeacherDash">Go back</button>
                            </form>
                        </div>
                    </div>
                    <form action="controllerPart2.php" method="Post" class="py-3">
                        <table class="table table-striped table-primary table-hover">
                            <thead class="">
                                <th>Title</th>
                                <th>Type</th>
                                <th>Actions</th>
                            </thead>
                            <tbody>
                                <form action="" method="Post">
                                    <?php
                                    if (mysqli_num_rows($result)) {
                                        while ($data = $result->fetch_assoc()) { ?>
                                            <tr>
                                                <td><?= $data['title'] ?></td>
                                                <td><?= type($data['title']); ?></td>
                                                <td>
                                                    <button class="btn btn-outline-primary" name="showStudentScores" value="<?= $data['id'] ?>">View Student Scores</button>
                                                </td>
                                            </tr>
                                        <?php }
                                    } else { ?>
                                        <tr>
                                            <td colspan="6">
                                                <div class=" mx-4 text-center py-2">no data found</div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </form>
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