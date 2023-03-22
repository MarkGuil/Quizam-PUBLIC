<?php
include 'controller.php';
$room = searchClassRoom($_SESSION['currentUser']['id']);

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
    <?php include 'extentions/bootstrap.php' ?>
</head>

<body class="">
    <img class="bkg" src="img/bkg.png" alt="">
    <?php include "extentions/navbar.php" ?>
    <div class=" d-flex justify-content-center align-items-center py-3 py-lg-5">
        <div class="contaiiner">
            <div class="row no-gutters">
                <div class="cl col-sm-5 col-lg-4 no-gutters">
                    <h1 class="txt ">Class
                        <a href="#" data-bs-toggle="modal" data-bs-target="#mymodal">
                            <img id="addc" class="imgg" src="img/add.png" alt="">
                        </a>
                    </h1>

                    <?php while ($r = $room->fetch_assoc()) { ?>
                        <form action="Main.php" method="Post">
                            <input id='classId' type="hidden" name="classId" value="<?= $r['classroom_id']; ?>">
                            <div class="nClass col-lg-11 text-start">
                                <button class="btn btn-light" type="submit" name="classInfo"><span><?= $r['class_name']; ?></span></button>
                                <a href="" class="dropdownn" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-three-dots" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" />
                                    </svg>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <!-- <button class="btn btn-light" type="submit" name="viewList" style="width: 100%;">List of Students</button> -->
                                    <button class="btn btn-light" type="submit" name="viewRequest" style="width: 100%;">View Students Requests</button>
                                    <!-- <button class="btn btn-light" type="submit" name="viewScores" style="width: 100%;">View Students Scores</button> -->
                                    <button class="btn btn-light" type="submit" name="editName" style="width: 100%;">Rename Classroom</button>
                                    <button class="btn btn-light" type="submit" name="deleteClass" id="deleteClass" style="width: 100%;">Delete Classroom</button>
                                </div>
                        </form>
                </div>

                <?php $_SESSION['classEmpty'] = false; ?>
            <?php } ?>
            <!-- End of New class -->
            </div>

            <?php if ($_SESSION['classEmpty']) { ?>
                <div class="col-lg-9">
                    <div class="text-xs-center text-lg-center">
                        <form id="form" action="" method="Post" class=" p-5 mt-5">
                            <img class="mt-5" src="img/none.jpg" alt="" style="margin-top:0;">
                            <p class="">Don't have any class yet. Try creating one.</p>
                        </form>
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
        <div class="modal-dialog">
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
                        <a href="#" data-bs-toggle="modal" data-bs-target="#mymodal" data-bs-dismiss="modal">
                            <button class="btn btn-primary" type="submit" name="createClass">Try Again</button>
                        </a>
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
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post">
                    <div class="modal-header bg-primary text-light">
                        <h4 class="modal-title">Room Not Renamed!</h4>
                        <button type="submit" name="renameRoomCancelled" class="btn-close" aria-label="Close"></button>
                    </div>
                    <div class="modal-body bg-light text-dark">
                    </div>
                    <div class="modal-footer bg-light text-dark">
                        <button class="btn btn-primary" type="submit" name="renameRoomCancelled">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal" id="myModal5">
        <div class="modal-dialog">
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

</body>

</html>