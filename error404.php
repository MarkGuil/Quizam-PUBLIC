<!DOCTYPE html>
<html lang="en">

<head>
  <title>Error404</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <?php include 'extentions/bootstrap.php' ?>

  <style>
    #top div {
      margin-left: 1em;
      height: 20px;
      width: 20px;
      border-radius: 100%;

    }
  </style>
</head>

<body class="overflow-x-hidden vh-100 m-0 p-0">
  <img class="bkg" src="img/bkg2.jpg" alt="">
  <div class="row fixed-top">
    <h2 class="shadow p-3 " style="font-size:35px;color:yellow;text-shadow:1px 1px 1px black;">Quizam</h2>
  </div>
  <div class="row d-flex flex-row row no-gutters justify-content-center align-items-center vh-100">
    <div class=" col-lg-4 col-md-8 col-sm-10 col-xs-12  ">
      <form action="controller.php" method="Post" class="p-5 m-5 shadow bg-warning">
        <?php include 'extentions/dots.php'; ?>
        <br>
        <h4 class="text-light">The Requested page is not available...</h4>
        <br><br>
        <button class="btn btn-primary" name='goToLogin' type="submit">Go Back to Home Page</button>
      </form>
    </div>
  </div>
</body>

</html>