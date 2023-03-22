<?php

use PHPMailer\PHPMailer\PHPMailer;

function sendVericationCode($name, $email)
{

    $vCode = rand(100000, 500000);

    require('PHPMailer/src/PHPMailer.php');
    require('PHPMailer/src/SMTP.php');


    $body = "
        <body style='background:#eee; font-size:15px;font-family:Arial, Helvetica, sans-serif;'>
            <div style='max-width: 600px; min-width:200px;margin:auto; background:white;'>
            <h2 style='height:80px;border-bottom-right-radius:100%;background-color:blue;padding:10px;color:white;'>Welcome to Quizam</h2>
                <p style='padding:10px;'>Hello:   " . $name . "</p>
                <p style='padding:10px;'>Here is your Verification Code</p>
                <p style='text-align: center; font-weight:bold;font-size:28px;color:blue;letter-spacing:10px;'>" . $vCode . "</p>
                <p style='padding:20px; text-align:center;'>Lorem ipsum dolor sit, amet consectetur adipisicing elit. At ad ex, explicabo, eius omnis velit provident ullam earum recusandae, adipisci distinctio mollitia aliquam iusto. Officia molestiae eos tempora non mollitia inventore aut dicta at molestias.</p>
            </div>
        </body>
    ";

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = '';
    $mail->SMTPAuth = "true";
    $mail->SMTPSecure = "tls";
    $mail->Port = '587';
    $mail->Username = "";
    $mail->Password = "";
    $mail->Subject = "Quizam Verification Code";
    $mail->setFrom("");
    $mail->isHTML(true);
    $mail->Body = $body;
    $mail->addAddress($email);

    if (!$mail->Send()) {
        echo "<script>alert('An error Occured!')</script>";
    }
    $mail->smtpClose();

    return $vCode;
}
