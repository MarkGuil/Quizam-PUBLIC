<?php
// include "../controller.php";
include "controller3.php";


$currentId = $_SESSION['currentAssessment'];




$mysql = connectDatabase();
$result = $mysql->query("SELECT * FROM `questions` WHERE `assessment_id`='$currentId'");
$data = array();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Preview</title>
    <?php include '../extentions/bootstrap.php' ?>
    <link rel="stylesheet" href="styler.css">

</head>

<style>
    .bg-primary {
        background-color: #3D48C9 !important;
    }

    .custom-text {
        color: #3D48C9 !important;
    }

    button {
        border: none;
        outline: none;
    }

    a {
        text-decoration: none;
        cursor: pointer;
    }

    a:hover {
        text-decoration: none;
    }

    label {
        font-size: 20 px;
    }

    i {
        font-size: 100px;
        color: yellow;
    }

    #questionEditForm {
        z-index: 1;
        position: fixed;
        width: 50%;
        /* top: 50%;
        transform: translate(-50%,-50%); */
    }

    .qField {
        font-size: 18px;
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
    <!-- =====================Edit Question============== -->
    <?php if ($_SESSION['editQuestion']) : ?>
        <div class="container">
            <div class="row justify-content-center" style="position: relative;">
                <div id="questionEditForm" class="col col-lg-6 ">
                    <form action="" method="Post" class="p-5 bg-light shadow">
                        <div class="form-group">
                            <label for="" class="text-light">
                                <h4>Edit Question</h4>
                            </label>
                            <input name="newQuestion" type="text" class="qField form-control p-5" value="<?php print_r($_SESSION['currentQuestionIndex']['question']); ?>" required>
                        </div>
                        <div class="form-inline">
                            <button type="submit" name='updateQuestion' class="btn btn-warning mx-2">Update</button>
                            <button type="submit" name='cancelUpdate' class="btn btn-danger mx-2">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <!-- =====================Edit Timer============== -->


    <?php if ($_SESSION['editTimer']) : ?>
        <div class="container">
            <div class="row justify-content-center" style="position: relative;">
                <div id="questionEditForm" class="col col-lg-6 ">
                    <form action="" method="Post" class="p-5 bg-light shadow">
                        <div class="form-group">
                            <label for="" class="text-primary">
                                <h4>Edit Timer</h4>
                                (minutes)
                            </label>
                            <input name="newTimer" type="Number" class="qField form-control p-5" value="<?php print_r($_SESSION['currentQuestionIndex']['timer']); ?>" min=0 required>
                        </div>
                        <div class="form-inline">
                            <button type="submit" name='updateTimer' class="btn btn-warning mx-2">Update</button>
                            <button type="submit" name='cancelUpdate' class="btn btn-danger mx-2">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- =====================Edit Points============== -->
    <?php if ($_SESSION['editPoints']) : ?>
        <div class="container">
            <div class="row justify-content-center" style="position: relative;">
                <div id="questionEditForm" class="col col-lg-6 ">
                    <form action="" method="Post" class="p-5 bg-light shadow">
                        <div class="form-group">
                            <label for="" class="text-primary">
                                <h4>Edit Points</h4>
                            </label>
                            <input name="newPoints" type="Number" class="qField form-control p-5" value="<?php print_r($_SESSION['currentQuestionIndex']['points']); ?>" min=0 required>
                        </div>
                        <div class="form-inline">
                            <button type="submit" name='updatePoints' class="btn btn-warning mx-2">Update</button>
                            <button type="submit" name='cancelUpdate' class="btn btn-danger mx-2">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- =====================Edit Answer============== -->
    <?php if ($_SESSION['editAnswer']) : ?>
        <div class="container">
            <div class="row justify-content-center" style="position: relative;">
                <div id="questionEditForm" class="col col-lg-6 ">
                    <form action="" method="Post" class="p-5 bg-light shadow">
                        <div class="form-group">
                            <label for="" class="text-primary">
                                <h4>Edit Answer</h4>
                            </label>
                            <input name="newAnswer" type="text" class="qField form-control p-5" value="<?php print_r($_SESSION['currentAnswer']['answer']); ?>" required>
                        </div>
                        <div class="form-inline">
                            <button type="submit" name='updateAnswer' class="btn btn-warning mx-2">Update</button>
                            <button type="submit" name='cancelUpdate' class="btn btn-danger mx-2">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <!-- =====================Edit T/F Answer============== -->

    <?php if ($_SESSION['edit_TorF_Answer']) : ?>
        <div class="container">
            <div class="row justify-content-center" style="position: relative;">
                <div id="questionEditForm" class="col col-lg-6 ">
                    <form action="" method="Post" class="p-5 bg-light shadow">
                        <div class="form-group">
                            <label for="" class="text-primary">
                                <h4>Edit Answer</h4>
                            </label>
                            <div class="form-inline">
                                <label class="text-primary p-2" for="">Current Answer</label>
                                <input style="width:70%;" class="form-control" type="text" name="" id="" value="<?php print_r($_SESSION['currentAnswer']['answer']); ?>" readonly>
                            </div>
                            <div class="form-inline p-5">
                                <label class="mx-3 text-secondary" for="">True</label>
                                <input name="newAnswer" type="radio" class="qField" value="True" required>
                                <label class="mx-3 text-secondary" for="">False</label>
                                <input name="newAnswer" type="radio" class="qField" value="False" required>
                            </div>
                        </div>
                        <div class="form-inline">
                            <button type="submit" name='updateAnswer' class="btn btn-warning mx-2">Update</button>
                            <button type="submit" name='cancelUpdate' class="btn btn-danger mx-2">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- =====================Edit Options============== -->

    <?php if ($_SESSION['editOptions']) : ?>
        <div class="container">
            <div class="row justify-content-center" style="position: relative;">
                <div id="questionEditForm" class="col col-lg-6 ">
                    <form action="" method="Post" class="p-5 bg-light shadow">
                        <div class="form-group">
                            <label for="" class="text-primary">
                                <h4>Edit Option</h4>
                            </label>
                            <input name="newOption" type="text" class="qField form-control p-5" value="<?php print_r($_SESSION['currentOption']['option']); ?>" required>
                        </div>
                        <div class="form-inline">
                            <button type="submit" name='updateOption' class="btn btn-warning mx-2">Update</button>
                            <button type="submit" name='cancelUpdate' class="btn btn-danger mx-2">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <?php endif; ?>

    <!-- =====================Edit Image============== -->

    <?php if ($_SESSION['editImage']) : ?>
        <div class="container">
            <div class="row justify-content-center" style="position: relative;">
                <div id="questionEditForm" class="col col-lg-6 ">
                    <form action="" method="Post" class="p-5 bg-light shadow" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="" class="text-primary">
                                <h4 class="text-center">Edit Image</h4>
                            </label>
                            <br>
                            <div class="img text-center">
                                <img id="prv<?php print_r($_SESSION['currentImage']['id']); ?>" style="height:300px;" class='text-center' src="<?php print_r($_SESSION['currentImage']['pic_path']); ?>" alt="">
                            </div>
                            <div class="form-group text-center p-2">
                                <input name="newPicture" type="file" onchange='change(this,`<?php print_r($_SESSION['currentImage']['id']); ?>`)' id="id<?php print_r($_SESSION['currentImage']['id']); ?>" style="display: none;" accept="image/*">

                                <a class="btn btn-outline-primary" onclick="test(<?php print_r($_SESSION['currentImage']['id']); ?>)">Select Image</a>
                            </div>
                            <br><br>
                        </div>
                        <div class="form-inline justify-content-center">
                            <button type="submit" name='updateImage' class="btn btn-warning mx-2" value="<?php print_r($_SESSION['currentImage']['id']); ?>">Update</button>
                            <button type="submit" name='cancelUpdate' class="btn btn-danger mx-2">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- =====================Add Image============== -->

    <?php if ($_SESSION['addImage']) : ?>
        <div class="container">
            <div class="row justify-content-center" style="position: relative;">
                <div id="questionEditForm" class="col col-lg-6 ">
                    <form action="" method="Post" class="p-5 bg-light shadow" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="" class="text-primary">
                                <h4 class="text-center">Add Image</h4>
                            </label>
                            <br>
                            <div class="img text-center">
                                <img id="prv<?php print_r($_SESSION['image']['id']); ?>" style="height:300px;" class='text-center' src="" alt="">
                            </div>
                            <div class="form-group text-center p-2">
                                <input name="newPicture" type="file" onchange='change(this,`<?php print_r($_SESSION['image']['id']); ?>`)' id="id<?php print_r($_SESSION['image']['id']); ?>" style="display: none;" accept="image/*">

                                <a class="btn btn-outline-primary" onclick="test(<?php print_r($_SESSION['image']['id']); ?>)">Select Image</a>
                            </div>
                            <br><br>
                        </div>
                        <div class="form-inline justify-content-center">
                            <button type="submit" name='updateImage' class="btn btn-warning mx-2" value="<?php print_r($_SESSION['image']['id']); ?>">Save</button>
                            <button type="submit" name='cancelUpdate' class="btn btn-danger mx-2">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="container bg-light mt-5 mb-5">
        <div class="row mt-2">
            <div class="col col-lg-12 shadow p-0">

                <!-- ================================================================================= -->

                <!-- =====================================Header====================================== -->
                <header class="form-inline text-light bg-primary p-5 justify-content-between mb-4">
                    <div class="row">
                        <div class="col text-start">
                            <p class="title">View Assessment</p>
                        </div>
                        <div class="col text-end">
                            <form class="" action="../controller.php" method="Post">
                                <button class="btn btn-warning" name="viewList">Go back</button>
                            </form>
                        </div>
                    </div>
                </header>
                <!--=============================Button Next=====================================-->

                <div class="section px-5 pt-2">
                    <div class="q-section">
                        <div class="q-section text-right">
                            <!-- <form action="" method="Post"> -->

                        </div>
                        <!-- <h4 class="text-center">Questions will appear one at a time.</h4> -->

                        <!--=============================Form =====================================-->
                        <?php while ($datas = $result->fetch_assoc()) { ?>
                            <!-- <form class=" pb-5" action="" style="line-height:30px;"> -->

                            <!--=============================M choice=====================================-->

                            <?php if ($datas['type'] == 1) { ?>
                                <div class="section pb-4 border-bottom">
                                    <label for="" class="bg-primary w-100 rounded px-3 py-2">
                                        <h4 class="text-light ">Multiple Choice</h4>
                                    </label>
                                    <div class="px-3">
                                        <form action="" method='Post'>
                                            <div class="form-group my-3">
                                                <div class="d-flex justify-content-between my-2">
                                                    <label class="ml-3 mr-2" for="">
                                                        <h4><small>Question</small></h4>
                                                    </label>
                                                    <button class="btn btn-outline-warning" type="submit" name="editQuest" value="<?php print_r($datas['id']); ?>">
                                                        Edit
                                                    </button>
                                                </div>
                                                <input style="font-size:20px;" type="text" class="form-control p-5" value="<?php print_r($datas['question']); ?> " readonly>
                                            </div>
                                        </form>

                                        <?php if (!empty($datas['pic_path'])) { ?>
                                            <div id="div<?php print_r($datas['id']); ?>" class="img text-center mb-3">
                                                <img id="img<?php print_r($datas['id']); ?>" style="height:300px;" class='text-center' src="<?php print_r($datas['pic_path']); ?>" alt="">
                                            </div>

                                            <form action="" method="Post">
                                                <div class="form-inline d-flex justify-content-center">
                                                    <button class="btn btn-outline-warning mx-2" name="editImage" value="<?php print_r($datas['id']); ?>">Edit Image</button>
                                                    <button class="btn btn-outline-danger mx-2" name="removeImage" value="<?php print_r($datas['id']); ?>" onclick="verify(this)">Remove Image</button>
                                                </div>
                                            </form>


                                        <?php } else { ?>
                                            <form action="" method="Post">
                                                <div class="form-inline d-flex justify-content-center">
                                                    <button class="btn btn-outline-primary" name="addImage" value="<?php print_r($datas['id']); ?>">Add Image</button>
                                                </div>
                                            </form>

                                        <?php } ?>
                                        <!--===========================M choice Genrerate Options=================-->
                                        <div class="row mt-3">
                                            <div class="col col-lg-6 pl-5">
                                                <label for="" class="ms-2">Options</label>
                                                <?php
                                                $id = $datas['id'];
                                                $options = $mysql->query("SELECT * FROM `choices` WHERE `question_id`='$id'");
                                                ?>

                                                <form action="" method="Post">
                                                    <?php while ($choice = $options->fetch_assoc()) { ?>
                                                        <div class="form-inline d-flex py-2">
                                                            <div class=" flex-fill px-2">
                                                                <input style="" class="form-control" type="text" name="Option<?= $choice['id']; ?>" id="" value="<?= $choice['option']; ?>" readonly>
                                                            </div>
                                                            <button value="<?= $choice['id']; ?>" class="btn btn-outline-warning" name="editOption">Edit</button><br>
                                                        </div>

                                                    <?php } ?>
                                                </form>
                                                <form action="" method="Post">
                                                    <div class="form-inline d-flex">
                                                        <div class=" flex-fill px-2">
                                                            <label class="" for="">Answer</label>
                                                            <?php $answer = getAnswer($datas['id']); ?>
                                                            <input value="<?php print_r($answer['answer']); ?>" class="form-control mr-4" type="text" min=0 readonly>
                                                        </div>
                                                        <button name="editAnswer" type="submit" class="btn btn-outline-warning mt-4" value="<?php print_r($answer['id']); ?>">Edit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <div class="last row mt-4">
                                            <div class="col">
                                                <form action="" method="Post">
                                                    <div class="form-inline d-flex">
                                                        <div class=" flex-fill px-2">
                                                            <label class="" for="">Points&nbsp;&nbsp;</label>
                                                            <input value="<?php print_r($datas['points']); ?>" class="form-control mr-4" type="text" min=0 readonly>
                                                        </div>
                                                        <button name="editPoints" type="submit" class="btn btn-outline-warning mt-4" value="<?php print_r($datas['id']); ?>">Edit</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col">
                                                <form action="" method="Post">
                                                    <div class="form-inline d-flex">
                                                        <div class=" flex-fill px-2">
                                                            <label class="" for="">Timer&nbsp;&nbsp;</label>
                                                            <input value="<?php print_r($datas['timer']); ?> Min." class="form-control mr-4" type="text" min=0 readonly>
                                                        </div>
                                                        <button name="editTimer" type="submit" class="btn btn-outline-warning mt-4" value="<?php print_r($datas['id']); ?>">Edit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            <?php } ?>
                            <!--=============================True or Falls=====================================-->

                            <?php if ($datas['type'] == 2) { ?>
                                <div class="section pb-4 border-bottom">
                                    <label for="" class="bg-primary w-100 rounded px-3 py-2">
                                        <h4 class="text-light ">True or False</h4>
                                    </label>
                                    <div class="px-3">
                                        <form action="" method='Post'>
                                            <div class="form-group my-3">
                                                <div class="d-flex justify-content-between my-2">
                                                    <label class="ml-3 mr-2" for="">
                                                        <h4><small>Question</small></h4>
                                                    </label>
                                                    <button class="btn btn-outline-secondary" type="submit" name="editQuest" value="<?php print_r($datas['id']); ?>">
                                                        Edit
                                                    </button>
                                                </div>

                                                <input style="font-size:20px;" type="text" class="form-control p-5" value="<?php print_r($datas['question']); ?> " readonly>
                                            </div>
                                        </form>

                                        <?php if (!empty($datas['pic_path'])) { ?>
                                            <div id="div<?php print_r($datas['id']); ?>" class="img text-center mb-3">
                                                <img id="img<?php print_r($datas['id']); ?>" style="height:300px;" class='text-center' src="<?php print_r($datas['pic_path']); ?>" alt="">
                                            </div>

                                            <form action="" method="Post">
                                                <div class="form-inline d-flex justify-content-center">
                                                    <button class="btn btn-outline-secondary mx-2" name="editImage" value="<?php print_r($datas['id']); ?>">Edit Image</button>
                                                    <button class="btn btn-outline-secondary mx-2" name="removeImage" value="<?php print_r($datas['id']); ?>" onclick="verify(this)">Remove Image</button>
                                                </div>
                                            </form>


                                        <?php } else { ?>
                                            <form action="" method="Post">
                                                <div class="form-inline d-flex justify-content-center">
                                                    <button class="btn btn-outline-primary" name="addImage" value="<?php print_r($datas['id']); ?>">Add Image</button>
                                                </div>
                                            </form>

                                        <?php } ?>
                                        <form action="" method="Post" class="mt-4">
                                            <div class="form-inline">
                                                <label class="mx-3" for="">Answer</label>
                                                <?php $answer = getAnswer($datas['id']); ?>
                                                <input value="<?php print_r($answer['answer']); ?>" class="form-control mr-4" type="text" min=0 readonly>
                                                <button name="edit_TorF_Answer" type="submit" class="btn btn-outline-warning" value="<?php print_r($answer['id']); ?>">Edit</button><br>
                                            </div>
                                        </form>
                                        <div class="last row mt-4">
                                            <div class="col">
                                                <form action="" method="Post">
                                                    <div class="form-inline d-flex">
                                                        <div class=" flex-fill px-2">
                                                            <label class="mx-3" for="">Points&nbsp;&nbsp;</label>
                                                            <input value="<?php print_r($datas['points']); ?>" class="form-control mr-4" type="text" min=0 readonly>
                                                        </div>
                                                        <button name="editPoints" type="submit" class="btn btn-outline-warning mt-4" value="<?php print_r($datas['id']); ?>">Edit</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col">
                                                <form action="" method="Post">
                                                    <div class="form-inline d-flex">
                                                        <div class=" flex-fill px-2">
                                                            <label class="mx-3" for="">Timer&nbsp;&nbsp;</label>
                                                            <input value="<?php print_r($datas['timer']); ?> Min." class="form-control mr-4" type="text" min=0 readonly>
                                                        </div>
                                                        <button name="editTimer" type="submit" class="btn btn-outline-warning mt-4" value="<?php print_r($datas['id']); ?>">Edit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            <?php } ?>

                            <!--=============================Identifidation=====================================-->

                            <?php if ($datas['type'] == 3) { ?>
                                <div class="section pb-4 border-bottom">
                                    <label for="" class="bg-primary w-100 rounded px-3 py-2">
                                        <h4 class="text-light ">Identification</h4>
                                    </label>
                                    <div class="px-3">
                                        <form action="" method='Post'>
                                            <div class="form-group my-3">
                                                <div class="d-flex justify-content-between my-2">
                                                    <label class="ml-3 mr-2" for="">
                                                        <h4><small>Question</small></h4>
                                                    </label>
                                                    <button class="btn btn-outline-secondary" type="submit" name="editQuest" value="<?php print_r($datas['id']); ?>">
                                                        Edit
                                                    </button>
                                                </div>
                                                <input style="font-size:20px;" type="text" class="form-control p-5" value="<?php print_r($datas['question']); ?> " readonly>
                                            </div>
                                        </form>

                                        <?php if (!empty($datas['pic_path'])) { ?>
                                            <div id="div<?php print_r($datas['id']); ?>" class="img text-center mb-3">
                                                <img id="img<?php print_r($datas['id']); ?>" style="height:300px;" class='text-center' src="<?php print_r($datas['pic_path']); ?>" alt="">
                                            </div>

                                            <form action="" method="Post">
                                                <div class="form-inline d-flex justify-content-center">
                                                    <button class="btn btn-outline-warning mx-2" name="editImage" value="<?php print_r($datas['id']); ?>">Edit Image</button>
                                                    <button class="btn btn-outline-danger mx-2" name="removeImage" value="<?php print_r($datas['id']); ?>" onclick="verify(this)">Remove Image</button>
                                                </div>
                                            </form>



                                        <?php } else { ?>
                                            <form action="" method="Post">
                                                <div class="form-inline d-flex justify-content-center">
                                                    <button class="btn btn-outline-primary" name="addImage" value="<?php print_r($datas['id']); ?>">Add Image</button>
                                                </div>
                                            </form>

                                        <?php } ?>

                                        <form action="" method="Post" class="mt-4">
                                            <div class="form-inline d-flex">
                                                <div class=" flex-fill px-2">
                                                    <label class="mx-3" for="">Answer</label>
                                                    <?php $answer = getAnswer($datas['id']); ?>
                                                    <input value="<?php print_r($answer['answer']); ?>" class="form-control mr-4" type="text" min=0 readonly>
                                                </div>

                                                <button name="editAnswer" type="submit" class="btn btn-outline-warning mt-4" value="<?php print_r($answer['id']); ?>">Edit</button><br>
                                            </div>
                                        </form>
                                        <div class="last row mt-4">
                                            <div class="col">
                                                <form action="" method="Post">
                                                    <div class="form-inline d-flex">
                                                        <div class=" flex-fill px-2">
                                                            <label class="mx-3" for="">Points&nbsp;&nbsp;</label>
                                                            <input value="<?php print_r($datas['points']); ?>" class="form-control mr-4" type="text" min=0 readonly>
                                                        </div>
                                                        <button name="editPoints" type="submit" class="btn btn-outline-warning mt-4" value="<?php print_r($datas['id']); ?>">Edit</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col">
                                                <form action="" method="Post">
                                                    <div class="form-inline d-flex">
                                                        <div class=" flex-fill px-2">
                                                            <label class="mx-3" for="">Timer&nbsp;&nbsp;</label>
                                                            <input value="<?php print_r($datas['timer']); ?> Min." class="form-control mr-4" type="text" min=0 readonly>
                                                        </div>
                                                        <button name="editTimer" type="submit" class="btn btn-outline-warning mt-4" value="<?php print_r($datas['id']); ?>">Edit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            <?php } ?>
                            <!--=============================Essay=====================================-->

                            <?php if ($datas['type'] == 4) { ?>
                                <div class="section pb-4 border-bottom">
                                    <label for="" class="bg-primary w-100 rounded px-3 py-2">
                                        <h4 class="text-light  ">Essay</h4>
                                    </label>
                                    <div class="px-3">
                                        <form action="" method='Post'>
                                            <div class="form-group my-3">
                                                <div class="d-flex justify-content-between my-2">
                                                    <label class="ml-3 mr-2" for="">
                                                        <h4><small>Question</small></h4>
                                                    </label>
                                                    <button class="btn btn-outline-warning" type="submit" name="editQuest" value="<?php print_r($datas['id']); ?>">
                                                        Edit
                                                    </button>
                                                </div>
                                                <input style="font-size:20px;" type="text" class="form-control p-5" value="<?php print_r($datas['question']); ?> " readonly>
                                            </div>
                                        </form>

                                        <?php if (!empty($datas['pic_path'])) { ?>
                                            <div id="div<?php print_r($datas['id']); ?>" class="img text-center">
                                                <img id="img<?php print_r($datas['id']); ?>" style="height:300px;" class='text-center' src="<?php print_r($datas['pic_path']); ?>" alt="">
                                            </div>

                                            <form action="" method="Post">
                                                <div class="form-inline d-flex justify-content-center">
                                                    <button class="btn btn-outline-secondary mx-2" name="editImage" value="<?php print_r($datas['id']); ?>">Edit Image</button>
                                                    <button class="btn btn-outline-secondary mx-2" name="removeImage" value="<?php print_r($datas['id']); ?>" onclick="verify(this)">Remove Image</button>
                                                </div>
                                            </form>


                                        <?php } else { ?>
                                            <form action="" method="Post">
                                                <div class="form-inline d-flex justify-content-center">
                                                    <button class="btn btn-outline-primary" name="addImage" value="<?php print_r($datas['id']); ?>">Add Image</button>
                                                </div>
                                            </form>
                                        <?php } ?>
                                        <div class="last row mt-4">
                                            <div class="col">
                                                <form action="" method="Post">
                                                    <div class="form-inline d-flex">
                                                        <div class=" flex-fill px-2">
                                                            <label class="mx-3" for="">Points&nbsp;&nbsp;</label>
                                                            <input value="<?php print_r($datas['points']); ?>" class="form-control mr-4" type="text" min=0 readonly>
                                                        </div>
                                                        <button name="editPoints" type="submit" class="btn btn-outline-warning mt-4" value="<?php print_r($datas['id']); ?>">Edit</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col">
                                                <form action="" method="Post">
                                                    <div class="form-inline d-flex">
                                                        <div class=" flex-fill px-2">
                                                            <label class="mx-3" for="">Timer&nbsp;&nbsp;</label>
                                                            <input value="<?php print_r($datas['timer']); ?> Min." class="form-control mr-4" type="text" min=0 readonly>
                                                        </div>
                                                        <button name="editTimer" type="submit" class="btn btn-outline-warning mt-4" value="<?php print_r($datas['id']); ?>">Edit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            <?php } ?>
                            <div class="space p-3"></div>
                            <!-- </form>
                            </form> -->
                        <?php } ?>
                    </div>
                </div>

                <!--=============================End of Questions=====================================-->

            </div>
        </div>
    </div>
    <script>
        const verify = (e) => {



        }

        const test = (val) => {
            // alert(val)
            const value = document.querySelector(`#id${val}`)

            value.click()
        }
        const remove = (val) => {
            const value = document.querySelector(`#div${val}`)
            value.remove()

        }
        const change = (e, id) => {

            if (e.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector(`#prv${id}`).setAttribute('src', e.target.result);
                }
                reader.readAsDataURL(e.files[0]);
            }
        }
    </script>
</body>

</html>