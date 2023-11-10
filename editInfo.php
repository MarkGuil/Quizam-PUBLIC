<?php
include 'controller.php';
if (!isActive())
    header("location:error404.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit Info</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="icon" type="image/x-icon" href="./img/icon.png">
    <?php include 'extentions/bootstrap.php' ?>
</head>

<body>
    <img class="bkg" src="img/bkg.png" alt="">

    <?php include "extentions/navbar.php" ?>
    <div class="contaiiiner">
        <form action="controller.php" method="Post" enctype="multipart/form-data">
            <h1 class="ai-text my-4">Account Information</h1>
            <div class="text-xs-center text-lg-center">
                <div class="contUser">
                    <input type="" name="profileImage" id="" class="form-control">
                    <img src="<?= $_SESSION['currentUser']['pic_path']; ?>" alt="" id="">
                    <div class="cptext mt-2">
                        <button id="changePic" class="btn btn-primary">Change Profile</button>
                    </div>
                </div>
            </div>
            <div class="roww row no-gutters">
                <div class="col-sm-6 no-gutters">
                    <div class="cont col-sm-9 col-sm-offset-9">
                        <div class="input-group input-group-lg">
                            <span class="input-group-text" id="inputGroup-sizing-lg">First Name</span>
                            <input class="form-control" type="text" name="newfname" value="<?= $_SESSION['currentUser']['first_name']; ?>" required><br>
                        </div>
                    </div>
                    <div class="cont col-sm-9 col-sm-offset-9">
                        <div class="input-group input-group-lg">
                            <span class="input-group-text" id="inputGroup-sizing-lg">Last Name</span>
                            <input class="form-control" type="text" name="newlname" value="<?= $_SESSION['currentUser']['last_name']; ?>" required><br>
                        </div>
                    </div>
                    <div class="cont col-sm-9 col-sm-offset-9">
                        <div class="input-group input-group-lg">
                            <span class="sp2 input-group-text" id="inputGroup-sizing-lg">Email</span>
                            <input class="form-control" type="email" name="newEmail" value="<?= $_SESSION['currentUser']['email']; ?>" required><br>
                        </div>
                    </div>

                </div>
                <div class="col-sm-6 no-gutters">

                    <div class="cont2 col-sm-9 col-sm-offset-9">
                        <div class="input-group input-group-lg">
                            <span class="input-group-text" id="inputGroup-sizing-lg">Password</span>
                            <input class="form-control" type="password" name="password" value="<?= $_SESSION['currentUser']['password']; ?>" readonly><br>
                        </div>
                    </div>
                    <button id="btnChangePass" class="btn btn-primary mt-3" name="change">Change Password</button>
                </div>
                <div class="bn col-sm-9 col-sm-offset-9 mt-3">
                    <button class="btn btn-primary" type="submit" name="btnUpdateInfo">Update Info </button>
                    <button class="btn btn-secondary" type='submit' id="btnBack" name="btnCancel">Back to Previous Page</button>
                </div>
            </div>
        </form>
    </div>
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info text-light">
                    <h4 class="modal-title">Change Password</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-light text-dark">
                    <form action="" method="Post">
                        <div class="form-group">
                            <label for="">Current Password</label><input type="password" class="form-control" name="currentPass" required>
                        </div>
                        <div class="form-group">
                            <label for="">New Password</label><input id="newPass1" type="password" class="form-control" name="newPass1" required>
                        </div>
                        <div class="form-group">
                            <label for="">Re-Enter New Password</label><input id="newPass2" type="password" class="form-control" name="newPass2" required>
                        </div>
                </div>
                <div class="modal-footer bg-light text-dark">
                    <button id="updatePass" class="btn btn-info " type="submit" name="updatePassword">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal" id="myModal2">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-light">
                    <h4 class="modal-title">Successful</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-dark text-light">
                    Password has been changed!
                </div>
                <div class="modal-footer bg-dark text-light">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="myModal3">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-light">
                    <h4 class="modal-title">Upload Profile Picture</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-light text-dark">
                    <form action="controller.php" method="Post" enctype="multipart/form-data">
                        <div class="form-group">
                            <h4>Choose Picture</h4>
                            <input type="file" onchange="displayimg(this)" id="profileImage" class="form-control" name="picture" required>
                            <br>
                            <h4>Preview</h4>
                            <img class="object-fit-cover p-2 border border-2" style="width:250px; height: 250px;" src="<?= $_SESSION['currentUser']['pic_path']; ?>" alt="" onclick="choosepic()" id="profileimg"> 
                        </div>
                </div>
                <div class="modal-footer bg-light text-dark">
                    <button id="updatePass" class="btn btn-primary" type="submit" name="savePic">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal" id="myModal4">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-light">
                    <h4 class="modal-title">Invalid</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-dark text-light">
                    The Choosen File is not Supported!
                </div>
                <div class="modal-footer bg-dark text-light">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script>
    function choosepic() {
        document.querySelector('#profileImage').click();
    }

    function displayimg(e) {
        if (e.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                document.querySelector('#profileimg').setAttribute('src', e.target.result);
            }
            reader.readAsDataURL(e.files[0]);
        }
    }

    const changePass = document.querySelector('#btnChangePass')
    const updatePass = document.querySelector('#updatePass')
    const changePic = document.querySelector('#changePic')

    changePic.addEventListener('click', (e) => {
        $('#myModal3').modal('show')
        e.preventDefault()
    })

    changePass.addEventListener('click', (event1) => {
        $('#myModal').modal('show')
        event1.preventDefault()
    })
    updatePass.addEventListener('click', (e) => {
        const newPass1 = document.querySelector('#newPass1').value
        const newPass2 = document.querySelector('#newPass2').value

        if (newPass1 !== newPass2) {
            alert("Password Not Match!")
            e.preventDefault()
        }
    })
</script>



<?php if (!$_SESSION['passwordChanged']) : ?>
    <script>
        alert("The Current Password You Entered is Incorrect!")
    </script>
<?php $_SESSION['passwordChanged'] = true;
endif; ?>

<?php if ($_SESSION['passwordUpdated']) : ?>
    <script>
        const myModal2 = new bootstrap.Modal('#myModal2');
        myModal2.show();
    </script>
<?php $_SESSION['passwordUpdated'] = false;
endif; ?>
<!-- <?php if (!$_SESSION['fileSuppported']) : ?>
    <script>
        $('#myModal4').modal('show')
    </script>
<?php $_SESSION['fileSuppported'] = true;
        endif; ?> -->