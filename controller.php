<?php
include 'model.php';
include 'mailer.php';
include 'upload.php';
include 'passwordMailer.php';

session_start();

$_SESSION['regFailed'] = false;
$_SESSION['uniqueEmail'] = true;
$_SESSION['uniqueRoom'] = true;
$_SESSION['loginFailed'] = false;
$_SESSION['emailNotFound'] = false;
$_SESSION['passwordSent'] = false;
$_SESSION['passwordChanged'] = true;
$_SESSION['passwordUpdated'] = false;
$_SESSION['classEmpty'] = true;
$_SESSION['renameRoom'] = false;
$_SESSION['roomRenamed'] = true;
$_SESSION['deleteRoom'] = false;
$_SESSION['classSearch'] = false;
$_SESSION['showSearchResult'] = false;
$_SESSION['onRequest'] = false;
$_SESSION['onSubject'] = false;
$_SESSION['requestSent'] = false;
$_SESSION['invalidClassCode'] = false;
$_SESSION['editAssessment'] = false;


if (isset($_POST['regBtn'])) {
  //local function
  getInfo();
}

if (isset($_POST['verifyBtn'])) {
  //local function
  confirmRegistration();
}

if (isset($_POST['loginBtn'])) {

  $email = $_POST['loginEmail'];
  $password =  $_POST['loginPassword'];
  //local function
  checkAccount($email, $password);
}

if (isset($_POST['resetBtn'])) {
  //local function
  passwordReset($_POST['resetEmail']);
}

if (isset($_POST['goToLogin'])) {
  header('location:index.php');
}

if (isset($_POST['showInfo'])) {
  header('location:showInfo.php');
}

if (isset($_POST['showClass'])) {
  //local function
  displayClassRoom($_SESSION['currentUser']['id']);
  header('location:viewClassroom.php');
}

if (isset($_POST['btnEdit'])) {
  header('location:editInfo.php');
}

if (isset($_POST['btnBack'])) {

  if ($_SESSION['currentUser']['user_type'] == 1)
    header('location:Main.php');
  else
    header('location:studentMain.php');
}

if (isset($_POST['btnCancel'])) {
  header('location:showInfo.php');
}

if (isset($_POST['updatePassword'])) {
  $password = encryptPassword($_POST['newPass1']);
  //local function
  updatePassword($_POST['currentPass'], $password);
}

if (isset($_POST['btnUpdateInfo'])) {
  //local function
  updateInfo($_POST['newfname'], $_POST['newlname'], $_POST['newEmail']);
  header('location:showInfo.php');
}
if (isset($_POST['createClass'])) {
  //local function
  createClassroom($_POST['classroomName'], $_POST['classCode']);
}

if(isset($_POST['createClassInvalid'])) {
  $_SESSION['uniqueRoom'] = true;
  header('location:Main.php');
}

if (isset($_POST['savePic'])) {
  $email = $_SESSION['currentUser']['email'];
  $path = uploadFile($_FILES['picture'], $email);
  //function in model
  picUpdate($_SESSION['currentUser']['user_type'], $_SESSION['currentUser']['id'], $path);
  //function in model
  $_SESSION['currentUser'] = searchAccount($email);
  header('location:editInfo.php');
}

if (isset($_POST['btnPassChange'])) {
  $password = encryptPassword($_POST['newpass1']);
  //function in model
  passwordUpdate($_POST['email'], $password, $_POST['user_type']);
  //function in model
  updateReset($_POST['email']);
  $_SESSION['passwordUpdated'] = true;
}

/*/ =================================Functions==============================================/*/


function getInfo()
{
  $email = $_POST['email'];
  //function in model
  if (!isUnique($email))
    $_SESSION['uniqueEmail'] = false;

  else {
    $fullName = $_POST['fname'] . "  " . $_POST['lname'];
    $_SESSION['username'] = $_POST['fname'];
    $_SESSION['fname'] = $_POST['fname'];
    $_SESSION['lname'] = $_POST['lname'];
    $_SESSION['password'] = $_POST['password1'];
    $_SESSION['email'] = $email;
    $_SESSION['userType'] = $_POST['regBtn'];
    //function in mailer
    $_SESSION['code'] = sendVericationCode($fullName, $email);
    header('location:verify.php');
  }
}

function confirmRegistration()
{
  $code = $_SESSION['code'];
  $vCode = $_POST['vCode'];
  if ($code == $vCode) {
    //local Function
    $password = encryptPassword($_SESSION['password']);
    create(
      $_SESSION['fname'],
      $_SESSION['lname'],
      $_SESSION['email'],
      $password,
      $_SESSION['userType']
    );
    header('location:welcome.php');
  } else {
    $_SESSION['regFailed'] = true;
  }
}

function checkAccount($email, $password)
{
  //function in model
  $info = searchAccount($email);
  if ($info == null)
    $_SESSION['loginFailed'] = true;
  else {
    if (password_verify($password, $info['password'])) {
      $_SESSION['currentUser'] = $info;
      if ($info['user_type'] == 1)
        header('location:Main.php');
      else
        header('location:studentMain.php');

      setStatusActive($info['id'], $info['user_type']);
      $_SESSION['loginFailed'] = false;
    } else
      $_SESSION['loginFailed'] = true;
  }
}

function passwordReset($email)
{
  //function in model
  $info = searchAccount($email);
  if ($info == null)
    $_SESSION['emailNotFound'] = true;
  else {
    $token = password_hash(rand(1000, 10000), PASSWORD_DEFAULT);
    //passwordMailer Function
    $validity = sendResetLink($info['first_name'], $info['email'], $info['user_type'], $token);
    //function in model
    passwordRequests($email, $info['user_type'], $validity, $token);
    $_SESSION['passwordSent'] = true;
  }
}

function verifyPasswordReset($email)
{
  //function in model
  return checkRequest($email);
}


function updatePassword($currentPass, $newPass1)
{

  if (!password_verify($currentPass, $_SESSION['currentUser']['password']))
    $_SESSION['passwordChanged'] = false;
  else {
    //function in model
    passwordUpdate($_SESSION['currentUser']['email'], $newPass1, $_SESSION['currentUser']['user_type']);
    $_SESSION['passwordUpdated'] = true;
    $_SESSION['currentUser']['password'] = $newPass1;
  }
}

function updateInfo($fname, $lname, $email)
{

  if ($fname != $_SESSION['currentUser']['first_name'] or $lname != $_SESSION['currentUser']['last_name'] or $email != $_SESSION['currentUser']['email']) {

    if ($email != $_SESSION['currentUser']['email']) {
      //function in model
      if (isUnique($email)) {
        //function in model
        updateInformations($fname, $lname, $email, $_SESSION['currentUser']['user_type'], $_SESSION['currentUser']['id']);
      }
    } else {
      //function in model
      updateInformations($fname, $lname, $email, $_SESSION['currentUser']['user_type'], $_SESSION['currentUser']['id']);
    }
    //function in model
    $_SESSION['currentUser'] = searchAccount($email);
  }
}


function encryptPassword($password)
{
  return password_hash($password, PASSWORD_DEFAULT);
}


function displayClassRoom($id)
{
  // $_SESSION['rooms']=searchClassRoom($id);
  // echo  $_SESSION['rooms']['class_name'];
}

function createClassroom($classroomName, $classCode)
{
  //function in model

  if (uniqueRoom($classroomName, $_SESSION['currentUser']['id']))
    newRoom($_SESSION['currentUser']['id'], $classroomName, $classCode);

  else
    $_SESSION['uniqueRoom'] = false;
}

function generateClassCode()
{
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $code = '';

  for ($i = 0; $i < 6; $i++) {
    $index = rand(0, strlen($characters) - 1);
    $code .= $characters[$index];
  }

  if (uniqueCode($code))
    return  $code;
  else
    generateClassCode();
}

function isActive()
{

  if (checkStatus($_SESSION['currentUser']['id'], $_SESSION['currentUser']['user_type']) == 1)
    return true;

  return false;
}


// ===============================second part=========================================//

if (isset($_POST['backToMain'])) {
  if ($_SESSION['currentUser']['user_type'] == 1)
    header("location:Main.php");
  else
    header("location:studentMain.php");
}


if (isset($_POST['logout'])) {
  setStatusInActive($_SESSION['currentUser']['id'], $_SESSION['currentUser']['user_type']);
  session_unset();
  header('location:index.php');
}

if (isset($_POST['viewStudentList'])) {

  $_SESSION['currentClassroom'] = $_POST['classId'];
  header('location:LSEdit.php');
}

if (isset($_POST['viewRequest'])) {
  $_SESSION['currentClassroom'] = $_POST['classId'];
  header('location:Request.php');
}

if (isset($_POST['editName'])) {
  $_SESSION['currentClassId'] = $_POST['classId'];
  $className = getClassName($_POST['classId']);
  $_SESSION['currentClassName'] = $className['class_name'];
  $_SESSION['renameRoom'] = true;
}

if (isset($_POST['editNameCancelled'])) {
  $_SESSION['renameRoom'] = false;
}


if (isset($_POST['classInfo'])) {
  $_SESSION['currentClassId'] = $_POST['classId'];
  header('location:Main.php');
}

if (isset($_POST['studentDash'])) {
  $_SESSION['currentClassId'] = $_POST['classId'];
  header('location:studentMain.php');
}


if (isset($_POST['roomRename'])) {

  if (uniqueRoom($_POST['newClassroomName'], $_SESSION['currentUser']['id'])) {
    renameClassroom($_SESSION['currentClassId'], $_POST['newClassroomName']);
    $_SESSION['roomRenamed'] = true;
  } else
    $_SESSION['roomRenamed'] = false;
}
if (isset($_POST['renameRoomCancelled'])) {
  $_SESSION['roomRenamed'] = true;
  header('Location: ' . $_SERVER['HTTP_REFERER']);
}

if (isset($_POST['deleteClass'])) {
  $_SESSION['currentClassId'] = $_POST['classId'];
  $className = getClassName($_POST['classId']);
  $_SESSION['currentClassName'] = $className['class_name'];
  $_SESSION['deleteRoom'] = true;
}

if (isset($_POST['deleteRoomConfirmed'])) {
  deleteSubject($_SESSION['currentClassId']);
  deleteRequest($_SESSION['currentClassId']);
  deleteClassroom($_SESSION['currentClassId']);
  header("location:Main.php");
}
if (isset($_POST['deleteRoomCancelled'])) {
  $_SESSION['deleteRoom'] = false;
}


// ======================Requests and List==================
if (isset($_POST['delete'])) {
  removeFromClass($_POST['delete'], $_SESSION['currentClassroom']);
  header("location:LSEdit.php");
}

if (isset($_POST['btnAccept'])) {

  // model function
  acceptRequest($_POST['student_id'], $_POST['teacher_id'], $_POST['classroom_id'], $_POST['last_name']);
  removeRequest($_POST['student_id'], $_POST['classroom_id']);
  header("location:Request.php");
}

if (isset($_POST['btnDecline'])) {

  removeRequest($_POST['student_id'], $_POST['classroom_id']);
}


// ==========================Student=====================================


if (isset($_POST['btnclassSearch'])) {

  if (classRoomExist($_POST['classSearch'])) {

    $_SESSION['classInformation'] =  getClassInfo($_POST['classSearch']);
    if (isOnRequest($_SESSION['classInformation']['classroom_id'], $_SESSION['currentUser']['id']))
      $_SESSION['onRequest'] = true;
    else if (isOnSubject($_SESSION['classInformation']['classroom_id'], $_SESSION['currentUser']['id']))
      $_SESSION['onSubject'] = true;
    else {
      $_SESSION['classTeacher'] =  getClassTeacher($_SESSION['classInformation']['teacher_id']);
      $_SESSION['showSearchResult'] = true;
    }
  } else
    $_SESSION['invalidClassCode'] = true;
}

if (isset($_POST['sendRequest'])) {
  sendRequest($_SESSION['currentUser']['id'], $_SESSION['classInformation']['teacher_id'], $_SESSION['classInformation']['classroom_id']);
  $_SESSION['requestSent'] = true;
  header('location:studentMain.php');
}
// =====================================Exam============================================


if (isset($_POST['viewAssessment'])) {
  header("location:createAssessment/index.php");
}


if (isset($_POST['viewList'])) {
  header('location:assessmentList.php');
}

if (isset($_POST['preview'])) {
  $_SESSION['currentAssessment'] = $_POST['preview'];
  $_SESSION['index'] = 0;
  $_SESSION['randomized'] = false;

  header("location:createAssessment/preview.php");
}


if (isset($_POST['modify'])) {
  $result = modify($_POST['modify']);

  $_SESSION['currentAssessment'] = $result->fetch_assoc();
  $_SESSION['editAssessment'] = true;
}


if (isset($_POST['btnModify'])) {
  $id =  $_SESSION['currentAssessment']['id'];
  $title = $_POST['newtitle'];
  $time_start = $_POST['newtimeStart'];
  $time_end = $_POST['newtimeEnd'];
  $date = $_POST['newdate'];
  if (empty($_POST['newrandomize']))
    $randomize = 0;
  else
    $randomize = $_POST['newrandomize'];

  updateAssessment($id, $title, $time_start, $time_end, $randomize, $date);
  header("location:assessmentList.php");
}

if(isset($_POST['cancelUpdate'])) {
  header("location:assessmentList.php");
}

if (isset($_POST['deleteAssessment'])) {
  deleteAssessment($_POST['deleteAssessment']);
  header("location:assessmentList.php");
}


if (isset($_POST['goBack']) or isset($_POST['btnExit'])) {
  header("location:studentAssessmentList.php");
}
// view Scores==================================

if (isset($_POST['viewScores'])) {
  header("location:showAssessments.php");
}
