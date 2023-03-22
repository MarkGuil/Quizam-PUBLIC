<?php
include "controller.php";

$currentId = $_SESSION['currentAssessment'];
$studId = $_SESSION['currentUser']['id'];




$present =  present();

$result = loadQuestions($currentId);
$data = array();


while ($r = $result->fetch_assoc()) {
    array_push($data, $r);
}

if (!$_SESSION['randomized']) {
    $random = array();
    $i = count($data);
    while ($i > count($random)) {
        $c = rand(0, $i - 1);
        if (!in_array($c, $random)) {
            array_push($random, $c);
        }
        $_SESSION['randomNumbers'] = $random;
        $_SESSION['randomized'] = true;
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Assessment</title>
    <link rel="stylesheet" type="text/css" href="css/main2.css">
    <?php include 'extentions/bootstrap.php' ?>

</head>
<style>
    .bg-primary {
        background-color: #3D48C9 !important;
    }
</style>
<style>
    label {
        font-size: 20px;
    }

    i {
        font-size: 100px;
        color: yellow;
    }
</style>

<body>


    <?php include "extentions/navbar.php" ?>
    <div class="container mt-5 mb-5">
        <div class="row mt-2">
            <div class="col col-lg-12 shadow p-0">

                <!-- ================================================================================= -->
                <?php
                if (isset($_POST['btnNext'])) {

                    // insert response into the database

                    if ($_SESSION['index'] > 0) {

                        updateSubmission($currentId, $studId);
                        $question_id = $_POST['question_id'];
                        $student_id =  $_SESSION['currentUser']['id'];
                        $assessment_id = $_SESSION['currentAssessment'];
                        $points = 0;
                        $ans = '';

                        if (!empty($_POST['answer']))
                            $response = $_POST['answer'];
                        else
                            $response = "No Answer";

                        $answer = getAnswers($_POST['question_id']);

                        // echo "answer is " . is_array($answer);
                        if (is_array($answer))
                            $ans = strtolower($answer['answer']);

                        // if ($answer != "") {
                        if (strtolower($response) == $ans)
                            $points = $_POST['points'];
                        // }

                        addResponse($question_id, $student_id, $assessment_id, $response, $points);

                        //    else  print_r(getAnswer($_POST['question_id']));
                        // $_SESSION['currentAssessment'];
                        // $_SESSION['currentUser']['id'];


                    }
                    if ($_SESSION['index'] < count($data) and (!$_SESSION['taken'])) {
                        $datas = $data[$_SESSION['randomNumbers'][$_SESSION['index']]];
                        // print_r($datas); echo "<br>Current ".$_SESSION['currentUser']['id'];
                ?>
                        <!-- =====================================Header====================================== -->

                        <header class="form-inline text-light bg-primary p-5 d-flex justify-content-between">
                            <div id="" class="timer">
                                <h3 class="border rounded shadow  p-2 pr-4 pl-4 timer text-center"><?= $_SESSION['index'] + 1; ?></h3>
                            </div>
                            <!-- <h4 class="title">Preview</h4> -->
                            <div id="" class="timer p-4">
                                <h3 class="timer text-center" id="timer" style="letter-spacing:4px;">00:00</h3>
                            </div>
                        </header>

                        <!--=============================Button Next=====================================-->

                        <div class="section bg-light px-5 pt-2">
                            <div class="q-section bg-light">
                                <div class="q-section text-end">
                                    <form action="" method="Post">
                                        <button id="btnN" name="btnNext" class="btn btn-outline-primary ">Next</button>
                                </div>
                                <!-- <h4 class="text-center">Questions will appear one at a time.</h4> -->
                                <!--=============================Form =====================================-->

                                <form class="px-5 pb-5" action="" style="line-height:30px;">

                                    <!--=============================M choice=====================================-->

                                    <?php if ($datas['type'] == 1) { ?>
                                        <script>
                                            $(document).ready(() => {
                                                startTime(`<?php print_r($datas['timer']); ?>`)
                                            })
                                        </script>
                                        <h5 class="question"><?php print_r($datas['question']); ?></h5>
                                        <h5 id="points">( <?php print_r($datas['points']); ?> Points )</h5>
                                        <?php if (!empty($datas['pic_path'])) { ?>
                                            <div class="img text-center">
                                                <img style="height:300px;" class='text-center' src="createAssessment/<?php print_r($datas['pic_path']); ?>" alt="">
                                            </div>
                                        <?php } ?>
                                        <br><br>

                                        <!--===========================M choice Genrerate Options=================-->
                                        <?php
                                        $id = $datas['id'];
                                        $options = loadOptions($id);
                                        ?>
                                        <input type="hidden" name="points" value="<?php print_r($datas['points']); ?>">
                                        <input type="hidden" name="question_id" value="<?= $id ?>">
                                        <input type="hidden" name="answer" value="No Answer">
                                        <?php while ($choice = $options->fetch_assoc()) { ?>
                                            <input style="width:20px;height:20px;" class="ml-5" type="radio" name="answer" id="" value="<?= $choice['option']; ?>" required><label class="ml-5" for=""><?= $choice['option']; ?></label><br>

                                        <?php } ?>
                                    <?php } ?>
                                    <!--=============================True or Falls=====================================-->

                                    <?php if ($datas['type'] == 2) { ?>
                                        <script>
                                            $(document).ready(() => {
                                                startTime(`<?php print_r($datas['timer']); ?>`)
                                            })
                                        </script>
                                        <h5 class="question"><?php print_r($datas['question']); ?></h5>
                                        <h5 id="points">( <?php print_r($datas['points']); ?> Points )</h5>
                                        <?php if (!empty($datas['pic_path'])) { ?>
                                            <div class="img text-center">
                                                <img style="height:300px;" class='text-center' src="createAssessment/<?php print_r($datas['pic_path']); ?>" alt="">
                                            </div>

                                        <?php } ?>
                                        <br><br>
                                        <input type="hidden" name="points" value="<?php print_r($datas['points']); ?>">
                                        <input type="hidden" name="question_id" value="<?php print_r($datas['id']) ?>">
                                        <input type="hidden" name="answer" value="No Answer">
                                        <input class="ml-5" type="radio" name="answer" value="true" id="" required><label class="ml-5" for="">True</label><br>
                                        <input class="ml-5" type="radio" name="answer" value="false" id=""><label class="ml-5" for="">False</label><br>
                                    <?php } ?>
                                    <!--=============================Identifidation=====================================-->

                                    <?php if ($datas['type'] == 3) { ?>
                                        <script>
                                            $(document).ready(() => {
                                                startTime(`<?php print_r($datas['timer']); ?>`)
                                            })
                                        </script>
                                        <h5 class="question" id="q"><?php print_r($datas['question']); ?></h5>
                                        <h5 id="points">( <?php print_r($datas['points']); ?> Points )</h5>
                                        <?php if (!empty($datas['pic_path'])) { ?>
                                            <div class="img text-center">
                                                <img style="height:300px;" class='text-center' src="createAssessment/<?php print_r($datas['pic_path']); ?>" alt="">
                                            </div>

                                        <?php } ?>
                                        <br><br>
                                        <div class="form-group">
                                            <input type="hidden" name="points" value="<?php print_r($datas['points']); ?>">
                                            <input type="hidden" name="question_id" value="<?php print_r($datas['id']) ?>">
                                            <input type="text" name="answer" id="" class="form-control p-5" required>
                                        </div>
                                    <?php } ?>
                                    <!--=============================Essay=====================================-->

                                    <?php if ($datas['type'] == 4) { ?>
                                        <script>
                                            $(document).ready(() => {
                                                startTime(`<?php print_r($datas['timer']); ?>`)
                                            })
                                        </script>
                                        <h5 class="question" id="q"><?php print_r($datas['question']); ?></h5>
                                        <h5 id="points">( <?php print_r($datas['points']); ?> Points )</h5>
                                        <?php if (!empty($datas['pic_path'])) { ?>
                                            <div class="img text-center">
                                                <img style="height:200px;" class='text-center' src="createAssessment/<?php print_r($datas['pic_path']); ?>" alt="">
                                            </div>

                                        <?php } ?>
                                        <br><br>
                                        <div class="form-group">
                                            <input type="hidden" name="points" value="<?php print_r($datas['points']); ?>">
                                            <input type="hidden" name="question_id" value="<?php print_r($datas['id']) ?>">
                                            <input type="text" name="answer" id="" class="form-control p-5" required>
                                        </div>
                                    <?php } ?>
                                    <div class="space p-5"></div>
                                </form>
                                </form>
                            </div>

                        </div>
                        <!--=============================End of Questions=====================================-->

                    <?php
                        $_SESSION['index']++;
                    } else {
                        $_SESSION['taken'] = true;
                        $_SESSION['index'] = 0; ?>

                        <!--=============================Thank you Message=====================================-->

                        <header class="form-inline text-light bg-primary p-5 justify-content-between">
                            <div id="" class="form-inline">
                                <label for="" class=""></label>
                                <h4 class="pt-2 px-3 timer text-center"></h4>
                            </div>
                            <!-- <h4 class="title">Preview</h4> -->
                            <div id="" class="timer p-4">
                                <!-- <h3 class="timer text-center" style="letter-spacing:4px;">00:00</h3> -->
                            </div>
                        </header>
                        <div class="col-12 bg-light">
                            <form action="" method="Post" class="p-5 text-center">
                                <p style="font-size:25px;" class="text-primary">Well Done, Thank You!</p>
                                <i class="far fa-check-circle text-warning"></i>
                                <br><br>
                                <button id="btnN" name="btnExit" class="btn btn-outline-primary">Click Here to Exit</button>
                            </form>
                        </div>

                    <?php }
                } else { ?>

                    <!--=============================Opening message=====================================-->

                    <header class="form-inline text-light bg-primary p-5 justify-content-between">
                        <div id="" class="form-inline">
                            <div class="row mb-3">
                                <div class="col text-start d-flex">
                                    <label for="" class="">Total Questions: </label>
                                    <h4 class=" px-3 timer text-center"><?php echo count($data) ?></h4>
                                </div>
                                <div class="col text-end">
                                    <form class="" action="controller.php" method="Post">
                                        <button class="btn btn-warning" name="goBack">Go Back</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div id="" class="timer p-4">
                        </div>
                    </header>
                    <div class="col-12 bg-light">
                        <form action="" method="Post" class="p-5 text-center">
                            <input type="hidden" name="answer" value="No Answer">
                            <p class="text-primary" style="font-size:22px;">Questions will appear One at a time.</p>
                            <br><br>
                            <button id="btnN" name="btnNext" class="btn btn-outline-primary">Start Now</button>
                        </form>
                    </div>

                <?php } ?>
            </div>
        </div>

    </div>
    <script src="js/preview.js">
    </script>
    <script type="text/javascript">
        window.onbeforeunload = function() {
            event.preventDefault();
            // return "reloading page will move you to the next question. Are you sure you want to continue?";
        }
    </script>
</body>

</html>