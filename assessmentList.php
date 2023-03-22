<?php
include 'controller.php';
$class_Id = $_SESSION['currentClassId'];
$room = getClassName($class_Id);


if (!isActive() or $_SESSION['currentUser']['user_type'] != 1)
    header("location:error404.php");



$result = loadAssessments($class_Id);


function description($code)
{
    if ($code == 1)
        return 'Yes';

    return 'No';
}

function type($code)
{
    if ($code == 1)
        return 'Quiz';

    return 'Exam';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>List</title>
    <link rel="stylesheet" type="text/css" href="css/main2.css">
    <?php include 'extentions/bootstrap.php' ?>

    <style>
        .container {
            border-radius: 20px;
            min-height: 600px;
        }

        .bg-primary {
            background-color: #3D48C9 !important;
        }

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
            margin-top: 30px;

            height: 300px;
            width: 250px;
            display: flex;
            flex-direction: column;
            border-radius: 5px;
        }

        i {
            font-size: 60px;
            color: orange;
        }

        label {
            text-align: left;
        }
    </style>
</head>

<body>
    <img class="bkg" src="img/bkg.png" alt="">
    <?php include "extentions/navbar.php" ?>

    <div class="container bg-light mt-5 shadow">
        <div class="row no-gutters justify-content-center p-0">
            <div class="col-lg-12 px-3 px-lg-5 py-5 m-0">

                <div class="row mb-3">
                    <div class="col d-flex flex-row">
                        <h3 class="text-primary px-4">Quiz / Exam List</h3>
                        <form action="controller.php" method="post">
                            <button class="btn btn-success mb-2" name="viewAssessment" type="submit">Create New</button>
                        </form>
                    </div>
                    <div class="col-3 text-end">
                        <form class="" action="controllerPart2.php" method="Post">
                            <button class="btn btn-warning" name="backToTeacherDash">Go back</button>
                        </form>
                    </div>
                </div>
                <table class="table table-striped table-primary table-hover ">
                    <thead>
                        <tr>
                            <th scope="col" class="">Assessment Type</th>
                            <th scope="col" class="">Title</th>
                            <th scope="col" class="">Date</th>
                            <th scope="col" class="">Time Start</th>
                            <th scope="col" class="">Time End</th>
                            <!-- <th scope="col" class="text-center">Randomize Questions</th> -->
                            <th scope="col" class="">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($result)) {
                            while ($details = $result->fetch_assoc()) { ?>
                                <tr class="">
                                    <td class=""><?= type($details['assessment_type']) ?></td>
                                    <td class=""><?= $details['title']; ?></td>
                                    <td class=""><?= $details['date']; ?></td>

                                    <td><?= date("h:i a", strtotime($details['time_start']))  ?></td>
                                    <td><?= date("h:i a", strtotime($details['time_end'])) ?></td>
                                    <!-- <td class="text-center"><?= description($details['randomize']); ?></td> -->
                                    <td class="pl-5 ">
                                        <form action="" method="Post">
                                            <button name='preview' class="btn btn-outline-secondary ml-5" value="<?= $details['id']; ?>" type="submit">View</button>
                                            <button name='modify' class="btn btn-outline-primary ml-5" value="<?= $details['id']; ?>" type="submit">Modify</button>
                                            <button name='deleteAssessment' class="btn btn-outline-danger ml-5" value="<?= $details['id']; ?>" type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="6">
                                    <div class=" mx-4 text-center py-2">no data found</div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal shadow text-left" id="myModal">
        <form action="" method="post">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-light">
                        <header>
                            <h4 class="p-3 text-light">Settings</h4>
                        </header>
                    </div>
                    <div class="modal-body p-5">
                        <div class="form-group ">
                            <label for="">
                                <h5 class="">Title</h5>

                            </label>
                            <input name="newtitle" class="form-control" type="text" value="<?= $_SESSION['currentAssessment']['title']; ?>" required>
                        </div>
                        <div class="form-group mt-1">
                            <label for="">
                                <h5>Set Date of Assessment</h5>
                            </label>
                            <input name="newdate" class="form-control" type="date" value="<?= $_SESSION['currentAssessment']['date']; ?>" required>
                        </div>
                        <div class="form-group   mt-1">
                            <label for="">
                                <h5>Time Start</h5>
                            </label>
                            <input id="strt" name="newtimeStart" class="form-control" type="time" required value="<?= $_SESSION['currentAssessment']['time_start']; ?>">
                        </div>
                        <div class="form-group   mt-1">
                            <label for="">
                                <h5>Time End</h5>
                            </label>
                            <input id="end" name="newtimeEnd" class="form-control" type="time" required value="<?= $_SESSION['currentAssessment']['time_end']; ?>">
                            <!-- <div class="custom-control custom-checkbox mt-3">

                                <?php if ($_SESSION['currentAssessment']['randomize'] == 1) { ?>"
                                <input type="checkbox" checked value="1" class="custom-control-input" id="customCheck" name="newrandomize">
                                <?php } else { ?>"
                                <input type="hidden" value="0" name="newrandomize">
                                <input type="checkbox" value="1" class="custom-control-input" id="customCheck" name="newrandomize">
                            <?php } ?>
                            <label class="custom-control-label" for="customCheck"> Shuffle Questions</label>
                            </div> -->
                        </div>
                        <div class="modal-footer text-dark">
                            <div class="form-inline col justify-content-between">
                                <button id="cancelBtn" class="m-2 btn btn-outline-dark" type="" style="width:30%;">Cancel</button>
                                <button id="btnUpdateDetails" class="m-2 btn btn-secondary" type="submit" style="width:30%;" name="btnModify">Update</button>
                            </div>

                        </div>
                    </div>
                </div>
        </form>
    </div>
    <script>
        const myModal = document.querySelector('#myModal')
        const cancel = document.querySelector('#cancelBtn')
        const updateDetails = document.querySelector('#btnUpdateDetails')

        updateDetails.addEventListener('click', (e) => {

            const start = document.querySelector('#strt')
            const end = document.querySelector('#end')

            if (start.value >= end.value) {
                alert("Inavalid Time Start and Time End")
                e.preventDefault()

            }

        })

        cancel.addEventListener('click', () => {
            myModal.style.display = 'none';
        })
    </script>
    <?php if ($_SESSION['editAssessment']) { ?>
        <script>
            myModal.style.display = 'block';
        </script>
    <?php }
    $_SESSION['editAssessment'] = false; ?>

</body>

</html>