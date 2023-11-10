<?php include 'controller2.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login</title>

  <?php include '../extentions/bootstrap.php' ?>
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
  <link rel="stylesheet" href="styler.css">
  <style>
    .bg-primary {
      background-color: #3D48C9 !important;
    }
  </style>
</head>

<body style=" background: rgb(241, 240, 240) !important;">

  <nav class="navbar navbar-light bg-primary justify-content-between shadow px-sm-2 px-lg-2">
    <div class="navUser">
      <a class="navbar-brand">
        <a href="../Main.php" class="text-decoration-none">
          <img class="border-0 rounded-0" src="../img/logo.svg" width="160px" height="50px" alt="">
        </a>
      </a>
    </div>
    <form class="d-flex" action="../controller.php" method="Post">
      <div class="dropdown">
        <button class="btn btn-link dropdown-toggle text-light text-decoration-none me-3" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img class="border border-dark rounded-circle me-2 object-fit-cover" src="../<?= $_SESSION['currentUser']['pic_path']; ?>" width="40px" height="40px" alt="">
          <span>
            <?= $_SESSION['currentUser']['first_name']; ?><?= "  " . $_SESSION['currentUser']['last_name']; ?>
          </span>
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="showInfo.php">Edit Profile</a></li>
          <li><button class="dropdown-item " type="submit" name="logout">Logout</button></li>
        </ul>
      </div>
    </form>
  </nav>

  <div class="container bg-light mt-5 mb-5">
    <div class="row">
      <div class="col col-lg-12 shadow p-0">
        <header class="text-light bg-primary p-5">
          <?php include 'dots.php' ?>
          <br>
          <div class="row">
            <div class="col text-start">
              <p class="title">Create New Assessment</p>
            </div>
            <div class="col text-end">
              <form class="" action="../controller.php" method="Post">
                <button class="btn btn-warning" name="viewList">Go back</button>
              </form>
            </div>
          </div>
        </header>
        <form action="controller2.php" method="Post" class="px-5 py-2" enctype="multipart/form-data">
          <div id="form2">
            <input id="input" type="hidden" name="val">
            <input id="answers" type="hidden" name="answers">
          </div>
          <div class="d-flex flex-column justify-content-center align-items-center my-4">
            <div class="dropdown pt-0 col-6 mx-3 mb-2">
              <button class=" btn btn-secondary dropdown-toggle w-100" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Add
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a id="essay" class="dropdown-item" href="">Essay</a>
                <a id="multipleChoice" class="dropdown-item" href="">Multiple Choice</a>
                <a id="trueOrFalse" class="dropdown-item" href="">True or false</a>
                <a id="identification" class="dropdown-item" href="">Identification</a>
              </div>
            </div>
            <div class="col-6 mx-3">
              <button id="btnSave" class=" btn btn-primary w-100" type="submit">Finalize</button>
            </div>
          </div>

      </div>
    </div>
  </div>
  <div class="modal shadow" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary text-light justify-content-between">

          <header>
            <h4 class="text-light">Finalize</h4>
          </header>


        </div>
        <div class="modal-body px-5">
          <div class="form-group ">
            <label for="">
              <h5>Title</h5>
            </label>
            <input name="title" class="form-control" type="text" required>
          </div>

          <div class="form-group mt-1">
            <label for="">
              <h5>Set Date of Assessment</h5>
            </label>
            <input name="date" class="form-control" type="date" required>
          </div>

          <div class="form-group   mt-1">
            <label for="">
              <h5>Time Start</h5>
            </label>
            <input id="strt" name="timeStart" class="form-control" type="time" required>
          </div>
          <div class="form-group   mt-1">
            <label for="">
              <h5>Time End</h5>
            </label>
            <input id="end" name="timeEnd" class="form-control" type="time" required>

            <div class="type form-group my-2">
              <label for="" class="text-dark my-2">
                <h5>
                  Assessment Type
                </h5>
              </label>
              <select name="assessmentType" id="typeSelector" class="form-control" style="width: 30%;">
                <option value="1">Quiz</option>
                <option value="2">Exam</option>
              </select>
            </div>
            <div class="custom-control custom-checkbox mt-3">
              <!-- <label for="" > -->
              <h5 class="text-dark my-2">
                Randomizer
              </h5>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="randomize" value="1" id="flexRadioDefault1" required>
                <label class="form-check-label" for="flexRadioDefault1">
                  True
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="randomize" value="0" id="flexRadioDefault2" checked>
                <label class="form-check-label" for="flexRadioDefault2">
                  False
                </label>
              </div>
            </div>
          </div>
          <div class="modal-footer text-dark">
            <div class="form-inline col justify-content-between">
              <button id="btnCancel" class="m-2 btn btn-outline-dark" type="submit" style="width:30%;">Cancel</button>
              <button id="btnFinalize" class="m-2 btn btn-success" type="submit" style="width:30%;" name="sub">Save</button>
            </div>
          </div>
        </div>
      </div>
      </form>
    </div>
    <script src="script.js?">
    </script>
</body>

</html>