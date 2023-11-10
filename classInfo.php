<?php
include 'controller.php';
$room = getClassName($_SESSION['currentClassId']);

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

    <style>
        .details {
            height: 60%;
            display: grid;
            grid-template-rows: 5fr 5fr;
        }

        .upper,
        .lower {
            display: flex;
            justify-content: space-evenly;
            flex-wrap: wrap;
        }

        .classroomName {
            height: 300px;
            width: 250px;
            border-radius: 5px;
        }

        i {
            font-size: 40px;
            color: orange;
        }

        .container {
            border-radius: 20px;

        }

        @media (min-width: 1200px) {
            .container {
                max-width: 1300px;
            }
        }
    </style>
</head>

<body>
    <img class="bkg" src="img/bkg.png" alt="">

    <?php include "extentions/navbar.php" ?>

    <div class="container bg-light my-5 px-3 px-lg-5 py-5">

        <div class="text-center text-center justify-content-around">
            <div class="row">
                <div class="col text-start">
                    <h3 class="">Class Information</h3>
                </div>
                <div class="col text-end">
                    <form class="" action="controller.php" method="Post">
                        <button class="btn btn-warning" name="backToMain">Go back to main</button>
                    </form>
                </div>
            </div>
            <br>

            <div class="">
                <form action="" class="d-flex justify-content-center align-content-around flex-wrap gap-3" method="POST">
                    <div class="classroomName d-flex flex-column border">
                        <div class="icons p-5">
                            <i class="fas fa-file-code"></i>
                        </div>
                        <div class="description p-1 ">

                            <h4 class="text- font-weight-bold"><?= $room['classCode']; ?></h4>
                            <br>
                            <h5>Class Code</h5>
                        </div>
                    </div>
                    <div class="classroomName d-flex flex-column border">
                        <div class="icons p-5">
                            <i class="fas fa-tags"></i>
                        </div>
                        <div class="description p-1">
                            <h4 class="text- font-weight-bold"><?= $room['class_name']; ?></h4>
                            <br>
                            <div class="dropdown">
                                <button class="btn btn-outline-warning text-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Class Name
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <input id='classId' type="hidden" name="classId" value="<?= $room['classroom_id']; ?>">
                                    <button class="btn btn-light" type="submit" name="editName" style="width: 100%;">Rename Classroom</button>
                                    <button class="btn btn-light" type="submit" name="deleteClass" style="width: 100%;">Delete Classroom</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="classroomName d-flex flex-column border">
                        <div class="icons p-5">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="description p-1">
                            <h4 class="text- font-weight-bold"><?= studentCount($_SESSION['currentClassId']); ?></h4>
                            <br>
                            <button class="btn btn-outline-warning text-dark" type="submit" name="viewStudentList">Students</button>
                        </div>
                    </div>
                    <div class="classroomName d-flex flex-column border">
                        <div class="icons p-5">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="description p-1">
                            <h4 class="text- font-weight-bold"><?= requestCount($_SESSION['currentClassId']); ?></h4>
                            <br>
                            <button class="btn btn-outline-warning text-dark" name="viewRequest" type="submit">Requests</button>
                        </div>
                    </div>
                    <div class="classroomName d-flex flex-column border">
                        <div class="icons p-5">
                            <i class="fas fa-scroll"></i>
                        </div>
                        <div class="description p-1">
                            <h4 class="text- font-weight-bold">Exams/Quizes</h4>
                            <br>
                            <button class="btn btn-outline-warning text-dark" name="viewList">View</button>
                        </div>
                    </div>
                    <div class="classroomName d-flex flex-column border">
                        <div class="icons p-5">
                            <i class="fas fa-poll-h"></i>
                        </div>
                        <div class="description p-1">
                            <h4 class="text- font-weight-bold">Scores</h4>
                            <br>
                            <button class="btn btn-outline-warning text-dark" name="viewScores">View</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>


        <!-- ============================================================================ -->


        <div class="modal" id="myModal2">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-light">
                        <h4 class="modal-title">Invalid Class Name</h4>
                        <button type="button" name="renameRoomCancelled" class="btn-close" aria-label="Close"></button>
                    </div>
                    <div class="modal-body bg-light text-dark">
                        The Classroom name you Entered <br> is already on the List.
                        Please try again.
                    </div>
                    <div class="modal-footer bg-light text-dark">
                        <a href="#" data-toggle="modal" data-target="#mymodal" data-dismiss="modal"> <button class="btn btn-primary" type="submit" name="createClass">Try Again</button></a>
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
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-lg">Enter Class Name</span>
                                    </div>
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
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post">
                        <div class="modal-header bg-primary text-light">
                            <h4 class="modal-title">Room Not Renamed!</h4>
                            <button type="button" name="renameRoomCancelled" class="btn-close" aria-label="Close"></button>
                        </div>
                        <div class="modal-body bg-light text-dark">
                        </div>
                        <div class="modal-footer bg-light text-dark">
                            <a data-dismiss="modal">
                                <button class="btn btn-primary" type="submit" name="renameRoomCancelled">Close</button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal" id="myModal5">
            <div class="modal-dialog">
                <form action="" method="Post">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-light">
                            <h4 class="modal-title">Delete Classroom? <?= $_SESSION['currentClassName']; ?> </h4>
                            <button type="submit" name="deleteRoomCancelled" class="btn-close" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            If you delete this classroom all of the data in this classroom will also be deleted.
                        </div>
                        <div class="modal-footer text-dark">
                            <a> <button class="btn btn-primary" type="submit" name="deleteRoomConfirmed">Delete</button></a>
                            <button class="btn btn-info" type="submit" name="deleteRoomCancelled">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
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


</body>

</html>