<?php

if(isset($_POST['resetBtn'])){
  $email = $_POST['resetEmail'];
  $selector = bin2hex(random_bytes(8));
  $token = random_bytes(32);

  $url = "www.quizam.rf.gd/recoverPassword.php?=".$selector."&validator=".bin2hex($token);

  $expires = date("U") +1800;
    

  echo $expires;
}
