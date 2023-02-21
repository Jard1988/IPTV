<?php
include('../session.php');
require_once('../mailer/PHPMailer.php');
require_once('../mailer/SMTP.php');
require_once('../mailer/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

    $mail = new PHPMailer(true);

    //Variaveis de POST, Alterar somente se necessário
    //====================================================
    $email = $_REQUEST['email'];

    $sql = "SELECT users_id FROM users WHERE email = '$email'";
    $result = mysqli_query($db, $sql);
    $count = mysqli_num_rows($result);
    if ($count == 1) {
        try {
            //        $mail->SMTPDebug = SMTP::DEBUG_SERVER; // apresenta o DEBUG
            $mail->isSMTP();

            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;

            $mail->Username = MAIL_USERNAME;
            $mail->Password = MAIL_PASSWORD;
            $mail->Port = MAIL_PORT;

            $mail->setFrom(MAIL_USERNAME,MAIL_NAME); //nosso email from
            $mail->addAddress($email); // emails to

            $mail->isHTML(true);
            $mail->Subject = 'Ativacao Airsoft Planner';
            $mail->Body = 'Ativacao em falta do <strong>Email: </strong>' . $email . '<br>

                            <br><br>

                            Encontra-se em falta a Ativacao do seu Email para puder usufruir da Aplicação.
                            <br><br>
                            Obrigado pelo seu Registo na Airsoft Planner!<br><br>

                            Confirme o seu registo através do link:<br>
                            http://localhost/cerberus/confirm.php?email='.$email.'

                            <br><br>
                            Obrigado pelo seu contacto!<br>
                            Se tiver urgência ou o problema não ficar solucionadoqueira por favor ligar para 22X XXX XXX ou 9XX XXX XXX.<br><br>
                            NOTA: Não responda a este email, trata-se de uma mensagem automática de confirmação de receção do seu pedido.<br>
                            Cordiais cumprimentos,<br><br>

                            Airsoft Planner | Airsoft<br><br>

                            Está a receber esta mensagem porque entrou em contacto connosco através do formulário de contacto do nosso site http://www.bolanarede.website.
    <br>
                            Declaração de consentimento sobre campanhas:
    <br>
                            PROTEÇÃO DE DADOS PESSOAIS: A segurança e a privacidade de seus dados pessoais são importantes para nós. A Bola na Rede está em conformidade com o Regulamento Geral de Proteção de Dados em vigor na UE. Quando nos cede os seus dados pessoais, nós só os utilizaremos para o propósito para o qual foram fornecidos. Pode retirar o seu consentimento a qualquer momento. Por favor, veja nossa Política de Privacidade.';

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
    }else {
        echo "Ocorreu um erro. Tente Novamente.";
    }


exit;
?>
