<?php
include 'controller.php';
$id = $_SESSION['currentUser']['id'];
$current = $_SESSION['presentId'];
// $class = $_SESSION['classroomId'];

$result = showScores($current);

if (!isActive() or $_SESSION['currentUser']['user_type'] != 1)
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
    <nav class="navbar navbar-light bg-primary justify-content-between">
        <div class="navUser">
            <a class="navbar-brand">
                <a href="showInfo.php" class="text-decoration-none">
                    <img src="<?= $_SESSION['currentUser']['pic_path']; ?>" alt="">
                    <span>
                        <?= $_SESSION['currentUser']['first_name']; ?><?= "  " . $_SESSION['currentUser']['last_name']; ?>
                    </span>
                </a>
            </a>
        </div>
        <form class="form-inline me-5" action="controllerPart2.php" method="Post">
            <button class="btn btn-outline-light" type="submit" name="logout">Logout</button>
        </form>
    </nav>
    <div class="container bg-light mt-5 shadow">
        <div class="row no-gutters p-0">
            <div class="col-lg-12 p-5 m-0">
                <div class="text-xs-center text-lg-center">
                    <div class="row mb-3">
                        <div class="col text-start">
                            <h3 class="">Scores</h3>
                        </div>
                        <div class="col text-end">
                            <form class="" action="controllerPart2.php" method="Post">
                                <button class="btn btn-warning" name="backToTeacherDash">Back</button>
                            </form>
                        </div>
                    </div>
                    <table class="table table-striped table-primary table-hover">
                        <thead class="">
                            <td>Student Name</td>
                            <td>Time Submitted</td>
                            <td>Score</td>
                            <td>Actions</td>
                        </thead>
                        <tbody>
                            <form action="controllerPart2.php" method="Post">
                                <?php
                                if (mysqli_num_rows($result)) {
                                    while ($data = $result->fetch_assoc()) {
                                ?>
                                        <tr>
                                            <td> <?= $data['StudentName'] ?></td>
                                            <td> <?= $data['date_taken'] ?></td>
                                            <td> <?= $data['Total'] ?></td>
                                            <td>
                                                <input type="hidden" name="assessmentId" value="<?= $data['assessment_id'] ?>">
                                                <button class="btn btn-outline-primary" value=" <?= $data['id'] ?>" name="reviewQuestions">Show</button>
                                            </td>
                                        </tr>
                                    <?php }
                                } else { ?>
                                    <tr>
                                        <td colspan="4">
                                            <div class=" mx-4 text-center py-2">no data found</div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </form>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div>
        </div>
    </div>
</body>

</html>