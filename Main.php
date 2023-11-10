<?php
include 'controller.php';
$room = searchClassRoom($_SESSION['currentUser']['id']);
$rooms = searchClassRoom($_SESSION['currentUser']['id']);

if (!isActive() or $_SESSION['currentUser']['user_type'] != 1)
    header("location:error404.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Main</title>
    <link rel="stylesheet" type="text/css" href="css/main2.css">
    <link rel="icon" type="image/x-icon" href="./img/icon.png">
    <?php include 'extentions/bootstrap.php' ?>
</head>

<body class="vh-100">
    <?php include "extentions/navbar.php" ?>
    <div id="mainSection" class=" d-flex justify-content-center align-items-center flex-column">
        <div class="w-100 h-100 flex-grow-1">
            <div class="d-flex flex-column flex-sm-row g-0 h-100">
                <div class="cl flex-shrink-1 no-gutters">
                    <div class="d-none d-sm-block">
                        <h2 class="txt px-3 py-3 m-0">Class
                            <a href="#" data-bs-toggle="modal" data-bs-target="#mymodal">
                                <img id="addc" class="imgg" src="img/add.png" alt="">
                            </a>
                        </h2>
                        <div>
                            <?php while ($r = $room->fetch_assoc()) { ?>
                                <form action="Main.php" class="py-1" method="Post">
                                    <input id='classId' type="hidden" name="classId" value="<?= $r['classroom_id']; ?>">
                                    <div class="nClass">
                                        <button id="" data-classID="<?= $r['classroom_id']; ?>" class=" overflow-x-hidden text-nowrap w-100 btn shadow text-start py-3 ps-3 text-light border-0 rounded-0 rounded-start-pill <?= isset($_SESSION['currentClassId']) && $_SESSION['currentClassId'] == $r['classroom_id'] ? "active text-center":""  ?>" type="submit" name="classInfo"><span><?= $r['class_name']; ?></span>
                                        </button>
                                    </div>
                                </form>
                                <?php $_SESSION['classEmpty'] = false; ?>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="d-block d-sm-none px-2 position-sticky top-0">
                        <div class=" d-flex justify-content-between align-items-center">
                            <h1 class="txt">Class </h1>
                            <button id="showClassBtn" class="m-0 border-0 bg-transparent px-3 fs-4"><i class="fa fa-bars text-light" aria-hidden="true"></i></button>
                        </div>
                        <div id="classDropdownSection" class="pb-2">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#mymodal" class="overflow-x-hidden d-flex gap-3 justify-content-center align-items-center text-nowrap w-100 btn shadow text-start py-3 my-1 ps-3 text-light border border-white rounded-0"> 
                                <img id="" class="" height="27px" width="27px" src="img/add.png" alt="">
                                <span class="m-0">Add New Class</span>
                            </a>
                            <?php while ($r = $rooms->fetch_assoc()) { ?>
                                <form action="Main.php" class="py-1" method="Post">
                                    <input id='classId' type="hidden" name="classId" value="<?= $r['classroom_id']; ?>">
                                    <div class="nClass">
                                        <button id="" data-classID="<?= $r['classroom_id']; ?>" class=" overflow-x-hidden text-nowrap w-100 btn shadow text-start py-3 ps-3 text-light border-0 rounded-0 <?= isset($_SESSION['currentClassId']) && $_SESSION['currentClassId'] == $r['classroom_id'] ? "active text-center":""  ?>" type="submit" name="classInfo"><span><?= $r['class_name']; ?></span>
                                        </button>
                                    </div>
                                </form>
                                <?php $_SESSION['classEmpty'] = false; ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <?php if ($_SESSION['classEmpty']) { ?>
                <div class="py-3 bg-white flex-grow-1 d-flex justify-content-center align-items-center">
                    <div class="text-xs-center text-lg-center">
                        <img class="" src="img/none.jpg" width="250px" height="250px" alt="" style="margin-top:0;">
                        <p class="">Don't have any class yet. Try creating one.</p>
                    </div>
                </div>
                <?php } 
                if (isset($_SESSION['currentClassId']) && $_SESSION['currentClassId'] != "") {
                    $room = getClassName($_SESSION['currentClassId']); 
                ?>
                <div class="py-3 px-4 px-sm-4 bg-white flex-grow-1 d-flex justify-content-center">
                    <div class="flex-grow-1">
                        <h4 class="px-2 py-2"><?= $room['class_name']; ?></h4>
                        <div class="text-center">
                            <form action="" class="d-flex flex-column justify-content-center align-items-center align-content-around flex-wrap gap-3" method="POST">
                                <div class="row w-100">
                                    <div class=" col-sm-12 col-md-4 col-lg-4 p-2">
                                        <div class="classroomName d-flex flex-column border h">
                                            <div class="p-5">
                                                <i class="fas fa-file-code class-icon"></i>
                                            </div>
                                            <div class="description p-1 ">
                                                <h4 class="text- font-weight-bold"><?= $room['classCode']; ?></h4>
                                                <br>
                                                <h5>Class Code</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" col-sm-12 col-md-4 col-lg-4 p-2">
                                        <div class="classroomName d-flex flex-column border h">
                                            <div class="p-5">
                                                <i class="fas fa-users class-icon"></i>
                                            </div>
                                            <div class="description p-1">
                                                <h4 class="text- font-weight-bold"><?= studentCount($_SESSION['currentClassId']); ?></h4>
                                                <br>
                                                <button class="btn btn-outline-warning text-dark" type="submit" name="viewStudentList">Students</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" col-sm-12 col-md-4 col-lg-4 p-2">
                                        <div class="classroomName d-flex flex-column border h">
                                            <div class="p-5">
                                                <i class="fas fa-user-plus class-icon"></i>
                                            </div>
                                            <div class="description p-1">
                                                <h4 class="text- font-weight-bold"><?= requestCount($_SESSION['currentClassId']); ?></h4>
                                                <br>
                                                <button class="btn btn-outline-warning text-dark" name="viewRequest" type="submit">Requests</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row w-100">
                                    <div class=" col-sm-12 col-md-4 col-lg-4 p-2">
                                        <div class="classroomName d-flex flex-column border h">
                                            <div class="p-5">
                                                <i class="fas fa-scroll class-icon"></i>
                                            </div>
                                            <div class="description p-1">
                                                <h4 class="text- font-weight-bold">Exams/Quizes</h4>
                                                <br>
                                                <button class="btn btn-outline-warning text-dark" name="viewList">View</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" col-sm-12 col-md-4 col-lg-4 p-2">
                                        <div class="classroomName d-flex flex-column border h">
                                            <div class="p-5">
                                                <i class="fas fa-poll-h class-icon"></i>
                                            </div>
                                            <div class="description p-1">
                                                <h4 class="text- font-weight-bold">Scores</h4>
                                                <br>
                                                <button class="btn btn-outline-warning text-dark" name="viewScores">View</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" col-sm-12 col-md-4 col-lg-4 p-2">
                                        <div class="classroomName d-flex flex-column border h">
                                            <div class="p-5">
                                                <i class="fas fa-wrench class-icon"></i>
                                            </div>
                                            <div class="description p-1">
                                                <h4 class="text- font-weight-bold">Settings</h4>
                                                <br>
                                                <div class="dropdown dropdown-center">
                                                    <button class="btn btn-outline-warning text-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <input id='classId' type="hidden" name="classId" value="<?= $room['classroom_id']; ?>">
                                                        <button class="btn btn-light" type="submit" name="editName" style="width: 100%;">Rename Classroom</button>
                                                        <button class="btn btn-light" type="submit" name="deleteClass" style="width: 100%;">Delete Classroom</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php } else { ?>
                <div class="py-3 bg-white flex-grow-1 d-flex justify-content-center align-items-center">
                    <div class="text-xs-center text-lg-center">
                        <img class="mt-5" src="img/none.jpg" width="250px" height="250px" alt="" style="margin-top:0;">
                    </div>
                </div>
                <?php } ?>
        </div>
    </div>

    <div class="modal" id="mymodal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <span>Add Classroom</span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php $classCode = generateClassCode(); ?>
                    <form class="frm" id=" form_id " action="" method="Post">
                        <div class="cont-popup cont col-sm-11 col-sm-offset-11">
                            <div class="input-group input-group-lg">
                                <span class="input-group-text" id="inputGroup-sizing-lg">Enter Class Name</span>

                                <input class="form-control" type="text" name="classroomName" required><br>
                                <input type="hidden" name="classCode" value="<?= $classCode; ?>" required><br>
                            </div>
                        </div>
                        <span>Your Class code: </span> <span id="code"><?= $classCode; ?></span>
                        <br>
                        <button id="updatePass" class="btn btn-primary" type="submit" name="createClass">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="myModal2">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="post">
                    <div class="modal-header bg-primary text-light">
                        <h4 class="modal-title">Invalid Class Name</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body bg-light text-dark">
                        The Classroom name you Entered <br> is already on the list.
                        Please try again.
                    </div>
                    <div class="modal-footer bg-light text-dark">
                        <button class="btn btn-primary" type="submit" name="createClassInvalid">Try Again</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal" id="myModal3">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form class="frm" action="" method="Post">
                    <div class="modal-header">
                        <span>Rename Classroom</span>
                        <button type="submit" name="editNameCancelled" class="btn-close" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="cont-popup cont col-sm-11 col-sm-offset-11">
                            <div class="input-group input-group-lg">
                                <span class="input-group-text" id="inputGroup-sizing-lg">Enter Class Name</span>

                                <input class="form-control" type="text" name="newClassroomName" value="<?= $_SESSION['currentClassName']; ?>" required><br>
                            </div>
                        </div>
                        <button class="btn btn-info" type="submit" name="roomRename">Rename</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal" id="myModal4">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="post">
                    <div class="modal-header bg-primary text-light">
                        <h4 class="modal-title">Room Not Renamed!</h4>
                        <button type="submit" name="renameRoomCancelled" class="btn-close" aria-label="Close"></button>
                    </div>
                    <div class="modal-body bg-light text-dark">
                        The Classroom name you Entered <br> is already on   the list.
                        Please try again.
                    </div>
                    <div class="modal-footer bg-light text-dark">
                        <button class="btn btn-primary" type="submit" name="renameRoomCancelled">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal" id="myModal5">
        <div class="modal-dialog modal-dialog-centered">
            <form action="" id=" form_id " method="Post">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-light">
                        <h4 class="modal-title">Delete Classroom? <?= $_SESSION['currentClassName']; ?> </h4>
                        <button type="submit" name="deleteRoomCancelled" class="btn-close" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        If you delete this classroom all of the data in this classroom will also be deleted.
                    </div>
                    <div class="modal-footer">
                        <a> <button class="btn btn-danger" type="submit" name="deleteRoomConfirmed">Delete</button></a>
                        <button class="btn btn-info" type="submit" name="deleteRoomCancelled">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php if (!$_SESSION['uniqueRoom']) { ?>
        <script>
            const myModal1 = new bootstrap.Modal('#myModal2');
            myModal1.show();
        </script>
    <?php }
    $_SESSION['uniqueRoom'] = true; ?>

    <?php if ($_SESSION['renameRoom']) { ?>
        <script>
            const myModal2 = new bootstrap.Modal('#myModal3');
            myModal2.show();
        </script>
    <?php }
    $_SESSION['renameRoom'] = false; ?>

    <?php if (!$_SESSION['roomRenamed']) { ?>
        <script>
            const myModal3 = new bootstrap.Modal('#myModal4');
            myModal3.show();
        </script>
    <?php }
    $_SESSION['roomRenamed'] = true; ?>

    <?php if ($_SESSION['deleteRoom']) { ?>
        <script>
            const myModal4 = new bootstrap.Modal('#myModal5');
            myModal4.show();
        </script>
    <?php }
    $_SESSION['deleteRoom'] = false; ?>

    <script>
        function formReset() {
            var element = document.getElementById(" form_id ");
            element.reset()
        }
    </script>
    <script>
        const navbar = document.querySelector(".navbar");
        const mainSection = document.querySelector("#mainSection");
        reportWindowSize()

        function reportWindowSize() {
            mainSection.style.height = (window.innerHeight - navbar.offsetHeight) + "px";
        }

        window.onresize = reportWindowSize;

        $("#showClassBtn").on("click", function() {
            $("#classDropdownSection").slideToggle("fast");
        });
    </script>

</body>

</html>
