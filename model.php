<?php


function connect()
{
    $mysql = new mysqli('localhost', 'root', '', 'users');
    return $mysql;
}


function isUnique($email)
{
    $mysql = connect();
    if (teacher($email)[0] > 0 or student($email)[0] > 0)
        return false;

    return true;
}

function create($fname, $lname, $email, $password, $userType)
{
    $mysql = connect();
    if ($mysql->connect_error)
        echo $mysql->connect_error;

    if ($userType == 1) {
        $command = "INSERT INTO teacher (first_name,last_name,email,password,user_type,pic_path,status) VALUES ('$fname','$lname','$email','$password','$userType','uploads/myFile.png','1')";
    } else {
        $command = "INSERT INTO student (first_name,last_name,email,password,user_type,pic_path,status) VALUES ('$fname','$lname','$email','$password','$userType','uploads/myFile.png','1')";
    }

    $mysql->query($command) or die($mysql->error);
}

function searchAccount($email)
{
    $mysql = connect();
    if (teacher($email)[0] < 1 and student($email)[0] < 1)
        return;

    if (teacher($email)[0] > 0) {
        $teacher = $mysql->query("SELECT * FROM teacher WHERE email='$email'");
        $info = $teacher->fetch_assoc();
        return $info;
    }
    if (student($email)[0] > 0) {
        $student = $mysql->query("SELECT * FROM student WHERE email='$email'");
        $info = $student->fetch_assoc();
        return $info;
    }
}

function teacher($email)
{
    $mysql = connect();
    $con1 = $mysql->query("SELECT COUNT(id) FROM teacher WHERE email='$email'") or die($mysql->connect_error);
    $teacher = array_values($con1->fetch_assoc());
    return $teacher;
}

function student($email)
{
    $mysql = connect();
    $con2 = $mysql->query("SELECT COUNT(id) FROM student WHERE email='$email'") or die($mysql->connect_error);
    $student = array_values($con2->fetch_assoc());
    return $student;
}

// ============================================Update============================================================//

function passwordUpdate($email, $newPass, $userType)
{
    $mysql = connect();
    if ($userType == 1)
        $mysql->query("UPDATE teacher  SET password='$newPass' WHERE email='$email'") or die($mysql->connect_error);
    else
        $mysql->query("UPDATE student  SET password='$newPass' WHERE email='$email'") or die($mysql->connect_error);
}

function updateInformations($fname, $lname, $email, $userType, $id)
{
    $mysql = connect();
    if ($userType == 1)
        $mysql->query("UPDATE teacher  SET first_name='$fname',last_name='$lname',email='$email' WHERE id='$id'") or die($mysql->connect_error);
    else
        $mysql->query("UPDATE student  SET first_name='$fname',last_name='$lname',email='$email' WHERE id='$id'") or die($mysql->connect_error);
}

function picUpdate($userType, $id, $path)
{
    $mysql = connect();
    if ($userType == 1)
        $mysql->query("UPDATE teacher  SET pic_path='$path' WHERE id='$id'") or die($mysql->connect_error);
    else
        $mysql->query("UPDATE student  SET pic_path='$path' WHERE id='$id'") or die($mysql->connect_error);
}

function passwordRequests($email, $user_type, $validity, $token)
{
    $mysql = connect();
    $mysql->query("DELETE FROM passwordreset WHERE email='$email'");
    $mysql->query("INSERT INTO passwordreset (email,token,validity,user_type) VALUES ('$email','$token','$validity','$user_type')") or die($mysql->connect_error);
}
function checkRequest($email)
{
    $mysql = connect();
    $result = $mysql->query("SELECT * FROM passwordreset WHERE email='$email'") or die();
    return $result->fetch_assoc();
}

function uniqueRoom($roomName, $teacherId)
{

    $mysql = connect();
    $count = $mysql->query("SELECT COUNT(class_name) FROM classroom WHERE class_name='$roomName' AND teacher_id='$teacherId'") or die($mysql->connect_error);
    $result = array_values($count->fetch_assoc());
    if ($result[0] > 0)
        return false;
    else
        return true;
}


function uniqueCode($code)
{

    $mysql = connect();
    $count = $mysql->query("SELECT COUNT(`classCode`) FROM `classroom` WHERE `classCode`='$code'") or die($mysql->connect_error);
    $result = array_values($count->fetch_assoc());
    if ($result[0] > 0)
        return false;
    else
        return true;
}


function removeFromClass($studentId, $classId)
{
    $mysql = connect();
    $mysql->query("DELETE FROM `subject` WHERE student_id='$studentId' AND classroom_id='$classId'") or die($mysql->connect_error);
}


function newRoom($id, $description, $classCode)
{
    $mysql = connect();
    $mysql->query("INSERT INTO classroom (class_name,teacher_id,classCode) VALUES ('$description','$id','$classCode')") or die($mysql->connect_error);
}


function searchClassRoom($id)
{
    $mysql = connect();
    $rooms =  $mysql->query("SELECT * FROM classroom WHERE teacher_id='$id' ORDER BY class_name") or die($mysql->connect_error);

    return $rooms;
}

function classRoomExist($classCode)
{
    $mysql = connect();
    $count = $mysql->query("SELECT COUNT(`classCode`) FROM `classroom` WHERE `classCode`='$classCode'") or die($mysql->connect_error);
    $result = array_values($count->fetch_assoc());
    if ($result[0] > 0)
        return true;
    else
        return false;
}

function isOnSubject($classId, $studentId)
{
    $mysql = connect();
    $count = $mysql->query("SELECT COUNT(`student_id`) FROM `subject` WHERE `student_id`='$studentId' AND `classroom_id`='$classId'") or die($mysql->connect_error);
    $result = array_values($count->fetch_assoc());
    if ($result[0] > 0)
        return true;
    else
        return false;
}

function isOnRequest($classId, $studentId)
{
    $mysql = connect();
    $count = $mysql->query("SELECT COUNT(`student_id`) FROM `request` WHERE `student_id`='$studentId' AND `classroom_id`='$classId'") or die($mysql->connect_error);
    $result = array_values($count->fetch_assoc());
    if ($result[0] > 0)
        return true;
    else
        return false;
}

function getClassInfo($classCode)
{
    $mysql = connect();
    $classInfo =  $mysql->query("SELECT * FROM classroom WHERE `classCode`='$classCode'") or die($mysql->connect_error);
    $result = $classInfo->fetch_assoc();

    return $result;
}

function getClassTeacher($id)
{
    $mysql = connect();
    $classTeacher =  $mysql->query("SELECT * FROM teacher WHERE `id`='$id'") or die($mysql->connect_error);
    $result = $classTeacher->fetch_assoc();

    return $result;
}

function searchSubjects($id)
{
    $mysql = connect();
    $rooms =  $mysql->query("SELECT * FROM subject WHERE `student_id`='$id'") or die($mysql->connect_error);
    return $rooms;
}

function sendRequest($student_id, $teacher_id, $classroom_id)
{
    $mysql = connect();
    $mysql->query("INSERT INTO `request`(`student_id`,`teacher_id`,`classroom_id`) VALUES ('$student_id','$teacher_id','$classroom_id')") or die($mysql->connect_error);
}



function getClassName($id)
{
    $mysql = connect();
    $className =  $mysql->query("SELECT * FROM classroom WHERE `classroom_id`='$id'") or die($mysql->connect_error);
    $result = $className->fetch_assoc();

    return $result;
}

function renameClassroom($classroomId, $newName)
{
    $mysql = connect();
    $rooms =  $mysql->query("UPDATE `classroom` SET `class_name`='$newName' WHERE `classroom_id`='$classroomId'") or die($mysql->connect_error);
}

function deleteClassroom($classroomId)
{
    $mysql = connect();
    $mysql->query("DELETE FROM `classroom` WHERE `classroom_id`='$classroomId'") or die($mysql->connect_error);
}
function deleteSubject($classroomId)
{
    $mysql = connect();
    $mysql->query("DELETE FROM `subject` WHERE `classroom_id`='$classroomId'") or die($mysql->connect_error);
}
function deleteRequest($classroomId)
{
    $mysql = connect();
    $mysql->query("DELETE FROM `request` WHERE `classroom_id`='$classroomId'") or die($mysql->connect_error);
}

function updateReset($email)
{
    $validity = date("U");
    $mysql = connect();
    $mysql->query("UPDATE passwordreset SET validity='$validity' WHERE email='$email'") or die($mysql->connect_error);
}


function studentCount($classId)
{
    $mysql = connect();
    $count = $mysql->query("SELECT COUNT(`student_id`) FROM `subject` WHERE `classroom_id`='$classId'") or die($mysql->connect_error);
    $result = array_values($count->fetch_assoc());
    return $result[0];
}

function requestCount($classId)
{
    $mysql = connect();
    $count = $mysql->query("SELECT COUNT(`student_id`) FROM `request` WHERE `classroom_id`='$classId'") or die($mysql->connect_error);
    $result = array_values($count->fetch_assoc());
    return $result[0];
}


// ==============================================Second Part===============================================//

function setStatusActive($id, $userType)
{
    $mysql = connect();
    if ($userType == 1)
        $mysql->query("UPDATE `teacher` SET `status`=1 WHERE `id`='$id'");
    else
        $mysql->query("UPDATE `student` SET `status`=1 WHERE `id`='$id'");
}

function setStatusInActive($id, $userType)
{
    $mysql = connect();
    if ($userType == 1)
        $mysql->query("UPDATE `teacher` SET `status`=2 WHERE `id`='$id'");
    else
        $mysql->query("UPDATE `student` SET `status`=2 WHERE `id`='$id'");
}

function checkStatus($id, $userType)
{
    $mysql = connect();
    if ($userType == 1) {
        $result = $mysql->query("SELECT `status` FROM `teacher` WHERE `id`='$id'");
        $status = $result->fetch_assoc();
        return $status['status'];
    } else {
        $result = $mysql->query("SELECT `status` FROM `student` WHERE `id`='$id'");
        $status = $result->fetch_assoc();
        return $status['status'];
    }
}

function studentList($classId)
{
    $mysql = connect();
    return $mysql->query("SELECT student_id FROM subject WHERE classroom_id ='$classId' ORDER BY last_name");
}

function getStudent($id)
{
    $mysql = connect();
    return $mysql->query("SELECT * FROM student WHERE  id ='$id'");
}

function requestList($classId)
{
    $mysql = connect();
    return $mysql->query("SELECT * FROM request WHERE classroom_id ='$classId'");
}

function acceptRequest($studentId, $teacherId, $classroomId, $lastName)
{
    $mysql = connect();
    $mysql->query("INSERT INTO subject (student_id,teacher_id,classroom_id,last_name) VALUES ('$studentId','$teacherId','$classroomId','$lastName') ");
}

function removeRequest($studentId, $classroomId)
{
    $mysql = connect();
    $mysql->query("DELETE FROM request WHERE student_id='$studentId' AND classroom_id='$classroomId'");
}

function modify($id)
{
    $mysql = connect();
    return $mysql->query("SELECT * FROM `assessments` WHERE `id`=$id");
}
function deleteAssessment($id)
{
    $mysql = connect();
    $mysql->query("DELETE FROM `answers` WHERE `assessment_id`='$id'");
    $mysql->query("DELETE FROM `choices` WHERE `assessment_id`='$id'");
    $mysql->query("DELETE FROM `questions` WHERE `assessment_id`='$id'");
    $mysql->query("DELETE FROM `assessments` WHERE id='$id'");
}

function updateAssessment($id, $title, $time_start, $time_end, $randomize, $date)
{
    $mysql = connect();
    $mysql->query("UPDATE `assessments` SET `title`='$title',`time_start`='$time_start',`time_end`='$time_end',`randomize`='$randomize',`date`='$date' WHERE `id`='$id'");
}

// ====================================Student's View==========================================

function getStudentAssessments($class_id)
{
    $mysql = connect();
    $result = $mysql->query("SELECT * FROM `assessments` WHERE `class_id`='$class_id'");
    return $result;
}
function now()
{
    $mysql = connect();
    $result =  $mysql->query("SELECT CURDATE()");
    return $result->fetch_assoc();
}
function present()
{
    $mysql = connect();
    $result =  $mysql->query("SELECT NOW()");
    return $result->fetch_assoc();
}

function loadQuestions($currentId)
{
    $mysql = connect();
    $result = $mysql->query("SELECT * FROM `questions` WHERE `assessment_id`='$currentId'");
    return $result;
}

function loadOptions($id)
{
    $mysql = connect();
    $result = $mysql->query("SELECT * FROM `choices` WHERE `question_id`='$id'");
    return $result;
}

//===============================Responses=======================================

function addResponse($question_id, $student_id, $assessment_id, $answer, $points)
{

    $mysql = connect();
    $mysql->query("INSERT INTO `response` (`question_id`,`student_id`,`assessment_id`,`answer`,`points`) VALUES ('$question_id','$student_id','$assessment_id','$answer','$points')");
}
function getAnswers($question_id)
{

    $mysql = connect();
    $result = $mysql->query("SELECT `answer` FROM `answers` WHERE `question_id`='$question_id'");
    return $result->fetch_assoc();
}

function finished($assessment_id, $student_id)
{

    $mysql = connect();
    $count = $mysql->query("SELECT COUNT(`student_id`) FROM `finished` WHERE `assessment_id`='$assessment_id' AND `student_id`='$student_id'") or die($mysql->connect_error);
    $result = array_values($count->fetch_assoc());
    if ($result[0] > 0)
        echo 'false';
    else
        echo $assessment_id . " =========== " . $student_id;
}

function take($assessment_id, $student_id)
{

    $mysql = connect();
    $date = present();
    $dateNow =   $date['NOW()'];
    $mysql->query("INSERT INTO `taken` (`assessment_id`,`student_id`,`date_taken`) VALUES ('$assessment_id','$student_id','$dateNow')");
}

function updateSubmission($assessment_id, $student_id)
{

    $mysql = connect();
    $date = present();
    $dateNow =   $date['NOW()'];
    $mysql->query("UPDATE `taken` SET `date_taken`='$dateNow' WHERE `assessment_id`='$assessment_id' AND `student_id`='$student_id'");
}

function taken($assessment_id, $student_id)
{

    $mysql = connect();
    $count = $mysql->query("SELECT COUNT(`student_id`) FROM `taken` WHERE `assessment_id`='$assessment_id' AND `student_id`='$student_id'") or die($mysql->connect_error);
    $result = array_values($count->fetch_assoc());
    if ($result[0] > 0)
        return true;
    else
        return false;
}
function showResult($student, $classroom)
{
    $mysql = connect();
    $result = $mysql->query("SELECT * FROM `showResult` WHERE `Student_Id`='$student' AND `Classroom_Id`='$classroom'");
    return $result;
}

function showScores($assessment)
{

    $mysql = connect();
    $result = $mysql->query("SELECT * FROM `viewscores` WHERE `assessment_id`='$assessment'");
    return $result;
}

function reviewScores($studentId, $assessment)
{
    $mysql = connect();
    $result = $mysql->query("SELECT * FROM `viewscores` WHERE `id`='$studentId' AND `assessment_id`='$assessment'");
    return $result->fetch_assoc();
}

function loadAssessments($class_id)
{
    $mysql = connect();
    $result = $mysql->query("SELECT * FROM `assessments` WHERE `class_id`='$class_id' ORDER BY `date` DESC");
    return $result;
}

function getResponse($id, $sId)
{
    $mysql = connect();
    $result = $mysql->query("SELECT * FROM `response` WHERE `question_id`='$id' AND `student_id`='$sId'");
    return $result->fetch_assoc();
}

function modifyPointsInResponse($id, $newVal)
{
    $mysql = connect();
    $mysql->query("UPDATE `response` SET `points`='$newVal' WHERE `id`='$id'");
}
