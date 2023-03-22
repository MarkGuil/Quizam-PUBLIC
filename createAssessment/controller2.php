<?php
include '../controller.php';
include 'model2.php';
include 'imageUpload.php';

if (isset($_POST['sub'])) {

  $mysql = new mysqli('localhost', 'root', '', 'users');

  $title =      $_POST['title'];
  $date =       $_POST['date'];
  $time_start = $_POST['timeStart'];
  $time_end =   $_POST['timeEnd'];
  $randomize =  $_POST['randomize'];
  $assessmentType =  $_POST['assessmentType'];

  echo $title . '<br>';
  echo $date . '<br>';
  echo $time_start . '<br>';
  echo $time_end . '<br>';
  echo $randomize . '<br>';

  $teacherId = $_SESSION['currentUser']['id'];
  $class_id = $_SESSION['currentClassId'];


  $mysql->query("INSERT INTO assessments (`title`,`teacher_id`,`time_start`,`time_end`,`randomize`,`date`,`class_id`,`assessment_type`) VALUES ('$title','$teacherId','$time_start','$time_end','$randomize','$date','$class_id','$assessmentType')");

  //get the last inserted id
  $currentAssessmentId =  $mysql->insert_id;
  echo  $currentAssessmentId;

  echo $_POST['answers'];
  echo "<br>";
  $all = array();
  $str = str_replace(',', '', $_POST['val']);

  $arr = str_split($str, 4);
  echo '<br>';

  $index = 0;

  foreach ($arr as $que => $value) {
    $alter = str_replace(',', '', $_POST['' . $value]);
    $list = str_split($alter, 4);
    $all[$index++] = $list;
  }

  echo "<br>";
  print_r($all);
  $keys = array_keys($all);

  for ($i = 0; $i < count($all); $i++) {
    switch (questionType($all[$keys[$i]][0])) {
      case 1:
        $type = questionType($all[$keys[$i]][0]);
        $question =  $_POST[$all[$keys[$i]][1]];
        $path = uploadImage($_FILES[$all[$keys[$i]][2]]);
        $timer =  $_POST[$all[$keys[$i]][3]];
        $points =  $_POST[$all[$keys[$i]][4]];
        $answer =  $_POST[$_POST[$all[$keys[$i]][5]]];

        $mysql->query("INSERT INTO `questions` (`assessment_id`,`question`,`points`,`timer`,`type`,`pic_path`) VALUES ('$currentAssessmentId','$question','$points','$timer','$type','$path')");

        $currentQuestion = $mysql->insert_id;
        $mysql->query("INSERT INTO `answers` (`assessment_id`,`question_id`,`answer`) VALUES ('$currentAssessmentId','$currentQuestion','$answer')");

        for ($j = 6; $j < count($all[$keys[$i]]); $j++) {
          $option = $_POST[$all[$keys[$i]][$j]];
          $mysql->query("INSERT INTO `choices` (`assessment_id`,`question_id`,`option`) VALUES ('$currentAssessmentId','$currentQuestion','$option')");
        }
        echo "<br>";
        break;
      case 2:
        $type = questionType($all[$keys[$i]][0]);
        $question =  $_POST[$all[$keys[$i]][1]];
        $path = uploadImage($_FILES[$all[$keys[$i]][2]]);
        $timer =  $_POST[$all[$keys[$i]][3]];
        $points =  $_POST[$all[$keys[$i]][4]];
        $answer =  $_POST[$all[$keys[$i]][5]];

        $mysql->query("INSERT INTO `questions` (`assessment_id`,`question`,`points`,`timer`,`type`,`pic_path`) VALUES ('$currentAssessmentId','$question','$points','$timer','$type','$path')");

        $currentQuestion = $mysql->insert_id;
        $mysql->query("INSERT INTO `answers` (`assessment_id`,`question_id`,`answer`) VALUES ('$currentAssessmentId','$currentQuestion','$answer')");

        break;
      case 3:

        $type = questionType($all[$keys[$i]][0]);
        $question =  $_POST[$all[$keys[$i]][1]];
        $path = uploadImage($_FILES[$all[$keys[$i]][2]]);
        $timer =  $_POST[$all[$keys[$i]][3]];
        $points =  $_POST[$all[$keys[$i]][4]];
        $answer =  $_POST[$all[$keys[$i]][5]];

        $mysql->query("INSERT INTO `questions` (`assessment_id`,`question`,`points`,`timer`,`type`,`pic_path`) VALUES ('$currentAssessmentId','$question','$points','$timer','$type','$path')");

        $currentQuestion = $mysql->insert_id;
        $mysql->query("INSERT INTO `answers` (`assessment_id`,`question_id`,`answer`) VALUES ('$currentAssessmentId','$currentQuestion','$answer')");

        break;
      case 4:

        $type = questionType($all[$keys[$i]][0]);
        $question =  $_POST[$all[$keys[$i]][1]];
        $path = uploadImage($_FILES[$all[$keys[$i]][2]]);
        $timer =  $_POST[$all[$keys[$i]][3]];
        $points =  $_POST[$all[$keys[$i]][4]];

        $mysql->query("INSERT INTO `questions` (`assessment_id`,`question`,`points`,`timer`,`type`,`pic_path`) VALUES ('$currentAssessmentId','$question','$points','$timer','$type','$path')");
    }
  }

  header("location:../assessmentList.php");
}

function questionType($code)
{
  switch ($code) {
    case '0001':
      return 1;
    case '0002':
      return 2;
    case '0003':
      return 3;
    case '0004':
      return 4;
  }
}
