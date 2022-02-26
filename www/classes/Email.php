<?php

use PHPMailer\PHPMailer\PHPMailer;
require_once('vendor/autoload.php');

class Email
{
    public static function sendResetEmail($email, $url)
    {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['MAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['MAIL_PORT'];
        $mail->Username = $_ENV['MAIL_USERNAME'];
        $mail->Password = $_ENV['MAIL_PASSWORD'];


        $mail->setFrom($_ENV['MAIL_FROM']);
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = $_ENV['PROJECT_NAME'];
        $mail->Body = "Hello, to reset your password click <a href='$url'>here</a>";
        $mail->altBody = "Ola clique nesse link para resetar a senha ";

        try {
            $mail->send();
        } catch (\Throwable $th) {
            // echo $th;
        }
    }
}
