<?php
include 'controller.php';

$room = searchSubjects($_SESSION['currentUser']['id']);
$rooms = searchSubjects($_SESSION['currentUser']['id']);
if (!isActive() or $_SESSION['currentUser']['user_type'] != 2)
    header("location:error404.php");
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
</head>

<body class="vh-100">
    <?php include "extentions/navbar.php" ?>
    <div id="mainSection" class=" d-flex justify-content-center align-items-center flex-column">
        <div class="w-100 h-100 flex-grow-1">
            <div class="d-flex flex-column flex-sm-row g-0 h-100">
                <div class="cl flex-shrink-1 no-gutters">
                    <div class="d-none d-sm-block">
                        <h2 class="txt px-3 py-3 m-0">Class
                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalRoomSearch">
                                <img id="addc" class="imgg" src="img/add.png" alt="">
                            </a>
                        </h2>
                        <?php if (mysqli_num_rows($room)) { ?>
                            <?php while ($r = $room->fetch_assoc()) {
                                $className = getClassName($r['classroom_id']);?>
                                <form action="" class="py-1" method="Post">
                                    <input id='classId' type="hidden" name="classId" value="<?= $r['classroom_id']; ?>">
                                    <div class="nClass ">
                                        <button id="" data-classID="<?= $r['classroom_id']; ?>" class=" overflow-x-hidden text-nowrap w-100 btn shadow text-start py-3 ps-3 text-light border-0 rounded-0 rounded-start-pill <?= isset($_SESSION['currentClassId']) && $_SESSION['currentClassId'] == $r['classroom_id'] ? "active text-center":""  ?>" type="submit" name="studentDash"><span><?= $className['class_name']; ?></span>
                                        </button>
                                    </div>
                                </form>
                                <?php $_SESSION['classEmpty'] = false; ?>
                            <?php } ?>
                        <?php } ?>
                    </div>
                    
                    <div class="d-block d-sm-none px-2 position-sticky top-0">
                        <div class=" d-flex justify-content-between align-items-center">
                            <h1 class="txt">Class </h1>
                            <button id="showClassBtn" class="m-0 border-0 bg-transparent px-3 fs-4"><i class="fa fa-bars text-light" aria-hidden="true"></i></button>
                        </div>
                        <div id="classDropdownSection" class=" pb-2">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalRoomSearch" class="overflow-x-hidden d-flex gap-3 justify-content-center align-items-center text-nowrap w-100 btn shadow text-start py-3 my-1 ps-3 text-light border border-white rounded-0"> 
                                <img id="" class="" height="27px" width="27px" src="img/add.png" alt="">
                                <span class="m-0">Add New Class</span>
                            </a>
                            <?php if (mysqli_num_rows($rooms)) { ?>
                                <?php while ($r = $rooms->fetch_assoc()) {
                                    $className = getClassName($r['classroom_id']);?>
                                    <form action="" class="py-1" method="Post">
                                        <input id='classId' type="hidden" name="classId" value="<?= $r['classroom_id']; ?>">
                                        <div class="nClass ">
                                            <button id="" data-classID="<?= $r['classroom_id']; ?>" class=" overflow-x-hidden text-nowrap w-100 btn shadow text-start py-3 ps-3 text-light border-0 rounded-0 <?= isset($_SESSION['currentClassId']) && $_SESSION['currentClassId'] == $r['classroom_id'] ? "active text-center":""  ?>" type="submit" name="studentDash"><span><?= $className['class_name']; ?></span>
                                            </button>
                                        </div>
                                    </form>
                                    <?php $_SESSION['classEmpty'] = false; ?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <!-- End of New class -->
                <?php if ($_SESSION['classEmpty'] || !isset($_SESSION['currentClassId'])) { ?>
                    <div class="py-3 bg-white flex-grow-1 d-flex justify-content-center align-items-center">
                        <div class="text-xs-center text-lg-center">
                            <form id="form" action="" method="Post" class=" text-center p-5 mb-4">
                                <span>
                                    <img src="img/none.jpg" alt="" width="250px" height="250px">
                                </span>
                                <p class="font-weight-bold">Ask your teacher for the classroom code and enter it here.</p>
                                <div class="form-group row justify-content-center">
                                    <div class="col-xs-12">
                                        <input class="form-control" type="text" name="classSearch" placeholder="Enter Class Code" required>
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <button class="btn btn-primary" type="submit" name="btnclassSearch">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php } 
                if (isset($_SESSION['currentClassId']) && $_SESSION['currentClassId'] != "") {
                    $room = getClassName($_SESSION['currentClassId']); 
                ?>
                <div class="py-3 px-4 px-sm-4 bg-white flex-grow-1 d-flex justify-content-center ">
                    <div class="flex-grow-1">
                        <h4 class="px-2 py-2"><?= $room['class_name']; ?></h4>
                    
                        <div class="text-center">
                            <form action="controllerPart2.php" class="d-flex flex-column justify-content-center align-content-around flex-wrap gap-3" method="POST">
                                <div class="row w-100">
                                    <div class=" col-sm-12 col-md-5 col-lg-3 p-2">
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
                                    <div class=" col-sm-12 col-md-5 col-lg-3 p-2">
                                        <div class="classroomName d-flex flex-column border h">
                                            <div class="p-5">
                                                <i class="fas fa-book class-icon"></i>
                                            </div>
                                            <div class="description p-1">
                                                <h4 class="text- font-weight-bold">Exams/Quizes</h4>
                                                <!-- <h4 class="text- font-weight-bold"><?= studentCount($_SESSION['currentClassId']); ?></h4> -->
                                                <br>
                                                <button class="btn btn-outline-warning text-dark" name="studentViewAssessment" value="<?= $room['classroom_id']; ?>">View</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" col-sm-12 col-md-5 col-lg-3 p-2">
                                        <div class="classroomName d-flex flex-column border h">
                                            <div class="p-5">
                                                <i class="fas fa-check-square class-icon"></i>
                                            </div>
                                            <div class="description p-1">
                                                <h4 class="text- font-weight-bold">Completed</h4>
                                                <br>
                                                <button name="completed" class="btn btn-outline-warning text-dark" value="<?= $room['classroom_id']; ?>">View</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" col-sm-12 col-md-5 col-lg-3 p-2">
                                        <div class="classroomName d-flex flex-column border h">
                                            <div class="p-5">
                                                <i class="fas fa-wrench class-icon"></i>
                                            </div>
                                            <div class="description p-1">
                                                <h4 class="text- font-weight-bold">Settings</h4>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>

    </div>
    <div class="modal" id="modalRoomSearch">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <span>Search Classroom</span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-xs-center text-lg-center">
                        <form id="" action="" method="Post" class=" text-center">
                            <span>
                                <img src="img/none.jpg" alt="" width="200px" height="200px">
                            </span>
                            <p class="font-weight-bold">Ask your teacher for the classroom code and enter it here.</p>
                            <div class="form-group row justify-content-center">
                                <div class="col-xs-12">
                                    <input class="form-control" type="text" name="classSearch" placeholder="Enter Class Code" required>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <button class="btn btn-primary" type="submit" name="btnclassSearch">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="modalSearchResult">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <span>Search Classroom</span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-xs-center text-lg-center">
                        <form id="result" action="" method="Post" class=" text-center">
                            <h3 class="text-primary">Search Result</h3>
                            <div class="form-group mt-3">
                                <ul class="list-group bg-default  " >
                                    <li class="list-group-item font-weight-bold border-0"> <img src="<?= $_SESSION['classTeacher']['pic_path']; ?>" alt="" class="mt-0" style="height:100px;width:100px;"></li>
                                    <li class="list-group-item font-weight-bold border-0">Teacher: <?= $_SESSION['classTeacher']['first_name'] . "   " . $_SESSION['classTeacher']['last_name']; ?></li>
                                    <li class="list-group-item font-weight-bold border-0">Subject: <?= $_SESSION['classInformation']['class_name']; ?></li>
                                    <li class="list-group-item font-weight-bold border-0"> <button class="btn btn-primary" type="submit" name="sendRequest">Send Request</button>
                                        <button class="btn btn-warning" type="submit" name="">Cancel</button>
                                    </li>

                                </ul>
                            </div>
                            <div class="form-group">

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="myModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="controllerPart2.php" method="post">
                    <div class="modal-header bg-primary text-light">
                        <h4 class="modal-title">Request Already Sent</h4>
                        <button type="submit" name="backToDash" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body bg-light text-dark">
                        Waiting for your teachers Confirmation..
                    </div>
                    <div class="modal-footer bg-light text-dark">
                            <button type="submit" name="backToDash" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal" id="myModal2">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="controllerPart2.php" method="post">
                    <div class="modal-header bg-primary text-light">
                        <h4 class="modal-title">Your already a student of this class!</h4>
                        <button type="submit" name="backToDash" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body bg-light text-dark">
                        The classroom you searched is already on your list!
                    </div>
                    <div class="modal-footer bg-light text-dark">
                            <button type="submit" name="backToDash" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal" id="myModal3">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="controllerPart2.php" method="post">
                    <div class="modal-header bg-primary text-light">
                        <h4 class="modal-title">Request Sent!</h4>
                        <button type="submit" name="backToDash" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body bg-light text-dark">
                        The class you requested will be added on your list when confirmed by your teacher.
                    </div>
                    <div class="modal-footer bg-light text-dark">
                            <button type="submit" name="backToDash" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal" id="myModal4">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="controllerPart2.php" method="post">
                    <div class="modal-header bg-primary text-light">
                        <h4 class="modal-title">Couldn't find it</h4>
                        <button type="submit" name="backToDash" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body bg-light text-dark">
                        The class code you entered is invalid. Please try again!
                    </div>
                    <div class="modal-footer bg-light text-dark">
                            <button type="submit" name="backToDash" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const form = document.querySelector('#form')
        const result = document.querySelector('#result')
        const navbar = document.querySelector(".navbar");
        const mainSection = document.querySelector("#mainSection");
        reportWindowSize()

        function reportWindowSize() {
            mainSection.style.height = (window.innerHeight - navbar.offsetHeight) + "px";
        }

        window.onresize = reportWindowSize;

        // form.style.display = 'none'

    </script>

    <?php if ($_SESSION['classEmpty']) { ?>
        <script>
            // form.style.display = 'grid'
        </script>
    <?php }; ?>
    <?php if ($_SESSION['showSearchResult']) { ?>
        <script>
            const myModalRes = new bootstrap.Modal('#modalSearchResult');
            myModalRes.show();
            // result.style.display = 'grid'
            // form.style.display = 'none'
        </script>
    <?php };
    $_SESSION['showSearchResult'] = false; ?>

    <?php if ($_SESSION['onRequest']) { ?>
        <script>
            const myModal1 = new bootstrap.Modal('#myModal');
            myModal1.show();
        </script>
    <?php }
    $_SESSION['onRequest'] = false; ?>
    <?php if ($_SESSION['onSubject']) { ?>
        <script>
            const myModal2 = new bootstrap.Modal('#myModal2');
            myModal2.show();
        </script>
    <?php }
    $_SESSION['onSubject'] = false; ?>

    <?php if ($_SESSION['requestSent']) { ?>
        <script>
            const myModal3 = new bootstrap.Modal('#myModal3');
            myModal3.show();
        </script>
    <?php }
    $_SESSION['requestSent'] = false; ?>

    <?php if ($_SESSION['invalidClassCode']) { ?>
        <script>
            const myModal4 = new bootstrap.Modal('#myModal4');
            myModal4.show();
        </script>
    <?php }
    $_SESSION['invalidClassCode'] = false; ?>
    <script>
        $("#showClassBtn").on("click", function() {
            $("#classDropdownSection").slideToggle("fast");
        });
    </script>
</body>

</html>