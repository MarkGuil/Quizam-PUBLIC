<?php

use PHPMailer\PHPMailer\PHPMailer;

function sendResetLink($name, $email, $user_type, $token)
{
    require('PHPMailer/src/PHPMailer.php');
    require('PHPMailer/src/SMTP.php');
    $validity = date("U") + 3600;
    $body = "
    <? include 'extentions/bootstrap.php'?>
        <body style='background:#eee; font-size:15px;font-family:Arial, Helvetica, sans-serif; '>
            <div style='max-width: 600px; min-width:200px;margin:1rem auto; background:white;box-shadow:5px 5px 5px silver; border-radius:20px;'>
                <h2 style='height:80px;border-bottom-right-radius:100%;background-color:blue;padding:10px;color:white;'>Quizam Password Request</h2>
                <p style='padding:10px;'>Hello:   " . $name . "</p>
                <p style='padding:20px; text-align:center;'>We recieved a request that you want to retrieve your password. That is why we sent this message on your email address.Click the button below to reset your password. The link will no longer available after an hour upon receiving this message. If you didn't request for it, just ignore this message. </p>
                <p style='padding:10px;text-align:center;'></p>
                <p style='text-align: center; font-weight:bold;font-size:18px;color:blue;'> <a href='localhost/QuizamPart1/resetPassword.php?email=$email&amp;user_type=$user_type&amp;token=$token' style='padding:.5em .5em .5em;border-radius:10px;background:blue;color:yellow;box-shadow:2px 2px 2px silver; text-decoration:none;'>Click Here</a></p>
            </div>
        </body>
    ";

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = '';
    $mail->SMTPAuth = "true";
    $mail->SMTPSecure = "tls";
    $mail->Port = '587';
    $mail->Username = "";
    $mail->Password = "";
    $mail->Subject = "Quizam Password Request";
    $mail->setFrom("");
    $mail->isHTML(true);
    $mail->Body = $body;
    $mail->addAddress($email);

    if (!$mail->Send()) {
        echo "<script>alert('An error Occured!')</script>";
    }
    $mail->smtpClose();

    return $validity;
}
