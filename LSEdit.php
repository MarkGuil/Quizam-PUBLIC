<?php
include 'controller.php';

$result = studentList($_SESSION['currentClassroom']);

if (!isActive())
    header("location:error404.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>List</title>
    <link rel="stylesheet" type="text/css" href="css/main2.css">
    <link rel="icon" type="image/x-icon" href="./img/icon.png">
    <?php include 'extentions/bootstrap.php' ?>
</head>

<body>
    <img class="bkg" src="img/bkg.png" alt="">

    <?php include "extentions/navbar.php" ?>

    <div class="container bg-light mt-5 shadow">
        <div class="row no-gutters p-0">
            <div class="col-lg-12 px-3 px-lg-5 py-5 m-0">
                <div class="">
                    <div class="studName row text-start">
                        <div class="col">
                            <span class="m-0">Students</span>
                        </div>
                        <div class="editStud col text-end">
                            <form class="" action="controllerPart2.php" method="Post">
                                <button class="btn btn-warning" name="backToTeacherDash">Go back</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-12 px-4 py-3">
                        <table class="table table-striped table-primary table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col">Profile</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (mysqli_num_rows($result)) {
                                    if ($list = $result->fetch_assoc()) { ?>
                                        <?php
                                        $students = getStudent($list['student_id']);
                                        $count = 1;
                                        while ($info = $students->fetch_assoc()) { ?>
                                            <tr>
                                                <form action="" method="Post">
                                                    <td scope="row" class="text-center"><?= $count++ ?></td>
                                                    <td><img src="<?= $info['pic_path']; ?>" class="student_img m-0" id="" alt=""></td>
                                                    <td><span><?= '  ' . $info['last_name'] . '  ' . $info['first_name']; ?></span></td>
                                                    <td>
                                                        <button type="submit" class="button btn btn-default m-0 p-0" value="<?= $info['id']; ?>" name="delete">
                                                            <a data-bs-toggle="tooltip" data-placement="left" title="Remove">
                                                                <small><i class="fas fa-trash"></i></small>
                                                            </a>
                                                        </button>
                                                    </td>
                                                </form>
                                            </tr>
                                    <?php }
                                    }
                                } else { ?>
                                    <tr>
                                        <td colspan="4">
                                            <div class=" mx-4 text-center py-2">no data found</div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });

        const btnDelete = document.querySelectorAll('.button')
        btnDelete.forEach(item => {
            item.addEventListener('click', (e) => {
                if (!confirm('Delete student on the List?')) {
                    e.preventDefault()
                }


            })

        })
    </script>
</body>

</html>