<?php
include 'controller.php';
$id = $_SESSION['loadAssessments'];

$result = getStudentAssessments($id);

$date = now();
$now = $date['CURDATE()'];

$today = present();



if (!isActive() or $_SESSION['currentUser']['user_type'] != 2)
    header("location:error404.php");


function type($code)
{
    if ($code == 1)
        return "Quiz";
    return "Exam";
}

function getTime()
{
    return date("H:i");
}

function start($date, $time)
{
    $start = "" . $date . " " . $time;
    // echo strtotime($start);
    return strtotime($start);
}

function ends($date, $time)
{
    $end = "" . $date . " " . $time;
    return strtotime($end);
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
            <div class="col-lg-12 px-2 px-md-4 px-lg-5 py-5 m-0">
                <div class="">
                    <div class="row">
                        <div class="col text-start">
                            <h3 class="">Assessments</h3>
                        </div>
                        <div class="col text-end">
                            <form class="" action="controllerPart2.php" method="Post">
                                <button class="btn btn-warning" name="backToDash">Go back</button>
                            </form>
                        </div>
                    </div>
                    <!-- <h4>Assessments</h4> -->
                    <form action="controllerPart2.php" method="Post" class="py-3">
                        <table class="table table-striped table-primary table-hover ">
                            <thead class="">
                                <th>Title</th>
                                <th>Type</th>
                                <th>Date Available</th>
                                <th>Time Start</th>
                                <th>Time End</th>
                                <th>Status</th>
                            </thead>
                            <tbody>
                                <?php
                                if (mysqli_num_rows($result)) {
                                    while ($data = $result->fetch_assoc()) { ?>

                                        <?php if (
                                            intval(strtotime($today['NOW()'])) <= intval(ends($data['date'], $data['time_end']))
                                            and !taken($data['id'], $_SESSION['currentUser']['id'])
                                        ) { ?>
                                            <tr>
                                                <td><?= $data['title'] ?></td>
                                                <td><?php echo type($data['assessment_type']); ?></td>
                                                <td><?= $data['date']; ?></td>
                                                <td><?= date("h:i a", strtotime($data['time_start']))  ?></td>
                                                <td><?= date("h:i a", strtotime($data['time_end'])) ?></td>

                                                <?php
                                                if (
                                                    intval(strtotime($today['NOW()'])) >= intval(start($data['date'], $data['time_start'])) and
                                                    intval(strtotime($today['NOW()'])) <= intval(ends($data['date'], $data['time_end']))

                                                ) {
                                                ?>
                                                    <td><button class="btn btn-success" name="available" value="<?= $data['id'] ?>">Available</button></td>
                                                <?php } else { ?>
                                                    <td><button class="btn btn-outline-danger" disabled>Not Available</button></td>
                                                <?php } ?>
                                            </tr>
                                        <?php }
                                    }
                                } else { ?>
                                <tr>
                                    <td colspan="6">
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


    </div>
</body>

</html>