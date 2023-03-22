<?php
include 'controller.php';

$room = searchSubjects($_SESSION['currentUser']['id']);
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
    <?php include 'extentions/bootstrap.php' ?>
</head>

<body>
    <img class="bkg" src="img/bkg.png" alt="">
    <?php include "extentions/navbar.php" ?>
    <div class=" d-flex justify-content-center align-items-center py-3 py-lg-5">
        <div class="contaiiner">
            <div class="row d-flex justify-content-center no-gutters">
                <?php if (mysqli_num_rows($room)) { ?>
                    <div class="cl col-sm-5 col-lg-4 no-gutters">
                        <h1 class="txt">Class </h1>
                        <?php while ($r = $room->fetch_assoc()) {
                            $className = getClassName($r['classroom_id']);
                        ?>
                            <form action="" method="Post">
                                <div class="nClass ">
                                    <input id='classId' type="hidden" name="classId" value="<?= $r['classroom_id']; ?>">
                                    <button class="btn btn-light" type="submit" name="studentDash">
                                        <span><?= $className['class_name']; ?></span>
                                    </button>
                                </div>
                            </form>
                        <?php } ?>
                    </div>
                <?php } ?>
                <!-- End of New class -->
                <?php if ($_SESSION['classEmpty']) { ?>
                    <div class="rightt col-sm-7 col-lg-8">
                        <div class="text-xs-center text-lg-center">
                            <form id="form" action="" method="Post" class=" p-5 mb-4">
                                <img src="img/none.jpg" alt="" style="margin-top:0;">
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
                            <form style="display:none;" id="result" action="" method="Post" class="p-1 mt-5 text-center">
                                <h3 class="text-primary">Search Result</h3>
                                <div class="form-group d-flex justify-content-center mt-3">
                                    <ul class="list-group shadow bg-default  " style="width: 50%;">
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
                <?php } ?>
            </div>
        </div>

    </div>
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-light">
                    <h4 class="modal-title">Request Already Sent</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-light text-dark">
                    Waiting for your teachers Confirmation..
                </div>
                <div class="modal-footer bg-light text-dark">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="myModal2">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-light">
                    <h4 class="modal-title">Your already a student of this class!</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-light text-dark">
                    The classroom you searched is already on your list!
                </div>
                <div class="modal-footer bg-light text-dark">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="myModal3">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-light">
                    <h4 class="modal-title">Request Sent!</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-light text-dark">
                    The class you requested will be added on your list when confirmed by your teacher.
                </div>
                <div class="modal-footer bg-light text-dark">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="myModal4">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-light">
                    <h4 class="modal-title">Couldn't find it</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-light text-dark">
                    The class code you entered is invalid. Please try again!
                </div>
                <div class="modal-footer bg-light text-dark">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        const form = document.querySelector('#form')
        const result = document.querySelector('#result')
        // const search = document.querySelector('#search')

        form.style.display = 'none'

        // search.addEventListener('click', () => {
        //     result.style.display = 'none'
        //     form.style.display = 'grid'
        // })
    </script>

    <?php if ($_SESSION['classEmpty']) { ?>
        <script>
            form.style.display = 'grid'
        </script>
    <?php }; ?>
    <?php if ($_SESSION['showSearchResult']) { ?>
        <script>
            result.style.display = 'grid'
            form.style.display = 'none'
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

</body>

</html>