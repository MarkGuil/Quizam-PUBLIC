<style>
    .bg-primary {
        background-color: #3D48C9 !important;
    }
</style>
<nav class="navbar navbar-light bg-primary justify-content-between shadow px-sm-2 px-lg-2">
    <div class="navUser">
        <a class="navbar-brand">
            <a href="Main.php" class="text-decoration-none">
                <img class="border-0 rounded-0" src="./img/logo.svg" width="160px" height="50px" alt="">
            </a>
        </a>
    </div>
    <form class="d-flex" action="controller.php" method="Post">
        <div class="dropdown">
            <button class="btn btn-link dropdown-toggle text-light text-decoration-none me-3" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img class="border border-dark rounded-circle me-2 object-fit-cover" src="<?= $_SESSION['currentUser']['pic_path']; ?>" width="40px" height="40px" alt="">
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