<?php
include('../session.php');

require_once('../mailer/PHPMailer.php');
require_once('../mailer/SMTP.php');
require_once('../mailer/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

    //Variaveis de POST, Alterar somente se necessário
    //====================================================
    $assunto = $_REQUEST['assunto'];
    $mensagem = $_REQUEST['texto'];

    $sql = "SELECT * FROM users";
    $result = mysqli_query($db, $sql);
    while ($row = mysqli_fetch_array($result)){
        try {
            $mail = new PHPMailer(true);
            //        $mail->SMTPDebug = SMTP::DEBUG_SERVER; // apresenta o DEBUG
            $mail->isSMTP();

            $mail->Host = MAIL_HOST;
            $mail->SMTPAuth = true;

            $mail->Username = MAIL_USERNAME;
            $mail->Password = MAIL_PASSWORD;
            $mail->Port = MAIL_PORT;

            $mail->setFrom(MAIL_USERNAME,MAIL_NAME); //nosso email from
            $mail->addAddress($email); // emails to

            $mail->isHTML(true);
            $mail->Subject = utf8_decode($assunto);
            $mail->Body = utf8_decode('<strong>Email: </strong>' . $email . '<br>

                            <br><br>

                            ' . $mensagem
            );

            //$mail->setFrom('system@cksoftwares.com', 'CKSoftwares System'); // From email and name
            //$mail->addAddress('to@address.com', 'Mr. Brown'); // to email and name
            //$mail->Subject = 'PHPMailer GMail SMTP test';
            //$mail->msgHTML("test body"); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
            //$mail->AltBody = ''; // If html emails is not supported by the receiver, show this body
            // $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file

            if ($mail->send()) {
                echo "Email Enviado.";
            } else {
                echo "Email não enviado.";
            }
        } catch (Exception $e) {
            echo "Ocorreu um erro. Tente Novamente.";
        }
    }

?>
