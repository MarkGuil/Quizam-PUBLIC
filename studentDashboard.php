<?php
include 'controller.php';

$room = getClassName($_SESSION['currentClassId']);

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

    <style>
        .container {
            border-radius: 20px;
        }

        .bg-primary {
            background-color: #3D48C9 !important;
        }

        .details {
            height: 60%;
            display: grid;
            grid-template-rows: 4fr;
        }

        .upper,
        .lower {
            display: flex;
            justify-content: space-around;
            box-sizing: border-box;
            flex-wrap: wrap;
        }

        .classroomName {
            margin-top: 30px;
            height: 300px;
            width: 250px;

            border-radius: 5px;
        }

        i {
            font-size: 50px;
            color: orange;
        }

        .btn-default {
            padding: 0;
        }
    </style>
</head>

<body>


    <img class="bkg" src="img/bkg.png" alt="">

    <?php include "extentions/navbar.php" ?>

    <div class="container mt-5 bg-light">
        <div class="row">
            <div class="col-lg-12 p-5" style="min-height:600px;">
                <div class="text-xs-center text-lg-center">
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


                    <form action="controllerPart2.php" method="Post">
                        <div class="details p-1">
                            <div class="upper text-center">
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
                                        <h5>Class Name</h5>
                                    </div>
                                </div>

                                <div class="classroomName d-flex flex-column border">
                                    <div class="icons p-5">
                                        <i class="fas fa-scroll"></i>
                                    </div>
                                    <div class="description p-1">
                                        <h5 class="text- font-weight-bold">Exams/Quizes</h5>
                                        <br>
                                        <button class="btn btn-outline-warning text-dark" name="studentViewAssessment" value="<?= $room['classroom_id']; ?>">View</button>
                                    </div>
                                </div>
                                <div class="classroomName d-flex flex-column border">
                                    <div class="icons p-5">
                                        <i class="fas fa-poll-h"></i>
                                    </div>
                                    <div class="description p-1">
                                        <h5 class="text- font-weight-bold">Completed</h5>
                                        <br>
                                        <button name="completed" class="btn btn-outline-warning text-dark" value="<?= $room['classroom_id']; ?>">View</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================================ -->

    </div>
    <div class="modal" id="myModal2">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-light">
                    <h4 class="modal-title">Invalid Class Name</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                <div class="modal-header">
                    <span>Rename Classroom</span>
                    <div class="close" data-dismiss="modal">&times;</div>
                </div>
                <div class="modal-body">
                    <form class="frm" action="" method="Post">
                        <div class="cont-popup cont col-sm-11 col-sm-offset-11">
                            <div class="input-group input-group-lg">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-lg">Enter Class Name</span>
                                </div>
                                <input class="form-control" type="text" name="newClassroomName" value="<?= $_SESSION['currentClassName']; ?>" required><br>
                            </div>
                        </div>
                        <button class="btn btn-info" type="submit" name="roomRename">Rename</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="myModal4">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-light">
                    <h4 class="modal-title">Room Not Renamed!</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body bg-light text-dark">
                </div>
                <div class="modal-footer bg-light text-dark">
                    <a data-dismiss="modal"> <button class="btn btn-primary" type="submit">Close</button></a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="myModal5">
        <div class="modal-dialog">
            <form action="" method="Post">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-light">
                        <h4 class="modal-title">Delete Classroom? <?= $_SESSION['currentClassName']; ?> </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body bg-danger text-light">
                        If you delete this classroom all of the data in this classroom will also be deleted.
                    </div>
                    <div class="modal-footer bg-danger text-dark">
                        <a> <button class="btn btn-primary" type="submit" name="deleteRoomConfirmed">Delete</button></a>
                        <a data-dismiss="modal"> <button class="btn btn-info" type="submit" name="createClass">Cancel</button></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>

    <?php if (!$_SESSION['uniqueRoom']) { ?>
        <script>
            $('#myModal2').modal('show')
        </script>
    <?php }
    $_SESSION['uniqueRoom'] = true; ?>

    <?php if ($_SESSION['renameRoom']) { ?>
        <script>
            $('#myModal3').modal('show')
        </script>
    <?php }
    $_SESSION['renameRoom'] = false; ?>

    <?php if (!$_SESSION['roomRenamed']) { ?>
        <script>
            $('#myModal4').modal('show')
        </script>
    <?php }
    $_SESSION['roomRenamed'] = true; ?>

    <?php if ($_SESSION['deleteRoom']) { ?>
        <script>
            $('#myModal5').modal('show')
        </script>
    <?php }
    $_SESSION['deleteRoom'] = false; ?>


</body>

</html>