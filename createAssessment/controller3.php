<?php
include "model2.php";
include "../controller.php";
include "imageUpload.php";

setFalse();

function setFalse()
{
    $_SESSION['editQuestion'] = false;
    $_SESSION['editPoints'] = false;
    $_SESSION['editTimer'] = false;
    $_SESSION['editAnswer'] = false;
    $_SESSION['edit_TorF_Answer'] = false;
    $_SESSION['editOptions'] = false;
    $_SESSION['editImage'] = false;
    $_SESSION['addImage'] = false;
}
if (isset($_POST['editQuest'])) {

    $_SESSION['currentQuestionIndex'] = getQuestion($_POST['editQuest']);
    $_SESSION['editQuestion'] = true;
}

if (isset($_POST['cancelUpdate'])) {
    setFalse();
}

if (isset($_POST['updateQuestion'])) {

    $question = $_POST['newQuestion'];
    $id = $_SESSION['currentQuestionIndex']['id'];

    updateQuestion($id, $question);
}

// ============================Points======================================================

if (isset($_POST['editPoints'])) {

    $_SESSION['currentQuestionIndex'] = getQuestion($_POST['editPoints']);
    $_SESSION['editPoints'] = true;
}

if (isset($_POST['updatePoints'])) {

    $points = $_POST['newPoints'];
    $id = $_SESSION['currentQuestionIndex']['id'];

    updatePoints($id, $points);
}

// ============================Timer======================================================

if (isset($_POST['editTimer'])) {

    $_SESSION['currentQuestionIndex'] = getQuestion($_POST['editTimer']);
    $_SESSION['editTimer'] = true;
}

if (isset($_POST['updateTimer'])) {

    $time = $_POST['newTimer'];
    $id = $_SESSION['currentQuestionIndex']['id'];

    updateTimer($id, $time);
}

// ============================Answer======================================================

if (isset($_POST['edit_TorF_Answer'])) {

    $_SESSION['currentAnswer'] = getCurrentAnswer($_POST['edit_TorF_Answer']);
    $_SESSION['edit_TorF_Answer'] = true;
}

if (isset($_POST['editAnswer'])) {

    $_SESSION['currentAnswer'] = getCurrentAnswer($_POST['editAnswer']);
    $_SESSION['editAnswer'] = true;
}

if (isset($_POST['updateAnswer'])) {

    $answer = $_POST['newAnswer'];
    $id = $_SESSION['currentAnswer']['id'];

    updateAnswer($id, $answer);
}
//=======================Option================================

if (isset($_POST['editOption'])) {

    $_SESSION['currentOption'] = (getOptions($_POST['editOption']));
    $_SESSION['editOptions'] = true;
}

if (isset($_POST['updateOption'])) {

    $id = $_SESSION['currentOption']['id'];
    $option = $_POST['newOption'];

    updateOption($id, $option);
}
//======================Image================================

if (isset($_POST['editImage'])) {
    $id = $_POST['editImage'];

    $_SESSION['currentImage'] = getQuestion($id);
    $_SESSION['editImage'] = true;
}

if (isset($_POST['removeImage'])) {

    $id = $_POST['removeImage'];
    removeImage($id);
}

if (isset($_POST['updateImage'])) {

    $id = $_POST['updateImage'];
    $newPath = uploadImage($_FILES['newPicture']);
    updateImage($id, $newPath);
}

if (isset($_POST['addImage'])) {
    $id = $_POST['addImage'];

    $_SESSION['image'] = getQuestion($id);
    $_SESSION['addImage'] = true;
}

