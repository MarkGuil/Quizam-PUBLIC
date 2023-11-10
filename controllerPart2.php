<?php

include "controller.php";

$_SESSION['modifyPoints'] =false;
 
if(isset($_POST['studentViewAssessment'])){
    $_SESSION['loadAssessments'] = $_POST['studentViewAssessment'];
    header("location:studentAssessmentList.php");
}

 
if(isset($_POST['completed'])){
    $_SESSION['classroomId'] = $_POST['completed'];
    header("location:completed.php");
}

if(isset($_POST['backToDash'])){
    header("location:studentMain.php");
}

if(isset($_POST['backToTeacherDash'])){
    header("location:Main.php");
}

if(isset($_POST['backToViewScore'])){
    header("location:showAssessments.php");
}

if(isset($_POST['showStudentScores'])){
    $_SESSION['presentId'] = $_POST['showStudentScores'];
 header("location:viewScore.php");
}

if(isset($_POST['available'])){
    $_SESSION['currentAssessment'] = $_POST['available'];
    $_SESSION['index'] = 0;
    $_SESSION['randomized'] = false;
    $_SESSION['taken'] = false;
    take($_SESSION['currentAssessment'],$_SESSION['currentUser']['id']);
    header("location:exam.php");
}

if(isset($_POST['reviewQuestions'])){
    
    $assessment = $_POST['assessmentId'];
    $id = $_POST['reviewQuestions'];
    $_SESSION['reviewStudent'] = $id;
    $_SESSION['reviewAssessment'] = $assessment;
   
    header("location:createAssessment/reviewAnswers.php");
}


if(isset($_POST['backToList'])){
    header("location:../viewScore.php");
}

if(isset($_POST['editStudentScore'])){
    $_SESSION['currentPointsId'] = $_POST['editStudentScore'];
    $_SESSION['currentPoints'] = $_POST['currentVal'];
    $_SESSION['maxVal'] = $_POST['maxVal'];
    $_SESSION['modifyPoints']= true;
}

if(isset($_POST['saveNewPoints'])){
   
    $newVal = $_POST['updatedPoints'];
    $id = $_POST['saveNewPoints'];
    modifyPointsInResponse($id,$newVal);
  
}

?>