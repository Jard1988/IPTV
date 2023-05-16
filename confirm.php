<?php
    require("db.php");
    require_once('mailer/PHPMailer.php');
    require_once('mailer/SMTP.php');
    require_once('mailer/Exception.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    $mail = new PHPMailer(true);

    $email = $_REQUEST['email'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($db, $sql);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $sql2 = "UPDATE users SET valid = 1 WHERE users.email= '".$email."'";
        $result2 = mysqli_query($db, $sql2);
        echo "1";
        try {
						//$mail->SMTPDebug = SMTP::DEBUG_SERVER; // apresenta o DEBUG
						$mail->isSMTP();

						$mail->Host = 'smtp.gmail.com';
						$mail->SMTPAuth = true;

						$mail->Username = MAIL_USERNAME;
						$mail->Password = MAIL_PASSWORD;
						$mail->Port = MAIL_PORT;

						$mail->setFrom(MAIL_USERNAME,MAIL_NAME); //nosso email from
						$mail->addAddress($email); // emails to

						$mail->isHTML(true);
						$mail->Subject = 'Ativacao na IPTV Planner';
						$mail->Body = 'Ativacao concluida com Sucesso <strong>IPTV Planner</strong><br>
												<br><br>

												Obrigado pelo seu contributo na IPTV Planner!<br><br>

												O seu Pedido foi concluido e validado com sucesso!<br><br>

                        Foi redireccionado e já pode iniciar sessão, com dados anteriormente fornecidos.<br>

                        Com esta funcionalidade podes atualizar os teus dados e atualizar a tua lista quando quiseres<br>
                        assim como entrar em contacto connosco por qualquer motivo que seja. <br><br>

                        Se tiver urgência ou existir algum problema não exite em entrar em contacto por email ou por favor ligar para 22X XXX XXX ou 9XX XXX XXX.<br><br>
												NOTA: Não responda a este email, trata-se de uma mensagem automática de confirmação de receção do seu pedido.<br>
												Cordiais cumprimentos,<br><br>

												IPTV Planner @ 2023<br><br>

												Está a receber esta mensagem porque entrou em contacto connosco através do formulário de contacto do nosso site http://www.iptvplanner.pt.
<br>
												Declaração de consentimento sobre campanhas:
<br>
												PROTEÇÃO DE DADOS PESSOAIS: A segurança e a privacidade de seus dados pessoais são importantes para nós. A IPTV Planner está em conformidade com o Regulamento Geral de Proteção de Dados em vigor na UE. Quando nos cede os seus dados pessoais, nós só os utilizaremos para o propósito para o qual foram fornecidos. Pode retirar o seu consentimento a qualquer momento. Por favor, veja nossa Política de Privacidade.';

						//$mail->setFrom('system@cksoftwares.com', 'CKSoftwares System'); // From email and name
						//$mail->addAddress('to@address.com', 'Mr. Brown'); // to email and name
						//$mail->Subject = 'PHPMailer GMail SMTP test';
						//$mail->msgHTML("test body"); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
						//$mail->AltBody = ''; // If html emails is not supported by the receiver, show this body
						// $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file
            if ($mail->send()) {
              header("Location: index.php");
            } else {
              header("Location: index.php");
            }

					} catch (Exception $e) {
							echo "Ocorreu um erro ao enviar o Email. Enviar Manualmente.";
					}
    }else {
        echo "0";
    }

?>
