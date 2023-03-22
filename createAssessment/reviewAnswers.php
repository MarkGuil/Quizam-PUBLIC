<?php include '../controllerPart2.php';


$studentId =  $_SESSION['reviewStudent'];
$assessment = $_SESSION['reviewAssessment'];
$_SESSION['reviewCurrent'] = reviewScores($studentId, $assessment);

$assement_id = $_SESSION['reviewCurrent']['assessment_id'];
$result = loadQuestions($assement_id);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ReviewAnswers</title>
    <?php include '../extentions/bootstrap.php' ?>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script> -->
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <link rel="stylesheet" href="styler.css">
    <style>
        .bg-primary {
            background-color: #3D48C9 !important;
        }
    </style>
</head>
<style>
    .questions,
    .question {
        border-radius: 5px;
        font-size: 20px;
        background-color: rgb(247, 243, 243);
    }

    .question {
        font-size: 18px;
    }

    #popUp {
        position: fixed;
        z-index: 1;
        margin-left: 10rem;
        margin-top: 10rem;
    }
</style>

<body style=" background: rgb(241, 240, 240) !important;">
    <nav class="navbar navbar-light bg-primary justify-content-between shadow px-sm-2 px-lg-5">
        <div class="navUser">
            <a class="navbar-brand">
                <a href="Main.php" class="text-decoration-none">
                    <span>
                        Quizam
                    </span>
                </a>
            </a>
        </div>
        <form class="d-flex" action="../controller.php" method="Post">
            <div class="dropdown">
                <button class="btn btn-link dropdown-toggle text-light text-decoration-none me-3" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img class="border border-dark rounded-circle me-2" src="../<?= $_SESSION['currentUser']['pic_path']; ?>" width="40px" height="40px" alt="">
                    <span>
                        <?= $_SESSION['currentUser']['first_name']; ?><?= "  " . $_SESSION['currentUser']['last_name']; ?>
                    </span>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="showInfo.php">Edit Profile</a></li>
                    <li><button class="dropdown-item " type="submit" name="logout">Logout</button></li>
                </ul>
            </div>
        </form>
    </nav>

    <?php if ($_SESSION['modifyPoints']) : ?>
        <div id="popUp" class="container">

            <div class="row justify-content-center">
                <form action="" method="Post" class="p-5 border bg-light">
                    <label for="">Edit Points</label>
                    <div class="form-group">
                        <input name="updatedPoints" type="number" class="form-control" value="<?= $_SESSION['currentPoints'] ?>" min=0 max=<?= $_SESSION['maxVal'] ?>>
                    </div>
                    <div class="form-inline">
                        <button class="mx-2 btn btn-primary" name="saveNewPoints" value="<?= $_SESSION['currentPointsId'] ?>">Save</button>
                        <button class="mx-2 btn btn-danger">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    <?php endif; ?>
    <div class="container bg-light mt-5 mb-5">
        <div class="row">
            <div class="col col-lg-12 shadow p-0">
                <header class="text-light bg-primary p-5">
                    <div class="form-inline d-flex justify-content-between">
                        <h4><?= $_SESSION['reviewCurrent']['StudentName']; ?></h4>
                        <h4>Total Score: <?= $_SESSION['reviewCurrent']['Total']; ?></h4>
                        <form action="" class="form-inline my-2 my-lg-0" method="Post">
                            <button class=" btn btn-warning" type="submit" name="backToList">Go Back</button>
                        </form>
                    </div>
                    <div class="form-inline justify-content-between py-3">
                        <p>Date Submitted: <?= $_SESSION['reviewCurrent']['date_taken']; ?></p>
                    </div>
                </header>

                <?php while ($data = $result->fetch_assoc()) : {
                    } ?>
                    <form action="" method="Post" class="">
                        <div class="q-section mb-3 border-bottom p-5">
                            <div class="form-group">
                                <div class="form-group bg-primary rounded px-3 py-2 d-flex justify-content-between">

                                    <h4 class="text-light m-0">Question</h4>
                                    <h4 class="text-light m-0">Points: <?= $data['points'] ?></h4>
                                </div>
                            </div>
                            <div class="px-3 py-2">


                                <div class="questions border p-4">
                                    <?= $data['question'] ?>
                                    <?php if (!empty($data['pic_path'])) : ?>
                                        <div class="form-group text-center">
                                            <img src=" <?= $data['pic_path'] ?>" alt="" style="height:200px;">
                                        </div>
                                    <?php endif; ?>
                                </div>


                                <div class="form-inline d-flex justify-content-around mt-5 mx-3">
                                    <div class="col-6 mx-3">
                                        <label for="" class="justify-content-start">Student Answer</label>
                                        <div class="question border p-2">
                                            <?php $response = getResponse($data['id'], $studentId);
                                            if (!empty($response))
                                                echo $response['answer'];
                                            else echo "No Answer";
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-6 mx-3">
                                        <label for="" class="justify-content-start">Correct Answer</label>
                                        <div class="question border p-2">
                                            <?php
                                            $answer = getAnswers($data['id']);
                                            if ($answer == null) {
                                                echo "No correct answer";
                                            } else {
                                                echo $answer['answer'];
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 justify-content-center p-0 py-3 mt-3 p">
                                    <div class="form-group">
                                        <label for="" class="">Score</label>
                                        <div class="form-inline row">
                                            <input type="hidden" name="maxVal" value="<?= $data['points'] ?>">
                                            <?php
                                            $points = 0;
                                            if (!empty($response)) $points = $response['points']; ?>
                                            <input name="currentVal" type="text" class="form-control col mx-3" value="<?= $points ?>" readonly>
                                            <button name="editStudentScore" class="btn  btn-warning col mx-2" value="<?= $response['id'] ?>">Edit Score</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php endwhile; ?>

            </div>
            <script src="script.js?">
            </script>
</body>

<script>
</script>

</html>